-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: lhm_system
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_actions`
--

DROP TABLE IF EXISTS `admin_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_actions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int DEFAULT NULL,
  `action_description` text NOT NULL,
  `action_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `admin_actions_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_actions`
--

LOCK TABLES `admin_actions` WRITE;
/*!40000 ALTER TABLE `admin_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('primary','secondary','viewonly') NOT NULL DEFAULT 'viewonly',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','admin@gmail.com','admin123','primary','2024-11-05 02:36:24');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `batches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch_year` varchar(50) NOT NULL,
  `department_id` int DEFAULT NULL,
  `semester_id` int NOT NULL,
  `batch_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `semester_id` (`semester_id`),
  CONSTRAINT `batches_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `batches_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
INSERT INTO `batches` VALUES (1,'2022',1,3,'2022 HNDIT Batch'),(2,'2022',2,3,'2022 HNDA Batch'),(3,'2022',3,3,'2022 HNDE Batch'),(4,'2022',4,3,'2022 HNDPM Batch'),(5,'2324',1,1,'2324 HNDIT Batch'),(6,'2324',2,1,'2324  HNDA Batch'),(7,'2324',3,1,'2324 HNDE Batch'),(8,'2324',4,1,'2324 HNDPM Batch');
/*!40000 ALTER TABLE `batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dept_code` varchar(50) DEFAULT NULL,
  `department_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'HNDIT','Higher National Diploma in Information Technology'),(2,'HNDA','Higher National Diploma in Accountancy'),(3,'HNDE','Higher National Diploma in English'),(4,'HNDPM','Higher National Diploma in Project Management');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecture_book`
--

DROP TABLE IF EXISTS `lecture_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecture_book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lecturer_id` int DEFAULT NULL,
  `hall_id` int DEFAULT NULL,
  `department_id` int NOT NULL,
  `batch_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `slot_id` int DEFAULT NULL,
  `days` enum('Monday','Tuesday','Wednesday','Thursday','Friday') DEFAULT NULL,
  `request_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('available','booked') DEFAULT 'available',
  PRIMARY KEY (`id`),
  KEY `lecturer_id` (`lecturer_id`),
  KEY `hall_id` (`hall_id`),
  KEY `department_id` (`department_id`),
  KEY `batch_id` (`batch_id`),
  KEY `slot_id` (`slot_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `lecture_book_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_book_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `lecture_halls` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_book_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_book_ibfk_4` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_book_ibfk_5` FOREIGN KEY (`slot_id`) REFERENCES `timeslot` (`slot_id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_book_ibfk_6` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecture_book`
--

