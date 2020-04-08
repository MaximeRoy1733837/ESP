CREATE DATABASE  IF NOT EXISTS `bd_esp` default CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_esp`;

CREATE TABLE `tbl_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epoch` varchar(35) NOT NULL,
  `nom_commande` varchar(20) DEFAULT NULL,
  `date` varchar(35) DEFAULT NULL,
  `quantite_produite` varchar(5) DEFAULT NULL,
  `temperature` varchar(5) DEFAULT NULL,
  `humidite` varchar(5) DEFAULT NULL,
  `quantite_bon` varchar(5) NOT NULL,
  `quantite_mauvais` varchar(5) NOT NULL,
  `bloque` varchar(5) NOT NULL,
  PRIMARY KEY (`id`));
  
CREATE TABLE `tbl_historique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_commande` varchar(20) DEFAULT NULL,
  `date_historique` varchar(35) DEFAULT NULL,
  `quantite_produite` varchar(5) DEFAULT NULL,
  `temperature` varchar(5) DEFAULT NULL,
  `humidite` varchar(5) DEFAULT NULL,
  `quantite_bon` varchar(5) NOT NULL,
  `quantite_mauvais` varchar(5) NOT NULL,
  PRIMARY KEY (`id`));
  
CREATE TABLE `tbl_utilisateur` (
  `no_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(35) NOT NULL,
  `prenom` varchar(35) NOT NULL,
  `nom_utilisateur` varchar(35) NOT NULL,
  `motPasse` varchar(50) NOT NULL,
  PRIMARY KEY (`no_utilisateur`));
  
INSERT INTO `tbl_info` (`epoch`, `nom_commande`, `date`, `quantite_produite`, `temperature`, `humidite`, `quantite_bon`, `quantite_mauvais`,`bloque`) 
		VALUES 	(1583863424,'vert','Jeudi 2 avril 3:52:16',75,24.5,32,70,5,0),
				(1583863453,'jaune','Vendredi 3 avril 13:52:07',20,25,34.1,19,1,0),
                (1583863460,'rouge','Samedi 4 avril 18:52:42',160,23.9,30,150,10,0);
                
INSERT INTO `tbl_historique` (`nom_commande`, `date_historique`, `quantite_produite`, `temperature`, `humidite`, `quantite_bon`, `quantite_mauvais`) 
		VALUES 	('Vert','Lundi 6 avril 13:52',75,24.5,32,70,5),
				('Jaune','Lundi 6 avril 13:52',175,25.5,20,170,5);
  
INSERT INTO `tbl_utilisateur` (`no_utilisateur`, `nom`, `prenom`, `nom_utilisateur`, `motPasse`) 
		VALUES 	(1,'Roy','Maxime','mroy','*FB488315048F29BF9A666F7B7102E6DE1D3363B8'),
				(2,'Letourneau','Louca','lletourneau','*5B821ED96F8C48CE7DD6E21037B6DC704D32C016'),
                (3,'Lepage','Yves','ylapage','*5B821ED96F8C48CE7DD6E21037B6DC704D32C016');
                
  
delimiter |
create procedure getLastInsertedInfo()
begin
	select * 
    from tbl_info 
    where id = (select max(id) from tbl_info);
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
-- select password('ESP2020')

-- call getLastInsertedInfo
-- call VerificationLogin('lletourneau','Mecanium789')
                