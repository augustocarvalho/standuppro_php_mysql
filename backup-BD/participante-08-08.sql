-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Ago-2014 às 06:36
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
('00254527035', 'ROBERTO VICENTIN', 'SC', 'robertov.machado@hotmail.com'),
('00477694918', 'ADRIANO JOSE NOZEKOVSKI', 'SC', '3kferro_@sandroneves.com.br'),
('00807995746', 'ALOYSIO ALVES VASCONCELOS', 'ES', 'aloysiov@hotmail.com'),
('00984563504', 'ANDRE LEITE PINTO DE CARVALHO', 'SE', 'andrecarvalho86@gmail.com'),
('01062621905', 'MAICON ROBERTO DA ROSA', 'SC', 'maoconroberosa@hotmail.com'),
('01134975805', 'ARLINDO ANTONIO FLORENTINO', 'SP', 'arlindoa.florentino@globo.com'),
('01300764570', 'HELIO ROSA MONTALVAO NETO', 'SE', 'heliomontalvaopersonal@gmail.com'),
('01680117785', 'GABRIEL PARMERA', 'SC', 'gabrielptavares@hotmail.com'),
('01829735810', 'CLAUDIO CARNEIRO', 'RJ', 'picoalto50@gmail.com'),
('01855258579', 'THIAGO COUTO DE MATOS', 'BA', 'tmatos@mariposa.com.br'),
('01897617500', 'JOAO CARLOS GONZALLES', 'BA', 'paulamaciel.oliveira@gmail.com'),
('02470308720', 'CLAUDIO BOYNARD PINTO', 'ES', 'c.boynard@yahoo.com.br'),
('02536881830', 'GILBERTO ESTEVES MARTINS JR', 'SP', 'gibasurftrips@gmail.com'),
('02553398441', 'LUIZ BARROS', 'PB', 'luiznabazo.personal@gmail.com'),
('02562612531', 'Tatiana Alves Furtado', 'BA', 'thaty_jazz13@hotmail.com'),
('02694813461', 'JUNIOR MANTEIGA', 'PB', 'jrmanteiga@gmail.com'),
('03229634519', 'CRISTIANO JOSE MACEDO COSTA FILHO', 'SE', 'macedo.cristiano@hotmail.com'),
('03661445522', 'Luiz Marques Santana', 'SE', 'luizotasantana@hotmail.com'),
('03903210870', 'WASHINGTON HUGO DE MATOS', 'SP', 'nenomatosp@hotmail.com'),
('04305200775', 'Leonardo Maciel Machado ', 'BA', 'leo_mac@terra.com.br'),
('04415651909', 'ANDRE MAGU', 'SC', 'andregraziane@hotmail.com'),
('04696722503', 'Samanta de Santana Praia', 'BA', 'sapraia@hotmail.com'),
('047508015', 'CARLOS ALBERTO VAZ', 'RJ', 'carlospvaz@terra.com.br'),
('04806065528', 'CHEYENNE DANTAS FERNANDES', 'SE', 'cheyenne.dantas@gmail.com'),
('05195507732', 'MARCOS VIDIGAL', 'ES', 'vidigalmarcos@hotmail.com'),
('05521146776', 'LENA GUIMARAES RIBEIRO', 'RJ', 'lenagribeiro@hotmail.com'),
('07289527771', 'MARCIO MAGALHAES', 'RJ', 'marciomaga@hotmail.com'),
('07306459759', 'ROBERTO MASCARENHAS MARTINS FILHO', 'SC', 'mascarenhas.filho@gmail.com'),
('08340098896', 'LUIZ CLAUDIO HUKA', 'SP', 'huca@hucateam.com'),
('08393986702', 'RODRIGO ACHE ', 'SP', 'rodrigo.ache@itaubba.com'),
('08844928779', 'BERNARDO OTERO', 'RJ', 'bezinho.otero@gmail.com'),
('09057493837', 'ARIOVALDO DE OLIVEIRA', 'SP', 'jullyanarassan@hotmail.com'),
('09436840721', 'CLEDIO RANGEM GALDINO ', 'RJ', 'cledio.rangel@gmail.com'),
('09444615499', 'BRUNO MEDEIROS', 'PE', 'babubrunomedeiros@gmail.com'),
('11182681727', 'IAN VAZ', 'RJ', 'ianvaz@terra.com.br'),
('11182697720', 'CAIO VAZ', 'RJ', 'caiovaz@terra.com.br'),
('1142493423', 'Caue Braga Santos Interaminense', 'BA', 'maxinteraminense@hotmail.com'),
('1255375906', 'KAINOA TEIXEIRA', 'SC', 'escoladesurf@hotmail.com'),
('13039039709', 'CIRANO GOMES RIBEIRO', 'DF', 'ciranoribeiro@gmail.com'),
('13554033839', 'CLAUDIO CHAIM', 'SP', 'chaim@mk10.com.br'),
('14284264770', 'DAVI MARQUES SOBREIRA NUNES', 'ES', 'davizeranunes@gmail.com'),
('14824094534', 'Mauricio Abubakir', 'BA', 'qcabubakir@ig.com.br'),
('14906985823', 'MARIA LUIZA MONTELEONE', 'SP', 'lizalisa@hotmail.com'),
('14998437712', 'LUCAS MEDEIROS', 'ES', 'lucasmedeiros57@hotmail.com'),
('1521027366', 'MARIA LUIZA S RABELO', 'BA', 'mcrabelo@gmail.com.br'),
('15559316776', 'ARIANI GUIMARAES THEOPHILO', 'RJ', 'arianitheophilo@hotmail.com'),
('17585899572', 'EDNA MARIA DELMONDES CARVALHO', 'BA', 'edelmondes@gmail.com'),
('19691122553', 'JOSE AUGUSTO SAMPAIO FILHO', 'BA', 'ze1061@ig.com.br'),
('1985844150', 'RAFAEL ALVES DA SILVA RIBEIRO', 'RJ', 'rafael090@gmail.com'),
('2029590231', 'Guilherme Berenguer de Carvalho', 'BA', 'acasurf@ig.com.br'),
('21169306500', 'Tuka Carvalho', 'BA', 'tucapcarvalho@ig.com.br'),
('21223114520', 'MARINEY COSTA DE BRITTO', 'BA', 'marineycosta@hotmail.com'),
('21644920582', 'Antonio Saback', 'BA', 'antoniosaback@hotmail.com'),
('22548406814', 'ISADORA MORAES N. DA SILVA', 'SP', 'xabita.cabras@bol.com.br'),
('22721266500', 'Eline Mendonca Muniz', 'BA', 'eline.mendonca@hotmail.com'),
('23042253813', 'ALEX SALAZAR', 'SP', 'lecosalazar@hotmail.com'),
('2361428', 'Helton Santos da Silva', 'BA', ''),
('24753458881', 'PAULO DOS REIS', 'SP', 'bra3333@gmail.com'),
('2587253705', 'GABRIEL COELHO DA SILVA PEREIRA', 'SE', 'gabrielcoelhosurf@bol.com.br'),
('2587666112', 'LUCAS GOUVEIA MENEGAZZO', 'RJ', 'engenheirolgm@gmail.com'),
('25967984844', 'MARCELO LINS', 'SP', 'marceloolins@yahoo.com.br'),
('26818238890', 'MONICA J PASCO', 'SP', 'monica.pasco@bol.com.br'),
('26819899572', 'Jorge Mario Lino Villas Boas', 'BA', 'jorgemariolinovb@hotmail.com'),
('27178099534', 'Vicente Lima de Sa Barreto', 'BA', 'vicente@lognet.com.br'),
('27733084504', 'Sergio Luiz Calvacante de Oliveira', 'BA', 'sergiolcoliveira@hotmail.com'),
('27943090802', 'LEANDRO RODRIGUES AGUEDA', 'SP', 'priscilla.padula@hoymail.com'),
('29135716894', 'CARLOS MARTINS', 'SP', 'carlosmgs@terra.com.br'),
('29267307568', 'Pedro Americo Valadares', 'BA', 'speedlanches@yahoo.com.br'),
('29346762500', 'Jose Augusto Pinto de Carvalho', 'BA', 'acasurf@ig.com.br'),
('29512204568', 'JOSE OLAVO DE ALMEIDA MOURA SENNA', 'BA', 'osenna1@hotmail.com'),
('29801724803', 'GISELLE GUSMAO MOTA', 'SP', 'gissellemota@terra.com.br'),
('30526248900', 'IASMIM MORAES NOGUEIRA DA SILVA', 'SP', 'xabita.cabras@bol.com.br'),
('30526254890', 'ISTTEFANY MARLY MORAES N. DA SILVA', 'SP', 'xabita.cabras@bol.com.br'),
('32292444500', 'ISABELLY MORAES', 'SP', 'xabita.cabras@bol.com.br'),
('32813988553', 'Antonielle Valadares Freitas', 'BA', 'nella_@hotmail.com'),
('33073020578', 'Breno Leonardo Mendonca', 'SE', 'leonarzo@bol.com.br'),
('33568066882', 'CARLOS JOSE OLIVEIRA DE JESUS', 'SP', 'carlosbahiasurf@hotmail.com'),
('34467899871', 'PAULA MACEL LOPES DE OLIVEIRA', 'BA', 'paulamaciel.oliveira@gmail.com'),
('35981385553', 'JOSE ICO FILHO', 'BA', 'joseicofilho@yahoo.com.br'),
('36052205334', 'TIAGO LEITE FROES DA MOTTA', 'BA', 'plfm2010@hotmail.com.br'),
('36608374828', 'ALEX DURAND', 'SP', 'alex@moldabem.com.br'),
('37960131805', 'TIAGO HULLE CATANI BARRA', 'SP', 'tiagohcbarra@hotmail.com'),
('38607379534', 'SANDRA ROBATTO', 'BA', 'pedrorobatto@gmail.com'),
('39304584892', 'ALINE ADISAKA', 'SP', 'alineadisaka@hotmail.com'),
('42343209863', 'WELLINGTON REIS', 'SP', 'wellington_reis@hotmail.com'),
('42680735587', 'LINO BARBOSA', 'BA', 'cbarbosalino@hotmail.com'),
('42833518811', 'MIGUEL RASSAN OLIVEIRA', 'SP', 'jullyanarassan@hotmail.com'),
('43844124870', 'MATHEUS SALAZAR', 'SP', 'matheus_salazar@hotmail.com'),
('44316497863', 'ARIEL ALVES DE SOUZA', 'SP', 'ariel.alves28@hotmail.com'),
('44937905805', 'ARTHUR CARVALHO MAS SANTACREU', 'SP', 'art-santacreu@hotmail.com'),
('46047832504', 'Eladio Jose Praia Jr', 'BA', 'eladiopraia@hotmail.com'),
('46465987520', 'PEDRO ROBATTO', 'BA', 'pedrorobatto@gmail.com'),
('48029565844', 'GUILHERME BATISTA DE SOUZA', 'SP', 'bra3333@gmail.com'),
('48801372504', 'Alexandre Issami', 'BA', 'moniaehp@hotmail.com'),
('49234137515', 'Patricia Valadares', 'BA', 'paty_valadares@hotmail.com'),
('49688324515', 'MARIA DE FATIMA FREITAS SAMPAIO', 'BA', 'fatimasampaio@hotmail.com'),
('54386286853', 'Genauto Carvalho de Franca Filho', 'BA', 'genauto@ufba.ba'),
('55731856591', 'Carlos Henrique Garcia Cruz', 'SE', 'alcicruz@ibest.com.br'),
('572386427', 'JANNIKY MARIA BARBAS DE MELLO', 'BA', 'janjorge@axewind.com.br'),
('57720886534', 'JAIRO FLORES ', 'BA', 'jairoflores@terra.com.br'),
('59849592249', 'PABLO CASADO', 'AM', 'pablito_casado@yahoo.com.br'),
('63697416553', 'MANUELA GONZALES ARAUJO', 'BA', 'gonzales_manuela@hotmail.com'),
('63704315591', 'ANTONIO FERNANDO SOARES ROCHA', 'BA', 'antonio.fernandosr@gmail.com'),
('65007328553', 'MAIRA MENEZES DE AZEVEDO', 'BA', 'mairaazevedo@hotmail.com'),
('66914477000', 'JEFERSON CARDOSO COMARU', 'AL', 'jeferson.comaru@gmail.com'),
('67640699053', 'EDUARDO BRAZ CARRARD', 'RS', 'oab39344@gmail.com'),
('74332511549', 'Wilian Cerqueira Araujo', 'BA', 'wilianaraujo@hotmail.com'),
('77666054572', 'Ricardo Alexandre de Jesus Santana', 'BA', 'ricardo@depeitoaberto.com.br'),
('77774973591', 'Bruno Pitanga', 'BA', 'brunopitanga@hotmail.com'),
('7799055553', 'LUIZ JOSE PIMENTA', 'BA', 'pimenta@grupomc-ba.com.br'),
('79175244500', 'ALEX DALTRO MOREIRA', 'BA', 'adaltro@mariposa.com.br'),
('79485286520', 'Andre Luis Barros', 'BA', 'paradabahia@gmail.com'),
('80604129572', 'Claudio Duarte Britto', 'BA', 'duarte.britto@gmail.com'),
('80614035520', 'SAMUEL RIBEIRO JUNCAL', 'BA', 'samueljuncal@gmail.com'),
('81199333549', 'Joao Paulo Figueredo Ferreira', 'SE', ''),
('81203802153', 'PATRICIA MARTINS ', 'DF', 'am.patricia@gmail.com'),
('85774677168', 'GABRIELA DA COSTA SILVA', 'DF', '85774677168'),
('86276634590', 'PEDRO LEITE FROES DA MOTTA', 'BA', 'plfm2010@hotmail.com.br'),
('87145430525', 'GUSTAVO COSTA', 'BA', 'gustavo@refran.com.br'),
('88629899549', 'Janjorge Luis Santos de Melo', 'BA', 'janjorge@axewind.com.br'),
('90460480472', 'ANDRE ANTONIO ARAUJO DE MEDEIROS', 'BA', 'andre@andremedeiros.com.br'),
('92040047549', 'Andrea Mendonca', 'BA', 'andrea.virologia@gmail.com'),
('92262740020', 'DANIEL KOLLING', 'RS', 'kolling2012@gmail.com'),
('92755356553', 'Marivane Figueredo dos Santos', 'BA', 'liberty@libertyturismo.com'),
('93063679534', 'Sinara Pazos Britto', 'BA', 'sinarapazos@hotmail.com'),
('93851235568', 'LUCIANO DOREA ', 'BA', 'lucianodcarvalho@hotmail.com'),
('94873135591', 'TIAGO BATISTA DE SAOUZA', 'DF', 'tiagosouzza_@hotmail.com'),
('97464031504', 'CAROLA VIANNA HOISEL', 'BA', 'carolahoisel@hotmail.com'),
('98716018591', 'Mateus Tavares', 'BA', 'tavaresmateus@yahoo.com.br');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
