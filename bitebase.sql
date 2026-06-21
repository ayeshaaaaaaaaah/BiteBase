-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 02:14 PM
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
-- Database: `bitebase`
--

-- --------------------------------------------------------

--
-- Table structure for table `manager_auth`
--

CREATE TABLE `manager_auth` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager_auth`
--

INSERT INTO `manager_auth` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `restaurant_id`, `item_name`, `price`) VALUES
(1, 1, 'Chicken Karahi', 2400),
(2, 1, 'Mutton Karahi', 3600),
(3, 1, 'Garlic Naan', 200),
(4, 1, 'Raita', 150),
(5, 1, 'Salad', 120),
(6, 1, 'Butter Naan', 120),
(7, 1, 'Chicken Handi', 1900),
(8, 1, 'Seekh Kabab', 1200),
(9, 1, 'Daal Mash', 800),
(10, 1, 'Lassi', 250),
(11, 2, 'Mughlai Platter', 4500),
(12, 2, 'Reshmi Kabab', 1400),
(13, 2, 'Kulfi', 350),
(14, 2, 'Paneer Reshmi', 1100),
(15, 2, 'Mutton Chops', 2800),
(16, 2, 'Rice Bowl', 900),
(17, 2, 'Tandoori Chicken', 1500),
(18, 2, 'Mint Margarita', 450),
(19, 2, 'Hummus', 600),
(20, 2, 'Baklava', 800),
(21, 3, 'Chicken Tikka', 450),
(22, 3, 'Behari Kabab', 950),
(23, 3, 'Puri Paratha', 120),
(24, 3, 'Halwa', 400),
(25, 3, 'Chicken Boti', 800),
(26, 3, 'Fish Tikka', 1600),
(27, 3, 'Kabab Roll', 500),
(28, 3, 'Apple Juice', 350),
(29, 3, 'Special Tea', 150),
(30, 3, 'Gajar Halwa', 500),
(31, 4, 'Beef Steak', 3200),
(32, 4, 'Fettuccine Pasta', 1800),
(33, 4, 'Caesar Salad', 1200),
(34, 4, 'Margherita Pizza', 1600),
(35, 4, 'Grilled Chicken', 2100),
(36, 4, 'Prawns', 2500),
(37, 4, 'Mushroom Soup', 700),
(38, 4, 'Tiramisu', 900),
(39, 4, 'Espresso', 450),
(40, 4, 'Risotto', 1900),
(41, 5, 'Beef Nihari', 1100),
(42, 5, 'Nalli Nihari', 1500),
(43, 5, 'Maghaz', 800),
(44, 5, 'Khamiri Roti', 100),
(45, 5, 'Special Fry Nihari', 1300),
(46, 5, 'Brain Masala', 900),
(47, 5, 'Yogurt', 100),
(48, 5, 'Mixed Pickle', 50),
(49, 5, 'Lassi Sweet', 200),
(50, 5, 'Green Tea', 80),
(51, 6, 'Pad Thai', 1650),
(52, 6, 'Dynamite Prawns', 1300),
(53, 6, 'Chicken Cashew', 1550),
(54, 6, 'Red Curry', 1700),
(55, 6, 'Zouk Burger', 1100),
(56, 6, 'Club Sandwich', 1000),
(57, 6, 'Thai Soup', 750),
(58, 6, 'Iced Tea', 400),
(59, 6, 'Chocolate Lava', 850),
(60, 6, 'Spring Rolls', 600),
(61, 7, 'Classic Breakfast', 1600),
(62, 7, 'Pancakes', 950),
(63, 7, 'Scrambled Eggs', 700),
(64, 7, 'Hot Chocolate', 600),
(65, 7, 'Chicken Pot Pie', 1400),
(66, 7, 'Fish & Chips', 1900),
(67, 7, 'Steak Sandwich', 1500),
(68, 7, 'Apple Pie', 750),
(69, 7, 'Latte', 500),
(70, 7, 'Quiche', 850),
(71, 8, 'Son of a Bun', 1150),
(72, 8, 'Lone Ranger', 1050),
(73, 8, 'Tick Tock', 950),
(74, 8, 'Curly Fries', 450),
(75, 8, 'Beef Jalapeno', 1200),
(76, 8, 'Double Patty', 1400),
(77, 8, 'Cheese Fries', 600),
(78, 8, 'Milkshake', 650),
(79, 8, 'Coke', 150),
(80, 8, 'Nuggets', 500),
(81, 9, 'Tandoori Platter', 3500),
(82, 9, 'Palak Paneer', 950),
(83, 9, 'Chicken Makhni', 1700),
(84, 9, 'Mutton Biryani', 1400),
(85, 9, 'Gulab Jamun', 400),
(86, 9, 'Stuffed Chillies', 600),
(87, 9, 'Bhindi Masala', 800),
(88, 9, 'Garlic Rice', 700),
(89, 9, 'Shahi Tukray', 550),
(90, 9, 'Fresh Lime', 250),
(91, 10, 'Weich Burger', 850),
(92, 10, 'Fillet Burger', 750),
(93, 10, 'Tortilla Wrap', 900),
(94, 10, 'Nuggets', 500),
(95, 10, 'Fries', 300),
(96, 10, 'Loaded Fries', 650),
(97, 10, 'Mushroom Burger', 1100),
(98, 10, 'Zinger Stacker', 950),
(99, 10, 'Cold Drink', 150),
(100, 10, 'Ice Cream', 300),
(101, 11, 'Beef Medallion', 2800),
(102, 11, 'French Onion Soup', 850),
(103, 11, 'Stuffed Chicken', 1900),
(104, 11, 'Club Sandwich', 1100),
(105, 11, 'Prawn Pasta', 2200),
(106, 11, 'Molten Lava', 900),
(107, 11, 'Caesar Salad', 1100),
(108, 11, 'Fish & Chips', 2100),
(109, 11, 'Iced Latte', 650),
(110, 11, 'Grilled Salmon', 3500),
(111, 12, 'Plain Nihari', 950),
(112, 12, 'Nalli Nihari', 1400),
(113, 12, 'Maghaz Nihari', 1600),
(114, 12, 'Khamiri Roti', 100),
(115, 12, 'Tandoori Paratha', 100),
(116, 12, 'Lassi', 200),
(117, 12, 'Yogurt Bowl', 150),
(118, 12, 'Beef Paye', 1100),
(119, 12, 'Green Tea', 80),
(120, 12, 'Shahi Tukray', 450),
(121, 13, 'Chicken Pulao Kabab', 650),
(122, 13, 'Double Kabab Pulao', 750),
(123, 13, 'Extra Shami Kabab', 100),
(124, 13, 'Roasted Chicken', 500),
(125, 13, 'Zarda', 300),
(126, 13, 'Kheer', 250),
(127, 13, 'Coke 500ml', 120),
(128, 13, 'Fresh Salad', 80),
(129, 13, 'Raita Special', 80),
(130, 13, 'Mineral Water', 100),
(131, 14, 'Polo Tuscany', 1850),
(132, 14, 'Spicy Fettuccine', 1600),
(133, 14, 'Margherita Pizza', 1750),
(134, 14, 'Beef Lasagna', 1900),
(135, 14, 'Chicken Parmesan', 1800),
(136, 14, 'Wild Mushroom Soup', 750),
(137, 14, 'Tiramisu', 950),
(138, 14, 'Bread Pudding', 1100),
(139, 14, 'Blueberry Slush', 600),
(140, 14, 'Garlic Bread', 450),
(141, 15, 'Chicken Handi', 1950),
(142, 15, 'Beef Burger', 950),
(143, 15, 'Stuffed Chillies', 650),
(144, 15, 'Fruit Chaat', 450),
(145, 15, 'Dahi Bhally', 500),
(146, 15, 'Chicken Karahi', 2400),
(147, 15, 'Mutton Biryani', 1500),
(148, 15, 'Fish Crackers', 400),
(149, 15, 'Lemonade', 300),
(150, 15, 'Gulab Jamun', 350),
(151, 16, 'Carbonara', 1700),
(152, 16, 'Pesto Pasta', 1550),
(153, 16, 'Arrabbiata', 1400),
(154, 16, 'Ravioli', 1800),
(155, 16, 'Bruschetta', 700),
(156, 16, 'Gnocchi', 1650),
(157, 16, 'Calzone', 1500),
(158, 16, 'Cannoli', 800),
(159, 16, 'Italian Soda', 450),
(160, 16, 'Affogato', 750),
(161, 17, 'Salmon Sushi', 2500),
(162, 17, 'Tempura Prawns', 1800),
(163, 17, 'Beef Tataki', 2200),
(164, 17, 'Miso Soup', 800),
(165, 17, 'California Roll', 1900),
(166, 17, 'Sashimi Platter', 4500),
(167, 17, 'Rock Shrimp', 1600),
(168, 17, 'Green Tea Ice Cream', 900),
(169, 17, 'Sticky Rice', 700),
(170, 17, 'Edamame', 950),
(171, 18, 'Dinner Buffet', 4500),
(172, 18, 'Lunch Buffet', 3200),
(173, 18, 'Hi-Tea', 2500),
(174, 18, 'Live BBQ Tikka', 1200),
(175, 18, 'Seekh Kabab', 1100),
(176, 18, 'Jalebi', 400),
(177, 18, 'Sugarcane Juice', 250),
(178, 18, 'Mutton Kunna', 2800),
(179, 18, 'Saag Makhan', 900),
(180, 18, 'Makki Roti', 120),
(181, 19, 'Turkish Kebab', 1900),
(182, 19, 'Lamb Chops', 3200),
(183, 19, 'Mezze Platter', 1500),
(184, 19, 'Kunafa', 1200),
(185, 19, 'Falafel Wrap', 850),
(186, 19, 'Grilled Fish', 2400),
(187, 19, 'Hummus & Pita', 700),
(188, 19, 'Turkish Tea', 300),
(189, 19, 'Shish Tawook', 1700),
(190, 19, 'Mandhi Rice', 2100),
(191, 20, 'Mutton Joint', 3800),
(192, 20, 'Dumba Karahi', 4500),
(193, 20, 'Afghani Pulao', 1400),
(194, 20, 'Namkeen Boti', 1600),
(195, 20, 'Sulemani Chai', 150),
(196, 20, 'Kabuli Naan', 150),
(197, 20, 'Lamb Roast', 3500),
(198, 20, 'Mixed Grill', 2900),
(199, 20, 'Patta Kabab', 1300),
(200, 20, 'Sheer Khurma', 500),
(201, 21, 'Fiery Chili Chicken', 1450),
(202, 21, 'Stuffed Chicken Parmesan', 1590),
(203, 21, 'Tarragon Beef Steak', 2400),
(204, 21, 'Fettuccine Alfredo Pasta', 1350),
(205, 21, 'Cream of Mushroom Soup', 550),
(206, 21, 'Caesar Salad with Chicken', 790),
(207, 21, 'Club House Sandwich', 950),
(208, 21, 'Mint Margarita', 380),
(209, 21, 'Molten Lava Cake', 690),
(210, 21, 'Iced Latte', 450),
(211, 22, 'Mutton Karahi Half', 2100),
(212, 22, 'Chicken Makhani Handi', 1450),
(213, 22, 'Seekh Kabab Plate', 890),
(214, 22, 'Reshmi Kabab (4pc)', 850),
(215, 22, 'Chicken Tikka Piece', 450),
(216, 22, 'Roghni Naan', 90),
(217, 22, 'Garlic Naan', 200),
(218, 22, 'Fresh Green Salad', 150),
(219, 22, 'Zeera Raita', 120),
(220, 22, 'Shahi Kheer', 220),
(221, 23, 'Cold Coffee Classic', 550),
(222, 23, 'Hot Hazelnut Latte', 620),
(223, 23, 'Caramel Macchiato', 650),
(224, 23, 'Spanish Latte', 680),
(225, 23, 'Club Sandwich with Fries', 850),
(226, 23, 'Fudge Cake Slice', 490),
(227, 23, 'Nutella Brownie', 350),
(228, 23, 'Chicken Flaky Patty', 220),
(229, 23, 'Cheese Croissant', 420),
(230, 23, 'Mineral Water Small', 80),
(231, 24, 'Gourmet Loaded Fries XL', 590),
(232, 24, 'Zingrish Burger', 480),
(233, 24, 'Southern Fried Chicken', 390),
(234, 24, 'Garlic Mayo Fries', 420),
(235, 24, 'Masala Fries Large', 350),
(236, 24, 'Chicken Pizza Fries', 650),
(237, 24, 'Beef Smash Burger', 690),
(238, 24, 'Chicken Nuggets (6pc)', 290),
(239, 24, 'Lemonade Drink', 180),
(240, 24, 'Coke Can', 140),
(241, 25, 'Famous Star Burger', 850),
(242, 25, 'Super Star Beef Burger', 1190),
(243, 25, 'Mushroom & Swiss Beef', 990),
(244, 25, 'Santa Fe Chicken Sandwich', 890),
(245, 25, 'Golden Chicken Tenders', 550),
(246, 25, 'Curly Fries Large', 450),
(247, 25, 'Onion Rings Bucket', 380),
(248, 25, 'Chocolate Hand-Scooped Shake', 590),
(249, 25, 'Vanilla Shake', 590),
(250, 25, 'Free Refill Soft Drink', 250),
(251, 26, 'Classic Maple Pancakes', 690),
(252, 26, 'Nutella Loaded Waffles', 850),
(253, 26, 'Lotus Biscoff Pancakes', 950),
(254, 26, 'Strawberry Cream Crepe', 750),
(255, 26, 'Chocolate Chip Cookie Skillet', 790),
(256, 26, 'French Toast Classic', 580),
(257, 26, 'Hot Chocolate with Marshmallows', 480),
(258, 26, 'Banana Caramel Sundae', 620),
(259, 26, 'Americano Coffee', 390),
(260, 26, 'Peach Ice Tea', 350),
(261, 27, 'Sollys Special Pizza Large', 1550),
(262, 27, 'Chicken Tikka Pizza Large', 1390),
(263, 27, 'Fajita Premium Pizza Medium', 990),
(264, 27, 'Cheese Lover Pizza Medium', 890),
(265, 27, 'Garlic Bread Strips (6pc)', 320),
(266, 27, 'Oven Baked Wings', 490),
(267, 27, 'Chicken Pasta Bowl', 790),
(268, 27, 'Chocolate Calzone', 450),
(269, 27, 'Dip Sauce Extra', 70),
(270, 27, 'Sprite 1.5L', 220),
(271, 28, 'Chicken Pulao Single', 380),
(272, 28, 'Chicken Biryani Full Platter', 450),
(273, 28, 'Chicken Shahi Korma', 850),
(274, 28, 'Daal Makhani Bowl', 390),
(275, 28, 'Mix Vegetable Handi', 420),
(276, 28, 'Plain Naan', 40),
(277, 28, 'Fresh Raita', 80),
(278, 28, 'Gourmet Cola 500ml', 90),
(279, 28, 'Rasmalai Cup (2pc)', 180),
(280, 28, 'Gourmet Ice Cream Scoop', 120),
(281, 29, 'Dynamite Shrimp Starter', 1850),
(282, 29, 'Chang Chicken Rice', 1490),
(283, 29, 'Mongolian Beef Platter', 2250),
(284, 29, 'Kung Pao Chicken', 1550),
(285, 29, 'Chicken Lo Mein Noodles', 1290),
(286, 29, 'Egg Fried Rice Bowl', 550),
(287, 29, 'Hot and Sour Soup Bowl', 480),
(288, 29, 'Vegetable Spring Rolls', 590),
(289, 29, 'Dumplings Chicken (6pc)', 890),
(290, 29, 'Green Jasmine Tea', 250),
(291, 30, 'Chicken Quesadilla', 950),
(292, 30, 'Loaded Nachos Cheese Platter', 890),
(293, 30, 'Crispy Chicken Tacos', 790),
(294, 30, 'Cuban Grilled Sandwich', 850),
(295, 30, 'Fries with Salsa Dip', 320),
(296, 30, 'Churros with Chocolate Sauce', 490),
(297, 30, 'Spanish Hot Chocolate', 550),
(298, 30, 'Classic Mojito Mocktail', 420),
(299, 30, 'Piña Colada Shake', 480),
(300, 30, 'Espresso Machiato', 350),
(301, 31, 'California Roll (4pc)', 950),
(302, 31, 'Spicy Tuna Maki', 1150),
(303, 31, 'Salmon Nigiri (2pc)', 850),
(304, 31, 'Chicken Katsu Curry', 1650),
(305, 31, 'Prawn Tempura Roll', 1400),
(306, 31, 'Prawn Dumplings', 790),
(307, 31, 'Miso Soup Bowl', 450),
(308, 31, 'Beef Teppanyaki', 2450),
(309, 31, 'Matcha Ice Cream', 390),
(310, 31, 'Jasmine Green Tea', 180),
(311, 32, 'Tavuk Doner Kebab', 690),
(312, 32, 'Adana Kebab Platter', 1350),
(313, 32, 'Iskender Kebab Beef', 1550),
(314, 32, 'Turkish Pide Cheese', 790),
(315, 32, 'Mixed Shish Grill Platter', 2400),
(316, 32, 'Hummus with Pita', 420),
(317, 32, 'Turkish Baklava (2pc)', 490),
(318, 32, 'Kunafa Premium', 890),
(319, 32, 'Turkish Tea (Chai)', 150),
(320, 32, 'Ayran (Salty Lassi)', 190),
(321, 33, 'Thai Fiery Chicken', 1250),
(322, 33, 'Chicken Green Curry', 1390),
(323, 33, 'Tom Yum Goong Soup', 590),
(324, 33, 'Pad Thai Noodles Chicken', 1150),
(325, 33, 'Beef Chili Dry Platter', 1450),
(326, 33, 'Szechuan Chicken', 1290),
(327, 33, 'Chicken Manchurian', 1190),
(328, 33, 'Egg Fried Rice Shared', 450),
(329, 33, 'Mint Lemonade', 290),
(330, 33, 'Coke Can', 140),
(331, 34, 'Chicken Shawarma Wrap', 450),
(332, 34, 'Falafel Platter (6pc)', 550),
(333, 34, 'Shish Taouk Plate', 1150),
(334, 34, 'Moutabal Dip', 380),
(335, 34, 'Fattoush Salad', 450),
(336, 34, 'Tabbouleh Salad Bowl', 420),
(337, 34, 'Lamb Kofta Roll', 650),
(338, 34, 'Garlic Toum Sauce Extra', 80),
(339, 34, 'Baklava Walnut Platter', 590),
(340, 34, 'Fresh Lime Water', 150),
(341, 35, 'Mandarin Special Soup', 520),
(342, 35, 'Crispy Beef Beijing', 1550),
(343, 35, 'Kung Pao Prawns', 1850),
(344, 35, 'Chicken Drumsticks (4pc)', 750),
(345, 35, 'Wonton in Chili Oil', 690),
(346, 35, 'Sweet and Sour Chicken', 1250),
(347, 35, 'Vegetable Chow Mein', 990),
(348, 35, 'Garlic Fried Rice Bowl', 480),
(349, 35, 'Fudge Cake Block', 450),
(350, 35, 'Sprite Zero Can', 140),
(351, 36, 'Smoked Chicken Croissant', 580),
(352, 36, 'Avocado Toast with Egg', 890),
(353, 36, 'Sasha Special Club Sandwich', 950),
(354, 36, 'Lotus Cheesecake Slice', 690),
(355, 36, 'Chocolate Eclair', 280),
(356, 36, 'Fudge Brownie Heat', 320),
(357, 36, 'Vanilla Caramel Latte', 550),
(358, 36, 'Cold Brew Coffee', 490),
(359, 36, 'Blueberry Muffin', 350),
(360, 36, 'English Breakfast Tea', 250),
(361, 37, 'Crispy Fish and Chips', 1650),
(362, 37, 'Full English Breakfast', 1250),
(363, 37, 'Beef Shepherd Pie', 1490),
(364, 37, 'Grilled Chicken Tarragon', 1550),
(365, 37, 'Mushroom Grilled Steak', 2600),
(366, 37, 'Bread and Butter Pudding', 650),
(367, 37, 'Classic Hot Coffee Mug', 420),
(368, 37, 'Peach Iced Tea Glass', 380),
(369, 37, 'Caesar Salad Dressing', 750),
(370, 37, 'Mineral Water Large', 150),
(371, 38, 'Crunchy Honey Chicken Bowl', 790),
(372, 38, 'Black Pepper Beef Bowl', 890),
(373, 38, 'Hot Sauce Chicken Bowls', 750),
(374, 38, 'Sweet Sour Prawn Bowl', 990),
(375, 38, 'Thai Chicken Cashew Bowl', 850),
(376, 38, 'Vegetable Fried Rice Base', 250),
(377, 38, 'Egg Fried Rice Base', 290),
(378, 38, 'Spring Rolls Box (3pc)', 320),
(379, 38, 'Dynamite Chicken Bites', 690),
(380, 38, 'Soft Drink Can All', 140),
(381, 39, 'Turkish Beyti Kebab', 1450),
(382, 39, 'Lachmacun Turkish Pizza', 650),
(383, 39, 'Chicken Shish Kebab Platter', 1190),
(384, 39, 'Hummus Loaded Meat', 690),
(385, 39, 'Shepherd Salad Fresh', 380),
(386, 39, 'Sutlac (Rice Pudding)', 350),
(387, 39, 'Pistachio Baklava Plate', 750),
(388, 39, 'Turkish Coffee Shot', 390),
(389, 39, 'Mint Margarita Glass', 320),
(390, 39, 'Mineral Water Small', 80),
(391, 40, 'Sumo Loaded Bento Box', 2200),
(392, 40, 'Crunchy Maki Roll (8pc)', 1850),
(393, 40, 'Chicken Teppanyaki Meal', 1550),
(394, 40, 'Prawn Tempura Platter (6pc)', 1490),
(395, 40, 'Salmon Sashimi (4pc)', 1350),
(396, 40, 'Garlic Rice Bowl Bowl', 450),
(397, 40, 'Hot Hot Ramen Bowl', 1650),
(398, 40, 'Edamame Sea Salt', 550),
(399, 40, 'Ice Cream Matcha Bowl', 450),
(400, 40, 'Oolong Tea Pot', 350);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `items_ordered` text DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `items_ordered`, `total_amount`, `status`) VALUES
(1, 'Mustafa Khan', 'Fillet Burger, Nuggets', 1250, 'delivered'),
(2, 'Sarim', 'Tiramisu, Mushroom Burger, ', 2000, 'pending'),
(3, 'Sara', 'Jalebi, Live BBQ Tikka, Jalebi, Mineral Water, Chicken Karahi, ', 4500, 'delivered'),
(4, 'Dua', 'Fillet Burger, Pesto Pasta, ', 2300, 'delivered'),
(5, 'Hasan', 'Behari Kabab, Puri Paratha, Puri Paratha, ', 1190, 'pending'),
(6, 'Elizabeth', 'Garlic Bread, Hummus & Pita', 1150, 'pending'),
(8, 'Amina', 'Beef Jalapeno, Son of a Bun, Khamiri Roti, Loaded Fries', 3100, 'delivered'),
(9, 'Zaviyar', 'Grilled Chicken (x2)', 4200, 'pending'),
(10, 'Tony', 'Paneer Reshmi (x1), Mint Margarita (x1)', 1550, 'pending'),
(11, 'Neha', 'Strawberry Cream Crepe (x1)', 750, 'pending'),
(12, 'Salman', 'Mutton Karahi (x2)', 7200, 'pending'),
(15, 'Zeenat', 'French Onion Soup (x1)', 850, 'delivered'),
(16, 'Kiran', 'Polo Tuscany (x1)', 1850, 'pending'),
(17, 'Sadia', 'Tavuk Doner Kebab (x1)', 690, 'pending'),
(18, 'Haris', 'Live BBQ Tikka (x1)', 1200, 'Delivered'),
(19, 'Sidra', 'Crunchy Honey Chicken Bowl (x2)', 1580, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cuisine` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `cuisine`, `location`) VALUES
(1, 'Butt Karahi', 'Desi', 'Lakshmi Chowk'),
(2, 'Haveli', 'Mughlai', 'Badshahi Mosque'),
(3, 'Bundu Khan', 'BBQ', 'Liberty Market'),
(4, 'Aylanto', 'Italian', 'MM Alam Road'),
(5, 'Waris Nihari', 'Desi', 'Anarkali'),
(6, 'Cafe Zouk', 'Thai Fusion', 'Gulberg'),
(7, 'English Tea House', 'Continental', 'Gulberg III'),
(8, 'Howdy', 'Gourmet Burgers', 'Johar Town'),
(9, 'Spice Bazaar', 'Desi Fusion', 'Gulberg II'),
(10, 'Johnny & Jugnu', 'Fast Food', 'DHA Phase 6'),
(11, 'The Brasserie', 'Continental', 'Mall 1'),
(12, 'Muhammadi Nihari', 'Desi', 'Mozang'),
(13, 'Savour Foods', 'Pulao', 'Shadman'),
(14, 'Tuscany Courtyard', 'Italian', 'Gulberg'),
(15, 'Salt’n Pepper', 'Desi/Fast Food', 'Mall Road'),
(16, 'Pasta La Vista', 'Italian', 'DHA Phase 5'),
(17, 'Gai’a', 'Japanese Fusion', 'DHA Phase 4'),
(18, 'Village Restaurant', 'Traditional Buffet', 'Gulberg'),
(19, 'Options', 'Continental', 'Garden Town'),
(20, 'Paak Kumana', 'Desi/BBQ', 'Main Boulevard'),
(21, 'Arcadian Cafe', 'Continental', 'Gulberg'),
(22, 'Monal Lahore', 'Desi/BBQ', 'Gulberg'),
(23, 'Cothas Coffee', 'Cafe', 'DHA Phase 5'),
(24, 'OPTP', 'Fast Food', 'Johar Town'),
(25, 'Hardees', 'Burgers', 'MM Alam Road'),
(26, 'The Pancake Lounge', 'Dessert', 'DHA Phase 3'),
(27, 'Sollys Pizza', 'Pizza', 'Model Town'),
(28, 'Gourmet Restaurant', 'Desi', 'Faisal Town'),
(29, 'P.F. Changs', 'Asian', 'DHA Phase 6'),
(30, 'CoCo Cubano', 'Mexican/Cafe', 'Gulberg'),
(31, 'Gai\'a', 'Japanese/Sushi', 'DHA Phase 5'),
(32, 'Nisa Sultan', 'Turkish BBQ', 'MM Alam Road'),
(33, 'Novu Pan Asian', 'Thai/Chinese', 'Gulberg'),
(34, 'Lebanese Corner', 'Lebanese', 'Johar Town'),
(35, 'Mandarin Kitchen', 'Chinese', 'DHA Phase 3'),
(36, 'Sasha\'s', 'Bakery/Cafe', 'Gulberg'),
(37, ' Street 1 Cafe', 'British/English', 'DHA Phase 6'),
(38, 'Rice Bowl', 'Pan Asian', 'Johar Town'),
(39, 'Little Istanbul', 'Turkish', 'Model Town'),
(40, 'Sumo', 'Japanese', 'Gulberg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manager_auth`
--
ALTER TABLE `manager_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manager_auth`
--
ALTER TABLE `manager_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
