<html>
<head>
  <title>Adicionar Receita</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/edit.css"> 

  <style>
          *{
            margin: 0;
            padding: 0;
          }
          
          @media (max-width: 1920px){
          .imagem{
            margin-top: 10vh;
           
           
          }
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
  </header>

  <main>
    </main>
 
  <br><br>

  <h2><font size="+3">Adicionar Receita</font></h2>

<div class="cont"> 
<div class="box">
    <form action="receitaDB.php" method="post" name="form1">
    
      <div class="form-group">
        <label for="nome" class="form-label">Nome da Receita:</label>
        <input type="text" id="nome" name="nome" class="input-field" autocomplete="off" required>
      </div>

      <div class="form-group">
        <label for="descricao" class="form-label">Descrição:</label>
        <textarea id="descricao" name="descricao" class="input-field" rows="4" required></textarea>
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
        <label for="dataCriacao" class="form-label">Data de Criação:</label>
        <input type="date" id="dataCriacao" name="dataCriacao" class="input-field" required>
      </div>

      <div class="form-group">
    <label for="ingredientes" class="form-label">Ingredientes:</label>
    <textarea id="ingredientes" name="ingredientes" class="input-field" rows="8" required></textarea>
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
        <label for="modoPreparo" class="form-label">Modo de Preparo:</label>
        <textarea id="modoPreparo" name="modoPreparo" class="input-field" rows="8" required></textarea>
      </div>

      <div class="form-group">
        <label for="tempoPreparo" class="form-label">Tempo de Preparo:</label>
        <input type="time" id="tempoPreparo" name="tempoPreparo" class="input-field" required>
      </div>

      <div class="form-group">
        <label for="calorias" class="form-label">Calorias:</label>
        <input type="number" id="calorias" name="calorias" class="input-field" required>
      </div>

      <div class="form-group">
        <label for="rendimento" class="form-label">Rendimento (pessoas):</label>
        <input type="text" id="rendimento" name="rendimento" class="input-field" maxlength="4" required>
      </div>

      <div class="form-group">
        <label for="indPrecoMedio" class="form-label">Preço Médio (1 - 5):</label>
        <select id="indPrecoMedio" name="indPrecoMedio" class="input-field" required>
          <option value="1">1 - Muito Baixo</option>
          <option value="2">2 - Baixo</option>
          <option value="3">3 - Médio</option>
          <option value="4">4 - Alto</option>
          <option value="5">5 - Muito Alto</option>
        </select>
      </div>

      <div class="form-group">
        <label for="indDificuldade" class="form-label">Dificuldade (1 - 3):</label>
        <select id="indDificuldade" name="indDificuldade" class="input-field" required>
          <option value="1">1 - Fácil</option>
          <option value="2">2 - Médio</option>
          <option value="3">3 - Difícil</option>
        </select>
      </div>

      <div class="form-group">
        <label for="qtdPorcoes" class="form-label">Quantidade de Porções:</label>
        <input type="number" id="qtdPorcoes" name="qtdPorcoes" class="input-field" required>
      </div>

      <div class="form-group">
        <label for="dataUltAtualizacao" class="form-label">Data da Última Atualização:</label>
        <input type="date" id="dataUltAtualizacao" name="dataUltAtualizacao" class="input-field" required>
      </div>

      <div class="form-group">
        <label for="tempoTotal" class="form-label">Tempo Total (horas:minutos):</label>
        <input type="time" id="tempoTotal" name="tempoTotal" class="input-field" required>
      </div>

      <div class="form-group">
        <label for="valorCusto" class="form-label">Valor do Custo (R$):</label>
        <input type="number" id="valorCusto" name="valorCusto" class="input-field" required>
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