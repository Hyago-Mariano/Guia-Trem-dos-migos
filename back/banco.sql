CREATE DATABASE guiatrem;

USE guiatrem;

CREATE TABLE usuario(
    id_usuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    email_usuario VARCHAR(100) NOT NULL UNIQUE, /*unique dois usuarios não podem ter o memso email no banco de dados*/
    senha_usuario VARCHAR(255) NOT NULL, /*espaço suficiente para guardar o hash de senhas.*/
    funcao VARCHAR(50) NOT NULL
);

CREATE TABLE trem(
    id_trem INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    linha_trem VARCHAR(50) NOT NULL
);

CREATE TABLE manutencao(
    id_manutencao INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    data_manutencao DATE NOT NULL,
    tipo_manutencao VARCHAR(50),
    descricao_manutencao VARCHAR(50) NOT NULL,
    observacao_manutencao VARCHAR(50) NOT NULL,
    status_manutencao VARCHAR(50) NOT NULL,
    fk_trem INT NOT NULL, 
    FOREIGN KEY (fk_trem) REFERENCES trem(id_trem),
    fk_usuario INT NOT NULL,
    FOREIGN KEY (fk_usuario) REFERENCES trem(id_usuario)
);