<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
    header('Location: index.php');
}
?>

<?php
// including the database connection file
include_once("connection.php");

// fetching data in descending order (latest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM livro ORDER BY titulo ASC");
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Livros</title>
    <link rel="stylesheet" type="text/css" href="css/add.css">
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
            padding: 0;
        }
        @media (max-width: 1366px){
    .add-button{
                right: 13vh;
                top: 33vh;
            }  
            table {
    width: 80%;
    border-collapse: collapse;
    margin-bottom:auto;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
}
    .add-button{
                right: 30vh;
                top: 33vh;
            }  
} 

table {
    width: 80%;
    border-collapse: collapse;
    margin-bottom:auto;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
}
    </style>
</head>

<body>
<header>
<div class="container">
		  <a href="" class="logo">
			<img src="assets/logo.jpg" alt="Logo do site">
		  </a>
        <a href="logout.php" class="logout">
            <img src="assets/logout.png" alt="Sair do site">
        </a>
        <div class="header">
    <a href="receitaTable.php" class="home-button">Receitas</a>
    <div id="dropdown" class="dropdown-content">
    <a href="medidaTable.php">Medidas</a>
    <a href="categoriaTable.php">Categoria</a>
                                </div>
                                </div>
        <a href="cargoTable.php" class="home-button">Cargos</a>
        <a href="funcTable.php" class="home-button">Funcionários</a> 
        <a href="restTable.php" class="home-button">Restaurantes</a>
        <a href="livroTable.php" class="home-button">Livros</a>
    </div>
</header>

<main>
</main>
<br>
<center>
<div class="tabela">
    <div class="title">Listar Livros</div>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="livroAdd.html" class="add-button">Adicionar Livro</a>
    </div>
    <br>
    <table width='65%' height='7%' border="0.5">
        <thead>
            <tr bgcolor='white'>
                <td><b>Título</b></td>
                <td><b>Edição</b></td>
                <td><b>ISBN</b></td>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($res = mysqli_fetch_array($result)) {
                echo "<tr bgcolor='white'>";
                echo "<td style='color: #ffbc2a'>".$res['titulo']."</td>";
                echo "<td>".$res['edicao']."</td>";
                echo "<td>".$res['isbn']."</td>";  
                echo "<td><a href=\"livroEdit.php?idLivro=".$res['idLivro']."\" class=\"edit-button\">Editar</a> | <a href=\"livroDelete.php?id=".$res['idLivro']."\" class=\"delete-button\" onClick=\"return confirm('Tem certeza que deseja deletar?')\">Deletar</a></td>";  
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</center>
</body>
</html>
