<?php

include('protect.php');
include_once('../Model/Animal.class.php');
include_once('../Model/Usuario.class.php');

$usuario = Usuario::getOne($_SESSION['id']);
$animais = Animal::getAll();
?>

<html lang="en">
<head>
   <title>Perfil de Usuário</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="" style="width: 18rem;">
    <img class="" src="fotos/<?= $usuario->getFoto()?>" alt="">
    <div class="card-body">
    <h2>Informações do Usuário</h2>
    <p>Nome: <?php echo $usuario->getNome(); ?></p>
    <p>Cadastrado em: <?php echo $usuario->getDatacad(); ?>
    <?php if($usuario->getId() == $_SESSION['id']){?>
    <p>Email: <?php echo $usuario->getEmail(); ?></p>
    <p>Telefone: <?php echo $usuario->getCelular(); ?></p>
    <p><a href="../View/logout.php">Logout</a></p>
    <?php } ?>
    </div>
    </div>


    <?php foreach($animais as $animal){?>
    <?php if($animal->getIdUsuario() == $_SESSION['id']){?>

    <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="fotos/<?= $animal->getImagem();?>" alt="Card image cap">
    <div class="card-body">
    <h5 class="card-title"><?= $animal->getNome();?></h5>
    <p class="card-text">Ultimo endereço visto: <?= $animal->getRua();?>, <?= $animal->getNumero();?>, <?= $animal->getCidade();?>, <?= $animal->getEstado();?></p>
    <p class="card-text"><?= $animal->getDescricao();?></p>
    <p class="card-text">Contato com o dono: </p>
    
    <a href="../View/VizualizarPostagem.php?id=<?= $animal->getId();?>" class="btn btn-primary">Ver Postagem</a>
    <?php 
        if ($animal->getIdUsuario() == $_SESSION['id']){
    ?> 
        <a href="../View/EditarPostagem.php?id=<?= $animal->getId();?>" class="btn btn-primary">Editar Postagem</a>

    <?php
        }
    ?>
    <a href="#" class="facebook-btn">
        <i class="fab fa-facebook"></i>
        </a>

        <a href="#" class="twitter-btn">
        <i class="fab fa-twitter"></i>
        </a>

        <a href="#" class="pinterest-btn">
        <i class="fab fa-pinterest"></i>
        </a>

        <a href="#" class="linkedin-btn">
        <i class="fab fa-linkedin"></i>
        </a>

        <a href="#" class="whatsapp-btn">
        <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    </div>
    <?php } }?>
</body>
</html>