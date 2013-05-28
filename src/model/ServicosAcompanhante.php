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
        
        public static function objetoParaArray(ServicosAcompanhante $obj){
            
            $da['id'] = $obj->getId();
            $da['servicoId'] = $obj->getServicoId();
            $da['acompanhanteId'] = $obj->getAcompanhanteId();
            $da['valor'] = $obj->getValor();
            $da['excluido'] = $obj->getExcluido();

            return $da;
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
            $retorno = false;
            
            if($this->getServicoId() == 0){
                throw new CamposObrigatorios("Servico acompanhnante: servicoId");
                $retorno = false;
            }
            if($this->getAcompanhanteId() == 0){
                throw new CamposObrigatorios("Servico acompanhnante: acompanhante id");
                $retorno = false;
            }
            if($this->getValor() == 0){
                throw new CamposObrigatorios("Servico acompanhnante: valor");
                $retorno = false;
            }            
            else
                {
                    $retorno = true;

            }	
            return $retorno;
	}
        
	public function inserir(){
		// validando os campos //
		if($this->_validarCampos()){
                    // recuperando a instancia da classe de acesso a dados //
                    $instancia = ServicosAcomapnhanteDAO::getInstancia();
                    // retornando o Usuario //
                    return  $instancia->inserir($this);
                }
			
	}
	
	public function editar(){
		// validando os campos //
		if($this->_validarCampos()){
                    // recuperando a instancia da classe de acesso a dados //
                    $instancia = ServicosAcomapnhanteDAO::getInstancia();
                    // retornando o Usuario //
                    return  $instancia->editar($this);    
                }
	}
	
	public function excluir(){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosAcomapnhanteDAO::getInstancia();
		
		//executando o metodo e retornando o resultado //
		return $instancia->excluir($this->getId());
	}
	
	public static function listar(){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosAcomapnhanteDAO::getInstancia();
		// executando o metodo //
		$servicos = $instancia->listar();
		// checando se o retorno foi falso //
		if(!$servicos)
			// levantando a excessao ListaVazia //
			throw new ListaVazia(ListaVazia::SERVICOS_ACOMPANHNATE);
		// percorrendo os usuarios //
		foreach($servicos as $servico){
			// instanciando e jogando dentro da colecao $objetos o Usuario //
			$objetos[] = new ServicosAcompanhante($servico['id'],					
					$servico['servico_id'],
                                        $servico['acompanhante_id'],	
                                        $servico['valor'],
					$servico['excluido']
                                );
                        //Chamada da função
		}
		// retornando a colecao $objetos //
		return $objetos;
	}
        
        
	public static function listarPorAcompanhanteWebService(Acompanhante $acompanhante){
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
                        
                        $da['id'] = $servico['id'];
                        $da['servicoId'] = $servico['servico_id'];
                        $da['valor'] = $servico['valor'];
                        $da['acompanhanteId'] = $servico['acompanhante_id'];
                        $da['excluido'] = $servico['ecluido'];
                        
                    
                        $objetos[] = $da;
                        

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
                         $ob = new ServicosAcompanhante($servico['id'],					
					$servico['servico_id'],
                                        $servico['acompanhante_id'],	
                                        $servico['valor'],
					$servico['excluido']
                                );
                    
                        $objetos[] = $ob;
                        

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
	
		$a = new ServicosAcompanhante($servico['id'],					
                                    $servico['servico_id'],
                                    $servico['acompanhante_id'],	
                                    $servico['valor'],
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