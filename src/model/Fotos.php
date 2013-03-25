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
    private $acompanhante_id;
    
    function __construct($id = 0, $nome = '', $acompanhante_id= 0) {
        $this->id = $id;
        $this->nome = $nome;
        $this->acompanhante_id = $acompanhante_id;
    }
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getAcompanhante_id() {
        return $this->acompanhante_id;
    }

        
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setAcompanhante_id($acompanhante_id) {
        $this->acompanhante_id = $acompanhante_id;
    }

        
     public function inserir(){
            // validando os campos //
            if(!$this->_validarCampos())
                    // levantando a excessao CamposObrigatorios //
                    throw new CamposObrigatorios();
            // recuperando a instancia da classe de acesso a dados //
            $instancia = FotosDAO::getInstancia();
            // executando o metodo //
            $fotos = $instancia->inserir($this);
            // retornando o Usuario //
            return  $fotos = $instancia->inserir($this);
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
            return  $fotos = $instancia->editar($this);
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
            foreach($fotos as $fotos){
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                    $objetos[] = new Fotos($fotos['id'],
                            Perfil::buscar($fotos['id_acompanhante']),
                            $fotos['nome']                      
                           );
            }
            // retornando a colecao $objetos //
            return $objetos;
    }

    
     public static function buscar($id){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = FotosDAO::getInstancia();
            // executando o metodo //
            $fotos = $instancia->buscarPorId($id);
            // checando se o resultado foi falso //
            if(!$fotos)
                    // levanto a excessao RegistroNaoEncontrado //
                    throw new RegistroNaoEncontrado(RegistroNaoEncontrado::USUARIO);
            // instanciando e retornando o Usuario //
            
            $a = new  Fotos($fotos['id'],
                            Perfil::buscar($fotos['id_acompanhante']),
                            $fotos['nome']);  
            return $a;
    }
}

?>