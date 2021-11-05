create database if not exists FindYourJob;

use FindYourJob;


create table if not exists UserType (
id_UserType BIGINT UNSIGNED AUTO_INCREMENT not null,
description VARCHAR(30) not null ,
CONSTRAINT pk_idUserType PRIMARY KEY (id_UserType)
)ENGINE=INNODB;

INSERT INTO UserType (description) VALUES ('Admin');
INSERT INTO UserType (description) VALUES ('Student');
INSERT INTO UserType (description) VALUES ('Company');

create table if not exists User(
id_User BIGINT UNSIGNED AUTO_INCREMENT not null,
email VARCHAR(50) not null UNIQUE,
pass VARCHAR(45) not null , /*agregue el password */
idUserType BIGINT UNSIGNED not null,
constraint pk_idUser primary key(id_User),
constraint fk_idUserType foreign key (idUserType) references UserType(id_UserType)
)ENGINE=INNODB;

INSERT INTO `findyourjob`.`user` (`id_User`, `email`, `pass`, `idUserType`) VALUES ('1', 'admin@utn.com', 'adminutn1234', '1');

create table if not exists Career(
	id_Career BIGINT UNSIGNED AUTO_INCREMENT not null,
	description VARCHAR(60) not null ,
    active char(10) not null,
	constraint pk_idCarrer primary key(id_Career)
)ENGINE=INNODB;

create table if not exists City(
id_City BIGINT UNSIGNED AUTO_INCREMENT not null,
name VARCHAR(30) not null UNIQUE,
constraint pk_idCity primary key(id_City)
)ENGINE=INNODB;

INSERT INTO City (name) VALUES ('Mar del Plata'),('Bahia blanca'),('Gran Buenos Aires'),('Tandil'),('Cordoba'),('Rosario'),('La Plata'),('Salta'),('Merlo'), ('Quilmes');


create table if not exists Company(
id_Company BIGINT UNSIGNED AUTO_INCREMENT not null,
name varchar(50) not null UNIQUE, /*puse unico para no tener dos empresas con el mismo nombre*/
yearFoundation YEAR not null ,
description VARCHAR(50) not null ,
logo LONGBLOB not null ,
email VARCHAR(50) not null UNIQUE,
phoneNumber VARCHAR(20) not null UNIQUE,
idCity  BIGINT UNSIGNED not null,
constraint pk_idCompany primary key(id_Company),
constraint fk_idCity foreign key (idCity) references City(id_City) on update CASCADE
)ENGINE=INNODB;

create table if not exists JobPosition(
id_JobPosition BIGINT UNSIGNED AUTO_INCREMENT not null,
description VARCHAR(50) not null ,
idCareer  BIGINT UNSIGNED not null,
constraint pk_idJobPosition primary key(id_JobPosition),
constraint fk_idCareer foreign key (idCareer) references Career(id_Career) on update CASCADE
)ENGINE=INNODB;


create table if not exists JobOffer(
	id_JobOffer BIGINT UNSIGNED AUTO_INCREMENT not null,
	description VARCHAR(30) not null ,
	dateTime DATE  not null,
	limitDate DATE not null ,
	timeState int  not null,
	userState int not null,
	idUser BIGINT UNSIGNED not null,
	idJobPosition BIGINT UNSIGNED not null,
	idCompany BIGINT UNSIGNED not null,
	constraint pk_idJobOffer PRIMARY KEY (id_JobOffer),
	constraint fk_idUser foreign key (iduser) references User(id_User) ,
	constraint fk_idJobPosition foreign key (idJobPosition) references JobPosition(id_JobPosition),
	constraint fk_idCompany foreign key (idCompany) references Company(id_Company) on update CASCADE
)ENGINE=INNODB;







