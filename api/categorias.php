<?php
require_once '../inc/funciones_bd.php';
$db = new funciones_BD();
$id_sucursal = $_POST['id_sucursal'];
$result = $db->buscar_categoria($id_sucursal);

header("Content-type:application/json");
echo json_encode($result);
?>