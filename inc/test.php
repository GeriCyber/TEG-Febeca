<?php 

	require_once('funciones_bd.php');
	$db = new funciones_BD();
    $now = date("d-m-Y g:i A");
    //$now = substr($now, 0, -8);
    setlocale(LC_ALL, 'es_ES'); 
    //echo $now;
    /*$categorias=array();
    if(!empty($db->buscar_categoria(18))){
        $categorias[] = $db->buscar_categoria(18); 
        print_r($categorias);
    }*/

    /*function fechaCastellano ($fecha) 
    {
      $mes = date('F', mktime(0, 0, 0, $fecha, 10));
      $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
      $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
      $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
      return $nombreMes;
    }

    $test = $db->GetAvailableDates();
    $disponibles = array_unique($test, SORT_REGULAR);

    echo '<pre>'.print_r($disponibles, true).'</pre>';
    foreach ($disponibles as $value) 
    {
        echo fechaCastellano($value['last_date']);
    }*/
    $test = $db->ElementosCaducados('videos',false);
    echo '<pre>'.print_r($test, true).'</pre>';
    //$empresas = $db->GetAvailableEmpresas();
    //echo count($empresas);
	//$logs = $db->GetLogsUsersFromDate($now);
    //echo $now.' ';
    //echo substr($now,0,-8).' ';
   // $monthNum = substr($now,0,-8);
   // $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
    //echo $monthName;
    //$fechas = $db->GetAvailableDates();
    
    //$disponibles = array_unique(array_column($fechas, 'last_date'));
    //$hola = (array_intersect_key($fechas, $disponibles));

    /*$lista=array();
    for ($i = 0; $i < count($empresas=1); $i++) 
    {
        $id_empresa = $seleccionadas[$i];
        $categorias = $db->buscar_categoria($id_empresa);
        $lista[] = $categorias;
    }
    echo '<pre>'.print_r($categorias, true).'</pre>';*/

    //echo '<pre>'.print_r($disponibles, true).'</pre>';
    /*$countArray = array();

    foreach($logs as $tempArray){
      foreach($tempArray as $key => $value)
      {
        if(array_key_exists($value, $countArray))
          $countArray[$value] = $countArray[$value] + 1;
        else if($key == 'nombre_sucursal')
          $countArray[$value] = 1;
      }
    }

    echo '<pre>'.print_r($countArray, true).'</pre>';

    //echo count(array_keys($logs, "nombre_sucursal"));
    foreach ($countArray as $key => $registro) 
    {
        echo $registro.' ';
    }*/

    /*$fechas = $db->GetAvailableDates();
    $disponibles = array_unique($fechas, SORT_REGULAR);
    print_r($disponibles);*/
    
	//$eliminar = '../uploads/videos/9b9b9b99bb99b9b9bb9b9b9b99bb9b.mp4';
    //echo $eliminar;
    /*if(!empty($eliminar))
    {
        if(unlink($eliminar))
        	echo 'se elimino...';
        else
        	echo 'no se elimino...';
    }*/
 ?>