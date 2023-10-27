<?php>

if(isset($_FILES["arquivo"])){
    $arquivo = $_FILES["arquivo"];
    
    if($arquivo['error'])
      die("Falha ao enviar o arquivo");
    
     if($arquivo['size'] > 2097152)
       die("Arquivo muito grande!");
    
       $pasta = "arquivos/";
       $nomeDoArquivo = $arquivo['name'];
       $novoNomeDoArquivo = uniqid();
       $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    
      if($extensao != "jpg" && $extensao != "png")
        die("Tipo de arquivo não aceito");
  
        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $deu_certo = move_uplaod_file($arquivo["tmp_name"], $path);
        if($deu_certo){
          $mysqli->query("INSERT INTO arquivos(nome, path) VALUES('$nomeDoArquivo', '$path')") or die($mysqli->error);
  
        }else{
          echo "<p>Falha ao enviar o arquivo<p>";
        }
    }
  
    $sql_querry = $mysqli->query("SELECT * FROM arquivos") or die($mysqli->error);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postagem</title>
</head>
<body>
    <h1>Insira as informações do post abaixo</h1>

    <div>
        <form action="../Controller/Postagem.php?acao=cadastrar" method = "POST">
            <div>
                    <label for="exampleInputNome">Nome
                        <imput type="name" id="exampleImputName" name="nome">
                    </label>
            </div>
            <div>
                <label for="exampleInputNome">Espécie
                    <imput type="text" id="exampleImputEspecie" name="especie">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Raça
                    <imput type="text" id="exampleImputRaca" name="raca">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Genero
                    <imput type="text" id="exampleImputGenero" name="genero">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Cor
                    <imput type="name" id="exampleImputCor" name="cor">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Ultimo endereço visto
                    <imput type="name" id="exampleImputUltimoEndereco" name="ultimoEndereco">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Descrição adicional
                    <imput type="name" id="exampleImputDescricao" name="descricao">
                </label>
            </div>
            <form method="POST" action="">

                <p><label>Insira a imagem do animal</label></p> <br>
              
                <p><imput name="arquivo" type="file">
                  <buttom name="upload" type="submit">Enviar imagem</buttom>
                </p>
        </form>
    </div>

</body>
</html>