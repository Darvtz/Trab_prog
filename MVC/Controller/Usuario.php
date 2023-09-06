<?php
$acao = $_GET['acao'];
    
include_once '../Model/Usuario.class.php';

// Cadastrar no banco
if($acao='cadastrar'){
    $usuario=new Usuario();
    $papel=new Papel();
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $usuario->serSenha($_POST['senha']);
    $usuario->setDatanasc($_POST['Datanasc']);
    $usuario->setCelular($_POST['Celular']);
    $usuario->setDatacad(date('Y/m/d'));
    $papel->setPapel($_POST['base']);
    $usuario->save();
    $papel->save();
}else if($acao='deletar'){
    $usuario=new $Usuario();
    $usuario->setId($_REQUEST['id']);
    $usuario->deletar();
}
?>