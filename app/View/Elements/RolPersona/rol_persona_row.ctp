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
		<table class="table" id="table_content_personas">
			<thead>
		        <tr>
		          <th><?php echo __('Nro'); ?></th>
		          <th><?php echo __('Rol'); ?></th>
		          
		          <th><?php echo __('Operaciones'); ?></th>
		          <th style="width: 26px;"></th>
		        </tr>
		    </thead>
			<?php 
			$n = 0;
			foreach ($list_rol_persona as $rol_persona):
			$n = $n + 1;
			?>
			<tbody>
					<tr class="rol_persona_row_container" rol_persona_id="<?php echo $rol_persona->getAttr('id'); ?>">
						<td><?php echo $n; ?></td>
						<td><?php echo $rol_persona->Role->getAttr('descripcion'); ?></td>
						<td>
							<a href="#myModalDeleteRolPersona" role="button" data-toggle="modal"><i class="icon-remove"></i> </a>
						</td>
					</tr>
					<?php 
					endforeach;
					?>
			</tbody>	
		</table>
	</div>
	<br>

</div>