CREATE TABLE movie (

idMovie INT NOT NULL AUTO_INCREMENT,
name VARCHAR(100) NOT NULL,
year INT,
director VARCHAR (100),
category VARCHAR (100) NOT NULL,
availability INT,
PRIMARY KEY (idMovie)

);