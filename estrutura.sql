create database testeKabum;
use testeKabum;



CREATE TABLE usuarios (
    codigo INTEGER AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    usuario VARCHAR(30) UNIQUE NOT NULL,
    senha VARCHAR(30) NOT NULL,
);

create table clientes (
    codigo integer AUTO_INCREMENT PRIMARY KEY,
    nome varchar(200) not null,
    data_nascimento date not null,
    cpf varchar(14) UNIQUE not null,
    rg varchar(20),
    telefone varchar(20),
    ativo char(1) default 'S' not null,
    usuario_exclusao integer,

    FOREIGN KEY (usuario_exclusao) REFERENCES usuarios(codigo)
);

create table enderecos (
    codigo integer AUTO_INCREMENT PRIMARY KEY,
    codigo_cliente integer not null,
    descricao varchar(200) not null,
    numero varchar(10),
    bairro varchar(200),
    cidade varchar(200),
    estado varchar(200),
	complemento varchar(200),
    FOREIGN KEY (codigo_cliente) REFERENCES clientes(codigo)
);




create table clientes_historico (
    codigo integer AUTO_INCREMENT PRIMARY KEY,
    codigo_cliente integer not null,
    datahora timestamp default current_timestamp not null,
    usuario_alteracao integer not null,
    nome varchar(200) not null,
    data_nascimento date not null,
    cpf varchar(14) UNIQUE not null,
    rg varchar(20),
    telefone varchar(20),

    FOREIGN KEY (codigo_cliente) REFERENCES clientes(codigo),
    FOREIGN KEY (usuario_alteracao) REFERENCES usuarios(codigo)
);



insert into usuarios (nome, usuario, senha) values ('Mateus', 'mateus', 'senha123');