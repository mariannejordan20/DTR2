/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.27-MariaDB : Database - employee_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`employee_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `employee_db`;

/*Table structure for table `admin_accounts` */

DROP TABLE IF EXISTS `admin_accounts`;

CREATE TABLE `admin_accounts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `admin_accounts` */

insert  into `admin_accounts`(`ID`,`username`,`password`,`fullname`,`user_type`,`role`) values (3,'admin','admin','ADMIN','admin',NULL),(8,'cristobal','cristobal123','CRISTOBAL PARAON','admin',NULL),(9,'sirb','sirbaluca123','CHRISTOPHER BALUCA','admin',NULL);

/*Table structure for table `allowed_ips` */

DROP TABLE IF EXISTS `allowed_ips`;

CREATE TABLE `allowed_ips` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) DEFAULT NULL,
  `branch_loc` varchar(100) DEFAULT NULL,
  KEY `id` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `allowed_ips` */

insert  into `allowed_ips`(`ID`,`ip_address`,`branch_loc`) values (2,'192.168.1.202','sto nino'),(3,'192.168.1.203','sto nino'),(4,'192.168.1.204','sto nino'),(5,'192.168.1.205','sto nino'),(13,'192.168.1.201','nars');

/*Table structure for table `branches` */

DROP TABLE IF EXISTS `branches`;

CREATE TABLE `branches` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Branch` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `branches` */

insert  into `branches`(`ID`,`Branch`) values (7,'Mandaue'),(8,'Sto. Niño'),(9,'Ibabao-Estancia'),(11,'Lapu-Lapu'),(12,'Danao');

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `departments` */

insert  into `departments`(`ID`,`Department`) values (1,'Technical'),(2,'Programming'),(4,'Sales'),(7,'Front Desk');

/*Table structure for table `employee_information` */

DROP TABLE IF EXISTS `employee_information`;

CREATE TABLE `employee_information` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Employee_ID` varchar(100) NOT NULL,
  `Employee_FullName` varchar(100) NOT NULL,
  `Employee_Department` varchar(100) NOT NULL,
  `Employee_Position` varchar(100) NOT NULL,
  `Employee_Sex` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `Employee_Branch` varchar(100) NOT NULL,
  `Employee_Status` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `employee_information` */

insert  into `employee_information`(`ID`,`Employee_ID`,`Employee_FullName`,`Employee_Department`,`Employee_Position`,`Employee_Sex`,`user_type`,`Employee_Branch`,`Employee_Status`) values (13,'20104331','CRISTOBAL L. PARAON','Programming','Intern','Male','employee','Mandaue','1'),(15,'20104392','MARIANNE O. JORDAN','Programming','Intern','Female','employee','Ibabao-Estancia','1'),(16,'20105071','ABELITO M. LIM','Programming','Intern','Male','employee','Mandaue','1'),(19,'20105022','JESSICA P. NAVA','Front Desk','Intern','Female','employee','Sto. Niño','2'),(20,'20105031','JEROME D. MAGNA','Technical','Intern','Male','employee','Mandaue','1'),(21,'20114952','LYCA B. PALANA','Sales','Intern','Female','employee','Mandaue','1'),(22,'20104592','LESEL M. MACO','Sales','Intern','Female','employee','Mandaue','1'),(23,'20104401','JOHN BABEL C. BISNAR','Front Desk','Intern','Male','employee','Mandaue','1'),(24,'20104532','JASMINE J. LAGUMBAY','Front Desk','Intern','Female','employee','Mandaue','1'),(25,'15121732','JUSALINE A. EWAY','Front Desk','Intern','Female','employee','Mandaue','1'),(26,'20117432','CARMEL MALDO','Front Desk','Intern','Female','employee','Mandaue','1'),(27,'20105121','ANGELO MERCADO','Sales','Intern','Female','employee','Mandaue','1'),(28,'20105231','EMERSON CASCAS','Sales','Intern','Male','employee','Mandaue','1'),(29,'20104291','CRIS JOHN GULTIANO ','Technical','Intern','Male','employee','Mandaue','1'),(31,'20104271','JUNDELLE D. SILLO ','Technical','Intern','Male','employee','Mandaue','1'),(32,'18105541','JASON JUMAMOYA','Front Desk','Intern','Male','employee','Mandaue','1'),(33,'20103882','JENNY ROSE SALIZON ','Front Desk','Intern','Female','employee','Ibabao','1'),(34,'20104221','RYAN LASTRA','Front Desk','Intern','Male','employee','Ibabao','1'),(35,'20104622','MAIREEN NICOLE MACALAM','Front Desk','Intern','Female','employee','Sto. Niño','1'),(36,'20117732','MICHAELA JOY TARAZONA ','Sales','Intern','Female','employee','Ibabao','1'),(37,'20104282','VANESSA V. LARITA ','Front Desk','Intern','Female','employee','Ibabao-Estancia','1'),(38,'20104511','JADD ZACHARY M. ERRUA','Sales','Intern','Male','employee','Mandaue','1'),(39,'19109592','ETHEL E. ZOBEL ','Front Desk','Intern','Female','employee','Sto. Niño','1'),(40,'20104261','JERICHO GLENN A. ODARBE','Technical','Intern','Male','employee','Mandaue','1'),(42,'20104521','RICHARD P. BITO ','Sales','Intern','Male','employee','Mandaue','1'),(43,'20108341','CHRISTIAN VOCAL','Front Desk','Intern','Male','employee','Mandaue','1'),(97,'20105512','TIFFANY R. RIO','Front Desk','Intern','Female','employee','Sto. Niño','1'),(98,'20104551','JOHN MARK ABENOJA','Technical','Intern','Male','employee','Mandaue','1'),(99,'20200431','NARCISO ANGELO R. TEOFILO','Programming','Intern','Male','employee','Mandaue','1');

