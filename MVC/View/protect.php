<?php

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id'])){
    die("Você não pode acessar esta página pois não esta logado. <a href=\"Login.php\">Entar</a></p>");
  }

?>