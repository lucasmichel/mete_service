<?php
class Encontro{
	private $id;
	private $clienteId;
	private $dataHorario;
	private $excluido;
	
	public function __construct($id = 0, 
            $clienteId = 0,
            $dataHorario = null,
            $excluido = 0) {
            $this->id = $id;
            $this->clienteId = $clienteId;
            $this->dataHorario = $dataHorario;
            $this->excluido = $excluido;
	}
	
	
        private function _validarCampos(){
            $retorno = false;            
                    
            if($this->getClienteId() == 0){
                throw new CamposObrigatorios("Encontro falta: clienteId");
                $retorno = false;
            }     
            
            if($this->getDataHorario() == null){
                throw new CamposObrigatorios("Encontro: Data horario");
                $retorno = false;
            }
            else
                {
                    $retorno = true;

            }	
            return $retorno;
	}
	

	public function inserir(){
            // validando os campos //
            if(!$this->_validarCampos())
                    // levantando a excessao CamposObrigatorios //
                    throw new CamposObrigatorios();
            // recuperando a instancia da classe de acesso a dados //
            $instancia = EncontroDAO::getInstancia();		
            return  $instancia->inserir($this);
	}
	
	public function editar(){
            // validando os campos //
            if(!$this->_validarCampos())
                    // levantando a excessao CamposObrigatorios //
                    throw new CamposObrigatorios();
            // recuperando a instancia da classe de acesso a dados //
            $instancia = EncontroDAO::getInstancia();		

            return  $instancia->editar($this);
	}
	
	public function excluir(){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = EncontroDAO::getInstancia();
            // executando o metodo //
            $encontro = $instancia->excluir($this->getId());
            // retornando o resultado //
            return $encontro;
	}
	
        
        private function fabricaObjeto (Array $obj){
            $obj = new Encontro(
                                $obj['cliente_id'],
                                $obj['data_horario'],                                
                                $obj['excluido']
                                );
            return $obj;
        }
        
	public static function listar($ordenarPor){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = EncontroDAO::getInstancia();
            // executando o metodo //
            $lista = $instancia->listar($ordenarPor);
            // checando se o retorno foi falso //
            if(!$lista)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::ENCONTRO);
            // percorrendo os usuarios //
            foreach($lista as $obj){
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                    $objetos[] =  $this->fabricaObjeto($obj);
            }
            // retornando a colecao $objetos //
            return $objetos;
	}
	
	public static function buscar($id){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = EcontroDAO::getInstancia();
            // executando o metodo //
            $obj = $instancia->buscarPorId($id);
            // checando se o resultado foi falso //
            if(!$obj)
                    // levanto a excessao RegistroNaoEncontrado //
                    throw new RegistroNaoEncontrado(RegistroNaoEncontrado::ENCONTRO);
            // instanciando e retornando o objeto //
            return $this->fabricaObjeto($obj);
	}
        
	public function buscarSituacaoEcontro(){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = EncontroDAO::getInstancia();
            // executando o metodo //            
            return $instancia->buscarSituacaoEcontro($this->getId());
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
	
	public function getExcluido() {
		return $this->excluido;
	}
	
	public function setExcluido($excluido) {
		$this->excluido = $excluido;
	}
	
	
	
}

?>