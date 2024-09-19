<?php

    function conexao() {
    $servername = "localhost";  // Ou outro endereço
    $username = "root";         // Seu usuário
    $password = "";             // Sua senha
    $dbname = "seu_banco_de_dados"; // Nome do banco de dados

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
    
    return $conn;
}
?>
