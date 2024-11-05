<?php
include_once('../Model/Comentario.class.php');
include_once('../Model/Animal.class.php');

$acao = $_GET['acao'];

if($acao="postar"){

    $comentario= new Comentario();
    $comentario->setComentario($_POST['cometario']);
    $comentario->save();
    header('Location: ../View/VizualizarPostagem.php?id='. $animal->getId());

}else if($acao=='deletar'){
    $comentario=new Comentario();
    $comentario->setId($_REQUEST['id']);
    $comentario->deletar($id);
}

?>