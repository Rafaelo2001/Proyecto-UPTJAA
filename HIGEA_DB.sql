SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-04:00";

--
-- Base de datos: `higea_db`
-- Versión de BD: higea_db V2024.2
-- Inclusion de la tabla `medico` y sus respectivas relaciones.
-- Fecha de última modificación: 20-01-2024
--

CREATE DATABASE `higea_db`;
USE `higea_db`;


DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_columna_edad` ()  NO SQL UPDATE persona
SET edad = calcular_edad(F_nac)$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calcular_edad` (`F_nac` DATE) RETURNS INT(11) NO SQL BEGIN
    DECLARE anos INT;
    SET anos = TIMESTAMPDIFF(YEAR, F_nac, CURDATE());
    RETURN anos;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_ciudad`, `id_estado`, `nombre`) VALUES
(1, 1, 'Maroa'),
(2, 1, 'Puerto Ayacucho'),
(3, 1, 'San Fernando de Atabapo'),
(4, 2, 'Anaco'),
(5, 2, 'Aragua de Barcelona'),
(6, 2, 'Barcelona'),
(7, 2, 'Boca de Uchire'),
(8, 2, 'Cantaura'),
(9, 2, 'Clarines'),
(10, 2, 'El Chaparro'),
(11, 2, 'El Pao Anzoátegui'),
(12, 2, 'El Tigre'),
(13, 2, 'El Tigrito'),
(14, 2, 'Guanape'),
(15, 2, 'Guanta'),
(16, 2, 'Lechería'),
(17, 2, 'Onoto'),
(18, 2, 'Pariaguán'),
(19, 2, 'Píritu'),
(20, 2, 'Puerto La Cruz'),
(21, 2, 'Puerto Píritu'),
(22, 2, 'Sabana de Uchire'),
(23, 2, 'San Mateo Anzoátegui'),
(24, 2, 'San Pablo Anzoátegui'),
(25, 2, 'San Tomé'),
(26, 2, 'Santa Ana de Anzoátegui'),
(27, 2, 'Santa Fe Anzoátegui'),
(28, 2, 'Santa Rosa'),
(29, 2, 'Ciudad Orinoco'),
(30, 2, 'Urica'),
(31, 2, 'Valle de Guanape'),
(43, 3, 'Achaguas'),
(44, 3, 'Biruaca'),
(45, 3, 'Bruzual'),
(46, 3, 'El Amparo'),
(47, 3, 'El Nula'),
(48, 3, 'Elorza'),
(49, 3, 'Guasdualito'),
(50, 3, 'Mantecal'),
(51, 3, 'Puerto Páez'),
(52, 3, 'San Fernando de Apure'),
(53, 3, 'San Juan de Payara'),
(54, 4, 'Barbacoas'),
(55, 4, 'Cagua'),
(56, 4, 'Camatagua'),
(58, 4, 'Choroní'),
(59, 4, 'Colonia Tovar'),
(60, 4, 'El Consejo'),
(61, 4, 'La Victoria'),
(62, 4, 'Las Tejerías'),
(63, 4, 'Magdaleno'),
(64, 4, 'Maracay'),
(65, 4, 'Ocumare de La Costa'),
(66, 4, 'Palo Negro'),
(67, 4, 'San Casimiro'),
(68, 4, 'San Mateo'),
(69, 4, 'San Sebastián'),
(70, 4, 'Santa Cruz de Aragua'),
(71, 4, 'Tocorón'),
(72, 4, 'Turmero'),
(73, 4, 'Villa de Cura'),
(74, 4, 'Zuata'),
(75, 5, 'Barinas'),
(76, 5, 'Barinitas'),
(77, 5, 'Barrancas'),
(78, 5, 'Calderas'),
(79, 5, 'Capitanejo'),
(80, 5, 'Ciudad Bolivia'),
(81, 5, 'El Cantón'),
(82, 5, 'Las Veguitas'),
(83, 5, 'Libertad de Barinas'),
(84, 5, 'Sabaneta'),
(85, 5, 'Santa Bárbara de Barinas'),
(86, 5, 'Socopó'),
(87, 6, 'Caicara del Orinoco'),
(88, 6, 'Canaima'),
(89, 6, 'Ciudad Bolívar'),
(90, 6, 'Ciudad Piar'),
(91, 6, 'El Callao'),
(92, 6, 'El Dorado'),
(93, 6, 'El Manteco'),
(94, 6, 'El Palmar'),
(95, 6, 'El Pao'),
(96, 6, 'Guasipati'),
(97, 6, 'Guri'),
(98, 6, 'La Paragua'),
(99, 6, 'Matanzas'),
(100, 6, 'Puerto Ordaz'),
(101, 6, 'San Félix'),
(102, 6, 'Santa Elena de Uairén'),
(103, 6, 'Tumeremo'),
(104, 6, 'Unare'),
(105, 6, 'Upata'),
(106, 7, 'Bejuma'),
(107, 7, 'Belén'),
(108, 7, 'Campo de Carabobo'),
(109, 7, 'Canoabo'),
(110, 7, 'Central Tacarigua'),
(111, 7, 'Chirgua'),
(112, 7, 'Ciudad Alianza'),
(113, 7, 'El Palito'),
(114, 7, 'Guacara'),
(115, 7, 'Guigue'),
(116, 7, 'Las Trincheras'),
(117, 7, 'Los Guayos'),
(118, 7, 'Mariara'),
(119, 7, 'Miranda'),
(120, 7, 'Montalbán'),
(121, 7, 'Morón'),
(122, 7, 'Naguanagua'),
(123, 7, 'Puerto Cabello'),
(124, 7, 'San Joaquín'),
(125, 7, 'Tocuyito'),
(126, 7, 'Urama'),
(127, 7, 'Valencia'),
(128, 7, 'Vigirimita'),
(129, 8, 'Aguirre'),
(130, 8, 'Apartaderos Cojedes'),
(131, 8, 'Arismendi'),
(132, 8, 'Camuriquito'),
(133, 8, 'El Baúl'),
(134, 8, 'El Limón'),
(135, 8, 'El Pao Cojedes'),
(136, 8, 'El Socorro'),
(137, 8, 'La Aguadita'),
(138, 8, 'Las Vegas'),
(139, 8, 'Libertad de Cojedes'),
(140, 8, 'Mapuey'),
(141, 8, 'Piñedo'),
(142, 8, 'Samancito'),
(143, 8, 'San Carlos'),
(144, 8, 'Sucre'),
(145, 8, 'Tinaco'),
(146, 8, 'Tinaquillo'),
(147, 8, 'Vallecito'),
(148, 9, 'Tucupita'),
(149, 24, 'Caracas'),
(150, 24, 'El Junquito'),
(151, 10, 'Adícora'),
(152, 10, 'Boca de Aroa'),
(153, 10, 'Cabure'),
(154, 10, 'Capadare'),
(155, 10, 'Capatárida'),
(156, 10, 'Chichiriviche'),
(157, 10, 'Churuguara'),
(158, 10, 'Coro'),
(159, 10, 'Cumarebo'),
(160, 10, 'Dabajuro'),
(161, 10, 'Judibana'),
(162, 10, 'La Cruz de Taratara'),
(163, 10, 'La Vela de Coro'),
(164, 10, 'Los Taques'),
(165, 10, 'Maparari'),
(166, 10, 'Mene de Mauroa'),
(167, 10, 'Mirimire'),
(168, 10, 'Pedregal'),
(169, 10, 'Píritu Falcón'),
(170, 10, 'Pueblo Nuevo Falcón'),
(171, 10, 'Puerto Cumarebo'),
(172, 10, 'Punta Cardón'),
(173, 10, 'Punto Fijo'),
(174, 10, 'San Juan de Los Cayos'),
(175, 10, 'San Luis'),
(176, 10, 'Santa Ana Falcón'),
(177, 10, 'Santa Cruz De Bucaral'),
(178, 10, 'Tocopero'),
(179, 10, 'Tocuyo de La Costa'),
(180, 10, 'Tucacas'),
(181, 10, 'Yaracal'),
(182, 11, 'Altagracia de Orituco'),
(183, 11, 'Cabruta'),
(184, 11, 'Calabozo'),
(185, 11, 'Camaguán'),
(196, 11, 'Chaguaramas Guárico'),
(197, 11, 'El Socorro'),
(198, 11, 'El Sombrero'),
(199, 11, 'Las Mercedes de Los Llanos'),
(200, 11, 'Lezama'),
(201, 11, 'Onoto'),
(202, 11, 'Ortíz'),
(203, 11, 'San José de Guaribe'),
(204, 11, 'San Juan de Los Morros'),
(205, 11, 'San Rafael de Laya'),
(206, 11, 'Santa María de Ipire'),
(207, 11, 'Tucupido'),
(208, 11, 'Valle de La Pascua'),
(209, 11, 'Zaraza'),
(210, 12, 'Aguada Grande'),
(211, 12, 'Atarigua'),
(212, 12, 'Barquisimeto'),
(213, 12, 'Bobare'),
(214, 12, 'Cabudare'),
(215, 12, 'Carora'),
(216, 12, 'Cubiro'),
(217, 12, 'Cují'),
(218, 12, 'Duaca'),
(219, 12, 'El Manzano'),
(220, 12, 'El Tocuyo'),
(221, 12, 'Guaríco'),
(222, 12, 'Humocaro Alto'),
(223, 12, 'Humocaro Bajo'),
(224, 12, 'La Miel'),
(225, 12, 'Moroturo'),
(226, 12, 'Quíbor'),
(227, 12, 'Río Claro'),
(228, 12, 'Sanare'),
(229, 12, 'Santa Inés'),
(230, 12, 'Sarare'),
(231, 12, 'Siquisique'),
(232, 12, 'Tintorero'),
(233, 13, 'Apartaderos Mérida'),
(234, 13, 'Arapuey'),
(235, 13, 'Bailadores'),
(236, 13, 'Caja Seca'),
(237, 13, 'Canaguá'),
(238, 13, 'Chachopo'),
(239, 13, 'Chiguara'),
(240, 13, 'Ejido'),
(241, 13, 'El Vigía'),
(242, 13, 'La Azulita'),
(243, 13, 'La Playa'),
(244, 13, 'Lagunillas Mérida'),
(245, 13, 'Mérida'),
(246, 13, 'Mesa de Bolívar'),
(247, 13, 'Mucuchíes'),
(248, 13, 'Mucujepe'),
(249, 13, 'Mucuruba'),
(250, 13, 'Nueva Bolivia'),
(251, 13, 'Palmarito'),
(252, 13, 'Pueblo Llano'),
(253, 13, 'Santa Cruz de Mora'),
(254, 13, 'Santa Elena de Arenales'),
(255, 13, 'Santo Domingo'),
(256, 13, 'Tabáy'),
(257, 13, 'Timotes'),
(258, 13, 'Torondoy'),
(259, 13, 'Tovar'),
(260, 13, 'Tucani'),
(261, 13, 'Zea'),
(262, 14, 'Araguita'),
(263, 14, 'Carrizal'),
(264, 14, 'Caucagua'),
(265, 14, 'Chaguaramas Miranda'),
(266, 14, 'Charallave'),
(267, 14, 'Chirimena'),
(268, 14, 'Chuspa'),
(269, 14, 'Cúa'),
(270, 14, 'Cupira'),
(271, 14, 'Curiepe'),
(272, 14, 'El Guapo'),
(273, 14, 'El Jarillo'),
(274, 14, 'Filas de Mariche'),
(275, 14, 'Guarenas'),
(276, 14, 'Guatire'),
(277, 14, 'Higuerote'),
(278, 14, 'Los Anaucos'),
(279, 14, 'Los Teques'),
(280, 14, 'Ocumare del Tuy'),
(281, 14, 'Panaquire'),
(282, 14, 'Paracotos'),
(283, 14, 'Río Chico'),
(284, 14, 'San Antonio de Los Altos'),
(285, 14, 'San Diego de Los Altos'),
(286, 14, 'San Fernando del Guapo'),
(287, 14, 'San Francisco de Yare'),
(288, 14, 'San José de Los Altos'),
(289, 14, 'San José de Río Chico'),
(290, 14, 'San Pedro de Los Altos'),
(291, 14, 'Santa Lucía'),
(292, 14, 'Santa Teresa'),
(293, 14, 'Tacarigua de La Laguna'),
(294, 14, 'Tacarigua de Mamporal'),
(295, 14, 'Tácata'),
(296, 14, 'Turumo'),
(297, 15, 'Aguasay'),
(298, 15, 'Aragua de Maturín'),
(299, 15, 'Barrancas del Orinoco'),
(300, 15, 'Caicara de Maturín'),
(301, 15, 'Caripe'),
(302, 15, 'Caripito'),
(303, 15, 'Chaguaramal'),
(305, 15, 'Chaguaramas Monagas'),
(307, 15, 'El Furrial'),
(308, 15, 'El Tejero'),
(309, 15, 'Jusepín'),
(310, 15, 'La Toscana'),
(311, 15, 'Maturín'),
(312, 15, 'Miraflores'),
(313, 15, 'Punta de Mata'),
(314, 15, 'Quiriquire'),
(315, 15, 'San Antonio de Maturín'),
(316, 15, 'San Vicente Monagas'),
(317, 15, 'Santa Bárbara'),
(318, 15, 'Temblador'),
(319, 15, 'Teresen'),
(320, 15, 'Uracoa'),
(321, 16, 'Altagracia'),
(322, 16, 'Boca de Pozo'),
(323, 16, 'Boca de Río'),
(324, 16, 'El Espinal'),
(325, 16, 'El Valle del Espíritu Santo'),
(326, 16, 'El Yaque'),
(327, 16, 'Juangriego'),
(328, 16, 'La Asunción'),
(329, 16, 'La Guardia'),
(330, 16, 'Pampatar'),
(331, 16, 'Porlamar'),
(332, 16, 'Puerto Fermín'),
(333, 16, 'Punta de Piedras'),
(334, 16, 'San Francisco de Macanao'),
(335, 16, 'San Juan Bautista'),
(336, 16, 'San Pedro de Coche'),
(337, 16, 'Santa Ana de Nueva Esparta'),
(338, 16, 'Villa Rosa'),
(339, 17, 'Acarigua'),
(340, 17, 'Agua Blanca'),
(341, 17, 'Araure'),
(342, 17, 'Biscucuy'),
(343, 17, 'Boconoito'),
(344, 17, 'Campo Elías'),
(345, 17, 'Chabasquén'),
(346, 17, 'Guanare'),
(347, 17, 'Guanarito'),
(348, 17, 'La Aparición'),
(349, 17, 'La Misión'),
(350, 17, 'Mesa de Cavacas'),
(351, 17, 'Ospino'),
(352, 17, 'Papelón'),
(353, 17, 'Payara'),
(354, 17, 'Pimpinela'),
(355, 17, 'Píritu de Portuguesa'),
(356, 17, 'San Rafael de Onoto'),
(357, 17, 'Santa Rosalía'),
(358, 17, 'Turén'),
(359, 18, 'Altos de Sucre'),
(360, 18, 'Araya'),
(361, 18, 'Cariaco'),
(362, 18, 'Carúpano'),
(363, 18, 'Casanay'),
(364, 18, 'Cumaná'),
(365, 18, 'Cumanacoa'),
(366, 18, 'El Morro Puerto Santo'),
(367, 18, 'El Pilar'),
(368, 18, 'El Poblado'),
(369, 18, 'Guaca'),
(370, 18, 'Guiria'),
(371, 18, 'Irapa'),
(372, 18, 'Manicuare'),
(373, 18, 'Mariguitar'),
(374, 18, 'Río Caribe'),
(375, 18, 'San Antonio del Golfo'),
(376, 18, 'San José de Aerocuar'),
(377, 18, 'San Vicente de Sucre'),
(378, 18, 'Santa Fe de Sucre'),
(379, 18, 'Tunapuy'),
(380, 18, 'Yaguaraparo'),
(381, 18, 'Yoco'),
(382, 19, 'Abejales'),
(383, 19, 'Borota'),
(384, 19, 'Bramon'),
(385, 19, 'Capacho'),
(386, 19, 'Colón'),
(387, 19, 'Coloncito'),
(388, 19, 'Cordero'),
(389, 19, 'El Cobre'),
(390, 19, 'El Pinal'),
(391, 19, 'Independencia'),
(392, 19, 'La Fría'),
(393, 19, 'La Grita'),
(394, 19, 'La Pedrera'),
(395, 19, 'La Tendida'),
(396, 19, 'Las Delicias'),
(397, 19, 'Las Hernández'),
(398, 19, 'Lobatera'),
(399, 19, 'Michelena'),
(400, 19, 'Palmira'),
(401, 19, 'Pregonero'),
(402, 19, 'Queniquea'),
(403, 19, 'Rubio'),
(404, 19, 'San Antonio del Tachira'),
(405, 19, 'San Cristobal'),
(406, 19, 'San José de Bolívar'),
(407, 19, 'San Josecito'),
(408, 19, 'San Pedro del Río'),
(409, 19, 'Santa Ana Táchira'),
(410, 19, 'Seboruco'),
(411, 19, 'Táriba'),
(412, 19, 'Umuquena'),
(413, 19, 'Ureña'),
(414, 20, 'Batatal'),
(415, 20, 'Betijoque'),
(416, 20, 'Boconó'),
(417, 20, 'Carache'),
(418, 20, 'Chejende'),
(419, 20, 'Cuicas'),
(420, 20, 'El Dividive'),
(421, 20, 'El Jaguito'),
(422, 20, 'Escuque'),
(423, 20, 'Isnotú'),
(424, 20, 'Jajó'),
(425, 20, 'La Ceiba'),
(426, 20, 'La Concepción de Trujllo'),
(427, 20, 'La Mesa de Esnujaque'),
(428, 20, 'La Puerta'),
(429, 20, 'La Quebrada'),
(430, 20, 'Mendoza Fría'),
(431, 20, 'Meseta de Chimpire'),
(432, 20, 'Monay'),
(433, 20, 'Motatán'),
(434, 20, 'Pampán'),
(435, 20, 'Pampanito'),
(436, 20, 'Sabana de Mendoza'),
(437, 20, 'San Lázaro'),
(438, 20, 'Santa Ana de Trujillo'),
(439, 20, 'Tostós'),
(440, 20, 'Trujillo'),
(441, 20, 'Valera'),
(442, 21, 'Carayaca'),
(443, 21, 'Litoral'),
(444, 25, 'Archipiélago Los Roques'),
(445, 22, 'Aroa'),
(446, 22, 'Boraure'),
(447, 22, 'Campo Elías de Yaracuy'),
(448, 22, 'Chivacoa'),
(449, 22, 'Cocorote'),
(450, 22, 'Farriar'),
(451, 22, 'Guama'),
(452, 22, 'Marín'),
(453, 22, 'Nirgua'),
(454, 22, 'Sabana de Parra'),
(455, 22, 'Salom'),
(456, 22, 'San Felipe'),
(457, 22, 'San Pablo de Yaracuy'),
(458, 22, 'Urachiche'),
(459, 22, 'Yaritagua'),
(460, 22, 'Yumare'),
(461, 23, 'Bachaquero'),
(462, 23, 'Bobures'),
(463, 23, 'Cabimas'),
(464, 23, 'Campo Concepción'),
(465, 23, 'Campo Mara'),
(466, 23, 'Campo Rojo'),
(467, 23, 'Carrasquero'),
(468, 23, 'Casigua'),
(469, 23, 'Chiquinquirá'),
(470, 23, 'Ciudad Ojeda'),
(471, 23, 'El Batey'),
(472, 23, 'El Carmelo'),
(473, 23, 'El Chivo'),
(474, 23, 'El Guayabo'),
(475, 23, 'El Mene'),
(476, 23, 'El Venado'),
(477, 23, 'Encontrados'),
(478, 23, 'Gibraltar'),
(479, 23, 'Isla de Toas'),
(480, 23, 'La Concepción del Zulia'),
(481, 23, 'La Paz'),
(482, 23, 'La Sierrita'),
(483, 23, 'Lagunillas del Zulia'),
(484, 23, 'Las Piedras de Perijá'),
(485, 23, 'Los Cortijos'),
(486, 23, 'Machiques'),
(487, 23, 'Maracaibo'),
(488, 23, 'Mene Grande'),
(489, 23, 'Palmarejo'),
(490, 23, 'Paraguaipoa'),
(491, 23, 'Potrerito'),
(492, 23, 'Pueblo Nuevo del Zulia'),
(493, 23, 'Puertos de Altagracia'),
(494, 23, 'Punta Gorda'),
(495, 23, 'Sabaneta de Palma'),
(496, 23, 'San Francisco'),
(497, 23, 'San José de Perijá'),
(498, 23, 'San Rafael del Moján'),
(499, 23, 'San Timoteo'),
(500, 23, 'Santa Bárbara Del Zulia'),
(501, 23, 'Santa Cruz de Mara'),
(502, 23, 'Santa Cruz del Zulia'),
(503, 23, 'Santa Rita'),
(504, 23, 'Sinamaica'),
(505, 23, 'Tamare'),
(506, 23, 'Tía Juana'),
(507, 23, 'Villa del Rosario'),
(508, 21, 'La Guaira'),
(509, 21, 'Catia La Mar'),
(510, 21, 'Macuto'),
(511, 21, 'Naiguatá'),
(512, 25, 'Archipiélago Los Monjes'),
(513, 25, 'Isla La Tortuga y Cayos adyacentes'),
(514, 25, 'Isla La Sola'),
(515, 25, 'Islas Los Testigos'),
(516, 25, 'Islas Los Frailes'),
(517, 25, 'Isla La Orchila'),
(518, 25, 'Archipiélago Las Aves'),
(519, 25, 'Isla de Aves'),
(520, 25, 'Isla La Blanquilla'),
(521, 25, 'Isla de Patos'),
(522, 25, 'Islas Los Hermanos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correo`
--

