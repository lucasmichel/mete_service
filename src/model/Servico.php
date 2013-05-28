<?php
class Servico {
	/**
	 * @kayky lopes
	 */
	private $id;
	private $nome;
	private $excluido;

	function __construct($id = 0, $nome = '', $excluido = 0) {
		$this->id = $id;
		$this->nome = $nome;
		$this->excluido = $excluido;
		
	}
	public function getId() {
		return $this->id;
	}
	
	public function getNome() {
		return $this->nome;
	}
	
	public function getExcluido() {
		return $this->excluido;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	public function setExcluido($excluido) {
		$this->excluido = $excluido;
	}
	
	/**
	 * Metodo _validarCampos()
	 * @return boolean
	 */
	private function _validarCampos(){
		if($this->getNome() == null)
			return false;
		return true;
	}
	
	public function inserir(){
		// validando os campos //
		if(!$this->_validarCampos())
			// levantando a excessao CamposObrigatorios //
			throw new CamposObrigatorios();
		
		if($this->_testarServicoExiste($this->getNome()))
			// levanto a excessao//
			throw new Exception("Serviço já cadastrado en nossa base de dados");
		
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// retornando o Usuario //
		return  $servico = $instancia->inserir($this);
	}
	
	public function editar(){
		// validando os campos //
		if(!$this->_validarCampos())
			// levantando a excessao CamposObrigatorios //
			throw new CamposObrigatorios();
		
		if($this->_testarServicoExisteEdicao($this->getId(), $this->getNome()))
			// levanto a excessao//
			throw new Exception("Servico já cadastrado en nossa base de dados");
		
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia(); 
		// retornando o Usuario //
		return  $servico = $instancia->editar($this);
	}
	
	public function excluir(){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// executando o metodo //
		$servico = $instancia->excluir($this->getId());
		// retornando o resultado //
		return $servico;
	}
	
	public static function listar($ordenarPor){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// executando o metodo //
		$servico = $instancia->listar($ordenarPor);
		// checando se o retorno foi falso //
		if(!$servico)
			// levantando a excessao ListaVazia //
			throw new ListaVazia(ListaVazia::SERVICOS);
		// percorrendo os usuarios //
		foreach($servico as $servico){
			// instanciando e jogando dentro da colecao $objetos o Usuario //
			$objetos[] = new Servico($servico['id'],					
					$servico['nome'],
					$servico['excluido']
			);
		}
		// retornando a colecao $objetos //
		return $objetos;
	}
        
	public static function listarParaWebService($ordenarPor){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// executando o metodo //
		$servico = $instancia->listar($ordenarPor);
		// checando se o retorno foi falso //
		if(!$servico)
			// levantando a excessao ListaVazia //
			throw new ListaVazia(ListaVazia::SERVICOS);
		// percorrendo os usuarios //
		foreach($servico as $servico){
			// instanciando e jogando dentro da colecao $objetos o Usuario //
                        
                        $objetos[] = $servico;
		}
		// retornando a colecao $objetos //
		return $objetos;
	}
        
        
	public static function buscarServicoPorIdParaWebService($idServico){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// executando o metodo //
		$servico = $instancia->buscarServicoPorIdParaWebService($idServico);
		// checando se o retorno foi falso //
		if(!$servico)
			// levantando a excessao ListaVazia //
			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::SERVICO);
		// percorrendo os usuarios //
                
                
                $objeto = (array) new  Servico($servico['id'],					
					$servico['nome'],
					$servico['excluido']
			);
		// retornando a colecao $objetos //
		return $objeto;
	}
        
        
	
	public static function buscar($id){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// executando o metodo //
		$servico = $instancia->buscarPorId($id);
		// checando se o resultado foi falso //
		if(!$servico)
			// levanto a excessao RegistroNaoEncontrado //
			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::SERVICO);
		// instanciando e retornando o Usuario //
	
		$a = new  Servico($servico['id'],					
					$servico['nome'],
					$servico['excluido']
			);
		return $a;
	}
	
	/**
	 * Metodo testarEmailExiste($email)
	 * @param $email
	 * @return Usuario
	 */
	private static function _testarServicoExiste($nome){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// executando o metodo //
		$objeto = $instancia->testarServicoExiste($nome);
		// checando se o resultado foi falso //
		if($objeto)
			return true;
		// instanciando e retornando o bollean//
		else
			return false;
	}
	
	
	/**
	 * Metodo testarEmailExiste($email)
	 * @param $email
	 * @return Usuario
	 */
	private static function _testarServicoExisteEdicao($id, $nome){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// executando o metodo //
		$objeto = $instancia->testarServicoExisteEdicao($id, $nome);
		// checando se o resultado foi falso //
		if($objeto)
			return true;
		// instanciando e retornando o bollean//
		else
			return false;
	}
}

?>