-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-06-2015 a las 21:04:17
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `marambio2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrativas`
--

CREATE TABLE IF NOT EXISTS `administrativas` (
  `IdAdministrativas` int(11) NOT NULL AUTO_INCREMENT,
  `CodCont` varchar(255) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdAdministrativas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditores`
--

CREATE TABLE IF NOT EXISTS `auditores` (
  `IdAuditor` int(11) NOT NULL DEFAULT '0',
  `IdUnidad` int(11) DEFAULT NULL,
  `Auditor` varchar(100) DEFAULT NULL,
  `Celular` varchar(10) DEFAULT NULL,
  `Directo` varchar(100) DEFAULT NULL,
  `Ext` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdAuditor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `CodEmp` int(11) NOT NULL AUTO_INCREMENT,
  `CodGrupo` int(11) DEFAULT NULL,
  `CodCont` varchar(50) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefonos` varchar(100) DEFAULT NULL,
  `Fax` varchar(100) DEFAULT NULL,
  `PersonaEnc` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rif` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CodEmp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1448 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriados`
--

CREATE TABLE IF NOT EXISTS `feriados` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dia` varchar(10) DEFAULT NULL,
  `Mes` varchar(255) DEFAULT NULL,
  `ORDEN` varchar(255) DEFAULT NULL,
  `NombreFeriado` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `IdGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Direccion` longtext,
  `Telefonos` varchar(100) DEFAULT NULL,
  `Fax` varchar(10) DEFAULT NULL,
  `PersonaContac` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdGrupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=614 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_fact`
--

CREATE TABLE IF NOT EXISTS `orden_fact` (
  `idOP` bigint(20) NOT NULL AUTO_INCREMENT,
  `IdTarea` bigint(20) DEFAULT NULL,
  `IdGrupo` bigint(20) DEFAULT NULL,
  `IdEmpresa` bigint(20) DEFAULT NULL,
  `fechaEsp` varchar(20) DEFAULT NULL,
  `fechaIng` varchar(20) DEFAULT NULL,
  `concepto` longtext,
  `monto` double DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOP`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalasignado`
--

CREATE TABLE IF NOT EXISTS `personalasignado` (
  `IdPA` bigint(20) NOT NULL AUTO_INCREMENT,
  `IdTarea` int(11) DEFAULT NULL,
  `CodificacionComp` varchar(100) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Posicion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdPA`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=183 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quincenas`
--

CREATE TABLE IF NOT EXISTS `quincenas` (
  `IdQna` bigint(20) NOT NULL AUTO_INCREMENT,
  `Quincena` int(11) DEFAULT NULL,
  `Mes` char(2) DEFAULT NULL,
  `Anno` varchar(4) DEFAULT NULL,
  `CodificacionCompleta` varchar(20) DEFAULT NULL,
  `activa` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdQna`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=202 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quincenasub`
--

CREATE TABLE IF NOT EXISTS `quincenasub` (
  `IdQnaSub` bigint(20) NOT NULL AUTO_INCREMENT,
  `IdQna` int(11) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `TipoTarea` varchar(10) DEFAULT NULL,
  `CodificacionComp` varchar(255) DEFAULT NULL,
  `DiasHoras---------------------------------` char(1) DEFAULT NULL,
  `D01` double DEFAULT NULL,
  `D02` double DEFAULT NULL,
  `D03` double DEFAULT NULL,
  `D04` double DEFAULT NULL,
  `D05` double DEFAULT NULL,
  `D06` double DEFAULT NULL,
  `D07` double DEFAULT NULL,
  `D08` double DEFAULT NULL,
  `D09` double DEFAULT NULL,
  `D10` double DEFAULT NULL,
  `D11` double DEFAULT NULL,
  `D12` double DEFAULT NULL,
  `D13` double DEFAULT NULL,
  `D14` double DEFAULT NULL,
  `D15` double DEFAULT NULL,
  `D16` double DEFAULT NULL,
  `D17` double DEFAULT NULL,
  `D18` double DEFAULT NULL,
  `D19` double DEFAULT NULL,
  `D20` double DEFAULT NULL,
  `D21` double DEFAULT NULL,
  `D22` double DEFAULT NULL,
  `D23` double DEFAULT NULL,
  `D24` double DEFAULT NULL,
  `D25` double DEFAULT NULL,
  `D26` double DEFAULT NULL,
  `D27` double DEFAULT NULL,
  `D28` double DEFAULT NULL,
  `D29` double DEFAULT NULL,
  `D30` double DEFAULT NULL,
  `D31` double DEFAULT NULL,
  `APROBADO` int(11) DEFAULT NULL,
  `A01` int(11) DEFAULT NULL,
  `A02` int(11) DEFAULT NULL,
  `A03` int(11) DEFAULT NULL,
  `A04` int(11) DEFAULT NULL,
  `A05` int(11) DEFAULT NULL,
  `A06` int(11) DEFAULT NULL,
  `A07` int(11) DEFAULT NULL,
  `A08` int(11) DEFAULT NULL,
  `A09` int(11) DEFAULT NULL,
  `A10` int(11) DEFAULT NULL,
  `A11` int(11) DEFAULT NULL,
  `A12` int(11) DEFAULT NULL,
  `A13` int(11) DEFAULT NULL,
  `A14` int(11) DEFAULT NULL,
  `A15` int(11) DEFAULT NULL,
  `A16` int(11) DEFAULT NULL,
  `A17` int(11) DEFAULT NULL,
  `A18` int(11) DEFAULT NULL,
  `A19` int(11) DEFAULT NULL,
  `A20` int(11) DEFAULT NULL,
  `A21` int(11) DEFAULT NULL,
  `A22` int(11) DEFAULT NULL,
  `A23` int(11) DEFAULT NULL,
  `A24` int(11) DEFAULT NULL,
  `A25` int(11) DEFAULT NULL,
  `A26` int(11) DEFAULT NULL,
  `A27` int(11) DEFAULT NULL,
  `A28` int(11) DEFAULT NULL,
  `A29` int(11) DEFAULT NULL,
  `A30` int(11) DEFAULT NULL,
  `A31` int(11) DEFAULT NULL,
  `TotalHoras` double DEFAULT NULL,
  `token` int(1) DEFAULT NULL,
  PRIMARY KEY (`IdQnaSub`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67517 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `IdServicio` int(11) NOT NULL AUTO_INCREMENT,
  `CodCont` varchar(100) DEFAULT NULL,
  `Servicio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdServicio`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessiones`
--

CREATE TABLE IF NOT EXISTS `sessiones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `session2000` varchar(100) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `FDia` char(2) DEFAULT NULL,
  `FMes` char(2) DEFAULT NULL,
  `FAnno` varchar(4) DEFAULT NULL,
  `FEspanol` varchar(10) DEFAULT NULL,
  `FIngles` varchar(10) DEFAULT NULL,
  `ip` longtext,
  `nivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28090 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisores`
--

CREATE TABLE IF NOT EXISTS `supervisores` (
  `IdSupervisor` int(11) NOT NULL DEFAULT '0',
  `Nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdSupervisor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE IF NOT EXISTS `tareas` (
  `IdTarea` bigint(20) NOT NULL AUTO_INCREMENT,
  `IdGrupo` int(11) DEFAULT NULL,
  `IdEmpresa` int(11) DEFAULT NULL,
  `IdUnidad` int(11) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  `IdLider` int(11) DEFAULT NULL,
  `Dia` char(2) DEFAULT NULL,
  `Mes` varchar(50) DEFAULT NULL,
  `Anno` varchar(50) DEFAULT NULL,
  `AnnoMes` varchar(50) DEFAULT NULL,
  `FEspanol` varchar(50) DEFAULT NULL,
  `FIngles` varchar(50) DEFAULT NULL,
  `CodificacionComp` varchar(100) DEFAULT NULL,
  `IdSupervisor` int(11) DEFAULT NULL,
  `Tasa` double DEFAULT NULL,
  `HorasEstimadas` int(11) DEFAULT NULL,
  `HorasSocio` int(11) DEFAULT NULL,
  `HorasGerente` int(11) DEFAULT NULL,
  `HorasEncargado` int(11) DEFAULT NULL,
  `HorasAsistente` int(11) DEFAULT NULL,
  `HorasLider` int(11) DEFAULT NULL,
  `porcAvance` int(11) DEFAULT NULL,
  `MesEjecucion` varchar(10) DEFAULT NULL,
  `AnnoEjecucion` varchar(10) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `cerradoPor` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdTarea`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8869 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_registradas`
--

CREATE TABLE IF NOT EXISTS `tareas_registradas` (
  `id_tarea_registrada` bigint(10) NOT NULL AUTO_INCREMENT,
  `tarea` varchar(50) DEFAULT NULL,
  `id_empleado` int(20) DEFAULT NULL,
  `fecha_cierre` varchar(10) DEFAULT NULL,
  `fecha` varchar(10) DEFAULT NULL,
  `id_qna` int(20) DEFAULT NULL,
  PRIMARY KEY (`id_tarea_registrada`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46761 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasas`
--

CREATE TABLE IF NOT EXISTS `tasas` (
  `IdTasa` int(11) NOT NULL AUTO_INCREMENT,
  `CodCont` varchar(255) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Monto` double DEFAULT NULL,
  PRIMARY KEY (`IdTasa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiempo`
--

CREATE TABLE IF NOT EXISTS `tiempo` (
  `IdTiempo` bigint(20) NOT NULL AUTO_INCREMENT,
  `IdAuditor` int(11) DEFAULT NULL,
  `Quincena` int(11) DEFAULT NULL,
  `Mes` char(2) DEFAULT NULL,
  `Anno` varchar(4) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `Tarea----------------` char(1) DEFAULT NULL,
  `IdTarea` int(11) DEFAULT NULL,
  `CodificacionComp` varchar(255) DEFAULT NULL,
  `Administrativa-------` char(1) DEFAULT NULL,
  `IdAdministrativa` int(11) DEFAULT NULL,
  `DiasHoras------------` char(1) DEFAULT NULL,
  `D01` double DEFAULT NULL,
  `D02` double DEFAULT NULL,
  `D03` double DEFAULT NULL,
  `D04` double DEFAULT NULL,
  `D05` double DEFAULT NULL,
  `D06` double DEFAULT NULL,
  `D07` double DEFAULT NULL,
  `D08` double DEFAULT NULL,
  `D09` double DEFAULT NULL,
  `D10` double DEFAULT NULL,
  `D11` double DEFAULT NULL,
  `D12` double DEFAULT NULL,
  `D13` double DEFAULT NULL,
  `D14` double DEFAULT NULL,
  `D15` double DEFAULT NULL,
  `D16` double DEFAULT NULL,
  `D17` double DEFAULT NULL,
  `D18` double DEFAULT NULL,
  `D19` double DEFAULT NULL,
  `D20` double DEFAULT NULL,
  `D21` double DEFAULT NULL,
  `D22` double DEFAULT NULL,
  `D23` double DEFAULT NULL,
  `D24` double DEFAULT NULL,
  `D25` double DEFAULT NULL,
  `D26` double DEFAULT NULL,
  `D27` double DEFAULT NULL,
  `D28` double DEFAULT NULL,
  `D29` double DEFAULT NULL,
  `D30` double DEFAULT NULL,
  `D31` double DEFAULT NULL,
  `TotalHoras` double DEFAULT NULL,
  PRIMARY KEY (`IdTiempo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE IF NOT EXISTS `unidades` (
  `IdUnidad` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Encargado` int(100) DEFAULT NULL,
  PRIMARY KEY (`IdUnidad`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `IdUnidad` int(11) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `Pass` varchar(50) DEFAULT NULL,
  `Nivel` int(11) DEFAULT NULL,
  `Cargo` varchar(50) DEFAULT NULL,
  `Telefono` varchar(100) DEFAULT NULL,
  `Ext` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=333 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
