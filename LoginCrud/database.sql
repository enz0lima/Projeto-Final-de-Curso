create database `crud_with_login`;

use `crud_with_login`;

CREATE TABLE `login` (
  `id` int(9) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,  
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

CREATE TABLE products (
  id int(11) NOT NULL auto_increment,
  name varchar(100) NOT NULL,
  cargo int(5) NOT NULL,
  price decimal(10,2) NOT NULL,
  login_id int(11) NOT NULL,
  PRIMARY KEY  (id),
  CONSTRAINT FK_products_1
  FOREIGN KEY (login_id) REFERENCES login(id)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Usuario (
    idUsuario INT,
    login VARCHAR(25),
    senha VARCHAR(32),
    idRestaurante SMALLINT,
    idFuncao INT,
    PRIMARY KEY (idUsuario)
);

CREATE TABLE `Restaurante` (
    `idRestaurante` SMALLINT AUTO_INCREMENT,
    `nomeRestaurante` VARCHAR(25),
    `cnpj` VARCHAR(14),
    `contato` VARCHAR(20),
    `endereco` VARCHAR(100),
    PRIMARY KEY (idRestaurante)
);

CREATE TABLE Referencia (
    idUsuario INT,
    idRestaurante SMALLINT,
    data_ini DATE,
    PRIMARY KEY (idUsuario, idRestaurante),
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario),
    FOREIGN KEY (idRestaurante) REFERENCES Restaurante(idRestaurante)
);
CREATE TABLE `Cargo` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `cargo` VARCHAR(255) NOT NULL,
    `descricao` VARCHAR(255) NOT NULL,
    `data_inicio` DATE NOT NULL,
    `data_fim` DATE NOT NULL,
    `cargo_ativo` TINYINT(1) NOT NULL DEFAULT 0
)ENGINE=InnoDB;

CREATE TABLE `Livro` (
    `idLivro` SMALLINT AUTO_INCREMENT PRIMARY KEY,
    `titulo` VARCHAR(50),
    `isbn` DECIMAL(13,0),
    `edicao` INT
)ENGINE=InnoDB;

CREATE TABLE Publicacao (
    idLivro SMALLINT,
    ano YEAR,
    PRIMARY KEY (idLivro),
    FOREIGN KEY (idLivro) REFERENCES Livro(idLivro)
);

CREATE TABLE `Categoria` (
     `id` INT AUTO_INCREMENT PRIMARY KEY,
    `categoria` VARCHAR(255) NOT NULL
    
);

CREATE TABLE `Receita` (
    `idReceita` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` MEDIUMTEXT,
    `descricao` TEXT,
    `categoria_id` INT,
    `medida_id` INT,
    `dataCriacao` DATE,
    `ingredientes` MEDIUMTEXT,
    `modoPreparo` MEDIUMTEXT,
    `tempoPreparo` TIME,
    `calorias` DECIMAL(6,1),
    `rendimento` CHAR(4),
    `indPrecoMedio` CHAR(2),
    `indDificuldade` CHAR(1),
    `qtdPorcoes` DECIMAL(3,0),
    `dataUltAtualizacao` DATE,
    `tempoTotal` TIME,
    `valorCusto` DECIMAL,
     FOREIGN KEY (`categoria_id`) REFERENCES `Categoria`(`id`),
     FOREIGN KEY (`medida_id`) REFERENCES `Medida`(`id`)
);


CREATE TABLE Ingrediente (
    idIngrediente INT,
    nome VARCHAR(75),
    descricao MEDIUMTEXT,
    PRIMARY KEY (idIngrediente)
);

CREATE TABLE Composicao (
    idReceita INT,
    idIngrediente SMALLINT,
    qtde FLOAT,
    medida VARCHAR(10),
    PRIMARY KEY (idReceita, idIngrediente),
    FOREIGN KEY (idReceita) REFERENCES Receita(idReceita),
    FOREIGN KEY (idIngrediente) REFERENCES Ingrediente(idIngrediente)
);
CREATE TABLE Parametro_Sistema (
    mes_producao SMALLINT,
    ano_producao YEAR,
    qtd_receita SMALLINT,
    PRIMARY KEY (mes_producao, ano_producao)
);

CREATE TABLE fotos_receita (
    idphotos INT,
    imagem LONGBLOB,
    descricao VARCHAR(255),
    Receita_id_cozinheiro INT,
    Receita_nome VARCHAR(45),
    PRIMARY KEY (idphotos)
);

CREATE TABLE `Medida` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `medida` VARCHAR(255) NOT NULL,
    `descricao` VARCHAR(255) NOT NULL
);

CREATE TABLE `funcionarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `cargo_id` INT NOT NULL,
    `nome_completo` VARCHAR(255) NOT NULL,
    `data_admissao` DATE NOT NULL,
    `salario`  DECIMAL(10, 2),
    `cargo_ativo` TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (`cargo_id`) REFERENCES `cargo`(`id`)
) ENGINE=InnoDB;



SELECT cargo FROM Cargo;
