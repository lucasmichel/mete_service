<?php
class WebServiceControll extends Controll{
	
	public function WebServiceControll(){}
	
	
	
	
	public function _excluirUsuario($dados) {
		try {
	
			$encoded = $this->descriptografarTextoTeste($dados);
			$dados = $encoded["dados"][0];
				
			$usuario = new Usuario( );
			$usuario->buscar($dados->{'id'});
	
			$arrayRetorno["dados"] = $usuario->excluir();
			$arrayRetorno["status"] = 0;
			$arrayRetorno["messagem"] = "Usuario excluído com suceso";
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
	
	
	
		} catch (Exception $e) {
			$arrayRetorno["dados"] = null;
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		}
			
			
	}
	
	
	public function _cadastrarFoto($dados) {
		try {
			 
			$encoded = $this->descriptografarTextoTeste($dados);
			$fotoDados = $encoded["dados"][0];
			
			$foto = new Fotos( );
			$foto->setNome($fotoDados->{'photo'});
			$foto->setAcompanhanteId($fotoDados->{'id'});
	
			$arrayRetorno["dados"] = $foto->inserir();
			$arrayRetorno["status"] = 0;
			$arrayRetorno["messagem"] = "Acompanhante cadastrada com suceso";
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
	
			 
			 
		} catch (Exception $e) {
			$arrayRetorno["dados"] = null;
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		}
		 
		 
	}
	
	
	public function _editarAcompanhante($dados) {
		 
		try {
	
			$encoded = $this->descriptografarTexto($dados);	
			$encoded = $encoded["dados"][0];
	
			$usuario = new Usuario();
			$acompanhante = new Acompanhante();
	
			$usuario->setId(trim($encoded->{'idUsuario'}));
			$usuario->setLogin(trim($encoded->{'email'}));
			$usuario->setSenha(trim($encoded->{'senha'}));
			$usuario->setEmail(trim($encoded->{'email'}));
	
			$acompanhante->setId(trim($encoded->{'id'}));
			$acompanhante->setNome(trim($encoded->{'nome'}));
			$acompanhante->setIdade(trim($encoded->{'idade'}));
			$acompanhante->setAltura(trim($encoded->{'altura'}));
			$acompanhante->setPeso(trim($encoded->{'peso'}));
			$acompanhante->setBusto(trim($encoded->{'busto'}));
			$acompanhante->setCintura(trim($encoded->{'cintura'}));
			$acompanhante->setQuadril(trim($encoded->{'quadril'}));
			$acompanhante->setOlhos(trim($encoded->{'olhos'}));
			$acompanhante->setPernoite(trim($encoded->{'pernoite'}));
			$acompanhante->setAtendo(trim($encoded->{'atendo'}));
			$acompanhante->setEspecialidade(trim($encoded->{'especialidade'}));
			$acompanhante->setHorarioAtendimento(trim($encoded->{'horario_atendimento'}));
	
			if($usuario->_validarCampos())
				$insert = true;
			else
				$insert = false;
	
			if($acompanhante->_validarCampos())
				$insert = true;
			else
				$insert = false;
	
			if($insert == true){
				$usuario = $usuario->editar();
				$acompanhante = $acompanhante->editar();
			}
				
			$arrayRetorno["dados"] = $usuario;
			$arrayRetorno["status"] = 0;
			$arrayRetorno["messagem"] = "Acompanhante editada com suceso";
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
	
	
		} catch (Exception $e) {
			$arrayRetorno["dados"] = null;
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		}
	}
	
