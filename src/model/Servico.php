<?php
class  Servico{
	/**
	 * @kayky lopes
	 */
	private $id;
	private $nome;

	function __construct($id = 0, $nome = '') {
		$this->id = $id;
		$this->nome = $nome;
		
	}
	public function getId() {
		return $this->id;
	}
	
	public function getNome() {
		return $this->nome;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	public function inserir(){
		// validando os campos //
		if(!$this->_validarCampos())
			// levantando a excessao CamposObrigatorios //
			throw new CamposObrigatorios();
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// executando o metodo //
		$servico = $instancia->inserir($this);
		// retornando o Usuario //
		return  $servico = $instancia->inserir($this);
	}
	
	public function editar(){
		// validando os campos //
		if(!$this->_validarCampos())
			// levantando a excessao CamposObrigatorios //
			throw new CamposObrigatorios();
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicoDAO::getInstancia();
		// executando o metodo //
		$servico = $instancia->editar($this);
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
			throw new ListaVazia(ListaVazia::FOTOS);
		// percorrendo os usuarios //
		foreach($servico as $servico){
			// instanciando e jogando dentro da colecao $objetos o Usuario //
			$objetos[] = new Servico($servico['id'],					
					$servico['nome']
			);
		}
		// retornando a colecao $objetos //
		return $objetos;
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
				$servico['nome']);
		return $a;
	}
	
}

?>