<?php
include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $cpf = $_POST['txtcpf'];
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $numero = $_POST['txttelefone'];

    
    $stmt = $link->prepare("SELECT COUNT(id) FROM cliente WHERE cpf = ? OR email = ?");
    
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $link->error);
    }

    $stmt->bind_param("ss", $cpf, $email);
    $stmt->execute();
    $stmt->bind_result($contagem);
    $stmt->fetch();
    $stmt->close();

    
    if ($contagem == 0) {
        
        $stmt = $link->prepare("INSERT INTO cliente (cpf, nome, email, telefone) VALUES (?, ?, ?, ?)");
        
        if (!$stmt) {
            die("Erro na preparação da consulta de inserção: " . $link->error);
        }

        $stmt->bind_param("ssss", $cpf, $nome, $email, $numero);
        if ($stmt->execute()) {
            echo "<script>alert('Cliente cadastrado com sucesso!'); window.location.href='cliente-cadastro.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar cliente: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Cliente já existente.');</script>";
    }

    $link->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Cadastro de Cliente</title>
</head>
<body>
    <div class="container"> 
    <form class="formulario" action="cliente-cadastro.php" method="post">
        <label>CPF</label>
        <input type="text" name="txtcpf" id="cpf" placeholder="000.000.000-00" maxlength="14" oninput="formatarCPF(this)" required>
        <br>
        <label>NOME</label>
        <input type="text" name="txtnome" placeholder="Digite seu Nome" required>
        <br>
        <label>EMAIL</label>
        <input type="email" name="txtemail" placeholder="Digite seu email" required>
        <br>
        <label>TELEFONE</label>
        <input type="text" name="txttelefone" id="telefone" placeholder="(00) 00000-0000" maxlength="15" oninput="formatarTelefone(this)" required>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
</div>
</body>
<script src="scripts/scripts.js"></script>
</html>

<!-- RODAR NO BANCO DE DADOS/Myadmin
CREATE TABLE IF NOT EXISTS cliente (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    cpf VARCHAR(14) NOT NULL UNIQUE,           
    nome VARCHAR(100) NOT NULL,         
    email VARCHAR(100) NOT NULL UNIQUE,        
    telefone VARCHAR(15)                
); 
-->