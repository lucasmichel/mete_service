<?php
class WebServiceControll extends Controll{
	
	public function WebServiceControll(){}
	
	
        private function calcularTempo(DateTime $tempoInicio, DateTime $tempoFim){
            
                        $DateTimeInicio = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
                        $DateTimeFim = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
                        $this->calcularTempo($DateTimeInicio, $DateTimeFim);
                        
                        
            echo '<pre>';
            echo '<br/>';
            echo '<br/>';
            echo $tempoInicio->format( "Y-m-d H:i:s" );
            echo '<br/>';
            echo '<br/>';
            echo $tempoFim->format( "Y-m-d H:i:s" );
            
            echo '<br/>';
            echo '<br/>';
            
            $data_login = strtotime($tempoInicio->format( "Y-m-d H:i:s" ));
            $data_logout = strtotime($tempoFim->format( "Y-m-d H:i:s" ));

            /*$tempo_con = mktime($tempoFim->getTimestamp() - $tempoInicio->getTimestamp());
            meuVarDump($tempo_con);*/
            
            $tempo_con = mktime(
                    date('H', $data_logout) - date('H', $data_login), date('i', $data_logout) - 
                    date('i', $data_login), date('s', $data_logout) - date('s', $data_login)
                    );

            echo '<br/>';
            echo '<br/>';
            print date('H:i:s', $tempo_con);
            die();
            
            try
                {
                    $DateTime = new DateTime( 'now', new DateTimeZone( 'America/Recife') );
                }
                catch( Exception $e )
                {
                    echo 'Erro ao instanciar objeto.';
                    echo $e->getMessage();
                    exit();
                }
        }
        
        
        
        
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
		
		//$arrayDados = $this->objectToArray($dados);
                
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
			
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
                        
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
			
                        	
                        
                        $retorno1 = (array) $acompanhante;
                        $retorno2 = (array) $usuario;
			
                        $retornoDados[] = $retorno1;
			$retornoDados[] = $retorno2;
                        
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
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
			
			$usuario = new Usuario();
			$acompanhante = new Acompanhante();
                        $perfil = Perfil::buscar(3);
                        
			$usuario->setId(trim($atributoDados['idUsuario']));
			$usuario->setLogin(trim($atributoDados['email']));
			$usuario->setSenha(trim($atributoDados['senha']));
			$usuario->setEmail(trim($atributoDados['email']));
                        $usuario->setPerfil($perfil);
	
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
			$acompanhante->setHorarioAtendimento(trim($atributoDados['horarioAtendimento']));
	
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

                        $retornoDados[] = (array) $acompanhante;
			$retornoDados[] = (array) $usuario;
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Acompanhante editada com suceso");
			
