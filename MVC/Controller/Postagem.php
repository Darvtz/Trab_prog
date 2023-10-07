<?php
$acao = $_GET['acao'];
    
include_once '../Model/Animal.class.php';

// Cadastrar no banco
if($acao='cadastrar'){
    $animal=new Animal();
    $animal->setNome($_POST['nome']);
    $animal->setEspecie($_POST['especie']);
    $animal->serRaca($_POST['senha']);
    $animal->setGenero($_POST['genero']);
    $animal->setCor($_POST['cor']);
    $animal->setUltimoEndereco('ultimoEndereco');
    $animal->setDescricao('descricao');
    $animal->save();
}else if($acao='deletar'){
    $animal=new Animal();
    $animal>setId($_REQUEST['id']);
    $animal->deletar();
}
?>