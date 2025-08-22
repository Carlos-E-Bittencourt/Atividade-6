<?php
require_once '../../db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("location: read.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"])) {
        $sql = "DELETE FROM times WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $param_id);
            $param_id = $id;

            if ($stmt->execute()) {
                header("location: read.php");
                exit();
            } else {
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            $stmt->close();
        }
        $conn->close();
    }
} else {
    // Verificar se o time existe antes de exibir o formulário de confirmação
    $sql = "SELECT * FROM times WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $param_id);
        $param_id = $id;

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows != 1) {
                header("location: read.php");
                exit();
            }
        } else {
            echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Excluir Time</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body>
    <?php include '../../header.php'; ?>

    <div class="container">
        <h2>Excluir Time</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
            <div class="alert alert-danger">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <p>Tem certeza que deseja excluir este time?</p>
                <p>
                    <input type="submit" value="Sim" class="btn btn-danger">
                    <a href="read.php" class="btn btn-secondary">Não</a>
                </p>
            </div>
        </form>
    </div>

    <?php include '../../footer.php'; ?>
</body>

</html>