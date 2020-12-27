-- phpMyAdmin SQL
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2020 at 7:15 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebook_store`
--

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `books` (
  `ISBN` INT NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Year` INT NOT NULL,
  `Price` decimal(6,2) NOT NULL,
  `Publisher` varchar(50) NOT NULL,
  `stock_status` enum('OUT_OF_STOCK', 'IN_STOCK') NOT NULL DEFAULT 'OUT_OF_STOCK',
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `ebook` (
	`eISBN` INT NOT NULL,
  `DownloadLink` TEXT,
	`AccessLink` TEXT,
    INDEX `eISBN_idx` (`eISBN` ASC) VISIBLE,
    CONSTRAINT `eISBN`
		FOREIGN KEY(`eISBN`)
        REFERENCES `books`(`ISBN`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT bundled_link PRIMARY KEY (`DownloadLink`, `AccessLink`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `category` (
	`catebookid` INT NOT NULL,
    `category_name` varchar(50) NOT NULL,
    INDEX `catebookid_idx` (`catebookid` ASC) VISIBLE,
    CONSTRAINT `catebookid`
		FOREIGN KEY(`catebookid`)
        REFERENCES `books`(`ISBN`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `keyword` (
	`keybookid` INT NOT NULL,
    `keywords` varchar(50) NOT NULL,
    INDEX `keybookid_idx` (`keybookid` ASC) VISIBLE,
    CONSTRAINT `keybookid`
		FOREIGN KEY(`keybookid`)
        REFERENCES `books`(`ISBN`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` INT NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `author_email` TEXT DEFAULT NULL,
  `author_phoneno` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `written` (
	`wauthorid` INT NOT NULL,
    `wbookid` INT NOT NULL,
    INDEX `bookid_idx` (`wbookid` ASC) VISIBLE,
    INDEX `authorid_idx` (`wauthorid` ASC) VISIBLE,
    CONSTRAINT `wbookid`
		FOREIGN KEY(`wbookid`)
        REFERENCES `books`(`ISBN`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
	CONSTRAINT `wauthorid`
		FOREIGN KEY(`wauthorid`)
        REFERENCES `authors`(`author_id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phoneno` varchar(50) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` char(2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `customer_id` INT NOT NULL,
  `pmethod` enum('Credit card', 'Bank deposit', 'Pay at arrival') NOT NULL DEFAULT 'Pay at arrival',
  `issue_date` date NOT NULL,
  `status` enum('Pending','Completed','Cancelled','Failed') NOT NULL DEFAULT 'Pending',
  `total_cost` INT NOT NULL,
  PRIMARY KEY (`order_id`),
  INDEX `customer_id_idx` (`customer_id` ASC) VISIBLE,
  CONSTRAINT `customer_id`
	FOREIGN KEY(`customer_id`)
	REFERENCES `customer`(`customer_id`)
	ON DELETE CASCADE
	ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `buy_order` (
	`oid` INT NOT NULL,
    `buyid` INT NOT NULL,
    `quantity` INT NOT NULL,
    INDEX `oid_idx` (`oid` ASC) VISIBLE,
    INDEX `buyid_idx` (`buyid` ASC) VISIBLE,
    CONSTRAINT `oid`
		FOREIGN KEY(`oid`)
        REFERENCES `orders`(`order_id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
	  CONSTRAINT `buyid`
		FOREIGN KEY(`buyid`)
        REFERENCES `books`(`ISBN`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `rent_order` (
	`roid` INT NOT NULL,
    `rentid` INT NOT NULL,
    `return_date` date NOT NULL,
    INDEX `roid_idx` (`roid` ASC) VISIBLE,
    INDEX `rentid_idx` (`rentid` ASC) VISIBLE,
    CONSTRAINT `roid`
		FOREIGN KEY(`roid`)
        REFERENCES `orders`(`order_id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
	  CONSTRAINT `rentid`
		FOREIGN KEY(`rentid`)
        REFERENCES `books`(`ISBN`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
    
CREATE TABLE IF NOT EXISTS `credit_card` (
	`card_id` INT NOT NULL,
    `exp_date` date NOT NULL,
    `bank_name` varchar(50) NOT NULL,
    `bank_branch` varchar(50) NOT NULL,
    `owner_id` INT NOT NULL,
    PRIMARY KEY (`card_id`),
    INDEX `owner_id_idx` (`owner_id` ASC) VISIBLE,
    CONSTRAINT `owner_id`
		FOREIGN KEY(`owner_id`)
		REFERENCES `customer`(`customer_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `warehouse` (
	`warehouse_id` INT NOT NULL AUTO_INCREMENT,
    `warehouse_phone` varchar(50) NOT NULL,
    `warehouse_address` varchar(50) NOT NULL,
	`warehouse_city` varchar(50) NOT NULL,
    `warehouse_state` varchar(50) NOT NULL, 
    PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;    

CREATE TABLE IF NOT EXISTS `stock_request` (
	`request_id` INT NOT NULL AUTO_INCREMENT,
    `publisher` varchar(50) NOT NULL,
    `request_date` date NOT NULL,
    `to_warehouse` INT NOT NULL,
    INDEX `request_id_idx` (`request_id` ASC) VISIBLE,
    PRIMARY KEY (`request_id`),
		CONSTRAINT `to_warehouse`
		FOREIGN KEY(`to_warehouse`)
		REFERENCES `warehouse`(`warehouse_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `restock` (
	`rid` INT NOT NULL,
  `rbookid` INT NOT NULL,
	`stock_num` INT NOT NULL,
    INDEX `rid_idx` (`rid` ASC) VISIBLE,
    INDEX `rbookid_idx` (`rbookid` ASC) VISIBLE,
  CONSTRAINT `rid`
		FOREIGN KEY(`rid`)
		REFERENCES `stock_request`(`request_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT `rbookid`
		FOREIGN KEY(`rbookid`)
		REFERENCES `books`(`ISBN`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `in_stock` (
	`storeid` INT NOT NULL,
	`stockid` INT NOT NULL,
  `numstock` INT NOT NULL,
  CONSTRAINT `storeid`
		FOREIGN KEY(`storeid`)
		REFERENCES `warehouse`(`warehouse_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT `stockid`
		FOREIGN KEY(`stockid`)
		REFERENCES `books`(`ISBN`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
  CONSTRAINT storage PRIMARY KEY (`storeid`,`stockid`)  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Insert section

INSERT INTO `authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('1', 'Dan', 'Brown', 'danb@gmail.com');
INSERT INTO `authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('2', 'Aoyama', 'Nanae', 'aone@gmail.com');
INSERT INTO `authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('3', 'Paolo', 'Coelho', 'paolocoelho@gmail.com');
INSERT INTO `authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('4', 'Yvonne', 'Vera', 'yvera@gmail.com');
INSERT INTO `authors` (`author_id`, `fname`, `lname`, `author_email`) VALUES ('5', 'Roger', 'Abrahams', 'rogerabra@gmail.com');

INSERT INTO `books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('1', 'The Alchemist', '2018', '25', 'Harper Collins', 'out of stock');
INSERT INTO `books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('2', 'A perfect day to be alone', '2010', '10', 'Kawade Shobo', 'in-stock');
INSERT INTO `books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('3', 'Da Vinci Code', '2003', '30', 'Doubleday Fiction', 'in-stock');
INSERT INTO `books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('4', 'Opening Spaces', '2010', '15', 'Pearson', 'in-stock');
INSERT INTO `books` (`ISBN`, `Title`, `Year`, `Price`, `Publisher`, `stock_status`) VALUES ('5', 'African Folktales', '2010', '20', 'Pantheon', 'out of stock');

INSERT INTO `written`(`wauthorid`,`wbookid`) VALUES (1,3);
INSERT INTO `written`(`wauthorid`,`wbookid`) VALUES (2,2);
INSERT INTO `written`(`wauthorid`,`wbookid`) VALUES (3,1);
INSERT INTO `written`(`wauthorid`,`wbookid`) VALUES (4,4);
INSERT INTO `written`(`wauthorid`,`wbookid`) VALUES (5,5);

INSERT INTO `category`(`catebookid`,`category_name`) VALUES (1, 'Philosphy');
INSERT INTO `category`(`catebookid`,`category_name`) VALUES (2, 'Novel');
INSERT INTO `category`(`catebookid`,`category_name`) VALUES (3, 'Novel');
INSERT INTO `category`(`catebookid`,`category_name`) VALUES (4, 'Scientific');
INSERT INTO `category`(`catebookid`,`category_name`) VALUES (5, 'folktales');
INSERT INTO `category`(`catebookid`,`category_name`) VALUES (1, 'Novel');

INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (1, 'Paolo');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (1, 'Best selling');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (1, 'Bible');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (2, 'Cat');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (2, 'Japanese');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (2, 'Adult');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (3, 'Drama');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (3, 'Dan Brown');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (3, 'Best selling');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (4, 'universe');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (4, 'spaces');
INSERT INTO `keyword`(`keybookid`,`keywords`) VALUES (5, 'folklore');

INSERT INTO `customer` VALUES ('1', 'A', 'BC', '0234912378', 'House1', 'City1', 'VN');
INSERT INTO `customer` VALUES ('2', 'B', 'CD', '0123812378', 'House2', 'City2', 'EN');
INSERT INTO `customer` VALUES ('3', 'C', 'DE', '0324897324', 'House3', 'City3', 'VN');
INSERT INTO `customer` VALUES ('4', 'D', 'XY', '021389723', 'House4', 'City2', 'VN');
INSERT INTO `customer` VALUES ('5', 'E', 'YZ', '012381382', 'House5', 'City3', 'EN');

INSERT INTO `credit_card` VALUES ('1', '13/12/27', 'BankA', 'Branch1', '1');
INSERT INTO `credit_card` VALUES ('2', '1/7/19', 'BankB', 'Branch1', '2');
INSERT INTO `credit_card` VALUES ('3', '4/4/20', 'BankA', 'Branch2', '2');
INSERT INTO `credit_card` VALUES ('5', '7/7/21', 'BankC', 'Branch1', '3');
INSERT INTO `credit_card` VALUES ('6', '2/3/19', 'BankE', 'Branch6', '4');


INSERT INTO `warehouse` VALUES ('1', '0923973929', 'PlaceA', 'City2', 'CN');
INSERT INTO `warehouse` VALUES ('2', '0218373129', 'PlaceB', 'City3', 'VN');
INSERT INTO `warehouse` VALUES ('3', '0328921387', 'PlaceC', 'City2', 'EN');
INSERT INTO `warehouse` VALUES ('4', '0139217378', 'PlaceD', 'City1', 'EN');
INSERT INTO `warehouse` VALUES ('5', '0101010101', 'PlaceE', 'City1', 'EN');

INSERT INTO `stock_request` (`request_id`, `publisher`, `request_date`, `to_warehouse`) VALUES (1, 'Harper Collins', '1/1/20', 3);
INSERT INTO `stock_request` (`request_id`, `publisher`, `request_date`, `to_warehouse`) VALUES (2, 'Pantheon', '4/4/20', 5);

INSERT INTO `restock` (`rid`, `rbookid`, `stock_num`) VALUES (1, 1, 100);
INSERT INTO `restock` (`rid`, `rbookid`, `stock_num`) VALUES (2, 5, 100);

INSERT INTO `in_stock` (`storeid`, `stockid`, `numstock`) VALUES (1, 2, 300);
INSERT INTO `in_stock` (`storeid`, `stockid`, `numstock`) VALUES (1, 3, 10);
INSERT INTO `in_stock` (`storeid`, `stockid`, `numstock`) VALUES (2, 4, 50);
INSERT INTO `in_stock` (`storeid`, `stockid`, `numstock`) VALUES (4, 4, 200);

INSERT INTO `orders` (`order_id`, `customer_id`, `pmethod`, `issue_date`, `status`, `total_cost`) VALUES ('1', '1', 'Credit Card', '1/1/20', 'Finished', '100');
INSERT INTO `orders` (`order_id`, `customer_id`, `pmethod`, `issue_date`, `status`, `total_cost`) VALUES ('2', '4', 'Cash', '2/2/20', 'Finished', '30');
INSERT INTO `orders` (`order_id`, `customer_id`, `pmethod`, `issue_date`, `status`, `total_cost`) VALUES ('3', '1', 'Credit Card', '3/2/20', 'Finished ', '30');
INSERT INTO `orders` (`order_id`, `customer_id`, `pmethod`, `issue_date`, `status`, `total_cost`) VALUES ('4', '5', 'Bank Deposit', '7/7/20', 'Shipping', '70');

INSERT INTO `buy_order` VALUES ('1', '1', '4');
INSERT INTO `buy_order` VALUES ('2', '3', '1');

INSERT INTO `rent_order` VALUES ('3', '3', '10/10/20');
INSERT INTO `rent_order` VALUES ('4', '2', '11/11/20');
INSERT INTO `rent_order` VALUES ('4', '1', '11/11/20');
INSERT INTO `rent_order` VALUES ('4', '3', '11/11/20');

