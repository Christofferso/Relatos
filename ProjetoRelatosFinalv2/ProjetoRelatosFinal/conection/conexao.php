<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "relatos";
$port = 8080;

try{
    //Conexao com a porta
    //$conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
    
    //Conexao sem a porta
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

    // Ativar o modo de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexão com banco de dados realizado com sucesso.";
}catch(PDOException $e){
    $error = $e->getMessage();
    echo "Erro: $error";
}