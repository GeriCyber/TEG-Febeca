<?php
	require_once('funciones_bd.php');
	$db = new funciones_BD();
	$seleccionadas = $_POST['empresas'];
	$empresas = json_decode($seleccionadas, true);
	$categorias=array();
	for ($i = 0; $i < count($empresas); $i++) 
	{
	    $id_empresa = $empresas[$i];
	    $categorias[] = $db->buscar_categoria($id_empresa); 
	}

	/*HTML a enviar al AJAX*/
?>
<?php 
	for($i=0; $i<count($categorias) ;$i++)
	{
		$c=0; 
		$empresa = $db->GetEmpresaName($empresas[$i]); ?>
		<optgroup label="<?= $empresa ?>">
			<?php foreach($categorias[$i] as $key=>$value)
			{
				$c++; ?>
				<option value="<?= $value['id_categoria'] ?>"><?= $value['descripcion'] ?></option>
				<?php if($c<count($categorias[$i])); 
			} ?>
		</optgroup>
	<?php } 
?>