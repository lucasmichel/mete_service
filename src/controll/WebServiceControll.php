<?php
class WebServiceControll extends Controll{
	
	public function WebServiceControll(){}
	
	
        public function calcularTempo($nomeFuncaoExecutada, $tempoInicio, $tempoFim){
            
            //echo $tempoInicio->format( "Y-m-d H:i:s" );
            //echo $tempoFim->format( "Y-m-d H:i:s" );
            
            $data_login = strtotime($tempoInicio->format( "Y-m-d H:i:s" ));
            $data_logout = strtotime($tempoFim->format( "Y-m-d H:i:s" ));

            /*$tempo_con = mktime($tempoFim->getTimestamp() - $tempoInicio->getTimestamp());
            meuVarDump($tempo_con);*/
            
            $tempo_con = mktime(
                date('H', $data_logout) - date('H', $data_login), date('i', $data_logout) - 
                date('i', $data_login), date('s', $data_logout) - date('s', $data_login)
            );
            
            $this->escreverArquivoLog($tempoInicio, $tempoFim, $nomeFuncaoExecutada, $tempo_con);
        }
        
        private function escreverArquivoLog($dtInicio, $dtFim, $nomeFuncao, $resultado){
            
            
            $arq = $_SERVER["DOCUMENT_ROOT"] . BASE."/img/".$nomeFuncao.$dtInicio->format( "d-m-Y H:i:s" ).".txt";
            
            
            
            if($novoarquivo = fopen($arq, "w+")){
                            
                fwrite($novoarquivo, "Funcao: ".$nomeFuncao." ...\n");
                fwrite($novoarquivo, "Início: ".$dtInicio->format( "d/m/Y H:i:s" )." ...\n");
                fwrite($novoarquivo, "Fim: ".$dtFim->format( "d/m/Y H:i:s" )." ...\n");
                fwrite($novoarquivo, "Tempo gasto: ".date('H:i:s', $resultado)." ...\n");

                fclose($novoarquivo);
                chmod ($arq, 0777);



                //$link = $path_a_tu_doc."/".$id;
                $link = $arq;
                header ("Content-Disposition: attachment; filename=dados.txt");
                header ("Content-Type: application/octet-stream");
                header ("Content-Length: ".filesize($link));
                readfile($link);
                echo "Tudo concluído!";
                //unlink($arq);
                
            }
            else{
                echo 'nao pode criar o arquivo';
            }

            
            
            
        }
        
        function objectToArrayNovo($d) {
			if (is_object($d)) {
				// Gets the properties of the given object
				// with get_object_vars function
				$d = get_object_vars($d);
			}
	 
			if (is_array($d)) {
				/*
				* Return array converted to object
				* Using __FUNCTION__ (Magic constant)
				* for recursive call
				*/
				return array_map(__FUNCTION__, $d);
			}
			else {
				// Return array
				return $d;
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
			
			$retornoDados[] = Acompanhante::objetoParaArray($acompanhante);
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

                        $retornoDados[] = Acompanhante::objetoParaArray($acompanhante);
			
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
			$acompanhante = $acompanhante->buscar($atributoDados['id']);
			$acompanhante = $acompanhante->excluir();
			
                        $retornoDados[] = Acompanhante::objetoParaArray($acompanhante);
                        
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
			$acompanhante = $acompanhante->buscarPorIdUsuario($atributoDados['idUsuario']);
			$acompanhante = $acompanhante2->excluirPorIdUsuario();
			
			$retornoDados[] = Acompanhante::objetoParaArray($acompanhante);
			
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
			$acompanhante = $acompanhante->buscarPorIdUsuario($atributoDados['id']);
			
                        $retornoDados[] = Acompanhante::objetoParaArray($acompanhante);
                        
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
                        $retornoDados[] = Acompanhante::obetoParaArray($acompanhante);
                        
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
                        
                        
                        $retornoDados[] = Cliente::objetoParaArray($cliente);
                        
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
			
                        $retornoDados[] = Cliente::objetoParaArray($cliente);
			
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
			
                        $retornoDados[] = Cliente::objetoParaArray($cliente);
                        
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
			$cliente = $cliente->buscarPorIdUsuario($atributoDados['idUsuario']);
			$cliente = $cliente->excluirPorIdUsuario();
			
                        $retornoDados[] = Cliente::objetoParaArray($cliente);
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
                        
                        $retornoDados[] = Cliente::objetoParaArray($cliente);
                        	
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
			
                        $retornoDados[] = Cliente::objetoParaArray($cliente);
                        
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
			
			//meuVarDump($jsonDescriptografado);
			
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];	
			
			
			
			//meuVarDump($encoded);			
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			//$to = count($encoded["dados"]);
			//meuVarDump($to);
			/*CONTA O TOTAL DE INTENS VINDOS NO ARRAY*/
			
			$usuario = Usuario::logarAndroid($atributoDados['email'], $atributoDados['senha']);
			$retornoDados[] = $usuario;
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
                        
                        $retornoDados[] = Fotos::objetoParaArray($foto);
			
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
                        $retornoDados[] = ServicosAcompanhante::objetoParaArray($serivicosAcompanhnate);
                        
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
                            
                            $retornoDados[] = Localizacao::objetoParaArray($localizacao);
                            
                        }
                        
