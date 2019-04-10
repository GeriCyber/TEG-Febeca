<?php

class funciones_BD 
{
    public function __construct() 
    {
        require_once 'protected/config.php';
        $this->user = DB_USER;
        $this->password = DB_PASSWORD;
        $this->database = DB_DATABASE;
        $this->host = DB_HOST;
    }
    protected function connect() 
    {
        return mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    // destructor
    function __destruct() 
    {
        mysqli_close($this->connect());
    }

    /**
     * Verificar si el usuario ya existe por la cedula
     */

    public function isuserexist($cedula) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT cedula from usuarios WHERE cedula = '$cedula'");

        $num_rows = mysqli_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) 
           return true; // el usuario existe
         else 
            return false; // no existe
    }

    /**
     * Verificar si el usuario ya existe por la cedula
     */

    public function isUserNameExist($id_usuario) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT id_usuario from usuarios WHERE id_usuario = '$id_usuario'");

        $num_rows = mysqli_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) 
           return true; // el usuario existe
         else 
            return false; // no existe
    }

    /**
     * Verificar si la empresa ya existe por el nombre
     */
    public function isempresaexist($nombre) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT nombre from sucursales WHERE nombre = '$nombre'");

        $num_rows = mysqli_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) 
           return true; // la empresa existe
         else 
            return false; // no existe
    }
    public function isVideoExist($nombre) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT nombre from videos WHERE nombre = '$nombre'");

        $num_rows = mysqli_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) 
           return true; // el video existe
         else 
            return false; // no existe
    }

    public function GetVideoName($id_video) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT id_video, archivo from videos WHERE id_video = '$id_video'");
        $num_rows = mysqli_num_rows($result);
        $archivo='';
        if ($num_rows == 1) 
        {
            $fila = mysqli_fetch_assoc($result);
            $archivo = $fila["archivo"];
        }
        return $archivo;
    }
    public function GetVideo($id_video) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT id_video, nombre from videos WHERE id_video = '$id_video'");
        $num_rows = mysqli_num_rows($result);
        $archivo='';
        if ($num_rows == 1) 
        {
            $fila = mysqli_fetch_assoc($result);
            $archivo = $fila["nombre"];
        }
        return $archivo;
    }
    public function GetEmpresaName($id_sucursal) 
    {
        $db = $this->connect();
        $empresa='';
        $result = mysqli_query($db, "SELECT id_sucursal, nombre from sucursales WHERE id_sucursal = '$id_sucursal'");
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 1) 
        {
            $fila = mysqli_fetch_assoc($result);
            $empresa = $fila["nombre"];
        }
        return $empresa;
    }
    public function GetUserFullName($id_usuario) 
    {
        $db = $this->connect();
        $usuario='';
        $result = mysqli_query($db, "SELECT id_usuario, nombre, apellido from usuarios WHERE id_usuario = '$id_usuario'");
        $num_rows = mysqli_num_rows($result);
        if($num_rows == 1) 
        {
            $fila = mysqli_fetch_assoc($result);
            $usuario = $fila["nombre"].' '.$fila["apellido"];
        }
        return $usuario;
    }
    public function GetEmpresaID($id_categoria) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT id_sucursal from categorias WHERE id_categoria = '$id_categoria'");
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 1) 
        {
            $fila = mysqli_fetch_assoc($result);
            $empresa = $fila["id_sucursal"];
        }
        return $empresa;
    }
    public function GetCategoryName($id_categoria) 
    {
        $db = $this->connect();
        $categoria='';
        $result = mysqli_query($db, "SELECT id_categoria, descripcion from categorias WHERE id_categoria = '$id_categoria'");
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 1) 
        {
            $fila = mysqli_fetch_assoc($result);
            $categoria = $fila["descripcion"];
        }
        return $categoria;
    }
    public function GetComentario($id_comentario) 
    {
        $db = $this->connect();
        $comentario='';
        $result = mysqli_query($db, "SELECT id_comentario, descripcion from comentarios WHERE id_comentario = '$id_comentario'");
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 1) 
        {
            $fila = mysqli_fetch_assoc($result);
            $comentario = substr($fila["comentario"],0,70);
        }
        return $comentario;
    }

    public function GetDocName($id_documento) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT id_documento, archivo from documentos WHERE id_documento = '$id_documento'");
        $num_rows = mysqli_num_rows($result);
        $fila;
        if ($num_rows == 1) 
            $fila = mysqli_fetch_assoc($result);

        return $fila["archivo"];
    }

    public function GetDoc($id_documento) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT id_documento, nombre from documentos WHERE id_documento = '$id_documento'");
        $num_rows = mysqli_num_rows($result);
        $fila;
        if ($num_rows == 1) 
            $fila = mysqli_fetch_assoc($result);

        return $fila["nombre"];
    }

    public function isDocumentExist($nombre) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT nombre from documentos WHERE nombre = '$nombre'");

        $num_rows = mysqli_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) 
           return true; // el documento existe
         else 
            return false; // no existe
    }
    public function isEmailExist($correo) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT correo from usuarios WHERE correo = '$correo'");

        $num_rows = mysqli_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) 
           return true; // el correo existe
         else 
            return false; // no existe
    }
    public function isVideoAsignado($id_video) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT id_video from videos_asignados WHERE id_video = '$id_video'");

        $num_rows = mysqli_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) 
           return true; 
         else 
            return false; // no existe
    }
    public function isDocumentoAsignado($id_documento) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT id_documento from documentos_asignados WHERE id_documento = '$id_documento'");
        $num_rows = mysqli_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) 
           return true;
         else 
            return false; // no existe
    }

    /**
     * agregar nuevo usuario
     */
    public function adduser($id_sucursal, $id_usuario, $clave, $id_rol, $nombre, $apellido, $cedula, $telefono, $correo, $taller = 0) 
    {
        $db = $this->connect();
        $clave_encriptada = mysqli_real_escape_string($db, md5($clave));
        $nombre_codificado = mysqli_real_escape_string($db, ($nombre));
        $apellido_codificado = mysqli_real_escape_string($db, ($apellido));

        $sql =
            "INSERT INTO usuarios(
                id_sucursal,
                id_usuario,
                clave,
                id_rol,
                nombre,
                apellido,
                cedula,
                telefono,
                correo,
                taller
            )
            VALUES(
                $id_sucursal,
                '$id_usuario',
                '$clave_encriptada',
                '$id_rol',
                '$nombre_codificado',
                '$apellido_codificado',
                '$cedula',
                '$telefono',
                '$correo',
                $taller
            )";
        $result = mysqli_query($db, $sql);
        // check for successful store

        if ($result) 
            return true;
        else 
            return false;
    }

    public function actualizar_usuario($id_sucursal, $id_rol, $nombre, $apellido, $cedula, $telefono, $correo, $taller, $id_usuario, $clave)
    {
        $db = $this->connect();
        $clave_encriptada = mysqli_real_escape_string($db, md5($clave));
        $nombre_codificado = mysqli_real_escape_string($db, ($nombre));
        $apellido_codificado = mysqli_real_escape_string($db, ($apellido));
        $cedula_codificado = mysqli_real_escape_string($db, ($cedula));
        $sql = "UPDATE usuarios 
                SET id_sucursal = '$id_sucursal',
                id_rol = '$id_rol',
                nombre = '$nombre_codificado',
                apellido = '$apellido_codificado',
                cedula = '$cedula_codificado',
                telefono = '$telefono',
                correo = '$correo',
                clave = '$clave_encriptada',
                taller = $taller
                WHERE id_usuario = '$id_usuario'";
        $result = mysqli_query($db, $sql);
        if ($result) 
            return true;
        else 
            return false;
    }

    public function buscar_usuarios()
    {
        $db = $this->connect();
        $sql = "SELECT U.id_sucursal, U.id, U.id_usuario, U.id_rol, U.telefono, U.nombre, U.apellido, U.cedula, U. correo, U.taller, U.active_directory, U.base_datos, R.descripcion AS nombre_rol, S.nombre AS nombre_sucursal 
                FROM usuarios U 
                INNER JOIN roles R ON R.id_rol = U.id_rol 
                INNER JOIN sucursales S ON S.id_sucursal = U.id_sucursal WHERE 1";

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                //el registro individual
                $rol = $this->buscar_rol($registro["id_rol"]);
                $datos = array(
                    'id' => $registro['id'],
                    'id_usuario' => $registro['id_usuario'],
                    'nombre_sucursal' => $registro['nombre_sucursal'],
                    'id_rol' => $registro['id_rol'],
                    'nombre' => $registro['nombre'],
                    'apellido' => $registro['apellido'],
                    'cedula' => $registro['cedula'],
                    'telefono' => $registro['telefono'],
                    'correo' => $registro['correo'],
                    'rol' => $rol,
                    'taller' => $registro["taller"],
                    'active_directory' => $registro['active_directory'],
                    'base_datos' => $registro['base_datos'],
                    'nombre_rol' => $registro['nombre_rol'],
                    'id_sucursal' => $registro['id_sucursal']

                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function listar_usuarios($id_rol = "", $id_usuario = "", $id = 0, $id_sucursal = 0)
    {
        $db = $this->connect();
        $sql = "SELECT U.id_sucursal, U.id, U.id_usuario, U.id_rol, U.telefono, U.nombre, U.apellido, U.cedula, U. correo, U.taller, U.active_directory, U.base_datos, R.descripcion as nombre_rol FROM usuarios U INNER JOIN roles R on R.id_rol = U.id_rol WHERE 1";
        if (!empty($id_rol))
        {
            $sql .= " AND id_rol = '$id_rol'";
        }

        if (!empty($id_usuario))
        {
            $sql .= " AND id_usuario = '$id_usuario' ";
        }

        if (!empty($id))
        {
            $sql .= " AND id = $id ";
        }

        if (!empty($id_sucursal))
        {
            $sql .= " AND id_sucursal = $id_sucursal ";
        }

        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $arreglo["data"][] = array_map("utf8_encode", $registro);
            }
            $lista = json_encode($arreglo);
        }
        return ($lista);
    }

    public function login($id_usuario,$clave)
    {
        $db = $this->connect();
        $clave_encriptada = mysqli_real_escape_string($db,md5($clave));
        $result = mysqli_query($db, "SELECT U.*, S.logo, S.estatus, S.nombre as nombre_sucursal FROM usuarios U LEFT JOIN sucursales S on S.id_sucursal = U.id_sucursal WHERE U.id_usuario='$id_usuario' AND U.clave='$clave_encriptada' LIMIT 1");
        if (mysqli_num_rows($result) > 0)
        {
            $registro = mysqli_fetch_assoc($result);
            $logo_url = sprintf("%s://%s/gericyber/teg/%s", 
                        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                        $_SERVER['SERVER_NAME'],                    
                        $registro['logo']);
            $datos = array(
                "logstatus" => 1,
                "id_sucursal" => $registro["id_sucursal"],
                "nombre_sucursal" => $registro["nombre_sucursal"],
                "id_usuario" => $registro["id_usuario"],
                "id_rol" => $registro["id_rol"],
                "nombre" => $registro["nombre"],
                "apellido" => $registro["apellido"],
                "taller" => $registro["taller"],
                "id" => $registro["id"],
                "estatus" => $registro["estatus"],
                "logo_url" => !empty($registro['logo']) ? $logo_url : ""
            );
            /*como el usuario debe ser unico cuenta el numero de ocurrencias con esos datos*/
        }
        else 
        {
            $datos = array(
                "logstatus" => 0,
            );
        }
        $lista = array();
        $lista[] = $datos;

        return ($lista);
    }

    public function cambiar_clave($id_usuario, $clave_antigua, $clave_nueva)
    {
        $db = $this->connect(); 
        $clave_antigua_encriptada = mysqli_real_escape_string($db, md5($clave_antigua));
        $clave_nueva_encriptada = mysqli_real_escape_string($db, md5($clave_nueva));
        $sql = "UPDATE usuarios SET clave = '$clave_nueva_encriptada' WHERE id_usuario = '$id_usuario' AND clave = '$clave_antigua_encriptada' ";
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            if (mysqli_affected_rows($db) > 0)
                return true;
            else 
                return false;
        }
        else
            return false;
    }

    public function eliminar_usuario($id_usuario)
    {
        $db = $this->connect();
        $sql = "DELETE FROM usuarios WHERE id_usuario = '$id_usuario'";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function eliminar_comentario($id_comentario)
    {
        $db = $this->connect();
        $sql = "DELETE FROM comentarios WHERE id_comentario = '$id_comentario'";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }
    public function eliminar_asignacion_video($id_video)
    {
        $db = $this->connect();
        $sql = "DELETE FROM videos_asignados WHERE id_video = $id_video";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }
    public function eliminar_asignacion_video_por_categoria($id_categoria)
    {
        $db = $this->connect();
        $sql = "DELETE FROM videos_asignados WHERE id_categoria = $id_categoria";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }
    public function eliminar_asignacion_documento_por_categoria($id_categoria)
    {
        $db = $this->connect();
        $sql = "DELETE FROM documentos_asignados WHERE id_categoria = $id_categoria";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }
    public function eliminar_asignacion_documento($id_documento)
    {
        $db = $this->connect();
        $sql = "DELETE FROM documentos_asignados WHERE id_documento = $id_documento";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function buscar_rol($id_rol = "", $descripcion = "")
    {
        $db = $this->connect();
        $sql = "SELECT * FROM roles WHERE 1 ";
        if (!empty($id_rol)){
            $sql .= " AND id_rol = '$id_rol' ";
        }

        if (!empty($descripcion)){
            $sql .= " AND descripcion like '%$descripcion%' ";
        }

        $lista = array();
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0){
            while ($registro = mysqli_fetch_assoc($result)){
                //el registro individual
                $datos = array(
                    'id_rol' => $registro['id_rol'],
                    'descripcion' => $registro['descripcion'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function cantidad_registros_tabla($tabla)
    {
        $db = $this->connect();
        $tabla_codificado = mysqli_real_escape_string($db,$tabla);
        $sql = "SELECT COUNT(*) as cantidad FROM $tabla_codificado";
        $result = mysqli_query($db,$sql);
        if ($result)
        {
            $registro = mysqli_fetch_array($result);
            return $registro["cantidad"];
        }
        else
            return -1;
    }

    public function buscar_categoria($id_sucursal)
    {
        $db = $this->connect();
        $sql = "SELECT * FROM categorias WHERE id_sucursal = '$id_sucursal'";

        //lista de datos a enviar en JSON
        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                //el registro individual
                $datos = array(
                    'id_categoria' => $registro['id_categoria'],
                    'descripcion' => $registro['descripcion']
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }    

    public function listar_categorias()
    {
        $db = $this->connect();
        $sql = "SELECT * FROM categorias AS C INNER JOIN sucursales S on C.id_sucursal = S.id_sucursal ORDER BY id_categoria ASC";
        $lista = [];
        $i=0;
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $lista[] = 
                [
                    'id_categoria' => $registro['id_categoria'],
                    'descripcion' => $registro['descripcion'],
                    'nombre' => $registro['nombre']
                ];
            }
        }
        return $lista;
    }

    public function registrar_categoria($id_sucursal, $descripcion)
    {
        $db = $this->connect();
        $descripcion_codificado = mysqli_real_escape_string($db, ($descripcion));
        $sql =
            "INSERT INTO categorias(
                id_sucursal,
                descripcion
             )
             VALUES(
                $id_sucursal,
                '$descripcion_codificado'
             )";
        $result = mysqli_query($db, $sql);

        if ($result) 
            return mysqli_insert_id($db);
        else 
            return false;
    }

    public function modificar_categoria($id_categoria, $descripcion)
    {
        $db = $this->connect();
        $descripcion_codificado = mysqli_real_escape_string($db, ($descripcion));
        $sql = "UPDATE categorias SET "
                . " descripcion = '$descripcion_codificado' "
                . " WHERE id_categoria = $id_categoria ";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function eliminar_categoria($id_categoria)
    {
        $db = $this->connect();
        $sql = "DELETE FROM categorias WHERE id_categoria = $id_categoria";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function isCategoryExist($descripcion) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT descripcion from categorias WHERE descripcion = '$descripcion'");
        $num_rows = mysqli_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) 
            // la dependencia existe
            return true;
         else 
            // no existe
            return false;
    }

    public function registrar_video($nombre, $descripcion, $archivo, $checkbox_etiqueta, $fecha_caduc, $id_usuario)
    {
        $db = $this->connect();
        $nombre_codificado = mysqli_real_escape_string($db, ($nombre));
        $descripcion_codificado = mysqli_real_escape_string($db, ($descripcion));

        $valido = true;
        if (!empty($archivo))
        {
            $nombre_archivo_mostrar = $archivo['name'];
            $nombre_archivo = uniqid().date('Ymdhis').'.'.pathinfo($nombre_archivo_mostrar, PATHINFO_EXTENSION);
            if (!move_uploaded_file($archivo['tmp_name'], '../../uploads/videos/'.$nombre_archivo))
                $valido = false;
        }

        if ($valido)
        {
            $sql = "INSERT INTO videos(nombre, descripcion, archivo, archivo_mostrar, etiqueta, fecha_caducidad, id_usuario_creacion) VALUES('$nombre_codificado', '$descripcion_codificado', 'videos/$nombre_archivo', '$nombre_archivo_mostrar', '$checkbox_etiqueta', '$fecha_caduc', '$id_usuario')";
            $result = mysqli_query($db, $sql);
            if ($result)
            {
                if (mysqli_affected_rows($db) > 0)
                    return true;
            }   
            else
                return false;
        }
        else
            return false;
    }

    public function registrar_documento($nombre, $descripcion, $archivo, $checkbox_etiqueta, $fecha_caduc, $id_usuario)
    {
        $db = $this->connect();
        $nombre_codificado = mysqli_real_escape_string($db, ($nombre));
        $descripcion_codificado = mysqli_real_escape_string($db, ($descripcion));
        $valido = true;

        if (!empty($archivo))
        {
            $nombre_archivo_mostrar = $archivo['name'];
            $nombre_archivo = uniqid().date('Ymdhis').'.'.pathinfo($nombre_archivo_mostrar, PATHINFO_EXTENSION);
            if (!move_uploaded_file($archivo['tmp_name'], '../../uploads/docs/'.$nombre_archivo))
                $valido = false;
        }

        if ($valido)
        {
            $sql = "INSERT INTO documentos(nombre, descripcion, archivo, archivo_mostrar, etiqueta, fecha_caducidad, id_usuario_creacion) VALUES('$nombre_codificado', '$descripcion_codificado', 'docs/$nombre_archivo', '$nombre_archivo_mostrar', '$checkbox_etiqueta', '$fecha_caduc', '$id_usuario')";
            $result = mysqli_query($db, $sql);
            if ($result)
            {
                if (mysqli_affected_rows($db) > 0)
                    return true;
            }   
            else
                return false;
        }
        else
            return false;
    }

    public function actualizar_video($id_video, $checkbox_etiqueta, $fecha_caduc, $id_usuario)
    {
        $db = $this->connect();
        $sql = "UPDATE videos SET etiqueta = '$checkbox_etiqueta', fecha_caducidad = '$fecha_caduc', id_usuario_creacion = '$id_usuario' WHERE id_video = $id_video";
        $result = mysqli_query($db, $sql);
        if($result)
        {
            if (mysqli_affected_rows($db) > 0)
                return true;
        }
        else
            return false;
    }
    public function asignar_video($id_empresa, $id_video, $id_categoria)
    {
        $db = $this->connect();
        $sql = "INSERT INTO videos_asignados(id_sucursal, id_video, id_categoria) VALUES($id_empresa, $id_video, $id_categoria)";
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            if (mysqli_affected_rows($db) > 0)
                return true;
        }   
        else
            return false;
    }
    public function asignar_documento($id_empresa, $id_documento, $id_categoria)
    {
        $db = $this->connect();
        $sql = "INSERT INTO documentos_asignados(id_sucursal, id_documento, id_categoria) VALUES($id_empresa, $id_documento, $id_categoria)";
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            if (mysqli_affected_rows($db) > 0)
                return true;
        }   
        else
            return false;
    }

    public function actualizar_documento($id_documento, $checkbox_etiqueta, $fecha_caduc, $id_usuario)
    {
        $db = $this->connect();
        $sql = "UPDATE documentos SET etiqueta = '$checkbox_etiqueta', fecha_caducidad = '$fecha_caduc', id_usuario_creacion = '$id_usuario' WHERE id_documento = $id_documento";
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            if (mysqli_affected_rows($db) > 0)
                return true;
        }
        else
            return false;
    }

    /*public function buscar_videos($id_categoria = 0)
    {
        $db = $this->connect();
        $sql = "SELECT V.*, C.descripcion as nombre_categoria, S.nombre as nombre_sucursal FROM videos V INNER JOIN sucursales S on S.id_sucursal = V.id_sucursal INNER JOIN categorias C on C.id_categoria = V.id_categoria WHERE 1 ";
        if (!empty($id_categoria)){
            $sql .= "AND V.id_categoria = $id_categoria";
        }

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result){
            while ($registro = mysqli_fetch_assoc($result)){
                $url = sprintf("%s://%s/gericyber/teg/uploads/videos/%s", 
                    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                    $_SERVER['SERVER_NAME'],                    
                    $registro['archivo']);
                //el registro individual
                $datos = array(
                    'id_video' => $registro['id_video'],
                    'id_categoria' => $registro['id_categoria'],
                    'nombre_categoria' => $registro['nombre_categoria'],
                    'nombre' => $registro['nombre'],
                    'descripcion' => $registro['descripcion'],
                    'archivo' => $registro['archivo'],
                    'archivo_mostrar' => $registro['archivo_mostrar'],
                    'src' => $url,
                    'id_usuario_creacion' => $registro['id_usuario_creacion'],
                    'id_sucursal' => $registro["id_sucursal"],
                    'nombre_sucursal' => $registro['nombre_sucursal']
                );
                $lista[] = $datos;
            }
        }
        return ($lista);

    }

    public function buscar_documentos($id_categoria = 0)
    {
        $db = $this->connect();
        $sql = "SELECT V.*, C.descripcion as nombre_categoria, S.nombre as nombre_sucursal FROM documentos V LEFT JOIN sucursales S on S.id_sucursal = V.id_sucursal LEFT JOIN categorias C on C.id_categoria = V.id_categoria WHERE 1 ";
        if (!empty($id_categoria)){
            $sql .= "AND V.id_categoria = $id_categoria";
        }

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result)){
                $url = sprintf("%s://%s/gericyber/teg/uploads/docs/%s", 
                    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                    $_SERVER['SERVER_NAME'],                    
                    $registro['archivo']);
                //el registro individual
                $datos = array(
                    'id_documento' => $registro['id_documento'],
                    'id_categoria' => $registro['id_categoria'],
                    'nombre' => $registro['nombre'],
                    'descripcion' => $registro['descripcion'],
                    'archivo' => $registro['archivo'],
                    'archivo_mostrar' => $registro['archivo_mostrar'],
                    'src' => $url,
                    'id_usuario_creacion' => $registro['id_usuario_creacion'],
                    'id_sucursal' => $registro["id_sucursal"],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);

    }*/

    public function buscar_videos_disponibles($id_sucursal)
    {
        $db = $this->connect();
        $sql = "SELECT DISTINCT V.archivo, V.archivo_mostrar FROM videos V WHERE EXISTS(SELECT * FROM videos WHERE archivo = V.archivo AND id_sucursal = $id_sucursal) = FALSE ";
        $result = mysqli_query($db, $sql);
        $lista = [];
        if ($result){
            while ($registro = mysqli_fetch_assoc($result)){
                $datos = [
                    'archivo' => $registro['archivo'],
                    'archivo_mostrar' => $registro['archivo_mostrar']
                ];

                $lista[] = $datos;
            }
        }
        return $lista;
    }

    public function buscar_documentos_disponibles($id_sucursal)
    {
        $db = $this->connect();
        $sql = "SELECT DISTINCT V.archivo, V.archivo_mostrar FROM documentos V WHERE EXISTS(SELECT * FROM documentos WHERE archivo = V.archivo AND id_sucursal = $id_sucursal) = FALSE ";
        $result = mysqli_query($db, $sql);
        $lista = [];
        if ($result){
            while ($registro = mysqli_fetch_assoc($result)){
                $datos = [
                    'archivo' => $registro['archivo'],
                    'archivo_mostrar' => $registro['archivo_mostrar']
                ];

                $lista[] = $datos;
            }
        }
        return $lista;
    }

    public function listar_videos()
    {
        $db = $this->connect();
        $sql = "SELECT * FROM videos WHERE 1";

        //lista de datos a enviar en JSON
        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $url = sprintf("%s://%s/gericyber/teg/uploads/videos/%s", 
                    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                    $_SERVER['SERVER_NAME'],                    
                    $registro['archivo']);
                //el registro individual
                $datos = array(
                    'id_video' => $registro['id_video'],
                    'nombre' => $registro['nombre'],
                    'descripcion' => $registro['descripcion'],
                    'archivo' => $registro['archivo'],
                    'archivo_mostrar' => $registro['archivo_mostrar'],
                    'etiqueta' => $registro['etiqueta'],
                    'fecha_caducidad' => $registro['fecha_caducidad'],
                    'src' => $url,
                    'id_usuario_creacion' => $registro['id_usuario_creacion']
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function videos_asignados($id_video)
    {
        $db = $this->connect();
        $sql = "SELECT * FROM videos_asignados WHERE $id_video = id_video";

        //lista de datos a enviar en JSON
        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'id_sucursal' => $registro['id_sucursal'],
                    'id_categoria' => $registro['id_categoria'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }
    public function documentos_asignados($id_documento)
    {
        $db = $this->connect();
        $sql = "SELECT * FROM documentos_asignados WHERE $id_documento = id_documento";

        //lista de datos a enviar en JSON
        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'id_sucursal' => $registro['id_sucursal'],
                    'id_categoria' => $registro['id_categoria'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function listar_documentos()
    {
        $db = $this->connect();
        $sql = $sql = "SELECT * FROM documentos WHERE 1";

        //lista de datos a enviar en JSON
        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $url = sprintf("%s://%s/gericyber/teg/uploads/docs/%s", 
                    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                    $_SERVER['SERVER_NAME'],                    
                    $registro['archivo']);
                //el registro individual
                $datos = array(
                    'id_documento' => $registro['id_documento'],
                    'nombre' => $registro['nombre'],
                    'descripcion' => $registro['descripcion'],
                    'archivo' => $registro['archivo'],
                    'archivo_mostrar' => $registro['archivo_mostrar'],
                    'etiqueta' => $registro['etiqueta'],
                    'fecha_caducidad' => $registro['fecha_caducidad'],
                    'src' => $url,
                    'id_usuario_creacion' => $registro['id_usuario_creacion']
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function eliminar_video($id_video)
    {
        $db = $this->connect();
        $sql = "DELETE FROM videos WHERE id_video = $id_video";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function eliminar_documento($id_documento)
    {
        $db = $this->connect();
        $sql = "DELETE FROM documentos WHERE id_documento = $id_documento";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function buscar_comentarios()
    {
        $db = $this->connect();
        $sql = "SELECT C.*, V.nombre as nombre_video FROM comentarios C INNER JOIN videos V on V.id_video = C.id_video";
        if (!empty($id_video))
            $sql .= " AND V.id_video = $id_video";
        $sql .= " ORDER BY C.fecha DESC ";
        $lista = [];
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $lista[] = 
                [
                    'id_comentario' => $registro['id_comentario'],
                    'id_video' => $registro['id_video'],
                    'nombre_video' => $registro['nombre_video'],
                    'comentario' => $registro['comentario'],
                    'valoracion' => $registro['valoracion'],
                    'fecha' => $registro['fecha'],
                    'id_usuario' => $registro['id_usuario']
                ];
            }
        }
        return $lista;
    }

    public function GetAuditoria()
    {
        $db = $this->connect();
        $sql = "SELECT * FROM auditoria";
        $result = mysqli_query($db, $sql);
        $lista = array();
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'usuario' => $registro['usuario'],
                    'empresa' => $registro['empresa'],
                    'elemento' => $registro['elemento'],
                    'accion' => $registro['accion'],
                    'fecha' => $registro['fecha']
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function RegisterActivity($usuario, $empresa, $elemento, $fecha, $accion)
    {
        $db = $this->connect();
        $sql = "INSERT INTO auditoria(usuario, empresa, elemento, fecha, accion) VALUES('$usuario', '$empresa', '$elemento', '$fecha', '$accion')";
        $result = mysqli_query($db, $sql);        
        if ($result)
            return true;
        else
            return false;
    }

    public function buscar_cantidad_comentarios()
    {
        $db = $this->connect();
        $sql = "SELECT C.*, V.nombre as nombre_video FROM comentarios C INNER JOIN videos V on V.id_video = C.id_video";
        if (!empty($id_video))
          $sql .= " AND V.id_video = $id_video";
        $nrovaloraciones = mysqli_num_rows(mysqli_query($db, $sql));
    }

    public function registrar_sucursal($nombre, $direccion, $telefono, $correo, $estatus, $archivo)
    {
        $db = $this->connect();
        $logo = '';
        $valido = true;
        $nombre_codificado = mysqli_real_escape_string($db, ($nombre));
        $direccion_codificado = mysqli_real_escape_string($db, ($direccion));
        $telefono_codificado = mysqli_real_escape_string($db, ($telefono));
        $correo_codificado = mysqli_real_escape_string($db, ($correo));

        if (!empty($archivo))
        {
            $nombre_archivo_mostrar = $archivo['name'];
            $logo = uniqid().date('Ymdhis').'.'.pathinfo($nombre_archivo_mostrar, PATHINFO_EXTENSION);
            if(!move_uploaded_file($archivo['tmp_name'], '../../uploads/'.$logo))
            {
                $valido = false;
                $logo = '';                
            }
        }

        $sql = "INSERT INTO sucursales(nombre, direccion, telefono, correo, estatus, logo) VALUES('$nombre_codificado', '$direccion_codificado', '$telefono_codificado', '$correo_codificado', $estatus, '$logo')";
        $result = mysqli_query($db, $sql);        
        if ($result)
            return mysqli_insert_id($db);
        else
            return false;
    }

    public function actualizar_sucursal($id_sucursal, $nombre, $direccion, $telefono, $correo, $archivo)
    {
        $db = $this->connect();
        $logo = '';
        $valido = true;
        $nombre_codificado = mysqli_real_escape_string($db, $nombre);
        $direccion_codificado = mysqli_real_escape_string($db, $direccion);
        $telefono_codificado = mysqli_real_escape_string($db, $telefono);
        $correo_codificado = mysqli_real_escape_string($db, $correo);

        if (!empty($archivo))
        {
            $nombre_archivo_mostrar = $archivo['name'];
            $logo = uniqid().date('Ymdhis').'.'.pathinfo($nombre_archivo_mostrar, PATHINFO_EXTENSION);
            if (!move_uploaded_file($archivo['tmp_name'], '../../uploads/'.$logo))
            {
                $valido = false;
                $logo = '';
            }
        }

        $sql = "UPDATE sucursales SET nombre = '$nombre_codificado', direccion = '$direccion_codificado', telefono = '$telefono_codificado', correo = '$correo_codificado'";
        if(!empty($logo))
            $sql .= ",logo = '$logo' ";

        $sql .= " WHERE id_sucursal = $id_sucursal";
        
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function eliminar_sucursal($id_sucursal)
    {
        $db = $this->connect();
        $sql = "DELETE FROM sucursales WHERE id_sucursal = '$id_sucursal'";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function desactivar_sucursal($id_sucursal)
    {
        $db = $this->connect();
        $sql = "UPDATE sucursales SET estatus = 0 
                WHERE id_sucursal = $id_sucursal";

        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function activar_sucursal($id_sucursal)
    {
        $db = $this->connect();
        $sql = "UPDATE sucursales SET estatus = 1 
                WHERE id_sucursal = $id_sucursal";

        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }

    public function buscar_sucursales()
    {
        $db = $this->connect();
        $sql = "SELECT * FROM sucursales";
        $lista = [];
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $lista[] = [
                    'id_sucursal' => $registro['id_sucursal'],
                    'nombre' => $registro['nombre'],
                    'direccion' => $registro['direccion'],
                    'telefono' => $registro['telefono'],
                    'correo' => $registro['correo'],
                    'logo' => $registro['logo'],
                    'estatus' => $registro['estatus']
                ];
            }
        }
        return $lista;
    }

    /* Contadores para el panel de administrador*/
    public function total_usuarios_admin()
    {
        $db = $this->connect();
        $query = "SELECT COUNT(*) FROM usuarios WHERE id_rol = 'admin'";
        $ejecutarQuery = mysqli_query($db, $query);
        $filasQuery = mysqli_fetch_array($ejecutarQuery);
        $total = array_shift($filasQuery);

        return $total;
    }
    public function total_usuarios_analista()
    {
        $db = $this->connect();
        $query = "SELECT COUNT(*) FROM usuarios WHERE id_rol = 'analista'";
        $ejecutarQuery = mysqli_query($db, $query);
        $filasQuery = mysqli_fetch_array($ejecutarQuery);
        $total = array_shift($filasQuery);

        return $total;
    }
    public function total_usuarios_empleados()
    {
        $db = $this->connect();
        $query = "SELECT COUNT(*) FROM usuarios WHERE id_rol = 'usuario'";
        $ejecutarQuery = mysqli_query($db, $query);
        $filasQuery = mysqli_fetch_array($ejecutarQuery);
        $total = array_shift($filasQuery);

        return $total;
    }
    public function ultima_empresa()
    {
        $db = $this->connect();
        $query = "SELECT * 
                    FROM sucursales 
                    ORDER BY id_sucursal DESC
                    LIMIT 1";
        $ejecutarQuery = mysqli_query($db, $query);
        $filasQuery = mysqli_fetch_array($ejecutarQuery);

        return $filasQuery[1];
    }

    public function TotalAsignacionesVideo($id_video)
    {
        $db = $this->connect();
        $query = "SELECT COUNT(*) FROM videos_asignados WHERE id_video = $id_video";
        $ejecutarQuery = mysqli_query($db, $query);
        $filasQuery = mysqli_fetch_array($ejecutarQuery);
        $total = array_shift($filasQuery);

        return $total;
    }
    public function TotalAsignacionesVideoPorCategoria($id_categoria)
    {
        $db = $this->connect();
        $total=0;
        $query = "SELECT COUNT(*) FROM videos_asignados WHERE id_categoria = $id_categoria";
        $ejecutarQuery = mysqli_query($db, $query);
        $filasQuery = mysqli_fetch_array($ejecutarQuery);
        $total = array_shift($filasQuery);

        return $total;
    }
    public function TotalAsignacionesDocumentoPorCategoria($id_categoria)
    {
        $db = $this->connect();
        $total=0;
        $query = "SELECT COUNT(*) FROM documentos_asignados WHERE id_categoria = $id_categoria";
        $ejecutarQuery = mysqli_query($db, $query);
        $filasQuery = mysqli_fetch_array($ejecutarQuery);
        $total = array_shift($filasQuery);

        return $total;
    }
    public function TotalAsignacionesDocumento($id_documento)
    {
        $db = $this->connect();
        $query = "SELECT COUNT(*) FROM documentos_asignados WHERE id_documento = $id_documento";
        $ejecutarQuery = mysqli_query($db, $query);
        $filasQuery = mysqli_fetch_array($ejecutarQuery);
        $total = array_shift($filasQuery);

        return $total;
    }

    public function buscar_id_empresa($nombre)
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT nombre, id_sucursal from sucursales WHERE nombre like '%$nombre%'");
        $num_rows = mysqli_num_rows($result);

        if ($num_rows == 1) 
        {
            $fila = mysqli_fetch_assoc($result);
            return $fila["id_sucursal"];
        } 
         else 
            return -1;
    }

    public function buscar_id_rol($rol)
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT id_rol from roles WHERE id_rol = '$rol'");
        $num_rows = mysqli_num_rows($result);

        if ($num_rows == 1) 
        {
            $fila = mysqli_fetch_assoc($result);
            return $fila["id_rol"];
        } 
         else 
            return -1;
    }

    public function ElementosCaducados($elemento, $eliminar)
    {
        $db = $this->connect();
        $query = "SELECT * FROM $elemento WHERE etiqueta='Si'";
        $caducados = [];
        $lista = [];
        $elemento = substr($elemento, 0, -1);
        $result = mysqli_query($db, $query);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $lista[] = [
                    'fecha_caducidad' => $registro['fecha_caducidad'],
                    'nombre' => $registro['nombre'],
                    'id_'.$elemento => $registro['id_'.$elemento],
                ];
            }
        }
        foreach ($lista as $item) 
        {
            $now = date("m-d-Y g:i A");
            $var = substr($now,6,-8);
            $actualYear=strtotime($var);
            $date_from_db = $item['fecha_caducidad'];
            $dateX = str_replace('/', '-', $date_from_db);
            $var_ = substr($dateX,6,-8);
            $dateYear=strtotime($var_);
            
            if($dateX < $now && ($actualYear >= $dateYear))
            {
                if(!$eliminar)
                {
                  $caducados[] = [
                        'fecha_caducidad' => $item['fecha_caducidad'],
                        'nombre' => $item['nombre'],
                  ];
                }
                else
                {
                    $caducados[] = [
                        'nombre' => $item['nombre'],
                        'id_'.$elemento => $item['id_'.$elemento],
                    ];
                }
            }
        }
        return $caducados;
    }

    //Reportes
    public function GetLogsUsersFromDate($date)
    {
        $db = $this->connect();
        $sql = "SELECT S.nombre AS nombre_sucursal, L.* 
                FROM logs_login L 
                INNER JOIN sucursales S 
                ON L.id_sucursal = S.id_sucursal 
                WHERE last_date like '%$date%'";

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'nombre' => $registro['nombre'],
                    'apellido' => $registro['apellido'],
                    'cedula' => $registro['cedula'],
                    'telefono' => $registro['telefono'],
                    'correo' => $registro['correo'],
                    'nombre_sucursal' => $registro['nombre_sucursal'],
                    'cont_logs' => $registro['cont_logs'],
                    'last_date' => $registro['last_date'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function GetAllLogsUsers()
    {
        $db = $this->connect();
        $sql = "SELECT S.nombre AS nombre_sucursal, L.* 
                FROM logs_login L 
                INNER JOIN sucursales S
                ON L.id_sucursal = S.id_sucursal";
        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'nombre' => $registro['nombre'],
                    'apellido' => $registro['apellido'],
                    'cedula' => $registro['cedula'],
                    'telefono' => $registro['telefono'],
                    'correo' => $registro['correo'],
                    'nombre_sucursal' => $registro['nombre_sucursal'],
                    'cont_logs' => $registro['cont_logs'],
                    'last_date' => $registro['last_date'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }
    
    public function GetAvailableDates()
    {
        $db = $this->connect();
        $sql = "SELECT DISTINCT last_date FROM logs_login";

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'last_date' => substr($registro['last_date'],0,-8),
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function GetAvailableEmpresas()
    {
        $db = $this->connect();
        $sql = "SELECT DISTINCT L.id_sucursal, S.nombre 
                FROM logs_login L 
                INNER JOIN sucursales S 
                ON L.id_sucursal = S.id_sucursal";

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'nombre' => $registro['nombre'],
                    'id_sucursal' => $registro['id_sucursal'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function GetLogsUsersFromEmpresa($id_sucursal)
    {
        $db = $this->connect();
        $sql = "SELECT S.nombre AS nombre_sucursal, L.* 
                FROM logs_login L 
                INNER JOIN sucursales S 
                ON L.id_sucursal = S.id_sucursal 
                WHERE S.id_sucursal='$id_sucursal'";

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'nombre_sucursal' => $registro['nombre_sucursal'],
                    'nombre' => $registro['nombre'],
                    'apellido' => $registro['apellido'],
                    'cedula' => $registro['cedula'],
                    'telefono' => $registro['telefono'],
                    'correo' => $registro['correo'],
                    'cont_logs' => $registro['cont_logs'],
                    'last_date' => $registro['last_date'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function GetMostActiveUsersFromEmpesas()
    {
        $db = $this->connect();
        $sql = "SELECT L.id_sucursal, S.nombre as nombre_sucursal, COUNT(L.id_sucursal) AS total
                FROM  logs_login L
                INNER JOIN sucursales S
                ON S.id_sucursal = L.id_sucursal
                GROUP BY L.id_sucursal
                ORDER BY total DESC LIMIT 4";

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'nombre_sucursal' => $registro['nombre_sucursal'],
                    'ingresos' => $registro['total']
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function GetMostViewedDocument($docs)
    {
        $db = $this->connect();
        $sql = "SELECT id_documento, descripcion, nombre, COUNT(id_documento) AS total
                FROM  logs_documentos
                GROUP BY id_documento
                ORDER BY total DESC";
        if($docs == 6)
            $sql .= " LIMIT 6";
        if($docs == 1)
            $sql .= " LIMIT 1";

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'nombre' => $registro['nombre'],
                    'descripcion' => $registro['descripcion'],
                    'id_documento' => $registro['id_documento'],
                    'vistas' => $registro['total']
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function VideoMasVisto()
    {
        $db = $this->connect();
        $sql = "SELECT id_video, descripcion, nombre, COUNT(id_video) AS total
                FROM  logs_videos 
                WHERE vistas = 1
                GROUP BY id_video
                ORDER BY total DESC LIMIT 1";

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'nombre' => $registro['nombre'],
                    'descripcion' => $registro['descripcion'],
                    'id_video' => $registro['id_video'],
                    'vistas' => $registro['total']
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function GetMaxUsersLogs()
    {
        $db = $this->connect();
        $sql = "SELECT nombre, apellido, last_date, cont_logs 
                FROM logs_login 
                ORDER BY cont_logs 
                DESC LIMIT 10";

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'nombre' => $registro['nombre'],
                    'apellido' => $registro['apellido'],
                    'cont_logs' => $registro['cont_logs'],
                    'last_date' => $registro['last_date'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

    public function GetMostCommentedVideo()
    {
        $db = $this->connect();
        $sql = "SELECT COUNT(C.id_video) maximo, C.id_video, V.nombre
                FROM comentarios C
                INNER JOIN videos V
                ON C.id_video = V.id_video
                WHERE valoracion > 0
                GROUP BY id_video
                ORDER BY maximo DESC LIMIT 1";
        $datos=[];
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'comentarios' => $registro['maximo'],
                    'id_video' => $registro['id_video'],
                    'nombre' => $registro['nombre']
                );
            }
        }
        return ($datos);
    }

    public function GetAsignacionesDocument($id_documento)
    {
        $db = $this->connect();
        $sql = "SELECT A.id_sucursal, A.id_categoria, S.nombre, S.id_sucursal, C.id_categoria, C.descripcion
                FROM documentos_asignados A
                INNER JOIN sucursales S
                ON A.id_sucursal = S.id_sucursal
                INNER JOIN categorias C
                ON A.id_categoria = C.id_categoria
                WHERE A.id_documento = $id_documento";
        
        $lista = [];
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $lista[] = 
                [
                    'nombre' => $registro['nombre'],
                    'descripcion' => $registro['descripcion']
                ];
            }
        }
        return $lista;
    }

    public function GetAsignacionesVideos($id_video)
    {
        $db = $this->connect();
        $sql = "SELECT A.id_sucursal, A.id_categoria, S.nombre, S.id_sucursal, C.id_categoria, C.descripcion
                FROM videos_asignados A
                INNER JOIN sucursales S
                ON A.id_sucursal = S.id_sucursal
                INNER JOIN categorias C
                ON A.id_categoria = C.id_categoria
                WHERE A.id_video = $id_video";
        
        $lista = [];
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $lista[] = 
                [
                    'nombre' => $registro['nombre'],
                    'descripcion' => $registro['descripcion']
                ];
            }
        }
        return $lista;
    }

    public function GetAllRatingsVideos($valor)
    {
        $db = $this->connect();
        $sql = "SELECT C.*, V.nombre AS nombre_video 
                FROM comentarios C 
                INNER JOIN videos V 
                ON V.id_video = C.id_video";
        if($valor == 1)
            $sql .=" WHERE valoracion = 1";
        if($valor == 0)
            $sql .=" WHERE valoracion = 0";
        if($valor < 0)
            $sql .=" WHERE valoracion < 0";
        $lista = [];
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $lista[] = 
                [
                    'id_comentario' => $registro['id_comentario'],
                    'id_video' => $registro['id_video'],
                    'nombre_video' => $registro['nombre_video'],
                    'comentario' => $registro['comentario'],
                    'valoracion' => $registro['valoracion'],
                    'fecha' => $registro['fecha'],
                    'id_usuario' => $registro['id_usuario']
                ];
            }
        }
        return $lista;
    }

    public function GetMostViewedVideos($valor, $limit)
    {
        $db = $this->connect();
        $sql = "SELECT id_video, descripcion, nombre, vistas, COUNT(id_video) AS total
                FROM  logs_videos";
        if($valor == 1)
            $sql .=" WHERE vistas = 1";
        if($valor == 0)
            $sql .=" WHERE vistas = 0";  
        $sql .= " GROUP BY id_video ORDER BY total DESC";
        if($limit)
            $sql .=" LIMIT 3";
    
        $lista = [];
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $datos = array(
                    'nombre' => $registro['nombre'],
                    'descripcion' => $registro['descripcion'],
                    'id_video' => $registro['id_video'],
                    'vistas' => $registro['total'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }

   /*Funciones de la aplicacion movil Android*/

    //aplicacion android para log
    public function login_app($id_usuario,$clave)
    {
        $db = $this->connect();
        $clave_encriptada = mysqli_real_escape_string($db,md5($clave));
        $result = mysqli_query($db, "SELECT U.*, S.logo, S.estatus , S.nombre as nombre_sucursal FROM usuarios U JOIN sucursales S on S.id_sucursal = U.id_sucursal WHERE U.id_usuario='$id_usuario' AND U.clave='$clave_encriptada' LIMIT 1");
        if (mysqli_num_rows($result) > 0)
        {
            $registro = mysqli_fetch_assoc($result);
            $logo_url = sprintf("%s://%s/uploads/%s", 
                        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                        $_SERVER['SERVER_NAME'],                    
                        $registro['logo']);
                        $datos = array(
                        "logstatus" => 1,
                        "id_sucursal" => $registro["id_sucursal"],
                        "nombre_sucursal" => $registro["nombre_sucursal"],
                        "id_usuario" => $registro["id_usuario"],
                        "id_rol" => $registro["id_rol"],
                        "nombre" => $registro["nombre"],
                        "apellido" => $registro["apellido"],
                        "taller" => $registro["taller"],
                        "id" => $registro["id"],
                        "cedula" => $registro["cedula"],
                        "telefono" => $registro["telefono"],
                        "correo" => $registro["correo"],
                        "logo_url" => !empty($registro['logo']) ? $logo_url : "",
                        "estatus" => $registro["estatus"]
                    );
            /*como el usuario debe ser unico cuenta el numero de ocurrencias con esos datos*/
        }
        else 
        {
            $result1 = mysqli_query($db, "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario' AND clave = '$clave_encriptada' AND id_sucursal = 0");
            if(mysqli_num_rows($result1) > 0){

                $registro = mysqli_fetch_assoc($result1);
                $logo_url = sprintf("%s://%s/uploads/%s", 
                        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                        $_SERVER['SERVER_NAME'],                    
                        '591b6da7acfe420170516042247.png');
                        $datos = array(
                        "logstatus" => 1,
                        "id_sucursal" => $registro["id_sucursal"],
                        "nombre_sucursal" => 10,
                        "id_usuario" => $registro["id_usuario"],
                        "id_rol" => $registro["id_rol"],
                        "nombre" => $registro["nombre"],
                        "apellido" => $registro["apellido"],
                        "taller" => $registro["taller"],
                        "id" => $registro["id"],
                        "cedula" => $registro["cedula"],
                        "telefono" => $registro["telefono"],
                        "correo" => $registro["correo"],
                        "logo_url" => $logo_url,
                        "estatus" => 1
                    );
            }else{
                $datos = array(
                    "logstatus" => 0,
                );
            }
        }
        $lista = array();
        $lista[] = $datos;

        return ($lista);
    }

    // captura de informacion del usuario por parte de la aplicacion
    public function capture_login($id_usuario,$id_sucursal,$nombre,$apellido,$cedula,$telefono,$correo,$preview_date,$last_date){

        $db = $this->connect();
        $result = mysqli_query($db,"SELECT cedula FROM logs_login WHERE cedula ='$cedula'");
        $num_rows = mysqli_num_rows($result);

        if($num_rows > 0){
            // $data=substr($last_date, 0, -8);
            $data = explode(" ", $last_date);
            // echo $data[0]; // fecha
            // echo $data[1]; // hora 
            // echo $data[2]; // AM/PM
            $result = mysqli_query($db,"SELECT last_date FROM logs_login WHERE cedula ='$cedula' AND last_date like '%$data[0]%' ");
            $num_rows = mysqli_num_rows($result);
            if($num_rows > 0){
                mysqli_query($db,"UPDATE logs_login SET id_sucursal = '$id_sucursal', nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', correo = '$correo', cont_logs = cont_logs + 1 WHERE cedula = '$cedula'");
            }else{
                mysqli_query($db,"UPDATE logs_login SET id_sucursal = '$id_sucursal', nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', correo = '$correo', cont_logs = 1 WHERE cedula = '$cedula'");
            }

            $result = mysqli_query($db,"SELECT last_date FROM logs_login WHERE cedula = '$cedula'");
            $row = mysqli_fetch_row($result);
            $result = mysqli_query($db,"UPDATE logs_login SET preview_date = '$row[0]' , last_date = '$last_date' WHERE cedula = '$cedula'");
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }else{    
        $sql = "INSERT INTO logs_login (id_usuario,id_sucursal,nombre,apellido,cedula,telefono,correo,preview_date,last_date,cont_logs) VALUES ('$id_usuario','$id_sucursal','$nombre','$apellido','$cedula','$telefono','$correo','$preview_date','$last_date','1')";
            $result = mysqli_query($db,$sql);
            if ($result){   
                return mysqli_insert_id($db);
            }   
            else{
                return false;
            } 
        }
   }

   // captura de informacion de los documentos visto por los usuarios por parte de la aplicacion
    public function capture_documento($id_usuario,$id_documento,$nombre,$descripcion){

        $db = $this->connect();
        $result = mysqli_query($db,"SELECT id_usuario FROM logs_documentos WHERE id_usuario = '$id_usuario' AND id_documento = '$id_documento'");
        $num_rows = mysqli_num_rows($result);

        if($num_rows > 0){
             $result = mysqli_query($db,"UPDATE logs_documentos SET id_documento = '$id_documento', nombre = '$nombre', descripcion = '$descripcion', vistas = vistas + 1 WHERE id_usuario = '$id_usuario' AND id_documento = '$id_documento'");
            if ($result){
                return true;
            }
            else{
                return false;
            }   
        }    
        else{
            $sql = "INSERT INTO logs_documentos (id_usuario,id_documento,nombre,descripcion,vistas) VALUES ('$id_usuario','$id_documento','$nombre','$descripcion','1')";
            $result = mysqli_query($db,$sql);
            if ($result){   
                return mysqli_insert_id($db);
            }   
            else{
                return false;
            }
        }
    }

    // captura de informacion de los videos/no vistos visto por los usuarios por parte de la aplicacion
    public function capture_video($id_usuario,$id_video,$nombre,$descripcion,$vistas){

        $db = $this->connect();
        $result = mysqli_query($db,"SELECT id_usuario FROM logs_videos WHERE id_usuario = '$id_usuario' AND id_video = '$id_video'");
        $num_rows = mysqli_num_rows($result);

        if($num_rows > 0){
             $result = mysqli_query($db,"UPDATE logs_videos SET id_video = '$id_video', nombre = '$nombre', descripcion = '$descripcion', vistas = $vistas WHERE id_usuario = '$id_usuario' AND id_video = '$id_video'");
            if ($result){
                return true;
            }
            else{
                return false;
            }   
        }    
        else{
            $sql = "INSERT INTO logs_videos (id_usuario,id_video,nombre,descripcion,vistas) VALUES ('$id_usuario','$id_video','$nombre','$descripcion','$vistas')";
            $result = mysqli_query($db,$sql);
            if ($result){   
                return mysqli_insert_id($db);
            }   
            else{
                return false;
            }
        }
    }    

    //aplicacion android
    public function buscar_videos($id_categoria = 0,$id_usuario)
    {
        $db = $this->connect();
        date_default_timezone_set("America/Caracas");
        $Fecha = date('m/d/Y', time());
        $sql = "SELECT V.*,V_A.*, C.descripcion AS nombre_categoria, S.nombre AS nombre_sucursal FROM videos_asignados V_A INNER JOIN sucursales S on S.id_sucursal = V_A.id_sucursal INNER JOIN categorias C ON C.id_categoria = V_A.id_categoria INNER JOIN videos V ON V.id_video = V_A.id_video WHERE 1 ";

        if (!empty($id_categoria)){
            $sql .= "AND V_A.id_categoria = $id_categoria";
        }

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result){
            while ($registro = mysqli_fetch_assoc($result)){

                $url = sprintf("%s://%s/uploads/%s", 
                    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                    $_SERVER['SERVER_NAME'],                    
                    $registro['archivo']);
                if($registro['etiqueta'] == 'Si')
                {    
                    if(substr($registro['fecha_caducidad'], 0, -8) >= $Fecha ){
                        
                        //el registro individual
                        $datos = array(
                            'id_video' => $registro['id_video'],
                            'id_categoria' => $registro['id_categoria'],
                            'nombre_categoria' => $registro['nombre_categoria'],
                            'nombre' => $registro['nombre'],
                            'descripcion' => $registro['descripcion'],
                            'archivo' => $registro['archivo'],
                            'archivo_mostrar' => $registro['archivo_mostrar'],
                            'src' => $url,
                            'id_usuario_creacion' => $registro['id_usuario_creacion'],
                            'id_sucursal' => $registro["id_sucursal"],
                            'nombre_sucursal' => $registro['nombre_sucursal'],
                            'etiqueta' => $registro['etiqueta'],
                            'fecha_caducidad' => "Valido hasta: ".str_replace ( '/' , '-' , substr($registro['fecha_caducidad'], 0, -8) ),
                            'OK' => 'visible'
                        );
                        $id_video = $registro['id_video'];
                        $result1 = mysqli_query($db, "SELECT id_usuario FROM logs_videos WHERE id_usuario = '$id_usuario' AND id_video = '$id_video' AND  vistas = 0 ");
                        $num_rows = mysqli_num_rows($result1);
                        if ($num_rows > 0){
                            $datos += [ 'visto' => 'no_visto' ];
                        }else{
                            $datos += [ 'visto' => 'visto' ];
                        }
                        $lista[] = $datos;
                    }
                }else{
                    
                    //el registro individual
                    $datos = array(
                        'id_video' => $registro['id_video'],
                        'id_categoria' => $registro['id_categoria'],
                        'nombre_categoria' => $registro['nombre_categoria'],
                        'nombre' => $registro['nombre'],
                        'descripcion' => $registro['descripcion'],
                        'archivo' => $registro['archivo'],
                        'archivo_mostrar' => $registro['archivo_mostrar'],
                        'src' => $url,
                        'id_usuario_creacion' => $registro['id_usuario_creacion'],
                        'id_sucursal' => $registro["id_sucursal"],
                        'nombre_sucursal' => $registro['nombre_sucursal'],
                        'etiqueta' => $registro['etiqueta'],
                        'fecha_caducidad' => $registro['fecha_caducidad'],
                        'OK' => 'collapse'
                    );
                    $id_video = $registro['id_video'];
                    $result1 = mysqli_query($db, "SELECT id_usuario FROM logs_videos WHERE id_usuario = '$id_usuario' AND id_video = '$id_video' AND  vistas = 0 ");
                    $num_rows = mysqli_num_rows($result1);
                    if ($num_rows > 0){
                        $datos += [ 'visto' => 'no_visto' ];
                    }else{
                        $datos += [ 'visto' => 'visto' ];
                    }
                    $lista[] = $datos;
                } 
            }
        }
        return ($lista);
    }

   //aplicacion android
    public function buscar_documentos($id_categoria = 0,$id_usuario)
    {
        $db = $this->connect();
        date_default_timezone_set("America/Caracas");
        $Fecha = date('m/d/Y', time());
        $sql = "SELECT D.*,D_A.*, C.descripcion AS nombre_categoria, S.nombre AS nombre_sucursal FROM documentos_asignados D_A INNER JOIN sucursales S on S.id_sucursal = D_A.id_sucursal INNER JOIN categorias C ON C.id_categoria = D_A.id_categoria INNER JOIN documentos D ON D.id_documento = D_A.id_documento WHERE 1 ";

        if (!empty($id_categoria)){
            $sql .= "AND D_A.id_categoria = $id_categoria";
        }

        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result)){

                $url = sprintf("%s://%s/uploads/%s", 
                isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                $_SERVER['SERVER_NAME'],                    
                $registro['archivo']);

                if($registro['etiqueta'] == 'Si')
                {    
                    if(substr($registro['fecha_caducidad'], 0, -8) >= $Fecha ){
                        //el registro individual
                        $datos = array(
                            'id_documento' => $registro['id_documento'],
                            'id_categoria' => $registro['id_categoria'],
                            'nombre' => $registro['nombre'],
                            'descripcion' => $registro['descripcion'],
                            'archivo' => $registro['archivo'],
                            'archivo_mostrar' => $registro['archivo_mostrar'],
                            'src' => $url,
                            'id_usuario_creacion' => $registro['id_usuario_creacion'],
                            'id_sucursal' => $registro["id_sucursal"],
                            'etiqueta' => $registro['etiqueta'],
                            'fecha_caducidad' => "Valido hasta: ".str_replace ( '/' , '-' , substr($registro['fecha_caducidad'], 0, -8) ),
                            'OK' => 'visible'
                        );
                         $lista[] = $datos;
                    }
                }else{
                    //el registro individual
                    $datos = array(
                        'id_documento' => $registro['id_documento'],
                        'id_categoria' => $registro['id_categoria'],
                        'nombre' => $registro['nombre'],
                        'descripcion' => $registro['descripcion'],
                        'archivo' => $registro['archivo'],
                        'archivo_mostrar' => $registro['archivo_mostrar'],
                        'src' => $url,
                        'id_usuario_creacion' => $registro['id_usuario_creacion'],
                        'id_sucursal' => $registro["id_sucursal"],
                        'etiqueta' => $registro['etiqueta'],
                        'fecha_caducidad' => $registro['fecha_caducidad'],
                        'OK' => 'collapse'
                    );
                     $lista[] = $datos;
                }

                // $id_documento = $registro['id_documento'];
                // $result1 = mysqli_query($db, "SELECT id_usuario FROM logs_documentos WHERE id_usuario = '$id_usuario' AND id_documento = '$id_documento' AND  vistas = 0 ");
                // $num_rows = mysqli_num_rows($result1);
                // if ($num_rows > 0){
                //     $datos += [ 'visto' => 'no_visto' ];
                // }else{
                //     $datos += [ 'visto' => 'visto' ];
                // }
            }
        }
        return ($lista);
    }

    //comentar videos, valorar videos de la aplicacion
    public function comentar_video($id_video, $comentario, $valoracion, $id_usuario, $fecha)
    {
        $db = $this->connect();
        $comentario_codificado = mysqli_real_escape_string($db, ($comentario));
        $result = mysqli_query($db,"SELECT id_usuario FROM comentarios WHERE id_usuario = '$id_usuario' AND id_video = '$id_video'");
        $num_rows = mysqli_num_rows($result);

        if($num_rows > 0){
             $result = mysqli_query($db,"UPDATE comentarios SET comentario = '$comentario_codificado' , valoracion = '$valoracion' , fecha = '$fecha' WHERE id_usuario = '$id_usuario' AND id_video = '$id_video'");
            if ($result){
                return true;
            }
            else{
                return false;
            }   
        }    
        else{
            $sql = "INSERT INTO comentarios(id_video, comentario, valoracion, id_usuario, fecha) VALUES($id_video, '$comentario_codificado', $valoracion, '$id_usuario', '$fecha') ";
            $result = mysqli_query($db, $sql);
            if($result){
                return mysqli_insert_id($db);
            }
            else{
                return false;
            }
        }
    }

    //aplicacion android
    public function buscar_categoria_app($id_sucursal, $id_categoria = 0, $pag = -1)
    {
        $db = $this->connect();
        $sql = "SELECT * FROM categorias WHERE 1 ";
        if (!empty($id_sucursal)){
            $sql .= " AND id_sucursal = $id_sucursal ";
        }
        if (!empty($id_categoria)){
            $sql .= " AND id_categoria = $id_categoria";
        }
        $sql .= " ORDER BY descripcion ASC";

        if ($pag >= 0){
            $inicio = $pag * 10;
            $numero = 10;
            $sql .= " LIMIT $inicio, $numero";
        }

        //lista de datos a enviar en JSON
        $lista = array();
        $result = mysqli_query($db, $sql);
        if ($result){
            while ($registro = mysqli_fetch_assoc($result)){
                //el registro individual
                $datos = array(
                    'id_categoria' => $registro['id_categoria'],
                    'descripcion' => $registro['descripcion'],
                );
                $lista[] = $datos;
            }
        }
        return ($lista);
    }
}
?>