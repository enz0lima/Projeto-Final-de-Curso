<?php
session_start();

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
    $result = mysqli_query($mysqli, "DELETE FROM Medida WHERE id=$id");

    // Verificando se a exclusão foi bem-sucedida
    if ($result) {
        // Redirecionando para a página de exibição dos cargos
        header("Location: medidaTable.php");
        exit; // Terminar o script para garantir que o redirecionamento aconteça
    } else {
        // Exibindo uma mensagem de erro se a exclusão falhar
        echo "<font color='red'>Erro ao deletar a medida: " . mysqli_error($mysqli) . "</font>";
    }
} else {
    // Exibindo uma mensagem de erro se o ID não for passado na URL
    echo "<font color='red'>Parâmetro ID não definido.</font>";
}
?>
