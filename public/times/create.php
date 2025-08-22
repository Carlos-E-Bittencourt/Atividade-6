<?php

    include '../db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['nome']);
            $cidade = trim($_POST['cidade']);

            $sql = "INSERT INTO times (nome, cidade) VALUES ('$name', '$cidade')";


        if ($conn->query($sql) === true) {
                echo "Registro criado com sucesso!
                <a href='../index.php'>Ver registros.</a>";
        } else {
            echo "Erro: " . $conn->error;
        }

        $conn->close();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Time</title>
    <link rel="stylesheet" href="../styles/style.css">
  </head>

    <body>
        <div class="container">
        <h1>Criar Time</h1>
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required>
        
            <input type="submit" value="Criar">
            <input type="button" value="Cancelar" onclick="window.location.href='read.php'">
        </form>
        </div>

    </body>