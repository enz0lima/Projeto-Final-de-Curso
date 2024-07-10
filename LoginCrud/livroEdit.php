<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header('Location: index.php');
    exit;
}
?>

<?php
// Incluindo o arquivo de conexão com o banco de dados
include_once("connection.php");

if (isset($_POST['update'])) {
    $idLivro = $_POST['idLivro'];
    $titulo = $_POST['titulo'];
    $edicao = $_POST['edicao'];
    $isbn = $_POST['isbn'];

    // Verificando campos vazios
    if (empty($titulo) || empty($edicao) || empty($isbn)) {
        if (empty($titulo)) {
            echo "<font color='red'>O campo (título) está vazio</font><br/>";
        }
        if (empty($edicao)) {
            echo "<font color='red'>O campo (edição) está vazio</font><br/>";
        }
        if (empty($isbn)) {
            echo "<font color='red'>O campo (isbn) está vazio</font><br/>";
        }
    } else {
        // Atualizando a tabela
        $result = mysqli_query($mysqli, "UPDATE Livro SET titulo='$titulo', edicao='$edicao', isbn='$isbn' WHERE idLivro=$idLivro");

        // Redirecionando para a página de exibição. No nosso caso, é livroTable.php
        if ($result) {
            header("Location: livroTable.php");
            exit;
        } else {
            echo "<font color='red'>Erro ao atualizar o livro.</font>";
        }
    }
}

// Obtendo id da URL
$idLivro = $_GET['idLivro'] ?? null;

if (!$idLivro) {
    echo "ID não definido.";
    exit;
}

// Selecionando dados associados a este id
$result = mysqli_query($mysqli, "SELECT * FROM Livro WHERE idLivro=$idLivro");

if ($res = mysqli_fetch_array($result)) {
    $titulo = $res['titulo'];
    $edicao = $res['edicao'];
    $isbn = $res['isbn'];
} else {
    echo "Livro não encontrado.";
    exit;
}
?>

<html>
<head>
    <title>Editar dados</title>
    <link rel="stylesheet" type="text/css" href="css/edit.css">
    <style>
        * {
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

<br/><br/>

<h2><font size="+3">Editar Livros</font></h2>

<div class="cont">
    <div class="box">
        <form action="livroEdit.php" method="post" name="form1">
            <div class="form-group">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" name="titulo" class="input-field" autocomplete="off" value="<?php echo $titulo; ?>" required>
            </div>
            <div class="form-group">
                <label for="edicao" class="form-label">Edição</label>
                <input type="text" id="edicao" name="edicao" class="input-field" autocomplete="off" value="<?php echo $edicao; ?>" required>
            </div>
            <div class="form-group">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" id="isbn" name="isbn" class="input-field" autocomplete="off" value="<?php echo $isbn; ?>" required>
            </div>
            </div>
    <div class="imagem">
        <img src="assets/logo.jpg" alt="logo">
    </div>
</div>
            <input type="hidden" name="idLivro" value="<?php echo $idLivro; ?>">
            <div class="button-container">
                <input type="button" value="Voltar" onclick="history.back()" class="back-button">
                <input type="submit" name="update" value="Salvar" class="submit-button">
            </div>
        </form>
    
</body>
</html>