                        /*if($encoded["dados"] > 1){
                            
                        }*/
			
                        
                        /*$localizacao = new Localizacao();
                        $localizacao->setLatitude($atributoDados['latitude']);
                        $localizacao->setLongitude($atributoDados['latitude']);
                        $localizacao->setEnderecoFormatado($atributoDados['enderecoFormatado']);
                        $localizacao->setServicoAcompanhanteId($atributoDados['servicoAcompanhanteId']);
                        $localizacao = $localizacao->inserir();*/
                        
                        $retornoDados[] = Localizacao::objetoParaArray($localizacao);
                        
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

                        $lista = ServicosAcompanhante::listarPorAcompanhanteWebService($acompanhante); //::listarServicoAcompanhante($atributoDados['id']);
                        
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

                        $lista = Localizacao::listarPorServicoAcompanhanteIdWebService($atributoDados['id']);
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
        
        public function _teste($dados) {
            try {
                
                    $usuario = Usuario::logarAndroid($dados['email'], $dados['senha']);
                    
                    //echo json_encode(array($usuario));
                    $user = Usuario::objetoParaArray($usuario);
                    
                    $retorno = Array();
                    $retorno["msgm"] = "Login OK";
                    $retorno["status"] = 0;
                    $retorno["dados"] = $user;
                    echo json_encode($retorno);
                    /*header('Cache-Control: no-cache, must-revalidate');
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                    header('Content-type: application/json');
                    $a = json_encode($retorno,true);
                    echo $a;*/
                    
                    //echo "oK";
                    //COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
                    /*$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
                    $encoded = json_decode($jsonDescriptografado, true);
                    $atributoDados = $encoded["dados"][0];
                    $atributoStatus = $encoded["status"];
                    $atributoMensagem = $encoded["mensagem"];	

                    $usuario = Usuario::logarAndroid($atributoDados['email'], $atributoDados['senha']);
			
                    $retornoDados[] = (array) $usuario;
                        
                    $arrayRetorno = $this->preencherArray($retornoDados, 0, "Usuário logado com sucesso");
			
                    $this->retorno($arrayRetorno);*/
                    
		} catch (Exception $e) {			
                    //$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
                    //$this->retorno($arrayRetorno);
                    //echo $e->getMessage();
                    //json_encode(array("msgm"=>"".$e->getMessage()."","status"=>"1","dados"=>"null"));
                    /*$retorno["msgm"] = $e->getMessage();
                    $retorno["status"] = 1;
                    $retorno["dados"] = null;
                    header('Cache-Control: no-cache, must-revalidate');
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                    header('Content-type: application/json');
                    $a = json_encode($retorno,true);
                    echo $a;*/
                    
                    $retorno = Array();
                    $retorno["msgm"] = $e->getMessage();
                    $retorno["status"] = 1;
                    $retorno["dados"] = null;
                    echo json_encode($retorno);
                    
		}
        }
        
