<?php
require_once '../../db.php';

$nome = $cidade = "";
$nome_err = $cidade_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_nome = trim($_POST["nome"]);
    if (empty($input_nome)) {
        $nome_err = "Por favor, insira um nome para o time.";
    } else {
        $nome = $input_nome;
    }

    $input_cidade = trim($_POST["cidade"]);
    if (empty($input_cidade)) {
        $cidade_err = "Por favor, insira uma cidade para o time.";
    } else {
        $cidade = $input_cidade;
    }

    if (empty($nome_err) && empty($cidade_err)) {
        $sql = "INSERT INTO times (nome, cidade) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $param_nome, $param_cidade);

            $param_nome = $nome;
            $param_cidade = $cidade;

            if ($stmt->execute()) {
                header("location: read.php");
                exit();
            } else {
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Time</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body>
    <?php include '../../header.php'; ?>

    <div class="container">
        <h2>Adicionar Novo Time</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control <?php echo (!empty($nome_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nome; ?>">
                <span class="invalid-feedback"><?php echo $nome_err; ?></span>
            </div>
            <div class="form-group">
                <label>Cidade</label>
                <input type="text" name="cidade" class="form-control <?php echo (!empty($cidade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cidade; ?>">
                <span class="invalid-feedback"><?php echo $cidade_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Adicionar">
                <a href="read.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <?php include '../../footer.php'; ?>
</body>

</html>