-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 23, 2020 lúc 04:44 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_healthcare`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'adminnguyen');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `appointment`
--

CREATE TABLE `appointment` (
  `appId` int(3) NOT NULL,
  `patientIc` int(11) NOT NULL,
  `scheduleId` int(10) NOT NULL,
  `appSymptom` varchar(100) NOT NULL,
  `appComment` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doctor`
--

CREATE TABLE `doctor` (
  `icDoctor` int(11) NOT NULL,
  `password` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `doctorFirstName` varchar(50) NOT NULL,
  `doctorLastName` varchar(50) NOT NULL,
  `doctorSpecialist` int(11) DEFAULT NULL,
  `doctorAddress` varchar(100) NOT NULL,
  `doctorPhone` varchar(15) NOT NULL,
  `doctorEmail` varchar(200) NOT NULL,
  `doctorDOB` date NOT NULL,
  `doctorImg` varchar(255) NOT NULL,
  `doctorSocial` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doctorschedule`
--

CREATE TABLE `doctorschedule` (
  `scheduleId` int(11) NOT NULL,
  `icDoctor` int(11) NOT NULL,
  `scheduleDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `bookAvail` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `patient`
--

CREATE TABLE `patient` (
  `icPatient` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `patientFirstName` varchar(250) NOT NULL,
  `patientLastName` varchar(250) NOT NULL,
  `patientMaritialStatus` varchar(10) NOT NULL,
  `patientDOB` date NOT NULL,
  `patientGender` varchar(10) NOT NULL,
  `patientAddress` varchar(250) NOT NULL,
  `patientPhone` varchar(15) NOT NULL,
  `patientEmail` varchar(100) NOT NULL,
  `patientImg` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `postID` int(11) NOT NULL,
  `postTitle` varchar(200) NOT NULL,
  `postBody` longtext NOT NULL,
  `postImg` varchar(250) NOT NULL,
  `postCreate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`postID`, `postTitle`, `postBody`, `postImg`, `postCreate`) VALUES
(21, 'Thông báo!!', '<p>He thong da duoc dua vao su dung</p>\r\n', 'FoD.gif', '2020-12-22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `specialist`
--

CREATE TABLE `specialist` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appId`),
  ADD UNIQUE KEY `scheduleId_2` (`scheduleId`),
  ADD KEY `scheduleId` (`scheduleId`),
  ADD KEY `patientIc` (`patientIc`);

--
-- Chỉ mục cho bảng `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`icDoctor`),
  ADD KEY `doctorSpecialist` (`doctorSpecialist`);

--
-- Chỉ mục cho bảng `doctorschedule`
--
ALTER TABLE `doctorschedule`
  ADD PRIMARY KEY (`scheduleId`),
  ADD KEY `icDoctor` (`icDoctor`);

--
-- Chỉ mục cho bảng `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`icPatient`) USING BTREE;

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postID`);

--
-- Chỉ mục cho bảng `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `doctor`
--
ALTER TABLE `doctor`
  MODIFY `icDoctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `doctorschedule`
--
ALTER TABLE `doctorschedule`
  MODIFY `scheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT cho bảng `patient`
--
ALTER TABLE `patient`
  MODIFY `icPatient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `specialist`
--
ALTER TABLE `specialist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_5` FOREIGN KEY (`scheduleId`) REFERENCES `doctorschedule` (`scheduleId`),
  ADD CONSTRAINT `appointment_ibfk_6` FOREIGN KEY (`patientIc`) REFERENCES `patient` (`icPatient`);

--
-- Các ràng buộc cho bảng `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`doctorSpecialist`) REFERENCES `specialist` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `doctorschedule`
--
ALTER TABLE `doctorschedule`
  ADD CONSTRAINT `doctorschedule_ibfk_1` FOREIGN KEY (`icDoctor`) REFERENCES `doctor` (`icDoctor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
