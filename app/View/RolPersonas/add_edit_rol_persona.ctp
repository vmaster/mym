<div class="container div-crear-rol-persona form" id="div-crear-rol-persona">
	<?php echo $this->Form->create('RolPersona',array('method'=>'post', 'id'=>'add_edit_rol_persona'));?>
	<section>
		<div class="row">
			<div class="span2">
				<?php 
					echo __('Persona').':'; 
				?>
			</div>
			<div class="span2">
				<?php 
					if(isset($persona_nombre)){echo ' '.$persona_nombre;} 
				?>
			</div>
		</div>
		<div class="row">
			<div class="span2">
				<?php echo "<label>".__('Rol persona').":</label>"; ?>
			</div>
			<div class="span2">
				<select name="data[RolPersona][role_id]" class="cboRolPersona">
					<?php 
					if(isset($list_all_roles_missing)){
						foreach ($list_all_roles_missing as $rol):
						echo "<option value = ".$rol->getAttr('id').">".$rol->getAttr('descripcion')."</option>";
						endforeach;
					}
				?>
				</select>
				<?php 
				if(isset($list_all_roles_missing)){
					if(count($list_all_roles_missing) > 0){
						echo "HOLA";
					}

				}
				?>
			</div>
		</div><br>
		<div class="row" style="text-align:center;">
			<div class="span9">
				<button type="button" class="btn btn-large btn-success btn_crear_rol_persona_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-rol_persona"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
</div>
<hr>