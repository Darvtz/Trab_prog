<?php
$acao = $_GET['acao'];
    
include_once '../Model/Usuario.class.php';
include_once '../Model/Cargo.class.php';

function enviarArquivo($nomeInputFile, $size = 2097152){
    echo '<pre>';
    if(isset($_FILES[$nomeInputFile])){

        $arquivo = $_FILES["arquivo"];
        
        if($arquivo['error'])
        die("Falha ao enviar o arquivo");
        
        if($arquivo['size'] > $size)
        die("Arquivo muito grande!");
        
        $pasta = __DIR__. "/../View/fotos/";
        $novoNomeDoArquivo = uniqid();

    
            $path = $pasta . $novoNomeDoArquivo . ".jpg" ;
            var_dump($path);
            $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

            if($deu_certo){                    
                return $novoNomeDoArquivo . ".jpg";
            }else{
                die('Não pude enviar a imagem');
                return false;
            }
        }
        return false;

    
}

// Cadastrar no banco
if($acao=='cadastrar'){
    $usuario=new Usuario();
    $usuario->setCpf($_POST['cpf']);
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $usuario->setSenha($hash);
    $usuario->setDatanasc($_POST['Data']);
    $usuario->setCelular($_POST['celular']);
    $usuario->setDatacad(date('Y/m/d'));
    $foto = enviarArquivo('arquivo');
    if($foto){
        $usuario->setFoto($foto);
    }
    $usuario->save();
    header('Location: ../View/index.php');

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
        header('Location: ../View/TelaInicial.php');
    }

}else if ($acao="recuperar_senha"){
    require_once "PHPMailer/PHPMailerAutoLoad.php";
    require_once "interno/conecta.php";
    require_once "interno/funcoes.php";


    $recupera = $_POST['recuperar-senha'];
    $link = "http://localhost/toqve/recuperar.php?recupera=".$recupera;

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->isHTML(true);
    $mail->CharSet = 'utf-8';
    $mail->Host = 'mx1.weblink.com.br';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'cadastro@dalvz.com.br';
    $mail->Password = '*********';
    $mail->setFrom("cadastro@dalvz.com.br", "daLvz");
    $mail->FromName = 'daLvz';
    $mail->Subject = "Recuperar senha";

    $mensagem = "Clique <a href=".$link.">aqui</a> para recuperar sua senha. "

    $mail->Body = $mensagem;
    $mail->AltBody = "Conteudo do email em texto";

    $mail->addAddress($recupera);

    if($mail->Send()) {

        header("Location: confirmacao.php");
    } else {

        echo "Erro ao enviar email". $mail->ErrorInfo;
    }
    }
?>
