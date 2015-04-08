<style type="text/css">
            #container_page ul{
            	display: block !important;
            	padding-left: 80px;
            }
            #container_page .pagination_page ul li.inactive,
            #container_page .pagination_page ul li.inactive:hover{
                background-color:#ededed;
                color:#bababa;
                border:1px solid #bababa;
                cursor: default;
            }
            #container_page .data ul li{
                list-style: none;
                font-family: verdana;             
                color: #000;
                font-size: 13px;
            }

            #container_page .pagination_page{
                width: 640px;
                height: 25px;
                vertical-align: top;
            }
            #container_page .pagination_page ul li{
                list-style: none;
                float: left;
                border: 1px solid #006699;
                padding: 2px 6px 2px 6px;
                margin: 0 3px 0 3px;
                font-family: arial;
                font-size: 14px;
                color: #006699;
                font-weight: bold;
                background-color: #f2f2f2;
            }
            #container_page .pagination_page ul li:hover{
                color: #fff;
                background-color: #006699;
                cursor: pointer;
            }
			.total
			{
			font-family:arial;color:#999;
			display: inline-block;
			line-height: 25px;
			}

</style>

<div id="loading"></div>


<div id="container_page">
	<div class="data">
		<table class="table" id="table_content_actas">
			<thead>
		        <tr>
		          <th><?php echo __('ID'); ?></th>
		          <th><?php echo utf8_encode(__('Nro Acta')); ?></th>
		          <th><?php echo utf8_encode(__('Actividad')); ?></th>
		          <th><?php echo utf8_encode(__('Obra')); ?></th>
		          <th><?php echo utf8_encode(__('Responsable Supervisión')); ?></th>
		          
		          <th><?php echo __('Operaciones'); ?></th>
		          <th style="width: 26px;"></th>
		        </tr>
		    </thead>
			<?php 
			$n = 0;
			foreach ($list_acta as $acta):
			$n = $n + 1;
			?>
			<tbody>
					<tr class="acta_row_container" acta_id="<?php echo $acta->getAttr('id'); ?>">
						<td><?php echo $n; ?></td>
						<td><?php echo $acta->getAttr('numero'); ?></td>
						<td><?php echo ($acta->getAttr('actividad')=='')?"":$acta->getAttr('actividad'); ?></td>
						<td><?php echo $acta->getAttr('obra'); ?></td>
						<?php // $obj_trabajador = $acta->Trabajadore->showTrabajador($acta->getAttr('reponsable_act_id'));?>
						<td><?php //echo $obj_trabajador->getAttr('apellido_nombre'); ?></td>
						<td	><a href="<?= ENV_WEBROOT_FULL_URL; ?>actas/editar_informe/<?php echo $acta->getAttr('id')?>"><i class="fa fa-pencil"></i> </a>| 
							<a href="<?= ENV_WEBROOT_FULL_URL; ?>actas/view_informe/<?php echo $acta->getAttr('id')?>" target="_blank"><i class="fa fa-list-alt"></i> </a> |
							<a href="#myModalDeleteActa" role="button" data-toggle="modal"><i class="fa fa-times open-model-delete-acta"></i> </a>|
							<a href='mailto:usuario@dominio.com?subject=Titulo del mensaje&body=
Cuerpo del mensaje&attachment=""c:\temp\file.htm""'><i class="fa fa-envelope"></i> </a>
						</td>
					</tr>
					<?php 
					endforeach;
					?>
			</tbody>	
		</table>
	</div>
	<br>

	<div class="pagination">
	<?php 
	/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	
	$page = $page; //POST
	$cur_page = $page;
	$page -= 1;
	$per_page = 10;
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	$start = $page * $per_page;
	
	$no_of_paginations = $no_of_paginations; //POST
	
	$msg = "";
	if ($cur_page >= 7) {
		$start_loop = $cur_page - 3;
		if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
		else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
		} else {
			$end_loop = $no_of_paginations;
		}
	} else {
		$start_loop = 1;
		if ($no_of_paginations > 7)
			$end_loop = 7;
		else
			$end_loop = $no_of_paginations;
	}
	/* ----------------------------------------------------------------------------------------------------------- */
	$msg .= "<div class='pagination_page'><ul>";
	
	// FOR ENABLING THE FIRST BUTTON
	if ($first_btn && $cur_page > 1) {
		$msg .= "<li p='1' class='active'>First</li>";
	} else if ($first_btn) {
		$msg .= "<li p='1' class='inactive'>First</li>";
	}
	
	// FOR ENABLING THE PREVIOUS BUTTON
	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		$msg .= "<li p='$pre' class='active'>Previous</li>";
	} else if ($previous_btn) {
		$msg .= "<li class='inactive'>Previous</li>";
	}
	for ($i = $start_loop; $i <= $end_loop; $i++) {
	
		if ($cur_page == $i)
			$msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
		else
			$msg .= "<li p='$i' class='active'>{$i}</li>";
	}
	
	// TO ENABLE THE NEXT BUTTON
	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		$msg .= "<li p='$nex' class='active'>Next</li>";
	} else if ($next_btn) {
		$msg .= "<li class='inactive'>Next</li>";
	}
	
	// TO ENABLE THE END BUTTON
	if ($last_btn && $cur_page < $no_of_paginations) {
		$msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
	} else if ($last_btn) {
		$msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
	}
	//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
	$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
	$msg = $msg . "</ul>" . $total_string . "</div>";  // Content for pagination
	echo $msg;
	
	?>
	</div>
</div>