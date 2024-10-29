<?php

include('protect.php');
include_once('../Model/Animal.class.php');
include_once('../Model/Usuario.class.php');

if(!isset($_SESSION)){
    session_start();
}

$usuario = Usuario::getOne($_SESSION['id']);
?>

<html lang="en">
<head>
   <title>Profile Page</title>
</head>
<body>
    <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="fotos/<?= $usuario->getFoto()?>" alt="Card image cap">
    <div class="card-body">
    <h2>Informações do Usuário</h2>
    <p>Nome: <?php echo $usuario->getNome(); ?></p>
    <p>Email: <?php echo $usuario->getEmail(); ?></p>
    <p>Telefone: <?php echo $usuario->getCelular(); ?></p>
    <p>Cadastrado em: <?php echo $usuario->getDatacad(); ?><p>
    <p><a href="../View/logout.php">Logout</a></p>
</body>
</html>