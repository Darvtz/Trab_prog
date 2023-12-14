<?php
$acao = $_GET['acao'];
    
include_once '../Model/Usuario.class.php';
include_once '../Model/Cargo.class.php';



// Cadastrar no banco
if($acao=='cadastrar'){
    $usuario=new Usuario();
    $usuario->setCpf($_POST['cpf']);
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $usuario->setSenha($hash);
    $usuario->setDatanasc($_POST['Data']);
    $usuario->setCelular($_POST['celular']);
    $usuario->setDatacad(date('Y/m/d'));
    $usuario->save();
    header('Location: ../View/Index.php');
}else if($acao=='deletar'){
    $usuario=new Usuario();
    $usuario->setId($_REQUEST['id']);
    $usuario->deletar();
}else if($acao=='logar'){
    $usuario = new Usuario();

    $usuario->setEmail($_POST['email']);
    $usuario->loadByEmail();

    echo '<pre>';
    var_dump($usuario);

    if(password_verify($_POST['senha'], $usuario->getSenha())){
    //    echo 'logado';
        header('Location: ../View/TelaInicial.php');

        session_start();
        $_SESSION['id'] = $usuario->getId();
        $_SESSION['nome'] = $usuario->getNome();
    }
}
?>
