<?php
echo "<tr>";
if(isset($long_table)){
	$i = $long_table;
}
echo "<td>".$i."</td>";
echo "<td style='width:14%;'>";
echo "<span style='display: inline-flex; width: 100%; margin-right: -20px;'>";
echo "<select name='data[UnidadMovil".$i."][nro_placa_id]' class='cbo-placas-select2 form-control' id='PlacaActa".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
if (isset($list_all_vehiculos)){
	echo "<option></option>";
	foreach ($list_all_vehiculos as $id => $pla):
	echo "<option value = ".$id.">".$pla."</option>";
	endforeach;
}
echo "</select>";
echo "<input name='data[UnidadMovil][um_id".$i."]' type='hidden' value='' id='hiddenUmId".$i."'>";
echo "<a href='#myModalAddVehiculo' class='btn btn-primary btn-open-modal-vehiculo' style='height: 28px; padding-right: 3px; padding-left: 3px;' role='button' data-toggle='modal' id='btn-open-create-vehiculo".$i."'>...</a></span></td>";
echo "<td style='width:15%;'><input name='data[TipoUnidadMovil".$i."][vehiculo]' id='TipoVehiculoActa".$i."' class='form-control txt-vehiculo' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
echo "<input name='data[TipoUnidadMovil][vehiculo_id".$i."]' type='hidden' value='' id='hiddenVehiculoid".$i."'></td>";

for($j= 1; $j <=9; $j++){
	echo "<td><select name='data[UnidadNorma][ni-id".$i."-".$j."]' class='cbo-nincumplidas-select2 form-control' id='ni-".$i."-".$j."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
	echo "<option></option>";
	if (isset($list_all_codigos)){
		foreach ($list_all_codigos as $id => $cod):
		echo "<option value = ".$id.">".$cod."</option>";
		endforeach;
	}
	echo "</select>";
	echo "<input name='data[UmNi][umni-id".$i."-".$j."]' type='hidden' value='' id='hiddenUmNid".$i."-".$j."'></td>";
}
echo "</tr>";
?>