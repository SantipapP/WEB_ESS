-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 07:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ess_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_amount`
--

CREATE TABLE `tbl_amount` (
  `id` int(10) NOT NULL,
  `am_hardware` text NOT NULL,
  `am_in` int(10) NOT NULL,
  `am_out` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_board`
--

CREATE TABLE `tbl_board` (
  `boa_id` int(10) NOT NULL,
  `boa_title` varchar(255) NOT NULL,
  `boa_description` text NOT NULL,
  `boa_emp` varchar(255) NOT NULL,
  `boa_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(255) DEFAULT NULL,
  `comp_address` varchar(255) DEFAULT NULL,
  `comp_tel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`comp_id`, `comp_name`, `comp_address`, `comp_tel`) VALUES
(1, 'บริษัท อีเอสพาวเวอร์ คอร์ปอเรชั่น จำกัด', '138/95 หมู่ที่2 ตำบลบ้านกลาง อำเภอเมืองปทุมธานี\r\n จังหวัดปทุมธานี 12000', '+66 2 581 1124-5'),
(2, 'บริษัท อีเอสพี เทคโนโลยี่ จำกัด', '138/79 หมู่ที่2 ตำบลบ้านกลาง อำเภอเมืองปทุมธานี\r\n จังหวัดปทุมธานี 12000', '+66(0)21475048-9');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `de_id` varchar(255) NOT NULL,
  `de_company` varchar(255) NOT NULL,
  `de_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`de_id`, `de_company`, `de_name`) VALUES
('000', 'ArtLongDev', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_device`
--

