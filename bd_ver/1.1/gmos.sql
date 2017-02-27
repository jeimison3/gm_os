-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Fev-2017 às 02:09
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gmos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `credenciais`
--

create database gmos;
use gmos;


CREATE TABLE IF NOT EXISTS `credenciais` (
  `id_cred` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cred` varchar(30) NOT NULL,
  PRIMARY KEY (`id_cred`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `credenciais`
--

INSERT INTO `credenciais` (`id_cred`, `nome_cred`) VALUES
(1, 'Administrador'),
(2, 'Gestor'),
(3, 'Coordenador'),
(4, 'Secretário'),
(5, 'Professor'),
(6, 'Grupo'),
(7, 'Aluno'),
(8, 'Público');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscrigrupos`
--

CREATE TABLE IF NOT EXISTS `inscrigrupos` (
  `id_inscri` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  PRIMARY KEY (`id_inscri`),
  KEY `id_grupo` (`id_grupo`),
  KEY `id_usr` (`id_usr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagegrupos`
--

CREATE TABLE IF NOT EXISTS `pagegrupos` (
  `id_grupo` int(11) NOT NULL,
  `nome_grupo` varchar(60) NOT NULL,
  PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagens`
--

CREATE TABLE IF NOT EXISTS `postagens` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(300) NOT NULL,
  `postagem` text NOT NULL,
  `filtros` text,
  `credencial_min` int(11) NOT NULL,
  `id_key` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `credencial_min_idx` (`credencial_min`),
  KEY `id_key_idx` (`id_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_defs`
--

CREATE TABLE IF NOT EXISTS `system_defs` (
  `escolaNm` varchar(300) NOT NULL,
  `periodo_inscri` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `system_defs`
--

INSERT INTO `system_defs` (`escolaNm`, `periodo_inscri`) VALUES
('Gonzaga Mota', '2017-03-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE IF NOT EXISTS `turmas` (
  `id_turma` int(11) NOT NULL AUTO_INCREMENT,
  `nome_turma` varchar(60) NOT NULL,
  `dat_inicio` date NOT NULL,
  `dat_final` date NOT NULL,
  PRIMARY KEY (`id_turma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id_turma`, `nome_turma`, `dat_inicio`, `dat_final`) VALUES
(1, 'Nenhuma', '2017-02-13', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id_upload` int(11) NOT NULL AUTO_INCREMENT,
  `codefile` varchar(32) NOT NULL,
  `credencial_min` int(11) NOT NULL,
  `sharing_state` tinyint(1) NOT NULL,
  `id_key` int(11) NOT NULL,
  PRIMARY KEY (`id_upload`),
  UNIQUE KEY `codefile` (`codefile`),
  KEY `id_key` (`id_key`),
  KEY `credencial_min` (`credencial_min`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usr` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `passwd` varchar(45) NOT NULL,
  `nom_comp` varchar(100) NOT NULL,
  `dt_nasc` datetime NOT NULL,
  `id_turma` int(11) DEFAULT NULL,
  `id_credencial` int(11) NOT NULL,
  `numsec` int(11) NOT NULL,
  PRIMARY KEY (`id_usr`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usr`, `username`, `email`, `passwd`, `nom_comp`, `dt_nasc`, `id_turma`, `id_credencial`, `numsec`) VALUES
(1, 'jeimison3', 'jeimison3@gmail.com', '7ff93f74837b36a4e6a53997b6edad3c', 'Jeimison Moreno Lima', '2000-04-27 00:00:00', 1, 6, 2808);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_keys`
--

CREATE TABLE IF NOT EXISTS `usuarios_keys` (
  `id_key` int(11) NOT NULL AUTO_INCREMENT,
  `id_usr` int(11) NOT NULL,
  `key_value` varchar(32) NOT NULL,
  PRIMARY KEY (`id_key`),
  KEY `id_usr_idx` (`id_usr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuarios_keys`
--

INSERT INTO `usuarios_keys` (`id_key`, `id_usr`, `key_value`) VALUES
(4, 1, 'f21f87023a4779a1674cad2d6a0edc8e');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `usuarios_keys`
--
ALTER TABLE `usuarios_keys`
  ADD CONSTRAINT `usuarios_keys_ibfk_1` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id_usr`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
