<?php

/**
 * Classe DefaultControll
 * Controlador default da aplicação
 * @package controll
 */
class DefaultControll extends Controll {

    /**
     * Acao index()
     */
    public function index() {
        $this->setTela(($this->getUsuario()) ? 'home' : 'login');
        //$this->setTela(($this->getUsuario()) ? 'home' : 'loginTesteAndroid');
        $this->getPage();
    }

    /**
     * Acao logar()
     * Verifica se foram passados os dados do formulário POST
     */
    public function logar() {
        parent::getUsuario() ? $this->setTela('home') : ($this->getDados('POST') ? $this->_logar($this->getDados('POST')) : $this->setTela('login'));
    }

    /**
     * Metodo _logar($dados)
     * Persiste em logar o usuário com os dados passados por parametro no formulário
     * @param $dados
     */
    private function _logar($dados) {
        /**
         * Persistindo em logar
         */
        try {        	
            $usuario = Usuario::logar($dados['login'], $dados['senha']);   
            
            //guardando o usuário no controlador            
            $this->setUsuario($usuario);
            //recuperando se houver alguma url guardada
            $urlRecover = $this->getUrlRecover();
            //redirecionando
            header("Location: " . (($urlRecover) ? $urlRecover : 'index'));
        }

        /**
         * Capturando a excessão CamposObrigatorios
         */ catch (CamposObrigatorios $e) {
            $this->setFlash($e->getMessage());
            $this->setTela('login');
        }

        /**
         * Capturando a excessão LoginInvalido
         */ catch (LoginInvalido $e) {
            $this->setFlash($e->getMessage());
            $this->setTela('login');
        }
    }

    /**
     * Acao logout()
     * Destroi a sessão e redireciona para a tela default de login
     */
    public function logout() {
        session_destroy();
        header("Location: index");
    }

    public function voltar() {
        $this->setPage();
    }


    /* PARA ANDROID *//* PARA ANDROID */
    /* PARA ANDROID *//* PARA ANDROID */
    
    
    
    
    
