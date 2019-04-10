<?php
	include '../config/conn.php';

$id_paciente = $_POST["codigos"];
$motivo = $_POST["motivo"];
$patologias = $_POST["patologias"];
$id_usuario = $_POST["id_usuario"];

$conexion = new Conexion();
$cnn = $conexion->getConexion();
$sql = "INSERT INTO consulta (motivo,patologias,id_paciente,id_usuario) VALUES (?,?,?,?);";

$statement = $cnn->prepare( $sql );
	//Enlazar los parámetros de la consulta con los valores del formulario
$statement->bindParam(1, $motivo, PDO::PARAM_STR );
$statement->bindParam(2, $patologias, PDO::PARAM_STR );
$statement->bindParam(3, $id_paciente, PDO::PARAM_INT );
$statement->bindParam(4, $id_usuario, PDO::PARAM_INT );


echo $statement->execute() ? header('Location: ../vistas/pacientes.php')
:"Consulta Registrado Exitosamente"  ;


	//vaciar memoria
	$statement->closeCursor();
	$conexion = null;