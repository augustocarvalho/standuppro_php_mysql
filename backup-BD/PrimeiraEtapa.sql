-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29-Jul-2014 às 02:57
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
(1, '26819899572', 16, 101, '01:32:26'),
(1, '48801372504', 6, 103, '01:05:31'),
(1, '27733084504', 6, 105, '01:22:12'),
(1, '14824094534', 19, 106, '01:23:23'),
(1, '80604129572', 19, 107, '01:12:28'),
(1, '54386286853', 19, 108, '01:18:36'),
(1, '93063679534', 21, 109, '01:20:16'),
(1, '29346762500', 18, 112, '01:30:33'),
(1, '2029590231', 1, 111, '00:08:55'),
(1, '98716018591', 13, 113, '01:17:13'),
(1, '29267307568', 16, 114, '01:23:31'),
(1, '81199333549', 13, 115, '01:24:01'),
(1, '92040047549', 14, 116, '01:37:53'),
(1, '22721266500', 10, 117, '02:17:20'),
(1, '46047832504', 6, 118, '01:13:37'),
(1, '04696722503', 8, 119, NULL),
(1, '32813988553', 9, 120, NULL),
(1, '77774973591', 13, 121, '01:15:59'),
(1, '21169306500', 13, 122, '01:48:51'),
(1, '21644920582', 16, 123, '01:49:59'),
(1, '33073020578', 5, 124, '01:19:48'),
(1, '55731856591', 7, 125, NULL),
(1, '92755356553', 14, 126, '01:31:02'),
(1, '77774973591', 15, 121, '01:15:59'),
(1, '49234137515', 14, 127, '02:29:18'),
(1, '79485286520', 18, 128, '01:18:34'),
(1, '1142493423', 1, 129, '00:07:38'),
(1, '03661445522', 13, 130, '01:18:45'),
(1, '81199333549', 18, 115, '01:24:01'),
(1, '21169306500', 16, 122, '01:48:51'),
(1, '21169306500', 18, 122, '01:48:51'),
(1, '2029590231', 3, 111, '00:08:55'),
(1, '1142493423', 3, 129, '00:07:38'),
(1, '77666054572', 18, 131, '01:31:21'),
(1, '27178099534', 16, 132, '01:26:10'),
(1, '2361428', 5, 133, '01:05:37'),
(1, '04305200775', 5, 134, '01:04:49'),
(1, '88629899549', 13, 136, '01:20:04'),
(1, '02562612531', 8, 135, '01:42:40'),
(1, '74332511549', 6, 137, NULL),
(1, '29267307568', 13, 114, '01:23:31'),
(1, '29267307568', 15, 114, '01:23:31');

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
('02562612531', 'Tatiana Alves Furtado', 'BA', 'thaty_jazz13@hotmail.com'),
('03661445522', 'Luiz Marques Santana', 'SE', 'luizotasantana@hotmail.com'),
('04305200775', 'Leonardo Maciel Machado ', 'BA', 'leo_mac@terra.com.br'),
('04696722503', 'Samanta de Santana Praia', 'BA', 'sapraia@hotmail.com'),
('1142493423', 'Caue Braga Santos Interaminense', 'BA', 'maxinteraminense@hotmail.com'),
('14824094534', 'Mauricio Abubakir', 'BA', 'qcabubakir@ig.com.br'),
('2029590231', 'Guilherme Berenguer de Carvalho', 'BA', 'acasurf@ig.com.br'),
('21169306500', 'Tuka Carvalho', 'BA', 'tucapcarvalho@ig.com.br'),
('21644920582', 'Antonio Saback', 'BA', 'antoniosaback@hotmail.com'),
('22721266500', 'Eline Mendonca Muniz', 'BA', 'eline.mendonca@hotmail.com'),
('2361428', 'Helton Santos da Silva', 'BA', ''),
('26819899572', 'Jorge Mario Lino Villas Boas', 'BA', 'jorgemariolinovb@hotmail.com'),
('27178099534', 'Vicente Lima de Sa Barreto', 'BA', 'vicente@lognet.com'),
('27733084504', 'Sergio Luiz Calvacante de Oliveira', 'BA', 'sergiolcoliveira@hotmail.com'),
('29267307568', 'Pedro Americo Valadares', 'BA', 'speedlanches@yahoo.com.br'),
('29346762500', 'Jose Augusto Pinto de Carvalho', 'BA', 'acasurf@ig.com.br'),
('32813988553', 'Antonielle Valadares Freitas', 'BA', 'nella_@hotmail.com'),
('33073020578', 'Breno Leonardo Mendonca', 'SE', 'leonarzo@bol.com.br'),
('46047832504', 'Eladio Jose Praia Jr', 'BA', 'eladiopraia@hotmail.com'),
('48801372504', 'Alexandre Issami', 'BA', 'moniaehp@hotmail.com'),
('49234137515', 'Patricia Valadares', 'BA', 'paty_valadares@hotmail.com'),
('54386286853', 'Genauto Carvalho de Franca Filho', 'BA', 'genauto@ufba.ba'),
('55731856591', 'Carlos Henrique Garcia Cruz', 'SE', 'alcicruz@ibest.com.br'),
('74332511549', 'Wilian Cerqueira Araujo', 'BA', 'wilianaraujo@hotmail.com'),
('77666054572', 'Ricardo Alexandre de Jesus Santana', 'BA', 'ricardo@depeitoaberto.com.br'),
('77774973591', 'Bruno Pitanga', 'BA', 'brunopitanga@hotmail.com'),
('79485286520', 'Andre Luis Barros', 'BA', 'paradabahia@gmail.com'),
('80604129572', 'Claudio Duarte Britto', 'BA', 'duarte.britto@gmail.com'),
('81199333549', 'Joao Paulo Figueredo Ferreira', 'SE', ''),
('88629899549', 'Janjorge Luis Santos de Melo', 'BA', 'janjorge@axewind.com.br'),
('92040047549', 'Andrea Mendonca', 'BA', 'andrea.virologia@gmail.com'),
('92755356553', 'Marivane Figueredo dos Santos', 'BA', 'liberty@libertyturismo.com'),
('93063679534', 'Sinara Pazos Britto', 'BA', 'sinarapazos@hotmail.com'),
('98716018591', 'Mateus Tavares', 'BA', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ranking`
--

CREATE TABLE IF NOT EXISTS `ranking` (
  `id_participante` varchar(15) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `pontos` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ranking`
--

INSERT INTO `ranking` (`id_participante`, `id_categoria`, `pontos`) VALUES
('26819899572', 16, 730),
('48801372504', 6, 1000),
('27733084504', 6, 730),
('14824094534', 19, 730),
('80604129572', 19, 1000),
('54386286853', 19, 860),
('93063679534', 21, 1000),
('29346762500', 18, 730),
('2029590231', 1, 860),
('98716018591', 13, 860),
('29267307568', 16, 1000),
('81199333549', 13, 583),
('92040047549', 14, 860),
('22721266500', 10, 1000),
('46047832504', 6, 860),
('04696722503', 8, 0),
('32813988553', 9, 0),
('77774973591', 13, 1000),
('21169306500', 13, 555),
('21644920582', 16, 610),
('33073020578', 5, 730),
('55731856591', 7, 0),
('92755356553', 14, 1000),
('77774973591', 15, 1000),
('49234137515', 14, 730),
('79485286520', 18, 1000),
('1142493423', 1, 1000),
('03661445522', 13, 730),
('81199333549', 18, 860),
('21169306500', 16, 670),
('21169306500', 18, 610),
('2029590231', 3, 860),
('1142493423', 3, 1000),
('77666054572', 18, 670),
('27178099534', 16, 860),
('2361428', 5, 860),
('04305200775', 5, 1000),
('88629899549', 13, 670),
('02562612531', 8, 1000),
('74332511549', 6, 0),
('29267307568', 13, 610),
('29267307568', 15, 860);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
