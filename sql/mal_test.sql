-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 28 août 2021 à 10:47
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mal_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `animes`
--

CREATE TABLE `animes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `episodes` int(11) DEFAULT NULL,
  `airing` tinyint(4) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL,
  `aired_from` date DEFAULT NULL,
  `aired_to` date DEFAULT NULL,
  `aired` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `score` float DEFAULT NULL,
  `scored_by` int(11) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `synopsis` text DEFAULT NULL,
  `premiered` varchar(11) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `members` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `animes`
--

INSERT INTO `animes` (`id`, `title`, `episodes`, `airing`, `status`, `aired_from`, `aired_to`, `aired`, `duration`, `type_id`, `score`, `scored_by`, `rank`, `synopsis`, `premiered`, `cover`, `members`) VALUES
(356, 'Fate/stay night', 24, 0, 'Finished Airing', '2006-01-07', '2006-06-17', 'Jan 7, 2006 to Jun 17, 2006', '24 min per ep', 1, 7.31, 430513, 2338, 'After a mysterious inferno kills his family, Shirou is saved and adopted by Kiritsugu Emiya, who teaches him the ways of magic and justice. One night, years after Kiritsugu\'s death, Shirou is cleaning at school, when he finds himself caught in the middle of a deadly encounter between two superhumans known as Servants. During his attempt to escape, the boy is caught by one of the Servants and receives a life-threatening injury. Miraculously, he survives, but the same Servant returns to finish what he started. In desperation, Shirou summons a Servant of his own, a knight named Saber. The two must now participate in the Fifth Holy Grail War, a battle royale of seven Servants and the mages who summoned them, with the grand prize being none other than the omnipotent Holy Grail itself. Fate/stay night follows Shirou as he struggles to find the fine line between a hero and a killer, his ideals clashing with the harsh reality around him. Will the boy become a hero like his foster father, or die trying? [Written by MAL Rewrite]', 'Winter 2006', '30327.jpg', 807190),
(6922, 'Fate/stay night Movie: Unlimited Blade Works', 1, 0, 'Finished Airing', '2010-01-23', NULL, 'Jan 23, 2010', '1 hr 40 min', 2, 7.38, 102511, 2010, 'This is the adaptation of the second route of the popular visual novel: Fate/stay night. In this route, Rin Toosaka will be the major female character. Revelations about Shirou and his destiny will be made. (Source: AnimeNfo)', NULL, '95111.jpg', 188534),
(10087, 'Fate/Zero', 13, 0, 'Finished Airing', '2011-10-02', '2011-12-25', 'Oct 2, 2011 to Dec 25, 2011', '28 min per ep', 1, 8.32, 690097, 210, 'With the promise of granting any wish, the omnipotent Holy Grail triggered three wars in the past, each too cruel and fierce to leave a victor. In spite of that, the wealthy Einzbern family is confident that the Fourth Holy Grail War will be different; namely, with a vessel of the Holy Grail now in their grasp. Solely for this reason, the much hated \"Magus Killer\" Kiritsugu Emiya is hired by the Einzberns, with marriage to their only daughter Irisviel as binding contract. Kiritsugu now stands at the center of a cutthroat game of survival, facing off against six other participants, each armed with an ancient familiar, and fueled by unique desires and ideals. Accompanied by his own familiar, Saber, the notorious mercenary soon finds his greatest opponent in Kirei Kotomine, a priest who seeks salvation from the emptiness within himself in pursuit of Kiritsugu. Based on the light novel written by Gen Urobuchi, Fate/Zero depicts the events of the Fourth Holy Grail War—10 years prior to Fate/stay night. Witness a battle royale in which no one is guaranteed to survive. [Written by MAL Rewrite]', 'Fall 2011', '73249.jpg', 1231835),
(11617, 'High School DxD', 12, 0, 'Finished Airing', '2012-01-06', '2012-03-23', 'Jan 6, 2012 to Mar 23, 2012', '24 min per ep', 1, 7.37, 712670, 2077, 'High school student Issei Hyoudou is your run-of-the-mill pervert who does nothing productive with his life, peeping on women and dreaming of having his own harem one day. Things seem to be looking up for Issei when a beautiful girl asks him out on a date, although she turns out to be a fallen angel who brutally kills him! However, he gets a second chance at life when beautiful senior student Rias Gremory, who is a top-class devil, revives him as her servant, recruiting Issei into the ranks of the school\'s Occult Research club. Slowly adjusting to his new life, Issei must train and fight in order to survive in the violent world of angels and devils. Each new adventure leads to many hilarious (and risqué) moments with his new comrades, all the while keeping his new life a secret from his friends and family in High School DxD! [Written by MAL Rewrite]', 'Winter 2012', '111940.jpg', 1146202),
(11741, 'Fate/Zero 2nd Season', 12, 0, 'Finished Airing', '2012-04-08', '2012-06-24', 'Apr 8, 2012 to Jun 24, 2012', '24 min per ep', 1, 8.58, 571172, 75, 'As the Fourth Holy Grail War rages on with no clear victor in sight, the remaining Servants and their Masters are called upon by Church supervisor Risei Kotomine, in order to band together and confront an impending threat that could unravel the Grail War and bring about the destruction of Fuyuki City. The uneasy truce soon collapses as Masters demonstrate that they will do anything in their power, no matter how despicable, to win. Seeds of doubt are sown between Kiritsugu Emiya and Saber, his Servant, as their conflicting ideologies on heroism and chivalry clash. Meanwhile, an ominous bond forms between Kirei Kotomine, who still seeks to find his purpose in life, and one of the remaining Servants. As the countdown to the end of the war reaches zero, the cost of winning begins to blur the line between victory and defeat. [Written by MAL Rewrite]', 'Spring 2012', '41125.jpg', 909710),
(15451, 'High School DxD New', 12, 0, 'Finished Airing', '2013-07-07', '2013-09-22', 'Jul 7, 2013 to Sep 22, 2013', '26 min per ep', 1, 7.51, 490034, 1598, 'The misadventures of Issei Hyoudou, high school pervert and aspiring Harem King, continue on in High School DxD New. As the members of the Occult Research Club carry out their regular activities, it becomes increasingly obvious that there is something wrong with their Knight, the usually composed and alert Yuuto Kiba. Soon, Issei learns of Kiba\'s dark, bloody past and its connection to the mysterious Holy Swords. Once the subject of a cruel experiment, Kiba now seeks revenge on all those who wronged him. With the return of an old enemy, as well as the appearance of two new, Holy Sword-wielding beauties, it isn\'t long before Issei and his Devil comrades are plunged into a twisted plot once more. [Written by MAL Rewrite]', 'Summer 2013', '47729.jpg', 756403),
(24703, 'High School DxD BorN', 12, 0, 'Finished Airing', '2015-04-04', '2015-06-20', 'Apr 4, 2015 to Jun 20, 2015', '24 min per ep', 1, 7.44, 411191, 1803, 'The Red Dragon Emperor, Issei Hyoudou, and the Occult Research Club are back in action as summer break comes for the students of Kuoh Academy. After their fight with Issei’s sworn enemy, Vali and the Chaos Brigade, it is clear just how inexperienced Rias Gremory\'s team is. As a result, she and Azazel lead the club on an intense training regime in the Underworld to prepare them for the challenges that lie ahead. While they slowly mature as a team, Issei will once again find himself in intimate situations with the girls of the Occult Research Club. Meanwhile, their adversaries grow stronger and more numerous as they rally their forces. And with the sudden appearance of Loki, the Evil God of Norse Mythology, the stage is set for epic fights and wickedly powerful devils in High School DxD BorN! [Written by MAL Rewrite]', 'Spring 2015', '73642.jpg', 654740),
(25537, 'Fate/stay night Movie: Heaven\'s Feel - I. Presage Flower', 1, 0, 'Finished Airing', '2017-10-14', NULL, 'Oct 14, 2017', '2 hr', 2, 8.23, 168337, 281, 'The Holy Grail War: a violent battle between mages in which seven masters and their summoned servants fight for the Holy Grail, a magical artifact that can grant the victor any wish. Nearly 10 years ago, the final battle of the Fourth Holy Grail War wreaked havoc on Fuyuki City and took over 500 lives, leaving the city devastated. Shirou Emiya, a survivor of this tragedy, aspires to become a hero of justice like his rescuer and adoptive father, Kiritsugu Emiya. Despite only being a student, Shirou is thrown into the Fifth Holy Grail War when he accidentally sees a battle between servants at school and summons his own servant, Saber. When a mysterious shadow begins a murderous spree in Fuyuki City, Shirou aligns himself with Rin Toosaka, a fellow participant in the Holy Grail War, in order to stop the deaths of countless people. However, Shirou\'s feelings for his close friend Sakura Matou lead him deeper into the dark secrets surrounding the war and the feuding families involved. [Written by MAL Rewrite]', NULL, '102213.jpg', 331682),
(27821, 'Fate/stay night: Unlimited Blade Works Prologue', 1, 0, 'Finished Airing', '2014-10-05', NULL, 'Oct 5, 2014', '51 min', 3, 8.08, 164740, 448, 'In Fuyuki City, a long-lived ritual involving battles between seven magi and their servants is taking place. This ritual is known as the Holy Grail War and it promises to grant the victor any wish. With the war now entering its fifth iteration, the stage is set for Rin Toosaka to succeed her father\'s legacy. Rin wishes to summon Saber, said to be the most powerful class. But when she miscalculates and summons Archer instead, how will she fare in the battles that lie ahead of her? [Written by MAL Rewrite]', NULL, '67425.jpg', 265713),
(34281, 'High School DxD Hero', 12, 0, 'Finished Airing', '2018-04-17', '2018-07-03', 'Apr 17, 2018 to Jul 3, 2018', '23 min per ep', 1, 7.26, 191605, 2569, 'After rescuing his master, Rias Gremory, from the Dimensional Gap, Red Dragon Emperor and aspiring Harem King Issei Hyoudou can finally return to his high school activities alongside fellow members of the Occult Research Club: Yuuto Kiba, Asia Argento, Xenovia Quarta, and Irina Shidou. The group soon embarks on a school trip to Kyoto. While peacefully visiting a temple thanks to Rias\' spell, an attacking group of local youkai breaks the calm atmosphere. Once the altercation ends, the club learns that the mythical nine-tailed fox that protected the city was abducted and that someone has framed them for the act. Issei and his friends will now have to fight to protect the city and save their school trip from a planned disaster! In the meantime, Rias, who had to stay in Tokyo with Akeno Himejima and Koneko Toujou, grows increasingly restless to have left the perverted Issei alone with the other girls of the Occult Research Club. Beyond this vague anxiety, what is the exact nature of the feelings Rias has been struggling with for the past few months? [Written by MAL Rewrite]', 'Spring 2018', '93528.jpg', 372417),
(39247, 'Kobayashi-san Chi no Maid Dragon S', 12, 1, 'Currently Airing', '2021-07-08', '2021-09-23', 'Jul 8, 2021 to Sep 23, 2021', '23 min per ep', 1, 8.43, 40068, 135, 'As Tooru continues on her quest to become the greatest maid and Kanna Kamui fully immerses in her life as an elementary school student, there is not a dull day in the Kobayashi household with mischief being a daily staple. On one such day, however, a massive landslide is spotted on the hill where Kobayashi and Tooru first met—a clear display of a dragon\'s might. When none of the dragons they know claim responsibility, the perpetrator herself descends from the skies: Ilulu, the radical Chaos Dragon with monstrous power rivaling that of Tooru. Sickened by Tooru\'s involvement with humans, Ilulu resorts to the typical dragon method of resolving conflict—a battle to the death. Despite such behavior, she becomes intrigued by Kobayashi\'s ability to befriend dragons and decides instead to observe just what makes Kobayashi so special. With a new troublesome dragon in town, Kobayashi\'s eccentric life with a dragon maid is only getting merrier. [Written by MAL Rewrite]', 'Summer 2021', '115539.jpg', 283127),
(41487, 'Tensei shitara Slime Datta Ken 2nd Season Part 2', 12, 1, 'Currently Airing', '2021-07-06', NULL, 'Jul 6, 2021 to ?', '23 min per ep', 1, 8.38, 54194, 171, 'The nation of Tempest is in a festive mood after successfully overcoming the surprise attack from the Blumund Army and the Western Holy Church. Beyond the festivities lies a meeting between Tempest and its allies to decide the future of the Nation of Monsters. The aftermath of the Blumund invasion, Milim Nava\'s suspicious behavior, and the disappearance of Demon Lord Carrion—the problems seem to keep on piling up. Rimuru Tempest, now awakened as a \"True Demon Lord,\" decides to go on the offensive against Clayman. With the fully revived \"Storm Dragon\" Veldora, \"Ultimate Skill\" Raphael, and other powerful comrades, the ruler of the Tempest is confident in taking down his enemies one by one until he can face the man pulling the strings. [Written by MAL Rewrite]', 'Summer 2021', '116226.jpg', 321568);

-- --------------------------------------------------------

--
-- Structure de la table `animes_genres`
--

CREATE TABLE `animes_genres` (
  `anime_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `animes_genres`
