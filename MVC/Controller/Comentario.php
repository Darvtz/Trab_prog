<?php
$acao = $_GET['acao'];

if($acao="postar"){

    $comentario=new Cometario();
    $comentario->setComentario($_POST['cometario']);
    $comentario->save();
    header('Location: ../View/VizualizarPostagem.php');

}else if($acao=='deletar'){
    $comentario=new Comentario();
    $comentario->setId($_REQUEST['id']);
    $comentario->deletar($id);
}

?>