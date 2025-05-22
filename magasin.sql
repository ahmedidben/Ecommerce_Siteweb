-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 02:27 AM
-- Server version: 8.0.40
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magasin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Email`, `Password`, `nom`) VALUES
(1, 'admin@admin.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `ID` int NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`ID`, `Nom`, `Description`) VALUES
(1, 'Clothing', 'Clothing and fashion items including shirts, pants, shoes, and accessories.'),
(2, 'Food', 'Food products such as coffee, pasta, honey, and other consumables.'),
(3, 'Beauty', 'Beauty products including skincare, perfumes, and cosmetics.'),
(4, 'Home', 'Home goods such as furniture, decor, and everyday household items.'),
(5, 'Sports', 'Sporting goods, activewear, fitness equipment, and accessories for athletes.'),
(6, 'Technology', 'Electronics, gadgets, mobile phones, laptops, and tech accessories.'),
(7, 'Toys', 'Toys, games, and educational products for children of all ages.'),
(8, 'Books', 'A variety of books including fiction, non-fiction, and educational materials.'),
(9, 'Health', 'Health-related products such as vitamins, supplements, and personal care items.'),
(10, 'Accessories', 'Fashion accessories like jewelry, bags, hats, and scarves.'),
(11, 'Men\'s Clothing', 'Men’s clothing including shirts, trousers, jackets, and casual wear.'),
(12, 'Women\'s Clothing', 'Women’s clothing including dresses, skirts, tops, and more.'),
(13, 'Furniture', 'Furniture products for the home including tables, chairs, and storage solutions.'),
(14, 'Musical Instruments', 'Musical instruments, audio equipment, and accessories for music lovers.');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ID` int NOT NULL,
  `Nom` varchar(100) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Motdepass` varchar(255) NOT NULL,
  `Tel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Dateinsecription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ID`, `Nom`, `Email`, `Motdepass`, `Tel`, `Ville`, `Address`, `Dateinsecription`) VALUES
(1, 'Ahmed Karim', 'ahmed.karim@example.com', 'securePassword123', '0612345678', 'Rabat', '123 Rue des Fleurs', '2025-05-01'),
(2, 'Sara El Amrani', 'sara.amrani@example.com', 'saraSecure456', '0678901234', 'Casablanca', '45 Avenue Hassan II', '2025-04-15'),
(3, 'Youssef Naji', 'youssef.naji@example.com', 'passYoussef789', '0654321987', 'Fès', '78 Boulevard Zerktouni', '2025-03-28'),
(4, 'Imane Bennis', 'imane.bennis@example.com', 'ImanePass321', '0623456789', 'Marrakech', '12 Derb El Kebir', '2025-04-02'),
(5, 'Omar Tazi', 'omar.tazi@example.com', 'OmarSuperPass', '0687654321', 'Agadir', '99 Route d’Essaouira', '2025-05-01'),
(6, 'Amine', 'amineidbenadi6@gmail.com', 'Amine123', '+212 700-563468', 'rabat', 'bla bla', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `Num` int NOT NULL,
  `DateCommande` date NOT NULL,
  `IDClient` int NOT NULL,
  `Statut` varchar(50) NOT NULL,
  `AdresseLivraison` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`Num`, `DateCommande`, `IDClient`, `Statut`, `AdresseLivraison`) VALUES
(43, '2025-05-03', 4, 'EN COURE', NULL),
(44, '2025-05-03', 4, 'EN COURE', NULL),
(45, '2025-05-03', 4, 'EN COURE', NULL),
(46, '2025-05-03', 4, 'EN COURE', NULL),
(56, '2025-05-17', 6, 'EN livrision', NULL),
(57, '2025-05-17', 6, 'EN livrision', NULL),
(58, '2025-05-17', 6, 'EN livrision', NULL),
(59, '2025-05-17', 6, 'EN livrision', NULL),
(61, '2025-05-17', 6, 'EN livrision', NULL),
(62, '2025-05-17', 6, 'EN livrision', NULL),
(63, '2025-05-17', 6, 'EN livrision', NULL),
(64, '2025-05-19', 6, 'EN livrision', NULL),
(65, '2025-05-19', 6, 'EN livrision', NULL),
(66, '2025-05-19', 6, 'EN livrision', NULL),
(67, '2025-05-19', 6, 'EN livrision', NULL),
(68, '2025-05-20', 6, 'In Delivery', NULL),
(69, '2025-05-20', 6, 'In Delivery', NULL),
(70, '2025-05-21', 6, 'In Delivery', NULL),
(72, '2025-05-21', 6, 'EN COURE', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `demandeadmin`
--

CREATE TABLE `demandeadmin` (
  `ID` int NOT NULL,
  `Email` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `demandeadmin`
--

INSERT INTO `demandeadmin` (`ID`, `Email`, `nom`, `password`) VALUES
(3, 'amine@gmail.com', 'Amine', 'amine');

-- --------------------------------------------------------

--
-- Table structure for table `lignedecommande`
--

CREATE TABLE `lignedecommande` (
  `RefProduit` int NOT NULL,
  `NumCommande` int NOT NULL,
  `Quantite` int NOT NULL,
  `PrixUnitaire` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lignedecommande`
