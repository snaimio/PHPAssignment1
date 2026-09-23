-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2026 at 05:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(100) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `publishedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `title`, `author`, `genre`, `isbn`, `publishedDate`) VALUES
(1, 'Atomic Habits', 'James Clear', 'Self-Improvement', '978-0-7352-1129-2', '2018-10-16'),
(2, 'The Art of Thinking Clearly', 'Rolf Dobelli', 'Psychology', '978-0-06-221968-8', '2013-04-01'),
(3, 'Influence: The Psychology of Persuasion', 'Robert Cialdini', 'Psychology', '978-0-06-124189-5', '1984-01-01'),
(4, 'Mindset: The New Psychology of Success', 'Carol S. Dweck', 'Psychology', '978-0-345-47232-8', '2006-02-28'),
(5, 'Man\'s Search for Meaning', 'Viktor E. Frankl', 'Memoir', '978-0-8070-1429-5', '1946-01-01'),
(6, 'The Psychology of Money', 'Morgan Housel', 'Finance', '978-0-85719-769-6', '2020-09-08'),
(7, 'Family Fortunes', 'Bill Bonner & Will Bonner', 'Finance', '978-0-470-45519-6', '2011-04-05'),
(8, 'Hold On to Your Kids', 'Gordon Neufeld & Gabor Maté', 'Parenting', '978-0-345-40128-0', '2004-01-01'),
(9, 'Girls on the Edge', 'Leonard Sax', 'Parenting', '978-0-465-02031-4', '2010-08-24'),
(10, 'The Whole-Brain Child', 'Daniel J. Siegel & Tina Payne Bryson', 'Parenting', '978-0-553-38669-1', '2011-10-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
