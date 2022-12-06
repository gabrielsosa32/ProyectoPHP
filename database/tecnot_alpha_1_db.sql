-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2019 at 01:57 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecnot`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_titulo` varchar(256) NOT NULL,
  `project_subtitulo` varchar(256) NOT NULL,
  `project_resumen` text NOT NULL,
  `project_problematica` text NOT NULL,
  `project_interrogante` text NOT NULL,
  `project_objetivo` text NOT NULL,
  `project_solucion` text NOT NULL,
  `project_pruebayconclusion` text NOT NULL,
  `project_integrantes` text NOT NULL,
  `project_escuela` text NOT NULL,
  `project_comentarios` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_titulo`, `project_subtitulo`, `project_resumen`, `project_problematica`, `project_interrogante`, `project_objetivo`, `project_solucion`, `project_pruebayconclusion`, `project_integrantes`, `project_escuela`, `project_comentarios`) VALUES
(2, 'Proyecto1Urquiza', 'Proyecto1Urquiza', '                                                                Proyecto1Urquiza                                        ', '                                                                        Proyecto1Urquiza                                ', '                                                                                Proyecto1Urquiza                        ', '                                                                                Proyecto1Urquiza                        ', '                                                                                Proyecto1Urquiza                        ', '                                                                                Proyecto1Urquiza                        ', '                                                                                AlumnoUrquiza1           AlumnoUrquiza2             ', 'Urquiza', '                                                                                Proyecto1Urquiza                        '),
(3, 'Proyecto2Urquiza', 'Proyecto2Urquiza', '                                                    Proyecto2Urquiza', '                                                    Proyecto2Urquiza', '                                                    Proyecto2Urquiza', '                                                    Proyecto2Urquiza', '                                                    Proyecto2Urquiza', '                                                    Proyecto2Urquiza', '                                                    AlumnoUrquiza2', 'Urquiza', '                                                    Proyecto2Urquiza'),
(4, 'Proyecto1Belgrano', 'Proyecto1Belgrano', '                                                                                                                                        Proyecto1Belgrano                                                                        ', '                                                                                                                                        Proyecto1Belgrano                                                                        ', '                                                                                                                                        Proyecto1Belgrano                                                                        ', '                                                                                                                                        Proyecto1Belgrano                                                                        ', '                                                                                                                                        Proyecto1Belgrano                                                                        ', '                                                                                                                                        Proyecto1Belgrano                                                                        ', '                                                                                                                                        AlumnoBelgrano1                                                                        ', 'Belgrano', '                                                                                                                                        Proyecto1Belgrano         pepe                                                               ');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `request_tipo` varchar(256) NOT NULL,
  `request_solicitante` varchar(256) NOT NULL,
  `request_detalle` text NOT NULL,
  `request_estado` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL,
  `school_nombre` text NOT NULL,
  `school_direccion` text NOT NULL,
  `school_telefono` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_nombre`, `school_direccion`, `school_telefono`) VALUES
(1, 'Urquiza', 'La concha de tu madre', '547932'),
(2, 'Belgrano', 'La concha de tu hermana', 'Vaya uno a saber');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `user_escuela` varchar(255) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` char(3) DEFAULT '5',
  `user_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_status` char(3) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `user_escuela`, `password`, `role`, `user_created_at`, `user_status`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Belgrano', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '1', NULL, '1'),
(5, 'AlumnoUrquiza1', 'alumnourquiza1@gmail.com', 'Urquiza', '42d75c695f1520ef2aba2ad95836e5a69d8e3135f6b81ede1d72528e68b7d476', '5', '2019-11-28 20:19:59', '1'),
(6, 'AlumnoUrquiza2', 'alumnourquiza2@gmail.com', 'Urquiza', '71ca194d3c68480d959b787e25bfeb83cb337b895d34461be8b14c4d7cb09026', '5', '2019-11-28 20:20:26', '1'),
(7, 'AlumnoBelgrano1', 'alumnobelgrano1@gmail.com', 'Belgrano', '5b91bb45fcfeda1ecd7761e1ec8339857aef799af2aec3d252b5bf90a3ec73c5', '5', '2019-11-28 20:20:48', '1'),
(8, 'AlumnoBelgrano2', 'alumnobelgrano2@gmail.com', 'Belgrano', '4dd434def0ecddde6dd28f0c646b711f9439bf99ec74413a0c41828007bb9510', '5', '2019-11-28 20:21:16', '1'),
(9, 'ProfesorUrquiza1', 'profesorurquiza1@gmail.com', 'Urquiza', '3ffdcc894a11be207061786c3d1101fdbaedc784eed4a8114223de5797de9468', '4', '2019-11-28 20:21:52', '1'),
(10, 'ProfesorBelgrano1', 'profesorbelgrano1@gmail.com', 'Belgrano', '3a6021343c2c35e4b206a18ec4e776d42b2feebea4c9cfd28111d00910ad00bf', '4', '2019-11-28 20:22:20', '1'),
(11, 'DirectorUrquiza1', 'directorurquiza1@gmail.com', 'Urquiza', 'cdb95d710c409ffc5f17cd2f5f00d4d1357d175ef534109128ee1b4205657756', '3', '2019-11-28 20:24:18', '1'),
(12, 'DirectorBelgrano1', 'directorbelgrano1@gmail.com', 'Belgrano', '0ac9b8eb7e81e5008a714f59cf89af8cb5aab44c1d1c6b5692a6747257404034', '3', '2019-11-28 20:24:37', '1'),
(13, 'SupervisorUrquiza1', 'supervisorurquiza1@gmail.com', 'Urquiza', 'cfa8299ab82f7ec46a5a6d4258c598df43dae474ed32c9b79dd55370d13ae62d', '2', '2019-11-28 20:24:59', '1'),
(14, 'SupervisorBelgrano1', 'supervisorbelgrano1@gmail.com', 'Belgrano', '425d434b7413879c44bd173a14e39bb73e8cf9b5ccba50a54918dc1dc404e6d8', '2', '2019-11-28 20:25:20', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
