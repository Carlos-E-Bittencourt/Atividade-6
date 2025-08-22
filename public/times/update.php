<?php

include '../db.php';

$id_time = $_GET['id'];

$sql = "SELECT * FROM times WHERE id='$id_time'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $name = $_POST['nome'];
    $cidade = $_POST['cidade'];

    $sql = "UPDATE times SET nome='$name', cidade='$cidade' WHERE id='$id_time'";

    if ($conn->query($sql) === true) {
        echo "Registro atualizado com sucesso!
                <a href='read.php'>Ver registros.</a>
";
    } else {
        echo "Erro " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atualizar Jogador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid p-1 ms-5 me-5">
            <a class="navbar-brand fs-2" href="#">Atualizar Time</a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row ms-5 mt-5 me-5">

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row['nome']; ?>" aria-describedby="Nome" placeholder="Nome" required>
                </div>

                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $row['cidade']; ?>" placeholder="Cidade" required>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar</button>
                <input type="button" value="Cancelar" onclick="window.location.href='read.php'" class="btn btn-primary">
            </form>
        </div>

    </div>