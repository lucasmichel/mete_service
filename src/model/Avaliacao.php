<?php
 class Avaliacao{
 	private $id;
 	private $nota;
 	private $clienteId;
 	private $acompanhanteId;
 	private $dataCadastro;
 	private $excluido;
 	
 	public function __construct($id = 0, $nota = null, $clienteId = 0, $acompanhanteId = 0, $dataCadastro = null,
                $excluido = 0) {
 		$this->id = $id;
 		$this->nota = $nota;
 		$this->clienteId = $clienteId;
 		$this->acompanhanteId = $acompanhanteId;
 		$this->dataCadastro = $dataCadastro;
 		$this->excluido = $excluido;
 		
 	}
 	
 	private function _validarCampos(){
 		$retorno = true;
 		
 		if($this->getNota() == null){
 			throw new CamposObrigatorios("Avaliacao: falta o Nota da acompanhante");
 			$retorno = false;
 		}
 		if($this->getClienteId() == 0){
 			throw new CamposObrigatorios("Avaliacao: falta o id cliente");
 			$retorno = false;
 		}
 		if($this->getAcompanhanteId() == 0){
 			throw new CamposObrigatorios("Avaliacao: falta o id acompanhante");
 			$retorno = false;
 		}
 		else{
 			$retorno = true;
 		}
 		return $retorno;
 	}
 	
 public static function listar($campo) {
            $instancia = AvaliacaoDAO::getInstancia();
            $avaliacao = $instancia->listar($campo);
            if (!$avaliacao)
                    throw new ListaVazia(ListaVazia::AVALIACAO);
            foreach ($avaliacao as $avaliacao) {
                
                $objetos[] = self::factoryObj($avaliacao);
            }
            return $objetos;
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
                    $ob = self::factoryObj($avaliacao);
                    
                    //$objetos[] = (array) $ob;
                    $objetos[] = $ob;
            }
            // retornando a colecao $objetos //
            return $objetos;
	}
	
    public static function listarPorIdAcompanhante($id){
            // recuperando a instancia da classe de acesso a dados //
           $instancia = AvaliacaoDAO::getInstancia();
            // executando o metodo //
            $avaliacao = $instancia->listarPorIdAcompanhante($id);
            // checando se o retorno foi falso //
            if(!$avaliacao)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::AVALIACAO);
            // percorrendo os usuarios //
            foreach($avaliacao as $avaliacao){
                
                // instanciando e jogando dentro da colecao $objetos o Usuario //
                $objetos[] = self::factoryObj($avaliacao);
            }
            // retornando a colecao $objetos //
            return $objetos;
    }
		
 	public static function buscar($id) {
 		
 		$instancia = AvaliacaoDAO::getInstancia();
 		$avaliacao = $instancia->buscarPorId($id);
 		//meuVarDump("teste");
 		if (!$avaliacao)
 			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::AVALIACAO);
 		return self::factoryObj($avaliacao);
 	}
	
 	public function inserir(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		
 		$instancia = AvaliacaoDAO::getInstancia();
 		//meuVarDump($this);
 		// executando o metodo //
 		// retornando o Usuario //
 		return  $instancia->inserir($this);
 	}
 	
 	public function editar(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = AvaliacaoDAO::getInstancia();
 		// executando o metodo // 		
 		
 		return  $instancia->editar($this);
 	}
 	
 	public function excluir(){
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = AvaliacaoDAO::getInstancia();
 		// executando o metodo //
 		$avaliacao = $instancia->excluir($this->getId());
 		// retornando o resultado //
 		return $avaliacao;
 	}
 	
 	private static function factoryObj(array $dados){
 		 
 		return new Avaliacao($dados['id'],
 				$dados['nota'],
 				$dados['cliente_id'],
 				$dados['acompanhante_id'],
 				$dados['data_cadastro'],
 				$dados['excluido']
 		);
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

 	public function getDataCadastro() {
 		return $this->dataCadastro;
 	}
 	
 	public function setdataCadastro($dataCadastro) {
 		$this->dataCadastro = $dataCadastro;
 	}
 }

?>