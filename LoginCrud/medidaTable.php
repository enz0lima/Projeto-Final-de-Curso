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
$result = mysqli_query($mysqli, "SELECT * FROM Medida ORDER BY id ASC");
?>

<html>
<head>
	<title>Cargos</title>
	<link rel="stylesheet" type="text/css" href="css/add.css">
	<style>
		*{
			margin:0;
			box-sizing: border-box;
			padding: 0;
		}
		@media (max-width: 1366px){
        .tabela{
            padding: 70px 2px;
            width: 99%;
        }
        .edit-button,
        .delete-button{
             padding: 8px 19px;
            
        }
.add-button{
	right: 33vh;
	top: 33vh;
}  

.tabela{
padding: 70px 2px;
width: 78%;
}
.edit-button,
.delete-button{
 padding: 8px 19px;

}
td {
border: 2px solid #ddd;
padding: 10px 10px;
width: 10%;
text-align: center;
}
table {
width: 50%;
margin-right: auto;
margin-left: auto;
} 
} 
td {
border: 2px solid #ddd;
padding: 3vh 3vw;
text-align: center;
}
table {
width: 80%;
margin-right: auto;
margin-left: auto;
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
		<div class="title">Listar medidas</div>
		<div style="display: flex; justify-content: space-between; align-items: center;">
		<a href="MedAdd.html"  class="add-button">Adicionar medida</a>
	
		
	<br>
	<table width='65%' height='7%' border=0,5>	
	<thead>
	<tr bgcolor='white'>
			<td><b>Medida</b></td>
			<td><b>Descrição</b></td>
			
		</tr>
	</thead>
	</div>
</center> 

		<?php
		while($res = mysqli_fetch_array($result)) {		
			echo "<tr bgcolor='white'>";
			echo "<td style='color: #ffbc2a'>".$res['medida']."</td>";
			echo "<td>".$res['descricao']."</td>";
			echo "<td><a href=\"editMedida.php?id=$res[id]\" class=\"edit-button\">Editar</a> | <a href=\"deleteMedida.php?id=$res[id]\" class=\"delete-button\" onClick=\"return confirm('Tem certeza que deseja deletar?')\">Deletar</a></td>";
		}
		?>
	</table>	
</body>
</html>
