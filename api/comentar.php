<?php
$id_video = $_POST['id_video'];
$comentario = $_POST['comentario'];
$valoracion = $_POST['valoracion'];
$id_usuario = $_POST['id_usuario'];

require_once '../inc/funciones_bd.php';
$db = new funciones_BD();


if ($db->comentar_video($id_video, $comentario, $valoracion, $id_usuario)){
	$resultado = ['estatus' => 1];
}
else{
	$resultado = ['estatus' => 0];
}

header("Content-type:application/json");
echo json_encode($resultado);
?>