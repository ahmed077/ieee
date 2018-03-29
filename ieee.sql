-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2018 at 06:24 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ieee`
--
CREATE DATABASE IF NOT EXISTS `ieee` DEFAULT CHARACTER SET utf32 COLLATE utf32_general_ci;
USE `ieee`;

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `semester` int(2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook_profile` varchar(255) NOT NULL,
  `mobile` int(16) NOT NULL,
  `membership_type` varchar(50) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `name`, `faculty`, `semester`, `email`, `facebook_profile`, `mobile`, `membership_type`, `event_id`) VALUES
(50, 'test', 'test', 12, 'test@test', 'test', 123, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(511) NOT NULL,
  `location` varchar(511) NOT NULL,
  `date` date NOT NULL,
  `description` mediumtext NOT NULL,
  `arabic_description` longtext,
  `speakers` varchar(1023) NOT NULL,
  `speakers_images` varchar(4095) NOT NULL,
  `mission` varchar(1023) NOT NULL,
  `goals` varchar(1023) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `event_open` int(1) NOT NULL DEFAULT '0',
  `mega` tinyint(1) NOT NULL DEFAULT '0',
  `mega_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `image`, `location`, `date`, `description`, `arabic_description`, `speakers`, `speakers_images`, `mission`, `goals`, `event_type`, `event_open`, `mega`, `mega_date`) VALUES
(1, 'The Black Seekers V2.0', 'images/events/7c9dce92afac904a3a8c4208dc180ab5aac6fbdf.JPG', 'Pharos University', '2017-10-31', '  The main target was to teach you how to create a robot by your self and operate it into a show or contest. And to be able to see your work alive with a system that you put by yourself. We give you 4 sessions on 4 weeks pace, which covers electrical wiring in addition to how to use the bread board, and the needed electric materials in order to make a robot, as well as an elaboration of motor driver. Along with making a workshops that covers all of that. By the end of the first day, it was just enough to make us take the next stage. Which is defining the Arduino and make it a mind that could take orders and acutely perform it. Furthermore it&amp;amp;#39;s a link between you and the robot. Undoubtedly, the application is a wise approach that will encourage and motivate you, so we made a site visit to Robo-games contest at Arab Academy for Science and Technology and Maritime Transport, this site visit helped many attendees to understand even more about the functions and the process of programming the Arduino The course covered these main points:&amp;lt;br /&amp;gt;\r\n- HOW TO CODE A PROGRAM IN MICROCONTROLLER/ PROGRAMMING LANGUAGE&amp;lt;br /&amp;gt;\r\n- HOW TO USE ARDUINO.&amp;lt;br /&amp;gt;\r\n- HOW TO DEAL WIITH ELECTRONICS DEVICES LIKE DRIVERS, MOTORS, AND MICROCONTROLLER&amp;lt;br /&amp;gt;\r\nAfter finishing all 4 sessions the anticipated attendees were handed a certificate along with widely impressive closing ceremony characterized by a robots show.', NULL, 'Ahmed Ragab', 'images/speakers/person-vector.jpg', 'The main target was to teach you how to create a&amp;lt;br /&amp;gt;\r\n robot by your self and operate it into a show or contest.', 'Each compotator learn:&amp;lt;br /&amp;gt;\r\n1-More about the robotics..&amp;lt;br /&amp;gt;\r\n2-Team building skill.&amp;lt;br /&amp;gt;\r\n3-Time management .', 'workshop', 1, 0, NULL),
(2, 'MEGA BRAIN TO BE &#39;18', 'images/events/megambb_poster.jpg', 'Bibliotheca Alexandrina', '2018-06-23', 'The human mind is one of the greatest miracles on the earth. There is a terrible amount of nerve cells in which each one has a certain role and which is performed perfectly. But despite this, you are putting pressure on some cells to learn things to be done in a routine way. And since you need more information about the different skills that help your mind to accomplish the tasks better. You need courses and workshops in which you&rsquo;ll learn new things. But since it&rsquo;s a special thing to find most of your field weapons joined in one place and starting from this idea we, IEEEPUASB, decided to create our first annual scientific conference which is (Mega Brain To Be). That means in every year we&rsquo;ll be focusing on a certain skill so that we would benefit you with the largest amount of skills try to upgrade the human mind to the MEGA ( ultimate )which is 10 ^ 6. According to that, we present to you our genius character (Brainy) and every year he&rsquo;ll be helping you raise your mind one Mega human unit.Starting this year with our first scientific conference we&rsquo;ll achieve our vision and task by delivering to you through Sessions, Workshops and Skill fair.&amp;lt;br /&amp;gt;\r\n&amp;lt;br /&amp;gt;\r\n&amp;amp;#34;School education will bring you a job either self-education will bring you a mind&amp;amp;#34; - Albert Einstein&amp;lt;br /&amp;gt;\r\nWe&rsquo;ll be starting with self-learning, to obtain the first mega human unit through the first annual scientific conference of IEEE PUA SB and it will be different by all means. Helping you choose the field you love, away from your studies at the college and create your futures plan to complete and be able to study on your own in the field that you love aside from the skills you acquire and learn by yourself . we offer you more skills to help you complete your job and know all the requirements for your work in different fields&amp;lt;br /&amp;gt;\r\nAnd since when you teach yourself get more skills we&rsquo;ll be providing you with the main keys of the self-learning that will help you achieve your goals and make you special in your field.&amp;lt;br /&amp;gt;\r\n&amp;lt;br /&amp;gt;\r\nThe fees to attend the event are only EGP 50 include:&amp;lt;br /&amp;gt;\r\n1. Lunch break&amp;lt;br /&amp;gt;\r\n2. Certificate of attendee&amp;lt;br /&amp;gt;\r\nLocation: Bibliotheca Alexandrina&amp;lt;br /&amp;gt;\r\nDate: 23-24-25 June', 'العقل البشرى من اعظم المعجزات على الارض فيه كم رهيب من الخلايا العصبية اللى كل واحده فيهم ليها دور معين و بتقوم بيه على اكمل وجه لكن بالرغم من ده بتحتاج تجهد بعض الخلايا فى تعلم اشياء هتأديها بشكل روتينى -زى المواد اللى بتدرسها لفترة الامتحانات او روتين يوم عمل- ولانك بتحتاج معلومات اكتر عن ال Skills المختلفه تساعد عقلك على انجاز المهام بشكل افضل بتحتاج كورسات و دورات فى انك تتعلم اشياء جديدة مختلفه لكن الامر المختلف انك تلاقى معظم اسلحة مجالك متجمعين فى مكان واحد و من المنطلق ده قررنا و بكل فخر احنا IEEE PUA SB اننا نعمل اول مؤتمر سنوى علمى وهو Mega brain to be يعنى احنا كل سنه هنركز على skill معينه علشان نفيدك بأكبر كمية من ال skills الموجوده و نحاول نعلى بالعقل البشرى للميجا وهى 10^6 اخترنالكم شخصيتنا العبقرية Brainy وده اللى هيقدر كل سنة يرفع عقلك البشرى وحدة ميجا بشرية و السنادى هتكون بدايتنا بأول مؤتمر علمى هيكون لينا رؤية و مهمة لازم نوصلها ليكم من خلال Sessions و Workshops و Skill fair.&amp;lt;br /&amp;gt;\r\n&amp;lt;br /&amp;gt;\r\n&amp;amp;#34;التعليم المدرسى سيجلب لك وظيفة اما التعليم الذاتى سيجلب لك عقلا&amp;amp;#34;&amp;lt;br /&amp;gt;\r\nالبرت انشتاين و بدايتنا هتكون بالتعليم الذاتى &amp;amp;#34;Self Learning&amp;amp;#34; علشان نكون اخدنا اول وحدة ميجا بشرية من المؤتمر السنوى العلمى الاول لينا ك IEEE PUA SB اللى هتكون مختلفه من جميع النواحى هتعرف ازاى تختار المجال اللى انت بتحبه بعيداً عن دراستك فى الكلية و تحط خطتك المستقبلية علشان تكمل فيها و تقدر تدرس لوحدك المجال اللى انت بتحبه ده غير المهارات اللى هتكتسبها وانت بتعلم نفسك بنفسك .&amp;lt;br /&amp;gt;\r\n&amp;lt;br /&amp;gt;\r\nسعر التيكت لحضور الايفنت 50 جنيه فقط شاملة :&amp;lt;br /&amp;gt;\r\n1- Lunch break&amp;lt;br /&amp;gt;\r\n2- Certificate for attendee&amp;lt;br /&amp;gt;\r\nالمكان : مكتبة الاسكندرية&amp;lt;br /&amp;gt;\r\nالميعاد : 23-24-25 يونيو', '', '', '', '', 'mega', 0, 1, '23 , 24 , 25 JUNE 2018');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description_1` longtext NOT NULL,
  `description_2` longtext NOT NULL,
  `images` varchar(1023) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `date`, `description_1`, `description_2`, `images`) VALUES
