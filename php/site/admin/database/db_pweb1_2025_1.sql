-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

-- Copiando estrutura do banco de dados para db_pweb1_2025_1
CREATE DATABASE IF NOT EXISTS `db_pweb1_2025_1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_pweb1_2025_1`;

-- Copiando estrutura para tabela db_pweb1_2025_1.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Copiando dados para a tabela db_pweb1_2025_1.categoria: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela db_pweb1_2025_1.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(130) COLLATE utf8mb4_bin NOT NULL,categoria
  `descricao` text COLLATE utf8mb4_bin NOT NULL,
  `data_publicacao` datetime NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `categoria_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_post_categoria` (`categoria_id`),
  CONSTRAINT `FK_post_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Copiando dados para a tabela db_pweb1_2025_1.post: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela db_pweb1_2025_1.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE utf8mb4_bin DEFAULT NULL,
  `cpf` varchar(16) COLLATE utf8mb4_bin DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(80) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;


INSERT INTO `categoria` (`nome`) VALUES
	('Esporte'),
	('Política'),
	('Gerais')