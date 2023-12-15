<?php
// Configurações do banco de dados
$servername = "seu_servidor";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o formulário foi enviado corretamente
    if (isset($_POST["nome"]) && isset($_POST["especie"]) && isset($_POST["raca"]) && isset($_POST["genero"]) && isset($_POST["cor"]) && isset($_POST["ultimo_endereco"]) && isset($_POST["descricao"]) && isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        // Diretório de upload (certifique-se de ter permissões de escrita)
        $upload_dir = "uploads/";

        // Nome do arquivo único
        $file_name = uniqid() . "_" . $_FILES["imagem"]["name"];

        // Caminho completo do arquivo
        $file_path = $upload_dir . $file_name;

        // Mover o arquivo para o diretório de upload
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $file_path)) {
            // Inserir no banco de dados
            $nome = $_POST["nome"];
            $especie = $_POST["especie"];
            $raca = $_POST["raca"];
            $genero = $_POST["genero"];
            $cor = $_POST["cor"];
            $ultimo_endereco = $_POST["ultimo_endereco"];
            $descricao = $_POST["descricao"];

            // Inserir no banco de dados
            $sql = "INSERT INTO Postagem (nome, especie, raca, genero, cor, ultimo_endereco, descricao, imagem_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $nome, $especie, $raca, $genero, $cor, $ultimo_endereco, $descricao, $file_path);

            if ($stmt->execute()) {
                echo "Postagem enviada com sucesso!";
            } else {
                echo "Erro ao inserir no banco de dados: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro ao mover o arquivo para o diretório de upload.";
        }
    } else {
        echo "Erro nos dados do formulário ou no envio do arquivo.";
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Postagem</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <br>
        <!-- Adicione os outros campos do formulário conforme necessário -->
        <label for="imagem">Selecione uma imagem:</label>
        <input type="file" name="imagem" id="imagem" accept="image/*" required>
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>