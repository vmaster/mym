<?php
	echo "<tr>";
	if(isset($long_table)){
		$i = $long_table - 1;
	}
	echo "<td><textarea name='data[ActaInstalacione][cumplimiento_ilum_vent][".$i."][inf_des_ilum_vent]' rows='2' class='txtInfDesAct4 form-control' id='txtInfDesAct4' cols='30'></textarea></td>";
	echo "<td>
	<select class='form-control select-NI-NC select_cu_iv' name= 'data[ActaInstalacione][cumplimiento_ilum_vent][".$i."][alternativa]'>";
	echo "<option value= '2'>--</option><option value= '1'>SI</option>
	<option value='0'>NO</option>
	</select>
	</td>";
	echo "<td>
	<select class='form-control select_re_as' name= 'data[ActaInstalacione][cumplimiento_ilum_vent][".$i."][incidencia]'>";
	echo "<option value='4'>--</option>
		<option value='3'>N - Nueva Insp./Obs.</option>
		<option value='2'>S - Subsanado</option>
		<option value='1'>R - Reiterativo</option>
		<option value='0'>NO</option>
	</select>
	</td></tr>";
?>