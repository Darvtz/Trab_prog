<?php

include('protect.php');
include_once('../Model/Animal.class.php');
include_once('../Model/Usuario.class.php');

if(!isset($_SESSION)){
    session_start();
}

$usuarios = Usuario::getOne();
?>

<html lang="en">
<head>
   <title>Profile Page</title>
</head>
<body>
    <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="fotos/<?= $lista[$usuario->getFoto()]?>" alt="Card image cap">
    <div class="card-body">
    <h2>Informações do Usuário</h2>
    <p>Nome: <?php echo $lista[$usuario->getNome()]; ?></p>
    <p>Email: <?php echo $lista[$usuario->getEmail()]; ?></p>
    <p>Telefone: <?php echo $lista[$usuario->getCelular()]; ?></p>
    <p>Cadastrado em: <?php echo $lista[$usuario->getDatacad()] ?><p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>