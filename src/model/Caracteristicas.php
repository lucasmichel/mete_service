<?php
/**
 * @author kaykylopes
 *
 */
class Caracteristicas{
	private $id;
	private $nome;
        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }
        public function setId($id) {
            $this->id = $id;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }


        function __construct($id = 0, $nome = '') {
            $this->id = $id;
            $this->nome = $nome;
        }

        
        public function inserir(){
        	// validando os campos //
        	if(!$this->_validarCampos())
        		// levantando a excessao CamposObrigatorios //
        		throw new CamposObrigatorios();
        	// recuperando a instancia da classe de acesso a dados //
        	$instancia = CaracteisticasDAO::getInstancia();
        	// executando o metodo //
        	$caracteristicas = $instancia->inserir($this);
        	// retornando o Usuario //
        	return  $caracteristicas = $instancia->inserir($this);
        }
        public function editar(){
        	// validando os campos //
        	if(!$this->_validarCampos())
        		// levantando a excessao CamposObrigatorios //
        		throw new CamposObrigatorios();
        	// recuperando a instancia da classe de acesso a dados //
        	$instancia = CaracteisticasDAO::getInstancia();
        	// executando o metodo //
        	$caracteristicas = $instancia->editar($this);
        	// retornando o Usuario //
        	return  $caracteristicas = $instancia->editar($this);
        }
        public function excluir(){
        	// recuperando a instancia da classe de acesso a dados //
        	$instancia = CaracteisticasDAO::getInstancia();
        	// executando o metodo //
        	$caracteristicas = $instancia->excluir($this->getId());
        	// retornando o resultado //
        	return $caracteristicas;
        }
        
        public static function listar($ordenarPor){
        	// recuperando a instancia da classe de acesso a dados //
        	$instancia = CaracteisticasDAO::getInstancia();
        	// executando o metodo //
        	$caracteristicas = $instancia->listar($ordenarPor);
        	// checando se o retorno foi falso //
        	if(!$caracteristicas)
        		// levantando a excessao ListaVazia //
        		throw new ListaVazia(ListaVazia::FOTOS);
        	// percorrendo os usuarios //
        	foreach($caracteristicas as $caracteristicas){
        		// instanciando e jogando dentro da colecao $objetos o Usuario //
        		$objetos[] = new Caracteristicas($caracteristicas['id'],        				
        				$caracteristicas['nome']
        		);
        	}
        	// retornando a colecao $objetos //
        	return $objetos;
        }
        
        
        public static function buscar($id){
        	// recuperando a instancia da classe de acesso a dados //
        	$instancia = CaracteisticasDAO::getInstancia();
        	// executando o metodo //
        	$fotos = $instancia->buscarPorId($id);
        	// checando se o resultado foi falso //
        	if(!$caracteristicas)
        		// levanto a excessao RegistroNaoEncontrado //
        		throw new RegistroNaoEncontrado(RegistroNaoEncontrado::USUARIO);
        	// instanciando e retornando o Usuario //
        
        	$a = new  Caracteristicas($caracteristicas['id'],        			
        			$caracteristicas['nome']);
        	return $a;
        }
}

?>