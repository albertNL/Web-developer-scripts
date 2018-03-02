create database form;

use form;

create table records (
	id int(11) unsigned auto_increment primary key,
	firstname varchar(30) not null,
	lastname varchar(30) not null,
	appname varchar(30) not null,
	pd varchar(150) not null,
	date timestamp
);