	public function _editarCliente($dados) {
		 
		try {
	
			$encoded = $this->descriptografarTexto($dados);
			$encoded = $encoded["dados"][0];
	
			$perfil = Perfil::buscar(2);
			$usuario = new Usuario();
			$cliente = new Cliente();
			$usuario->setId(trim($encoded->{'idUsuario'}));
			$usuario->setLogin(trim($encoded->{'email'}));
			$usuario->setSenha(trim($encoded->{'senha'}));
			$usuario->setEmail(trim($encoded->{'email'}));
	
			$cliente->setId(trim($encoded->{'id'}));
			$cliente->setCpf(trim($encoded->{'cpf'}));
			$cliente->setNome(trim($encoded->{'nome'}));
			 
			if($usuario->_validarCampos())
				$insert = true;
			else
				$insert = false;
	
			if($cliente->_validarCampos())
				$insert = true;
			else
				$insert = false;
	
			if($insert == true){
				$usuario = $usuario->editar();
				$cliente = $cliente->editar();
			}
	
			$arrayRetorno["dados"] = $usuario;
			$arrayRetorno["status"] = 0;
			$arrayRetorno["messagem"] = "Cliente editado com suceso";
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
	
		} catch (Exception $e) {
			$arrayRetorno["dados"] = null;
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		}
	}
	
	public function _cadastrarUsuario($dados) {
	
		// O Curl irá fazer uma requisição para a API do Vimeo
		// e irá receber o JSON com as informações do vídeo.
		/*$curl = curl_init("http://leonardogalvao.com.br/teste/json.php");
		 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$jsonCriptografado = curl_exec($curl);
		curl_close($curl);
		$encoded = json_decode(base64_decode( $jsonCriptografado));*/
	
	
	
		// As informações pode ser recuperadas da seguinte forma.
		// Resultado do echo: Forest aerials 5D 1080p KAHRS / 395 segundos
		//echo $encoded->{'login'} . " / " . $encoded->{'senha'} . " segundos";
		try {
	
			$encoded = $this->descriptografarTextoTeste($dados);
	
			$encoded = $encoded["dados"][0];
	
			$tipoUsuario = $encoded->{'tipo'};
	
			if(($tipoUsuario != 1)&&($tipoUsuario != 2)){
				$arrayRetorno["dados"] = null;
				$arrayRetorno["status"] = 1;
				$arrayRetorno["messagem"] = 'tipo de usuario não definido ou definido errado';
				header('Cache-Control: no-cache, must-revalidate');
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Content-type: application/json');
				$retorno = base64_encode(json_encode($arrayRetorno));
				echo $retorno;
			}
	
			/*identifica o tipo 1 é cliente e 2 é prostituta*/
			if($tipoUsuario == 1){
	
				$perfil = Perfil::buscar(2);
				$usuario = new Usuario();
				$cliente = new Cliente();
	
				$usuario->setPerfil($perfil);
				$usuario->setLogin(trim($encoded->{'email'}));
				$usuario->setSenha(trim($encoded->{'senha'}));
				$usuario->setEmail(trim($encoded->{'email'}));
	
	
				$cliente->setCpf(trim($encoded->{'cpf'}));
				$cliente->setNome(trim($encoded->{'nome'}));
				$cliente->setExcluido(0);
	
	
	
				if($usuario->_validarCampos())
					$insert = true;
				else
					$insert = false;
	
				if($cliente->_validarCampos())
					$insert = true;
				else
					$insert = false;
	
				if($insert == true){
					$usuario = $usuario->inserir();
					$cliente->setUsuarioId($usuario->getId());
					$cliente->setUsuarioIdPerfil($usuario->getPerfil()->getId());
					$cliente = $cliente->inserir();
				}
				$arrayRetorno["dados"] = $cliente;
				$arrayRetorno["status"] = 0;
				$arrayRetorno["messagem"] = "Cliente cadastrado com suceso";
				header('Cache-Control: no-cache, must-revalidate');
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Content-type: application/json');
				$retorno = base64_encode(json_encode($arrayRetorno));
				echo $retorno;
	
			}
			/*identifica o tipo 1 é cliente e 2 é prostituta*/
			else if($tipoUsuario == 2){
	
				$perfil = Perfil::buscar(3);
	
				$usuario = new Usuario();
				$acompanhante = new Acompanhante();
	
	
				$usuario->setPerfil($perfil);
				$usuario->setLogin(trim($encoded->{'email'}));
				$usuario->setSenha(trim($encoded->{'senha'}));
				$usuario->setEmail(trim($encoded->{'email'}));
	
				$acompanhante->setNome(trim($encoded->{'nome'}));
				$acompanhante->setIdade(trim($encoded->{'idade'}));
				$acompanhante->setAltura(trim($encoded->{'altura'}));
				$acompanhante->setPeso(trim($encoded->{'peso'}));
				$acompanhante->setBusto(trim($encoded->{'busto'}));
				$acompanhante->setCintura(trim($encoded->{'cintura'}));
				$acompanhante->setQuadril(trim($encoded->{'quadril'}));
				$acompanhante->setOlhos(trim($encoded->{'olhos'}));
				$acompanhante->setPernoite(trim($encoded->{'pernoite'}));
				$acompanhante->setAtendo(trim($encoded->{'atendo'}));
				$acompanhante->setEspecialidade(trim($encoded->{'especialidade'}));
				$acompanhante->setHorarioAtendimento(trim($encoded->{'horarioAtendimento'}));
				$acompanhante->setExcluido(0);
	
	
				if($usuario->_validarCampos())
					$insert = true;
				else
					$insert = false;
	
				if($acompanhante->_validarCampos())
					$insert = true;
				else
					$insert = false;
	
				if($insert == true){
					$usuario = $usuario->inserir();
					$acompanhante->setUsuarioId($usuario->getId());
					$acompanhante->setUsuarioIdPerfil($usuario->getPerfil()->getId());
					$acompanhante->inserir();
				}
				$arrayRetorno["dados"] = $acompanhante;
				$arrayRetorno["status"] = 0;
				$arrayRetorno["messagem"] = "Acompanhante cadastrada com suceso";
				header('Cache-Control: no-cache, must-revalidate');
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Content-type: application/json');
				$retorno = base64_encode(json_encode($arrayRetorno));
				echo $retorno;
			}
	
	
		} catch (Exception $e) {
			$arrayRetorno["dados"] = null;
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		}
	}
	
	
	public function _logarAndroid($dados) {
		try {
	
			$jsonCriptografado = $dados['textoCriptografado'];
			$jsonDescriptografado = base64_decode($jsonCriptografado);
			$encoded = json_decode($jsonDescriptografado);
	
			$arrayRetorno["dados"] = Usuario::logarAndroid(trim($encoded->{'email'}), trim($encoded->{'senha'}));
			$arrayRetorno["status"] = 0;
			$arrayRetorno["messagem"] = "OK";
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		} catch (Exception $e) {
			$arrayRetorno["dados"] = null;
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		}
	}
	
	
	
