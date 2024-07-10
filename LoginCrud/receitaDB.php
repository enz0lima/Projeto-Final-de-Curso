<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
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
<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
    exit;
}

// Incluindo o arquivo de conexão com o banco de dados
include_once("connection.php");

// Verificar se o formulário foi enviado
if (isset($_POST['Submit'])) {
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $categoria_id = $_POST['categoria_id'];
    $medida_id = $_POST['medida_id'];
    $dataCriacao = $_POST['dataCriacao'];
    $ingredientes = $_POST['ingredientes'];
    $modoPreparo = $_POST['modoPreparo'];
    $tempoPreparo = $_POST['tempoPreparo'];
    $calorias = $_POST['calorias'];
    $rendimento = $_POST['rendimento'];
    $indPrecoMedio = $_POST['indPrecoMedio'];
    $indDificuldade = $_POST['indDificuldade'];
    $qtdPorcoes = $_POST['qtdPorcoes'];
    $dataUltAtualizacao = $_POST['dataUltAtualizacao'];
    $tempoTotal = $_POST['tempoTotal'];
    $valorCusto = $_POST['valorCusto'];
    $id = $_SESSION['id'];

    // Validação dos campos (opcional, você pode adicionar mais validações)
    if (empty($nome) || empty($descricao) || empty($categoria_id) || empty($medida_id) || empty($dataCriacao) || empty($ingredientes) || empty($modoPreparo) || empty($tempoPreparo) || empty($calorias) || empty($rendimento) || empty($indPrecoMedio) || empty($indDificuldade) || empty($qtdPorcoes) || empty($dataUltAtualizacao) || empty($tempoTotal) || empty($valorCusto)) {
        echo "<font color='red'>Preencha todos os campos obrigatórios.</font><br/>";
        echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
    } else {
        // Inserir dados no banco de dados
        $result = mysqli_query($mysqli, "INSERT INTO Receita (nome, descricao, categoria_id, medida_id, dataCriacao, ingredientes, modoPreparo, tempoPreparo, calorias, rendimento, indPrecoMedio, indDificuldade, qtdPorcoes, dataUltAtualizacao, tempoTotal, valorCusto) VALUES ('$nome','$descricao',$categoria_id,'$medida_id','$dataCriacao','$ingredientes','$modoPreparo','$tempoPreparo','$calorias','$rendimento','$indPrecoMedio','$indDificuldade','$qtdPorcoes','$dataUltAtualizacao','$tempoTotal','$valorCusto')");

        if ($result) {
            // Exibir mensagem de sucesso
            echo "<div class='success-box'>";
            echo "<div class='blur-effect'></div>";
            echo "<p class='success-message'>Receita adicionada com sucesso!!</p>";
            echo "<a class='login-button' href='receitaTable.php'>Ver Receitas</a>";
            echo "</div>";
        } else {
            // Exibir mensagem de erro
            echo "<font color='red'>Erro ao adicionar dados.</font>";
        }
    }
}
?>