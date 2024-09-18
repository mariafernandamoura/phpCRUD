<?php
    include("database/conexaoBD.php");

/* if (!isset($_GET["raAluno"])) { */
if (!isset($_POST["id"])) {
    echo "Selecione o aluno a ser excluído!";
} else {
    /* $ra = $_GET["raAluno"]; */
    $id = $_POST["id"];

    try {
        $stmt = $pdo->prepare('DELETE FROM coffee WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("location: consulta.php");
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    $pdo = null;
}

?>
