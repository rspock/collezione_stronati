INSERT INTO `geo_continenti` (`id`, `codice`, `continente`) VALUES
(1, '1', 'Europa'),
(2, '2', 'Africa'),
(3, '3', 'Asia'),
(4, '4', 'America'),
(5, '5', 'Oceania'),
(6, '6', 'Apolidi');

INSERT INTO `geo_aree_geopolitiche` (`id`, `continente_id`, `codice`, `area`) VALUES
(1, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '1'), '11', 'Unione Europea'),
(2, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '1'), '12', 'Europa centro orientale'),
(3, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '1'), '13', 'Altri paesi europei'),
(4, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '2'), '21', 'Africa settentrionale'),
(5, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '2'), '22', 'Africa occidentale'),
(6, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '2'), '23', 'Africa orientale'),
(7, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '2'), '24', 'Africa centro meridionale'),
(8, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '3'), '31', 'Asia occidentale'),
(9, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '3'), '32', 'Asia centro meridionale'),
(10, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '3'), '33', 'Asia orientale'),
(11, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '4'), '41', 'America settentrionale'),
(12, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '4'), '42', 'America centro meridionale'),
(13, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '5'), '50', 'Oceania'),
(14, (SELECT `id` FROM `geo_continenti` WHERE `codice` = '6'), '60', 'Apolidi');

INSERT INTO `geo_zone_altimetriche` (`id`, `codice`, `zona`) VALUES
(1, '1', 'Montagna interna'),
(2, '2', 'Montagna litoranea'),
(3, '3', 'Collina interna'),
(4, '4', 'Collina litoranea'),
(5, '5', 'Pianura');
