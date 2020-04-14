CREATE DATABASE  IF NOT EXISTS `bd_esp` default CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_esp`;
-- error 1215
CREATE TABLE `tbl_info` (
  `id_info` int(11) NOT NULL AUTO_INCREMENT,
  `epoch` varchar(35) NOT NULL,
  `date` varchar(35) DEFAULT NULL,
  `valeur_capteur` varchar(20) DEFAULT NULL,
  `id_machine` int(11) NOT NULL,
  `id_capteur` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  PRIMARY KEY (`id_info`),
  FOREIGN KEY (`id_machine`) REFERENCES `tbl_machine` (`id_machine`) ON UPDATE CASCADE,
  FOREIGN KEY (`id_capteur`) REFERENCES `tbl_capteur` (`id_capteur`) ON UPDATE CASCADE,
  FOREIGN KEY (`id_commande`) REFERENCES `tbl_commande` (`id_commande`) ON UPDATE CASCADE)ENGINE=InnoDB;
  
CREATE TABLE `tbl_capteur` (
  `id_capteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_capteur` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_capteur`),
  KEY `fk_capteur` (`id_capteur`),
  CONSTRAINT `fk_capteur` FOREIGN KEY (`id_capteur`) REFERENCES `tbl_info` (`id_capteur`) ON UPDATE CASCADE,
  KEY `fk_capteur2` (`id_capteur`),
  CONSTRAINT `fk_capteur2` FOREIGN KEY (`id_capteur`) REFERENCES `tbl_historique` (`id_capteur`) ON UPDATE CASCADE);
  
CREATE TABLE `tbl_machine` (
  `id_machine` int(11) NOT NULL AUTO_INCREMENT,
  `nom_machine` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_machine`),
  KEY `fk_machine` (`id_machine`),
  CONSTRAINT `fk_machine` FOREIGN KEY (`id_machine`) REFERENCES `tbl_info` (`id_machine`) ON UPDATE CASCADE,
  KEY `fk_machine2` (`id_machine`),
  CONSTRAINT `fk_machine2` FOREIGN KEY (`id_machine`) REFERENCES `tbl_historique` (`id_machine`) ON UPDATE CASCADE,
  KEY `fk_machine3` (`id_machine`),
  CONSTRAINT `fk_machine3` FOREIGN KEY (`id_machine`) REFERENCES `tbl_evenement` (`id_machine`) ON UPDATE CASCADE);
  
CREATE TABLE `tbl_commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `nom_commande` varchar(20) DEFAULT NULL,
  `quantite_a_produire` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `fk_commande` (`id_commande`),
  CONSTRAINT `fk_commande` FOREIGN KEY (`id_commande`) REFERENCES `tbl_info` (`id_commande`) ON UPDATE CASCADE,
  KEY `fk_commande2` (`id_commande`),
  CONSTRAINT `fk_commande2` FOREIGN KEY (`id_commande`) REFERENCES `tbl_historique` (`id_commande`) ON UPDATE CASCADE);
  
CREATE TABLE `tbl_historique` (
  `id_historique` int(11) NOT NULL AUTO_INCREMENT,
  `date_historique` varchar(35) DEFAULT NULL,
  `valeur_capteur` varchar(20) DEFAULT NULL,
  `id_machine` int(11) NOT NULL,
  `id_capteur` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  PRIMARY KEY (`id_historique`),
  KEY `id_machine` (`id_machine`),
  CONSTRAINT `tbl_machine_ibfk_2` FOREIGN KEY (`id_machine`) REFERENCES `tbl_machine` (`id_machine`) ON UPDATE CASCADE,
  KEY `id_capteur` (`id_capteur`),
  CONSTRAINT `tbl_capteur_ibfk_2` FOREIGN KEY (`id_capteur`) REFERENCES `tbl_capteur` (`id_capteur`) ON UPDATE CASCADE,
  KEY `id_commande` (`id_commande`),
  CONSTRAINT `tbl_commande_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `tbl_commande` (`id_commande`) ON UPDATE CASCADE);
  
CREATE TABLE `tbl_evenement` (
  `id_evenement` int(11) NOT NULL AUTO_INCREMENT,
  `date_evenement` varchar(35) DEFAULT NULL,
  `id_machine` int(11) NOT NULL,
  `id_type_evenement` int(11) NOT NULL,
  PRIMARY KEY (`id_evenement`),
  KEY `id_machine` (`id_machine`),
  CONSTRAINT `tbl_machine_ibfk_3` FOREIGN KEY (`id_machine`) REFERENCES `tbl_machine` (`id_machine`) ON UPDATE CASCADE,
  KEY `id_type_evenement` (`id_type_evenement`),
  CONSTRAINT `tbl_type_evenement_ibfk_1` FOREIGN KEY (`id_type_evenement`) REFERENCES `tbl_type_evenement` (`id_type_evenement`) ON UPDATE CASCADE);
  
CREATE TABLE `tbl_type_evenement` (
  `id_type_evenement` int(11) NOT NULL AUTO_INCREMENT,
  `nom_evenement` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_type_evenement`),
  KEY `fk_type_evenement` (`id_type_evenement`),
  CONSTRAINT `fk_type_evenement` FOREIGN KEY (`id_type_evenement`) REFERENCES `tbl_evenement` (`id_type_evenement`) ON UPDATE CASCADE);
  
