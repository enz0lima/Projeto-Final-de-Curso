
<html>
<head>
    <title>Adicionar Funcionário</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
    <a href="categoriaTable">Categoria</a>
                                </div>
                                </div>
            <a href="cargoTable.php" class="home-button">Cargos</a>
            <a href="funcTable.php" class="home-button">Funcionários</a>
            <a href="restTable.php" class="home-button">Restaurantes</a>
            <a href="livroTable.php" class="home-button">Livros</a>
        </div>
    </header>

    <main></main>
    <br/><br/>

    <h2><font size="+3">Incluir Funcionário</font></h2>
    <div class="cont">
        <div class="box">
            <form action="funcBD.php" method="post" name="form1">
            <div class="form-group">
                    <label for="nome_completo" class="form-label">Nome Completo</label>
                    <input type="text" id="nome_completo" name="nome_completo" class="input-field" autocomplete="off" required>
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
                    <input type="date" id="data_admissao" name="data_admissao" class="input-field" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="salario" class="form-label">Salário</label>
                    <input type="number" id="salario" name="salario" class="input-field" autocomplete="off" required>
                </div>
            </div>
            <div class="imagem">
                <img src="assets/logo.jpg" alt="logo">
            </div>
		</div>
            <div class="button-container">
                <input type="button" value="Voltar" onclick="history.back()" class="back-button">
                <input type="submit" name="Submit" value="Salvar" class="submit-button">
            </div>
        </form>
	
</body>
</html>