	public function listarAcompanhante() {	
		try {
			$arrayRetorno = Acompanhante::listarParaWebService();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		} catch (Exception $e) {
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		}
	}
	
	public function listarServicosDesc() {
		try {
			$arrayRetornoLista = Servico::listarParaWebService();
			$arrayRetorno["dados"] = $arrayRetornoLista;
			$arrayRetorno["status"] = 0;
			$arrayRetorno["messagem"] = "OK";
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = json_encode($arrayRetorno);
			echo $retorno;
		} catch (Exception $e) {
			$arrayRetorno["dados"] = null;
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = json_encode($arrayRetorno);
			echo $retorno;
		}
	}
	
	public function listarServicos() {
		try {
			$arrayRetornoLista = Servico::listarParaWebService();
			$arrayRetorno["dados"] = $arrayRetornoLista;
			$arrayRetorno["status"] = 0;
			$arrayRetorno["messagem"] = "OK";
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		} catch (Exception $e) {
			$arrayRetorno["dados"] = null;
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		}
	}
	
	public function listarUsuarios() {
		try {
			$arrayRetorno = Usuario::listarParaWebService();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		} catch (Exception $e) {
			$arrayRetorno["status"] = 1;
			$arrayRetorno["messagem"] = $e->getMessage();
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			$retorno = base64_encode(json_encode($arrayRetorno));
			echo $retorno;
		}
	}
	
}
?>