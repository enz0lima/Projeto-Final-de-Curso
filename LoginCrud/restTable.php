<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: index.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM Restaurante ORDER BY nomeRestaurante ASC");
?>

<html>
<head>
	<title>Restaurantes</title>
	<link rel="stylesheet" type="text/css" href="css/add.css">
	<style>
		*{
			margin:0;
			box-sizing: border-box;
			padding: 0;
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
  </header>

  <main>
    </main>
	
	<br/>
	<center>
	<div class="tabela">
		<div class="title">Listar Restaurantes</div>
		<div style="display: flex; justify-content: space-between; align-items: center;">
		<a href="restAdd.html" class="add-button">Adicionar Restaurantes</a>
	
		<span></span>
	<br>
	<table width='65%' height='7%' border=0,5>	
	<thead>
	<tr bgcolor='white'>
	        <td><b>Nome</b></td>
			<td><b>CNPJ</b></td>
			<td><b>Contato</b></td>
			<td><b>Endereço</b></td>
		</tr>
	</thead>
	</div>
		<?php
		while($res = mysqli_fetch_array($result)) {		
			echo "<tr bgcolor='white'>";
			echo "<td>".$res['nomeRestaurante']."</td>";
			echo "<td>".$res['cnpj']."</td>";
			echo "<td>".$res['contato']."</td>";	
			echo "<td>".$res['endereco']."</td>";
			echo "<td><a href=\"editRest.php?idRestaurante=$res[idRestaurante]\" class=\"edit-button\">Editar</a> | <a href=\"deleteRest.php?id=$res[idRestaurante]\" class=\"edit-button\" onClick=\"return confirm('Tem certeza que deseja deletar?')\">Deletar</a></td>";		
		}
		?>
	</table>	
</body>
</html>