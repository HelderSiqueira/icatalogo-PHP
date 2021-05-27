create database icatalogo;

use icatalogo;

create table tbl_produto(
    id int primary key auto_increment,
    peso decimal(10,2) not null,
    descricao varchar(255) not null,
    quantidade int not null,
    cor varchar(100) not null,
    tamanho varchar(100),
    valor decimal(10,2) not null,
    desconto int,
    imagem varchar(500)
);

create table tbl_administrador (
    id int primary key auto_increment,
    nome varchar(255) not null,
    usuario varchar(255) not null,
    senha varchar(255) not null
);

create table tbl_categoria (
    id int primary key auto_increment,
    descricao varchar(255) not null
);

insert into tbl_administrador (nome, usuario, senha) values ("Fulano de Tal","fulano","123456");

insert into tbl_administrador (nome, usuario, senha) values ("Ciclano da Silva","ciclano","654321");

# deleta a tabela tbl_produto
drop table tbl_produto;

# deleta o produto na tabela de produtos com o id ?
delete from tbl_produto where id = ?;

SELECT * FROM tbl_produto;

ALTER TABLE tbl_produto
ADD COLUMN categoria_id int,
ADD FOREIGN KEY (categoria_id) REFERENCES tbl_categoria(id);

TRUNCATE tbl_produto;

SELECT p.*, c.descricao as categoria FROM tbl_produto p
INNER JOIN tbl_categoria c ON p.categoria_id = c.id
ORDER BY p.id DESC