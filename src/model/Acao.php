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
	public static function listar($filtroModulo = 0,$filtroPerfil = 0){
		$instancia = AcaoDAO::getInstancia();
		$acoes = $instancia->listar($filtroModulo,$filtroPerfil);
		if(!$acoes)
			throw new ListaVazia(ListaVazia::ACOES);
		foreach($acoes as $acao){
			$objetos[] = new Acao($acao['codigo_acao'],$acao['nome'],Modulo::buscar($acao['id_modulo']));
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
		return new Acao($acao['codigo_acao'],$acao['nome'],Modulo::buscar($acao['id_modulo']));
	}
	
	/**
	 * Metodo checarPermissao($codigoAcao,$modulo)
	 * @param $codigoAcao
	 * @param $modulo
	 * @return boolean
	 */
	public static function checarPermissao($codigoAcao = 0, $modulo = 0) {
	
		$controll = Controll::getControll();
		
		if((empty($codigoAcao)) || (empty($modulo)))
			return false;
			
		foreach($controll->getUsuario()->getPerfil()->getAcoes() as $acao){

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
