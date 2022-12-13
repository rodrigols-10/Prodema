<?php
    $usuario = "prodemadb";
    $senha = "eUd*bGPEq4#";
    $database = "prodemadb";
    $host = "prodemadb.mysql.dbaas.com.br";

    $mysqli = new mysqli($host, $usuario, $senha, $database);
    
    if ($mysqli->error){
        die("Erro de conexão" . $mysqli->error);
    }
?>