--

INSERT INTO `animes_genres` (`anime_id`, `genre_id`) VALUES
(356, 1),
(356, 2),
(356, 3),
(356, 4),
(356, 5),
(6922, 1),
(6922, 5),
(6922, 3),
(6922, 2),
(10087, 1),
(10087, 2),
(10087, 3),
(10087, 5),
(11617, 6),
(11617, 7),
(11617, 8),
(11617, 4),
(11617, 9),
(11617, 10),
(11741, 1),
(11741, 2),
(11741, 3),
(11741, 5),
(15451, 1),
(15451, 6),
(15451, 7),
(15451, 8),
(15451, 4),
(15451, 9),
(15451, 10),
(24703, 1),
(24703, 7),
(24703, 8),
(24703, 9),
(24703, 6),
(24703, 4),
(24703, 10),
(25537, 1),
(25537, 5),
(25537, 3),
(25537, 2),
(27821, 1),
(27821, 5),
(27821, 3),
(27821, 2),
(34281, 1),
(34281, 6),
(34281, 7),
(34281, 8),
(34281, 4),
(34281, 9),
(34281, 10),
(39247, 11),
(39247, 7),
(39247, 5),
(41487, 1),
(41487, 12),
(41487, 7),
(41487, 8),
(41487, 5),
(41487, 3);

