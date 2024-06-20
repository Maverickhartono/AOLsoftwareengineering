-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 08:34 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `description`, `title`, `image`) VALUES
(27, 'SQL Injection is a code injection technique that exploits vulnerabilities in applications interacting with databases. Attackers can insert malicious SQL commands into the query executed by the application, allowing them to view, modify, or delete data from the database.', ' SQL Injection', 'Screenshot 2024-06-20 012708.png'),
(28, ' XSS is a type of security vulnerability found in web applications. It allows attackers to inject malicious scripts into web pages viewed by other users. XSS can be used to steal user data, such as cookies, session tokens, or other sensitive information.', 'Cross-Site Scripting (XSS)', 'Screenshot 2024-06-20 012831.png'),
(29, 'CSRF is a type of attack that tricks a user into performing actions they did not intend to perform. It exploits the trust that a web application has in the authenticated user by using their credentials to send unauthorized requests.', 'Cross-Site Request Forgery (CSRF)', 'Screenshot 2024-06-20 012946.png');

-- --------------------------------------------------------

--
-- Table structure for table `mscategory`
--

CREATE TABLE `mscategory` (
  `CategoryID` char(5) NOT NULL CHECK (`CategoryID` regexp '^CT[0-9][0-9][0-9]$'),
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mscategory`
--

INSERT INTO `mscategory` (`CategoryID`, `CategoryName`) VALUES
('CT001', 'Dairy'),
('CT002', 'Vegetable'),
('CT003', 'Fruit'),
('CT004', 'Meat'),
('CT005', 'Condiment');

-- --------------------------------------------------------

--
-- Table structure for table `mscustomer`
--

CREATE TABLE `mscustomer` (
  `CustomerID` char(5) NOT NULL CHECK (`CustomerID` regexp '^CU[0-9][0-9][0-9]$'),
  `CustomerName` varchar(50) NOT NULL,
  `CustomerGender` varchar(10) NOT NULL,
  `CustomerAddress` varchar(50) NOT NULL,
  `CustomerEmail` varchar(50) NOT NULL,
  `CustomerDOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mscustomer`
--

INSERT INTO `mscustomer` (`CustomerID`, `CustomerName`, `CustomerGender`, `CustomerAddress`, `CustomerEmail`, `CustomerDOB`) VALUES
('CU001', 'Dirk Titterell', 'Male', '74 Melvin Point', 'dtitterell0@yellowpages.com', '2003-10-29'),
('CU002', 'Dukey Diano', 'Male', '92 Sugar Alley', 'ddiano1@state.com', '2003-09-27'),
('CU003', 'Alex Meekins', 'Male', '577 Dovetail Park', 'ameekins2@blogs.com', '1996-11-06'),
('CU004', 'Mrs.Mrs.Cherice Jermey', 'Female', '811 Debs Street', 'cjermeyladylady3@guardian.com', '2000-05-18'),
('CU005', 'Ingamar Carlin', 'Male', '389 Surrey Pass', 'icarlin4@shareasale.com', '2003-08-08'),
('CU006', 'Pooh McCutcheon', 'Male', '7 Melby Trail', 'pmccutcheon5@salon.com', '2001-08-03'),
('CU007', 'Silvain Jozsa', 'Female', '19269 Maryland Hill', 'sjozsa6@omniture.com', '2003-12-30'),
('CU008', 'Mrs.Mrs.Javier Drewson', 'Female', '8 Moulton Point', 'jdrewsonladylady7@home.com', '1996-08-20'),
('CU009', 'Wilbur Francino', 'Female', '21840 Golden Leaf Avenue', 'wfrancino8@wunderground.com', '2003-10-06'),
('CU010', 'Sadie Snow', 'Female', '70 Eagle Crest Hill', 'ssnow9@github.com', '2004-04-25'),
('CU011', 'Mrs.Mrs.Sofie Carmen', 'Female', '20196 Springview Plaza', 'scarmenladyladya@gov.com', '2000-11-20'),
('CU012', 'Amy Grenkov', 'Male', '2263 Weeping Birch Center', 'agrenkovb@aol.com', '2003-06-06'),
('CU013', 'Gabriela Scarf', 'Female', '920 Bobwhite Trail', 'gscarfc@skype.com', '2004-03-12'),
('CU014', 'Westley Boram', 'Female', '47 Darwin Terrace', 'wboramd@sun.com', '2003-09-03'),
('CU015', 'Hadleigh Playfoot', 'Female', '49 6th Junction', 'hplayfoote@msu.com', '2004-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `msemployee`
--

CREATE TABLE `msemployee` (
  `EmployeeID` char(5) NOT NULL CHECK (`EmployeeID` regexp '^EM[0-9][0-9][0-9]$'),
  `EmployeeName` varchar(50) NOT NULL,
  `EmployeeGender` varchar(10) NOT NULL,
  `EmployeeAddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msemployee`
--

INSERT INTO `msemployee` (`EmployeeID`, `EmployeeName`, `EmployeeGender`, `EmployeeAddress`) VALUES
('EM001', 'Clem', 'Male', '0975 Forest Dale Trail'),
('EM002', 'Dene', 'Male', '2 Grayhawk Parkway'),
('EM003', 'Lethia', 'Female', '905 Goodland Lane'),
('EM004', 'Tyrone', 'Male', '51745 Bowman Hill'),
('EM005', 'Shanda', 'Male', '848 New Castle Center'),
('EM006', 'Nani', 'Male', '3455 Village Green Court'),
('EM007', 'Dorothea', 'Male', '772 Goodland Park'),
('EM008', 'Chet', 'Female', '1 Merchant Street'),
('EM009', 'Darsie', 'Female', '31718 Toban Point'),
('EM010', 'Don', 'Male', '936 Lyons Plaza'),
('EM011', 'Tabby', 'Male', '10787 School Drive'),
('EM012', 'Desmond', 'Male', '8 Lien Junction'),
('EM013', 'Robenia', 'Female', '4 Dapin Avenue'),
('EM014', 'Curr', 'Female', '2 Veith Terrace'),
('EM015', 'Rudd', 'Male', '2 Hermina Park');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `Fullname` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Education` varchar(50) DEFAULT NULL,
  `Job` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`Fullname`, `Email`, `Username`, `Password`, `Phone`, `Country`, `State`, `Education`, `Job`, `role`) VALUES
