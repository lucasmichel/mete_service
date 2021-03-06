<?php

/**
 * Classe PerfilDAO
 * Camada de acesso a dados da entidade Perfil
 * @package model
 * @subpackage DAO
 */
class PerfilDAO extends ClassDAO {

    /**
     * Atributos
     */
    private static $instancia;
    private $conexao;

    const TABELA = 'perfis';

    /**
     * Metodo construtor()
     */
    protected function __construct() {
        //passa pra a classe pai o nomeda tabelausada pela classe
        parent::__construct("perfis");
        $this->conexao = Connect::getInstancia();
    }

    /**
     * Metodo getInstancia()
     */
    public static function getInstancia() {
        if (!isset(self::$instancia))
            self::$instancia = new PerfilDAO();
        return self::$instancia;
    }

    /**
     * Metodo inserir($obj)
     * @param $obj
     * @return Perfil
     */
    public function inserir($obj) {
        // INSTRUCAO SQL //
        $sql = "INSERT INTO " . self::TABELA . "(nome, excluido) VALUES('" . $obj->getNome() . "', 0)";
        // EXECUTANDO A SQL //
        $perfil = $this->conexao->exec($sql);
        // RECUPERANDO O ID //
        $obj->setId(mysql_insert_id());
        // PERCORRENDO AS ACOES //
        foreach ($obj->getAcoes() as $acao) {
            // INSTRUCAO SQL 2 //
            $sql2 = "INSERT INTO acoes_modulos_perfis(codigo_acao,id_modulo,id_perfil) 
                VALUES('" . $acao->getCodigoAcao() . "',
            '" . $acao->getModulo()->getId() . "',
            '" . $obj->getId() . "')";
            // EXECUTANDO A SQL 2 //
            $this->conexao->exec($sql2);
        }
        // RETORNANDO O RESULTADO //
        return $perfil;
    }

    /**
     * Metodo editar($obj)
     * @param $obj
     * @return Perfil
     */
    public function editar(Perfil $obj) {
        // INSTRUCAO SQL //

        $sql = "UPDATE " . self::TABELA . " SET nome = '" . $obj->getNome() . "' 
        WHERE id = '" . $obj->getId() . "'";
        $this->conexao->exec($sql);

        // INSTRUCAO SQL 2 //
        $sql2 = "DELETE FROM acoes_modulos_perfis WHERE id_perfil = '" . $obj->getId() . "'";
        $this->conexao->exec($sql2);

        
     
        
        foreach ($obj->getAcoes() as $acao) {
            // INSTRUCAO SQL 3 //
            $sql3 = "INSERT INTO acoes_modulos_perfis
            (codigo_acao,id_modulo,id_perfil) VALUES('" . $acao->getCodigoAcao() . "',
            '" . $acao->getModulo()->getId() . "',
            '" . $obj->getId() . "')";
            $this->conexao->exec($sql3);
        }
    }

    /**
     * Metodo excluir($id)
     * @param $id
     * @return boolean
     */
    public function excluir($id) {
        // checando se existe algum vinculo desse registro com outros //
        $validacao = "SELECT u.id FROM usuarios u WHERE id_perfil = '" . $id . "'";
        if ($this->conexao->fetch($validacao))
            throw new RegistroNaoExcluido(RegistroNaoExcluido::PERFIL);
        // INSTRUCOES SQL //
        $sql[] = "DELETE FROM " . self::TABELA . " WHERE id = '" . $id . "'";
        $sql[] = "DELETE FROM acoes_modulos_perfis WHERE id_perfil = '" . $id . "'";
        // PERCORRENDO AS SQL //
        foreach ($sql as $item) {
            // EXECUTANDO A SQL //
            $resultado = $this->conexao->exec($item);
        }
        // RETORNANDO O RESULTADO //
        return $resultado;
    }

    

    

    /**
     * Metodo setAcoes($perfil)
     * @param $perfil
     * @return fetch_assoc[]
     */
    public function setAcoes($perfil) {
        // INSTRUCAO SQL //
        $sql = "SELECT amp.codigo_acao,amp.id_modulo FROM acoes_modulos_perfis amp
					WHERE amp.id_perfil = '" . $perfil . "'
					ORDER BY amp.codigo_acao";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetchAll($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }

}

?>