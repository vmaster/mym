<?php
echo "<tr>";
if(isset($long_table)){
	$i = $long_table;
}
echo "<td>".$i."</td>";
echo "<td style='width:28%;'>";
echo "<select name='data[TrabajadorActa".$i."][trabajador_id]' class='cbo-trabajadores-select2 form-control' id='Trabajador".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
echo "<option></option>";
if (isset($list_all_trabajadores)){
	foreach ($list_all_trabajadores as $id => $nom):
	echo "<option value = ".$id.">".$nom."</option>";
	endforeach;
}
echo "</select>";
echo "<input name='data[TrabajadorActa][ipp_id".$i."]' type='hidden' value='' id='hiddenIppid".$i."'></td>";

echo "<td><select name='data[TrabajadorActividad".$i."][actividad_id]' class='cbo-actividades-select2 form-control' id='Actividad".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
echo "<option>--Actividad--</option>";
if (isset($list_all_actividades)){
	foreach ($list_all_actividades as $id => $des):
	echo "<option value = ".$id.">".$des."</option>";
	endforeach;
}
echo "</select></td>";

for($j= 1; $j <=7; $j++){
	echo "<td style='width:7%;'><select name='data[NiActa][ni-id".$i."-".$j."]' class='cbo-nincumplidas-select2 form-control' id='Nid-".$id."-".$j."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
	echo "<option></option>";
	if (isset($list_all_codigos)){
		foreach ($list_all_codigos as $id => $cod):
		echo "<option value = ".$id.">".$cod."</option>";
		endforeach;
	}
	echo "</select>";
	echo "<input name='data[IppNi][ippni-id".$i."-".$j."]' type='hidden' value='' id='hiddenIppNid".$i."-".$j."'></td>";
}
echo "</tr>";
?>