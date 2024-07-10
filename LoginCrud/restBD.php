<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
    exit; // Terminar o script para evitar execução adicional
}
 ?>
 <html> 
 <head>
 </head>
 <body>
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
// Incluindo o arquivo de conexão com o banco de dados
include_once("connection.php");

if (isset($_POST['Submit'])) {

    $nomeRestaurante = $_POST['nomeRestaurante'];
    $cnpj = $_POST['cnpj'];
    $contato = $_POST['contato'];
    $endereco = $_POST['endereco'];

    // Verificando campos vazios
    if (empty($nomeRestaurante) || empty($cnpj) || empty($contato) || empty($endereco)) {
        echo "<font color='red'>Preencha todos os campos obrigatórios.</font><br/>";
        
        // Voltar para a página anterior
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
        // Se todos os campos estiverem preenchidos (não vazios)
        
        // Preparar a consulta usando declaração preparada
        $stmt = $mysqli->prepare("INSERT INTO restaurante (nomeRestaurante, cnpj, contato, endereco) VALUES (?, ?, ?, ?)");
        
        // Vincular parâmetros e executar a consulta
        $stmt->bind_param("ssss", $nomeRestaurante, $cnpj, $contato, $endereco);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            // Exibir mensagem de sucesso se a inserção for bem-sucedida
            echo "<div class='success-box'>";
            echo "<div class='blur-effect'></div>";
            echo "<p class='success-message'>Restaurante adicionado com sucesso!!</p>";
            echo "<a class='login-button' href='restTable.php'>Ver Resultado</a>";
            echo "</div>";
        } else {
            // Exibir mensagem de erro se a inserção falhar
            echo "<font color='red'>Erro ao adicionar dados.</font>";
        }

        // Fechar a declaração preparada
        $stmt->close();
    }
}
?>
 </body>
 </html>