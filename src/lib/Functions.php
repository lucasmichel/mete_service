<?php
    /**
        * Função formataData($data)
        * Inverte o formato da data para o formato oposto
        * Formatos válidos: dd/mm/YYYY ou YYYY-mm-dd
        * @param $data
        * @return string
        */
    function formataData($dataEntrada){
            
            $data = explode(' ',$dataEntrada);
        
            $temp = explode('/',$data[0]);
            if(count($temp) == 3)
                    return $temp[2] . "-" . $temp[1] . "-" . $temp[0]. ' ' .$data[1];
            
            $temp = explode('-',$data[0]);
            
            $ano = $temp[0];
            $mes = $temp[1];
            $dia = substr($temp[2], 0, 2);
            
            return (count($temp) == 3) ? $dia . "/" . $mes . "/" . $ano . ' '. $data[1] : false;
    }

    function formataDataTime($dataTime){            
            $temp = explode('/',$dataTime);                
            if(count($temp) == 3)
                    return $temp[2] . "-" . $temp[1] . "-" . $temp[0];

            $temp = explode('-',$dataTime);                                
            $ano = $temp[0];
            $mes = $temp[1];
            $dia = substr($temp[2], 0, 2);
            $hora = substr($temp[2], 3);                
            /*echo $dia . "/" . $mes . "/" . $ano ." ". $hora;
            var_dump($temp);
            die();*/                
            return (count($temp) == 3) ? $dia . "/" . $mes . "/" . $ano ." ". $hora : false;
    }

    
    function formataDataParaInserir($data){
            $temp = explode('/',$data);
            
            $dia = $temp[0];
            $mes = $temp[1];            
            $ano = $temp[2];
            
            return (count($temp) == 3) ? $ano . "-" . $mes . "-" . $dia." 00:00:00" : false;
    }
    
    
    
    
    function getAcaoAtual(){
            if(empty($_GET['url']))
                    return 'index';
            return (count($temp = explode('/',$_GET['url'])) > 1) ? $temp[1] : 'index';
    }

        
    function chmodr($path, $filemode) { 
    if (!is_dir($path)) 
        return chmod($path, $filemode); 

    $dh = opendir($path); 
    while (($file = readdir($dh)) !== false) { 
        if($file != '.' && $file != '..') { 
            $fullpath = $path.'/'.$file; 
            if(is_link($fullpath)) 
                return FALSE; 
            elseif(!is_dir($fullpath) && !chmod($fullpath, $filemode)) 
                    return FALSE; 
            elseif(!chmodr($fullpath, $filemode)) 
                return FALSE; 
        } 
    } 

    closedir($dh); 

    if(chmod($path, $filemode)) 
        return TRUE; 
    else 
        return FALSE; 
    }
    
    
/*
* Copiar todos os arquivos e subdiretórios dentro de um diretório
* @Autor: Aidan Lister <aidan ARROBA php.net>
* @Tradução: Tiago Passos <voxtiago ARROBA gmail.com>
* @versão 1.0.1
* @parâmetro de origem: $source
* @parâmetro de destino: $dest
* @retorna TRUE se houver sucesso e FALSE se houver erro
* @Exemplo de uso: copyr("site","backup_site");
*/
 
function copyr($source, $dest)
{
   // COPIA UM ARQUIVO
   if (is_file($source)) {
      return copy($source, $dest);
   }
 
   // CRIA O DIRETÓRIO DE DESTINO
   if (!is_dir($dest)) {
      mkdir($dest);
      echo "DIRET&Oacute;RIO $dest CRIADO<br />";
   }
 
   // FAZ LOOP DENTRO DA PASTA
   $dir = dir($source);
   while (false !== $entry = $dir->read()) {
      // PULA "." e ".."
      if ($entry == '.' || $entry == '..') {
         continue;
      }
 
      // COPIA TUDO DENTRO DOS DIRETÓRIOS
      if ($dest !== "$source/$entry") {
         copyr("$source/$entry", "$dest/$entry");
         echo "COPIANDO $entry de $source para $dest <br />";
      }
   }
 
   $dir->close();
   return true;
 
}

