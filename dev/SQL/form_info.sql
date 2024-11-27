CREATE TABLE `form_info` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `profesion` varchar(255) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `frecuencia` varchar(50) DEFAULT NULL,
  `actividades` text DEFAULT NULL,
  `importancia` tinyint(4) DEFAULT NULL,
  `acciones` text DEFAULT NULL,
  `voluntariado` varchar(50) DEFAULT NULL,
  `arboles` int(11) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `areas` text DEFAULT NULL,
  `conocimiento` tinyint(4) DEFAULT NULL,
  `aprender` varchar(50) DEFAULT NULL,
  `informacion` varchar(50) DEFAULT NULL,
  `objetivos` text DEFAULT NULL,
  `cambios` text DEFAULT NULL,
  `mejorar` text DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `form_info`
  ADD PRIMARY KEY (`id`)

INSERT INTO `form_info` (`id`, `nombre`, `edad`, `profesion`, `correo`, `frecuencia`, `actividades`, `importancia`, `acciones`, `voluntariado`, `arboles`, `horas`, `areas`, `conocimiento`, `aprender`, `informacion`, `objetivos`, `cambios`, `mejorar`, `comentarios`, `created_at`) VALUES
(1, 'Alejandro', 27, 'Contador', 'alejandrosj039@gmail.com', 'diariamente', 'correr', 10, 'reducir_papel', 'si', 1, 1, 'conservacion_bosques', 1, 'si', 'si', 'das', 'asd', 'das', 'asd', '2024-11-13 01:53:28'),
(2, 'Alejandro', 272, 'Contador', 'alejandrosj039@gmail.com', 'diariamente', '1', 1, 'reducir_papel', 'si', 1, 1, 'conservacion_bosques', 1, 'si', 'si', 'sad', 'asd', 'aaaa', '111', '2024-11-13 02:01:32');
;

ALTER TABLE `form_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;