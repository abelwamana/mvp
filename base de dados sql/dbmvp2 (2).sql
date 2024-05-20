-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2023 a las 15:18:54
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbmvp2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agua`
--

CREATE TABLE `agua` (
  `Id` int(11) NOT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` enum('ADESPOV/C4','ADPP/C1','ADRA/C4','CODESPA/C2','COSPE/C1','CUAMM/C4','DW/C1','DW/C4','FEC/C2','FEC/C4','NCA/C1','NCA/C4','PIN/C4','TESE/C4','UIC','WVI/C1','WVI/C4') NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `infraEstrutura` enum('Furo','Barragem com Sistema de Bombeamento','Barragem Subterrânea','Cisterna Calçadão','Represa','Sistema de Captação e Bombeamento de Água','Chafariz','Poço Melhorado','Chimpaca') NOT NULL,
  `fonteHidraulica` enum('Furo/Poço','Barragem/Chimpaca/Represa','Água da Chuva','Rio Permanente','Chimpaca','Outro') NOT NULL,
  `fonteHidraulicaAlternativa` enum('Furo/Poço','Barragem/Chimpaca/Represa','Água da Chuva','Rio Permanente','Chimpaca','Outro') NOT NULL,
  `servicoAssociado` enum('Bebedouro','Bebedouro e Chafariz','Bebedouro e Lavandaria','Bebedouro, Chafariz e Lavandaria','Bebedouro, Chafariz, Lavandaria e Tanque Banheiro','Chafariz','Chafariz e Lavandaria','Lavandaria','Outro') NOT NULL,
  `novaConstrucao` enum('Nova Construção','Reabilitação','Instalação de um Sistema de Irrigação') NOT NULL,
  `fimAQueSeDestina` enum('Consumo Animal e Rega','Consumo Humano','Consumo Humano e Animal','Consumo Humano e Rega','Consumo Humano, Animal e Rega','Rega') NOT NULL,
  `capacidadeInfraestrutura` float DEFAULT NULL,
  `capacidadeUnidadeID` int(11) NOT NULL,
  `realizadoTesteQualidadeAgua` enum('Sim','Não','','') DEFAULT NULL,
  `entidadeResponsavelConstrucao` enum('Comunidade',' Empresa contratada','NCA-ADRA') NOT NULL,
  `anosGarantia` int(11) DEFAULT NULL,
  `sistemExtracaoAgua` enum('Bomba Solar','Bomba Manual (a volante)','N/A (não especificado)','Gravidade (Curso Natural de Água)','Motobomba','Electrobomba','Outro (Especifique na Descrição)') NOT NULL,
  `especificacoesTecnInfraExtru` text DEFAULT NULL,
  `temPlacaVisibilidade` enum('Sim','Não') DEFAULT NULL,
  `infraAssociadaCampo` enum('Sim','Não') DEFAULT NULL,
  `nomeCampoAssociadoGrupoID` int(11) DEFAULT NULL,
  `anexoFichaTecnInfraExtr` varchar(255) DEFAULT NULL,
  `estadoObra` enum('Finalizado/Operacional','Em Progresso','Em Preparação','Em fase de Finalização') DEFAULT NULL,
  `imagemInfra` varchar(255) NOT NULL,
  `dataConclusaoObra` date DEFAULT NULL,
  `pontoFoiEntregueObra` enum('Não foi entregue','Associação de Consumidores de Água (ACA) da Comuna','Brigada Municipal de Água e Saneamento (BMAS)','Empresa Provincial de Água e Saneamento (EPAS)') DEFAULT NULL,
  `anexoActaEntrega` varchar(255) DEFAULT NULL,
  `benHomem` int(11) DEFAULT NULL,
  `benMulher` int(11) DEFAULT NULL,
  `totalAFAbrangidos` int(11) DEFAULT NULL,
  `benCorresponTotalPopulacao` enum('Sim','Não','','') DEFAULT NULL,
  `totalSuino` int(11) DEFAULT NULL,
  `totalCaprino` int(11) DEFAULT NULL,
  `totalBovino` int(11) DEFAULT NULL,
  `totalHaIrrigados` float DEFAULT NULL,
  `grupoGestAgua` enum('Sim','Não') DEFAULT NULL,
  `orientacoesMetodologia` enum('MOGECA','Comissão de Gestão') NOT NULL,
  `comissaoRealizaReuniosFreq` enum('Mensal','Quinzenal') DEFAULT NULL,
  `grupoFazContribuicoes` enum('Sim','Não') DEFAULT NULL,
  `grupoTemPlanoManutencaoPrev` enum('Sim','Não') DEFAULT NULL,
  `grupoTemPlanoManutencaoUrgen` enum('Sim','Não','','') DEFAULT NULL,
  `comissaoHomem` int(11) DEFAULT NULL,
  `comissaoMulher` int(11) DEFAULT NULL,
  `grupoFazParteACA` enum('Sim','Não') DEFAULT NULL,
  `grupoEstaAssociadoBMAS` enum('Sim','Não') DEFAULT NULL,
  `existeAcompaMuniEneAgua` enum('Sim','Não') DEFAULT NULL,
  `nTecniAcompanham` int(11) DEFAULT NULL,
  `nTecniParticipamReunioes` enum('Sim','Não') DEFAULT NULL,
  `metodologiaAdoptada` enum('Food For Work','Cash For Work','Outro (Especifique)') NOT NULL,
  `criteriosUtilizadoParaSeleBenef` text DEFAULT NULL,
  `benHomemTransSocial` int(11) DEFAULT NULL,
  `benMulherTransSocial` int(11) DEFAULT NULL,
  `totalAFCorrespondenteTransSocial` int(11) DEFAULT NULL,
  `valorDiarioBene` float DEFAULT NULL,
  `valorDiarioBeneUnidadeID` int(11) DEFAULT NULL,
  `nDiasTrabalho` int(11) DEFAULT NULL,
  `totalEntregueTranBen` float DEFAULT NULL,
  `anexoTermoPagamento` varchar(255) DEFAULT NULL,
  `desafiosONG` varchar(255) DEFAULT NULL,
  `licoesAprendidadasONG` varchar(255) DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(255) DEFAULT NULL,
  `constantacoeFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoes` varchar(255) DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(255) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` varchar(100) NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agua`
--