-- --------------------------------------------------------

--
-- Structure de la table `animes_relations`
--

CREATE TABLE `animes_relations` (
  `prequel_id` int(11) NOT NULL,
  `sequel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `animes_relations`
--

INSERT INTO `animes_relations` (`prequel_id`, `sequel_id`) VALUES
(10087, 11741),
(11617, 15451),
(11741, 356),
(11741, 6922),
(11741, 25537),
(11741, 27821),
(15451, 24703),
(24703, 34281);

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(1, 'Action'),
(2, 'Supernatural'),
(3, 'Magic'),
(4, 'Romance'),
(5, 'Fantasy'),
(6, 'Harem'),
(7, 'Comedy'),
(8, 'Demons'),
(9, 'Ecchi'),
(10, 'School'),
(11, 'Slice of Life'),
(12, 'Adventure');

-- --------------------------------------------------------

--
-- Structure de la table `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `list` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `lists`
--

INSERT INTO `lists` (`id`, `list`) VALUES
(1, 'Watching'),
(2, 'Completed'),
(3, 'On Hold'),
(4, 'Dropped'),
(5, 'Plan to Watch');

-- --------------------------------------------------------

--
-- Structure de la table `priorities`
--

CREATE TABLE `priorities` (
  `id` int(11) NOT NULL,
  `priority` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `priorities`
--

INSERT INTO `priorities` (`id`, `priority`) VALUES
(1, 'High'),
(2, 'Medium'),
(3, 'Low');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `theme_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id`, `anime_id`, `theme`, `theme_type`) VALUES
(1, 356, '#1: \"disillusion\" by Tainaka Sachi (eps 1-14)', 'Opening'),
(2, 356, '#2: \"Kirameku Namida wa Hoshi ni (きらめく涙は星に)\" by Tainaka Sachi (eps 15-23)', 'Opening'),
(3, 356, '#1: \"Anata ga Ita Mori (あなたがいた森)\" by Jyukai (eps 1-13, 15-23)', 'Ending'),
(4, 356, '#2: \"Hikari (ヒカリ)\" by Jyukai (ep 14)', 'Ending'),
(5, 356, '#3: \"Kimi to no Ashita (君との明日)\" by Tainaka Sachi (ep 24)', 'Ending'),
(6, 6922, '\"Imitation\" by Tainaka Sachi', 'Opening'),
(7, 6922, '\"Voice ~Tadori Tsuku Basho~\" by Tainaka Sachi', 'Ending'),
(8, 10087, '\"oath sign\" by LiSA (eps 2-10, 12-13)', 'Opening'),
(9, 10087, '#1: \"oath sign\" by LiSA (ep 1)', 'Ending'),
(10, 10087, '#2: \"MEMORIA\" by Eir Aoi (eps 2-13)', 'Ending'),
(11, 11617, '\"Trip -innocent of D-\" by Larval Stage Planning', 'Opening'),
(12, 11617, '#1: \"Trip -innocent of D-\" by Larval Stage Planning (ep 1)', 'Ending'),
(13, 11617, '#2: \"STUDY x STUDY\" by StylipS (eps 2-12)', 'Ending'),
(14, 11741, '\"to the beginning\" by Kalafina (eps 1-4, 7-11)', 'Opening'),
(15, 11741, '#1: \"Sora wa Takaku Kaze wa Utau (空は高く風は歌う)\" by Luna Haruna (eps 1-4, 7-11)', 'Ending'),
(16, 11741, '#2: \"Manten (満天)\" by Kalafina (eps 5, 6)', 'Ending'),
(17, 11741, '#3: \"to the beginning\" by Kalafina (ep 12)', 'Ending'),
(18, 15451, '#1: \"Sympathy\" by Larval Stage Planning (eps 1-6)', 'Opening'),
(19, 15451, '#2: \"Gekijouron (激情論)\" by ZAQ (eps 7-12)', 'Opening'),
(20, 15451, '#1: \"Houteishiki wa Kotaenai (方程式は答えない)\" by Occult Kenkyuubu Girls (Yoko Hikasa, Shizuka Itou, Azumi Asakura, Ayana Taketatsu) (eps 1-6)', 'Ending'),
(21, 15451, '#2: \"Lovely ♥ Devil (らぶりぃ♥でびる)\" by Occult Kenkyuubu Girls (Yoko Hikasa, Shizuka Itou, Azumi Asakura, Ayana Taketatsu, Risa Taneda, Ayane Sakura) (eps 7-12)', 'Ending'),
(22, 24703, '\"BLESS YoUr NAME\" by ChouCho', 'Opening'),
(23, 24703, '#1: \"Give Me Secret (ギブミー・シークレット)\" by StylipS (eps 1-11)', 'Ending'),
(24, 24703, '#2: \"Oppai Dragon no Uta (おっぱいドラゴンの歌)\" by Issei Hyoudou (Yuuki Kaji) (ep 12)', 'Ending'),
(25, 25537, '\"Hana no Uta (花の唄)\" by Aimer', 'Ending'),
(26, 27821, '#1. \"ideal white\" by Ayano Mashiro', 'Ending'),
(27, 27821, '#2. \"Unlimited Blade Works\" composed by Hideyuki Fukasawa', 'Ending'),
(28, 34281, '\"SWITCH\" by Minami', 'Opening'),
(29, 34281, '\"Motenai Kuse ni (モテないくせに(`;ω;´))\" by Tapimiru', 'Ending'),
(30, 39247, '\"Ai no Supreme (愛のシュプリーム！)\" by fhána', 'Opening'),
(31, 39247, '\"Maid with Dragons❤︎ (めいど・うぃず・どらごんず︎❤︎)\" by Super Chorogonzu (スーパーちょろゴンず)', 'Ending'),
(32, 41487, '\"Like Flames\" by MindaRyn', 'Opening'),
(33, 41487, '\"Reincarnate\" by Takuma Terashima', 'Ending');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `type`) VALUES
(1, 'TV'),
(2, 'Movie'),
(3, 'Special');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Normal',
  `signup_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `image`, `role`, `signup_date`) VALUES
(1, 'Razalael', '$2y$10$YjcNY1ge44XxJynRgBLK0uQJtoYLVvoEfCNr9jlKtVGHITGQCq0kK', 'raphaelbleu70@gmail.com', '30327.jpg', 'Admin', '2021-08-23');

-- --------------------------------------------------------

--
-- Structure de la table `users_lists`
--

CREATE TABLE `users_lists` (
  `user_id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `modification_date` datetime NOT NULL DEFAULT current_timestamp(),
  `priority_id` int(11) NOT NULL,
  `progress_episodes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users_lists`
