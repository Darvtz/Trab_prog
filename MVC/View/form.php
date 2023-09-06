<?php

//print_r($_POST);

//echo $_POST['usuario'];
//echo '<br>';
//echo $_POST['senha'];
//extract($_POST);
//echo '<br> Depois do Extract ' . $_POST['re-senha'];

foreach($_POST as $chave => $valor){
    //echo '<br> Valores ' . $chave . ' = ' . $valor;
    echo "<br> Valor de $chave é $valor ";

    var_dump($valor);

}






?>