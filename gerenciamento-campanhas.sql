-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11-Maio-2021 às 18:35
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gerenciamento-campanhas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `cnpj` varchar(18) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  PRIMARY KEY (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`cnpj`, `razao_social`) VALUES
('XX.XXX.XXX/0001-XX', 'Empresa Test Ltda.'),
('XX.XXX.XXX/0002-XX', 'Empresa Test 2 Ltda.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `participantes`
--

DROP TABLE IF EXISTS `participantes`;
CREATE TABLE IF NOT EXISTS `participantes` (
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `data_nascimento` varchar(10) NOT NULL,
  `empresa_cnpj` varchar(18) NOT NULL,
  PRIMARY KEY (`cpf`),
  KEY `fk_empresa_cnpj` (`empresa_cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `participantes`
--

INSERT INTO `participantes` (`cpf`, `nome`, `email`, `data_nascimento`, `empresa_cnpj`) VALUES
('000.000.000-00', 'Participante Test', 'participantetest@gmail.com', '01/01/2000', 'XX.XXX.XXX/0001-XX'),
('222.222.222-22', 'Participante Test 2', 'participantetest2@gmail.com', '02/01/2000', 'XX.XXX.XXX/0002-XX');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `participantes`
--
ALTER TABLE `participantes`
  ADD CONSTRAINT `fk_empresa_cnpj` FOREIGN KEY (`empresa_cnpj`) REFERENCES `empresas` (`cnpj`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
