-- Création de la base de données
CREATE DATABASE ges_dette;
USE ges_dette;

-- Création de la table profile
CREATE TABLE profile (
    idp INT AUTO_INCREMENT PRIMARY KEY,
    libp VARCHAR(100) NOT NULL
);

-- Création de la table users
CREATE TABLE users (
    idu INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    login VARCHAR(100) UNIQUE NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    etat ENUM('actif', 'inactif') NOT NULL DEFAULT 'actif',
    idProfile INT,
    FOREIGN KEY (idProfile) REFERENCES profile(idp)
        ON DELETE SET NULL  -- Option plus prudente pour éviter la suppression de l'utilisateur en cas de suppression d'un profil
        ON UPDATE CASCADE
);

-- Création de la table client
CREATE TABLE client (
    idcl INT AUTO_INCREMENT PRIMARY KEY,
    nomc VARCHAR(100) NOT NULL,
    prenomc VARCHAR(100) NOT NULL,
    tel VARCHAR(15) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    adresse TEXT NOT NULL,
    categorie ENUM('solvable', 'non solvable', 'fidele', 'nouveau') NOT NULL,
    sexe ENUM('F', 'M') NOT NULL,
    solde DECIMAL(10, 2) DEFAULT 0,
    montantseuil DECIMAL(10, 2) DEFAULT 0,
    photo BLOB
);

-- Création de la table depot
CREATE TABLE depot (
    iddep INT AUTO_INCREMENT PRIMARY KEY,
    numerodep VARCHAR(100) UNIQUE NOT NULL,
    montantdep DECIMAL(10, 2) NOT NULL,
    datedep DATE NOT NULL,
    idClient INT,
    FOREIGN KEY (idClient) REFERENCES client(idcl)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

-- Création de la table dette
CREATE TABLE dette (
    iddet INT AUTO_INCREMENT PRIMARY KEY,
    numerodet VARCHAR(100) UNIQUE NOT NULL,
    datedet DATE NOT NULL,
    montantdet DECIMAL(10, 2) NOT NULL,
    etatdet ENUM('impayée', 'payée') DEFAULT 'impayée',
    idClient INT,
    FOREIGN KEY (idClient) REFERENCES client(idcl)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

-- Création de la table article
CREATE TABLE article (
    idart INT AUTO_INCREMENT PRIMARY KEY,
    refart VARCHAR(100) UNIQUE NOT NULL,
    libart VARCHAR(100) NOT NULL,
    prixu DECIMAL(10, 2) NOT NULL,
    qteStock INT NOT NULL
);

-- Création de la table artdette
CREATE TABLE artdette (
    idDette INT,
    idArticle INT,
    qte INT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (idDette, idArticle), -- Clé primaire composite pour éviter les duplications
    FOREIGN KEY (idDette) REFERENCES dette(iddet)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    FOREIGN KEY (idArticle) REFERENCES article(idart)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

-- Création de la table paiement
CREATE TABLE paiement (
    idpay INT AUTO_INCREMENT PRIMARY KEY,
    numeropay VARCHAR(100) UNIQUE NOT NULL,
    datepay DATE NOT NULL,
    montantpay DECIMAL(10, 2) NOT NULL,
    idDette INT,
    FOREIGN KEY (idDette) REFERENCES dette(iddet)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

-- Ajout d'indexes sur les colonnes souvent utilisées pour améliorer les performances
CREATE INDEX idx_client_tel ON client(tel);
CREATE INDEX idx_client_email ON client(email);
CREATE INDEX idx_dette_numerodet ON dette(numerodet);
CREATE INDEX idx_article_refart ON article(refart);
CREATE INDEX idx_paiement_numeropay ON paiement(numeropay);
