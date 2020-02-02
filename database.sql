--
-- Host: localhost    Database: egames
-- ------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (2,'Avantura'),(3,'First Role Play');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `pub_date` datetime NOT NULL,
  `game_user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `game_user_id` (`game_user_id`),
  KEY `news_id` (`news_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`game_user_id`) REFERENCES `game_user` (`id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'Test','2019-10-15 01:05:17',1,1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_user`
--

DROP TABLE IF EXISTS `game_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_user`
--

LOCK TABLES `game_user` WRITE;
/*!40000 ALTER TABLE `game_user` DISABLE KEYS */;
INSERT INTO `game_user` VALUES (1,'Uroš Rajković','urosrajkovic011@hotmail.com','$2y$10$tYvKy435T7zLxLzOagjrFOkreo8Red9yLzgjeklVwcqvHavLiT0gS','admin'),(2,'Super Mario','gejmer@gejmer.net','$2y$10$d0kHHwqSCgDPJlgXOxqVuOklRi4SGM/TKg.3NMJjgBROMbQ/SMwKu','gejmer');
/*!40000 ALTER TABLE `game_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `content` text NOT NULL,
  `intro` text NOT NULL,
  `pub_date` date NOT NULL,
  `game_user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `img_url` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `game_user_id` (`game_user_id`),
  KEY `category_id` (`category_id`),
  FULLTEXT KEY `idx_fts_news` (`title`,`intro`,`content`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`game_user_id`) REFERENCES `game_user` (`id`),
  CONSTRAINT `news_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'NFS2','<p>\r\nNeed for Speed (NFS) is a racing video game franchise published by Electronic Arts and currently developed by Ghost Games. The series centers around illicit street racing and in general tasks players to complete various types of races while evading the local law enforcement in police pursuits. The series released its first title, The Need for Speed, in 1994. The most recent game, Need for Speed Payback, was released in 2017.\r\n</p>\r\n<p>\r\n       <img src=\"resource/img/bg-img/6.jpg\" alt=\"\">\r\n</p>\r\n<p>\r\nThe Need for Speed series was originally developed by Distinctive Software, a video game studio based in Vancouver, British Columbia, Canada. Prior to Electronic Arts\' purchase of the company in 1991, it had created popular racing games such as Stunts and Test Drive II: The Duel. After the purchase, the company was renamed Electronic Arts (EA) Canada. The company capitalized on its experience in the domain by developing the Need for Speed series in late 1992.[4]\r\n</p><p>\r\nEA Canada continued to develop and expand the Need for Speed franchise up to 2002, when another Vancouver-based gaming company, named Black Box Games, was contracted to continue the series with Need for Speed: Hot Pursuit 2.[5] EA Black Box has been the primary series developer on a yearly cycle from 2002-08.\r\n</p><p>\r\nIn 2009, EA brought in Slightly Mad Studios, due to sagging sales, and they released Need for Speed: Shift, and EA\'s own UK-based company Criterion Games came with Hot Pursuit in 2010. In 2011, Slightly Mad Studios released a sequel to Shift, Shift 2: Unleashed and EA Black Box released The Run.\r\n</p><p>\r\nIn 2010, EA introduced a social platform, titled Autolog, for Need for Speed: Hot Pursuit and future games in the series. Autolog provides social features for Need for Speed games via a mobile app and website; it allows players to track game progress, view leaderboards, share screenshots with friends, and more.[6]\r\n</p><p>\r\nAt E3 2012, Criterion Games vice president Alex Ward announced that random developers would no longer be developing NFS titles. Ward wouldn\'t confirm that all Need for Speed games in the future would be developed entirely by Criterion, but he did say the studio would have \"strong involvement\" in them and would have control over which NFS titles would be released in the future.[1][7]\r\n</p><p>\r\nIn August 2013, following the downsizing of Criterion Games, it was announced that Swedish developer Ghost Games would gain control of the Need for Speed racing franchise and oversee future development of the main series.[8][9] At the time, 80% of Ghost Games\' work force consisted of former Criterion Games employees.[8][9]\r\n</p>\r\n<h5>Gameplay</h5>\r\n<p>\r\nAlmost all of the games in the NFS series employ the same fundamental rules and similar mechanics: the player controls a race car in a variety of races, the goal being to win the race. In the tournament/career mode, the player must win a series of races in order to unlock vehicles and tracks. Before each race, the player chooses a vehicle and has the option of selecting either an automatic or manual transmission. All games in the series have some form of multiplayer mode allowing players to race one another via a split screen, a LAN or the Internet. Since Need for Speed: High Stakes, the series has also integrated car body customization into gameplay.\r\n</p><p>\r\nAlthough the games share the same name, their tone and focus can vary significantly. For example, in some games the cars can suffer mechanical and visual damage, while in other games the cars cannot be damaged at all; in some games, the software simulates real-car behavior (physics), while in others there are more forgiving physics.\r\n</p><p>\r\nWith the release of Need for Speed: Underground, the series shifted from racing sports cars on scenic point-to-point tracks to an import/tuner subculture involving street racing in an urban setting. To date, this theme has remained prevalent in most of the following games.\r\n</p><p>\r\nNeed for Speed: Shift and its sequel took a simulator approach to racing, featuring closed-circuit racing on real tracks like the Nürburgring and the Laguna Seca, and fictional street circuits in cities like London and Chicago. The car lists include a combination of exotics, sports cars, and tuners in addition to special race cars.\r\n</p><p>\r\nMost of the games in the franchise include police pursuits in some form or other. In some of the games featuring police pursuit (e.g. Need for Speed III: Hot Pursuit), the player can play as either the felon or the cop.[10] The concepts of drifting and dragging were introduced in Need for Speed: Underground. These new mechanics are included in the tournament/career mode aside from the regular street races. Drift races, in games like Need for Speed: Underground and Need for Speed (2015), the player must defeat other racers by totaling the most points, earned by the length and timing of the drift made by the player\'s vehicle.[11] In drag races, the player must finish first to win the race, though if the player crashes into an obstacle or wall, the race ends.[11] In the recent game Need for Speed: Payback, the player has to earn a certain number of points to win; increase their multiplier based on how many points they get, whist passing through a limited number of checkpoints.[12]\r\n</p><p>\r\nThe concept of car tuning evolved with each new game, from focusing mainly on the mechanics of the car to including how the car looks. Each game except Need for Speed: Hot Pursuit has car tuning which can set options for items like ABS, traction control, or downforce, or for upgrading parts like the engine or gearbox. Visual tuning of the player\'s car becomes important in tournament/career mode after the release of Need for Speed: Underground 2, when the appearance is rated from zero to ten points. When a car attains a high enough visual rating, the vehicle is eligible to be on the cover of a fictional magazine.[13]\r\n</p><p>\r\nLike all racing games, the Need for Speed series features a list of cars, modeled and named after actual cars. Cars in the franchise are divided into four categories: exotic cars, muscle cars, tuners, and special vehicles.[14] Exotic cars feature high performance, expensive cars like the Lamborghini Murciélago, Mercedes-Benz SLR McLaren, Chevrolet Corvette and the Ford GT; muscle cars refer to the Ford Mustang, Dodge Challenger and the Chevrolet Camaro; while tuner cars are cars like the Nissan Skyline and the Mitsubishi Lancer Evolution. The special vehicles are civilian and police cars that are available for use in some games, such as the Ford Crown Victoria in Need for Speed: Hot Pursuit and garbage trucks, fire engines and taxis in Need for Speed: Carbon.[14]\r\n</p><p>\r\nOriginally the series took place in international settings, such as race tracks in Australia, Europe, and Africa.[15] Beginning with Underground, the series has taken place in fictional metropolitan cities.[16] The first game featured traffic on \"head to head\" mode, while later games traffic can be toggled on and off, and starting with Underground, traffic is a fixed obstacle.[16] Most of the recent Need for Speed games are set in fictional locations of our world, in a number of different time periods. These include, but are not limited to, Bayview, Rockport, Palmont City, Seacrest County, Fairhaven City, Redview County, Ventura Bay, and Fortune Valley.\r\n</p>','Need for Speed (NFS) is a racing video game franchise published by Electronic Arts and currently developed by Ghost Games. The series centers around illicit street racing and in general tasks players to complete various types of races while evading the local law enforcement in police pursuits. The series released its first title, The Need for Speed, in 1994. The most recent game, Need for Speed Payback, was released in 2017.','2019-10-14',1,2,'resource/img/bg-img/28.jpg'),(2,'Call of Duty','<p>Call of Duty is a first-person shooter video game franchise published by Activision. Starting out in 2003, it first focused on games set in World War II, but over time, the series has seen games set in modern times, the midst of the Cold War, futuristic worlds, and outer space. The games were first developed by Infinity Ward, then also by Treyarch and Sledgehammer Games. Several spin-off and handheld games were made by other developers. The most recent title, Call of Duty: Black Ops 4, was released on October 12, 2018. The next title, Call of Duty: Modern Warfare, will be released on October 25, 2019.\r\n<p>\r\n<p><img src=\"resource/img/bg-img/29.jpg\" alt=\"\"></p>\r\n</p>\r\nThe series originally focused on the World War II setting, with Infinity Ward developing the first (2003) and second (2005) titles in the series and Treyarch developing the third (2006). Call of Duty 4: Modern Warfare (2007) introduced a new, modern setting, and proved to be the breakthrough title for the series, creating the Modern Warfare sub-series. The game\'s legacy also influenced the creation of a remastered version, released in 2016. Two other entries, Modern Warfare 2 (2009) and 3 (2011), were made. The sub-series received a soft-reboot with Modern Warfare in 2019. Infinity Ward have also developed two games outside of the Modern Warfare sub-series, Ghosts (2013) and Infinite Warfare (2016). Treyarch made one last World War II-based game, World at War (2008), before releasing Black Ops (2010) and subsequently creating the Black Ops sub-series. Three other entries, Black Ops II (2012), III (2015), and 4 (2018), were made. Sledgehammer Games, who were co-developers for Modern Warfare 3, have also developed two titles, Advanced Warfare (2014) and WWII (2017).\r\n<p></p>\r\nAs of February 2016, the series has sold over 250 million copies.[1] Sales of all Call of Duty games topped US$15 billion.[1] Other products in the franchise include a line of action figures designed by Plan-B Toys, a card game created by Upper Deck Company, Mega Bloks sets by Mega Brands, and a comic book mini-series published by WildStorm Productions.\r\n<p>\r\n','Call of Duty is a first-person shooter video game franchise published by Activision. Starting out in 2003, it first focused on games set in World War II, but over time, the series has seen games set in modern times, the midst of the Cold War, futuristic worlds, and outer space. The games were first developed by Infinity Ward, then also by Treyarch and Sledgehammer Games. Several spin-off and handheld games were made by other developers. The most recent title, Call of Duty: Black Ops 4, was released on October 12, 2018. The next title, Call of Duty: Modern Warfare, will be released on October 25, 2019.','2019-10-15',1,3,'resource/img/bg-img/29.jpg');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-15 11:02:06
