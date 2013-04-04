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
    	else{
    		return true;
    	}
    }
	
    
    
    
    public function inserir(){
    	// validando os campos //
    	if(!$this->_validarCampos()){
    		// recuperando a instancia da classe de acesso a dados //
    		$instancia = AcaoDAO::getInstancia();
    		// retornando o Usuario //
    		return self::construirObjeto($instancia->adicionar($this));
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
    
    private function construirObjeto($dados){
    	$acao =	new Acao();
    	$acao->setCodigoAcao(trim($dados['codigo_acao']));
    	$acao->setNome(trim($dados['nome']));
    	$acao->setModulo(Modulo::buscar(trim($dados['nome'])));
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
		if((empty($codigoAcao)) || (empty($modulo)))
			return false;
		
		//echo '<pre>';
		foreach($controll->getUsuario()->getPerfil()->getAcoes() as $acao){

			/*echo '<br />CodigoAcao<br />';
			echo $acao->getCodigoAcao();
			echo '<br />nome<br />';
			echo $acao->getNome();
			echo '<br />Modulo<br />';
			var_dump($acao->getModulo());
			echo '<br /><br />';*/

			if(($acao->getCodigoAcao() == $codigoAcao)&&($acao->getModulo()->getId() == $modulo))
			{
				return true;
			}
				
		}
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
