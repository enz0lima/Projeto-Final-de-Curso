<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
    exit; // Terminar o script para evitar execução adicional
}
?>

<?php
// Incluindo o arquivo de conexão com o banco de dados
include("connection.php");

// Verificando se o ID do cargo foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deletando o cargo da tabela
    $result = mysqli_query($mysqli, "DELETE FROM categoria WHERE id=$id");

    // Verificando se a exclusão foi bem-sucedida
    if ($result) {
        // Redirecionando para a página de exibição dos cargos
        header("Location: categoriaTable.php");
    } else {
        // Exibindo uma mensagem de erro se a exclusão falhar
        echo "<font color='red'>Erro ao deletar a categoria.</font>";
    }
} else {
    // Exibindo uma mensagem de erro se o ID não for passado na URL
    echo "Parâmetro ID não definido.";
}
?>
