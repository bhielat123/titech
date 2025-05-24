-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 03:35 PM
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
-- Database: `wrtclc`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `phone`, `message`, `status`, `created_at`) VALUES
(3, 'Alice Johnson', 'alice@example.com', '555-1234', 'Interested in your services.', 'new', '2025-05-08 13:10:10'),
(4, 'Bob Smith', 'bob@example.com', '555-2345', 'Please call me back.', 'Resolved', '2025-05-08 13:10:10'),
(5, 'Carol Lee', 'carol@example.com', '555-3456', 'Need a quote.', 'new', '2025-05-08 13:10:10'),
(6, 'David Kim', 'david@example.com', '555-4567', 'Follow up on previous email.', 'read', '2025-05-08 13:10:10'),
(7, 'Eve Miller', 'eve@example.com', '555-5678', 'Inquiry about pricing.', 'new', '2025-05-08 13:10:10'),
(8, 'Frank White', 'frank@example.com', '555-6789', 'Schedule a meeting.', 'pending', '2025-05-08 13:10:10'),
(9, 'Grace Hall', 'grace@example.com', '555-7890', 'Looking for partnership.', 'new', '2025-05-08 13:10:10'),
(10, 'Henry Adams', 'henry@example.com', '555-8901', 'Send more details.', 'read', '2025-05-08 13:10:10'),
(11, 'Isabel Brown', 'isabel@example.com', '555-9012', 'Urgent response needed.', 'new', '2025-05-08 13:10:10'),
(12, 'Jack Davis', 'jack@example.com', '555-0123', 'Interested in demo.', 'pending', '2025-05-08 13:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `parentSurname` varchar(100) DEFAULT NULL,
  `parentFirst` varchar(100) DEFAULT NULL,
  `parentMiddle` varchar(100) DEFAULT NULL,
  `parentPhone` varchar(15) DEFAULT NULL,
  `parentEmail` varchar(255) DEFAULT NULL,
  `parentOccupation` varchar(100) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `surname`, `firstname`, `middlename`, `gender`, `birthplace`, `email`, `dob`, `street`, `city`, `province`, `zipcode`, `parentSurname`, `parentFirst`, `parentMiddle`, `parentPhone`, `parentEmail`, `parentOccupation`, `status`, `created_at`) VALUES