CREATE TABLE `correo` (
  `ID_Correo` int(11) NOT NULL,
  `Correo` varchar(200) DEFAULT NULL,
  `CI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `correo`
--

INSERT INTO `correo` (`ID_Correo`, `Correo`, `CI`) VALUES
(1, 'admin@admin.com', 123456);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `ID_Direccion` int(11) NOT NULL,
  `Localizacion` varchar(250) DEFAULT NULL,
  `Calle` varchar(60) DEFAULT NULL,
  `Sector` varchar(60) DEFAULT NULL,
  `Nro_Casa` varchar(45) DEFAULT NULL,
  `ID_Parroquia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`ID_Direccion`, `Localizacion`, `Calle`, `Sector`, `Nro_Casa`, `ID_Parroquia`) VALUES
(1, 'Comercial Flamingo', '1ra Carrera', 'El Luchador', '2', 79);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `CIE` int(11) NOT NULL,
  `Tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`CIE`, `Tipo`) VALUES
(123456, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre`) VALUES
(1, 'Amazonas'),
(2, 'Anzoátegui'),
(3, 'Apure'),
(4, 'Aragua'),
(5, 'Barinas'),
(6, 'Bolívar'),
(7, 'Carabobo'),
(8, 'Cojedes'),
(9, 'Delta Amacuro'),
(10, 'Falcón'),
(11, 'Guárico'),
(12, 'Lara'),
(13, 'Mérida'),
(14, 'Miranda'),
(15, 'Monagas'),
(16, 'Nueva Esparta'),
(17, 'Portuguesa'),
(18, 'Sucre'),
(19, 'Táchira'),
(20, 'Trujillo'),
(21, 'La Guaira'),
(22, 'Yaracuy'),
(23, 'Zulia'),
(24, 'Distrito Capital'),
(25, 'Dependencias Federales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `ID_Examen` int(11) NOT NULL,
  `ID_M_remitido` int(11) NOT NULL,
  `Tipo` set('biopsia','citologia') NOT NULL,
  `F_Examen` date NOT NULL DEFAULT current_timestamp(),
  `Obs` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_usa_insumo`
--

CREATE TABLE `examen_usa_insumo` (
  `ID_Examen` int(11) NOT NULL,
  `ID_Insumo` int(11) NOT NULL,
  `F_Uso` datetime DEFAULT NULL,
  `Cant_Uso` varchar(50) DEFAULT NULL,
  `Obs` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `ID_Factura` int(11) NOT NULL,
  `Nro_Control` int(11) DEFAULT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `F_Pago` datetime DEFAULT NULL,
  `Descripcion` varchar(400) DEFAULT NULL,
  `CIP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe`
--

CREATE TABLE `informe` (
  `ID_Informe` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Descripcion_M_Remitido` text DEFAULT NULL,
  `Diagnostico` text DEFAULT NULL,
  `Observacion` text DEFAULT NULL,
  `CIP` int(11) NOT NULL,
  `ID_Medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inf_biopsia`
--

CREATE TABLE `inf_biopsia` (
  `ID_Inf_Biopsia` int(11) NOT NULL,
  `ID_Informe` int(11) NOT NULL,
  `Desc_Macro` text DEFAULT NULL,
  `Desc_Micro` text DEFAULT NULL,
  `ID_Examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inf_citologia`
--

CREATE TABLE `inf_citologia` (
  `ID_Inf_Citologia` int(11) NOT NULL,
  `ID_Informe` int(11) NOT NULL,
  `Calidad` text DEFAULT NULL,
  `Categ_Gral` text DEFAULT NULL,
  `Hallazgos` text DEFAULT NULL,
  `Conducta` text DEFAULT NULL,
  `ID_Examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE `insumo` (
  `ID_Insumo` int(11) NOT NULL,
  `F_Exp` date DEFAULT NULL,
  `Existencia` varchar(45) DEFAULT NULL,
  `Duracion` varchar(45) DEFAULT NULL,
  `Material` varchar(45) DEFAULT NULL,
  `Tope` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo_tiene_lote`
--

CREATE TABLE `insumo_tiene_lote` (
  `ID_Insumo` int(11) NOT NULL,
  `ID_Lote` int(11) NOT NULL,
  `F_Ingreso_Lote` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `ID_Lote` int(11) NOT NULL,
  `F_Elab` date DEFAULT NULL,
  `F_Entrada` date DEFAULT NULL,
  `Proveedor` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `ID_Medico` int(11) NOT NULL,
  `Nombre_Medico` varchar(45) DEFAULT NULL,
  `Telefono_Medico` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_remite_paciente`
--

CREATE TABLE `medico_remite_paciente` (
  `ID_Medico` int(11) NOT NULL,
  `CIP` int(11) NOT NULL,
  `F_Registro` datetime DEFAULT NULL,
  `Obs` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `id_estado`, `nombre`) VALUES
(1, 1, 'Alto Orinoco'),
(2, 1, 'Atabapo'),
(3, 1, 'Atures'),
(4, 1, 'Autana'),
(5, 1, 'Manapiare'),
(6, 1, 'Maroa'),
(7, 1, 'Río Negro'),
(8, 2, 'Anaco'),
(9, 2, 'Aragua'),
(10, 2, 'Manuel Ezequiel Bruzual'),
(11, 2, 'Diego Bautista Urbaneja'),
(12, 2, 'Fernando Peñalver'),
(13, 2, 'Francisco Del Carmen Carvajal'),
(14, 2, 'General Sir Arthur McGregor'),
(15, 2, 'Guanta'),
(16, 2, 'Independencia'),
(17, 2, 'José Gregorio Monagas'),
(18, 2, 'Juan Antonio Sotillo'),
(19, 2, 'Juan Manuel Cajigal'),
(20, 2, 'Libertad'),
(21, 2, 'Francisco de Miranda'),
(22, 2, 'Pedro María Freites'),
(23, 2, 'Píritu'),
(24, 2, 'San José de Guanipa'),
(25, 2, 'San Juan de Capistrano'),
(26, 2, 'Santa Ana'),
(27, 2, 'Simón Bolívar'),
(28, 2, 'Simón Rodríguez'),
(29, 3, 'Achaguas'),
(30, 3, 'Biruaca'),
(31, 3, 'Muñóz'),
(32, 3, 'Páez'),
(33, 3, 'Pedro Camejo'),
(34, 3, 'Rómulo Gallegos'),
(35, 3, 'San Fernando'),
(36, 4, 'Atanasio Girardot'),
(37, 4, 'Bolívar'),
(38, 4, 'Camatagua'),
(39, 4, 'Francisco Linares Alcántara'),
(40, 4, 'José Ángel Lamas'),
(41, 4, 'José Félix Ribas'),
(42, 4, 'José Rafael Revenga'),
(43, 4, 'Libertador'),
(44, 4, 'Mario Briceño Iragorry'),
(45, 4, 'Ocumare de la Costa de Oro'),
(46, 4, 'San Casimiro'),
(47, 4, 'San Sebastián'),
(48, 4, 'Santiago Mariño'),
(49, 4, 'Santos Michelena'),
(50, 4, 'Sucre'),
(51, 4, 'Tovar'),
(52, 4, 'Urdaneta'),
(53, 4, 'Zamora'),
(54, 5, 'Alberto Arvelo Torrealba'),
(55, 5, 'Andrés Eloy Blanco'),
(56, 5, 'Antonio José de Sucre'),
(57, 5, 'Arismendi'),
(58, 5, 'Barinas'),
(59, 5, 'Bolívar'),
(60, 5, 'Cruz Paredes'),
(61, 5, 'Ezequiel Zamora'),
(62, 5, 'Obispos'),
(63, 5, 'Pedraza'),
(64, 5, 'Rojas'),
(65, 5, 'Sosa'),
(66, 6, 'Caroní'),
(67, 6, 'Cedeño'),
(68, 6, 'El Callao'),
(69, 6, 'Gran Sabana'),
(70, 6, 'Heres'),
(71, 6, 'Piar'),
(72, 6, 'Angostura (Raúl Leoni)'),
(73, 6, 'Roscio'),
(74, 6, 'Sifontes'),
(75, 6, 'Sucre'),
(76, 6, 'Padre Pedro Chien'),
(77, 7, 'Bejuma'),
(78, 7, 'Carlos Arvelo'),
(79, 7, 'Diego Ibarra'),
(80, 7, 'Guacara'),
(81, 7, 'Juan José Mora'),
(82, 7, 'Libertador'),
(83, 7, 'Los Guayos'),
(84, 7, 'Miranda'),
(85, 7, 'Montalbán'),
(86, 7, 'Naguanagua'),
(87, 7, 'Puerto Cabello'),
(88, 7, 'San Diego'),
(89, 7, 'San Joaquín'),
(90, 7, 'Valencia'),
(91, 8, 'Anzoátegui'),
(92, 8, 'Tinaquillo'),
(93, 8, 'Girardot'),
(94, 8, 'Lima Blanco'),
(95, 8, 'Pao de San Juan Bautista'),
(96, 8, 'Ricaurte'),
(97, 8, 'Rómulo Gallegos'),
(98, 8, 'San Carlos'),
(99, 8, 'Tinaco'),
(100, 9, 'Antonio Díaz'),
(101, 9, 'Casacoima'),
(102, 9, 'Pedernales'),
(103, 9, 'Tucupita'),
(104, 10, 'Acosta'),
(105, 10, 'Bolívar'),
(106, 10, 'Buchivacoa'),
(107, 10, 'Cacique Manaure'),
(108, 10, 'Carirubana'),
(109, 10, 'Colina'),
(110, 10, 'Dabajuro'),
(111, 10, 'Democracia'),
(112, 10, 'Falcón'),
(113, 10, 'Federación'),
(114, 10, 'Jacura'),
(115, 10, 'José Laurencio Silva'),
(116, 10, 'Los Taques'),
(117, 10, 'Mauroa'),
(118, 10, 'Miranda'),
(119, 10, 'Monseñor Iturriza'),
(120, 10, 'Palmasola'),
(121, 10, 'Petit'),
(122, 10, 'Píritu'),
(123, 10, 'San Francisco'),
(124, 10, 'Sucre'),
(125, 10, 'Tocópero'),
(126, 10, 'Unión'),
(127, 10, 'Urumaco'),
(128, 10, 'Zamora'),
(129, 11, 'Camaguán'),
(130, 11, 'Chaguaramas'),
(131, 11, 'El Socorro'),
(132, 11, 'José Félix Ribas'),
(133, 11, 'José Tadeo Monagas'),
(134, 11, 'Juan Germán Roscio'),
(135, 11, 'Julián Mellado'),
(136, 11, 'Las Mercedes'),
(137, 11, 'Leonardo Infante'),
(138, 11, 'Pedro Zaraza'),
(139, 11, 'Ortíz'),
(140, 11, 'San Gerónimo de Guayabal'),
(141, 11, 'San José de Guaribe'),
(142, 11, 'Santa María de Ipire'),
(143, 11, 'Sebastián Francisco de Miranda'),
(144, 12, 'Andrés Eloy Blanco'),
(145, 12, 'Crespo'),
(146, 12, 'Iribarren'),
(147, 12, 'Jiménez'),
(148, 12, 'Morán'),
(149, 12, 'Palavecino'),
(150, 12, 'Simón Planas'),
(151, 12, 'Torres'),
(152, 12, 'Urdaneta'),
(179, 13, 'Alberto Adriani'),
(180, 13, 'Andrés Bello'),
(181, 13, 'Antonio Pinto Salinas'),
(182, 13, 'Aricagua'),
(183, 13, 'Arzobispo Chacón'),
(184, 13, 'Campo Elías'),
(185, 13, 'Caracciolo Parra Olmedo'),
(186, 13, 'Cardenal Quintero'),
(187, 13, 'Guaraque'),
(188, 13, 'Julio César Salas'),
(189, 13, 'Justo Briceño'),
(190, 13, 'Libertador'),
(191, 13, 'Miranda'),
(192, 13, 'Obispo Ramos de Lora'),
(193, 13, 'Padre Noguera'),
(194, 13, 'Pueblo Llano'),
(195, 13, 'Rangel'),
(196, 13, 'Rivas Dávila'),
(197, 13, 'Santos Marquina'),
(198, 13, 'Sucre'),
(199, 13, 'Tovar'),
(200, 13, 'Tulio Febres Cordero'),
(201, 13, 'Zea'),
(223, 14, 'Acevedo'),
(224, 14, 'Andrés Bello'),
(225, 14, 'Baruta'),
(226, 14, 'Brión'),
(227, 14, 'Buroz'),
(228, 14, 'Carrizal'),
(229, 14, 'Chacao'),
(230, 14, 'Cristóbal Rojas'),
(231, 14, 'El Hatillo'),
(232, 14, 'Guaicaipuro'),
(233, 14, 'Independencia'),
(234, 14, 'Lander'),
(235, 14, 'Los Salias'),
(236, 14, 'Páez'),
(237, 14, 'Paz Castillo'),
(238, 14, 'Pedro Gual'),
(239, 14, 'Plaza'),
(240, 14, 'Simón Bolívar'),
(241, 14, 'Sucre'),
(242, 14, 'Urdaneta'),
(243, 14, 'Zamora'),
(258, 15, 'Acosta'),
(259, 15, 'Aguasay'),
(260, 15, 'Bolívar'),
(261, 15, 'Caripe'),
(262, 15, 'Cedeño'),
(263, 15, 'Ezequiel Zamora'),
(264, 15, 'Libertador'),
(265, 15, 'Maturín'),
(266, 15, 'Piar'),
(267, 15, 'Punceres'),
(268, 15, 'Santa Bárbara'),
(269, 15, 'Sotillo'),
(270, 15, 'Uracoa'),
(271, 16, 'Antolín del Campo'),
(272, 16, 'Arismendi'),
(273, 16, 'García'),
(274, 16, 'Gómez'),
(275, 16, 'Maneiro'),
(276, 16, 'Marcano'),
(277, 16, 'Mariño'),
(278, 16, 'Península de Macanao'),
(279, 16, 'Tubores'),
(280, 16, 'Villalba'),
(281, 16, 'Díaz'),
(282, 17, 'Agua Blanca'),
(283, 17, 'Araure'),
(284, 17, 'Esteller'),
(285, 17, 'Guanare'),
(286, 17, 'Guanarito'),
(287, 17, 'Monseñor José Vicente de Unda'),
(288, 17, 'Ospino'),
(289, 17, 'Páez'),
(290, 17, 'Papelón'),
(291, 17, 'San Genaro de Boconoíto'),
(292, 17, 'San Rafael de Onoto'),
(293, 17, 'Santa Rosalía'),
(294, 17, 'Sucre'),
(295, 17, 'Turén'),
(296, 18, 'Andrés Eloy Blanco'),
(297, 18, 'Andrés Mata'),
(298, 18, 'Arismendi'),
(299, 18, 'Benítez'),
(300, 18, 'Bermúdez'),
(301, 18, 'Bolívar'),
(302, 18, 'Cajigal'),
(303, 18, 'Cruz Salmerón Acosta'),
(304, 18, 'Libertador'),
(305, 18, 'Mariño'),
(306, 18, 'Mejía'),
(307, 18, 'Montes'),
(308, 18, 'Ribero'),
(309, 18, 'Sucre'),
(310, 18, 'Valdéz'),
(341, 19, 'Andrés Bello'),
(342, 19, 'Antonio Rómulo Costa'),
(343, 19, 'Ayacucho'),
(344, 19, 'Bolívar'),
(345, 19, 'Cárdenas'),
(346, 19, 'Córdoba'),
(347, 19, 'Fernández Feo'),
(348, 19, 'Francisco de Miranda'),
(349, 19, 'García de Hevia'),
(350, 19, 'Guásimos'),
(351, 19, 'Independencia'),
(352, 19, 'Jáuregui'),
(353, 19, 'José María Vargas'),
(354, 19, 'Junín'),
(355, 19, 'Libertad'),
(356, 19, 'Libertador'),
(357, 19, 'Lobatera'),
(358, 19, 'Michelena'),
(359, 19, 'Panamericano'),
(360, 19, 'Pedro María Ureña'),
(361, 19, 'Rafael Urdaneta'),
(362, 19, 'Samuel Darío Maldonado'),
(363, 19, 'San Cristóbal'),
(364, 19, 'Seboruco'),
(365, 19, 'Simón Rodríguez'),
(366, 19, 'Sucre'),
(367, 19, 'Torbes'),
(368, 19, 'Uribante'),
(369, 19, 'San Judas Tadeo'),
(370, 20, 'Andrés Bello'),
(371, 20, 'Boconó'),
(372, 20, 'Bolívar'),
(373, 20, 'Candelaria'),
(374, 20, 'Carache'),
(375, 20, 'Escuque'),
(376, 20, 'José Felipe Márquez Cañizalez'),
(377, 20, 'Juan Vicente Campos Elías'),
(378, 20, 'La Ceiba'),
(379, 20, 'Miranda'),
(380, 20, 'Monte Carmelo'),
(381, 20, 'Motatán'),
(382, 20, 'Pampán'),
(383, 20, 'Pampanito'),
(384, 20, 'Rafael Rangel'),
(385, 20, 'San Rafael de Carvajal'),
(386, 20, 'Sucre'),
(387, 20, 'Trujillo'),
(388, 20, 'Urdaneta'),
(389, 20, 'Valera'),
(390, 21, 'Vargas'),
(391, 22, 'Arístides Bastidas'),
(392, 22, 'Bolívar'),
(407, 22, 'Bruzual'),
(408, 22, 'Cocorote'),
(409, 22, 'Independencia'),
(410, 22, 'José Antonio Páez'),
(411, 22, 'La Trinidad'),
(412, 22, 'Manuel Monge'),
(413, 22, 'Nirgua'),
(414, 22, 'Peña'),
(415, 22, 'San Felipe'),
(416, 22, 'Sucre'),
(417, 22, 'Urachiche'),
(418, 22, 'José Joaquín Veroes'),
(441, 23, 'Almirante Padilla'),
(442, 23, 'Baralt'),
(443, 23, 'Cabimas'),
(444, 23, 'Catatumbo'),
(445, 23, 'Colón'),
(446, 23, 'Francisco Javier Pulgar'),
(447, 23, 'Páez'),
(448, 23, 'Jesús Enrique Losada'),
(449, 23, 'Jesús María Semprún'),
(450, 23, 'La Cañada de Urdaneta'),
(451, 23, 'Lagunillas'),
(452, 23, 'Machiques de Perijá'),
(453, 23, 'Mara'),
(454, 23, 'Maracaibo'),
(455, 23, 'Miranda'),
(456, 23, 'Rosario de Perijá'),
(457, 23, 'San Francisco'),
(458, 23, 'Santa Rita'),
(459, 23, 'Simón Bolívar'),
(460, 23, 'Sucre'),
(461, 23, 'Valmore Rodríguez'),
(462, 24, 'Libertador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `m_biopsia`
--

CREATE TABLE `m_biopsia` (
  `ID_M_Biopsia` int(11) NOT NULL,
  `ID_M_Remitido` int(11) NOT NULL,
  `Sitio_lesion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `m_citologia`
--

CREATE TABLE `m_citologia` (
  `ID_M_Citologia` int(11) NOT NULL,
  `ID_M_Remitido` int(11) NOT NULL,
  `FUR` varchar(45) DEFAULT NULL,
  `Endocervix` tinyint(1) DEFAULT NULL,
  `Exocervix` tinyint(1) DEFAULT NULL,
  `Vagina` tinyint(1) DEFAULT NULL,
  `Otros` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `m_remitido`
--

CREATE TABLE `m_remitido` (
  `ID_M_Remitido` int(11) NOT NULL,
  `ID_Medico` int(11) DEFAULT NULL,
  `CI_Paciente` int(11) DEFAULT NULL,
  `Descripcion_material` text DEFAULT NULL,
  `Diagnostico` text DEFAULT NULL,
  `Resumen` text DEFAULT NULL,
  `Examinado` tinyint(1) DEFAULT 0,
  `F_Entrada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `CIP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `ID_Pago` int(11) NOT NULL,
  `Referencia` varchar(45) DEFAULT NULL,
  `Tipo_Pago` varchar(45) DEFAULT NULL,
  `Obs` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `id_parroquia` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`id_parroquia`, `id_municipio`, `nombre`) VALUES
(1, 1, 'Alto Orinoco'),
(2, 1, 'Huachamacare Acanaña'),
(3, 1, 'Marawaka Toky Shamanaña'),
(4, 1, 'Mavaka Mavaka'),
(5, 1, 'Sierra Parima Parimabé'),
(6, 2, 'Ucata Laja Lisa'),
(7, 2, 'Yapacana Macuruco'),
(8, 2, 'Caname Guarinuma'),
(9, 3, 'Fernando Girón Tovar'),
(10, 3, 'Luis Alberto Gómez'),
(11, 3, 'Pahueña Limón de Parhueña'),
(12, 3, 'Platanillal Platanillal'),
(13, 4, 'Samariapo'),
(14, 4, 'Sipapo'),
(15, 4, 'Munduapo'),
(16, 4, 'Guayapo'),
(17, 5, 'Alto Ventuari'),
(18, 5, 'Medio Ventuari'),
(19, 5, 'Bajo Ventuari'),
(20, 6, 'Victorino'),
(21, 6, 'Comunidad'),
(22, 7, 'Casiquiare'),
(23, 7, 'Cocuy'),
(24, 7, 'San Carlos de Río Negro'),
(25, 7, 'Solano'),
(26, 8, 'Anaco'),
(27, 8, 'San Joaquín'),
(28, 9, 'Cachipo'),
(29, 9, 'Aragua de Barcelona'),
(30, 11, 'Lechería'),
(31, 11, 'El Morro'),
(32, 12, 'Puerto Píritu'),
(33, 12, 'San Miguel'),
(34, 12, 'Sucre'),
(35, 13, 'Valle de Guanape'),
(36, 13, 'Santa Bárbara'),
(37, 14, 'El Chaparro'),
(38, 14, 'Tomás Alfaro'),
(39, 14, 'Calatrava'),
(40, 15, 'Guanta'),
(41, 15, 'Chorrerón'),
(42, 16, 'Mamo'),
(43, 16, 'Soledad'),
(44, 17, 'Mapire'),
(45, 17, 'Piar'),
(46, 17, 'Santa Clara'),
(47, 17, 'San Diego de Cabrutica'),
(48, 17, 'Uverito'),
(49, 17, 'Zuata'),
(50, 18, 'Puerto La Cruz'),
(51, 18, 'Pozuelos'),
(52, 19, 'Onoto'),
(53, 19, 'San Pablo'),
(54, 20, 'San Mateo'),
(55, 20, 'El Carito'),
(56, 20, 'Santa Inés'),
(57, 20, 'La Romereña'),
(58, 21, 'Atapirire'),
(59, 21, 'Boca del Pao'),
(60, 21, 'El Pao'),
(61, 21, 'Pariaguán'),
(62, 22, 'Cantaura'),
(63, 22, 'Libertador'),
(64, 22, 'Santa Rosa'),
(65, 22, 'Urica'),
(66, 23, 'Píritu'),
(67, 23, 'San Francisco'),
(68, 24, 'San José de Guanipa'),
(69, 25, 'Boca de Uchire'),
(70, 25, 'Boca de Chávez'),
(71, 26, 'Pueblo Nuevo'),
(72, 26, 'Santa Ana'),
(73, 27, 'Bergantín'),
(74, 27, 'Caigua'),
(75, 27, 'El Carmen'),
(76, 27, 'El Pilar'),
(77, 27, 'Naricual'),
(78, 27, 'San Crsitóbal'),
(79, 28, 'Edmundo Barrios'),
(80, 28, 'Miguel Otero Silva'),
(81, 29, 'Achaguas'),
(82, 29, 'Apurito'),
(83, 29, 'El Yagual'),
(84, 29, 'Guachara'),
(85, 29, 'Mucuritas'),
(86, 29, 'Queseras del medio'),
(87, 30, 'Biruaca'),
(88, 31, 'Bruzual'),
(89, 31, 'Mantecal'),
(90, 31, 'Quintero'),
(91, 31, 'Rincón Hondo'),
(92, 31, 'San Vicente'),
(93, 32, 'Guasdualito'),
(94, 32, 'Aramendi'),
(95, 32, 'El Amparo'),
(96, 32, 'San Camilo'),
(97, 32, 'Urdaneta'),
(98, 33, 'San Juan de Payara'),
(99, 33, 'Codazzi'),
(100, 33, 'Cunaviche'),
(101, 34, 'Elorza'),
(102, 34, 'La Trinidad'),
(103, 35, 'San Fernando'),
(104, 35, 'El Recreo'),
(105, 35, 'Peñalver'),
(106, 35, 'San Rafael de Atamaica'),
(107, 36, 'Pedro José Ovalles'),
(108, 36, 'Joaquín Crespo'),
(109, 36, 'José Casanova Godoy'),
(110, 36, 'Madre María de San José'),
(111, 36, 'Andrés Eloy Blanco'),
(112, 36, 'Los Tacarigua'),
(113, 36, 'Las Delicias'),
(114, 36, 'Choroní'),
(115, 37, 'Bolívar'),
(116, 38, 'Camatagua'),
(117, 38, 'Carmen de Cura'),
(118, 39, 'Santa Rita'),
(119, 39, 'Francisco de Miranda'),
(120, 39, 'Moseñor Feliciano González'),
(121, 40, 'Santa Cruz'),
(122, 41, 'José Félix Ribas'),
(123, 41, 'Castor Nieves Ríos'),
(124, 41, 'Las Guacamayas'),
(125, 41, 'Pao de Zárate'),
(126, 41, 'Zuata'),
(127, 42, 'José Rafael Revenga'),
(128, 43, 'Palo Negro'),
(129, 43, 'San Martín de Porres'),
(130, 44, 'El Limón'),
(131, 44, 'Caña de Azúcar'),
(132, 45, 'Ocumare de la Costa'),
(133, 46, 'San Casimiro'),
(134, 46, 'Güiripa'),
(135, 46, 'Ollas de Caramacate'),
(136, 46, 'Valle Morín'),
(137, 47, 'San Sebastían'),
(138, 48, 'Turmero'),
(139, 48, 'Arevalo Aponte'),
(140, 48, 'Chuao'),
(141, 48, 'Samán de Güere'),
(142, 48, 'Alfredo Pacheco Miranda'),
(143, 49, 'Santos Michelena'),
(144, 49, 'Tiara'),
(145, 50, 'Cagua'),
(146, 50, 'Bella Vista'),
(147, 51, 'Tovar'),
(148, 52, 'Urdaneta'),
(149, 52, 'Las Peñitas'),
(150, 52, 'San Francisco de Cara'),
(151, 52, 'Taguay'),
(152, 53, 'Zamora'),
(153, 53, 'Magdaleno'),
(154, 53, 'San Francisco de Asís'),
(155, 53, 'Valles de Tucutunemo'),
(156, 53, 'Augusto Mijares'),
(157, 54, 'Sabaneta'),
(158, 54, 'Juan Antonio Rodríguez Domínguez'),
(159, 55, 'El Cantón'),
(160, 55, 'Santa Cruz de Guacas'),
(161, 55, 'Puerto Vivas'),
(162, 56, 'Ticoporo'),
(163, 56, 'Nicolás Pulido'),
(164, 56, 'Andrés Bello'),
(165, 57, 'Arismendi'),
(166, 57, 'Guadarrama'),
(167, 57, 'La Unión'),
(168, 57, 'San Antonio'),
(169, 58, 'Barinas'),
(170, 58, 'Alberto Arvelo Larriva'),
(171, 58, 'San Silvestre'),
(172, 58, 'Santa Inés'),
(173, 58, 'Santa Lucía'),
(174, 58, 'Torumos'),
(175, 58, 'El Carmen'),
(176, 58, 'Rómulo Betancourt'),
(177, 58, 'Corazón de Jesús'),
(178, 58, 'Ramón Ignacio Méndez'),
(179, 58, 'Alto Barinas'),
(180, 58, 'Manuel Palacio Fajardo'),
(181, 58, 'Juan Antonio Rodríguez Domínguez'),
(182, 58, 'Dominga Ortiz de Páez'),
(183, 59, 'Barinitas'),
(184, 59, 'Altamira de Cáceres'),
(185, 59, 'Calderas'),
(186, 60, 'Barrancas'),
(187, 60, 'El Socorro'),
(188, 60, 'Mazparrito'),
(189, 61, 'Santa Bárbara'),
(190, 61, 'Pedro Briceño Méndez'),
(191, 61, 'Ramón Ignacio Méndez'),
(192, 61, 'José Ignacio del Pumar'),
(193, 62, 'Obispos'),
(194, 62, 'Guasimitos'),
(195, 62, 'El Real'),
(196, 62, 'La Luz'),
(197, 63, 'Ciudad Bolívia'),
(198, 63, 'José Ignacio Briceño'),
(199, 63, 'José Félix Ribas'),
(200, 63, 'Páez'),
(201, 64, 'Libertad'),
(202, 64, 'Dolores'),
(203, 64, 'Santa Rosa'),
(204, 64, 'Palacio Fajardo'),
(205, 65, 'Ciudad de Nutrias'),
(206, 65, 'El Regalo'),
(207, 65, 'Puerto Nutrias'),
(208, 65, 'Santa Catalina'),
(209, 66, 'Cachamay'),
(210, 66, 'Chirica'),
(211, 66, 'Dalla Costa'),
(212, 66, 'Once de Abril'),
(213, 66, 'Simón Bolívar'),
(214, 66, 'Unare'),
(215, 66, 'Universidad'),
(216, 66, 'Vista al Sol'),
(217, 66, 'Pozo Verde'),
(218, 66, 'Yocoima'),
(219, 66, '5 de Julio'),
(220, 67, 'Cedeño'),
(221, 67, 'Altagracia'),
(222, 67, 'Ascensión Farreras'),
(223, 67, 'Guaniamo'),
(224, 67, 'La Urbana'),
(225, 67, 'Pijiguaos'),
(226, 68, 'El Callao'),
(227, 69, 'Gran Sabana'),
(228, 69, 'Ikabarú'),
(229, 70, 'Catedral'),
(230, 70, 'Zea'),
(231, 70, 'Orinoco'),
(232, 70, 'José Antonio Páez'),
(233, 70, 'Marhuanta'),
(234, 70, 'Agua Salada'),
(235, 70, 'Vista Hermosa'),
(236, 70, 'La Sabanita'),
(237, 70, 'Panapana'),
(238, 71, 'Andrés Eloy Blanco'),
(239, 71, 'Pedro Cova'),
(240, 72, 'Raúl Leoni'),
(241, 72, 'Barceloneta'),
(242, 72, 'Santa Bárbara'),
(243, 72, 'San Francisco'),
(244, 73, 'Roscio'),
(245, 73, 'Salóm'),
(246, 74, 'Sifontes'),
(247, 74, 'Dalla Costa'),
(248, 74, 'San Isidro'),
(249, 75, 'Sucre'),
(250, 75, 'Aripao'),
(251, 75, 'Guarataro'),
(252, 75, 'Las Majadas'),
(253, 75, 'Moitaco'),
(254, 76, 'Padre Pedro Chien'),
(255, 76, 'Río Grande'),
(256, 77, 'Bejuma'),
(257, 77, 'Canoabo'),
(258, 77, 'Simón Bolívar'),
(259, 78, 'Güigüe'),
(260, 78, 'Carabobo'),
(261, 78, 'Tacarigua'),
(262, 79, 'Mariara'),
(263, 79, 'Aguas Calientes'),
(264, 80, 'Ciudad Alianza'),
(265, 80, 'Guacara'),
(266, 80, 'Yagua'),
(267, 81, 'Morón'),
(268, 81, 'Yagua'),
(269, 82, 'Tocuyito'),
(270, 82, 'Independencia'),
(271, 83, 'Los Guayos'),
(272, 84, 'Miranda'),
(273, 85, 'Montalbán'),
(274, 86, 'Naguanagua'),
(275, 87, 'Bartolomé Salóm'),
(276, 87, 'Democracia'),
(277, 87, 'Fraternidad'),
(278, 87, 'Goaigoaza'),
(279, 87, 'Juan José Flores'),
(280, 87, 'Unión'),
(281, 87, 'Borburata'),
(282, 87, 'Patanemo'),
(283, 88, 'San Diego'),
(284, 89, 'San Joaquín'),
(285, 90, 'Candelaria'),
(286, 90, 'Catedral'),
(287, 90, 'El Socorro'),
(288, 90, 'Miguel Peña'),
(289, 90, 'Rafael Urdaneta'),
(290, 90, 'San Blas'),
(291, 90, 'San José'),
(292, 90, 'Santa Rosa'),
(293, 90, 'Negro Primero'),
(294, 91, 'Cojedes'),
(295, 91, 'Juan de Mata Suárez'),
(296, 92, 'Tinaquillo'),
(297, 93, 'El Baúl'),
(298, 93, 'Sucre'),
(299, 94, 'La Aguadita'),
(300, 94, 'Macapo'),
(301, 95, 'El Pao'),
(302, 96, 'El Amparo'),
(303, 96, 'Libertad de Cojedes'),
(304, 97, 'Rómulo Gallegos'),
(305, 98, 'San Carlos de Austria'),
(306, 98, 'Juan Ángel Bravo'),
(307, 98, 'Manuel Manrique'),
(308, 99, 'General en Jefe José Laurencio Silva'),
(309, 100, 'Curiapo'),
(310, 100, 'Almirante Luis Brión'),
(311, 100, 'Francisco Aniceto Lugo'),
(312, 100, 'Manuel Renaud'),
(313, 100, 'Padre Barral'),
(314, 100, 'Santos de Abelgas'),
(315, 101, 'Imataca'),
(316, 101, 'Cinco de Julio'),
(317, 101, 'Juan Bautista Arismendi'),
(318, 101, 'Manuel Piar'),
(319, 101, 'Rómulo Gallegos'),
(320, 102, 'Pedernales'),
(321, 102, 'Luis Beltrán Prieto Figueroa'),
(322, 103, 'San José (Delta Amacuro)'),
(323, 103, 'José Vidal Marcano'),
(324, 103, 'Juan Millán'),
(325, 103, 'Leonardo Ruíz Pineda'),
(326, 103, 'Mariscal Antonio José de Sucre'),
(327, 103, 'Monseñor Argimiro García'),
(328, 103, 'San Rafael (Delta Amacuro)'),
(329, 103, 'Virgen del Valle'),
(330, 10, 'Clarines'),
(331, 10, 'Guanape'),
(332, 10, 'Sabana de Uchire'),
(333, 104, 'Capadare'),
(334, 104, 'La Pastora'),
(335, 104, 'Libertador'),
(336, 104, 'San Juan de los Cayos'),
(337, 105, 'Aracua'),
(338, 105, 'La Peña'),
(339, 105, 'San Luis'),
(340, 106, 'Bariro'),
(341, 106, 'Borojó'),
(342, 106, 'Capatárida'),
(343, 106, 'Guajiro'),
(344, 106, 'Seque'),
(345, 106, 'Zazárida'),
(346, 106, 'Valle de Eroa'),
(347, 107, 'Cacique Manaure'),
(348, 108, 'Norte'),
(349, 108, 'Carirubana'),
(350, 108, 'Santa Ana'),
(351, 108, 'Urbana Punta Cardón'),
(352, 109, 'La Vela de Coro'),
(353, 109, 'Acurigua'),
(354, 109, 'Guaibacoa'),
(355, 109, 'Las Calderas'),
(356, 109, 'Macoruca'),
(357, 110, 'Dabajuro'),
(358, 111, 'Agua Clara'),
(359, 111, 'Avaria'),
(360, 111, 'Pedregal'),
(361, 111, 'Piedra Grande'),
(362, 111, 'Purureche'),
(363, 112, 'Adaure'),
(364, 112, 'Adícora'),
(365, 112, 'Baraived'),
(366, 112, 'Buena Vista'),
(367, 112, 'Jadacaquiva'),
(368, 112, 'El Vínculo'),
(369, 112, 'El Hato'),
(370, 112, 'Moruy'),
(371, 112, 'Pueblo Nuevo'),
(372, 113, 'Agua Larga'),
(373, 113, 'El Paují'),
(374, 113, 'Independencia'),
(375, 113, 'Mapararí'),
(376, 114, 'Agua Linda'),
(377, 114, 'Araurima'),
(378, 114, 'Jacura'),
(379, 115, 'Tucacas'),
(380, 115, 'Boca de Aroa'),
(381, 116, 'Los Taques'),
(382, 116, 'Judibana'),
(383, 117, 'Mene de Mauroa'),
(384, 117, 'San Félix'),
(385, 117, 'Casigua'),
(386, 118, 'Guzmán Guillermo'),
(387, 118, 'Mitare'),
(388, 118, 'Río Seco'),
(389, 118, 'Sabaneta'),
(390, 118, 'San Antonio'),
(391, 118, 'San Gabriel'),
(392, 118, 'Santa Ana'),
(393, 119, 'Boca del Tocuyo'),
(394, 119, 'Chichiriviche'),
(395, 119, 'Tocuyo de la Costa'),
(396, 120, 'Palmasola'),
(397, 121, 'Cabure'),
(398, 121, 'Colina'),
(399, 121, 'Curimagua'),
(400, 122, 'San José de la Costa'),
(401, 122, 'Píritu'),
(402, 123, 'San Francisco'),
(403, 124, 'Sucre'),
(404, 124, 'Pecaya'),
(405, 125, 'Tocópero'),
(406, 126, 'El Charal'),
(407, 126, 'Las Vegas del Tuy'),
(408, 126, 'Santa Cruz de Bucaral'),
(409, 127, 'Bruzual'),
(410, 127, 'Urumaco'),
(411, 128, 'Puerto Cumarebo'),
(412, 128, 'La Ciénaga'),
(413, 128, 'La Soledad'),
(414, 128, 'Pueblo Cumarebo'),
(415, 128, 'Zazárida'),
(416, 113, 'Churuguara'),
(417, 129, 'Camaguán'),
(418, 129, 'Puerto Miranda'),
(419, 129, 'Uverito'),
(420, 130, 'Chaguaramas'),
(421, 131, 'El Socorro'),
(422, 132, 'Tucupido'),
(423, 132, 'San Rafael de Laya'),
(424, 133, 'Altagracia de Orituco'),
(425, 133, 'San Rafael de Orituco'),
(426, 133, 'San Francisco Javier de Lezama'),
(427, 133, 'Paso Real de Macaira'),
(428, 133, 'Carlos Soublette'),
(429, 133, 'San Francisco de Macaira'),
(430, 133, 'Libertad de Orituco'),
(431, 134, 'Cantaclaro'),
(432, 134, 'San Juan de los Morros'),
(433, 134, 'Parapara'),
(434, 135, 'El Sombrero'),
(435, 135, 'Sosa'),
(436, 136, 'Las Mercedes'),
(437, 136, 'Cabruta'),
(438, 136, 'Santa Rita de Manapire'),
(439, 137, 'Valle de la Pascua'),
(440, 137, 'Espino'),
(441, 138, 'San José de Unare'),
(442, 138, 'Zaraza'),
(443, 139, 'San José de Tiznados'),
(444, 139, 'San Francisco de Tiznados'),
(445, 139, 'San Lorenzo de Tiznados'),
(446, 139, 'Ortiz'),
(447, 140, 'Guayabal'),
(448, 140, 'Cazorla'),
(449, 141, 'San José de Guaribe'),
(450, 141, 'Uveral'),
(451, 142, 'Santa María de Ipire'),
(452, 142, 'Altamira'),
(453, 143, 'El Calvario'),
(454, 143, 'El Rastro'),
(455, 143, 'Guardatinajas'),
(456, 143, 'Capital Urbana Calabozo'),
(457, 144, 'Quebrada Honda de Guache'),
(458, 144, 'Pío Tamayo'),
(459, 144, 'Yacambú'),
(460, 145, 'Fréitez'),
(461, 145, 'José María Blanco'),
(462, 146, 'Catedral'),
(463, 146, 'Concepción'),
(464, 146, 'El Cují'),
(465, 146, 'Juan de Villegas'),
(466, 146, 'Santa Rosa'),
(467, 146, 'Tamaca'),
(468, 146, 'Unión'),
(469, 146, 'Aguedo Felipe Alvarado'),
(470, 146, 'Buena Vista'),
(471, 146, 'Juárez'),
(472, 147, 'Juan Bautista Rodríguez'),
(473, 147, 'Cuara'),
(474, 147, 'Diego de Lozada'),
(475, 147, 'Paraíso de San José'),
(476, 147, 'San Miguel'),
(477, 147, 'Tintorero'),
(478, 147, 'José Bernardo Dorante'),
(479, 147, 'Coronel Mariano Peraza '),
(480, 148, 'Bolívar'),
(481, 148, 'Anzoátegui'),
(482, 148, 'Guarico'),
(483, 148, 'Hilario Luna y Luna'),
(484, 148, 'Humocaro Alto'),
(485, 148, 'Humocaro Bajo'),
(486, 148, 'La Candelaria'),
(487, 148, 'Morán'),
(488, 149, 'Cabudare'),
(489, 149, 'José Gregorio Bastidas'),
(490, 149, 'Agua Viva'),
(491, 150, 'Sarare'),
(492, 150, 'Buría'),
(493, 150, 'Gustavo Vegas León'),
(494, 151, 'Trinidad Samuel'),
(495, 151, 'Antonio Díaz'),
(496, 151, 'Camacaro'),
(497, 151, 'Castañeda'),
(498, 151, 'Cecilio Zubillaga'),
(499, 151, 'Chiquinquirá'),
(500, 151, 'El Blanco'),
(501, 151, 'Espinoza de los Monteros'),
(502, 151, 'Lara'),
(503, 151, 'Las Mercedes'),
(504, 151, 'Manuel Morillo'),
(505, 151, 'Montaña Verde'),
(506, 151, 'Montes de Oca'),
(507, 151, 'Torres'),
(508, 151, 'Heriberto Arroyo'),
(509, 151, 'Reyes Vargas'),
(510, 151, 'Altagracia'),
(511, 152, 'Siquisique'),
(512, 152, 'Moroturo'),
(513, 152, 'San Miguel'),
(514, 152, 'Xaguas'),
(515, 179, 'Presidente Betancourt'),
(516, 179, 'Presidente Páez'),
(517, 179, 'Presidente Rómulo Gallegos'),
(518, 179, 'Gabriel Picón González'),
(519, 179, 'Héctor Amable Mora'),
(520, 179, 'José Nucete Sardi'),
(521, 179, 'Pulido Méndez'),
(522, 180, 'La Azulita'),
(523, 181, 'Santa Cruz de Mora'),
(524, 181, 'Mesa Bolívar'),
(525, 181, 'Mesa de Las Palmas'),
(526, 182, 'Aricagua'),
(527, 182, 'San Antonio'),
(528, 183, 'Canagua'),
(529, 183, 'Capurí'),
(530, 183, 'Chacantá'),
(531, 183, 'El Molino'),
(532, 183, 'Guaimaral'),
(533, 183, 'Mucutuy'),
(534, 183, 'Mucuchachí'),
(535, 184, 'Fernández Peña'),
(536, 184, 'Matriz'),
(537, 184, 'Montalbán'),
(538, 184, 'Acequias'),
(539, 184, 'Jají'),
(540, 184, 'La Mesa'),
(541, 184, 'San José del Sur'),
(542, 185, 'Tucaní'),
(543, 185, 'Florencio Ramírez'),
(544, 186, 'Santo Domingo'),
(545, 186, 'Las Piedras'),
(546, 187, 'Guaraque'),
(547, 187, 'Mesa de Quintero'),
(548, 187, 'Río Negro'),
(549, 188, 'Arapuey'),
(550, 188, 'Palmira'),
(551, 189, 'San Cristóbal de Torondoy'),
(552, 189, 'Torondoy'),
(553, 190, 'Antonio Spinetti Dini'),
(554, 190, 'Arias'),
(555, 190, 'Caracciolo Parra Pérez'),
(556, 190, 'Domingo Peña'),
(557, 190, 'El Llano'),
(558, 190, 'Gonzalo Picón Febres'),
(559, 190, 'Jacinto Plaza'),
(560, 190, 'Juan Rodríguez Suárez'),
(561, 190, 'Lasso de la Vega'),
(562, 190, 'Mariano Picón Salas'),
(563, 190, 'Milla'),
(564, 190, 'Osuna Rodríguez'),
(565, 190, 'Sagrario'),
(566, 190, 'El Morro'),
(567, 190, 'Los Nevados'),
(568, 191, 'Andrés Eloy Blanco'),
(569, 191, 'La Venta'),
(570, 191, 'Piñango'),
(571, 191, 'Timotes'),
(572, 192, 'Eloy Paredes'),
(573, 192, 'San Rafael de Alcázar'),
(574, 192, 'Santa Elena de Arenales'),
(575, 193, 'Santa María de Caparo'),
(576, 194, 'Pueblo Llano'),
(577, 195, 'Cacute'),
(578, 195, 'La Toma'),
(579, 195, 'Mucuchíes'),
(580, 195, 'Mucurubá'),
(581, 195, 'San Rafael'),
(582, 196, 'Gerónimo Maldonado'),
(583, 196, 'Bailadores'),
(584, 197, 'Tabay'),
(585, 198, 'Chiguará'),
(586, 198, 'Estánquez'),
(587, 198, 'Lagunillas'),
(588, 198, 'La Trampa'),
(589, 198, 'Pueblo Nuevo del Sur'),
(590, 198, 'San Juan'),
(591, 199, 'El Amparo'),
(592, 199, 'El Llano'),
(593, 199, 'San Francisco'),
(594, 199, 'Tovar'),
(595, 200, 'Independencia'),
(596, 200, 'María de la Concepción Palacios Blanco'),
(597, 200, 'Nueva Bolivia'),
(598, 200, 'Santa Apolonia'),
(599, 201, 'Caño El Tigre'),
(600, 201, 'Zea'),
(601, 223, 'Aragüita'),
(602, 223, 'Arévalo González'),
(603, 223, 'Capaya'),
(604, 223, 'Caucagua'),
(605, 223, 'Panaquire'),
(606, 223, 'Ribas'),
(607, 223, 'El Café'),
(608, 223, 'Marizapa'),
(609, 224, 'Cumbo'),
(610, 224, 'San José de Barlovento'),
(611, 225, 'El Cafetal'),
(612, 225, 'Las Minas'),
(613, 225, 'Nuestra Señora del Rosario'),
(614, 226, 'Higuerote'),
(615, 226, 'Curiepe'),
(616, 226, 'Tacarigua de Brión'),
(617, 227, 'Mamporal'),
(618, 228, 'Carrizal'),
(619, 229, 'Chacao'),
(620, 230, 'Charallave'),
(621, 230, 'Las Brisas'),
(622, 231, 'El Hatillo'),
(623, 232, 'Altagracia de la Montaña'),
(624, 232, 'Cecilio Acosta'),
(625, 232, 'Los Teques'),
(626, 232, 'El Jarillo'),
(627, 232, 'San Pedro'),
(628, 232, 'Tácata'),
(629, 232, 'Paracotos'),
(630, 233, 'Cartanal'),
(631, 233, 'Santa Teresa del Tuy'),
(632, 234, 'La Democracia'),
(633, 234, 'Ocumare del Tuy'),
(634, 234, 'Santa Bárbara'),
(635, 235, 'San Antonio de los Altos'),
(636, 236, 'Río Chico'),
(637, 236, 'El Guapo'),
(638, 236, 'Tacarigua de la Laguna'),
(639, 236, 'Paparo'),
(640, 236, 'San Fernando del Guapo'),
(641, 237, 'Santa Lucía del Tuy'),
(642, 238, 'Cúpira'),
(643, 238, 'Machurucuto'),
(644, 239, 'Guarenas'),
(645, 240, 'San Antonio de Yare'),
(646, 240, 'San Francisco de Yare'),
(647, 241, 'Leoncio Martínez'),
(648, 241, 'Petare'),
(649, 241, 'Caucagüita'),
(650, 241, 'Filas de Mariche'),
(651, 241, 'La Dolorita'),
(652, 242, 'Cúa'),
(653, 242, 'Nueva Cúa'),
(654, 243, 'Guatire'),
(655, 243, 'Bolívar'),
(656, 258, 'San Antonio de Maturín'),
(657, 258, 'San Francisco de Maturín'),
(658, 259, 'Aguasay'),
(659, 260, 'Caripito'),
(660, 261, 'El Guácharo'),
(661, 261, 'La Guanota'),
(662, 261, 'Sabana de Piedra'),
(663, 261, 'San Agustín'),
(664, 261, 'Teresen'),
(665, 261, 'Caripe'),
(666, 262, 'Areo'),
(667, 262, 'Capital Cedeño'),
(668, 262, 'San Félix de Cantalicio'),
(669, 262, 'Viento Fresco'),
(670, 263, 'El Tejero'),
(671, 263, 'Punta de Mata'),
(672, 264, 'Chaguaramas'),
(673, 264, 'Las Alhuacas'),
(674, 264, 'Tabasca'),
(675, 264, 'Temblador'),
(676, 265, 'Alto de los Godos'),
(677, 265, 'Boquerón'),
(678, 265, 'Las Cocuizas'),
(679, 265, 'La Cruz'),
(680, 265, 'San Simón'),
(681, 265, 'El Corozo'),
(682, 265, 'El Furrial'),
(683, 265, 'Jusepín'),
(684, 265, 'La Pica'),
(685, 265, 'San Vicente'),
(686, 266, 'Aparicio'),
(687, 266, 'Aragua de Maturín'),
(688, 266, 'Chaguamal'),
(689, 266, 'El Pinto'),
(690, 266, 'Guanaguana'),
(691, 266, 'La Toscana'),
(692, 266, 'Taguaya'),
(693, 267, 'Cachipo'),
(694, 267, 'Quiriquire'),
(695, 268, 'Santa Bárbara'),
(696, 269, 'Barrancas'),
(697, 269, 'Los Barrancos de Fajardo'),
(698, 270, 'Uracoa'),
(699, 271, 'Antolín del Campo'),
(700, 272, 'Arismendi'),
(701, 273, 'García'),
(702, 273, 'Francisco Fajardo'),
(703, 274, 'Bolívar'),
(704, 274, 'Guevara'),
(705, 274, 'Matasiete'),
(706, 274, 'Santa Ana'),
(707, 274, 'Sucre'),
(708, 275, 'Aguirre'),
(709, 275, 'Maneiro'),
(710, 276, 'Adrián'),
(711, 276, 'Juan Griego'),
(712, 276, 'Yaguaraparo'),
(713, 277, 'Porlamar'),
(714, 278, 'San Francisco de Macanao'),
(715, 278, 'Boca de Río'),
(716, 279, 'Tubores'),
(717, 279, 'Los Baleales'),
(718, 280, 'Vicente Fuentes'),
(719, 280, 'Villalba'),
(720, 281, 'San Juan Bautista'),
(721, 281, 'Zabala'),
(722, 283, 'Capital Araure'),
(723, 283, 'Río Acarigua'),
(724, 284, 'Capital Esteller'),
(725, 284, 'Uveral'),
(726, 285, 'Guanare'),
(727, 285, 'Córdoba'),
(728, 285, 'San José de la Montaña'),
(729, 285, 'San Juan de Guanaguanare'),
(730, 285, 'Virgen de la Coromoto'),
(731, 286, 'Guanarito'),
(732, 286, 'Trinidad de la Capilla'),
(733, 286, 'Divina Pastora'),
(734, 287, 'Monseñor José Vicente de Unda'),
(735, 287, 'Peña Blanca'),
(736, 288, 'Capital Ospino'),
(737, 288, 'Aparición'),
(738, 288, 'La Estación'),
(739, 289, 'Páez'),
(740, 289, 'Payara'),
(741, 289, 'Pimpinela'),
(742, 289, 'Ramón Peraza'),
(743, 290, 'Papelón'),
(744, 290, 'Caño Delgadito'),
(745, 291, 'San Genaro de Boconoito'),
(746, 291, 'Antolín Tovar'),
(747, 292, 'San Rafael de Onoto'),
(748, 292, 'Santa Fe'),
(749, 292, 'Thermo Morles'),
(750, 293, 'Santa Rosalía'),
(751, 293, 'Florida'),
(752, 294, 'Sucre'),
(753, 294, 'Concepción'),
(754, 294, 'San Rafael de Palo Alzado'),
(755, 294, 'Uvencio Antonio Velásquez'),
(756, 294, 'San José de Saguaz'),
(757, 294, 'Villa Rosa'),
(758, 295, 'Turén'),
(759, 295, 'Canelones'),
(760, 295, 'Santa Cruz'),
(761, 295, 'San Isidro Labrador'),
(762, 296, 'Mariño'),
(763, 296, 'Rómulo Gallegos'),
(764, 297, 'San José de Aerocuar'),
(765, 297, 'Tavera Acosta'),
(766, 298, 'Río Caribe'),
(767, 298, 'Antonio José de Sucre'),
(768, 298, 'El Morro de Puerto Santo'),
(769, 298, 'Puerto Santo'),
(770, 298, 'San Juan de las Galdonas'),
(771, 299, 'El Pilar'),
(772, 299, 'El Rincón'),
(773, 299, 'General Francisco Antonio Váquez'),
(774, 299, 'Guaraúnos'),
(775, 299, 'Tunapuicito'),
(776, 299, 'Unión'),
(777, 300, 'Santa Catalina'),
(778, 300, 'Santa Rosa'),
(779, 300, 'Santa Teresa'),
(780, 300, 'Bolívar'),
(781, 300, 'Maracapana'),
(782, 302, 'Libertad'),
(783, 302, 'El Paujil'),
(784, 302, 'Yaguaraparo'),
(785, 303, 'Cruz Salmerón Acosta'),
(786, 303, 'Chacopata'),
(787, 303, 'Manicuare'),
(788, 304, 'Tunapuy'),
(789, 304, 'Campo Elías'),
(790, 305, 'Irapa'),
(791, 305, 'Campo Claro'),
(792, 305, 'Maraval'),
(793, 305, 'San Antonio de Irapa'),
(794, 305, 'Soro'),
(795, 306, 'Mejía'),
(796, 307, 'Cumanacoa'),
(797, 307, 'Arenas'),
(798, 307, 'Aricagua'),
(799, 307, 'Cogollar'),
(800, 307, 'San Fernando'),
(801, 307, 'San Lorenzo'),
(802, 308, 'Villa Frontado (Muelle de Cariaco)'),
(803, 308, 'Catuaro'),
(804, 308, 'Rendón'),
(805, 308, 'San Cruz'),
(806, 308, 'Santa María'),
(807, 309, 'Altagracia'),
(808, 309, 'Santa Inés'),
(809, 309, 'Valentín Valiente'),
(810, 309, 'Ayacucho'),
(811, 309, 'San Juan'),
(812, 309, 'Raúl Leoni'),
(813, 309, 'Gran Mariscal'),
(814, 310, 'Cristóbal Colón'),
(815, 310, 'Bideau'),
(816, 310, 'Punta de Piedras'),
(817, 310, 'Güiria'),
(818, 341, 'Andrés Bello'),
(819, 342, 'Antonio Rómulo Costa'),
(820, 343, 'Ayacucho'),
(821, 343, 'Rivas Berti'),
(822, 343, 'San Pedro del Río'),
(823, 344, 'Bolívar'),
(824, 344, 'Palotal'),
(825, 344, 'General Juan Vicente Gómez'),
(826, 344, 'Isaías Medina Angarita'),
(827, 345, 'Cárdenas'),
(828, 345, 'Amenodoro Ángel Lamus'),
(829, 345, 'La Florida'),
(830, 346, 'Córdoba'),
(831, 347, 'Fernández Feo'),
(832, 347, 'Alberto Adriani'),
(833, 347, 'Santo Domingo'),
(834, 348, 'Francisco de Miranda'),
(835, 349, 'García de Hevia'),
(836, 349, 'Boca de Grita'),
(837, 349, 'José Antonio Páez'),
(838, 350, 'Guásimos'),
(839, 351, 'Independencia'),
(840, 351, 'Juan Germán Roscio'),
(841, 351, 'Román Cárdenas'),
(842, 352, 'Jáuregui'),
(843, 352, 'Emilio Constantino Guerrero'),
(844, 352, 'Monseñor Miguel Antonio Salas'),
(845, 353, 'José María Vargas'),
(846, 354, 'Junín'),
(847, 354, 'La Petrólea'),
(848, 354, 'Quinimarí'),
(849, 354, 'Bramón'),
(850, 355, 'Libertad'),
(851, 355, 'Cipriano Castro'),
(852, 355, 'Manuel Felipe Rugeles'),
(853, 356, 'Libertador'),
(854, 356, 'Doradas'),
(855, 356, 'Emeterio Ochoa'),
(856, 356, 'San Joaquín de Navay'),
(857, 357, 'Lobatera'),
(858, 357, 'Constitución'),
(859, 358, 'Michelena'),
(860, 359, 'Panamericano'),
(861, 359, 'La Palmita'),
(862, 360, 'Pedro María Ureña'),
(863, 360, 'Nueva Arcadia'),
(864, 361, 'Delicias'),
(865, 361, 'Pecaya'),
(866, 362, 'Samuel Darío Maldonado'),
(867, 362, 'Boconó'),
(868, 362, 'Hernández'),
(869, 363, 'La Concordia'),
(870, 363, 'San Juan Bautista'),
(871, 363, 'Pedro María Morantes'),
(872, 363, 'San Sebastián'),
(873, 363, 'Dr. Francisco Romero Lobo'),
(874, 364, 'Seboruco'),
(875, 365, 'Simón Rodríguez'),
(876, 366, 'Sucre'),
(877, 366, 'Eleazar López Contreras'),
(878, 366, 'San Pablo'),
(879, 367, 'Torbes'),
(880, 368, 'Uribante'),
(881, 368, 'Cárdenas'),
(882, 368, 'Juan Pablo Peñalosa'),
(883, 368, 'Potosí'),
(884, 369, 'San Judas Tadeo'),
(885, 370, 'Araguaney'),
(886, 370, 'El Jaguito'),
(887, 370, 'La Esperanza'),
(888, 370, 'Santa Isabel'),
(889, 371, 'Boconó'),
(890, 371, 'El Carmen'),
(891, 371, 'Mosquey'),
(892, 371, 'Ayacucho'),
(893, 371, 'Burbusay'),
(894, 371, 'General Ribas'),
(895, 371, 'Guaramacal'),
(896, 371, 'Vega de Guaramacal'),
(897, 371, 'Monseñor Jáuregui'),
(898, 371, 'Rafael Rangel'),
(899, 371, 'San Miguel'),
(900, 371, 'San José'),
(901, 372, 'Sabana Grande'),
(902, 372, 'Cheregüé'),
(903, 372, 'Granados'),
(904, 373, 'Arnoldo Gabaldón'),
(905, 373, 'Bolivia'),
(906, 373, 'Carrillo'),
(907, 373, 'Cegarra'),
(908, 373, 'Chejendé'),
(909, 373, 'Manuel Salvador Ulloa'),
(910, 373, 'San José'),
(911, 374, 'Carache'),
(912, 374, 'La Concepción'),
(913, 374, 'Cuicas'),
(914, 374, 'Panamericana'),
(915, 374, 'Santa Cruz'),
(916, 375, 'Escuque'),
(917, 375, 'La Unión'),
(918, 375, 'Santa Rita'),
(919, 375, 'Sabana Libre'),
(920, 376, 'El Socorro'),
(921, 376, 'Los Caprichos'),
(922, 376, 'Antonio José de Sucre'),
(923, 377, 'Campo Elías'),
(924, 377, 'Arnoldo Gabaldón'),
(925, 378, 'Santa Apolonia'),
(926, 378, 'El Progreso'),
(927, 378, 'La Ceiba'),
(928, 378, 'Tres de Febrero'),
(929, 379, 'El Dividive'),
(930, 379, 'Agua Santa'),
(931, 379, 'Agua Caliente'),
(932, 379, 'El Cenizo'),
(933, 379, 'Valerita'),
(934, 380, 'Monte Carmelo'),
(935, 380, 'Buena Vista'),
(936, 380, 'Santa María del Horcón'),
(937, 381, 'Motatán'),
(938, 381, 'El Baño'),
(939, 381, 'Jalisco'),
(940, 382, 'Pampán'),
(941, 382, 'Flor de Patria'),
(942, 382, 'La Paz'),
(943, 382, 'Santa Ana'),
(944, 383, 'Pampanito'),
(945, 383, 'La Concepción'),
(946, 383, 'Pampanito II'),
(947, 384, 'Betijoque'),
(948, 384, 'José Gregorio Hernández'),
(949, 384, 'La Pueblita'),
(950, 384, 'Los Cedros'),
(951, 385, 'Carvajal'),
(952, 385, 'Campo Alegre'),
(953, 385, 'Antonio Nicolás Briceño'),
(954, 385, 'José Leonardo Suárez'),
(955, 386, 'Sabana de Mendoza'),
(956, 386, 'Junín'),
(957, 386, 'Valmore Rodríguez'),
(958, 386, 'El Paraíso'),
(959, 387, 'Andrés Linares'),
(960, 387, 'Chiquinquirá'),
(961, 387, 'Cristóbal Mendoza'),
(962, 387, 'Cruz Carrillo'),
(963, 387, 'Matriz'),
(964, 387, 'Monseñor Carrillo'),
(965, 387, 'Tres Esquinas'),
(966, 388, 'Cabimbú'),
(967, 388, 'Jajó'),
(968, 388, 'La Mesa de Esnujaque'),
(969, 388, 'Santiago'),
(970, 388, 'Tuñame'),
(971, 388, 'La Quebrada'),
(972, 389, 'Juan Ignacio Montilla'),
(973, 389, 'La Beatriz'),
(974, 389, 'La Puerta'),
(975, 389, 'Mendoza del Valle de Momboy'),
(976, 389, 'Mercedes Díaz'),
(977, 389, 'San Luis'),
(978, 390, 'Caraballeda'),
(979, 390, 'Carayaca'),
(980, 390, 'Carlos Soublette'),
(981, 390, 'Caruao Chuspa'),
(982, 390, 'Catia La Mar'),
(983, 390, 'El Junko'),
(984, 390, 'La Guaira'),
(985, 390, 'Macuto'),
(986, 390, 'Maiquetía'),
(987, 390, 'Naiguatá'),
(988, 390, 'Urimare'),
(989, 391, 'Arístides Bastidas'),
(990, 392, 'Bolívar'),
(991, 407, 'Chivacoa'),
(992, 407, 'Campo Elías'),
(993, 408, 'Cocorote'),
(994, 409, 'Independencia'),
(995, 410, 'José Antonio Páez'),
(996, 411, 'La Trinidad'),
(997, 412, 'Manuel Monge'),
(998, 413, 'Salóm'),
(999, 413, 'Temerla'),
(1000, 413, 'Nirgua'),
(1001, 414, 'San Andrés'),
(1002, 414, 'Yaritagua'),
(1003, 415, 'San Javier'),
(1004, 415, 'Albarico'),
(1005, 415, 'San Felipe'),
(1006, 416, 'Sucre'),
(1007, 417, 'Urachiche'),
(1008, 418, 'El Guayabo'),
(1009, 418, 'Farriar'),
(1010, 441, 'Isla de Toas'),
(1011, 441, 'Monagas'),
(1012, 442, 'San Timoteo'),
(1013, 442, 'General Urdaneta'),
(1014, 442, 'Libertador'),
(1015, 442, 'Marcelino Briceño'),
(1016, 442, 'Pueblo Nuevo'),
(1017, 442, 'Manuel Guanipa Matos'),
(1018, 443, 'Ambrosio'),
(1019, 443, 'Carmen Herrera'),
(1020, 443, 'La Rosa'),
(1021, 443, 'Germán Ríos Linares'),
(1022, 443, 'San Benito'),
(1023, 443, 'Rómulo Betancourt'),
(1024, 443, 'Jorge Hernández'),
(1025, 443, 'Punta Gorda'),
(1026, 443, 'Arístides Calvani'),
(1027, 444, 'Encontrados'),
(1028, 444, 'Udón Pérez'),
(1029, 445, 'Moralito'),
(1030, 445, 'San Carlos del Zulia'),
(1031, 445, 'Santa Cruz del Zulia'),
(1032, 445, 'Santa Bárbara'),
(1033, 445, 'Urribarrí'),
(1034, 446, 'Carlos Quevedo'),
(1035, 446, 'Francisco Javier Pulgar'),
(1036, 446, 'Simón Rodríguez'),
(1037, 446, 'Guamo-Gavilanes'),
(1038, 448, 'La Concepción'),
(1039, 448, 'San José'),
(1040, 448, 'Mariano Parra León'),
(1041, 448, 'José Ramón Yépez'),
(1042, 449, 'Jesús María Semprún'),
(1043, 449, 'Barí'),
(1044, 450, 'Concepción'),
(1045, 450, 'Andrés Bello'),
(1046, 450, 'Chiquinquirá'),
(1047, 450, 'El Carmelo'),
(1048, 450, 'Potreritos'),
(1049, 451, 'Libertad'),
(1050, 451, 'Alonso de Ojeda'),
(1051, 451, 'Venezuela'),
(1052, 451, 'Eleazar López Contreras'),
(1053, 451, 'Campo Lara'),
(1054, 452, 'Bartolomé de las Casas'),
(1055, 452, 'Libertad'),
(1056, 452, 'Río Negro'),
(1057, 452, 'San José de Perijá'),
(1058, 453, 'San Rafael'),
(1059, 453, 'La Sierrita'),
(1060, 453, 'Las Parcelas'),
(1061, 453, 'Luis de Vicente'),
(1062, 453, 'Monseñor Marcos Sergio Godoy'),
(1063, 453, 'Ricaurte'),
(1064, 453, 'Tamare'),
(1065, 454, 'Antonio Borjas Romero'),
(1066, 454, 'Bolívar'),
(1067, 454, 'Cacique Mara'),
(1068, 454, 'Carracciolo Parra Pérez'),
(1069, 454, 'Cecilio Acosta'),
(1070, 454, 'Cristo de Aranza'),
(1071, 454, 'Coquivacoa'),
(1072, 454, 'Chiquinquirá'),
(1073, 454, 'Francisco Eugenio Bustamante'),
(1074, 454, 'Idelfonzo Vásquez'),
(1075, 454, 'Juana de Ávila'),
(1076, 454, 'Luis Hurtado Higuera'),
(1077, 454, 'Manuel Dagnino'),
(1078, 454, 'Olegario Villalobos'),
(1079, 454, 'Raúl Leoni'),
(1080, 454, 'Santa Lucía'),
(1081, 454, 'Venancio Pulgar'),
(1082, 454, 'San Isidro'),
(1083, 455, 'Altagracia'),
(1084, 455, 'Faría'),
(1085, 455, 'Ana María Campos'),
(1086, 455, 'San Antonio'),
(1087, 455, 'San José'),
(1088, 456, 'Donaldo García'),
(1089, 456, 'El Rosario'),
(1090, 456, 'Sixto Zambrano'),
(1091, 457, 'San Francisco'),
(1092, 457, 'El Bajo'),
(1093, 457, 'Domitila Flores'),
(1094, 457, 'Francisco Ochoa'),
(1095, 457, 'Los Cortijos'),
(1096, 457, 'Marcial Hernández'),
(1097, 458, 'Santa Rita'),
(1098, 458, 'El Mene'),
(1099, 458, 'Pedro Lucas Urribarrí'),
(1100, 458, 'José Cenobio Urribarrí'),
(1101, 459, 'Rafael Maria Baralt'),
(1102, 459, 'Manuel Manrique'),
(1103, 459, 'Rafael Urdaneta'),
(1104, 460, 'Bobures'),
(1105, 460, 'Gibraltar'),
(1106, 460, 'Heras'),
(1107, 460, 'Monseñor Arturo Álvarez'),
(1108, 460, 'Rómulo Gallegos'),
(1109, 460, 'El Batey'),
(1110, 461, 'Rafael Urdaneta'),
(1111, 461, 'La Victoria'),
(1112, 461, 'Raúl Cuenca'),
(1113, 447, 'Sinamaica'),
(1114, 447, 'Alta Guajira'),
(1115, 447, 'Elías Sánchez Rubio'),
(1116, 447, 'Guajira'),
(1117, 462, 'Altagracia'),
(1118, 462, 'Antímano'),
(1119, 462, 'Caricuao'),
(1120, 462, 'Catedral'),
(1121, 462, 'Coche'),
(1122, 462, 'El Junquito'),
(1123, 462, 'El Paraíso'),
(1124, 462, 'El Recreo'),
(1125, 462, 'El Valle'),
(1126, 462, 'La Candelaria'),
(1127, 462, 'La Pastora'),
(1128, 462, 'La Vega'),
(1129, 462, 'Macarao'),
(1130, 462, 'San Agustín'),
(1131, 462, 'San Bernardino'),
(1132, 462, 'San José'),
(1133, 462, 'San Juan'),
(1134, 462, 'San Pedro'),
(1135, 462, 'Santa Rosalía'),
(1136, 462, 'Santa Teresa'),
(1137, 462, 'Sucre (Catia)'),
(1138, 462, '23 de enero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `CI` int(11) NOT NULL,
  `PN` varchar(45) NOT NULL,
  `SN` varchar(45) DEFAULT NULL,
  `TN` varchar(45) DEFAULT NULL,
  `PA` varchar(45) NOT NULL,
  `SA` varchar(45) DEFAULT NULL,
  `F_nac` date NOT NULL,
  `Edad` int(3) NOT NULL,
  `Sexo` enum('M','F') NOT NULL,
  `ID_Direccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`CI`, `PN`, `SN`, `TN`, `PA`, `SA`, `F_nac`, `Edad`, `Sexo`, `ID_Direccion`) VALUES
(123456, 'ADMIN', NULL, NULL, 'ADMIN', NULL, '2000-01-01', 23, 'M', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recup_password`
--

CREATE TABLE `recup_password` (
  `ID_Recup_Password` int(11) NOT NULL,
  `P1` varchar(100) DEFAULT NULL,
  `P2` varchar(100) DEFAULT NULL,
  `P3` varchar(100) DEFAULT NULL,
  `R1` varchar(100) DEFAULT NULL,
  `R2` varchar(100) DEFAULT NULL,
  `R3` varchar(100) DEFAULT NULL,
  `ID_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `recup_password`
--

INSERT INTO `recup_password` (`ID_Recup_Password`, `P1`, `P2`, `P3`, `R1`, `R2`, `R3`, `ID_Usuario`) VALUES
(1, 'Ciudad de nacimiento', 'Nombre de mi mascota', 'Nombre de mi mascota', 'admin', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `ID_Telefono` int(11) NOT NULL,
  `Cod_Area` varchar(10) DEFAULT NULL,
  `Nro_Telf` varchar(45) DEFAULT NULL,
  `CI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `telefono`
--

INSERT INTO `telefono` (`ID_Telefono`, `Cod_Area`, `Nro_Telf`, `CI`) VALUES
(1, '1234', '1234567', 123456);

--
-- Disparadores `telefono`
--
DELIMITER $$
CREATE TRIGGER `call_actualizar_columna_edad` AFTER INSERT ON `telefono` FOR EACH ROW BEGIN
	CALL actualizar_columna_edad();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL,
  `CIE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre`, `Password`, `CIE`) VALUES
(1, 'ADMIN', '$2y$10$Dx8gHR45bvQJFbR1ri3pleB5D1eX5/DTUhbgkyFk2Utks9s2St.46', 123456);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_emite_factura`
--

CREATE TABLE `usuario_emite_factura` (
  `ID_Usuario` int(11) NOT NULL,
  `ID_Factura` int(11) NOT NULL,
  `F_Emision` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_realiza_informe`
--

CREATE TABLE `usuario_realiza_informe` (
  `ID_Usuario` int(11) NOT NULL,
  `ID_Informe` int(11) NOT NULL,
  `F_Informe` datetime DEFAULT NULL,
  `F_Entrega` datetime DEFAULT NULL,
  `Obs` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_registra_insumo`
--

CREATE TABLE `usuario_registra_insumo` (
  `ID_Usuario` int(11) NOT NULL,
  `ID_Insumo` int(11) NOT NULL,
  `F_Registro` datetime DEFAULT NULL,
  `Cantidad` varchar(45) DEFAULT NULL,
  `Obs` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_registra_paciente`
--

CREATE TABLE `usuario_registra_paciente` (
  `ID_Usuario` int(11) NOT NULL,
  `CIP` int(11) NOT NULL,
  `F_Registro` datetime DEFAULT NULL,
  `Obs` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `correo`
--
ALTER TABLE `correo`
  ADD PRIMARY KEY (`ID_Correo`,`CI`),
  ADD UNIQUE KEY `ID_Correo` (`ID_Correo`),
  ADD KEY `fk_Correo_Persona1` (`CI`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`ID_Direccion`,`ID_Parroquia`),
  ADD UNIQUE KEY `ID_Direccion` (`ID_Direccion`),
  ADD KEY `fk_Direccion_Parroquia1` (`ID_Parroquia`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`CIE`),
  ADD UNIQUE KEY `CIE` (`CIE`),
  ADD UNIQUE KEY `CIE_2` (`CIE`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`ID_Examen`),
  ADD UNIQUE KEY `ID_Examen` (`ID_Examen`),
  ADD KEY `FK_id_m_remitido` (`ID_M_remitido`);

--
-- Indices de la tabla `examen_usa_insumo`
--
ALTER TABLE `examen_usa_insumo`
  ADD PRIMARY KEY (`ID_Examen`,`ID_Insumo`),
  ADD KEY `ID_Insumo` (`ID_Insumo`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID_Factura`),
  ADD UNIQUE KEY `ID_Factura` (`ID_Factura`),
  ADD KEY `fk_Factura_NControl1` (`Nro_Control`),
  ADD KEY `fk_Factura_CIP1` (`CIP`);

--
-- Indices de la tabla `informe`
--
ALTER TABLE `informe`
  ADD PRIMARY KEY (`ID_Informe`,`CIP`),
  ADD UNIQUE KEY `ID_Informe` (`ID_Informe`),
  ADD KEY `fk_Informe_Paciente1` (`CIP`),
  ADD KEY `FK_Informe_Medico` (`ID_Medico`);

--
-- Indices de la tabla `inf_biopsia`
--
ALTER TABLE `inf_biopsia`
  ADD PRIMARY KEY (`ID_Inf_Biopsia`),
  ADD UNIQUE KEY `ID_Inf_Biopsia` (`ID_Inf_Biopsia`),
  ADD KEY `ID_Informe` (`ID_Informe`),
  ADD KEY `ID_Examen` (`ID_Examen`);

--
-- Indices de la tabla `inf_citologia`
--
ALTER TABLE `inf_citologia`
  ADD PRIMARY KEY (`ID_Inf_Citologia`),
  ADD UNIQUE KEY `ID_Inf_Citologia` (`ID_Inf_Citologia`),
  ADD KEY `ID_Informe` (`ID_Informe`),
  ADD KEY `ID_Examen` (`ID_Examen`);

--
-- Indices de la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`ID_Insumo`),
  ADD UNIQUE KEY `ID_Insumo` (`ID_Insumo`);

--
-- Indices de la tabla `insumo_tiene_lote`
--
ALTER TABLE `insumo_tiene_lote`
  ADD PRIMARY KEY (`ID_Insumo`,`ID_Lote`),
  ADD KEY `ID_Lote` (`ID_Lote`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`ID_Lote`),
  ADD UNIQUE KEY `ID_Lote` (`ID_Lote`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`ID_Medico`);

--
-- Indices de la tabla `medico_remite_paciente`
--
ALTER TABLE `medico_remite_paciente`
  ADD PRIMARY KEY (`ID_Medico`,`CIP`),
  ADD KEY `FK_paciente` (`CIP`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `m_biopsia`
--
ALTER TABLE `m_biopsia`
  ADD PRIMARY KEY (`ID_M_Biopsia`),
  ADD UNIQUE KEY `ID_M_Biopsia` (`ID_M_Biopsia`),
  ADD KEY `fk_ID_M_Remitido1` (`ID_M_Remitido`);

--
-- Indices de la tabla `m_citologia`
--
ALTER TABLE `m_citologia`
  ADD PRIMARY KEY (`ID_M_Citologia`),
  ADD UNIQUE KEY `ID_M_Citologia` (`ID_M_Citologia`),
  ADD KEY `fk_ID_M_Remitido2` (`ID_M_Remitido`);

--
-- Indices de la tabla `m_remitido`
--
ALTER TABLE `m_remitido`
  ADD PRIMARY KEY (`ID_M_Remitido`),
  ADD KEY `ID_Medico` (`ID_Medico`),
  ADD KEY `CI_Paciente` (`CI_Paciente`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`CIP`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`ID_Pago`),
  ADD UNIQUE KEY `ID_Pago` (`ID_Pago`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`id_parroquia`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`CI`,`ID_Direccion`),
  ADD UNIQUE KEY `CI` (`CI`),
  ADD KEY `fk_Persona_Direccion1` (`ID_Direccion`);

--
-- Indices de la tabla `recup_password`
--
ALTER TABLE `recup_password`
  ADD PRIMARY KEY (`ID_Recup_Password`,`ID_Usuario`),
  ADD UNIQUE KEY `ID_Recup_Password` (`ID_Recup_Password`),
  ADD KEY `fk_Recup_Password_Usuario1` (`ID_Usuario`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`ID_Telefono`,`CI`),
  ADD UNIQUE KEY `ID_Telefono` (`ID_Telefono`),
  ADD KEY `fk_Telefono_Persona1` (`CI`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`,`CIE`),
  ADD UNIQUE KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `fk_Usuario_Empleado1` (`CIE`);

--
-- Indices de la tabla `usuario_emite_factura`
--
ALTER TABLE `usuario_emite_factura`
  ADD PRIMARY KEY (`ID_Usuario`,`ID_Factura`),
  ADD KEY `ID_Factura` (`ID_Factura`);

--
-- Indices de la tabla `usuario_realiza_informe`
--
ALTER TABLE `usuario_realiza_informe`
  ADD PRIMARY KEY (`ID_Usuario`,`ID_Informe`),
  ADD KEY `ID_Informe` (`ID_Informe`);

--
-- Indices de la tabla `usuario_registra_insumo`
--
ALTER TABLE `usuario_registra_insumo`
  ADD PRIMARY KEY (`ID_Usuario`,`ID_Insumo`),
  ADD KEY `ID_Insumo` (`ID_Insumo`);

--
-- Indices de la tabla `usuario_registra_paciente`
--
ALTER TABLE `usuario_registra_paciente`
  ADD PRIMARY KEY (`ID_Usuario`,`CIP`),
  ADD KEY `CIP` (`CIP`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT de la tabla `correo`
--
ALTER TABLE `correo`
  MODIFY `ID_Correo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `ID_Direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `ID_Examen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `ID_Factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informe`
--
ALTER TABLE `informe`
  MODIFY `ID_Informe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumo`
--
ALTER TABLE `insumo`
  MODIFY `ID_Insumo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `ID_Lote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `ID_Medico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT de la tabla `m_biopsia`
--
ALTER TABLE `m_biopsia`
  MODIFY `ID_M_Biopsia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `m_citologia`
--
ALTER TABLE `m_citologia`
  MODIFY `ID_M_Citologia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `m_remitido`
--
ALTER TABLE `m_remitido`
  MODIFY `ID_M_Remitido` int(11) NOT NULL AUTO_INCREMENT;
 
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `ID_Pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  MODIFY `id_parroquia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1139;

--
-- AUTO_INCREMENT de la tabla `recup_password`
--
ALTER TABLE `recup_password`
  MODIFY `ID_Recup_Password` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `telefono`
--
ALTER TABLE `telefono`
  MODIFY `ID_Telefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inf_biopsia`
--
ALTER TABLE `inf_biopsia`
  MODIFY `ID_Inf_Biopsia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inf_citologia`
--
ALTER TABLE `inf_citologia`
  MODIFY `ID_Inf_Citologia` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `correo`
--
ALTER TABLE `correo`
  ADD CONSTRAINT `fk_Correo_Persona1` FOREIGN KEY (`CI`) REFERENCES `persona` (`CI`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `fk_Direccion_Parroquia1` FOREIGN KEY (`ID_Parroquia`) REFERENCES `parroquia` (`id_parroquia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_Empleado_Persona1` FOREIGN KEY (`CIE`) REFERENCES `persona` (`CI`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `FK_id_m_remitido` FOREIGN KEY (`ID_M_remitido`) REFERENCES `m_remitido` (`ID_M_remitido`);

--
-- Filtros para la tabla `examen_usa_insumo`
--
ALTER TABLE `examen_usa_insumo`
  ADD CONSTRAINT `examen_usa_insumo_ibfk_1` FOREIGN KEY (`ID_Insumo`) REFERENCES `insumo` (`ID_Insumo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Examen_Insumo1` FOREIGN KEY (`ID_Examen`) REFERENCES `examen` (`ID_Examen`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Factura_NControl1` FOREIGN KEY (`Nro_Control`) REFERENCES `pago` (`ID_Pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Factura_CIP1` FOREIGN KEY (`CIP`) REFERENCES `paciente` (`CIP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `informe`
--
ALTER TABLE `informe`
  ADD CONSTRAINT `FK_Informe_Medico` FOREIGN KEY (`ID_Medico`) REFERENCES `medico` (`ID_Medico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Informe_Paciente1` FOREIGN KEY (`CIP`) REFERENCES `paciente` (`CIP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inf_biopsia`
--
ALTER TABLE `inf_biopsia`
  ADD CONSTRAINT `fk_Inf_Biopsia_Informe_Examen1` FOREIGN KEY (`ID_Informe`) REFERENCES `informe` (`ID_Informe`),
  ADD CONSTRAINT `inf_biopsia_ibfk_1` FOREIGN KEY (`ID_Examen`) REFERENCES `examen` (`ID_Examen`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inf_citologia`
--
ALTER TABLE `inf_citologia`
  ADD CONSTRAINT `fk_Inf_Citologia_Informe_Examen1` FOREIGN KEY (`ID_Informe`) REFERENCES `informe` (`ID_Informe`),
  ADD CONSTRAINT `inf_citologia_ibfk_1` FOREIGN KEY (`ID_Examen`) REFERENCES `examen` (`ID_Examen`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `insumo_tiene_lote`
--
ALTER TABLE `insumo_tiene_lote`
  ADD CONSTRAINT `fk_Insumo_Lote1` FOREIGN KEY (`ID_Insumo`) REFERENCES `insumo` (`ID_Insumo`),
  ADD CONSTRAINT `insumo_tiene_lote_ibfk_1` FOREIGN KEY (`ID_Lote`) REFERENCES `lote` (`ID_Lote`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `medico_remite_paciente`
--
ALTER TABLE `medico_remite_paciente`
  ADD CONSTRAINT `FK_medico` FOREIGN KEY (`ID_Medico`) REFERENCES `medico` (`ID_Medico`),
  ADD CONSTRAINT `FK_paciente` FOREIGN KEY (`CIP`) REFERENCES `paciente` (`CIP`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `m_biopsia`
--
ALTER TABLE `m_biopsia`
  ADD CONSTRAINT `fk_M_Biopsia_M_Remitido_Examen1` FOREIGN KEY (`ID_M_Remitido`) REFERENCES `m_remitido` (`ID_M_Remitido`);

--
-- Filtros para la tabla `m_citologia`
--
ALTER TABLE `m_citologia`
  ADD CONSTRAINT `fk_M_Citologia_M_Remitido_Examen1` FOREIGN KEY (`ID_M_Remitido`) REFERENCES `m_remitido` (`ID_M_Remitido`);

--
-- Filtros para la tabla `m_remitido`
--
ALTER TABLE `m_remitido`
  ADD CONSTRAINT `m_remitido_ibfk_1` FOREIGN KEY (`ID_Medico`) REFERENCES `medico` (`ID_Medico`),
  ADD CONSTRAINT `m_remitido_ibfk_2` FOREIGN KEY (`CI_Paciente`) REFERENCES `paciente` (`CIP`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_CIP_CI` FOREIGN KEY (`CIP`) REFERENCES `persona` (`CI`);

--
-- Filtros para la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD CONSTRAINT `parroquia_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_Persona_Direccion1` FOREIGN KEY (`ID_Direccion`) REFERENCES `direccion` (`ID_Direccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recup_password`
--
ALTER TABLE `recup_password`
  ADD CONSTRAINT `fk_Recup_Password_Usuario1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `fk_Telefono_Persona1` FOREIGN KEY (`CI`) REFERENCES `persona` (`CI`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Empleado1` FOREIGN KEY (`CIE`) REFERENCES `empleado` (`CIE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_emite_factura`
--
ALTER TABLE `usuario_emite_factura`
  ADD CONSTRAINT `fk_Usuario_Factura1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `usuario_emite_factura_ibfk_1` FOREIGN KEY (`ID_Factura`) REFERENCES `factura` (`ID_Factura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_realiza_informe`
--
ALTER TABLE `usuario_realiza_informe`
  ADD CONSTRAINT `fk_Usuario_Informe1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `usuario_realiza_informe_ibfk_1` FOREIGN KEY (`ID_Informe`) REFERENCES `informe` (`ID_Informe`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_registra_insumo`
--
ALTER TABLE `usuario_registra_insumo`
  ADD CONSTRAINT `fk_Usuario_Insumo1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `usuario_registra_insumo_ibfk_1` FOREIGN KEY (`ID_Insumo`) REFERENCES `insumo` (`ID_Insumo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_registra_paciente`
--
ALTER TABLE `usuario_registra_paciente`
  ADD CONSTRAINT `fk_Usuario_Paciente1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `usuario_registra_paciente_ibfk_1` FOREIGN KEY (`CIP`) REFERENCES `paciente` (`CIP`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
