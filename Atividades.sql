-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 23/08/2023 às 04:30
-- Versão do servidor: 10.4.22-MariaDB
-- Versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Atividades`
--
CREATE DATABASE IF NOT EXISTS `Atividades` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Atividades`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

CREATE TABLE `atividades` (
  `id` int(11) NOT NULL,
  `id_diciplina` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `data_entrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `diciplinas`
--

CREATE TABLE `diciplinas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `curso` varchar(30) NOT NULL,
  `id_professor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `diciplina_aluno`
--

CREATE TABLE `diciplina_aluno` (
  `id_diciplina` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `matricula` varchar(20) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `curso` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_diciplina` (`id_diciplina`);

--
-- Índices de tabela `diciplinas`
--
ALTER TABLE `diciplinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices de tabela `diciplina_aluno`
--
ALTER TABLE `diciplina_aluno`
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_diciplina` (`id_diciplina`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividades`
--
ALTER TABLE `atividades`
  ADD CONSTRAINT `atividades_ibfk_1` FOREIGN KEY (`id_diciplina`) REFERENCES `diciplinas` (`id`);

--
-- Restrições para tabelas `diciplinas`
--
ALTER TABLE `diciplinas`
  ADD CONSTRAINT `diciplinas_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `diciplina_aluno`
--
ALTER TABLE `diciplina_aluno`
  ADD CONSTRAINT `diciplina_aluno_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `diciplina_aluno_ibfk_2` FOREIGN KEY (`id_diciplina`) REFERENCES `diciplinas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
