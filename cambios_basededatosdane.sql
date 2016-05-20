ALTER TABLE `dane_banco`.`usuario` 
ADD COLUMN `trabaja` CHAR(2) CHARACTER SET 'utf8' NULL  AFTER `fecha_acti`,
ADD COLUMN `trabaja_dane` CHAR(2) CHARACTER SET 'utf8' NULL AFTER `trabaja`;


CREATE TABLE `dane_banco`.`param_tipo_vinculacion` (
  `id_tipo_vinculacion` INT NOT NULL AUTO_INCREMENT,
  `nom_vinculacion` VARCHAR(256) NOT NULL,
  `estado` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_vinculacion`));

CREATE TABLE `dane_banco`.`param_dependencia` (
  `id_dependencia` INT NOT NULL AUTO_INCREMENT,
  `nom_dependencia` VARCHAR(256) NOT NULL,
  `estado` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_dependencia`));


CREATE TABLE `dane_banco`.`param_tipo_trabajador` (
  `id_tipo_trabajador` INT NOT NULL AUTO_INCREMENT,
  `nom_tipo_trabajador` VARCHAR(256) NOT NULL,
  `estado` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_trabajador`));

INSERT INTO `dane_banco`.`param_tipo_trabajador` (`id_tipo_trabajador`, `nom_tipo_trabajador`) VALUES ('1', 'EMPLEADO');
INSERT INTO `dane_banco`.`param_tipo_trabajador` (`id_tipo_trabajador`, `nom_tipo_trabajador`) VALUES ('2', 'INDEPENDIENTE');


CREATE TABLE `dane_banco`.`param_actividad_economica` (
  `id_actividad_economica` INT NOT NULL AUTO_INCREMENT,
  `nom_actividad_economica` VARCHAR(256) NOT NULL,
  `estado` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_actividad_economica`));

CREATE TABLE `dane_banco`.`param_tipo_entidad` (
  `id_tipo_entidad` INT NOT NULL AUTO_INCREMENT,
  `nom_tipo_entidad` VARCHAR(256) NOT NULL,
  `estado` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_entidad`));

INSERT INTO `param_tipo_entidad` (`id_tipo_entidad`, `nom_tipo_entidad`, `estado`) VALUES (NULL, 'PRIVADA', '1'), (NULL, 'PUBLICA', '1');


CREATE TABLE `us_info_laboral` (
  `id_info_laboral` int(11) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `id_tipo_vinculacion` int(11) DEFAULT NULL,
  `id_dependencia` int(11) DEFAULT NULL,
  `id_tipo_trabajador` int(11) DEFAULT NULL,
  `id_tipo_entidad` int(11) DEFAULT NULL,
  `id_actividad_economica` int(11) DEFAULT NULL,
  `entidad` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dependencia` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codi_pais` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(2) COLLATE utf8_spanish_ci DEFAULT 'AC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `us_info_laboral`
--
ALTER TABLE `us_info_laboral`
  ADD PRIMARY KEY (`id_info_laboral`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `us_info_laboral`
--
ALTER TABLE `us_info_laboral`
  MODIFY `id_info_laboral` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `us_info_laboral`
--
ALTER TABLE `us_info_laboral`
  ADD CONSTRAINT `us_info_laboral_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE NO ACTION;

