<?php
class  Comentario{
	private $id;
	private $comentario;
	private $clienteId;
	private $acompanhanteId;
	private $dataCadastro;
	private $excluido;
	
	public function __construct($id = 0, 
                $comentario = null, 
                $clienteId = 0, 
                $acompanhanteId = 0,
                $dataCadastro = null,
                $excluido = 0
                ) {
            
		$this->id = $id;
		$this->comentario = $comentario;		
		$this->clienteId = $clienteId;
		$this->acompanhanteId = $acompanhanteId;	
		$this->dataCadastro = $dataCadastro;	
		$this->excluido = $excluido;
	}
	

	
	public function _validarCampos(){
		$retorno = true;
                
		if($this->getComentario() == null){
                    throw new CamposObrigatorios("Comentario: falta o texto do comentario");
                    $retorno = false;
		}                
		if($this->getClienteId() == 0){
                    throw new CamposObrigatorios("Comentario: falta o id cliente");
                    $retorno = false;
		}
		if($this->getAcompanhanteId() == 0){
                    throw new CamposObrigatorios("Comentario: falta o id acompanhante");
                    $retorno = false;
		}
		else{
                    $retorno = true;
		}
		return $retorno;
	}
	
	
	public static function listar($campo) {
            $instancia = ComentarioDAO::getInstancia();
            $comentario = $instancia->listar($campo);
            if (!$comentario)
                    throw new ListaVazia(ListaVazia::COMENTARIO);
            foreach ($comentario as $comentario) {
                
                $objetos[] = self::factoryObj($comentario);
            }
            return $objetos;
	}
	
        public static function listarPorAcompanhante(Acompanhante $acompanhante){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = ComentarioDAO::getInstancia();
            // executando o metodo //
            $comentario = $instancia->listarPorIdAcompanhante($acompanhante->getId());
            // checando se o retorno foi falso //
            if(!$comentario)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::COMENTARIO);
            // percorrendo os usuarios //
            foreach($comentario as $comentario){
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                    $ob = self::factoryObj($comentario);
                    
                    //$objetos[] = (array) $ob;
                    $objetos[] = $ob;
            }
            // retornando a colecao $objetos //
            return $objetos;
	}
	
    public static function listarPorIdAcompanhante($id){
            // recuperando a instancia da classe de acesso a dados //
           $instancia = ComentarioDAO::getInstancia();
            // executando o metodo //
            $comentario = $instancia->listarPorIdAcompanhante($id);
            // checando se o retorno foi falso //
            if(!$comentario)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::COMENTARIO);
            // percorrendo os usuarios //
            foreach($comentario as $comentario){
                
                // instanciando e jogando dentro da colecao $objetos o Usuario //
                $objetos[] = self::factoryObj($comentario);
            }
            // retornando a colecao $objetos //
            return $objetos;
    }
		
 	public static function buscar($id) {
 		$instancia = ComentarioDAO::getInstancia();
 		$comentario = $instancia->buscarPorId($id);
 		if (!$comentario)
 			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::COMENTARIO);
 		return self::factoryObj($comentario);
 	}
	
 	public function inserir(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = ComentarioDAO::getInstancia();
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
 		$instancia = ComentarioDAO::getInstancia();
 		// executando o metodo // 		
 		return  $instancia->editar($this);
 	}
 	
 	public function excluir(){
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = ComentarioDAO::getInstancia();
 		// executando o metodo //
 		$comentario = $instancia->excluir($this->getId());
 		// retornando o resultado //
 		return $comentario;
 	}
        
         private static function factoryObj(array $dados){
             
             return new Comentario($dados['id'], 
                        $dados['comentario'],
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
	
	public function getComentario() {
		return $this->comentario;
	}
	
	public function setComentario($comentario) {
		$this->comentario = $comentario;
	}
	
	
	public function getClienteId() {
		return $this->clienteId;
	}
	
	public function setClienteId($clienteId) {
		$this->clienteId = $clienteId;
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