<?php
 class Avaliacao{
 	private $id;
 	private $nota;
 	private $clienteId;
 	private $acompanhanteId;
 	
 	public function __construct($id = 0, $nota = '', $clienteId = null, $acompanhanteId = null) {
 		$this->id = $id;
 		$this->nota = $nota;
 		$this->clienteId = $clienteId;
 		$this->acompanhanteId = $acompanhanteId;
 	}
 	
 	private function _validarCampos(){
 		
 		$retorno = true;
 		if($this->getNota() == null){
 			throw new CamposObrigatorios("Avaliacao");
 			$retorno = false;
 		}
 		else{
 			$retorno = true;
 		
 		}
 		return $retorno;
 	}
 	
 	public static function listarPorAcompanhante(Acompanhante $acompanhante){
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = AvaliacaoDAO::getInstancia();
 		// executando o metodo //
 		$avaliacao = $instancia->listarPorIdAcompanhante($acompanhante->getId());
 		// checando se o retorno foi falso //
 		if(!$avaliacao)
 			// levantando a excessao ListaVazia //
 			throw new ListaVazia(ListaVazia::AVALIACAO);
 		// percorrendo os usuarios //
 		foreach($avaliacao as $avaliacao){
 			// instanciando e jogando dentro da colecao $objetos o Usuario //
 			$ob = new Comentario($avaliacao['id'], $avaliacao['nota'],
 					$avaliacao['clienteId'], $avaliacao['acompanhanteId']);
 			$objetos[] = (array) $ob;
 		}
 		// retornando a colecao $objetos //
 		return $objetos;
 	}
 	
 	public static function listar() {
 		$instancia = AvaliacaoDAO::getInstancia();
 		$avaliacao = $instancia->listar();
 		if (!$avaliacao)
 			throw new ListaVazia(ListaVazia::AVALIACAO);
 		foreach ($avaliacao as $avaliacao) {
 			$objetos[] = new Avaliacao($avaliacao['id'], $avaliacao['nota'], $avaliacao['clienteId'],
 					$avaliacao['acompanhanteId']);
 		}
 		return $objetos;
 	}
 	
 	public static function buscar($id) {
 		$instancia = AvaliacaoDAO::getInstancia();
 		$avaliacao = $instancia->buscar($id);
 		if (!$avaliacao)
 			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::AVALIACAO);
 		return new Avaliacao($avaliacao['id'], $avaliacao['nota'], $avaliacao['clienteId'],
 					$avaliacao['acompanhanteId']);
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
 		//return  $avaliacao = $instancia->inserir($this);
 	}
 	
 	public function editar(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = AvaliacaoDAO::getInstancia();
 		// executando o metodo //
 		 if($instancia->editar($this))
                return $this;
            else
                return null;
 		// retornando o Usuario //
 		//return  $avaliacao = $instancia->editar($this);
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
 		return $this->nota;
 	}
 	
 	public function setNota($nota) {
 		$this->nota = $nota;
 	}
 	
 	public function getClienteId() {
 		return $this->clienteId;
 	}
 	
 	public function setClienteId($cliente_id) {
 		$this->clienteId = $cliente_id;
 	}
 	
 	public function getAcompanhanteId() {
 		return $this->acompanhanteId;
 	}
 	
 	public function setAcompanhanteId($acompanhanteId) {
 		$this->acompanhanteId = $acompanhanteId;
 	}
 }

?>