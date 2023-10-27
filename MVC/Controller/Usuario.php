<?php
$acao = $_GET['acao'];
    
include_once '../Model/Usuario.class.php';
include_once '../Model/Cargo.class.php';

$hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Cadastrar no banco
if($acao='cadastrar'){
    $usuario=new Usuario();
    $usuario->setCpf($_POST['cpf']);
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($hash);
    $usuario->setDatanasc($_POST['Data']);
    $usuario->setCelular($_POST['celular']);
    $usuario->setDatacad(date('Y/m/d'));
    $usuario->save();
}else if($acao='deletar'){
    $usuario=new Usuario();
    $usuario->setId($_REQUEST['id']);
    $usuario->deletar();
}
?>
