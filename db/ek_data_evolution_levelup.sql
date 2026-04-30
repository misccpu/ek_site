-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: ix-dev.cs.uoregon.edu    Database: ek_data
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Dumping data for table `evolution_levelup`
--

LOCK TABLES `evolution_levelup` WRITE;
/*!40000 ALTER TABLE `evolution_levelup` DISABLE KEYS */;
INSERT INTO `evolution_levelup` VALUES ('Abra','Kadabra',16),('Anorith','Armaldo',40),('Aron','Lairon',25),('Azurill','Marill',1),('Bagon','Shelgon',30),('Baltoy','Claydol',36),('Barboach','Whiscash',30),('Bayleef','Meganium',32),('Beldum','Metang',20),('Bellsprout','Weepinbell',16),('Bulbasaur','Ivysaur',16),('Cacnea','Cacturne',29),('Carvanha','Sharpedo',30),('Cascoon','Dustox',10),('Caterpie','Metapod',7),('Chansey','Blissey',1),('Charmander','Charmeleon',16),('Charmeleon','Charizard',36),('Chikorita','Bayleef',16),('Chinchou','Lanturn',27),('Clamperl','Huntail',24),('Cleffa','Clefairy',1),('Combusken','Blaziken',16),('Corphish','Crawdaunt',25),('Croconaw','Feraligatr',30),('Cubone','Marowak',28),('Cyndaquil','Quilava',14),('Diglett','Dugtrio',26),('Doduo','Dodrio',31),('Dragonair','Dragonite',55),('Dratini','Dragonair',30),('Drowzee','Hypno',38),('Duskull','Dusclops',65),('Ekans','Arbok',22),('Electrike','Manectric',26),('Elekid','Electabuzz',30),('Feebas','Milotic',1),('Flaaffy','Ampharos',30),('Gastly','Haunter',25),('Geodude','Graveler',25),('Gloom','Bellossom',1),('Golbat','Crobat',1),('Goldeen','Seaking',20),('Graveler','Golem',42),('Grimer','Muk',38),('Grovyle','Sceptile',16),('Gulpin','Swalot',26),('Haunter','Gengar',50),('Hoothoot','Noctowl',20),('Hoppip','Skiploom',18),('Horsea','Seadra',30),('Houndour','Houndoom',66),('Igglybuff','Jigglypuff',1),('Ivysaur','Venusaur',32),('Kabuto','Kabutops',40),('Kadabra','Alakazam',55),('Kakuna','Beedrill',10),('Kirlia','Gardevior',30),('Koffing','Weezing',35),('Krabby','Kingler',28),('Lairon','Aggron',42),('Larvitar','Pupitar',30),('Ledyba','Ledian',18),('Lileep','Cradily',40),('Lotad','Lombre',14),('Loudred','Exploud',36),('Machoke','Machamp',50),('Machop','Machoke',28),('Magby','Magmar',30),('Magikarp','Gyarados',20),('Magnemite','Magneton',30),('Makuhita','Hariyama',24),('Mankey','Primeape',28),('Mareep','Flaaffy',15),('Marill','Azumarill',18),('Marshtomp','Swampert',36),('Meditite','Medicham',37),('Meowth','Persian',28),('Metang','Metagross',45),('Metapod','Butterfree',10),('Mudkip','Marshtomp',16),('Natu','Xatu',25),('Nidoran(f)','Nidorina',16),('Nidoran(m)','Nidorino',16),('Nincada','Ninjask',20),('Nincada','Shedinja',20),('Numel','Camerupt',33),('Oddish','Gloom',16),('Omanyte','Omastar',40),('Onix','Steelix',45),('Paras','Parasect',24),('Phanpy','Donphan',25),('Pichu','Pikachu',1),('Pidgeotto','Pidgeot',30),('Pidgey','Pidgeotto',16),('Pineco','Forretress',31),('Poliwag','Poliwhirl',25),('Poliwhirl','Politoed',37),('Ponyta','Rapidash',25),('Poochyena','Mightyena',18),('Porygon','Porygon2',42),('Psyduck','Golduck',25),('Pupitar','Tyranitar',55),('Quilava','Typhlosion',36),('Ralts','Kirlia',20),('Rattata','Raticate',20),('Remoraid','Octillery',25),('Rhyhorn','Rhydon',42),('Sandshrew','Sandslash',22),('Scyther','Scizor',50),('Seadra','Kingdra',55),('Sealeo','Walrein',44),('Seedot','Nuzleaf',14),('Seel','Dewgong',28),('Sentret','Furret',15),('Shelgon','Salamence',50),('Shroomish','Breloom',23),('Shuppet','Banette',37),('Silcoon','Beautifly',10),('Skiploom','Jumpluff',27),('Slakoth','Vigoroth',18),('Slowpoke','Slowbro',37),('Slugma','Magcargo',16),('Smoochum','Jynx',30),('Snorunt','Glalie',42),('Snubbull','Granbull',23),('Spearow','Fearow',20),('Spheal','Sealeo',25),('Spinarak','Ariados',22),('Spoink','Grumpig',27),('Squirtle','Wartortle',16),('Surskit','Masquerain',22),('Swablu','Altaria',35),('Swinub','Piloswine',33),('Taillow','Swello',22),('Teddiursa','Ursaring',30),('Tentacool','Tentacruel',30),('Togepi','Togetic',1),('Torchic','Combusken',16),('Totodile','Croconaw',18),('Trapinch','Vibrava',35),('Treecko','Grovyle',16),('Tyrogue','Hitmonchan',15),('Tyrogue','Hitmonlee',15),('Tyrogue','Hitmontop',15),('Venonat','Venomoth',31),('Vibrava','Flygon',45),('Vigoroth','Slaking',36),('Voltorb','Electrode',30),('Wailmer','Wailor',70),('Wartortle','Blastoise',36),('Weedle','Kakuna',7),('Whismur','Loudred',20),('Wingull','Pelipper',25),('Wooper','Quagsire',20),('Wurmple','Cascoon',7),('Wurmple','Silcoon',7),('Wynaut','Wobbuffet',64),('Zigzagoon','Linoone',20),('Zubat','Golbat',22);
/*!40000 ALTER TABLE `evolution_levelup` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-12 15:36:03
