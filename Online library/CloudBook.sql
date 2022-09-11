-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2022 at 10:54 AM
-- Server version: 5.6.38
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CloudBook`
--

-- --------------------------------------------------------

--
-- Table structure for table `Author`
--

CREATE TABLE `Author` (
  `Id` bigint(20) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Author`
--

INSERT INTO `Author` (`Id`, `Name`) VALUES
(5, 'Vijaya Ramaswamy'),
(6, 'Thomas Palef.'),
(7, 'Robert C. Martin'),
(8, 'علي بن جابر الفيقي '),
(9, 'مركذ المنهاج لمراجعة القرآن '),
(10, 'محمد عثمان نجاتي '),
(11, 'جهاد الترباني '),
(12, 'مصطفي حسني '),
(13, 'عز الدين بن محمد '),
(14, 'محمد الغزالي '),
(15, 'Thomas H. cormen'),
(16, 'Harold abelson'),
(17, 'Steve mc.Connell'),
(18, 'Harper lee'),
(19, 'Meguel de carvantee');

-- --------------------------------------------------------

--
-- Table structure for table `Book`
--

CREATE TABLE `Book` (
  `Title` varchar(30) NOT NULL,
  `Pages` smallint(6) NOT NULL,
  `Publish-dat` year(4) NOT NULL,
  `Code` bigint(20) NOT NULL,
  `Category_id` bigint(20) NOT NULL,
  `Author_Id` bigint(20) NOT NULL,
  `Cover` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`Title`, `Pages`, `Publish-dat`, `Code`, `Category_id`, `Author_Id`, `Cover`) VALUES
('Clean Code ', 600, 2008, 4, 2, 7, 'cleanCode.jpeg'),
('Javascript ', 600, 2018, 6, 2, 5, 'js.jpg'),
('Historical Dictionary ', 320, 2009, 7, 3, 6, 'Historical.jpg'),
('لأنك الله', 192, 2016, 13, 1, 8, 'لانك_الله.jpg.webp'),
('القرآن تدبر وعمل ', 616, 2016, 14, 1, 9, 'القرآن-تدبر.jpg.webp'),
('الحديث النبوى وعلم النفس', 307, 2016, 15, 1, 10, 'الحديث-النبوي-وعلم-النفس.jpg.webp'),
('مدرسة الصحابة ', 190, 2017, 16, 1, 11, 'مدرسة-الصحابة.jpg.webp'),
('سحر الدنيا ', 250, 2020, 17, 1, 12, 'سحر-الدنيا.jpg.webp'),
('يوم في الجنه ', 120, 2018, 18, 1, 12, 'يوم-فى-الجنة.jpg.webp'),
('خدعوك فقالو ', 360, 2017, 19, 1, 12, 'خدعوك-فقالوا.jpg.webp'),
('فن الحياة', 399, 2019, 20, 1, 12, 'فن-الحياة.jpg.webp'),
('Introduction To Algorithms ', 1050, 2017, 21, 2, 15, 'introduction-to-algorithms.jpg.webp'),
('Instruction of computer ', 1070, 2015, 22, 2, 16, 'structure.jpg.webp'),
('The Clean Cooder', 1500, 2019, 23, 2, 7, 'the-clean-coder.jpg.webp'),
('Code complete ', 900, 2015, 24, 2, 17, 'code-caomplete.jpg.webp'),
('To kill', 200, 2000, 25, 5, 18, 'book-cover-To-Kill.jpg.webp'),
('Don Quixote', 100, 1999, 26, 5, 16, 'Don-Quixote.jpg.webp');

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `Name` varchar(30) NOT NULL,
  `Code` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`Name`, `Code`) VALUES
('Islamic ', 1),
('programming ', 2),
('Historic ', 3),
('Children ', 4),
('Novel', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `Id` bigint(20) NOT NULL,
  `User_Id` bigint(20) NOT NULL,
  `Book_Code` bigint(20) NOT NULL,
  `Content` varchar(500) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`Id`, `User_Id`, `Book_Code`, `Content`, `date`) VALUES
(1, 2, 4, 'Very nice book i recommend it for programmers who want to make their code easier and looking good ? ', '2022-08-11'),
(2, 5, 6, 'Very nice book i recommend it for programmers who want to make their code easier and looking good\r\n\r\nVery nice book i recommend it for programmers who want to make their code easier and looking good', '2022-08-11');

-- --------------------------------------------------------

--
-- Table structure for table `Recite`
--

