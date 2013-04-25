<?php
class WebServiceControll extends Controll{
	
	public function WebServiceControll(){}
	
	
	private function objectToArray ($object) {
		
		return (array) $object;
		
		/*if ( count($object) > 1 ) {
			$arr = array();
			for ( $i = 0; $i < count($object); $i++ ) {
				$arr[] = get_object_vars($object[$i]);
			}
	
			meuVarDump('AQUI 1 ' . $arr);
			
			return $arr;
	
		} else {
			echo '<pre>';
			var_dump($object);
			echo '<br />';
			echo '<br />';
			meuVarDump(get_object_vars($object));
			
			return get_object_vars($object);
		}*/
	}
	
	private function retorno($arrayRetorno){
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		$retorno = base64_encode(json_encode($arrayRetorno));
		//$retorno = json_encode($arrayRetorno);
		echo $retorno;
	}
	
	
	private function preencherArray($dados, $status, $menssagem){
		
		$arrayDados = $this->objectToArray($dados);
		$arrayRetorno["dados"] = $arrayDados;
		$arrayRetorno["status"] = $status;
		$arrayRetorno["mensagem"] = $menssagem;
		
		return $arrayRetorno; 
	}
	
	
	private function lerArray($encoded){
		$arrayRetorno["dados"] = $encoded["dados"];
		$arrayRetorno["status"] = $encoded["status"];
		$arrayRetorno["mensagem"] = $encoded["mensagem"];
		
		return $arrayRetorno;
	}
	
	
	public function _cadastrarAcompanhante($dados) {
		try {	
			$jsonDescriptografado = base64_decode($dados);
			$encoded = json_decode($jsonDescriptografado, true);
				
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
	
			$perfil = Perfil::buscar(3);
	
			$usuario = new Usuario();
			$acompanhante = new Acompanhante();
	
			$usuario->setPerfil($perfil);
			$usuario->setLogin(trim($atributoDados['email']));
			$usuario->setSenha(trim($atributoDados['senha']));
			$usuario->setEmail(trim($atributoDados['email']));
	
			$acompanhante->setNome(trim($atributoDados['nome']));
			$acompanhante->setIdade(trim($atributoDados['idade']));
			$acompanhante->setAltura(trim($atributoDados['altura']));
			$acompanhante->setPeso(trim($atributoDados['peso']));
			
			$acompanhante->setBusto(trim($atributoDados['busto']));
			$acompanhante->setCintura(trim($atributoDados['cintura']));
			$acompanhante->setQuadril(trim($atributoDados['quadril']));
			$acompanhante->setOlhos(trim($atributoDados['olhos']));
			$acompanhante->setPernoite(trim($atributoDados['pernoite']));
			$acompanhante->setAtendo(trim($atributoDados['atendo']));
			$acompanhante->setEspecialidade(trim($atributoDados['especialidade']));
			$acompanhante->setHorarioAtendimento(trim($atributoDados['horarioAtendimento']));
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
				$acompanhante = $acompanhante->inserir();
			}
			
			$retornoDados[] = $acompanhante;
			$retornoDados[] = $usuario;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Acompanhante cadastrada com suceso");
			
			$this->retorno($arrayRetorno);
		}
		catch (Exception $e) {
			$arrayRetorno["dados"] = null;
			$arrayRetorno["status"] = 1;
			$arrayRetorno["mensagem"] = $e->getMessage();
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
	
	
	public function _editarAcompanhante($dados) {
		 
		try {
	
			
			$jsonDescriptografado = base64_decode($dados);
			$encoded = json_decode($jsonDescriptografado, true);
				
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
			
			
	
			$usuario = new Usuario();
			$acompanhante = new Acompanhante();
	
			$usuario->setId(trim($atributoDados['idUsuario']));
			$usuario->setLogin(trim($atributoDados['email']));
			$usuario->setSenha(trim($atributoDados['senha']));
			$usuario->setEmail(trim($atributoDados['email']));
	
			$acompanhante->setId(trim($atributoDados['id']));
			$acompanhante->setNome(trim($atributoDados['nome']));
			$acompanhante->setIdade(trim($atributoDados['idade']));
			$acompanhante->setAltura(trim($atributoDados['altura']));
			$acompanhante->setPeso(trim($atributoDados['peso']));
			$acompanhante->setBusto(trim($atributoDados['busto']));
			$acompanhante->setCintura(trim($atributoDados['cintura']));
			$acompanhante->setQuadril(trim($atributoDados['quadril']));
			$acompanhante->setOlhos(trim($atributoDados['olhos']));
			$acompanhante->setPernoite(trim($atributoDados['pernoite']));
			$acompanhante->setAtendo(trim($atributoDados['atendo']));
			$acompanhante->setEspecialidade(trim($atributoDados['especialidade']));
			$acompanhante->setHorarioAtendimento(trim($atributoDados['horario_atendimento']));
	
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

			$retornoDados[] = $acompanhante;
			$retornoDados[] = $usuario;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Acompanhante editada com suceso");
			
			$this->retorno($arrayRetorno);
			
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _excluirAcompanhante($dados) {
		try {
			$jsonDescriptografado = base64_decode($dados);
			$encoded = json_decode($jsonDescriptografado, true);
			
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];


			
			$acompanhante = new Acompanhante();
			$acompanhante = $acompanhante->buscar($atributoDados['id']);
			$acompanhante = $acompanhante->excluir();
			
			$retornoDados[] = $acompanhante;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Acompanhante excluída com sucesso!");
			
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _buscarAcompanhantePorId($dados) {
		try {
			$jsonDescriptografado = base64_decode($dados);
			$encoded = json_decode($jsonDescriptografado, true);
			
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
				
			$acompanhante = new Acompanhante();
			$acompanhante = $acompanhante->buscar($atributoDados['id']);
			
			$usuario = Usuario::buscar($acompanhante->getUsuarioId());
			
			$retornoDados[] = $cliente;
			$retornoDados[] = $usuario;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Acompanhante localizada!");
			
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
	
	public function listarAcompanhante() {
		try {
			$arrayRetornoLista = Acompanhante::listarParaWebService();			
			
			$arrayRetorno = $this->preencherArray($arrayRetornoLista, 0, "OK");
			
			$this->retorno($arrayRetorno);
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	
	
	
	public function _cadastrarCliente($dados) {
	
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
			
			$jsonDescriptografado = base64_decode($dados);
			$encoded = json_decode($jsonDescriptografado, true);
			
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
			
			$perfil = Perfil::buscar(2);
			$usuario = new Usuario();
			$cliente = new Cliente();
				
			$usuario->setPerfil($perfil);
			$usuario->setLogin(trim($atributoDados['email']));
			$usuario->setSenha(trim($atributoDados['senha']));
			$usuario->setEmail(trim($atributoDados['email']));
	
			
			$cliente->setCpf(trim($atributoDados['cpf']));
			$cliente->setNome(trim($atributoDados['nome']));
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
			
			$retornoDados[] = $cliente;
			$retornoDados[] = $usuario;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Cliente cadastrado com suceso");
			
			$this->retorno($arrayRetorno);
		}
		catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	
	}
	
	
	
	
	public function _editarCliente($dados) {
		 
		try {
	
			$jsonDescriptografado = base64_decode($dados);
			$encoded = json_decode($jsonDescriptografado, true);
			
			
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
			
			$usuario = new Usuario();
			$cliente = new Cliente();
			$usuario->setId(trim($atributoDados['idUsuario']));
			$usuario->setLogin(trim($atributoDados['email']));
			$usuario->setSenha(trim($atributoDados['senha']));
			$usuario->setEmail(trim($atributoDados['email']));
	
			$cliente->setId(trim($atributoDados['id']));
			$cliente->setCpf(trim($atributoDados['cpf']));
			$cliente->setNome(trim($atributoDados['nome']));
			 
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
			
			$retornoDados[] = $cliente;
			$retornoDados[] = $usuario;
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Cliente editado com suceso");
			
			
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _excluirCliente($dados) {
		try {
			
			$jsonDescriptografado = base64_decode($dados);
			$encoded = json_decode($jsonDescriptografado, true);
			
			//meuVarDump($encoded);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			//$to = count($encoded["dados"]);
			//meuVarDump($to);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			
			
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
			
			$cliente = new Cliente();
			$cliente = $cliente->buscar($atributoDados['id']);
			$cliente = $cliente->excluir();
			
			$retornoDados[] = $cliente;
				
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Cliente excluído com sucesso!");
			$this->retorno($arrayRetorno);
			
	
		} catch (Exception $e) {
						
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _buscarClientePorId($dados) {
		try {
			
			$jsonDescriptografado = base64_decode($dados);
			$encoded = json_decode($jsonDescriptografado, true);
				
			//meuVarDump($encoded);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			//$to = count($encoded["dados"]);
			//meuVarDump($to);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
				
				
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];

			$cliente = new Cliente();
			$cliente = $cliente->buscar($atributoDados['id']);
			
			$usuario = Usuario::buscar($cliente->getUsuarioId());
			
			$retornoDados[] = $cliente;
			$retornoDados[] = $usuario;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "OK");
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	
	
	
	public function _logarAndroid($dados) {
		try {
	
			//$jsonCriptografado = $dados['textoCriptografado'];
			$jsonDescriptografado = base64_decode($dados);
			$encoded = json_decode($jsonDescriptografado, true);
			
			//meuVarDump($encoded);			
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			//$to = count($encoded["dados"]);
			//meuVarDump($to);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			
			
			$atributoDados = $encoded["dados"][0];			
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
			
			$usuario = Usuario::logarAndroid($atributoDados['login'], $atributoDados['senha']);
			$retornoDados[] = $usuario; 
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Usuário logado com sucesso!");			
			$this->retorno($arrayRetorno);
			
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	
	
	
	
	public function listarServicos() {
		try {
			
			$arrayRetornoLista = Servico::listarParaWebService();
			
			$arrayRetorno = $this->preencherArray($arrayRetornoLista, 0, "OK");
			
			$this->retorno($arrayRetorno);
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	
	public function _cadastrarFoto($dados) {
		try {
	
			$encoded = $this->descriptografarTextoTeste($dados);
			$fotoDados = $encoded["dados"][0];
				
			$foto = new Fotos( );
			$foto->setNome($fotoDados->{'photo'});
			$foto->setAcompanhanteId($fotoDados->{'id'});
			
			$arrayRetorno = $this->preencherArray($foto->inserir(), 0, "Foto cadastrada com suceso");
			
			$this->retorno($arrayRetorno);
				
		} catch (Exception $e) {			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	
	
	
}
?>