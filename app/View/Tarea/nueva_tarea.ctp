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
<div class="row">
	<div class="col-md-12">
		<h2>Crear una Nueva Tarea</h2>
	</div>
</div>
<hr />

<div class="container div-crear-tarea form" id="div-crear-tarea">
	<?php echo $this->Form->create('Tarea',array('method'=>'post', 'id'=>'add_edit_tarea'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-6 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNombreTarea'>".__('Ingrese las actividades del día')."</label>"; ?>
				<?php echo $this->Form->input('descripcion', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5','cols'=>'80', 'class'=> 'txt-tareas editor form-control','id' =>'txtTereas')); ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="span3 col-md-4 col-sm-6 col-xs-6">
				<?php echo "<label id='lblInformeRef'>".__('Informe de Referencia')."</label>"; ?>
				<?php echo $this->Form->input('informe_ref', array('div' => false, 'label'=> false, 'class'=> 'txt-tareas editor form-control','id' =>'txtTereas')); ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="span3 col-md-4 col-sm-6 col-xs-6">
				<strong>Movilidad:</strong>
				<div class="radio">
					<label> Viaticos <input name="data[Tarea][movilidad]" type="radio" value="0" id="rbViaticos" checked>
					</label>
				</div>
				<div class="radio" style="display: -webkit-inline-box">
					<label>Auto <input name="data[Tarea][movilidad]" type="radio" value="1" id="rbAuto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo $this->Form->input('placa_auto', array('div' => false, 'label' => false, 'class'=> 'txtPlaca form-control','id' =>'txtPlaca', 'type' =>'text', 'style' => 'display:none', 'value'=>'MyM')); ?>
					</label>
				</div>
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