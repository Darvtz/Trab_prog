<?php

include_once '../View/protect.php';
include_once('../Model/Animal.class.php');
include_once('../Model/Usuario.class.php');
include_once('../Model/Cargo.class.php');

if(!isset($_SESSION)){
    session_start();
}

if(isset($_GET['id'])){
    $usuario = Usuario::getOne($_GET['id']);    
}else{
    $usuario = Usuario::getOne($_SESSION['id']);
}

$animais = Animal::getAll();
?>

<html lang="en">
<head>
   <title>Perfil de Usuário</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .foto-usuario {
            display: flex;
            justify-content: center !important;;   
            width: 150px !important;
            height: 150px !important;
            object-fit: cover !important;
            border-radius: 50% !important;
            border: 3px solid #fff !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        }

        .foto-usuario:hover {
        transform: scale(1.1); /* Aumenta ligeiramente a imagem ao passar o mouse */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Aumenta a sombra ao passar o mouse */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">GPetS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="../View/TelaInicial.php">Tela Inicial</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="card" style="width: 60rem;">
    <img class="foto-usuario" src="fotos/<?= $usuario->getFoto()?>" alt="">
    <div class="card-body">
    <?php if(isset($_SESSION['ADMIN'])){?>
        <a href = "../Controller/Adm.php?acao=banir&id=<?= $usuario->getId()?>" class="btn btn-primary">Banir Usuario</a>
    <?php } ?>
    <h2><?php echo $usuario->getNome();?></h2>
    <p>Entrou em: <?php date_default_timezone_set('UTC'); echo date($usuario->getDatacad()); ?>

    <?php if($usuario->getId() == $_SESSION['id']){?>
    <p>Email: <?php echo $usuario->getEmail(); ?></p>
    <a href="../View/EditarUsuario.php?acao=editar&id=<?=$_SESSION['id'];?>" class="btn btn-primary">Editar Dados</a></br></br>
    <?php } ?>
    </div>
    </div>


    <?php foreach($animais as $animal){?>
    <?php if($animal->getIdUsuario() == $_REQUEST['id']){?>

    <div class="card" style="width: 19rem;">
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