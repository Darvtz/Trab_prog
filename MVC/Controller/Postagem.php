<?php
$acao = $_GET['acao'];
    
include_once '../Model/Animal.class.php';

function enviarArquivo($nomeInputFile, $size = 2097152){
    echo '<pre>';
    if(isset($_FILES[$nomeInputFile])){

        $arquivo = $_FILES["arquivo"];
        
        if($arquivo['error'])
        die("Falha ao enviar o arquivo");
        
        if($arquivo['size'] > $size)
        die("Arquivo muito grande!");
        
        $pasta = __DIR__. "/../View/fotos/";
        $novoNomeDoArquivo = uniqid();

    
            $path = $pasta . $novoNomeDoArquivo . ".jpg" ;
            var_dump($path);
            $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

            if($deu_certo){                    
                return $novoNomeDoArquivo . ".jpg";
            }else{
                die('Não pude enviar a imagem');
                return false;
            }
        }
        return false;

    
}


// Cadastrar no banco
if($acao=='postar'){
    $animal=new Animal();
    $animal->setNome($_POST['nome']);
    $animal->setEspecie($_POST['especie']);
    $animal->setRaca($_POST['raca']);
    $animal->setGenero($_POST['genero']);
    $animal->setCor($_POST['cor']);
    $animal->setUltimoEndereco($_POST['ultimoEndereco']);
    $animal->setDescricao($_POST['descricao']);
    $imagem = enviarArquivo('arquivo');
    if($imagem){
        $animal->setImagem($imagem);
    }
    $animal->save();
    
}else if($acao=='deletar'){
    $animal=new Animal();
    $animal>setId($_REQUEST['id']);
    $animal->deletar();
}
?>