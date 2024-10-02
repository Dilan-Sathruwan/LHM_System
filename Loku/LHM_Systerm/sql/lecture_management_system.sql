-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 06:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lecture_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin123', '2024-10-02 16:19:13'),
(2, 'superadmin', 'super123', '2024-10-02 16:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`) VALUES
(1, 'IT', '2024-10-02 16:19:14'),
(2, 'Accounting', '2024-10-02 16:19:14'),
(3, 'English', '2024-10-02 16:19:14'),
(4, 'Project Management', '2024-10-02 16:19:14'),
(5, 'Mathematics', '2024-10-02 16:19:14'),
(6, 'Biology', '2024-10-02 16:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `facilities` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `name`, `capacity`, `facilities`, `created_at`) VALUES
(1, 'Hall A', 50, 'Projector, Whiteboard', '2024-10-02 16:19:16'),
(2, 'Hall B', 100, 'Projector, Sound System, Air Conditioning', '2024-10-02 16:19:16'),
(3, 'Hall C', 200, 'Projector, Whiteboard, Video Conferencing', '2024-10-02 16:19:16'),
(4, 'Hall D', 75, 'Whiteboard, Air Conditioning', '2024-10-02 16:19:16'),
(5, 'Hall E', 150, 'Smart Board, Sound System', '2024-10-02 16:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `first_name`, `last_name`, `username`, `email`, `department_id`, `password`, `phone_number`, `created_at`) VALUES
(1, 'John', 'Doe', 'johndoe', 'john.doe@example.com', 1, 'password1', '123-456-7890', '2024-10-02 16:19:17'),
(2, 'Jane', 'Smith', 'janesmith', 'jane.smith@example.com', 2, 'password2', '234-567-8901', '2024-10-02 16:19:17'),
(3, 'Alice', 'Johnson', 'alicejohnson', 'alice.johnson@example.com', 3, 'password3', '345-678-9012', '2024-10-02 16:19:17'),
(4, 'Bob', 'Williams', 'bobwilliams', 'bob.williams@example.com', 4, 'password4', '456-789-0123', '2024-10-02 16:19:17'),
(5, 'Charlie', 'Brown', 'charliebrown', 'charlie.brown@example.com', 5, 'password5', '567-890-1234', '2024-10-02 16:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `hall_id` int(11) NOT NULL,
  `lecture_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `lecturer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `subject_id`, `hall_id`, `lecture_date`, `start_time`, `end_time`, `created_at`, `lecturer_id`) VALUES
(1, 1, 1, '2024-09-30', '08:30:00', '09:30:00', '2024-10-02 16:19:18', 1),
(2, 2, 2, '2024-09-30', '09:30:00', '10:30:00', '2024-10-02 16:19:18', 1),
(3, 3, 3, '2024-09-30', '10:30:00', '11:30:00', '2024-10-02 16:19:18', 2),
(4, 4, 1, '2024-09-30', '11:30:00', '12:30:00', '2024-10-02 16:19:18', 2),
(5, 5, 4, '2024-09-30', '01:00:00', '02:00:00', '2024-10-02 16:19:18', 3),
(6, 6, 3, '2024-09-30', '02:00:00', '03:00:00', '2024-10-02 16:19:18', 4),
(7, 7, 5, '2024-09-30', '03:00:00', '04:00:00', '2024-10-02 16:19:18', 5),
(8, 8, 2, '2024-09-30', '04:00:00', '05:00:00', '2024-10-02 16:19:18', 5),
(9, 1, 1, '2024-10-01', '08:30:00', '09:30:00', '2024-10-02 16:24:54', 1),
(10, 2, 2, '2024-10-01', '09:30:00', '10:30:00', '2024-10-02 16:24:54', 1),
(11, 3, 3, '2024-10-01', '10:30:00', '11:30:00', '2024-10-02 16:24:54', 2),
(12, 4, 4, '2024-10-01', '11:30:00', '12:30:00', '2024-10-02 16:24:54', 3),
(13, 5, 5, '2024-10-01', '01:00:00', '02:00:00', '2024-10-02 16:24:54', 4),
(14, 6, 2, '2024-10-01', '02:00:00', '03:00:00', '2024-10-02 16:24:54', 4),
(15, 1, 3, '2024-10-01', '03:00:00', '04:00:00', '2024-10-02 16:24:54', 1),
(16, 7, 4, '2024-10-01', '04:00:00', '05:00:00', '2024-10-02 16:24:54', 5),
(17, 8, 1, '2024-10-02', '08:30:00', '09:30:00', '2024-10-02 16:24:54', 3),
(18, 9, 2, '2024-10-02', '09:30:00', '10:30:00', '2024-10-02 16:24:54', 4),
(19, 10, 3, '2024-10-02', '10:30:00', '11:30:00', '2024-10-02 16:24:54', 5),
(20, 1, 4, '2024-10-02', '11:30:00', '12:30:00', '2024-10-02 16:24:54', 1),
(21, 2, 5, '2024-10-02', '01:00:00', '02:00:00', '2024-10-02 16:24:54', 2),
(22, 3, 1, '2024-10-02', '02:00:00', '03:00:00', '2024-10-02 16:24:54', 3),
(23, 4, 2, '2024-10-02', '03:00:00', '04:00:00', '2024-10-02 16:24:54', 4),
(24, 5, 3, '2024-10-02', '04:00:00', '05:00:00', '2024-10-02 16:24:54', 5),
(25, 6, 4, '2024-10-03', '08:30:00', '09:30:00', '2024-10-02 16:24:54', 1),
(26, 7, 5, '2024-10-03', '09:30:00', '10:30:00', '2024-10-02 16:24:54', 2),
(27, 8, 1, '2024-10-03', '10:30:00', '11:30:00', '2024-10-02 16:24:54', 3),
(28, 9, 2, '2024-10-03', '11:30:00', '12:30:00', '2024-10-02 16:24:54', 4),
(29, 10, 3, '2024-10-03', '01:00:00', '02:00:00', '2024-10-02 16:24:54', 5),
(30, 1, 4, '2024-10-03', '02:00:00', '03:00:00', '2024-10-02 16:24:54', 1),
(31, 2, 5, '2024-10-03', '03:00:00', '04:00:00', '2024-10-02 16:24:54', 2),
(32, 3, 1, '2024-10-03', '04:00:00', '05:00:00', '2024-10-02 16:24:54', 3);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `email`, `department_id`, `created_at`) VALUES
(1, 'student1', 'student1@example.com', 1, '2024-10-02 16:19:19'),
(2, 'student2', 'student2@example.com', 2, '2024-10-02 16:19:19'),
(3, 'student3', 'student3@example.com', 3, '2024-10-02 16:19:19'),
(4, 'student4', 'student4@example.com', 4, '2024-10-02 16:19:19'),
(5, 'student5', 'student5@example.com', 5, '2024-10-02 16:19:19'),
(6, 'student6', 'student6@example.com', 6, '2024-10-02 16:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_enrollment`
--

CREATE TABLE `student_enrollment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `enrollment_date` date NOT NULL,
  `semester` int(11) NOT NULL,
  `grade` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_enrollment`
--

INSERT INTO `student_enrollment` (`id`, `student_id`, `subject_id`, `enrollment_date`, `semester`, `grade`) VALUES
(1, 1, 1, '2024-09-01', 1, 'A'),
(2, 2, 3, '2024-09-01', 1, 'B'),
(3, 3, 5, '2024-09-01', 1, 'C'),
(4, 4, 7, '2024-09-01', 1, 'B'),
(5, 5, 8, '2024-09-01', 1, 'A'),
(6, 6, 6, '2024-09-01', 1, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `lecturer_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `department_id`, `lecturer_id`, `description`, `created_at`) VALUES
(1, 'Introduction to Programming', 1, 1, 'Basics of programming using Python.', '2024-10-02 16:19:18'),
(2, 'Database Management Systems', 1, 1, 'Understanding databases and SQL.', '2024-10-02 16:19:18'),
(3, 'Financial Accounting', 2, 2, 'Principles of accounting and financial reporting.', '2024-10-02 16:19:18'),
(4, 'Taxation', 2, 2, 'Overview of taxation systems and laws.', '2024-10-02 16:19:18'),
(5, 'English Literature', 3, 3, 'Study of various literary works.', '2024-10-02 16:19:18'),
(6, 'Business Communication', 3, 3, 'Effective communication in a business setting.', '2024-10-02 16:19:18'),
(7, 'Project Management Fundamentals', 4, 4, 'Introduction to project management principles.', '2024-10-02 16:19:18'),
(8, 'Advanced Project Management', 4, 4, 'In-depth study of project management methodologies.', '2024-10-02 16:19:18'),
(9, 'Calculus I', 5, 5, 'Fundamentals of calculus and its applications.', '2024-10-02 16:19:18'),
(10, 'Biology 101', 6, 5, 'Introduction to the study of living organisms.', '2024-10-02 16:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time_slot_id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `hall_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `lecturer_id`, `subject_id`, `time_slot_id`, `day_of_week`, `hall_id`) VALUES
(1, 1, 1, 1, 'Monday', 1),
(2, 1, 2, 2, 'Monday', 2),
(3, 2, 3, 3, 'Monday', 3),
(4, 2, 4, 4, 'Monday', 1),
(5, 3, 5, 5, 'Monday', 4),
(6, 4, 6, 6, 'Monday', 3),
(7, 5, 8, 7, 'Monday', 5),
(8, 5, 9, 8, 'Tuesday', 2),
(9, 3, 10, 1, 'Wednesday', 4);

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `start_time`, `end_time`) VALUES
(1, '08:30:00', '09:30:00'),
(2, '09:30:00', '10:30:00'),
(3, '10:30:00', '11:30:00'),
(4, '11:30:00', '12:30:00'),
(5, '13:00:00', '14:00:00'),
(6, '14:00:00', '15:00:00'),
(7, '15:00:00', '16:00:00'),
(8, '16:00:00', '17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `hall_id` (`hall_id`),
  ADD KEY `lectures_ibfk_3` (`lecturer_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturer_id` (`lecturer_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_timetable` (`lecturer_id`,`subject_id`,`time_slot_id`,`day_of_week`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `time_slot_id` (`time_slot_id`),
  ADD KEY `hall_id` (`hall_id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `time_slot` (`start_time`,`end_time`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD CONSTRAINT `lecturers_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `lectures_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lectures_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lectures_ibfk_3` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  ADD CONSTRAINT `student_enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_enrollment_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`),
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slots` (`id`),
  ADD CONSTRAINT `timetable_ibfk_4` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
