<?php
	if (isset($array_trabajadores)){
		foreach ($array_trabajadores as $id => $trabajador):
			echo "<option value = ".$id.">".$trabajador."</option>";
		endforeach;
	}