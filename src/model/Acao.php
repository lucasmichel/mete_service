<?php
/**
 * Classe Acao
 * @package model
 */
class Acao {
	
	/**
	 * Atributos
	 */
	private $codigoAcao;
	private $nome;
	private $modulo;

	/**
	 * Metodo construtor()
	 * @param $codigoAcao
	 * @param $nome
	 * @param $modulo
	 * @param $subMenu
	 * @return Acao
	 */
	public function __construct($codigoAcao = 0,$nome = '',Modulo $modulo = null){
		$this->codigoAcao = $codigoAcao;
		$this->nome = $nome;
		$this->modulo = $modulo;		
	}
	
	/**
	 * Metodo listar($filtroModulo,$filtroPerfil)
	 * @param $filtroModulo
	 * @param $filtroPerfil
	 * @return Acao[]
	 */
 	public function _validarCampos(){
    	if($this->getNome() == null){
    		throw new Exception("é necessário um nome para a ação");
    		return false;
    	}
    	elseif ($this->getModulo() == null){
    		throw new Exception("é necessário definir a que módulo esta ação pertence");
    		return false;
    	}
    	elseif ($this->getCodigoAcao() == 0){
    		throw new Exception("é necessário definir o código da ação");
    		return false;
    	}
    	
    	
    	elseif ($this->_validarNomeAcao){
    		throw new Exception("nome da ação já existente para este módulo");
    		return false;
    	}
    	
    	elseif ($this->_validarCodigoAcao){
    		throw new Exception("código da ação já existente para este módulo");
    		return false;
    	}
    	//validar se ja não existe o mesmo codigo junto com o mesmo nome no mesmo modulo...
    	else{
    		return true;
    	}
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
    	if(!$this->_validarCampos()){
    		// recuperando a instancia da classe de acesso a dados //
    		$instancia = AcaoDAO::getInstancia();
    		// executando o metodo //
    		return self::construirObjeto($instancia->editar($this));
    	}
    }    
    
    private static function construirObjeto($dados){
    	$acao =	new Acao();
    	$acao->setCodigoAcao($dados['codigo_acao']);
    	$acao->setNome($dados['nome']);
    	$acao->setModulo(Modulo::buscar($dados['id_modulo']));
    	return $acao;
    }
    
    
	public static function listar($filtroModulo = 0,$filtroPerfil = 0){
		$instancia = AcaoDAO::getInstancia();
		$acoes = $instancia->listar($filtroModulo,$filtroPerfil);
		if(!$acoes)
			throw new ListaVazia(ListaVazia::ACOES);
		foreach($acoes as $acao){
			$objetos[] = self::construirObjeto($acao);
		}
		return $objetos;
	}
	
	
	
	public static function listarPorModulo($modulo){
		$instancia = AcaoDAO::getInstancia();
		$acoes = $instancia->listarPorModulo($modulo->getId());
		if(!$acoes)
			throw new ListaVazia(ListaVazia::ACOES);
		foreach($acoes as $acao){
			$objetos[] = self::construirObjeto($acao);
		}
		return $objetos;
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
	
	private function _validarNomeAcao(Acao $dados){
		//buscarNomeAcao
		$instancia = AcaoDAO::getInstancia();
		$acoe = $instancia->buscarNomeAcao($dados->getNome(), $dados->getModulo()->getId());
		if($acoe)
			return true;
		// instanciando e retornando o bollean//
		else
			return false;
	}
	
	
	private function _validarCodigoAcao(Acao $dados){
		//buscarNomeAcao
		$instancia = AcaoDAO::getInstancia();
		$acoe = $instancia->buscarCodigoAcao($dados->getCodigoAcao(), $dados->getModulo()->getId());
		if($acoe)
			return true;
		// instanciando e retornando o bollean//
		else
			return false;
	}
	
	/**
	 * Metodos getters() e setters()
	 */
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
}
?>
