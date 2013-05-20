<?php
class EncontroControll extends Controll{
	const MODULO = 9;
	/**
	 * Acao index()
	 */
	public function index(){
            // código da ação serve para o controle de acesso//
            static $acao = 1;
            // definindo a tela //
            $this->setTela('listar',array('encontro'));
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
            $encontro = Encontro::buscar($id);
            // jogando o usuário no atributo $dados do controlador //
            $this->setDados($encontro,'encontro');
            // definindo a tela //
            $this->setTela('ver',array('encontro'));
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
                $this->setTela('add',array('encontro'));
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
                $encontro = new Servico();
                $encontro->setClienteId($dados['cliente_id']);
                $encontro->setDataHorario($dados['data_horario']);
                $encontro->getAprovado($dados['aprovado']);
                $encontro->inserir();
                // setando a mensagem de sucesso //
                $this->setFlash('Encontro cadastrado com sucesso.');
                // setando a url //
                $this->setPage();
            }


            catch (Exception $e) {
                //retorna os campos prar serem preenchidos novamente
                if(isset($encontro))
                    $this->setDados($encontro,'encontro');
                // setando a mensagem de excessão //
                $this->setFlash($e->getMessage());
                // definindo a tela //
                $this->setTela('add',array('encontro'));
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
            $objeto = Encontro::buscar($id);
            // checando se o formulário nao foi passado //
            if(!$this->getDados('POST')){
                // Jogando perfil no atributo $dados do controlador //
                $this->setDados($objeto,'encontro');
                // Definindo a tela //
                $this->setTela('editar',array('encontro'));
            }
            // caso passar o formulario //
            else
                // chamando o metodo privado _editar() passando os dados do post por parametro //
                $this->_editar($this->getDados('POST'));
	}
        
        private function _editar($dados){	
            // persistindo em inserir o usuário //
            try {
                $encontro = new Servico();
                $encontro->setClienteId($dados['cliente_id']);
                $encontro->setDataHorario($dados['data_horario']);
                $encontro->getAprovado($dados['aprovado']);
                $encontro->inserir();
                // setando a mensagem de sucesso //
                $this->setFlash('Encontro cadastrado com sucesso.');
                // setando a url //
                $this->setPage();
            }


            catch (Exception $e) {
                //retorna os campos prar serem preenchidos novamente
                if(isset($encontro))
                    $this->setDados($encontro,'encontro');
                // setando a mensagem de excessão //
                $this->setFlash($e->getMessage());
                // definindo a tela //
                $this->setTela('add',array('encontro'));
            }
	}
	
	/**
	 * Acao excluir($id)
	 * @param $id
	 */
	public function excluir($id){
            // código da ação //
            static $acao = 4;
            // buscando o usuário //
            $objeto = encontro::buscar($id);
            // excluíndo ele //
            $objeto->excluir();
            // setando mensagem de sucesso //
            $this->setFlash('Encontro excluido com sucesso.');

            // setando a url //
            $this->setPage();
	}
}

?>