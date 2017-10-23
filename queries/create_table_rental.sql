CREATE TABLE rental (

idRental INT NOT NULL AUTO_INCREMENT,
idUser INT NOT NULL,
idCustomer INT NOT NULL,
idMovie INT NOT NULL,
date TIMESTAMP,
devolution TIMESTAMP,
PRIMARY  KEY (idRental),
CONSTRAINT FK_UserRental FOREIGN KEY (idUser) REFERENCES user(idUser),
CONSTRAINT FK_CustomerRental FOREIGN KEY (idCustomer) REFERENCES customer(idCustomer),
CONSTRAINT FK_MovieRental FOREIGN KEY (idMovie) REFERENCES movie(idMovie)
);