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
    
  <h1></p1>Seja bem vindo, <a href="TelaUsuario.php" class="l1" ><?php echo $_SESSION['nome']; ?></a></h1>

  <form method="POST" >
    <input type="text" name="search" required>
    <input type="submit" value="Pesquisar">
  </form>

  <p>
    <a href="../View/Postagem.php"  class="btn btn-primary">Fazer uma postagem</a>
  </p>

  <?php foreach($animais as $animal){ 
    ?>
  <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="fotos/<?= $animal->getImagem();?>" alt="Card image cap">
  <div class="card-body">
    
    <h4><a href="TelaUsuario.php?id=<?= $animal->getIdUsuario()?>"><?php echo $animal->getUsuario()->getNome(); ?></a></h4>
    <h5 class="card-title"><?= $animal->getNome();?></h5>
    <p class="card-text">Ultimo endereço visto: <?= $animal->getRua();?>, <?= $animal->getNumero();?>, <?= $animal->getCidade();?>, <?= $animal->getEstado();?></p>
    <p class="card-text"><?= $animal->getDescricao();?></p>
    <p class="card-text">Contato com o dono: </p>
    
    <a href="../View/VizualizarPostagem.php?id=<?= $animal->getId();?>" class="btn btn-primary">Ver Postagem</a>
    <?php 
      if ($animal->getIdUsuario() == $_SESSION['id']){
    ?> 
      <a href="../View/EditarPostagem.php?acao=editar&id=<?= $animal->getId();?>" class="btn btn-primary">Editar Postagem</a></br>
      <a href="../Controller/Postagem.php?acao=deletar&id=<?= $animal->getId();?>" class="btn btn-primary">Deletar Postagem</a>
    <?php
      }
    ?>
    <ul class="row justify-content-end">                  
      <li><a class="btn btn-dark btn-shared mx-2 share" data-rede="twitter" data-dica="90" href="https://twitter.com/share?url=https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId();?>&text=Há um animal perdido!" target="_blank" title="Twetar poema"><i class="fab fa-twitter" target="_blank"></i></a></li>
      <li><a class="btn btn-dark btn-shared mx-2 share" data-rede="facebook" data-dica="90" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fgpets2provisorio1.websiteseguro.com%2FTrab_prog%2FMVC%2F/View%2FVizualizarPostagem.php?id=<?= $animal->getId();?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
      <li><a class="btn btn-dark btn-shared mx-2 share" data-rede="whats" data-dica="90" href="https://api.whatsapp.com/send?text=Há um animal perdido! Veja em https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId();?>&" target="_blank"><i class="fab fa-whatsapp"></i></a>
      <li><a class="btn btn-dark btn-shared mx-2 share" data-rede="telegram" data-dica="90" href="https://telegram.me/share/url?url=https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId();?>&&text=Há um animal perdido!" target="_blank"><i class="fab fa-telegram-plane"></i></a>
      <li><a class="btn btn-dark btn-shared mx-2 share" data-rede="email" data-dica="90" href="mailto:?subject=Preciso de sua ajuda! &body=Há um animal perdido! em https://gpets2provisorio1.websiteseguro.com/Trab_prog/MVC/View/VizualizarPostagem.php?id=<?= $animal->getId();?>&"><i class="fas fa-envelope"></i></a>
    </ul>
  </div>
</div>
  <?php } ?>
</body>
</html>