--

INSERT INTO `users_lists` (`user_id`, `anime_id`, `list_id`, `score`, `comment`, `modification_date`, `priority_id`, `progress_episodes`) VALUES
(1, 356, 2, 9, NULL, '2021-08-25 17:03:55', 2, 17),
(1, 15451, 1, NULL, NULL, '2021-08-24 18:04:24', 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Index pour la table `animes_genres`
--
ALTER TABLE `animes_genres`
  ADD KEY `anime_id` (`anime_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Index pour la table `animes_relations`
--
ALTER TABLE `animes_relations`
  ADD PRIMARY KEY (`prequel_id`,`sequel_id`),
  ADD KEY `prequel_id` (`sequel_id`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_lists`
--
ALTER TABLE `users_lists`
  ADD PRIMARY KEY (`user_id`,`anime_id`),
  ADD KEY `anime_id` (`anime_id`),
  ADD KEY `list_id` (`list_id`),
  ADD KEY `priority_id` (`priority_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animes`
--
ALTER TABLE `animes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41488;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animes`
--
ALTER TABLE `animes`
  ADD CONSTRAINT `animes_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Contraintes pour la table `animes_genres`
--
ALTER TABLE `animes_genres`
  ADD CONSTRAINT `animes_genres_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`id`),
  ADD CONSTRAINT `animes_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Contraintes pour la table `animes_relations`
--
ALTER TABLE `animes_relations`
  ADD CONSTRAINT `animes_relations_ibfk_1` FOREIGN KEY (`prequel_id`) REFERENCES `animes` (`id`),
  ADD CONSTRAINT `animes_relations_ibfk_2` FOREIGN KEY (`sequel_id`) REFERENCES `animes` (`id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`id`);

--
-- Contraintes pour la table `themes`
--
ALTER TABLE `themes`
  ADD CONSTRAINT `themes_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`id`);

--
-- Contraintes pour la table `users_lists`
--
ALTER TABLE `users_lists`
  ADD CONSTRAINT `users_lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_lists_ibfk_2` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`id`),
  ADD CONSTRAINT `users_lists_ibfk_3` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`),
  ADD CONSTRAINT `users_lists_ibfk_4` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
