<?php

    // $usuario = "root";
    // $senha = "";
    // $database = "prodema";
    // $host = "localhost";

    $mysqli = new mysqli($host, $usuario, $senha, $database);
    
    if ($mysqli->error){
        die("Erro de conexão" . $mysqli->error);
    }
?>