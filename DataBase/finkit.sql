-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 23 2023 г., 04:15
-- Версия сервера: 10.4.25-MariaDB
-- Версия PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `finkit`
--

-- --------------------------------------------------------

--
-- Структура таблицы `estudiante`
--

CREATE TABLE `estudiante` (
  `ID_estudiante` int(11) NOT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `instituto` varchar(200) DEFAULT NULL,
  `cafedra` varchar(200) DEFAULT NULL,
  `curso` varchar(20) DEFAULT NULL,
  `grupo` varchar(20) DEFAULT NULL,
  `tipo_educacion` varchar(50) DEFAULT NULL,
  `forma_educacion` varchar(50) DEFAULT NULL,
  `promedio_academico` varchar(20) DEFAULT NULL,
  `numero_serie_pasaporte` varchar(25) DEFAULT NULL,
  `emitido_por_quien` varchar(100) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `snils` varchar(25) DEFAULT NULL,
  `parientes` varchar(50) DEFAULT NULL,
  `telefono_pariente` varchar(13) DEFAULT NULL,
  `ID_sesion_usuario` int(11) DEFAULT NULL,
  `aprovado` tinyint(1) NOT NULL,
  `ID_tipo_genero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `estudiante`
--

INSERT INTO `estudiante` (`ID_estudiante`, `fecha_de_nacimiento`, `direccion`, `telefono`, `instituto`, `cafedra`, `curso`, `grupo`, `tipo_educacion`, `forma_educacion`, `promedio_academico`, `numero_serie_pasaporte`, `emitido_por_quien`, `fecha_emision`, `snils`, `parientes`, `telefono_pariente`, `ID_sesion_usuario`, `aprovado`, `ID_tipo_genero`) VALUES
(118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 128, 0, NULL),
(119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 129, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `roles_usuarios`
--

CREATE TABLE `roles_usuarios` (
  `id_roles_usuarios` int(11) NOT NULL,
  `nombre_roles_usuarios` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles_usuarios`
--

INSERT INTO `roles_usuarios` (`id_roles_usuarios`, `nombre_roles_usuarios`) VALUES
(1, 'ESTUDIANTE'),
(2, 'COMANDANTE');

-- --------------------------------------------------------

--
-- Структура таблицы `tipo_genero`
--

CREATE TABLE `tipo_genero` (
  `ID_tipo_genero` int(11) NOT NULL,
  `genero` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tipo_genero`
--

INSERT INTO `tipo_genero` (`ID_tipo_genero`, `genero`) VALUES
(1, 'Мужчина'),
(2, 'Женщина');

-- --------------------------------------------------------

--
-- Структура таблицы `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_sesion_usuario` int(11) NOT NULL,
  `profileImage_dir` varchar(200) DEFAULT NULL,
  `FIO` varchar(50) NOT NULL,
  `token` varchar(300) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(150) NOT NULL,
  `password2` varchar(150) NOT NULL,
  `intentos_fallidos` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_roles_usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `usuarios`
--

INSERT INTO `usuarios` (`ID_sesion_usuario`, `profileImage_dir`, `FIO`, `token`, `nombre`, `email`, `password`, `password2`, `intentos_fallidos`, `fecha`, `id_roles_usuarios`) VALUES
(128, 'Ajax/ProfileImge/user2.jpg', 'Карлос эдуардо Олгин', '6885a142763f3606d83d5132dbe2b354', 'carlos', 'edwuardholguin7@outlook.com', '$6$rounds=5000$BjoniOIpm2r4bmiN$rYOCXryH/j1lImO1B3NS6YnJ5jmiB3zIHygrOsBOmPBetlO8SqcOKmxf4.0ch5M/SSnxsOmIItsgqBN3TkmGE.', '$6$rounds=5000$BjoniOIpm2r4bmiN$rYOCXryH/j1lImO1B3NS6YnJ5jmiB3zIHygrOsBOmPBetlO8SqcOKmxf4.0ch5M/SSnxsOmIItsgqBN3TkmGE.', 0, '2023-05-23 02:07:48', 1),
(129, 'Ajax/ProfileImge/testimonials-2.jpg', 'Николь Стефания Олтин ', '84ce256865b8cce18f072926356b4ce0', 'Nicolle', 'nicollestefania@gmail.ru', '$6$rounds=5000$BjoniOIpm2r4bmiN$rYOCXryH/j1lImO1B3NS6YnJ5jmiB3zIHygrOsBOmPBetlO8SqcOKmxf4.0ch5M/SSnxsOmIItsgqBN3TkmGE.', '$6$rounds=5000$BjoniOIpm2r4bmiN$rYOCXryH/j1lImO1B3NS6YnJ5jmiB3zIHygrOsBOmPBetlO8SqcOKmxf4.0ch5M/SSnxsOmIItsgqBN3TkmGE.', 0, '2023-05-23 02:07:18', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`ID_estudiante`),
  ADD KEY `ID_sesion_usuario` (`ID_sesion_usuario`),
  ADD KEY `ID_tipo_genero` (`ID_tipo_genero`);

--
-- Индексы таблицы `roles_usuarios`
--
ALTER TABLE `roles_usuarios`
  ADD PRIMARY KEY (`id_roles_usuarios`);

--
-- Индексы таблицы `tipo_genero`
--
ALTER TABLE `tipo_genero`
  ADD PRIMARY KEY (`ID_tipo_genero`);

--
-- Индексы таблицы `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_sesion_usuario`),
  ADD KEY `id_roles_usuarios` (`id_roles_usuarios`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `ID_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT для таблицы `roles_usuarios`
--
ALTER TABLE `roles_usuarios`
  MODIFY `id_roles_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tipo_genero`
--
ALTER TABLE `tipo_genero`
  MODIFY `ID_tipo_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_sesion_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`ID_sesion_usuario`) REFERENCES `usuarios` (`ID_sesion_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiante_ibfk_2` FOREIGN KEY (`ID_tipo_genero`) REFERENCES `tipo_genero` (`ID_tipo_genero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_roles_usuarios`) REFERENCES `roles_usuarios` (`id_roles_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
