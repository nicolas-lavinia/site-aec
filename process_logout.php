<?php
    include 'functions.php';
    sec_session_start();
    // Zera todos os valores da sess�o
    $_SESSION = array();
    // Pega os par�metros da sess�o 
    $params = session_get_cookie_params();
    // Deleta o cookie atual.
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    // Destr�i a sess�o
    session_destroy();
    header("Location: index.php");
    exit();
?>