			$this->retorno($arrayRetorno);
                        
			
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _excluirAcompanhante($dados) {
		try {
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	


			
			$acompanhante = new Acompanhante();
			$acompanhante2 = $acompanhante->buscar($atributoDados['id']);
			$acompanhante3 = $acompanhante2->excluir();
			
                        
                        $retornoDados[] = (array) $acompanhante3;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Acompanhante excluída com sucesso!");
			
			$this->retorno($arrayRetorno);
                        
	
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
        
	public function _excluirAcompanhantePorIdUsuario($dados) {
		try {
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	


			
			$acompanhante = new Acompanhante();
			$acompanhante2 = $acompanhante->buscar($atributoDados['idUsuario']);
			$acompanhante3 = $acompanhante2->excluirPorIdUsuario();
			
                        
                        $retornoDados[] = (array) $acompanhante3;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Acompanhante excluída com sucesso!");
			
			$this->retorno($arrayRetorno);
                        
	
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _buscarAcompanhantePorId($dados) {
		try {
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
				
			$acompanhante = new Acompanhante();
			$acompanhante2 = $acompanhante->buscar($atributoDados['id']);
			
                        $retornoDados[] = (array) $acompanhante2;
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Acompanhante localizada!");
			
			$this->retorno($arrayRetorno);
                        
			
	
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
        
        
	public function _buscarAcompanhantePorIdUsuario($dados) {
		try {
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
				
			$acompanhante = new Acompanhante();
			$acompanhante = $acompanhante->buscarPorIdUsuario($atributoDados['id']);
			
			//$usuario = Usuario::buscar($acompanhante->getUsuarioId());
			
                        $retornoDados[] = (array) $acompanhante;
                        
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
                        $retornoDados[] =(array) $arrayRetornoLista;
                        $arrayRetorno = $this->preencherArray($retornoDados, 0, "Acompanhante localizada!");
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
			
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
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
                        
                        
                        $retornoDados[] = (array) $cliente;
                        $retornoDados[] = (array) $usuario;
			
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
	
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
			
                        
                        
                        $perfil = new Perfil();
                        
                        $perfil = Perfil::buscar(2);
                        
			$usuario = new Usuario();
			$cliente = new Cliente();
			$usuario->setId(trim($atributoDados['idUsuario']));
			$usuario->setLogin(trim($atributoDados['email']));
			$usuario->setSenha(trim($atributoDados['senha']));
			$usuario->setEmail(trim($atributoDados['email']));
                        $usuario->setPerfil($perfil);
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
			
                        $retornoDados[] = (array) $cliente;
                        $retornoDados[] = (array) $usuario;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Cliente editado com suceso");
			
			$this->retorno($arrayRetorno);
                        
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _excluirCliente($dados) {
		try {
			
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
			
			//meuVarDump($encoded);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			//$to = count($encoded["dados"]);
			//meuVarDump($to);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			
			$cliente = new Cliente();
			$cliente = $cliente->buscar($atributoDados['id']);
			$cliente = $cliente->excluir();
			
                        $retornoDados[] = (array) $cliente;
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Cliente excluído com sucesso!");
			
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
						
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
        
        
	public function _excluirClientePorIdUsuario($dados) {
		try {
			
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
			
			//meuVarDump($encoded);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			//$to = count($encoded["dados"]);
			//meuVarDump($to);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			
			$cliente = new Cliente();
			$cliente = $cliente->buscar($atributoDados['idUsuario']);
			$cliente = $cliente->excluirPorIdUsuario();
			
                        $retornoDados[] = (array) $cliente;
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Cliente excluído com sucesso!");
			
			$this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
						
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	public function _buscarClientePorId($dados) {
		try {
			
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
				
			//meuVarDump($encoded);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			//$to = count($encoded["dados"]);
			//meuVarDump($to);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/


			$cliente = new Cliente();
                        
			$cliente = $cliente->buscar($atributoDados['id']);
			
                        $retornoDados[] = (array) $cliente;
                        	
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "OK");
			
			$this->retorno($arrayRetorno);
                        
	
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	
        
        
        public function _buscarClientePorIdUsuario($dados) {
		try {
			
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
				
			//meuVarDump($encoded);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			//$to = count($encoded["dados"]);
			//meuVarDump($to);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/


			$clienteBusca = new Cliente();
			$cliente = $clienteBusca->buscarPorIdUsuario($atributoDados['id']);
			
			
			
                        
                        $retornoDados[] = (array) $cliente;
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "OK");
			
			$this->retorno($arrayRetorno);
                        
	
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
        
        
	
	
	public function _logarAndroid($dados) {
		try {
	
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
			
                        //meuVarDump($atributoDados);
			//meuVarDump($encoded);			
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			//$to = count($encoded["dados"]);
			//meuVarDump($to);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			
			$usuario = Usuario::logarAndroid($atributoDados['email'], $atributoDados['senha']);
			
                        $retornoDados[] = (array) $usuario;
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Usuário logado com sucesso");
			
			$this->retorno($arrayRetorno);
			
			
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
	
	
	
	
	
	public function listarServicos() {
            try {
                    $arrayRetornoLista = Servico::listarParaWebService("nome");
                    //$retornoDados[] = (array) $arrayRetornoLista;
                    $arrayRetorno = $this->preencherArray($arrayRetornoLista, 0, "listarServicos OK");
                    $this->retorno($arrayRetorno);
            } catch (Exception $e) {
                    $arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
                    $this->retorno($arrayRetorno);
            }
	}
        
        
	public function _buscarServicoPorId($dado) {
            try {
                
                    //COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
                    $jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
                    $encoded = json_decode($jsonDescriptografado, true);
                    $atributoDados = $encoded["dados"][0];
                    $atributoStatus = $encoded["status"];
                    $atributoMensagem = $encoded["mensagem"];
                    
                    $idServico = $atributoDados['id'];
                
                    $arrayRetornoLista = Servico::buscarServicoPorIdParaWebService($idServico);
                    //$retornoDados[] = (array) $arrayRetornoLista;
                    $arrayRetorno = $this->preencherArray($arrayRetornoLista, 0, "listarServicos OK");
                    $this->retorno($arrayRetorno);
            } catch (Exception $e) {
                    $arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
                    $this->retorno($arrayRetorno);
            }
	}
	
	
	public function _cadastrarFoto($dados) {
		try {
	
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
				
			$foto = new Fotos( );
			$foto->setNome($atributoDados['nome']);
			$foto->setAcompanhanteId($atributoDados['id']);
			$foto = $foto->inserir();
                        
                        $retornoDados[] = (array) $foto;
			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Foto cadastrada com suceso");
			
			$this->retorno($arrayRetorno);
		} catch (Exception $e) {			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
                
	}
        
	public function _listarFotosPorIdAcompanhnate($dados) {
		try {
	
                        //COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
                        $jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
                        $encoded = json_decode($jsonDescriptografado, true);
                        $atributoDados = $encoded["dados"][0];
                        $atributoStatus = $encoded["status"];
                        $atributoMensagem = $encoded["mensagem"];	
                        $listaFotos = Fotos::listarPorIdAcompanhanteWebService($atributoDados['id']);
                        $arrayRetorno = $this->preencherArray($listaFotos, 0, "Listar fotos OK");

                        $this->retorno($arrayRetorno);
		} catch (Exception $e) {			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
                
	}
	
	
	public function _cadastrarServicosAcompanhnate($dados) {
	
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
			
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
			
                        $serivicosAcompanhnate = new ServicosAcompanhante();
                        $serivicosAcompanhnate->setAcompanhanteId($atributoDados['acompanhanteId']);
                        $serivicosAcompanhnate->setServicoId($atributoDados['servicoId']);
                        $serivicosAcompanhnate->setValor($atributoDados['valor']);
                        
                        $serivicosAcompanhnate = $serivicosAcompanhnate->inserir();                        
                        $retornoDados[] = (array) $serivicosAcompanhnate;
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Servico da acompanhante cadastrado com sucesso");
			
			$this->retorno($arrayRetorno);
		}
		catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	
	}
        
        
	public function _cadastrarLocalizacaoServicoAcompanhante($dados){
	
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
			
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
                        
                        
                        $total = count($encoded["dados"]);
                        
                        for($i = 0 ; $i< $total; $i++){
                            $atributoDados = $encoded["dados"][$i];
                            //meuVarDump($atributoDados);
                            $localizacao = new Localizacao(0,
                                    $atributoDados['latitude'],
                                    $atributoDados['longitude'],
                                    $atributoDados['enderecoFormatado'], 
                                    $atributoDados['servicoAcompanhanteId']);
                            $localizacao = $localizacao->inserir();
                           
                            
                            /*$localizacao->setLatitude($atributoDados['latitude']);
                            $localizacao->setLongitude($atributoDados['longitude']);
                            $localizacao->setEnderecoFormatado($atributoDados['enderecoFormatado']);
                            $localizacao->setServicoAcompanhanteId($atributoDados['servicoAcompanhanteId']);
                            $localizacao = $localizacao->inserir();*/
                            
                            $retornoDados[] = (array) $localizacao;
                            
                        }
                        
                        /*if($encoded["dados"] > 1){
                            
                        }*/
			
                        
                        /*$localizacao = new Localizacao();
                        $localizacao->setLatitude($atributoDados['latitude']);
                        $localizacao->setLongitude($atributoDados['latitude']);
                        $localizacao->setEnderecoFormatado($atributoDados['enderecoFormatado']);
                        $localizacao->setServicoAcompanhanteId($atributoDados['servicoAcompanhanteId']);
                        $localizacao = $localizacao->inserir();*/
                        
                        $retornoDados[] = (array) $localizacao;
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Localizaao do servico da acompanhante cadastrado com sucesso");
			
			$this->retorno($arrayRetorno);
		}
		catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	
	}
        
        public function _listarServicoAcompanhante($dados) {
		try {
	

                        //COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
                        $jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
                        $encoded = json_decode($jsonDescriptografado, true);
                        $atributoDados = $encoded["dados"][0];
                        $atributoStatus = $encoded["status"];
                        $atributoMensagem = $encoded["mensagem"];	
                        
                        $acompanhante = Acompanhante::buscar($atributoDados['id']);

                        $lista = ServicosAcompanhante::listarPorAcompanhante($acompanhante); //::listarServicoAcompanhante($atributoDados['id']);
                        
                        
                        //$retornoDados[] = (array)$lista;

                        //meuVarDump($retornoDados);
                        
                        $arrayRetorno = $this->preencherArray($lista, 0, "listarServicoAcompanhante OK");
                        $this->retorno($arrayRetorno);
		} catch (Exception $e) {			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
                
	}
        
        
        
        public function _listarLocalizacaoServicoAcompanhante($dados) {
		try {
	
                        //COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
                        $jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
                        $encoded = json_decode($jsonDescriptografado, true);
                        $atributoDados = $encoded["dados"][0];
                        $atributoStatus = $encoded["status"];
                        $atributoMensagem = $encoded["mensagem"];	

                        $lista = Localizacao::listarPorServicoAcompanhanteId($atributoDados['id']);
                        //meuVarDump($lista);
                        
                        //$retornoDados[] = (array)$lista;

                        //meuVarDump($retornoDados);
                        
                        $arrayRetorno = $this->preencherArray($lista, 0, "listarLocalizacaoServicoAcompanhante OK");

                        $this->retorno($arrayRetorno);
		} catch (Exception $e) {			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
                
	}
	
}
?>