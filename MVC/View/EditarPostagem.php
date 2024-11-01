<?php

include_once('../Model/Animal.class.php');

if(!isset($_SESSION)){
    session_start();
}

$animal = Animal::getOne($_REQUEST['id']);

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
    <h1>Edite sua postagem</h1>

    <div>
        <form action="../Controller/Postagem.php?acao=editar" method = "POST"  enctype="multipart/form-data">
            <div>
                    <label for="exampleInputNome">
                        Nome
                        <input type="text" class="form-control" id="exampleImputNome" name = "nome" value="<?php echo $animal->getNome(); ?>">
                    </label>
            </div>
            <div>
                <label for="exampleInputNome">Espécie
                    <input type="text" class="form-control" id="exampleImputEspecie" name = "especie" value="<?php echo $animal->getEspecie();?>">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Raça
                    <input type="text" class="form-control" id="exampleImputRaca" name = "raca" value="<?php echo $animal->getRaca();?>">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Genero
                <input type="text" class="form-control" id="exampleImputGenero" name = "genero" value="<?php echo $animal->getGenero();?>">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Cor
                    <input type="text" class="form-control" id="exampleImputCor" name = "cor" value="<?php echo $animal->getCor();?>">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Ultimo endereço visto:</label></br></br>
                    <label>Estado<input type="name" class="form-control" id="exampleImputEstado" name="estado"></label></br>
                    <label>Cidade<input type="name" class="form-control" id="exampleImputCidade" name="cidade"></label></br>
                    <label>Rua<input type="name" class="form-control" id="exampleImputRua" name="rua"></label></br>
                    <label>Número<input type="number" class="form-control" id="exampleImputNumero" name="numero"></label></br>
            </div>
            <div>
            <div>
                <label for="exampleInputNome">Descrição adicional
                    <input type="name" class="form-control" id="exampleImputDescricao" name="descricao" value="<?php echo $animal->getDescricao();?>">
                </label>
            </div>
                <p><label>Insira a imagem do animal</label></p> <br>
              
                <p><input name="arquivo" type="file">
                  <button name="upload" type="submit" >Editar Postagem</button>
                </p>
</form>
    </div>

</body>
</html>