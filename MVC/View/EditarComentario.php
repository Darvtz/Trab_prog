<?php

include_once('../Model/Comentario.class.php');

if(!isset($_SESSION)){
    session_start();
}

$comentario = Comentario::getOne($_REQUEST['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Editar Comentario</title>
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
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="../View/TelaUsuario.php?id=<?=$_SESSION['id'];?>">Tela do Usuário</a>
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

    <div>
        <form action="../Controller/Comentario.php?acao=editar&id=<?= $comentario->getId();?>" method = "POST">
        <textarea type="textarea" class="form-control" id="comentario" name="comentario"> <?php  echo $comentario->getComentario()?> </textarea>
        <input type = 'hidden' value = '<?php  echo $comentario->getId()?>' name = 'id'>
        </div>
        <button type="submit">Editar</button>
        </form>
    </div>
</body>
</html>