<?php

include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $time_casa_id = $_POST['time_casa_id'];
    $time_fora_id = $_POST['time_fora_id'];
    $data = $_POST['data_jogo'];
    $gols_casa = $_POST['gols_casa'];
    $gols_fora = $_POST['gols_fora'];

    $sql = "INSERT INTO partidas (time_casa_id, time_fora_id, data_jogo, gols_casa, gols_fora) VALUES ('$time_casa_id', '$time_fora_id', '$data', '$gols_casa', '$gols_fora')";

    if ($conn->query($sql) === true) {
        echo "Partida criada com sucesso!
        <a href='read.php'>Ver partidas.</a>";
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
    <title>Criar Partida</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <div class="container">
        <h1>Criar Partida</h1>
        <form action="" method="POST">
            <label for="time_casa_id">ID do Time da Casa:</label>
            <input type="text" id="time_casa_id" name="time_casa_id" required>

            <label for="time_fora_id">ID do Time de Fora:</label>
            <input type="text" id="time_fora_id" name="time_fora_id" required>

            <label for="data_jogo">Data do Jogo:</label>
            <input type="date" id="data_jogo" name="data_jogo" required>

            <label for="gols_casa">Gols do Time da Casa:</label>
            <input type="number" id="gols_casa" name="gols_casa" required>

            <label for="gols_fora">Gols do Time de Fora:</label>
            <input type="number" id="gols_fora" name="gols_fora" required>

            <input type="submit" value="Criar">
            <input type="button" value="Cancelar" onclick="window.location.href='read.php'">
        </form>
    </div>
</body>

</html>
