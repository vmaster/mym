<?php
echo "<tr>";
if(isset($long_table)){
	$i = $long_table - 1;
}
echo "<td><textarea name='data[ActaMedioAmbiente][cumplimiento_cond_amb][".$i."][inf_des_cond_amb]' rows='2' class='txtInfDesAct4 form-control' id='txtInfDesAct4' cols='30'></textarea></td>";
echo "<td>
<select class='form-control select-NI-NC select_cu_ee' name= 'data[ActaMedioAmbiente][cumplimiento_cond_amb][".$i."][alternativa]'>";
echo "<option value= '2'>--</option><option value= '1'>SI</option>
<option value='0'>NO</option>
</select>
</td>";
echo "<td>
<select class='form-control select_re_as' name= 'data[ActaMedioAmbiente][cumplimiento_cond_amb][".$i."][incidencia]'>";
echo "<option value= '2'>--</option><option value= '1'>SI</option>
<option value='0'>NO</option>
</select>
</td></tr>";
?>