    /******ACOMPANHANTE******/
    /******ACOMPANHANTE******/
    /******ACOMPANHANTE******/
    public function cadastrarAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_cadastrarAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('cadastrarUsuario');
    		$this->getPage();
    	}
    }
    
    private function _cadastrarAcompanhante($dados) {
    	$executa = new WebServiceControll();
    	$executa->_cadastrarAcompanhante($dados);
    }
    
    public function editarAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_editarAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarAcompanhante');
    		$this->getPage();
    	}
    }
    
    private function _editarAcompanhante($dados) {
    	$executa = new WebServiceControll();
    	$executa->_editarAcompanhante($dados);
    }

    public function excluirAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_excluirAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarAcompanhante');
    		$this->getPage();
    	}
    }
    
    private function _excluirAcompanhante($dados) {
    	$executa = new WebServiceControll();
    	$executa->_excluirAcompanhante($dados);
    }
    
    
    public function excluirAcompanhantePorIdUsuario() {
    	if ($this->getDados('POST')) {
    		$this->_excluirAcompanhantePorIdUsuario($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarAcompanhante');
    		$this->getPage();
    	}
    }
    
    private function _excluirAcompanhantePorIdUsuario($dados) {
    	$executa = new WebServiceControll();
    	$executa->_excluirAcompanhantePorIdUsuario($dados);
    }
    
    
    public function buscarAcompanhantePorId() {
    	if ($this->getDados('POST')) {
    		$this->_buscarAcompanhantePorId($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarAcompanhante');
    		$this->getPage();
    	}
    }
    
    private function _buscarAcompanhantePorId($dados) {
    	$executa = new WebServiceControll();
    	$executa->_buscarAcompanhantePorId($dados);
    }
    
    
    public function buscarAcompanhantePorIdUsuario() {
    	if ($this->getDados('POST')) {
    		$this->_buscarAcompanhantePorIdUsuario($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarAcompanhante');
    		$this->getPage();
    	}
    }
    
    private function _buscarAcompanhantePorIdUsuario($dados) {
    	$executa = new WebServiceControll();
    	$executa->_buscarAcompanhantePorIdUsuario($dados);
    }
    
    
    
    
    
    public function listarAcompanhante() {
    	$executa = new WebServiceControll();
    	$executa->listarAcompanhante();
    }    
    /******ACOMPANHANTE******/
    /******ACOMPANHANTE******/
    /******ACOMPANHANTE******/
    
    /******CLIENTE******/
    /******CLIENTE******/
    /******CLIENTE******/
    public function cadastrarCliente() {
    	if ($this->getDados('POST')) {
    		$this->_cadastrarCliente($this->getDados('POST'));
    	}
    	else{
    		meuVarDump($this->getDados('POST'));
    		//$this->setTela('cadastrarUsuario');
    		//
    	}
    }
    
    private function _cadastrarCliente($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_cadastrarCliente($dados);
    	 
    }
    
    public function editarCliente() {
    	if ($this->getDados('POST')) {
    		$this->_editarCliente($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarCliente');
    		$this->getPage();
    	}
    }
    
    private function _editarCliente($dados) {
    	
    	$executa = new WebServiceControll();
    	$executa->_editarCliente($dados);
    	
    }
    
    public function excluirCliente() {
    	if ($this->getDados('POST')) {
    		$this->_excluirCliente($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }
    
    
    private function _excluirCliente($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_excluirCliente($dados);
    
    }
    
    
    public function excluirClientePorIdUsuario() {
    	if ($this->getDados('POST')) {
    		$this->_excluirClientePorIdUsuario($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }
    
    
    private function _excluirClientePorIdUsuario($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_excluirClientePorIdUsuario($dados);
    
    }
    
    
    
    public function buscarClientePorId() {
    	if ($this->getDados('POST')) {
    		$this->_buscarClientePorId($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }
    
    private function _buscarClientePorId($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_buscarClientePorId($dados);
    
    }
    
    
    public function buscarClientePorIdUsuario() {
    	if ($this->getDados('POST')) {
    		$this->_buscarClientePorIdUsuario($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }    
    private function _buscarClientePorIdUsuario($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_buscarClientePorIdUsuario($dados);
    
    }
    /******CLIENTE******/
    /******CLIENTE******/
    /******CLIENTE******/
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /******FOTO******/
    /******FOTO******/
    /******FOTO******/
    public function cadastrarFoto() {    	
        if ($this->getDados('POST')) {
            $this->_cadastrarFoto($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    	
    }
        
    private function _cadastrarFoto($dados) {
        $executa = new WebServiceControll();
        $executa->_cadastrarFoto($dados);
    }
    
    
    
    public function listarFotosPorIdAcompanhnate() {
    	if ($this->getDados('POST')) {
    		$this->_listarFotosPorIdAcompanhnate($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }    
    
    private function _listarFotosPorIdAcompanhnate($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_listarFotosPorIdAcompanhnate($dados);
    
    }
    
    
    public function subirFoto(){
        $this->setTela('subirFoto');
        $this->getPage();
    }
    
    public function subir(){
        
        // Where the file is going to be placed
        //$target_path = "http://leonardogalvao.com.br/TesteAndroid/uploads";
        //$target_path = dirname(__FILE__)."/uploads/";
        $target_path = RAIZ."/img/foto/";
        

        /* Add the original filename to our target path.
        Result is "uploads/filename.extension" */
        $target_path = $target_path .  $_FILES['uploadedfile']['name'];
        
        //meuVarDump($target_path);

        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            echo "The file ".  basename( $_FILES['uploadedfile']['name']).
            " has been uploaded";
        } else{
            echo "There was an error uploading the file, please try again!";
            echo "filename: " .  basename( $_FILES['uploadedfile']['name']);
            echo "target_path: " .$target_path;
        }
        /*
            <!--
            <form name="form1" id="form1" method="post" enctype="multipart/form-data">
                    <input type="file" name="uploadedfile" id="uploadedfile" />
                    <input type="submit" value="  Cadastrar  " />
            </form>-->
          */  
    }
    
    
    public function excluirFoto() {
    	if ($this->getDados('POST')) {
    		$this->_excluirFoto($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }
    
    
    private function _excluirFoto($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_excluirFoto($dados);
    
    }
    
    /******FOTO******/
    /******FOTO******/
    /******FOTO******/
    
    
    /******SERVIÇO******/
    /******SERVIÇO******/
    /******SERVIÇO******/ 
    public function servicosMaisUtilizados() {
    	$executa = new WebServiceControll();
    	$executa->_servicosMaisUtilizados();
    }
    
    public function listarServicos() {
    	$executa = new WebServiceControll();
    	$executa->listarServicos();
    }
    
    public function buscarServicoPorId() {
    	if ($this->getDados('POST')) {
    		$this->_buscarServicoPorId($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }    
    
    private function _buscarServicoPorId($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_buscarServicoPorId($dados);
    
    }
    /******SERVIÇO******/
    /******SERVIÇO******/
    /******SERVIÇO******/
    
    
    /******SERVIÇOS_ACOMPANHNATE******/
    /******SERVIÇOS_ACOMPANHNATE******/
    /******SERVIÇOS_ACOMPANHNATE******/    
    public function cadastrarServicosAcompanhante() {    	
        if ($this->getDados('POST')) {
            $this->_cadastrarServicosAcompanhnate($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    	
    }   
    private function _cadastrarServicosAcompanhnate($dados) {
        $executa = new WebServiceControll();
        $executa->_cadastrarServicosAcompanhnate($dados);
    }
    
    public function listarServicoAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_listarServicoAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }    
    private function _listarServicoAcompanhante($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_listarServicoAcompanhante($dados);
    
    }
    
    public function excluirServicoAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_excluirServicoAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }    
    private function _excluirServicoAcompanhante($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_excluirServicoAcompanhante($dados);
    
    }
    /******SERVIÇOS_ACOMPANHNATE******/
    /******SERVIÇOS_ACOMPANHNATE******/
    /******SERVIÇOS_ACOMPANHNATE******/
    
    

    /******LOCALIZAÇÃO_SERVIÇO_ACOMPANHANTE******/
    /******LOCALIZAÇÃO_SERVIÇO_ACOMPANHANTE******/
    /******LOCALIZAÇÃO_SERVIÇO_ACOMPANHANTE******/    
    public function cadastrarLocalizacaoServicoAcompanhante(){
        if ($this->getDados('POST')) {
            $this->_cadastrarLocalizacaoServicoAcompanhante($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    }
        
    private function _cadastrarLocalizacaoServicoAcompanhante($dados){
        $executa = new WebServiceControll();
        $executa->_cadastrarLocalizacaoServicoAcompanhante($dados);
    }
    
    
    public function listarLocalizacaoServicoAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_listarLocalizacaoServicoAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }    
    private function _listarLocalizacaoServicoAcompanhante($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_listarLocalizacaoServicoAcompanhante($dados);
    
    }
    
    public function excluirLocalizacaoServicoAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_excluirLocalizacaoServicoAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }    
    private function _excluirLocalizacaoServicoAcompanhante($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_excluirLocalizacaoServicoAcompanhante($dados);
    
    }
    
    /******LOCALIZAÇÃO_SERVIÇO_ACOMPANHANTE******/
    /******LOCALIZAÇÃO_SERVIÇO_ACOMPANHANTE******/
    /******LOCALIZAÇÃO_SERVIÇO_ACOMPANHANTE******/
    
    
    
    /******ENCONTRO******/
    /******ENCONTRO******/
    /******ENCONTRO******/    
    public function cadastrarEncontro(){
        if ($this->getDados('POST')) {
            $this->_cadastrarEncontro($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    }
        
    private function _cadastrarEncontro($dados){
        $executa = new WebServiceControll();
        $executa->_cadastrarEncontro($dados);
    }
    
    public function listarEncontroPorIdCliente(){
        if ($this->getDados('POST')) {
            $this->_listarEncontroPorIdCliente($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    }
        
    private function _listarEncontroPorIdCliente($dados){
        $executa = new WebServiceControll();
        $executa->_listarEncontroPorIdCliente($dados);
    }
    /******ENCONTRO******/
    /******ENCONTRO******/
    /******ENCONTRO******/
    
    
    
    
    /******ENCONTROS_DO_SERVCOS******/
    /******ENCONTROS_DO_SERVCOS******/
    /******ENCONTROS_DO_SERVCOS******/
    public function cadastrarServicosDoEncontro(){
        if ($this->getDados('POST')) {
            $this->_cadastrarServicosDoEncontro($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    }
        
    private function _cadastrarServicosDoEncontro($dados){
        $executa = new WebServiceControll();
        $executa->_cadastrarServicosDoEncontro($dados);
    }
    
    
    public function listarServicosDoEncontro(){
        if ($this->getDados('POST')) {
            $this->_listarServicosDoEncontro($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    }
        
    private function _listarServicosDoEncontro($dados){
        $executa = new WebServiceControll();
        $executa->_listarServicosDoEncontro($dados);
    }
    /******ENCONTROS_DO_SERVCOS******/
    /******ENCONTROS_DO_SERVCOS******/
    /******ENCONTROS_DO_SERVCOS******/
    
    
    /******COMENTARIO******/
    /******COMENTARIO******/
    /******COMENTARIO******/
    
    public function cadastrarComentario(){
        if ($this->getDados('POST')) {
            $this->_cadastrarComentario($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    }
        
    private function _cadastrarComentario($dados){
        $executa = new WebServiceControll();
        $executa->_cadastrarComentario($dados);
    }
    
    public function listarComentarioPorIdAcompanhante(){
        if ($this->getDados('POST')) {
            $this->_listarComentarioPorIdAcompanhante($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    }
        
    private function _listarComentarioPorIdAcompanhante($dados){
        $executa = new WebServiceControll();
        $executa->_listarComentarioPorIdAcompanhante($dados);
    }
    
    public function excluirComentario(){
        if ($this->getDados('POST')) {
            $this->_excluirComentario($this->getDados('POST'));
        }
        else
        {
            $this->setTela('cadastrarFoto');
            $this->getPage();
    	}
    }
        
    private function _excluirComentario($dados){
        $executa = new WebServiceControll();
        $executa->_excluirComentario($dados);
    }
    
    /******COMENTARIO******/
    /******COMENTARIO******/
    /******COMENTARIO******/
    
    
    public function logarAndroid() {
        if ($this->getDados('POST')) {
            $this->_logarAndroid($this->getDados('POST'));
        }
        else{            
            $this->setTela('loginTesteAndroid');
            $this->getPage();
        }
    }

    private function _logarAndroid($dados) {    	
    	$executa = new WebServiceControll();
    	$executa->_logarAndroid($dados);
    }
    











	
    /******TREAHD******/
    /******TREAHD******/
    /******TREAHD******/
    
    public function teste() {
        if ($this->getDados('POST')) {
            $this->_teste($this->getDados('POST'));
        }
        else{
            
            $this->setTela('testePerformance');
            $this->getPage();
		}
    }

    private function _teste($_POST) {    	
        
        $DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );        
        
    	$executa = new WebServiceControll();
    	$executa->_teste($_POST);
            
        $DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
        $executa->calcularTempo("logarAndroid",$DateTimeInicio, $DateTimeFim);
        
    }
    
    
    public function teste30() {
        if ($this->getDados('POST')) {
            $this->_teste30($this->getDados('POST'));
        }
        else{
            $this->setTela('testePerformance30');
            $this->getPage();
        }
    }

    private function _teste30($_POST) {    
    	$DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	
    	$executa = new WebServiceControll();
    	$executa->_teste($_POST);
    	
    	$DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	$executa->calcularTempo("logarAndroid",$DateTimeInicio, $DateTimeFim);
    }
    
    
    public function teste100() {
        if ($this->getDados('POST')) {
            $this->_teste100($this->getDados('POST'));
        }
        else{
            $this->setTela('testePerformance100');
            $this->getPage();
        }
    }

    private function _teste100($_POST) {
    	$DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	
    	$executa = new WebServiceControll();
    	$executa->_teste($_POST);
    	

    	$DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	$executa->calcularTempo("logarAndroid",$DateTimeInicio, $DateTimeFim);
    }
    
    
    
    public function testeListaAcompanhante() {
        if ($this->getDados('POST')) {
            $this->_testeListaAcompanhante($this->getDados('POST'));
        }
        else{
            
            $this->setTela('listarPerformance');
            $this->getPage();
		}
    }

    private function _testeListaAcompanhante($_POST) {    	
        
        $DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );        
        
    	$executa = new WebServiceControll();
    	$A = $executa->_testeListar($_POST);
        $DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
        $executa->calcularTempo("logarAndroid",$DateTimeInicio, $DateTimeFim);
        
    }
    
    
    public function testeListaAcompanhante30() {
        if ($this->getDados('POST')) {
            $this->_testeListaAcompanhante30($this->getDados('POST'));
        }
        else{
            
            $this->setTela('listarPerformance30');
            $this->getPage();
        }
    }

    private function _testeListaAcompanhante30($_POST) {    	
        $DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );        
    	$executa = new WebServiceControll();
    	$A = $executa->_testeListar($_POST);
            
        $DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
        $executa->calcularTempo("logarAndroid",$DateTimeInicio, $DateTimeFim);
    }
    
    public function testeListaAcompanhante100() {
        if ($this->getDados('POST')) {
            $this->_testeListaAcompanhante100($this->getDados('POST'));
        }
        else{
            
            $this->setTela('listarPerformance100');
            $this->getPage();
        }
    }

    private function _testeListaAcompanhante100($_POST) {    	
        $DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );        
    	$executa = new WebServiceControll();
    	$A = $executa->_testeListar($_POST);
            
        $DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
        $executa->calcularTempo("logarAndroid",$DateTimeInicio, $DateTimeFim);  
    }
    
    
    
    public function testeListaServico() {
        if ($this->getDados('POST')) {
            $this->_testeListaServico($this->getDados('POST'));
        }
        else{    
            $this->setTela('listarPerformanceServico');
            $this->getPage();
        }
    }

    private function _testeListaServico($_POST) {    	
        
        $DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );        
        
    	$executa = new WebServiceControll();
    	$executa->_testeListarServico($_POST);
        $DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
        $executa->calcularTempo("logarAndroid",$DateTimeInicio, $DateTimeFim);
        
    }
    
    public function testeListaServico30() {
        if ($this->getDados('POST')) {
            $this->_testeListaServico30($this->getDados('POST'));
        }
        else{    
            $this->setTela('listarPerformanceServico30');
            $this->getPage();
        }
    }

    private function _testeListaServico30($_POST) {    	
        
        $DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );        
        
    	$executa = new WebServiceControll();
    	$executa->_testeListarServico($_POST);
        $DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
        $executa->calcularTempo("logarAndroid",$DateTimeInicio, $DateTimeFim);
        
    }
    
    public function testeListaServico100() {
        if ($this->getDados('POST')) {
            $this->_testeListaServico100($this->getDados('POST'));
        }
        else{    
            $this->setTela('listarPerformanceServico100');
            $this->getPage();
        }
    }

    private function _testeListaServico100($_POST) {    	
        
        $DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );        
        
    	$executa = new WebServiceControll();
    	$executa->_testeListarServico($_POST);
        $DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
        $executa->calcularTempo("logarAndroid",$DateTimeInicio, $DateTimeFim);
        
    }
    
    
    
    public function excluirAcompanhantePerformance() {
        if ($this->getDados('POST')) {
            $this->_excluirAcompanhantePerformance($this->getDados('POST'));
        }
        else{    
            $this->setTela('excluirAcompanhantePerformance');
            $this->getPage();
        }
    }
    public function _excluirAcompanhantePerformance($dados){
    	$DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	
        $executa = new WebServiceControll();
    	$executa->_excluirAcompanhantePerformance($dados);
    	
    	$DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	$executa->calcularTempo("buscar",$DateTimeInicio, $DateTimeFim);
    }
    
    
    public function excluirAcompanhantePerformance30() {
        if ($this->getDados('POST')) {
            $this->_excluirAcompanhantePerformance30($this->getDados('POST'));
        }
        else{    
            $this->setTela('excluirAcompanhantePerformance30');
            $this->getPage();
        }
    }
    public function _excluirAcompanhantePerformance30($dados){
    	$DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	
        $executa = new WebServiceControll();
    	$executa->_excluirAcompanhantePerformance($dados);
    	
    	$DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	$executa->calcularTempo("buscar",$DateTimeInicio, $DateTimeFim);
    }
    
    
    public function excluirAcompanhantePerformance100() {
        if ($this->getDados('POST')) {
            $this->_excluirAcompanhantePerformance100($this->getDados('POST'));
        }
        else{    
            $this->setTela('excluirAcompanhantePerformance100');
            $this->getPage();
        }
    }
    public function _excluirAcompanhantePerformance100($dados){
    	$DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	
        $executa = new WebServiceControll();
    	$executa->_excluirAcompanhantePerformance($dados);
    	
    	$DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	$executa->calcularTempo("buscar",$DateTimeInicio, $DateTimeFim);
    }

    
    public function excluirClientePerformance() {
        if ($this->getDados('POST')) {
            $this->_excluirClientePerformance($this->getDados('POST'));
        }
        else{    
            $this->setTela('excluirClientePerformance');
            $this->getPage();
        }
    }
    
    public function _excluirClientePerformance(){
    	$DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	
        $executa = new WebServiceControll();
    	$executa->_excluirClientePerformance($dados);
    	
    	$DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	$executa->calcularTempo("buscar",$DateTimeInicio, $DateTimeFim);
    }
    
    
    public function excluirClientePerformance30() {
        if ($this->getDados('POST')) {
            $this->_excluirClientePerformance30($this->getDados('POST'));
        }
        else{    
            $this->setTela('excluirClientePerformance30');
            $this->getPage();
        }
    }
    
    public function _excluirClientePerformance30($dados){
    	$DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	
        $executa = new WebServiceControll();
    	$executa->_excluirClientePerformance($dados);
    	
    	$DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	$executa->calcularTempo("buscar",$DateTimeInicio, $DateTimeFim);
    }
    
    
    public function excluirClientePerformance100() {
        if ($this->getDados('POST')) {
            $this->_excluirClientePerformance100($this->getDados('POST'));
        }
        else{    
            $this->setTela('excluirClientePerformance100');
            $this->getPage();
        }
    }
    
    public function _excluirClientePerformance100($dados){
    	$DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	
        $executa = new WebServiceControll();
    	$executa->_excluirClientePerformance($dados);
    	

    	$DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
    	$executa->calcularTempo("buscar",$DateTimeInicio, $DateTimeFim);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function gravarLog(){
        if ($this->getDados('POST')) {
            $dados = $this->getDados('POST');
            
            
            $dtInicio = new DateTime($dados['dataIncio']);
            $dtFim = new DateTime($dados['dataFim']);
                        
            
            $executa = new WebServiceControll();
            $executa->calcularTempo($dados['funcao'], $dtInicio, $dtFim);
        }
        else{
            echo'Falta enviar os dados via post';
        }
        
    }
    
    
    /******TREAHD******/
    /******TREAHD******/
    /******TREAHD******/    
}

?>