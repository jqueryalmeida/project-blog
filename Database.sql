CREATE DATABASE IF NOT EXISTS blog CHARACTER SET = UTF8 COLLATE utf8_bin;

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

CREATE TABLE IF NOT EXISTS blog.categories
(
  id_category varchar(20) NOT NULL,
  name_category varchar(60) NOT NULL COLLATE utf8_bin,
  description_category varchar(120) DEFAULT NULL COLLATE utf8_bin,
  weight_category TINYINT(3) DEFAULT 0,
  PRIMARY KEY pk_category(id_category)
)CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.attributes
(
  id_object varchar(20) NOT NULL,
  value_attr blob DEFAULT NULL,
  PRIMARY KEY pk_id_object(id_object)
) CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.objects
(
  id_object varchar(20) NOT NULL,
  name_object varchar(50) NOT NULL,
  description_object varchar(100) DEFAULT NULL,
  weight_object tinyint(4) DEFAULT 0,
  relationship_object varchar(20) DEFAULT NULL,
  parent_object varchar(20) DEFAULT NULL,
  PRIMARY KEY pk_id_object(id_object)
) CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blog.articles
(
  id_article varchar(20) NOT NULL,
  title_article varchar(75) NOT NULL,
  description_article varchar(150) DEFAULT NULL,
  text_article LONGTEXT NOT NULL,
  publication_article DATETIME NOT NULL,
  author_article varchar(20) NOT NULL,
  category_article varchar(20) NOT NULL,
  PRIMARY KEY pk_id_article(id_article)
)CHARACTER SET = UTF8 COLLATE utf8_bin, ENGINE=InnoDB;

USE blog;

ALTER TABLE users
    ADD CONSTRAINT FOREIGN KEY fk_id_grade(id_grade) REFERENCES grades(id_grade) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE users_information
    ADD CONSTRAINT FOREIGN KEY fk_id_user(id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE attributes
    ADD CONSTRAINT FOREIGN KEY fk_id_object(id_object) REFERENCES objects(id_object) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE articles
    ADD CONSTRAINT FOREIGN KEY fk_id_author(author_article) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD CONSTRAINT FOREIGN KEY fk_id_category(category_article) REFERENCES categories(id_category) ON UPDATE CASCADE ON DELETE CASCADE;

INSERT INTO grades(id_grade, name_grade, power_grade) VALUE(10, 'SuperAdmin', 9999);

INSERT INTO users(id_user, pseudo_user, password_user, email_user, id_grade) VALUE('56c5d5546bc32', 'admin', '$2y$10$ed2b386f2d313f251a300OFo177.9Lcf0Q53VYkRwmu.OqOdEmHLK', 'admincontact@blog.org', 10);

INSERT INTO objects(id_object, name_object, description_object, weight_object, relationship_object, parent_object) VALUES
	('56e55bc5c85df', 'AdminRoot', 'Contient tout de Admin', -100, null, null),
	('56e55be62d765', 'Catégories Admin', 'Gestion de la parties Admin', -10, '56e55bc5c85df', '56e55bc5c85df'),
	('56e55c0be27d5', 'Articles', 'Gestion des articles', 0, '56e55be62d765', '56e55be62d765'),
	('56e55c10e0c72', 'Gestion menus', 'Gérer les menues', 0, '56e55be62d765', '56e55be62d765')
;