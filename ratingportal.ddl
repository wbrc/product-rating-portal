CREATE DATABASE `ratingportal` /*!40100 DEFAULT CHARACTER SET utf8 */	


CREATE TABLE `Users` (
 `Username` varchar(50) NOT NULL,
 `Password` varchar(100) NOT NULL,
 PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE `Product` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `Name` varchar(50) NOT NULL,
 `Manufacturer` varchar(50) NOT NULL,
 `created_by` varchar(50) NOT NULL,
 PRIMARY KEY (`ID`),
 KEY `created_by` (`created_by`),
 CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `Users` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8

CREATE TABLE `Rating` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `created_by` varchar(50) NOT NULL,
 `created_for` int(11) NOT NULL,
 `Score` int(11) NOT NULL,
 `Comment` varchar(500) DEFAULT NULL,
 PRIMARY KEY (`ID`),
 KEY `rating_created_by` (`created_by`),
 KEY `rating_created_for` (`created_for`),
 CONSTRAINT `Rating_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `Users` (`Username`),
 CONSTRAINT `Rating_ibfk_2` FOREIGN KEY (`created_for`) REFERENCES `Product` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8