<?php
$acao = $_GET['acao'];
session_start();
    
include_once '../Model/Usuario.class.php';
include_once '../Model/Cargo.class.php';

function enviarArquivo($nomeInputFile, $size = 2097152) {
    // Verificando se o arquivo foi enviado
    if (isset($_FILES[$nomeInputFile])) {
        
        $arquivo = $_FILES[$nomeInputFile];

        // Verificando se houve erro no envio
        switch ($arquivo['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                die('Arquivo muito grande!');
            case UPLOAD_ERR_PARTIAL:
                die('O upload do arquivo foi feito parcialmente.');
            case UPLOAD_ERR_NO_FILE:
                die('Nenhum arquivo foi enviado.');
            case UPLOAD_ERR_NO_TMP_DIR:
                die('Faltando pasta temporária.');
            case UPLOAD_ERR_CANT_WRITE:
                die('Falha ao gravar no disco.');
            case UPLOAD_ERR_EXTENSION:
                die('Upload bloqueado por extensão.');
            default:
                die('Erro desconhecido no upload.');
        }

        // Verificando se o arquivo excede o tamanho permitido
        if ($arquivo['size'] > $size) {
            die('Arquivo muito grande!');
        }
        
        // Definindo a pasta de destino
        $pasta = __DIR__ . "/../View/fotos/";

        // Verificando se a pasta existe e tem permissões adequadas
        if (!is_dir($pasta)) {
            die('O diretório de uploads não existe.');
        }

        if (!is_writable($pasta)) {
            die('O diretório de uploads não tem permissões adequadas.');
        }
        
        // Obtendo a extensão do arquivo original
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $extensao = strtolower($extensao);

        // Verificando se a extensão é válida
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($extensao, $extensoesPermitidas)) {
            die('Tipo de arquivo não permitido.');
        }

        // Gerando um nome único para o arquivo
        $novoNomeDoArquivo = uniqid() . "." . $extensao;

        // Definindo o caminho completo do arquivo
        $path = $pasta . $novoNomeDoArquivo;

        // Movendo o arquivo para a pasta de destino
        $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

        // Verificando se o arquivo foi enviado com sucesso
        if ($deu_certo) {
            return $novoNomeDoArquivo; // Retorna o nome do arquivo para ser salvo no banco
        } else {
            return "Erro ao mover o arquivo para o diretório.";
        }
    }

    // Retorna falso se o arquivo não foi enviado
    return false;
}


// Cadastrar no banco
if ($acao == 'cadastrar') {
    // Instanciando os objetos de usuário e cargo
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

    // Se a foto foi enviada, associamos ao usuário
    if ($foto) {
        $usuario->setFoto($foto);
    } else {
        $usuario->setFoto('default.jpg'); // Caso não haja foto, usa uma foto padrão
    }

    // Definindo o cargo do usuário
    $cargo->setId(3);
    $cargo->setCargo('usuario_padrão');
    
    // Salvando o usuário
    if ($usuario->save() == true) {
        // Redirecionando para a página de login
        header('Location: ../View/Login.php');
        exit;
    } else {
        // Em caso de falha no cadastro, redireciona para a página de cadastro com erro
        header('Location: ../View/Cadastro.php?error=1');
        exit;
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