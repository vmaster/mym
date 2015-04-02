<script type="text/javascript">
$body = $('body');
var order_by_select;
var order_by_or;

</script>
<div id="rol_persona" persona_id= <?php if(isset($persona_id)){echo $persona_id;} ?> persona_nombre='<?php if(isset($persona_nombre)){echo $persona_nombre;} ?>'>
	<div id="add_edit_rol_persona_container">
	</div>
	
	<div class="btn-toolbar">
	    <button class="btn btn-primary btn-nuevo-rol-persona"><i class="icon-plus"></i> <?php echo __('Nuevo Rol'); ?></button>
	  <div class="btn-group">
	  </div>
	</div>
	
	<div class="well">
	    <?php 
		if(empty($list_rol_persona)){ 
			echo __('No hay roles');
		}else{ ?>  
	      <div id = "conteiner_all_rows">
	      <?php 
	      	echo $this->element('RolPersona/rol_persona_row');
	 	  ?>
	      </div>
	    <?php }?>
	</div>
	<div class="pagination">
	    <ul>
	        <li><a href="#">Prev</a></li>
	        <li><a href="#">1</a></li>
	        <li><a href="#">2</a></li>
	        <li><a href="#">3</a></li>
	        <li><a href="#">4</a></li>
	        <li><a href="#">Next</a></li>
	    </ul>
	</div>
	
	<div class="modal small hide fade" id="myModalDeleteRolPersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        <h3 id="myModalLabel">Delete Confirmation</h3>
	    </div>
	    <div class="modal-body">
	        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
	    </div>
	    <div class="modal-footer">
	        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
	    </div>
	</div>
</div>