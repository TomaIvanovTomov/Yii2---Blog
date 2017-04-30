-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2017 at 04:29 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letsblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '58', 1490524402),
('admin', '68', 1491553288),
('user', '51', 1490380248),
('user', '52', 1490382763),
('user', '55', 1490470651),
('user', '56', 1490472813),
('user', '57', 1490524228),
('user', '59', 1490524456),
('user', '60', 1490524648),
('user', '61', 1490524717),
('user', '62', 1490524793),
('user', '63', 1491133499),
('user', '64', 1490525389),
('user', '65', 1491551820),
('user', '66', 1491551912),
('user', '67', 1491552118),
('user', '68', 1491553139),
('user', '72', 1493038372);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator', NULL, NULL, 1490379893, 1490379893),
('createPost', 2, 'Create Post', NULL, NULL, 1490379892, 1490379892),
('deletePost', 2, 'Delete Post', NULL, NULL, 1490379892, 1490379892),
('updatePost', 2, 'Update Post', NULL, NULL, 1490379892, 1490379892),
('user', 1, 'User', NULL, NULL, 1490379893, 1490379893);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'user'),
('user', 'createPost'),
('user', 'deletePost'),
('user', 'updatePost');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `message_id` int(11) NOT NULL,
  `message_content` varchar(100) NOT NULL,
  `message_author` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`message_id`, `message_content`, `message_author`) VALUES
