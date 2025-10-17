-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 30/05/2014 às 15h39min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `siscom2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `area` varchar(255) NOT NULL,
  `arquivo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 19456 kB' AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `areas`
--

INSERT INTO `areas` (`id`, `area`, `arquivo`) VALUES
(1, 'Home', 'home.php'),
(2, 'Fornecedores', 'fornecedores.php'),
(3, 'Produtos', 'produtos.php'),
(4, 'Caixa', 'pdv.php'),
(5, 'Usuários', 'usuarios.php'),
(6, 'Relatórios', 'relatorios.php'),
(7, 'Clientes', 'clientes.php'),
(8, 'Entrada de Produtos', 'entrada.php');

--
-- Estrutura da tabela `atendimento`
--

CREATE TABLE IF NOT EXISTS `atendimento` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cartao` bigint(20) unsigned NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `unitario` double NOT NULL,
  `qtde` double NOT NULL,
  `subtotal` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 18432 kB; InnoDB free: 18432 kB' AUTO_INCREMENT=1 ;

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(1) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  `observacoes` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 13312 kB' AUTO_INCREMENT=114 ;

--
-- Estrutura da tabela `entrada1`
--

CREATE TABLE IF NOT EXISTS `entrada1` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_fornecedor` bigint(20) unsigned NOT NULL,
  `nfnro` varchar(255) NOT NULL,
  `data_emissao` date NOT NULL,
  `total_nota` double NOT NULL,
  `data_lancamento` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Estrutura da tabela `entrada2`
--

CREATE TABLE IF NOT EXISTS `entrada2` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_entrada` bigint(20) unsigned NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `qtde` double NOT NULL,
  `custo` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 13312 kB' AUTO_INCREMENT=1 ;

--
-- Estrutura da tabela `estorno`
--

CREATE TABLE IF NOT EXISTS `estorno` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `quantidade` double DEFAULT NULL,
  `unitario` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `datahora` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2363 ;

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fornecedor` varchar(255) NOT NULL,
  `incluido` datetime NOT NULL,
  `alterado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fornecedor` (`fornecedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB; InnoDB free: 18432 kB' AUTO_INCREMENT=1 ;

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE IF NOT EXISTS `permissoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `id_area` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`,`id_area`),
  KEY `id_area` (`id_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `id_user`, `id_area`) VALUES
(6, 1, 1),
(5, 1, 2),
(7, 1, 3),
(2, 1, 4),
(9, 1, 5),
(8, 1, 6),
(3, 1, 7),
(4, 1, 8),
(25, 2, 1),
(24, 2, 2),
(26, 2, 3),
(21, 2, 4),
(28, 2, 5),
(27, 2, 6),
(22, 2, 7),
(23, 2, 8),
(30, 3, 4),
(52, 4, 4),
(47, 5, 1),
(46, 5, 2),
(48, 5, 3),
(43, 5, 4),
(50, 5, 5),
(49, 5, 6),
(44, 5, 7),
(45, 5, 8),
(54, 6, 4);

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` bigint(20) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `custo` double unsigned NOT NULL,
  `venda` double unsigned NOT NULL,
  `estoque` double NOT NULL,
  `id_fornecedor` bigint(20) unsigned NOT NULL DEFAULT '0',
  `incluido` datetime NOT NULL,
  `alterado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `home` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  KEY `home` (`home`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 18432 kB' AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `user`, `pass`, `home`) VALUES
(1, 'MAIKER', 'maiker', '', 1),
(2, 'ROSE', 'rose', 'ÌH$ª­', 1),
(3, 'CAIXA', 'caixa', 'ÌH$ª­', 4),
(4, 'CAIXA1', 'fran', 'ð', 4),
(5, 'CAIO', 'caio', '­', 1),
(6, 'TESTE', 'teste', '“Øá', 4);

--
-- Estrutura da tabela `vendas1`
--

CREATE TABLE IF NOT EXISTS `vendas1` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `datahora` datetime NOT NULL,
  `total` double NOT NULL,
  `id_cliente` bigint(20) NOT NULL DEFAULT '0',
  `pago` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 18432 kB' AUTO_INCREMENT=3 ;

--
-- Estrutura da tabela `vendas2`
--

CREATE TABLE IF NOT EXISTS `vendas2` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_venda` bigint(20) unsigned NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `unitario` double NOT NULL,
  `qtde` double NOT NULL,
  `subtotal` double NOT NULL,
  `id_user` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 18432 kB' AUTO_INCREMENT=3 ;

--
-- Restrições para a tabela `permissoes`
--

ALTER TABLE `permissoes`
  ADD CONSTRAINT `permissoes_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permissoes_ibfk_5` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`) ON UPDATE CASCADE;

--
-- Restrições para a tabela `usuarios`
--

ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`home`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
