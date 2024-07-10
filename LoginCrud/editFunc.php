<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
    header('Location: index.php');
    exit; // Adicionando exit para garantir que o script não continue executando
}
?>

<?php
// Incluindo o arquivo de conexão com o banco de dados
include_once("connection.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome_completo = $_POST['nome_completo'];
    $cargo_id = $_POST['cargo_id'];
    $data_admissao = $_POST['data_admissao'];
    $salario = $_POST['salario'];
    $cargo_ativo = isset($_POST['cargo_ativo']) ? 1 : 0;
    
    // Verificando campos vazios
    if (empty($nome_completo) || empty($cargo_id) || empty($data_admissao) || empty($salario)) {
        if (empty($nome_completo)) {
            echo "<font color='red'>O campo (Nome) está vazio</font><br/>";
        }
        if (empty($cargo_id)) {
            echo "<font color='red'>O campo (Cargo) está vazio</font><br/>";
        }
        if (empty($data_admissao)) {
            echo "<font color='red'>O campo (Data de Admissão) está vazio</font><br/>";
        }
        if (empty($salario)) {
            echo "<font color='red'>O campo (Salário) está vazio</font><br/>";
        }
    } else {
        // Atualizando a tabela
        $result = mysqli_query($mysqli, "UPDATE funcionarios SET nome_completo='$nome_completo', cargo_id='$cargo_id', data_admissao='$data_admissao', salario='$salario', cargo_ativo='$cargo_ativo' WHERE id=$id");
        
        // Redirecionando para a página de exibição. No nosso caso, é funcTable.php
        header("Location: funcTable.php");
    }
}
?>

<?php
// Obtendo id da URL
$id = $_GET['id'];

// Selecionando dados associados a este id
$result = mysqli_query($mysqli, "SELECT * FROM funcionarios WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
    $nome_completo = $res['nome_completo'];
    $cargo_id = $res['cargo_id'];
    $data_admissao = $res['data_admissao'];
    $salario = $res['salario'];
    $cargo_ativo = $res['cargo_ativo'];
}
?>

<html>
<head>
    <title>Editar dados</title>
    <link rel="stylesheet" type="text/css" href="css/edit.css">
    <style>
        *{
            margin: 0;
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

<br/><br/>

<h2><font size="+3">Editar Funcionário</font></h2>

<div class="cont"> 
<div class="box">
<form action="editFunc.php" method="post" name="form1">
    <div class="form-group">
        <label for="nome_completo" class="form-label">Nome Completo</label>
        <input type="text" id="nome_completo" name="nome_completo" class="input-field" autocomplete="off" value="<?php echo $nome_completo; ?>" required>
    </div>
    <div class="form-group">
					<label for="cargo" class="form-label">Cargo</label>
					<select id="cargo" name="cargo_id" class="input-field" required>
						<option disabled selected value="">Selecione um cargo</option>
        <?php
        include_once("connection.php");
        $result = mysqli_query($mysqli, "SELECT id, cargo FROM Cargo");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['id']."'>".$row['cargo']."</option>";
            }
        } else {
            echo "<option value=''>Nenhum cargo encontrado</option>";
        }
        ?>
    </select>
</div>
    <div class="form-group">
        <label for="data_admissao" class="form-label">Data de Admissão</label>
        <input type="date" id="data_admissao" name="data_admissao" class="input-field" autocomplete="off" value="<?php echo $data_admissao; ?>" required>
    </div>
    <div class="form-group">
        <label for="salario" class="form-label">Salário</label>
        <input type="number" id="salario" name="salario" class="input-field" autocomplete="off" value="<?php echo $salario; ?>" required>
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
