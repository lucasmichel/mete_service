<?php
class  Localizacao{
	private $id;
	private $latitude;
	private $longitude;
	private $bairro;
	private $cidade;
	private $servico_acompanhante_id;
	
	public function __construct($id = 0, $latitude = '',$longitude = '',$bairro = '',$cidade = '',
			$servico_acompanhante_id = null) {
		$this->id = $id;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->bairro = $bairro;
		$this->cidade = $cidade;
		$this->servico_acompanhante_id = $servico_acompanhante_id;
	}
	
	private function _validarCampos(){
		if(($this->getLatitude() == '')||($this->getId() == null)||($this->getLongitude() == '')
				||($this->getBairro() == '')||($this->getCidade() == null)
				||($this->getServicoAcompanhanteId() == null))
			return false;
		return true;
	}
	
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getLatitude() {
		return $this->latitude;
	}
	
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}
	public function getLongitude() {
		return $this->longitude;
	}
	
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}
	
	public function getBairro() {
		return $this->bairro;
	}
	
	public function setBairro($bairro) {
		$this->bairro = $bairro;
	}
	public function getCidade() {
		return $this->cidade;
	}
	
	public function setCidade($cidade) {
		$this->cidade = $cidade;
	}
	public function getServicoAcompanhanteId() {
		return $this->servico_acompanhante_id;
	}
	
	public function setServicoAcompanhanteId($servicoAcompanhanteId) {
		$this->ServicoAcompanhanteId = $servicoAcompanhanteId;
	}
	
	public function inserir(){
		// validando os campos //
		if(!$this->_validarCampos())
			// levantando a excessao CamposObrigatorios //
			throw new CamposObrigatorios();
		// recuperando a instancia da classe de acesso a dados //
		$instancia = LocalizacaoDAO::getInstancia();
		// executando o metodo //
		$localizacao = $instancia->inserir($this);
		// retornando o Usuario //
		return  $localizacao = $instancia->inserir($this);
	}
	
	public function editar(){
		// validando os campos //
		if(!$this->_validarCampos())
			// levantando a excessao CamposObrigatorios //
			throw new CamposObrigatorios();
		// recuperando a instancia da classe de acesso a dados //
		$instancia = LocalizacaoDAO::getInstancia();
		// executando o metodo //
		$localizacao = $instancia->editar($this);
		// retornando o Usuario //
		return  $localizacao = $instancia->editar($this);
	}
	
	public function excluir(){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = LocalizacaoDAO::getInstancia();
		// executando o metodo //
		$localizacao = $instancia->excluir($this->getId());
		// retornando o resultado //
		return $localizacao;
	}
	
	public static function listar($ordenarPor){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = LocalizacaoDAO::getInstancia();
		// executando o metodo //
		$localizacao = $instancia->listar($ordenarPor);
		// checando se o retorno foi falso //
		if(!$localizacao)
			// levantando a excessao ListaVazia //
			throw new ListaVazia(ListaVazia::LOCALIZACAO);
		// percorrendo os usuarios //
		foreach($localizacao as $localizacao){
			// instanciando e jogando dentro da colecao $objetos o Usuario //
			$objetos[] = new Localizacao($localizacao['id'],$localizacao['latitude'],
					$localizacao['longitude'],$localizacao['bairro'],$localizacao['cidade'],
					$localizacao['servico_acompanhante_id']);
		}
		// retornando a colecao $objetos //
		return $objetos;
	}
	
 
        public static function buscar($id){
        	// recuperando a instancia da classe de acesso a dados //
        	$instancia = CaracteisticasDAO::getInstancia();
        	// executando o metodo //
        	$localizacao = $instancia->buscarPorId($id);
        	// checando se o resultado foi falso //
        	if(!$localizacao)
        		// levanto a excessao RegistroNaoEncontrado //
        		throw new RegistroNaoEncontrado(RegistroNaoEncontrado::LOCALIZACAO);
        	// instanciando e retornando o Usuario //
        	$a = new  Localizacao($caracteristicas['id'],$caracteristicas['latitude'],
					$caracteristicas['longitude'],$caracteristicas['bairro'],$caracteristicas['cidade'],
					$caracteristicas['servico_acompanhante_id']);
        	return $a;
        }
}

?>