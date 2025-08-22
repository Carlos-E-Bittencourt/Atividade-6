<?php

    include '../db.php';

    $id_partida = $_GET['id'];

    $sql = "SELECT * FROM partidas WHERE id='$id_partida'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $time_casa_id = $_POST['time_casa_id'];
        $time_fora_id = $_POST['time_fora_id'];
        $data_jogo = $_POST['data_jogo'];
        $gols_casa = $_POST['gols_casa'];
        $gols_fora = $_POST['gols_fora'];

        $sql = "UPDATE partidas SET time_casa_id='$time_casa_id', time_fora_id='$time_fora_id', data_jogo='$data_jogo', gols_casa='$gols_casa', gols_fora='$gols_fora' WHERE id='$id_partida'";

        if($conn -> query($sql) === true){
            echo "Registro atualizado com sucesso!
                <a href='read.php'>Ver registros.</a>
";
        }else{
            echo"Erro " . $sql . "<br>" . $conn->error;
        }
        $conn -> close();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atualizar Partida</title>
    <link rel="stylesheet" href="../styles/style.css">
  </head>

    <body>
        <div class="container">
        <h1>Atualizar Partida</h1>
        <form action="" method="POST">
            <label for="time_casa_id">ID Time Casa:</label>
            <input type="text" id="time_casa_id" name="time_casa_id" value="<?php echo $row['time_casa_id']; ?>" required>

            <label for="time_fora_id">ID Time Fora:</label>
            <input type="text" id="time_fora_id" name="time_fora_id" value="<?php echo $row['time_fora_id']; ?>" required>

            <label for="data_jogo">Data Jogo:</label>
            <input type="date" id="data_jogo" name="data_jogo" value="<?php echo $row['data_jogo']; ?>" required>

            <label for="gols_casa">Gols Time Casa:</label>
            <input type="number" id="gols_casa" name="gols_casa" value="<?php echo $row['gols_casa']; ?>" required>

            <label for="gols_fora">Gols Time Fora:</label>
            <input type="number" id="gols_fora" name="gols_fora" value="<?php echo $row['gols_fora']; ?>" required>

            <input type="submit" value="Atualizar">
            <input type="button" value="Cancelar" onclick="window.location.href='read.php'">
           
        </form>
        </div>