CREATE TABLE `tbl_device` (
  `dev_id` int(11) NOT NULL,
  `dev_company` varchar(255) DEFAULT NULL,
  `dev_brand` varchar(255) DEFAULT NULL,
  `dev_type` varchar(255) DEFAULT NULL,
  `dev_model` varchar(255) DEFAULT NULL,
  `dev_assetcode` varchar(255) DEFAULT NULL,
  `dev_sn` varchar(255) DEFAULT NULL,
  `dev_department` varchar(255) DEFAULT NULL,
  `dev_user` varchar(255) DEFAULT NULL,
  `dev_pic` varchar(255) DEFAULT NULL,
  `dev_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp`
--

CREATE TABLE `tbl_emp` (
  `emp_id` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_company` varchar(255) NOT NULL,
  `emp_department` varchar(255) NOT NULL,
  `emp_position` varchar(255) NOT NULL,
  `emp_department2` varchar(255) NOT NULL,
  `emp_position2` varchar(255) NOT NULL,
  `emp_department3` varchar(255) NOT NULL,
  `emp_position3` varchar(255) NOT NULL,
  `emp_tel` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_password` varchar(255) NOT NULL,
  `emp_annaul` int(11) NOT NULL,
  `emp_annaul_time` int(10) NOT NULL,
  `emp_leave` int(11) NOT NULL,
  `emp_leave_time` int(10) NOT NULL,
  `emp_sick` int(11) NOT NULL,
  `emp_sick_time` int(10) NOT NULL,
  `emp_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_emp`
--

INSERT INTO `tbl_emp` (`emp_id`, `emp_name`, `emp_company`, `emp_department`, `emp_position`, `emp_department2`, `emp_position2`, `emp_department3`, `emp_position3`, `emp_tel`, `emp_email`, `emp_password`, `emp_annaul`, `emp_annaul_time`, `emp_leave`, `emp_leave_time`, `emp_sick`, `emp_sick_time`, `emp_level`) VALUES
('admin', 'Administrator', 'ArtLongDev', '000', 'Manager', '', '', '', '', '', '', '285002', 0, 0, 0, 0, 0, 0, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_external_company`
--

CREATE TABLE `tbl_external_company` (
  `ec_id` varchar(255) NOT NULL,
  `ec_name` varchar(255) NOT NULL,
  `ec_address` varchar(255) NOT NULL,
  `ec_tel` varchar(255) NOT NULL,
  `ec_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hardware`
--

CREATE TABLE `tbl_hardware` (
  `hw_id` int(10) NOT NULL,
  `hw_name` varchar(255) NOT NULL,
  `hw_department` varchar(255) NOT NULL,
  `hw_regisdate` varchar(255) NOT NULL,
  `hw_regisemp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hw_in`
--

CREATE TABLE `tbl_hw_in` (
  `hw_in_id` int(10) NOT NULL,
  `hw_in_date` varchar(255) NOT NULL,
  `hw_in_name` varchar(255) NOT NULL,
  `hw_in_amount` int(10) NOT NULL,
  `hw_in_pr` text NOT NULL,
  `hw_in_supplier` text NOT NULL,
  `hw_in_emp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hw_out`
--

CREATE TABLE `tbl_hw_out` (
  `hw_out_id` int(10) NOT NULL,
  `hw_out_date` varchar(255) NOT NULL,
  `hw_out_rdate` varchar(255) NOT NULL,
  `hw_out_name` varchar(255) NOT NULL,
  `hw_out_amount` int(10) NOT NULL,
  `hw_out_emp` varchar(255) NOT NULL,
  `hw_out_department` varchar(255) NOT NULL,
  `hw_out_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_day`
--

CREATE TABLE `tbl_leave_day` (
  `id` int(11) NOT NULL,
  `lev_empid` varchar(255) NOT NULL,
  `lev_emp` varchar(255) NOT NULL,
  `lev_departmentid` varchar(255) NOT NULL,
  `lev_department` varchar(255) NOT NULL,
  `lev_position` varchar(255) NOT NULL,
  `lev_type` varchar(255) NOT NULL,
  `lev_stime` text NOT NULL,
  `lev_etime` text NOT NULL,
  `lev_amount_day` int(11) NOT NULL,
  `lev_amount_time` int(11) NOT NULL,
  `lev_objective` varchar(255) NOT NULL,
  `lev_file` varchar(255) NOT NULL,
  `lev_approve` varchar(255) NOT NULL,
  `lev_note` varchar(255) NOT NULL,
  `lev_note2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave_day`
--

INSERT INTO `tbl_leave_day` (`id`, `lev_empid`, `lev_emp`, `lev_departmentid`, `lev_department`, `lev_position`, `lev_type`, `lev_stime`, `lev_etime`, `lev_amount_day`, `lev_amount_time`, `lev_objective`, `lev_file`, `lev_approve`, `lev_note`, `lev_note2`) VALUES
(1, 'admin', 'Administrator', '000', 'IT', 'Manager', 'ลาพักร้อน', '2023-03-27 08:00', '2023-03-27 17:00', 1, 0, 'test', '0', '', '', '08:00-17:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_license`
--

CREATE TABLE `tbl_license` (
  `lic_id` int(11) NOT NULL,
  `lic_program` varchar(255) DEFAULT NULL,
  `lic_key` varchar(255) DEFAULT NULL,
  `lic_status` varchar(255) DEFAULT NULL,
  `lic_device` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `lo_id` varchar(255) NOT NULL,
  `lo_name` varchar(255) NOT NULL,
  `lo_intendant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id` int(10) NOT NULL,
  `log_date` varchar(255) NOT NULL,
  `log_des` varchar(255) NOT NULL,
  `log_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`id`, `log_date`, `log_des`, `log_ip`) VALUES
(1, '2023-Mar-26', 'เพิ่มแผนกโดย : Administrator', 'DESKTOP-LMU6EOH');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ot_request`
--

CREATE TABLE `tbl_ot_request` (
  `ot_re_id` int(11) NOT NULL,
  `ot_re_date` date NOT NULL,
  `ot_re_start` varchar(255) NOT NULL,
  `ot_re_end` varchar(255) NOT NULL,
  `ot_re_time` int(255) NOT NULL,
  `ot_re_company` varchar(255) NOT NULL,
  `ot_re_department` varchar(255) NOT NULL,
  `ot_re_desciption` varchar(255) NOT NULL,
  `ot_re_price` varchar(255) NOT NULL,
  `ot_re_po` varchar(255) NOT NULL,
  `ot_re_emp` varchar(255) NOT NULL,
  `ot_re_approve` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_to_work`
--

CREATE TABLE `tbl_request_to_work` (
  `rtw_id` varchar(255) NOT NULL,
  `rtw_company` varchar(255) NOT NULL,
  `rtw_date` varchar(255) NOT NULL,
  `rtw_informent` varchar(255) NOT NULL,
  `rtw_extcompany` varchar(255) NOT NULL,
  `rtw_job` varchar(255) NOT NULL,
  `rtw_location` varchar(255) NOT NULL,
  `rtw_sdate` varchar(255) NOT NULL,
  `rtw_edate` varchar(255) NOT NULL,
  `rtw_time` varchar(255) NOT NULL,
  `rtw_amount` varchar(255) NOT NULL,
  `rtw_male` varchar(255) NOT NULL,
  `rtw_female` varchar(255) NOT NULL,
  `rtw_tool` varchar(255) NOT NULL,
  `rtw_car` varchar(255) NOT NULL,
  `rtw_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitor`
--

CREATE TABLE `tbl_visitor` (
  `id` int(10) NOT NULL,
  `vi_doc` varchar(255) NOT NULL,
  `vi_name` varchar(255) NOT NULL,
  `vi_company` varchar(255) NOT NULL,
  `vi_location` varchar(255) NOT NULL,
  `vi_sdate` varchar(255) NOT NULL,
  `vi_edate` varchar(255) NOT NULL,
  `vi_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_amount`
--
ALTER TABLE `tbl_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_board`
--
ALTER TABLE `tbl_board`
  ADD PRIMARY KEY (`boa_id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`de_id`),
  ADD KEY `de_name` (`de_name`);

--
-- Indexes for table `tbl_device`
--
ALTER TABLE `tbl_device`
  ADD PRIMARY KEY (`dev_id`),
  ADD KEY `dev_assetcode` (`dev_assetcode`),
  ADD KEY `department` (`dev_department`),
  ADD KEY `user` (`dev_user`);

--
-- Indexes for table `tbl_emp`
--
ALTER TABLE `tbl_emp`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `emp_name` (`emp_name`);

--
-- Indexes for table `tbl_external_company`
--
ALTER TABLE `tbl_external_company`
  ADD PRIMARY KEY (`ec_id`);

--
-- Indexes for table `tbl_hardware`
--
ALTER TABLE `tbl_hardware`
  ADD PRIMARY KEY (`hw_id`);

--
-- Indexes for table `tbl_hw_in`
--
ALTER TABLE `tbl_hw_in`
  ADD PRIMARY KEY (`hw_in_id`);

--
-- Indexes for table `tbl_hw_out`
--
ALTER TABLE `tbl_hw_out`
  ADD PRIMARY KEY (`hw_out_id`);

--
-- Indexes for table `tbl_leave_day`
--
ALTER TABLE `tbl_leave_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_license`
--
ALTER TABLE `tbl_license`
  ADD PRIMARY KEY (`lic_id`),
  ADD KEY `tbl_license_ibfk_1` (`lic_device`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`lo_id`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ot_request`
--
ALTER TABLE `tbl_ot_request`
  ADD PRIMARY KEY (`ot_re_id`);

--
-- Indexes for table `tbl_request_to_work`
--
ALTER TABLE `tbl_request_to_work`
  ADD PRIMARY KEY (`rtw_id`);

--
-- Indexes for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_amount`
--
ALTER TABLE `tbl_amount`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_board`
--
ALTER TABLE `tbl_board`
  MODIFY `boa_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_device`
--
ALTER TABLE `tbl_device`
  MODIFY `dev_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hardware`
--
ALTER TABLE `tbl_hardware`
  MODIFY `hw_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hw_in`
--
ALTER TABLE `tbl_hw_in`
  MODIFY `hw_in_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hw_out`
--
ALTER TABLE `tbl_hw_out`
  MODIFY `hw_out_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_leave_day`
--
ALTER TABLE `tbl_leave_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_license`
--
ALTER TABLE `tbl_license`
  MODIFY `lic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_ot_request`
--
ALTER TABLE `tbl_ot_request`
  MODIFY `ot_re_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
