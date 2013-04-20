<?php
class WebServiceControll extends Controll{
	
	public function WebServiceControll(){}
	
	private function retorno($arrayRetorno){
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		$retorno = base64_encode(json_encode($arrayRetorno));
		echo $retorno;
	}
	
	
	private function preencherArray($dados, $status, $menssagem){
		$arrayRetorno["dados"] = $dados;
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
			$encoded = $this->descriptografarTexto($dados);
			
			meuVarDump($encoded);
			
			$status = $encoded["status"];
			$menssagem = $encoded["mensagem"];			
			$encoded = $encoded["dados"][0];
	
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
			
			$arrayRetorno = $this->preencherArray($acompanhante, 0, "Acompanhante cadastrada com suceso");
			
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
	
			$encoded = $this->descriptografarTexto($dados);
			
			$encoded = $encoded[$this->$dat][0];
	
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
			
			$arrayRetorno = $this->preencherArray($acompanhante, 0, "Acompanhante editada com suceso");
			
			$this->retorno($arrayRetorno);
			
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _excluirAcompanhante($dados) {
		try {
			$encoded = $this->descriptografarTexto($dados);
			$encoded = $encoded["dados"][0];
				
			$acompanhante = new Acompanhante();
			$acompanhante = $acompanhante->buscar($encoded->{'id'});
			$acompanhante = $acompanhante->excluir();
			
			$arrayRetorno[$this->$dat] = null;
			$arrayRetorno[$this->$sts] = 0;
			$arrayRetorno[$this->$msg] = "Acompanhante excluída com sucesso!";
			
			$arrayRetorno = $this->preencherArray(null, 0, "Acompanhante excluída com sucesso!");
			
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _buscarAcompanhantePorId($dados) {
		try {
			$encoded = $this->descriptografarTexto($dados);
			$encoded = $encoded["dados"][0];
				
			$acompanhante = new Acompanhante();
			
			$arrayRetorno = $this->preencherArray($acompanhante->buscar($encoded->{'id'}), 0, "Acompanhante localizada!");
			
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
			$encoded = $this->descriptografarTexto($dados);			
			$encoded = $encoded["dados"][0];
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
			
			$arrayRetorno = $this->preencherArray($cliente, 0, "Cliente cadastrado com suceso");
			
			$this->retorno($arrayRetorno);
		}
		catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
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
			
			
			$arrayRetorno = $this->preencherArray($cliente, 0, "Cliente editado com suceso");
			
			
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _excluirCliente($dados) {
		try {
			$encoded = $this->descriptografarTexto($dados);
			$encoded = $encoded["dados"][0];
						
			$cliente = new Cliente();
			$cliente = $cliente->buscar($encoded->{'id'});			
			$cliente = $cliente->excluir();
			
			$arrayRetorno = $this->preencherArray(null, 0, "Cliente excluído com sucesso!");
			
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
						
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _buscarClientePorId($dados) {
		try {
			$encoded = $this->descriptografarTexto($dados);
			$encoded = $encoded["dados"][0];
	
			$cliente = new Cliente();
			
			$arrayRetorno = $this->preencherArray($cliente->buscar($encoded->{'id'}), 0, "cliente localizado!");
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	
	
	
	public function _logarAndroid($dados) {
		try {
	
			$jsonCriptografado = $dados['textoCriptografado'];
			$jsonDescriptografado = base64_decode($jsonCriptografado);
			$encoded = json_decode($jsonDescriptografado);
			
			$arrayRetorno = $this->preencherArray(Usuario::logarAndroid(trim($encoded->{'email'}), trim($encoded->{'senha'})), 0, "OK");
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