(196, 'I am admin! This is test message!', 'Toma'),
(198, 'I am admin! Also testing!', 'Vlado'),
(199, ':message', ':username'),
(200, 'test 2', 'Vlado'),
(205, 'chat chat', 'Toma'),
(206, 'hellooo', 'rrrregister'),
(207, 'test test test', 'Toma'),
(208, 'again testing', 'Toma'),
(209, 'ddasfsdfsdf', 'aaa'),
(210, 'undefined', 'aaa'),
(211, 'asdasda', 'aaa'),
(212, 'dffds', 'Toma'),
(213, 'ddsfsdffds', 'Toma');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `dislike_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`dislike_id`, `user_id`, `comment_id`, `post_id`) VALUES
(33, 68, 0, 59),
(34, 68, 49, 0),
(35, 61, 47, 0),
(36, 61, 0, 88),
(37, 58, 0, 57),
(38, 58, 0, 88),
(39, 76, 0, 130),
(42, 81, 0, 131),
(43, 81, 0, 62);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `comment_id`, `post_id`) VALUES
(92, 58, 37, 0),
(93, 58, 0, 62),
(94, 68, 0, 62),
(95, 68, 47, 0),
(96, 68, 48, 0),
(97, 61, 0, 62),
(99, 58, 47, 0),
(101, 58, 0, 130),
(102, 67, 0, 131),
(105, 78, 0, 131),
(108, 58, 0, 131);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m140506_102106_rbac_init', 1490346878);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_create` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`, `content`, `date_create`) VALUES
(55, 58, 'What is blog!', 'A blog (a truncation of the expression weblog)[1] is a discussion or informational website published on the World Wide Web consisting of discrete, often informal diary-style text entries ("posts"). Posts are typically displayed in reverse chronological order, so that the most recent post appears first, at the top of the web page. Until 2009, blogs were usually the work of a single individual,[citation needed] occasionally of a small group, and often covered a single subject or topic. In the 2010s, "multi-author blogs" (MABs) have developed, with posts written by large numbers of authors and sometimes professionally edited. MABs from newspapers, other media outlets, universities, think tanks, advocacy groups, and similar institutions account for an increasing quantity of blog traffic. The rise of Twitter and other "microblogging" systems helps integrate MABs and single-author blogs into the news media. Blog can also be used as a verb, meaning to maintain or add content to a blog.\r\n\r\nThe emergence and growth of blogs in the late 1990s coincided with the advent of web publishing tools that facilitated the posting of content by non-technical users who did not have much experience with HTML or computer programming. Previously, a knowledge of such technologies as HTML and File Transfer Protocol had been required to publish content on the Web, and as such, early Web users tended to be hackers and computer enthusiasts. In the 2010s, the majority are interactive Web 2.0 websites, allowing visitors to leave online comments, and it is this interactivity that distinguishes them from other static websites.[2] In that sense, blogging can be seen as a form of social networking service. Indeed, bloggers do not only produce content to post on their blogs, but also often build social relations with their readers and other bloggers.[3] However, there are high-readership blogs which do not allow comments.', '03/26/2017'),
(57, 60, 'GCN(Graphic Core Next)', 'Graphics Core Next (GCN)[1] is the codename for both a series of microarchitectures as well as for an instruction set. GCN was developed by AMD for their GPUs as the successor to TeraScale microarchitecture/instruction set. The first product featuring GCN was launched in 2011.[2]\r\n\r\nGCN is used in 28 nm and 14 nm graphics chips in the Radeon HD 7700–7900, HD 8000, R9 240–290, R9 300, and Radeon 400 series of AMD graphics cards. GCN is also used in the AMD Accelerated Processing Units code-named "Temash", "Kabini", "Kaveri", "Carrizo", "Beema" and "Mullins", as well as in Liverpool (PlayStation 4) and Durango (Xbox One).\r\n\r\nGCN is a RISC SIMD (or rather SIMT) microarchitecture contrasting the VLIW SIMD architecture of TeraScale. GCN requires considerably more transistors than TeraScale, but offers advantages for GPGPU computation. It makes the compiler simpler and should also lead to better utilization.[citation needed] GCN implements HyperZ.[3]The GCN instruction set is owned by AMD as well as the X86-64 instruction set. The GCN instruction set has been developed specifically for GPUs (and GPGPU) and e.g. has no micro-operation for division.\r\n\r\nDocumentation is available:\r\n\r\nfor Graphics Core Next instruction set\r\nfor GCN 2nd generation instruction set\r\nfor GCN 3rd generation instruction set\r\nDocumentation for GCN 4th generation instruction set is the same as for the 3rd generation.[4]\r\nAn LLVM code generator (i.e. a compiler back-end) is available for the GCN instruction set.[5] It is used e.g. by Mesa 3D.\r\n\r\nMIAOW is an open-source RTL implementation of the AMD Southern Islands GPGPU instruction set (aka Graphics Core Next).\r\n\r\nIn November 2015, AMD announced the "Boltzmann Initiative". The AMD Boltzmann Initiative shall enable the porting of CUDA-based applications to a common C++ programming model.[6]\r\n\r\nAt the "Super Computing 15" AMD showed their Heterogeneous Compute Compiler (HCC), a headless Linux driver and HSA runtime infrastructure for cluster-class, High Performance Computing (HPC) and the Heterogeneous-compute Interface for Portability (HIP) tool for porting CUDA-based applications to a common C++ programming model.', '03/26/2017'),
(58, 61, 'Advanced Micro Devices(AMD)', 'Advanced Micro Devices, Inc. (AMD) is an American multinational semiconductor company based in Sunnyvale, California, United States, that develops computer processors and related technologies for business and consumer markets. While initially it manufactured its own processors, the company became fabless after GlobalFoundries was spun off in 2009. AMD''s main products include microprocessors, motherboard chipsets, embedded processors and graphics processors for servers, workstations and personal computers, and embedded systems applications.\r\n\r\nAMD is the second-largest supplier and only significant rival to Intel in the market for x86-based microprocessors. Since acquiring ATI in 2006, AMD and its competitor Nvidia have dominated the discrete Graphics Processing Unit (GPU) market.[5]Advanced Micro Devices was formally incorporated on May 1, 1969, by Jerry Sanders, along with seven of his colleagues from Fairchild Semiconductor.[6][7] Sanders, an electrical engineer who was the director of marketing at Fairchild, had like many Fairchild executives, grown frustrated with the increasing lack of support, opportunity, and flexibility within that company, and decided to leave to start his own semiconductor company.[8] The previous year Robert Noyce, who had invented the first practical integrated circuit or microchip in 1959 at Fairchild,[9] had left Fairchild together with Gordon Moore and founded the semiconductor company Intel in July 1968.[10]\r\n\r\nIn September 1969, AMD moved from its temporary location in Santa Clara to Sunnyvale, California.[11] To immediately secure a customer base, AMD initially became a second source supplier of microchips designed by Fairchild and National Semiconductor.[12][13] AMD first focused on producing logic chips.[14] The company guaranteed quality control to United States Military Standard, an advantage in the early computer industry since unreliability in microchips was a distinct problem that customers – including computer manufacturers, the telecommunications industry, and instrument manufacturers – wanted to avoid.[12][15][16][17]\r\n\r\nIn November 1969, the company manufactured its first product, the Am9300, a 4-bit MSI shift register, which began selling in 1970.[17][18] Also in 1970, AMD produced its first proprietary product, the Am2501 logic counter, which was highly successful.[19][20] Its best-selling product in 1971 was the Am2505, the fastest multiplier available.[19][21]\r\n\r\nIn 1971, AMD entered the RAM chip market, beginning with the Am3101, a 64-bit bipolar RAM.[21][22] That year AMD also greatly increased the sales volume of its linear integrated circuits, and by year end the company''s total annual sales reached $4.6 million.[19][23]\r\n\r\nAMD went public in September 1972.[12][24][25] The company was a second source for Intel MOS/LSI circuits by 1973, with products such as Am14/1506 and Am14/1507, dual 100-bit dynamic shift registers.[26][27] By 1975, AMD was producing 212 products – of which 49 were proprietary, including the Am9102 (a static N-channel 1024-bit RAM)[28] and three low-power Schottky MSI circuits: Am25LS07, Am25LS08, and Am25LS09.[29]\r\n\r\nIntel had created the first microprocessor, its 4-bit 4004, in 1971.[30][31] By 1975, AMD entered the microprocessor market with the Am9080, a reverse-engineered clone of the Intel 8080,[32][33][34] and the Am2900 bit-slice microprocessor family.[33] When Intel began installing microcode in its microprocessors in 1976, it entered into a cross-licensing agreement with AMD, granting AMD a copyright license to the microcode in its microprocessors and peripherals, effective October 1976.[29][35][36][37][38]', '03/26/2017'),
(59, 62, 'BEER!!!BEER!!!BEER!!!', 'Beer is the world''s oldest[1][2][3] and most widely consumed[4] alcoholic drink; it is the third most popular drink overall, after water and tea.[5] The production of beer is called brewing, which involves the fermentation of starches, mainly derived from cereal grains—most commonly malted barley, although wheat, maize (corn), and rice are widely used.[6] Most beer is flavoured with hops, which add bitterness and act as a natural preservative, though other flavourings such as herbs or fruit may occasionally be included. The fermentation process causes a natural carbonation effect, although this is often removed during processing, and replaced with forced carbonation.[7] Some of humanity''s earliest known writings refer to the production and distribution of beer: the Code of Hammurabi included laws regulating beer and beer parlours,[8] and "The Hymn to Ninkasi", a prayer to the Mesopotamian goddess of beer, served as both a prayer and as a method of remembering the recipe for beer in a culture with few literate people.[9][10]\r\n\r\nBeer is sold in bottles and cans; it may also be available on draught, particularly in pubs and bars. The brewing industry is a global business, consisting of several dominant multinational companies and many thousands of smaller producers ranging from brewpubs to regional breweries. The strength of beer is usually around 4% to 6% alcohol by volume (abv), although it may vary between 0.5% and 20%, with some breweries creating examples of 40% abv and above.[11] Beer forms part of the culture of beer-drinking nations and is associated with social traditions such as beer festivals, as well as a rich pub culture involving activities like pub crawling, and pub games such as bar billiards.Beer is one of the world''s oldest prepared beverages, possibly dating back to the early Neolithic or 9500 BC[citation needed], when cereal was first farmed,[12] and is recorded in the written history of ancient Iraq and ancient Egypt.[13] Archaeologists speculate that beer was instrumental in the formation of civilisations.[14] Approximately 5000 years ago, workers in the city of Uruk (modern day Iraq) were paid by their employers in beer.[15] During the building of the Great Pyramids in Giza, Egypt, each worker got a daily ration of four to five litres of beer, which served as both nutrition and refreshment that was crucial to the pyramids'' construction.[16]\r\n\r\nThe earliest known chemical evidence of barley beer dates to circa 3500–3100 BC from the site of Godin Tepe in the Zagros Mountains of western Iran.[17][18] Some of the earliest Sumerian writings contain references to beer; examples include a prayer to the goddess Ninkasi, known as "The Hymn to Ninkasi",[19] which served as both a prayer as well as a method of remembering the recipe for beer in a culture with few literate people,[9][10] and the ancient advice (Fill your belly. Day and night make merry) to Gilgamesh, recorded in the Epic of Gilgamesh, by the ale-wife Siduri may, at least in part, have referred to the consumption of beer.[20] The Ebla tablets, discovered in 1974 in Ebla, Syria, show that beer was produced in the city in 2500 BC.[21] A fermented beverage using rice and fruit was made in China around 7000 BC. Unlike sake, mould was not used to saccharify the rice (amylolytic fermentation); the rice was probably prepared for fermentation by mastication or malting.[22][23]', '03/26/2017'),
(60, 67, 'Edward Electronics', 'Extron Electronics, commonly known as Extron, is an ISO 9001:2015 certified[4] manufacturer in the professional AV (audiovisual) market. The company has products that cover fields including: video and computer interfacing, switching, and signal distribution to professional displays and projectors.\r\n\r\nExtron operates over 30 offices and regional training and demonstration facilities[5] around the globe.\r\n\r\nIn 2004, Extron entered the control systems market place and over time has expanded its control system offering to include control processors, button panels, touch panels,[6] and several software solutions.[7]\r\n\r\nIn 2010, it bought the products division of Electrosonic.[8][9]\r\n\r\nIn 2012 it opened its new six-story, 200,000 square foot[10] global headquarters building in Anaheim; including a training center, technical support and marketing offices, and a restaurant called The Ranch.[11]\r\n\r\nIn 2014, the company launched into the lecture capture market with hardware devices for capturing video signals.[12]', '04/07/2017'),
(61, 68, 'Admin Message', 'Guardians are concrete in communicating and cooperative in pursuing their goals. Their greatest strength is logistics. Their most developed intelligence role is either that of the Conservator (Protectors and Providers) or the Administrator (Inspector and Supervisor).\r\n\r\nAs the security-seeking temperament, Guardians are practical and frugal types. They share certain core values, among them the belief in a strong work ethic, the need for people and institutions to be responsible, the importance of following the rules and of serving one''s community. Guardians value experience, and they seek a tangible return on their investments. Believing in common sense, they are not attracted to idle speculation. They are the glue of civilization, maintaining and nurturing institutions that have been established by the dint of hard work. They tend to be conventional and cooperative in their work, wanting to make sure everybody gets what they deserve, no more and no less. They follow the rules and conventions of their cohort or group and expect others to as well.\r\n\r\nInterests: In their education and careers, Guardians'' primary interest is business and commerce, with an eye toward practical applications in managing material things. They are preoccupied with maintaining the morality of their group.[2]\r\n\r\nOrientation: Guardians have a strong sense of duty. They forgo the pleasures of the moment to prepare for unseen eventualities. They regard past events with a sense of resignation. They guard against the corruption of outside influences, and look to past experiences to guide their present choices.\r\n\r\nSelf-image: The Guardians'' self-esteem is based on their dependability; their self-respect on their beneficence; and their self-confidence on their respectability.\r\n\r\nValues: Guardians are concerned about the well-being of people and institutions that they hold dear. They trust authority and seek security. They strive for a sense of belonging and want to be appreciated for their contributions. They aspire to become executives, whether by managing their own households or by running a multinational corporation.\r\n\r\nSocial roles: In romantic relationships, Guardians regard themselves as helpmates, working together with their spouse to establish a secure home. As parents, they focus on raising their children to become productive and law-abiding citizens. In business and social situations, they are stabilizers, establishing procedures and ensuring that the material needs of the group are met.', '04/07/2017'),
(62, 58, 'Text Display', 'A text display is an electronic alphanumeric display device that is mainly or only capable of showing text, or extremely limited graphic characters. This includes electromechanical split-flap displays, vane displays, and flip-disc displays; all-electronic liquid-crystal displays, incandescent eggcrate displays, LED displays, and vacuum fluorescent displays; and even electric nixie tubes.\r\n\r\nThere are several ways to form text for display. A segment display uses lines, while a dot-matrix display uses a grid of dots, and both of these are seen in LCD, LED, VFD, and vane/disc types. For split-flap displays, the characters or words are pre-printed, and for nixie tubes the shapes are also pre-formed. In any case, the display elements are controlled by electronics which activate them in the correct physical and temporal sequence to show the desired information.\r\n\r\nText displays are used in everything from clocks (clock radios, wristwatches) to variable-message signs (departure boards, intelligent transportation systems), because until the late 2000s, they were (and in many cases still are) the least expensive for their purpose.', '04/07/2017'),
(88, 61, 'test', 'test', '04/13/2017'),
(130, 58, 'MySQL', 'MySQL (officially pronounced as /ma? ??skju???l/ "My S-Q-L",[6]) is an open-source relational database management system (RDBMS).[7] Its name is a combination of "My", the name of co-founder Michael Widenius'' daughter,[8] and "SQL", the abbreviation for Structured Query Language. The MySQL development project has made its source code available under the terms of the GNU General Public License, as well as under a variety of proprietary agreements. MySQL was owned and sponsored by a single for-profit firm, the Swedish company MySQL AB, now owned by Oracle Corporation.[9] For proprietary use, several paid editions are available, and offer additional functionality.\r\n\r\nMySQL is a central component of the LAMP open-source web application software stack (and other "AMP" stacks). LAMP is an acronym for "Linux, Apache, MySQL, Perl/PHP/Python". Applications that use the MySQL database include: TYPO3, MODx, Joomla, WordPress, phpBB, MyBB, and Drupal. MySQL is also used in many high-profile, large-scale websites, including Google[10][11] (though not for searches), Facebook,[12][13][14] Twitter,[15] Flickr,[16] and YouTube.[17]', '04/23/2017'),
(131, 67, 'JavaScript dasdadasasd', 'JavaScript (/?d???v??skr?pt/[6]), often abbreviated as "JS", is a high-level, dynamic, untyped, and interpreted run-time language.[7] It has been standardized in the ECMAScript language specification.[8] Alongside HTML and CSS, JavaScript is one of the three core technologies of World Wide Web content production; the majority of websites employ it, and all modern Web browsers support it without the need for plug-ins.[7] JavaScript is prototype-based with first-class functions, making it a multi-paradigm language, supporting object-oriented,[9] imperative, and functional programming styles.[7] It has an API for working with text, arrays, dates and regular expressions, but does not include any I/O, such as networking, storage, or graphics facilities, relying for these upon the host environment in which it is embedded.[8]\r\n\r\nAlthough there are strong outward similarities between JavaScript and Java, including language name, syntax, and respective standard libraries, the two are distinct languages and differ greatly in their design. JavaScript was influenced by programming languages such as Self and Scheme.[10]\r\n\r\nJavaScript is also used in environments that are not Web-based, such as PDF documents, site-specific browsers, and desktop widgets. Newer and faster JavaScript virtual machines (VMs) and platforms built upon them have also increased the popularity of JavaScript for server-side Web applications. On the client side, developers have traditionally implemented JavaScript as an interpreted language, but more recent browsers perform just-in-time compilation. Programmers also use JavaScript in video-game development, in crafting desktop and mobile applications, and in server-side network programming with run-time environments such as Node.js.', '04/23/2017');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` varchar(1000) NOT NULL,
  `date_create` varchar(20) NOT NULL,
  `author_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`comment_id`, `comment_content`, `date_create`, `author_id`, `post_id`) VALUES
(29, 'Testing (Admin test)', '12/04/2017', 58, 67),
(30, 'I am here to ruin everything :)', '12/04/2017', 62, 67),
(31, 'Second test (Admin test)', '12/04/2017', 68, 67),
(32, 'Helloooo :)', '12/04/2017', 61, 67),
(34, 'testing', '13/04/2017', 58, 69),
(47, 'asdsaddsa', '13/04/2017', 68, 62),
(48, 'comment', '13/04/2017', 68, 60),
(49, 'asdad', '13/04/2017', 68, 60),
(56, 'adssdadas', '16/04/2017', 58, 55);

-- --------------------------------------------------------

--
-- Table structure for table `tagpostrelation`
--

CREATE TABLE `tagpostrelation` (
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `relation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagpostrelation`
--

INSERT INTO `tagpostrelation` (`tag_id`, `post_id`, `relation_id`) VALUES
(4, 130, 24),
(2, 130, 25),
(1, 131, 26),
(7, 131, 27),
(2, 132, 28),
(1, 133, 29),
(2, 133, 30),
(3, 133, 31),
(7, 134, 32),
(5, 135, 33),
(4, 135, 34);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'JavaScript'),
(2, 'PHP'),
(3, 'Java'),
(4, 'MySQL'),
(5, 'AJAX'),
(6, 'PJAX'),
(7, 'Framework'),
(8, 'CSharp'),
(9, 'C'),
(10, 'C++');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `repeat_password` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `auth_key` varchar(15) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default-user.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `repeat_password`, `username`, `auth_key`, `image`) VALUES
(58, 'tomasqn@abv.bg', '202cb962ac59075b964b07152d234b70', '', 'Toma', '4tfPVadPS8zScCb', 'admin.png'),
(60, 'stephan@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Stephan', 'LIvj79ETiR7mCOM', 'space.jpg'),
(61, 'buba@abv.bg', '202cb962ac59075b964b07152d234b70', '', 'Buba', 'pNgycL-R3yw2jKL', 'kitty.jpg'),
(62, 'kiro_debeliq@abv.bg', '202cb962ac59075b964b07152d234b70', '', 'Kiro', 'GHffsmZoGFOLrgo', '17498658_10206158795767839_1511228185630802340_n.jpg'),
(67, 'northan@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Edward', 'gDoKxrWmxvTIpbR', 'ed.jpg'),
(68, 'vmilanov@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Vlado', 'Dbx_gGKriuSmA0f', 'vlado.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_messages`
--

