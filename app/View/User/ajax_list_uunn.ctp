<?php
	if (isset($array_uunn)){
		foreach ($array_uunn as $id => $uunn):
			echo "<option value = ".$id.">".$uunn."</option>";
		endforeach;
	}