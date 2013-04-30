<?php
/**
 * Classe Acao
 * @package model
 */
class Acao {
	
	/**
	 * Atributos
	 */
	
	private $id;
	private $codigoAcao;
	private $nome;
	private $modulo;
	private $subMenu;
	private $excluido;

	/**
	 * Metodo construtor()
	 * @param $id
	 * @param $codigoAcao
	 * @param $nome
	 * @param $modulo
	 * @param $subMenu
	 * @return Acao
	 */
	public function __construct($id = 0, $codigoAcao = 0,$nome = '',Modulo $modulo = null, $subMenu = 0, $excluido = 0){
		$this->id = $id;
		$this->codigoAcao = $codigoAcao;
		$this->nome = $nome;
		$this->modulo = $modulo;
		$this->subMenu = $subMenu;
		$this->excluido = $excluido;
		
	}
	
	/**
	 * Metodo listar($filtroModulo,$filtroPerfil)
	 * @param $filtroModulo
	 * @param $filtroPerfil
	 * @return Acao[]
	 */
 	public function _validarCampos(){
 		
 		$retorno = true;
 		
    	if($this->getNome() == null){
    		throw new Exception("é necessário um nome para a ação");
    		$retorno = false;
    	}
    	elseif ($this->getModulo() == null){
    		throw new Exception("é necessário definir a que módulo esta ação pertence");
    		$retorno = false;
    	}
    	elseif ($this->getCodigoAcao() == 0){
    		throw new Exception("é necessário definir o código da ação");
    		$retorno = false;
    	}
    	
    	else if($this->getId() == 0){
    	
	    	if ($this->_validarNomeAcaoAdd($this)){
	    		throw new Exception("nome da ação já existente para este módulo");
	    		$retorno = false;
	    	}
	    	
	    	if ($this->_validarCodigoAcaoAdd($this)){
	    		throw new Exception("código da ação já existente para este módulo");
	    		$retorno = false;
	    	}
    	}
    	
    	elseif ($this->getId() != 0){
    		
    		if ($this->_validarNomeAcaoEdit($this)){
    			throw new Exception("nome da ação já existente para este módulo");
    			$retorno = false;
    		}    		
    		
	    	if ($this->_validarCodigoAcaoEdit($this)){	    		
	    		throw new Exception("código da ação já existente para este módulo");
	    		$retorno = false;
	    	}
    	}
    	//validar se ja não existe o mesmo codigo junto com o mesmo nome no mesmo modulo...
    	else{
    		$retorno = true;
    	}
    	return $retorno;
    }
	
    
    
    
    public function inserir(){
    	// validando os campos //
    	if($this->_validarCampos()){
    		// recuperando a instancia da classe de acesso a dados //
    		$instancia = AcaoDAO::getInstancia();
    		// retornando o Usuario //    		
    		return $instancia->inserir($this); 
    	}
    }
    
    public function editar(){
    	// validando os campos //
    	if($this->_validarCampos()){
    		// recuperando a instancia da classe de acesso a dados //
    		$instancia = AcaoDAO::getInstancia();
    		
    		// executando o metodo //
    		//return $this;//self::construirObjeto($instancia->editar($this));
    		$instancia->editar($this);
    		return $this;
    	}
    }

    
    /**
     * Metodo excluir()
     * @return boolean
     */
    public function excluir(){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = AcaoDAO::getInstancia();
    	// executando o metodo //
    	
        //primeiro exclui o relacionamento das acoes
        $obj1 = $instancia->excluirRelacionamentoAcaoModuloPerfil($this);
        
    	$obj = $instancia->excluir($this->getId());
    	// retornando o resultado //
    	return $obj;
    }
    
    
    private static function construirObjeto($dados){
    	
    	$acao =	new Acao();
    	
    	$acao->setId($dados['id']);
    	$acao->setCodigoAcao($dados['codigo_acao']);
    	$acao->setNome($dados['nome']);
    	$acao->setModulo(Modulo::buscar($dados['id_modulo']));
    	$acao->setSubMenu($dados['sub_menu']);
    	$acao->setExcluido($dados['excluido']);
    	return $acao;
    }
    
    
	public static function listarComFiltro($filtroModulo = 0,$filtroPerfil = 0){
		$instancia = AcaoDAO::getInstancia();
		$acoes = $instancia->listar($filtroModulo,$filtroPerfil);
		if(!$acoes)
			throw new ListaVazia(ListaVazia::ACOES);
		foreach($acoes as $acao){
			$objetos[] = self::construirObjeto($acao);
		}
		return $objetos;
	}
	
	
	
