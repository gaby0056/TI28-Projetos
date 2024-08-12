<?php
include('conectadb.php');

$id = $_GET['id'];
$sql = "SELECT * FROM cliente WHERE id = '$id'";

$retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $cpf = $tbl['cpf'];
        $nome = $tbl['nome'];
        $email = $tbl['email'];
        $telefone = $tbl['telefone'];
    }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $cpf = $_POST['txtcpf'];
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $telefone = $_POST['txttelefone'];

    $sql = "UPDATE cliente 
    SET cpf = '$cpf', nome = '$nome', email = '$email', telefone = '$telefone'
    WHERE id = $id";

    mysqli_query($link, $sql);

    echo"<script>window.alert('Cliente alterado com sucesso!');</script>";
    echo"<script>window.location.href='cliente-lista.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>ALTERAÇÃO DE CLIENTE</title>
</head>
<body>
    <div class="container-global">
        
        <a href="cliente-lista.php"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

    <form class="formulario" action="cliente-altera.php?id=<?= $id ?>" method="post">
                <input type="hidden" name="id" value="<?= $id?>">

                <label>CPF</label>
                <input type="text" name="txtcpf" value="<?= $cpf?>" required>
                <br>
                <label>NOME</label>
                <input type="text" name="txtnome" value="<?= $nome?>" required>
                <br>
                <label>EMAIL</label>
                <input type="email" name="txtemail" value="<?= $email?>" required>
                <br>
                <label>TELEFONE</label>
                <input type="text" name="txttelefone" value="<?= $telefone?>" required>
                <br>
                <br>
                <input type="submit" value="CONFIRMAR">
        </form>

    </div>
    
</body>
</html>
