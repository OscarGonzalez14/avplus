show tables;
CREATE consultas(
  id_consulta INT(11) NOT NULL AUTO_INCREMENT,
  motivo TEXT NULL DEFAULT NULL,
  patologias TEXT NULL DEFAULT NULL,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  primary key(id_consulta)
