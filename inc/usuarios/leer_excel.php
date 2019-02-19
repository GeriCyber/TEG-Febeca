<?php 
	session_start();
	require '../../libs/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
	require('../../libs/fpdf/fpdf.php');
	require_once('../funciones_bd.php');
	$db = new funciones_BD();

	$fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_sucursal_user = $_SESSION["id_sucursal"];
    $empresa_admin = $db->GetEmpresaName($id_sucursal_user);
    $pdf=new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,utf8_decode('Reporte de errores en el documento Excel'));
	$pdf->Ln();
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(40,10,utf8_decode('Fecha: ').$fecha);
	$pdf->Ln(); $pdf->Ln();
	$pdf->SetFont('Arial','',14);

	//Fecha y hora
    date_default_timezone_set("America/Caracas");

	//Variable con el nombre del archivo
	$archivo=$_FILES['archivo']['name'];
    //Subir archivo set #1
    $target="../../uploads/excel/".basename($_FILES['archivo']['name']);
    #Set archivo #2
    move_uploaded_file($_FILES['archivo']['tmp_name'],$target); 

    // Cargar la hoja de excel
	$objPHPExcel = PHPExcel_IOFactory::load($target);
	//Asignar la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtener el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	$error="";
	
	if($numRows > 1)
	{
		for ($i = 2; $i <= $numRows; $i++) 
		{
			$nombre = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
			$apellido = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
			$cedula = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
			$telefono = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
			$correo = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
			$empresa = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
			$password = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
			$nombre_usuario = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
			$rol = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
			$taller = 0;
			$registro = $nombre.' '.$apellido;
			
			if(!empty($cedula))
			{
				if(!empty($password))
				{
					if(!empty($nombre_usuario))
					{
						if(!$db->isuserexist($cedula))
						{
							if(!$db->isUserNameExist($nombre_usuario))
							{
								if(!empty($empresa))
								{
									if($db->isempresaexist($empresa))
									{
										$id_sucursal = $db->buscar_id_empresa($empresa);
										if($id_sucursal != -1)
										{
											if(!empty($rol))
											{
												$id_rol = $db->buscar_id_rol($rol);
												if($id_rol != -1)
												{
													$db->adduser($id_sucursal, $nombre_usuario, $password, $id_rol, $nombre, $apellido, $cedula, $telefono, $correo, $taller);
													
													//Registrando la accion
						        					$db->RegisterActivity($usuario, $empresa_admin, $registro, $fecha, 'Agregó un usuario por medio de la carga masiva');
												}
												else
												{
													$error = 'No existe el Rol "'.$rol.'" asignado para '.$nombre.' '.$apellido.'';
													$pdf->Cell(40,10,utf8_decode($error));
													$pdf->Ln();
												}
											}
											else
											{
												$error = '"'.$nombre.' '.$apellido.'" no tiene rol ';
												$pdf->Cell(40,10,utf8_decode($error));
												$pdf->Ln();
											}
										}
									}
									else
									{
										$error = 'No existe la Empresa: "'.$empresa.'" asignada para '.$nombre.' '.$apellido.' ';
										$pdf->Cell(40,10,utf8_decode($error));
										$pdf->Ln();	
									}
								}
								else
								{
									$error = '"'.$nombre.' '.$apellido.'" no tiene empresa ';
									$pdf->Cell(40,10,utf8_decode($error));
									$pdf->Ln();
								}
							}
							else
							{
								$error = 'Ya existe el nombre de usuario: "'.$nombre_usuario.'"de '.$nombre.' '.$apellido.' ';
								$pdf->Cell(40,10,utf8_decode($error));
								$pdf->Ln();
							}
						}
						else
						{
							$error = 'Ya existe "'.$nombre.' '.$apellido.'" ';
							$pdf->Cell(40,10,utf8_decode($error));
							$pdf->Ln();
						}
					}
					else
					{
						$error = '"'.$nombre.' '.$apellido.'" no tiene nombre de usuario ';
						$pdf->Cell(40,10,utf8_decode($error));
						$pdf->Ln();
					}
				}
				else
				{
					$error = '"'.$nombre.' '.$apellido.'" no tiene contraseña ';
					$pdf->Cell(40,10,utf8_decode($error));
					$pdf->Ln();
				}
			}
			else
			{
				$error = '"'.$nombre.' '.$apellido.'" no tiene cédula ';
				$pdf->Cell(40,10,utf8_decode($error));
				$pdf->Ln();
			}
		}
	}
	else
	{
		$error = 'El documento esta vacío!';
		$pdf->Cell(40,10,utf8_decode($error));
		$pdf->Ln();
	}

	//Verificando si hubieron errores en los campos del excel
	if(!empty($error))
	{ 
		$pdf->Output('F','../../uploads/ErroresCargaMasiva.pdf');
		$warning = urlencode("Se encontraron algunos errores en el archivo");
	    header("Location:../../carga_masiva.php?error=".$warning);
	    die;
	}
	else
	{
		$exito = urlencode("Se cargaron todos los usuarios");
	    header("Location:../../carga_masiva.php?exito=".$exito);
	    die;
	}
    	
?>