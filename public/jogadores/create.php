<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Inserir Jogador no Banco</title>
</head>
<body>
    
    <form action="POST">
        <label>Nome: </label>
        <input type="text" name="nome">
        <label>Posição: </label>
        <select name="positions" id="posi-select">
            <option value="" selected disabled>Selecione...</option>
            <option value="GOL">GOL</option>
            <option value="ZAG">ZAG</option>
            <option value="MEI">MEI</option>
            <option value="ATA">ATA</option>
        </select>
        <label>Número da Camisa: </label>
        <input type="text" name="num_cami">
        <label>Time: </label>
        <select name="times" id="time-select">
            <option value="" selected disabled>Selecione...</option>
        </select>
    </form>

</body>
</html>