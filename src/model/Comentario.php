<?php
class  Comentario{
	private $id;
	private $comentario;
	private $comentario_id;
	private $cliente_id;
	private $acompanhante_id;
	
	public function __construct($id = 0, $comentario = '', $comentario_id = null, $cliente_id = null, $acompanhante_id = null) {
		$this->id = $id;
		$this->comentario = $comentario;
		$this->comentario_id = $comentario_id;
		$this->cliente_id = $cliente_id;
		$this->acompanhante_id = $acompanhante_id;
		
	}
	
	private function _validarCampos(){
		if(($this->getComentario() == '')
				//||($this->getId() == null));
				//||($this->getCliente_id() == null)
				//||($this->getAcompanhante_id() == null))
		);
			return false;
		return true;
	}
	
	public static function listar($campo) {
		$instancia = ComentarioDAO::getInstancia();
		$comentario = $instancia->listar($campo);
		if (!$comentario)
			throw new ListaVazia(ListaVazia::COMENTARIO);
		foreach ($comentario as $comentario) {
			$objetos[] = new Comentario($comentario['id'], $comentario['comentario'], $comentario['comentario_id'],
					 $comentario['cliente_id'], $comentario['acompanhante_id']);
		}
		return $objetos;
	}
	
	public static function listarPorIdAcompanhante($id){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = AcompanhanteDAO::getInstancia();
		// executando o metodo //
		$acompanhante = $instancia->buscarPorIdUsuario($id);
		// checando se o resultado foi falso //
		if(!$acompanhante)
			// levanto a excessao RegistroNaoEncontrado //
			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::ACOMPANHANTE);
		// instanciando e retornando o Usuario //
		return self::construirObjeto($acompanhante);
	}
	
	
 	public static function buscar($id) {
 		$instancia = ComentarioDAO::getInstancia();
 		$comentario = $instancia->buscar($id);
 		if (!$comentario)
 			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::COMENTARIO);
 		return new Comentario($comentario['id'], $comentario['comentario'], $comentario['comentario_id'],
					 $comentario['cliente_id'], $comentario['acompanhante_id']);
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
 		return  $comentario = $instancia->inserir($this);
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
	public function getComentario_id() {
		return $this->comentario;
	}
	
	public function setComentario_id($comentario_id) {
		$this->comentario_id = $comentario_id;
	}
	
	public function getCliente_id() {
		return $this->comentario;
	}
	
	public function setClienteo_id($cliente_id) {
		$this->cliente_id = $cliente_id;
	}
	
	public function getAcompanhante_id() {
		return $this->comentario;
	}
	
	public function setAcompanhante_id($acompanhante_id) {
		$this->acompanhante_id = $acompanhante_id;
	}
}

?>