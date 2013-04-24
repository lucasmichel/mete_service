<?php
 class Avaliacao{
 	private $id;
 	private $nota;
 	private $cliente_id;
 	private $acompanhante_id;
 	
 	public function __construct($id = 0, $nota = '', $cliente_id = null, $acompanhante_id = null) {
 		$this->id = $id;
 		$this->nota = $nota;
 		$this->cliente_id = $cliente_id;
 		$this->acompanhante_id = $acompanhante_id;
 	}
 	
 	private function _validarCampos(){
 		if(($this->getNota() == '')||($this->getId() == null)||($this->getClienteId() == null)
 				||($this->getAcompanhanteId() == null))
 			return false;
 		return true;
 	}
 	
 	public static function listar() {
 		$instancia = AvaliacaoDAO::getInstancia();
 		$avaliacao = $instancia->listar();
 		if (!$avaliacao)
 			throw new ListaVazia(ListaVazia::AVALIACAO);
 		foreach ($avaliacao as $avaliacao) {
 			$objetos[] = new Avaliacao($avaliacao['id'], $avaliacao['nota'], $avaliacao['cliente_id'],
 					$avaliacao['acompanhante_id']);
 		}
 		return $objetos;
 	}
 	
 	public static function buscar($id) {
 		$instancia = AvaliacaoDAO::getInstancia();
 		$avaliacao = $instancia->buscar($id);
 		if (!$avaliacao)
 			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::AVALIACAO);
 		return new Avaliacao($avaliacao['id'], $avaliacao['nota'], $avaliacao['cliente_id'],
 					$avaliacao['acompanhante_id']);
 	}
 	
 	public function inserir(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = AvaliacaoDAO::getInstancia();
 		// executando o metodo //
 		$avaliacao = $instancia->inserir($this);
 		// retornando o Usuario //
 		return  $avaliacao = $instancia->inserir($this);
 	}
 	
 	public function editar(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = AvaliacaoDAO::getInstancia();
 		// executando o metodo //
 		$avaliacao = $instancia->editar($this);
 		// retornando o Usuario //
 		return  $avaliacao = $instancia->editar($this);
 	}
 	
 	public function excluir(){
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = AvaliacaoDAO::getInstancia();
 		// executando o metodo //
 		$avaliacao = $instancia->excluir($this->getId());
 		// retornando o resultado //
 		return $avaliacao;
 	}
 	
 	public function getId() {
 		return $this->id;
 	}
 	
 	public function setId($id) {
 		$this->id = $id;
 	}
 	public function getNota() {
 		return $this->id;
 	}
 	
 	public function setNota($nota) {
 		$this->nota = $nota;
 	}
 	
 	public function getClienteId() {
 		return $this->cliente_id;
 	}
 	
 	public function setClienteId($cliente_id) {
 		$this->cliente_id = $cliente_id;
 	}
 	
 	public function getAcompanhanteId() {
 		return $this->acompanhanteId;
 	}
 	
 	public function setAcompanhanteId($acompanhanteId) {
 		$this->acompanhanteId = $acompanhanteId;
 	}
 }

?>