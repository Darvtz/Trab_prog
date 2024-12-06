<?php
session_start();
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
    $animal->setEstado($_POST['estado']);
    $animal->setCidade($_POST['cidade']);
    $animal->setRua($_POST['rua']);
    $animal->setNumero($_POST['numero']);
    $animal->setContato($_POST['contato']);
    $animal->setDescricao($_POST['descricao']);
    $imagem = enviarArquivo($_POST['arquivo']);
    if($imagem){
        $animal->setImagem($imagem);
    }
    $animal->setIdUsuario($_SESSION['id']);
    //$animal->save();

    if($animal->save() == true){
        header('Location: ../View/TelaInicial.php');
    }else{
        header('Location: ../View/Postagem.php?error=1');
    }
    
}else if($acao=='deletar'){

    $animal=new Animal();
    $animal->setId($_REQUEST['id']);
    $animal->deletar();

}else if($acao='editar'){

    $animal = Animal::getOne($_REQUEST['id']);
    $animal->setNome($_POST['nome']);
    $animal->setEspecie($_POST['especie']);
    $animal->setRaca($_POST['raca']);
    $animal->setGenero($_POST['genero']);
    $animal->setCor($_POST['cor']);
    $animal->setEstado($_POST['estado']);
    $animal->setCidade($_POST['cidade']);
    $animal->setRua($_POST['rua']);
    $animal->setNumero($_POST['numero']);
    $animal->setContato($_POST['contato']);
    $animal->setDescricao($_POST['descricao']);
    if(isset($_FILES['arquivo']) && !$_FILES['arquivo']['error']){
        $imagem = enviarArquivo('arquivo');
        if($imagem){
            $animal->setImagem($imagem);
        }
    }
    $animal->setIdUsuario($_SESSION['id']);

    if($animal->update() == true){
        header('Location: ../View/TelaInicial.php');
    }else{
        header('Location: ../View/Postagem.php?error=1');
    }
    
}
?>