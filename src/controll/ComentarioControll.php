<?php
 class ComentarioControll extends Controll{
 	const MODULO = 8;
 	/**
 	 * Acao index()
 	 */
 	public function index(){
 		//meuVarDump("euuuu");
 		// código da ação serve para o controle de acesso//
 		static $acao = 1;
 		// definindo a tela //
 		$this->setTela('listar',array('comentario'));
 		// guardando a url //
 		$this->getPage();
 }
 
 /**
  * Acao ver($id)
  * @param $id
  */
 public function ver($id){
 	// código da ação serve para o controle de acesso//
 	static $acao = 1;
 	// buscando o usuário //
 	$comentario = Comentario::buscar($id);
 	// jogando o usuário no atributo $dados do controlador //
 	$this->setDados($comentario,'comentario');
 	// definindo a tela //
 	$this->setTela('ver',array('comentario'));
 }
 
 /**
  * Acao add()
  */
 public function add() {
 	// código da ação serve para o controle de acesso//
 	static $acao = 2;
 	// checando se o formulário nao foi passado //
 	if(!$this->getDados('POST')) {
 		//  definindo a  tela //
 		$this->setTela('add',array('comentario'));
 	} else {
 		// caso passar o formulário //
 		// chamando o metodo privado _add() passando os dados do post por parametro //
 		$this->_add($this->getDados('POST'));
 	}
 }
 
 /**
  * Metodo _add($dados)
  * @param $dados
  * @return modulo
  */
 private function _add($dados){
 		
 	// persistindo em inserir o usuário //
 	try {
 		$comentario = new Comentario();
 		$comentario->setComentario($dados['comentario']);
 		//$comentario->setNome($dados['comentario_id']);
		//$comentario->getCliente_id($dados['cliente_id']);
		//$comentario->setAcompanhante_id($dados['acompanhante_id']);
 		$comentario->inserir();
 		// setando a mensagem de sucesso //
 		$this->setFlash('Comentario cadastrado com sucesso.');
 		// setando a url //
 		$this->setPage();
 	}
 
 
 	catch (Exception $e) {
 		//retorna os campos prar serem preenchidos novamente
 		if(isset($comentario))
 			$this->setDados($comentario,'comentario');
 
 		if(isset($usuario))
 			$this->setDados($comentario,'comentario');
 		// setando a mensagem de excessão //
 		$this->setFlash($e->getMessage());
 		// definindo a tela //
 		$this->setTela('add',array('comentario'));
 	}
 }
 
 /**
  * Acao editar($id)
  * @param $id
  */
 public function editar($id){
 	// código da ação //
 	static $acao = 3;
 	// Buscando o usuário //
 	$objeto = Comentario::buscar($id);
 	// checando se o formulário nao foi passado //
 	if(!$this->getDados('POST')){
 		// Jogando perfil no atributo $dados do controlador //
 		$this->setDados($objeto,'comentario');
 		// Definindo a tela //
 		$this->setTela('editar',array('comentario'));
 	}
 	// caso passar o formulario //
 	else
 		// chamando o metodo privado _editar() passando os dados do post por parametro //
 		$this->_editar($this->getDados('POST'));
 }
 
 /**
  * Acao excluir($id)
  * @param $id
  */
 public function excluir($id){
 	// código da ação //
 	static $acao = 4;
 	// buscando o usuário //
 	$objeto = comentario::buscar($id);
 	// checando se o usuário a ser excluído é diferente do logado //
 
 	//ATENÇÃO
 	//checar se o modulo esta sendo utilizada
 
 	// excluíndo ele //
 	$objeto->excluir();
 	// setando mensagem de sucesso //
 	$this->setFlash('Comentario excluido com sucesso.');
 
 	// setando a url //
 	$this->setPage();
 }
 }
?>