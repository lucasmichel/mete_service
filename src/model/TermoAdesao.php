<?php
 class TermoAdesao{
 	private $id;
 	private $ip;
 	private $browser;
 	private $data;
 	private $usuario_id; 
 	private $usuario_id_perfil;
 	
 	public function __construct($id = 0, $ip = '', $browser = '',$data = '', $usuario_id = null,
 			 $usuario_id_perfil = null) {
 		$this->id = $id;
 		$this->ip = $ip;
 		$this->browser = $browser;		
 		$this->data = $data;
 		$this->usuario_id = $usuario_id;
 		$this->usuario_id_perfil = $usuario_id_perfil;
 	}
 	
 	private function _validarCampos(){
 		if(($this->getIp() == '')||($this->getId() == null)||($this->getBrowser() == '')
 	     ||($this->getData() == '')||($this->getUsuarioId() == null)||($this->getUsuarioIdPerfil() == null))
 			return false;
 		return true;
 	}
 	
 	public static function listar() {
 		$instancia = TermoAdesaoDAO::getInstancia();
 		$modulos = $instancia->listar();
 		if (!$termoAdesao)
 			throw new ListaVazia(ListaVazia::TERMOADESAO);
 		foreach ($termoAdesao as $termoAdesao) {
 			$objetos[] = new TermoAdesao($termoAdesao['id'], $termoAdesao['ip'], $termoAdesao['browser'],
 					$termoAdesao['data'], $termoAdesao['usuario_id'], $termoAdesao['usuario_id_perfil']);
 		}
 		return $objetos;
 	}
 	
 	
 	public static function buscar($id) {
 		$instancia = TermoAdesaoDAO::getInstancia();
 		$termoAdesao = $instancia->buscar($id);
 		if (!$modulo)
 			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::TERMOADESAO);
 		return new TermoAdesao($termoAdesao['id'], $termoAdesao['ip'], $termoAdesao['browser'],
 					$termoAdesao['data'], $termoAdesao['usuario_id'], $termoAdesao['usuario_id_perfil']);
 	}
 	
 	
 	public function inserir(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = TermoAdesaoDAO::getInstancia();
 		// executando o metodo //
 		$termoAdesao = $instancia->inserir($this);
 		// retornando o Usuario //
 		return  $termoAdesao = $instancia->inserir($this);
 	}
 	
 	public function editar(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = TermoAdesaoDAO::getInstancia();
 		// executando o metodo //
 		$termoAdesao = $instancia->editar($this);
 		// retornando o Usuario //
 		return  $termoAdesao = $instancia->editar($this);
 	}
 	
 	public function excluir(){
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = TermoAdesaoDAO::getInstancia();
 		// executando o metodo //
 		$termoAdesao = $instancia->excluir($this->getId());
 		// retornando o resultado //
 		return $termoAdesao;
 	}
 	
 	public function getId() {
 		return $this->id;
 	}
 	
 	public function setId($id) {
 		$this->id = $id;
 	}
 	
 	public function getIp() {
 		return $this->ip;
 	}
 	
 	public function setIp($ip) {
 		$this->ip = $ip;
 	}
 	
 	//browser
 	public function getBrowser() {
 		return $this->browser;
 	}
 	
 	public function setBrowser($browser) {
 		$this->browser = $browser;
 	}
 	
 	public function getLink() {
 		return $this->link;
 	}
 	
 	public function setLink($link) {
 		$this->link = $link;
 	}
 	
 	public function getData() {
 		return $this->data;
 	}
 	
 	public function setData($data) {
 		$this->data = $data;
 	}
 	
 	public function getUsuarioId() {
 		return $this->usuario_id;
 	}
 	
 	public function setUsuarioId($UsuarioId) {
 		$this->usuario_id = $UsuarioId;
 	}
 	public function getUsuarioIdPerfil() {
 		return $this->usuario_id_perfil;
 	}
 	
 	public function setUsuarioIdPerfil($UsuarioIdPerfil) {
 		$this->usuario_id_perfil = $UsuarioIdPerfil;
 	}
 	
 }


?>