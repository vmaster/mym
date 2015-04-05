<?php
echo "<tr>";
if(isset($long_table)){
	$i = $long_table;
}
echo "<td style='width:4%;'>".$i."</td>";
echo "<td style='width:89%;'><input name='data[CondiSubestandar".$i."][descripcion]' id='txtCondiSubDes".$i."' class='form-control'/>";
echo "<input name='data[CondiSubestandar".$i."][cs-id]' id='hiddenCondiSubId".$i."' type='hidden' class='form-control' value=''></td>";
echo "<td><select name='data[CondiSubestandar".$i."][ni-id]' class='cbo-nincumplidas-select2 form-control' id='CondiSubNid-".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
echo "<option></option>";
if (isset($list_all_codigos)){
	foreach ($list_all_codigos as $id => $cod):
	echo "<option value = ".$id.">".$cod."</option>";
	endforeach;
}
echo "</select></td>";
echo "</tr>";
?>