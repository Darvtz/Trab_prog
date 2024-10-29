<?php

    include("../Model/Conexao.php");

    include("../Model/Email.php");

    if(isset($_POST['ok'])){

        $pdo = conexao();

        $recuperarSenha = uniqid();

        $email = ($_POST['email']);

        $stmt = $pdo->prepare("UPDATE Usuario SET recuperar_senha = '$recuperarSenha' WHERE usuario.email = '$email'");

        $stmt->execute();

        email($email, "Recuperação de senha", "para recuperar a senha acesse o link http: . $recuperarSenha");
    }

?>

<html>
<head>
    <meta charset = "utf-8">
</head>

<body>
    <form action="" method='POST'>
        <input placeholder="Seu E-mail" name="email" type="text">
        <input name="ok" value="ok" type="submit">
</body>

</html>