//
/*
* Resume o texto e nao corta as palavras
* @Autor: lucas michel 

* @parâmetro: 
 *  $texto - texto a ser resumido
 *  $qnt - quantidade de palavras a ser cortado
* 
* retorna a string com a quantidade palavras e os ... no final.
* @Exemplo de uso: copyr("a casa é feia",1);
*/
define("STR_REDUCE_LEFT", 1);
define("STR_REDUCE_RIGHT", 2);
define("STR_REDUCE_CENTER", 4);

/**
 *  @autor: Carlos Reche
 *  @data:  Jan 21, 2005
 */
function str_reduce($str, $max_length, $append = NULL, $position = STR_REDUCE_RIGHT, $remove_extra_spaces = true)
{
    if (!is_string($str))
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "() expects parameter 1 to be string.";
        return false;
    }
    else if (!is_int($max_length))
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "() expects parameter 2 to be integer.";
        return false;
    }
    else if (!is_string($append)  &&  $append !== NULL)
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "() expects optional parameter 3 to be string.";
        return false;
    }
    else if (!is_int($position))
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "() expects optional parameter 4 to be integer.";
        return false;
    }
    else if (($position != STR_REDUCE_LEFT)  &&  ($position != STR_REDUCE_RIGHT)  &&
             ($position != STR_REDUCE_CENTER)  &&  ($position != (STR_REDUCE_LEFT | STR_REDUCE_RIGHT)))
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "(): The specified parameter '" . $position . "' is invalid.";
        return false;
    }


    if ($append === NULL)
    {
        $append = "...";
    }


    //$str = html_entity_decode($str);
    

    if ((bool)$remove_extra_spaces)
    {
        $str = preg_replace("/\s+/s", " ", trim($str));
    }


    if (strlen($str) <= $max_length)
    {
        //return htmlentities($str);
        return $str;
    }


    if ($position == STR_REDUCE_LEFT)
    {
        $str_reduced = preg_replace("/^.*?(\s.{0," . $max_length . "})$/s", "\\1", $str);

        while ((strlen($str_reduced) + strlen($append)) > $max_length)
        {
            $str_reduced = preg_replace("/^\s?[^\s]+(\s.*)$/s", "\\1", $str_reduced);
        }

        $str_reduced = $append . $str_reduced;
    }


    else if ($position == STR_REDUCE_RIGHT)
    {
        $str_reduced = preg_replace("/^(.{0," . $max_length . "}\s).*?$/s", "\\1", $str);

        while ((strlen($str_reduced) + strlen($append)) > $max_length)
        {
            $str_reduced = preg_replace("/^(.*?\s)[^\s]+\s?$/s", "\\1", $str_reduced);
        }

        $str_reduced .= $append;
    }


    else if ($position == (STR_REDUCE_LEFT | STR_REDUCE_RIGHT))
    {
        $offset = ceil((strlen($str) - $max_length) / 2);

        $str_reduced = preg_replace("/^.{0," . $offset . "}|.{0," . $offset . "}$/s", "", $str);
        $str_reduced = preg_replace("/^[^\s]+|[^\s]+$/s", "", $str_reduced);

        while ((strlen($str_reduced) + (2 * strlen($append))) > $max_length)
        {
            $str_reduced = preg_replace("/^(.*?\s)[^\s]+\s?$/s", "\\1", $str_reduced);

            if ((strlen($str_reduced) + (2 * strlen($append))) > $max_length)
            {
                $str_reduced = preg_replace("/^\s?[^\s]+(\s.*)$/s", "\\1", $str_reduced);
            }
        }

        $str_reduced = $append . $str_reduced . $append;
    }


    else if ($position == STR_REDUCE_CENTER)
    {
        $pattern = "/^(.{0," . floor($max_length / 2) . "}\s)|(\s.{0," . floor($max_length / 2) . "})$/s";

        preg_match_all($pattern, $str, $matches);

        $begin_chunk = $matches[0][0];
        $end_chunk   = $matches[0][1];

        while ((strlen($begin_chunk) + strlen($append) + strlen($end_chunk)) > $max_length)
        {
            $end_chunk = preg_replace("/^\s?[^\s]+(\s.*)$/s", "\\1", $end_chunk);

            if ((strlen($begin_chunk) + strlen($append) + strlen($end_chunk)) > $max_length)
            {
                $begin_chunk = preg_replace("/^(.*?\s)[^\s]+\s?$/s", "\\1", $begin_chunk);
            }
        }

        $str_reduced = $begin_chunk . $append . $end_chunk;
    }

    //return htmlentities($str_reduced);
    return $str_reduced;
}