	public static function listarPorModulo($idModulo){
		$instancia = AcaoDAO::getInstancia();
		$acoes = $instancia->listarPorModulo($idModulo);
		if(!$acoes)
			throw new ListaVazia(ListaVazia::ACOES);
		foreach($acoes as $acao){
			$objetos[] = self::construirObjeto($acao);
		}
		return $objetos;
	}
	
        
        public static function listarPorModuloExclusaoModulo($idModulo){
		$instancia = AcaoDAO::getInstancia();
		$listaAcoes = $instancia->listarPorModulo($idModulo);
		if($listaAcoes){
	
                    foreach($listaAcoes as $acao){
                            $objetos[] = self::construirObjeto($acao);
                    }                    
                    return $objetos;
                }
                else {
                    return null;
                }
                
	}
        
        
	/**
	 * Metodo buscar($codigoAcao,$modulo)
	 * @param $codigoAcao
	 * @param $modulo
	 * @return Acao
	 */
	public static function buscar($codigoAcao = 0,$modulo = 0){
		
		$instancia = AcaoDAO::getInstancia();
		
		$acao = $instancia->buscar($codigoAcao,$modulo);		
		if(!$acao)
			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::ACAO);
		return self::construirObjeto($acao);
	}
	
	/**
	 * Metodo checarPermissao($codigoAcao,$modulo)
	 * @param $codigoAcao
	 * @param $modulo
	 * @return boolean
	 */
	public static function checarPermissao($codigoAcao = 0, $modulo = null) {
		$controll = Controll::getControll();		
		$usuarioLogado = $controll->getUsuario();
		$perfilUsuarioLogado = $usuarioLogado->getPerfil();
		$acoesPerfilUsuarioLogado = $perfilUsuarioLogado->getAcoes();
		
		if((empty($codigoAcao)) || (empty($modulo))){
			return false;
		}
			
		
		if(($modulo == 5)&&($codigoAcao==1)){
			$acoesPerfilUsuarioLogado;
		}
		
		//echo '<pre>';
		
		foreach($acoesPerfilUsuarioLogado as $acao){
			
			$usuarioAcao = (int) $acao->getCodigoAcao();
			$moduloId = (int) $acao->getModulo()->getId();

			/*echo '<br />CodigoAcao<br />';
			echo $acao->getCodigoAcao();
			echo '<br />nome<br />';
			echo $acao->getNome();
			echo '<br />Modulo<br />';
			var_dump($acao->getModulo());
			echo '<br /><br />';*/
			
			/*echo '<pre>Usuario acao <br />';
			var_dump($usuarioAcao);
			echo '<br />modulo ID ';
			var_dump($moduloId);*/

			if(($usuarioAcao == $codigoAcao)&&($moduloId == $modulo))
			{
				return true;
			}
				
		}
		return false;
	}
	
	private static function _validarNomeAcaoAdd(Acao $dados){
		//buscarNomeAcao
		$instancia = AcaoDAO::getInstancia();
		$acoe = $instancia->buscarNomeAcao($dados->getNome(), $dados->getModulo()->getId());
		if($acoe)
			return true;
		// instanciando e retornando o bollean//
		else
			return false;
	}
	
	
	private static function _validarCodigoAcaoAdd(Acao $dados){
		//buscarNomeAcao
		$instancia = AcaoDAO::getInstancia();
		$acoe = $instancia->buscarCodigoAcao($dados->getCodigoAcao(), $dados->getModulo()->getId());
		if($acoe)
			return true;
		// instanciando e retornando o bollean//
		else
			return false;
	}
	
	
	

	private static function _validarNomeAcaoEdit(Acao $dados){
		//buscarNomeAcao
		$instancia = AcaoDAO::getInstancia();
		$acoe = $instancia->buscarNomeAcaoEdicao($dados->getId(), $dados->getNome(), $dados->getModulo()->getId());
		if($acoe)
			return true;
		// instanciando e retornando o bollean//
		else
			return false;
	}
	
	
	private static function _validarCodigoAcaoEdit(Acao $dados){		
		//buscarNomeAcao
		$instancia = AcaoDAO::getInstancia();				
		$acoe = $instancia->buscarCodigoAcaoEdicao($dados->getId(), $dados->getCodigoAcao(), $dados->getModulo()->getId());
		if($acoe)
			return true;
		// instanciando e retornando o bollean//
		else
			return false;
	}
	
	/**
	 * Metodos getters() e setters()
	 */
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getCodigoAcao(){
		return $this->codigoAcao;
	}
	public function setCodigoAcao($codigoAcao){
		$this->codigoAcao = $codigoAcao;
	}
	public function getNome(){
		return $this->nome;
	}
	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getModulo(){
		return $this->modulo;
	}
	public function setModulo(Modulo $modulo){
		$this->modulo = $modulo;
	}
	public function getSubMenu(){
		return $this->subMenu;
	}
	public function setSubMenu($subMenu){
		$this->subMenu = $subMenu;
	}
	public function getExcluido(){
		return $this->excluido;
	}
	public function setExcluido($excluido){
		$this->excluido = $excluido;
	}
	
}
?>
