<?php
$acao = $_GET['acao'];
    
include_once '../Model/Usuario.class.php';
include_once '../Model/Cargo.class.php';

// Cadastrar no banco
if($acao='cadastrar'){
    $usuario=new Usuario();
    $cargo=new Cargo();
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $usuario->serSenha($_POST['senha']);
    $usuario->setDatanasc($_POST['Datanasc']);
    $usuario->setCelular($_POST['Celular']);
    $usuario->setDatacad(date('Y/m/d'));
    $cargo->setCargo($_POST['base']);
    $usuario->save();
    $cargo->save();
}else if($acao='deletar'){
    $usuario=new $Usuario();
    $usuario->setId($_REQUEST['id']);
    $usuario->deletar();
}
?>
