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
    
    
    /**
     * Acao foto($id)
     * @param $id
     */
    public function servico($id){
    	// código da ação serve para o controle de acesso//
    	static $acao = 5;
    	// buscando o usuário //
    	$objeto = Acompanhante::buscar($id);
    	// jogando o usuário no atributo $dados do controlador //
    	$this->setDados($objeto,'acompanhante');
    	// definindo a tela //
    	$this->setTela('listar',array('acompanhante/servicos'));
    }
    
    
    /**
     * Acao foto($id)
     * @param $id
     */
    public function foto($id){
    	// código da ação serve para o controle de acesso//
    	static $acao = 9;
    	// buscando o usuário //
    	$objeto = Acompanhante::buscar($id);
    	// jogando o usuário no atributo $dados do controlador //
    	$this->setDados($objeto,'acompanhante');
    	// definindo a tela //
    	$this->setTela('listar',array('acompanhante/foto'));
    }
    
    /**
     * Acao fotoAdd($id)
     * @param $id
     */
    public function adicionarFoto($idAcompanahante){
        // código da ação //
        static $acao = 10;
    	
        $acompanhante = Acompanhante::buscar($idAcompanahante);
        
        //verifica se veio algum arquivo pra subir
        $arquivos[] = (array) $_FILES;
        
        if($arquivos[0]['foto']['name'] != ""){
        
            $fotos = count($arquivos[0]['foto']['name']);
            
                if ($fotos != "") {
                    $this->sobeFotosCampo($acompanhante, $arquivos);
                }
        
        }
    }
    
    private function sobeFotosCampo(Acompanhante $acompanhante, Array $arquivos){
        $contFoto = 1;
        $fotos = count($arquivos[0]['foto']['name']);
            for($i = 0; $i < $fotos ; $i++){			

                $foto_temp = $arquivos[0]['foto']['tmp_name'][$i]; 
                $foto_name = $arquivos[0]['foto']['name'][$i];			
                $foto_size = $arquivos[0]['foto']['size'][$i];
                $foto_type = $arquivos[0]['foto']['type'][$i];

                if($foto_size > 0){

                    if (substr($foto_name,-4,1) == ".")
                        $extensao = substr($foto_name, -4);
                    else
                        $extensao = substr($foto_name, -5);

                    $dataHora = date("YmdHi");

                    $nome_foto = $acompanhante->getId() . "_" . $dataHora ."_". $contFoto .$extensao;
                    $contFoto++;


                    $caminhoFoto = $_SERVER["DOCUMENT_ROOT"] . BASE . DS . "img/foto/".$nome_foto;

                    /*SALVA FOTO*/
                    $fotoAcao = new Fotos();
                    $fotoCadastro = new Fotos();
                    
                    $fotoCadastro->setAcompanhanteId($acompanhante->getId());
                    $fotoCadastro->setNome($caminhoFoto);
                    
                    
                    /*SALVA FOTO*/
                    
                    if (move_uploaded_file($foto_temp, $caminhoFoto)){
                        chmod ($caminhoFoto, 0777);
                        $fotoAcao = $fotoCadastro->inserir();
                        //$acaoFoto->cadastrarFoto($idGeradoGaleria, $nome_foto, " ");
                    }
                    else{
                        meuVarDump("ERRO");
                        exit();
                    }
                }
            }
    }
    
}
?>