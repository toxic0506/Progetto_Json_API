create database if not exists emma_pilotto_ecommerce;
create table if not exists ecommerce.products
(
    id int not null auto_increment primary key,
    nome varchar(50),
    prezzo float,
    marca varchar(50)
    );