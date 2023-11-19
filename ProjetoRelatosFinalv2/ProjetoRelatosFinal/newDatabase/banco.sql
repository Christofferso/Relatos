create database relatos
default character set utf8
default collate utf8_unicode_ci;

use relatos;

-- DROP DATABASE relatos; 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `tb_usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(220) NOT NULL,
  `nm_email` varchar(220) NOT NULL,
  `nm_senha` varchar(220) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

create procedure usuario(nm_usuario varchar(100), nm_email varchar(100), nm_senha varchar(100))
  insert into tb_usuario(nm_usuario, nm_email, nm_senha) 
    values (nm_usuario, nm_email, nm_senha);

call usuario( 'jorbell0', 'lgrigolon0@tmall.com', 'zAWrTka3HgGk');
call usuario( 'bbushell1', 'jjekyll1@nbcnews.com', 'nVtG2I0Iy');
call usuario( 'mfilippazzo2', 'hberka2@independent.co.uk', '3fZ9v9c');
call usuario( 'aipsgrave3', 'bdrohan3@opera.com', 'ME54PO4o7');
call usuario('dtice4', 'lhadcock4@list-manage.com', 'neIx9y');
call usuario('jwhiteoak5', 'aseilmann5@house.gov', 'Ka18tU72J');
call usuario( 'enaden6', 'dide6@google.de', 'J9PeVyBYsSZ');
call usuario('mraiker7', 'ftother7@storify.com', 'iMzKGtKaT');
call usuario( 'ttwort8', 'rvanyukov8@usda.gov', 'yWH3zmccEYt');
call usuario( 'mkite9', 'mreinisch9@wikispaces.com', '8RhzLTanY');

CREATE TABLE IF NOT EXISTS `markers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `address` varchar(155) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  user_id int,
  foreign key(user_id) references tb_usuario(id_usuario)
  ON DELETE CASCADE,
  primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

create procedure marcacao(`name` varchar(60), address varchar(155), lat float(10,6), lng float(10,6), user_id int)
	insert into markers(`name`, address , lat, lng, user_id)
		values(`name`, address, lat, lng, user_id);

call marcacao('Tem um poste com o led queimado', 'Depois da Swift',  -24.0218389, -46.4715617, 1);
call marcacao('Problema de iluminação, diversos postes queimados na região', 'Na frente da igreja amor e vida',  -24.0156458, -46.461995, 2);
call marcacao('Ocorre muito alagamento nessas ruas em dias de chuva forte', 'Perto do ponto de ônibus na frente da Smart fit', -24.023525, -46.473823, 2);
call marcacao('Há muito entulho na calçada e na rua', 'Na Rua Leonardo Nunes 417, perto de uma igreja evangélica',  -23.9532304, -46.3966377, 3);
call marcacao('Falta de iluminação nessa rua à noite', 'Paralela à Rua João Pessoa, entre os comércios',  -23.9357879, -46.3255034, 4);
call marcacao('Frequente transbordamento do canal, mesmo em dias não chuvosos', 'Próximo à Rua Frei Gaspar entre os canais', -23.9491923,-46.4107036, 5);
call marcacao('Sérios problemas de engarrafamentos ocasionados pelas más condições da ponte ', 'Na Ponte dos Barreiros', -23.9613197,-46.4129347, 6);
call marcacao('Longa espera para a utilização ocasionada pela má administração do tráfego', 'Em frente para a Travessia Santos Guarujá', -23.9873228,-46.2947413, 7);
call marcacao('Muito lixo espalhado pela rua', '37 R. Herminio Bordinhon',  -23.9540869, -46.4573471, 8);
call marcacao('Muito entulho espalhado pelo chão', '273 Av. Ver. Walter Melarato',  -23.951018,-46.4626862, 9);

/*tabela relato*/
create table IF NOT EXISTS tb_relato(
  id_relato int(11) not null auto_increment,
  cd_problema int(6) not null,
  nm_problema varchar(14),
  id_marker_relato int, 
  foreign key(id_marker_relato) references markers(id)
  ON DELETE CASCADE,
  primary key(id_relato)
)ENGINE=InnoDB Default charset = utf8;

