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