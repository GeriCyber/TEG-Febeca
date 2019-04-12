<?php 
$login = $_POST['login'];
$clave = $_POST['clave'];

require_once '../inc/funciones_bd.php';
$db = new funciones_BD();

$resultado = $db->login_app($login,$clave);
header("Content-type:application/json");
echo json_encode($resultado[0]);
?>