-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Dez 28, 2006 as 01:36 AM
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `bdMetteService`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acoes`
--

CREATE TABLE IF NOT EXISTS `acoes` (
  `id_modulo` int(11) NOT NULL,
  `codigo_acao` int(11) NOT NULL,
  `nome` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_modulo`,`codigo_acao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `acoes`
--

INSERT INTO `acoes` (`id_modulo`, `codigo_acao`, `nome`) VALUES
(1, 1, 'Visulizar'),
(1, 2, 'Adicionar'),
(1, 3, 'Editar'),
(1, 4, 'Excluir'),
(2, 1, 'Visualizar'),
(2, 2, 'Adicionar'),
(2, 3, 'Editar'),
(2, 4, 'Excluir'),
(3, 1, 'Visulaizar'),
(3, 2, 'Adicionar'),
(3, 3, 'Editar'),
(3, 4, 'Excluir');

-- --------------------------------------------------------

--
-- Estrutura da tabela `acoes_modulos_perfis`
--

CREATE TABLE IF NOT EXISTS `acoes_modulos_perfis` (
  `id_perfil` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `codigo_acao` int(11) NOT NULL,
  PRIMARY KEY (`id_perfil`,`id_modulo`,`codigo_acao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `acoes_modulos_perfis`
--

INSERT INTO `acoes_modulos_perfis` (`id_perfil`, `id_modulo`, `codigo_acao`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(1, 1, 4),
(1, 2, 1),
(1, 2, 2),
(1, 2, 3),
(1, 2, 4),
(1, 3, 1),
(1, 3, 2),
(1, 3, 3),
(1, 3, 4),
(2, 3, 1),
(3, 3, 1),
(3, 3, 3),
(3, 3, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acompanhante`
--

CREATE TABLE IF NOT EXISTS `acompanhante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idade` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `altura` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `peso` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `busto` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cintura` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `quadril` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `olhos` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pernoite` tinyint(4) DEFAULT NULL,
  `atendo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `especialidade` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `horario_atendimento` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `excluido` tinyint(4) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `usuarios_id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id`,`usuarios_id`,`usuarios_id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `acompanhante`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `acompanhante_has_caracterisiticas`
--

CREATE TABLE IF NOT EXISTS `acompanhante_has_caracterisiticas` (
  `acompanhante_id` int(11) NOT NULL,
  `caracterisiticas_id` int(11) NOT NULL,
  PRIMARY KEY (`acompanhante_id`,`caracterisiticas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `acompanhante_has_caracterisiticas`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nota` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `acompanhante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`cliente_id`,`acompanhante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `avaliacao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `caracterisiticas`
--

CREATE TABLE IF NOT EXISTS `caracterisiticas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `caracterisiticas`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cpf` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `excluido` tinyint(4) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `usuarios_id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id`,`usuarios_id`,`usuarios_id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `cliente`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text COLLATE utf8_bin NOT NULL,
  `comentario_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `acompanhante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`cliente_id`,`acompanhante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `comentario`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `encontro`
--

CREATE TABLE IF NOT EXISTS `encontro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `data_horario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `aprovado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`,`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `encontro`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos`
--

CREATE TABLE IF NOT EXISTS `fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_bin NOT NULL,
  `acompanhante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`acompanhante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `fotos`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacao`
--

CREATE TABLE IF NOT EXISTS `localizacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `longitude` varchar(45) COLLATE utf8_bin NOT NULL,
  `latitude` varchar(45) COLLATE utf8_bin NOT NULL,
  `bairro` varchar(45) COLLATE utf8_bin NOT NULL,
  `cidade` varchar(45) COLLATE utf8_bin NOT NULL,
  `servicos_acompanhante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`servicos_acompanhante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `localizacao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) COLLATE utf8_bin NOT NULL,
  `link` varchar(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id`, `nome`, `link`) VALUES
(1, 'Usuarios', 'usuario'),
(2, 'Perfis', 'perfil'),
(3, 'Acompanhantes', 'acompanhante'),
(4, 'Clientes', 'cliente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

CREATE TABLE IF NOT EXISTS `perfis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`id`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'Garota');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `servico`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos_acompanhante`
--

CREATE TABLE IF NOT EXISTS `servicos_acompanhante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servico_id` int(11) NOT NULL,
  `valor` double NOT NULL,
  `acompanhante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`servico_id`,`acompanhante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `servicos_acompanhante`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos_do_encontro`
--

CREATE TABLE IF NOT EXISTS `servicos_do_encontro` (
  `encontro_id` int(11) NOT NULL,
  `servicos_acompanhante_id` int(11) NOT NULL,
  PRIMARY KEY (`encontro_id`,`servicos_acompanhante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `servicos_do_encontro`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `termo_adesao`
--

CREATE TABLE IF NOT EXISTS `termo_adesao` (
  `id` int(11) NOT NULL,
  `ip` varchar(45) COLLATE utf8_bin NOT NULL,
  `browser` varchar(45) COLLATE utf8_bin NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuarios_id` int(11) NOT NULL,
  `usuarios_id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `termo_adesao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) COLLATE utf8_bin NOT NULL,
  `senha` varchar(45) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  `dataUltimoLogin` timestamp NULL DEFAULT NULL,
  `excluido` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`,`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `email`, `id_perfil`, `dataUltimoLogin`, `excluido`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com.br', 1, '2013-03-26 21:09:56', 0),
(2, 'lucasmcihel2003@yahoo.com.br', '202cb962ac59075b964b07152d234b70', 'lucasmcihel2003@yahoo.com.br', 2, NULL, 1),
(3, 'llucasmcihel2003@yahoo.com.br', '202cb962ac59075b964b07152d234b70', 'llucasmcihel2003@yahoo.com.br', 2, NULL, 1);
