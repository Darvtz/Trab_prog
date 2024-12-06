<?php

include('protect.php');
include_once('../Model/Animal.class.php');
include_once('../Model/Usuario.class.php');

$animais = Animal::getAll();
$usuarios = Usuario::getAll();

if(isset($_POST['search'])){
  $animais = Animal::getBusca($_POST['search']);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>GPetS</title>
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
                        <a class="nav-link active" href="../View/TelaUsuario.php?id=<?=$_SESSION['id'];?>">Tela do Usuário</a>
                    </li>
                    <?php if(isset($_SESSION['ADMIN'])){?>
                    <li class="nav-item">
                        <a class="nav-link active" href="../View/PostagensOcultas.php?id=<?=$_SESSION['id'];?>">Postagens Ocultas</a>
                    </li>
                    <?php } ?>
                    <li>
                      <p><a class="nav-link active" href="../View/logout.php">Logout</a></p>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>
    
  <h1></p1>Seja bem vindo, <?php echo $_SESSION['nome']; ?></h1>

  <form method="POST" >
    <input type="text" name="search" required>
    <input type="submit" value="Pesquisar">
  </form>

  <p>
    <a href="../View/Postagem.php"  class="btn btn-primary">Fazer uma postagem</a>
  </p>

  <?php foreach($animais as $animal){ 
    ?>
  <div class="card" style="width: 19rem;">
  <img class="card-img-top" src="fotos/<?= $animal->getImagem();?>" alt="Card image cap">
  <div class="card-body">
    
    <h4><a href="TelaUsuario.php?id=<?= $animal->getIdUsuario()?>"><?php echo $animal->getUsuario()->getNome(); ?></a></h4>
    <h5 class="card-title"><?= $animal->getNome();?></h5>
    <p class="card-text">Ultimo endereço visto: <?= $animal->getRua();?>, <?= $animal->getNumero();?>, <?= $animal->getCidade();?>, <?= $animal->getEstado();?></p>
    <p class="card-text"><?= $animal->getDescricao();?></p>
    <p class="card-text">Contato com o dono: <?php echo $animal->getContato(); ?></p>
    
    <a href="../View/VizualizarPostagem.php?id=<?= $animal->getId();?>" class="btn btn-primary">Ver Postagem</a></br></br>
    <?php 
      if ($animal->getIdUsuario() == $_SESSION['id']){
    ?> 
      <a href="../View/EditarPostagem.php?acao=editar&id=<?= $animal->getId();?>" class="btn btn-primary">Editar Postagem</a></br></br>
      <a href="../Controller/Postagem.php?acao=deletar&id=<?= $animal->getId();?>" class="btn btn-primary">Deletar Postagem</a></br></br>
    <?php
      }
    ?> 
    
    <?php if(isset($_SESSION['ADMIN'])){?>
      <?php if($animal->getOculto()==false){ ?>
        <a href = "../Controller/Adm.php?acao=ocultar&id=<?= $animal->getId();?>" class="btn btn-primary">Ocultar Postagem</a>
        <?php } ?>
        <?php if($animal->getOculto()==true){ ?>
        <a href = "../Controller/Adm.php?acao=mostrar&id=<?= $animal->getId();?>" class="btn btn-primary">Mostrar Postagem</a>
        <?php } ?>
    <?php } ?>

      <p>Compartilhar:</p>         
      <a class="btn btn-primary" data-rede="twitter" data-dica="90" href="https://twitter.com/share?url=https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId();?>&text=Há um animal perdido!" target="_blank" title="Twittar postagem">
        <i class="fab fa-twitter"></i> Twitter
      </a>
      <a class="btn btn-primary" data-rede="facebook" data-dica="90" href="https://www.facebook.com/sharer/sharer.php?u=https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId();?>" target="_blank">
        <i class="fab fa-facebook-f"></i> Facebook
      </a>
      <a class="btn btn-success" data-rede="whats" data-dica="90" href="https://api.whatsapp.com/send?text=Há um animal perdido! Veja em https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId();?>&" target="_blank">
        <i class="fab fa-whatsapp"></i> WhatsApp
      </a>
      <a class="btn btn-primary" data-rede="telegram" data-dica="90" href="https://telegram.me/share/url?url=https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId();?>&&text=Há um animal perdido!" target="_blank">
        <i class="fab fa-telegram-plane"></i> Telegram
      </a>
      <a class="btn btn-dark btn-shared mx-2 share" data-rede="email" data-dica="90" href="mailto:?subject=Preciso de sua ajuda!&body=Há um animal perdido! em https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId();?>&">
        <i class="fas fa-envelope"></i> E-Mail
      </a>
  </div>
</div>
  <?php } ?>
</body>
</html>