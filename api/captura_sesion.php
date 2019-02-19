<?php 
$id_usuario = $_POST['id_usuario']
$id_sucursal = $_POST['id_sucursal'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$preview_date = $_POST['preview_date'];
$last_date = $_POST['last_date'];

require_once '../inc/funciones_bd.php';
$db = new funciones_BD();


if ($db->capture_login($id_usuario,$id_sucursal,$nombre,$apellido,$cedula,$telefono,$correo,$preview_date,$last_date)){
	$resultado = ['estatus' => 1];
}
else{
	$resultado = ['estatus' => 0];
}

header("Content-type:application/json");
echo json_encode($resultado);
?>