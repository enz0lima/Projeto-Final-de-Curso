<?php
session_start();


if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
    exit;
}


include_once("connection.php");


$result = mysqli_query($mysqli, "SELECT r.*, c.categoria AS categoria_nome, m.medida AS medida_nome FROM Receita r LEFT JOIN categoria c ON r.categoria_id = c.id LEFT JOIN Medida m ON r.medida_id = m.id ORDER BY r.idReceita DESC");
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
        @media (max-width: 1366px){
    
        .tabela{
            padding: 70px 2px;
            width: 98%;
        }
        .edit-button,
        .delete-button{
             padding: 8px 19px;
            
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
            <div class="title">Listar Receitas</div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="ReceitaAdd.php" class="add-button">Adicionar Receita</a>
                <span></span>
                <br>
            <table width='65%' height='70%' border=0,5>
                <thead>
                <tr bgcolor='white'>
                    <td><b>Categoria</b></td>
                        <td><b>Nome</b></td>
                        <td><b>Descrição</b></td>
                        <td><b>Medida</b></td>
                        <td><b>Data de Criação</b></td>
                    </tr>
                </thead>
                </div>
    </center>
                
                    <?php
                    while ($res = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td style='color: #ffbc2a'>".$res['categoria_nome']."</td>";
                        echo "<td><b>" . $res['nome'] . "</b></td>";
                        echo "<td>" . $res['descricao'] . "</td>";
                        echo "<td style='color: #ffbc2a'>".$res['medida_nome']."</td>";
                        echo "<td>" . date_format(date_create($res['dataCriacao']), "d/m/Y") . "</td>";
                        echo "<td><a href=\"editReceita.php?id=" . $res['idReceita'] . "\" class=\"edit-button\">Editar</a> | <a href=\"deleteReceita.php?id=" . $res['idReceita'] . "\" class=\"edit-button\" onClick=\"return confirm('Tem certeza que deseja deletar esta receita?')\">Deletar</a> | <a href=\"option.php?id=" . $res['idReceita'] . "&nome=" . $res['nome'] . "\" class=\"edit-button\">+ Opções</a></td>";
                        echo "</tr>";
                    }
                    ?>
                
            </table>
        
</body>
</html>