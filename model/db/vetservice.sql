-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/07/2025 às 22:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vetservice`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_animal`
--

CREATE TABLE `tbl_animal` (
  `ANI_CODIGO` int(11) NOT NULL,
  `ANI_NOME` varchar(100) NOT NULL,
  `ANI_NASCIMENTO` date DEFAULT NULL,
  `ANI_ESPECIE` varchar(50) DEFAULT NULL,
  `ANI_SEXO` char(1) DEFAULT NULL,
  `DON_CODIGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_animal`
--

INSERT INTO `tbl_animal` (`ANI_CODIGO`, `ANI_NOME`, `ANI_NASCIMENTO`, `ANI_ESPECIE`, `ANI_SEXO`, `DON_CODIGO`) VALUES
(1, 'Lagosta', '2025-07-01', 'Felina', 'F', 1),
(2, 'Thor', '2025-07-02', 'Canina', 'M', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_consulta`
--

CREATE TABLE `tbl_consulta` (
  `CON_CODIGO` int(11) NOT NULL,
  `ANI_CODIGO` int(11) NOT NULL,
  `VET_CODIGO` int(11) NOT NULL,
  `CON_DATA` date NOT NULL,
  `CON_HORA` time NOT NULL,
  `CON_HORA_FIM` time DEFAULT NULL,
  `CON_REALIZADA` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_diagnostico`
--

CREATE TABLE `tbl_diagnostico` (
  `DIG_CODIGO` int(11) NOT NULL,
  `ANI_CODIGO` int(11) NOT NULL,
  `CON_CODIGO` int(11) NOT NULL,
  `DIG_PESO` decimal(5,2) DEFAULT NULL,
  `DIG_TEMPERATURA` decimal(4,1) DEFAULT NULL,
  `DIG_BPM` int(11) DEFAULT NULL,
  `DIG_ALTURA` decimal(5,2) DEFAULT NULL,
  `DIG_PRESSAO` varchar(20) DEFAULT NULL,
  `DIG_SINTOMAS` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_dono`
--

CREATE TABLE `tbl_dono` (
  `DON_CODIGO` int(11) NOT NULL,
  `DON_NOME` varchar(100) NOT NULL,
  `DON_CPF` varchar(14) NOT NULL,
  `DON_CEP` varchar(9) NOT NULL,
  `DON_RUA` varchar(100) NOT NULL,
  `DON_NUMCASA` varchar(10) DEFAULT NULL,
  `DON_COMPLEMENTO` varchar(50) DEFAULT NULL,
  `DON_BAIRRO` varchar(50) NOT NULL,
  `DON_CIDADE` varchar(50) NOT NULL,
  `DON_UF` char(2) NOT NULL,
  `DON_TELEFONE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_dono`
--

INSERT INTO `tbl_dono` (`DON_CODIGO`, `DON_NOME`, `DON_CPF`, `DON_CEP`, `DON_RUA`, `DON_NUMCASA`, `DON_COMPLEMENTO`, `DON_BAIRRO`, `DON_CIDADE`, `DON_UF`, `DON_TELEFONE`) VALUES
(1, 'Eliezer Leite Chaves', '475.658.278-86', '12.040-65', 'Estrada Municipal Francisco Alves Monteiro', '1467', '', 'Parque Senhor do Bonfim', 'Taubaté', 'SP', '(12) 99215-6300'),
(2, 'Thalissa Amanda Rodrigues Chaves', '461.070.468-44', '12.040-65', 'Buscando...', '1467', '', 'Buscando...', 'Buscando...', 'Bu', '(12) 99215-6300');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_especialidade`
--

CREATE TABLE `tbl_especialidade` (
  `ESP_CODIGO` int(11) NOT NULL,
  `ESP_NOME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_especialidade`
--

INSERT INTO `tbl_especialidade` (`ESP_CODIGO`, `ESP_NOME`) VALUES
(1, 'Clínica Geral'),
(2, 'Cirurgia'),
(3, 'Dermatologia'),
(4, 'Cardiologia'),
(5, 'Ortopedia'),
(6, 'Oftalmologia'),
(7, 'Oncologia'),
(8, 'Neurologia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_veterinario`
--

CREATE TABLE `tbl_veterinario` (
  `VET_CODIGO` int(11) NOT NULL,
  `VET_NOME` varchar(100) NOT NULL,
  `VET_CRMV` varchar(20) NOT NULL,
  `VET_TELEFONE` varchar(20) NOT NULL,
  `VET_CRMV_UF` char(2) NOT NULL,
  `ESP_CODIGO` int(11) NOT NULL,
  `VET_COLOR` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_veterinario`
--

INSERT INTO `tbl_veterinario` (`VET_CODIGO`, `VET_NOME`, `VET_CRMV`, `VET_TELEFONE`, `VET_CRMV_UF`, `ESP_CODIGO`, `VET_COLOR`) VALUES
(1, 'Eliezer Leite Chaves', '12312', '(12) 99215-6300', '12', 2, '#0d6efd'),
(2, 'Thalissa Amanda Rodrigues Chaves', '22222', '(12) 31231-2312', '22', 4, '#d50dfd');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbl_animal`
--
ALTER TABLE `tbl_animal`
  ADD PRIMARY KEY (`ANI_CODIGO`),
  ADD KEY `DON_CODIGO` (`DON_CODIGO`);

--
-- Índices de tabela `tbl_consulta`
--
ALTER TABLE `tbl_consulta`
  ADD PRIMARY KEY (`CON_CODIGO`),
  ADD KEY `ANI_CODIGO` (`ANI_CODIGO`),
  ADD KEY `VET_CODIGO` (`VET_CODIGO`);

--
-- Índices de tabela `tbl_diagnostico`
--
ALTER TABLE `tbl_diagnostico`
  ADD PRIMARY KEY (`DIG_CODIGO`),
  ADD KEY `ANI_CODIGO` (`ANI_CODIGO`),
  ADD KEY `CON_CODIGO` (`CON_CODIGO`);

--
-- Índices de tabela `tbl_dono`
--
ALTER TABLE `tbl_dono`
  ADD PRIMARY KEY (`DON_CODIGO`),
  ADD UNIQUE KEY `DON_CPF` (`DON_CPF`);

--
-- Índices de tabela `tbl_especialidade`
--
ALTER TABLE `tbl_especialidade`
  ADD PRIMARY KEY (`ESP_CODIGO`);

--
-- Índices de tabela `tbl_veterinario`
--
ALTER TABLE `tbl_veterinario`
  ADD PRIMARY KEY (`VET_CODIGO`),
  ADD UNIQUE KEY `VET_CRMV` (`VET_CRMV`),
  ADD KEY `ESP_CODIGO` (`ESP_CODIGO`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_animal`
--
ALTER TABLE `tbl_animal`
  MODIFY `ANI_CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbl_consulta`
--
ALTER TABLE `tbl_consulta`
  MODIFY `CON_CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbl_diagnostico`
--
ALTER TABLE `tbl_diagnostico`
  MODIFY `DIG_CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbl_dono`
--
ALTER TABLE `tbl_dono`
  MODIFY `DON_CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbl_especialidade`
--
ALTER TABLE `tbl_especialidade`
  MODIFY `ESP_CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tbl_veterinario`
--
ALTER TABLE `tbl_veterinario`
  MODIFY `VET_CODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbl_animal`
--
ALTER TABLE `tbl_animal`
  ADD CONSTRAINT `tbl_animal_ibfk_1` FOREIGN KEY (`DON_CODIGO`) REFERENCES `tbl_dono` (`DON_CODIGO`);

--
-- Restrições para tabelas `tbl_consulta`
--
ALTER TABLE `tbl_consulta`
  ADD CONSTRAINT `tbl_consulta_ibfk_1` FOREIGN KEY (`ANI_CODIGO`) REFERENCES `tbl_animal` (`ANI_CODIGO`),
  ADD CONSTRAINT `tbl_consulta_ibfk_2` FOREIGN KEY (`VET_CODIGO`) REFERENCES `tbl_veterinario` (`VET_CODIGO`);

--
-- Restrições para tabelas `tbl_diagnostico`
--
ALTER TABLE `tbl_diagnostico`
  ADD CONSTRAINT `tbl_diagnostico_ibfk_1` FOREIGN KEY (`ANI_CODIGO`) REFERENCES `tbl_animal` (`ANI_CODIGO`),
  ADD CONSTRAINT `tbl_diagnostico_ibfk_2` FOREIGN KEY (`CON_CODIGO`) REFERENCES `tbl_consulta` (`CON_CODIGO`);

--
-- Restrições para tabelas `tbl_veterinario`
--
ALTER TABLE `tbl_veterinario`
  ADD CONSTRAINT `tbl_veterinario_ibfk_1` FOREIGN KEY (`ESP_CODIGO`) REFERENCES `tbl_especialidade` (`ESP_CODIGO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
