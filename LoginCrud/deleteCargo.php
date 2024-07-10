<?php
include("connection.php");

if (isset($_GET['id'])) {
    $idCargo = $_GET['id'];

    // Verifique se há funcionários associados a este cargo
    $checkQuery = "SELECT * FROM funcionarios WHERE cargo_id = $idCargo";
    $checkResult = mysqli_query($mysqli, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Deletar funcionários associados
        $deleteFuncionariosQuery = "DELETE FROM funcionarios WHERE cargo_id = $idCargo";
        mysqli_query($mysqli, $deleteFuncionariosQuery);
    }

    // Agora delete o cargo
    $deleteCargoQuery = "DELETE FROM cargo WHERE id = $idCargo";
    if (mysqli_query($mysqli, $deleteCargoQuery)) {
        header("Location: cargoTable.php");
    } else {
        echo "Erro ao deletar cargo: " . mysqli_error($mysqli);
    }
} else {
    echo "ID não definido.";
}
?>
