<?php
session_start();
$acao = $_GET['acao'];
    
include_once '../Model/Animal.class.php';

function enviarArquivo($nomeInputFile, $size = 2097152) {
    // Verificando se o arquivo foi enviado
    if(isset($_FILES[$nomeInputFile])) {
        
        $arquivo = $_FILES[$nomeInputFile];
        
        // Verificando se houve erro no envio
        if($arquivo['error'])
            die("Falha ao enviar o arquivo");

        // Verificando se o arquivo excede o tamanho permitido
        if($arquivo['size'] > $size)
            die("Arquivo muito grande!");
        
        // Definindo a pasta de destino
        $pasta = __DIR__ . "/../View/fotos/";
        
        // Gerando um nome único para o arquivo
        $novoNomeDoArquivo = uniqid();
        
        // Definindo o caminho completo do arquivo
        $path = $pasta . $novoNomeDoArquivo . ".jpg";
        
        // Movendo o arquivo para a pasta de destino
        $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

        // Verificando se o arquivo foi enviado com sucesso
        if($deu_certo){                    
            return $novoNomeDoArquivo . ".jpg"; // Retornando o nome do arquivo para ser salvo no banco
        } else {
            die('Não pude enviar a imagem');
            return false; // Retorna falso em caso de erro
        }
    }

    // Retorna falso se o arquivo não foi enviado
    return false;
}


if ($acao == 'postar') {
    $animal = new Animal();
    $animal->setNome($_POST['nome']);
    $animal->setEspecie($_POST['especie']);
    $animal->setRaca($_POST['raca']);
    $animal->setGenero($_POST['genero']);
    $animal->setCor($_POST['cor']);
    $animal->setEstado($_POST['estado']);
    $animal->setCidade($_POST['cidade']);
    $animal->setRua($_POST['rua']);
    $animal->setNumero($_POST['numero']);
    $animal->setContato($_POST['contato']);
    $animal->setDescricao($_POST['descricao']);
    
    // Enviar o arquivo utilizando a função
    $imagem = enviarArquivo('arquivo'); // Passando o nome do campo de input (arquivo)
    
    if ($imagem) {
        $animal->setImagem($imagem); // Aqui, você setará o nome ou caminho da imagem
    }

    $animal->setIdUsuario($_SESSION['id']);
    
    // Salvando o animal
    if ($animal->save() == true) {
        header('Location: ../View/TelaInicial.php');
    } else {
        header('Location: ../View/Postagem.php?error=1');
    }
}else if($acao=='deletar'){

    $animal=new Animal();
    $animal->setId($_REQUEST['id']);
    $animal->deletar();
    header('Location: ../View/TelaInicial.php');

}else if ($acao == 'editar') {
    // Obtém o animal com base no ID
    $animal = Animal::getOne($_REQUEST['id']);

    // Atualiza os atributos do animal com os valores recebidos do formulário
    $animal->setNome($_POST['nome']);
    $animal->setEspecie($_POST['especie']);
    $animal->setRaca($_POST['raca']);
    $animal->setGenero($_POST['genero']);
    $animal->setCor($_POST['cor']);
    $animal->setEstado($_POST['estado']);
    $animal->setCidade($_POST['cidade']);
    $animal->setRua($_POST['rua']);
    $animal->setNumero($_POST['numero']);
    $animal->setContato($_POST['contato']);
    $animal->setDescricao($_POST['descricao']);
    
    // Verifica se há um arquivo de imagem sendo enviado e se não houve erro
    if (isset($_FILES['arquivo']) && !$_FILES['arquivo']['error']) {
        $imagem = enviarArquivo('arquivo'); // Função para salvar o arquivo
        if ($imagem) {
            $animal->setImagem($imagem);  // Atualiza a imagem
        }
    }

    // Atualiza o ID do usuário
    $animal->setIdUsuario($_SESSION['id']);

    // Tenta salvar as alterações no banco de dados
    if ($animal->update() == true) {
        // Se a atualização for bem-sucedida, redireciona para a tela inicial
        header('Location: ../View/TelaInicial.php');
    } else {
        // Se ocorrer um erro, redireciona de volta para a página de postagem com um erro
        header('Location: ../View/Postagem.php?error=1');
    }
}

?>