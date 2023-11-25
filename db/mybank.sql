-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2018 at 06:24 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
/*!40101 SET NAMES utf8mb4 */

--
-- Database: `mybank`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branchId` int(11) NOT NULL,
  `branchNo` varchar(111) NOT NULL,
  `branchName` varchar(111) NOT NULL,
  `branch_Location` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchId`, `branchNo`, `branchName`,`branch_Location`) VALUES
(1, '100101', 'Dera Ghazi Khan','tumkur'),
(2, '100102', 'Multan','gulbarga');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int(11) NOT NULL,
  `message` text NOT NULL,
  `userId` int NOT NULL,
  `ratings` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackId`, `message`, `userId`,`ratings`, `date`) VALUES
(1, 'This is testing message to admin or manager by fk',1,5, '2023-12-15 04:30:48'),
(3, 'This is testing message to admin or manager by fk', 2,1,'2023-12-15 04:30:48'),
(4, 'this is help card for admin', 1,3, '2023-12-17 06:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL,
  `type` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `type`, `date`) VALUES
(1, 'cashier@cashier.com', 'cashier', 'cashier', '2023-12-15 04:36:27'),
(2, 'manager@manager.com', 'manager', 'manager', '2023-12-15 04:36:27'),
(3, 'sadfas@gmail.com', 'sdfas', 'type', '2023-12-16 07:13:12'),
(4, 'fkgeo@gmail.com', 'asdfsa', 'type', '2023-12-16 07:13:18'),
(6, 'cashier2@cashier.com', 'cashier2', 'cashier', '2023-12-16 07:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `userId` varchar(111) NOT NULL,
  `notice` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `userId`, `notice`, `date`) VALUES
(1, '1', 'Dear Customer! <br> OUr privacy policy is changed for account information get new prospectus from your nearest branch', '2023-12-14 13:11:46'),
(6, '2', 'Dear Ali,<br>\r\nOur privacy policy has been changed please visit nearest <kbd> MCB </kbd> branch for new prospectus.', '2023-12-16 06:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `otheraccounts`
--

CREATE TABLE `otheraccounts` (
  `id` int(11) NOT NULL,
  `accountNo` varchar(111) NOT NULL,
  `bankName` varchar(111) NOT NULL,
  `holderName` varchar(111) NOT NULL,
  `balance` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otheraccounts`
--

INSERT INTO `otheraccounts` (`id`, `accountNo`, `bankName`, `holderName`, `balance`, `date`) VALUES
(1, '12001122', 'UBL', 'Yaqoob Quraishi', '40800', '2023-12-14 11:55:07'),
(2, '12001123', 'HBL', 'Yousaf Khan', '71000', '2023-12-14 11:55:07'),
(3, '12001124', 'HBL', 'Yousaf Khan', '71000', '2023-12-14 11:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionId` int(11) NOT NULL,
  `action` varchar(111) NOT NULL,
  `credit` varchar(111) DEFAULT 0,
  `debit` varchar(111) DEFAULT 0,
  `balance` varchar(111) NOT NULL,
  `receiverAccountNo` varchar(111) NOT NULL,
  `senderAccountNo` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionId`, `action`, `credit`, `debit`, `balance`,  `other`, `userId`, `date`) VALUES
(4, 'transfer', '', '200', '',  '12001122', 1, '2023-12-14 12:33:40'),
(5, 'transfer', '', '200', '',  '10054777', 1, '2023-12-14 12:56:48'),
(6, 'transfer', '', '333', '',  '10054777', 1, '2023-12-14 12:57:20'),
(7, 'transfer', '', '222', '',  '10054777', 1, '2023-12-14 12:58:19'),
(8, 'transfer', '', '333', '',  '10054777', 1, '2023-12-14 13:00:23'),
(16, 'withdraw', '', '100', '',  '23423', 1, '2023-12-15 08:31:59'),
(17, 'deposit', '1200', '', '', '234232', 1, '2023-12-15 08:32:17'),
(18, 'transfer', '', '467', '',  '12001122', 1, '2023-12-17 06:44:48'),
(22, 'deposit', '1200', '', '',  '32424', 2, '2023-12-17 06:56:29'),
(23, 'withdraw', '', '12', '',  '23423', 2, '2023-12-17 06:59:02'),
(24, 'deposit', '12', '', '', '21321', 2, '2023-12-17 06:59:20'),
(25, 'transfer', '', '1200', '',  '10054777', 1, '2023-12-17 07:01:37'),
(26, 'deposit', '600', '', '',  '342342', 2, '2023-12-17 07:04:39'),
(27, 'withdraw', '', '1012', '',  '23423', 2, '2023-12-17 07:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` varchar(111) NOT NULL,
  `balance` varchar(111) NOT NULL,
  `cnic` varchar(111) NOT NULL,
  `number` varchar(111) NOT NULL,
  `city` varchar(111) NOT NULL,
  `address` varchar(111) NOT NULL,
  `source` varchar(111) NOT NULL,
  `accountNo` varchar(111) NOT NULL,
  `branch` varchar(111) NOT NULL,
  `accountType` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`id`, `email`, `password`, `name`, `balance`, `cnic`, `number`, `city`, `address`, `source`, `accountNo`, `branch`, `accountType`, `date`) VALUES
