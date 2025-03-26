CREATE DATABASE  IF NOT EXISTS `assignment2_web` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `assignment2_web`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: assignment2_web
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) NOT NULL,
  `productDescription` varchar(500) NOT NULL,
  `productPrice` float NOT NULL,
  `GENDER` char(1) NOT NULL,
  `BRAND` varchar(30) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,'Jean Paul Gaultier Le Male Le Parfum EDP Intense','Le Male Le Parfum by Jean Paul Gaultier is a Oriental fragrance for men. Le Male Le Parfum was launched in 2020. Le Male Le Parfum was created by Quentin Bisch and Natalie Gracia-Cetto. Top note is Cardamom; middle notes are Lavender and Iris; base notes are Vanilla, Oriental notes and Woodsy Notes.',150,'M','Jean Paul Gaultier'),(4,'Jean Paul Gaultier Le Male Elixir Parfum','Le Male Elixir by Jean Paul Gaultier is a Oriental Fougere fragrance for men. This is a new fragrance. Le Male Elixir was launched in 2023. The nose behind this fragrance is Quentin Bisch. Top notes are Lavender and Mint; middle notes are Vanilla and Benzoin; base notes are Honey, Tonka Bean and Tobacco.',153,'M','Jean Paul Gaultier'),(5,'Valentino Uomo Born In Roma EDT','Valentino Uomo Born In Roma Intense by Valentino is a Oriental Vanilla fragrance for men. This is a new fragrance. Valentino Uomo Born In Roma Intense was launched in 2023. Valentino Uomo Born In Roma Intense was created by Antoine Maisondieu and Guillaume Flavigny. Top note is Vanilla; middle note is Lavender; base note is Vetiver.',130,'M','Valentino'),(6,'Emporio Armani Stronger With You Intensely EDP','Emporio Armani Stronger With You Intensely by Giorgio Armani is a Oriental Fougere fragrance for men. Emporio Armani Stronger With You Intensely was launched in 2019. Top notes are Pink Pepper, Juniper and Violet; middle notes are Toffee, Cinnamon, Lavender and Sage; base notes are Vanilla, Amber, Tonka Bean and Suede.',125,'M','Emporio Armani'),(7,'Yves Saint Laurent Black Opium EDP','Black Opium Storm Illusion by Yves Saint Laurent is a Oriental Vanilla fragrance for women. Black Opium Storm Illusion was launched in 2020. Black Opium Storm Illusion was created by Nathalie Lorson, Marie Salamagne, Olivier Cresp and Honorine Blanc. Top notes are Pink Pepper, Orange Blossom, Mandarin Orange, Bergamot and Pear; middle notes are Tuberose, Licorice, Bitter Almond, Coffee and Jasmine Sambac; base notes are Cashmirwood, White Musk, Vanilla, Patchouli and Cedar.',150,'F','Yves Saint Laurent'),(8,'La Vie Est Belle Lancome','La Vie Est Belle Domaine de la Rose by Lancôme is a Floral Fruity Gourmand fragrance for women. This is a new fragrance. La Vie Est Belle Domaine de la Rose was launched in 2022. Top notes are Bergamot, Pink Pepper and Herbal Notes; middle notes are Grasse Rose and Jasmine Sambac; base notes are Patchouli, Iris, Gourmand Accord and Amberwood.',150,'F','Lancome'),(9,'Carolina Herrera Good Girl EDP','Good Girl by Carolina Herrera is a Oriental Floral fragrance for women. Good Girl was launched in 2016. Good Girl was created by Louise Turner and Quentin Bisch. Top notes are Almond, Coffee, Bergamot and Lemon; middle notes are Tuberose, Jasmine Sambac, Orange Blossom, Bulgarian Rose and Orris; base notes are Tonka Bean, Cacao, Vanilla, Praline, Sandalwood, Musk, Amber, Cashmere Wood, Patchouli, Cinnamon and Cedar.',167,'F','Carolina Herrera'),(10,'Louis Vuitton Attrape Reves EDP','Attrape-Rêves by Louis Vuitton is a Oriental Floral fragrance for women. Attrape-Rêves was launched in 2018. The nose behind this fragrance is Jacques Cavallier Belletrud. Top notes are Litchi, Bergamot and Ginger; middle notes are Peony, Turkish Rose and Cacao; base note is Patchouli.',410,'F','Louis Vuitton'),(11,'Louis Vuitton Les Sables Roses EDP','Les Sables Roses by Louis Vuitton is a Oriental Floral fragrance for women and men. Les Sables Roses was launched in 2019. The nose behind this fragrance is Jacques Cavallier Belletrud.',480,'M','Louis Vuitton'),(12,'Gucci Guilty Pour Homme EDT','Gucci Guilty Pour Homme Platinum by Gucci is a Woody Aromatic fragrance for men. Gucci Guilty Pour Homme Platinum was launched in 2016. Top notes are Lavender and Lemon; middle note is Orange Blossom; base notes are Patchouli and Cedar.',120,'M','Gucci'),(13,'Bleu de Chanel','Bleu de Chanel Eau de Parfum by Chanel is a Woody Aromatic fragrance for men. Bleu de Chanel Eau de Parfum was launched in 2014. The nose behind this fragrance is Jacques Polge. Top notes are Grapefruit, Lemon, Mint, Bergamot, Pink Pepper, Aldehydes and Coriander; middle notes are Ginger, Nutmeg, Jasmine and Melon; base notes are Incense, Amber, Cedar, Sandalwood, Patchouli, Amberwood and Labdanum.',240,'M','Chanel'),(14,'Yves Saint Laurent Libre Le Parfum EDP','Libre Le Parfum by Yves Saint Laurent is a Oriental Floral fragrance for women. This is a new fragrance. Libre Le Parfum was launched in 2022. Libre Le Parfum was created by Anne Flipo and Carlos Benaïm. Top notes are Ginger, Saffron, Mandarin Orange and Bergamot; middle notes are Orange Blossom and Lavender; base notes are Bourbon Vanilla, Honey, Tonka Bean and Vetiver.',175,'F','Yves Saint Laurent'),(15,'Versace Pour Femme Dylan Blue Versace','Versace Pour Femme Dylan Blue by Versace is a Floral Fruity fragrance for women. Versace Pour Femme Dylan Blue was launched in 2017. Versace Pour Femme Dylan Blue was created by Calice Becker and Natalie Gracia-Cetto. Top notes are Granny Smith apple, Black Currant, Clover, Forget me not and Shiso; middle notes are Peach, Petalia, Rose Hip, Rose and Jasmine; base notes are Musk, White Woods, Patchouli and Styrax.',150,'W','Versace'),(16,'Azzaro The Most Wanted Parfum','The Most Wanted Parfum by Azzaro is a Woody Spicy fragrance for men. This is a new fragrance. The Most Wanted Parfum was launched in 2022. Top note is Ginger; middle note is Woodsy Notes; base note is Bourbon Vanilla.',135,'M','Azzaro'),(17,'Boss Bottled Elixir Hugo Boss','Boss Bottled Elixir by Hugo Boss is a Oriental Spicy fragrance for men. This is a new fragrance. Boss Bottled Elixir was launched in 2023. Boss Bottled Elixir was created by Annick Menardo and Suzy Le Helley. Top notes are Frankincense and Cardamom; middle notes are Patchouli and Vetiver; base notes are Labdanum and Cedar.',100,'M','Boss'),(18,'Louis Vuitton Pacific Chill EDP','Pacific Chill by Louis Vuitton is a Aromatic Fruity fragrance for women and men. Pacific Chill was launched in 2023. The nose behind this fragrance is Jacques Cavallier Belletrud. Top notes are Citron, Orange, Mint, Lemon, Black Currant and Coriander; middle notes are Apricot, Basil, Carrot Seeds and May Rose; base notes are Fig, Dates and Ambrette.',410,'U','Louis Vuitton'),(19,'Creed Aventus EDP','Aventus by Creed is a Chypre Fruity fragrance for men. Aventus was launched in 2010. Aventus was created by Jean-Christophe Hérault and Erwin Creed. Top notes are Bergamot, Black Currant, Apple, Lemon and Pink Pepper; middle notes are Pineapple, Patchouli and Moroccan Jasmine; base notes are Birch, Musk, oak moss, Ambroxan and Cedarwood.',450,'M','Creed Aventus'),(20,'Louis Vuitton On The Beach EDP','Aventus by Creed is a Chypre Fruity fragrance for men. Aventus was launched in 2010. Aventus was created by Jean-Christophe Hérault and Erwin Creed. Top notes are Bergamot, Black Currant, Apple, Lemon and Pink Pepper; middle notes are Pineapple, Patchouli and Moroccan Jasmine; base notes are Birch, Musk, oak moss, Ambroxan and Cedarwood.',410,'M','Louis Vuitton'),(21,'Gucci Guilty','Gucci Guilty by Gucci is a Oriental Floral fragrance for women. Gucci Guilty was launched in 2010. The nose behind this fragrance is Aurélien Guichard. Top notes are Pink Pepper, Mandarin Orange and Bergamot; middle notes are Lilac, Peach, Geranium, Jasmine and Black Currant; base notes are Patchouli, Amber, White Musk and Vanilla.',100,'F','Gucci');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-24 20:34:21
