<?php
class ServicosAcompanhante {
	/**
	 * @Lucas Michel
	 */
	private $id;
	private $servicoId;
	private $valor;
	private $acompanhanteId;
	private $excluido;

	function __construct($id = 0, $servicoId = 0, 
                $acompanhanteId = 0, $valor = 0, $excluido = 0) {
		$this->id = $id;
		$this->servicoId = $servicoId;
		$this->acompanhanteId = $acompanhanteId;
		$this->valor = $valor;
		$this->excluido = $excluido;
		
	}
	public function getId() {
		return $this->id;
	}
        
        public function setId($id) {
		$this->id = $id;
	}
        
	public function getServicoId() {
		return $this->servicoId;
	}
	public function setServicoId($servicoId) {
		$this->servicoId = $servicoId;
	}
        
        public function getValor() {
		return $this->valor;
	}
        public function setValor($valor) {
		$this->valor = $valor;
	}
        
        public function getAcompanhanteId() {
		return $this->acompanhanteId;
	}
        public function setAcompanhanteId($acompanhanteId) {
		$this->acompanhanteId = $acompanhanteId;
	}
	
	
        
        public function getExcluido() {
		return $this->excluido;
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
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosAcomapnhanteDAO::getInstancia();
		// retornando o Usuario //
		return  $instancia->inserir($this);
	}
	
	public function editar(){
		// validando os campos //
		if(!$this->_validarCampos())
			// levantando a excessao CamposObrigatorios //
			throw new CamposObrigatorios();		
		
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosAcomapnhanteDAO::getInstancia();
		// retornando o Usuario //
		return  $instancia->editar($this);
	}
	
	public function excluir(){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosAcomapnhanteDAO::getInstancia();
		
		//executando o metodo e retornando o resultado //
		return $instancia->excluir($this->getId());
	}
	
	public static function listar($ordenarPor){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosAcomapnhanteDAO::getInstancia();
		// executando o metodo //
		$servicos = $instancia->listar($ordenarPor);
		// checando se o retorno foi falso //
		if(!$servicos)
			// levantando a excessao ListaVazia //
			throw new ListaVazia(ListaVazia::SERVICOS_ACOMPANHNATE);
		// percorrendo os usuarios //
		foreach($servicos as $servico){
			// instanciando e jogando dentro da colecao $objetos o Usuario //
			$objetos[] = new ServicosAcompanhantes($servico['id'],					
					$servico['servico_id'],
					$servico['valor'],
					$servico['acompanhante_id'],
					$servico['excluido']
                                );
		}
		// retornando a colecao $objetos //
		return $objetos;
	}
        
        
	public static function listarPorAcompanhante(Acompanhante $acompanhante){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosAcomapnhanteDAO::getInstancia();
		// executando o metodo //
		$servicos = $instancia->listarPorIdAcompanhante($acompanhante->getId());
		// checando se o retorno foi falso //
		if(!$servicos)
			// levantando a excessao ListaVazia //
			throw new ListaVazia(ListaVazia::SERVICOS_ACOMPANHNATE);
		// percorrendo os usuarios //
		foreach($servicos as $servico){
			// instanciando e jogando dentro da colecao $objetos o Usuario //
			$objetos[] = new ServicosAcompanhantes($servico['id'],					
					$servico['servico_id'],
					$servico['valor'],
					$servico['acompanhante_id'],
					$servico['excluido']
                                );
		}
		// retornando a colecao $objetos //
		return $objetos;
	}
	
	public static function buscar($id){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosAcomapnhanteDAO::getInstancia();
		// executando o metodo //
		$servico = $instancia->buscarPorId($id);
		// checando se o resultado foi falso //
		if(!$servico)
			// levanto a excessao RegistroNaoEncontrado //
			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::SERVICO);
		// instanciando e retornando o Usuario //
	
		$a = new ServicosAcompanhantes($servico['id'],					
					$servico['servico_id'],
					$servico['valor'],
					$servico['acompanhante_id'],
					$servico['excluido']
                                );
		return $a;
	}
	
	
	
	
	public static function listarParaWebService(){
		// recuperando a instancia da classe de acesso a dados //
    	$instancia = ServicoDAO::getInstancia();
    	// executando o metodo //
    	$servicos = $instancia->listar("nome");
    	// checando se o retorno foi falso //
    	if(!$servicos)
    		// levantando a excessao ListaVazia //
    		throw new ListaVazia(ListaVazia::SERVICOS);
    	return $servicos;
	}
}

?>