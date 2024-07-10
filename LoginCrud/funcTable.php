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
$result = mysqli_query($mysqli, "SELECT f.*, c.cargo FROM funcionarios f JOIN Cargo c ON f.cargo_id = c.id ORDER BY f.nome_completo ASC");
?>

<html>
<head>
	<title>Funcionários</title>
	<link rel="stylesheet" type="text/css" href="css/add.css">
	<style>
		*{
			margin:0;
			box-sizing: border-box;
			padding: 0;
		}
		@media (max-width: 1366px){
        .tabela{
            padding: 70px 8px;
            width: 95%;
        }
		.edit-button,
        .delete-button{
             padding: 8px 6px;
            
        }
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
	<Br>
	<center>
	<div class="tabela">
		<div class="title">Listar Funcionários</div>
		<div style="display: flex; justify-content: space-between; align-items: center;">
		<a href="funcAdd.php" class="add-button">Adicionar funcionários</a>	
		<span></span>
	<br>
	<table width='65%' height='7%' border=0,5>	
	<thead>
	<tr bgcolor='white'>
	        <td><b>Cargo</b></td>        
	        <td><b>Nome</b></td>
			<td><b>Data de Admissão</b></td>
			<td><b>Salário</b></td>
		</tr>
	</thead>
	</div>
	
</center> 

		<?php
		while($res = mysqli_fetch_array($result)) {		
			echo "<tr bgcolor='white'>";
			echo "<td style='color: #ffbc2a'>".$res['cargo']."</td>";
			echo "<td>".$res['nome_completo']."</td>";
			echo "<td>".date_format(date_create($res['data_admissao']), "d/m/Y")."</td>";			
			echo "<td>R$ ".number_format($res['salario'], 2, ',', '.')."</td>";	
			echo "<td><a href=\"editFunc.php?id=$res[id]\" class=\"edit-button\">Editar</a> | <a href=\"deleteFunc.php?id=$res[id]\" class=\"delete-button\" onClick=\"return confirm('Tem certeza que deseja deletar?')\">Deletar</a></td>";
		}
		?>
	</table>	
</body>
</html>
