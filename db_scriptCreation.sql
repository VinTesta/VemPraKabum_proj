CREATE DATABASE projeto_kabum;

USE projeto_kabum;

CREATE TABLE usuario 
(
	idusuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nomeusuario VARCHAR(255) NOT NULL,
    emailusuario VARCHAR(255) NOT NULL,
    senhausuario VARCHAR(255) NOT NULL
);

CREATE TABLE cliente
(
	idcliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nomecliente VARCHAR(255) NOT NULL,
    datanascimento DATE NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    rg varchar(9) NOT NULL,
    telefone VARCHAR(11) NOT NULL
);

CREATE TABLE endereco
(
	idendereco INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cep VARCHAR(8) NOT NULL,
    logradouro VARCHAR(255) NOT NULL,
    numero VARCHAR(5) NOT NULL,
    bairro VARCHAR(255) NOT NULL,
    cidade VARCHAR(70) NOT NULL,
    estado VARCHAR(2) NOT NULL,
	pais VARCHAR(70) NOT NULL
);

CREATE TABLE clienteendereco
(
	idClienteEndereco INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cliente_idcliente INT NOT NULL,
    endereco_idendereco INT NOT NULL
);

ALTER TABLE clienteendereco ADD CONSTRAINT cliente_idcliente FOREIGN KEY ( cliente_idcliente ) REFERENCES cliente ( idcliente );
ALTER TABLE clienteendereco ADD CONSTRAINT endereco_idendereco FOREIGN KEY ( endereco_idendereco ) REFERENCES endereco ( idendereco );

SELECT * FROM endereco;
SELECT * FROM usuario;
SELECT * FROM cliente;
SELECT * FROM clienteendereco;
