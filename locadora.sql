-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Ago-2022 às 20:36
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `locadora`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `cep` varchar(12) NOT NULL,
  `endereco` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `celular`, `cep`, `endereco`) VALUES
(1, 'Natanael de Paiva Junior', '033.731.549-36', '(41) 99905-0015', '81750-250', 'Rua Henrique Dyck - 59 -  - Boqueirão - Curitiba - PR'),
(4, 'Maria Locadora', '022.358.987-78', '(41) 99999-9999', '81750-250', 'Rua Henrique Dyck - 25 -  - Boqueirão - Curitiba - PR'),
(5, 'Joao Locador', '887.865.465-45', '(41) 99999-9999', '81750-250', 'Rua Henrique Dyck - 10 -  - Boqueirão - Curitiba - PR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacoes`
--

CREATE TABLE `locacoes` (
  `id` int(11) NOT NULL,
  `idlocador` int(11) NOT NULL,
  `idfilme` int(10) NOT NULL,
  `filme` varchar(100) NOT NULL,
  `statusfilme` varchar(10) NOT NULL,
  `dataretir` date NOT NULL,
  `datadev` date NOT NULL,
  `valordiaria` varchar(20) NOT NULL,
  `valormultadia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `locacoes`
--

INSERT INTO `locacoes` (`id`, `idlocador`, `idfilme`, `filme`, `statusfilme`, `dataretir`, `datadev`, `valordiaria`, `valormultadia`) VALUES
(1, 1, 3, 'Avatar', 'lanc', '2022-07-27', '2022-07-29', '8', '8'),
(3, 1, 7, 'Minions -  A origem do Gru', 'cat', '2022-07-19', '2022-07-22', '5', '5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `produto` varchar(100) NOT NULL,
  `descri` varchar(2000) NOT NULL,
  `status` varchar(20) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `prateleira` varchar(100) NOT NULL,
  `disponivel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `produto`, `descri`, `status`, `foto`, `categoria`, `prateleira`, `disponivel`) VALUES
(3, 'Avatar', 'Avatar', 'lanc', '706184fad9b83ca19a4787bd329e2339.jpg', '..infantil..', '1', ''),
(7, 'Minions -  A origem do Gru', 'Minions 2', 'cat', '02ef2262a39620ebbc58f397a1f2b839.jpg', '..comedia..', '2', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `nivel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `pass`, `nivel`) VALUES
(1, 'master', 'master', 'master');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `locacoes`
--
ALTER TABLE `locacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `locacoes`
--
ALTER TABLE `locacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
