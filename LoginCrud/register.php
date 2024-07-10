<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
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
<a href="index.php"  class="home-button">Home</a> <br />
<?php
include("connection.php");

if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$user = $_POST['username'];
	$pass = $_POST['password'];

	if($user == "" || $pass == "" || $name == "" || $email == "") {
		echo "<div class='error-message'>Todos os campos devem ser preenchidos. Pelo menos um campo está vazio.</div>";
    echo "<br/>";
	
	} else {
		mysqli_query($mysqli, "INSERT INTO login(name, email, username, password) VALUES('$name', '$email', '$user', md5('$pass'))")
			or die("Could not execute the insert query.");
			
			echo "<div class='success-box'>";
			echo "<div class='blur-effect'></div>";
			echo "<p class='success-message'>Registrado com sucesso!!</p>";
			echo "<a class='login-button' href='index.php'>Login</a>";
			echo "</div>";
	}
} else {
?>
<div class="container">
        <img src="assets/logo.jpg" alt="logo" class="logo-image">
    </div>
	<div class="box";>
        <h2><font size="+3">CADASTRO</font></h2>
	<form name="form1" method="post" action="">
			<form name="form1" method="post" action="">
            <div class="form-group">
                <label for="name" class="form-label">Nome Completo</label>
                <input type="text" id="name" name="name"  class="input-field" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="text" class="form-label">Email</label>
                <input type="text" id="email" name="email" class="input-field" autocomplete="off" required>
            </div>
			<div class="form-group">
                <label for="username" class="form-label">Usuário</label>
                <input type="text" id="username" name="username"  class="input-field" autocomplete="off" required>
            </div>
			<div class="form-group">
                <label for="password" class="form-label">Crie uma Senha</label>
                <input type="password" id="password" name="password"  class="input-field" autocomplete="off" required>
				</div>
            <input type="submit" name="submit" value="Cadastrar" class="submit-button">
        </form>
		
<?php
}
?>
</body>
</html>
