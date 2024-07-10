<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
    exit; // Terminar o script para evitar execução adicional
}

include_once("connection.php");

// Verificar se o formulário foi enviado
if (isset($_POST['update'])) {
    $idReceita = $_POST['idReceita'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $medida_id = $_POST['medida_id'];
    $categoria_id = $_POST['categoria_id'];
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

    // Validação dos campos (opcional, você pode adicionar mais validações)
    if (empty($nome) || empty($descricao) ||empty($medida_id) ||empty($categoria_id) || empty($dataCriacao) || empty($ingredientes) || empty($modoPreparo) || empty($tempoPreparo) || empty($calorias) || empty($rendimento) || empty($indPrecoMedio) || empty($indDificuldade) || empty($qtdPorcoes) || empty($dataUltAtualizacao) || empty($tempoTotal) || empty($valorCusto)) {
        echo "<font color='red'>Preencha todos os campos obrigatórios.</font><br/>";
        echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
    } else {
        // Atualizando a tabela
        
        $result = mysqli_query($mysqli, "UPDATE Receita SET nome='$nome', descricao='$descricao', medida_id='$medida_id', categoria_id='$categoria_id', dataCriacao='$dataCriacao', ingredientes='$ingredientes', modoPreparo='$modoPreparo', tempoPreparo='$tempoPreparo', calorias='$calorias', rendimento='$rendimento', indPrecoMedio='$indPrecoMedio', indDificuldade='$indDificuldade', qtdPorcoes='$qtdPorcoes', dataUltAtualizacao='$dataUltAtualizacao', tempoTotal='$tempoTotal', valorCusto='$valorCusto' WHERE idReceita=$idReceita");

        if ($result) {
            // Redirecionando para a página de exibição
            header("Location: receitaTable.php");
        } else {
            echo "<font color='red'>Erro ao atualizar dados.</font>";
        }
    }
}

// Obtendo id da URL
if (isset($_GET['id'])) {
    $idReceita = $_GET['id'];
} else {
    echo "ID não definido.";
    exit;
}

// Selecionando dados associados a este id
$result = mysqli_query($mysqli, "SELECT * FROM Receita WHERE idReceita=$idReceita");

while ($res = mysqli_fetch_array($result)) {
    $nome = $res['nome'];
    $descricao = $res['descricao'];
    $medida_id = $res['medida_id'];
    $categoria_id = $res['categoria_id'];
    $dataCriacao = $res['dataCriacao'];
    $ingredientes = $res['ingredientes'];
    $modoPreparo = $res['modoPreparo'];
    $tempoPreparo = $res['tempoPreparo'];
    $calorias = $res['calorias'];
    $rendimento = $res['rendimento'];
    $indPrecoMedio = $res['indPrecoMedio'];
    $indDificuldade = $res['indDificuldade'];
    $qtdPorcoes = $res['qtdPorcoes'];
    $dataUltAtualizacao = $res['dataUltAtualizacao'];
    $tempoTotal = $res['tempoTotal'];
    $valorCusto = $res['valorCusto'];
}
?>


<html>
<head>
    <title>Editar Receita</title>
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

    <main>
    </main>

    <br></br>

    <h2><font size="+3">Editar Receita</font></h2>

    <div class="cont"> 
<div class="box">
    <form action="editReceita.php" method="post" name="form1">
        <div class="form-group">
            <label for="nome" class="form-label">Nome da Receita:</label>
            <input type="text" id="nome" name="nome" class="input-field" autocomplete="off" value="<?php echo $nome; ?>" required>
        </div>

        <div class="form-group">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea id="descricao" name="descricao" class="input-field" rows="4" required><?php echo $descricao; ?></textarea>
        </div>

        <div class="form-group">
        <label for="cargo" class="form-label">Categoria</label>
        <select id="categoria" name="categoria_id" class="input-field" required>
          <option disabled selected value="">Selecione a categoria</option>
      <?php
      include_once("connection.php");
      $result = mysqli_query($mysqli, "SELECT id, categoria FROM categoria");
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='".$row['id']."'>".$row['categoria']."</option>";
          }
      } else {
          echo "<option value=''>Nenhuma categoria encontrado</option>";
      }
      ?>
  </select>
