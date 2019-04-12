<?php
$id_categoria = !empty($_POST['id_categoria']) ? $_POST['id_categoria'] : 0;
$id_sucursal = $_POST['id_sucursal'];
$id_usuario = $_POST['id_usuario'];
require_once '../inc/funciones_bd.php';
$db = new funciones_BD();

$documentos = $db->buscar_documentos($id_categoria, $id_usuario);
header("Content-type:application/json");
echo json_encode($documentos);
?>