-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2016 at 09:58 PM
-- Server version: 5.7.12-0ubuntu1
-- PHP Version: 7.0.6-1+donate.sury.org~wily+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id_article` int(10) NOT NULL,
  `title_article` varchar(75) COLLATE utf8_bin NOT NULL,
  `description_article` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `text_article` longtext COLLATE utf8_bin NOT NULL,
  `publication_article` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_article` varchar(20) COLLATE utf8_bin NOT NULL,
  `category_article` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id_article`, `title_article`, `description_article`, `text_article`, `publication_article`, `author_article`, `category_article`) VALUES
(2, 'gfh', 'fghfdgh', 'fdghftgh', '2016-05-01 20:41:43', '56c5d5546bc32', '1'),
(5, 'Présentation', 'Petite présentation', 'Ceci est un  article de présentation qui vise à tester certaines petites fonctionnalités du site \r\n\r\n\r\nMais aussi pour voir comment il réagit dans le temps,  mais surtout avec certaines fonctions . \r\n\r\n\r\nQuand on aura atteint les 150 charactères je penses qu\'on pourra voir comment réagit la page d\'accueil ! \r\n\r\nCeci étant fait on va pouvoir publier cet article bidon pour enfin être sûr ! ', '2016-05-02 07:45:29', '56c5d5546bc32', '1'),
(6, 'Présentation', 'Petite présentation', 'Ceci est un  article de présentation qui vise à tester certaines petites fonctionnalités du site \r\n\r\n\r\nMais aussi pour voir comment il réagit dans le temps,  mais surtout avec certaines fonctions . \r\n\r\n\r\nQuand on aura atteint les 150 charactères je penses qu\'on pourra voir comment réagit la page d\'accueil ! \r\n\r\nCeci étant fait on va pouvoir publier cet article bidon pour enfin être sûr ! ', '2016-05-02 07:45:30', '56c5d5546bc32', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `idCategory` int(2) NOT NULL,
  `dataCategory` longblob NOT NULL,
  `nameCategory` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCategory`, `dataCategory`, `nameCategory`) VALUES
(1, 0x7b227469746c65223a22426c6f67222c22776569676874223a223130222c22706172656e74223a22227d, 'Blog'),
(2, 0x7b227469746c65223a2267666468222c22776569676874223a226667222c22706172656e74223a22227d, 'gfdh');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` varchar(20) COLLATE utf8_bin NOT NULL,
  `name_category` varchar(60) COLLATE utf8_bin NOT NULL,
  `description_category` varchar(120) COLLATE utf8_bin DEFAULT NULL,
  `weight_category` tinyint(3) DEFAULT '0',
  `parent_category` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `id_menu` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`, `description_category`, `weight_category`, `parent_category`, `id_menu`) VALUES
('56e94de82b768', 'Articles', '', -100, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Error`
--

CREATE TABLE `Error` (
  `idError` int(20) NOT NULL,
  `messageError` text COLLATE utf8_bin NOT NULL,
  `codeError` varchar(40) COLLATE utf8_bin NOT NULL,
  `file` varchar(255) COLLATE utf8_bin NOT NULL,
  `lineFile` int(10) NOT NULL,
  `dateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `trace` longtext COLLATE utf8_bin NOT NULL,
  `type` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `idForm` varchar(80) COLLATE utf8_bin NOT NULL,
  `dataForm` longblob NOT NULL,
  `attributes` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id_grade` tinyint(2) NOT NULL,
  `name_grade` varchar(35) COLLATE utf8_bin NOT NULL,
  `power_grade` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id_grade`, `name_grade`, `power_grade`) VALUES
(10, 'SuperAdmin', 9999),
(20, 'test insert', 200);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(2) NOT NULL,
  `dataMenu` longblob NOT NULL,
  `visibility` varchar(20) COLLATE utf8_bin DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `dataMenu`, `visibility`) VALUES
(14, 0x7b227469746c65223a224163637565696c222c226465736372697074696f6e223a22506167652064276163637565696c222c226c696e6b223a225c2f222c22776569676874223a222d323030222c2263617465676f7279223a22227d, 'public'),
(15, 0x7b227469746c65223a22426c6f67222c226465736372697074696f6e223a22436f6e7469656e742061727469636c6520646520626c6f67222c226c696e6b223a222f626c6f67222c22776569676874223a222d323030227d, 'public'),
(16, 0x7b227469746c65223a225665696c6c6573222c226465736372697074696f6e223a22506167652064276163637565696c222c226c696e6b223a225c2f7665696c6c6573222c22776569676874223a222d313030222c2263617465676f7279223a22227d, 'public'),
(19, 0x7b227469746c65223a225050452031222c226465736372697074696f6e223a224c69656e2076657273206c652050504531222c226c696e6b223a22687474703a2f2f7070652e6c6f63616c222c22776569676874223a223130227d, 'public');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id_menu` varchar(20) COLLATE utf8_bin NOT NULL,
  `name_menu` varchar(20) COLLATE utf8_bin NOT NULL,
  `description_menu` varchar(75) COLLATE utf8_bin DEFAULT NULL,
  `weight_menu` tinyint(3) DEFAULT '0',
  `link_menu` varchar(150) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id_menu`, `name_menu`, `description_menu`, `weight_menu`, `link_menu`) VALUES
('56e972f75fa63', 'Articles', 'Liste les articles', 100, '/articles');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(20) COLLATE utf8_bin NOT NULL,
  `pseudo_user` varchar(20) COLLATE utf8_bin NOT NULL,
  `password_user` varchar(200) COLLATE utf8_bin NOT NULL,
  `email_user` varchar(100) COLLATE utf8_bin NOT NULL,
  `id_grade` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `pseudo_user`, `password_user`, `email_user`, `id_grade`) VALUES
('56c5d5546bc32', 'admin', '$2y$10$AUb83Oc7qzwMPrRN4WMnFuFrsf1I/t9x2h2r1yMKhJuLwSCOyjcyW', 'admincontact@blog.org', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users_information`
--

CREATE TABLE `users_information` (
  `id_user` varchar(20) COLLATE utf8_bin NOT NULL,
  `name` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `fk_id_author` (`author_article`),
  ADD KEY `fk_id_category` (`category_article`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `fk_id_menu` (`id_menu`);

--
-- Indexes for table `Error`
--
ALTER TABLE `Error`
  ADD PRIMARY KEY (`idError`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`idForm`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id_grade`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`),
  ADD UNIQUE KEY `menu_idMenu_uindex` (`idMenu`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_id_grade` (`id_grade`);

--
-- Indexes for table `users_information`
--
ALTER TABLE `users_information`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategory` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Error`
--
ALTER TABLE `Error`
  MODIFY `idError` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_article`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_grade`) REFERENCES `grades` (`id_grade`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users_information`
--
ALTER TABLE `users_information`
  ADD CONSTRAINT `users_information_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
