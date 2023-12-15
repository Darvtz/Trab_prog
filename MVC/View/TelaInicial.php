<?php

include('protect.php');
include_once('../Model/Animal.class.php');

if(!isset($_SESSION)){
    session_start();
}

$animais = Animal::getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>GPetS</title>
</head>
<body>
    
  Seja bem vindo, <?php echo $_SESSION['nome']; ?>

  <?php foreach($animais as $animal){?>

  <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="fotos/<?= $animal->getImagem();?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?= $animal->getNome();?></h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
  <?php } ?>

  <p>
    <a href="../View/Postagem.php">Fazer uma postagem</a>
  </p>

</body>
</html>