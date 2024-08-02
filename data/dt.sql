#creation base de donnee
CREATE DATABASE ges_dette;
USE ges_dette;

#creation table
CREATE TABLE profile (
    idp INT AUTO_INCREMENT PRIMARY KEY,
    libp VARCHAR(100) NOT NULL
);

CREATE TABLE users (
    idu INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    login VARCHAR(100) UNIQUE NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    idProfile INT,
    FOREIGN KEY (idProfile) REFERENCES profile(idp)
);

CREATE TABLE client (
    idcl INT AUTO_INCREMENT PRIMARY KEY,
    nomc VARCHAR(100) NOT NULL,
    prenomc VARCHAR(100) NOT NULL,
    tel VARCHAR(15) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    adresse TEXT NOT NULL,
    categorie ENUM('solvable', 'non solvable', 'fidele', 'nouveau') NOT NULL,
    sexe CHAR(1) NOT NULL,
    photo BLOB
);

CREATE TABLE depot (
    iddep INT AUTO_INCREMENT PRIMARY KEY,
    numerodep VARCHAR(100) UNIQUE NOT NULL,
    montantdep DECIMAL(10, 2) NOT NULL,
    datedep DATE NOT NULL,
    idClient INT,
    FOREIGN KEY (idClient) REFERENCES client(idcl)
);

CREATE TABLE dette (
    iddet INT AUTO_INCREMENT PRIMARY KEY,
    numerodet VARCHAR(100) UNIQUE NOT NULL,
    datedet DATE NOT NULL,
    montandet DECIMAL(10, 2) NOT NULL,
    idClient INT,
    FOREIGN KEY (idClient) REFERENCES client(idcl)
);

CREATE TABLE article (
    idart INT AUTO_INCREMENT PRIMARY KEY,
    refart VARCHAR(100) UNIQUE NOT NULL,
    libart VARCHAR(100) NOT NULL,
    prixu DECIMAL(10, 2) NOT NULL,
    qteStock INT NOT NULL
);

CREATE TABLE artdette (
    idDette INT,
    idArticle INT,
    qte INT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (idDette, idArticle),
    FOREIGN KEY (idDette) REFERENCES dette(iddet),
    FOREIGN KEY (idArticle) REFERENCES article(idart)
);

CREATE TABLE paiement (
    idpay INT AUTO_INCREMENT PRIMARY KEY,
    numeropay VARCHAR(100) UNIQUE NOT NULL,
    datepay DATE NOT NULL,
    montantpay DECIMAL(10, 2) NOT NULL,
    idDette INT,
    FOREIGN KEY (idDette) REFERENCES dette(iddet)
);


#insertion donnee
-- Insertion des profils
INSERT INTO profile (libp) VALUES ('vendeur');

-- Insertion des utilisateurs
INSERT INTO users (nom, prenom, login, mdp, idProfile) VALUES 
('Diop', 'Amadou', 'adiop', 'password123', 1),
('Ndoye', 'Fatou', 'fndoye', 'password123', 1);

-- Insertion des clients
INSERT INTO client (nomc, prenomc, tel, email, adresse, categorie, sexe) VALUES
('Seck', 'Mamadou', '776543210', 'mamadou.seck@example.com', 'Dakar', 'solvable', 'M'),
('Ba', 'Aissatou', '776543211', 'aissatou.ba@example.com', 'Thies', 'fidele', 'F'),
('Sow', 'Oumar', '776234567', 'oumar.sow@example.com', 'Louga', 'nouveau', 'M'),
('Gaye', 'Sokhna', '774567890', 'sokhna.gaye@example.com', 'Saint-Louis', 'non solvable', 'F');

-- Insertion des dépôts
INSERT INTO depot (numerodep, montantdep, datedep, idClient) VALUES
('DEP001', 50000.00, '2023-07-01', 1),
('DEP002', 30000.00, '2023-07-15', 2),
('DEP003', 75000.00, '2023-08-01', 3),
('DEP004', 45000.00, '2023-08-10', 4);

-- Insertion des dettes
INSERT INTO dette (numerodet, datedet, montandet, idClient) VALUES
('DET001', '2023-06-01', 15000.00, 1),
('DET002', '2023-06-10', 20000.00, 2),
('DET003', '2023-07-20', 25000.00, 3),
('DET004', '2023-07-25', 35000.00, 4);

-- Insertion des articles
INSERT INTO article (refart, libart, prixu, qteStock) VALUES
('ART001', 'Riz', 500.00, 100),
('ART002', 'Huile', 1200.00, 50),
('ART003', 'Sucre', 300.00, 150),
('ART004', 'Sel', 100.00, 200);

-- Insertion des articles de dette
INSERT INTO artdette (idDette, idArticle, qte, prix) VALUES
(1, 1, 10, 5000.00),
(2, 2, 5, 6000.00),
(3, 3, 15, 4500.00),
(4, 4, 25, 2500.00);

-- Insertion des paiements
INSERT INTO paiement (numeropay, datepay, montantpay, idDette) VALUES
('PAY001', '2023-07-01', 15000.00, 1),
('PAY002', '2023-07-15', 20000.00, 2),
('PAY003', '2023-08-10', 25000.00, 3),
('PAY004', '2023-08-15', 35000.00, 4);

