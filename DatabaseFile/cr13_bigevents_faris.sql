SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `cr13_bigevents_faris` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr13_bigevents_faris`;

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210514112547', '2021-05-14 13:29:16', 336);

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evt_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `event` (`id`, `name`, `date`, `description`, `image`, `capacity`, `email`, `phone`, `address`, `evt_url`, `type`) VALUES
(1, 'Muthspiel / Rom / Egg', '2021-05-21 09:00:00', 'A story of south seas« (Regie: Friedrich Wilhelm Murnau, USA 1931) (UA)\r\nKompositionsauftrag des Wiener Konzerthauses', 'https://images.pexels.com/photos/165974/pexels-photo-165974.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', 352, 'concert@email.com', 67556789, 'Opernring 20, 1010, Vienna', 'https://events.wien.info/de/1313/muthspiel-rom-eggner/', 'museum'),
(2, 'Klavierabend Rudolf Buchbinder', '2021-07-25 19:00:00', 'Rudolf Buchbinder, Piano\r\nLudwig van Beethoven\r\nSonate E-Dur op. 109 (1820)\r\nSonate As-Dur op. 110 (1821)\r\nSonate c-moll op. 111 (1821–1822)', 'https://images.pexels.com/photos/2378209/pexels-photo-2378209.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', 320, 'concert@email.com', 67556789, 'Opernring 20, 1010, Vienna', 'https://events.wien.info/en/11zo/klavierabend-rudolf-buchbinder/', 'music'),
(3, 'Analysis, Psychoanalytical Schools after Freud', '2021-09-23 09:00:00', 'The exhibition presents five current psychoanalytic schools, whose commonalities and differentiations show psychoanalysis to be a multi-layered and progressive science of the unconscious.', 'https://images.pexels.com/photos/5699482/pexels-photo-5699482.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', 35, 'psycho@email.com', 12214748, 'Hubertgasse 20, 1090, Vienna', 'https://events.wien.info/en/133h/analysis-interminable-psychoanalytical-schools-of-thought-after-freud/', 'Family'),
(4, 'Vienna 1900 and beyond', '2021-06-01 09:00:00', 'The Leopold Museum is a unique treasury of Viennese Modernism and the Wiener Werkstätte.', 'https://images.pexels.com/photos/989917/pexels-photo-989917.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', 220, 'museum@email.com', 1234567, 'Someweirdnamegasse 33, 1010, Vienna', 'https://events.wien.info/en/yf9/vienna-1900/', 'music'),
(5, 'Cut the grass', '2026-01-01 18:16:00', 'fadfsdfsdfsdf', 'https://images.pexels.com/photos/1105666/pexels-photo-1105666.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', 8, 'blabla@mail.com', 2147483647, 'Schönbrunnerstrasse 96/2/12-13', 'https://events.wien.info/en/yf9/vienna-1900/', 'music'),
(6, 'Water baloons', '2022-01-01 16:00:00', 'Kids get together to mess up their parents .', 'https://northeastohiofamilyfun.com/wp-content/uploads/2013/07/Water-Balloon-Games-for-Kids.jpg', 200, 'blabla@mail.com', 2147483647, 'Schönbrunnerstrasse 96/2/12-13', 'https://events.wien.info/en/yf9/vienna-1900/', 'family');


ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
