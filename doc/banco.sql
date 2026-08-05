create database crud_php;
use crud_php;

create table tb_tarefas (
	id int(3) zerofill auto_increment not null primary key,
    nm_nome varchar(50),
    ds_descricao varchar(150),
    ds_tipo enum('urgente', 'mediano', 'basico'),
    dt_termino timestamp default current_timestamp null,
    dt_criacao timestamp default current_timestamp
);

drop table tb_tarefas