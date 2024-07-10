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
    $idRestaurante = $_POST['idRestaurante'];
    $nomeRestaurante = $_POST['nomeRestaurante'];
    $cnpj = $_POST['cnpj'];
    $contato = $_POST['contato'];
    $endereco = $_POST['endereco'];
    
    // Verificando campos vazios
    if (empty($nomeRestaurante) || empty($cnpj) || empty($contato) || empty($endereco)) {
        if (empty($nomeRestaurante)) {
            echo "<font color='red'>O campo (Nome) está vazio</font><br/>";
        }
        if (empty($cnpj)) {
            echo "<font color='red'>O campo (CNPJ) está vazio</font><br/>";
        }
        if (empty($contato)) {
            echo "<font color='red'>O campo (Contato) está vazio</font><br/>";
        }
        if (empty($endereco)) {
            echo "<font color='red'>O campo (Endereço) está vazio</font><br/>";
        }
    } else {
        // Atualizando a tabela
        $result = mysqli_query($mysqli, "UPDATE Restaurante SET nomeRestaurante='$nomeRestaurante', cnpj='$cnpj', contato='$contato', endereco='$endereco' WHERE idRestaurante=$idRestaurante");
        
        // Redirecionando para a página de exibição. No nosso caso, é funcTable.php
        header("Location: restTable.php");
    }
}
?>

<?php
// Obtendo id da URL
$idRestaurante = $_GET['idRestaurante'];

// Selecionando dados associados a este id
$result = mysqli_query($mysqli, "SELECT * FROM Restaurante WHERE idRestaurante=$idRestaurante");

while ($res = mysqli_fetch_array($result)) {
    $nomeRestaurante = $res['nomeRestaurante'];
    $cnpj = $res['cnpj'];
    $contato = $res['contato'];
    $endereco = $res['endereco'];
}
?>

<html>
<head>
    <title>Editar dados</title>
    <link rel="stylesheet" type="text/css" href="css/edit.css">
    <style>
        /* Seu CSS aqui */
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

<h2><font size="+3">Editar Restaurante</font></h2>
<div class="cont"> 
<div class="box">
<form action="editRest.php" method="post" name="form1">
    <div class="form-group">
        <label for="nomeRestaurante" class="form-label">Nome Completo</label>
        <input type="text" id="nomeRestaurante" name="nomeRestaurante" class="input-field" autocomplete="off" value="<?php echo $nomeRestaurante; ?>" required>
    </div>
    <div class="form-group">
        <label for="cnpj" class="form-label">CNPJ</label>
        <input type="text" id="cnpj" name="cnpj" class="input-field" autocomplete="off" value="<?php echo $cnpj; ?>" required>
    </div>
    <div class="form-group">
        <label for="contato" class="form-label">Contato</label>
        <input type="text" id="contato" name="contato" class="input-field" autocomplete="off" value="<?php echo $contato; ?>" required>
    </div>
    <div class="form-group">
        <label for="endereco" class="form-label">Endereço</label>
        <input type="text" id="endereco" name="endereco" class="input-field" autocomplete="off" value="<?php echo $endereco; ?>" required>
    </div>
    </div>
    <input type="hidden" name="idRestaurante" value="<?php echo $idRestaurante; ?>">
    
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
