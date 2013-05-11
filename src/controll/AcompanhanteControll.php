<?php
/**
 * Classe UsuarioControll
 * Controlador do modulo de usuários
 * @package controll
 */
class AcompanhanteControll extends Controll {

    /**
     * Constante referente ao número do modulo serve para o controle de acesso
     */
    const MODULO = 4;

    /**
     * Acao index()
     */
    public function index(){
        // código da ação serve para o controle de acesso//
        static $acao = 1;
        // definindo a tela //
        $this->setTela('listar',array('acompanhante'));
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
        $objeto = Acompanhante::buscar($id);
        // jogando o usuário no atributo $dados do controlador //
        $this->setDados($objeto,'acompanhante');
        // definindo a tela //
        $this->setTela('ver',array('acompanhante'));
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
            $this->setTela('add',array('acompanhante'));
        } else {
            // caso passar o formulário //
            // chamando o metodo privado _add() passando os dados do post por parametro //
            $this->_add($this->getDados('POST'));
        }
    }

    /**
     * Metodo _add($dados)
     * @param $dados
     * @return Usuario
     */
    private function _add($dados){	
    	// persistindo em inserir o usuário //
    	try {
    		
	        // instanciando o novo Usuário //
	        $usuario = new Usuario(0,
        		/*3 por padrão é o perfil da garota*/
        		Perfil::buscar(3),
        		trim($dados['email']),
        		trim($dados['senha']),
        		trim($dados['email']));
        
	        
	        if(!isset($dados['pernoite']))
	        	$pernoite = null;
	        else 
	        	$pernoite = trim($dados['pernoite']);
	        
	        $acompanhante = new Acompanhante(0,
	        		trim($dados['nome']),
	        		trim($dados['idade']),
	        		trim($dados['altura']),
	        		trim($dados['peso']),
	        		trim($dados['busto']),
	        		trim($dados['cintura']),
	        		trim($dados['quadril']),
	        		trim($dados['olhos']),
	        		$pernoite,
	        		trim($dados['atendo']),
	        		trim($dados['especialidade']),
	        		trim($dados['horarioAtendimento']),
	        		null,
	        		null,
	        		null);	        
	        
	        
    		if($usuario->_validarCampos())
            	$insert = true;
			else
           	$insert = false;
                
			if($acompanhante->_validarCampos())
            	$insert = true;
			else
           $insert = false;
           	if($insert == true){
            	$usuario = $usuario->inserir();
	            $acompanhante->setUsuarioId($usuario->getId());
	            $acompanhante->setUsuarioIdPerfil($usuario->getPerfil()->getId());
	            $acompanhante->inserir();
			}
			
            // setando a mensagem de sucesso //
            $this->setFlash('Acompanhante cadastrada com sucesso.');
            // setando a url //
            $this->setPage();
        }        
        catch (Exception $e) {
            //retorna os campos prar serem preenchidos novamente
            if(isset($acompanhante))
            	$this->setDados($acompanhante,'acompanhante');
            
            if(isset($usuario))
            	$this->setDados($usuario,'usuario');
            // setando a mensagem de excessão //
            $this->setFlash($e->getMessage());
            // definindo a tela //
            $this->setTela('add',array('acompanhante'));
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
        $objeto = Acompanhante::buscar($id);
        // checando se o formulário nao foi passado //
        if(!$this->getDados('POST')){
            // Jogando perfil no atributo $dados do controlador //
            $this->setDados($objeto,'acompanhante');
            // Definindo a tela //
            $this->setTela('editar',array('acompanhante'));
        }
        // caso passar o formulario //
        else
            // chamando o metodo privado _editar() passando os dados do post por parametro //
            $this->_editar($this->getDados('POST'));
    }

    /**
     * Metodo _editar($dados)
     * @param $dados
     * @return Usuario
     */
    private function _editar($dados){
    	// persistindo em inserir o usuário //
    	try {
	        // instanciando o novo Usuário //
	        
    		$usuario = Usuario::buscar($dados['idUsuario']);    		
    		$usuario->setLogin(trim($dados['email']));
    		$usuario->setSenha(trim($dados['senha']));
    		$usuario->setEmail(trim($dados['email']));
    		
	        
    		$acompanhante = Acompanhante::buscar($dados['idAcompanhante']);
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
    		$acompanhante->setHorarioAtendimento(trim($dados['horarioAtendimento']));
            
    		if($usuario->_validarCampos())
    			$insert = true;
    		else
    			$insert = false;
    		
    		if($acompanhante->_validarCampos())
    			$insert = true;
    		else
    			$insert = false;
    		
    		if($insert == true){
    			$usuario = $usuario->editar();
    			$acompanhante = $acompanhante->editar();
    		}
            
            // setando a mensagem de sucesso //
            $this->setFlash('Acompanhante editada com sucesso.');
            // setando a url //
            $this->setPage();
        }        
        catch (Exception $e) {
            //retorna os campos prar serem preenchidos novamente
            if(isset($acompanhante))
            	$this->setDados($acompanhante,'acompanhante');
            
            if(isset($usuario))
            	$this->setDados($usuario,'usuario');
            // setando a mensagem de excessão //
            $this->setFlash($e->getMessage());
            // definindo a tela //
            $this->setTela('editar',array('acompanhante'));
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
        $objeto = Acompanhante::buscar($id);
        
        // excluíndo ele //
        $objeto->excluir();
        // setando mensagem de sucesso //
		$this->setFlash('Acompanhante excluída com sucesso.');
        
        
        $this->setPage();
    }
    
    public function visualizarServicos($id){
    	// código da ação serve para o controle de acesso//
    	static $acao = 5;
    	// buscando o usuário //
    	$objeto = Acompanhante::buscar($id);
    	// jogando o usuário no atributo $dados do controlador //
    	$this->setDados($objeto,'acompanhante');
    	// definindo a tela //
    	$this->setTela('listar',array('acompanhante/servicos'));
    }
    
    public function verServico($id){
    	// código da ação serve para o controle de acesso//
    	static $acao = 5;
    	// buscando o usuário //
    	$ServicosAcompanhanteRetorno = ServicosAcompanhante::buscar($id); // Acompanhante::buscar($id);        
        $acompanhante = Acompanhante::buscar($ServicosAcompanhanteRetorno->getAcompanhanteId());
        $listaLocalizacao = Localizacao::listarPorServicoAcompanhanteId($ServicosAcompanhanteRetorno->getId());
        
    	// jogando o usuário no atributo $dados do controlador //
    	$this->setDados($ServicosAcompanhanteRetorno,'servicosAcompanhante');
    	$this->setDados($acompanhante,'acompanhante');
    	$this->setDados($listaLocalizacao,'listaLocalizacao');
    	// definindo a tela //
    	$this->setTela('ver',array('acompanhante/servicos'));
    }
    
    /**
     * Acao foto($id)
     * @param $id
     */
    public function adicionarServico($id){
    	
        static $acao = 6;
        
        // checando se o formulário nao foi passado //
        if(!$this->getDados('POST')){
            // Buscando o usuário //
            $objeto = Acompanhante::buscar($id);            
            // Jogando perfil no atributo $dados do controlador //
            $this->setDados($objeto,'acompanhante');
            // Definindo a tela //
            $this->setTela('add',array('acompanhante/servicos'));
        }
        // caso passar o formulario //
        else
            // chamando o metodo privado _editar() passando os dados do post por parametro //
            $this->_adicionarServico($this->getDados('POST'), $id);
    }
    
    private function _adicionarServico($dados, $id){
        try {                      
            $servicoAcompanhnate = new ServicosAcompanhante();            
            $servicoAcompanhnate->setValor($dados["preco"]);
            $servicoAcompanhnate->setServicoId($dados["servicoAcompanhanteId"]);
            $servicoAcompanhnate->setAcompanhanteId($id);            
            $servicoAcompanhnate = $servicoAcompanhnate->inserir();
            $servicoAcompanhanteId = $servicoAcompanhnate->getId();
            
            
            
            for ($index = 0; $index < count($dados["latitude"]); $index++) {
                
                $localizacao = new Localizacao(0, 
                        $dados["latitude"][$index], 
                        $dados["longitude"][$index], 
                        $dados["endereco"][$index], 
                        $servicoAcompanhanteId);
                
                $localizacao->inserir();
            }
            
            return $servicoAcompanhnate->getId();
            
        }
        catch (Exception $e){
            return "erro"; //$e->getMessage();
        }
    }
    
    public function editarServico($id){
        static $acao = 7;
        // checando se o formulário nao foi passado //
        if(!$this->getDados('POST')){
            
            $ServicosAcompanhanteRetorno = ServicosAcompanhante::buscar($id); // Acompanhante::buscar($id);        
            $acompanhante = Acompanhante::buscar($ServicosAcompanhanteRetorno->getAcompanhanteId());
            $listaLocalizacao = Localizacao::listarPorServicoAcompanhanteId($ServicosAcompanhanteRetorno->getId());

            // jogando o usuário no atributo $dados do controlador //
            $this->setDados($ServicosAcompanhanteRetorno,'servicosAcompanhante');
            $this->setDados($acompanhante,'acompanhante');
            $this->setDados($listaLocalizacao,'listaLocalizacao');
            
            
            // Definindo a tela //
            $this->setTela('editar',array('acompanhante/servicos'));
        }
        // caso passar o formulario //
        else{
            $ServicosAcompanhanteRetorno = ServicosAcompanhante::buscar($id); // Acompanhante::buscar($id);        
            $this->_editarServico($this->getDados('POST'), $ServicosAcompanhanteRetorno->getAcompanhanteId());
        }
            
    }
    
    private function _editarServico($dados, $idAcompanhnante){
        echo '<pre>';
        var_dump($idAcompanhnante);
        echo '<br />';
        meuVarDump($dados);
        
        try {                      
            $servicoAcompanhnate = new ServicosAcompanhante();            
            $servicoAcompanhnate->setValor($dados["preco"]);
            $servicoAcompanhnate->setServicoId($dados["servicoAcompanhanteId"]);
            $servicoAcompanhnate->setAcompanhanteId($idAcompanhnante);            
            $servicoAcompanhnate = $servicoAcompanhnate->inserir();
            $servicoAcompanhanteId = $servicoAcompanhnate->getId();
            
            for ($index = 0; $index < count($dados["latitude"]); $index++) {
                
                $localizacao = new Localizacao(0, 
                        $dados["latitude"][$index], 
                        $dados["longitude"][$index], 
                        $dados["endereco"][$index], 
                        $servicoAcompanhanteId);
                
                $localizacao->inserir();
            }
            
            return $servicoAcompanhnate->getId();
            
        }
        catch (Exception $e){
            return "erro"; //$e->getMessage();
        }
    }
    
    
    
    /**
     * Acao foto($id)
     * @param $id
     */
    public function visualizarFotos($id){
    	// código da ação serve para o controle de acesso//
    	static $acao = 9;
    	// buscando o usuário //
    	$objeto = Acompanhante::buscar($id);
    	// jogando o usuário no atributo $dados do controlador //
    	$this->setDados($objeto,'acompanhante');
    	// definindo a tela //
    	$this->setTela('listar',array('acompanhante/foto'));
    }
    
    public function visualizarComentario($idAcompanhnate){
    	// código da ação serve para o controle de acesso//
    	static $acao = 1;
    	// buscando o usuário //
    	$objeto = Acompanhante::buscar($idAcompanhnate);
    	// jogando o usuário no atributo $dados do controlador //
    	$this->setDados($objeto,'acompanhante');
    	// definindo a tela //
    	$this->setTela('listar',array('acompanhante/comentario'));
    }
    /**
     * Acao fotoAdd($id)
     * @param $id
     */
    public function adicionarFoto($idAcompanahante){
        // código da ação //
        static $acao = 10;    	
        
        try {
            
            $acompanhante = Acompanhante::buscar($idAcompanahante);
            
            $objFoto = new Fotos();

            //verifica se veio algum arquivo novo pra subir
            $arquivos[] = (array) $_FILES;
            if($arquivos[0]['foto']['name'] != ""){
                $fotos = count($arquivos[0]['foto']['name']);
                    if ($fotos != "") {
                        $objFoto->sobeFotosCampo($acompanhante, $arquivos);
                    }
            }


            $dados = $_POST;

            if(count($dados) > 0){
                $objFoto->excluirFotos($dados);
            }

            $this->setFlash('Galeria de fotos alterada com sucesso.');
            $this->setDados($acompanhante,'acompanhante');
            // definindo a tela //
            $this->setTela('listar',array('acompanhante/foto'));
            
        }
        catch (Exception $e) {
            $this->setFlash($e->getMessage());
            
            $this->setDados($acompanhante,'acompanhante');
            // definindo a tela //
            $this->setTela('listar',array('acompanhante/foto'));
        }
        
        
        
        
        
    }
    
    
    
}
?>