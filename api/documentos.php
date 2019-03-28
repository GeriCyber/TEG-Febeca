<?php
$id_categoria = !empty($_POST['id_categoria']) ? $_POST['id_categoria'] : 0;
$id_sucursal = $_POST['id_sucursal'];
require_once '../inc/funciones_bd.php';
$db = new funciones_BD();

$documentos = $db->buscar_documentos($id_categoria);
header("Content-type:application/json");
echo json_encode($documentos);
?>