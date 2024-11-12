<?php

include_once('../Model/Animal.class.php');
include_once('../Model/Usuario.class.php');
include_once('../Model/Comentario.class.php');

if(!isset($_SESSION)){
    session_start();
}

$animal = Animal::getOne($_REQUEST['id']);
$usuarios = Usuario::getAll();
$comentarios = Comentario::getComentarios($_REQUEST['id']);


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
    <title>Postagem</title>
</head>
<body>
    <h1>Vizualizar Postagem</h1>

    <div>
        <div>
            <label for="exampleInputNome">
                <?php echo $animal->getNome();?>
            </label>
        </div>
        <div>
            <label for="exampleInputNome">
                Espécie: <?php echo $animal->getEspecie();?>
            </label>
        </div>
        <div>
              <label for="exampleInputNome">
                Raça: <?php echo $animal->getRaca();?>"
             </label>
        </div>
        <div>
            <label for="exampleInputNome">
                Sexo: <?php echo $animal->getGenero();?>
            </label>
        </div>
        <div>
            <label for="exampleInputNome">
                Cor: <?php echo $animal->getCor();?>
            </label>
        </div>
        <div>
                <label for="exampleInputNome">Ultimo endereço visto:</label></br></br>
                    <label>Estado: <?php  echo $animal->getEstado()?></label></br>
                    <label>Cidade: <?php  echo $animal->getCidade()?></label></br>
                    <label>Rua: <?php  echo $animal->getRua()?></label></br>
                    <label>Número: <?php  echo $animal->getNumero()?></label></br>
            </div>
        <div>
            <label for="exampleInputNome">
                Descrição: <?php echo $animal->getDescricao();?>
            </label>
        </div>
        </br>
        <div>
        <form action="../Controller/Comentario.php?acao=postar" method = "POST"  enctype="multipart/form-data">
            <div>
                <textarea type="textarea" class="form-control" id="comentario" name="comentario"></textarea>
                <input type = 'hidden' value = '<?php  echo $animal->getid()?>' name = 'id'>
            </div>
            <button type="submit">Comentar</button>

        </form>
        </div>

        <?php foreach($comentarios as $comentario){?>

        <div class="card" style="width: 18rem;">
        <div class="card-body">
        <h5 class="card-title"><?= $comentario->getUsuario()->getNome();?></h5>
        <p class="card-text"><?= $comentario->getComentario();}?></p>
        </div>
        </div>

</body>
</html>