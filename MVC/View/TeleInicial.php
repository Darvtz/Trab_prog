<?php

include('protect.php');

if(!isset($_SESSION)){
    session_start();
  }

if(isset($_FILES["arquivo"])){
  $arquivo = $_FILES["arquivo"];
  
  if($arquivo['erroe'])
    die("Falha ao enviar o arquivo");
  
   if($arquivo['size'] > 2097152)
     die("Arquivo muito grande!");
  
     $pasta = "arquivos/";
     $nomeDoArquivo = $arquivo['name'];
     $novoNomeDoArquivo = uniqid();
     $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
  
    if($extensao != "jpg" && $extensao != "png")
      die("Tipo de arquivo não aceito");
  
    $deu_certo = move_uplaod_file();
  
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPetS</title>
</head>
<body>
    
  Seja bem vindo, <?php echo $_SESSION['nome']; ?>

  <form method="POST" action="">

  <p><label>Selecione um Arquivo</label></p> <br>

  <p><imput name="arquivo" type="file">
    <buttom name="upload" type="submit">Enviar imagem</buttom>
  </p>

</body>
</html>