<?php
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('BASE', 'barretospizza');

    $conn = new MySQLi(HOST, USER, PASS, BASE);

    // Verificação de erro na conexão (opcional, mas recomendada)
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }
?>