--

INSERT INTO `lignedecommande` (`RefProduit`, `NumCommande`, `Quantite`, `PrixUnitaire`) VALUES
(1, 43, 1, 14.00),
(2, 44, 1, 19.00),
(3, 45, 1, 29.00),
(4, 46, 1, 39.00),
(4, 56, 1, 39.00),
(2, 57, 1, 19.00),
(4, 58, 1, 39.00),
(2, 59, 1, 19.00),
(1, 61, 1, 14.00),
(2, 62, 1, 19.00),
(1, 63, 1, 14.00),
(1, 64, 1, 14.00),
(2, 65, 1, 19.00),
(4, 66, 1, 39.00),
(3, 67, 1, 29.00),
(2, 68, 1, 19.00),
(2, 69, 1, 19.00),
(1, 70, 1, 14.00),
(1, 72, 1, 14.00);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `Reference` int NOT NULL,
  `Designation` varchar(255) NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Categorie` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `PrixAcquisition` decimal(10,2) NOT NULL,
  `Stock` int DEFAULT NULL,
  `ImageURL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`Reference`, `Designation`, `Description`, `Categorie`, `prix`, `PrixAcquisition`, `Stock`, `ImageURL`) VALUES
(1, 'Camera ', 'INSTAX Mini 12 Instant Camera Mint Green', 6, 14.00, 10.00, 10, 'imgs/bestSales/camera.jpg'),
(2, 'controle ', 'BE', 6, 19.00, 9.00, 99, 'imgs/bestSales/controle.jpg'),
(3, 'Drink ', 'Best Body Nutrition Vital Drink ZEROP® – Cherry Syrup Sugar-Free – 1 L – 1:80 Makes 80                                 Litres of Ready Drink', 9, 29.00, 20.00, 20, 'imgs/bestSales/Drink.jpg'),
(4, 'balance ', 'RENPHO Digital Bathroom Scale, Ultra Slim Body Scale with High-Precision Sensors, Smart                                 Scale with Step-On Technology, black', 6, 39.00, 10.00, 9, 'imgs/bestSales/scale.jpg'),
(201, 'T-shirt coton', 'T-shirt confortable 100% coton', 1, 120.00, 80.00, 50, 'imgs/bestSales/t_shirt.webp'),
(202, 'Café Arabica', 'Café moulu 100% Arabica, 250g', 2, 45.00, 30.00, 50, 'imgs/bestSales/coffie.webp'),
(203, 'Crème hydratante', 'Crème pour peau sèche, 100ml', 3, 90.00, 60.00, 49, 'imgs/bestSales/cream.jpg'),
(204, 'Lampe de chevet', 'Lampe LED pour chambre à coucher', 4, 220.00, 140.00, 10, 'imgs/bestSales/lamp.jpeg'),
(205, 'Tapis de yoga', 'Tapis antidérapant 6mm', 5, 180.00, 120.00, 5, 'imgs/bestSales/tapie.jpeg'),
(206, 'Smartphone X1', 'Écran AMOLED, 128GB, 6Go RAM', 6, 1699.00, 1200.00, 10, 'imgs/bestSales/phone.jpeg'),
(207, 'Puzzle 1000 pièces', 'Puzzle 1000 pièces', 7, 69.00, 40.00, 12, 'imgs/bestSales/puzzel.jpeg'),
(208, 'Roman policier', 'Thriller captivant en édition poche', 8, 64.00, 40.00, 20, 'imgs/bestSales/book.jpeg'),
(209, 'Vitamines C 500mg', 'Complément alimentaire – 60 comprimés', 9, 59.00, 40.00, 40, 'imgs/bestSales/vitaminC.jpeg'),
(210, 'Montre femme', 'Montre élégante avec bracelet en cuir', 10, 349.00, 150.00, 100, 'imgs/bestSales/watch.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `f_u` (`Email`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Unique1` (`Email`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`Num`),
  ADD KEY `fk_1` (`IDClient`);

--
-- Indexes for table `demandeadmin`
--
ALTER TABLE `demandeadmin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `lignedecommande`
--
ALTER TABLE `lignedecommande`
  ADD KEY `fk_1` (`RefProduit`),
  ADD KEY `fk_2` (`NumCommande`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`Reference`),
  ADD KEY `fk_3` (`Categorie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `Num` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `demandeadmin`
--
ALTER TABLE `demandeadmin`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`IDClient`) REFERENCES `client` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lignedecommande`
--
ALTER TABLE `lignedecommande`
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`NumCommande`) REFERENCES `commande` (`Num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_3` FOREIGN KEY (`Categorie`) REFERENCES `categorie` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
