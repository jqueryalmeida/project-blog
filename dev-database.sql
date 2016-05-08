-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2016 at 01:41 PM
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
(6, 'Présentation', 'Petite présentation', 'Ceci est un  article de présentation qui vise à tester certaines petites fonctionnalités du site \r\n\r\n\r\nMais aussi pour voir comment il réagit dans le temps,  mais surtout avec certaines fonctions . \r\n\r\n\r\nQuand on aura atteint les 150 charactères je penses qu\'on pourra voir comment réagit la page d\'accueil ! \r\n\r\nCeci étant fait on va pouvoir publier cet article bidon pour enfin être sûr ! ', '2016-05-02 07:45:30', '56c5d5546bc32', '1'),
(7, 'Test Veilles Category', 'Little description', 'Litte text !', '2016-05-04 09:44:12', '56c5d5546bc32', '3'),
(8, 'Tes Veille article', 'Little description', 'Little text', '2016-05-04 11:30:27', '56c5d5546bc32', '3'),
(9, 'sdfvdsvc', 'sdfvcsd&lt;vc', 's&lt;dfvs&lt;dfv&lt;', '2016-05-08 08:36:52', '56c5d5546bc32', '2');

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
(2, 0x7b227469746c65223a2267666468222c22776569676874223a226667222c22706172656e74223a22227d, 'gfdh'),
(3, 0x7b227469746c65223a225665696c6c6573222c22776569676874223a223130222c22706172656e74223a22227d, 'Veilles');

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

--
-- Dumping data for table `Error`
--

INSERT INTO `Error` (`idError`, `messageError`, `codeError`, `file`, `lineFile`, `dateTime`, `trace`, `type`) VALUES
(1, 'Not in possibilities', '0', '/var/www/blog/app/controllers/Admin/Admin.class.php', 515, '2016-05-08 09:22:31', '[{"file":"\\/var\\/www\\/blog\\/app\\/models\\/Router.class.php","line":197,"function":"experiences","class":"App\\\\Controllers\\\\Admin","type":"->","args":["a",[]]},{"file":"\\/var\\/www\\/blog\\/app\\/models\\/Router.class.php","line":34,"function":"loadController","class":"App\\\\Models\\\\Router","type":"->","args":[{},"experiences"]},{"file":"\\/var\\/www\\/blog\\/index.php","line":15,"function":"__construct","class":"App\\\\Models\\\\Router","type":"->","args":["admin\\/experiences\\/a","dev"]}]', 'php_error');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `idExperience` int(11) NOT NULL,
  `dataExperience` longblob NOT NULL,
  `nameExperience` varchar(80) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`idExperience`, `dataExperience`, `nameExperience`) VALUES
(8, 0x7b226e616d65223a22445c753030653976656c6f7070657572222c22656e7465727072697365223a22546168697469436c6963222c22626567696e223a22323031352d30352d3130222c22656e64223a22323031362d30352d3135222c2264657461696c73223a227a65667a6566222c22636f6e74726174223a225374616765222c226475726565436f6e74726174223a7b2279656172223a312c226d6f6e746873223a302c2264617973223a357d7d, 'Développeur'),
(9, 0x7b226e616d65223a22445c753030653976656c6f7070657572222c22656e7465727072697365223a22546168697469436c6963222c22626567696e223a22323031362d30352d3031222c22656e64223a22323031362d30352d3239222c2264657461696c73223a22222c22636f6e74726174223a225374616765222c226475726565436f6e74726174223a7b2279656172223a302c226d6f6e746873223a302c2264617973223a32387d7d, 'Développeur');

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
(19, 0x7b227469746c65223a225050452031222c226465736372697074696f6e223a224c69656e2076657273206c652050504531222c226c696e6b223a22687474703a2f2f7070652e6c6f63616c222c22776569676874223a223130227d, 'public'),
(33, 0x7b227469746c65223a224356222c226465736372697074696f6e223a224465736372697074696f6e20435620222c226c696e6b223a225c2f736b696c6c73222c22776569676874223a223230227d, 'public');

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
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `idSkill` int(11) NOT NULL,
  `dataSkill` longblob NOT NULL,
  `nameSkill` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`idSkill`, `dataSkill`, `nameSkill`) VALUES
(1, 0x7b226e616d65223a2248544d4c35222c226c6576656c223a223930227d, 'HTML5'),
(58, 0x7b226e616d65223a22504850222c226c6576656c223a223730227d, 'PHP'),
(59, 0x7b226e616d65223a224a617661536372697074222c226c6576656c223a223530227d, 'JavaScript');

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
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`idExperience`);

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
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`idSkill`);

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
  MODIFY `id_article` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategory` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Error`
--
ALTER TABLE `Error`
  MODIFY `idError` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `idExperience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `idSkill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
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
