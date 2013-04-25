<?php
class  Cliente{
	private $id;
	private $nome;
	private $cpf;
	private $excluido;
	private $usuarioId;
	private $usuarioIdPerfil;

	function __construct($id = 0, $nome = '', $cpf = '', $excluido = '',
			$usuarioId = null, $usuarioIdPerfil = null) {
			
		$this->id = $id;
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->excluido = $excluido;
		$this->usuarioId = $usuarioId;
		$this->usuarioIdPerfil = $usuarioIdPerfil;
	}

	public function _validarCampos(){
		$retorno = true;
		
		if(($this->getNome() == '')||($this->getCpf() == null)){
			throw new CamposObrigatorios();
    		$retorno = false;
		}
		else if($this->getId() == 0){
			if($this->_testarCpfExiste())
				throw new Exception("CPF já cadastrado em nossa base de dados");
		}
		else if($this->getId() != 0){
			if($this->_testarCpfExisteEdicao())
				throw new Exception("Email já utilizado por outro cliente");
		}
		else
		{
			$retorno = true;
		}
		return $retorno;
	}

	public static function listar($campo) {
		$instancia = ClienteDAO::getInstancia();
		$cliente = $instancia->listar($campo);
		if (!$cliente)
			throw new ListaVazia(ListaVazia::CLIENTES);
		foreach ($cliente as $cliente) {
			$objetos[] = self::construirObjeto($cliente);
		}
		return $objetos;
	}

	public static function buscar($id) {
		$instancia = ClienteDAO::getInstancia();
		$cliente = $instancia->buscarPorId($id);
		if (!$cliente)
			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::CLIENTE);
		
		return self::construirObjeto($cliente);
	}

	public function inserir(){
		// validando os campos //
		if($this->_validarCampos()){
			// recuperando a instancia da classe de acesso a dados //
			$instancia = ClienteDAO::getInstancia();
			// executando o metodo //
			$cliente = $instancia->inserir($this);
			// retornando o Usuario //
			return  $cliente;
		}
	}

	public function editar(){
		// validando os campos //
		if($this->_validarCampos()){
			//recuperando a instancia da classe de acesso a dados //
			$instancia = ClienteDAO::getInstancia();
			// executando o metodo //
			$cliente = $instancia->editar($this);
			// retornando o Usuario //
			return  $cliente;
		}
		
		
		
	}

	public function excluir(){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ClienteDAO::getInstancia();
		// executando o metodo //
		
		$usuario = Usuario::buscar($this->getUsuarioId());
		
		$usuario = $usuario->excluir();
		
		$cliente = $instancia->excluir($this->getId());
		// retornando o resultado //
		return $cliente;
	}

	private static function construirObjeto($dados){
			
		$cliente = new Cliente();
		$cliente->setId($dados['id']);
		$cliente->setNome($dados['nome']);
		$cliente->setCpf($dados['cpf']);
		$cliente->setExcluido($dados['excluido']);
		$cliente->setUsuarioId($dados['usuarios_id']);
		$cliente->setUsuarioIdPerfil($dados['usuarios_id_perfil']);
		return $cliente;
			
	}

	
	private function _testarCpfExiste(){
		// recuperando a instancia da classe de acesso a dados //
    	$instancia = ClienteDAO::getInstancia();
    	// executando o metodo //
    	$objeto = $instancia->testarCpfExiste($this->getCpf());
    	// checando se o resultado foi falso //
    	if($objeto)
	    	return true;
    	// instanciando e retornando o bollean//
    	else
			return false;
	}
	
	private function _testarCpfExisteEdicao(){
		// recuperando a instancia da classe de acesso a dados //
    	$instancia = ClienteDAO::getInstancia();
    	// executando o metodo //
    	$objeto = $instancia->testarCpfExisteEdicao($this->getId() ,$this->getCpf());
    	// checando se o resultado foi falso //
    	if($objeto)
	    	return true;
    	// instanciando e retornando o bollean//
    	else
			return false;
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

	public function setExcluido($excluido) {
		$this->excluido = $excluido;
	}
	public function getUsuarioId() {
		return $this->usuarioId;
	}
	public function setUsuarioId($usuarioId) {
		$this->usuarioId = $usuarioId;
	}
	public function getUsuarioIdPerfil() {
		return $this->usuarioIdPerfil;
	}
	public function setUsuarioIdPerfil($usuarioIdPerfil) {
		$this->usuarioIdPerfil = $usuarioIdPerfil;
	}
}

?>