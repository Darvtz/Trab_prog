<?php

$acao = $_GET['acao'];

include('Usuario.class.php');

if($acao=="banir"){

    $usuario = new Usuario::getOne($_REQUEST['id']);
    if($usuario->getId() == $_REQUEST['id']){
        $usuario->setBanido(true);
        $usuario->save();
    }
}