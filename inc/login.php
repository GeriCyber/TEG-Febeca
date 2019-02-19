<?php
session_start();
/*LOGIN*/

$id_usuario = $_POST['usuario'];
$clave = $_POST['password'];
$android = !empty($_POST['android']) ? true : false;

require_once 'funciones_bd.php';
$db = new funciones_BD();

$resultado = $db->login($id_usuario,$clave);

if (!$android)
{
    if ($resultado[0]["logstatus"] == 1)
    {
        if($resultado[0]["estatus"] == 1 || $resultado[0]["id_sucursal"] == 0)
        {
            $_SESSION["id_rol"] = $resultado[0]["id_rol"];
            $_SESSION["id_usuario"] = $resultado[0]["id_usuario"];
            $_SESSION["taller"] = $resultado[0]["taller"];
            $_SESSION["nombre"] = $resultado[0]["nombre"];
            $_SESSION["apellido"] = $resultado[0]["apellido"];
            $_SESSION["id_sucursal"] = $resultado[0]["id_sucursal"];
            switch ($resultado[0]["id_rol"]) 
            {
                case "admin":
                    header("Location: ../dashboard.php");
                    break;

                case "analista":
                    header("Location: ../dashboard.php");
                    break;

                case "usuario":
                    $error = urlencode("No tienes permisos para ingresar");
                    header("Location:../index.php?error=".$error);
                    break;

                default:
                    break;
            }
        }
        else
        {
            $error = urlencode("Empresa inactiva, comunícate con el administrador");
            header("Location:../index.php?error=".$error);
            die;
        }
    }
    else
    {
        $error = urlencode("Usuario o Contraseña inválida");
        header("Location:../index.php?error=".$error);
        die;
    }
}
echo json_encode($resultado);

?>