CREATE TABLE `tbl_utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(35) NOT NULL,
  `prenom` varchar(35) NOT NULL,
  `nom_utilisateur` varchar(35) NOT NULL,
  `motPasse` varchar(50) NOT NULL,
  PRIMARY KEY (`id_utilisateur`));
  
INSERT INTO `tbl_info` (`epoch`, `date`, `valeur_capteur`, `id_machine`, `id_capteur`,`id_commande`)
		VALUES 	(1583863424,'Jeudi 2 avril 3:52:16',75,1,1,1),
				(1583863453,'Vendredi 3 avril 13:52:07',20,1,2,1),
                (1583863460,'Samedi 4 avril 18:52:42',160,1,3,2);

INSERT INTO `tbl_capteur` (`nom_capteur`)
		VALUES 	('temperature'),
				('humidite'),
                ('bon'),
                ('mauvais');
                
INSERT INTO `tbl_machine` (`nom_machine`)
		VALUES 	('Siemens S7-1200'),
				('Raspberry Pi');
                
INSERT INTO `tbl_commande` (`nom_commande`,`quantite_a_produire`)
		VALUES 	('bouchon vert',150),
				('bouchon jaune',40);
                
INSERT INTO `tbl_historique` (`date_historique`, `valeur_capteur`, `id_machine`, `id_capteur`,`id_commande`)
		VALUES 	('Lundi 6 avril 13:52',24,1,1,1),
				('Lundi 6 avril 13:52',20,1,2,2);
                
INSERT INTO `tbl_evenement` (`date_evenement`,`id_machine`,`id_type_evenement`)
		VALUES 	('Lundi 6 avril 13:52',1,1),
				('Lundi 6 avril 13:55',1,2);
                
INSERT INTO `tbl_type_evenement` (`nom_evenement`)
		VALUES 	('manque_bouchon'),
				('machine_bloque'),
                ('machine_arrete');
  
INSERT INTO `tbl_utilisateur` (`id_utilisateur`, `nom`, `prenom`, `nom_utilisateur`, `motPasse`) 
		VALUES 	(1,'Roy','Maxime','mroy','*FB488315048F29BF9A666F7B7102E6DE1D3363B8'),
				(2,'Letourneau','Louca','lletourneau','*5B821ED96F8C48CE7DD6E21037B6DC704D32C016'),
                (3,'Lepage','Yves','ylapage','*5B821ED96F8C48CE7DD6E21037B6DC704D32C016');
                
delimiter |
create procedure getLastInsertedInfo()
begin
	select * 
    from tbl_info 
    where id_info = (select max(id_info) from tbl_info);
end|

delimiter |
create procedure VerificationLogin(in _nom varchar(20), in _mpd varchar(45))
begin
	select *
    from tbl_utilisateur
    where nom_utilisateur = _nom and motPasse = password(_mpd);
end|

-- drop database bd_esp
-- drop procedure getLastInsertedInfo
-- drop procedure VerificationLogin

-- select * FROM tbl_info
-- select * FROM tbl_historique
-- select * FROM tbl_utilisateur
-- select * FROM tbl_capteur
-- select * FROM tbl_machine
-- select * FROM tbl_evenement
-- select * FROM tbl_type_evenement
-- select password('ESP2020')

-- call getLastInsertedInfo
-- call VerificationLogin('lletourneau','Mecanium789')
                