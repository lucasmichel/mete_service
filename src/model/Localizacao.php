
<?php
class  Localizacao{
	private $id;
	private $latitude;
	private $longitude;
	private $enderecoFormatado;	
	private $servicoAcompanhanteId;
	
	public function __construct($id = 0, $latitude = null,$longitude = null,
                $enderecoFormatado = null, $servicoAcompanhanteId = 0) {
		$this->id = $id;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->enderecoFormatado = $enderecoFormatado;
		$this->servicoAcompanhanteId = $servicoAcompanhanteId;
	}
	
	private function _validarCampos(){
            $retorno = false;
            
            if($this->getLatitude() == null){
                throw new CamposObrigatorios("Localização: falta latitude");
                $retorno = false;
            }
            if($this->getLongitude() == null){
                throw new CamposObrigatorios("Localização: falta longitude");
                $retorno = false;
            }
            if($this->getEnderecoFormatado() == null){
                throw new CamposObrigatorios("Localização: falta enderço formatado");
                $retorno = false;
            }
            if ($this->getServicoAcompanhanteId() == 0)
            {
                throw new CamposObrigatorios("Localização: falta ServicoAcompanhanteId");
                $retorno = false;
            }
            else
                {
                    $retorno = true;

            }	
            return $retorno;
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
	
	public function getEnderecoFormatado() {
		return $this->enderecoFormatado;
	}
        
	public function setEnderecoFormatado($enderecoFormatado) {
		$this->enderecoFormatado = $enderecoFormatado;
	}
        
	
	public function getServicoAcompanhanteId() {
		return $this->servicoAcompanhanteId;
	}
	
	public function setServicoAcompanhanteId($servicoAcompanhanteId) {
		$this->ServicoAcompanhanteId = $servicoAcompanhanteId;
	}
	
	public function inserir(){
            
		// validando os campos //
		if($this->_validarCampos()){
                    // recuperando a instancia da classe de acesso a dados //
                    $instancia = LocalizacaoDAO::getInstancia();
                    // executando o metodo //                    
                    $localizacao = $instancia->inserir($this);
                    // retornando o Usuario //
                    return  $localizacao;
                }
			
			
		
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
		return  $localizacao;
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
					$localizacao['longitude'],$localizacao['endereco_formatado'],
					$localizacao['servicos_acompanhante_id']);
		}
		// retornando a colecao $objetos //
		return $objetos;
	}
        
	public static function listarPorServicoAcompanhanteId($ServicoAcompanhanteId){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = LocalizacaoDAO::getInstancia();
		// executando o metodo //
		$localizacao = $instancia->listarPorServicoAcompanhanteId($ServicoAcompanhanteId);
		// checando se o retorno foi falso //
		if(!$localizacao)
			// levantando a excessao ListaVazia //
			throw new ListaVazia(ListaVazia::LOCALIZACAO);
		// percorrendo os usuarios //
		foreach($localizacao as $localizacao){
			// instanciando e jogando dentro da colecao $objetos o Usuario //
			$objetos[] = new Localizacao($localizacao['id'],$localizacao['latitude'],
					$localizacao['longitude'],$localizacao['endereco_formatado'],
					$localizacao['servicos_acompanhante_id']);
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
        	$a = new  Localizacao($localizacao['id'],$localizacao['latitude'],
					$localizacao['longitude'],$localizacao['endereco_formatado'],
					$localizacao['servicos_acompanhante_id']);
        	return $a;
        }
}

?>
        




