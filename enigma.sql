-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2020 at 04:41 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enigma`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` smallint(6) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
(1, '698d51a19d8a121ce581499d7b701668'),
(1, '698d51a19d8a121ce581499d7b701668');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `desc` varchar(2048) DEFAULT NULL,
  `img` varchar(1024) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `regdate` varchar(255) DEFAULT NULL,
  `status` enum('lost','found','theft','deactivated') DEFAULT NULL,
  `reward` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `owner_id`, `uid`, `header`, `category`, `desc`, `img`, `location`, `regdate`, `status`, `reward`) VALUES
(62, 150, '5e2c91197310a', 'Пропав котик', 'pets', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultrices ex vulputate, commodo augue eget, fringilla urna. Aenean velit ipsum, interdum at posuere at, mattis vel lectus. Vestibulum porta leo a augue sagittis, vitae tempor lectus malesuada. Etiam et quam sed risus finibus feugiat ac ac lectus. Nulla vehicula augue mi, vel blandit leo fringilla sed. Quisque est mauris, gravida porttitor erat a, fermentum euismod ante. Etiam ullamcorper lacinia sem interdum congue. Fusce eget nisi non nisi scelerisque posuere.\r\n\r\nQuisque gravida felis in erat molestie, id lobortis velit scelerisque. Quisque sed justo vitae magna volutpat finibus. Sed auctor et enim ut placerat. Vivamus a ante id est vulputate aliquam eget id turpis. Donec semper fringilla pulvinar. Duis vitae velit non dolor ullamcorper ultrices. Pellentesque lobortis commodo tincidunt. Nulla semper ex sed pellentesque vestibulum. Phasellus fringilla quam non ligula sagittis, non molestie nunc congue. Duis urna sem, molestie ut malesuada ac, malesuada vel leo. Praesent felis nisl, tempor in dictum et, venenatis vitae magna. Pellentesque ligula elit, congue et dignissim tempus, sollicitudin sed justo. Vivamus porttitor vel turpis nec cursus. Ut vitae ornare ipsum.', '{\"data\":{\"id\":\"98P0nG1\",\"url_viewer\":\"https://ibb.co/98P0nG1\",\"url\":\"https://i.ibb.co/SsSgNJM/cfcc238c4b4f.jpg\",\"display_url\":\"https://i.ibb.co/ZL9rdNF/cfcc238c4b4f.jpg\",\"title\":\"cfcc238c4b4f\",\"time\":\"1579978594\",\"image\":{\"filename\":\"cfcc238c4b4f.jpg\",\"name\":\"cfcc238c4b4f\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/SsSgNJM/cfcc238c4b4f.jpg\",\"size\":141025},\"thumb\":{\"filename\":\"cfcc238c4b4f.jpg\",\"name\":\"cfcc238c4b4f\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/98P0nG1/cfcc238c4b4f.jpg\",\"size\":\"10367\"},\"medium\":{\"filename\":\"cfcc238c4b4f.jpg\",\"name\":\"cfcc238c4b4f\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/ZL9rdNF/cfcc238c4b4f.jpg\",\"size\":\"118901\"},\"delete_url\":\"https://ibb.co/98P0nG1/f9296e80bc5e74ad080009572a105a12\"},\"success\":true,\"status\":200}', 'Kiev', '{\"seconds\":53,\"minutes\":3,\"hours\":20,\"mday\":25,\"wday\":6,\"mon\":1,\"year\":2020,\"yday\":24,\"weekday\":\"Saturday\",\"month\":\"January\",\"0\":1579979033}', 'lost', NULL),
(63, 150, '5e2c92ec91838', 'Вкрали паспорт', 'documents', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultrices ex vulputate, commodo augue eget, fringilla urna. Aenean velit ipsum, interdum at posuere at, mattis vel lectus. Vestibulum porta leo a augue sagittis, vitae tempor lectus malesuada. Etiam et quam sed risus finibus feugiat ac ac lectus. Nulla vehicula augue mi, vel blandit leo fringilla sed. Quisque est mauris, gravida porttitor erat a, fermentum euismod ante. Etiam ullamcorper lacinia sem interdum congue. Fusce eget nisi non nisi scelerisque posuere.\r\n\r\nQuisque gravida felis in erat molestie, id lobortis velit scelerisque. Quisque sed justo vitae magna volutpat finibus. Sed auctor et enim ut placerat. Vivamus a ante id est vulputate aliquam eget id turpis. Donec semper fringilla pulvinar. Duis vitae velit non dolor ullamcorper ultrices. Pellentesque lobortis commodo tincidunt. Nulla semper ex sed pellentesque vestibulum. Phasellus fringilla quam non ligula sagittis, non molestie nunc congue. Duis urna sem, molestie ut malesuada ac, malesuada vel leo. Praesent felis nisl, tempor in dictum et, venenatis vitae magna. Pellentesque ligula elit, congue et dignissim tempus, sollicitudin sed justo. Vivamus porttitor vel turpis nec cursus. Ut vitae ornare ipsum.', '{\"data\":{\"id\":\"c1x6XyD\",\"url_viewer\":\"https://ibb.co/c1x6XyD\",\"url\":\"https://i.ibb.co/Ms9c5gM/a7a92cb51823.jpg\",\"display_url\":\"https://i.ibb.co/ZVNB1fW/a7a92cb51823.jpg\",\"title\":\"a7a92cb51823\",\"time\":\"1579979499\",\"image\":{\"filename\":\"a7a92cb51823.jpg\",\"name\":\"a7a92cb51823\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/Ms9c5gM/a7a92cb51823.jpg\",\"size\":319108},\"thumb\":{\"filename\":\"a7a92cb51823.jpg\",\"name\":\"a7a92cb51823\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/c1x6XyD/a7a92cb51823.jpg\",\"size\":\"11545\"},\"medium\":{\"filename\":\"a7a92cb51823.jpg\",\"name\":\"a7a92cb51823\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/ZVNB1fW/a7a92cb51823.jpg\",\"size\":\"59034\"},\"delete_url\":\"https://ibb.co/c1x6XyD/461c00f377267abfaaad5b42760ea72a\"},\"success\":true,\"status\":200}', 'Луцьк', '{\"seconds\":40,\"minutes\":11,\"hours\":20,\"mday\":25,\"wday\":6,\"mon\":1,\"year\":2020,\"yday\":24,\"weekday\":\"Saturday\",\"month\":\"January\",\"0\":1579979500}', 'theft', NULL),
(64, 150, '5e2c937fe1b23', 'Знайшла кросівки', 'clothes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultrices ex vulputate, commodo augue eget, fringilla urna. Aenean velit ipsum, interdum at posuere at, mattis vel lectus. Vestibulum porta leo a augue sagittis, vitae tempor lectus malesuada. Etiam et quam sed risus finibus feugiat ac ac lectus. Nulla vehicula augue mi, vel blandit leo fringilla sed. Quisque est mauris, gravida porttitor erat a, fermentum euismod ante. Etiam ullamcorper lacinia sem interdum congue. Fusce eget nisi non nisi scelerisque posuere.\r\n\r\nQuisque gravida felis in erat molestie, id lobortis velit scelerisque. Quisque sed justo vitae magna volutpat finibus. Sed auctor et enim ut placerat. Vivamus a ante id est vulputate aliquam eget id turpis. Donec semper fringilla pulvinar. Duis vitae velit non dolor ullamcorper ultrices. Pellentesque lobortis commodo tincidunt. Nulla semper ex sed pellentesque vestibulum. Phasellus fringilla quam non ligula sagittis, non molestie nunc congue. Duis urna sem, molestie ut malesuada ac, malesuada vel leo. Praesent felis nisl, tempor in dictum et, venenatis vitae magna. Pellentesque ligula elit, congue et dignissim tempus, sollicitudin sed justo. Vivamus porttitor vel turpis nec cursus. Ut vitae ornare ipsum.', '{\"data\":{\"id\":\"Ld87Q3T\",\"url_viewer\":\"https://ibb.co/Ld87Q3T\",\"url\":\"https://i.ibb.co/SwPCQzk/42f60bee7ec0.png\",\"display_url\":\"https://i.ibb.co/RT9whqX/42f60bee7ec0.png\",\"title\":\"42f60bee7ec0\",\"time\":\"1579979646\",\"image\":{\"filename\":\"42f60bee7ec0.png\",\"name\":\"42f60bee7ec0\",\"mime\":\"image/png\",\"extension\":\"png\",\"url\":\"https://i.ibb.co/SwPCQzk/42f60bee7ec0.png\",\"size\":1256042},\"thumb\":{\"filename\":\"42f60bee7ec0.png\",\"name\":\"42f60bee7ec0\",\"mime\":\"image/png\",\"extension\":\"png\",\"url\":\"https://i.ibb.co/Ld87Q3T/42f60bee7ec0.png\",\"size\":\"54780\"},\"medium\":{\"filename\":\"42f60bee7ec0.png\",\"name\":\"42f60bee7ec0\",\"mime\":\"image/png\",\"extension\":\"png\",\"url\":\"https://i.ibb.co/RT9whqX/42f60bee7ec0.png\",\"size\":\"396313\"},\"delete_url\":\"https://ibb.co/Ld87Q3T/bcf0d1a57d4fa53a812b219d5b2cbe48\"},\"success\":true,\"status\":200}', 'Львів', '{\"seconds\":7,\"minutes\":14,\"hours\":20,\"mday\":25,\"wday\":6,\"mon\":1,\"year\":2020,\"yday\":24,\"weekday\":\"Saturday\",\"month\":\"January\",\"0\":1579979647}', 'found', NULL),
(68, 153, '5e30453561745', 'Вкрали друга', 'pets', 'Зовнышнысть як на фото', '{\"data\":{\"id\":\"17VWfJG\",\"url_viewer\":\"https://ibb.co/17VWfJG\",\"url\":\"https://i.ibb.co/6rhCRJ0/add6a4d1580d.jpg\",\"display_url\":\"https://i.ibb.co/6rhCRJ0/add6a4d1580d.jpg\",\"title\":\"add6a4d1580d\",\"time\":\"1580221763\",\"image\":{\"filename\":\"add6a4d1580d.jpg\",\"name\":\"add6a4d1580d\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/6rhCRJ0/add6a4d1580d.jpg\",\"size\":19446},\"thumb\":{\"filename\":\"add6a4d1580d.jpg\",\"name\":\"add6a4d1580d\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/17VWfJG/add6a4d1580d.jpg\",\"size\":\"5486\"},\"delete_url\":\"https://ibb.co/17VWfJG/f7b9047a0fe1ebe1cbb7b8169a6c1f8f\"},\"success\":true,\"status\":200}', 'незнаю', '{\"seconds\":9,\"minutes\":29,\"hours\":15,\"mday\":28,\"wday\":2,\"mon\":1,\"year\":2020,\"yday\":27,\"weekday\":\"Tuesday\",\"month\":\"January\",\"0\":1580221749}', 'theft', NULL),
(69, 154, '5e30468d5142d', 'Загубив телефон', 'devices', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id risus et dui consectetur condimentum ut quis tellus. Sed vestibulum placerat efficitur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum varius hendrerit felis eu ultrices. Duis vel purus sit amet sem aliquam egestas. Pellentesque molestie semper tortor sed aliquam. Maecenas at efficitur sapien. In a risus eleifend, tincidunt orci quis, dignissim est. Aliquam blandit elit non massa egestas, et aliquam eros pulvinar. Suspendisse potenti. Nulla lacinia est cursus pulvinar rhoncus. Nullam ut ex enim. Curabitur ultricies est sed quam placerat porttitor. Praesent nisl justo, tristique quis semper sed, porta et augue. Morbi elit enim, porttitor eget tempor id, cursus sed ex. Morbi maximus nec velit id tincidunt. Morbi feugiat sagittis aliquet. Fusce mattis sollicitudin orci luctus tempor. Duis aliquet eros quis egestas semper. Vivamus vulputate pharetra libero, quis blandit libero fringilla ut. Etiam et neque ac augue aliquam malesuada. Maecenas hendrerit eros elementum, pretium lectus eget, consequat est. Maecenas lobortis eu ipsum nec rhoncus. Nam commodo lacus eget tortor condimentum malesuada. Aenean ac sapien gravida nulla maximus dignissim vitae et metus. Pellentesque sollicitudin metus eu elit dictum porttitor. Donec finibus hendrerit nulla, vel lacinia quam. Donec semper fermentum dolor, sed tincidunt est volutpat non. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce id neque porttitor elit tincidunt volutpat. Donec nec dui dapibus, pretium lectus sit amet, molestie nisi. Aenean porta non odio eget varius. Nulla facilisi. Morbi ut maximus elit. Integer eu felis arcu. Cras nisl.', '{\"data\":{\"id\":\"rH3KpCq\",\"url_viewer\":\"https://ibb.co/rH3KpCq\",\"url\":\"https://i.ibb.co/BBGH6Xv/d0becb228944.png\",\"display_url\":\"https://i.ibb.co/HqCLPWR/d0becb228944.png\",\"title\":\"d0becb228944\",\"time\":\"1580222096\",\"image\":{\"filename\":\"d0becb228944.png\",\"name\":\"d0becb228944\",\"mime\":\"image/png\",\"extension\":\"png\",\"url\":\"https://i.ibb.co/BBGH6Xv/d0becb228944.png\",\"size\":573431},\"thumb\":{\"filename\":\"d0becb228944.png\",\"name\":\"d0becb228944\",\"mime\":\"image/png\",\"extension\":\"png\",\"url\":\"https://i.ibb.co/rH3KpCq/d0becb228944.png\",\"size\":\"40724\"},\"medium\":{\"filename\":\"d0becb228944.png\",\"name\":\"d0becb228944\",\"mime\":\"image/png\",\"extension\":\"png\",\"url\":\"https://i.ibb.co/HqCLPWR/d0becb228944.png\",\"size\":\"404551\"},\"delete_url\":\"https://ibb.co/rH3KpCq/ca73b86e8d63b9ff47f422b3a3b83e31\"},\"success\":true,\"status\":200}', 'Ковель', '{\"seconds\":53,\"minutes\":34,\"hours\":15,\"mday\":28,\"wday\":2,\"mon\":1,\"year\":2020,\"yday\":27,\"weekday\":\"Tuesday\",\"month\":\"January\",\"0\":1580222093}', 'lost', NULL),
(70, 150, '5e3048178d35a', 'Знайшли коронавырус', 'pets', 'Коронавирус повернем власнику звертайтесь!()())()()()))))', '', 'Фывфыв', '{\"seconds\":27,\"minutes\":41,\"hours\":15,\"mday\":28,\"wday\":2,\"mon\":1,\"year\":2020,\"yday\":27,\"weekday\":\"Tuesday\",\"month\":\"January\",\"0\":1580222487}', 'lost', NULL),
(71, 153, '5e3048da8a8fb', 'pivko', 'preciousness', 'знайшов півко)))))000))00 НІКОМУ НЕ ОТДААААААААААААААМ.', '{\"data\":{\"id\":\"S6g3Hzn\",\"url_viewer\":\"https://ibb.co/S6g3Hzn\",\"url\":\"https://i.ibb.co/CwyH4f7/2ca63562d190.jpg\",\"display_url\":\"https://i.ibb.co/CwyH4f7/2ca63562d190.jpg\",\"title\":\"2ca63562d190\",\"time\":\"1580222683\",\"image\":{\"filename\":\"2ca63562d190.jpg\",\"name\":\"2ca63562d190\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/CwyH4f7/2ca63562d190.jpg\",\"size\":8213},\"thumb\":{\"filename\":\"2ca63562d190.jpg\",\"name\":\"2ca63562d190\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/S6g3Hzn/2ca63562d190.jpg\",\"size\":\"10830\"},\"delete_url\":\"https://ibb.co/S6g3Hzn/44e7bb19e0e2b976d0d1c1ba8df2162f\"},\"success\":true,\"status\":200}', 'Za garazhami', '{\"seconds\":42,\"minutes\":44,\"hours\":15,\"mday\":28,\"wday\":2,\"mon\":1,\"year\":2020,\"yday\":27,\"weekday\":\"Tuesday\",\"month\":\"January\",\"0\":1580222682}', 'found', NULL),
(72, 155, '5e3049817f770', 'Пропал ДИмон  ', 'pets', 'Любить борщик,пісяє сидя і спить з світільніком', '{\"data\":{\"id\":\"18jQKpP\",\"url_viewer\":\"https://ibb.co/18jQKpP\",\"url\":\"https://i.ibb.co/FgC3Jfy/b66a60874d12.jpg\",\"display_url\":\"https://i.ibb.co/FgC3Jfy/b66a60874d12.jpg\",\"title\":\"b66a60874d12\",\"time\":\"1580222850\",\"image\":{\"filename\":\"b66a60874d12.jpg\",\"name\":\"b66a60874d12\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/FgC3Jfy/b66a60874d12.jpg\",\"size\":5172},\"thumb\":{\"filename\":\"b66a60874d12.jpg\",\"name\":\"b66a60874d12\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/18jQKpP/b66a60874d12.jpg\",\"size\":\"7670\"},\"delete_url\":\"https://ibb.co/18jQKpP/856388c39e18c4ae2ac77eb91e08be8f\"},\"success\":true,\"status\":200}', 'Під діваном', '{\"seconds\":29,\"minutes\":47,\"hours\":15,\"mday\":28,\"wday\":2,\"mon\":1,\"year\":2020,\"yday\":27,\"weekday\":\"Tuesday\",\"month\":\"January\",\"0\":1580222849}', 'theft', NULL),
(73, 154, '5e3049bbd53da', 'Вкрали авто', 'devices', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut euismod erat id euismod facilisis. Suspendisse nec purus volutpat, tempus risus a, pretium est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vehicula lectus vitae dapibus pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante tortor, blandit volutpat lectus at, vestibulum porta sapien. In blandit odio vel libero rutrum, et dapibus tortor convallis. Aliquam iaculis eget nisl nec tempor. Nullam convallis fermentum nisi, id tempus nisi dignissim quis. Nulla facilisi. Aenean aliquam laoreet metus et elementum.', '', 'Grove St, home', '{\"seconds\":27,\"minutes\":48,\"hours\":15,\"mday\":28,\"wday\":2,\"mon\":1,\"year\":2020,\"yday\":27,\"weekday\":\"Tuesday\",\"month\":\"January\",\"0\":1580222907}', 'theft', NULL),
(74, 154, '5e304a7819320', 'Потерял друзей', 'toys', 'Ayaayayayayay', '{\"data\":{\"id\":\"swvdHtq\",\"url_viewer\":\"https://ibb.co/swvdHtq\",\"url\":\"https://i.ibb.co/d20wg7D/6424dc21cb4d.jpg\",\"display_url\":\"https://i.ibb.co/d20wg7D/6424dc21cb4d.jpg\",\"title\":\"6424dc21cb4d\",\"time\":\"1580223097\",\"image\":{\"filename\":\"6424dc21cb4d.jpg\",\"name\":\"6424dc21cb4d\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/d20wg7D/6424dc21cb4d.jpg\",\"size\":59409},\"thumb\":{\"filename\":\"6424dc21cb4d.jpg\",\"name\":\"6424dc21cb4d\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/swvdHtq/6424dc21cb4d.jpg\",\"size\":\"13230\"},\"delete_url\":\"https://ibb.co/swvdHtq/3680190ffff834840e6bcaee18b8079c\"},\"success\":true,\"status\":200}', 'Aztec Empire', '{\"seconds\":36,\"minutes\":51,\"hours\":15,\"mday\":28,\"wday\":2,\"mon\":1,\"year\":2020,\"yday\":27,\"weekday\":\"Tuesday\",\"month\":\"January\",\"0\":1580223096}', 'lost', NULL),
(75, 155, '5e304ab23d29e', 'Знайшли ДИмона', 'pets', 'Той самий Дімка не доїний, не сверлиний ,використанню не підлягав.В прекрасном состоянії.Вернем за благородну плату-2 гривні', '{\"data\":{\"id\":\"pfF4ccP\",\"url_viewer\":\"https://ibb.co/pfF4ccP\",\"url\":\"https://i.ibb.co/GWSCyyJ/8ecd726f0a30.jpg\",\"display_url\":\"https://i.ibb.co/Ht8G662/8ecd726f0a30.jpg\",\"title\":\"8ecd726f0a30\",\"time\":\"1580223157\",\"image\":{\"filename\":\"8ecd726f0a30.jpg\",\"name\":\"8ecd726f0a30\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/GWSCyyJ/8ecd726f0a30.jpg\",\"size\":70000},\"thumb\":{\"filename\":\"8ecd726f0a30.jpg\",\"name\":\"8ecd726f0a30\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/pfF4ccP/8ecd726f0a30.jpg\",\"size\":\"9717\"},\"medium\":{\"filename\":\"8ecd726f0a30.jpg\",\"name\":\"8ecd726f0a30\",\"mime\":\"image/jpeg\",\"extension\":\"jpg\",\"url\":\"https://i.ibb.co/Ht8G662/8ecd726f0a30.jpg\",\"size\":\"58053\"},\"delete_url\":\"https://ibb.co/pfF4ccP/9b9234fd37c5b44bcf2d288ae788c316\"},\"success\":true,\"status\":200}', 'Під діваном', '{\"seconds\":34,\"minutes\":52,\"hours\":15,\"mday\":28,\"wday\":2,\"mon\":1,\"year\":2020,\"yday\":27,\"weekday\":\"Tuesday\",\"month\":\"January\",\"0\":1580223154}', 'found', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `checked1` tinyint(1) DEFAULT NULL,
  `checked2` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `regdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `name`, `email`, `password`, `login`, `phone`, `address`, `checked1`, `checked2`, `status`, `regdate`) VALUES
(150, '5e2c86a67f844', 'Дмитро', 'google@google.com', '$2y$10$9ipX1CzOtj.Hh9OnZl5Poug.WJ70k6z09dlRShb7RmWfhdVMJQVFO', 'dimasoltusyuk', '3453453', '', 1, 1, NULL, '2020-01-25 19:19:18'),
(152, '5e2ca8aa68d3b', 'Jkadkashkdhs', 'ajsdashkd@adsasd.asd', '$2y$10$pvfCTImoB79EZ3eVUT.STOxX7UmfVw4MLeitCWOJ1B5UlvAzXXMPe', '', '+3801231232', NULL, 1, 0, NULL, '2020-01-25 21:44:26'),
(153, '5e3044cf55aca', 'Taraas', 'taras.shparuk@gmail.com', '$2y$10$/FcRgDPZLBZXb6armqAMjuGgZhL2xZmCXEBbqTKEM49oHFp6Z7NPe', 'taras.shparuk', '88005553535', NULL, 1, 0, NULL, '2020-01-28 15:27:27'),
(154, '5e3045715886b', 'Гена Букин', 'genadiubukin@i.ua', '$2y$10$62FnqMoeL4Uu7dlcxuzUROWOZGCBpsreqi9zKueYGJ1eGWvaljNLW', 'genadiubukin', '09992212312', NULL, 1, 0, NULL, '2020-01-28 15:30:09'),
(155, '5e304843d6568', 'VAsil', 'dododik@tulox.da', '$2y$10$nM6oD6Y3bF6BWzyAJcL0i.kgOvKcyv0rrBDnwmKdetxoE04glPQhi', 'dododik', '066 66 66 666', NULL, 1, 1, NULL, '2020-01-28 15:42:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_posts_owner_id` (`owner_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_posts_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