('aaa', 'sfsf@kontol.ac.id', 'matthew', '$2y$10$S2Ssc4SlO1YaG/jS2pUHEu.IPB.137NNHnUXsO/2cSRPl3CistUQC', '00000000000', 'a', 'a', 'a', 'a', 'member'),
('aaa', 'sfsf@kontol.ac.id', 'matthewa', '$2y$10$IYhCc21oQ8NXeEXb4sjqleKl1A7t7ObIdwwj4x2TlqqSZe7xsXFji', '00000000000', 'a', 'a', 'a', 'a', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `transactionheader`
--

CREATE TABLE `transactionheader` (
  `TransactionID` char(5) NOT NULL CHECK (`TransactionID` regexp '^TR[0-9][0-9][0-9]$'),
  `EmployeeID` char(5) NOT NULL,
  `CustomerID` char(5) NOT NULL,
  `TransactionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactionheader`
--

INSERT INTO `transactionheader` (`TransactionID`, `EmployeeID`, `CustomerID`, `TransactionDate`) VALUES
('TR001', 'EM006', 'CU002', '2022-05-01'),
('TR002', 'EM005', 'CU003', '2022-07-02'),
('TR003', 'EM011', 'CU001', '2022-02-14'),
('TR004', 'EM014', 'CU007', '2022-10-20'),
('TR005', 'EM005', 'CU008', '2022-12-25'),
('TR006', 'EM009', 'CU009', '2022-06-06'),
('TR007', 'EM011', 'CU015', '2022-01-01'),
('TR008', 'EM013', 'CU005', '2022-03-02'),
('TR009', 'EM014', 'CU013', '2022-08-09'),
('TR010', 'EM009', 'CU002', '2022-09-01'),
('TR011', 'EM013', 'CU008', '2022-07-12'),
('TR012', 'EM006', 'CU014', '2022-11-25'),
('TR013', 'EM005', 'CU001', '2022-10-31'),
('TR014', 'EM009', 'CU003', '2022-12-24'),
('TR015', 'EM005', 'CU010', '2022-04-12'),
('TR016', 'EM011', 'CU011', '2022-02-14'),
('TR017', 'EM006', 'CU013', '2022-05-17'),
('TR018', 'EM005', 'CU002', '2022-07-04'),
('TR019', 'EM009', 'CU005', '2022-01-18'),
('TR020', 'EM014', 'CU009', '2022-06-06'),
('TR021', 'EM009', 'CU014', '2022-03-17'),
('TR022', 'EM014', 'CU006', '2022-08-15'),
('TR023', 'EM005', 'CU007', '2022-12-25'),
('TR024', 'EM009', 'CU015', '2022-10-31'),
('TR025', 'EM006', 'CU010', '2022-11-01'),
('TR026', 'EM014', 'CU005', '2022-02-14'),
('TR027', 'EM009', 'CU008', '2022-04-12'),
('TR028', 'EM014', 'CU014', '2022-07-04'),
('TR029', 'EM005', 'CU009', '2022-08-09'),
('TR030', 'EM014', 'CU001', '2022-12-24'),
('TR031', 'EM005', 'CU006', '2022-05-17'),
('TR032', 'EM009', 'CU011', '2022-10-20'),
('TR033', 'EM014', 'CU002', '2022-11-25'),
('TR034', 'EM005', 'CU010', '2022-09-01'),
('TR035', 'EM014', 'CU003', '2022-06-06'),
('TR036', 'EM011', 'CU007', '2022-01-06'),
('TR037', 'EM009', 'CU013', '2022-03-02'),
('TR038', 'EM005', 'CU014', '2022-08-09'),
('TR039', 'EM014', 'CU005', '2022-09-01'),
('TR040', 'EM009', 'CU001', '2022-07-12'),
('TR041', 'EM013', 'CU009', '2022-11-25'),
('TR042', 'EM006', 'CU006', '2022-10-31'),
('TR043', 'EM009', 'CU008', '2022-12-24'),
('TR044', 'EM014', 'CU015', '2022-04-12'),
('TR045', 'EM005', 'CU011', '2022-02-14'),
('TR046', 'EM009', 'CU002', '2022-05-17'),
('TR047', 'EM006', 'CU003', '2022-07-04'),
('TR048', 'EM014', 'CU007', '2022-02-01'),
('TR049', 'EM009', 'CU014', '2022-06-06'),
('TR050', 'EM014', 'CU010', '2022-03-17'),
('TR051', 'EM005', 'CU005', '2022-08-15'),
('TR052', 'EM014', 'CU013', '2022-12-25'),
('TR053', 'EM005', 'CU009', '2022-10-31'),
('TR054', 'EM006', 'CU006', '2022-11-01'),
('TR055', 'EM009', 'CU008', '2022-02-14'),
('TR056', 'EM014', 'CU014', '2022-04-12'),
('TR057', 'EM005', 'CU009', '2022-07-04'),
('TR058', 'EM014', 'CU001', '2022-08-09'),
('TR059', 'EM005', 'CU006', '2022-12-24'),
('TR060', 'EM009', 'CU011', '2022-05-17'),
('TR061', 'EM014', 'CU002', '2022-10-20'),
('TR062', 'EM005', 'CU010', '2022-11-25'),
('TR063', 'EM014', 'CU003', '2022-09-01'),
('TR064', 'EM011', 'CU007', '2022-06-06'),
('TR065', 'EM009', 'CU013', '2022-03-02'),
('TR066', 'EM005', 'CU014', '2022-08-09'),
('TR067', 'EM014', 'CU005', '2022-09-01'),
('TR068', 'EM009', 'CU001', '2022-07-12'),
('TR069', 'EM013', 'CU009', '2022-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `woi`
--

CREATE TABLE `woi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `datee` date DEFAULT NULL,
  `format` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `woi`
--

INSERT INTO `woi` (`id`, `nama`, `datee`, `format`, `location`, `notes`) VALUES
(25, 'Grey Cat The Flag 2024 Finals', '2024-06-18', 'Jeopardy', 'onsite', 'Location Singapore and 33 teams will participate'),
(26, 'CyberSci Nationals 2024', '2024-05-26', 'Jeopardy', 'onsite', 'Location Canada and 14 teams will participate'),
(27, 'Wani CTF 2024', '0000-00-00', 'Jeopardy', 'online', '	110 teams will participate'),
(28, 'Google Capture The Flag 2024', '0000-00-00', 'Jeopardy', 'online', '	410 teams will participate'),
(29, 'HACK\'OSINT - CTF', '0000-00-00', 'Jeopardy', 'online', '	10 teams will participate'),
(30, '?GÜCTF 24\'', '0000-00-00', 'Jeopardy', 'online', '	55 teams will participate'),
(31, 'Break The Wall - Dystopia 2099', '0000-00-00', 'Jeopardy', 'online', '	70 teams will participate'),
(32, 'The Hacker Conclave', '0000-00-00', 'Jeopardy', 'online', '	60 teams will participate'),
(33, 'UIUCTF 2024', '0000-00-00', 'Jeopardy', 'online', '	50 teams will participate'),
(34, 'DiceCTF 2024 Finals', '0000-00-00', 'Jeopardy', 'online', '	2200 teams will participate');

-- --------------------------------------------------------

--
-- Table structure for table `writeup`
--

CREATE TABLE `writeup` (
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writeup`
--

INSERT INTO `writeup` (`title`, `author`, `description`, `id`) VALUES
('write up for the grey cat the flag', 'agung', 'With pride, we announce that our team has successfully completed all challenges in the Grey Cat The Flag 2024 Finals CTF competition. The comprehensive writeup detailing each challenge can be found here https://example.com . This victory not only reflects the technical prowess of our team but also the hard work and outstanding collaboration among team members. We thank the organizers for this challenging and educational experience!', 24),
('CyberSec Challenge 2024: Journey to Victory', 'CyberElite Team', 'ive into our team\'s adventure and triumphs in the CyberSec Challenge 2024. This writeup unveils our strategies, techniques, and solutions that led us to victory. Follow our journey in detail on our youtube.', 25),
('CodeBreaker 2024: Unraveling the Enigma', ' Cryptic Minds Crew', 'Join us on a journey of code-breaking and problem-solving in the CodeBreaker 2024 competition. Our writeup delves into the challenges we faced and the innovative solutions we devised. Explore our insights and strategies on our website https://example.com.', 26),
(' Hackathon Heroes: Innovations Unleashed', 'TechGenius Innovators', ' Discover the innovative solutions and creative strategies of our team in the Hackathon Heroes competition. Our writeup showcases how we unleashed our potential and creativity to solve complex problems. Read more about our journey here.', 27),
('SecureNet 2024: Navigating the Cyber Maze', 'CyberNavigators', 'ollow our team\'s navigation through the intricate challenges of SecureNet 2024. Our writeup provides insights into our cybersecurity skills, teamwork, and problem-solving abilities. Explore our journey through the cyber maze on our instagram', 28),
('SecureNet 2024: Navigating the Cyber Maze', 'CyberNavigators', 'ollow our team\'s navigation through the intricate challenges of SecureNet 2024. Our writeup provides insights into our cybersecurity skills, teamwork, and problem-solving abilities. Explore our journey through the cyber maze on our instagram', 29),
('SecureNet 2024: Navigating the Cyber Maze', 'CyberNavigators', 'ollow our team\'s navigation through the intricate challenges of SecureNet 2024. Our writeup provides insights into our cybersecurity skills, teamwork, and problem-solving abilities. Explore our journey through the cyber maze on our instagram', 30),
('SecureNet 2024: Navigating the Cyber Maze', 'CyberNavigators', 'ollow our team\'s navigation through the intricate challenges of SecureNet 2024. Our writeup provides insights into our cybersecurity skills, teamwork, and problem-solving abilities. Explore our journey through the cyber maze on our instagram', 31),
('SecureNet 2024: Navigating the Cyber Maze', 'CyberNavigators', 'ollow our team\'s navigation through the intricate challenges of SecureNet 2024. Our writeup provides insights into our cybersecurity skills, teamwork, and problem-solving abilities. Explore our journey through the cyber maze on our instagram', 32),
('SecureNet 2024: Navigating the Cyber Maze', 'CyberNavigators', 'ollow our team\'s navigation through the intricate challenges of SecureNet 2024. Our writeup provides insights into our cybersecurity skills, teamwork, and problem-solving abilities. Explore our journey through the cyber maze on our instagram', 33);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mscategory`
--
ALTER TABLE `mscategory`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `mscustomer`
--
ALTER TABLE `mscustomer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `msemployee`
--
ALTER TABLE `msemployee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `transactionheader`
--
ALTER TABLE `transactionheader`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `woi`
--
ALTER TABLE `woi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `writeup`
--
ALTER TABLE `writeup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `woi`
--
ALTER TABLE `woi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `writeup`
--
ALTER TABLE `writeup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactionheader`
--
ALTER TABLE `transactionheader`
  ADD CONSTRAINT `transactionheader_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `msemployee` (`EmployeeID`),
  ADD CONSTRAINT `transactionheader_ibfk_2` FOREIGN KEY (`CustomerID`) REFERENCES `mscustomer` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
