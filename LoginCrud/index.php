<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">


</head>
<body>
<?php
include("connection.php");

if (isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($mysqli, $_POST['username']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

    if ($user == "" || $pass == "") {
        echo "Either username or password field is empty.";
        echo "<br/>";
        echo "<a href='inicio.php'>Go back</a>";
    } else {
        $result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' AND password=md5('$pass')") or die("Could not execute the select query.");
        $row = mysqli_fetch_assoc($result);

        if (is_array($row) && !empty($row)) {
            $validuser = $row['username'];
            $_SESSION['valid'] = $validuser;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
        } else {
            echo "Invalid username or password.";
            echo "<br/>";
            echo "<a href='index.php'>Go back</a>";
        }

        if (isset($_SESSION['valid'])) {
            header('Location: cargoTable.php');
        }
    }
} else {
?>
    
	
	<div class="container">
        <img src="assets/logo.jpg" alt="logo" class="logo-image">
    </div>

    <div class="box" id="tamanho" style="margin-top:2px;">
        <h2><font size="+3">LOGIN</font></h2>

        <form name="form1" method="post" action="">
            <div class="form-group">
                <label for="username" class="form-label">Usuário</label>
                <input type="text" id="username" name="username" placeholder="Digite seu Usuário" class="input-field" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite sua Senha" class="input-field" autocomplete="off" required>
            </div>
            <input type="submit" name="submit" value="Entrar" class="submit-button">
        </form>

        <div style="margin-top:2px;">
            <p>Não possui conta? <a href="register.php">Cadastrar</a></p>
        </div>
    </div>
<?php
}
?>
</body>
</html>