(3, 'Make the Web Better for Everyone', '2017-09-21', ' Now the hard part—what to do about it?<br />\r\nStarting over is impossible. The Web is the ground of our global civilization, a pillar of contemporary existence. Even as we complain about the excesses and shortcomings of the Web, we can’t survive without it.<br />\r\nFor engineers and technovisionaries, the solution flows from an admirable U.S. tradition: building a better mousetrap.<br />\r\nFor redesigners of the broken Web, the popular impulse is to expand digital freedom by creating a Web so decentralized that governments can’t censor it and big corporations can’t dominate.<br />\r\n<br />\r\nHowever noble, the freedom advocates fail to account for a major class of vexations arising from anonymity, which allows, say, Russian hackers to pose as legitimate tweeters and terrorist groups to recruit through Facebook pages.<br />\r\nTo be sure, escape from government surveillance through digital masks has benefits, yet the path to improved governance across the world doesn’t chiefly lie with finding more clever ways to hide from official oppression. More freedom, ultimately, will only spawn more irresponsible, harmful behavior.<br />\r\n<br />\r\nIf more freedom and greater privacy won’t cure what ails the Web, might we consider older forms of control and the cooperation of essential public services?<br />\r\nIn the 19th century, railroads gained such power over the lives of cities and towns across the United States that norms, rules, and laws emerged to impose a modicum of fairness on routes, fares, and services. Similarly, in the 20th century, the Bell telephone network, having gained a “natural” monopoly, came under the supervision of the U.S. government. So did the country’s leading computer company, IBM.<br />\r\n<br />\r\nBecause of government limits, Bell stayed out of the computer business—and licensed its revolutionary transistor to others. IBM’s management, meanwhile, felt pressured by the government to “unbundle” software that came free with its computers, which in one swoop created a nascent software industry that a half century later is the envy of the world.<br />\r\nSince governments can help make innovations fairer, what kind of interventions might the U.S. government make to reform the Web? First, it can support net neutrality. The policy helps sustain wider support for asking Amazon, ­Facebook, and Google to behave as “common carriers,” which must treat their vendors evenhandedly but also police their behavior, disallowing Web fraud in all forms.<br />\r\n<br />\r\nNew obligations on the digital oligarchy are based on the reality that a few companies earn huge profits from the Web; the costs of supervising the Web more closely, and rooting out unhealthy practices, should be viewed as a necessary cost of doing business for these big winners.<br />\r\nFacebook and Google are already trying to combat the impression—and the reality—that their services are too easily harnessed by the malevolent. By using novel automated techniques combined with brute-force methods—human review of such inherently unstable services as live streams—Facebook and Google should be able to dramatically reduce abuses over time.<br />\r\n<br />\r\nSocial engineering is also needed. If you grew up in the United States in the 1960s, you well remember the national campaign against littering. At that time, Americans routinely tossed trash out of their car windows. Within a decade, antilittering campaigns made most Americans ashamed to do so.<br />\r\n<br />\r\nI’m ashamed at how some people abuse the Web, which has many virtues worth preserving. I’m certain that, working with the corporations that profit greatly from the Web—and with national governments, which have the power to reduce abuses while still protecting privacy and freedom of ­expression—we can get closer to the Web experience we all want.<br />\r\n', '', 'images/news/489bed23c378aa0966f8f56f77cad040285cf348.jpg,');

