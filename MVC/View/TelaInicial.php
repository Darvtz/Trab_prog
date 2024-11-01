<?php

include('protect.php');
include_once('../Model/Animal.class.php');
include_once('../Model/Usuario.class.php');

if(!isset($_SESSION)){
    session_start();
}

$animais = Animal::getAll();
$usuarios = Usuario::getAll();
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
    
  <h1><a href="TelaUsuario.php" class="l1">Usuário</a></p1>Seja bem vindo, <?php echo $_SESSION['nome']; ?></h1>

  <?php foreach($animais as $animal){?>

  <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="fotos/<?= $animal->getImagem();?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?= $animal->getNome();?></h5>
    <p class="card-text">Ultimo endereço visto: <?= $animal->getUltimoEndereco();?></p>
    <p class="card-text"><?= $animal->getDescricao();?></p>
    <p class="card-text">Contato com o dono: </p>
    <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3458.9493243850884!2d-51.15462771687573!3d-29.894560759862568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95196fd8f13d8b8d:0x86db994a478111c0!2sR.Mariluz,70-Estância Velha,Canoas-RS,92412-546!5e0!3m2!1spt-BR!2sbr!4v1730474836124!5m2!1spt-BR!2sbr" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe></p>
    <?php //if ($status == 'COMPLETE'){?> 
      <a href="../View/EditarPostagem.php?id=<?= $animal->getId();?>" class="btn btn-primary">Editar Postagem</a>
    <?php//}?>

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
  <?php } ?>

  <p>
    <a href="../View/Postagem.php">Fazer uma postagem</a>
  </p>

</body>
</html>