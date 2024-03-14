-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 04:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro_webdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `การจัดส่ง`
--

CREATE TABLE `การจัดส่ง` (
  `หมายเลขการจัดส่ง` varchar(16) NOT NULL,
  `ID_admin` char(16) NOT NULL,
  `สถานะการจัดส่ง` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `การจัดส่ง`
--

INSERT INTO `การจัดส่ง` (`หมายเลขการจัดส่ง`, `ID_admin`, `สถานะการจัดส่ง`) VALUES
('NO9523C895K', 'EM001', 'จัดส่งเรียบร้อย'),
('NR8975J634B', 'EM003', 'รอการจัดส่ง'),
('SU3692Y875N', 'EM002', 'จัดส่งเรียบร้อย'),
('TH1563K698L', 'EM007', 'รอการจัดส่ง'),
('TR8546W964P', 'EM008', 'จัดส่งเรียบร้อย');

-- --------------------------------------------------------

--
-- Table structure for table `การสั่งออเดอร์`
--

CREATE TABLE `การสั่งออเดอร์` (
  `อันดับออเดอร์` int(11) NOT NULL,
  `หมายเลขออเดอร์` varchar(16) NOT NULL,
  `username` varchar(16) NOT NULL,
  `รหัสขนม` varchar(16) NOT NULL,
  `จำนวนชิ้น` int(11) NOT NULL,
  `วันที่สั่งOrder` date NOT NULL,
  `วันที่รับขนม` date NOT NULL,
  `ประเภทการชำระเงิน` varchar(20) NOT NULL,
  `หมายเลขการจัดส่ง` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `การสั่งออเดอร์`
--

INSERT INTO `การสั่งออเดอร์` (`อันดับออเดอร์`, `หมายเลขออเดอร์`, `username`, `รหัสขนม`, `จำนวนชิ้น`, `วันที่สั่งOrder`, `วันที่รับขนม`, `ประเภทการชำระเงิน`, `หมายเลขการจัดส่ง`) VALUES
(1, 'OD001', 'Sommai21', 'C13', 3, '2022-01-07', '2022-01-14', 'บัตรเครดิต/เดบิต', 'NO9523C895K'),
(1, 'OD001', 'Sommai21', 'CK01', 4, '2022-01-07', '2022-01-14', 'บัตรเครดิต/เดบิต', 'NO9523C895K'),
(1, 'OD001', 'Sommai21', 'P04', 5, '2022-01-07', '2022-01-14', 'บัตรเครดิต/เดบิต', 'NO9523C895K'),
(2, 'OD002', 'somphong06', 'C01', 5, '2022-01-13', '2022-01-26', 'Prompt pay', 'NR8975J634B'),
(2, 'OD002', 'somphong06', 'C12', 2, '2022-01-13', '2022-01-26', 'Prompt pay', 'NR8975J634B'),
(3, 'OD003', 'Somjaii', 'C02', 1, '2022-01-17', '2022-01-29', 'บัตรเครดิต/เดบิต', 'SU3692Y875N'),
(4, 'OD004', 'Somjit888', 'CK02', 5, '2022-02-04', '2022-02-26', 'บัตรเครดิต/เดบิต', 'TR8546W964P'),
(4, 'OD004', 'Somjit888', 'S01', 1, '2022-02-04', '2022-02-26', 'บัตรเครดิต/เดบิต', 'TR8546W964P'),
(5, 'OD005', 'Somsakkub', 'C01', 8, '2022-02-20', '2022-03-01', 'Internet Banking', 'TH1563K698L'),
(5, 'OD005', 'Somsakkub', 'CK01', 10, '2022-02-20', '2022-03-01', 'Internet Banking', 'TH1563K698L'),
(6, 'OD006', 'Sommai21', 'C02', 2, '2022-02-24', '2022-03-01', 'Prompt pay', 'NT8485C145A');

-- --------------------------------------------------------

--
-- Table structure for table `การแก้ไขขนม`
--

CREATE TABLE `การแก้ไขขนม` (
  `ID_admin` char(16) NOT NULL,
  `รหัสขนม` varchar(10) NOT NULL,
  `วันที่แก้ไข` date NOT NULL,
  `เวลาที่แก้ไข` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `การแก้ไขขนม`
--

INSERT INTO `การแก้ไขขนม` (`ID_admin`, `รหัสขนม`, `วันที่แก้ไข`, `เวลาที่แก้ไข`) VALUES
('EM009', 'P01', '2022-08-19', '13:22:00'),
('EM001', 'C12', '2022-09-13', '12:21:00'),
('EM009', 'C01', '2022-09-15', '08:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `ขนม`
--

CREATE TABLE `ขนม` (
  `รหัสขนม` varchar(16) NOT NULL,
  `ชื่อขนม` char(35) NOT NULL,
  `ราคาขนม` int(10) NOT NULL,
  `ชนิดขนม` char(20) NOT NULL,
  `ประเภทตามเทศกาล` char(20) NOT NULL,
  `สถานะ` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ขนม`
--

INSERT INTO `ขนม` (`รหัสขนม`, `ชื่อขนม`, `ราคาขนม`, `ชนิดขนม`, `ประเภทตามเทศกาล`, `สถานะ`) VALUES
('C01', 'เค้กหน้านิ่มรสช็อกโกแลต', 20, 'เค้ก', 'ทั่วไป', 'เปิด'),
('C02', 'เค้กหน้านิ่มรสส้ม', 20, 'เค้ก', 'ทั่วไป', 'เปิด'),
('C11', 'เค้กฉลองวันคริสต์มาส', 250, 'เค้ก', 'คริสต์มาส', 'เปิด'),
('C12', 'เค้กวันเกิดรสช็อกโกแลต', 250, 'เค้ก', 'วันเกิด', 'เปิด'),
('C13', 'เค้กวันเกิดรสส้ม', 250, 'เค้ก', 'วันเกิด', 'เปิด'),
('CK01', 'คุกกี้รสช็อกโกแลต', 30, 'คุกกี้', 'ทั่วไป', 'เปิด'),
('CK02', 'คุกกี้รสวนิลลา', 30, 'คุกกี้', 'ทั่วไป', 'เปิด'),
('K01', 'ขนมปังเนยสด', 100, 'ขนมปัง', 'ทั่วไป', 'เปิด'),
('P01', 'พายข้าวโพด', 50, 'พาย', 'ทั่วไป', 'เปิด'),
('P02', 'บลูเบอร์รี่ชีสพาย', 65, 'พาย', 'ทั่วไป', 'เปิด'),
('P03', 'สตอเบอรี่ชีสพาย', 65, 'พาย', 'ทั่วไป', 'เปิด'),
('P04', 'แอปเปิ้ลพาย', 65, 'พาย', 'ทั่วไป', 'เปิด'),
('P11', 'พายสับปะรดฉลองปีใหม่', 50, 'พาย', 'ปีใหม่', 'เปิด'),
('S01', 'ซาวเวอร์โด', 100, 'ขนมปัง', 'ทั่วไป', 'เปิด');

-- --------------------------------------------------------

--
-- Table structure for table `พนักงาน`
--

CREATE TABLE `พนักงาน` (
  `ID_admin` char(16) NOT NULL,
  `am_username` varchar(16) NOT NULL,
  `am_password` char(16) NOT NULL,
  `ชื่อพนักงาน` char(20) NOT NULL,
  `เบอร์พนักงาน` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `พนักงาน`
--

INSERT INTO `พนักงาน` (`ID_admin`, `am_username`, `am_password`, `ชื่อพนักงาน`, `เบอร์พนักงาน`) VALUES
('EM001', 'kammji', 'kam228', 'เขมจิรา', '095-8296228'),
('EM002', 'adkamji20', 'kam_jira20', 'เขมจิรา', '083-9915322'),
('EM003', 'ya_ying21', 'ying_yathida', 'ญาธิดา', '080-9469226'),
('EM004', 'pploy_na', 'nariployy', 'นารีวรรณ', '095-8261622'),
('EM005', 'naigab_chok', 'palitchok_gab', 'ผลิตโชค', '082-6394233'),
('EM006', 'somsriii', 'somsrii1980', 'สมศรี', '082-5565223'),
('EM007', 'yingcher_', 'som_cher20', 'เฌอมณี', '082-6392682'),
('EM008', 'sommsrii_90', 'sriingai_652', 'สมศรี', '081-4699652'),
('EM009', 'tthanthabook', 'bookthanya', 'ธัญธร', '083-7926963'),
('EM010', 'sommai_123', 'sommai878', 'สมหมาย', '083-4529878');

-- --------------------------------------------------------

--
-- Table structure for table `ลูกค้า`
--

CREATE TABLE `ลูกค้า` (
  `username` varchar(16) NOT NULL,
  `password` char(16) NOT NULL,
  `ชื่อลูกค้า` char(20) NOT NULL,
  `เบอร์ลูกค้า` varchar(11) NOT NULL,
  `ที่อยู่ลูกค้า` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ลูกค้า`
--

INSERT INTO `ลูกค้า` (`username`, `password`, `ชื่อลูกค้า`, `เบอร์ลูกค้า`, `ที่อยู่ลูกค้า`) VALUES
('Jejeee', '555555', 'ศิริขวัญ', '095-6643446', '35/33 เมือง เมือง นนทบุรี'),
('pongg2503', '000000', 'สมพงศ์', '084-6005354', '316/9 หมู่ 8 ถ.ประชาอุทิศราษฎร์บูรณะ เขตราษฎร์บูรณะ จ.กรุงเทพฯ 10140'),
('Somchai05', '666666', 'สมชาย', '084-0301405', '333 ถ.สมเด็จเจ้าพระเจ้าตากสิน เขตธนบุรี จ.กรุงเทพฯ 10600'),
('Somjaii', '888888', 'สมใจ', '092-5937110', '1379 ถ.จันทน์ แขวงทุ่งวัดดอน เขตสาธร จ.กรุงเทพฯ 10120'),
('Somjit888', '444444', 'สมจิต', '091-2124888', '87 ถ.สุขุมวิท ต.ปากน้ำ อ.เมือง จ.สมุทรปราการ 10270'),
('Sommai21', '11111', 'สมหมาย', '088-2710921', '49/2 หมู่ 4 ถ.ปิ่นเกล้า-นครชัยศรีเขตตลิ่งชัน จ.กรุงเทพฯ 10170'),
('Sommainaja', '555555', 'สมหมาย', '085-4515546', '123/165 หมู่ 3 ถ.เอกชัยบางขุนเทียน เขตจอมทอง จ.กรุงเทพฯ 10150'),
('somphong06', '222222', 'สมปอง', '087-6150600', '88 หมู่ 3 ถ.แจ้งวัฒนะ ทุ่งสองห้อง เขตหลักสี่ จ.กรุงเทพฯ 10210'),
('Somsakkub', '999999', 'สมศักดิ์', '083-3335551', '91 หมู่ 4 ต.บางไทร อ.บางไทร จ.พระนครศรีอยุธยา 13190'),
('Somsrieiei', '333333', 'สมศรี', '088-4150100', '2020 ถ.อ่อนนุช แขวงสวนหลวง เขตสวนหลวง จ.กรุงเทพฯ 10250'),
('yingsuay88', '777777', 'สมหญิง', '095-6689229', '53 หมู่ 5 ต.ไทรน้อย อ.ไทรน้อย จ.นนทบุรี 11150');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `การจัดส่ง`
--
ALTER TABLE `การจัดส่ง`
  ADD PRIMARY KEY (`หมายเลขการจัดส่ง`);

--
-- Indexes for table `การสั่งออเดอร์`
--
ALTER TABLE `การสั่งออเดอร์`
  ADD PRIMARY KEY (`หมายเลขออเดอร์`,`รหัสขนม`) USING BTREE;

--
-- Indexes for table `การแก้ไขขนม`
--
ALTER TABLE `การแก้ไขขนม`
  ADD PRIMARY KEY (`วันที่แก้ไข`,`เวลาที่แก้ไข`) USING BTREE;

--
-- Indexes for table `ขนม`
--
ALTER TABLE `ขนม`
  ADD PRIMARY KEY (`รหัสขนม`);

--
-- Indexes for table `พนักงาน`
--
ALTER TABLE `พนักงาน`
  ADD PRIMARY KEY (`ID_admin`);

--
-- Indexes for table `ลูกค้า`
--
ALTER TABLE `ลูกค้า`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
