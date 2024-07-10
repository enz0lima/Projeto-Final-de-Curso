<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
    exit; // Terminar o script para evitar execução adicional
}

include_once("connection.php");

if (isset($_POST['update'])) {
    $categoria = $_POST['categoria'];
	$id = $_SESSION['id'];

    // Verificando campos vazios
    if (empty($categoria)) {
        echo "<font color='red'>Preencha todos os campos obrigatórios.</font><br/>";
        
        // Voltar para a página anterior
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // Atualizando a tabela
        $result = mysqli_query($mysqli, "UPDATE categoria SET categoria='$categoria' WHERE id=$id");
        
        if ($result) {
            // Redirecionando para a página de exibição. No nosso caso, é cargoTable.php
            header("Location: categoriaTable.php");
        } else {
            echo "<font color='red'>Erro ao atualizar dados.</font>";
        }
    }
}

// Obtendo id da URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "ID não definido.";
    exit;
}

// Selecionando dados associados a este id
$result = mysqli_query($mysqli, "SELECT * FROM categoria WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
    $categoria = $res['categoria'];
  
}
?>

<html>
<head>
    <title>Editar Categorias</title>
    <link rel="stylesheet" type="text/css" href="css/edit.css">
    <style>
        *{
            margin:0;
            padding:0;
        }
        
.button-container{ 

margin-top: -13vh;
margin-left: 25vh;
}
@media (max-width: 1366px){

.button-container{ 

	margin-top: -17vh;
	margin-left: 20vh;
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
  
    <br></br>
    
    <h2><font size="+3">Editar Categorias</font></h2>
     <div class="cont"> 
    <div class="box">
    <form action="editCategoria.php" method="post" name="form1">
        <div class="form-group">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" id="categoria" name="categoria" class="input-field" autocomplete="off" value="<?php echo $categoria; ?>" required>
        </div>      
    
        
           </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    
    <div class="imagem">
        <img src="assets/logo.jpg" alt="logo">
    </div>
    </div>
    <div class="button-container">
            <input type="button" value="Voltar" onclick="history.back()" class="back-button">
            <input type="submit" name="update" value="Salvar" class="submit-button">
        </div>
        </form>
</body>
</html>
