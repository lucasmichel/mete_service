<?php
class  Cliente{
	private $id;
	private $nome;
	private $cpf;
	private $excluido;
	private $usuario_id;
	private $usuario_id_perfil;
	
	function __construct($id = 0, $nome = '', $cpf = '', $excluido = '',
			$usuario_id = null, $usuario_id_perfil = null) {
		 
		$this->id = $id;
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->excluido = $excluido;
		$this->usuario_id = $usuario_id;
		$this->usuario_id_perfil = $usuario_id_perfil;
	}
	
	private function _validarCampos(){
		if(($this->getNome() == '')||($this->getId() == null))
			return false;
		return true;
	}
	
	public static function listar() {
		$instancia = ClienteDAO::getInstancia();
		$cliente = $instancia->listar();
		if (!$cliente)
			throw new ListaVazia(ListaVazia::CLIENTE);
		foreach ($cliente as $cliente) {
			$objetos[] = new Cliente($cliente['id'], $cliente['nome'], $cliente['cpf'],
					$cliente['excluido'], $cliente['usuario_id'], $cliente['usuario_id_perfil']);
		}
		return $objetos;
	}
	
	public static function buscar($id) {
		$instancia = ClienteDAO::getInstancia();
		$cliente = $instancia->buscar($id);
		if (!$cliente)
			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::CLIENTE);
		return new Cliente($cliente['id'], $cliente['nome'], $cliente['cpf'],
					$cliente['excluido'], $cliente['usuario_id'], $cliente['usuario_id_perfil']);
		}
		
		public function inserir(){
			// validando os campos //
			if(!$this->_validarCampos())
				// levantando a excessao CamposObrigatorios //
				throw new CamposObrigatorios();
			// recuperando a instancia da classe de acesso a dados //
			$instancia = ClienteDAO::getInstancia();
			// executando o metodo //
			$cliente = $instancia->inserir($this);
			// retornando o Usuario //
			return  $cliente = $instancia->inserir($this);
		}
		
		public function editar(){
			// validando os campos //
			if(!$this->_validarCampos())
				// levantando a excessao CamposObrigatorios //
				throw new CamposObrigatorios();
			// recuperando a instancia da classe de acesso a dados //
			$instancia = ClienteDAO::getInstancia();
			// executando o metodo //
			$cliente = $instancia->editar($this);
			// retornando o Usuario //
			return  $cliente = $instancia->editar($this);
		}
		
		public function excluir(){
			// recuperando a instancia da classe de acesso a dados //
			$instancia = ClienteDAO::getInstancia();
			// executando o metodo //
			$cliente = $instancia->excluir($this->getId());
			// retornando o resultado //
			return $cliente;
		}
	
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getNome() {
		return $this->nome;
	}
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getCpf() {
		return $this->cpf;
	}
	
	public function setCpf($cpf) {
		$this->cpf = $cpf;
	}
	
	public function getExcluido() {
		return $this->cpf;
	}
	
	public function setExcluido($cpf) {
		$this->cpf = $cpf;
	}
	public function getUsuarioId() {
		return $this->usuario_id;
	}
	public function setUsuarioId($usuario_id) {
		$this->usuario_id = $usuario_id;
	}
	public function getUsuarioIdPerfil() {
		return $this->usuario_id_perfil;
	}
	public function setUsuarioIdPerfil($usuario_id_perfil) {
		$this->usuario_id_perfil = $usuario_id_perfil;
	}
}

?>