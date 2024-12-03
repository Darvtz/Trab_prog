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
    $comemtario->load();
    $comentario->deletar();
    header('Location: ../View/VizualizarPostagem.php?id='. $_POST['id']);
    
}else if ($acao == 'editar'){

    $comentario = new Comentario();
    $comentario->setId($_REQUEST['id']);
    $comentario->update();
}

?>