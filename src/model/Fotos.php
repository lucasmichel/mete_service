<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acao_modulos_perfis
 *
 * @author kaykylopes
 */
class Fotos {
    private $id;
    private $nome;
    private $excluido;
    private $acompanhanteId;
    
    function __construct($id = 0, $nome = '', $excluido = 0, $acompanhanteId = 0) {
        $this->id = $id;
        $this->nome = $nome;
        $this->excluido = $excluido;
        $this->acompanhanteId = $acompanhanteId;
    }
    

    /**
     * Metodo _validarCampos()
     * @return boolean
     */
    private function _validarCampos(){
        
    	if(($this->getNome() == '')||($this->getAcompanhanteId() == 0))
    		return false;
    	return true;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
    
    public function getExcluido() {
        return $this->excluido;
    }

    public function getAcompanhanteId() {
        return $this->acompanhanteId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setExcluido($excluido) {
        $this->excluido = $excluido;
    }

    public function setAcompanhanteId($acompanhanteId) {
        $this->acompanhanteId = $acompanhanteId;
    }

        
	public function inserir(){
            // validando os campos //
            
            if(!$this->_validarCampos())
                    // levantando a excessao CamposObrigatorios //
                    throw new CamposObrigatorios("Fotos");
            // recuperando a instancia da classe de acesso a dados //
            $instancia = FotosDAO::getInstancia();
            // executando o metodo //
            $fotos = $instancia->inserir($this);
            // retornando o Usuario //
            return  $fotos;
    }
     public function editar(){
            // validando os campos //
            if(!$this->_validarCampos())
                    // levantando a excessao CamposObrigatorios //
                    throw new CamposObrigatorios();
            // recuperando a instancia da classe de acesso a dados //
            $instancia = FotosDAO::getInstancia();
            // executando o metodo //
            $fotos = $instancia->editar($this);
            // retornando o Usuario //
            return  $fotos;
    }
    public function excluir(){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = FotosDAO::getInstancia();
            // executando o metodo //
            $fotos = $instancia->excluir($this->getId());
            // retornando o resultado //
            return $fotos;
    }
    
     public static function listar($ordenarPor){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = FotosDAO::getInstancia();
            // executando o metodo //
            $fotos = $instancia->listar($ordenarPor);
            // checando se o retorno foi falso //
            if(!$fotos)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::FOTOS);
            // percorrendo os usuarios //
            foreach($fotos as $foto){
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                    $objetos[] = new Fotos($foto['id'],
                            $foto['nome'],
                            $foto['excluido'],
                            $foto['acompanhante_id']
                           );
            }
            // retornando a colecao $objetos //
            return $objetos;
     }
     public static function listarPorIdAcompanhante($id){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = FotosDAO::getInstancia();
            // executando o metodo //
            $fotos = $instancia->listarPorIdAcompanhante($id);
            // checando se o retorno foi falso //
            if(!$fotos)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::FOTOS);
            // percorrendo os usuarios //
            foreach($fotos as $foto){
                
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                    $objetos[] = new Fotos($foto['id'],
                            $foto['nome'],
                            $foto['excluido'],
                            $foto['acompanhante_id']
                           );
                    
                           
            }
            // retornando a colecao $objetos //
            return $objetos;
    }
    
     public static function listarPorIdAcompanhanteWebService($id){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = FotosDAO::getInstancia();
            // executando o metodo //
            $fotos = $instancia->listarPorIdAcompanhante($id);
            // checando se o retorno foi falso //
            if(!$fotos)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::FOTOS);
            // percorrendo os usuarios //
            foreach($fotos as $foto){
                
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                    $objetos[] = (array) new Fotos($foto['id'],
                            $foto['nome'],
                            $foto['excluido'],
                            $foto['acompanhante_id']
                           );
                    
                           
            }
            // retornando a colecao $objetos //
            return $objetos;
    }

    
     public static function buscar($id){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = FotosDAO::getInstancia();
            // executando o metodo //
            $foto = $instancia->buscarPorId($id);
            // checando se o resultado foi falso //
            if(!$foto)
                    // levanto a excessao RegistroNaoEncontrado //
                    throw new RegistroNaoEncontrado(RegistroNaoEncontrado::FOTO);
            // instanciando e retornando o Usuario //
            
            $a = new Fotos($foto['id'],
                            $foto['nome'],
                            $foto['excluido'],
                            $foto['acompanhante_id']
                           );
            return $a;
    }
    
    
    
    public function sobeFotosCampo(Acompanhante $acompanhante, Array $arquivos){
        $contFoto = 1;
        $fotos = count($arquivos[0]['foto']['name']);
            for($i = 0; $i < $fotos ; $i++){			

                $foto_temp = $arquivos[0]['foto']['tmp_name'][$i]; 
                $foto_name = $arquivos[0]['foto']['name'][$i];			
                $foto_size = $arquivos[0]['foto']['size'][$i];
                $foto_type = $arquivos[0]['foto']['type'][$i];

                if($foto_size > 0){

                    /*if (substr($foto_name,-4,1) == ".")
                        $extensao = substr($foto_name, -4);
                    else
                        $extensao = substr($foto_name, -5);*/

                    //$dataHora = date("YmdHi");

                    //$nome_foto = $acompanhante->getId() . "_" . $dataHora ."_". $contFoto .$extensao;
                    //$contFoto++;
                    //$caminhoFoto = $_SERVER["DOCUMENT_ROOT"] . BASE . DS . "img/foto/".$nome_foto;

                    /*SALVA FOTO*/
                    
                    $caminhoFotoNovo = $_SERVER["DOCUMENT_ROOT"] . BASE.'/img/foto/'.$foto_name;
                    
                    $fotoAcao = new Fotos();
                    $fotoCadastro = new Fotos();
                    
                    $fotoCadastro->setAcompanhanteId($acompanhante->getId());
                    //$fotoCadastro->setNome($nome_foto);
                    $fotoCadastro->setNome($foto_name);
                    
                    
                    /*SALVA FOTO*/
                    
                    //if (move_uploaded_file($foto_temp, $caminhoFoto)){
                    if (move_uploaded_file($foto_temp, $caminhoFotoNovo)){
                        //chmod ($caminhoFoto, 0777);
                        chmod ($caminhoFotoNovo, 0777);
                        $fotoAcao = $fotoCadastro->inserir();
                        //$acaoFoto->cadastrarFoto($idGeradoGaleria, $nome_foto, " ");
                    }
                    else{
                        throw new Exception("Erro ao subir imagem, contate o adminsitrador do sistema");
                        exit();
                    }
                }
            }
    }
    
    
    
    public function excluirFotos(Array $arquivos){
        
        
        
        foreach ($arquivos as $value) {
        
            
            
            foreach ($value as $id) {
                $foto = self::buscar($id);
            
                //unlink($foto->getNome());
                $foto->excluir();
            }
            
            
            
        }
        
        
        
        
    }
    
    
    
    
}

?>;