/*Table structure for table `employee_log` */

DROP TABLE IF EXISTS `employee_log`;

CREATE TABLE `employee_log` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Employee_ID` varchar(100) NOT NULL,
  `Employee_Date` varchar(100) NOT NULL,
  `Employee_Time` time DEFAULT NULL,
  `Employee_Status` time DEFAULT NULL,
  `Employee_TimeInAM` time DEFAULT NULL,
  `Employee_TimeOutAM` time DEFAULT NULL,
  `Employee_TimeInPM` time DEFAULT NULL,
  `Employee_TimeOutPM` time DEFAULT NULL,
  `Ip_Address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `employee_log` */

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Employee_ID` varchar(250) DEFAULT NULL,
  `DateLog` date DEFAULT NULL,
  `TimeLog1` time DEFAULT NULL,
  `TimeLog2` time DEFAULT NULL,
  `TimeLog3` time DEFAULT NULL,
  `TimeLog4` time DEFAULT NULL,
  `IpAddress` varchar(50) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `logs` */

insert  into `logs`(`id`,`Employee_ID`,`DateLog`,`TimeLog1`,`TimeLog2`,`TimeLog3`,`TimeLog4`,`IpAddress`) values (1,'20104331','2024-04-12','10:50:42','13:50:42','13:50:45','13:50:46','192.168.1.204'),(3,'20104331','2024-04-15','11:55:11','11:56:29','11:56:30','11:56:32','192.168.1.204'),(4,'20114952','2024-04-15','16:09:36',NULL,NULL,NULL,'192.168.1.111'),(5,'20105121','2024-04-15','16:15:16','16:15:21','16:15:23','16:16:04','192.168.1.111'),(6,'20104331','2024-04-16','13:40:22','13:43:50',NULL,NULL,'192.168.1.204'),(7,'20200431','2024-04-16','13:40:42','13:44:24','13:44:29','13:44:35','192.168.1.204'),(8,'20105071','2024-04-16','13:40:52','14:13:27','14:13:35','14:13:40','192.168.1.204'),(9,'20105022','2024-04-17','22:08:05','22:08:21',NULL,NULL,'::1'),(10,'20104331','2024-04-17','22:10:40',NULL,NULL,NULL,'::1'),(11,'20200431','2024-04-18','09:42:17',NULL,NULL,NULL,'::1'),(12,'20105121','2024-04-18','09:50:33',NULL,NULL,NULL,'192.168.1.187');

/*Table structure for table `userss` */

DROP TABLE IF EXISTS `userss`;

CREATE TABLE `userss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(50) NOT NULL,
  `Role` varchar(50) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `userss` */

insert  into `userss`(`id`,`UserName`,`Password`,`Role`) values (1,'admin','admin','Admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
