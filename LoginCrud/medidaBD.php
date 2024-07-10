<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
	exit; // Terminar o script para evitar execução adicional
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

/* Estilos comuns para o corpo e o contêiner */
body, html {
    height: 100%;
    margin: 0;
	font-family: 'Montserrat';
}
	
	.success-box {
    border: 2px solid rgb(0, 0, 0);
    background-color: transparent;
    width: 300px;
    margin: 50px auto;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
}

body {
    background: linear-gradient(
     to top,
     white 0%,
       white 50%,
       #FFF0BA 60%,
       #FFF0BA 100%

    );
 display: flex;
 justify-content: center;
 align-items: center;
 margin-right: 30px;
 
}

.blur-effect {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    backdrop-filter: blur(10px); /* Aplica o efeito de blur */
    z-index: -1; /* Mantém o blur no fundo */
}

/* Estilo para a mensagem de sucesso */
.success-message {
    color: rgb(0, 0, 0);
    font-weight: bold;
    margin-bottom: 20px;
    font-size: larger;
}

.login-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ffbc2a;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.login-button:hover {
    background-color: #876604;
}


</style>
<body>
<?php
// Incluindo o arquivo de conexão com o banco de dados
include_once("connection.php");

if(isset($_POST['Submit'])) {	
    $medida = $_POST['medida'];
	$descricao = $_POST['descricao'];
	$id = $_SESSION['id'];

	// Verificando campos vazios
	if(empty($medida) || empty($descricao)) {
		echo "<font color='red'>Preencha todos os campos obrigatórios.</font><br/>";
		
		// Voltar para a página anterior
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// Se todos os campos estiverem preenchidos (não vazios)
			
		// Inserir dados no banco de dados	
		$result = mysqli_query($mysqli, "INSERT INTO medida (medida, descricao) VALUES ('$medida','$descricao')");
		
		if($result) {
			// Exibir mensagem de sucesso se a inserção for bem-sucedida
			echo "<div class='success-box'>";
			echo "<div class='blur-effect'></div>";
			echo "<p class='success-message'>Medida adicionado com sucesso!!</p>";
			echo "<a class='login-button' href='medidaTable.php'>Ver Resultado</a>";
			echo "</div>";
		} else {
			// Exibir mensagem de erro se a inserção falhar
			echo "<font color='red'>Erro ao adicionar dados.</font>";
		}
	}
}
?>
</body>
</html>
