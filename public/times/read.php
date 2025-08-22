<?php
include '../../db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 5;
$offset = ($page - 1) * $records_per_page;

if ($search) {
    $sql = "SELECT * FROM times WHERE nome LIKE ? OR cidade LIKE ? ORDER BY id DESC LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%$search%";
    $stmt->bind_param("ssii", $search_param, $search_param, $offset, $records_per_page);
} else {
    $sql = "SELECT * FROM times ORDER BY id DESC LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $offset, $records_per_page);
}

$stmt->execute();
$result = $stmt->get_result();

// Contar total de registros para paginação
if ($search) {
    $count_sql = "SELECT COUNT(*) as total FROM times WHERE nome LIKE ? OR cidade LIKE ?";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->bind_param("ss", $search_param, $search_param);
} else {
    $count_sql = "SELECT COUNT(*) as total FROM times";
    $count_stmt = $conn->prepare($count_sql);
}

$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $records_per_page);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lista de Times</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<body>
    <?php include '../../header.php'; ?>

    <div class="container">
        <h2>Lista de Times</h2>

        <div class="action-bar">
            <form method="GET" action="read.php" class="search-form">
                <input type="text" name="search" placeholder="Buscar times..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Buscar</button>
            </form>
            <a href="create.php" class="btn btn-success">Adicionar Novo Time</a>
        </div>

        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead><tr><th>ID</th><th>Nome</th><th>Cidade</th><th>Ações</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['cidade'] . "</td>";
                echo "<td>";
                echo "<a href='update.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>";
                echo "<a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Excluir</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";

            // Paginação
            if ($total_pages > 1) {
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = $i == $page ? "active" : "";
                    echo "<a href='read.php?page=" . $i . "&search=" . urlencode($search) . "' class='$active'>" . $i . "</a>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>Nenhum time encontrado.</p>";
        }
        ?>
    </div>

    <?php include '../../footer.php'; ?>
</body>

</html>