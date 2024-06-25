-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2024 pada 11.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metode_knn`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `poll_votes`
--

CREATE TABLE `poll_votes` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vote` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `poll_votes`
--

INSERT INTO `poll_votes` (`id`, `poll_id`, `user_id`, `vote`) VALUES
(1, 1, 0, 'option1'),
(2, 1, 0, 'option1'),
(3, 2, 0, 'option2'),
(4, 2, 0, 'option2'),
(5, 2, 0, 'option1'),
(6, 2, 0, 'option3'),
(7, 1, 0, 'option2'),
(8, 2, 0, 'option1'),
(9, 2, 0, 'option1'),
(10, 1, 0, 'option2'),
(11, 2, 0, 'option1'),
(12, 1, 0, 'option2'),
(13, 2, 0, 'option2'),
(14, 1, 0, 'option2'),
(15, 2, 0, 'option2'),
(16, 1, 0, 'option3'),
(17, 2, 0, 'option2'),
(18, 1, 0, 'option2'),
(19, 2, 0, 'option1'),
(20, 1, 0, 'option1'),
(21, 2, 0, 'option3'),
(22, 1, 0, 'option3'),
(23, 2, 0, 'option2'),
(24, 1, 0, 'option3'),
(25, 2, 0, 'option1'),
(26, 1, 0, 'option2'),
(27, 2, 0, 'option3'),
(28, 1, 0, 'option3'),
(29, 2, 0, 'option3'),
(30, 1, 0, 'option1'),
(31, 2, 0, 'option1'),
(32, 1, 0, 'option2'),
(33, 2, 0, 'option3'),
(34, 1, 0, 'option2'),
(35, 1, 0, 'option3'),
(36, 2, 0, 'option2'),
(37, 2, 0, 'option1'),
(38, 1, 0, 'option3'),
(39, 2, 0, 'option3'),
(40, 2, 0, 'option3'),
(41, 1, 0, 'option2'),
(42, 2, 0, 'option3'),
(43, 2, 0, 'option1'),
(44, 2, 0, 'option3'),
(45, 1, 0, 'option1'),
(46, 2, 0, 'option3'),
(47, 1, 0, 'option3'),
(48, 2, 0, 'option3'),
(49, 2, 0, 'option1'),
(50, 2, 0, 'option1'),
(51, 1, 0, 'option3'),
(52, 1, 0, 'option2'),
(53, 2, 0, 'option3'),
(54, 1, 0, 'option2'),
(55, 2, 0, 'option3'),
(56, 1, 0, 'option1'),
(57, 2, 0, 'option3'),
(58, 1, 0, 'option2'),
(59, 2, 0, 'option3'),
(60, 1, 0, 'option2'),
(61, 2, 0, 'option3'),
(62, 1, 0, 'option3'),
(63, 2, 0, 'option3'),
(64, 1, 0, 'option2'),
(65, 1, 0, 'option3'),
(66, 2, 0, 'option3'),
(67, 2, 0, 'option1'),
(68, 1, 0, 'option1'),
(69, 2, 0, 'option1'),
(70, 1, 0, 'option2'),
(71, 1, 0, 'option1'),
(72, 2, 0, 'option3'),
(73, 2, 0, 'option1'),
(74, 1, 0, 'option2'),
(75, 2, 0, 'option1'),
(76, 2, 0, 'option1'),
(77, 1, 0, 'option1'),
(78, 2, 0, 'option2'),
(79, 1, 0, 'option3'),
(80, 2, 0, 'option1'),
(81, 1, 0, 'option2'),
(82, 1, 0, 'option3'),
(83, 2, 0, 'option3'),
(84, 2, 0, 'option1'),
(85, 1, 0, 'option3'),
(86, 1, 0, 'option2'),
(87, 2, 0, 'option1'),
(88, 1, 0, 'option1'),
(89, 1, 0, 'option3'),
(90, 1, 0, 'option3'),
(91, 1, 0, 'option1'),
(92, 2, 0, 'option3'),
(93, 2, 0, 'option3'),
(94, 2, 0, 'option3'),
(95, 2, 0, 'option3'),
(96, 2, 0, 'option3'),
(97, 1, 0, 'option2'),
(98, 2, 0, 'option3'),
(99, 1, 0, 'option2'),
(100, 2, 0, 'option1'),
(101, 1, 0, 'option3'),
(102, 2, 0, 'option3'),
(103, 1, 0, 'option3'),
(104, 2, 0, 'option2'),
(105, 1, 0, 'option3'),
(106, 2, 0, 'option2'),
(107, 1, 0, 'option2'),
(108, 2, 0, 'option3'),
(109, 1, 0, 'option3'),
(110, 2, 0, 'option1'),
(111, 1, 0, 'option3'),
(112, 2, 0, 'option2'),
(113, 1, 0, 'option3'),
(114, 2, 0, 'option3'),
(115, 1, 0, 'option3'),
(116, 2, 0, 'option2'),
(117, 2, 0, 'option3'),
(118, 1, 0, 'option3'),
(119, 1, 0, 'option2'),
(120, 2, 0, 'option1'),
(121, 1, 0, 'option3'),
(122, 1, 0, 'option3'),
(123, 2, 0, 'option3'),
(124, 1, 0, 'option3'),
(125, 2, 0, 'option2'),
(126, 1, 0, 'option3'),
(127, 2, 0, 'option3'),
(128, 2, 0, 'option3'),
(129, 1, 0, 'option2'),
(130, 2, 0, 'option3'),
(131, 1, 0, 'option3'),
(132, 1, 0, 'option2'),
(133, 2, 0, 'option3'),
(134, 2, 0, 'option3'),
(135, 1, 0, 'option2'),
(136, 1, 0, 'option2'),
(137, 2, 0, 'option3'),
(138, 2, 0, 'option1'),
(139, 1, 0, 'option2'),
(140, 2, 0, 'option3'),
(141, 1, 0, 'option2'),
(142, 2, 0, 'option2'),
(143, 1, 0, 'option2'),
(144, 2, 0, 'option3'),
(145, 2, 0, 'option1'),
(146, 1, 0, 'option1'),
(147, 2, 0, 'option1'),
(148, 1, 0, 'option1'),
(149, 2, 0, 'option3'),
(150, 1, 0, 'option2'),
(151, 2, 0, 'option3'),
(152, 1, 0, 'option1'),
(153, 2, 0, 'option2'),
(154, 1, 0, 'option3'),
(155, 2, 0, 'option3'),
(156, 2, 0, 'option2'),
(157, 1, 0, 'option1'),
(158, 2, 0, 'option3'),
(159, 1, 0, 'option2'),
(160, 2, 0, 'option1'),
(161, 2, 0, 'option3'),
(162, 1, 0, 'option3'),
(163, 2, 0, 'option1'),
(164, 1, 0, 'option2'),
(165, 2, 0, 'option2'),
(166, 1, 0, 'option3'),
(167, 2, 0, 'option3'),
(168, 1, 0, 'option3'),
(169, 2, 0, 'option3'),
(170, 2, 0, 'option3'),
(171, 2, 0, 'option3'),
(172, 1, 0, 'option1'),
(173, 1, 0, 'option3'),
(174, 2, 0, 'option3'),
(175, 1, 0, 'option3'),
(176, 2, 0, 'option2'),
(177, 2, 0, 'option1'),
(178, 1, 0, 'option2'),
(179, 2, 0, 'option3'),
(180, 1, 0, 'option2'),
(181, 2, 0, 'option2'),
(182, 1, 0, 'option3'),
(183, 2, 0, 'option3'),
(184, 2, 0, 'option3'),
(185, 1, 0, 'option3'),
(186, 2, 0, 'option3'),
(187, 1, 0, 'option3'),
(188, 2, 0, 'option2'),
(189, 2, 0, 'option1'),
(190, 2, 0, 'option2'),
(191, 1, 0, 'option1'),
(192, 2, 0, 'option1'),
(193, 1, 0, 'option2'),
(194, 2, 0, 'option3'),
(195, 2, 0, 'option3'),
(196, 1, 0, 'option1'),
(197, 2, 0, 'option1'),
(198, 2, 0, 'option3'),
(199, 1, 0, 'option3'),
(200, 2, 0, 'option3'),
(201, 2, 0, 'option3'),
(202, 2, 0, 'option3'),
(203, 2, 0, 'option3'),
(204, 2, 0, 'option3'),
(205, 1, 0, 'option2'),
(206, 2, 0, 'option3'),
(207, 1, 0, 'option3'),
(208, 2, 0, 'option3'),
(209, 2, 0, 'option1'),
(210, 1, 0, 'option2'),
(211, 2, 0, 'option3'),
(212, 1, 0, 'option3'),
(213, 2, 0, 'option3'),
(214, 1, 0, 'option3'),
(215, 2, 0, 'option2'),
(216, 1, 0, 'option2'),
(217, 2, 0, 'option1'),
(218, 2, 0, 'option1'),
(219, 2, 0, 'option3'),
(220, 1, 0, 'option3'),
(221, 2, 0, 'option2'),
(222, 1, 0, 'option3'),
(223, 1, 0, 'option3'),
(224, 2, 0, 'option1'),
(225, 2, 0, 'option1'),
(226, 1, 0, 'option2'),
(227, 2, 0, 'option3'),
(228, 2, 0, 'option3'),
(229, 1, 0, 'option1'),
(230, 2, 0, 'option3'),
(231, 1, 0, 'option1'),
(232, 2, 0, 'option3'),
(233, 2, 0, 'option3'),
(234, 1, 0, 'option3'),
(235, 2, 0, 'option2'),
(236, 2, 0, 'option2'),
(237, 1, 0, 'option3'),
(238, 2, 0, 'option1'),
(239, 2, 0, 'option1'),
(240, 1, 0, 'option1'),
(241, 2, 0, 'option3'),
(242, 1, 0, 'option3'),
(243, 2, 0, 'option2'),
(244, 1, 0, 'option3'),
(245, 2, 0, 'option3'),
(246, 2, 0, 'option2'),
(247, 1, 0, 'option3'),
(248, 2, 0, 'option3'),
(249, 1, 0, 'option3'),
(250, 2, 0, 'option2'),
(251, 2, 0, 'option2'),
(252, 1, 0, 'option3'),
(253, 2, 0, 'option3'),
(254, 1, 0, 'option2'),
(255, 2, 0, 'option1'),
(256, 1, 0, 'option1'),
(257, 2, 0, 'option2'),
(258, 1, 0, 'option3'),
(259, 2, 0, 'option3'),
(260, 1, 0, 'option1'),
(261, 2, 0, 'option3'),
(262, 1, 0, 'option2'),
(263, 2, 0, 'option3'),
(264, 2, 0, 'option3'),
(265, 1, 0, 'option3'),
(266, 2, 0, 'option3'),
(267, 1, 0, 'option2'),
(268, 2, 0, 'option1'),
(269, 1, 0, 'option1'),
(270, 2, 0, 'option1'),
(271, 2, 0, 'option3'),
(272, 1, 0, 'option3'),
(273, 2, 0, 'option3'),
(274, 1, 0, 'option1'),
(275, 2, 0, 'option1'),
(276, 2, 0, 'option2'),
(277, 1, 0, 'option3'),
(278, 2, 0, 'option2'),
(279, 1, 0, 'option3'),
(280, 2, 0, 'option1'),
(281, 1, 0, 'option2'),
(282, 2, 0, 'option1'),
(283, 2, 0, 'option2'),
(284, 1, 0, 'option3'),
(285, 2, 0, 'option1'),
(286, 1, 0, 'option2'),
(287, 1, 0, 'option2'),
(288, 2, 0, 'option3'),
(289, 1, 0, 'option2'),
(290, 2, 0, 'option3'),
(291, 1, 0, 'option3'),
(292, 2, 0, 'option1'),
(293, 2, 0, 'option1'),
(294, 1, 0, 'option2'),
(295, 1, 0, 'option3'),
(296, 1, 0, 'option2'),
(297, 2, 0, 'option2'),
(298, 1, 0, 'option1'),
(299, 2, 0, 'option3'),
(300, 2, 0, 'option3'),
(301, 2, 0, 'option3'),
(302, 1, 0, 'option3'),
(303, 1, 0, 'option3'),
(304, 1, 0, 'option3'),
(305, 1, 0, 'option3'),
(306, 1, 0, 'option3'),
(307, 2, 0, 'option3'),
(308, 1, 0, 'option3'),
(309, 1, 0, 'option3'),
(310, 2, 0, 'option3'),
(311, 2, 0, 'option3'),
(312, 1, 0, 'option3'),
(313, 2, 0, 'option3'),
(314, 1, 0, 'option3'),
(315, 2, 0, 'option3'),
(316, 1, 0, 'option3'),
(317, 1, 0, 'option3'),
(318, 2, 0, 'option3'),
(319, 2, 0, 'option3'),
(320, 2, 0, 'option3'),
(321, 1, 0, 'option3'),
(322, 2, 0, 'option3'),
(323, 1, 0, 'option3'),
(324, 1, 0, 'option3'),
(325, 1, 0, 'option3'),
(326, 2, 0, 'option3'),
(327, 2, 0, 'option3'),
(328, 1, 0, 'option3'),
(329, 2, 0, 'option3'),
(330, 1, 0, 'option3'),
(331, 2, 0, 'option3'),
(332, 1, 0, 'option3'),
(333, 1, 0, 'option3'),
(334, 1, 0, 'option3'),
(335, 1, 0, 'option3'),
(336, 1, 0, 'option3'),
(337, 2, 0, 'option3'),
(338, 2, 0, 'option3'),
(339, 1, 0, 'option3'),
(340, 2, 0, 'option1'),
(341, 1, 0, 'option1'),
(342, 2, 0, 'option1'),
(343, 2, 0, 'option1'),
(344, 2, 0, 'option1'),
(345, 2, 0, 'option1'),
(346, 2, 0, 'option2'),
(347, 1, 0, 'option3'),
(348, 1, 0, 'option3'),
(349, 1, 0, 'option3'),
(350, 1, 0, 'option3'),
(351, 1, 0, 'option3'),
(352, 1, 0, 'option3'),
(353, 2, 0, 'option3'),
(354, 2, 0, 'option3'),
(355, 1, 0, 'option1'),
(356, 2, 0, 'option1'),
(357, 1, 0, 'option1'),
(358, 2, 0, 'option1'),
(359, 2, 0, 'option1'),
(360, 2, 0, 'option1'),
(361, 2, 0, 'option1'),
(362, 2, 0, 'option1'),
(363, 2, 0, 'option1'),
(364, 1, 0, 'option1'),
(365, 2, 0, 'option1'),
(366, 1, 0, 'option1'),
(367, 1, 0, 'option1'),
(368, 2, 0, 'option3'),
(369, 2, 0, 'option3'),
(370, 2, 0, 'option3'),
(371, 1, 0, 'option3'),
(372, 1, 0, 'option3'),
(373, 1, 0, 'option3'),
(374, 2, 0, 'option2'),
(375, 1, 0, 'option3'),
(376, 1, 0, 'option3'),
(377, 1, 0, 'option3'),
(378, 2, 0, 'option1'),
(379, 1, 0, 'option3'),
(380, 2, 0, 'option1'),
(381, 2, 0, 'option3'),
(382, 1, 0, 'option3'),
(383, 2, 0, 'option3'),
(384, 1, 0, 'option2'),
(385, 1, 0, 'option3'),
(386, 2, 0, 'option2'),
(387, 2, 0, 'option1'),
(388, 2, 0, 'option3'),
(389, 2, 0, 'option3'),
(390, 1, 0, 'option3'),
(391, 2, 0, 'option1'),
(392, 2, 0, 'option2'),
(393, 2, 0, 'option2'),
(394, 2, 0, 'option2'),
(395, 2, 0, 'option2'),
(396, 2, 0, 'option3'),
(397, 1, 0, 'option3'),
(398, 2, 0, 'option3'),
(399, 1, 0, 'option3'),
(400, 2, 0, 'option3'),
(401, 2, 0, 'option2'),
(402, 1, 0, 'option2'),
(403, 2, 0, 'option3'),
(404, 2, 0, 'option2'),
(405, 2, 0, 'option1'),
(406, 2, 0, 'option2'),
(407, 1, 0, 'option2'),
(408, 1, 0, 'option2'),
(409, 2, 0, 'option3'),
(410, 2, 0, 'option3'),
(411, 2, 0, 'option3'),
(412, 1, 0, 'option2'),
(413, 2, 0, 'option3'),
(414, 1, 0, 'option3'),
(415, 2, 0, 'option3'),
(416, 2, 0, 'option1'),
(417, 2, 0, 'option2'),
(418, 1, 0, 'option2'),
(419, 2, 0, 'option3'),
(420, 1, 0, 'option2'),
(421, 2, 0, 'option1'),
(422, 2, 0, 'option1'),
(423, 2, 0, 'option2'),
(424, 2, 0, 'option1'),
(425, 1, 0, 'option1'),
(426, 1, 0, 'option3'),
(427, 2, 0, 'option2'),
(428, 1, 0, 'option2'),
(429, 1, 0, 'option2'),
(430, 2, 0, 'option2'),
(431, 2, 0, 'option2'),
(432, 1, 0, 'option2'),
(433, 2, 0, 'option1'),
(434, 2, 0, 'option2'),
(435, 2, 0, 'option3'),
(436, 2, 0, 'option3'),
(437, 1, 0, 'option3'),
(438, 1, 0, 'option3'),
(439, 2, 0, 'option1'),
(440, 2, 0, 'option2'),
(441, 1, 0, 'option1'),
(442, 2, 0, 'option3'),
(443, 1, 0, 'option2'),
(444, 2, 0, 'option1'),
(445, 1, 0, 'option2'),
(446, 2, 0, 'option3'),
(447, 2, 0, 'option3'),
(448, 2, 0, 'option3'),
(449, 2, 0, 'option3'),
(450, 2, 0, 'option2'),
(451, 2, 0, 'option2'),
(452, 2, 0, 'option2'),
(453, 2, 0, 'option2'),
(454, 2, 0, 'option2'),
(455, 2, 0, 'option3'),
(456, 2, 0, 'option3'),
(457, 1, 0, 'option2'),
(458, 2, 0, 'option2'),
(459, 1, 0, 'option2'),
(460, 1, 0, 'option2'),
(461, 2, 0, 'option1'),
(462, 2, 0, 'option1'),
(463, 1, 0, 'option3'),
(464, 2, 0, 'option3'),
(465, 2, 0, 'option2'),
(466, 1, 0, 'option2'),
(467, 2, 0, 'option1'),
(468, 2, 0, 'option3'),
(469, 1, 0, 'option3'),
(470, 2, 0, 'option3'),
(471, 2, 0, 'option3'),
(472, 1, 0, 'option3'),
(473, 1, 0, 'option3'),
(474, 1, 0, 'option2'),
(475, 2, 0, 'option3'),
(476, 2, 0, 'option3'),
(477, 2, 0, 'option3'),
(478, 1, 0, 'option3'),
(479, 1, 0, 'option3'),
(480, 2, 0, 'option1'),
(481, 2, 0, 'option3'),
(482, 2, 0, 'option3'),
(483, 1, 0, 'option3'),
(484, 1, 0, 'option3'),
(485, 1, 0, 'option3'),
(486, 2, 0, 'option1'),
(487, 1, 0, 'option3'),
(488, 2, 0, 'option3'),
(489, 1, 0, 'option3'),
(490, 1, 0, 'option3'),
(491, 2, 0, 'option3'),
(492, 1, 0, 'option3'),
(493, 2, 0, 'option3'),
(494, 2, 0, 'option1'),
(495, 0, 0, 'option1'),
(496, 1, 0, 'option1\''),
(497, 1, 0, 'option'),
(498, 1, NULL, 'option'),
(499, 1, 0, 'option1'),
(500, 2, 0, 'option2'),
(501, 2, 0, 'option2'),
(502, 1, 0, 'option3'),
(503, 1, 0, 'option3'),
(504, 1, 0, 'option3'),
(505, 1, 0, 'option3'),
(506, 1, 0, 'option3'),
(507, 1, 0, 'option3'),
(508, 1, 0, 'option3'),
(509, 1, 0, 'option3'),
(510, 1, 0, 'option3'),
(511, 1, 0, 'option3'),
(512, 1, 0, 'option3'),
(513, 1, 0, 'option3'),
(514, 1, 0, 'option3'),
(515, 1, 0, 'option3'),
(516, 1, 0, 'option3'),
(517, 1, 0, 'option3'),
(518, 1, 0, 'option3'),
(519, 1, 0, 'option3'),
(520, 1, 0, 'option3'),
(521, 1, 0, 'option3'),
(522, 1, 0, 'option3'),
(523, 1, 0, 'option3'),
(524, 1, 0, 'option3'),
(525, 1, 0, 'option3'),
(526, 1, 0, 'option3'),
(527, 1, 0, 'option3'),
(528, 1, 0, 'option3'),
(529, 1, 0, 'option3'),
(530, 1, 0, 'option3'),
(531, 2, 0, 'option3'),
(532, 2, 0, 'option3'),
(533, 2, 0, 'option3'),
(534, 2, 0, 'option1'),
(535, 2, 0, 'option3'),
(536, 2, 0, 'option1'),
(537, 2, 0, 'option2'),
(538, 2, 0, 'option3'),
(539, 2, 0, 'option1'),
(540, 2, 0, 'option2'),
(541, 1, 0, 'option3'),
(542, 1, 0, 'option3'),
(543, 2, 0, 'option2'),
(544, 1, 0, 'option3'),
(545, 2, 0, 'option1'),
(546, 1, 0, 'option3'),
(547, 1, 0, 'option3'),
(548, 2, 0, 'option3'),
(549, 1, 0, 'option2'),
(550, 2, 0, 'option1'),
(551, 2, 0, 'option3'),
(552, 2, 0, 'option3'),
(553, 1, 0, 'option2'),
(554, 2, 0, 'option1'),
(555, 2, 0, 'option1'),
(556, 1, 0, 'option3'),
(557, 2, 0, 'option2'),
(558, 1, 0, 'option3'),
(559, 2, 0, 'option3'),
(560, 2, 0, 'option3'),
(561, 1, 0, 'option3'),
(562, 2, 0, 'option3'),
(563, 1, 0, 'option2'),
(564, 2, 0, 'option3'),
(565, 2, 0, 'option3'),
(566, 1, 0, 'option3'),
(567, 2, 0, 'option2'),
(568, 1, 0, 'option2'),
(569, 2, 0, 'option1'),
(570, 1, 0, 'option2'),
(571, 2, 0, 'option3'),
(572, 2, 0, 'option3'),
(573, 2, 0, 'option3'),
(574, 1, 0, 'option2'),
(575, 2, 0, 'option1'),
(576, 1, 0, 'option3'),
(577, 2, 0, 'option1'),
(578, 2, 0, 'option3'),
(579, 1, 0, 'option3'),
(580, 2, 0, 'option2'),
(581, 1, 0, 'option2'),
(582, 1, 0, 'option3'),
(583, 2, 0, 'option3'),
(584, 1, 0, 'option3'),
(585, 2, 0, 'option3'),
(586, 2, 0, 'option3'),
(587, 1, 0, 'option3'),
(588, 2, 0, 'option3'),
(589, 1, 0, 'option3'),
(590, 2, 0, 'option3'),
(591, 2, 0, 'option3'),
(592, 1, 0, 'option2'),
(593, 2, 0, 'option3'),
(594, 1, 0, 'option2'),
(595, 1, 0, 'option3'),
(596, 2, 0, 'option2'),
(597, 1, 0, 'option2'),
(598, 1, 0, 'option1'),
(599, 2, 0, 'option3'),
(600, 2, 0, 'option3'),
(601, 2, 0, 'option1'),
(602, 2, 0, 'option1'),
(603, 2, 0, 'option2'),
(604, 1, 0, 'option1'),
(605, 2, 0, 'option2'),
(606, 2, 0, 'option3'),
(607, 2, 0, 'option1'),
(608, 2, 0, 'option2'),
(609, 1, 0, 'option2'),
(610, 2, 0, 'option2'),
(611, 1, 0, 'option2'),
(612, 2, 0, 'option3'),
(613, 2, 0, 'option3'),
(614, 1, 0, 'option3'),
(615, 2, 0, 'option2'),
(616, 1, 0, 'option2'),
(617, 1, 0, 'option2'),
(618, 2, 0, 'option2'),
(619, 1, 0, 'option1'),
(620, 2, 0, 'option3'),
(621, 1, 0, 'option2'),
(622, 2, 0, 'option3'),
(623, 2, 0, 'option1'),
(624, 1, 0, 'option3'),
(625, 2, 0, 'option3'),
(626, 2, 0, 'option3'),
(627, 1, 0, 'option3'),
(628, 1, 0, 'option3'),
(629, 2, 0, 'option3'),
(630, 1, 0, 'option3'),
(631, 1, 0, 'option1'),
(632, 2, 0, 'option1'),
(633, 2, 0, 'option1'),
(634, 2, 0, 'option1'),
(635, 2, 0, 'option1'),
(636, 2, 0, 'option2'),
(637, 1, 0, 'option3'),
(638, 2, 0, 'option1'),
(639, 1, 0, 'option1'),
(640, 2, 0, 'option3'),
(641, 2, 0, 'option1'),
(642, 1, 0, 'option1'),
(643, 2, 0, 'option3'),
(644, 2, 0, 'option1'),
(645, 1, 0, 'option1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `id_akun` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_akun`
--

INSERT INTO `tbl_akun` (`id_akun`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'Administratorrr', 'Admin', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_analisa`
--

CREATE TABLE `tbl_analisa` (
  `id_analisa` int(11) NOT NULL,
  `nm_analisa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_atribut`
--

CREATE TABLE `tbl_atribut` (
  `id_atribut` int(11) NOT NULL,
  `nm_atribut` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_atribut`
--

INSERT INTO `tbl_atribut` (`id_atribut`, `nm_atribut`) VALUES
(10, 'Jenis Kelamin'),
(11, 'Lokasi'),
(12, 'Skor Kepuasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_class`
--

CREATE TABLE `tbl_class` (
  `id_class` int(11) NOT NULL,
  `nm_class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_class`
--

INSERT INTO `tbl_class` (`id_class`, `nm_class`) VALUES
(4, 'Sangat Puas'),
(5, 'Puas'),
(6, 'Perlu Ditingkatkan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dataset`
--

CREATE TABLE `tbl_dataset` (
  `id_dataset` int(11) NOT NULL,
  `tipe_data` varchar(50) NOT NULL,
  `id_atribut` int(11) NOT NULL,
  `nilai_set` double NOT NULL,
  `id_class` int(11) NOT NULL,
  `ket_data` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `id_hasil` int(11) NOT NULL,
  `tipe_data` varchar(50) NOT NULL,
  `id_class_knn` int(11) NOT NULL,
  `nilai_k` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `tbl_analisa`
--
ALTER TABLE `tbl_analisa`
  ADD PRIMARY KEY (`id_analisa`);

--
-- Indeks untuk tabel `tbl_atribut`
--
ALTER TABLE `tbl_atribut`
  ADD PRIMARY KEY (`id_atribut`);

--
-- Indeks untuk tabel `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indeks untuk tabel `tbl_dataset`
--
ALTER TABLE `tbl_dataset`
  ADD PRIMARY KEY (`id_dataset`);

--
-- Indeks untuk tabel `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=646;

--
-- AUTO_INCREMENT untuk tabel `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_analisa`
--
ALTER TABLE `tbl_analisa`
  MODIFY `id_analisa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_atribut`
--
ALTER TABLE `tbl_atribut`
  MODIFY `id_atribut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_dataset`
--
ALTER TABLE `tbl_dataset`
  MODIFY `id_dataset` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
