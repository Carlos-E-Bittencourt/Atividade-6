<?php

    include '../db.php';

    $id_jogador = $_GET['id'];

    $sql = "SELECT * FROM jogadores WHERE id='$id_jogador'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $name = $_POST['nome'];
        $posicao = $_POST['posicao'];
        $numero_camisa = $_POST['numero_camisa'];
        $time_id = $_POST['time_id'];

        $sql = "UPDATE jogadores SET nome='$name', posicao='$posicao', numero_camisa='$numero_camisa', time_id='$time_id' WHERE id='$id_jogador'";

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
        <h1>Atualizar Jogador</h1>
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>
    
            <label for="posicao">Posição:</label>
            <select name="posicao" class="form-control" required>
                <option value="ATA" <?php if($row['posicao']=='ATA') echo 'selected'; ?>>ATA</option>
                <option value="MEI" <?php if($row['posicao']=='MEI') echo 'selected'; ?>>MEI</option>
                <option value="DEF" <?php if($row['posicao']=='DEF') echo 'selected'; ?>>DEF</option>
                <option value="GOL" <?php if($row['posicao']=='GOL') echo 'selected'; ?>>GOL</option>
            </select>
    
            <label for="numero_camisa">Número da Camisa:</label>
            <input type="number" id="numero_camisa" name="numero_camisa" value="<?php echo $row['numero_camisa']; ?>" required>
    
            <label for="time_id">ID do Time:</label>
            <input type="number" id="time_id" name="time_id" value="<?php echo $row['time_id']; ?>" required>
    
            <input type="submit" value="Atualizar">
        </form>
        </div>