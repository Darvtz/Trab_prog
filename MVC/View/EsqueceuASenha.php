<?php

    include("Conexao.php");

    if(isset($_POST[ok])){

        $email = $mysqli->escape_string($_POST['email']);

        if(!filter_var($email, FILTER_VALIDADE_EMAIL)){
            $error[] = "E-mail invalido.";
        }

        $sql_code = "SELECT senha, from usuario where email = $email";
        $sql_query = $mysqli->querry($sql_code) or die ($mysqli->error);
        $dado = $sql_query->fetch_assoc();
        $total = $sql_query->num_rows;

        if($total==0){
            $error = "O e-mail informado não existe no banco de dados";
        }

        if(count($error)==0 && $total > 0){

            $novasenha = substr(password_hash(time()), 0, 6);
            $nscriptografada = password_hash(password_hash($novasenha));

            if(mail($email, "Sua nova senha", "Sua nova senha: ".$novasenha)){

                $sql_code = "UPDATE usuario SET senha = '$nscriptografada' WHERE email = '$email'";
                $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

                if($sql_query){
                    $error[] = "Senha alterada com sucesso!";
                }

            }

        }

    }

?>

<html>
<head>
    <meta charset = "utf-8">
</head>

<body>
    <form action="">
        <input placeholder="Seu E-mail" name="email" type="text">
        <input name="ok" value="ok" type="submit">
</body>

</html>