        public function _testeListar($dados) {
            try {
                
                    $lista = Acompanhante::listarParaWebService();
                    
                    //echo json_encode(array($usuario));
                    $user = array($lista);
                    
                    $retorno = Array();
                    $retorno["msgm"] = "Login OK";
                    $retorno["status"] = 0;
                    $retorno["dados"] = $user;
                    echo json_encode($retorno);
                    /*header('Cache-Control: no-cache, must-revalidate');
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                    header('Content-type: application/json');
                    $a = json_encode($retorno,true);
                    echo $a;*/
                    
                    //echo "oK";
                    //COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
                    /*$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
                    $encoded = json_decode($jsonDescriptografado, true);
                    $atributoDados = $encoded["dados"][0];
                    $atributoStatus = $encoded["status"];
                    $atributoMensagem = $encoded["mensagem"];	

                    $usuario = Usuario::logarAndroid($atributoDados['email'], $atributoDados['senha']);
			
                    $retornoDados[] = (array) $usuario;
                        
                    $arrayRetorno = $this->preencherArray($retornoDados, 0, "Usuário logado com sucesso");
			
                    $this->retorno($arrayRetorno);*/
                    
		} catch (Exception $e) {			
                    //$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
                    //$this->retorno($arrayRetorno);
                    //echo $e->getMessage();
                    //json_encode(array("msgm"=>"".$e->getMessage()."","status"=>"1","dados"=>"null"));
                    /*$retorno["msgm"] = $e->getMessage();
                    $retorno["status"] = 1;
                    $retorno["dados"] = null;
                    header('Cache-Control: no-cache, must-revalidate');
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                    header('Content-type: application/json');
                    $a = json_encode($retorno,true);
                    echo $a;*/
                    
                    $retorno = Array();
                    $retorno["msgm"] = $e->getMessage();
                    $retorno["status"] = 1;
                    $retorno["dados"] = null;
                    echo json_encode($retorno);
                    
		}
        }
        
        public function _testeListarServico($dados) {
            try {
                
                    $lista = Servico::listar($ordenarPor);
                    
                    //echo json_encode(array($usuario));
                    $user = array($lista);
                    
                    $retorno = Array();
                    $retorno["msgm"] = "Login OK";
                    $retorno["status"] = 0;
                    $retorno["dados"] = $user;
                    echo json_encode($retorno);
                    /*header('Cache-Control: no-cache, must-revalidate');
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                    header('Content-type: application/json');
                    $a = json_encode($retorno,true);
                    echo $a;*/
                    
                    //echo "oK";
                    //COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
                    /*$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
                    $encoded = json_decode($jsonDescriptografado, true);
                    $atributoDados = $encoded["dados"][0];
                    $atributoStatus = $encoded["status"];
                    $atributoMensagem = $encoded["mensagem"];	

                    $usuario = Usuario::logarAndroid($atributoDados['email'], $atributoDados['senha']);
			
                    $retornoDados[] = (array) $usuario;
                        
                    $arrayRetorno = $this->preencherArray($retornoDados, 0, "Usuário logado com sucesso");
			
                    $this->retorno($arrayRetorno);*/
                    
		} catch (Exception $e) {			
                    //$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
                    //$this->retorno($arrayRetorno);
                    //echo $e->getMessage();
                    //json_encode(array("msgm"=>"".$e->getMessage()."","status"=>"1","dados"=>"null"));
                    /*$retorno["msgm"] = $e->getMessage();
                    $retorno["status"] = 1;
                    $retorno["dados"] = null;
                    header('Cache-Control: no-cache, must-revalidate');
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                    header('Content-type: application/json');
                    $a = json_encode($retorno,true);
                    echo $a;*/
                    
                    $retorno = Array();
                    $retorno["msgm"] = $e->getMessage();
                    $retorno["status"] = 1;
                    $retorno["dados"] = null;
                    echo json_encode($retorno);
                    
		}
        }
        
        
        
        public function _excluirAcompanhantePerformance($dados) {
            try {
                    $acompanhante = Acompanhante::buscar($dados['id']);
                    $acompanhante->excluir();
                    
		} catch (Exception $e) {			
                    echo $e->getMessage();
		}
        }
        
        
        public function _excluirClientePerformance($dados) {
            try {
                    $acompanhante = Cliente::buscar($dados['id']);
                    $acompanhante->excluir();
                    
		} catch (Exception $e) {			
                    echo $e->getMessage();
		}
        }
        
