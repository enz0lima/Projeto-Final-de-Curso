<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
    exit; // Terminar o script para evitar execução adicional
}

include_once("connection.php");

// Obtendo id da URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "ID não definido.";
    exit;
}

// Deletando dados associados a este id
$result = mysqli_query($mysqli, "DELETE FROM Livro WHERE idLivro=$id");

if ($result) {
    // Redirecionando para a página de exibição. No nosso caso, é livroTable.php
    header("Location: livroTable.php");
} else {
    echo "<font color='red'>Erro ao deletar livro.</font>";
}
?>
