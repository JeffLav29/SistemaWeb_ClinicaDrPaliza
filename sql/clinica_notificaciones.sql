CREATE DATABASE  IF NOT EXISTS `clinica_notificaciones` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `clinica_notificaciones`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: clinica_notificaciones
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `medicamento`
--

DROP TABLE IF EXISTS `medicamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicamento` (
  `idmedicamento` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `dosificacion` varchar(45) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `registrado_en` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idmedicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamento`
--

LOCK TABLES `medicamento` WRITE;
/*!40000 ALTER TABLE `medicamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamento_paciente`
--

DROP TABLE IF EXISTS `medicamento_paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicamento_paciente` (
  `idmedi_paciente` int NOT NULL AUTO_INCREMENT,
  `paciente_id` int NOT NULL,
  `medicamento_id` int NOT NULL,
  `medico_id` int NOT NULL,
  `prescrito_en` timestamp NULL DEFAULT NULL,
  `dosificacion` varchar(45) NOT NULL,
  `duracion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmedi_paciente`),
  KEY `fk_pacienteid_idx` (`paciente_id`),
  KEY `fk_medicamentoid_idx` (`medicamento_id`),
  KEY `fk_medicoid_idx` (`medico_id`),
  CONSTRAINT `fk_medic` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`idmedico`),
  CONSTRAINT `fk_medicamentoid` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamento` (`idmedicamento`),
  CONSTRAINT `fk_pacienteid` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`idpaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamento_paciente`
--

LOCK TABLES `medicamento_paciente` WRITE;
/*!40000 ALTER TABLE `medicamento_paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicamento_paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medico`
--

DROP TABLE IF EXISTS `medico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medico` (
  `idmedico` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `especialidad` varchar(45) NOT NULL,
  `numero_licencia` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `dirrecion_consulta` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmedico`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `numero_licencia_UNIQUE` (`numero_licencia`),
  CONSTRAINT `fk_medicoii` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medico`
--

LOCK TABLES `medico` WRITE;
/*!40000 ALTER TABLE `medico` DISABLE KEYS */;
INSERT INTO `medico` VALUES (11,12,'Carlos','López','Cardiología','LIC12345','987654321','Av. Salud 123, Lima'),(12,13,'María','Pérez','Pediatría','LIC67890','987654322','Av. Niños 456, Lima'),(13,14,'Luis','González','Dermatología','LIC54321','987654323','Av. Piel 789, Lima'),(14,15,'Ana','Ramírez','Ginecología','LIC98765','987654324','Av. Mujer 101, Lima'),(15,16,'José','Fernández','Neurología','LIC13579','987654325','Av. Cerebro 202, Lima');
/*!40000 ALTER TABLE `medico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `notificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificacion` (
  `idnotificacion` int NOT NULL AUTO_INCREMENT,
  `medico_id` int DEFAULT NULL,
  `paciente_id` int DEFAULT NULL,
  `motivo` varchar(255) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `programado_para` timestamp NULL DEFAULT NULL,
  `leido` tinyint DEFAULT '0',
  PRIMARY KEY (`idnotificacion`),
  KEY `fk_medico_idx` (`medico_id`),
  KEY `fk_paciente_idx` (`paciente_id`),
  CONSTRAINT `fk_medico_idi` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`idmedico`),
  CONSTRAINT `fk_pacientedi` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`idpaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacion`
--

LOCK TABLES `notificacion` WRITE;
/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
INSERT INTO `notificacion` VALUES (78,11,7,'Consulta de seguimiento','Recordatorio: Consulta de seguimiento programada.','2024-11-01 15:00:00','2024-11-05 15:00:00',0),(79,12,8,'Control de rutina','Recordatorio: Control de rutina agendado para la fecha.','2024-11-01 19:00:00','2024-11-06 14:00:00',0),(80,13,9,'Revisión dermatológica','Recordatorio: Revisión dermatológica programada.','2024-11-02 14:30:00','2024-11-07 14:30:00',0),(81,14,8,'Consulta ginecológica','Recordatorio: Consulta ginecológica pendiente.','2024-11-03 16:00:00','2024-11-08 16:00:00',0),(82,15,7,'Evaluación neurológica','Recordatorio: Evaluación neurológica programada.','2024-11-04 20:00:00','2024-11-09 20:00:00',0);
/*!40000 ALTER TABLE `notificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `idpaciente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `dirrecion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (7,'Juan','Pérez','12345678','1980-05-15','M','987654321','Av. Siempre Viva 123'),(8,'María','López','87654321','1990-08-25','F','912345678','Calle Falsa 456'),(9,'Jefferson','Lavado','62603415','2003-09-29','M','900335726','MiCasa');
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(45) NOT NULL,
  `contra` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `nom_user_UNIQUE` (`nom_user`),
  UNIQUE KEY `correo_UNIQUE` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (12,'carlos.lopez','password123','carlos.lopez@clinica.com','medico'),(13,'maria.perez','password456','maria.perez@clinica.com','medico'),(14,'luis.gonzalez','password789','luis.gonzalez@clinica.com','medico'),(15,'ana.ramirez','password101','ana.ramirez@clinica.com','medico'),(16,'jose.fernandez','password202','jose.fernandez@clinica.com','medico');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-03 11:36:28
