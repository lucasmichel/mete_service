<?php
class ServicosDoEncontro {
	/**
	 * @Lucas Michel
	 */
	private $id;
	private $encontroId;
	private $clienteId;
	private $servicosAcompanhanteId;
	private $servicoId;
	private $acompanhanteId;
	private $aprovado;	
	private $excluido;

	function __construct($id = 0,
                $encontroId = 0, 
                $clienteId = 0, 
                $servicosAcompanhanteId = 0,                 
                $servicoId = 0,                 
                $acompanhanteId = 0, 
                $aprovado = 0, 
                $excluido = 0) {
		$this->id = $id;
		$this->encontroId = $encontroId;
		$this->clienteId = $clienteId;
		$this->servicosAcompanhanteId = $servicosAcompanhanteId;
		$this->servicoId = $servicoId;
		$this->acompanhanteId = $acompanhanteId;
		$this->aprovado = $aprovado;
		$this->excluido = $excluido;
		
	}
        
        
        public static function objetoParaArray(ServicosDoEncontro $obj){
             
            $da['id'] = $obj->getId();
            $da['aprovado'] = $obj->getAprovado();            
            $da['clienteId'] = $obj->getClienteId();
            $da['excluido'] = $obj->getExcluido();
            $da['encontroId'] = $obj->getEncontroId();
            $da['servicoId'] = $obj->getServicoId();
            $da['servicoAcompanhanteId'] = $obj->getServicosAcompanhanteId();
                    
            return $da;
        }
        
	public function getId() {
		return $this->id;
	}        
        public function setId($id) {
		$this->id = $id;
	}
        
	public function getEncontroId() {
		return $this->encontroId;
	}        
        public function setEncontroId($encontroId) {
		$this->encontroId = $encontroId;
	}
                
	public function getClienteId() {
		return $this->clienteId;
	}        
        public function setClienteId($clienteId) {
		$this->clienteId = $clienteId;
	}
        
	public function getServicosAcompanhanteId() {
		return $this->servicosAcompanhanteId;
	}        
        public function setServicosAcompanhanteId($servicosAcompanhanteId) {
		$this->servicosAcompanhanteId = $servicosAcompanhanteId;
	}
        
	public function getServicoId() {
		return $this->servicoId;
	}
	public function setServicoId($servicoId) {
		$this->servicoId = $servicoId;
	}
        
	public function getAcompanhanteId() {
		return $this->acompanhanteId;
	}
        public function setAcompanhanteId($acompanhanteId) {
		$this->acompanhanteId = $acompanhanteId;
	}
        
        public function getAprovado() {
		return $this->aprovado;
	}
        public function setAprovado($aprovado) {
		$this->aprovado = $aprovado;
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
            if($this->getEncontroId() == 0){
                throw new CamposObrigatorios("Servicos do encontro falta: encontroId");
                $retorno = false;
            }            
            if($this->getClienteId() == 0){
                throw new CamposObrigatorios("Servicos do encontro falta: clienteId");
                $retorno = false;
            }            
            if($this->getServicosAcompanhanteId() == 0){
                throw new CamposObrigatorios("Servicos do encontro falta: servicosAcompanhanteI");
                $retorno = false;
            }            
            if($this->getServicoId() == 0){
                throw new CamposObrigatorios("Servicos do encontro falta: servicoId");
                $retorno = false;
            }            
            if($this->getAcompanhanteId() == 0){
                throw new CamposObrigatorios("Servicos do encontro falta: acompanhante id");
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
                $instancia = ServicosDoEncontroDAO::getInstancia();
                // retornando o Usuario //
                return  $instancia->inserir($this);
            }
			
	}
	
	public function editar(){
            // validando os campos //
            if($this->_validarCampos()){
                // recuperando a instancia da classe de acesso a dados //
                $instancia = ServicosDoEncontroDAO::getInstancia();
                // retornando o Usuario //
                return  $instancia->editar($this);    
            }
	}
	
	public function excluir(){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = ServicosDoEncontroDAO::getInstancia();

            //executando o metodo e retornando o resultado //
            return $instancia->excluir($this->getId());
	}
        
        private function fabricaObjeto (Array $obj){
            $obj = new ServicosDoEncontro(
                                    $obj['id'],
                                    $obj['encontro_id'],
                                    $obj['cliente_id'],	
                                    $obj['servicos_acompanhante_id'],
                                    $obj['servico_id'],
                                    $obj['acompanhante_id'],
                                    $obj['aprovado'],
                                    $obj['excluido']
                                    );
            return $obj;
        }
	
