<?php
function conexao(){
    try {
    
        //$pdo = new PDO('mysql:host=gpetsbd.mysql.dbaas.com.br;dbname=gpets;charset=utf8', 'gpets', 'D@v12004');
        $pdo = new PDO('mysql:host=localhost;dbname=gpets; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    }catch(PDOException $e){
            echo 'Erro de conexão: ' . $e->getMessage();
        }
    }
