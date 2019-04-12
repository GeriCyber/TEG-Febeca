<?php 
$id_usuario = $_POST['id_usuario'];
$id_documento = $_POST['id_documento'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

require_once '../inc/funciones_bd.php';
$db = new funciones_BD();

if ($db->capture_documento($id_usuario,$id_documento,$nombre,$descripcion)){
	$resultado = ['estatus' => 1];
}
else{
	$resultado = ['estatus' => 0];
}

header("Content-type:application/json");
echo json_encode($resultado);
?>