	public static function listar($ordenarPor){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosDoEncontroDAO::getInstancia();
		// executando o metodo //
		$lista = $instancia->listar($ordenarPor);
		// checando se o retorno foi falso //
		if(!$lista)
			// levantando a excessao ListaVazia //
			throw new ListaVazia(ListaVazia::SERVICOS_DO_ENCONTRO);
		// percorrendo os usuarios //
		foreach($lista as $obj){
                    
                    $objetos[] =  self::fabricaObjeto($obj);                    
		}
		// retornando a colecao $objetos //
		return $objetos;
	}
        
        public static function buscar($id){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = ServicosDoEncontroDAO::getInstancia();
		// executando o metodo //
		$obj = $instancia->buscarPorId($id);
		// checando se o resultado foi falso //
		if(!$obj)
		// levanto a excessao RegistroNaoEncontrado //
                    throw new RegistroNaoEncontrado(RegistroNaoEncontrado::SERVICOS_DO_ECONTRO);
		else
		return $this->fabricaObjeto($obj);
	}
	
        
        public static function listarPorAcompanhante(Acompanhante $acompanhante){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = ServicosDoEncontroDAO::getInstancia();
            // executando o metodo //
            $lista = $instancia->listarPorIdAcompanhante($acompanhante->getId());
            // checando se o retorno foi falso //
            if(!$lista)
                // levantando a excessao ListaVazia //
                throw new ListaVazia(ListaVazia::SERVICOS_DO_ENCONTRO);
            // percorrendo os usuarios //
            foreach($lista as $obj){			

                $objetos[] = $this->fabricaObjeto($obj);

            }
            // retornando a colecao $objetos //
            return $objetos;
	}
        
        
	public static function listarPorAcompanhanteWebService(Acompanhante $acompanhante){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = ServicosDoEncontroDAO::getInstancia();
            // executando o metodo //
            $lista = $instancia->listarPorIdAcompanhante($acompanhante->getId());
            // checando se o retorno foi falso //
            if(!$lista)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::SERVICOS_DO_ENCONTRO);
            // percorrendo os usuarios //
            foreach($lista as $obj){
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                     $ob = $this->fabricaObjeto($obj);                         
                     $objetos[] = (array) $this->fabricaObjeto($obj);

            }
            // retornando a colecao $objetos //
            return $objetos;
	}
        
        public static function listarPorCliente(Cliente $cliente){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = ServicosDoEncontroDAO::getInstancia();
            // executando o metodo //
            $lista = $instancia->listarPorIdCliente($cliente->getId());
            // checando se o retorno foi falso //
            if(!$lista)
                // levantando a excessao ListaVazia //
                throw new ListaVazia(ListaVazia::SERVICOS_DO_ENCONTRO);
            // percorrendo os usuarios //
            foreach($lista as $obj){			

                $objetos[] = $this->fabricaObjeto($obj);

            }
            // retornando a colecao $objetos //
            return $objetos;
	}
        
        
	public static function listarPorClienteWebService(Cliente $cliente){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = ServicosDoEncontroDAO::getInstancia();
            // executando o metodo //
            $lista = $instancia->listarPorIdCliente($cliente->getId());
            // checando se o retorno foi falso //
            if(!$lista)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::SERVICOS_DO_ENCONTRO);
            // percorrendo os usuarios //
            foreach($lista as $obj){
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                     $ob = $this->fabricaObjeto($obj);                         
                     $objetos[] = (array) $this->fabricaObjeto($obj);

            }
            // retornando a colecao $objetos //
            return $objetos;
	}
        
        public static function listarPorEcontro(Encontro $encontro){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = ServicosDoEncontroDAO::getInstancia();
            // executando o metodo //
            $lista = $instancia->listarPorIdEcontro($encontro->getId());
            // checando se o retorno foi falso //
            if(!$lista)
                // levantando a excessao ListaVazia //
                throw new ListaVazia(ListaVazia::SERVICOS_DO_ENCONTRO);
            // percorrendo os usuarios //
            foreach($lista as $obj){			

                $objetos[] = self::fabricaObjeto($obj);

            }
            // retornando a colecao $objetos //
            return $objetos;
	}
        
        
	public static function listarPorEcontroWebService(Encontro $econtro){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = ServicosDoEncontroDAO::getInstancia();
            // executando o metodo //
            $lista = $instancia->listarPorIdEcontro($econtro->getId());
            // checando se o retorno foi falso //
            if(!$lista)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::SERVICOS_DO_ENCONTRO);
            // percorrendo os usuarios //
            foreach($lista as $obj){
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                     $ob = $this->fabricaObjeto($obj);                         
                     $objetos[] = (array) $this->fabricaObjeto($obj);

            }
            // retornando a colecao $objetos //
            return $objetos;
	}
        
        
	
	
	
}

?>