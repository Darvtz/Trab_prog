<?php

include_once('../Model/Animal.class.php');

if(!isset($_SESSION)){
    session_start();
}

$usuario = Usuario::getOne($_REQUEST['id']);

?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edição de Usuário</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="../JS/MascaraCPF.js"></script>
    </head>

<body>
  <div>
  <h1>
    Edite suas informações de usuario
  </h1>
  </div>
    <form action="../Controller/Usuario.php?acao=editar&id=<?= $usuario->getId()?>" method = "POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputName" class="dorm-label">
                Nome
                <input type="name" class="form-control" id="exampleImputName" name = "nome" value="<?php echo $usuario->getNome(); ?>">
            </label>
        </div>
        <div>
          <label for="exampleInputEmail" class="form-label">
            Endereço de e-mail
            <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="email" value="<?php echo $usuario->getEmail(); ?>">
        </label>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword" class="form-label">
            Nova Senha
            <input type="password" class="form-control" id="exampleInputPassword" name="senha">
        </label>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword2" class="form-label">
            Repetir Senha
            <input type="password" class="form-control" id="exampleInputPassword2" name="resenha">
        </label>
        </div>
        <div class="mb-3">
          <label for="exampleInputDate" class="form-label">
            Data de nascimento
            <input type="date" class="form-control" id="exampleInputDate" name="Data">
        </label>
        </div>
        <div>
        <p><label>Insira uma foto de perfil</label></p> </br>
        <p><input name="arquivo" type="file"></br></br>
          <button type="submit">cadastrar</button></br>
          <?php if(isset($_REQUEST['error'])){ echo 'Erro, verifique seus dados.'; }?>
        </div>
      </form>
    
    <script>
        $(document).ready(function () {
        $('input[type=radio]').change(function() {
        $('input[type=radio]:checked').not(this).prop('checked', false);
        });
        });

        let vetor = new Array();
        vetor[1] = "dsfds";
        vetor['dsds'] = 'sas' //non existe
        console.log(vetor[1]);
        let mapa = {}; // let mapa = new Object();

        mapa['ooo'] = "fdsf"; // mapa.ooo
    </script>
</body>

</html>