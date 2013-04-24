<?php
class Encontro{
	private $id;
	private $cliente_id;
	private $data_horario;
	private $aprovado;
	
	public function __construct($id = 0, $cliente_id = null,$data_horario = '',$aprovado = true) {
		$this->id = $id;
		$this->cliente_id = $cliente_id;
		$this->data_horario = $data_horario;
		$this->aprovado = $aprovado;
	}
	
	private function _validarCampos(){
		if(($this->getClienteId() == null)||($this->getId() == null)||($this->getDataHorario() == '')
				||($this->getAprovado() == ''))
			return false;
		return true;
	}
	

	public function inserir(){
		// validando os campos //
		if(!$this->_validarCampos())
			// levantando a excessao CamposObrigatorios //
			throw new CamposObrigatorios();
		// recuperando a instancia da classe de acesso a dados //
		$instancia = EncontroDAO::getInstancia();
		// executando o metodo //
		$encontro = $instancia->inserir($this);
		// retornando o Usuario //
		return  $encontro = $instancia->inserir($this);
	}
	
	public function editar(){
		// validando os campos //
		if(!$this->_validarCampos())
			// levantando a excessao CamposObrigatorios //
			throw new CamposObrigatorios();
		// recuperando a instancia da classe de acesso a dados //
		$instancia = EncontroDAO::getInstancia();
		// executando o metodo //
		$encontro = $instancia->editar($this);
		// retornando o Usuario //
		return  $encontro = $instancia->editar($this);
	}
	
	public function excluir(){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = EncontroDAO::getInstancia();
		// executando o metodo //
		$encontro = $instancia->excluir($this->getId());
		// retornando o resultado //
		return $encontro;
	}
	
	public static function listar($ordenarPor){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = CaracteisticasDAO::getInstancia();
		// executando o metodo //
		$encontro = $instancia->listar($ordenarPor);
		// checando se o retorno foi falso //
		if(!$encontro)
			// levantando a excessao ListaVazia //
			throw new ListaVazia(ListaVazia::ENCONTRO);
		// percorrendo os usuarios //
		foreach($encontro as $encontro){
			// instanciando e jogando dentro da colecao $objetos o Usuario //
			$objetos[] = new Encontro($caracteristicas['id'],$caracteristicas['clienteId'],
					$caracteristicas['data_horario'],	$caracteristicas['aprovado']);
		}
		// retornando a colecao $objetos //
		return $objetos;
	}
	
	public static function buscar($id){
		// recuperando a instancia da classe de acesso a dados //
		$instancia = CaracteisticasDAO::getInstancia();
		// executando o metodo //
		$encontro = $instancia->buscarPorId($id);
		// checando se o resultado foi falso //
		if(!$encontro)
			// levanto a excessao RegistroNaoEncontrado //
			throw new RegistroNaoEncontrado(RegistroNaoEncontrado::ENCONTRO);
		// instanciando e retornando o Usuario //
	
		$a = new   Encontro($caracteristicas['id'],$caracteristicas['clienteId'],
					$caracteristicas['data_horario'],	$caracteristicas['aprovado']);
		return $a;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getClienteId() {
		return $this->cliente_id;
	}
	
	public function setClienteId($clienteId) {
		$this->cliente_id = $clienteId;
	}
	
	public function getDataHorario() {
		return $this->data_horario;
	}
	
	public function setDataHorario($DataHorario) {
		$this->data_horario = $DataHorario;
	}
	
	public function getAprovado() {
		return $this->aprovado;
	}
	
	public function setAprovado($aprovado) {
		$this->aprovado = $aprovado;
	}
	
	
	
}

?>