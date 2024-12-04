<?php
include_once('../Model/Comentario.class.php');
include_once('../Model/Animal.class.php');

session_start();

$acao = $_GET['acao'];

if($acao=="postar"){

    $comentario= new Comentario();
    $comentario->setComentario($_POST['comentario']);
    $comentario->setPostagem($_POST['id']);
    $comentario->setUsuario($_SESSION['id']);
    $comentario->save();
    header('Location: ../View/VizualizarPostagem.php?id='. $_POST['id']);

}else if($acao == 'deletar'){

    $comentario=new Comentario();
    $comentario->setId($_REQUEST['id']);
    $comentario->load();
    $comentario->deletar();
    header('Location: ../View/VizualizarPostagem.php?id='. $comentario->getPostagem()->getId());
    
}else if ($acao == 'editar'){

    $comentario = new Comentario();
    $comentario->setId($_REQUEST['id']);
    $comentario->load();
    $comentario->setComentario($_REQUEST['comentario']);
    if($comentario->update() == true){
        header('Location: ../View/VizualizarPostagem.php?id='. $comentario->getPostagem()->getId());
    }else{
        header('Location: ../View/Postagem.php?error=1');
    }
}

?>