INSERT INTO `agua` (`Id`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `latitude`, `longitude`, `infraEstrutura`, `fonteHidraulica`, `fonteHidraulicaAlternativa`, `servicoAssociado`, `novaConstrucao`, `fimAQueSeDestina`, `capacidadeInfraestrutura`, `capacidadeUnidadeID`, `realizadoTesteQualidadeAgua`, `entidadeResponsavelConstrucao`, `anosGarantia`, `sistemExtracaoAgua`, `especificacoesTecnInfraExtru`, `temPlacaVisibilidade`, `infraAssociadaCampo`, `nomeCampoAssociadoGrupoID`, `anexoFichaTecnInfraExtr`, `estadoObra`, `imagemInfra`, `dataConclusaoObra`, `pontoFoiEntregueObra`, `anexoActaEntrega`, `benHomem`, `benMulher`, `totalAFAbrangidos`, `benCorresponTotalPopulacao`, `totalSuino`, `totalCaprino`, `totalBovino`, `totalHaIrrigados`, `grupoGestAgua`, `orientacoesMetodologia`, `comissaoRealizaReuniosFreq`, `grupoFazContribuicoes`, `grupoTemPlanoManutencaoPrev`, `grupoTemPlanoManutencaoUrgen`, `comissaoHomem`, `comissaoMulher`, `grupoFazParteACA`, `grupoEstaAssociadoBMAS`, `existeAcompaMuniEneAgua`, `nTecniAcompanham`, `nTecniParticipamReunioes`, `metodologiaAdoptada`, `criteriosUtilizadoParaSeleBenef`, `benHomemTransSocial`, `benMulherTransSocial`, `totalAFCorrespondenteTransSocial`, `valorDiarioBene`, `valorDiarioBeneUnidadeID`, `nDiasTrabalho`, `totalEntregueTranBen`, `anexoTermoPagamento`, `desafiosONG`, `licoesAprendidadasONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constantacoeFeitasFresan`, `recomendacoes`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(1, '2021-10-01', '2023-04-01', 'rosario', '', 3, 13, 2, 5, '-16.37302', '14.25786', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', '', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, '', 'Finalizado/Operacional', '', '2020-07-25', 'Brigada Municipal de Água e Saneamento (BMAS)', '', 1042, 1563, 434, 'Sim', 0, 1091, 789, 0, 'Sim', '', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, NULL, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-25'),
(2, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 13, 2, 6, '-16.16922', '14.17808', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Construção da inf. hidráulica sistema solar (colocação da bomba e placas solares, instalado o suporte do resrevatório de água, montado a ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada, montagem da estrutura da vedação, portões e quadro para o controlo eléctrico e suporte de sombra).  ', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-08-18', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 723, 1085, 301, 'Sim', 0, 804, 541, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-25'),
(3, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 13, 2, 5, '-16.33958', '14.2078', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  na ligações das tubagens, Reabilitado o bebedouro,1 chafarizes com 1 torneira , 4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-08-10', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 914, 1371, 381, 'Sim', 0, 771, 589, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(4, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 13, 2, 8, '-16.34258', '14.22722', 'Furo', 'Furo/Poço', '', 'Chafariz e Lavandaria', '', 'Consumo Humano', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema Bomba Manual (Reposição da Bomba manual de Sistema Volanta com partes lubrificads, Contruido o Massiço, 1 Chafariz, 4 Lavandaria e  ligacoes montadas e Construida a vedação, Suporte de Sombra e portão)', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-08-21', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 358, 538, 149, 'Sim', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(5, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 13, 2, 9, '-16.19983', '14.20672', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema Bomba Manual (Reposição da Bomba manual de Sistema Volanta com partes lubrificads, Contruido o Massiço, 1 Chafariz, 4 Lavandaria e Bebedouro de 1 Lado com tubagem  ligacoes montadas e Construida a vedação, Suporte de Sombra e portão). ', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-09-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 962, 1, 401, 'Sim', 0, 848, 602, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(6, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 13, 2, 10, '-16.256', '14.29158', 'Furo', 'Furo/Poço', '', 'Chafariz e Lavandaria', '', 'Consumo Humano', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens para o ,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , e o tanque do Mercado,  Mudancas na estrutura da vedação no chafaris, portões e e no Local da a estrutura solar com quadro do controlo electrico e Suporte de Sombra.)', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-09-18', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 395, 592, 165, 'Sim', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(7, '2022-01-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 13, 2, 11, '-16.18583', '14.17277', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema Bomba Manual (Reposição da Bomba manual de Sistema Volanta com partes lubrificads, Contruido o Massiço, 1 Chafariz, 4 Lavandaria e Bebedouro de 1 Lado com tubagem  ligacoes montadas e Construida a vedação, Suporte de Sombra e portão). ', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-02-10', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 261, 391, 109, 'Sim', 0, 201, 611, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(8, '2022-01-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 13, 2, 12, '-16.20258', '14.15056', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-02-10', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 970, 1454, 404, 'Sim', 0, 254, 952, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(9, '2022-01-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 13, 2, 13, '-16.18598', '14.17276', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Em fase de Finalização', 'Anexo Enviado', '2022-02-26', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 218, 328, 91, 'Sim', 0, 174, 302, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(10, '2022-01-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 13, 2, 14, '-16.20523', '14.15201', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Em fase de Finalização', 'Anexo Enviado', '2022-02-27', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 196, 293, 82, 'Sim', 0, 150, 273, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(11, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 13, 2, 15, 'S16º21´11,76192´´', 'E14º44´48,30576´´', 'Cisterna Calçadão', 'Chimpaca', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', '', '', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '1900-01-11', 'Associação de Consumidores de Água (ACA) da Comuna', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', 'Não', 0, 0, '', '', '', 0, '', 'Cash For Work', ' selecção dos membros das comunidades, com o apoio dos líderes comunitários, celebração de um contratos de ', 10, 6, 0, 0, 0, 30, 877350, '', 'Envolvimento das autoridades tradicioanis ', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(12, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 13, 2, 16, 'S16º 22´9,46 416´´', 'E 14º 43´19,92 324´´', 'Cisterna Calçadão', '', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', '', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', '', '2023-12-30', 'Associação de Consumidores de Água (ACA) da Comuna', '', 19, 51, 70, 'Não', 0, 0, 0, 0, 'Sim', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', ' selecção dos membros das comunidades, com o apoio dos líderes comunitários, celebração de um contratos de ', 0, 0, 0, 0, 0, 0, 0, '', 'Envovimento das instituições locais(direção da energia e água ', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(13, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 13, 2, 17, '-16.37111', '14.66138', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Bebedouro, Chafariz, Lavandaria e Tanque Banheiro', 'Nova Construção', 'Consumo Humano e Animal', 2500, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', '1. Anexo Enviado', '2023-03-22', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 0, 0, '', '', 'Sim', 1, 'Sim', 'Outro (Especifique)', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', 'Foi realizado novo furo contíguo ao existente', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(14, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 5, 18, '-16.84011', '15.63808', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano, Animal e Rega', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-08-09', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 397, 482, 147, 'Sim', 0, 652, 383, 0.9, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(15, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 5, 19, '-17.05875', '15.69113', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colocação da Bomba e placas solares, Restruturação do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-08-28', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 238, 358, 99, 'Sim', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(16, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 5, 20, '-16.83911', '15.63891', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colocação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-08-25', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 389, 567, 159, 'Sim', 0, 634, 408, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(17, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 5, 21, '-16.97441', '15.585', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema Bomba Manual (Reposição da Bomba manual de Sistema Volanta com partes lubrificads, Contruido o Massiço, 1 Chafariz, 4 Lavandaria e Bebedouro de 1 Lado com tubagem  ligacoes montadas e Construida a vedação, Suporte de Sombra e portão). ', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-09-05', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 1148, 1724, 479, 'Sim', 0, 1689, 1311, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(18, '2022-01-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 5, 22, '-17.06603', '15.73801', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema Bomba Manual (Reposição da Bomba manual de Sistema Volanta com partes lubrificads, Contruido o Massiço, 1 Chafariz, 4 Lavandaria e Bebedouro de 1 Lado com tubagem  ligacoes montadas e Construida a vedação, Suporte de Sombra e portão). ', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-12-18', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 352, 433, 131, 'Sim', 0, 543, 355, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(19, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 14, 5, 23, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(20, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 24, '-15.59602', '14.09873', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 99, 143, 20, 'Não', 0, 20, 0, 0.15, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Vias de acesso secundarias em mau estado, e o exodo rural por parte dos jovens Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '1., 2., 3.', '1.2.3.', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(21, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 25, '-15.60994', '14.11781', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-10-08', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 20, 35, 4, 'Não', 0, 25, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'Vias de acesso secundarias em mau estado e o éxodo rural por parte dos jovens Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(22, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 26, '-15.76209', '14.05397', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Rega', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 40, 75, 10, 'Não', 0, 0, 0, 0.15, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Nada consta Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(23, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 27, '-15.7684', '14.05255', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 30, 55, 8, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Nada consta Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(24, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 28, '-15.77189', '14.0503', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 58, 107, 13, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Nada consta Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(25, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 29, '-15.80363', '14.0291', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 33, 62, 9, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Vias de acessos terciarias em mau estado, exodo rural por parte dos jovensEnvolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(26, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 30, '-15.79517', '14.02786', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 19, 36, 4, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'O fraco envolvimemto das famílias Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(27, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 31, '-15.79208', '14.04399', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 23, 42, 6, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Vias de acesso terciarias em mau estado Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(28, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 32, '-15.65479', '14.0494', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Rega', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 72, 170, 24, 'Não', 0, 0, 0, 0.25, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta do número de famílias que buscam água nestes cistemas Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(29, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 33, '-15.73367', '14.08426', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 56, 104, 15, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Vias de ecesso terciarias em mau estado e o pouco envolvimento das famílais aliado ao éxodo rural por parte dos jonves Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(30, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 34, '15.56805188', '14.03307440', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-10-08', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 65, 123, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 15, 19, 0, 0, 0, 20, 0, 'N/A', 'Vias de ecesso terciarias em mau estado e o pouco envolvimento das famílais aliado ao éxodo rural por parte dos jonves Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(31, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 35, '-15.69565', '13.95572', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 68, 127, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Vias de ecesso terciarias em mau estado e o pouco envolvimento das famílais aliado ao éxodo rural por parte dos jonves Envolver os membros do GAS nas diferentes formações para garantir a sustentabilidade dos sistemas construidos', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(32, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 36, '-15.6172', '14.04881', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Rega', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 16, 19, 3, 'Não', 0, 0, 0, 0.12, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta do número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(33, '2022-07-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 37, '-15.59602', '14.09873', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-10-08', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 99, 143, 20, 'Não', 0, 10, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'Êxodo  rural por parte dos Jovens e aumento de consumidores Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(34, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 38, '-15.60987', '14.11794', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-10-08', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 20, 35, 5, 'Não', 0, 19, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Êxodo  rural por parte dos Jovens e aumento de consumidores Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(35, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 39, '-15.65479', '14.0494', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas. Associado a um bebedouro', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 72, 170, 24, 'Não', 0, 20, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(36, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 40, '-15.745137', '14.061473', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 20, 37, 7, 'Não', 0, 11, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(37, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 41, '15.751155', '14.058553', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 20, 37, 7, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(38, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 42, '-15.73367', '14.08426', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-05-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 56, 104, 15, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 12, 20, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(39, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 43, '-15.567139', '14.033151', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-10-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 65, 123, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(40, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 44, '-15.574624', '14.02795', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-01-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 39, 27, 4, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(41, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 45, '-15.574624', '14.02795', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-01-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 39, 27, 3, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24');
INSERT INTO `agua` (`Id`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `latitude`, `longitude`, `infraEstrutura`, `fonteHidraulica`, `fonteHidraulicaAlternativa`, `servicoAssociado`, `novaConstrucao`, `fimAQueSeDestina`, `capacidadeInfraestrutura`, `capacidadeUnidadeID`, `realizadoTesteQualidadeAgua`, `entidadeResponsavelConstrucao`, `anosGarantia`, `sistemExtracaoAgua`, `especificacoesTecnInfraExtru`, `temPlacaVisibilidade`, `infraAssociadaCampo`, `nomeCampoAssociadoGrupoID`, `anexoFichaTecnInfraExtr`, `estadoObra`, `imagemInfra`, `dataConclusaoObra`, `pontoFoiEntregueObra`, `anexoActaEntrega`, `benHomem`, `benMulher`, `totalAFAbrangidos`, `benCorresponTotalPopulacao`, `totalSuino`, `totalCaprino`, `totalBovino`, `totalHaIrrigados`, `grupoGestAgua`, `orientacoesMetodologia`, `comissaoRealizaReuniosFreq`, `grupoFazContribuicoes`, `grupoTemPlanoManutencaoPrev`, `grupoTemPlanoManutencaoUrgen`, `comissaoHomem`, `comissaoMulher`, `grupoFazParteACA`, `grupoEstaAssociadoBMAS`, `existeAcompaMuniEneAgua`, `nTecniAcompanham`, `nTecniParticipamReunioes`, `metodologiaAdoptada`, `criteriosUtilizadoParaSeleBenef`, `benHomemTransSocial`, `benMulherTransSocial`, `totalAFCorrespondenteTransSocial`, `valorDiarioBene`, `valorDiarioBeneUnidadeID`, `nDiasTrabalho`, `totalEntregueTranBen`, `anexoTermoPagamento`, `desafiosONG`, `licoesAprendidadasONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constantacoeFeitasFresan`, `recomendacoes`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(42, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 46, '-15.613355', '14.073451', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-02-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 20, 39, 5, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(43, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 47, '-15.717625', '13.918033', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-02-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 10, 25, 4, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(44, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 48, '15.747734', '14.048844', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-05-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 21, 39, 6, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(45, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 49, '15.747734', '14.048844', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-04-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 21, 39, 7, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(46, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 50, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-04-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 10, 20, 3, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(47, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 51, '15.613355', '14.073451', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-04-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 10, 18, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(48, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 52, '15.613355', '14.073451', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-04-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 10, 18, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(49, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 53, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-09-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 17, 25, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(50, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 54, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-09-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 11, 3, 1, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 0, 0, 'Sim', 'Sim', '', 0, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', '', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(51, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 55, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2020-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 15, 30, 5, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(52, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 56, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 7, 12, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(53, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 57, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 3, 13, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(54, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 58, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 58, 20, 11, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(55, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 6, 59, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 26, 14, 6, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(56, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 60, '15145887', '1321473', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 0, 0, 0, 'Não', 0, 0, 0, 0, '', '', 'Mensal', 'Sim', 'Sim', 'Sim', 0, 0, 'Sim', 'Sim', '', 0, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(57, '2022-07-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 61, '15145887', '1321473', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 177, 75, 8, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 33, 27, 0, 0, 0, 20, 0, 'N/A', 'Êxodo  rural por parte dos Jovens e aumento de consumidores Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(58, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 62, '15152886', '13203625', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-09-28', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 0, 0, 0, 'Não', 0, 0, 0, 0, '', '', 'Mensal', 'Sim', 'Sim', 'Sim', 0, 0, 'Sim', 'Sim', '', 0, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(59, '2022-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 63, '15152886', '13203625', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-10-08', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 60, 142, 21, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'Êxodo  rural por parte dos Jovens e aumento de consumidores Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(60, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 64, '1517523', '13214768', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-04', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 0, 0, 0, 'Não', 0, 0, 0, 0, '', '', 'Mensal', 'Sim', 'Sim', 'Sim', 0, 0, 'Sim', 'Sim', '', 0, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(61, '2022-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 65, '1517523', '13214768', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 95, 175, 25, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 24, 30, 0, 0, 0, 20, 0, 'N/A', 'Êxodo  rural por parte dos Jovens e aumento de consumidores Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(62, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 66, '15145894', '1321526', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 33, 62, 9, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Êxodo  rural por parte dos Jovens e aumento de consumidores Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(63, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 67, '15.152925', '13.203597', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 60, 142, 20, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 31, 9, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(64, '2022-07-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 68, '15145894', '1321526', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 33, 62, 8, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 33, 22, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(65, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 69, '1517498', '13.214805', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 95, 175, 10, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(66, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 70, '15.143503', '13.191884', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-30', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 19, 36, 5, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(67, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 71, '15.143503', '13.191884', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-30', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 19, 36, 7, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(68, '2022-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 72, '15.142164', '13.213593', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-30', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 50, 59, 10, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(69, '2022-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 73, '15.142130', '13213615', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-30', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 0, 0, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(70, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 74, '15.142603', '13.21019', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-03-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 75, 63, 9, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 33, 20, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(71, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 10, 12, 75, '15.15187', '1323324', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-03-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 0, 0, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(72, '2021-10-01', '2022-10-01', 'Domingos Nangafina', 'WVI/C1', 2, 10, 12, 76, '-15.20603', '13.42001', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 120000, 0, '', '', 0, 'Bomba Solar', 'Feito perfuração de 1 Furo com 31 metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 125 PVC tradicional com o devido pré Selecione constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm) ', 'Sim', 'Sim', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-05-01', 'Não foi entregue', 'N/A', 517, 560, 0, 'Não', 0, 0, 0, 2, 'Sim', 'MOGECA', '', '', '', '', 3, 4, 'Não', 'Não', 'Sim', 1, '', 'Cash For Work', 'Discussão e planificação junto das comunidades beneficiadas pelas infraestruturas priorizando as pessoas mais vulneráveis especialmente as mulheres e jovens conhecidos e residentes na comunidade numa metodologia que garante flexibilidade e maior impacto das tarefas, individuos maiores de 18 anos com vontade de participar nos trabalhos comunitários. É feita uma remuneração diferenciada entre os mestres de obra e os membros da comunida (em média recebem 1000kz).', 9, 0, 0, 3000, 9, 0, 27000, 'Anexo por ser Enviado', 'Os desafios prendem-se com a participação das mulheres nos trabalhos de construção. Existe uma certa descriminação dos homens perante as mulheres de que estas não deveriam participar neste tipo de trabalho, e, esta acção faz com que as mulheres se apartam', 'Mobilização e sensibilização comunitária para o envolvimento das mulheres e homens em trabalhos comunitários.', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(73, '2021-10-01', '2022-10-01', 'Domingos Nangafina', 'WVI/C1', 2, 10, 12, 77, '-15.206', '13.30075', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano', 14400, 0, '', '', 0, 'Bomba Solar', 'Feito perfuração de 1 Furo com 62 metros  a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 125 PVC tradicional com o devido pré Selecione constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm). * Construido 1 Bica/Chafariz, montando 1 tanque de 5m³  e 1 Bomba submersa solar Grundfos SQ = 0.6 ', 'Sim', 'Não', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-09-30', 'Não foi entregue', 'N/A', 1607, 1741, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', 'Sim', '', '', 5, 2, 'Não', 'Não', 'Sim', 1, '', 'Cash For Work', 'Discussão e planificação junto das comunidades beneficiadas pelas infraestruturas priorizando as pessoas mais vulneráveis especialmente as mulheres e jovens conhecidos e residentes na comunidade numa metodologia que garante flexibilidade e maior impacto das tarefas, individuos maiores de 18 anos com vontade de participar nos trabalhos comunitários. É feita uma remuneração diferenciada entre os mestres de obra e os membros da comunida (em média recebem 1000kz).', 21, 5, 0, 14077, 9, 0, 366000, 'Anexo por ser Enviado', 'Os desafios prendem-se com a participação das mulheres nos trabalhos de construção. Existe uma certa descriminação dos homens perante as mulheres de que estas não deveriam participar neste tipo de trabalho, e, esta acção faz com que as mulheres se apartam', 'Mobilização e sensibilização comunitária para o envolvimento das mulheres e homens em trabalhos comunitários.', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(74, '2021-10-01', '2022-10-01', 'Domingos Nangafina', 'WVI/C1', 2, 10, 12, 78, '-15.24246', '13.38108', 'Represa', '', '', '', 'Nova Construção', 'Consumo Animal e Rega', 60000, 0, '', '', 0, 'Motobomba', 'Construido uma Represa de irrigação', 'Sim', 'Sim', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-08-25', 'Não foi entregue', 'N/A', 254, 276, 0, 'Não', 0, 0, 0, 2, 'Sim', 'Comissão de Gestão', '', '', '', '', 5, 2, 'Não', 'Não', 'Sim', 1, '', 'Cash For Work', 'Discussão e planificação junto das comunidades beneficiadas pelas infraestruturas priorizando as pessoas mais vulneráveis especialmente as mulheres e jovens conhecidos e residentes na comunidade numa metodologia que garante flexibilidade e maior impacto das tarefas, individuos maiores de 18 anos com vontade de participar nos trabalhos comunitários. É feita uma remuneração diferenciada entre os mestres de obra e os membros da comunida (em média recebem 1000kz).', 20, 9, 0, 24862, 9, 0, 721000, 'Anexo por ser Enviado', 'Os desafios prendem-se com a participação das mulheres nos trabalhos de construção. Existe uma certa descriminação dos homens perante as mulheres de que estas não deveriam participar neste tipo de trabalho, e, esta acção faz com que as mulheres se apartam', 'Mobilização e sensibilização comunitária para o envolvimento das mulheres e homens em trabalhos comunitários.', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(75, '2022-07-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 10, 12, 79, '15º12.248', '13º17.529', 'Represa', '', '', '', 'Nova Construção', 'Rega', 8000, 0, '', '', 0, 'Motobomba', 'Construido uma Represa de irrigação', 'Sim', 'Sim', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-20', 'Não foi entregue', 'N/A', 12, 24, 0, 'Não', 0, 0, 0, 0, 'Sim', 'Comissão de Gestão', '', '', '', '', 0, 0, 'Não', 'Não', 'Sim', 2, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(76, '2022-07-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 10, 12, 80, '-15.12248', '13.17529', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 8000, 0, '', '', 0, 'Bomba Solar', 'Reabilitação e limpeza do furo, construção do maciço, rede de vedação, instalação de bomba solar, instalação da estrutura e o tanque 6000 lt (metal), lavandaria com 4 tanques, 1 bica na lavandaria, instalação a 800 mt dentro da aldeia (2 torneiras) e 1 bebedouro.', 'Sim', 'Não', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '0000-00-00', 'Não foi entregue', 'N/A', 192, 477, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 3, 4, 'Não', 'Não', 'Sim', 2, '', 'Outro (Especifique)', 'Discussão e planificação junto das comunidades beneficiadas pelas infraestruturas priorizando as pessoas mais vulneráveis especialmente as mulheres e jovens conhecidos e residentes na comunidade numa metodologia que garante flexibilidade e maior impacto das tarefas, individuos maiores de 18 anos com vontade de participar nos trabalhos comunitários. É feita uma remuneração diferenciada entre os mestres de obra e os membros da comunida (em média recebem 1000kz).', 10, 20, 0, 0, 0, 0, 289000, 'Anexo por ser Enviado', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(77, '2022-07-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 10, 12, 81, '-15.15017', '13.23069', 'Furo', '', '', '', '', 'Consumo Humano', 8000, 0, '', '', 0, '', 'Substituição da bomba, patamar e vedação.', 'Sim', 'Não', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-04-29', 'Não foi entregue', 'N/A', 182, 199, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 4, 4, 'Não', 'Não', 'Sim', 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(78, '2023-04-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 10, 12, 82, '-15,24246', '13.38108', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Animal', 32000, 0, '', '', 0, 'Bomba Solar', 'Construçao de um novo tanque 32.000, perfuração de um novo furo de 52 m, mantagem de uma boba solar com placas 3 placas solares de 410 W, a cosntrução de um Bebedouro.', 'Sim', 'Sim', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-07-25', 'Não foi entregue', 'N/A', 254, 276, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 0, 0, 'Não', 'Não', 'Sim', 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(79, '2022-07-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 13, 83, '\"15°13\'6.29\"\"\"', '\"12° 7\'31.06\"\"\"', 'Chafariz', '', '', 'Lavandaria', 'Nova Construção', 'Consumo Humano', 10000, 3, 'Sim', '', 5, 'Outro (Especifique na Descrição)', 'Captação da rede Pública', 'Não', 'Não', 0, '', 'Em fase de Finalização', '', '2023-03-01', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 4, 1, 5, 1682, 9, 176, 1480000, '', 'Estrutura finalizada e falta apenas a ligação da água a conduta da rede pública por parte da EPAS', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24');
INSERT INTO `agua` (`Id`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `latitude`, `longitude`, `infraEstrutura`, `fonteHidraulica`, `fonteHidraulicaAlternativa`, `servicoAssociado`, `novaConstrucao`, `fimAQueSeDestina`, `capacidadeInfraestrutura`, `capacidadeUnidadeID`, `realizadoTesteQualidadeAgua`, `entidadeResponsavelConstrucao`, `anosGarantia`, `sistemExtracaoAgua`, `especificacoesTecnInfraExtru`, `temPlacaVisibilidade`, `infraAssociadaCampo`, `nomeCampoAssociadoGrupoID`, `anexoFichaTecnInfraExtr`, `estadoObra`, `imagemInfra`, `dataConclusaoObra`, `pontoFoiEntregueObra`, `anexoActaEntrega`, `benHomem`, `benMulher`, `totalAFAbrangidos`, `benCorresponTotalPopulacao`, `totalSuino`, `totalCaprino`, `totalBovino`, `totalHaIrrigados`, `grupoGestAgua`, `orientacoesMetodologia`, `comissaoRealizaReuniosFreq`, `grupoFazContribuicoes`, `grupoTemPlanoManutencaoPrev`, `grupoTemPlanoManutencaoUrgen`, `comissaoHomem`, `comissaoMulher`, `grupoFazParteACA`, `grupoEstaAssociadoBMAS`, `existeAcompaMuniEneAgua`, `nTecniAcompanham`, `nTecniParticipamReunioes`, `metodologiaAdoptada`, `criteriosUtilizadoParaSeleBenef`, `benHomemTransSocial`, `benMulherTransSocial`, `totalAFCorrespondenteTransSocial`, `valorDiarioBene`, `valorDiarioBeneUnidadeID`, `nDiasTrabalho`, `totalEntregueTranBen`, `anexoTermoPagamento`, `desafiosONG`, `licoesAprendidadasONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constantacoeFeitasFresan`, `recomendacoes`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(80, '2023-01-01', '2023-04-01', 'Pandequeni Martins/Eduardo Eliseu', 'ADESPOV/C4', 1, 3, 14, 84, 'S 15º46´33, 54204´´', 'E 12º 6´ 10, 47528', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Rega', 0, 0, '', '', 0, '', '', '', '', 0, '', 'Finalizado/Operacional', '', '0000-00-00', '', '', 14, 21, 0, '', 0, 0, 0, 1, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Cash For Work', 'Trabalho para abertura de furo artesanal', 7, 0, 0, 130000, 9, 0, 130000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(81, '2023-01-01', '2023-04-01', 'Sílvia Santos', 'FEC/C4', 1, 3, 14, 85, '-15.05077', '12.27817', 'Furo', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 18000, 3, 'Sim', ' Empresa contratada', 0, 'Electrobomba', 'Captação artesanal, em poço encamisado + eletrobomba com painel solar + reservatório de 18.000 litros+ charafiz + bomba solar a jusante do reservatório (se necessário) + sistema de irrigação/adução principal.', 'Não', 'Sim', 0, '', 'Em Progresso', '', '2023-09-01', '', '', 23, 12, 35, 'Não', 12, 80, 34, 0, 'Sim', '', '', '', '', '', 0, 0, 'Não', 'Não', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(82, '2023-04-01', '2023-04-01', 'Sílvia Santos', 'FEC/C4', 1, 3, 14, 85, '-15.04959', '12.28756', 'Furo', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 18000, 3, 'Sim', ' Empresa contratada', 0, 'Electrobomba', 'Captação artesanal, em poço encamisado + eletrobomba com painel solar + reservatório de 18.000 litros+ charafiz + bomba solar a jusante do reservatório (se necessário) + sistema de irrigação/adução principal.', 'Não', 'Sim', 0, '', 'Em Progresso', '', '2023-09-01', '', '', 23, 13, 36, 'Não', 5, 46, 104, 0, 'Sim', '', '', '', '', '', 0, 0, 'Não', 'Não', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(83, '2023-04-01', '2023-04-01', 'Sílvia Santos', 'FEC/C4', 1, 3, 14, 85, '-15.05004', '12.28886', 'Furo', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 18000, 3, 'Sim', ' Empresa contratada', 0, 'Electrobomba', 'Captação artesanal, em poço encamisado + eletrobomba com painel solar + reservatório de 18.000 litros+ charafiz + bomba solar a jusante do reservatório (se necessário) + sistema de irrigação/adução principal.', 'Não', 'Sim', 0, '', 'Em Progresso', '', '2023-09-01', '', '', 23, 2, 25, 'Não', 0, 122, 5, 0, 'Sim', '', '', '', '', '', 0, 0, 'Não', 'Não', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(84, '2023-04-01', '2023-04-01', 'Sílvia Santos', 'FEC/C4', 1, 3, 14, 85, '-15.05946', '12.29215', 'Furo', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 18000, 3, 'Sim', ' Empresa contratada', 0, 'Electrobomba', 'Captação artesanal, em poço encamisado + eletrobomba com painel solar + reservatório de 18.000 litros+ charafiz + bomba solar a jusante do reservatório (se necessário) + sistema de irrigação/adução principal.', 'Não', 'Sim', 0, '', 'Em Progresso', '', '2023-09-01', '', '', 26, 9, 35, 'Não', 8, 106, 56, 0, 'Sim', '', '', '', '', '', 0, 0, 'Não', 'Não', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(85, '2023-04-01', '2023-04-01', 'Sílvia Santos', 'FEC/C4', 1, 3, 14, 85, '-15.0606', '12.29181', 'Furo', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 18000, 3, 'Sim', ' Empresa contratada', 0, 'Electrobomba', 'Captação artesanal, em poço encamisado + eletrobomba com painel solar + reservatório de 18.000 litros+ charafiz + bomba solar a jusante do reservatório (se necessário) + sistema de irrigação/adução principal.', 'Não', 'Sim', 0, '', 'Em Progresso', '', '2023-09-01', '', '', 10, 13, 23, 'Não', 6, 75, 13, 0, 'Sim', '', '', '', '', '', 0, 0, 'Não', 'Não', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(86, '2022-07-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 86, '\"15°10\'32.88\"\"\"', '\"12°11\'30.03\"\"\"', 'Chafariz', 'Furo/Poço', '', '', '', 'Consumo Humano', 3000, 5, 'Sim', '', 5, 'Outro (Especifique na Descrição)', 'Pqueno sistema de água do bairro', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', '', '2022-09-01', 'Empresa Provincial de Água e Saneamento (EPAS)', '', 800, 1200, 2000, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 5, 0, 5, 1455, 9, 88, 640000, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(87, '2022-07-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 86, '\"15°10\'36.24\"\"\"', '\"12°11\'33.02\"\"\"', 'Chafariz', 'Furo/Poço', '', '', '', 'Consumo Humano', 0, 0, 'Não', '', 5, 'Outro (Especifique na Descrição)', 'Pequeno sistema de água do bairro', 'Sim', 'Não', 0, '', 'Em fase de Finalização', '', '2023-08-10', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 3, 0, 3, 1515, 9, 88, 400000, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(88, '2022-07-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 87, '15°09′03.66″', '12°10′07.92″', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Rega', 3, 3, 'Não', '', 4, 'Motobomba', 'Comunitária: Furo artesanal com suporte de um tanque reservatório de água', 'Não', 'Sim', 0, '', 'Finalizado/Operacional', '', '2023-07-30', '', '', 7, 13, 20, '', 0, 0, 0, 0, 'Sim', '', 'Quinzenal', 'Não', 'Não', 'Não', 0, 0, '', '', 'Não', 0, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 4, 0, 4, 8929, 9, 7, 250000, '', 'Furo finalizado e já está a ser utilizado para a rega do campo de demonstração. Vai ser instalado um tanque com uma capacidade de 3000 litros para o sistema de rega.', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(89, '2022-10-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 87, '15°09′03.66″', '12°10′07.92″', 'Furo', 'Furo/Poço', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 3, 3, 'Não', '', 4, 'Motobomba', 'Comunitária: Furo artesanal com suporte de um tanque reservatório de água', 'Não', 'Sim', 0, '', 'Em Progresso', '', '2023-07-30', '', '', 4, 13, 17, '', 0, 0, 0, 0, 'Sim', '', 'Quinzenal', 'Não', 'Não', 'Não', 0, 0, '', '', 'Não', 0, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 3, 0, 3, 1970, 9, 22, 130000, '', 'Instalação de um tanque reservatório de água com uma capacidade de 3000 litros para o sistema de rega do campo de demonstração.', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(90, '2022-10-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 86, '\"15°10\'11.33\"\"\"', '\"12°12\'11.84\"\"\"', 'Chafariz', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano', 0, 0, 'Não', '', 5, 'Outro (Especifique na Descrição)', 'Pequeno sistema de água do bairro', 'Sim', 'Não', 0, '', 'Em fase de Finalização', '', '2023-07-30', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 3, 1, 4, 1989, 9, 66, 525000, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(91, '2023-01-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 88, '15°07′16.31″', '12°08′51.19″', 'Chafariz', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano', 0, 0, 'Não', '', 5, 'Outro (Especifique na Descrição)', 'Captação da rede Pública', 'Não', 'Não', 0, '', 'Em Progresso', '', '2023-07-30', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 2, 1, 3, 1970, 9, 88, 520000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(92, '2023-01-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 86, '\"15°10\'36.24\"\"\"', '\"12°11\'33.02\"\"\"', 'Chafariz', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano', 0, 0, 'Não', '', 5, 'Outro (Especifique na Descrição)', 'Captação da rede Pública', 'Sim', 'Não', 0, '', 'Em fase de Finalização', '', '2023-07-30', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 3, 1, 4, 1989, 9, 22, 175000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(93, '2023-01-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 88, '15°07′16.31″', '12°08′51.19″', 'Chafariz', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano', 0, 0, 'Não', '', 5, 'Outro (Especifique na Descrição)', 'Captação da rede Pública', 'Não', 'Não', 0, '', 'Em fase de Finalização', '', '2023-07-30', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 3, 0, 3, 1970, 9, 44, 260000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(94, '2023-04-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 88, '15°07′16.31″', '12°08′51.19″', 'Chafariz', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano', 0, 0, 'Não', '', 5, 'Outro (Especifique na Descrição)', 'Captação da rede Pública', 'Não', 'Não', 0, '', 'Em fase de Finalização', '', '2023-07-30', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 3, 0, 3, 1970, 9, 44, 260000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(95, '2023-04-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 3, 14, 88, '15°07′16.31″', '12°08′51.19″', 'Chafariz', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano', 0, 0, 'Não', '', 5, 'Outro (Especifique na Descrição)', 'Captação da rede Pública', 'Não', 'Não', 0, '', 'Em fase de Finalização', '', '2023-07-30', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 3, 0, 3, 1970, 9, 44, 260000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(96, '2022-10-01', '2023-04-01', 'José Mário (Aniceto)', 'WVI/C4', 1, 3, 14, 305, '15°56,820', '12°85,687', 'Furo', 'Furo/Poço', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 6.6, 6, '', '', 0, 'Motobomba', 'Escavação manual de um poço (4m) seguida de perfuração artesanal do furo (14 metros de profundidade). Revestimento do furo com tubos dreno com 6 m profundidade e 12 m de tubo liso. Está em curso a Construção de um tanque em alvenaria em bloco de cimento em base em pedra com capacidade de 18000 litros para apoio a rega. ', 'Sim', 'Sim', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-03-01', 'Não foi entregue', '', 9, 23, 0, 'Não', 0, 0, 0, 0.6, 'Não', 'Comissão de Gestão', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', 'Helder (Fresan Namibe)', 'Parcelas de estudo', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(97, '2021-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 5, 21, 89, '-15.406832', ' 12.854363', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 5000, 5, 'Sim', '', 0, 'Bomba Solar', 'furo profundo', 'Sim', 'Sim', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-12-01', '', 'Anexo Enviado', 0, 0, 0, '', 0, 2000, 300, 0.8, 'Sim', 'Comissão de Gestão', '', '', '', '', 1, 1, '', '', 'Sim', 0, '', 'Food For Work', 'Entrega de comida pelo  trabalho  realizado (27-28-29-30-31/10/2022 + 1-2-3-4-5-7-8-9/11/2022)', 44, 33, 77, 2.5, 0, 0, 24.5, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(98, '2021-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 5, 21, 90, '-15.345234', ' 13.062908', 'Barragem com Sistema de Bombeamento', 'Barragem/Chimpaca/Represa', '', '', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, 'Bomba Manual (a volante)', 'BARRAGEM DE AREIA: paredes de alvenaria construídas sobre leitos de rios arenosos. A parede é composta por uma parte central (aproximadamente da dimensão da secção do leito) e duas asas laterais ancoradas nas rochas laterais das margens. O corpo de alvenaria é composto por 65% de pedras (disponíveis lugar das obras, na Comunidade) e 35% de cimento.', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-12-01', '', 'Anexo Enviado', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(99, '2021-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 5, 21, 90, '-15.233464', '13.040981', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 5000, 5, 'Sim', '', 0, 'Bomba Solar', 'furo profundo', 'Sim', 'Sim', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-12-01', '', 'Anexo Enviado', 0, 0, 0, '', 0, 5000, 1000, 0.8, 'Sim', 'Comissão de Gestão', '', '', '', '', 1, 1, '', '', 'Sim', 1, '', 'Food For Work', 'Entrega de comida pelo  trabalho  realizado  (12-14/10/2022)', 20, 24, 44, 1, 10, 0, 2, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(100, '2022-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 5, 22, 91, '15º43′38.27', '12º36′13.92', '', '', '', '', '', '', 0, 0, '', '', 0, '', '', '', '', 0, '', '', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Outro (Especifique)', 'Pagamento pela colocaçao de estrume nas microbacias 3-27/11/2022', 9, 2, 11, 4850, 9, 0, 56000, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(101, '2023-01-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 5, 22, 91, '15º43′38.27', '12º36′13.92', '', '', '', '', '', '', 0, 0, '', '', 0, '', '', '', '', 0, '', '', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Outro (Especifique)', 'Pagamento pela colocaçao de estrume nas microbacias 19-27/01/2023', 18, 4, 22, 3192, 9, 0, 59300, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(102, '2023-01-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 5, 22, 91, '15º43′38.27', '12º36′13.92', '', '', '', '', '', '', 0, 0, '', '', 0, '', '', '', '', 0, '', '', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Outro (Especifique)', 'Pagamento pela colocaçao de estrume nas microbacias 19/02 a 05/03/2023', 15, 7, 22, 3700, 9, 0, 45480, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(103, '2021-10-01', '2023-01-01', 'Sílvia Santos', 'FEC/C2', 1, 5, 22, 92, '-15.73101', '13.1656', 'Furo', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 240000, 4, '', '', 0, 'Motobomba', '1 Furo artesanal novo de 12 metros, com 1 reservatório de 5000L elevado e 1chafariz - Cavelocamue 1', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo Enviado', '2021-09-01', '', '', 369, 246, 0, '', 0, 0, 0, 2, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'Trabalho para abertura de furo artesanal', 5, 0, 0, 4000, 9, 0, 20000, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(104, '2021-10-01', '2023-04-01', 'Sílvia Santos', 'FEC/C2', 1, 5, 22, 93, '-15.74082', '13.18587', 'Furo', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 240000, 4, '', '', 0, 'Motobomba', '1 Furo artesanal novo de 12 metros, com 1 reservatório de 5000L elevado e 1chafariz  - Cavelocamue 2, associado à barragem subterrânea - Cavelocamue', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo Enviado', '2021-09-01', '', '', 279, 186, 0, '', 0, 0, 0, 1, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'Trabalho para abertura de cacimba', 4, 14, 0, 4000, 9, 0, 160000, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(105, '2021-10-01', '2023-01-01', 'Sílvia Santos', 'FEC/C2', 1, 5, 22, 94, '-15.83973', '13.07433', 'Furo', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 48000, 4, '', '', 0, 'Motobomba', '1 Furo artesanal novo de 10 metros, com 1 reservatório de 5000L elevado e 1chafariz - Kuiti Kuiti', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo Enviado', '2022-02-01', '', '', 441, 294, 0, '', 0, 0, 0, 2, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'Trabalho para abertura de furo artesanal', 6, 0, 0, 4000, 9, 0, 24000, '', 'Muito lodo no terreno - estamos a avaliar alterar a infraestrutura para uma Cacinba/poço', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(106, '2021-10-01', '2023-01-01', 'Sílvia Santos', 'FEC/C2', 1, 5, 22, 94, '-15.84157', '13.06592', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 360000, 4, '', '', 0, 'Bomba Solar', '1 Furo industrial de 100 metros em Kuiti Kuiti - nova perfuração e reabilitação das infraestruturas existentes', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo Enviado', '2022-01-01', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'Trabalho para abertura de vala proveniente de furo industrial', 2, 26, 0, 4000, 9, 0, 164000, '', 'Invasão por grupo externo à comunidade, com derrube da vedação e causa de danos.', 'Responsabilização do grupo de gestão da infraestrutura. (é uma situação recente)', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(107, '2021-10-01', '2023-01-01', 'Sílvia Santos', 'FEC/C2', 1, 5, 22, 95, '-15.74007', '13.18378', 'Barragem Subterrânea', 'Barragem/Chimpaca/Represa', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 0, 0, '', '', 0, '', 'Barragem subterrânea - Cavelocamue (entre o 1 e 2) É um sistema de retenção de água subterrânea', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo Enviado', '2021-12-01', '', '', 648, 432, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'Trabalho para abertura vala para barragem subterrânea', 12, 0, 0, 30000, 9, 0, 360000, '', 'Dificuldades na escavação pois o solo é muito arenoso, provocando desabamentos das paredes da escavação.', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(108, '2021-10-01', '2022-10-01', 'Domingos Nangafina', 'WVI/C1', 2, 12, 23, 96, '-13.90786', '13.67488', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 120000, 0, '', '', 0, 'Bomba Solar', 'Feito perfuração de 1 Furo com 62 metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 125 PVC tradicional com o devido pré Selecione constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm); construido um Chafariz com 2 bicas; construido um tanque de apoio a rega para a ECA SALVAÇÃO I com capacidade de 32 000 litros.', 'Sim', 'Sim', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-07-30', 'Não foi entregue', 'N/A', 986, 1069, 0, 'Não', 0, 0, 0, 1, 'Sim', 'MOGECA', '', '', '', '', 3, 4, 'Não', 'Não', 'Sim', 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(109, '2021-10-01', '2022-10-01', 'Domingos Nangafina', 'WVI/C1', 2, 12, 23, 97, '-13.92286', '13.76478', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 120000, 0, '', '', 0, 'Bomba Solar', '\"Feito perfuração de 1 Furo com 30, 70 metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 125 PVC tradicional com o devido pré Selecione constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm); construdo um bebedoura para gado, Construidos 2 chafarizas e uma lavandaria. Extensão de um tubo de 2\"\"para a ECA 1º de Maio.\"', 'Sim', 'Sim', 1, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-30', 'Não foi entregue', 'N/A', 634, 687, 0, 'Não', 0, 0, 0, 1, 'Sim', 'MOGECA', '', '', '', '', 4, 3, 'Não', 'Não', 'Sim', 1, '', 'Cash For Work', 'Discussão e planificação junto das comunidades beneficiadas pelas infraestruturas priorizando as pessoas mais vulneráveis especialmente as mulheres e jovens conhecidos e residentes na comunidade numa metodologia que garante flexibilidade e maior impacto das tarefas, individuos maiores de 18 anos com vontade de participar nos trabalhos comunitários. É feita uma remuneração diferenciada entre os mestres de obra e os membros da comunida (em média recebem 1000kz).', 28, 32, 0, 6767, 9, 0, 203000, 'Anexo por ser Enviado', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(110, '2022-07-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 12, 23, 96, '-13.54051', '13.40664', 'Furo', '', '', '', '', 'Consumo Humano', 2400, 0, '', '', 0, '', 'Substituição da bomba manual, Vedação da infraestrutura, substituição da tubangem e instalação de uma bomba manual nova de marca AFRIDEV.', 'Sim', 'Não', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-17', 'Não foi entregue', 'N/A', 521, 543, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 0, 0, 'Não', 'Não', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(111, '2023-04-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 12, 23, 98, '', '', 'Furo', '', '', '', 'Nova Construção', 'Rega', 16000, 0, '', '', 0, 'Motobomba', 'Abertuto de um furo em perfuração artesanal para irrigação da ECA e fornecimento de uma motobomba para a extração da água.', 'Sim', 'Sim', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-06-29', 'Não foi entregue', 'N/A', 17, 23, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 0, 0, 'Não', 'Não', 'Sim', 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(112, '2023-04-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 12, 23, 99, '', '', 'Furo', '', '', '', 'Reabilitação', 'Consumo Humano e Animal', 24000, 0, '', '', 0, 'Bomba Solar', '*Reabilitação do Feito perfuração de 1 Furo com 90 metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 125 PVC tradicional com o devido pré filtro constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm). * Construido 1 Bica/Chafariz, 1 Bebedouro e 1 Lavandaria.', 'Sim', 'Não', 0, 'Anexo por ser Enviado', 'Em fase de Finalização', 'Anexo por ser Enviado', '2023-06-30', 'Não foi entregue', 'N/A', 387, 670, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 3, 3, 'Não', 'Não', 'Sim', 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(113, '2022-10-01', '2022-10-01', 'Anivaldo Pena', 'ADRA/C4', 2, 10, 24, 100, '', '', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Bebedouro e Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 5000, 5, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Furo alimentdo por bomba solar, inclui um bebedouro e uma bica ', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', '', '1900-01-02', 'Associação de Consumidores de Água (ACA) da Comuna', 'Anexo por ser Enviado', 28, 35, 441, 'Sim', 0, 385, 144, 4, 'Sim', 'Comissão de Gestão', 'Mensal', 'Não', 'Sim', 'Não', 6, 6, 'Sim', 'Não', 'Sim', 1, 'Não', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(114, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 101, '-15.69462', '13.9118', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Rega', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas. Cisterna 1', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-04', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 0, 0, 0, 'Não', 0, 0, 0, 0, '', '', 'Mensal', 'Sim', 'Sim', 'Sim', 0, 0, 'Sim', 'Sim', '', 0, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(115, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 102, '-15.69462', '13.9118', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Rega', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas. Cisterna 1', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-19', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 27, 65, 9, 'Não', 0, 0, 0, 0.23, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta do número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(116, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 103, '-15.69376', '13.9249', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-10-08', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 49, 91, 13, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Vias de acesso secundarias degradas e o exodo rural por parte dos jovens Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(117, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 104, '-15.69534', '13.91552', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2020-12-20', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 73, 137, 15, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'vias de acesso secundarias degradas e o exodo rural por parte dos jovens e o aumento de consumidores no período de trasumancia Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(118, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 105, '-15.71881', '13.92053', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-04-04', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 76, 49, 6, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'Êxodo  rural por parte dos Jovens e aumento de consumidores Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Sempe que os tanques estiverem abastecidos os membros deveram estabelecer critérios de consumo de água que permita a que dure para mais de 3 meses criticos do ano ', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(119, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 106, '-15.67088', '13.91321', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-10-08', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 82, 153, 12, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 2, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(120, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 107, '-15.670833', '13.91323', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '1900-01-02', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 82, 153, 22, 'Não', 0, 17, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 20, 17, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(121, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 108, '-15.672137', '13.920417', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-20', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 37, 25, 4, 'Não', 0, 13, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 37, 25, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(122, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 109, '-15.672137', '13.920417', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-21', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 0, 0, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(123, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 110, '-15.672251', '13.920459', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-22', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 20, 26, 4, 'Não', 0, 11, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 10, 13, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(124, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 111, '-15.672251', '13.920459', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-23', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 0, 0, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', '0', 10, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(125, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 112, '-15.731817', '13.851842', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 15, 20, 3, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(126, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 113, '-15.7359', '13.934551', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 27, 39, 7, 'Não', 0, 11, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 5, 6, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(127, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 114, '-15.7359', '13.934551', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-02-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 27, 39, 6, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24');
INSERT INTO `agua` (`Id`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `latitude`, `longitude`, `infraEstrutura`, `fonteHidraulica`, `fonteHidraulicaAlternativa`, `servicoAssociado`, `novaConstrucao`, `fimAQueSeDestina`, `capacidadeInfraestrutura`, `capacidadeUnidadeID`, `realizadoTesteQualidadeAgua`, `entidadeResponsavelConstrucao`, `anosGarantia`, `sistemExtracaoAgua`, `especificacoesTecnInfraExtru`, `temPlacaVisibilidade`, `infraAssociadaCampo`, `nomeCampoAssociadoGrupoID`, `anexoFichaTecnInfraExtr`, `estadoObra`, `imagemInfra`, `dataConclusaoObra`, `pontoFoiEntregueObra`, `anexoActaEntrega`, `benHomem`, `benMulher`, `totalAFAbrangidos`, `benCorresponTotalPopulacao`, `totalSuino`, `totalCaprino`, `totalBovino`, `totalHaIrrigados`, `grupoGestAgua`, `orientacoesMetodologia`, `comissaoRealizaReuniosFreq`, `grupoFazContribuicoes`, `grupoTemPlanoManutencaoPrev`, `grupoTemPlanoManutencaoUrgen`, `comissaoHomem`, `comissaoMulher`, `grupoFazParteACA`, `grupoEstaAssociadoBMAS`, `existeAcompaMuniEneAgua`, `nTecniAcompanham`, `nTecniParticipamReunioes`, `metodologiaAdoptada`, `criteriosUtilizadoParaSeleBenef`, `benHomemTransSocial`, `benMulherTransSocial`, `totalAFCorrespondenteTransSocial`, `valorDiarioBene`, `valorDiarioBeneUnidadeID`, `nDiasTrabalho`, `totalEntregueTranBen`, `anexoTermoPagamento`, `desafiosONG`, `licoesAprendidadasONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constantacoeFeitasFresan`, `recomendacoes`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(128, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 115, '-15.7172208', '13.91047', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 27, 39, 8, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(129, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 116, '-15.7172208', '13.91047', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 27, 39, 6, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(130, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 117, '15.717311', '14.073451', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-02-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 15, 10, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(131, '2022-01-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 118, '-15.717497', '13.926805', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-02-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 19, 26, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 17, 26, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(132, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 119, '15.787381', '13.787381', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-05-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 40, 75, 9, 'Não', 0, 25, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(133, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 120, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-05-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 10, 14, 3, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(134, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 121, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-06-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 14, 10, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(135, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 122, '15.787381', '13.787381', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-06-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 40, 75, 10, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(136, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 123, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-06-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 15, 27, 3, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(137, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 124, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-06-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 6, 9, 1, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(138, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 125, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-06-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 6, 9, 1, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(139, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 126, '15.720881', '13.84381', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-06-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 94, 176, 25, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 12, 22, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(140, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 127, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-09-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 27, 31, 4, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(141, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 128, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-09-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 11, 8, 1, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(142, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 129, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-09-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 5, 11, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(143, '2021-10-01', '2022-10-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 130, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 10, 21, 3, 'Não', 0, 0, 0, 0, '', '', 'Mensal', 'Sim', 'Sim', 'Sim', 0, 0, 'Sim', 'Sim', '', 0, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', '', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(144, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 131, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 9, 11, 1, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(145, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 132, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 20, 40, 6, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(146, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 133, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 26, 28, 4, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(147, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 134, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 13, 28, 4, 'Não', 0, 0, 0, 0, '', '', 'Mensal', 'Sim', 'Sim', 'Sim', 0, 0, 'Sim', 'Sim', '', 0, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', '', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(148, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 135, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 6, 14, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(149, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 136, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-10-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 5, 12, 3, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(150, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 137, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-10-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 12, 25, 5, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(151, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 138, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-10-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 9, 10, 1, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 26, 17, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(152, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 139, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 11, 21, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(153, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 140, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 3, 17, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 9, 10, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(154, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 141, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-11-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 16, 28, 4, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(155, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 142, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 16, 5, 3, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(156, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 143, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 9, 26, 5, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(157, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 144, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Sim', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 5, 8, 2, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(158, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 145, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 11, 19, 4, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(159, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 146, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 12, 34, 6, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(160, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 147, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 15, 17, 5, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 0, 0, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(161, '2022-01-01', '2022-01-01', 'Anastácia Tchilete/Moisés Cacupa', 'NCA/C1', 2, 9, 27, 306, '', '', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 3, 'Sim', '', 0, 'Gravidade (Curso Natural de Água)', 'Construção de cisternas de captação e armazenamento de água com a capacidade de 52 mil litros, com um raio de 3,5 m e 1,75 m de altura, podendo ser abastecida em época de estiagem por camiões cisterna. Calçadão com uma dimensão de 200 m2 para a captação de água por meio das quedas pluviométricas.', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 12, 13, 3, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Food For Work', '0', 19, 36, 0, 0, 0, 20, 0, 'N/A', 'As quantidades de águas são insuficientes por conta no número de famílias que buscam água nestes cistemas Incetivar a comunidade a abrir mais buracos para aumentar o nº de cisternas e advocar junto do Gouverno para adotar a política ', 'Aconselhar as famílias a adotar o metodo de priorizar o consumo humano em deterimeto da rega', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(162, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 33, 148, '-15.4042', '15.75166', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-04-01', 'Não foi entregue', 'N/A', 11, 23, 34, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 4, 1, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(163, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 33, 149, '-15.61246', '15.44778', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 29, 43, 72, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 4, 1, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(164, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 33, 150, '-15.65479', '15.4188', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 15, 30, 45, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 4, 1, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(165, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 33, 151, '-15.70443', '15.38517', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 18, 27, 45, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(166, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 33, 152, '-15.49967', '15.50996', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-04-01', 'Não foi entregue', 'N/A', 18, 31, 49, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24');
INSERT INTO `agua` (`Id`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `latitude`, `longitude`, `infraEstrutura`, `fonteHidraulica`, `fonteHidraulicaAlternativa`, `servicoAssociado`, `novaConstrucao`, `fimAQueSeDestina`, `capacidadeInfraestrutura`, `capacidadeUnidadeID`, `realizadoTesteQualidadeAgua`, `entidadeResponsavelConstrucao`, `anosGarantia`, `sistemExtracaoAgua`, `especificacoesTecnInfraExtru`, `temPlacaVisibilidade`, `infraAssociadaCampo`, `nomeCampoAssociadoGrupoID`, `anexoFichaTecnInfraExtr`, `estadoObra`, `imagemInfra`, `dataConclusaoObra`, `pontoFoiEntregueObra`, `anexoActaEntrega`, `benHomem`, `benMulher`, `totalAFAbrangidos`, `benCorresponTotalPopulacao`, `totalSuino`, `totalCaprino`, `totalBovino`, `totalHaIrrigados`, `grupoGestAgua`, `orientacoesMetodologia`, `comissaoRealizaReuniosFreq`, `grupoFazContribuicoes`, `grupoTemPlanoManutencaoPrev`, `grupoTemPlanoManutencaoUrgen`, `comissaoHomem`, `comissaoMulher`, `grupoFazParteACA`, `grupoEstaAssociadoBMAS`, `existeAcompaMuniEneAgua`, `nTecniAcompanham`, `nTecniParticipamReunioes`, `metodologiaAdoptada`, `criteriosUtilizadoParaSeleBenef`, `benHomemTransSocial`, `benMulherTransSocial`, `totalAFCorrespondenteTransSocial`, `valorDiarioBene`, `valorDiarioBeneUnidadeID`, `nDiasTrabalho`, `totalEntregueTranBen`, `anexoTermoPagamento`, `desafiosONG`, `licoesAprendidadasONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constantacoeFeitasFresan`, `recomendacoes`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(167, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 33, 153, '-15.42793', '15.65072', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2020-12-01', 'Não foi entregue', 'N/A', 20, 25, 45, 'Não', 0, 0, 0, 1.2, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(168, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 34, 154, '-15.65626', '15.82977', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2020-12-01', 'Não foi entregue', 'N/A', 18, 23, 41, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(169, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 34, 155, '-15.64403', '15.86964', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 17, 25, 42, 'Não', 0, 0, 0, 1.2, '', '', 'Quinzenal', '', 'Sim', 'Sim', 1, 4, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(170, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 34, 156, '-15.65333', '15.81199', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-05-01', 'Não foi entregue', 'N/A', 12, 34, 46, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 4, 1, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(171, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 34, 157, '-15.65808', '15.83577', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 17, 25, 42, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 4, 1, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(172, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 34, 158, '-15.62911', '15.98766', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2020-12-01', 'Não foi entregue', 'N/A', 14, 30, 44, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(173, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 16, 34, 159, '-15.64477', '15.88435', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-05-01', 'Não foi entregue', 'N/A', 15, 33, 48, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(174, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 34, 160, '-15.60769', '15.81991', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-10-30', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 220, 329, 92, 'Sim', 0, 466, 281, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(175, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 34, 161, '-15.38376', '15.81992', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-10-15', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 253, 336, 98, 'Sim', 0, 548, 302, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(176, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 34, 162, '-15.40171', '15.81993', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema Bomba Manual (Reposição da Bomba manual de Sistema Volanta com partes lubrificads, Contruido o Massiço, 1 Chafariz, 4 Lavandaria e  ligacoes montadas e Construida a vedação, Suporte de Sombra e portão)tubagens, Construido bebedouro com 1 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-10-18', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 265, 385, 108, 'Sim', 0, 342, 289, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(177, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 34, 163, '-15.38377', '15.81994', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema Bomba Manual (Reposição da Bomba manual de Sistema Volanta com partes lubrificads, Contruido o Massiço, 1 Chafariz, 4 Lavandaria, Bebedouro e  ligacoes montadas e Construida a vedação, Suporte de Sombra e portão)', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-11-21', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 268, 310, 96, 'Sim', 0, 703, 531, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(178, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 34, 164, '-15.60773', '15.81995', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-11-21', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 223, 297, 87, 'Sim', 0, 536, 304, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(179, '2022-01-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 34, 165, '-15.665110', '15.794550', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-11-26', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 250, 291, 90, 'Sim', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(180, '2022-01-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 34, 166, '-15.649590', '15.809850', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-12-04', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 245, 345, 98, 'Sim', 0, 671, 355, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(181, '2022-01-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 34, 167, '-15.665800', '15.803770', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-12-10', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 248, 278, 88, 'Sim', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(182, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 16, 34, 168, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(183, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 16, 34, 307, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(184, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 16, 34, 169, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(185, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 35, 170, '-16.14202', '15.81996', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-10-04', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 552, 1228, 297, 'Sim', 0, 20000, 800, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(186, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 16, 35, 171, '-16.08045', '15.81997', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-09-11', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 240, 272, 85, 'Sim', 0, 456, 228, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(187, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 16, 35, 172, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(188, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 16, 35, 173, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(189, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 16, 35, 174, '-16.10903831', '15.75305891', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-09-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 287, 300, 100, 'Sim', 0, 250, 262, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(190, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 36, 175, '-16.81638', '15.23455', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-11-25', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 516, 775, 215, 'Sim', 0, 642, 304, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(191, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 36, 176, '-16.85008', '15.43105', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema Bomba Manual (Reposição da Bomba manual de Sistema Volanta com partes lubrificads, Contruido o Massiço, 1 Chafariz, 4 Lavandaria e Bebedouro de 1 Lado com tubagem  ligacoes montadas e Construida a vedação, Suporte de Sombra e portão). ', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-12-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 156, 234, 65, 'Sim', 0, 457, 344, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(192, '2022-01-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 36, 177, '-16.723223', '15.386967', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2021-12-21', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 1359, 1493, 475, 'Sim', 0, 893, 676, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(193, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 14, 36, 178, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(194, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 14, 36, 179, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(195, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 38, 180, '-16.40888', '16.59575', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-09-11', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 250, 261, 85, 'Sim', 0, 754, 457, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(196, '2021-10-01', '2023-04-01', 'Soares Nasso', 'DW/C1', 3, 14, 38, 181, '-16.40827', '16.59575', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação da inf. hidráulica sistema solar (Colacação da Bomba e placas solares, Restruração do suporte do Revartorio de água, reajuste  na ligações das tubagens, Construido bebedouro com 2 lados,1 chafarizes com 1 torneira ,4 lavandarias de com 1 torneira em cada , Mudancas na estrutura da vedação, portões e quarto do controlo electrico e Suporte de Sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2020-09-07', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo Enviado', 256, 300, 93, 'Sim', 0, 410, 443, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, 'Não', 'Sim', 'Sim', 3, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(197, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 14, 38, 182, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(198, '2021-10-01', '2022-10-01', 'Domingos Nangafina', 'WVI/C1', 2, 8, 39, 183, '-14.37188', '14.91608', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 108000, 0, '', '', 0, 'Bomba Solar', '* Feito perfuração de 1 Furo 36 metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 125 PVC tradicional com o devido pré Selecione constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm). * Construido 2 Bica/Chafariz, 1 Bebedouro e 1 Lavandaria.', 'Sim', 'Sim', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-01-31', 'Não foi entregue', 'N/A', 528, 572, 0, 'Não', 0, 0, 0, 3, 'Sim', 'MOGECA', '', '', '', '', 6, 1, 'Não', 'Não', 'Sim', 2, '', 'Cash For Work', 'Discussão e planificação junto das comunidades beneficiadas pelas infraestruturas priorizando as pessoas mais vulneráveis especialmente as mulheres e jovens conhecidos e residentes na comunidade numa metodologia que garante flexibilidade e maior impacto das tarefas, individuos maiores de 18 anos com vontade de participar nos trabalhos comunitários. É feita uma remuneração diferenciada entre os mestres de obra e os membros da comunida (em média recebem 1000kz).', 26, 8, 0, 16397, 9, 0, 557500, 'Anexo por ser Enviado', 'Os desafios prendem-se com a participação das mulheres nos trabalhos de construção. Existe uma certa descriminação dos homens perante as mulheres de que estas não deveriam participar neste tipo de trabalho, e, esta acção faz com que as mulheres se apartam', 'Mobilização e sensibilização comunitária para o envolvimento das mulheres e homens em trabalhos comunitários.', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(199, '2021-10-01', '2022-10-01', 'Domingos Nangafina', 'WVI/C1', 2, 8, 39, 184, '-14.83398', '14.9368', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 120000, 0, '', '', 0, 'Bomba Solar', 'Feito perfuração de 1 Furo 33 metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 125 PVC tradicional com o devido pré Selecione constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm) ', 'Sim', 'Sim', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-06-30', 'Não foi entregue', 'N/A', 1387, 1503, 0, 'Não', 0, 0, 0, 2, 'Sim', 'MOGECA', '', '', '', '', 5, 2, 'Não', 'Não', 'Sim', 2, '', 'Outro (Especifique)', '', 13, 12, 0, 0, 0, 0, 271000, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(200, '2022-07-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 8, 39, 185, '-14.30469', '14.53626', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 108000, 0, '', '', 0, 'Bomba Solar', '*Reabilitação do Feito perfuração de 1 Furo com 35 metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 125 PVC tradicional com o devido pré Selecione constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm). * Construido 2 Bica/Chafariz, 1 Bebedouro e 1 Lavandaria.', 'Sim', 'Não', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-06-15', 'Não foi entregue', 'N/A', 275, 265, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 3, 2, 'Não', 'Não', 'Sim', 2, '', 'Cash For Work', 'Discussão e planificação junto das comunidades beneficiadas pelas infraestruturas priorizando as pessoas mais vulneráveis especialmente as mulheres e jovens conhecidos e residentes na comunidade numa metodologia que garante flexibilidade e maior impacto das tarefas, individuos maiores de 18 anos com vontade de participar nos trabalhos comunitários. É feita uma remuneração diferenciada entre os mestres de obra e os membros da comunida (em média recebem 1000kz).', 5, 10, 0, 13667, 9, 0, 205000, 'Anexo por ser Enviado', 'Os desafios prendem-se com a participação das mulheres nos trabalhos de construção. Existe uma certa descriminação dos homens perante as mulheres de que estas não deveriam participar neste tipo de trabalho, e, esta acção faz com que as mulheres se apartam', 'Mobilização e sensibilização comunitária para o envolvimento das mulheres e homens em trabalhos comunitários.', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(201, '2023-04-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 8, 39, 186, '-14.14575', '14,53626, ', 'Furo', '', '', '', 'Reabilitação', 'Consumo Humano e Animal', 0, 0, '', '', 0, 'Bomba Solar', 'Reabilitaçã de 1 Furo 80metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 160 PVC tradicional com o devido pré filtro constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm).* Construido 3 Bica/Chafariz, 1 Bebedouro e 1 Lavandaria e a pintura completa', 'Sim', 'Não', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '0000-00-00', 'Não foi entregue', 'N/A', 0, 0, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 5, 2, 'Não', 'Não', 'Sim', 2, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(202, '2023-04-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 8, 39, 187, '-14192076', '14.90599', 'Furo', '', '', '', 'Reabilitação', 'Consumo Humano', 8000, 0, '', '', 0, 'Bomba Manual (a volante)', 'Substituição da bomba manual volanta por Uma Bomba Manual AFRIDEV nova, construção do novo patamar e vedação.', 'Sim', 'Não', 0, 'Anexo por ser Enviado', 'Em fase de Finalização', 'Anexo por ser Enviado', '2023-05-11', 'Não foi entregue', 'N/A', 485, 474, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 2, 1, 'Não', 'Não', 'Sim', 2, '', 'Outro (Especifique)', '', 4, 4, 0, 0, 0, 0, 28000, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(203, '2023-04-01', '2022-10-01', 'José Mário (Aniceto)', 'WVI/C1', 2, 8, 39, 188, '-14.32742', '14,52.181, ', 'Furo', '', '', '', 'Reabilitação', 'Consumo Humano e Animal', 12000, 0, '', '', 0, 'Bomba Solar', 'Reabilitaçã de 1 Furo 61 metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 160 PVC tradicional com o devido pré filtro constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm).* Construido 2 Bica/Chafariz, 1 Bebedouro e 1 Lavandaria e a pintura completa e mantagem de um tanque plastico 5.000 litros.', 'Sim', 'Não', 0, 'Anexo por ser Enviado', 'Em Progresso', 'Anexo por ser Enviado', '0000-00-00', 'Não foi entregue', 'N/A', 384, 588, 0, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 3, 4, 'Não', 'Não', 'Sim', 2, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(204, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 43, 189, '-17.34862', '14.47815', 'Furo', 'Furo/Poço', '', 'Bebedouro e Chafariz', '', 'Consumo Humano e Animal', 10000, 5, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-01-01', '', '', 155, 195, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 2, 0, 0, 50000, 9, 0, 100000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(205, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 43, 190, '-17.36782', '14.47367', 'Furo', 'Furo/Poço', '', 'Bebedouro e Chafariz', '', 'Consumo Humano e Animal', 10000, 5, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-01-01', '', '', 170, 230, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 2, 0, 0, 50000, 9, 0, 100000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(206, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 43, 191, '-17.12033', '14.40480', 'Poço Melhorado', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Sim', 'Sim', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 731, 893, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 5, 0, 0, 148000, 9, 0, 740000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(207, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 43, 192, '-17.02351', '14.44409', 'Poço Melhorado', 'Furo/Poço', '', 'Bebedouro e Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Em Progresso', 'Anexo por ser Enviado', '0000-00-00', '', '', 411, 627, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 7, 0, 0, 148000, 9, 0, 1036000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(208, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 43, 193, '-16.52419', '14.48184', 'Poço Melhorado', 'Furo/Poço', '', 'Bebedouro e Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Em Progresso', 'Anexo por ser Enviado', '0000-00-00', '', '', 432, 565, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 8, 2, 0, 148000, 9, 0, 1480000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(209, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 43, 194, '-16.57288', '14.45588', 'Poço Melhorado', 'Furo/Poço', '', 'Bebedouro e Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 6000, 5, '', '', 0, '', '', 'Sim', 'Sim', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-02-01', '', '', 913, 1001, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 10, 7, 0, 148000, 9, 0, 2516000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(210, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 43, 195, '-17.30321', '14.5463', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2020-12-01', 'Não foi entregue', 'N/A', 19, 26, 45, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(211, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 43, 195, '-17.30185', '14.53933', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 15, 21, 36, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(212, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 43, 196, '-17.33497', '14.55849', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 19, 26, 45, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(213, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 43, 197, '-17.35783', '14.5632', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 16, 26, 42, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 4, 1, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(214, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 43, 198, '-17.31538', '14.55231', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-03-01', 'Não foi entregue', 'N/A', 14, 36, 50, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(215, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 43, 199, '-17.3581', '14.56326', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 14, 36, 50, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(216, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 43, 200, 'S17º 0´48,07584´´', 'E 14º 59´54,70692´´', 'Cisterna Calçadão', 'Água da Chuva', 'Água da Chuva', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, 'Gravidade (Curso Natural de Água)', '', 'Sim', 'Não', 0, '', 'Em Preparação', '', '2023-07-01', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', '', '', 0, 0, 0, 0, 0, 30, 0, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(217, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 44, 201, '-16.75704', '15.01077', 'Chafariz', 'Rio Permanente', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 3000, 4, '', '', 0, '', '', '', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-08-01', '', '', 616, 713, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 9, 1, 0, 80000, 9, 0, 800000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(218, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 44, 202, '-16.75341', '15.05523', 'Chafariz', 'Rio Permanente', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 3000, 4, '', '', 0, '', '', '', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-08-01', '', '', 811, 875, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 9, 0, 0, 80000, 9, 0, 720000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(219, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 44, 203, '-16.73804', '15.14232', 'Chafariz', 'Rio Permanente', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 3000, 4, '', '', 0, '', '', '', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-08-01', '', '', 913, 1001, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 8, 1, 0, 80000, 9, 0, 720000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(220, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 44, 204, '-16.47952', '15.20755', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 20, 41, 61, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(221, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 44, 204, '-16.46474', '15.23397', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 8, 48, 56, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 1, 4, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(222, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 44, 205, '-16.49614', '15.16641', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2020-12-01', 'Não foi entregue', 'N/A', 18, 38, 56, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(223, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 44, 206, '-16.66077', '15.01023', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 8, 33, 41, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24');
INSERT INTO `agua` (`Id`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `latitude`, `longitude`, `infraEstrutura`, `fonteHidraulica`, `fonteHidraulicaAlternativa`, `servicoAssociado`, `novaConstrucao`, `fimAQueSeDestina`, `capacidadeInfraestrutura`, `capacidadeUnidadeID`, `realizadoTesteQualidadeAgua`, `entidadeResponsavelConstrucao`, `anosGarantia`, `sistemExtracaoAgua`, `especificacoesTecnInfraExtru`, `temPlacaVisibilidade`, `infraAssociadaCampo`, `nomeCampoAssociadoGrupoID`, `anexoFichaTecnInfraExtr`, `estadoObra`, `imagemInfra`, `dataConclusaoObra`, `pontoFoiEntregueObra`, `anexoActaEntrega`, `benHomem`, `benMulher`, `totalAFAbrangidos`, `benCorresponTotalPopulacao`, `totalSuino`, `totalCaprino`, `totalBovino`, `totalHaIrrigados`, `grupoGestAgua`, `orientacoesMetodologia`, `comissaoRealizaReuniosFreq`, `grupoFazContribuicoes`, `grupoTemPlanoManutencaoPrev`, `grupoTemPlanoManutencaoUrgen`, `comissaoHomem`, `comissaoMulher`, `grupoFazParteACA`, `grupoEstaAssociadoBMAS`, `existeAcompaMuniEneAgua`, `nTecniAcompanham`, `nTecniParticipamReunioes`, `metodologiaAdoptada`, `criteriosUtilizadoParaSeleBenef`, `benHomemTransSocial`, `benMulherTransSocial`, `totalAFCorrespondenteTransSocial`, `valorDiarioBene`, `valorDiarioBeneUnidadeID`, `nDiasTrabalho`, `totalEntregueTranBen`, `anexoTermoPagamento`, `desafiosONG`, `licoesAprendidadasONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constantacoeFeitasFresan`, `recomendacoes`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(224, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 44, 207, '-16.80827', '14.91573', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-06-01', 'Não foi entregue', 'N/A', 11, 53, 64, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(225, '2023-04-01', '2023-04-01', 'Marianna Costanzo', 'CUAMM/C4', 3, 18, 45, 208, '-16.424642°', '15.102675°', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 3, 'Não', ' Empresa contratada', 0, 'Bomba Solar', 'Profundidade 102m; nivel estatico 48; nivel dinamico 39; cheiro inodor; cor incolor; caudal 1200 l/h', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2023-02-01', '', '', 0, 0, 350, '', 0, 12350, 6572, 0, 'Sim', '', '', '', '', '', 2, 3, '', '', 'Sim', 1, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Monitoria costante das obras. Empresa não autonoma. ', 'Supervisao costante. Prazos mais longos para permitir correcções em processo', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(226, '2023-04-01', '2023-04-01', 'Marianna Costanzo', 'CUAMM/C4', 3, 18, 45, 209, '-16,721883°', '14,971786°', 'Sistema de Captação e Bombeamento de Água', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 16000, 3, 'Não', ' Empresa contratada', 0, 'Outro (Especifique na Descrição)', '2 reservatorios de 3000l cada mais um tanque interrado reabilitado de 10000l', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2023-05-01', 'Não foi entregue', '', 0, 0, 75, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(227, '2023-04-01', '2023-04-01', 'Marianna Costanzo', 'CUAMM/C4', 3, 18, 45, 210, '-16.387051°', '14.791438°', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 10000, 3, 'Não', ' Empresa contratada', 0, 'Bomba Solar', 'Profundidade furo 120m; nivel estatico 117m; nivel dinamico 68m; diametro da captaçao 125mm; caudal 2500 l/h; cheiro inodor; cor incolor.', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2023-05-01', 'Não foi entregue', '', 0, 0, 0, '', 0, 4685, 2578, 0, 'Sim', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(228, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 45, 211, '-16.2922801', '15.1064591', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 1000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-05-20', 'Não foi entregue', 'Anexo por ser Enviado', 289, 312, 105, 'Sim', 0, 0, 0, 0, 'Não', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(229, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 45, 212, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(230, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 45, 213, '-16.5507876', '14.8606833', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 1000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-06-06', 'Não foi entregue', 'Anexo por ser Enviado', 219, 240, 80, 'Sim', 0, 230, 209, 0, 'Não', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(231, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 45, 214, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(232, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 45, 215, '-16.3709611', '14.9004077', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 10000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-06-20', 'Não foi entregue', 'Anexo por ser Enviado', 246, 273, 88, '', 0, 239, 217, 0, 'Não', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(233, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 45, 216, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(234, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 18, 45, 217, '-16.32644', '14.78741', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Bebedouro, Chafariz e Lavandaria', 'Nova Construção', 'Consumo Humano e Animal', 2500, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', 'Sim', 'Não', 0, '', 'Em fase de Finalização', '1. Anexo Enviado', '2023-03-06', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 1, 0, 'Sim', '', 'Sim', 1, 'Sim', 'Outro (Especifique)', 'Identificação de 18 homens a nível das comunidades para a escavação de furos', 9, 0, 0, 22500, 9, 0, 202500, '', 'Debilidade na qualidade de alguns  materiais e opções de construçãoRealizado novo projeto de arquitectura. Notificação para correção de trabalhos.', '26.03.2022', '0000-00-00', 'Obra na sua fase final. Falta efectuar a vedação da infraestrutura hidráulica.', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(235, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 18, 45, 218, '-16.32611', '14.84638', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Bebedouro, Chafariz, Lavandaria e Tanque Banheiro', 'Nova Construção', 'Consumo Humano e Animal', 2500, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', 'Sim', 'Não', 0, '', 'Em fase de Finalização', '1. Anexo Enviado', '2023-03-06', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', '', '', '', '', 1, 0, 'Sim', '', 'Sim', 1, 'Sim', 'Outro (Especifique)', 'Identificação de 18 homens a nível das comunidades para a escavação de furos', 9, 0, 0, 22500, 9, 0, 202500, '', 'Debilidade na qualidade de alguns  materiais e opções de construçãoRealizado novo projeto de arquitectura. Notificação para correção de trabalhos.', '26.03.2023', '0000-00-00', 'Obra na sua fase final. Falta efectuar a vedação da infraestrutura hidráulica.', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(236, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 18, 45, 219, '-16.20905', '14.97322', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Bebedouro, Chafariz e Lavandaria', 'Nova Construção', 'Consumo Humano e Animal', 0, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', '', 'Não', 0, '', 'Em Progresso', '2. Anexo por ser Enviado', '0000-00-00', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, 'Sim', 'Outro (Especifique)', '', 0, 0, 0, 0, 0, 0, 0, '', 'Detectadas anomalias na qualidade dos materiais e construção realizada pela empresa Contratação de empresa para realização de novo projeto de arquitectura Notificação da empresa para a correção dos erros.', '30.04.2022', '0000-00-00', 'Empresa prevê reiniciar trabalhos no dia 16 de junho', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(237, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 18, 45, 220, '-16.09645', '14.82862', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Bebedouro, Chafariz, Lavandaria e Tanque Banheiro', 'Nova Construção', 'Consumo Humano e Animal', 0, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', '', 'Não', 0, '', 'Em Progresso', '2. Anexo por ser Enviado', '0000-00-00', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, 'Sim', 'Outro (Especifique)', '', 0, 0, 0, 0, 0, 0, 0, '', 'Detectadas anomalias na qualidade dos materiais e construção realizada pela empresa Contratação de empresa para realização de novo projeto de arquitectura Notificação da empresa para a correção dos erros.', '30.04.2023', '0000-00-00', 'Empresa prevê reiniciar trabalhos no dia 16 de junho', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(238, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 221, '-16.65742', '13.42054', 'Represa', 'Água da Chuva', '', 'Bebedouro e Lavandaria', '', 'Consumo Humano, Animal e Rega', 0, 0, '', '', 0, '', 'Agosto de 2021', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo Enviado', '2021-08-01', 'Brigada Municipal de Água e Saneamento (BMAS)', '', 628, 658, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 16, 0, 0, 80000, 9, 0, 1280000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(239, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 222, '-16.65684', '13.42609', 'Represa', 'Água da Chuva', '', 'Bebedouro e Lavandaria', '', 'Consumo Humano, Animal e Rega', 0, 0, '', '', 0, '', 'Janeiro de 2021', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo Enviado', '2021-08-01', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 16, 0, 0, 80000, 9, 0, 1280000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(240, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 223, '-16.65715', '13.42362', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Chafariz', '', 'Consumo Humano', 5000, 5, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo Enviado', '2021-08-01', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 2, 0, 0, 50000, 9, 0, 100000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(241, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 222, '-16.65511', '13.42408', 'Furo', 'Furo/Poço', '', 'Chafariz', '', 'Consumo Humano', 24000, 4, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo Enviado', '2021-07-01', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 2, 0, 0, 50000, 9, 0, 100000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(242, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 224, '-16.65575', '13.42306', 'Furo', 'Furo/Poço', '', 'Bebedouro e Chafariz', '', 'Consumo Humano', 120000, 4, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo Enviado', '2022-01-01', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 2, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(243, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 225, '-16.66293', '13.43156', 'Represa', 'Água da Chuva', '', 'Chafariz', '', 'Consumo Humano, Animal e Rega', 0, 0, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo Enviado', '2021-08-01', '', '', 204, 178, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 16, 0, 0, 80000, 9, 0, 1280000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(244, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 226, '-16.51752', '13.40392', 'Furo', 'Furo/Poço', '', 'Bebedouro e Chafariz', '', 'Consumo Humano e Animal', 3000, 4, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2021-08-01', '', '', 177, 191, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 6, 0, 0, 60000, 9, 0, 360000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(245, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 227, '-16.74576', '13.49394', 'Furo', 'Furo/Poço', '', 'Bebedouro e Chafariz', '', 'Consumo Humano, Animal e Rega', 20000, 4, '', '', 0, '', '', 'Sim', 'Sim', 0, 'N/A', 'Finalizado/Operacional', 'Anexo Enviado', '2021-08-01', '', '', 272, 292, 0, '', 0, 0, 0, 0.3, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 8, 0, 0, 80000, 9, 0, 640000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(246, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 228, '-16.78277', '13.4803', 'Furo', 'Furo/Poço', '', 'Bebedouro e Chafariz', '', 'Consumo Humano e Animal', 2000, 4, '', '', 0, '', '', 'Sim', '', 0, 'N/A', 'Finalizado/Operacional', 'Anexo Enviado', '2021-08-01', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 0, 0, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 8, 0, 0, 80000, 9, 0, 640000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(247, '2021-10-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 229, '-16.621509°', '13.360768°', 'Furo', 'Furo/Poço', '', 'Bebedouro e Chafariz', '', 'Consumo Humano, Animal e Rega', 10000, 5, '', '', 0, '', '', 'Sim', 'Sim', 0, 'N/A', 'Finalizado/Operacional', 'Anexo Enviado', '2022-01-01', '', '', 312, 334, 0, '', 0, 0, 0, 0.6, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 8, 0, 0, 80000, 9, 0, 640000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(248, '2022-01-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 230, '-16.40965', '13.31085', 'Poço Melhorado', 'Furo/Poço', '', 'Bebedouro e Chafariz', 'Nova Construção', 'Consumo Humano, Animal e Rega', 0, 0, '', '', 0, '', '', '', 'Sim', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-01', '', '', 913, 1001, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, '', '', 'Sim', 2, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(249, '2022-01-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 231, '-16.40965', '13.31085', 'Furo', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 6000, 5, '', '', 0, '', '', 'Sim', 'Sim', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-06-01', '', '', 913, 1001, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, '', '', 'Sim', 2, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(250, '2022-01-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 232, '-16.40965', '13.31085', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', 'Nova Construção', 'Consumo Humano, Animal e Rega', 0, 0, '', '', 0, '', '', 'Sim', 'Sim', 0, 'N/A', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-02-01', '', '', 913, 1001, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, '', '', 'Sim', 3, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(251, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 46, 233, '16° 33.030\'S', '13° 36.837\'E', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, '', 'Finalizado/Operacional', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(252, '2022-10-01', '2022-10-01', 'Inácio Zacarias', 'TESE/C4', 3, 15, 46, 234, '-16.7644', '13.1996', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Bebedouro, Chafariz, Lavandaria e Tanque Banheiro', 'Reabilitação', 'Consumo Humano, Animal e Rega', 2500, 3, 'Sim', ' Empresa contratada', 0, 'Bomba Solar', 'Reabilitação de infraestrutuaras anexas (pontos de coleta de água, lavandaria, balneários e bebedouro.', 'Sim', 'Sim', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-12-18', 'Empresa Provincial de Água e Saneamento (EPAS)', 'Anexo Enviado', 627, 955, 0, 'Não', 0, 0, 0, 0.38, 'Sim', 'MOGECA', 'Mensal', 'Não', 'Sim', 'Não', 2, 1, 'Não', 'Não', 'Sim', 0, 'Não', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', 'alteração de estrutura ', '0000-00-00', 'TS-C (Gaudêncio K.)', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(253, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 15, 46, 235, '-16.5505', '13.3628', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz, Lavandaria e Tanque Banheiro', 'Nova Construção', 'Consumo Humano e Animal', 0, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', '', 'Não', 0, '', 'Em Preparação', '2. Anexo por ser Enviado', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(254, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 15, 46, 236, '-16.6512', '13.6176', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', 'Nova Construção', 'Consumo Humano e Animal', 0, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', '', 'Não', 0, '', 'Em Preparação', '2. Anexo por ser Enviado', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(255, '2022-01-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 47, 237, '-16.991389°', '13.726416', 'Furo', 'Furo/Poço', '', '', '', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', '', '', 0, 'N/A', 'Em Preparação', 'Anexo por ser Enviado', '0000-00-00', '', '', 300, 352, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 2, 3, '', '', 'Sim', 2, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dos Brigadistas ', 'Aquisição do Material, Contas e BI dos Brigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(256, '2022-01-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 47, 238, '-16.95100', '13.97756', 'Furo', 'Furo/Poço', '', '', '', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em Preparação', 'Anexo por ser Enviado', '0000-00-00', '', '', 257, 374, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 2, 3, '', '', 'Sim', 2, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(257, '2022-01-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 47, 239, '171.4000S', '14148730L', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Sim', 'Sim', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 269, 340, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, '', '', 'Sim', 5, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 9, 1, 0, 65000, 9, 0, 650000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(258, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 47, 240, '-17.09130', '14.27170', 'Chimpaca', 'Água da Chuva', '', '', '', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em Preparação', 'Anexo por ser Enviado', '0000-00-00', '', '', 405, 515, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', 'Sim', 6, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(259, '2022-01-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 15, 47, 241, '-17.33527', '13.97092', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', '', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', 'Sim', 0, 'N/A', 'Em Preparação', 'Anexo por ser Enviado', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, '', '', 'Sim', 7, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(260, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 15, 47, 242, '-17.3353', '13.9707', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz, Lavandaria e Tanque Banheiro', 'Nova Construção', 'Consumo Humano e Animal', 0, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', '', 'Não', 0, '', 'Em Preparação', '2. Anexo por ser Enviado', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(261, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 15, 47, 243, '-17.0663', '14.0049', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz e Lavandaria', 'Nova Construção', 'Consumo Humano e Animal', 0, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', '', 'Não', 0, '', 'Em Preparação', '2. Anexo por ser Enviado', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(262, '2021-10-01', '2023-04-01', 'Paulo Silva', 'UIC', 3, 15, 47, 244, '-16.8546', '14.4635', 'Furo', 'Furo/Poço', '', 'Bebedouro, Chafariz, Lavandaria e Tanque Banheiro', 'Nova Construção', 'Consumo Humano e Animal', 0, 5, '', ' Empresa contratada', 0, '', 'Informação a recolher após realização do ensaio de caudal', '', 'Não', 0, '', 'Em Preparação', '2. Anexo por ser Enviado', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(263, '2023-01-01', '2023-04-01', 'Pandequeni Martins/Eduardo Eliseu', 'ADESPOV/C4', 1, 4, 48, 245, 'S-14° 45´ 37,29852´´ ', 'E0-13° 30´53,56404´´ ', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Rega', 0, 0, '', '', 0, '', '', '', '', 15, '', 'Finalizado/Operacional', '', '0000-00-00', '', '', 14, 21, 0, '', 0, 0, 0, 2, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Cash For Work', 'Trabalho para abertura de furo artesanal', 10, 0, 0, 130000, 9, 0, 130000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(264, '2023-01-01', '2023-01-01', 'Pandequeni Martins/Eduardo Eliseu', 'ADESPOV/C4', 1, 4, 48, 246, '\"S 15º 3`17,49132\"\"\"', '\"E 12º15`25,42068\"\"\"', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Rega', 0, 0, '', '', 0, '', '', '', '', 0, '', 'Em Progresso', '', '0000-00-00', '', '', 14, 21, 0, '', 0, 0, 0, 2, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Cash For Work', 'Trabalho para abertura de furo artesanal', 5, 0, 0, 130000, 9, 0, 130000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(265, '2022-10-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 2, 53, 247, '14°12′17.93″', '13°04′13.62″', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Rega', 3000, 3, 'Não', '', 5, 'Motobomba', 'Comunitária: Furo artesanal com suporte de um tanque reservatório de água', 'Não', 'Sim', 0, '', 'Finalizado/Operacional', '', '2022-09-20', '', '', 11, 8, 19, '', 0, 0, 0, 0, 'Sim', '', 'Quinzenal', 'Não', 'Não', 'Não', 0, 0, '', '', 'Não', 0, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 4, 0, 4, 8036, 9, 7, 225000, '', 'Furo finalizado e já está a ser utilizado para a rega do campo de demonstração. Vai ser instalado um tanque com uma capacidade de 3000 litros para o sistema de rega.', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(266, '2023-01-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 2, 53, 248, '14°13′10.24″', '12°53′51.5″', 'Chafariz', 'Furo/Poço', '', '', 'Reabilitação', 'Consumo Humano', 0, 0, 'Sim', '', 0, 'Outro (Especifique na Descrição)', 'Furo: Sistema de Captação', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', '', '2023-07-14', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 10, 0, 10, 1220, 9, 66, 805000, '', 'Finalizado e operacional faltando apenas a entrega formal da obra. Sobre as transferencias sociais no Chingo Sede todos os 10 trabalhadores trabalharam em conjunto na construção dos 5 pontos de água e dai a razão de alguns aparecerem sem dados nas tansfer', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(267, '2023-01-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 2, 53, 248, '14°13′10.24″', '12°53′51.5″', 'Chafariz', 'Furo/Poço', '', '', 'Reabilitação', 'Consumo Humano', 0, 0, 'Sim', '', 0, 'Outro (Especifique na Descrição)', 'Furo: Sistema de Captação', 'Não', 'Não', 0, '', 'Finalizado/Operacional', '', '2023-07-14', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 0, 0, 0, 0, 9, 0, 0, '', 'Finalizado e operacional faltando apenas a entrega formal da obra.', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(268, '2023-04-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 2, 53, 248, '14°13′10.24″', '12°53′51.5″', 'Chafariz', 'Furo/Poço', '', '', 'Reabilitação', 'Consumo Humano', 0, 0, 'Sim', '', 5, 'Outro (Especifique na Descrição)', 'Furo: Sistema de Captação', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', '', '2023-07-14', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 0, 0, 0, 0, 9, 0, 0, '', 'Finalizado e operacional faltando apenas a entrega formal da obra.', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(269, '2023-04-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 2, 53, 248, '14°13′10.24″', '12°53′51.5″', 'Chafariz', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano', 0, 0, 'Sim', '', 5, 'Outro (Especifique na Descrição)', 'Furo: Sistema de Captação', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', '', '2023-07-14', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 0, 0, 0, 0, 9, 0, 0, '', 'Finalizado e operacional faltando apenas a entrega formal da obra.', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(270, '2023-04-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 2, 53, 248, '14°13′10.24″', '12°53′51.5″', 'Chafariz', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano', 0, 0, 'Sim', '', 5, 'Outro (Especifique na Descrição)', 'Furo: Sistema de Captação', 'Sim', 'Não', 0, '', 'Finalizado/Operacional', '', '2023-07-14', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 0, 0, 0, 0, 9, 0, 0, '', 'Finalizado e operacional faltando apenas a entrega formal da obra.', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(271, '2022-10-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 2, 54, 249, '13°40′27.11″', '12°54′09.29″', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Rega', 5000, 4, 'Não', '', 0, 'Motobomba', 'Comunitária: Furo artesanal com suporte de um tanque reservatório de água', '', 'Sim', 0, '', 'Finalizado/Operacional', '', '2023-04-01', '', '', 16, 4, 20, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 4, 1, 5, 6714, 9, 7, 235000, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(272, '2023-04-01', '2023-04-01', 'Miguel Souza', 'PIN/C4', 1, 2, 54, 250, '', '', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Rega', 3000, 3, 'Não', '', 4, 'Motobomba', 'Comunitária: Furo artesanal com suporte de um tanque reservatório de água', 'Não', 'Sim', 0, '', 'Finalizado/Operacional', '', '2023-05-30', '', '', 6, 7, 13, '', 0, 0, 0, 0, 'Sim', '', '', '', '', '', 0, 0, '', '', 'Não', 0, '', 'Cash For Work', '. Maior de 18 anos, nacionalidade angolana, residir no Bairro/aldeia, ter noções de pedreira e canalização, falar a língua local, ter um bom aproveitamento na entrevista de selecção. Os CfW foram seleccionados na presença das autoridades tradicionais, foi aplicado um questionário sobre especificadades de cada técnico em 3 áreas (construção, canalização e serralharia) foram seleccionados os Cash for Work em cada bairro de acordo com o aproveitamento na entrevista. ', 4, 0, 4, 7143, 9, 7, 200000, '', 'Furo finalizado e já está a ser utilizado para a rega do campo de demonstração. Vai ser instalado um tanque com uma capacidade de 3000 litros para o sistema de rega.', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(273, '2022-10-01', '2023-04-01', 'Pandequeni Martins/Eduardo Eliseu', 'ADESPOV/C4', 1, 1, 55, 251, 'S-14°39´115´´  ', 'E0-13°.16´,076´´', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Rega', 0, 0, '', '', 0, '', '', '', '', 0, '', 'Finalizado/Operacional', '', '0000-00-00', '', '', 14, 21, 0, '', 0, 0, 0, 1, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Cash For Work', 'Trabalho para abertura de furo artesanal', 5, 0, 0, 130000, 9, 0, 130000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(274, '2023-01-01', '2023-01-01', 'Pandequeni Martins/Eduardo Eliseu', 'ADESPOV/C4', 1, 1, 55, 252, 'S 14° 45´ 50,87916´´  ', 'L 13°28´30,89784´´', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Rega', 0, 0, '', '', 0, '', '', '', '', 0, '', 'Em Progresso', '', '0000-00-00', '', '', 14, 21, 0, '', 0, 0, 0, 1, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Cash For Work', 'Trabalho para abertura de furo artesanal', 3, 0, 0, 130000, 9, 0, 130000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(275, '2023-01-01', '2023-01-01', 'Pandequeni Martins/Eduardo Eliseu', 'ADESPOV/C4', 1, 1, 55, 253, 'S 15º 5` 55,47408', 'L 12º 19´, 4932', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Rega', 0, 0, '', '', 0, '', '', '', '', 0, '', 'Em Progresso', '', '0000-00-00', '', '', 14, 21, 0, '', 0, 0, 0, 1, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', 'Cash For Work', 'Trabalho para abertura de furo artesanal', 3, 0, 0, 130000, 9, 0, 130000, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(276, '2021-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 1, 56, 254, '-14.222968', '13.260931', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 4000, 5, 'Sim', '', 0, 'Bomba Solar', 'furo profundo', 'Sim', 'Sim', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-12-01', '', 'Anexo Enviado', 0, 0, 0, '', 50, 2500, 1500, 0.8, 'Sim', 'Comissão de Gestão', '', '', '', '', 1, 1, '', '', 'Sim', 1, '', 'Food For Work', 'Entrega de comida pelo  trabalho  realizado 25+29/06/2022', 30, 10, 40, 5, 10, 0, 8, '', 'Morosidade na implementaçao do Lote 1 e 2', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(277, '2021-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 1, 56, 255, '-14.295762', '13.466093', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 3000, 5, 'Sim', '', 0, 'Bomba Solar', 'furo profundo', 'Sim', 'Sim', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-12-01', '', 'Anexo Enviado', 0, 0, 0, '', 37, 3500, 2000, 0.8, 'Sim', 'Comissão de Gestão', '', '', '', '', 1, 1, '', '', 'Sim', 0, '', 'Food For Work', 'Entrega de comida pelo  trabalho  realizado 25/06/2022', 15, 5, 20, 5, 10, 0, 8, '', 'Morosidade na implementaçao do Lote 1 e 2', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(278, '2021-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 1, 56, 256, '-14.443151', ' 13.327852', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 12000, 5, 'Sim', '', 0, 'Bomba Solar', 'furo profundo', 'Sim', 'Sim', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-12-01', '', 'Anexo Enviado', 0, 0, 0, '', 200, 3000, 2400, 0.8, 'Sim', 'Comissão de Gestão', '', '', '', '', 1, 1, '', '', 'Sim', 0, '', 'Food For Work', 'Entrega de comida pelo  trabalho  realizado 24/06/2022', 15, 5, 20, 5, 10, 0, 8, '', 'Morosidade na implementaçao do Lote 1 e 2', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(279, '2022-10-01', '2023-04-01', 'José Mário (Aniceto)', 'WVI/C4', 1, 1, 56, 257, '14°22,787', '13°33,700', 'Furo', 'Furo/Poço', '', '', '', 'Consumo Humano, Animal e Rega', 10000, 5, '', '', 0, 'Bomba Solar', 'Insatalação da bomba de água alimentada pro paineis solares; reabilitação de 1 lavandaria, 1 chafariz, 1 bebedouro e reposição da vedação; construção de um tanque de rega 18 000 l de alvenaria em blocos de cimento enchidos e assentamento em base de pedra; construção de 2 balnearios (um balneário duplo para Mulheres e outro para Homens) e instalação de um sistema de irrigação (por sulco) do campo da ECA.', 'Sim', 'Sim', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-02-01', 'Não foi entregue', '', 160, 156, 0, 'Não', 0, 0, 0, 0.5, 'Sim', 'MOGECA', '', '', '', '', 5, 5, '', '', 'Sim', 1, '', 'Outro (Especifique)', '', 10, 10, 20, 1000, 0, 10, 200000, 'Anexo por ser Enviado', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(280, '2021-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 1, 57, 258, '-14.982997', ' 12.865082', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 12000, 5, 'Sim', '', 0, 'Bomba Solar', 'furo profundo', 'Sim', 'Sim', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-12-01', '', 'Anexo Enviado', 0, 0, 0, '', 26, 2000, 600, 0.8, 'Sim', 'Comissão de Gestão', '', '', '', '', 1, 1, '', '', 'Sim', 0, '', 'Food For Work', 'Entrega de comida pelo  trabalho  realizado 20/06/2022', 15, 5, 20, 5, 10, 0, 8, '', 'Morosidade na implementaçao do Lote 1 e 2', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(281, '2021-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 1, 57, 259, '-14.938341', ' 12.961320', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 12000, 5, 'Sim', '', 0, 'Bomba Solar', 'furo profundo', 'Sim', 'Sim', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-12-01', '', 'Anexo Enviado', 0, 0, 0, '', 13, 5000, 3000, 0.8, 'Sim', 'Comissão de Gestão', '', '', '', '', 1, 1, '', '', 'Sim', 0, '', 'Food For Work', 'Entrega de comida pelo  trabalho  realizado 20/06/2022', 15, 5, 20, 5, 10, 0, 8, '', 'Morosidade na implementaçao do Lote 1 e 2', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(282, '2021-10-01', '2023-01-01', 'Enrica Colazzo/Óscar Dala', 'COSPE/C1', 1, 1, 57, 260, '-15.026118', ' 12.844932', 'Furo', 'Furo/Poço', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 3000, 5, 'Sim', '', 0, 'Bomba Solar', 'furo profundo', 'Sim', 'Sim', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo Enviado', '2022-12-01', '', 'Anexo Enviado', 0, 0, 0, '', 0, 3000, 600, 0.8, 'Sim', 'Comissão de Gestão', '', '', '', '', 1, 1, '', '', 'Sim', 0, '', 'Food For Work', 'Entrega de comida pelo  trabalho  realizado 21/06/2022', 15, 5, 20, 5, 10, 0, 8, '', 'Morosidade na implementaçao do Lote 1 e 2', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(283, '2022-10-01', '2023-04-01', 'José Mário (Aniceto)', 'WVI/C4', 1, 1, 58, 261, '14°38,311', '13°09,450', 'Furo', 'Furo/Poço', '', '', '', 'Consumo Humano, Animal e Rega', 5000, 5, '', '', 0, 'Bomba Solar', 'Reabilitação e ampliação do sistema multifuncional: a) Substituição da estrutura de elevação do tanque de agua; b) instalçaão do tanque inox de agua (5000 l); c) Construção do tanque de rega para a ECA em alvanaria com capacidade (com capacidade de armazenamento de 18 000 l); d) Construção do segundo bebedouro do gado; e) Reabilitação do primeiro bebedouro do gado; f) Construção de dois balneario (1 dupla para senhoras e 1 para homens);  g) construção de uma lavandaria; h)  Reabilitação do Chariz.', 'Não', 'Sim', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-03-01', 'Não foi entregue', '', 195, 203, 0, 'Não', 0, 0, 0, 0.6, 'Sim', 'MOGECA', '', '', '', '', 3, 3, '', '', 'Sim', 1, '', 'Outro (Especifique)', '', 9, 11, 20, 1000, 0, 10, 200000, 'Anexo por ser Enviado', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(284, '2022-10-01', '2023-04-01', 'José Mário (Aniceto)', 'WVI/C4', 1, 1, 58, 262, '14°37,799', '13°14,642', 'Furo', 'Furo/Poço', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 6.6, 6, '', '', 0, 'Motobomba', 'Escavação manual de um poço (2m) seguida de perfuração artesanal do furo (4 metros de profundidade). Revestimento do furo com tubos dreno e tubo liso; fornecimento de uma motobomba e respectiva mangueira de irrigação., ', 'Sim', 'Sim', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-01-01', 'Não foi entregue', '', 18, 8, 0, 'Não', 0, 0, 0, 0.6, 'Não', 'Comissão de Gestão', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', 'Helder (Fresan Namibe)', 'Parcelas de estudo', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24');
INSERT INTO `agua` (`Id`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `latitude`, `longitude`, `infraEstrutura`, `fonteHidraulica`, `fonteHidraulicaAlternativa`, `servicoAssociado`, `novaConstrucao`, `fimAQueSeDestina`, `capacidadeInfraestrutura`, `capacidadeUnidadeID`, `realizadoTesteQualidadeAgua`, `entidadeResponsavelConstrucao`, `anosGarantia`, `sistemExtracaoAgua`, `especificacoesTecnInfraExtru`, `temPlacaVisibilidade`, `infraAssociadaCampo`, `nomeCampoAssociadoGrupoID`, `anexoFichaTecnInfraExtr`, `estadoObra`, `imagemInfra`, `dataConclusaoObra`, `pontoFoiEntregueObra`, `anexoActaEntrega`, `benHomem`, `benMulher`, `totalAFAbrangidos`, `benCorresponTotalPopulacao`, `totalSuino`, `totalCaprino`, `totalBovino`, `totalHaIrrigados`, `grupoGestAgua`, `orientacoesMetodologia`, `comissaoRealizaReuniosFreq`, `grupoFazContribuicoes`, `grupoTemPlanoManutencaoPrev`, `grupoTemPlanoManutencaoUrgen`, `comissaoHomem`, `comissaoMulher`, `grupoFazParteACA`, `grupoEstaAssociadoBMAS`, `existeAcompaMuniEneAgua`, `nTecniAcompanham`, `nTecniParticipamReunioes`, `metodologiaAdoptada`, `criteriosUtilizadoParaSeleBenef`, `benHomemTransSocial`, `benMulherTransSocial`, `totalAFCorrespondenteTransSocial`, `valorDiarioBene`, `valorDiarioBeneUnidadeID`, `nDiasTrabalho`, `totalEntregueTranBen`, `anexoTermoPagamento`, `desafiosONG`, `licoesAprendidadasONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constantacoeFeitasFresan`, `recomendacoes`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(285, '2023-01-01', '2023-04-01', 'José Mário (Aniceto)', 'WVI/C4', 1, 4, 73, 263, '15°43743', '11°55584', 'Furo', 'Furo/Poço', '', '', '', 'Rega', 3, 6, '', '', 0, 'Electrobomba', 'Furo artesanal equipado com eletrobomba para um tanque de apoio a rega. O sistema está inoperacional.', 'Sim', 'Sim', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '0000-00-00', 'Não foi entregue', '', 3, 15, 0, 'Não', 0, 0, 0, 1, 'Não', 'Comissão de Gestão', '', '', '', '', 0, 0, '', '', 'Sim', 2, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(286, '2023-01-01', '2023-04-01', 'José Mário (Aniceto)', 'WVI/C4', 1, 4, 73, 263, '', '', 'Furo', 'Furo/Poço', '', '', '', 'Consumo Humano e Rega', 0, 0, '', '', 0, 'Electrobomba', 'Furo com eletrobomba para abastecimento de um sistema composto por tanque elevado de 5 000 litros e uma lavandaria e chafariz. Também abastece a escola e o Posto de saude, porem está iniperacional.', 'Sim', 'Sim', 0, 'Anexo por ser Enviado', 'Em Preparação', 'Anexo por ser Enviado', '0000-00-00', 'Não foi entregue', '', 789, 1, 0, 'Não', 0, 0, 0, 0.35, 'Não', 'MOGECA', '', '', '', '', 0, 0, '', '', 'Sim', 2, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 0, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(287, '2021-10-01', '2022-10-01', 'Domingos Nangafina', 'WVI/C1', 2, 8, 74, 264, '-14.2492', '15.05756', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano, Animal e Rega', 108000, 0, '', '', 0, 'Bomba Solar', '* Feito perfuração de 1 Furo com 30 metros a rotopercussão, ar comprimido  e a rotary com devido revestimento  com tubos lisos e drenados (ralos) de 125 PVC tradicional com o devido pré Selecione constituído por areão calibrado de granulometria apropriada (diâmetro de 2-4mm). * Construido 2 Bica/Chafariz, 1 Bebedouro e 1 Lavandaria.', 'Sim', 'Não', 0, 'Anexo por ser enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-02-04', 'Não foi entregue', 'N/A', 1433, 1553, 0, 'Não', 0, 0, 0, 0.5, 'Sim', 'MOGECA', '', '', '', '', 3, 2, 'Não', 'Não', 'Sim', 2, '', 'Cash For Work', 'Discussão e planificação junto das comunidades beneficiadas pelas infraestruturas priorizando as pessoas mais vulneráveis especialmente as mulheres e jovens conhecidos e residentes na comunidade numa metodologia que garante flexibilidade e maior impacto das tarefas, individuos maiores de 18 anos com vontade de participar nos trabalhos comunitários. É feita uma remuneração diferenciada entre os mestres de obra e os membros da comunida (em média recebem 1000kz).', 11, 3, 0, 4857, 9, 0, 68000, 'Anexo por ser Enviado', 'Os desafios prendem-se com a participação das mulheres nos trabalhos de construção. Existe uma certa descriminação dos homens perante as mulheres de que estas não deveriam participar neste tipo de trabalho, e, esta acção faz com que as mulheres se apartam', 'Mobilização e sensibilização comunitária para o envolvimento das mulheres e homens em trabalhos comunitários.', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(288, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 13, 75, 265, '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(289, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 13, 75, 266, '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(290, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 13, 75, 267, '-16.3881702', '13.9534293', 'Furo', '', '', '', '', 'Consumo Humano', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-10-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 250, 314, 94, 'Sim', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(291, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 13, 75, 268, '-16.2666506', '13.7968275', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-10-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 240, 298, 90, 'Sim', 0, 262, 300, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(292, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 13, 75, 269, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(293, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 13, 75, 270, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(294, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 14, 76, 271, '-16.6930013', '15.77676136', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-10-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 220, 288, 86, 'Sim', 0, 275, 303, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(295, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 14, 76, 272, '-17.065093', '15.705621', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2022-09-01', 'Brigada Municipal de Água e Saneamento (BMAS)', 'Anexo por ser Enviado', 245, 281, 91, 'Sim', 0, 233, 285, 0, 'Sim', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(296, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 77, 273, '-17.19212', '15.24455', 'Poço Melhorado', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 532, 648, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', 'Sim', 8, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 5, 3, 0, 46750, 9, 0, 374000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(297, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 77, 274, '-17.33705', '15.11692', 'Poço Melhorado', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em Preparação', 'Anexo por ser Enviado', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', 'Sim', 9, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(298, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 77, 275, '-16.97873', '15.14945', 'Poço Melhorado', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 743, 1905, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', 'Sim', 10, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 7, 1, 0, 56100, 9, 0, 448000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(299, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 77, 276, '-17.20250', '15.13803', 'Poço Melhorado', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 481, 531, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', 'Sim', 11, '', 'Cash For Work', 'As pessoas das brigadas foram escolhidas pela comunidade e com envolvimento do GAS', 6, 2, 0, 46750, 9, 0, 374000, 'Anexo Enviado', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(300, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 77, 277, '-16.94400', '15.14052', 'Poço Melhorado', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 540, 793, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 0, 0, '', '', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(301, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 77, 278, '-17.08347', '15.05890', 'Poço Melhorado', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 543, 796, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(302, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 77, 279, '-17.27665', '14.90726', 'Poço Melhorado', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 1890, 2574, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(303, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 77, 280, '-17.27882', '14.91763', 'Poço Melhorado', 'Furo/Poço', '', 'Chafariz', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(304, '2022-04-01', '2022-10-01', 'Duarte Manuel', 'ADPP/C1', 3, 18, 77, 281, '-17.19870', '14.92754', 'Chimpaca', 'Água da Chuva', '', 'Bebedouro', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, '', '', 'Não', '', 0, 'N/A', 'Em fase de Finalização', 'Anexo por ser Enviado', '0000-00-00', '', '', 674, 779, 0, '', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Quinzenal', '', 'Sim', '', 3, 2, '', '', 'Sim', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Aquisição do Material, Contas e BI dosBrigadistas ', 'Aquisição do Material, Contas e BI dosBrigadistas ', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(305, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 282, 'S17º 0´ 52,50 744´´', 'E 15º 2´26,63 916´´', 'Cisterna Calçadão', 'Chimpaca', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', 'A cisterna calaçadão, é uma tecnologia do semi árido brasileiro brasileiro. O calçadão é construído ao nível do solo capta água da chuva que escoa para a cisterna. A água é usada para para fins do consumo doméstico e representa para a comunidade uma solução simples para o acesso aá água as comunidades rurais com uma capacidade de 52.000 litros, numa área de 200m2. Num ano com 350 milimetros de precipitação é capaz de armazenar 52.000 litros', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-10-30', 'Associação de Consumidores de Água (ACA) da Comuna', '', 37, 61, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', '', 'Sim', 'Não', 0, 0, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', ' selecção dos membros das comunidades, com o apoio dos líderes comunitários, celebração de um contratos de prestação de serviço, posteriormente é feita a remuneração das pessoas envolvidas na  construção das 80 cisternas,  (Mão-de-obra especializada e não especializada)', 9, 7, 0, 0, 0, 30, 877350, '', 'Falta contas bancáriasincentivar as  as mulheres para o processo de construção das cisternas', 'Incentivar os membros das comunidades para a emissão dos documentos de identificação pessoal;', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(306, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 283, 'S16º 59´46,3 73 28´´', 'E 15º 0´14,46 33 6´´', 'Cisterna Calçadão', 'Chimpaca', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', '', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-10-30', 'Associação de Consumidores de Água (ACA) da Comuna', '', 28, 71, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', '', 'Sim', 'Não', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', '', '', 0, 0, 0, 0, 0, 30, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(307, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 284, 'S16º 57´ 37,77912´´', 'E 15º   0 21,35376', 'Cisterna Calçadão', 'Chimpaca', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', '', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-12-15', 'Associação de Consumidores de Água (ACA) da Comuna', '', 49, 63, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', '', 'Não', 'Não', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', ' selecção dos membros das comunidades, com o apoio dos líderes comunitários, celebração de um contratos de prestação de serviço, posteriormente é feita a remuneração das pessoas envolvidas na  construção das 80 cisternas,  (Mão-de-obra especializada e não especializada)', 8, 8, 0, 0, 0, 30, 877350, '', 'Falta contas bancáriasincentivar as  as mulheres para o processo de construção das cisternas', 'Incentivar os membros das comunidades para a emissão dos documentos de identificação pessoal;', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(308, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 285, 'S16º 58´10,4 5164´´', 'E 15º 2´18,27312´´', 'Cisterna Calçadão', 'Chimpaca', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', '', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-12-21', 'Associação de Consumidores de Água (ACA) da Comuna', '', 27, 80, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', '', 'Não', 'Não', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', '', '', 0, 0, 0, 0, 0, 30, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(309, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 286, 'S17º 6´43,00 236´´', 'E 14º 56´51,0 81´´', 'Cisterna Calçadão', 'Chimpaca', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', '', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-12-15', 'Associação de Consumidores de Água (ACA) da Comuna', '', 41, 59, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', '', 'Não', 'Não', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', ' selecção dos membros das comunidades, com o apoio dos líderes comunitários, celebração de um contratos de prestação de serviço, posteriormente é feita a remuneração das pessoas envolvidas na  construção das 80 cisternas,  (Mão-de-obra especializada e não especializada)', 10, 6, 0, 0, 0, 30, 877350, '', 'Falta contas bancáriasincentivar as  as mulheres para o processo de construção das cisternas', 'Incentivar os membros das comunidades para a emissão dos documentos de identificação pessoal;', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(310, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 287, 'S17º 7´39,89244´´', 'E15º0´34,4268´´', 'Cisterna Calçadão', 'Chimpaca', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', '', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-12-24', 'Associação de Consumidores de Água (ACA) da Comuna', '', 37, 52, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', '', 'Não', 'Não', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', '', '', 0, 0, 0, 0, 0, 30, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(311, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 288, 'S17º 2´53,93 616´´', 'E 15º 0´8,718 12', 'Cisterna Calçadão', 'Chimpaca', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', '', '', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-12-30', 'Associação de Consumidores de Água (ACA) da Comuna', '', 47, 53, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', '', 'Não', 'Não', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', '', '', 0, 0, 0, 0, 0, 30, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(312, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 289, 'S16º 22´10,0 2648´´', 'E 14º 43´18,74 28´´', 'Cisterna Calçadão', '', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, '', '', 'Sim', 'Não', 0, 'Anexo Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-12-30', 'Associação de Consumidores de Água (ACA) da Comuna', '', 26, 47, 18, 'Não', 0, 0, 0, 0, 'Sim', 'MOGECA', 'Mensal', '', '', 'Não', 3, 3, 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Cash For Work', ' selecção dos membros das comunidades, com o apoio dos líderes comunitários, celebração de um contratos de prestação de serviço, posteriormente é feita a remuneração das pessoas envolvidas na  construção das 80 cisternas,  (Mão-de-obra especializada e não especializada)', 10, 6, 0, 0, 0, 30, 877350, '', 'Falta contas bancáriasincentivar as  as mulheres para o processo de construção das cisternas', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(313, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 290, 'S17º 1´ 40,30 032´´', 'E 15º 0´35,08272´´', 'Cisterna Calçadão', '', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, 'Gravidade (Curso Natural de Água)', '', 'Sim', 'Não', 0, '', 'Em Preparação', '', '2023-07-01', 'Não foi entregue', '', 19, 51, 70, 'Não', 0, 0, 0, 0, 'Sim', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', ' selecção dos membros das comunidades, com o apoio dos líderes comunitários, celebração de um contratos de ', 10, 6, 0, 0, 0, 30, 877350, '', 'Envovimento das instituições locais(direção da energia e água ', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(314, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 291, 'S16º 59´ 0,06216´´', 'E 15º 0´ 57,80736´´', 'Cisterna Calçadão', 'Água da Chuva', '', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, 'Gravidade (Curso Natural de Água)', '', 'Sim', 'Não', 0, '', 'Em Preparação', '', '2023-07-01', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', 'Cash For Work', ' selecção dos membros das comunidades, com o apoio dos líderes comunitários, celebração de um contratos de ', 10, 6, 0, 0, 0, 30, 877350, '', 'Envovimento das instituições locais(direção da energia e água ', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(315, '2022-10-01', '2022-10-01', 'Alice Peso', 'NCA/C4', 3, 18, 77, 291, 'S16º 58´41,90844´´', 'E 14º 58´,29,6598´´', 'Cisterna Calçadão', '', 'Água da Chuva', '', 'Nova Construção', 'Consumo Humano', 52000, 4, 'Não', 'NCA-ADRA', 50, 'Gravidade (Curso Natural de Água)', '', 'Sim', 'Não', 0, '', 'Em Preparação', '', '2023-07-01', 'Não foi entregue', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, '', '', '', 0, 0, 0, 0, 0, 30, 0, '', '#REF!', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(316, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 78, 292, '-16.76251', '14.93605', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 25, 32, 57, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(317, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 78, 293, '-16.76683', '14.91223', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-02-01', 'Não foi entregue', 'N/A', 22, 40, 62, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(318, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 78, 294, '-16.8205', '14.858052', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2020-11-01', 'Não foi entregue', 'N/A', 13, 47, 60, 'Não', 0, 0, 0, 1.5, '', '', 'Quinzenal', '', 'Sim', 'Sim', 2, 3, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(319, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 78, 295, '-16.85258', '14.80471', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-07-01', 'Não foi entregue', 'N/A', 18, 35, 53, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 4, 1, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(320, '2022-01-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 78, 296, '-16.86153', '14.79232', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-07-01', 'Não foi entregue', 'N/A', 11, 45, 56, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 4, 1, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(321, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 78, 296, '-16.90349', '14.77407', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-06-01', 'Não foi entregue', 'N/A', 12, 43, 55, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(322, '2021-10-01', '2022-10-01', 'Baptista Pedro', 'CODESPA/C2', 3, 18, 78, 297, '-17.0444', '14.71935', 'Sistema de Captação e Bombeamento de Água', '', '', '', 'Instalação de um Sistema de Irrigação', 'Rega', 108000, 0, '', '', 0, '', 'Infraestrutura de irrigação com capacidade de irrigar 1ha, constituído por uma motobomba capaz de bombear 36.000L de água por hora, tubo de transporte, mangueira de distribuição, fitas gota-gota e ligadores manga-fita.', '', '', 0, '', 'Finalizado/Operacional', '', '2021-07-01', 'Não foi entregue', 'N/A', 22, 40, 62, 'Não', 0, 0, 0, 1, '', '', 'Quinzenal', '', 'Sim', 'Sim', 3, 2, 'Não', 'Não', 'Não', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(323, '2023-04-01', '2023-04-01', 'Marianna Costanzo', 'CUAMM/C4', 3, 18, 78, 298, '-16.594524°', '14.997058°', 'Sistema de Captação e Bombeamento de Água', 'Água da Chuva', '', '', '', 'Consumo Humano', 6000, 3, 'Não', ' Empresa contratada', 0, 'Outro (Especifique na Descrição)', '2 reservatorios de 3000l cada ', 'Sim', 'Não', 0, 'Anexo Enviado', 'Em Preparação', 'Anexo Enviado', '2023-05-01', 'Não foi entregue', '', 0, 0, 75, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', 'Sim', 1, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(324, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 78, 299, '-16.763115', '14.5791998', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-05-25', 'Não foi entregue', 'Anexo por ser Enviado', 312, 320, 106, 'Sim', 0, 400, 312, 0, 'Não', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(325, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 78, 300, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(326, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 78, 301, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(327, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 78, 302, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(328, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 78, 303, '-16.973755', '14.5130931', 'Furo', '', '', '', '', 'Consumo Humano e Animal', 5000, 4, 'Sim', ' Empresa contratada', 0, '', 'Reabilitação da inf. hidráulica sistema solar (colocação da bomba e placas solares, reestruturação do suporte do reservatório de água, reajuste  nas ligações das tubagens, construído bebedouro com 2 lados, 1 chafariz com 1 torneira, 4 lavandarias com 1 torneira em cada uma, mudancas na estrutura da vedação, portões e quarto do controlo electrico e suporte de sombra).', 'Sim', '', 0, 'Anexo por ser Enviado', 'Finalizado/Operacional', 'Anexo por ser Enviado', '2023-06-10', 'Não foi entregue', 'Anexo por ser Enviado', 268, 310, 98, 'Sim', 0, 270, 219, 0, 'Não', 'MOGECA', 'Mensal', 'Sim', 'Sim', 'Sim', 1, 1, '', 'Sim', 'Sim', 2, 'Sim', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(329, '2022-10-01', '2022-10-01', 'Soares Nasso', 'DW/C4', 3, 18, 78, 304, '', '', 'Furo', '', '', '', '', '', 0, 0, '', '', 0, '', 'N/A', '', '', 0, '', 'Em Preparação', 'N/A', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, 'Não', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(330, '2022-10-01', '2022-10-01', 'Anivaldo Pena', 'ADRA/C4', 2, 7, 79, 308, '', '', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, 'Bomba Solar', '', '', '', 0, '', 'Em Preparação', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(331, '2022-10-01', '2022-10-01', 'Anivaldo Pena', 'ADRA/C4', 2, 7, 79, 308, '', '', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, 'Bomba Solar', '', '', '', 0, '', 'Em Preparação', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(332, '2022-10-01', '2022-10-01', 'Anivaldo Pena', 'ADRA/C4', 2, 7, 79, 308, '', '', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, 'Bomba Solar', '', '', '', 0, '', 'Em Preparação', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(333, '2022-10-01', '2022-10-01', 'Anivaldo Pena', 'ADRA/C4', 2, 9, 79, 308, '', '', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, 'Bomba Solar', '', '', '', 0, '', 'Em Preparação', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(334, '2022-10-01', '2022-10-01', 'Anivaldo Pena', 'ADRA/C4', 2, 9, 79, 308, '', '', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, 'Bomba Solar', '', '', '', 0, '', 'Em Preparação', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(335, '2022-10-01', '2022-10-01', 'Anivaldo Pena', 'ADRA/C4', 2, 9, 79, 308, '', '', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, 'Bomba Solar', '', '', '', 0, '', 'Em Preparação', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(336, '2022-10-01', '2022-10-01', 'Anivaldo Pena', 'ADRA/C4', 2, 10, 79, 308, '', '', 'Furo', '', '', '', 'Nova Construção', 'Consumo Humano e Animal', 0, 0, '', '', 0, 'Bomba Solar', '', '', '', 0, '', 'Em Preparação', '', '0000-00-00', '', '', 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '0000-00-00', '2023-10-24'),
(835, '2023-10-04', NULL, 'rosario', '', 2, 7, 3, 6, '', '', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Bebedouro', 'Nova Construção', '', NULL, 1, 'Sim', ' Empresa contratada', NULL, 'Bomba Solar', '', '', '', NULL, 'anexoTermoEntregaMerendaEscolar/jTz-tkcu4me_BNa6RN6bMh3G_MNOgdgp.xls', '', 'anexoTermoEntregaMerendaEscolar/jTz-tkcu4me_BNa6RN6bMh3G_MNOgdgp.xls', NULL, '', 'anexoTermoEntregaMerendaEscolar/jTz-tkcu4me_BNa6RN6bMh3G_MNOgdgp.xls', 1, 1, NULL, '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, '', '', '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'anexoTermoEntregaMerendaEscolar/jTz-tkcu4me_BNa6RN6bMh3G_MNOgdgp.xls', '', '', NULL, '', '', '', '', '', 10, 'Validado', 'rosario', 'rosario', '2023-10-26', '2023-10-26'),
(836, '2023-10-04', NULL, 'rosario', '', 2, 7, 3, 6, '', '', 'Furo', 'Furo/Poço', 'Furo/Poço', 'Bebedouro', 'Nova Construção', '', NULL, 1, 'Não', 'Comunidade', NULL, 'Bomba Solar', '', 'Sim', 'Sim', NULL, 'anexoFichaTecnInfraExtr/5TfWnGbzRjKE6foCaCqtTAqcex2_PyA5.xls', 'Finalizado/Operacional', 'anexoTermoEntregaMerendaEscolar/wbee2eh3heUKOPbJ9N_NOuEAcVkvTIYc.xls', NULL, '', 'anexoActaEntrega/RsV0UvQJJW85EcA7rP3FMRb6t_m9m71v.xls', 1, 1, 1, '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, '', '', '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'anexoTermoPagamento/47277PMff6OleXsjEXBdaQn8Q7RiHZSf.xls', '', '', NULL, '', '', '', '', '', 10, 'Validado', 'rosario', 'rosario', '2023-10-26', '2023-10-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrador', '10', 1698301187),
('Administrador', '31', 1698083344),
('Perfil Aprovação de dados', '10', 1698301731),
('Perfil Aprovação de dados', '12', 1696216139),
('Perfil Lancamento', '10', 1698305161),
('Permissão de Administrador', '10', 1700063005),
('Permissão de Administrador', '12', 1697635753),
('Permissão de DELUE / Gestor do Projecto', '11', 1695728555),
('Permissao Validador de dados', '10', 1698305164),
('Técnico de Subvenções Huíla', '32', 1698145502);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1695728202, 1695728202),
('/agua/*', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/aprovar', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/aprovar-selecionados', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/create', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/delete', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/index', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/publicar', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/publicar-selecionados', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/relatorioreforco', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/update', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/validar', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/validar-selecionados', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/agua/view', 2, NULL, NULL, NULL, 1697945798, 1697945798),
('/capacitacao/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/capacitacao/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/getcomuna', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/getlocalidade', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/getmunicipio', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/relatorioreforco', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/classificacaodocumentoartigo/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/comuna/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/comuna/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/comuna/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/comuna/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/comuna/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/comuna/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/culturasprovidas/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/culturasprovidas/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/culturasprovidas/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/culturasprovidas/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/culturasprovidas/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/culturasprovidas/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/demostracoesculinarias/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/doccomunicacao/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/prod', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/relatorioreforco', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/subcat', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/eventos/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/prod', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/relatorioreforco', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/subcat', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/finalidade/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/fitofarmacosferramentas/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/fitofarmacosferramentas/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/fitofarmacosferramentas/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/fitofarmacosferramentas/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/fitofarmacosferramentas/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/fitofarmacosferramentas/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/relatorioreforco', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/grupo/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/prod', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/relatorioreforco', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/subcat', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/insumogrupo/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/localidade/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/localidade/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/localidade/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/localidade/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/localidade/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/localidade/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/materiais/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/merendaescolar/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/meta/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/meta/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/meta/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/meta/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/meta/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/meta/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/municipio/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/municipio/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/municipio/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/municipio/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/municipio/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/municipio/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/pacotepedagfresan/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/profissionaissaude/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/provincia/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/provincia/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/provincia/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/provincia/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/provincia/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/provincia/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/rastreio/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/reforcoinstitucional/*', 2, NULL, NULL, NULL, 1695726283, 1695726283),
('/reforcoinstitucional/aprovar', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/reforcoinstitucional/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/reforcoinstitucional/create', 2, NULL, NULL, NULL, 1695726269, 1695726269),
('/reforcoinstitucional/delete', 2, NULL, NULL, NULL, 1695726283, 1695726283),
('/reforcoinstitucional/getcomuna', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/reforcoinstitucional/getlocalidade', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/reforcoinstitucional/getmunicipio', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/reforcoinstitucional/index', 2, NULL, NULL, NULL, 1695726269, 1695726269),
('/reforcoinstitucional/listareforco', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/reforcoinstitucional/publicar', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/reforcoinstitucional/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/reforcoinstitucional/relatorioreforco', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/reforcoinstitucional/update', 2, NULL, NULL, NULL, 1695726269, 1695726269),
('/reforcoinstitucional/validar', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/reforcoinstitucional/validar-selecionados', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/reforcoinstitucional/view', 2, NULL, NULL, NULL, 1695726269, 1695726269),
('/site/*', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/site/calendario', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/site/calendario2', 2, NULL, NULL, NULL, 1700062888, 1700062888),
('/site/error', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/site/exportfolhatrimestral', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/site/folhatrimestral', 2, NULL, NULL, NULL, 1696810989, 1696810989),
('/site/graficos', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/site/index', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/site/index2', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/site/login', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/site/logout', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/supervisao/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/supervisao/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/aprovar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/aprovar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/publicar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/publicar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/validar-selecionados', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/suplementacao/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/tipometa/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/tipometa/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/tipometa/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/tipometa/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/tipometa/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/tipometa/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/unidade/*', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/unidade/create', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/unidade/delete', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/unidade/index', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/unidade/update', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/unidade/view', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/user/*', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/user/create', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/user/delete', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/user/inativar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/user/index', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/user/request-password-reset', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/user/resend-verification-email', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/user/reset-password', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/user/signup', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/user/update', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('/user/validar', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/user/verify-email', 2, NULL, NULL, NULL, 1698145303, 1698145303),
('/user/view', 2, NULL, NULL, NULL, 1696205110, 1696205110),
('Administrador', 1, 'Admnistrado tem acesso a todo o sistema', NULL, NULL, 1697581380, 1697581380),
('Gestor UIC', 1, 'este tem acesso a validar registos', NULL, NULL, 1695728448, 1695728448),
('Perfil Aprovação de dados', 2, 'Este perfil permite aprovar os dados', NULL, NULL, 1695732457, 1695732457),
('Perfil Lancamento', 2, 'Este perfil permite Lançar os dados, ou seja tornar eles publicos', NULL, NULL, 1695732496, 1695732496),
('Permissão de Administrador', 2, 'O Administrador tem acesso a todo o sitema', NULL, NULL, 1695728177, 1695728177),
('Permissão de DELUE / Gestor do Projecto', 2, 'este perfil pode validar os dados somente', NULL, NULL, 1695728363, 1695728363),
('Permissao Validador de dados', 2, 'Este perfil permite ao usuario qe lhe for atribuido, Validar os dados', NULL, NULL, 1695732425, 1695732425),
('Permissão Visualizar Tudo', 2, 'Permite apenas visualizar todos os dados', NULL, NULL, 1698144698, 1698144698),
('Técnico de Subvenções Huíla', 1, NULL, NULL, NULL, 1698145476, 1698145476);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Administrador', '/site/calendario2'),
('Administrador', 'Permissão de Administrador'),
('Gestor UIC', 'Permissão de DELUE / Gestor do Projecto'),
('Permissão de Administrador', '/*'),
('Permissão Visualizar Tudo', '/agua/index'),
('Permissão Visualizar Tudo', '/agua/view'),
('Permissão Visualizar Tudo', '/reforcoinstitucional/view'),
('Permissão Visualizar Tudo', '/site/index'),
('Técnico de Subvenções Huíla', 'Permissão Visualizar Tudo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitacao`
--

CREATE TABLE `capacitacao` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `beneficiarios` varchar(50) DEFAULT NULL,
  `tema` varchar(50) DEFAULT NULL,
  `participantesHomem` int(11) DEFAULT NULL,
  `participantesMulher` int(11) DEFAULT NULL,
  `ParticipantesTrim` date DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesImplementacaoONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(100) DEFAULT NULL,
  `constatacoesFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoesPrincipaisFresan` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(50) DEFAULT NULL,
  `nomeGrupoID` int(11) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capacitacao`
--

INSERT INTO `capacitacao` (`Id`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `beneficiarios`, `tema`, `participantesHomem`, `participantesMulher`, `ParticipantesTrim`, `anexo`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `latitude`, `longitude`, `desafiosImplementacaoONG`, `licoesImplementacaoONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constatacoesFeitasFresan`, `recomendacoesPrincipaisFresan`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `nomeGrupoID`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(2, 2, 7, 3, 6, '1', '1', 1, 1, '2023-10-19', '', '2023-11-01', '2023-11-01', 'rosario', 'CUAMM/C2', '1', '1', '\r\n1', '1', '2023-11-01', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(3, 1, 1, 55, 251, '1', '1', 1, 1, '2023-10-25', 'anexo/9Zvf3i5MJ52Zi35TU7hPQ2K4E-b3IXOU.xlsx', '2023-10-25', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '1\r\n', '1', '2023-10-25', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classificacaodocumentoartigo`
--

CREATE TABLE `classificacaodocumentoartigo` (
  `Id` int(11) NOT NULL,
  `NomeClassficacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `classificacaodocumentoartigo`
--

INSERT INTO `classificacaodocumentoartigo` (`Id`, `NomeClassficacao`) VALUES
(1, 'Relatório');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `Id` int(11) NOT NULL,
  `nomeComuna` varchar(100) DEFAULT NULL,
  `municipioID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`Id`, `nomeComuna`, `municipioID`) VALUES
(2, 'Cahama', 13),
(3, 'Chibia', 7),
(4, 'Chibia Sede', 7),
(5, 'Ondjiva', 14),
(6, 'Chibemba', 9),
(7, 'Chibemba Sede', 9),
(10, 'Palanca', 10),
(11, 'Humpata Sede', 10),
(12, 'Bata-Bata', 10),
(13, 'Moçâmedes', 3),
(14, 'Forte Santa Rita', 3),
(17, 'Quilengues', 12),
(20, 'Gambos Sede', 9),
(21, 'Cainde', 5),
(22, 'Virei', 5),
(23, 'Impulo', 12),
(24, 'Humpata', 10),
(27, 'Chiange', 9),
(33, 'Calonga', 16),
(34, 'Mukolongodjo', 16),
(35, 'Mupa', 16),
(36, 'Môngwa', 14),
(38, 'Tchomporo Oximolo', 14),
(39, 'Quê', 8),
(41, '', 9),
(43, 'Naulila', 18),
(44, 'Xangongo', 18),
(45, 'Mucope', 18),
(46, 'Oncócua', 15),
(47, 'Chitado', 15),
(48, 'Curoca', 4),
(53, 'Chingo', 2),
(54, 'Mamué', 2),
(55, 'Bibala', 1),
(56, 'Lola', 1),
(57, 'Capangombe', 1),
(58, 'Caitou', 1),
(73, 'Tômbwa', 4),
(74, 'Cutenda', 8),
(75, 'Otchinjau', 13),
(76, 'Evale', 14),
(77, 'Ombala-yo-Mungo', 18),
(78, 'Humbe', 18),
(79, 'vazia(Actualizar dados)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `culturasprovidas`
--

CREATE TABLE `culturasprovidas` (
  `Id` int(11) NOT NULL,
  `culturaPrevisao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `culturasprovidas`
--

INSERT INTO `culturasprovidas` (`Id`, `culturaPrevisao`) VALUES
(1, 'Hortícolas - Abóbora e Cenoura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demostracoesculinarias`
--

CREATE TABLE `demostracoesculinarias` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `nDemostracaoCulinaria` int(11) DEFAULT NULL,
  `nDemostracaoCulinariaTrimestre` date DEFAULT NULL,
  `beneficiariosDemoCuliHomem` int(11) DEFAULT NULL,
  `beneficiariosDemoCuliMulher` int(11) DEFAULT NULL,
  `anexoEvidenciaDemonsCulinaria` varchar(255) DEFAULT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesImplementacaoONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(100) DEFAULT NULL,
  `constatacoesFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoesPrincipaisFresan` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(50) DEFAULT NULL,
  `nomeGrupoID` int(11) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Validado','Publicado','Aprovado','Pendente') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `demostracoesculinarias`
--

INSERT INTO `demostracoesculinarias` (`Id`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `nDemostracaoCulinaria`, `nDemostracaoCulinariaTrimestre`, `beneficiariosDemoCuliHomem`, `beneficiariosDemoCuliMulher`, `anexoEvidenciaDemonsCulinaria`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `latitude`, `longitude`, `desafiosImplementacaoONG`, `licoesImplementacaoONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constatacoesFeitasFresan`, `recomendacoesPrincipaisFresan`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `nomeGrupoID`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(5, 1, 1, 55, 251, 1, '2023-10-13', 1, 1, NULL, '2024-06-13', '2023-10-07', 'rosario', 'CUAMM/C2', '1', '1', '', '', '2024-06-05', '1', '', '', '', '', NULL, 10, 'Validado', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(6, 1, 1, 55, 251, 1, '2023-09-29', 1, 1, NULL, '2023-10-25', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '', '', '2023-09-28', '1', '', '', '', '', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(7, 1, 1, 55, 251, NULL, '2023-10-13', 1, 1, NULL, '2023-10-25', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '111', '11', '2023-10-25', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(8, 1, 1, 55, 251, 1, '2023-10-25', 1, 1, NULL, '2023-10-25', '2023-11-01', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-11-01', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(10, 1, 1, 55, 251, 1, '2023-09-29', 1, 1, NULL, '2023-10-25', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '1\r\n1', '1', '2023-10-25', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(11, 1, 1, 55, 251, 1, '2023-09-29', 1, 1, NULL, '2023-11-08', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '\r\n1', '111', '2023-10-25', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(12, 1, 1, 55, 251, 1, '2023-09-29', 1, 1, '', '2023-11-01', '2023-11-01', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-11-01', '1', '1', '1', '1', '', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(13, 1, 1, 55, 251, 1, '2023-10-25', 1, 1, '', '2023-11-01', '2023-11-01', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-11-01', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(14, 2, 7, 3, 6, 1, '2023-10-25', 1, 1, '', '2023-11-11', '2023-11-01', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-11-01', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(15, 1, 1, 55, 251, 1, '2023-10-12', 1, 1, 'anexoEvidenciaDemonsCulinaria/Onk0Zu9EIC_oaubrIrenMxXw7r-FFoID.png', '2023-11-08', '2023-11-01', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-11-11', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(16, 1, 1, 55, 251, 1, '2023-11-01', 1, 1, '', '2023-11-01', '2024-06-07', 'rosario', 'CUAMM/C2', '1', '1', '\r\n1', '1', '2023-11-11', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(17, 1, 1, 55, 251, 1, '2023-11-01', 1, 1, 'anexoEvidenciaDemonsCulinaria/YmGgKNpQi_lF5k5gLuBQNKVCO2cIUXa1.png', '2023-11-01', '2023-11-01', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-11-01', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(18, 1, 1, 55, 251, 1, '2023-10-25', 1, 1, 'anexoEvidenciaDemonsCulinaria/Imu_vM0JJOMpLKaq_piXR6JR8VoGQbVY.xlsx', '2023-10-25', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '\r\n1\r\n', '1', '2024-06-07', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(19, 1, 1, 55, 251, 1, '2023-10-25', 1, 1, 'anexoEvidenciaDemonsCulinaria/cUNlkw9CnQCqEYxITX4KNKPuqPwq9uoE.png', '2023-10-25', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2024-06-07', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doccomunicacao`
--

CREATE TABLE `doccomunicacao` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `primeiroReporte` date NOT NULL,
  `actualizacao` date NOT NULL,
  `repondente` varchar(255) DEFAULT NULL,
  `entidade` enum('ADESPOV/C4','ADPP/C1','ADRA/C4','CODESPA/C2','COSPE/C1','CUAMM/C4','DW/C1','DW/C4','FEC/C2','FEC/C4','NCA/C1','NCA/C4','PIN/C4','TESE/C4','UIC','WVI/C1','WVI/C4') NOT NULL,
  `actividade` varchar(50) NOT NULL,
  `classificacaoDocumentoID` int(11) NOT NULL,
  `nomeDocumentoArtigo` varchar(255) DEFAULT NULL,
  `areaTematica` varchar(50) NOT NULL,
  `descricaoDocumentoArtigo` text DEFAULT NULL,
  `audienciaProduto` varchar(50) DEFAULT NULL,
  `qtdTotalProduto` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `dataConclusao` date DEFAULT NULL,
  `documentoDisponivel` enum('Sim','Não') DEFAULT NULL,
  `documentoCumpreNormasPublicacao` varchar(3) DEFAULT NULL,
  `documentoValidado` varchar(3) DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  `hiperlink` varchar(1000) DEFAULT NULL,
  `desafiosImplementacao` text DEFAULT NULL,
  `licoesAprendidas` text DEFAULT NULL,
  `dataMonitoria` date DEFAULT NULL,
  `tecnicoResponsavel` varchar(50) DEFAULT NULL,
  `recomendacoes` text DEFAULT NULL,
  `estadoCumprimento` varchar(50) DEFAULT NULL,
  `medidasMitigacaoONG` text DEFAULT NULL,
  `medidasMitigacaoEstado` text DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doccomunicacao`
--

INSERT INTO `doccomunicacao` (`Id`, `provinciaID`, `municipioID`, `primeiroReporte`, `actualizacao`, `repondente`, `entidade`, `actividade`, `classificacaoDocumentoID`, `nomeDocumentoArtigo`, `areaTematica`, `descricaoDocumentoArtigo`, `audienciaProduto`, `qtdTotalProduto`, `estado`, `dataConclusao`, `documentoDisponivel`, `documentoCumpreNormasPublicacao`, `documentoValidado`, `anexo`, `hiperlink`, `desafiosImplementacao`, `licoesAprendidas`, `dataMonitoria`, `tecnicoResponsavel`, `recomendacoes`, `estadoCumprimento`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`) VALUES
(3, 2, 7, '2023-10-11', '2023-10-18', 'rosario', 'UIC', 'Actividade 1', 1, 'Documento1', 'varchar(50)', '', 'dew', 12, 'varchar(30)', '2023-10-25', 'Sim', '', '', 'anexo/ComunicacaoArtigo3qFy4ykTEaTR5tlhx53hR8_5cK__eD3H_20231015151012.xls', '', 'nenhum', 'nenhum', '2023-09-29', 'tecnico', 'nenum', NULL, NULL, 'nenhuma', 10, 'Publicado'),
(4, 3, 13, '2023-10-17', '2023-10-11', 'rosario', 'UIC', '233r', 1, 'efdfv', 'varchar(50)', 'frew', '32r', 10, 'varchar(30)', '2023-10-10', 'Sim', '', '', 'anexo/ComunicacaoArtigoNKlOtZk39jYbIX0V2Jkw9Xm2vjbbA0Ce_20231015124040.xls', 'htpps', '', '', NULL, '', '', NULL, NULL, '', 10, ''),
(6, 1, 1, '2023-10-28', '2023-10-27', 'rosario', '', 'Activity', 1, '', 'varchar(50)', '', '', 3, '', '2023-10-21', '', '', '', 'anexo/ComunicacaoArtigovKHp5GbdN4A3cgbesTJUT9yfp_aeOSua_20231015112331.doc', '', '', '', NULL, '', '', NULL, NULL, '', 10, ''),
(8, 2, 7, '2023-10-19', '2023-10-22', 'rosario', '', 'Activity', 1, '', 'varchar(50)', '', '', NULL, '', NULL, '', '', '', 'anexo/ComunicacaoArtigoP2EVjQk9KHl67WkhKZOJLAQX6oRVZ35Z_20231015114707.pdf', '', '', '', NULL, '', '', NULL, NULL, '', 10, ''),
(9, 2, 7, '2023-10-27', '2023-10-19', 'rosario', '', 'Activity12', 1, '', 'varchar(50)', '', '', 2, '', '2023-10-22', 'Sim', '', '', '', '', '', '', NULL, '', '', NULL, NULL, '', 10, ''),
(10, 1, 2, '2023-10-27', '2023-10-25', 'rosario', '', 'Activity3', 1, '', 'varchar(50)', '', '', NULL, '', NULL, '', '', '', 'anexo/-u6eEo9dEOEf2hkSYCDbJKLxKnrFTMDq.pdf', '', '', '', NULL, '', '', NULL, NULL, '', 10, ''),
(11, 1, 3, '2023-10-27', '2023-10-18', 'rosario', '', 'Activity4', 1, '', 'varchar(50)', '', '', 10, '', NULL, '', '', '', 'anexo/eZlR-HEJ7OHr6xdxfRe-9SfiM6Jh4yTE.pdf', '', '', '', NULL, '', '', NULL, NULL, '', 10, ''),
(12, 1, 1, '2023-10-19', '2023-10-26', 'rosario', '', '3ed', 1, '', 'varchar(50)', '', '', 3, '', NULL, '', '', '', 'anexo/A_Sw2gv4jMemoNc38r7x0ChRYWoYmcgi.png', '', '', '', NULL, '', '', NULL, NULL, '', 10, ''),
(13, 1, 2, '2023-11-01', '2023-11-01', 'rosario', 'ADESPOV/C4', '233r', 1, '1', 'varchar(50)', '1', '1', 10, 'varchar(30)', '2023-10-04', 'Não', '', '', 'anexo/MTfMggmklwP425I_r3_mv8zVRVlAVNYC.png', '1', '1', '1', '2023-09-26', '1', '1', NULL, NULL, '1', 10, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `Id` int(11) NOT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` enum('ADESPOV/C4','ADPP/C1','ADRA/C4','CODESPA/C2','COSPE/C1','CUAMM/C4','DW/C1','DW/C4','FEC/C2','FEC/C4','NCA/C1','NCA/C4','PIN/C4','TESE/C4','UIC','WVI/C1','WVI/C4') NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `descricaoTema` varchar(500) DEFAULT NULL,
  `estadoDescricao` varchar(30) DEFAULT NULL,
  `parceiro` varchar(50) DEFAULT NULL,
  `dataRelacionadaEstadForum` date DEFAULT NULL,
  `tematicaAbordada` text DEFAULT NULL,
  `orador` varchar(255) DEFAULT NULL,
  `localLink` varchar(255) DEFAULT NULL,
  `publicoAlvo` varchar(255) DEFAULT NULL,
  `participantesHomem` int(11) DEFAULT NULL,
  `participantesMulher` int(11) DEFAULT NULL,
  `anexoForum` varchar(255) DEFAULT NULL,
  `desafiosONG` varchar(255) DEFAULT NULL,
  `licoesONG` varchar(255) DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(255) DEFAULT NULL,
  `constantacoeFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoes` varchar(255) DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(255) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`Id`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `descricaoTema`, `estadoDescricao`, `parceiro`, `dataRelacionadaEstadForum`, `tematicaAbordada`, `orador`, `localLink`, `publicoAlvo`, `participantesHomem`, `participantesMulher`, `anexoForum`, `desafiosONG`, `licoesONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constantacoeFeitasFresan`, `recomendacoes`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(3, '2023-09-30', '2023-10-27', 'rosario', '', 1, 4, '', '', '', NULL, '', '', '', '', NULL, NULL, '', '', '', NULL, '', '', '', '', '', 10, 'Publicado', 'rosario', 'rosario', '2023-10-16', '2023-10-16'),
(4, '2023-09-29', '2023-09-29', 'rosario', '', 1, 1, '', 'varchar(30)', 'varchar(50)', '2023-09-21', '1', '1', '1', '1', 1, 1, 'anexoForum/sr4FNrcj1sVjG15gpEbxxdqLcEDdXnYD.xlsx', '1', '1', '2023-10-12', '1', '1', '', '1', '1', 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finalidade`
--

CREATE TABLE `finalidade` (
  `Id` int(11) NOT NULL,
  `finalidade` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `finalidade`
--

INSERT INTO `finalidade` (`Id`, `finalidade`) VALUES
(1, 'Consumo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fitofarmacosferramentas`
--

CREATE TABLE `fitofarmacosferramentas` (
  `Id` int(11) NOT NULL,
  `grupoID` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `previsaoCampanha` date NOT NULL,
  `distribuido` int(11) DEFAULT NULL,
  `unidadeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fitofarmacosferramentas`
--

INSERT INTO `fitofarmacosferramentas` (`Id`, `grupoID`, `nome`, `previsaoCampanha`, `distribuido`, `unidadeID`) VALUES
(1353, 132, NULL, '0000-00-00', NULL, 0),
(1354, 132, NULL, '0000-00-00', NULL, 0),
(1355, 132, NULL, '0000-00-00', NULL, 0),
(1356, 132, NULL, '0000-00-00', NULL, 0),
(1357, 132, NULL, '0000-00-00', NULL, 0),
(1358, 132, NULL, '0000-00-00', NULL, 0),
(1359, 132, NULL, '0000-00-00', NULL, 0),
(1360, 132, NULL, '0000-00-00', NULL, 0),
(1361, 132, NULL, '0000-00-00', NULL, 0),
(1362, 132, NULL, '0000-00-00', NULL, 0),
(1363, 132, NULL, '0000-00-00', NULL, 0),
(1364, 132, NULL, '0000-00-00', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `Id` int(11) NOT NULL,
  `primeiroReporte` date NOT NULL,
  `actualizacaoID` date NOT NULL,
  `respondente` varchar(255) NOT NULL,
  `entidade` enum('ADRA/C4','CODESPA/C2','CODESPA/C4','COSPE/C1','CUAMM/C2','CUAMM/C4','FEC/C2','FEC/C4','NCA/C1','UIC') NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `apoioAgricola` varchar(255) NOT NULL,
  `nomeGrupo` varchar(255) DEFAULT NULL,
  `grupoExistia` enum('Sim','Não','','') DEFAULT NULL,
  `metodologiaAgricola` varchar(50) DEFAULT NULL,
  `outraMetodologiaAgricola` varchar(200) DEFAULT NULL,
  `segueMetodologiaECA` enum('Sim','Não','','') DEFAULT NULL,
  `anoInicioApoio` date NOT NULL,
  `primeiroAnoAgriColheita` date DEFAULT NULL,
  `ultimoAnoAgriColheita` date DEFAULT NULL,
  `estagioFaseEncontra` varchar(30) NOT NULL,
  `validadaIDA` enum('Sim','Não') DEFAULT NULL,
  `grupoEntregueEntPubl` enum('Sim','Não') DEFAULT NULL,
  `dataGrupoEntregue` date DEFAULT NULL,
  `anexoAutoEntrega` varchar(255) DEFAULT NULL,
  `primeiraFinalidadeID` int(11) NOT NULL,
  `segundaFinalidadeID` int(11) NOT NULL,
  `terceiraFinalidadeID3` int(11) NOT NULL,
  `beneficiariosHomem` int(11) DEFAULT NULL,
  `beneficiariosMulher` int(11) DEFAULT NULL,
  `listaMembros` enum('Sim','Não') DEFAULT NULL,
  `representaQtsAF` int(11) DEFAULT NULL,
  `bovinos` int(11) DEFAULT NULL,
  `caprinos` int(11) DEFAULT NULL,
  `ovinos` int(11) DEFAULT NULL,
  `temComissaoGestao` enum('Sim','Não','','') DEFAULT NULL,
  `temReguInterno` enum('Sim','Não','','') DEFAULT NULL,
  `temFacilitador` enum('Sim','Não','','') DEFAULT NULL,
  `temParcelasAprendizagem` enum('Sim','Não','','') DEFAULT NULL,
  `temCerco` enum('Sim','Não','','') DEFAULT NULL,
  `temPlacaIdentificacao` enum('Sim','Não','','') DEFAULT NULL,
  `temCadernoRegisto` enum('Sim','Não','','') DEFAULT NULL,
  `contribuicaoFundoManeio` enum('Sim','Não','','') DEFAULT NULL,
  `frequenciaContribuicoes` enum('Sim','Não','','') DEFAULT NULL,
  `membrosContribuemRegular` int(11) DEFAULT NULL,
  `fundoManeioSaldoPositivo` enum('Sim','Não','','') DEFAULT NULL,
  `temPlanoActividade` enum('Sim','Não','','') DEFAULT NULL,
  `frequenciaSessoes` varchar(20) DEFAULT NULL,
  `localReunioes` enum('Sim','Não','','') DEFAULT NULL,
  `implementaASAE` enum('Sim','Não','','') DEFAULT NULL,
  `produzBioInsecticida` enum('Sim','Não','','') DEFAULT NULL,
  `usaBioFertilizante` enum('Sim','Não','','') DEFAULT NULL,
  `integraSistemaAgrosilvopastoril` enum('Sim','Não','','') DEFAULT NULL,
  `numEvenTrocExperCamponeses` int(11) DEFAULT NULL,
  `metodologiaJangosPastoris` enum('Sim','Não','','') DEFAULT NULL,
  `assistTecnApoioProducao` enum('Sim','Não','','') DEFAULT NULL,
  `placaVisibilidade` enum('Sim','Não','','') DEFAULT NULL,
  `autoridadeTradEnvolvida` enum('Sim','Não','','') DEFAULT NULL,
  `administracaoEnvolvida` enum('Sim','Não','','') DEFAULT NULL,
  `isvEnvolvida` enum('Sim','Não','','') DEFAULT NULL,
  `idfEnvolvida` enum('Sim','Não','','') DEFAULT NULL,
  `idaEdaEnvolvida` enum('Sim','Não','','') DEFAULT NULL,
  `iiaEnvolvida` enum('Sim','Não','','') DEFAULT NULL,
  `iivEnvolvida` enum('Sim','Não','','') DEFAULT NULL,
  `outroEnvolvida` varchar(255) DEFAULT NULL,
  `primeiraPraticaInovadora` varchar(50) NOT NULL,
  `segundaPraticaInovadora` varchar(50) NOT NULL,
  `terceiraPraticaInovadora` varchar(50) NOT NULL,
  `replicaPraticaInovadora` enum('Sim','Não','','') DEFAULT NULL,
  `nLavrasPartiReplicaPraticaInovadora` int(11) DEFAULT NULL,
  `principalConstrangimento` varchar(255) DEFAULT NULL,
  `temas` text DEFAULT NULL,
  `tema1Ciclo` varchar(255) DEFAULT NULL,
  `tema2Ciclo` varchar(255) DEFAULT NULL,
  `tema3Ciclo` varchar(255) DEFAULT NULL,
  `outroTema` text DEFAULT NULL,
  `nSessoeTeoPrat` int(11) DEFAULT NULL,
  `nSessoeTeoPratTrimes` date DEFAULT NULL,
  `diaSessaoEca` varchar(20) DEFAULT NULL,
  `percentParticipacao` varchar(20) DEFAULT NULL,
  `areaTotalCampoAgro` float DEFAULT NULL,
  `areaCultivadaCampoAgro` float DEFAULT NULL,
  `areaInsPlantInovadorasCampoAgro` float DEFAULT NULL,
  `pontoAguaDispoIrri` varchar(20) DEFAULT NULL,
  `previstConstrSistIrrig` enum('Sim','Não','','') DEFAULT NULL,
  `sistemaIrriUtilizad` varchar(50) DEFAULT NULL,
  `areaIrrigada` float DEFAULT NULL,
  `classificacacaoCampo` varchar(20) DEFAULT NULL,
  `houveExcedente` enum('Sim','Não','','') DEFAULT NULL,
  `culturasHouveExcedente` varchar(255) DEFAULT NULL,
  `qtdExcedente` float DEFAULT NULL,
  `trimestreExcedente` date DEFAULT NULL,
  `destinoExcedente` varchar(50) DEFAULT NULL,
  `facilitaLigacoesEntreProdutores` enum('Sim','Não','','') DEFAULT NULL,
  `realizaEventosSobreProdutos` varchar(50) DEFAULT NULL,
  `apoioDistrProdCamponeses` enum('Sim','Não','','') DEFAULT NULL,
  `nRedes` int(11) DEFAULT NULL,
  `dataApoios` varchar(255) DEFAULT NULL,
  `tipoEvento` varchar(50) NOT NULL,
  `descricaoRede` text DEFAULT NULL,
  `coberturaGeograficaRede` varchar(50) DEFAULT NULL,
  `comerciantesEnvolvidos` varchar(255) DEFAULT NULL,
  `finalidadeRede` varchar(50) DEFAULT NULL,
  `frequenciaRede` varchar(50) DEFAULT NULL,
  `resultadoInicRede` varchar(50) DEFAULT NULL,
  `desafios` varchar(255) DEFAULT NULL,
  `licoesAprendidas` varchar(255) DEFAULT NULL,
  `temBancoSementes` enum('Sim','Não','','') DEFAULT NULL,
  `fazMultiSementes` enum('Sim','Não','','') DEFAULT NULL,
  `culturasDispoBancSementes` text DEFAULT NULL,
  `qtdSementesEntrBancoKG` int(11) DEFAULT NULL,
  `trimSementesBanco` date DEFAULT NULL,
  `totalSementesEntrCamponeses` float DEFAULT NULL,
  `trimestreSementesEntrCamponeses` date DEFAULT NULL,
  `totalSementesReembPelosCamponeses` float DEFAULT NULL,
  `trimestreSementesReembPelosCamponeses` date DEFAULT NULL,
  `qtdSementesDisponiveisBanco` float DEFAULT NULL,
  `trimestreSementesDisponiveisBanco` date DEFAULT NULL,
  `estadoBancoSementes` varchar(50) DEFAULT NULL,
  `temRegistoBancSementes` varchar(50) DEFAULT NULL,
  `camponesesRecebemSementesBanc` int(11) DEFAULT NULL,
  `camponesesReebolsaSementesBanc` int(11) DEFAULT NULL,
  `resultadIniciBancoSem` varchar(50) DEFAULT NULL,
  `desafiosBancoSem` text DEFAULT NULL,
  `licoesAprendiBancSem` text DEFAULT NULL,
  `classifCooper` varchar(50) DEFAULT NULL,
  `membrCampoAgrFormal` varchar(30) DEFAULT NULL,
  `homemCoop` int(11) DEFAULT NULL,
  `mulherCoop` int(11) DEFAULT NULL,
  `coopExistia` varchar(50) DEFAULT NULL,
  `coopLegalizada` varchar(50) DEFAULT NULL,
  `coopLegalFresan` varchar(50) DEFAULT NULL,
  `tipoApoioDadoProjec` varchar(255) DEFAULT NULL,
  `realizaFormacao` varchar(50) DEFAULT NULL,
  `temaSessoesFormacao` text DEFAULT NULL,
  `nSessoesFormacoes` int(11) DEFAULT NULL,
  `trimesSessoesFormacoes` date DEFAULT NULL,
  `orgaosSociaisDefinidos` varchar(50) DEFAULT NULL,
  `nReunioesOrgSoc` int(11) DEFAULT NULL,
  `nReunioesOrgSocTrimestre` date DEFAULT NULL,
  `membrosFazemContrReg` varchar(50) DEFAULT NULL,
  `coopTemFundoManeioPositivo` enum('Sim','Não','','') DEFAULT NULL,
  `propositoApoiarTransformacao` varchar(50) DEFAULT NULL,
  `realizaTransforDescriProduto` text DEFAULT NULL,
  `propositoApoiarArmazen` varchar(50) DEFAULT NULL,
  `propositoApoiarFactorProd` varchar(50) DEFAULT NULL,
  `propositoApoiarComercializacao` varchar(50) DEFAULT NULL,
  `propositoApoiarMembroCaixaCom` varchar(50) DEFAULT NULL,
  `desafiosCooperativas` text DEFAULT NULL,
  `licoesAprendidasCooperativas` text DEFAULT NULL,
  `tecnologiaProjectoPioto` varchar(50) DEFAULT NULL,
  `nCamponesesHomens` int(11) DEFAULT NULL,
  `nCamponesesMulheres` int(11) DEFAULT NULL,
  `kitClassificacao` varchar(255) DEFAULT NULL,
  `kitDistribuidoDescric` text DEFAULT NULL,
  `nKitEntregue` int(11) DEFAULT NULL,
  `pontoSituacaoProjecto` varchar(50) DEFAULT NULL,
  `comercializacao` varchar(30) DEFAULT NULL,
  `qtdProdComercializadoKG` float DEFAULT NULL,
  `resultadoInicPiloto` varchar(50) DEFAULT NULL,
  `desafiosPiloto` text DEFAULT NULL,
  `licoesAprendidasPiloto` text DEFAULT NULL,
  `realizadaSinsibilizacoesEAN` enum('Sim','Não') DEFAULT NULL,
  `realizadasSensibilizacoesCulinarias` enum('Sim','Não','','') DEFAULT NULL,
  `realizadoRastreios` enum('Sim','Não','','') DEFAULT NULL,
  `desafiosAprendidasONG` int(11) DEFAULT NULL,
  `licoesAprendidasONG` int(11) DEFAULT NULL,
  `dataVisitaUIC` date DEFAULT NULL,
  `tecnicoResponsavelUIC` varchar(50) DEFAULT NULL,
  `constatacoesFeitasUIC` varchar(255) DEFAULT NULL,
  `recomendacoesFeitasUIC` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(50) DEFAULT NULL,
  `medidasMitigacaoEstado` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `estadoValidacao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`Id`, `primeiroReporte`, `actualizacaoID`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `latitude`, `longitude`, `apoioAgricola`, `nomeGrupo`, `grupoExistia`, `metodologiaAgricola`, `outraMetodologiaAgricola`, `segueMetodologiaECA`, `anoInicioApoio`, `primeiroAnoAgriColheita`, `ultimoAnoAgriColheita`, `estagioFaseEncontra`, `validadaIDA`, `grupoEntregueEntPubl`, `dataGrupoEntregue`, `anexoAutoEntrega`, `primeiraFinalidadeID`, `segundaFinalidadeID`, `terceiraFinalidadeID3`, `beneficiariosHomem`, `beneficiariosMulher`, `listaMembros`, `representaQtsAF`, `bovinos`, `caprinos`, `ovinos`, `temComissaoGestao`, `temReguInterno`, `temFacilitador`, `temParcelasAprendizagem`, `temCerco`, `temPlacaIdentificacao`, `temCadernoRegisto`, `contribuicaoFundoManeio`, `frequenciaContribuicoes`, `membrosContribuemRegular`, `fundoManeioSaldoPositivo`, `temPlanoActividade`, `frequenciaSessoes`, `localReunioes`, `implementaASAE`, `produzBioInsecticida`, `usaBioFertilizante`, `integraSistemaAgrosilvopastoril`, `numEvenTrocExperCamponeses`, `metodologiaJangosPastoris`, `assistTecnApoioProducao`, `placaVisibilidade`, `autoridadeTradEnvolvida`, `administracaoEnvolvida`, `isvEnvolvida`, `idfEnvolvida`, `idaEdaEnvolvida`, `iiaEnvolvida`, `iivEnvolvida`, `outroEnvolvida`, `primeiraPraticaInovadora`, `segundaPraticaInovadora`, `terceiraPraticaInovadora`, `replicaPraticaInovadora`, `nLavrasPartiReplicaPraticaInovadora`, `principalConstrangimento`, `temas`, `tema1Ciclo`, `tema2Ciclo`, `tema3Ciclo`, `outroTema`, `nSessoeTeoPrat`, `nSessoeTeoPratTrimes`, `diaSessaoEca`, `percentParticipacao`, `areaTotalCampoAgro`, `areaCultivadaCampoAgro`, `areaInsPlantInovadorasCampoAgro`, `pontoAguaDispoIrri`, `previstConstrSistIrrig`, `sistemaIrriUtilizad`, `areaIrrigada`, `classificacacaoCampo`, `houveExcedente`, `culturasHouveExcedente`, `qtdExcedente`, `trimestreExcedente`, `destinoExcedente`, `facilitaLigacoesEntreProdutores`, `realizaEventosSobreProdutos`, `apoioDistrProdCamponeses`, `nRedes`, `dataApoios`, `tipoEvento`, `descricaoRede`, `coberturaGeograficaRede`, `comerciantesEnvolvidos`, `finalidadeRede`, `frequenciaRede`, `resultadoInicRede`, `desafios`, `licoesAprendidas`, `temBancoSementes`, `fazMultiSementes`, `culturasDispoBancSementes`, `qtdSementesEntrBancoKG`, `trimSementesBanco`, `totalSementesEntrCamponeses`, `trimestreSementesEntrCamponeses`, `totalSementesReembPelosCamponeses`, `trimestreSementesReembPelosCamponeses`, `qtdSementesDisponiveisBanco`, `trimestreSementesDisponiveisBanco`, `estadoBancoSementes`, `temRegistoBancSementes`, `camponesesRecebemSementesBanc`, `camponesesReebolsaSementesBanc`, `resultadIniciBancoSem`, `desafiosBancoSem`, `licoesAprendiBancSem`, `classifCooper`, `membrCampoAgrFormal`, `homemCoop`, `mulherCoop`, `coopExistia`, `coopLegalizada`, `coopLegalFresan`, `tipoApoioDadoProjec`, `realizaFormacao`, `temaSessoesFormacao`, `nSessoesFormacoes`, `trimesSessoesFormacoes`, `orgaosSociaisDefinidos`, `nReunioesOrgSoc`, `nReunioesOrgSocTrimestre`, `membrosFazemContrReg`, `coopTemFundoManeioPositivo`, `propositoApoiarTransformacao`, `realizaTransforDescriProduto`, `propositoApoiarArmazen`, `propositoApoiarFactorProd`, `propositoApoiarComercializacao`, `propositoApoiarMembroCaixaCom`, `desafiosCooperativas`, `licoesAprendidasCooperativas`, `tecnologiaProjectoPioto`, `nCamponesesHomens`, `nCamponesesMulheres`, `kitClassificacao`, `kitDistribuidoDescric`, `nKitEntregue`, `pontoSituacaoProjecto`, `comercializacao`, `qtdProdComercializadoKG`, `resultadoInicPiloto`, `desafiosPiloto`, `licoesAprendidasPiloto`, `realizadaSinsibilizacoesEAN`, `realizadasSensibilizacoesCulinarias`, `realizadoRastreios`, `desafiosAprendidasONG`, `licoesAprendidasONG`, `dataVisitaUIC`, `tecnicoResponsavelUIC`, `constatacoesFeitasUIC`, `recomendacoesFeitasUIC`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`) VALUES
(132, '2023-10-26', '2023-10-18', 'rosario', 'CUAMM/C2', 1, 1, 55, 251, '', '', 'varchar(255)', 'Tukondjeni Kalombe ', 'Sim', 'varchar(50)', 'varchar(200)', 'Sim', '0000-00-00', NULL, NULL, 'varchar(30)', 'Sim', 'Sim', NULL, '', 1, 1, 1, 1, 1, 'Sim', 1, 1, 1, 1, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Sim', 'varchar(20)', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 1, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', '1', 'varchar(50)', 'varchar(50)', 'varchar(50)', 'Sim', 1, '1', '1', '1', '1', '1', '1', 1, NULL, '1', '1', 1, 1, 1, 'varchar(20)', 'Sim', 'varchar(50)', 1, 'varchar(20)', 'Sim', '1', 1, NULL, 'varchar(50)', 'Sim', 'varchar(50)', 'Não', 1, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'Não', 'Sim', '1', 1, NULL, 1, NULL, 1, NULL, 1, NULL, 'varchar(50)', 'varchar(50)', 1, 1, 'varchar(50)', '1', '1', 'varchar(50)', 'varchar(30)', 1, 1, 'varchar(50)', 'varchar(50)', 'varchar(50)', 'varchar(255)', 'varchar(50)', '1', 1, NULL, 'varchar(50)', 1, NULL, 'varchar(50)', 'Não', 'varchar(50)', '1', 'varchar(50)', 'varchar(50)', 'varchar(50)', 'varchar(50)', '1', '1', 'varchar(50)', 1, 1, '1', '1', 1, 'varchar(50)', '1', 1, 'varchar(50)', '1', '1', 'Sim', 'Sim', 'Não', 1, 1, NULL, '1', '1', '1', '1', 1, 10, 'Validado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumogrupo`
--

CREATE TABLE `insumogrupo` (
  `Id` int(11) NOT NULL,
  `grupoID` int(11) NOT NULL,
  `culturasID` int(11) NOT NULL,
  `campanhaPrevisaoAbobora` int(11) NOT NULL,
  `cultDistr` int(11) DEFAULT NULL,
  `trimestreCulturaDistr` date DEFAULT NULL,
  `culturaColheita` int(11) DEFAULT NULL,
  `trimestreCultColheita` date DEFAULT NULL,
  `destinoCultColheita` varchar(50) NOT NULL,
  `culturaBiofortificada` enum('Sim','Não','','') DEFAULT NULL,
  `unidadeID` int(11) NOT NULL,
  `quantasVingaram` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `insumogrupo`
--

INSERT INTO `insumogrupo` (`Id`, `grupoID`, `culturasID`, `campanhaPrevisaoAbobora`, `cultDistr`, `trimestreCulturaDistr`, `culturaColheita`, `trimestreCultColheita`, `destinoCultColheita`, `culturaBiofortificada`, `unidadeID`, `quantasVingaram`) VALUES
(1345, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1346, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1347, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1348, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1349, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1350, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1351, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1352, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1353, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1354, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1355, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL),
(1356, 132, 0, 0, NULL, NULL, NULL, NULL, '', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidade`
--

CREATE TABLE `localidade` (
  `Id` int(11) NOT NULL,
  `nomeLocalidade` varchar(100) DEFAULT NULL,
  `comunaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `localidade`
--

INSERT INTO `localidade` (`Id`, `nomeLocalidade`, `comunaID`) VALUES
(5, 'Tyityongombe', 2),
(6, 'Hacavamba', 3),
(7, 'Mulola', 2),
(8, 'Mupapa', 2),
(9, 'Munhandi', 2),
(10, 'Mercado Municipal', 2),
(11, 'Liambinga', 2),
(12, 'Ediva', 2),
(13, 'Ompupa', 2),
(14, 'Mbome', 2),
(15, 'Caholo', 2),
(16, 'Ngando (2 cisternas)', 2),
(17, 'Tangandiva (Uia)', 2),
(18, 'Oifidi', 5),
(19, 'Caculuvale', 5),
(20, 'Okambadi', 5),
(21, 'Outekelo', 5),
(22, 'Hihiambo', 5),
(23, 'Ufitu Unene', 5),
(24, 'Ompanda 1', 6),
(25, 'Tchipeio 1', 6),
(26, 'Garanja 1', 6),
(27, 'Garanja 2', 6),
(28, 'Garanja 3', 6),
(29, 'Tchitunto', 6),
(30, 'Caquete', 6),
(31, 'Vienga', 6),
(32, 'Cantiate /Ompapa 1', 6),
(33, 'Sambua 1', 6),
(34, 'Noncombo 1', 6),
(35, 'Tumba', 6),
(36, 'Rio de Areia/ Nanungo', 6),
(37, 'Ompanda 1.1', 6),
(38, 'Tchipeio 1.1', 6),
(39, 'Cantiate /Ompapa 1.1', 6),
(40, 'Capeu I', 6),
(41, 'Capeu II', 6),
(42, 'Sambua 1.1', 6),
(43, 'Noncombo 1.1', 6),
(44, 'Canhele 1', 6),
(45, 'Canhele 1.1', 6),
(46, 'Tchinemawe', 6),
(47, 'Capelete 4', 6),
(48, 'Imbica 1', 6),
(49, 'Imbica 1.1', 6),
(50, 'Inbica II', 6),
(51, 'Tchioco 1', 6),
(52, 'Tchioco 1.1', 6),
(53, 'Lupembe 1', 6),
(54, 'Capeu 04', 6),
(55, 'Katunda', 6),
(56, 'Capeu 3 Isaura', 6),
(57, 'Caila', 6),
(58, 'Mapupo', 6),
(59, 'Kaheque', 6),
(60, 'Malambi 1', 12),
(61, 'Malambi 1.1', 12),
(62, 'Lukoto 1', 12),
(63, 'Lukoto 1.1', 12),
(64, 'Chipulo 1', 12),
(65, 'Chipulo 1.1', 12),
(66, 'Malambi 2', 12),
(67, 'Lukoto 2', 12),
(68, 'Malambi 2.1', 12),
(69, 'Chipulo 2', 12),
(70, 'Omutcha Yo Ndumbu 1', 12),
(71, 'Omutcha Yo Ndumbu 1.1', 12),
(72, 'Embandi 1', 12),
(73, 'Embandi 1.1', 12),
(74, 'Matatayala 1', 12),
(75, 'Matatayala 1.1', 12),
(76, 'Ndjambi', 12),
(77, 'Ndundualumbe', 12),
(78, 'Vifolo', 12),
(79, 'Tchiango', 12),
(80, 'Tchiango/Catemo', 12),
(81, 'Mambande', 12),
(82, 'Vifolo', 12),
(83, 'Valódia', 13),
(84, 'Giraul do meio (Kaleva)', 14),
(85, 'Giraúl de Cima', 14),
(86, 'Aida', 14),
(87, 'Cambongue', 14),
(88, 'Saco Mar', 14),
(89, 'Tchicueya', 21),
(90, 'Sayona', 21),
(91, 'Vitumba II', 22),
(92, 'Cavelocamue 1', 22),
(93, 'Cavelocamue 2', 22),
(94, 'Kuiti Kuiti', 22),
(95, 'Cavelocamue', 22),
(96, '23/Sede', 23),
(97, 'Tchitaqui-Baixo', 23),
(98, 'Tepa', 23),
(99, 'Camucua', 23),
(100, 'Ruival', 24),
(101, 'Tunda II Associação 1', 27),
(102, 'Tunda II Associação 1.1', 27),
(103, 'Tunda/Nkaingongo', 27),
(104, 'Tunda II Comunidade', 27),
(105, 'Capelete 1', 27),
(106, 'Macaca 1', 27),
(107, 'Macaca 1.1', 27),
(108, 'Tchindjangue 1', 27),
(109, 'Tchindjangue 1.1', 27),
(110, 'Tchindjangue 2', 27),
(111, 'Tchindjangue 2.1', 27),
(112, 'Nhampala', 27),
(113, 'Lundje 1', 27),
(114, 'Lundje 1.1', 27),
(115, 'Mulimbi 1', 27),
(116, 'Mulimbi 1.1', 27),
(117, 'Capelete 3', 27),
(118, 'Capelete 2', 27),
(119, 'Kamuxixi 1', 27),
(120, 'Tchopocati 1', 27),
(121, 'Tchopocati 1.1', 27),
(122, 'Kamuxixi 1.1', 27),
(123, 'Tchioco Praça', 27),
(124, 'Tintim 1', 27),
(125, 'Tintim 1.1', 27),
(126, 'Nhampala escola', 27),
(127, 'Tchioco comunidade', 27),
(128, 'Ndjehi Nompawe 1', 27),
(129, 'Ndjehi Nompawe 1.1', 27),
(130, 'Tunda II/Evaristo', 27),
(131, 'Capunda', 27),
(132, 'Capelete 05', 27),
(133, 'Tchioco 3', 27),
(134, 'Chiange velho 1', 27),
(135, 'Chiange velho 2', 27),
(136, 'Tchileva', 27),
(137, 'Ndumbo/Minkete', 27),
(138, 'Nondjelo', 27),
(139, 'Nhampala Ndjimbe', 27),
(140, 'Ntiaty', 27),
(141, 'Lupembe 2', 27),
(142, 'Capelete 07', 27),
(143, 'Capete 08', 27),
(144, 'Lundje 2/ Policia', 27),
(145, 'Capelete 06', 27),
(146, 'Omutuovacai', 27),
(147, 'Tunda Sr. Fernando', 27),
(148, 'Vicungo', 33),
(149, 'Ngando Yhekuka', 33),
(150, 'Uela', 33),
(151, 'Mpongokua', 33),
(152, 'Ngando Ilaula', 33),
(153, 'Munquete', 33),
(154, 'Kelendende', 34),
(155, 'Catocatoca', 34),
(156, 'Tchikolomuenho', 34),
(157, 'Macova', 34),
(158, 'Maúvi', 34),
(159, 'Etomba', 34),
(160, 'Munhongono', 34),
(161, 'Mui Naitolo', 34),
(162, 'Sendje', 34),
(163, 'Ndombeheke', 34),
(164, 'Ndeleme 2', 34),
(165, 'Hoje-Ya-Henda', 34),
(166, 'Nanhanga', 34),
(167, 'Helder Neto', 34),
(168, 'Mbamby', 34),
(169, 'Meva-Yela', 34),
(170, 'Muoongo', 35),
(171, 'Missao da Mupa', 35),
(172, 'Nahuyala', 35),
(173, 'Oshanyongo', 35),
(174, 'Okamudi', 35),
(175, 'Mongua Omafuma', 36),
(176, 'Mongua Woongo', 36),
(177, 'Mwoolo 1', 36),
(178, 'Onghaya-Ohenghaly', 36),
(179, 'Ohamafo Ominda I', 36),
(180, 'Okokola', 38),
(181, 'Okafima', 38),
(182, 'Okahumba', 38),
(183, 'Etala', 39),
(184, 'Mbanga-Nguendji', 39),
(185, 'Tchavindilica', 39),
(186, 'Ndlindinda', 39),
(187, 'Chicomba velha', 39),
(188, 'Caliongo II', 39),
(189, 'Mumbonde', 43),
(190, 'Okapika 1', 43),
(191, 'Naulila-sede 1', 43),
(192, 'Tchipeque', 43),
(193, 'Canconda 1', 43),
(194, 'Tchipulu 1', 43),
(195, '4 de Abril', 43),
(196, 'Calueque Portão', 43),
(197, 'Nombunda', 43),
(198, 'Mixa', 43),
(199, 'Kankonda', 43),
(200, 'Evanda - bairro do Evanda 2 (2 cisternas)', 43),
(201, 'Oupalé 01', 44),
(202, 'Oupalé 02', 44),
(203, 'Oupalé 04', 44),
(204, 'Cafu Tchipeke', 44),
(205, 'Cafu Sede', 44),
(206, 'Kapanda', 44),
(207, 'Shangalala', 44),
(208, 'PS Chica', 45),
(209, 'PS Ekamba', 45),
(210, 'PS Mussive', 45),
(211, 'Nangombe I', 45),
(212, 'Nangombe II', 45),
(213, 'Chiúlo', 45),
(214, 'Kolondjo II', 45),
(215, 'Onkango', 45),
(216, 'Kassandja', 45),
(217, 'Finda Ya-holo', 45),
(218, 'Cambunda', 45),
(219, 'Epango', 45),
(220, 'Nkolonjo 1', 45),
(221, 'Oncocua-sede-Escola', 46),
(222, 'Oncocua-sede', 46),
(223, 'Oncocua sede hospital', 46),
(224, 'Katavento', 46),
(225, 'Oncocua Zona Verde', 46),
(226, 'Capapa', 46),
(227, 'Warú', 46),
(228, 'Warú-Caumbamenhe zona de transumância', 46),
(229, 'Canuno', 46),
(230, 'Elovalinde', 46),
(231, 'Erola', 46),
(232, 'Mahini', 46),
(233, 'Camue', 46),
(234, 'Erola', 46),
(235, 'Kewe', 46),
(236, 'Mbembahi', 46),
(237, 'Hangumbi', 47),
(238, 'Lombombo', 47),
(239, 'Tcholofeu', 47),
(240, 'Kailona', 47),
(241, 'Okutanga', 47),
(242, 'Omivapo', 47),
(243, 'Tapela', 47),
(244, 'Mpalanga', 47),
(245, '15', 48),
(246, 'Citete', 48),
(247, 'Matocua', 53),
(248, 'Chingo Sede', 53),
(249, 'Mucuio Upopia', 54),
(250, 'Mayanja', 54),
(251, 'Muntipa', 55),
(252, 'Quilemba', 55),
(253, 'Cheila', 55),
(254, 'Panguelo', 56),
(255, 'Tchituntu', 56),
(256, 'Muhambamena', 56),
(257, 'Lohamwe', 56),
(258, 'Nascente', 57),
(259, 'Munhino', 57),
(260, 'Bombo', 57),
(261, 'Mumanga', 58),
(262, 'Liocombambo', 58),
(263, 'Pinda Paiva', 73),
(264, 'Cambandje', 74),
(265, 'Thalanga', 75),
(266, 'Nongondi Tchifindi II', 75),
(267, 'Canhimei', 75),
(268, 'Tapaila', 75),
(269, 'Nandjimba', 75),
(270, 'Okalonga', 75),
(271, 'Oshamala', 76),
(272, 'Mbudo Itwima', 76),
(273, 'OHAMUIFI', 77),
(274, 'ODISHANA', 77),
(275, 'OMUNDJAVALA', 77),
(276, 'OKAKU SEDE', 77),
(277, 'OSOODJI', 77),
(278, 'ONAITYAPWILO', 77),
(279, 'ONDJIBI 1', 77),
(280, 'ONDJIBI 2', 77),
(281, 'OMUPALALA', 77),
(282, 'Ondeitotela (2 cisternas)', 77),
(283, 'Ongobehonga (2 cisternas)', 77),
(284, 'Oshahuyo (2 cisternas)', 77),
(285, 'Omupaya (2 cisternas)', 77),
(286, 'Osheitekela', 77),
(287, 'Ohakeke (2 cisternas)', 77),
(288, 'Evanda 1 (2 cisternas)', 77),
(289, 'UIA sede (4 cisternas)', 77),
(290, 'Odeitotela(bairro Oshandi 2 cisternas)', 77),
(291, 'Oshahuyo (bairro do Okapapa 2 cisternas)', 77),
(292, 'Luhenge', 78),
(293, 'Namukulungo', 78),
(294, 'Mahenge -ya-Mukulo', 78),
(295, 'Ohenda', 78),
(296, 'Epembe', 78),
(297, 'Mundjavala', 78),
(298, 'PS Nimba Tchiholo', 78),
(299, 'Tchandi-Lunhandi', 78),
(300, 'Tengano', 78),
(301, 'Tchissana', 78),
(302, 'Tchiavana', 78),
(303, 'Nengediva', 78),
(304, 'Tchimanha', 78),
(305, 'Giraúl de Baixo', 14),
(306, 'Muntchaulua', 27),
(307, 'Mufaula', 34),
(308, 'VAZIA(Actualizar dados)', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiais`
--

CREATE TABLE `materiais` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `entidadeRecebeuEntPub` varchar(50) DEFAULT NULL,
  `equipamentoEntregue` varchar(255) DEFAULT NULL,
  `qtdEquipEntregues` int(11) DEFAULT NULL,
  `nFitaMUACmenor5anos` int(11) DEFAULT NULL,
  `nFitaMUACmulherGravida` int(11) DEFAULT NULL,
  `fitasPerCefalico` int(11) DEFAULT NULL,
  `balancaPediatrica` int(11) DEFAULT NULL,
  `balancaAdultas` int(11) DEFAULT NULL,
  `altimetro` int(11) DEFAULT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesImplementacaoONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(100) DEFAULT NULL,
  `constatacoesFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoesPrincipaisFresan` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiais`
--

INSERT INTO `materiais` (`Id`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `entidadeRecebeuEntPub`, `equipamentoEntregue`, `qtdEquipEntregues`, `nFitaMUACmenor5anos`, `nFitaMUACmulherGravida`, `fitasPerCefalico`, `balancaPediatrica`, `balancaAdultas`, `altimetro`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `latitude`, `longitude`, `desafiosImplementacaoONG`, `licoesImplementacaoONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constatacoesFeitasFresan`, `recomendacoesPrincipaisFresan`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(2, 1, 1, 55, 251, 'varchar(50)', '1', 1, 1, 1, 1, 1, 1, 1, '2023-10-25', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '11', '1', '2023-10-25', '1', '1', '1', '1', '1', 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `merendaescolar`
--

CREATE TABLE `merendaescolar` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `nTotalCestas` int(11) DEFAULT NULL,
  `nTotalCestasTrimestre` date DEFAULT NULL,
  `nomeEscolaMerendaEscolar` varchar(255) DEFAULT NULL,
  `nMeredendaEscolarHomem` int(11) DEFAULT NULL,
  `nMeredendaEscolarMulher` int(11) DEFAULT NULL,
  `anexoTermoEntregaMerendaEscolar` varchar(255) DEFAULT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesImplementacaoONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(100) DEFAULT NULL,
  `constatacoesFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoesPrincipaisFresan` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `merendaescolar`
--

INSERT INTO `merendaescolar` (`Id`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `nTotalCestas`, `nTotalCestasTrimestre`, `nomeEscolaMerendaEscolar`, `nMeredendaEscolarHomem`, `nMeredendaEscolarMulher`, `anexoTermoEntregaMerendaEscolar`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `latitude`, `longitude`, `desafiosImplementacaoONG`, `licoesImplementacaoONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constatacoesFeitasFresan`, `recomendacoesPrincipaisFresan`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(2, 1, 1, 55, 251, 2, '2023-11-01', '1', 1, 1, '', '2023-11-01', '2023-11-01', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-11-01', '1', '1', '1', '1', '1', 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(3, 1, 1, 55, 251, 1, '2023-10-25', '1', 1, 1, 'anexoTermoEntregaMerendaEscolar/E5EF7TWT6EgpG3c7qcXvpa_p6TvUXY7t.xlsx', '2023-10-25', '2023-10-25', 'rosario', 'CUAMM/C2', '', '1', '\r\n1', '\r\n1', '2023-10-25', '1', '1', '1', '1', '1', 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meta`
--

CREATE TABLE `meta` (
  `Id` int(11) NOT NULL,
  `nomeMeta` varchar(255) NOT NULL,
  `tipoMetaID` int(11) NOT NULL,
  `valorMeta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `meta`
--

INSERT INTO `meta` (`Id`, `nomeMeta`, `tipoMetaID`, `valorMeta`) VALUES
(1, 'ECA', 1, 60000),
(2, 'camponeses apoiados', 1, 18375),
(3, 'participantes formacao apoio agricultores', 1, 324),
(4, 'participantes formacao apoio familias', 1, 7000),
(5, 'beneficiarios de transferencias sociais', 3, 2000),
(6, 'pequenas infra-estruturas', 3, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `Id` int(11) NOT NULL,
  `nomeMunicipio` varchar(100) DEFAULT NULL,
  `provinciaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`Id`, `nomeMunicipio`, `provinciaID`) VALUES
(1, 'Bibala', 1),
(2, 'Camucuio', 1),
(3, 'Moçamedes', 1),
(4, 'Tombua', 1),
(5, 'Virei', 1),
(7, 'Chibia', 2),
(8, 'Chicomba', 2),
(9, 'Gambos', 2),
(10, 'Humpata', 2),
(11, 'Jamba', 2),
(12, 'Quilengues', 2),
(13, 'Cahama', 3),
(14, 'Cuanhama', 3),
(15, 'Curoca', 3),
(16, 'Cuvelai', 3),
(17, 'Namacunde', 3),
(18, 'Ombandja', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacotepedagfresan`
--

CREATE TABLE `pacotepedagfresan` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `receitaMwangole` varchar(50) DEFAULT NULL,
  `painelAlimentacao` varchar(50) DEFAULT NULL,
  `outroManualAlimentacao` varchar(255) DEFAULT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesImplementacaoONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(100) DEFAULT NULL,
  `constatacoesFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoesPrincipaisFresan` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacotepedagfresan`
--

INSERT INTO `pacotepedagfresan` (`Id`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `receitaMwangole`, `painelAlimentacao`, `outroManualAlimentacao`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `latitude`, `longitude`, `desafiosImplementacaoONG`, `licoesImplementacaoONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constatacoesFeitasFresan`, `recomendacoesPrincipaisFresan`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(1, 2, 7, 3, 5, '1', 'varchar(50)', '1', '2023-10-19', '2023-10-11', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-10-19', '1', '1', '1', '1', '1', 10, 'Publicado', 'rosario', 'rosario', '2023-10-16', '2023-10-16'),
(2, 1, 1, 55, 251, '1', 'varchar(50)', '1', '2023-10-19', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-10-25', '1', '1', '1', '1', '1', 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `praticainovadora`
--

CREATE TABLE `praticainovadora` (
  `Id` int(11) NOT NULL,
  `praticaInovadora` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profissionaissaude`
--

CREATE TABLE `profissionaissaude` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `nomeFormacao` varchar(50) DEFAULT NULL,
  `NTotHoras` int(11) DEFAULT NULL,
  `NSessoes` int(11) DEFAULT NULL,
  `NSessoesTrimestre` date DEFAULT NULL,
  `ParticipantesTrimHomem` int(11) DEFAULT NULL,
  `ParticipantesTrimMulher` int(11) DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesImplementacaoONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(100) DEFAULT NULL,
  `constatacoesFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoesPrincipaisFresan` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profissionaissaude`
--

INSERT INTO `profissionaissaude` (`Id`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `nomeFormacao`, `NTotHoras`, `NSessoes`, `NSessoesTrimestre`, `ParticipantesTrimHomem`, `ParticipantesTrimMulher`, `anexo`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `latitude`, `longitude`, `desafiosImplementacaoONG`, `licoesImplementacaoONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constatacoesFeitasFresan`, `recomendacoesPrincipaisFresan`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(3, 1, 1, 55, 251, '1', 1, 1, '2023-10-20', 1, 1, '', '2023-10-26', '2023-10-19', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-10-26', '1', '1', '1', '1', '1', 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(4, 1, 1, 55, 251, '1', 1, 1, '2023-10-25', 1, 1, 'anexo/qjzS-BhP5O_cmXlDpowoqVgnz7tVuzjd.xlsx', '2024-06-07', '2024-06-07', 'rosario', 'CUAMM/C2', '1', '1', '1', '11\r\n', '2023-10-25', '1', '1', '1', '1', '1', 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `Id` int(11) NOT NULL,
  `nomeProvincia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`Id`, `nomeProvincia`) VALUES
(1, 'Namibe'),
(2, 'Huila'),
(3, 'Cunene');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rastreio`
--

CREATE TABLE `rastreio` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `DAS` int(11) DEFAULT NULL,
  `DAM` int(11) DEFAULT NULL,
  `EDEMA` int(11) DEFAULT NULL,
  `Saudavel` int(11) DEFAULT NULL,
  `trimestre` date DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  `beneficiarioCriaGrav` int(11) DEFAULT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesImplementacaoONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(100) DEFAULT NULL,
  `constatacoesFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoesPrincipaisFresan` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(50) DEFAULT NULL,
  `nomeGrupoID` int(11) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rastreio`
--

INSERT INTO `rastreio` (`Id`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `DAS`, `DAM`, `EDEMA`, `Saudavel`, `trimestre`, `anexo`, `beneficiarioCriaGrav`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `latitude`, `longitude`, `desafiosImplementacaoONG`, `licoesImplementacaoONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constatacoesFeitasFresan`, `recomendacoesPrincipaisFresan`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `nomeGrupoID`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(5, 1, 1, 55, 251, 1, 1, 1, 1, '2023-10-25', '', 1, '2023-10-04', '2023-11-02', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-10-12', '1', '1', '1', '1', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25'),
(6, 1, 1, 55, 251, 1, 1, 1, 1, '2023-10-25', 'anexo/-r7XYAdK2ryR0jK4dgl9gVqG2CjL-hrb.docx', 1, NULL, '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-10-25', '1', '1', '1', '11', '1', NULL, 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reforcoinstitucional`
--

CREATE TABLE `reforcoinstitucional` (
  `Id` int(11) NOT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` enum('ADRA/C4','CODESPA/C2','CODESPA/C4','COSPE/C1','CUAMM/C2','CUAMM/C4','FEC/C2','FEC/C4','NCA/C1','UIC') NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `entidadeApoiada` enum('Administrações Municipais','DNSA','EEAN','EZC','Governo Municipal','IDA','IDA, Administração comunal de Oshimolo, Administração comunal de Evale, Administração comunal de Mupa','IDF','INAMET','ISV') NOT NULL,
  `apoioCapacitacao` text NOT NULL,
  `temaAbordadoSessoes` text DEFAULT NULL,
  `nSessoesPublicoAlvo` int(11) DEFAULT NULL,
  `nSessoesPubliTrimestre` date DEFAULT NULL,
  `nHorasSessoes` int(11) DEFAULT NULL,
  `participantesFormacaoHomem` int(11) DEFAULT NULL,
  `participantesFormacaoMulher` int(11) DEFAULT NULL,
  `participantesFormacaoTrimestre` date DEFAULT NULL,
  `anexoProgramaFormacao` varchar(255) DEFAULT NULL,
  `descricaoEquipamentos` text DEFAULT NULL,
  `qtdEquipEntregues` int(11) DEFAULT NULL,
  `anexoTermoEntreEquipamento` varchar(255) DEFAULT NULL,
  `nAnimaisVacinadosCampanha` int(11) DEFAULT NULL,
  `meiosEntreguEntiCampanhaVacinacaoDesc` text DEFAULT NULL,
  `nmeiosDistriEntiCampanhaVacinacao` int(11) DEFAULT NULL,
  `anexoTermoEntrMeiosCampanhaVacinacao` varchar(255) DEFAULT NULL,
  `trataGadoForamMapeadosHomem` int(11) DEFAULT NULL,
  `trataGadoForamMapeadosMulher` int(11) DEFAULT NULL,
  `trataGadoForamMapeadosTrim` date DEFAULT NULL,
  `temaAbordadoFormaGado` varchar(255) DEFAULT NULL,
  `nSessoesRealiFormGado` int(11) DEFAULT NULL,
  `nSessoesRealiFormGadoTrimestre` date DEFAULT NULL,
  `nTotalHorasFormacaoGado` int(11) DEFAULT NULL,
  `participantesFormacaoGadoHomem` int(11) DEFAULT NULL,
  `participantesFormacaoGadoMulher` int(11) DEFAULT NULL,
  `participantesFormacaoGadoTrimestre` date DEFAULT NULL,
  `totalCabecaGado` int(11) DEFAULT NULL,
  `anexoProgramaFormaGado` varchar(255) DEFAULT NULL,
  `distriKitVeterinaria` varchar(3) DEFAULT NULL,
  `composicaoKitVeter` text DEFAULT NULL,
  `nTotalKitDistribuido` int(11) DEFAULT NULL,
  `anexoKitDistri` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesAprendidasONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(50) DEFAULT NULL,
  `constantacoeFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoes` varchar(255) DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(255) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') DEFAULT 'Pendente',
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reforcoinstitucional`
--

INSERT INTO `reforcoinstitucional` (`Id`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `latitude`, `longitude`, `entidadeApoiada`, `apoioCapacitacao`, `temaAbordadoSessoes`, `nSessoesPublicoAlvo`, `nSessoesPubliTrimestre`, `nHorasSessoes`, `participantesFormacaoHomem`, `participantesFormacaoMulher`, `participantesFormacaoTrimestre`, `anexoProgramaFormacao`, `descricaoEquipamentos`, `qtdEquipEntregues`, `anexoTermoEntreEquipamento`, `nAnimaisVacinadosCampanha`, `meiosEntreguEntiCampanhaVacinacaoDesc`, `nmeiosDistriEntiCampanhaVacinacao`, `anexoTermoEntrMeiosCampanhaVacinacao`, `trataGadoForamMapeadosHomem`, `trataGadoForamMapeadosMulher`, `trataGadoForamMapeadosTrim`, `temaAbordadoFormaGado`, `nSessoesRealiFormGado`, `nSessoesRealiFormGadoTrimestre`, `nTotalHorasFormacaoGado`, `participantesFormacaoGadoHomem`, `participantesFormacaoGadoMulher`, `participantesFormacaoGadoTrimestre`, `totalCabecaGado`, `anexoProgramaFormaGado`, `distriKitVeterinaria`, `composicaoKitVeter`, `nTotalKitDistribuido`, `anexoKitDistri`, `desafiosImplementacaoONG`, `licoesAprendidasONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constantacoeFeitasFresan`, `recomendacoes`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(29, '2023-10-25', '1915-08-18', 'rosario', 'CUAMM/C2', 1, 1, 55, 251, '1', '1', 'Administrações Municipais', '1', '11', 1, '2023-10-26', 1, 1, 1, '2024-06-07', 'anexoProgramaFormacao/sNKv5B3FSkOedMKAlk6Ux9pMpWTUBBTQ.xlsx', '1', 1, 'anexoTermoEntreEquipamento/WQ8e2W3d5NWwpuCTTJaHziyzEVlG4l2S.xlsx', 1, '1', 1, 'anexoTermoEntrMeiosCampanhaVacinacao/cBQGcd_PLWm6g60JJruRF9iUktgAgL34.xlsx', 1, 1, '2023-10-04', '1', 1, '2023-10-25', 1, 1, 1, '2023-10-25', 1, 'anexoProgramaFormaGado/LrV4yMvAWSZFD_RN4PYTrTgoVGaIAqjk.xlsx', '1', '1', 1, 'anexoKitDistri/A7JZPCxqQOyPRRpXWWDQbQJs6B6C6oJu.xlsx', '1', '1', '2023-10-11', '1', '1', '1', '1', '1', 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', 2023);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisao`
--

CREATE TABLE `supervisao` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `supervisionadoNome` varchar(50) DEFAULT NULL,
  `qtdSupervisionadoTrimestre` int(11) DEFAULT NULL,
  `supervisionadoTrimestre` date DEFAULT NULL,
  `profissionaisSupervisionadoHomem` int(11) DEFAULT NULL,
  `profissionaisSupervisionadoMulher` int(11) DEFAULT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesImplementacaoONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(100) DEFAULT NULL,
  `constatacoesFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoesPrincipaisFresan` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `supervisao`
--

INSERT INTO `supervisao` (`Id`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `supervisionadoNome`, `qtdSupervisionadoTrimestre`, `supervisionadoTrimestre`, `profissionaisSupervisionadoHomem`, `profissionaisSupervisionadoMulher`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `latitude`, `longitude`, `desafiosImplementacaoONG`, `licoesImplementacaoONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constatacoesFeitasFresan`, `recomendacoesPrincipaisFresan`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(1, 2, 7, 3, 5, '1', 2, '2024-04-19', 2, 2, '2023-10-06', '2023-10-27', '1', 'CUAMM/C2', '1', '1', '1', '1', '2023-10-26', '1', '1', '1', '1', '1', 10, 'Publicado', 'rosario', 'rosario', '2023-10-16', '2023-10-16'),
(2, 2, 7, 3, 6, '1', 1, '2023-10-25', 1, 1, '2023-10-18', '2023-10-25', '1', 'CUAMM/C2', '1', '1', '1', '1', '2023-10-25', '1', '1', '1', '1', '1', 10, 'Pendente', 'rosario', 'rosario', '2023-10-25', '2023-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suplementacao`
--

CREATE TABLE `suplementacao` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `municipioID` int(11) NOT NULL,
  `comunaID` int(11) NOT NULL,
  `localidadeID` int(11) NOT NULL,
  `nSuplemVit` int(11) DEFAULT NULL,
  `nSuplemViTrimestre` date DEFAULT NULL,
  `nDesparatizacao` int(11) DEFAULT NULL,
  `nDesparatizacaoTrimestre` date DEFAULT NULL,
  `primeiroReporte` date DEFAULT NULL,
  `actualizacao` date DEFAULT NULL,
  `respondente` varchar(255) DEFAULT NULL,
  `entidade` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `desafiosImplementacaoONG` text DEFAULT NULL,
  `licoesImplementacaoONG` text DEFAULT NULL,
  `dataVisitaFresan` date DEFAULT NULL,
  `tecnicoResponsavelFresan` varchar(100) DEFAULT NULL,
  `constatacoesFeitasFresan` varchar(255) DEFAULT NULL,
  `recomendacoesPrincipaisFresan` text DEFAULT NULL,
  `medidasMitigacaoONG` varchar(255) DEFAULT NULL,
  `medidasMitigacaoEstado` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `estadoValidacao` enum('Pendente','Validado','Aprovado','Publicado') NOT NULL,
  `criadoPor` varchar(100) NOT NULL,
  `actualizadoPor` varchar(100) NOT NULL,
  `createdAt` date NOT NULL,
  `UpdatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `suplementacao`
--

INSERT INTO `suplementacao` (`Id`, `provinciaID`, `municipioID`, `comunaID`, `localidadeID`, `nSuplemVit`, `nSuplemViTrimestre`, `nDesparatizacao`, `nDesparatizacaoTrimestre`, `primeiroReporte`, `actualizacao`, `respondente`, `entidade`, `latitude`, `longitude`, `desafiosImplementacaoONG`, `licoesImplementacaoONG`, `dataVisitaFresan`, `tecnicoResponsavelFresan`, `constatacoesFeitasFresan`, `recomendacoesPrincipaisFresan`, `medidasMitigacaoONG`, `medidasMitigacaoEstado`, `userID`, `estadoValidacao`, `criadoPor`, `actualizadoPor`, `createdAt`, `UpdatedAt`) VALUES
(1, 2, 7, 3, 5, 1, '2023-10-18', 1, '2023-10-26', '2019-11-24', '2023-10-25', 'rosario', 'CUAMM/C2', '1', '1', '1', '1', '2023-10-10', '1', '1', '1', '1', '1', 10, 'Publicado', 'rosario', 'rosario', '2023-10-16', '2023-10-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipometa`
--

CREATE TABLE `tipometa` (
  `Id` int(11) NOT NULL,
  `tipoMeta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipometa`
--

INSERT INTO `tipometa` (`Id`, `tipoMeta`) VALUES
(1, 'Agricultura'),
(2, 'Nutrição'),
(3, 'Água'),
(4, 'Reforço Institucional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidade`
--

CREATE TABLE `unidade` (
  `Id` int(11) NOT NULL,
  `unidade` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidade`
--

INSERT INTO `unidade` (`Id`, `unidade`) VALUES
(1, 'KG'),
(2, 'Tonelada'),
(3, 'Capacidade '),
(4, 'Litro/dia'),
(5, 'Litro/hora'),
(6, 'M3/hora'),
(9, 'AKZ'),
(10, 'kg e L');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `entidade` enum('ADRA/C4','CODESPA/C2','CODESPA/C4','COSPE/C1','CUAMM/C2','CUAMM/C4','FEC/C2','FEC/C4','NCA/C1','UIC') NOT NULL,
  `nomeCompleto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `entidade`, `nomeCompleto`) VALUES
(10, 'rosario', 'ptJJhRXB1LqurZYGwynVTwPBEOnkknEL', '$2y$13$P7gq9obZNsMqGzu7hYfXq.kdHzW92nXnTTtfTnD6e2UKbBoz2kDhy', NULL, 'rosarioabderval@gmail.com', 10, 1695686156, 1695686156, 'qnEFBhaH28TRHz4yeeyqmmLnkwk8D9fL_1695686156', 'CUAMM/C2', ''),
(12, 'carmen', 'KGSGwOlhbx_Mm-P6hA4M_xV6LxzGAMN4', '$2y$13$7VxbG5D3ONv2mNkyoNvaL.pBhSt6QwRPKiyo2xn4pklWdhEAwvtYK', '', 'gugurai923@gmail.com', 10, 1695729188, 1695729188, 'vo2K6C_hQdjMjofC9NT6BJyT76A3cfxP_1695729188', 'CODESPA/C2', ''),
(15, 'rosario3', 'rosario3', 'rosario12345', 'rosario12345', 'rosarioabderval2@gmail.com', 10, 1, 1, 'rosario2', 'UIC', ''),
(16, 'test', 'vSvQgCinZCKjUQ-g03Rikyh7y0gGMU0N', '$2y$13$1SJdP0dYdyg1zI6nbLBDwu3mg1aGNUm6saDzNm/u5HcOeumE2MBoC', NULL, 'rosarioabderval3@gmail.com', 9, 1698022115, 1698022115, 'C-Mtj-B8A40YGkv9mDFH0RXaiiDdBC66_1698022115', 'CODESPA/C2', ''),
(17, 'test2', 'oAUo7fpkx2WUjOmAlZInLQjQCvefAxPk', '$2y$13$1nZVj.NHSt2E5HjPagBDyOLb.8FInAaQpJufWmp8zUF1Uq5j3HdBK', NULL, 'rosarioabderval4@gmail.com', 9, 1698022195, 1698022195, 'tEiOKj1D-t9q2D_Hpg40acT7NRzHiqTx_1698022195', 'FEC/C2', ''),
(18, 'rosario100', 'aT0fvw2eluGnPMLiH6Zm1K_Gqg_VZMcb', '$2y$13$fiD42JpHXqE6mx18Wc42vu3nJIMjHbd4zU2Enf6mBcDCdN4165E2K', NULL, 'gugurai123@gmail.com', 9, 1698022865, 1698022865, 'yoyXaB8XK69kByhdCsy8SgxuowYwKNgu_1698022865', 'FEC/C4', ''),
(19, 'rosario123', 'Ju11-UTz97Jj9aG81RcEec11Ng8t6Vy_', '$2y$13$qZZPGx3pbVTOemF1B4/jEO.J.al0W543y7P1y8ciMzSWoOmf3J6BC', NULL, 'teste23@gmail.com', 9, 1698023165, 1698023165, 'OsLleQ71O412FrJp8e1AVkqIndGEa9vS_1698023165', 'FEC/C4', ''),
(20, 'rosario1234', 'XlZ73iJxM1yDEfHvFFo_Rh3Q7zrxmzww', '$2y$13$jFaNuEoGIgGUvPkPypHkRupwvuSSJhj82WHKe008MHpGiKEm8N8m6', NULL, 'teste234@gmail.com', 9, 1698023197, 1698023197, 'MXkQytvlCJMSgSXKsfgOBP-mm2pLZe-i_1698023197', 'FEC/C4', ''),
(30, 'teste1', 'axbTaFZRcVHH8KHuKC-qCPW62eg5dQKT', '$2y$13$pm7U49fGH6aNO5vzFYYcB.RTvlwDX.Lu.qZxrXBUMG4seR9TJHQIe', NULL, 'teste1@gmail.com', 9, 1698025920, 1698025920, 'U0S3bPth5rSpUFALW3KDowRvZqwyfQKT_1698025920', 'FEC/C4', 'teste1'),
(31, 'valeria', 'UZa-uwqV9h2p6510-O5F7NdtveBvyA3g', '$2y$13$6inz/FrPfOW6Iwx.nYuF6OPUzPpCyfUe.0v/3G/5ciB5TX1mNQ6Uy', NULL, 'valerio@gmail.com', 10, 1698083057, 1698083057, 'wdID2j9UAZPjPWGLs5rpwo3mCs7Cb0Ux_1698083057', 'UIC', 'Valeria Gonçalves'),
(32, 'gabrieljoaquim', 'lv4Y2pajgIguCWZWsuWjsqGHoeqVz6HG', '$2y$13$WWUx6uu.paB.eUzyh0OvHuNjmE715tOZ2H11NHKCgvOAbSyKkxsiq', NULL, 'gabrieljoaquim.fresan@gmail.com', 10, 1698143019, 1698143019, 'L6BIYNC-elJa4ARXMnfe_Oz0Iu_qXp-p_1698143019', 'UIC', 'Gabriel Joaquim');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agua`
--
ALTER TABLE `agua`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FKAgua354949` (`provinciaID`),
  ADD KEY `FKAgua66937` (`municipioID`),
  ADD KEY `FKAgua296813` (`comunaID`),
  ADD KEY `FKAgua643593` (`localidadeID`),
  ADD KEY `FKAgua9028` (`capacidadeUnidadeID`),
  ADD KEY `FKAgua314146` (`nomeCampoAssociadoGrupoID`),
  ADD KEY `FKAgua389984` (`userID`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `capacitacao`
--
ALTER TABLE `capacitacao`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provinciaC` (`provinciaID`),
  ADD KEY `FK_municipioC` (`municipioID`),
  ADD KEY `FK_comunaC` (`comunaID`),
  ADD KEY `FK_localidadeC` (`localidadeID`);

--
-- Indices de la tabla `classificacaodocumentoartigo`
--
ALTER TABLE `classificacaodocumentoartigo`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `culturasprovidas`
--
ALTER TABLE `culturasprovidas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `demostracoesculinarias`
--
ALTER TABLE `demostracoesculinarias`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provincia` (`provinciaID`),
  ADD KEY `FK_municipio` (`municipioID`),
  ADD KEY `FK_comuna` (`comunaID`),
  ADD KEY `FK_localidade` (`localidadeID`);

--
-- Indices de la tabla `doccomunicacao`
--
ALTER TABLE `doccomunicacao`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_provinciID_provincia` (`provinciaID`),
  ADD KEY `fk_municipioID_municipio` (`municipioID`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provinciae` (`provinciaID`),
  ADD KEY `FK_municipioe` (`municipioID`);

--
-- Indices de la tabla `finalidade`
--
ALTER TABLE `finalidade`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `fitofarmacosferramentas`
--
ALTER TABLE `fitofarmacosferramentas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_grupoFito` (`grupoID`),
  ADD KEY `fk_unidadeFito` (`unidadeID`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FKGrupo686723` (`localidadeID`),
  ADD KEY `FKGrupo339943` (`comunaID`),
  ADD KEY `FKGrupo110067` (`municipioID`),
  ADD KEY `FKGrupo311819` (`provinciaID`),
  ADD KEY `FKGrupo346854` (`userID`),
  ADD KEY `FKGrupo263262` (`primeiraFinalidadeID`),
  ADD KEY `FKGrupo928541` (`segundaFinalidadeID`),
  ADD KEY `FKGrupo113540` (`terceiraFinalidadeID3`);

--
-- Indices de la tabla `insumogrupo`
--
ALTER TABLE `insumogrupo`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_culturas` (`culturasID`);

--
-- Indices de la tabla `localidade`
--
ALTER TABLE `localidade`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_foreign_LocalidadeComuna` (`comunaID`);

--
-- Indices de la tabla `materiais`
--
ALTER TABLE `materiais`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provinciaMa` (`provinciaID`),
  ADD KEY `FK_municipioMa` (`municipioID`),
  ADD KEY `FK_comunaMa` (`comunaID`),
  ADD KEY `FK_localidadeMa` (`localidadeID`);

--
-- Indices de la tabla `merendaescolar`
--
ALTER TABLE `merendaescolar`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provinciaM` (`provinciaID`),
  ADD KEY `FK_municipioM` (`municipioID`),
  ADD KEY `FK_comunaM` (`comunaID`),
  ADD KEY `FK_localidadeM` (`localidadeID`);

--
-- Indices de la tabla `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_tipoMeta` (`tipoMetaID`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FKMunicipio799871` (`provinciaID`);

--
-- Indices de la tabla `pacotepedagfresan`
--
ALTER TABLE `pacotepedagfresan`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provinciapa` (`provinciaID`),
  ADD KEY `FK_municipiopa` (`municipioID`),
  ADD KEY `FK_comunapa` (`comunaID`),
  ADD KEY `FK_localidadepa` (`localidadeID`);

--
-- Indices de la tabla `profissionaissaude`
--
ALTER TABLE `profissionaissaude`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provinciap` (`provinciaID`),
  ADD KEY `FK_municipiop` (`municipioID`),
  ADD KEY `FK_comunap` (`comunaID`),
  ADD KEY `FK_localidadep` (`localidadeID`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `rastreio`
--
ALTER TABLE `rastreio`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provinciarastreio` (`provinciaID`),
  ADD KEY `FK_municipiorastreio` (`municipioID`),
  ADD KEY `FK_comunarastreio` (`comunaID`),
  ADD KEY `FK_localidaderastreio` (`localidadeID`);

--
-- Indices de la tabla `reforcoinstitucional`
--
ALTER TABLE `reforcoinstitucional`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provinciaR` (`provinciaID`),
  ADD KEY `FK_municipioR` (`municipioID`),
  ADD KEY `FK_comunaR` (`comunaID`),
  ADD KEY `FK_localidadeR` (`localidadeID`);

--
-- Indices de la tabla `supervisao`
--
ALTER TABLE `supervisao`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provinciaSup` (`provinciaID`),
  ADD KEY `FK_municipioSup` (`municipioID`),
  ADD KEY `FK_comunaSup` (`comunaID`),
  ADD KEY `FK_localidadeSup` (`localidadeID`);

--
-- Indices de la tabla `suplementacao`
--
ALTER TABLE `suplementacao`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_provincias` (`provinciaID`),
  ADD KEY `FK_municipios` (`municipioID`),
  ADD KEY `FK_comunas` (`comunaID`),
  ADD KEY `FK_localidades` (`localidadeID`);

--
-- Indices de la tabla `tipometa`
--
ALTER TABLE `tipometa`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `unidade`
--
ALTER TABLE `unidade`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agua`
--
ALTER TABLE `agua`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=837;

--
-- AUTO_INCREMENT de la tabla `capacitacao`
--
ALTER TABLE `capacitacao`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `classificacaodocumentoartigo`
--
ALTER TABLE `classificacaodocumentoartigo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `culturasprovidas`
--
ALTER TABLE `culturasprovidas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `demostracoesculinarias`
--
ALTER TABLE `demostracoesculinarias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `doccomunicacao`
--
ALTER TABLE `doccomunicacao`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `finalidade`
--
ALTER TABLE `finalidade`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fitofarmacosferramentas`
--
ALTER TABLE `fitofarmacosferramentas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1365;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `insumogrupo`
--
ALTER TABLE `insumogrupo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1357;

--
-- AUTO_INCREMENT de la tabla `localidade`
--
ALTER TABLE `localidade`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT de la tabla `materiais`
--
ALTER TABLE `materiais`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `merendaescolar`
--
ALTER TABLE `merendaescolar`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `meta`
--
ALTER TABLE `meta`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pacotepedagfresan`
--
ALTER TABLE `pacotepedagfresan`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `profissionaissaude`
--
ALTER TABLE `profissionaissaude`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rastreio`
--
ALTER TABLE `rastreio`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reforcoinstitucional`
--
ALTER TABLE `reforcoinstitucional`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `supervisao`
--
ALTER TABLE `supervisao`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `suplementacao`
--
ALTER TABLE `suplementacao`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipometa`
--
ALTER TABLE `tipometa`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidade`
--
ALTER TABLE `unidade`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `capacitacao`
--
ALTER TABLE `capacitacao`
  ADD CONSTRAINT `FK_comunaC` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidadeC` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipioC` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provinciaC` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `demostracoesculinarias`
--
ALTER TABLE `demostracoesculinarias`
  ADD CONSTRAINT `FK_comuna` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidade` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipio` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provincia` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `doccomunicacao`
--
ALTER TABLE `doccomunicacao`
  ADD CONSTRAINT `fk_municipioID_municipio` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `fk_provinciID_provincia` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `FK_municipioe` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provinciae` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `FKGrupo110067` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FKGrupo113540` FOREIGN KEY (`terceiraFinalidadeID3`) REFERENCES `finalidade` (`Id`),
  ADD CONSTRAINT `FKGrupo263261` FOREIGN KEY (`primeiraFinalidadeID`) REFERENCES `finalidade` (`Id`),
  ADD CONSTRAINT `FKGrupo263262` FOREIGN KEY (`primeiraFinalidadeID`) REFERENCES `finalidade` (`Id`),
  ADD CONSTRAINT `FKGrupo311819` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`),
  ADD CONSTRAINT `FKGrupo339943` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FKGrupo346854` FOREIGN KEY (`userID`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FKGrupo686723` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FKGrupo928541` FOREIGN KEY (`segundaFinalidadeID`) REFERENCES `finalidade` (`Id`);

--
-- Filtros para la tabla `localidade`
--
ALTER TABLE `localidade`
  ADD CONSTRAINT `fk_foreign_LocalidadeComuna` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`);

--
-- Filtros para la tabla `materiais`
--
ALTER TABLE `materiais`
  ADD CONSTRAINT `FK_comunaMa` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidadeMa` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipioMa` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provinciaMa` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `merendaescolar`
--
ALTER TABLE `merendaescolar`
  ADD CONSTRAINT `FK_comunaM` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidadeM` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipioM` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provinciaM` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `meta`
--
ALTER TABLE `meta`
  ADD CONSTRAINT `FK_tipoMeta` FOREIGN KEY (`tipoMetaID`) REFERENCES `tipometa` (`Id`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `FKMunicipio799871` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `pacotepedagfresan`
--
ALTER TABLE `pacotepedagfresan`
  ADD CONSTRAINT `FK_comunapa` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidadepa` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipiopa` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provinciapa` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `profissionaissaude`
--
ALTER TABLE `profissionaissaude`
  ADD CONSTRAINT `FK_comunap` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidadep` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipiop` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provinciap` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `rastreio`
--
ALTER TABLE `rastreio`
  ADD CONSTRAINT `FK_comunarastreio` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidaderastreio` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipiorastreio` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provinciarastreio` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `reforcoinstitucional`
--
ALTER TABLE `reforcoinstitucional`
  ADD CONSTRAINT `FK_comunaR` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidadeR` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipioR` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provinciaR` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `supervisao`
--
ALTER TABLE `supervisao`
  ADD CONSTRAINT `FK_comunaSup` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidadeSup` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipioSup` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provinciaSup` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);

--
-- Filtros para la tabla `suplementacao`
--
ALTER TABLE `suplementacao`
  ADD CONSTRAINT `FK_comunas` FOREIGN KEY (`comunaID`) REFERENCES `comuna` (`Id`),
  ADD CONSTRAINT `FK_localidades` FOREIGN KEY (`localidadeID`) REFERENCES `localidade` (`Id`),
  ADD CONSTRAINT `FK_municipios` FOREIGN KEY (`municipioID`) REFERENCES `municipio` (`Id`),
  ADD CONSTRAINT `FK_provincias` FOREIGN KEY (`provinciaID`) REFERENCES `provincia` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
