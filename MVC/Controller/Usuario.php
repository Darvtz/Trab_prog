<?php
$acao = $_GET['acao'];
session_start();
    
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
    $cargo=new Cargo();
    $usuario->setCpf($_POST['cpf']);
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $usuario->setSenha($hash);
    $usuario->setDatanasc($_POST['Data']);
    $usuario->setCelular($_POST['celular']);
    $usuario->setDatacad(date('Y/m/d'));
    $foto = enviarArquivo('arquivo');
    $cargo->setId(3);
    $cargo->setCargo();
    if($foto){
        $usuario->setFoto($foto);
    }

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

        header('Location: ../View/index.php');
    }
}
?>