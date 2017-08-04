-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `publicationDate` date NOT NULL,
  `categoryId` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `content` mediumtext NOT NULL,
  `likes` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'2017-07-27',1,'Первопроходцы ','Это статья - первопроходец','Первопроходец - человек(или статья), проложивший новые пути, открывший новые земли',57),(2,'2017-07-28',1,'Неведомые земли','Каждый человек хотя бы раз просыпался с утра с будоражащим чувством, что сегодня он не вернётся домой. ','Не так сложно отправиться в путь, как решиться на это. Не многие посвятили свою жизнь познанию, изучению тайн нашей планеты. И ещё меньше тех, о ком мы знаем это наверняка. Но несмотря на это, они шли вперёд, и вклад их в общее дело велик. ',31),(3,'2017-08-01',1,'Х. Колумб','Это итальянский мореплаватель, в 1492 году открывший для европейцев Америку, благодаря снаряжению экспедиций католическими королями.','Колумб первым из достоверно известных путешественников пересёк Атлантический океан в субтропической и тропической полосе северного полушария и первым из европейцев ходил в Карибском море и Саргассово море [2]. Он открыл и положил начало исследованию Южной и Центральной Америки, включая их континентальные части и близлежащие архипелаги — Большие Антильские (Куба, Гаити, Ямайка и Пуэрто-Рико), Малые Антильские (от Доминики до Виргинских островов, а также Тринидад) и Багамские острова.\r\n\r\nПервооткрывателем Америки Колумба можно назвать с оговорками, ведь ещё в Средние века на территории Северной Америки бывали европейцы в лице исландских викингов (см. Винланд). Но, поскольку за пределами Скандинавии сведений об этих походах не было, именно экспедиции Колумба впервые сделали сведения о землях на западе всеобщим достоянием и положили начало колонизации Америки европейцами.\r\n\r\nВсего Колумб совершил 4 плавания к Америке:\r\n\r\n    Первое плавание (3 августа 1492 — 15 марта 1493).\r\n    Второе плавание (25 сентября 1493 — 11 июня 1496).\r\n    Третье плавание (30 мая 1498 — 25 ноября 1500).\r\n    Четвёртое плавание (9 мая 1502 — 7 ноября 1504).\r\n',21),(4,'2017-07-27',1,' В. Янсзон и А.Тасман',' Голландский мореплаватель и губернатор Виллем Янсзон стал первым европейцем, увидевшим побережье Австралии.','Янсзон отправился в своё третье плавание из Нидерландов к Ост-Индии 18 декабря 1603 года в качестве капитана Duyfken, одного из двенадцати судов большого флота Стивена ван дер Хагена (англ.)русск..[113] Уже в Ост-Индии Янсзон получил приказ отправиться на поиски новых торговых возможностей, в том числе в «к большой земле Новой Гвинеи и другим восточным и южным землям.» 18 ноября 1605 года Duyfken вышел из Бантама к западному берегу Новой Гвинеи. Янсзон пересёк восточную часть Арафурского моря, и, не увидев Торресов пролив, вошёл в залив Карпентария. 26 февраля 1606 года он высадился у реки Пеннефазер (англ.)русск. на западном берегу полуострова Кейп-Йорк в Квинсленде, рядом с современным городом Уэйпа. Это была первая задокументированная высадка европейцев на австралийский континент. Янсзон нанёс на карту около 320 км побережья, полагая, что это южное продолжение Новой Гвинеи. В 1615 году Якоб Лемер и Виллем Корнелис Схаутен, обойдя мыс Горн, доказали, что Огненная Земля является островом и не может быть северной частью неизвестного южного континента.\r\n\r\nВ 1642—1644 годах Абель Тасман, также голландский исследователь и купец на службе VOC, обошёл вокруг Новой Голландии, доказав, что Австралия не является частью мифического южного континента. Он стал первым европейцем, достигшим острова Земля Ван-Димена (сегодня Тасмания) и Новой Зеландии, а также в 1643 году наблюдал острова Фиджи. Тасман, его капитан Вискер и купец Гилсманс также нанесли на карту отдельные участки Австралии, Новой Зеландии и тихоокеанских островов.',10),(5,'2017-07-27',3,'Description ','Выполняет поиск и замену по регулярному выражению  ',' mixed preg_replace ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )\r\n\r\nВыполняет поиск совпадений в строке subject с шаблоном pattern и заменяет их на replacement. \r\n\r\n preg_replace() возвращает массив, если параметр subject является массивом, иначе возвращается строка. Если найдены совпадения, возвращается новая версия subject, иначе subject возвращается нетронутым, в случае ошибки возвращается NULL.\r\n\r\nС версии PHP 5.5.0, если передается модификатор \"\\e\", вызывается ошибка уровня E_DEPRECATED. С версии PHP 7.0.0 в этом случае выдается E_WARNING и сам модификатор игнорируется.\r\n\r\nPHP 7.0.0: Удалена поддержка модификатора /e. Вместо него используйте preg_replace_callback(). ',11),(6,'2017-08-02',1,'С.И. Дежнёв','Искони известна тяга русского человека к неизведанным местам. Казак Семен Дежнев первым из европейцев отделил Евразию от Америки, вышел в Тихий океан. Он и его собратья бродили на утлых лодьях по Великому океану вдоль Курильской гряды. Эти люди, их спутники и последователи не искали славы и золота, они были подвижниками, следопытами.','Семён Иванович Дежнёв (ок. 1605, Великий Устюг — нач. 1673, Москва) — выдающийся русский мореход, землепроходец, путешественник, исследователь Северной и Восточной Сибири, казачий атаман, а также торговец пушниной, первый из известных европейских мореплавателей, в 1648 году, на 80 лет раньше, чем Витус Беринг, прошёл Берингов пролив, отделяющий Аляску от Чукотки.\r\nПримечательно, что Берингу не удалось пройти весь пролив целиком, а пришлось ограничиться плаванием только в его южной части, тогда как Дежнёв прошёл пролив с севера на юг, по всей его длине.\r\nЗа 40 лет пребывания в Сибири Дежнев участвовал в многочисленных боях и стычках, имел не менее 13 ранений, включая три тяжелых. Судя по письменным свидетельствам, его отличали надежность, честность и миролюбие, стремление исполнить дело без кровопролития.\r\nИменем Дежнева названы мыс, остров, бухта, полуостров и село. В центре Великого Устюга в 1972 году ему установлен памятник.',7);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Первый сорт','Это первая созданная категория, она была отредактирована после отладки ошибок'),(3,'Статьи про preg_replace','Здесь будут сохранены факты о функции preg_replace с целью понять, зачем же она понадобилась создателю сайта');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `name` varchar(200) NOT NULL,
  `description` mediumtext,
  `available` mediumint(9) DEFAULT '0',
  `price` int(11) NOT NULL,
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `likes` mediumint(9) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES ('Бутылка кефира','Студент может 2 дня жить',345,45,1,0),('Полбатона','Лучше только целый ',1,32,2,0),('Общая тетрадь','Толстая тетрадь, подойдёт для всех предметов сразу',7848,51,3,0),('Сумка','Страшная разорванная в нескольких местах сумка через плечо',2013,250,4,0),('Шариковая ручка','Застрахована от протекания в карманы',14288,8,5,0),('Наушники','Чтобы заткнуть уши с утра, когда едешь к первой паре ',5678,350,6,0),('Наушники \"spy\"','Незаменимая вещь на зачёте или экзамене',1258113,1500,7,0),('Гитара','Внимание! Если Вас заинтересовал данный товар, зайдите на наш сайт www.vsyo-dlya-turista.com',23,2350,8,0);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` date NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` int(11) NOT NULL,
  `role` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (26,'Mery','$2y$10$YyvPebNkLg90fkx1w/NIdOF62nJ.LgOU5VhcL4LPDd/hvXmOg0NKG','2017-08-01','email@rrt',426915,'auth_user'),(27,'admin','$2y$10$X4jIhBcKVBhdr/UPc0wWg.uuH8gswcTTesvMw9OsNugYnfUMw/yQO','2017-08-02','email@email',86362,'admin'),(28,'user2','$2y$10$T4vHM9v.9MbOgFA9xKOMHeOwSA1vytKA52AqspBAoAUFpH6x8FXWW','2017-08-02','email@mail',962448,'auth_user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-04 18:01:54
