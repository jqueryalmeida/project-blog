CREATE DATABASE IF NOT EXISTS blog CHARACTER SET = UTF8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS blog.users (
  id_user varchar(20) NOT NULL COLLATE utf8_bin,
  pseudo_user varchar(20) NOT NULL COLLATE utf8_bin,
  password_user varchar(200) NOT NULL COLLATE utf8_bin,
  email_user varchar(100) NOT NULL COLLATE utf8_bin,
  id_grade tinyint(2) DEFAULT '0',
  PRIMARY KEY pk_user(id_user)
);

CREATE TABLE IF NOT EXISTS blog.grades (
  id_grade tinyint(2) NOT NULL,
  name_grade varchar(35) NOT NULL COLLATE utf8_bin,
  power_grade int(4) NOT NULL,
  PRIMARY KEY pk_grade(id_grade)
);

CREATE TABLE IF NOT EXISTS blog.users_information
(
  id_user varchar(20) NOT NULL COLLATE utf8_bin,
  name varchar(60) DEFAULT NULL COLLATE utf8_bin,
  lastname varchar(60) DEFAULT NULL COLLATE utf8_bin,
  birthday date DEFAULT NULL,
  PRIMARY KEY pk_user (id_user)
);

CREATE TABLE IF NOT EXISTS blog.categories
(
  id_category varchar(20) NOT NULL,
  name_category varchar(60) NOT NULL COLLATE utf8_bin,
  description_category varchar(120) DEFAULT NULL COLLATE utf8_bin,
  params_category blob DEFAULT NULL,
  weight_category TINYINT(3) DEFAULT 0,
  PRIMARY KEY pk_category(id_category)
);


USE blog;

ALTER TABLE users
    ADD CONSTRAINT FOREIGN KEY fk_id_grade(id_grade) REFERENCES grades(id_grade) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE users_information
    ADD CONSTRAINT FOREIGN KEY fk_id_user(id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;

INSERT INTO grades(id_grade, name_grade, power_grade) VALUE(10, 'SuperAdmin', 9999);

INSERT INTO users(id_user, pseudo_user, password_user, email_user, id_grade) VALUE('56c5d5546bc32', 'admin', '$2y$10$ed2b386f2d313f251a300OFo177.9Lcf0Q53VYkRwmu.OqOdEmHLK', 'admincontact@blog.org', 10);

INSERT INTO categories(id_category, name_category, description_category, params_category, weight_category) VALUES (
  (0, 'Articles', 'Gestion des articles', '{attributes : [type : "button", role : "button", attributes : ]', 0)
);