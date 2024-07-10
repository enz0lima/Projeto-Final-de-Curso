<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
    exit; // Terminar o script para evitar execução adicional
}

include_once("connection.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $cargo = $_POST['cargo'];
    $descricao = $_POST['descricao'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $cargo_ativo = isset($_POST['cargo_ativo'])? 1 : 0;

    // Verificando campos vazios
    if (empty($cargo) || empty($descricao) || empty($data_inicio) || empty($data_fim)) {
        echo "<font color='red'>Preencha todos os campos obrigatórios.</font><br/>";
        
        // Voltar para a página anterior
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // Atualizando a tabela
        $result = mysqli_query($mysqli, "UPDATE Cargo SET cargo='$cargo', descricao='$descricao', data_inicio='$data_inicio', data_fim='$data_fim', cargo_ativo='$cargo_ativo' WHERE id=$id");
        
        if ($result) {
            // Redirecionando para a página de exibição. No nosso caso, é cargoTable.php
            header("Location: cargoTable.php");
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
$result = mysqli_query($mysqli, "SELECT * FROM Cargo WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
    $cargo = $res['cargo'];
    $descricao = $res['descricao'];
    $data_inicio = $res['data_inicio'];
    $data_fim = $res['data_fim']; 
    $cargo_ativo = $res['cargo_ativo'];

}
?>

<html>
<head>
    <title>Editar Cargo</title>
    <link rel="stylesheet" type="text/css" href="css/edit.css">
    <style>
        *{
            margin:0;
            padding:0;
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
    <a href="categoriaTable">Categoria</a>
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
    
    <h2><font size="+3">Editar Cargo</font></h2>
     <div class="cont"> 
    <div class="box">
    <form action="editCargo.php" method="post" name="form1">
        <div class="form-group">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" id="cargo" name="cargo" class="input-field" autocomplete="off" value="<?php echo $cargo; ?>" required>
        </div>      
    
        <div class="form-group">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" id="descricao" name="descricao" class="input-field" autocomplete="off" value="<?php echo $descricao; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="data_inicio" class="form-label">Data de Início</label>
            <input type="date" id="data_inicio" name="data_inicio" class="input-field" autocomplete="off" value="<?php echo $data_inicio; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="data_fim" class="form-label">Data Fim</label>
            <input type="date" id="data_fim" name="data_fim" class="input-field" autocomplete="off" value="<?php echo $data_fim; ?>" required>
        </div>
        
        <div class="form-group">
				<label for="cargo_ativo" class="form_label">Indicador de Cargo Ativo:</label>
				 <input type="checkbox" name="cargo_ativo" value="1" class="checkbox" <?php echo ($cargo_ativo == 1) ? 'checked' : ''; ?>> 
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
