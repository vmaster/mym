<script type="text/javascript">
tinymce.init({
	save_enablewhendirty: true,
    save_onsavecallback: function() {console.log("Save");},
    selector: "textarea.editor",
    language: "es",
    browser_spellcheck : true,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<div class="container div-crear-tarea form" id="div-crear-tarea">
	<?php echo $this->Form->create('Tarea',array('method'=>'post', 'id'=>'add_edit_tarea'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-6 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNombreTarea'>".__('Ingrese las actividades del día')."</label>"; ?>
				<?php echo $this->Form->input('descripcion', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5','cols'=>'80', 'class'=> 'txt-tareas editor form-control','id' =>'txtTereas')); ?>
			</div>
		</div>
		<div class="roww">
			<div class="span3 col-md-6 col-sm-6 col-xs-6">
				<select name="data[Tarea][tarea_id]" class="cbo-tarea-refer-select2 form-control">
						<?php 
							if (isset($list_tareas_ref_user)){
								echo "<option>---</option>";
								foreach ($list_tareas_ref_user as $id => $tarea):
								echo "<option value = ".$tarea['Tarea']['id'].">".$tarea['Tarea']['num_informe']."</option>";
								endforeach;
							}
						?>
				</select>
			</div>
		</div>
		<br>
		<div class="row" style="text-align:left;">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn_crear_tarea_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-tarea"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
<hr>
</div>