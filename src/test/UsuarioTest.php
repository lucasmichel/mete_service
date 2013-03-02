<?php
/**
 * Carregando os arquivos necessários para realiza��o dos testes
 */
require_once 'include.php';

class UsuarioTest extends PHPUnit_Framework_TestCase {

	/**
	 * Função testControll()
	 * Testa as funcionalidades do Usuario
	 */
    public function testAddUsuario() {
        try {
            $u = $usuario = new Usuario(0, Perfil::buscar(1), "teste", "teste");
            $usuario->inserir();

            //TODO Procurar um Assert melhor...

            //Verifica se os dois objetos são do mesmo tipo
            $this->assertSame($u, $usuario);
        } catch (RegistroNaoEncontrado $e) {
            var_dump($usuario);
        }
    }
}
?>