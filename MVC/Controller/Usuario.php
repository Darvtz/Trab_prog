<?php
$acao = $_GET['acao'];
session_start();
    
include_once '../Model/Usuario.class.php';
include_once '../Model/Cargo.class.php';

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

// Cadastrar no banco
if($acao == 'cadastrar'){
    $usuario = new Usuario();
    $cargo = new Cargo();
    
    // Definindo os dados do usuário
    $usuario->setCpf($_POST['cpf']);
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    
    // Hash da senha
    $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $usuario->setSenha($hash);
    
    // Definindo a data de nascimento e data de cadastro
    $usuario->setDatanasc($_POST['Data']);
    $usuario->setDatacad(date('Y/m/d'));
    
    // Enviando a foto
    $foto = enviarArquivo('arquivo'); // Passando o nome do campo de input para a função de upload

    // Definindo o cargo do usuário
    $cargo->setId(3);
    $cargo->setCargo('usuario_padrão');
    
    // Se a foto foi enviada, associamos ao usuário
    if($foto){
        $usuario->setFoto($foto);
    }

    // Salvando o usuário e redirecionando
    if($usuario->save() == true){
        header('Location: ../View/Login.php');
    }else{
        header('Location: ../View/Cadastro.php?error=1');
    }
}else if($acao=='deletar'){
    $usuario=new Usuario();
    $usuario->setId($_REQUEST['id']);
    $usuario->deletar($id);

}else if($acao=='logar'){
    $usuario = new Usuario();

    $usuario->setEmail($_POST['email']);
    $usuario->loadByEmail();

    echo '<pre>';
    var_dump($usuario);

    if(password_verify($_POST['senha'], $usuario->getSenha())){
    //    echo 'logado';
        session_start();
        $_SESSION['id'] = $usuario->getId();
        $_SESSION['nome'] = $usuario->getNome();
        $usuario->getCargo();

        if($usuario->getBanido() == true){
            header('Location: ../View/Banido.php');
        }

        header('Location: ../View/TelaInicial.php');
    }else{
        header('Location: ../View/Login.php?error=1');
    }
}else if($acao=='editar'){

    $usuario = Usuario::getOne($_REQUEST['id']);
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $usuario->setSenha($hash);
    $usuario->setDatanasc($_POST['Data']);
    $usuario->setDatacad(date("j, n, Y"));
    if(isset($_FILES['arquivo']) && !$_FILES['arquivo']['error']){
        $foto = enviarArquivo('arquivo');
        if($foto){
            $usuario->setFoto($foto);
        }
    }

    $usuario->update();
    
    header('Location: ../View/TelaUsuario.php?id='. $_REQUEST['id']);
    
}
?>