-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2022 at 03:18 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scraper`
--

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data` varchar(255) NOT NULL,
  `attempt` int(255) NOT NULL,
  `error` varchar(255) NOT NULL,
  `upload_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `type`, `status`, `created`, `data`, `attempt`, `error`, `upload_date`) VALUES
(8, '', '2', '2022-02-14 11:05:04', '36361222101', 0, '', '0000-00-00 00:00:00'),
(9, '', '3', '2022-02-14 11:08:12', '36361222101', 0, '', '0000-00-00 00:00:00'),
(10, '', '3', '2022-02-14 11:09:17', '36361222101', 0, '', '0000-00-00 00:00:00'),
(11, '', '2', '2022-02-14 11:10:24', '36361222101', 0, '', '0000-00-00 00:00:00'),
(12, '', '2', '2022-02-14 11:10:24', '1343545', 0, '', '0000-00-00 00:00:00'),
(13, '', '2', '2022-02-14 11:10:24', '13242', 0, '', '0000-00-00 00:00:00'),
(14, '', '2', '2022-02-14 12:48:13', '36361222101', 0, '', '0000-00-00 00:00:00'),
(15, '', '2', '2022-02-14 12:48:13', '1343545', 0, '', '0000-00-00 00:00:00'),
(16, '', '2', '2022-02-14 12:48:13', '13242', 0, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `scraped`
--

CREATE TABLE `scraped` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `model_no` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `discounted_price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scraped`
--

INSERT INTO `scraped` (`id`, `title`, `model_no`, `part_no`, `description`, `price`, `discounted_price`, `image`, `status`) VALUES
(682, 'Evaporator Fan Motor Assembly', '36361222101', ' WR60X10300', '                                                                                              This evaporator fan motor is located in the back of the freezer, and circulates air over the refrigerator coils. These coils will convert the heat into cool air,', '159', '111.087', 'https://partselectca.azureedge.net//2359960-1-S-GE-WR60X10300-Evaporator-Fan-Motor-Assembly.jpg', 'Pending'),
(683, 'Fan Motor Grommet', '36361222101', ' WR02X10520', '                                                                    Can be used with the evaporator or condenser fan motor.                                                                                      ', '9', '6.234', 'https://partselectca.azureedge.net//284959-1-S-GE-WR02X10520-Fan-Motor-Grommet.jpg', 'Pending'),
(684, 'Defrost Timer', '36361222101', ' WR9X483', '                                                                                              This refrigerator defrost timer will cycle for thirty minutes after every ten hours of run time.                                                                 ', '100', '69.934', 'https://partselectca.azureedge.net//310852-1-S-GE-WR9X483-Defrost-Timer.jpg', 'Pending'),
(685, 'Door Shelf Retainer Bar End Cap', '36361222101', ' WR2X5795', '                                                                    This is the replacement door shelf retainer bar end cap for your refrigerator. An end cap connects to the lower shelf bar on either side, and then snaps into position on the refrigerator ', '16', '11.056', 'https://partselectca.azureedge.net//298113-1-S-GE-WR2X5795-Door-Shelf-Retainer-Bar-End-Cap.jpg', 'Pending'),
(687, 'Light Socket', '36361222101', ' WR2X9391', '                                                                    This part is a replacement light socket for your refrigerator. It connects to the power source, and holds the light bulb. If the light in your refrigerator is not working, you could have ', '11', '7.64', 'https://partselectca.azureedge.net//299782-1-S-GE-WR2X9391-Light-Socket.jpg', 'Pending'),
(689, 'BRACKET EVAP FAN', '36361222101', ' WR2M3562', '                                                                                                                                                          ', '12', '8.391', 'https://partselectca.azureedge.net//assets/images/noimage_S.jpg', 'Pending'),
(692, 'Interlock Switch', 'GUD24ESMJ0WW', ' WD21X10261', '                                                                                              This part is a simple on/off mechanism that prohibits the appliance from operating when the door is open.                                                        ', '21', '14.631', 'https://partselectca.azureedge.net//1481922-1-S-GE-WD21X10261-Interlock-Switch.jpg', 'Pending'),
(694, 'Door Strike', 'GUD24ESMJ0WW', ' WE1X1192', '                                                                                              The door strike for your dryer is mounted on the dryer door. It fits into the door latch and keeps the door closed. If the door strike is damaged or missing, the', '7', '4.639', 'https://partselectca.azureedge.net//266893-1-S-GE-WE1X1192-Door-Strike.jpg', 'Pending'),
(695, 'Drum Glide Bearing - White', 'GUD24ESMJ0WW', ' WE3M51', '                                                                                                                                                          ', '7', '4.639', 'https://partselectca.azureedge.net//4704230-1-S-GE-WE3M51-Drum-Glide-Bearing-White.jpg', 'Pending'),
(696, 'Push-to-Start Switch', 'GUD24ESMJ0WW', ' WE4M416', '                                                                                              This switch is used to activate the dryer.                                                                                      ', '28', '19.375', 'https://partselectca.azureedge.net//3487190-1-S-GE-WE4M416-Push-to-Start-Switch.jpg', 'Pending'),
(697, 'Slide Bearing', 'GUD24ESMJ0WW', ' WE3M52', '                                                                    This OEM replacement dryer slide bearing is white in color, and approximately 3 inches long. The slide bearings are supportive linings for your dryer. If they have eroded, or are damaged,', '13', '8.962', 'https://partselectca.azureedge.net//3505464-1-S-GE-WE3M52-Slide-Bearing.jpg', 'Pending'),
(698, 'Direct Drive Water Pump', 'wp3363394', ' WP3363394', '                                                                                              This pump is intended for use with washing machines that do not have belts. This drain pump has two ports for water to pass through: a large one, and a smaller o', '49', '34.183', 'https://partselectca.azureedge.net//11741239-1-S--WP3363394-Direct-Drive-Water-Pump.jpg', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scraped`
--
ALTER TABLE `scraped`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `scraped`
--
ALTER TABLE `scraped`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=699;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