create procedure relato(cd_problema int(6), nm_problema varchar(14), id_marker_relato int)
insert into tb_relato(cd_problema, nm_problema, id_marker_relato)
		values(cd_problema, nm_problema, id_marker_relato);
	
call relato(3, 'iluminacao', 1);
call relato(3, 'iluminacao', 2);
call relato(1, 'enchente', 3);
call relato(2,'poluicao' , 4);
call relato(3, 'iluminacao', 5);
call relato(1, 'enchente', 6);
call relato(5, 'engarrafamento', 7);
call relato(5, 'engarrafamento', 8);
call relato(2,'poluicao' , 9);
call relato(4,'buraco' , 10);

select * from tb_relato;
select * from markers;
SELECT * FROM tb_usuario;

/* FUNÇÕES PARA GRAFICO */
SET GLOBAL log_bin_trust_function_creators = 1; -- 	COMANDO para habilitar o uso de funções

CREATE FUNCTION fn_totalEnchente (id int)
  RETURNS DECIMAL
    RETURN (
      SELECT COUNT(cd_problema) 
        FROM tb_relato
          WHERE nm_problema like '%enchente%');
          -- DROP FUNCTION fn_totalEnchente;
          SELECT fn_totalEnchente(1) as `total_enchente`;

CREATE FUNCTION fn_totalBuraco (id int)
  RETURNS DECIMAL
    RETURN (
      SELECT COUNT(cd_problema) 
        FROM tb_relato
          WHERE nm_problema like '%buraco%');
          -- DROP FUNCTION fn_totalBuraco;
          SELECT fn_totalBuraco(1) as `total_buraco`;

CREATE FUNCTION fn_totalPoluicao (id int)
  RETURNS DECIMAL
    RETURN (
      SELECT COUNT(cd_problema) 
        FROM tb_relato
          WHERE nm_problema like '%poluicao%');
          -- DROP FUNCTION fn_totalPoluicao;
          SELECT fn_totalPoluicao(1) as `total_poluicao`;

CREATE FUNCTION fn_totalIluminacao (id int)
  RETURNS DECIMAL
    RETURN (
      SELECT COUNT(cd_problema) 
        FROM tb_relato
          WHERE nm_problema like '%iluminacao%');
          -- DROP FUNCTION fn_totalIluminacao;
          SELECT fn_totalIluminacao(1) as `total_iluminacao`;

CREATE FUNCTION fn_totalEngarrafamento (id int)
  RETURNS DECIMAL
    RETURN (
      SELECT COUNT(cd_problema) 
        FROM tb_relato
          WHERE nm_problema like '%engarrafamento%');
          -- DROP FUNCTION fn_totalEngarrafamento;
          SELECT fn_totalEngarrafamento(1) as `total_engarrafamento`;

CREATE FUNCTION fn_totalRelato (id int)
  RETURNS DECIMAL
    RETURN (
      SELECT COUNT(*) 
        FROM tb_relato);
	-- DROP FUNCTION fn_totalRelato;
	SELECT fn_totalRelato(1) as `total_relato`;

/* SELECT nm_problema as problema, COUNT(cd_problema) as `relatos` FROM tb_relato WHERE nm_problema LIKE '%enchente%'; */
SELECT nm_problema, fn_totalEnchente(1)/100 * (SELECT fn_totalRelato(1)) as `% Enchente` FROM tb_relato WHERE nm_problema like '%enchente%' LIMIT 1;
SELECT nm_problema, fn_totalPoluicao(1)/100 * (SELECT fn_totalRelato(1)) as `% Poluição` FROM tb_relato WHERE nm_problema like '%poluicao%' LIMIT 1;
SELECT nm_problema, fn_totalIluminacao(1)/100 * (SELECT fn_totalRelato(1)) as `% iluminação` FROM tb_relato WHERE nm_problema like '%iluminacao%' LIMIT 1;
SELECT nm_problema, fn_totalBuraco(1)/100 * (SELECT fn_totalRelato(1)) as `% Buraco` FROM tb_relato WHERE nm_problema like '%buraco%' LIMIT 1;
SELECT nm_problema, fn_totalEngarrafamento(1)/100 * (SELECT fn_totalRelato(1)) as `% Engarrafamento` FROM tb_relato WHERE nm_problema like '%engarrafamento%' LIMIT 1;
