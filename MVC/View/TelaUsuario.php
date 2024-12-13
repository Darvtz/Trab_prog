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
            justify-content: center !important;
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

        /* Tornando o card do usuário mais largo */
        .card-usuario {
            max-width: 80rem; /* Largura maior para o card do usuário */
        }

        /* Ajustando o layout dos cards de animais para ocupar o mínimo de espaço possível */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* Menor espaço entre os cards */
            justify-content: flex-start; /* Alinhamento à esquerda para evitar muito espaço */
        }

        .card {
            width: 15rem; /* Cards menores para ocupar menos espaço */
        }

        .card-body {
            padding: 10px; /* Menos padding para os cards de animais */
        }

        .btn-share {
            margin-top: 10px;
            display: inline-block;
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
            <ul class="navbar-nav ms-auto"> <!-- Aqui foi adicionado ms-auto para alinhar à direita -->
                <li class="nav-item">
                    <a class="nav-link active" href="../View/logout.php">Sair do sistema</a>
                </li>
            </ul>
            <?php if(isset($_SESSION['ADMIN'])){?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="../View/PostagensOcultas.php?id=<?=$_SESSION['id'];?>">Postagens Ocultas</a>
                </li>
            </ul>
            <?php } ?>               
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

    <div class="card-container">
    <?php foreach ($animais as $animal){ ?>
        <?php if ($animal->getIdUsuario() == $_REQUEST['id']){ ?>
            <div class="card">
                <img class="card-img-top" src="fotos/<?= $animal->getImagem(); ?>" alt="Card image cap">
                <div class="card-body">
                    <h4><a href="TelaUsuario.php?id=<?= $animal->getIdUsuario() ?>"><?php echo $animal->getUsuario()->getNome(); ?></a></h4>
                    <h5 class="card-title"><?= $animal->getNome(); ?></h5>
                    <p class="card-text">Último endereço visto: </br> <?= $animal->getRua(); ?>, <?= $animal->getNumero(); ?>, <?= $animal->getCidade(); ?>, <?= $animal->getEstado(); ?></p>
                    <p class="card-text"><?= $animal->getDescricao(); ?></p>
                    <p class="card-text">Contato com o dono: <?php echo $animal->getContato(); ?></p>

                    <a href="../View/VizualizarPostagem.php?id=<?= $animal->getId(); ?>" class="btn btn-primary">Ver Postagem</a></br></br>
                    
                    <!-- Verifica se o usuário logado é o proprietário da postagem -->
                    <?php if ($animal->getIdUsuario() == $_SESSION['id']): ?> 
                        <a href="../View/EditarPostagem.php?acao=editar&id=<?= $animal->getId(); ?>" class="btn btn-primary">Editar Postagem</a></br></br>
                        <a href="../Controller/Postagem.php?acao=deletar&id=<?= $animal->getId(); ?>" class="btn btn-primary">Deletar Postagem</a></br></br>
                    <?php endif; ?> 

                    <!-- Verifica se o usuário tem permissão de administrador -->
                    <?php if (isset($_SESSION['ADMIN'])): ?>
                        <?php if ($animal->getOculto() == false): ?>
                            <a href="../Controller/Adm.php?acao=ocultar&id=<?= $animal->getId(); ?>" class="btn btn-primary">Ocultar Postagem</a>
                        <?php endif; ?>
                        <?php if ($animal->getOculto() == true): ?>
                            <a href="../Controller/Adm.php?acao=mostrar&id=<?= $animal->getId(); ?>" class="btn btn-primary">Mostrar Postagem</a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Botões de compartilhamento -->
                    <div class="btn-share">
                        <p>Compartilhar:</p>
                        <a class="btn btn-primary" data-rede="twitter" href="https://twitter.com/share?url=https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId(); ?>&text=Há um animal perdido!" target="_blank" title="Twittar postagem">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a class="btn btn-primary" data-rede="facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId(); ?>" target="_blank">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a class="btn btn-success" data-rede="whats" href="https://api.whatsapp.com/send?text=Há um animal perdido! Veja em https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId(); ?>&" target="_blank">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a class="btn btn-primary" data-rede="telegram" href="https://telegram.me/share/url?url=https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId(); ?>&&text=Há um animal perdido!" target="_blank">
                            <i class="fab fa-telegram-plane"></i> Telegram
                        </a>
                        <a class="btn btn-dark btn-shared mx-2 share" data-rede="email" href="mailto:?subject=Preciso de sua ajuda!&body=Há um animal perdido! em https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId(); ?>&">
                            <i class="fas fa-envelope"></i> E-Mail
                        </a>
                    </div>
                </div>
            </div>
        <?php  } ?>
    <?php  } ?>
</div>

</body>
</html>