LOCK TABLES `lecture_book` WRITE;
/*!40000 ALTER TABLE `lecture_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `lecture_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecture_halls`
--

DROP TABLE IF EXISTS `lecture_halls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecture_halls` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hall_name` varchar(100) NOT NULL,
  `capacity` int NOT NULL,
  `location` varchar(255) NOT NULL,
  `available` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecture_halls`
--

LOCK TABLES `lecture_halls` WRITE;
/*!40000 ALTER TABLE `lecture_halls` DISABLE KEYS */;
INSERT INTO `lecture_halls` VALUES (1,'B1',115,'Building B',1),(2,'B2',90,'Building B',1),(3,'B3',90,'Building B',1),(4,'B4',95,'Building B',1),(5,'B5',85,'Building B',1),(6,'B6',90,'Building B',1),(7,'B7',110,'Building B',1),(8,'Lab 03',120,'Building B',1);
/*!40000 ALTER TABLE `lecture_halls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecture_schedule`
--

DROP TABLE IF EXISTS `lecture_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecture_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lecturer_id` int DEFAULT NULL,
  `hall_id` int DEFAULT NULL,
  `department_id` int NOT NULL,
  `batch_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `slot_id` int DEFAULT NULL,
  `days` enum('Monday','Tuesday','Wednesday','Thursday','Friday') DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `status` enum('available','booked') DEFAULT 'available',
  PRIMARY KEY (`id`),
  KEY `lecturer_id` (`lecturer_id`),
  KEY `hall_id` (`hall_id`),
  KEY `department_id` (`department_id`),
  KEY `batch_id` (`batch_id`),
  KEY `slot_id` (`slot_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `lecture_schedule_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_schedule_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `lecture_halls` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_schedule_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_schedule_ibfk_4` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_schedule_ibfk_5` FOREIGN KEY (`slot_id`) REFERENCES `timeslot` (`slot_id`) ON DELETE CASCADE,
  CONSTRAINT `lecture_schedule_ibfk_6` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecture_schedule`
--

LOCK TABLES `lecture_schedule` WRITE;
/*!40000 ALTER TABLE `lecture_schedule` DISABLE KEYS */;
INSERT INTO `lecture_schedule` VALUES (1,21,6,1,1,17,1,'Monday',NULL,'available'),(2,21,6,1,1,15,2,'Monday',NULL,'available'),(3,21,6,1,1,15,3,'Monday',NULL,'available'),(4,21,6,1,1,15,4,'Monday',NULL,'available'),(5,8,8,1,1,16,6,'Monday',NULL,'available'),(6,8,8,1,1,16,7,'Monday',NULL,'available'),(7,8,8,1,1,16,1,'Tuesday',NULL,'available'),(8,8,8,1,1,16,2,'Tuesday',NULL,'available'),(9,8,8,1,1,16,3,'Tuesday',NULL,'available'),(10,8,8,1,1,16,4,'Tuesday',NULL,'available'),(11,8,6,1,1,15,6,'Tuesday',NULL,'available'),(12,8,6,1,1,15,7,'Tuesday',NULL,'available'),(13,8,6,1,1,15,8,'Tuesday',NULL,'available'),(14,1,8,1,1,18,1,'Wednesday',NULL,'available'),(15,1,8,1,1,18,2,'Wednesday',NULL,'available'),(16,1,6,1,1,18,3,'Wednesday',NULL,'available'),(17,1,6,1,1,18,4,'Wednesday',NULL,'available'),(18,9,6,1,1,20,6,'Wednesday',NULL,'available'),(19,9,6,1,1,20,7,'Wednesday',NULL,'available'),(20,9,6,1,1,20,8,'Wednesday',NULL,'available'),(21,23,6,1,1,21,1,'Thursday',NULL,'available'),(22,23,6,1,1,21,2,'Thursday',NULL,'available'),(23,23,6,1,1,21,3,'Thursday',NULL,'available'),(24,23,6,1,1,21,4,'Thursday',NULL,'available'),(25,21,6,1,1,19,1,'Friday',NULL,'available'),(26,21,6,1,1,19,2,'Friday',NULL,'available'),(27,21,6,1,1,19,3,'Friday',NULL,'available'),(28,21,6,1,1,19,4,'Friday',NULL,'available'),(29,8,6,1,1,15,6,'Friday',NULL,'available'),(30,8,6,1,1,15,7,'Friday',NULL,'available'),(31,8,6,1,1,15,8,'Friday',NULL,'available');
/*!40000 ALTER TABLE `lecture_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecturers`
--

DROP TABLE IF EXISTS `lecturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecturers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `index_number` varchar(45) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(10) DEFAULT NULL,
  `role` enum('Visiting','Permanent') DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecturers`
--

LOCK TABLES `lecturers` WRITE;
/*!40000 ALTER TABLE `lecturers` DISABLE KEYS */;
INSERT INTO `lecturers` VALUES (1,'2020','Ms.Y.M.R.D Wepathana','wepathana@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Visual Application Programming, ICT Project, Software Tools & Cloud Services','C1, kegalle','712345670','Permanent','none',NULL),(2,'2021','Ms.M.M.S.N Dasanayaka','dasanayaka@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Web Design, Information Management Information System','C2, kegalle','712345671','Visiting','none',NULL),(3,'2022','Ms.M.A.Y.U Jayathilaka','jayathilaka@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Computer and Network Sysytem','C3, kegalle','712345672','Visiting','none',NULL),(4,'2023','Mr.R.W.M.B.K.W Wanigasekara','wanigasekara@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Introduction to Project Management, project integration Management','C4, kegalle','712345673','Visiting','none',NULL),(5,'2024','Ms.M.P.S.Ishari','ishari@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Principlee of management','C5,kegalle','712345674','Permanent','none',NULL),(6,'2025','Ms.W.K.T.P.S. Sumanathilaka','sumanathilaka@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Project Planning','C6, kegalle','712345675','Visiting','none',NULL),(7,'2026','Mr.S.P.G.M.Aberathna','aberathna@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Micro Economics','C7,kegalle','712345676','Permanent','none',NULL),(8,'2027','Ms.M.G.N.H. Gamlath','gamlath@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Business Mathamatics & Statics, Web programming','C8, kegalle','712345677','Visiting','none',NULL),(9,'2028','Ms.Kumudu Rathnasiri','rathnasiri@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Information Technology','C9,kegalle','712345678','Visiting','none',NULL),(10,'2029','Mr.K.G.D.P.Kumara','kumara@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Business Communication I','C10, kegalle','712345679','Visiting','none',NULL),(11,'2030','Mr J.M.M.H. Jayasuriya','jayasuriya@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Project Communication & Stake holder Management','C11,kegalle','712345680','Visiting','none',NULL),(12,'2031','Ms.D.A.Weerasinge','weerasinge@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Project Qualiti Management','C12,kegalle','712345681','Visiting','none',NULL),(13,'2032','Ms.M.P.K. Rathnayake','rathnayake@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Project Monitoring & Evalution','C13, kegalle','712345682','Visiting','none',NULL),(14,'2033','Mr.M.A.U.R.Madurapperuma','madurapperuma@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Business Communication III','C14, kegalle','712345683','Visiting','none',NULL),(15,'2034','Mr.K.P.P.B Jayasinghe','jayasinghe@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','English Grammer , writing Skll, introduction to literature','C15,kegalle','712345684','Permanent','none',NULL),(16,'2035','Ms.W.A.I.B Wikramasinghe','wikramasinghe@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Listenning Sklls','C16,kegalle','712345685','Visiting','none',NULL),(17,'2036','Ms.E.A.N.J.Edirisinghe','edirisinghe@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Speaking skills','C17,kegalle','712345686','Permanent','none',NULL),(18,'2037','Ms.A.N.B.Rodrigo','rodrigo@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Introduction to literature in English','C18, kegalle','712345687','Visiting','none',NULL),(19,'2038','Ms.H.M.H.P Jayarathna','jayarathna@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Language and Society','C19,kegalle','712345688','Permanent','none',NULL),(20,'2039','Ms.A.S.W. Gunawardane','gunawardane@gmail.com','$2y$10$p2fDt6I73XzPUbzlcxlnuuIBlXl05QtvOdi/VFTqCwb39Wmi/6AbC','Language and Society','C20,kegalle','712345689','Permanent','none',NULL),(21,'2040','Ms J.M.M.U.P Senevirathna','senevirathna@gmail.com','$2y$10$9ch4eahjfTRu9eJhMhJurOdfZLSm74GIxW.vKTu6vM5pvDFWJswzC','Data Structure and Algorithms, Operating System','kegalle','','Visiting',NULL,'2024-11-06 18:35:54'),(22,'2041','Mr N.M.D.N Wijerathna','wijerathna@gmail.com','$2y$10$8hXFFzRzcDGuzRgLlG5xKO30.T3WPc0ulz4rfcq1xu4dVMAXs0DWO','Object Oriented Programming','kegalle','','Visiting',NULL,'2024-11-06 18:37:55'),(23,'2042','Ms R.U.I.K Jananayake','jananayake@gmail.com','$2y$10$8/BlnMhEzSTojrZfhxCF0Oz/MG6kYaEhA2LYWInLi1565MtufYUpe','Statics for IT','kegalle','','Visiting',NULL,'2024-11-06 19:13:28');
/*!40000 ALTER TABLE `lecturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `semester` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sem_num` int NOT NULL,
  `sem_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

LOCK TABLES `semester` WRITE;
/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
INSERT INTO `semester` VALUES (1,1,'First Semester'),(2,2,'Second  Semester'),(3,3,'Third Semester'),(4,4,'Fourth Semester');
/*!40000 ALTER TABLE `semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `index_number` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_num` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `department_id` int NOT NULL,
  `batch_id` int NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `enrollment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_number` (`index_number`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `department_id` (`department_id`),
  KEY `batch_id` (`batch_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `students_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'KEG/E/2022/F/0001','Nimal Perera','nimal.perera@gmail.com','712345678','M-12 kagalle',3,3,'none','2024-11-05 16:12:30'),(2,'KEG/E/2022/F/0002','Ranjith Silva','ranjith.silva@gmail.com','712345679','M-13 kagalle',3,3,'none','2024-11-05 16:12:30'),(3,'KEG/E/2022/F/0003','Sarath Fernando','sarath.fernando@gmail.com','712345680','M-14 kagalle',3,3,'none','2024-11-05 16:12:30'),(4,'KEG/E/2022/F/0004','Upul Bandara','upul.bandara@gmail.com','712345681','M-15 kagalle',3,3,'none','2024-11-05 16:12:30'),(5,'KEG/E/2022/F/0005','Chaminda Gunawardena','chaminda.gunawardena@gmail.com','712345682','M-12 kagalle',3,3,'none','2024-11-05 16:12:30'),(6,'KEG/E/2022/F/0006','Suresh Herath','suresh.herath@gmail.com','712345683','M-13 kagalle',3,3,'none','2024-11-05 16:12:30'),(7,'KEG/E/2022/F/0007','Sunil Jayasinghe','sunil.jayasinghe@gmail.com','712345684','M-14 kagalle',3,3,'none','2024-11-05 16:12:30'),(8,'KEG/E/2022/F/0008','Ruwanthi Dissanayake','ruwanthi.dissanayake@gmail.com','712345709','M-15 kagalle',3,3,'none','2024-11-05 16:12:30'),(9,'KEG/E/2022/F/0009','Harini Senanayake','harini.senanayake@gmail.com','712345710','M-12 kagalle',3,3,'none','2024-11-05 16:12:30'),(10,'KEG/E/2022/F/0010','Samanthi Wijesinghe','samanthi.wijesinghe@gmail.com','712345711','M-13 kagalle',3,3,'none','2024-11-05 16:12:30'),(11,'KEG/E/2022/F/0011','Rihana Farzana','rihana.farzana@gmail.com','712345770','M-12 kagalle',3,3,'none','2024-11-05 16:12:30'),(12,'KEG/E/2022/F/0012','Saniya Nafeesa','saniya.nafeesa@gmail.com','712345771','M-13 kagalle',3,3,'none','2024-11-05 16:12:30'),(13,'KEG/E/2022/F/0013','Alina Razeena','alina.razeena@gmail.com','712345772','M-14 kagalle',3,3,'none','2024-11-05 16:12:30'),(14,'KEG/E/2022/F/0014','Zoya Nabila','zoya.nabila@gmail.com','712345773','M-15 kagalle',3,3,'none','2024-11-05 16:12:30'),(15,'KEG/E/2022/F/0015','Janaka Karunaratne','janaka.karunaratne@gmail.com','712345692','M-14 kagalle',3,3,'none','2024-11-05 16:12:30'),(16,'KEG/E/2022/F/0016','Prasanna Weerasinghe','prasanna.weerasinghe@gmail.com','712345693','M-15 kagalle',3,3,'none','2024-11-05 16:12:30'),(17,'KEG/E/2022/F/0017','Nihal Kulasuriya','nihal.kulasuriya@gmail.com','712345694','M-12 kagalle',3,3,'none','2024-11-05 16:12:30'),(18,'KEG/E/2022/F/0018','Anura Mudalige','anura.mudalige@gmail.com','712345695','M-13 kagalle',3,3,'none','2024-11-05 16:12:30'),(19,'KEG/E/2022/F/0019','Dinesh Pathirana','dinesh.pathirana@gmail.com','712345696','M-14 kagalle',3,3,'none','2024-11-05 16:12:30'),(20,'KEG/E/2022/F/0020','Rohan Abeywardena','rohan.abeywardena@gmail.com','712345697','M-15 kagalle',3,3,'none','2024-11-05 16:12:30'),(21,'KEG/E/2022/F/0021','Sampath Liyanage','sampath.liyanage@gmail.com','712345698','M-12 kagalle',3,3,'none','2024-11-05 16:12:30'),(22,'KEG/E/2022/F/0022','Lalith Amarasinghe','lalith.amarasinghe@gmail.com','712345699','M-13 kagalle',3,3,'none','2024-11-05 16:12:30'),(23,'KEG/E/2022/F/0023','Ravindra Tennakoon','ravindra.tennakoon@gmail.com','712345700','M-14 kagalle',3,3,'none','2024-11-05 16:12:30'),(24,'KEG/E/2022/F/0024','Ajith Ranasinghe','ajith.ranasinghe@gmail.com','712345701','M-15 kagalle',3,3,'none','2024-11-05 16:12:30'),(25,'KEG/E/2022/F/0025','Thilina Aluthge','thilina.aluthge@gmail.com','712345702','M-12 kagalle',3,3,'none','2024-11-05 16:12:30'),(26,'KEG/A/2022/F/0001','Kumari Silva','kumari.silva@gmail.com','712345703','M-13 kagalle',2,2,'none','2024-11-05 16:12:30'),(27,'KEG/A/2022/F/0002','Sanduni Rathnayake','sanduni.rathnayake@gmail.com','712345704','M-14 kagalle',2,2,'none','2024-11-05 16:12:30'),(28,'KEG/A/2022/F/0003','Malini Jayasinghe','malini.jayasinghe@gmail.com','712345705','M-15 kagalle',2,2,'none','2024-11-05 16:12:30'),(29,'KEG/A/2022/F/0004','Dharshika Muthukumaran','dharshika.muthukumaran@gmail.com','712345785','M-15 kagalle',2,2,'none','2024-11-05 16:12:30'),(30,'KEG/A/2022/F/0005','Priya Rajendran','priya.rajendran@gmail.com','712345786','M-12 kagalle',2,2,'none','2024-11-05 16:12:30'),(31,'KEG/A/2022/F/0006','Meera Balasubramaniam','meera.balasubramaniam@gmail.com','712345787','M-13 kagalle',2,2,'none','2024-11-05 16:12:30'),(32,'KEG/A/2022/F/0007','Safiya Jameela','safiya.jameela@gmail.com','712345766','M-12 kagalle',2,2,'none','2024-11-05 16:12:30'),(33,'KEG/A/2022/F/0008','Nadia Mahira','nadia.mahira@gmail.com','712345767','M-13 kagalle',2,2,'none','2024-11-05 16:12:30'),(34,'KEG/A/2022/F/0009','Hadiya Sameera','hadiya.sameera@gmail.com','712345768','M-14 kagalle',2,2,'none','2024-11-05 16:12:30'),(35,'KEG/A/2022/F/0010','Mariya Zainab','mariya.zainab@gmail.com','712345769','M-15 kagalle',2,2,'none','2024-11-05 16:12:30'),(36,'KEG/A/2022/F/0011','Gayathri Gamage','gayathri.gamage@gmail.com','712345713','M-15 kagalle',2,2,'none','2024-11-05 16:12:30'),(37,'KEG/A/2022/F/0012','Shanika Karunaratne','shanika.karunaratne@gmail.com','712345714','M-12 kagalle',2,2,'none','2024-11-05 16:12:30'),(38,'KEG/A/2022/F/0013','Dilini Sooriyabandara','dilini.sooryabandara@gmail.com','712345715','M-13 kagalle',2,2,'none','2024-11-05 16:12:30'),(39,'KEG/A/2022/F/0014','Nithya Ananth','nithya.ananth@gmail.com','712345716','M-14 kagalle',2,2,'none','2024-11-05 16:12:30'),(40,'KEG/A/2022/F/0015','Nisha Manikkam','nisha.manikkam@gmail.com','712345717','M-15 kagalle',2,2,'none','2024-11-05 16:12:30'),(41,'KEG/A/2022/F/0016','Safiya Prabhu','safiya.prabhu@gmail.com','712345718','M-12 kagalle',2,2,'none','2024-11-05 16:12:30'),(42,'KEG/A/2022/F/0017','Zainab Sabina','zainab.sabina@gmail.com','712345719','M-13 kagalle',2,2,'none','2024-11-05 16:12:30'),(43,'KEG/A/2022/F/0018','Nisa Nazeer','nisa.nazeer@gmail.com','712345720','M-14 kagalle',2,2,'none','2024-11-05 16:12:30'),(44,'KEG/A/2022/F/0019','Anjali Ramachandran','anjali.ramachandran@gmail.com','712345721','M-15 kagalle',2,2,'none','2024-11-05 16:12:30'),(45,'KEG/A/2022/F/0020','Umaima Zahir','umaima.zahir@gmail.com','712345722','M-12 kagalle',2,2,'none','2024-11-05 16:12:30'),(46,'KEG/A/2022/F/0021','Parveen Batool','parveen.batool@gmail.com','712345723','M-13 kagalle',2,2,'none','2024-11-05 16:12:30'),(47,'KEG/A/2022/F/0022','Laila Muqaddas','laila.muqaddas@gmail.com','712345724','M-14 kagalle',2,2,'none','2024-11-05 16:12:30'),(48,'KEG/A/2022/F/0023','Shazia Irfan','shazia.irfan@gmail.com','712345725','M-15 kagalle',2,2,'none','2024-11-05 16:12:30'),(49,'KEG/A/2022/F/0024','Huma Noor','huma.noor@gmail.com','712345726','M-12 kagalle',2,2,'none','2024-11-05 16:12:30'),(50,'KEG/A/2022/F/0025','Naaz Azeez','naaz.azeez@gmail.com','712345727','M-13 kagalle',2,2,'none','2024-11-05 16:12:30'),(51,'KEG/PM/2022/F/0001','Lakmal Rathnayake','lakmal.rathnayake@gmail.com','712345728','M-14 kagalle',4,4,'none','2024-11-05 16:12:30'),(52,'KEG/PM/2022/F/0002','Dinuka Perera','dinuka.perera@gmail.com','712345729','M-15 kagalle',4,4,'none','2024-11-05 16:12:30'),(53,'KEG/PM/2022/F/0003','Harsha Bandara','harsha.bandara@gmail.com','712345730','M-12 kagalle',4,4,'none','2024-11-05 16:12:30'),(54,'KEG/PM/2022/F/0004','Kasun Fernando','kasun.fernando@gmail.com','712345731','M-13 kagalle',4,4,'none','2024-11-05 16:12:30'),(55,'KEG/PM/2022/F/0005','Pasindu Wijesinghe','pasindu.wijesinghe@gmail.com','712345732','M-14 kagalle',4,4,'none','2024-11-05 16:12:30'),(56,'KEG/PM/2022/F/0006','Chathura Gunasekara','chathura.gunasekara@gmail.com','712345733','M-15 kagalle',4,4,'none','2024-11-05 16:12:30'),(57,'KEG/PM/2022/F/0007','Lahiru Herath','lahiru.herath@gmail.com','712345734','M-12 kagalle',4,4,'none','2024-11-05 16:12:30'),(58,'KEG/PM/2022/F/0008','Roshan Abeywardena','roshan.abeywardena@gmail.com','712345735','M-13 kagalle',4,4,'none','2024-11-05 16:12:30'),(59,'KEG/PM/2022/F/0009','Keshan Ekanayake','keshan.ekanayake@gmail.com','712345736','M-14 kagalle',4,4,'none','2024-11-05 16:12:30'),(60,'KEG/PM/2022/F/0010','Dilan Senanayake','dilan.senanayake@gmail.com','712345737','M-15 kagalle',4,4,'none','2024-11-05 16:12:30'),(61,'KEG/PM/2022/F/0011','Nethmi Jayasinghe','nethmi.jayasinghe@gmail.com','712345738','M-12 kagalle',4,4,'none','2024-11-05 16:12:30'),(62,'KEG/PM/2022/F/0012','Tharushi Rathnayake','tharushi.rathnayake@gmail.com','712345739','M-13 kagalle',4,4,'none','2024-11-05 16:12:30'),(63,'KEG/PM/2022/F/0013','Isuri Fernando','isuri.fernando@gmail.com','712345740','M-14 kagalle',4,4,'none','2024-11-05 16:12:30'),(64,'KEG/PM/2022/F/0014','Himasha Gunasekara','himasha.gunasekara@gmail.com','712345741','M-15 kagalle',4,4,'none','2024-11-05 16:12:30'),(65,'KEG/PM/2022/F/0015','Oshadhi Wijesinghe','oshadhi.wijesinghe@gmail.com','712345742','M-12 kagalle',4,4,'none','2024-11-05 16:12:30'),(66,'KEG/PM/2022/F/0016','Chamari Herath','chamari.herath@gmail.com','712345743','M-13 kagalle',4,4,'none','2024-11-05 16:12:30'),(67,'KEG/PM/2022/F/0017','Rasangi Abeywardena','rasangi.abeywardena@gmail.com','712345744','M-14 kagalle',4,4,'none','2024-11-05 16:12:30'),(68,'KEG/PM/2022/F/0018','Thilini Ekanayake','thilini.ekanayake@gmail.com','712345745','M-15 kagalle',4,4,'none','2024-11-05 16:12:30'),(69,'KEG/PM/2022/F/0019','Dushani Bandara','dushani.bandara@gmail.com','712345746','M-12 kagalle',4,4,'none','2024-11-05 16:12:30'),(70,'KEG/PM/2022/F/0020','Madushika Senanayake','madushika.senanayake@gmail.com','712345747','M-13 kagalle',4,4,'none','2024-11-05 16:12:30'),(71,'KEG/PM/2022/F/0021','Amir Fawaz','amir.fawaz@gmail.com','712345748','M-14 kagalle',4,4,'none','2024-11-05 16:12:30'),(72,'KEG/PM/2022/F/0022','Imran Nazeer','imran.nazeer@gmail.com','712345749','M-15 kagalle',4,4,'none','2024-11-05 16:12:30'),(73,'KEG/PM/2022/F/0023','Nafees Rameez','nafees.rameez@gmail.com','712345750','M-12 kagalle',4,4,'none','2024-11-05 16:12:30'),(74,'KEG/PM/2022/F/0024','Yasir Mahir','yasir.mahir@gmail.com','712345751','M-13 kagalle',4,4,'none','2024-11-05 16:12:30'),(75,'KEG/PM/2022/F/0025','Iqbal Sharif','iqbal.sharif@gmail.com','712345752','M-14 kagalle',4,4,'none','2024-11-05 16:12:30'),(76,'KEG/IT/2022/F/0001','Riaz Saleem','riaz.saleem@gmail.com','712345753','M-15 kagalle',1,1,'none','2024-11-05 16:12:30'),(77,'KEG/IT/2022/F/0002','Bilal Azeem','bilal.azeem@gmail.com','712345754','M-12 kagalle',1,1,'none','2024-11-05 16:12:30'),(78,'KEG/IT/2022/F/0003','Ruwan Dissanayake','ruwan.dissanayake@gmail.com','712345685','M-15 kagalle',1,1,'none','2024-11-05 16:12:30'),(79,'KEG/IT/2022/F/0004','Mahinda Rathnayake','mahinda.rathnayake@gmail.com','712345686','M-12 kagalle',1,1,'none','2024-11-05 16:12:30'),(80,'KEG/IT/2022/F/0005','Arjuna Senanayake','arjuna.senanayake@gmail.com','712345687','M-13 kagalle',1,1,'none','2024-11-05 16:12:30'),(81,'KEG/IT/2022/F/0006','Kumara Wijesinghe','kumara.wijesinghe@gmail.com','712345688','M-14 kagalle',1,1,'none','2024-11-05 16:12:30'),(82,'KEG/IT/2022/F/0007','Dayananda Ekanayake','dayananda.ekanayake@gmail.com','712345689','M-15 kagalle',1,1,'none','2024-11-05 16:12:30'),(83,'KEG/IT/2022/F/0008','Asela Wickramasinghe','asela.wickramasinghe@gmail.com','712345690','M-12 kagalle',1,1,'none','2024-11-05 16:12:30'),(84,'KEG/IT/2022/F/0009','Jagath Gamage','jagath.gamage@gmail.com','712345691','M-13 kagalle',1,1,'none','2024-11-05 16:12:30'),(85,'KEG/IT/2022/F/0010','Tariq Nizam','tariq.nizam@gmail.com','712345762','M-12 kagalle',1,1,'none','2024-11-05 16:12:30'),(86,'KEG/IT/2022/F/0011','Amina Fathima','amina.fathima@gmail.com','712345763','M-13 kagalle',1,1,'none','2024-11-05 16:12:30'),(87,'KEG/IT/2022/F/0012','Yasmin Haleema','yasmin.haleema@gmail.com','712345764','M-14 kagalle',1,1,'none','2024-11-05 16:12:30'),(88,'KEG/IT/2022/F/0013','Leena Naleefa','leena.naleefa@gmail.com','712345765','M-15 kagalle',1,1,'none','2024-11-05 16:12:30'),(89,'KEG/IT/2022/F/0014','Ishara Wickramasinghe','ishara.wickramasinghe@gmail.com','712345712','M-14 kagalle',1,1,'none','2024-11-05 16:12:30'),(90,'KEG/IT/2022/F/0015','Jameel Rauf','jameel.rauf@gmail.com','712345755','M-13 kagalle',1,1,'none','2024-11-05 16:12:30'),(91,'KEG/IT/2022/F/0016','Fahim Yusuf','fahim.yusuf@gmail.com','712345756','M-14 kagalle',1,1,'none','2024-11-05 16:12:30'),(92,'KEG/IT/2022/F/0017','Sameer Malik','sameer.malik@gmail.com','712345757','M-15 kagalle',1,1,'none','2024-11-05 16:12:30'),(93,'KEG/IT/2022/F/0018','Naseem Farook','naseem.farook@gmail.com','712345758','M-12 kagalle',1,1,'none','2024-11-05 16:12:30'),(94,'KEG/IT/2022/F/0019','Rahim Junaid','rahim.junaid@gmail.com','712345759','M-13 kagalle',1,1,'none','2024-11-05 16:12:30'),(95,'KEG/IT/2022/F/0020','Zayed Mohideen','zayed.mohideen@gmail.com','712345760','M-14 kagalle',1,1,'none','2024-11-05 16:12:30'),(96,'KEG/IT/2022/F/0021','Khalid Shakir','khalid.shakir@gmail.com','712345761','M-15 kagalle',1,1,'none','2024-11-05 16:12:30'),(97,'KEG/IT/2022/F/0022','Sarah Haleema','sarah.haleema@gmail.com','712345774','M-12 kagalle',1,1,'none','2024-11-05 16:12:30'),(98,'KEG/IT/2022/F/0023','Faiza Naseema','faiza.naseema@gmail.com','712345775','M-13 kagalle',1,1,'none','2024-11-05 16:12:30'),(99,'KEG/IT/2022/F/0024','Rumaisa Mariam','rumaisa.mariam@gmail.com','712345776','M-14 kagalle',1,1,'none','2024-11-05 16:12:30'),(100,'KEG/IT/2022/F/0025','Layla Zahra','layla.zahra@gmail.com','712345777','M-15 kagalle',1,1,'none','2024-11-05 16:12:30');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_number` varchar(50) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `department_id` int DEFAULT NULL,
  `semester_id` int NOT NULL,
  `credits` int NOT NULL,
  `about` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subject_number` (`subject_number`),
  KEY `department_id` (`department_id`),
  KEY `semester_id` (`semester_id`),
  CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'HNDIT1012','Visual Application Programming',1,1,2,NULL),(2,'HNDIT1022','Web Design',1,1,3,NULL),(3,'HNDIT1032','Computer and Network Systems',1,1,2,NULL),(4,'HNDIT1042','Information Management and information system',1,1,3,NULL),(5,'HNDIT1052','ICT Project(individual)',1,1,4,NULL),(6,'HNDIT1062','Communication Skills',1,1,2,NULL),(7,'HNDIT2012','Fundimental of programming',1,2,3,NULL),(8,'HNDIT2022','Software Development',1,2,2,NULL),(9,'HNDIT2032','System Analyst and Design',1,2,4,NULL),(10,'HNDIT2042','Data Communication and Computer Network',1,2,3,NULL),(11,'HNDIT2052','User Interface Design',1,2,2,NULL),(12,'HNDIT2062','ICT project(Group)',1,2,3,NULL),(13,'HNDIT2072','Technical Writing',1,2,4,NULL),(14,'HNDIT2082','Human value & Professional Ethics',1,2,4,NULL),(15,'HNDIT3012','Object Oriented Programming',1,3,2,NULL),(16,'HNDIT3022','Web Programming',1,3,3,NULL),(17,'HNDIT3032','Data Structures and Algorithms',1,3,4,NULL),(18,'HNDIT3042','Database Management Systems',1,3,2,NULL),(19,'HNDIT3052','Operating Systems',1,3,3,NULL),(20,'HNDIT3062','Information and Computer Security',1,3,4,NULL),(21,'HNDIT3072','Statistics for IT',1,3,4,NULL),(22,'DA 2313','Advanced Financial Accounting',2,3,2,NULL),(23,'DA 2323','Business Statistics',2,3,2,NULL),(24,'DA 2332','Human Resources Management & OB',2,3,3,NULL),(25,'DA 2343','Auditing and Assurance',2,3,3,NULL),(26,'DA 2353','Financial Modelling',2,3,4,NULL),(27,'DA 2362','Managing Information System',2,3,4,NULL),(28,'ENGL 1101','English Grammar & Vocabulary in Context- Level 1',3,1,2,NULL),(29,'ENGL 1102','Listening Skills in English-Level 1',3,1,3,NULL),(30,'ENGL 1103','Speaking Skills in English– Level 1',3,1,4,NULL),(31,'ENGL 1104','Reading Skills in English- Level 1',3,1,4,NULL),(32,'ENGL 1105','Writing Skills in English- Level 1',3,1,4,NULL),(33,'ENGL 1106','Introduction to Literature in English',3,1,3,NULL),(34,'ENGL 1107','Technology Assisted Language Learning- Level I',3,1,3,NULL),(35,'ENGL 1108','Language and Society',3,1,4,NULL),(36,'PM 1101','Introduction to Project Management',4,1,2,NULL),(37,'PM 1102','Principles of Management',4,1,2,NULL),(38,'PM 1103','Project Planning',4,1,3,NULL),(39,'PM 1104','Micro Economics',4,1,4,NULL),(40,'PM 1105','Business Mathematics & Statistics I',4,1,4,NULL),(41,'PM 1106','Information Technology I',4,1,3,NULL),(42,'PM 1107','Business Communication I',4,1,2,NULL),(43,'PM 2101','Project Intergration Management',4,3,3,NULL),(44,'PM 2102','Project Communication & Stakeholder Management',4,3,2,NULL),(45,'PM 2103','Project Quality Management',4,3,4,NULL),(46,'PM 2104','Software Tools & Cloud Services for Project management',4,3,2,NULL),(47,'PM 2105','Project Monitoring & Evaluation',4,3,2,NULL),(48,'PM 2106','Project Risk Management',4,3,2,NULL),(49,'PM 2107','Business Communication III',4,3,4,NULL);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeslot`
--

DROP TABLE IF EXISTS `timeslot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timeslot` (
  `slot_id` int NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_interval` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`slot_id`),
  UNIQUE KEY `start_time` (`start_time`,`end_time`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeslot`
--

LOCK TABLES `timeslot` WRITE;
/*!40000 ALTER TABLE `timeslot` DISABLE KEYS */;
INSERT INTO `timeslot` VALUES (1,'08:30:00','09:30:00',0),(2,'09:30:00','10:30:00',0),(3,'10:30:00','11:30:00',0),(4,'11:30:00','12:30:00',0),(5,'12:30:00','13:00:00',1),(6,'13:00:00','14:00:00',0),(7,'14:00:00','15:00:00',0),(8,'15:00:00','16:00:00',0),(9,'16:00:00','17:00:00',0);
/*!40000 ALTER TABLE `timeslot` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-12 21:08:43