</div>

        <div class="form-group">
            <label for="dataCriacao" class="form-label">Data de Criação:</label>
            <input type="date" id="dataCriacao" name="dataCriacao" class="input-field" value="<?php echo $dataCriacao; ?>" required>
        </div>

        <div class="form-group">
    <label for="ingredientes" class="form-label">Ingredientes:</label>
    <textarea id="ingredientes" name="ingredientes" class="input-field" rows="8" required><?php echo htmlspecialchars($ingredientes); ?></textarea>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ingredientesTextarea = document.getElementById('ingredientes');

    // Adiciona um hífen na primeira linha ao começar a digitar
    ingredientesTextarea.addEventListener('keydown', function(e) {
        if (this.value.trim() === '' && (e.key !== 'Enter' && e.keyCode !== 13)) {
            this.value = '- ';
        }
    });

    ingredientesTextarea.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            e.preventDefault(); // Evita a quebra de linha padrão

            let text = this.value;
            let cursorPosition = this.selectionStart;
            let textBeforeCursor = text.substring(0, cursorPosition);
            let textAfterCursor = text.substring(cursorPosition);

            // Adiciona um hífen e uma quebra de linha após o hífen, se necessário
            if (textBeforeCursor.trim().length === 0) {
                text = '- ' + textAfterCursor;
            } else {
                text = textBeforeCursor + '\n- ' + textAfterCursor;
            }

            // Atualiza o valor no textarea
            this.value = text;

            // Move o cursor para após o hífen adicionado
            this.selectionStart = this.selectionEnd = cursorPosition + 3;
        }
    });
});
</script>
<div class="form-group">
        <label for="medida" class="form-label">Medida</label>
        <select id="medida" name="medida_id" class="input-field" required>
          <option disabled selected value="">Selecione a Medida</option>
      <?php
      include_once("connection.php");
      $result = mysqli_query($mysqli, "SELECT id, medida FROM medida");
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='".$row['id']."'>".$row['medida']."</option>";
          }
      } else {
          echo "<option value=''>Nenhuma medida encontrado</option>";
      }
      ?>
  </select>
</div>
        <div class="form-group">
            <label for="modoPreparo" class="form-label">Modo de Preparo:</label>
            <textarea id="modoPreparo" name="modoPreparo" class="input-field" rows="8" required><?php echo $modoPreparo; ?></textarea>
        </div>

        <div class="form-group">
            <label for="tempoPreparo" class="form-label">Tempo de Preparo:</label>
            <input type="time" id="tempoPreparo" name="tempoPreparo" class="input-field" value="<?php echo $tempoPreparo; ?>" required>
        </div>

        <div class="form-group">
            <label for="calorias" class="form-label">Calorias:</label>
            <input type="number" id="calorias" name="calorias" class="input-field" value="<?php echo $calorias; ?>" required>
        </div>

        <div class="form-group">
            <label for="rendimento" class="form-label">Rendimento (pessoas):</label>
            <input type="text" id="rendimento" name="rendimento" class="input-field" maxlength="4" value="<?php echo $rendimento; ?>" required>
        </div>

        <div class="form-group">
            <label for="indPrecoMedio" class="form-label">Preço Médio (1 - 5):</label>
            <select id="indPrecoMedio" name="indPrecoMedio" class="input-field" required>
                <option value="1" <?php if ($indPrecoMedio == 1) echo "selected"; ?>>1 - Muito Baixo</option>
                <option value="2" <?php if ($indPrecoMedio == 2) echo "selected"; ?>>2 - Baixo</option>
                <option value="3" <?php if ($indPrecoMedio == 3) echo "selected"; ?>>3 - Médio</option>
                <option value="4" <?php if ($indPrecoMedio == 4) echo "selected"; ?>>4 - Alto</option>
                <option value="5" <?php if ($indPrecoMedio == 5) echo "selected"; ?>>5 - Muito Alto</option>
            </select>
        </div>

        <div class="form-group">
            <label for="indDificuldade" class="form-label">Dificuldade (1 - 3):</label>
            <select id="indDificuldade" name="indDificuldade" class="input-field" required>
                <option value="1" <?php if ($indDificuldade == 1) echo "selected"; ?>>1 - Fácil</option>
                <option value="2" <?php if ($indDificuldade == 2) echo "selected"; ?>>2 - Médio</option>
                <option value="3" <?php if ($indDificuldade == 3) echo "selected"; ?>>3 - Difícil</option>
            </select>
        </div>

        <div class="form-group">
            <label for="qtdPorcoes" class="form-label">Quantidade de Porções:</label>
            <input type="number" id="qtdPorcoes" name="qtdPorcoes" class="input-field" value="<?php echo $qtdPorcoes; ?>" required>
        </div>

        <div class="form-group">
            <label for="dataUltAtualizacao" class="form-label">Data da Última Atualização:</label>
            <input type="date" id="dataUltAtualizacao" name="dataUltAtualizacao" class="input-field" value="<?php echo $dataUltAtualizacao; ?>" required>
        </div>

        <div class="form-group">
            <label for="tempoTotal" class="form-label">Tempo Total (horas:minutos):</label>
            <input type="time" id="tempoTotal" name="tempoTotal" class="input-field" value="<?php echo $tempoTotal; ?>" required>
        </div>

        <div class="form-group">
            <label for="valorCusto" class="form-label">Valor do Custo (R$):</label>
            <input type="number" id="valorCusto" name="valorCusto" class="input-field" value="<?php echo $valorCusto; ?>" required>
        </div>
        </div>
        <input type="hidden" name="idReceita" value="<?php echo $idReceita; ?>">

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