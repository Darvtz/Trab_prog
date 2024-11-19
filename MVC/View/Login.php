<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>

<body>
  <div>
  <h1>
    Login de Usuário
  </h1>
  </div>
    <form action="../Controller/Usuario.php?acao=logar" method = "POST">
        <div>
          <label for="exampleInputEmail1" class="form-label">
            Endereço de e-mail
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        </label>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">
            Senha
            <input type="password" class="form-control" id="exampleInputPassword1" name="senha">
        </label>
        </br> <a href="../View/Cadastro.html">Não possui uma conta? Cadastre-se!</a>
        </br>
              <a href="../View/EsqueceuASenha.php" target="_blank">Esqueceu a senha?</a>
        </div>
      <button type="submit" class="btn btn-primary">Log-In</button>
      </form>
    
    <script>
        
    </script>
</body>

</html>
