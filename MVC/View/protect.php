<?php

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id'])){
    die("Para poder acessar esta página você precisa estar logado. <a href=\"Login.php\">Entar</a></p>");
}
?>