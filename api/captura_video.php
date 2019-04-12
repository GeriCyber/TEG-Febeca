<?php 
$id_usuario = $_POST['id_usuario'];
$id_video = $_POST['id_video'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$vistas = $_POST['vistas'];

require_once '../inc/funciones_bd.php';
$db = new funciones_BD();

if ($db->capture_video($id_usuario,$id_video,$nombre,$descripcion,$vistas)){
	$resultado = ['estatus' => 1];
}
else{
	$resultado = ['estatus' => 0];
}

header("Content-type:application/json");
echo json_encode($resultado);
?>