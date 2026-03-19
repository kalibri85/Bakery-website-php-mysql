-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2025 at 03:21 PM
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
-- Database: `bakeryDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productTypeID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` text DEFAULT NULL,
  `sugar` int(11) DEFAULT NULL,
  `gluten` int(11) DEFAULT NULL,
  `lactose` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productTypeID`, `productName`, `productDescription`, `sugar`, `gluten`, `lactose`, `image`, `price`, `date`) VALUES
(1, 1, 'Carrot Cake', 'Carrot cake is a moist, sweet cake with a distinctive spice flavour, often featuring grated carrots, nuts, and a tangy cream cheese frosting. ', 1, 0, 1, 'carrot.jpg', 10.99, '2025-07-03'),
(5, 6, 'Assorted Chocolate', 'Introducing our delightful assortment of buttercream (contains dairy) chocolate cupcakes, a symphony of flavour that will tantalise your taste buds and indulge your sweet cravings. Crafted with the finest ingredients and a passion for perfection, each bite is a journey into chocolatey bliss.\r\n\r\nPerfect for any occasion, whether it&#039;s a birthday celebration, a special treat for yourself, or a gathering with friends and family, our Assorted Chocolate Cupcakes are sure to impress. They also make a thoughtful gift for any chocolate lover in your life. Enjoy 6 scrumptious flavours:\r\n\r\nOreo Cookie Heaven (Victoria sponge)\r\nRoyal Rocher (Hazelnuts)\r\nCurly Choc Dot\r\nCaramel Fudge\r\nCaramel Crunch (Victoria Sponge)\r\nRed Velvet (Red Velvet Sponge)', 1, 0, 1, 'cupcake.jpg', 10.99, '2025-07-03'),
(6, 6, 'Fruity Berry', 'The Fruity Berry Cupcake, made with rich red velvet sponge cupcakes filled with a fruity spread. Topped with luscious raspberry buttercream, these cupcakes offer a delightful blend of velvety sweetness and tangy berry flavor in every bite.', 0, 1, 0, 'frutty.jpg', 3, '2025-07-03'),
(7, 6, 'Chocolate Orange', 'Chocolate Orange Cupcakes, made with rich chocolate sponge cupcakes filled with smooth, zesty orange cream. Topped with velvety chocolate buttercream frosting, these cupcakes perfectly balance the deep chocolate flavour with a refreshing citrus twist.', 0, 0, 0, 'chockOrange.jpg', 3, '2025-07-03'),
(8, 3, 'Apple Pie', 'This apple pie recipe is the embodiment of that idea. The age-old combination of a flaky, buttery pie crust and tender sliced apples is perfect as it is, without any added bells and whistles (except maybe a scoop of vanilla ice cream). It’s an essential dessert to cap off a holiday meal—alongside pumpkin pie or pecan pie as the occasion demands—but it’s also great anytime as a comforting treat to enjoy with coffee.', 0, 0, 0, 'CINNAMON-CRUMBLE-APPLE-PIE-RECIPE-07092017.webp', 4.5, '2025-07-03'),
(9, 1, 'Loveberry Cheesecake', 'Our Loveberry Bliss Cheesecake is a perfect treat for berry lovers. Featuring a creamy cheesecake base topped with strawberries and raspberries, this dessert offers a delightful and refreshing taste in every bite.', 0, 0, 0, 'ch028vc06xx_01.webp', 16.99, '2025-07-03'),
(10, 7, 'Dubai Chocolate Cookie', 'Indulge in the luxurious Dubai Style Chocolate Cookie , featuring a rich, baked chocolate cookie dough filled with our signature pistachio Dubai crunch, elegantly finished with a smooth milk chocolate drizzle, nibbed pistachios, and crisp suter pheni. A perfect fusion of creamy, nutty, and chocolaty decadence in every bite.', 0, 0, 0, 'co002cho1xx.webp', 3.99, '2025-07-03'),
(11, 7, 'Dubai Chocolate Cup', 'Indulge in the viral Dubai Chocolate Cup, a luxurious dessert made of three layers of soft chocolate sponge. Each bite reveals a delightful pistachio Dubai crunch filling, complemented by layers of Nutella spread and fresh cream. Topped with smooth pistachio cream piping, a drizzle of Nutella, crunchy nibbed pistachios, and a fresh strawberry, this treat is a perfect balance of textures and flavors, making every mouthful a delightful experience.', 1, 1, 1, 'sc007dbxxxx_01.webp', 4.5, '2025-07-02'),
(12, 7, 'Oreo Crumble', 'Treat yourself to the irresistible flavours of our Cookie Crumble Cake Slice. Layers of chocolate sponge, chocolate spread, and fresh cream, enhanced with delectable Oreo crumble and crowned with tantalizing Oreo biscuits.', 0, 0, 0, 'sl023_2.webp', 4.49, '2025-07-02'),
(13, 5, 'Mini Donuts', 'A box of 12 assorted mini ring doughnuts ideal for children’s parties or events.', 0, 0, 0, 'IMG_0571.webp', 15, '2025-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `productTypes`
--

CREATE TABLE `productTypes` (
  `typeID` int(11) NOT NULL,
  `typeName` varchar(255) NOT NULL,
  `active` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productTypes`
--

INSERT INTO `productTypes` (`typeID`, `typeName`, `active`) VALUES
(1, 'Cakes', 1),
(2, 'Pancakes', 0),
(3, 'Pie', 1),
(4, 'Pastry', 0),
(5, 'Donuts', 1),
(6, 'Cupcakes', 1),
(7, 'Treats', 1),
(8, 'Cookies', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `reviewDescrioption` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewID`, `productID`, `stars`, `reviewDescrioption`, `name`, `email`, `date`) VALUES
(1, 1, 5, 'sdcs esfsg efsdg sefsdg dsgdfgfd dsg wf sdfdg sdfsdf asfsdg sdfdgf', 'Lana', 'lana@mail.com', '2025-06-29'),
(10, 1, 4, 'Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s.', 'Max', 'max@mail.com', '2025-06-29'),
(39, 7, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'Jack', 'jack@gmail.com', '2025-07-02'),
(41, 6, 5, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'Mike', 'mike@gmail.com', '2025-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `password`, `email`, `role`) VALUES
(9, 'admin', '$2y$10$8lnBZMTmXW4L.Y60IecQqubD9KXv7f05EcoNq5sGMKiVWRvCEKU2m', 'lanaTest@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `productTypeID` (`productTypeID`);

--
-- Indexes for table `productTypes`
--
ALTER TABLE `productTypes`
  ADD PRIMARY KEY (`typeID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `productTypes`
--
ALTER TABLE `productTypes`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`productTypeID`) REFERENCES `productTypes` (`typeID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
