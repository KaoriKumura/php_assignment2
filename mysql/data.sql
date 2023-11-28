CREATE DATABASE student_db;

USE student_db;

CREATE TABLE student_tb (
    id int not null auto_increment,
	password varchar (255),
	fname varchar (255),
	lname varchar (255),
	phone varchar (255),
	email varchar (255),
    primary key (user_id)
);

CREATE table admin(
	id int not null auto_increment,
	password varchar (255),
	fname varchar (255),
	lname varchar (255),
	email varchar (255),
	telNumber varchar (255),
    primary key (ID)
);