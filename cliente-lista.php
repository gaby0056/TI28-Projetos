<?php
include('conectadb.php');

$sql = "SELECT id, cpf, nome, email, telefone FROM cliente";
$retorno = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LISTA DE CLIENTES</title>
</head>
<body>
<a href="backoffice.php" class='btnsair'><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

    <div class="container-listausuarios">
        
        <table class="lista">
            <tr>
                <th>CPF</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>ALTERAR</th>
            </tr>

            <?php
            while($tbl = mysqli_fetch_array($retorno)){
            ?>
                 <tr>
                    <td><?=$tbl['cpf']?></td> 
                    <td><?=$tbl['nome']?></td> 
                    <td><?=$tbl['email']?></td> 
                    <td><?=$tbl['telefone']?></td> 
                    <td><a href="cliente-altera.php?id=<?=$tbl['id']?>"><input type="button" value="ALTERAR"></a></td>
                 </tr>
            <?php
            }
            ?>
        </table>

    </div>
    
</body>
</html>
