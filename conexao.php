<?php
      
    //parãmetros de conexão com BD
    define("HOST", "200.18.128.50");
    define("USER", "luisa_willian");
    define("PASS", "2021@Luisa_willian");
    define("DB", "luisa_willian");

    $charset = "utf8";

    //criar um objeto de conexão
    $conn = new mysqli(HOST, USER, PASS, DB);

    //checar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
?>