CREATE TABLE `Recite` (
  `Code` int(11) NOT NULL,
  `Amount` smallint(6) NOT NULL,
  `Rdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Recite`
--

INSERT INTO `Recite` (`Code`, `Amount`, `Rdate`) VALUES
(1, 50, '2022-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `Reded_Books`
--

CREATE TABLE `Reded_Books` (
  `User_Id` bigint(20) NOT NULL,
  `Book_Code` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Reded_Books`
--

INSERT INTO `Reded_Books` (`User_Id`, `Book_Code`) VALUES
(29, 7),
(2, 19),
(2, 21),
(29, 21);

-- --------------------------------------------------------

--
-- Table structure for table `Saved_Books`
--

CREATE TABLE `Saved_Books` (
  `User_Id` bigint(20) NOT NULL,
  `Book_Code` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Saved_Books`
--

INSERT INTO `Saved_Books` (`User_Id`, `Book_Code`) VALUES
(1, 4),
(29, 4),
(8, 6),
(29, 6),
(30, 7),
(29, 13),
(30, 13),
(29, 14),
(30, 17),
(29, 22),
(29, 23),
(30, 23),
(30, 25);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Username` varchar(200) DEFAULT NULL,
  `Id` bigint(20) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Age` tinyint(4) NOT NULL,
  `Recite_code` int(11) DEFAULT NULL,
  `Password` char(200) NOT NULL,
  `photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Username`, `Id`, `Phone`, `Age`, `Recite_code`, `Password`, `photo`) VALUES
('Mohammed918', 1, 1110834150, 22, NULL, 'Jabralla', 'user.jpg'),
('Ahmad9012', 2, 1110834170, 20, NULL, 'Jabralla', 'user.jpg'),
('Hamada0199', 3, 1110834153, 23, NULL, 'Noorhjs', 'user.jpg'),
('Hepa110', 4, 1110834170, 20, NULL, 'Jabralla', 'user.jpg'),
('Islaam0990', 5, 111088919, 30, NULL, '19002', 'user.jpg'),
('Enjy787', 6, 11108341, 27, NULL, 'lla781j', 'user.jpg'),
('Hanyibraheem8', 7, 61900286, 23, NULL, 'Nooauwn', 'user.jpg'),
('Mohammed_jabrallah090', 8, 1110834178, 20, NULL, 'Nna8i', 'user.jpg'),
('Mohammed01110', 21, 1110872469, 0, NULL, '915858af', NULL),
('Mohammed_jabrallah', 26, 1110834120, 0, NULL, '4e357d53', NULL),
('User1', 29, 123456, 0, NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'user.jpg'),
('User2', 30, 123, 0, NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'سحر-الدنيا.jpg.webp'),
('testFinal', 31, 0, 0, NULL, '', NULL),
('User3', 32, 123, 0, NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Author`
--
ALTER TABLE `Author`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`Code`),
  ADD KEY `Category_id` (`Category_id`),
  ADD KEY `Author_FK_2sd` (`Author_Id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`Code`),
  ADD KEY `Code` (`Code`),
  ADD KEY `Code_2` (`Code`);

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Comment_ibfk_1` (`User_Id`),
  ADD KEY `commentsfk` (`Book_Code`);

--
-- Indexes for table `Recite`
--
ALTER TABLE `Recite`
  ADD PRIMARY KEY (`Code`);

--
-- Indexes for table `Reded_Books`
--
ALTER TABLE `Reded_Books`
  ADD PRIMARY KEY (`User_Id`,`Book_Code`),
  ADD KEY `Bookforign` (`Book_Code`);

--
-- Indexes for table `Saved_Books`
--
ALTER TABLE `Saved_Books`
  ADD PRIMARY KEY (`User_Id`,`Book_Code`),
  ADD KEY `savedforign` (`Book_Code`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `User_ibfk_1` (`Recite_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Author`
--
ALTER TABLE `Author`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Book`
--
ALTER TABLE `Book`
  MODIFY `Code` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `Code` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Recite`
--
ALTER TABLE `Recite`
  MODIFY `Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Book`
--
ALTER TABLE `Book`
  ADD CONSTRAINT `Author_FK_2sd` FOREIGN KEY (`Author_Id`) REFERENCES `Author` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Book_ibfk_1` FOREIGN KEY (`Category_id`) REFERENCES `Category` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentsfk` FOREIGN KEY (`Book_Code`) REFERENCES `Book` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Reded_Books`
--
ALTER TABLE `Reded_Books`
  ADD CONSTRAINT `Bookforign` FOREIGN KEY (`Book_Code`) REFERENCES `Book` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Userforign` FOREIGN KEY (`User_Id`) REFERENCES `User` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Saved_Books`
--
ALTER TABLE `Saved_Books`
  ADD CONSTRAINT `UserSavedforign` FOREIGN KEY (`User_Id`) REFERENCES `User` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `savedforign` FOREIGN KEY (`Book_Code`) REFERENCES `Book` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`Recite_code`) REFERENCES `Recite` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
