CREATE DATABASE IF NOT EXISTS blog CHARACTER SET = UTF8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS blog.Error
(
	idError int(100) NOT NULL AUTO_INCREMENT,
	messageError TEXT NOT NULL,
	codeError VARCHAR(255) NOT NULL,
	file VARCHAR(255) NOT NULL,
	lineFile int(10) NOT NULL,
	dateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	trace LONGTEXT NOT NULL,
	type VARCHAR(20) NOT NULL,
	PRIMARY KEY pk_id_error(idError)
) CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.users (
  id_user varchar(20) NOT NULL COLLATE utf8_bin,
  pseudo_user varchar(20) NOT NULL COLLATE utf8_bin,
  password_user varchar(200) NOT NULL COLLATE utf8_bin,
  email_user varchar(100) NOT NULL COLLATE utf8_bin,
  id_grade tinyint(2) DEFAULT '0',
  PRIMARY KEY pk_user(id_user)
) CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.grades (
  id_grade tinyint(2) NOT NULL,
  name_grade varchar(35) NOT NULL COLLATE utf8_bin,
  power_grade int(4) NOT NULL,
  PRIMARY KEY pk_grade(id_grade)
) CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.users_information
(
  id_user varchar(20) NOT NULL COLLATE utf8_bin,
  name varchar(60) DEFAULT NULL COLLATE utf8_bin,
  lastname varchar(60) DEFAULT NULL COLLATE utf8_bin,
  birthday date DEFAULT NULL,
  PRIMARY KEY pk_user (id_user)
) CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.categorie
(
  idCategory int(5) NOT NULL AUTO_INCREMENT,
	dataCategory LONGBLOB NOT NULL,
  name_category varchar(60) NOT NULL COLLATE utf8_bin,
  PRIMARY KEY pk_category(idCategory)
)CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.articles
(
  id_article int(20) NOT NULL AUTO_INCREMENT,
  title_article varchar(75) NOT NULL,
  description_article varchar(150) DEFAULT NULL,
  text_article LONGTEXT NOT NULL,
  publication_article TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	author_article varchar(20) NOT NULL,
  category_article int(5) NOT NULL,
  PRIMARY KEY pk_id_article(id_article)
)CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS blog.menu
(
	id_menu int(20) NOT NULL AUTO_INCREMENT,
	dataMenu MEDIUMBLOB NOT NULL,
	PRIMARY KEY pk_id_menu(id_menu)
) CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.skills
(
	idSkill int(4) NOT NULL AUTO_INCREMENT,
	dataSkill TINYBLOB NOT NULL,
	nameSkill varchar(50) NOT NULL,
	PRIMARY KEY pk_id_skill (idSkill)
) CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.experiences
(
	idExperience int(5) NOT NULL AUTO_INCREMENT,
	dataExperience LONGBLOB NOT NULL,
	nameExperience VARCHAR(100) NOT NULL,
	PRIMARY KEY pk_id_exp(idExperience)
) CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;


USE blog;

ALTER TABLE users
    ADD CONSTRAINT FOREIGN KEY fk_id_grade(id_grade) REFERENCES grades(id_grade) ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE users_information
    ADD CONSTRAINT FOREIGN KEY fk_id_user(id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE articles
    ADD CONSTRAINT FOREIGN KEY fk_id_author(author_article) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE NO ACTION,
    ADD CONSTRAINT FOREIGN KEY fk_id_category(category_article) REFERENCES categorie(idCategory) ON UPDATE CASCADE ON DELETE NO ACTION;

INSERT INTO grades(id_grade, name_grade, power_grade) VALUE(10, 'SuperAdmin', 9999);

INSERT INTO users(id_user, pseudo_user, password_user, email_user, id_grade) VALUE('56c5d5546bc32', 'admin', '$2y$10$ed2b386f2d313f251a300OFo177.9Lcf0Q53VYkRwmu.OqOdEmHLK', 'admincontact@blog.org', 10);