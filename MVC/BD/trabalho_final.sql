-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Maio-2023 às 19:52
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabalho_final`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel`
--

CREATE TABLE `papel` (
  `id_papel` int(11) NOT NULL,
  `papel` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel_usuario`
--

CREATE TABLE `papel_usuario` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_papel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT NULL,
  `sys_whats` tinyint(1) NOT NULL,
  `sys_email_confirmado` tinyint(1) NOT NULL,
  `sys_confirmado_termos_de_uso` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `papel`
--
ALTER TABLE `papel`
  ADD PRIMARY KEY (`id_papel`);

--
-- Índices para tabela `papel_usuario`
--
ALTER TABLE `papel_usuario`
  ADD KEY `fk_id_usuario` (`id_usuario`),
  ADD KEY `fk_id_papel` (`id_papel`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `papel_usuario`
--
ALTER TABLE `papel_usuario`
  ADD CONSTRAINT `fk_id_papel` FOREIGN KEY (`id_papel`) REFERENCES `papel` (`id_papel`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