CREATE TABLE `users_messages` (
  `message_id` int(11) NOT NULL,
  `message_title` varchar(100) NOT NULL,
  `message_content` text NOT NULL,
  `message_author` varchar(50) NOT NULL,
  `author_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_messages`
--

INSERT INTO `users_messages` (`message_id`, `message_title`, `message_content`, `message_author`, `author_email`) VALUES
(20, 'AMD', 'Advanced Micro Devices, Inc. (AMD) is an American multinational semiconductor company based in Sunnyvale, California, United States, that develops computer processors and related technologies for business and consumer markets. While initially it manufactured its own processors, the company became fabless after GlobalFoundries was spun off in 2009. AMD''s main products include microprocessors, motherboard chipsets, embedded processors and graphics processors for servers, workstations and personal computers, and embedded systems applications.', 'Stephan', 'amdfan@gmail.com'),
(36, 'The Pirates Of The Caribbean', 'Pirates of the Caribbean is a series of fantasy swashbuckler films produced by Jerry Bruckheimer and based on Walt Disney''s theme park ride of the same name. Directors of the series include Gore Verbinski (1–3), Rob Marshall (4), and Joachim Rønning and Espen Sandberg (5). The series was most notably written by Ted Elliott and Terry Rossio (1–4); other writers include Stuart Beattie (1), Jay Wolpert (1), and Jeff Nathanson (5). The stories followed the adventures of Captain Jack Sparrow (Johnny Depp), Will Turner (Orlando Bloom), and Elizabeth Swann (Keira Knightley). Characters such as Hector Barbossa (Geoffrey Rush) and Joshamee Gibbs (Kevin McNally) follow Jack, Will, and Elizabeth in the course of the films. The fourth film featured Philip Swift (Sam Claflin) and Syrena (Àstrid Bergès-Frisbey), while the fifth film will feature Henry Turner (Brenton Thwaites) and Carina Smyth (Kaya Scodelario). The films take place in a fictional historical setting; a world ruled by the British Empire, the East India Company and the Spanish Empire, with pirates representing freedom from the ruling powers.', 'Johny', 'depp@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`dislike_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `likes_ibfk_1` (`user_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `FK_post_commentsusers` (`author_id`),
  ADD KEY `FK_post_commentsposts` (`post_id`);

--
-- Indexes for table `tagpostrelation`
--
ALTER TABLE `tagpostrelation`
  ADD PRIMARY KEY (`relation_id`),
  ADD KEY `FK_TagPostTag` (`tag_id`),
  ADD KEY `FK_TagPostPost` (`post_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_messages`
--
ALTER TABLE `users_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;
--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `dislike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `tagpostrelation`
--
ALTER TABLE `tagpostrelation`
  MODIFY `relation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `users_messages`
--
ALTER TABLE `users_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD CONSTRAINT `dislikes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `FK_post_commentsposts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `FK_post_commentsusers` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tagpostrelation`
--
ALTER TABLE `tagpostrelation`
  ADD CONSTRAINT `FK_TagPostPost` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `FK_TagPostTag` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
