-- Création de la base de données
CREATE DATABASE ges_dette_up;
USE ges_dette_up;

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
    photo BLOB,
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
    prixAchat DECIMAL(10, 2) NOT NULL,
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



-- Insertion de données dans la table profile
INSERT INTO profile (libp) VALUES 
('Client'),
('Boutiquier');

-- Insertion de données dans la table users
INSERT INTO users (nom, prenom, login, mdp, etat, idProfile) VALUES 
('Diop', 'Aminata', 'adiop', 'password_hash1', 'actif', 1),
('Ndiaye', 'Cheikh', 'cndiaye', 'password_hash2', 'actif', 2),
('Fall', 'Moussa', 'mfall', 'password_hash3', 'inactif', 2),
('Diop', 'Amadou', 'adiop@gmail.com', '123', 'actif', 1),
('Ndoye', 'Fatou', 'fndoye', 'password123', 'actif', 1);

-- Insertion de données dans la table client
INSERT INTO `client` (`idcl`, `nomc`, `prenomc`, `tel`, `email`, `adresse`, `categorie`, `sexe`, `solde`, `montantseuil`, `photo`) VALUES
(1, 'Seck', 'Mamadou', '776543210', 'mamadou.seck@example.com', 'Dakar', 'solvable', 'M', 0, 0, NULL),
(2, 'Ba', 'Aissatou', '776543211', 'aissatou.ba@example.com', 'Thies', 'fidele', 'F', 0, 0, NULL),
(3, 'Sow', 'Oumar', '776234567', 'oumar.sow@example.com', 'Louga', 'nouveau', 'M', 0, 0, NULL),
(4, 'Gaye', 'Sokhna', '774567890', 'sokhna.gaye@example.com', 'Saint-Louis', 'non solvable', 'F', 0, 0, NULL),
(5, 'Ba', 'Badara', '772641040', 'bbabadara@gmail.com', 'Ouakam', 'fidele', 'M', 0, 0, NULL);


-- Insertion de données dans la table depot
INSERT INTO depot (numerodep, montantdep, datedep, idClient) VALUES 
('DEP001', 150000.00, '2024-08-15', 1),
('DEP002', 300000.00, '2024-08-16', 2),
('DEP003', 50000.00, '2024-08-17', 3);

-- Insertion de données dans la table dette
INSERT INTO `dette` (`iddet`, `numerodet`, `datedet`, `montantdet`, `etatdet`, `idClient`) VALUES
(1, 'DET001', '2023-06-01', 30000.00, 'Non Soldée', 1),
(2, 'DET002', '2023-06-10', 20000.00, 'Soldée', 2),
(3, 'DET003', '2023-07-20', 25000.00, 'Soldée', 3),
(4, 'DET004', '2023-07-25', 62500.00, 'Non Soldée', 4),
(9, 'DET9238540927', '2024-08-09', 16300.00, 'Non Soldée', 5),
(10, 'DET6240781516', '2024-08-09', 16300.00, 'Non Soldée', 5),
(11, 'DET3251906188', '2024-08-09', 7000.00, 'Non Soldée', 5),
(12, 'DET3516157472', '2024-08-09', 5000.00, 'Soldée', 5),
(13, 'DET0458721799', '2024-08-13', 3000.00, 'Non Soldée', 5),
(14, 'DET2593038160', '2024-08-16', 40800.00, 'Soldée', 5),
(15, 'DET0399289366', '2024-08-23', 9000.00, 'Soldée', 5);;

-- Insertion de données dans la table article
INSERT INTO article (refart, libart, prixu, qteStock) VALUES 
('ART001', 'Sac de Riz', 20000.00, 50),
('ART002', 'Huile 5L', 12000.00, 100),
('ART003', 'Sucre 1kg', 600.00, 200);

-- Insertion de données dans la table artdette
INSERT INTO `artdette` (`idDette`, `idArticle`, `qte`, `prixAchat`) VALUES
(1, 1, 10, 5000.00),
(2, 2, 5, 6000.00),
(3, 3, 15, 4500.00),
(4, 4, 25, 2500.00),
(9, 1, 23, 500.00),
(9, 2, 4, 1200.00),
(10, 1, 23, 500.00),
(10, 2, 4, 1200.00),
(11, 1, 5, 500.00),
(11, 2, 5, 1200.00),
(12, 1, 80, 500.00),
(13, 4, 30, 100.00),
(14, 2, 34, 1200.00),
(15, 2, 5, 1200.00),
(15, 3, 10, 300.00);


-- Insertion de données dans la table paiement
INSERT INTO `paiement` (`idpay`, `numeropay`, `datepay`, `montantpay`, `idDette`) VALUES
(1, 'PAY001', '2023-07-01', 15000.00, 1),
(2, 'PAY002', '2023-07-15', 18000.00, 2),
(3, 'PAY003', '2023-08-10', 25000.00, 3),
(4, 'PAY004', '2023-08-15', 25000.00, 4),
(5, 'PAY005', '2024-08-02', 2000.00, 2),
(6, 'PAY0056757177', '2024-08-07', 10500.00, 4),
(10, 'PAY9571909367', '2024-08-07', 200.00, 4),
(12, 'PAY1472418490', '2024-08-07', 849.00, 4),
(13, 'PAY009002', '2024-08-09', 2000.00, 9),
(14, 'PAY7723346784', '2024-08-09', 5200.00, 10),
(15, 'PAY6292855805', '2024-08-09', 10000.00, 4),
(16, 'PAY6997163201', '2024-08-09', 5000.00, 12),
(17, 'PAY0861906773', '2024-08-13', 1000.00, 13),
(18, 'PAY7521855602', '2024-08-14', 2000.00, 10),
(19, 'PAY0685192841', '2024-08-14', 3000.00, 10),
(20, 'PAY7934513159', '2024-08-14', 3500.00, 10),
(21, 'PAY0843153171', '2024-08-14', 3500.00, 10),
(22, 'PAY4079125147', '2024-08-14', 3500.00, 10),
(23, 'PAY2797557437', '2024-08-14', 3500.00, 10),
(24, 'PAY1394038174', '2024-08-15', 3535.00, 4),
(25, 'PAY6022582357', '2024-08-15', 3535.00, 4),
(26, 'PAY8756259644', '2024-08-15', 3535.00, 4),
(27, 'PAY0708111288', '2024-08-16', 355.00, 4),
(28, 'PAY8681681147', '2024-08-16', 2200.00, 4),
(29, 'PAY1083159345', '2024-08-16', 500.00, 4);
