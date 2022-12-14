<?php
    if(!isset($_SESSION)){
    session_start();
    }
    if(!isset($_SESSION["usuario"])){
        die("<h2>Acesso restrito a usuários logados no sistema.</h2> <h2>Por favor, realize o login <a href=\"login.php\">[AQUI]</a></h2>");
    }
?>