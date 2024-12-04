<?php
session_start();
$acao = $_GET['acao'];

include_once('../Model/Usuario.class.php');

if($acao=="banir"){

    $usuario = Usuario::getOne($_REQUEST['id']);
    if($usuario->getId() == $_REQUEST['id']){
        $usuario->setBanido(true);
        if($usuario->update() == true){
            header("../View/index.php");
        }
    }
}