<?php

/**
 * Classe AcompanhanteDAO
 * Camada de acesso a dados da entidade Acompanhante
 * @package model
 * @subpackage DAO
 */
class AcompanhanteDAO extends ClassDAO {

    /**
     * Atributos
     */
    private static $instancia;
    private $conexao;

    const TABELA = 'acompanhante';

    /**
     * Metodo construtor()
     */
    protected function __construct() {
        //passa pra a classe pai o nomeda tabelausada pela classe
        parent::__construct("acompanhante");
        $this->conexao = Connect::getInstancia();
    }

    /**
     * Metodo getInstancia()
     */
    public static function getInstancia() {
        if (!isset(self::$instancia))
            self::$instancia = new AcompanhanteDAO();
        return self::$instancia;
    }

    /**
     * Metodo inserir($obj)
     * @param $obj
     * @return Perfil
     */
    public function inserir(Acompanhante $obj) {
        // INSTRUCAO SQL //
        $sql = "INSERT INTO " . self::TABELA . "
            (nome, idade, altura,
        	peso, busto, cintura,
			quadril, olhos, pernoite,
			atendo, especialidade, horario_atendimento, 
			excluido, usuarios_id, usuarios_id_perfil
            ) 
            
            VALUES('" . $obj->getNome() . "',
            '" . $obj->getIdade() . "',
            '" . $obj->getAltura() . "',
            '" . $obj->getPeso() . "',
            '" . $obj->getBusto() . "',
            '" . $obj->getCintura() . "',
            '" . $obj->getQuadril() . "',
            '" . $obj->getOlhos() . "',
            '" . $obj->getPernoite() . "',		
            '" . $obj->getAtendo() . "',
            '" . $obj->getEspecialidade() . "',
            '" . $obj->getHorarioAtendimento() . "',
			'0',
            '" . $obj->getUsuarioId() . "',
            '" . $obj->getUsuarioIdPerfil() . "')";
        
        
        
        
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->exec($sql);
        // TRATANDO O RESULTADO //
        ($resultado) ? $obj->setId(mysql_insert_id()) : $obj = $resultado;
        // RETORNANDO O RESULTADO //
        return $obj;
    }

    /**
     * Metodo editar($obj)
     * @param $obj
     * @return Perfil
     */
    public function editar(Acompanhante $obj) {
        // INSTRUCAO SQL //
        $sql = "UPDATE " . self::TABELA . " SET 
            nome = '" . $obj->getNome() . "',
            idade =	'" . $obj->getIdade() . "',
            altura = '" . $obj->getAltura() . "',
            peso = '" . $obj->getPeso() . "',
            busto = '" . $obj->getBusto() . "',
            cintura = '" . $obj->getCintura() . "',
            quadril = '" . $obj->getQuadril() . "',
            olhos = '" . $obj->getOlhos() . "',
            pernoite = '" . $obj->getPernoite() . "',
            atendo = '" . $obj->getAtendo() . "',
            especialidade = '" . $obj->getEspecialidade() . "',
            horario_atendimento = '" . $obj->getHorarioAtendimento() . "'
            WHERE id = '" . $obj->getId() . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->exec($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }

    


}

?>