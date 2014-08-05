-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Jul-2014 às 01:53
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `campeonato`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` text NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `id_categoria_3` (`id_categoria`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_categoria_2` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome_categoria`) VALUES
(1, 'KIDS MASCULINO'),
(2, 'KIDS FEMININO'),
(3, 'JUNIOR MASCULINO'),
(4, 'JUNIOR FEMININO'),
(5, 'FUN RACE MASCULINO'),
(6, 'FUN RACE MASC MASTER'),
(7, 'FUN RACE MASC G-MASTER'),
(8, 'FUN RACE FEMININO'),
(9, 'FUN RACE FEM MASTER'),
(10, 'FUN RACE FEM G-MASTER'),
(11, 'RACE AMADOR MASC'),
(12, 'RACE AMADOR FEM'),
(13, 'RACE PROFISSIONAL MASC'),
(14, 'RACE PROFISSIONAL FEM'),
(15, 'RACE MASTER'),
(16, 'RACE GRAN MASTER'),
(17, 'RACE 14'),
(18, 'UNLIMIT'),
(19, 'PADDLE BOARD MASC'),
(20, 'CANOA HAVAIANA'),
(21, 'PADDLE BOARD FEM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `etapa`
--

CREATE TABLE IF NOT EXISTS `etapa` (
  `id_etapa` int(11) NOT NULL,
  `local` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `etapa`
--

INSERT INTO `etapa` (`id_etapa`, `local`) VALUES
(1, 'SALINAS DAS MARGARIDAS'),
(2, 'BAHIA SUP ECO 2014');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao`
--

CREATE TABLE IF NOT EXISTS `inscricao` (
  `id_etapa` int(11) NOT NULL,
  `id_participante` varchar(15) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `cod_inscricao` int(11) NOT NULL,
  `tempo` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `inscricao`
--

INSERT INTO `inscricao` (`id_etapa`, `id_participante`, `id_categoria`, `cod_inscricao`, `tempo`) VALUES
(1, '26819899572', 16, 101, NULL),
(1, '48801372504', 6, 103, NULL),
(1, '27733084504', 6, 105, '12:34:23'),
(1, '14824094534', 19, 106, '01:30:45'),
(1, '80604129572', 19, 107, '00:49:00'),
(1, '54386286853', 19, 108, '01:49:00'),
(1, '93063679534', 21, 109, NULL),
(1, '29346762500', 18, 112, '00:30:01'),
(1, '2029590231', 1, 111, '01:00:00'),
(2, '29346762500', 18, 500, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `participante`
--

CREATE TABLE IF NOT EXISTS `participante` (
  `id_participante` varchar(15) NOT NULL,
  `nome_participante` text NOT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_participante`),
  UNIQUE KEY `id_participante` (`id_participante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `participante`
--

INSERT INTO `participante` (`id_participante`, `nome_participante`, `estado`, `email`) VALUES
('14824094534', 'Mauricio Abubakir', 'BA', 'qcabubakir@ig.com.br'),
('2029590231', 'Guilherme Berenguer de Carvalho', 'BA', 'acasurf@ig.com.br'),
('26819899572', 'Jorge Mario Lino Villas Boas', 'BA', 'jorgemariolinovb@hotmail.com'),
('27733084504', 'Sergio Luiz Calvacante de Oliveira', 'BA', 'sergiolcoliveira@hotmail.com'),
('29346762500', 'Jose Augusto Pinto de Carvalho', 'BA', 'acasurf@ig.com.br'),
('48801372504', 'Alexandre Issami', 'BA', 'moniaehp@hotmail.com'),
('54386286853', 'Genauto Carvalho de Franca Filho', 'BA', 'genauto@ufba.ba'),
('80604129572', 'Claudio Duarte Britto', 'BA', 'duarte.britto@gmail.com'),
('93063679534', 'Sinara Pazos Britto', 'BA', 'sinarapazos@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ranking`
--

CREATE TABLE IF NOT EXISTS `ranking` (
  `id_participante` varchar(15) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `pontos` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_participante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ranking`
--

INSERT INTO `ranking` (`id_participante`, `id_categoria`, `pontos`) VALUES
('14824094534', 19, 1720),
('2029590231', 1, 2000),
('26819899572', 16, 2000),
('27733084504', 6, 1720),
('29346762500', 18, 2000),
('48801372504', 6, 2000),
('54386286853', 19, 1460),
('80604129572', 19, 2000),
('93063679534', 21, 2000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
