<?php
echo "<tr>";
if(isset($long_table)){
	$i = $long_table;
}
echo "<td>".$i."</td>";
echo "<td style='width:89%;'>";
//echo "<input name='data[ActoSubestandar".$i."][descripcion]' id='txtActoSubDes".$i."' class='form-control'/>";
echo "<select name='data[ActoSubestandar][".$i."][act_sub_tipo_id]' class='cbo-tipo-act-sub-select2 form-control' id='cboActoSubDes".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
echo "<option></option>";
if (isset($list_all_tipos_actos_sub)){
	foreach ($list_all_tipos_actos_sub as $id => $des):
	echo "<option value = ".$id.">".utf8_encode($des)."</option>";
	endforeach;
}
echo "</select>";
echo "<input name='data[ActoSubestandar][".$i."][as-id]' id='hiddenActoSubId".$i."' type='hidden' class='form-control' value=''></td>";
echo "<td><select name='data[ActoSubestandar][".$i."][ni-id]' class='cbo-nincumplidas-select2 form-control' id='ActoSubNid-".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
echo "<option></option>";
if (isset($list_all_codigos)){
	foreach ($list_all_codigos as $id => $cod):
	echo "<option value = ".$id.">".$cod."</option>";
	endforeach;
}
echo "</select></td>";
echo "</tr>";
?>