<?php
echo "<tr>";
if(isset($long_table)){
	$i = $long_table;
}
echo "<td>".$i."</td>";
echo "<td style='width:28%;'>";
echo "<span style='display: inline-flex; width: 100%;'>";
echo "<select name='data[TrabajadorActa][".$i."][trabajador_id]' class='cbo-trabajadores-select2 form-control' id='Trabajador".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
echo "<option></option>";
if (isset($list_all_trabajadores)){
	foreach ($list_all_trabajadores as $id => $nom):
	echo "<option value = ".$id.">".$nom."</option>";
	endforeach;
}
echo "</select>";
echo "<input name='data[TrabajadorActa][".$i."][ipp_id]' type='hidden' value='' id='hiddenIppid".$i."'>";
echo "&nbsp;<a href='#myModalAddTrabajador' class='btn btn-primary btn-open-modal-trabajador' style='height: 28px; padding-right: 4px; padding-left: 4px;' role='button' data-toggle='modal' id='btn-open-create-trabajador".$i."'>...</a></span>";
echo "</td>";

echo "<td><select name='data[TrabajadorActa][".$i."][actividad_id]' class='cbo-actividades-select2 form-control' id='Actividad".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
echo "<option>--Actividad--</option>";
if (isset($list_all_actividades)){
	foreach ($list_all_actividades as $id => $des):
	echo "<option value = ".$id.">".$des."</option>";
	endforeach;
}
echo "</select></td>";

echo "<td style='width:40%;'><select name='data[NiActa][".$i."][]' class='cbo-nincumplidas-select2 form-control' id='Nid-".$i."' multiple='multiple' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
echo "<option></option>";
if (isset($list_all_codigos)){
	foreach ($list_all_codigos as $id => $cod):
	echo "<option value = ".$id.">".$cod."</option>";
	endforeach;
}
echo "</select>";
echo "<input name='data[IppNi][".$i."]' type='hidden' value='' id='hiddenIppNid".$i."'></td>";
echo "</tr>";
?>