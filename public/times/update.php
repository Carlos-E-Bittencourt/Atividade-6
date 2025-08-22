<?php

    include '../db.php';

    $id_time = $_GET['id'];

    $sql = "SELECT * FROM times WHERE id='$id_time'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $name = $_POST['nome'];
        $cidade = $_POST['cidade'];

        $sql = "UPDATE times SET nome='$name', cidade='$cidade' WHERE id='$id_time'";

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
    <title>Atualizar Jogador</title>
    <link rel="stylesheet" href="../styles/style.css">
  </head>

    <body>
        <div class="container">
        <h1>Atualizar Time</h1>
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="<?php echo $row['cidade']; ?>" required>
        
            <input type="submit" value="Atualizar">
            <input type="button" value="Cancelar" onclick="window.location.href='read.php'">
        </form>
        </div>