CREATE TABLE IF NOT EXISTS `Administradores`(
    `idAdministrador`              INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id del administrador',
    `Nombres`               VARCHAR(100) NOT NULL                COMMENT 'Nombres del administrador',
    `ApellidoPaterno`       VARCHAR(50)      NULL                COMMENT 'Apellido paterno del administrador',
    `ApellidoMaterno`       VARCHAR(50)      NULL                COMMENT 'Apellido materno del administrador',    
    `Password`              VARCHAR(30)  NOT NULL                COMMENT 'Contraseña del administrador',
    `FechaRegistro`         DATETIME     NOT NULL DEFAULT NOW()  COMMENT 'Fecha y hora de creación del registro',
        PRIMARY KEY(`idAdministrador`),
                INDEX `_ixNombreDelAdmin` (`Nombres` , `ApellidoPaterno`, `ApellidoMaterno`)
) COMMENT='Tabla de los Administradores';

CREATE TABLE IF NOT EXISTS `Usuarios`(
    `Nombres`               VARCHAR(100) NOT NULL                COMMENT 'Nombres del usuario',
    `ApellidoPaterno`       VARCHAR(50)      NULL                COMMENT 'Apellido paterno del usuario',
    `Correo`                VARCHAR(50)  NOT NULL                COMMENT 'Apellido materno del usuario',    
    `Password`              VARCHAR(30)  NOT NULL                COMMENT 'Contraseña del usuario',
    `FechaRegistro`         DATETIME     NOT NULL DEFAULT NOW()  COMMENT 'Fecha y hora de creación del registro',
        PRIMARY KEY(`Nombres`),
                INDEX `_ixNombreDelusuario` (`Nombres` , `ApellidoPaterno`)
) COMMENT='Tabla de los usuarios';