function ziparArquivo()
{
    // Criando o objeto
    $z = new ZipArchive();
    // Criando o pacote chamado "teste.zip"
    $criou = $z->open('teste.zip', ZipArchive::CREATE);
    if ($criou === true) {
    // Criando um diretorio chamado "teste" dentro do pacote
    $z->addEmptyDir('teste');
    // Criando um TXT dentro do diretorio "teste" a partir do valor de uma string
    $z->addFromString('teste/texto.txt', 'Conteúdo do arquivo de Texto');
    // Criando outro TXT dentro do diretorio "teste"
    $z->addFromString('teste/outro.txt', 'Outro arquivo');
    // Copiando um arquivo do HD para o diretorio "teste" do pacote
    //$z->addFile('/opt/lampp/htdocs/ZIP/testfiles/aa.jpg','teste/aa.jpg');
    // Apagando o segundo TXT
    $z->deleteName('teste/outro.txt');
    // Salvando o arquivo
    $z->close();
    } else {
    echo 'Erro: '.$criou;
    }
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="teste.zip"');
    readfile('teste.zip');
    //unlink ('/opt/lampp/htdocs/ZIP/teste.zip');
    exit(0);
}

function listarCaminhoArquivo($caminhoPasta)
{
    
    $dir = opendir($caminhoPasta);
    if ($dir) {
        while (($item = readdir($dir)) !== false) {
            
            /*if($caminhoPasta == "/opt/lampp/htdocs/SGA/src/foto/Projeto-MNU/Area-BUU/Prospeccao-5"){
                echo '<pre>';
                var_dump($item);
                die();
            }*/

            if(($item!='.')&&($item!='..')){
                $objetos[] = $caminhoPasta.'/'.$item.'<br />';
                //echo $caminhoPasta.'/'.$item.'<br />';
            }            
        }    
        closedir($dir);
        //die();
    }
    
    
    
    if($objetos!=null)
        {
            return $objetos;
        }
    else
        {
            return null;
        }
    /*
    $listar = new RecursiveDirectoryIterator($caminhoPasta);
    $recursivo = new RecursiveIteratorIterator($listar);    
    
    
    
    if($caminhoPasta =="/opt/lampp/htdocs/SGA/src/foto/Projeto-MNU/Area-BUU/Prospeccao-2"){
        $recursivo2 = new RecursiveIteratorIterator($listar->getChildren());    
        echo '<pre> aqui aqui <br/>';
        var_dump($recursivo2);
        echo '<br />';
        
    }
     
    if($caminhoPasta =="/opt/lampp/htdocs/SGA/src/foto/Projeto-MNU/Area-BUU/Prospeccao-5"){
        echo '<pre>';
        var_dump($listar->);
        die();
    }
    
    
    //$recursivo = new RecursiveIteratorIterator($listar);
    //if(($listar->getFilename() != '..')&&($listar->getFilename() != '.'))
    if(($listar->getFilename() != '..'))
        {
            foreach($recursivo as $obj){            
                $objetos[] = $obj->getPathName();            
            }
            return $objetos;
        }
    else
        {
            return null;
        }
*/
}

function retornaNomeArquivo($caminho)
{
    $pieces = explode("/", $caminho);
    
    $nomeArquivo = $pieces[count($pieces)- 2];
    
    /*echo'<pre>';
    var_dump(count($pieces));
    echo'<br />';
    var_dump($pieces);
    echo'<br />';
    var_dump($nomeArquivo);
    die();*/
    
    return $nomeArquivo;
}


function meuVarDump($dados){
	echo'<pre>';
	var_dump($dados);
	die();
}



	
?>