create database loja;
use loja;

create table funcao_usuarios(
id int not null primary key auto_increment,
nome varchar(50) not null
);

insert into funcao_usuarios(nome) values ("usuarios");
insert into funcao_usuarios(nome) values ("admin");
insert into funcao_usuarios(nome) values ("gerente");

create table usuarios(
id int not null primary key auto_increment,
id_funcao int not null,
nome varchar(50) not null unique,
email varchar(50) not null unique,
senha varchar(50) not null 
);

create table vantagens_produtos(
id int not null primary key auto_increment,
id_produto int not null,
vantagem varchar(50) not null
);

create table produtos(
id int not null primary key auto_increment,
id_categoria int not null,
url_imagem varchar(50) not null,
nome varchar(50) not null,
descricao varchar(50) not null,
valor decimal(10, 2) not null
);

create table categorias_produtos(
id int not null primary key auto_increment,
nome varchar(50) not null unique
);

insert into categorias_produtos(nome) values ("Esportes");
insert into categorias_produtos(nome) values ("Culinária");
insert into categorias_produtos(nome) values ("Movéis");
insert into categorias_produtos(nome) values ("Eletrônicos");
insert into categorias_produtos(nome) values ("Roupas");


create table carrinho_produtos(
id int not null primary key auto_increment,
id_produto int not null,
id_usuario int not null
);
