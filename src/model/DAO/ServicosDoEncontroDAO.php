<?php
class ServicosDoEncontroDAO extends ClasseDAO{
    /**
     * Atributos
     */
    private static $instancia;
    private $conexao;

    const TABELA = 'servicos_do_encontro';

    /**
     * Metodo construtor()
     */
    protected function __construct() {
        //passa pra a classe pai o nomeda tabelausada pela classe
        parent::__construct("servicos_do_encontro");
        $this->conexao = Connect::getInstancia();
    }

    /**
     * Metodo getInstancia()
     */
    public static function getInstancia() {
        if (!isset(self::$instancia))
                self::$instancia = new ServicosDoEncontroDAO();
        return self::$instancia;
    }

    public function inserir(ServicosDoEncontro  $obj) {
        // INSTRUCAO SQL //
        $sql = "INSERT INTO " . self::TABELA . "
        (encontro_id,
        cliente_id,
        servicos_acompanhante_id,
        servico_id,
        acompanhante_id,
        aprovado, 
        excluido)
        VALUES('" . $obj->getEncontroId()  . "',
        '" . $obj->getClienteId() . "',
        '" . $obj->getServicosAcompanhanteId() . "',
        '" . $obj->getServicoId() . "',
        '" . $obj->getAcompanhanteId() . "',
        '" . $obj->getAprovado() . "',
        '0')";

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
    public function editar(ServicosDoEncontro $obj) {
        // INSTRUCAO SQL //
        $sql = "UPDATE " . self::TABELA . " SET
        cliente_id = '" . $obj->getClienteId() . "',
        servicos_acompanhante_id = '" . $obj->getServicosAcompanhanteId() . "',
        servico_id = '" . $obj->getServicoId() . "',
        acompanhante_id = '" . $obj->getAcompanhanteId() . "',
        aprovado = '" . $obj->getAprovado() . "'
        WHERE id = '" . $obj->getId() . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->exec($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }



    public function buscar($id) {
        // INSTRUCAO SQL //
        $sql = "SELECT e.* FROM " . self::TABELA . " e WHERE e.id = '" . $id . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetch($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }

    /**
     * Metodo listar()
     * @return fetch_assoc[]
     */
    /*public function listar() {
            // INSTRUCAO SQL //
            $sql = "SELECT e.* FROM " . self::TABELA . ";";
            // EXECUTANDO A SQL //
            $resultado = $this->conexao->fetchAll($sql);
            // RETORNANDO O RESULTADO //
            return $resultado;
    }*/


    public function listarPorIdAcompanhante($id) {
        // INSTRUCAO SQL //
        $sql = "SELECT e.* FROM " . self::TABELA . " e WHERE e.acompanhante_id = '" . $id . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetchAll($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }



    public function listarPorIdCliente($id) {
        // INSTRUCAO SQL //
        $sql = "SELECT e.* FROM " . self::TABELA . " e WHERE e.cliente_id = '" . $id . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetchAll($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }
    
    public function listarPorIdEcontro($id) {
        // INSTRUCAO SQL //
        $sql = "SELECT e.* FROM " . self::TABELA . " e WHERE e.encontro_id = '" . $id . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetchAll($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }
	
	
}

?>