(1, 'some@gmail.com', 'some', 'Fayyaz Khan', '9800', '3210375555426', '03356910260', 'Islamabad', 'Some where in isb', 'Programmer', '1005469', '1', 'Current', '2023-12-14 05:50:06'),
(2, 'some2@gmail.com', 'some2', 'Ali khan', '16000', '3210375555343', '03356910260', 'Islamabad', 'Some where in isb', 'Programmer', '10054777', '1', 'Saving', '2023-12-14 04:50:06'),
(6, 'realx4rd@gmail.com', 'afsdfasd', 'Fayyaz Khan', '234234', '3240338834902', '03356910260', 'Taunsa', 'Dera Ghazi Khan', 'Govt. job', '1513410739', '1', 'saving', '2023-12-16 07:52:40'),
(7, 'realx4rd@gmail.com', 'safsadf', 'Fayyaz Khan', '12121', '3240338834902', '03356910260', 'Taunsa', 'Dera Ghazi Khan', 'Govt. job', '1513410837', '1', 'current', '2023-12-16 07:54:18');

-- loan application table
CREATE TABLE `loan_applications` (
  `id` INT (11) NOT NULL AUTO_INCREMENT,
  `userId` INT (11) NOT NULL,
  `amount` DECIMAL (10, 2) NOT NULL,
  `reason` TEXT NOT NULL,
  `occupation` VARCHAR (255) NOT NULL,
  `status` ENUM ('Pending', 'Approved', 'Rejected') NOT NULL DEFAULT 'Pending',
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`userId`) REFERENCES `useraccounts` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `loanAproved` (
  `id` INT (11) NOT NULL,
  `userId` INT (11) NOT NULL,
  `amount` DECIMAL (10, 2) NOT NULL,
  `reason` TEXT NOT NULL,
  `occupation` VARCHAR (255) NOT NULL,
  `status` ENUM ('Pending', 'Approved', 'Rejected') NOT NULL DEFAULT 'Pending',
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`userId`) REFERENCES `useraccounts` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `loanRejection` (
  `id` INT (11) NOT NULL,
  `userId` INT (11) NOT NULL,
  `amount` DECIMAL (10, 2) NOT NULL,
  `reason` TEXT NOT NULL,
  `rejectionReason` TEXT NOT NULL,
  `occupation` VARCHAR (255) NOT NULL,
  `status` ENUM ('Pending', 'Approved', 'Rejected') NOT NULL DEFAULT 'Pending',
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`userId`) REFERENCES `useraccounts` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otheraccounts`
--
ALTER TABLE `otheraccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionId`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `otheraccounts`
--
ALTER TABLE `otheraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
 

create view transaction_limit as (Select transactionId, debit as transaction_value, userId 
from transaction); 
select * from transaction_limit; 
DELIMITER $$ 
CREATE FUNCTION validate_transaction_limit(transactionId int(11)) 
RETURNS varchar(50) 
DETERMINISTIC 
BEGIN
declare Debitval varchar(111); 
DECLARE VALUE varchar(50); 
select transaction_value into Debitval from transaction_limit where
transaction_limit.transactionId = transactionId; 
IF Debitval > 1000 THEN
SET VALUE = "Not advisable transaction as the amount is above 1000"; 
ELSE
SET VALUE = "Can proceed with the transaction"; 
END IF; 
RETURN VALUE; 
END; 
DELIMITER $$ 



DELIMITER $$ 
CREATE DEFINER=`root`@`localhost` PROCEDURE `Addfeedback`(IN `feedbackId` INT(11), IN
`message` text, IN `userId` int,IN `ratings` int,IN `date` timestamp) 
INSERT INTO
feedback(`feedbackId`,`message`,`userId`,`ratings`,`date`)VALUES(feedbackId,message,userId,date)$$ 
DELIMITER ; 

DELIMITER $$ 
CREATE TRIGGER check_first_deposit 
AFTER INSERT
ON useraccounts FOR EACH ROW
BEGIN
DECLARE user int; 
DECLARE bal int; 
DECLARE error_msg varchar(225); 
SET error_msg = "Insufficient minimum balance"; 
SET user = NEW.id; 
SET bal = (SELECT balance FROM useraccounts WHERE id = user); 
IF bal < 10000 THEN
 SIGNAL SQLSTATE '50001'
 SET MESSAGE_TEXT = error_msg; 
 END IF; 
END $$ 

CREATE TABLE feedback_backup(feedbackId integer, message text, userId int, date timestamp) 
DELIMITER $$ 
CREATE PROCEDURE CUR_PROC()
BEGIN
DECLARE done INT DEFAULT 0; 
DECLARE feedbackId INTEGER; 
DECLARE message text; 
DECLARE userId int; 
DECLARE date timestamp; 
DECLARE cur CURSOR FOR SELECT * FROM feedback; 
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1; 
DELETE from feedback_backup; 
OPEN cur; 
label: LOOP
FETCH cur INTO feedbackId, message, userId, date; 
INSERT INTO feedback_backup VALUES(feedbackId, message, userId, date); 
IF done = 1 THEN LEAVE label; 
END IF; 
END LOOP; 
CLOSE cur; 
END$$ 

-- Join queries

-- Retrieve the account number, CNIC, Transaction ID and transaction action of all the 
-- transactions made by customer with ID = 2. 
SELECT useraccounts.accountNo, useraccounts.cnic, transaction.action, transaction.transactionId
 FROM useraccounts INNER JOIN transaction ON useraccounts.id=transaction.userId WHERE useraccounts.id=2;

-- Retrieve the account number, CNIC, Transaction ID and transaction action of all the 
-- transactions made by customer with ID = 2. 
SELECT useraccounts.accountNo, useraccounts.name, branch.branchName, branch.branchNo
FROM branch
RIGHT OUTER JOIN useraccounts ON useraccounts.branch = branch.branchId
WHERE branch.branchId = 2;


-- Retrieve the account number, account holder name, balance in the account and branch name of the account 
-- holders whose account balance is more than 15000.
SELECT useraccounts.accountNo, useraccounts.name, useraccounts.balance, branch.branchName
FROM useraccounts
LEFT OUTER JOIN branch ON branch.branchId = useraccounts.branch
WHERE useraccounts.balance > 15000;






