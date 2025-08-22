<?php

include '../db.php';

$sql = "SELECT * FROM times";

$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $posi = $_POST['positions'];
    $num_cami = $_POST['num_cami'];
    $time = $_POST['times'];

    $sql = "INSERT INTO jogadores (nome, posicao, numero_camisa, time_id) VALUES ('$nome', '$posi', '$num_cami', '$time')";

    if($conn ->query($sql) === true)
        {echo"Jogador criado com sucesso!<a href='read.php'>Ver jogadores</a>";}
    else{echo "Erro: " . $conn->error;}
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../styles/style.css">
    <title>Inserir Jogador no Banco</title>
</head>
<body>
    
    <form action="" method="POST">
        <label>Nome: </label>
        <input type="text" name="nome">
        <br>
        <label>Posição: </label>
        <select name="positions" id="posi-select">
            <option value="" selected disabled>Selecione...</option>
            <option value="GOL">GOL</option>
            <option value="ZAG">ZAG</option>
            <option value="MEI">MEI</option>
            <option value="ATA">ATA</option>
        </select>
        <br>
        <label>Número da Camisa: </label>
        <input type="text" name="num_cami">
        <br>
        <label>Time: </label>
        <select name="times" id="time-select">
            <option value="" selected disabled>Selecione...</option>
            <?php
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                }
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Criar">
        <input type="button" value="Cancelar" onclick="window.location.href='read.php'">
    </form>

</body>
</html>