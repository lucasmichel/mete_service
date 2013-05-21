<?php
class  Comentario{
	private $id;
	private $comentario;
	//private $comentarioId;
	private $clienteId;
	private $acompanhanteId;
	
	public function __construct($id = 0, $comentario = '', $clienteId = null, $acompanhanteId = null) {
		$this->id = $id;
		$this->comentario = $comentario;
		//$this->comentario_id = $comentario_id;
		$this->clienteId = $clienteId;
		$this->acompanhanteId = $acompanhanteId;
		
	}
	

	
	public function _validarCampos(){
		$retorno = true;
		if($this->getComentario() == null){
			throw new CamposObrigatorios("Comentario");
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
			$objetos[] = new Comentario($comentario['id'], $comentario['comentario'],
					 $comentario['clienteId'], $comentario['acompanhanteId']);
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
			$ob = new Comentario($comentario['id'], $comentario['comentario'],
					 $comentario['clienteId'], $comentario['acompanhanteId']);           
			$objetos[] = (array) $ob;
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
                    $objetos[] = new Comentario($comentario['id'], $comentario['comentario'],
					 $comentario['clienteId'], $comentario['acompanhanteId']
                           );
                    
                           
            }
            // retornando a colecao $objetos //
            return $objetos;
    }
		
 	public static function buscar($id) {
 		$instancia = ComentarioDAO::getInstancia();
 		$comentario = $instancia->buscar($id);
 		if (!$comentario)
 			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::COMENTARIO);
 		return new Comentario($comentario['id'], $comentario['comentario'],
					 $comentario['clienteId'], $comentario['acompanhanteId']);
 	}
	
 	public function inserir(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = ComentarioDAO::getInstancia();
 		// executando o metodo //
 		$comentario = $instancia->inserir($this);
 		// retornando o Usuario //
 		//return  $comentario = $instancia->inserir($this);
 	}
 	
 	public function editar(){
 		// validando os campos //
 		if(!$this->_validarCampos())
 			// levantando a excessao CamposObrigatorios //
 			throw new CamposObrigatorios();
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = ComentarioDAO::getInstancia();
 		// executando o metodo //
 		$comentario = $instancia->editar($this);
 		// retornando o Usuario //
 		return  $comentario = $instancia->editar($this);
 	}
 	
 	public function excluir(){
 		// recuperando a instancia da classe de acesso a dados //
 		$instancia = ComentarioDAO::getInstancia();
 		// executando o metodo //
 		$comentario = $instancia->excluir($this->getId());
 		// retornando o resultado //
 		return $comentario;
 	}
 	
 	private static function construirObjeto($dados){
 		//varDump($dados);
 			
 		$acompanhante =	new Acompanhante();
		$acompanhante->setId(trim($dados['id']));
    	$acompanhante->setNome(trim($dados['nome']));
    	$acompanhante->setIdade(trim($dados['idade']));
    	$acompanhante->setAltura(trim($dados['altura']));
    	$acompanhante->setPeso(trim($dados['peso']));
    	$acompanhante->setBusto(trim($dados['busto']));
    	$acompanhante->setCintura(trim($dados['cintura']));
    	$acompanhante->setQuadril(trim($dados['quadril']));
    	$acompanhante->setOlhos(trim($dados['olhos']));
    	$acompanhante->setPernoite(trim($dados['pernoite']));
    	$acompanhante->setAtendo(trim($dados['atendo']));
    	$acompanhante->setEspecialidade(trim($dados['especialidade']));
    	$acompanhante->setHorarioAtendimento(trim($dados['horario_atendimento']));
    	$acompanhante->setExcluido(trim($dados['excluido']));
    	$acompanhante->setUsuarioId(trim($dados['usuarios_id']));
    	$acompanhante->setUsuarioIdPerfil(trim($dados['usuarios_id_perfil']));  	
    		
		return $acompanhante; 
 			
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
	
	public function setClienteoId($clienteId) {
		$this->clienteId = $clienteId;
	}
	
	public function getAcompanhanteId() {
		return $this->acompanhanteId;
	}
	
	public function setAcompanhanteId($acompanhanteId) {
		$this->acompanhanteId = $acompanhanteId;
	}
}

?>