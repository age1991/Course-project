-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2015 at 11:56 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MovieDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `grading`
--

CREATE TABLE IF NOT EXISTS `grading` (
  `points` int(5) NOT NULL,
  `gradeBy` int(5) NOT NULL,
  `graded` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grading`
--

INSERT INTO `grading` (`points`, `gradeBy`, `graded`) VALUES
(5, 1, 13),
(7, 8, 13),
(3, 9, 13),
(9, 9, 15),
(10, 9, 17);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
  `listId` int(5) NOT NULL,
  `listName` varchar(50) NOT NULL,
  `listDescription` varchar(255) DEFAULT NULL,
  `listScore` float DEFAULT NULL,
  `ownedBy` int(5) NOT NULL,
  `include` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`listId`, `listName`, `listDescription`, `listScore`, `ownedBy`, `include`) VALUES
(13, 'Funny Movies', 'All the funny movies that I''ve watched.', 5, 8, NULL),
(14, 'Worst Movie', 'Movies you don''t want to see!', NULL, 8, NULL),
(15, 'Drama', 'These movies are pretty funny!', 9, 8, NULL),
(16, 'Marvel', 'Marvel movies! Funny to watch!', NULL, 8, NULL),
(17, 'Funniest Movies', 'Movies that I think are funny.', 10, 1, NULL),
(18, 'Twisted', 'Movie with unexpected story and ending.', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `movieId` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `releasedDate` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `mdescription` varchar(5000) DEFAULT NULL,
  `includedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieId`, `name`, `releasedDate`, `image`, `mdescription`, `includedBy`) VALUES
(3, 'Maze Runner: The Scorch Trials', '2015-09-18', '/vlTPQANjLYTebzFJM1G4KeON0cb.jpg', 'Thomas and his fellow Gladers face their greatest challenge yet: searching for clues about the mysterious and powerful organization known as WCKD. Their journey takes them to the Scorch, a desolate landscape filled with unimaginable obstacles. Teaming up with resistance fighters, the Gladers take on WCKDÃ¢Â€Â™s vastly superior forces and uncover its shocking plans for them all.', 14),
(4, 'The Last Airbender', '2010-06-30', '/5kO6hVZrtBZ98VfpgHvwivjXgMg.jpg', 'The story follows the adventures of Aang, a young successor to a long line of Avatars, who must put his childhood ways aside and stop the Fire Nation from enslaving the Water, Earth and Air nations.', 14),
(5, 'Kingsman: The Secret Service', '2015-01-13', '/8x7ej0LnHdKUqilNNJXYOeyB6L9.jpg', 'Kingsman: The Secret Service tells the story of a super-secret spy organization that recruits an unrefined but promising street kid into the agency''s ultra-competitive training program just as a global threat emerges from a twisted tech genius.', 15),
(6, 'Snatch', '2000-09-01', '/on9JlbGEccLsYkjeEph2Whm1DIp.jpg', 'The second film from British director Guy Ritchie. Snatch tells an obscure story similar to his first fast-paced crazy character-colliding filled film Ã¢Â€ÂœLock, Stock &amp; Two Smoking Barrels.Ã¢Â€Â There are two overlapping stories here Ã¢Â€Â“ one is the search for a stolen diamond, and the other about a boxing promoter whoÃ¢Â€Â™s having trouble with a psychotic gangster.', 15),
(8, 'Hot Fuzz', '2007-02-14', '/5Jx6s6VXnunh8wCLgR0YgjwSgjh.jpg', 'Top London cop PC Nicholas Angel is good. Too good. And to stop the rest of his team from looking bad, he is reassigned to the quiet town of Sandford. Paired with simple country cop Danny, everything seems quiet until two actors are found decapitated. It is addressed as an accident, but Angel isn''t going to accept that, especially when more and more people turn up dead.', 17),
(9, 'Zombieland', '2009-12-03', '/vUzzDpVrab1BOG3ogxhRGfLN94d.jpg', 'Columbus (Jesse Eisenberg) has made a habit of running from what scares him. Tallahassee (Woody Harrelson) doesn''t have fears. If he did, he''d kick their ever-living ass. In a world overrun by zombies, these two are perfectly evolved survivors. But now, they''re about to stare down the most terrifying prospect of all: each other.', 17),
(10, 'Snatch', '2000-09-01', '/on9JlbGEccLsYkjeEph2Whm1DIp.jpg', 'The second film from British director Guy Ritchie. Snatch tells an obscure story similar to his first fast-paced crazy character-colliding filled film Ã¢Â€ÂœLock, Stock &amp; Two Smoking Barrels.Ã¢Â€Â There are two overlapping stories here Ã¢Â€Â“ one is the search for a stolen diamond, and the other about a boxing promoter whoÃ¢Â€Â™s having trouble with a psychotic gangster.', 13),
(11, 'Full Metal Jacket', '1987-05-31', '/vM5Pkp4L6nB9TzNARhrToOE11IX.jpg', 'A pragmatic U.S. Marine observes the dehumanizing effects the U.S.-Vietnam War has on his fellow recruits from their brutal boot camp training to the bloody street fighting in Hue.', 13),
(12, 'Ace Ventura: Pet Detective', '1994-02-04', '/nZirljb8XYbKTWsRQTplDGhx39Q.jpg', 'He''s Ace Ventura: Pet Detective. Jim Carrey is on the case to find the Miami Dolphins'' missing mascot and quarterback Dan Marino. He goes eyeball to eyeball with a man-eating shark, stakes out the Miami Dolphins and woos and wows the ladies. Whether he''s undercover, under fire or underwater, he always gets his man . . . or beast!', 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `description`) VALUES
(1, 'age1991', '84710868149a84c83a0284f6e6a51aa3', ''),
(6, 'ahelalks', '9984a3faadec241cb480b9c3e259fa54', ''),
(7, 'ssa', '77963b7a931377ad4ab5ad6a9cd718aa', 'asdsaffaa'),
(8, 'cs5200', '84710868149a84c83a0284f6e6a51aa3', 'hello'),
(9, 'age1992', '84710868149a84c83a0284f6e6a51aa3', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grading`
--
ALTER TABLE `grading`
  ADD PRIMARY KEY (`gradeBy`,`graded`),
  ADD KEY `gradeBy` (`gradeBy`),
  ADD KEY `graded` (`graded`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`listId`),
  ADD KEY `ownedBy` (`ownedBy`),
  ADD KEY `include` (`include`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieId`),
  ADD KEY `includedBy` (`includedBy`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `listId` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieId` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `grading`
--
ALTER TABLE `grading`
  ADD CONSTRAINT `grading_ibfk_1` FOREIGN KEY (`gradeBy`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grading_ibfk_2` FOREIGN KEY (`graded`) REFERENCES `lists` (`listId`);

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`ownedBy`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lists_ibfk_2` FOREIGN KEY (`include`) REFERENCES `movies` (`movieId`);

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`includedBy`) REFERENCES `lists` (`listId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