        public function _excluirFoto($dados) {
            
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
		
                    $obj = new Fotos();
                    $obj = $obj->buscar($atributoDados['id']);
                    $obj = $obj->excluir();
			
                    $retornoDados[] = Fotos::objetoParaArray($obj);                        
		    $arrayRetorno = $this->preencherArray($retornoDados, 0, "Foto excluída com sucesso!");
                    $this->retorno($arrayRetorno);
	
		} catch (Exception $e) {
						
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
            
            
            try {
                    $foto = Fotos::buscar($dados['id']);
                    $foto->excluir();
                    
		} catch (Exception $e) {			
                    echo $e->getMessage();
		}
        }
        
        public function _cadastrarEncontro($dados) {
	
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
                        
                        $encontro = new Encontro();
                        $encontro->setClienteId($atributoDados["clienteId"]);
                        $encontro->setDataHorario($atributoDados["dataHora"]);
                        $encontro->setExcluido(0);
                        $encontro = $encontro->inserir();
                        
                        $retornoDados[] = Encontro::objetoParaArray($encontro);
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Encontro cadastrado com sucesso");
			
			$this->retorno($arrayRetorno);
		}
		catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	
	}
        
        
        public function _cadastrarServicosDoEncontro($dados) {
	
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
                        
			//$atributoDados = $encoded["dados"][0];
			$atributoDados = $encoded["dados"];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];
                        
                        /*var_dump($atributoDados[0]);
                        die();*/
                        
			foreach ($atributoDados[0] as $value) {
                            
                            
                            $servicoAcompanhante = ServicosAcompanhante::buscar($value["servicoAcompanhanteId"]);
                            
                            
                            
                            $servicosDoEncontro = new ServicosDoEncontro();
                            $servicosDoEncontro->setServicoId($servicoAcompanhante->getServicoId());
                            $servicosDoEncontro->setAcompanhanteId($servicoAcompanhante->getAcompanhanteId());
                            
                            $servicosDoEncontro->setServicosAcompanhanteId($value["servicoAcompanhanteId"]);
                            $servicosDoEncontro->setClienteId($value["clienteId"]);
                            $servicosDoEncontro->setEncontroId($value["encontroId"]);
                            $servicosDoEncontro->setAprovado(1);
                            $servicosDoEncontro->setExcluido(0);
                            $servicosDoEncontro->inserir();
                            $retornoDados[] = ServicosDoEncontro::objetoParaArray($servicosDoEncontro);
                        }
                        
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Servicos do encontro cadastrado com sucesso");
			$this->retorno($arrayRetorno);
		}
		catch (Exception $e) {			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	
	}
        
        
        public function _excluirServicoAcompanhante($dados) {
		try {
			//COM TRUE NO FINAL È PRA OBJETO $encoded = json_decode($jsonDescriptografado, true);
			$jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];                        
                        
			$servicosAcompanhnate = ServicosAcompanhante::buscar($atributoDados['id']);
                        $servicosAcompanhnate = $servicosAcompanhnate->excluir();
                        
                        $retornoDados[] = ServicosAcompanhante::objetoParaArray($servicosAcompanhnate);			
			$arrayRetorno = $this->preencherArray($retornoDados, 0, "Servico da acompanhnate excluído com sucesso!");
			$this->retorno($arrayRetorno);
                        	
		} catch (Exception $e) {
			
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			
			$this->retorno($arrayRetorno);
		}
	}
        
        public function _listarServicosDoEncontro($dados) {
            
		try {
                    
                        $jsonDescriptografado = base64_decode($dados["textoCriptografado"]);
			$encoded = json_decode($jsonDescriptografado, true);
			$atributoDados = $encoded["dados"][0];
			$atributoStatus = $encoded["status"];
			$atributoMensagem = $encoded["mensagem"];                        
                        
                        $encontro = Encontro::buscar($atributoDados['id']);
                        
			$arrayRetornoLista = ServicosDoEncontro::listarPorEcontro($encontro);
                        
                        foreach ($arrayRetornoLista as $servicosDoEncontro) {
                            $retornoDados[] = ServicosDoEncontro::objetoParaArray($servicosDoEncontro);
                        }
                        
                        //$retornoDados[] =(array) $arrayRetornoLista;
                        $arrayRetorno = $this->preencherArray($retornoDados, 0, "Servicos localizados!");
                        $this->retorno($arrayRetorno);
                        
		} catch (Exception $e) {
			$arrayRetorno = $this->preencherArray(null, 1, $e->getMessage());
			$this->retorno($arrayRetorno);
		}
	}
        
        
}
?>