-- --------------------------------------------------------

--
-- Table structure for table `registeration`
--

CREATE TABLE `registeration` (
  `Id` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Mobile` int(11) NOT NULL,
  `NationalId` int(11) NOT NULL,
  `University` varchar(30) NOT NULL,
  `A_status` varchar(20) NOT NULL,
  `IEEEMember` varchar(20) NOT NULL,
  `Code` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registeration`
--

INSERT INTO `registeration` (`Id`, `Name`, `Email`, `Mobile`, `NationalId`, `University`, `A_status`, `IEEEMember`, `Code`, `event_id`) VALUES
(8, 'Karim Soliman Ahmed', 'Ahmed_ibrahim@pua.edu.eg', 2341, 3421, 'Pharos Univeristy', 'Undergraduate', 'Member', 182802003, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `admin`) VALUES
(1, 'd033e22ae348aeb5660fc2140aec35850c4da997', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin@admin.com', 1),
(2, '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'staff', 'staff@staff.com', 2),
(3, '6467baa3b187373e3931422e2a8ef22f3e447d77', '6467baa3b187373e3931422e2a8ef22f3e447d77', 'member', 'member@member.com', 0),
(4, '6bc975fade974a1c5dd2cd1545ca4e318171d407', '6bc975fade974a1c5dd2cd1545ca4e318171d407', 'substaff', 'substaff@substaff.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Committee` varchar(255) NOT NULL,
  `Img` varchar(255) NOT NULL,
  `Facebook` varchar(255) NOT NULL DEFAULT '#',
  `Linkedin` varchar(255) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`ID`, `Name`, `Committee`, `Img`, `Facebook`, `Linkedin`) VALUES
(1, 'xx', 'xxx', 'images/volunteers/581c52cbc3a21951d1a8b76d1874397265cf61aa.jpg', 'xxx', 'xx'),
(3, 'xx', 'xxx', 'images/volunteers/581c52cbc3a21951d1a8b76d1874397265cf61aa.jpg', 'xxx', 'xx'),
(4, 'ii', 'iii', 'images/volunteers/7b2d680da2fa1361e4bd0c4494c60a9266988e31.jpg', 'iiii', 'iii');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_ibfk_1` (`event_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registeration`
--
ALTER TABLE `registeration`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `NationalId` (`NationalId`),
  ADD UNIQUE KEY `Mobile` (`Mobile`),
  ADD UNIQUE KEY `Code` (`Code`),
  ADD KEY `event_id` (`event_id`);
ALTER TABLE `registeration` ADD FULLTEXT KEY `Name` (`Name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registeration`
--
ALTER TABLE `registeration`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registeration`
--
ALTER TABLE `registeration`
  ADD CONSTRAINT `registeration_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
