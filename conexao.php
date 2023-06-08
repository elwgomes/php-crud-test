<?php

// definindo variaveis
const DB_HOST = 'localhost';
const DB_NAME = 'produtos';
const DB_USER = 'root';
const DB_PASSWORD = 'tt333';

// metodo para conectar ao banco
function connectToDatabase()
{
    try {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        return new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    } catch (PDOException $e) {
        exit('Erro na conexão: ' . $e->getMessage());
    }
}

$conn = connectToDatabase();
?>
