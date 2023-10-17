-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Out-2023 às 08:33
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
-- Estrutura da tabela `banidos`
--

CREATE TABLE `banidos` (
  `id_banimento` int(11) NOT NULL,
  `cpf_usuario` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `cargo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo_usuario`
--

CREATE TABLE `cargo_usuario` (
  `cpf_usuario` varchar(15) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem_animal`
--

CREATE TABLE `postagem_animal` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `especie` varchar(60) DEFAULT NULL,
  `raca` varchar(60) DEFAULT NULL,
  `genero` varchar(60) DEFAULT NULL,
  `cor` varchar(60) DEFAULT NULL,
  `ultimo_endereco` varchar(60) DEFAULT NULL,
  `descricao` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem_usuario`
--

CREATE TABLE `postagem_usuario` (
  `cpf_usuario` varchar(15) DEFAULT NULL,
  `id_postagem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cpf` varchar(15) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `celular` varchar(60) DEFAULT NULL,
  `data_cadatro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `banidos`
--
ALTER TABLE `banidos`
  ADD PRIMARY KEY (`id_banimento`),
  ADD KEY `fk_cpf_usuario_banido` (`cpf_usuario`);

--
-- Índices para tabela `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cargo_usuario`
--
ALTER TABLE `cargo_usuario`
  ADD KEY `fk_cpf_usuario_cargo` (`cpf_usuario`),
  ADD KEY `fk_id_cargo_usuario` (`id_cargo`);

--
-- Índices para tabela `postagem_animal`
--
ALTER TABLE `postagem_animal`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `postagem_usuario`
--
ALTER TABLE `postagem_usuario`
  ADD KEY `fk_cpf_usuario_postagem` (`cpf_usuario`),
  ADD KEY `fk_id_postagem_usuario` (`id_postagem`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cpf`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `banidos`
--
ALTER TABLE `banidos`
  ADD CONSTRAINT `fk_cpf_usuario_banido` FOREIGN KEY (`cpf_usuario`) REFERENCES `usuario` (`cpf`);

--
-- Limitadores para a tabela `cargo_usuario`
--
ALTER TABLE `cargo_usuario`
  ADD CONSTRAINT `fk_cpf_usuario_cargo` FOREIGN KEY (`cpf_usuario`) REFERENCES `usuario` (`cpf`),
  ADD CONSTRAINT `fk_id_cargo_usuario` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`);

--
-- Limitadores para a tabela `postagem_usuario`
--
ALTER TABLE `postagem_usuario`
  ADD CONSTRAINT `fk_cpf_usuario_postagem` FOREIGN KEY (`cpf_usuario`) REFERENCES `usuario` (`cpf`),
  ADD CONSTRAINT `fk_id_postagem_usuario` FOREIGN KEY (`id_postagem`) REFERENCES `postagem_animal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
