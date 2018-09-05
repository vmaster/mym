<script type="text/javascript">
$(document).ready(function(){

$('#table_content_actas').DataTable({
 	dom: 'T<"clear">lfrtip',
	tableTools: {
		"sSwfPath": env_webroot_script + "/lib/data.tables-1.10.6/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
		"aButtons": [
                "copy",
                "csv",
                "xls",
                "pdf"
                /*{
                    "sExtends":    "collection",
                    "aButtons":    [ "csv", "xls", "pdf" ]
                }*/
        ]
	}
});
	
$body = $('body');
var order_by_select;
var order_by_or;

/* Cambiar de año*/
$body.off('click','div#acta .btn-consultar-acta');
$body.on('click', 'div#acta .btn-consultar-acta' , function(){

$('#conteiner_all_rows').html('Cargando...');
fec_incio = $('#txtBuscarFecIncioBkp').val();
fec_fin = $('#txtBuscarFecFinBkp').val();

$('#conteiner_all_rows').load(env_webroot_script+ escape('configurations/search_actas_bkp_img/'+$( "#cbo-tipo-acta" ).val()+'/'+fec_incio + '/' + fec_fin),function(){
	$('#table_content_actas').DataTable({
		dom: 'T<"clear">lfrtip',
		tableTools: {
			"sSwfPath": env_webroot_script + "/lib/data.tables-1.10.6/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
			"aButtons": [
					"copy",
					"csv",
					"xls",
					"pdf"
					/*{
						"sExtends":    "collection",
						"aButtons":    [ "csv", "xls", "pdf" ]
					}*/
			]
		}
	});
});
});
	
	/* Date Picker */
		$('#txtBuscarFecIncioBkp').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtBuscarFecFinBkp').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

	


		/*$( "#cbo-tipo-acta" )
		  .change(function() {
		    var str = "";
		    $( "#cbo-tipo-acta option:selected" ).each(function() {
		      str = $( this ).val();
		      if(str==0){
		      	$('.div-consorcio').show();
		      }

		      if(str==1 || str==2){
		      	$('.div-consorcio').hide();
		      }
		    });
		    //$( "div" ).text( str );
		  })
		  .trigger( "change" );*/


});

	
tinymce.init({
	save_enablewhendirty: true,
    save_onsavecallback: function() {console.log("Save");},
    selector: "textarea.editor",
    plugins: [
        //"advlist autolink lists link image charmap print preview anchor",
        //"searchreplace visualblocks code fullscreen",
        //"insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<style>
div#spinner-send-report
{
   	display: none;
    width:168px;
    height: 300px;
    position: fixed;
    top: 50%;
    left: 50%;
    text-align:center;
    margin-left: -70px;
    margin-top: -17px;
    z-index:2;
    overflow: auto;
}
</style>
<div class="row">
	<div class="col-md-12">
		<h2>Generar Backup de Imagenes por Actas </h2>
	</div>
</div>
<hr />
<div id="acta">
	<div id="add_edit_acta_container">
	</div>
	
	<div class="btn-toolbar">
		<?php //if($this->Session->read('Auth.User.tipo_user_id') != 3) { ?>
	    <a class="btn btn-primary btn-nuevo-acta" href="<?= ENV_WEBROOT_FULL_URL; ?>actas/nuevo_informe"><i class="icon-plus"></i> <?php echo __('Nuevo Informe'); ?></a>
	    <?php //} ?>
	  <div class="btn-group">
	  </div>
	</div>
	<p>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
			<label><?php echo __('Elija tipo de Acta'); ?> </label>
			<select class="select2 form-control" id="cbo-tipo-acta">
				<option value = 0> Acta de inspección de seguridad </option>
				<option value = 1> Acta de instalaciones </option>
				<option value = 2> Acta de Medio Ambiente </option>
			</select>
		</div>

		<?php /* if($this->Session->read('Auth.User.tipo_user_id')==1) { ?>
			<div class="col-md-3 col-sm-6 col-xs-6 div-consorcio">
				<label><?php echo __('Consorcio'); ?> </label>
					<select class="select2 form-control" id="cbo-entidad-search">
				        <?php 
					        if (isset($list_consorcios)){
					            	foreach ($list_consorcios as $consorcio) {
					            		if($consorcio->getAttr('id') == 1){
					            			$selected = " selected "; 
					            		}else{
					            			$selected = "";
					            		}
					            		echo "<option value = ".$consorcio->getAttr('id').$selected.">".$consorcio->getAttr('descripcion')."</option>";
					            	}
					        }
				        ?>
					</select>
			</div>*/
		?>
		
		<?php 
			$fin= date('t');
			$mes= date('m')."-".date('Y');
		?>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio');?></label> <input type="text"
				name="txtBuscarFecIncioBkp" id="txtBuscarFecIncioBkp"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtBuscarFecFinBkp" id="txtBuscarFecFinBkp"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>

		<?php /* }elseif(($this->Session->read('Auth.User.tipo_user_id')==2) && ($this->Session->read('Auth.User.consorcio_id')==1)) { ?>
			<div class="col-md-3 col-sm-6 col-xs-6" style="display: none">
				<label><?php echo __('Consorcio'); ?> </label>
					<select class="select2 form-control" id="cbo-entidad-search">
				        <?php 
					        if (isset($list_consorcios)){
					            	foreach ($list_consorcios as $consorcio) {
					            		if($consorcio->getAttr('id') == 1){
					            			$selected = " selected "; 
					            		}else{
					            			$selected = "";
					            		}
					            		echo "<option value = ".$consorcio->getAttr('id').$selected.">".$consorcio->getAttr('descripcion')."</option>";
					            	}
					        }
				        ?>
					</select>
			</div>


		<?php } else{ ?>
			<div class="col-md-3 col-sm-6 col-xs-6" style="display: none">
				<label><?php echo __('Consorcio'); ?> </label>
					<select class="select2 form-control" id="cbo-entidad-search">
				        <?php 
					        if (isset($list_consorcios)){
					            	foreach ($list_consorcios as $consorcio) {
					            		if($consorcio->getAttr('id') == 2){
					            			$selected = " selected "; 
					            		}else{
					            			$selected = "";
					            		}
					            		echo "<option value = ".$consorcio->getAttr('id').$selected.">".$consorcio->getAttr('descripcion')."</option>";
					            	}
					        }
				        ?>
					</select>
			</div>
		<?php } */?>
		<div class="col-md-3 col-sm-6 col-xs-6" style="margin-top: 26px;">
			<button type="button" class="btn btn-large btn-consultar-acta"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<br>
	<div class="well"> 
	      <div id = "conteiner_all_rows">
	      <?php 
			/*if(empty($list_acta)){ 
				echo __('No hay datos de Actas');
			}else{ 
				echo $this->element('Configuration/acta_row');
			}*/
	 	  ?>
	      </div>
	</div>
	
	<div class="modal fade" id="myModalDeleteActa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" acta_id=''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Confirmar Eliminación')); ?></h3>
				</div>
				<div class="modal-body">
					<p class="error-text">
						<i class="icon-warning-sign modal-icon"></i>
						<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar el acta?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger eliminar-acta-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="myModalSendReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" acta_id= ''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Enviar Informe por Email')); ?></h3>
				</div>
				<div id="spinner-send-report">
				    	<img src="<?= ENV_WEBROOT_FULL_URL; ?>img/ajax-loader.gif" alt="Loading..."/>
				    	<br>
				    	<label>Espere un momento...</label>
					</div>
				<?php echo $this->Form->create('SendEmail',array('method'=>'post', 'id'=>'form_send_email','action'=> false));?>
				<div class="modal-body">
					
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Correo de destino:')); ?> </label>
								</div>
								<div class="span3 col-md-7 col-sm-7 col-xs-7">
									<?php echo $this->Form->hidden('email_destino', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'email-destino')); ?>
									<select class="js-example-tokenizer" multiple="multiple">
									  <option value="jmorenod@distriluz.com.pe">Moreno Descalzi, Juan Salvador</option>
									  <option value="lvallejosm@distriluz.com.pe">Vallejos M&aacute;squez, Luis Alberto</option>
									  <option value="mperezt@distriluz.com.pe">P&eacute;rez Torres, Marisella Cristina</option>
									  <option value="csandovalg@distriluz.com.pe">Sandoval Guevara, C&eacute;sar</option>
									  <option value="dojedam@distriluz.com.pe">Ojeda Mendoza, Dante Ivan</option>
									  <option value="apejerreyg@distriluz.com.pe">Pejerrey Gonzales, Angel Antonio</option>
									  <option value="jpaicom@distriluz.com.pe">Paico Mata, Javier Nestor</option>
									  <option value="jsanchezm@distriluz.com.pe">Sanchez Montejo, Jos&eacute; Luis</option>
									  <option value="jaguilarc@distriluz.com.pe">Aguilar Calvanapon, Jos&eacute; Ytalo</option>
									  <option value="omontenegror@distriluz.com.pe">Montenegro Ramirez, Orlando</option>
									  <option value="jsalazart@distriluz.com.pe">Salazar Torres, Jaime</option>
									  <option value="jvaldiviac@distriluz.com.pe">Valdivia Cubas, Jorge Alberto</option>
									  <option value="larnaov@distriluz.com.pe">Arnao V&aacute;squez, Luis Alberto</option>
									  <option value="rcamposd@distriluz.com.pe">Campos D&iacute;az, Ra&uacute;l</option>
									  <option value="jperaltag@distriluz.com.pe">Peralta Guerrero, Jorge Luis</option>
									  <option value="jnavarror@distriluz.com.pe">Navarro Rubi&ntilde;os, Jos&eacute; Miguel</option>
									  <option value="mym.iceperu@outlook.com">MyM ingenier&iacute;a Obras y Servicios</option>
									  <option value="mym.ingenieria@mym-iceperu.com">M&M ingenier&iacute;a Obras y Servicios</option>
									  <option value="tdemeddu@gmail.com">Eddu Martin Tenorio Delgado</option>
									  <option value="jmaldonado.milian@hotmail.com">Jorge Maldonado Milian</option>
									  <option value="jmaldonado@mym-iceperu.com">Jorge Maldonado Milian</option>
									  <option value="j_contrerast@yahoo.es">Jorge Luis Contreras Tapia</option>
									  <option value="jeverli.riosleon@yahoo.es">Jeverli Rios le&oacute;n</option>
									  <option value="gersonset85@gmail.com">Gerson Paz Suclupe</option>
									  <option value="jzamoraramirez@hotmail.com">Joel Zamora Ramirez</option>
									  <option value="ing.victorjacinto@hotmail.com">Victor Hugo Jacinto Segura</option>
									  <option value="alan_hugo@outlook.com">Alan Florez Torres</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Enviar copia:')); ?> </label>
								</div>
								<div class="span3 col-md-7 col-sm-7 col-xs-7">
									<?php echo $this->Form->hidden('email_copia', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'email-copia')); ?>
									<select class="js-example-tokenizer2" multiple="multiple">
									  <option value="jmorenod@distriluz.com.pe">Moreno Descalzi, Juan Salvador</option>
									  <option value="lvallejosm@distriluz.com.pe">Vallejos M&aacute;squez, Luis Alberto</option>
									  <option value="mperezt@distriluz.com.pe">P&eacute;rez Torres, Marisella Cristina</option>
									  <option value="csandovalg@distriluz.com.pe">Sandoval Guevara, C&eacute;sar</option>
									  <option value="dojedam@distriluz.com.pe">Ojeda Mendoza, Dante Ivan</option>
									  <option value="apejerreyg@distriluz.com.pe">Pejerrey Gonzales, Angel Antonio</option>
									  <option value="jpaicom@distriluz.com.pe">Paico Mata, Javier Nestor</option>
									  <option value="jsanchezm@distriluz.com.pe">Sanchez Montejo, Jos&eacute; Luis</option>
									  <option value="jaguilarc@distriluz.com.pe">Aguilar Calvanapon, Jos&eacute; Ytalo</option>
									  <option value="omontenegror@distriluz.com.pe">Montenegro Ramirez, Orlando</option>
									  <option value="jsalazart@distriluz.com.pe">Salazar Torres, Jaime</option>
									  <option value="jvaldiviac@distriluz.com.pe">Valdivia Cubas, Jorge Alberto</option>
									  <option value="larnaov@distriluz.com.pe">Arnao V&aacute;squez, Luis Alberto</option>
									  <option value="rcamposd@distriluz.com.pe">Campos D&iacute;az, Ra&uacute;l</option>
									  <option value="jperaltag@distriluz.com.pe">Peralta Guerrero, Jorge Luis</option>
									  <option value="jnavarror@distriluz.com.pe">Navarro Rubi&ntilde;os, Jos&eacute; Miguel</option>
									  <option value="mym.iceperu@outlook.com">MyM ingenier&iacute;a Obras y Servicios</option>
									  <option value="mym.ingenieria@mym-iceperu.com">M&M ingenier&iacute;a Obras y Servicios</option>
									  <option value="tdemeddu@gmail.com">Eddu Martin Tenorio Delgado</option>
									  <option value="jmaldonado.milian@hotmail.com">Jorge Maldonado Milian</option>
									  <option value="jmaldonado@mym-iceperu.com">Jorge Maldonado Milian</option>
									  <option value="j_contrerast@yahoo.es">Jorge Luis Contreras Tapia</option>
									  <option value="jeverli.riosleon@yahoo.es">Jeverli Rios le&oacute;n</option>
									  <option value="gersonset85@gmail.com">Gerson Paz Suclupe</option>
									  <option value="jzamoraramirez@hotmail.com">Joel Zamora Ramirez</option>
									  <option value="ing.victorjacinto@hotmail.com">Victor Hugo Jacinto Segura</option>
									  <option value="alan_hugo@outlook.com">Alan Florez Torres</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Asunto:')); ?> </label>
								</div>
								<div class="span3 col-md-7 col-sm-7 col-xs-7">
									<?php echo $this->Form->input('asunto', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'txt-asunto')); ?>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Mensaje:')); ?> </label>
								</div>
								<div class="span3 col-md-7 col-sm-7 col-xs-7">
									<?php echo $this->Form->input('mensaje', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5', 'cols'=>'40','class'=> 'txtInfDes5 editor form-control','id' =>'txt-mensaje')); ?>
								</div>
							</div>
					 
				</div>
				<div class="modal-footer">
					<a class="btn btn-info" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></a>
					<a class="btn btn-danger send-report-email-trigger"><?php echo __('Enviar'); ?></a>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	$(".js-example-tokenizer").select2({
		tags: true,
		width: '100%'
	});
	$(".js-example-tokenizer").on("change", function(e) { 
 		$('#email-destino').val($(this).val());
 	});
	
	$(".js-example-tokenizer2").select2({
		tags: true,
		width: '100%'
	});
	$(".js-example-tokenizer2").on("change", function(e) { 
 		$('#email-copia').val($(this).val());
 	});
})
</script>
<style>
.ui-autocomplete{
width: 250px;
}
</style>