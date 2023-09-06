<?php

include('Conexao.php');

  $email = $mysql->real_escape_strig($_POST['email']);
  $senha = $mysql->real_escape_string($_POSR['senha']);

  $sql_code = "SELECT * FROM Usuario WHERE email = '$email' AND senha = '$senha'";
  $sql_query = $mysql->query($sql_code) or die("Falha na execução do erro");

?>