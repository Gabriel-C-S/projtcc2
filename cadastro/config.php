<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'formulario';

$conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

if ($conexao->connect_error) {
    
    die("Erro na conexão: " . $conexao->connect_error);
}

?>