(1, 'Balite', 'Hannah', NULL, 'female', 'Makati', 'hannah@gmail.com', '2019-09-09', '2019', 'Makati City', 'Metro Manila', '1209', 'Balite', 'Hannah', '', '09999999999', 'Hahhan@gmail.com', 'Doctor', 'Accepted', '2025-04-21 16:43:07'),
(4, 'Gentallan', 'Vianca', NULL, 'female', 'Makati', 'via@gmail.com', '2019-09-09', '6594', 'Makati City', 'Metro Manila', '1206', 'Gentallan', 'Francus', '', '09999999999', 'francis@gmail.com', 'Construction Worker', 'Accepted', '2025-04-23 04:44:27'),
(5, 'Hodreal', 'Jeph', NULL, 'male', 'Makati', 'test@gmail.com', '2019-09-09', '2019', 'Makati City', 'Metro Manila', '1209', 'Balite', 'Francus', '', '09999999999', 'leah@gmail.com', 'Doctor', 'Declined', '2025-04-25 10:08:01'),
(6, 'Lopez', 'Maria', 'Isabel', 'female', 'Manila', 'maria.lopez@example.com', '2005-06-15', '123 Elm St', 'Quezon City', 'Metro Manila', '1100', 'Lopez', 'Juan', 'Andres', '09171234567', 'juan.lopez@example.com', 'Engineer', 'Accepted', '2025-05-08 21:16:27'),
(7, 'Cruz', 'Jose', 'Antonio', 'male', 'Cebu City', 'jose.cruz@example.com', '2004-08-20', '456 Pine St', 'Cebu City', 'Cebu', '6000', 'Cruz', 'Carlos', 'Miguel', '09281234567', 'carlos.cruz@example.com', 'Doctor', 'active', '2025-05-08 21:16:27'),
(8, 'Reyes', 'Ana', 'Lucia', 'female', 'Davao City', 'ana.reyes@example.com', '2006-02-10', '789 Maple St', 'Davao City', 'Davao del Sur', '8000', 'Reyes', 'Luis', 'Fernando', '09391234567', 'luis.reyes@example.com', 'Teacher', 'active', '2025-05-08 21:16:27'),
(9, 'Santos', 'Mark', 'Elijah', 'male', 'Baguio City', 'mark.santos@example.com', '2005-11-05', '101 Oak St', 'Baguio City', 'Benguet', '2600', 'Santos', 'Pedro', 'Jose', '09451234567', 'pedro.santos@example.com', 'Businessman', 'active', '2025-05-08 21:16:27'),
(10, 'Garcia', 'Lara', 'Marie', 'female', 'Iloilo City', 'lara.garcia@example.com', '2004-09-22', '202 Birch St', 'Iloilo City', 'Iloilo', '5000', 'Garcia', 'Roberto', 'Carlos', '09561234567', 'roberto.garcia@example.com', 'Nurse', 'active', '2025-05-08 21:16:27'),
(11, 'Fernandez', 'Jorge', 'Luis', 'male', 'Zamboanga City', 'jorge.fernandez@example.com', '2005-03-18', '303 Cedar St', 'Zamboanga City', 'Zamboanga del Sur', '7000', 'Fernandez', 'Mario', 'Ramon', '09671234567', 'mario.fernandez@example.com', 'Engineer', 'active', '2025-05-08 21:16:27'),
(12, 'Torres', 'Bianca', 'Elaine', 'female', 'Tagaytay City', 'bianca.torres@example.com', '2006-07-11', '404 Spruce St', 'Tagaytay City', 'Cavite', '4120', 'Torres', 'Ernesto', 'David', '09781234567', 'ernesto.torres@example.com', 'Lawyer', 'active', '2025-05-08 21:16:27'),
(13, 'Morales', 'Kevin', 'John', 'male', 'Pasig City', 'kevin.morales@example.com', '2004-12-25', '505 Redwood St', 'Pasig City', 'Metro Manila', '1600', 'Morales', 'Ricardo', 'Andres', '09891234567', 'ricardo.morales@example.com', 'Architect', 'active', '2025-05-08 21:16:27'),
(14, 'Del Rosario', 'Julia', 'Ann', 'female', 'Makati City', 'julia.delrosario@example.com', '2005-05-14', '606 Walnut St', 'Makati City', 'Metro Manila', '1200', 'Del Rosario', 'Francisco', 'Luis', '09901234567', 'francisco.delrosario@example.com', 'Engineer', 'active', '2025-05-08 21:16:27'),
(15, 'Navarro', 'Luis', 'Martin', 'male', 'Cagayan de Oro', 'luis.navarro@example.com', '2004-10-30', '707 Fir St', 'Cagayan de Oro', 'Misamis Oriental', '9000', 'Navarro', 'Manuel', 'Santos', '09181234567', 'manuel.navarro@example.com', 'Teacher', 'active', '2025-05-08 21:16:27'),
(16, 'Vega', 'Nicole', 'Rose', 'female', 'San Fernando', 'nicole.vega@example.com', '2006-01-19', '808 Cypress St', 'San Fernando', 'Pampanga', '2000', 'Vega', 'Oscar', 'Pablo', '09291234567', 'oscar.vega@example.com', 'Nurse', 'active', '2025-05-08 21:16:27'),
(17, 'De la Cruz', 'Ryan', 'Edward', 'male', 'Tarlac City', 'ryan.delacruz@example.com', '2005-04-07', '909 Palm St', 'Tarlac City', 'Tarlac', '2300', 'De la Cruz', 'Rafael', 'Jorge', '09301234567', 'rafael.delacruz@example.com', 'Mechanic', 'active', '2025-05-08 21:16:27'),
(18, 'Ramos', 'Faith', 'Claire', 'female', 'Antipolo City', 'faith.ramos@example.com', '2004-03-03', '100 Aspen St', 'Antipolo City', 'Rizal', '1870', 'Ramos', 'Benjamin', 'Leo', '09411234567', 'benjamin.ramos@example.com', 'Driver', 'active', '2025-05-08 21:16:27'),
(19, 'Agustin', 'Ian', 'Gabriel', 'male', 'Legazpi City', 'ian.agustin@example.com', '2006-06-06', '111 Bamboo St', 'Legazpi City', 'Albay', '4500', 'Agustin', 'Noel', 'Rico', '09521234567', 'noel.agustin@example.com', 'Carpenter', 'active', '2025-05-08 21:16:27'),
(20, 'Salazar', 'Trisha', 'Mae', 'female', 'Tacloban City', 'trisha.salazar@example.com', '2005-08-12', '122 Magnolia St', 'Tacloban City', 'Leyte', '6500', 'Salazar', 'Antonio', 'Emilio', '09631234567', 'antonio.salazar@example.com', 'Vendor', 'active', '2025-05-08 21:16:27'),
(21, 'Bautista', 'Leo', 'Christopher', 'male', 'General Santos', 'leo.bautista@example.com', '2004-02-28', '133 Lilac St', 'General Santos', 'South Cotabato', '9500', 'Bautista', 'Simon', 'Rene', '09741234567', 'simon.bautista@example.com', 'Farmer', 'active', '2025-05-08 21:16:27'),
(22, 'Dela Peña', 'Camille', 'Joy', 'female', 'Lucena City', 'camille.delapena@example.com', '2006-11-09', '144 Rosewood St', 'Lucena City', 'Quezon', '4301', 'Dela Peña', 'Arnold', 'Tomas', '09851234567', 'arnold.delapena@example.com', 'Fisherman', 'active', '2025-05-08 21:16:27'),
(23, 'Castro', 'Nathan', 'James', 'male', 'San Pablo City', 'nathan.castro@example.com', '2005-09-16', '155 Poplar St', 'San Pablo City', 'Laguna', '4000', 'Castro', 'Vicente', 'Raul', '09961234567', 'vicente.castro@example.com', 'Clerk', 'active', '2025-05-08 21:16:27'),
(24, 'Flores', 'Samantha', 'Faith', 'female', 'Calamba City', 'samantha.flores@example.com', '2004-07-01', '166 Chestnut St', 'Calamba City', 'Laguna', '4027', 'Flores', 'Eduardo', 'Silvestre', '09101324567', 'eduardo.flores@example.com', 'Dentist', 'active', '2025-05-08 21:16:27'),
(25, 'Mendoza', 'Zachary', 'Luke', 'male', 'Olongapo City', 'zachary.mendoza@example.com', '2006-12-21', '177 Willow St', 'Olongapo City', 'Zambales', '2200', 'Mendoza', 'Gerardo', 'Vicente', '09211324567', 'gerardo.mendoza@example.com', 'Plumber', 'active', '2025-05-08 21:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `age`, `subject`, `grade`, `image`, `status`) VALUES
(1, 'Maria Paz Yanga', 42, 'English', '3', '40513332_2234230923465682_571622591903563776_n.jpg', 1),
(3, 'Hannah Balite', 20, 'Kalokohan', '6', '482359136_18495747814053759_3741163903719696166_n.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `parentSurname` varchar(255) NOT NULL,
  `parentFirst` varchar(255) NOT NULL,
  `parentMiddle` varchar(255) DEFAULT NULL,
  `parentPhone` varchar(15) NOT NULL,
  `parentEmail` varchar(255) NOT NULL,
  `parentOccupation` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `surname`, `firstname`, `middlename`, `gender`, `birthplace`, `email`, `dob`, `street`, `city`, `province`, `zipcode`, `parentSurname`, `parentFirst`, `parentMiddle`, `parentPhone`, `parentEmail`, `parentOccupation`, `grade`, `status`, `created_at`) VALUES
(1, 'Garcia', 'Liam', 'Reyes', 'Male', 'Manila', 'liam.garcia@email.com', '2015-03-12', '123 Sampaguita St', 'Quezon City', 'Metro Manila', '1101', 'Garcia', 'Ana', 'Lopez', '09171234567', 'ana.garcia@email.com', 'Teacher', '1', 'active', '2025-05-08 00:00:00'),
(2, 'Santos', 'Mia', 'Torres', 'Female', 'Cebu City', 'mia.santos@email.com', '2012-08-25', '45 Mango Ave', 'Cebu City', 'Cebu', '6000', 'Santos', 'Carlos', 'Dela Cruz', '09179876543', 'carlos.santos@email.com', 'Engineer', '4', 'active', '2025-05-08 00:00:00'),
(3, 'Rivera', 'Noah', 'Cruz', 'Male', 'Davao City', 'noah.rivera@email.com', '2012-11-10', '678 Jacinto St', 'Davao City', 'Davao del Sur', '8000', 'Rivera', 'Jenna', 'Aquino', '09173456789', 'jenna.rivera@email.com', 'Nurse', '4', 'active', '2025-05-08 00:00:00'),
(4, 'Delos Santos', 'Ella', 'Mendoza', 'Female', 'Baguio', 'ella.delossantos@email.com', '2011-06-30', '9 Pine Rd', 'Baguio City', 'Benguet', '2600', 'Delos Santos', 'Marco', 'Villanueva', '09172345678', 'marco.delossantos@email.com', 'Doctor', '5', 'active', '2025-05-08 00:00:00'),
(5, 'Cruz', 'Lucas', 'Navarro', 'Male', 'Iloilo City', 'lucas.cruz@email.com', '2013-02-14', '100 Mabini St', 'Iloilo City', 'Iloilo', '5000', 'Cruz', 'Melissa', 'Reyes', '09176543210', 'melissa.cruz@email.com', 'Accountant', '3', 'active', '2025-05-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') DEFAULT 'student',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin', 'admin', '2025-05-02 06:46:34'),
(2, 'Anne', 'anne9ramos@gmail.com', 'password', '', '2025-05-02 07:07:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE news ADD COLUMN image VARCHAR(255) DEFAULT NULL;

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    description TEXT,
    link VARCHAR(255) DEFAULT NULL
);

INSERT INTO events (title, image, description, link) VALUES
('Halloween Party', 'images/halloween.jpg', 'The Halloween celebration was a hit, featuring fun activities, creative costumes, and plenty of treats for everyone.', 'gallery.php'),
('Wikang Katutubo Day', 'images/Wikatu.jpg', 'Wikang Katutubo Day was successfully celebrated, highlighting the importance of preserving indigenous languages in the Philippines.', 'gallery.php');


CREATE TABLE main_news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(100) NOT NULL, -- e.g. 'Buwan ng Wika'
    image VARCHAR(255) NOT NULL,
    caption VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE faculty (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image VARCHAR(255) NOT NULL
);

CREATE TABLE about_mission_vision (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('mission','vision') NOT NULL,
    content TEXT NOT NULL
);

CREATE TABLE about_calendar_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    description TEXT
);

INSERT INTO about_mission_vision (type, content) VALUES
('mission', 'To provide quality education and develop strong ethical values.'),
('vision', 'To create a community of learners who are empowered to make positive changes in society.');

INSERT INTO about_calendar_events (title, event_date, description) VALUES
('Opening of Classes', '2025-06-10', 'First day of school year 2025-2026'),
('Foundation Day', '2025-08-15', 'School Foundation Day Celebration');

UPDATE contactus SET status = 'Pending' WHERE status != 'Replied';