create database Ecommerce;
Use Ecommerce;
create table category(
id varchar(5),
category varchar(20),
CategoryRank int,
CategoryStatus varchar(10)
);
create table product(
pId varchar(5),
categoryId varchar(5),
productName varchar(20),
price int,
productStatus varchar(10),
description varchar(100),
image varchar(100)
);
insert into category value('1A','Grocery',1,'Published');
insert into product value('P1','1A','Mustard Oil',450,'Published','Mustard Cooking Oil','mustardOil.png');
select* from category;
select* from product;
