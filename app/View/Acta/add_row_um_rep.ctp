<?php
echo "<tr>";
if(isset($long_table)){
	$i = $long_table;
}
echo "<td><textarea name='data[Acta][cumplimiento_um][".$i."][info_des_um]' rows='2' class='txtInfDesAct4 form-control' id='txtInfDesAct4' cols='30'></textarea></td>";
echo "<td>
<select name= 'data[Acta][cumplimiento_um][".$i."][alternativa]'>";
echo "<option value= '1'>SI</option>
<option value='0'>NO</option>
</select>
</td></tr>";
?>