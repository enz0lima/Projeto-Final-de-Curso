<?php
session_start();


if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
    exit;
}


include_once("connection.php");


$result = mysqli_query($mysqli, "SELECT * FROM Receita ORDER BY idReceita DESC");
?>


<html>
<head>
    <title>Receitas</title>
    <link rel="stylesheet" type="text/css" href="css/add.css">
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
            padding: 0;
        }
        table {
    width: 70%;
    border-collapse: collapse;
    margin: 0 auto;
}
.add-button{
                right: 21vh;
                top: 27vh;
            }  
            .title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 27px;
    text-align: left;
   
    margin-left: 60px;
}

@media (max-width: 1366px){
    table {
        width: 80%; 
         } 

.add-button{
                right: 24vh;
                top: 34vh;
            }  
            .title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 27px;
    text-align: left;
   
    margin-left: 60px;
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
 <Br>   
 <center>
        <div class="tabela">
            <div class="title">
                <?php
$id = $_GET['id'];
$nome = $_GET['nome'];

echo  $nome;
?>
</div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="receitaTable.php" class="add-button">Voltar a tabela</a>
             
                <span></span>
                <br>
            <table width='60%' height='70%' border=0,5>
            <tbody>
                        <?php
                        while ($res = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td><b>Ingredientes</b></td>";
                            echo "<td style='list-style-type: none; padding-left: 0;'>"; // Estilo para remover bolinhas
                            
                            // Supondo que $res['ingredientes'] é uma string contendo os ingredientes separados por quebras de linha
                            $ingredientes = explode("\n", $res['ingredientes']);
                            
                            echo "<ul style='list-style-type: none; padding-left: 0;'>"; // Estilo para remover bolinhas
                            
                            foreach ($ingredientes as $ingrediente) {
                                $ingrediente = trim($ingrediente); // Remove espaços em branco extras
                            
                                // Verifica se o ingrediente não está vazio
                                if (!empty($ingrediente)) {
                                    echo "<li> " . htmlspecialchars($ingrediente) . "</li>"; // Adiciona um item de lista com um hífen
                                }
                            }
                            
                            echo "</tr>";
                            echo "<td><b>Tempo de Preparo</b></td>";
                            $tempo_preparo = date_create($res['tempoPreparo']);
                            $horas_preparo = date_format($tempo_preparo, 'H');
                            $minutos_preparo = date_format($tempo_preparo, 'i');
                            echo "<td>" . $horas_preparo . " Hr " . $minutos_preparo . " Min</td>";
                            echo "</tr>";
                            echo "<td><b>Calorias</b></td>";
                            echo "<td>" . $res['calorias'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td><b>Modo de Preparo</b></td>";
                            echo "<td>" . $res['modoPreparo'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td><b>Rendimento</b></td>";
                            echo "<td>" . $res['rendimento'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td><b>Preço Médio</b></td>";
                            echo "<td>" . $res['indPrecoMedio'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td><b>Dificuldade</b></td>";
                            echo "<td>" . $res['indDificuldade'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td><b>Quantidade de Porções</b></td>";
                            echo "<td>" . $res['qtdPorcoes'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td><b>Data da Últ. Atualização</b></td>";
                            echo "<td>" . date_format(date_create($res['dataUltAtualizacao']), "d/m/Y") . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td><b>Tempo Total</b></td>";
                            $tempo_total = date_create($res['tempoTotal']);
                            $horas = date_format($tempo_total, 'H');
                            $minutos = date_format($tempo_total, 'i');
                            echo "<td>" . $horas . " Hr " . $minutos . " Min</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td><b>Valor do Custo</b></td>";
                            echo "<td>R$ " . number_format($res['valorCusto'], 2, ',', '.') . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </center>
    </main>
</body>
</html>