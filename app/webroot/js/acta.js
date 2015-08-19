$(document).ready(function(){
	
	Acta = this;
	$body = $('body');
	
	acta = {

		deleteActa: function(acta_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'actas/delete_acta',
				data:{
					'acta_id': acta_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.acta_row_container[acta_id='+acta_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		sendReport: function(acta_id, email_destino, email_copia, asunto, mensaje){
			$('#spinner-send-report').show();
			$('#myModalSendReport .modal-body').hide();
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'actas/send_reporte_email',
				data:{
					'acta_id': acta_id,
					'email_destino': email_destino,
					'email_copia': email_copia,
					'asunto': asunto,
					'mensaje': mensaje
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					alertify.success(data.msg);
					$('#myModalSendReport').modal('hide');
					$('.modal-backdrop').fadeOut(function(){$(this).hide()});
				}else{
					$('#spinner-send-report').hide();
					$('#myModalSendReport .modal-body').show();
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						//alert(key);
						$('[name="data[SendEmail]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[SendEmail]['+key+']"]').change(function() {
						$('[name="data[SendEmail]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});	
		},
		changeEstadoRevisado: function(acta_id, value_check){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'actas/activar_revisado',
				data:{
					'acta_id': acta_id,
					'value_check' : value_check
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					alertify.success(data.msg);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						//alert(key);
						$('[name="data[SendEmail]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[SendEmail]['+key+']"]').change(function() {
						$('[name="data[SendEmail]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear vehículo */
	$body.off('click','div#acta .btn-nuevo-acta');
	$body.on('click', 'div#acta .btn-nuevo-acta' , function(){
		acta_id = $(this).attr('acta_id');
		acta.openAddActa(acta_id);
	});
	
	/* Ocultar formulario Crear Acta*/
	$body.on('click','div#div-crear-acta .btn-cancelar-crear-acta', function(){
		//$('#add_edit_acta').hide();
		window.open(env_webroot_script + 'actas/','_self');
	});
	
	$body.off('click','.btn_crear_acta_trigger');
	$body.on('click','.btn_crear_acta_trigger',function(){
		myProccess.showPleaseWait();
		$form = $(this).parents('form').eq(0);
		
		var html_conclusiones = $('#father-container1 .nicEdit-main:first').html();
		var html_recomendaciones = $('#father-container1 .nicEdit-main:last').html();
		var html_med_control = $('#father-container2 .nicEdit-main:first').html();
		
		
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize() + '&html_conclusiones=' + html_conclusiones + '&html_recomendaciones=' + html_recomendaciones + '&html_med_control=' + html_med_control,
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				myProccess.hidePleaseWait();
				$('.btn_crear_acta_trigger').prop('disabled',true)
				alertify.success(data.msg);
				setTimeout(function(){
					window.open(env_webroot_script + 'actas/','_self');
				},1000)
				
			}else{
				myProccess.hidePleaseWait();
				$('.btn_crear_acta_trigger').prop('disabled',false)
				$.each(data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[Acta]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Acta]['+key+']"]').change(function() {
						$('[name="data[Acta]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#acta .edit-acta-trigger');
	$body.on('click','div#acta .edit-acta-trigger', function(){
		acta_id = $(this).parents('.acta_row_container').attr('acta_id');
		//acta.openEditActa(acta_id);
		
		/*if($form.attr('acta_id') == undefined || !$form.attr('acta_id')) {
			codigo_id ='';
		}else{*/
			alert($('txtConclusiones').val());
			$('#father-container .nicEdit-main:first').html($('txtConclusiones').val());
		//}
	});
	
	$body.off('click','div#acta .open-model-delete-acta');
	$body.on('click','div#acta .open-model-delete-acta', function(){
		acta_id = $(this).parents('.acta_row_container').attr('acta_id');
		$('div#myModalDeleteActa').attr('acta_id', acta_id);
	});
	
	$body.off('click','div#myModalDeleteActa .eliminar-acta-trigger');
	$body.on('click','div#myModalDeleteActa .eliminar-acta-trigger', function(){
		acta_id = $('div#myModalDeleteActa').attr('acta_id');
		acta.deleteActa(acta_id);
	});
	
	$( "#rbMym" ).click(function() {
		  $('#txtEmpSup').attr('value','MyM');
		  $('#txtEmpSup').css('display','none');
	});
	
	$body.off('click','div#acta #chRevisado');
	$body.on('click','div#acta #chRevisado', function(){
		if($(this).prop('checked') == true){
			$(this).val(1);
			$(this).parents('.acta_row_container').attr('style','');
        } else {  
        	$(this).val(0);
        	$(this).parents('.acta_row_container').attr('style','background-color:#BADEFB');
        }
		acta_id = $(this).parents('.acta_row_container').attr('acta_id');
		value_check = $(this).val();
		acta.changeEstadoRevisado(acta_id, value_check);
	});
	
	/*Send Report by Email*/
	$body.off('click','div#acta .open-model-send-informe');
	$body.on('click','div#acta .open-model-send-informe', function(){
		acta_id = $(this).parents('.acta_row_container').attr('acta_id');
		$('div#myModalSendReport').attr('acta_id', acta_id);
		$('#spinner-send-report').hide();
		$('#myModalSendReport .modal-body').show();
		$(":input").each(function(){	
			$($(this)).val('');
		});
	});
	
	$body.off('click','div#myModalSendReport .send-report-email-trigger');
	$body.on('click','div#myModalSendReport .send-report-email-trigger', function(){
		acta_id = $('div#myModalSendReport').attr('acta_id');
		email_destino = $('div#myModalSendReport #email-destino').val();
		email_copia = $('div#myModalSendReport #email-copia').val();
		asunto = $('div#myModalSendReport #txt-asunto').val();
		mensaje = $('div#myModalSendReport #txt-mensaje').val();
		acta.sendReport(acta_id, email_destino, email_copia, asunto, mensaje);
	});
	
	/*$('#spinner-send-report').ajaxStart(function () {
		$('#form_send_email').hide();
	    $(this).fadeIn('fast');
	 }).ajaxStop(function () {
	     $(this).stop().fadeOut('fast');
	     document.getElementById('form_send_email').reset();
	     $('#form_send_email').show();
	});*/
	
	/*SCRIPT PARA ELIMINAR FOTOS IPP -  EXISTENTES*/
	$body.off('click','.delete-file-ipp');
	$body.on('click','.delete-file-ipp', function(){
		file_name = $(this).data('url');
		foto_ipp = $(this).data('foto_ipp');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'actas/delete_foto_ipp',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto_ipp='+foto_ipp+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS SD -  EXISTENTES*/
	$body.off('click','.delete-file-sd');
	$body.on('click','.delete-file-sd', function(){
		file_name = $(this).data('url');
		foto_sd = $(this).data('foto_sd');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'actas/delete_foto_sd',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto_sd='+foto_sd+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS UM -  EXISTENTES*/
	$body.off('click','.delete-file-um');
	$body.on('click','.delete-file-um', function(){
		file_name = $(this).data('url');
		foto_um = $(this).data('foto_um');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'actas/delete_foto_um',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto_um='+foto_um+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS UM -  EXISTENTES*/
	$body.off('click','.delete-file-doc');
	$body.on('click','.delete-file-doc', function(){
		file_name = $(this).data('url');
		foto_doc = $(this).data('foto_doc');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'actas/delete_foto_doc',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto_doc='+foto_doc+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS ACTOS SUB -  EXISTENTES*/
	$body.off('click','.delete-file-as');
	$body.on('click','.delete-file-as', function(){
		file_name = $(this).data('url');
		foto_as = $(this).data('foto-as');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'actas/delete_foto_as',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto_as='+foto_as+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS COND SUB -  EXISTENTES*/
	$body.off('click','.delete-file-cs');
	$body.on('click','.delete-file-cs', function(){
		file_name = $(this).data('url');
		foto_cs = $(this).data('foto-cs');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'actas/delete_foto_cs',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-cs='+foto_cs+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS MEDIDAS DE CONTROL -  EXISTENTES*/
	$body.off('click','.delete-file-med');
	$body.on('click','.delete-file-med', function(){
		file_name = $(this).data('url');
		foto_med = $(this).data('foto-med');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'actas/delete_foto_med',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-med='+foto_med+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	
/***** ENVIAR EL INDEX DEL BOTON CREAR TRABAJADOR AL MODAL ******/
	function loadSendIndexButtonToModalTrabajador(){
		$.each($('.btn-open-modal-trabajador'), function(index) {
			index_current = index + 1;
			cadena_name_id = "#btn-open-create-trabajador"+ index_current;
			  
			  $(cadena_name_id).click(function() {
				  nombre_id_input_button = $(this).attr('id');
				  longitud = nombre_id_input_button.length;
				  if(longitud==27){
					  index_current = nombre_id_input_button.substring(longitud-1);
				  }else{
					  index_current = nombre_id_input_button.substring(longitud-2);
				  }
				  $('#txt-apellido-nombre').val('');
				  $('#txt-nro-documento').val('');
				  $('.cboTipoTrabajadores').val('');
				  $('#txt-apellido-nombre').parent().removeClass('control-group has-error');
				  $('#myModalAddTrabajador').attr('index-button',index_current);
				  $('#myModalAddTrabajador').attr('data-type','t');
			  });
		});
	}
	loadSendIndexButtonToModalTrabajador();

/***** ENVIAR EL INDEX DEL BOTON CREAR TRABAJADOR AL MODAL ******/
	function loadSendIndexButtonToModalResponsable(){
		$.each($('.btn-open-modal-responsable'), function(index) {
			index_current = index + 1;
			cadena_name_id = "#btn-open-create-resp"+ index_current;
			  
			  $(cadena_name_id).click(function() {
				  nombre_id_input_button = $(this).attr('id');
				  longitud = nombre_id_input_button.length;
				  index_current = nombre_id_input_button.substring(longitud-1);

				  $('#txt-apellido-nombre').val('');
				  $('#txt-apellido-nombre').parent().removeClass('control-group has-error');
				  $('#myModalAddTrabajador').attr('index-button',index_current);
				  $('#myModalAddTrabajador').attr('data-type','r');
			  });
		});
	}
	loadSendIndexButtonToModalResponsable();

/******* ENVIAR INDEX DEL BOTON CREAR VEHICULO AL MODAL *******/
	function loadSendIndexButtonToModalVehiculo(){
		$.each($('.btn-open-modal-vehiculo'), function(index) {
			index_current = index + 1;
			cadena_name_id = "#btn-open-create-vehiculo"+ index_current;
			  
			  $(cadena_name_id).click(function() {
				  nombre_id_input_button = $(this).attr('id');
				  longitud = nombre_id_input_button.length;
				  if(longitud==25){
					  index_current = nombre_id_input_button.substring(longitud-1);
				  }else{
					  index_current = nombre_id_input_button.substring(longitud-2);
				  }
				  $('#txt-nro-placa').val('');
				  $('#txt-nro-placa').parent().removeClass('control-group has-error');
				  $('#myModalAddVehiculo').attr('index-button',index_current);
			  });
		});
	}
	loadSendIndexButtonToModalVehiculo();

/*SCRIPTS PARA EL CREAR Y EDITAR INFORME  */
	
	/* AGREGAR FILAS A LA TABLA DE IMPLEMENTOS DE PROT PERSO. */

		$("#div-btn-add-ipp .add-more-row-ipp").bind("click", function(e){
			long_table = $('#table-ipp-inf tbody tr').length + 1;
			 $.ajax({
		         type: "POST",
		         url: env_webroot_script + "actas/add_file_ipp",
		         data: { long_table: long_table },
		         cache: false,
		         success: function(html)
		          {
		        	 $('#table-ipp-inf tr:last').after(html);
		        	 loadATrabajador();
		        	 loadEachTrabajador();
		        	 loadANIncumplicas();
		        	 loadSendIndexButtonToModalTrabajador();
		          }
			 });
		});
		
	/* AGREGAR FILAS A LA TABLA DE UNIDADES MOVILES */	
	$("#div-btn-add-um .add-more-row-um").bind("click", function(e){
	long_table = $('#table-um-inf tbody tr').length + 1;
		$.ajax({
	        type: "POST",
	        url: env_webroot_script + "actas/add_file_um",
	        data: { long_table: long_table },
	        cache: false,
	        success: function(html)
	         {
	       	 $('#table-um-inf tr:last').after(html);
	       	 loadAPlaca();
	       	 loadANIncumplicas();
	       	 loadEachPlaca();
	       	 loadSendIndexButtonToModalVehiculo();
	         }
		 });
	});
	
	/* AGREGAR FILAS A LA TABLA ACTOS SUBESTÁNDARES */	
	$("#div-btn-add-as .add-more-row-as").bind("click", function(e){
	long_table = $('#table-as-inf tbody tr').length + 1;
		$.ajax({
	        type: "POST",
	        url: env_webroot_script + "actas/add_file_as",
	        data: { long_table: long_table },
	        cache: false,
	        success: function(html)
	         {
	       	 $('#table-as-inf tr:last').after(html);
	       	 loadAActosSub();
	       	 loadANIncumplicas();
	         }
		 });
	});
	
	/* AGREGAR FILAS A LA TABLA CONDICIONES SUBESTÁNDARES */	
	$("#div-btn-add-cs .add-more-row-cs").bind("click", function(e){
	long_table = $('#table-cs-inf tbody tr').length + 1;
		$.ajax({
	        type: "POST",
	        url: env_webroot_script + "actas/add_file_cs",
	        data: { long_table: long_table },
	        cache: false,
	        success: function(html)
	         {
	       	 $('#table-cs-inf tr:last').after(html);
	       	 loadACondSub();
	       	 loadANIncumplicas();
	         }
		 });
	});
	
	/* AGREGAR FILAS A LA TABLA CIERRE DE ACTA (Medidas de control adoptadas) */	
	$("#div-btn-add-mc .add-more-row-mc").bind("click", function(e){
	long_table = $('#table-mc-inf tbody tr').length;
		
	var new_row = 	"<tr>"+
					"<td>"+(long_table+1)+"</td>"+
					"<td><input name='data[MedidasAdoptadas]["+(long_table+1)+"][descripcion]' id='txtMedidasAdopDes"+(long_table+1)+"' value='' class='form-control'/>"+
				    "<input name='data[MedidasAdoptadas]["+(long_table+1)+"][ca_id]' type='hidden' id='hiddenCierreActa"+(long_table+1)+"' value='' class='form-control'/></td>"+
					"</tr>";

		$('#table-mc-inf tr:last').after(new_row);
	});
	
	
	/* AGREGAR FILAS A LA TABLA ACTOS SUBESTÁNDARES PARA EL REPORTE*/	
	$("#div-btn-add-as-rep .add-more-row-as-rep").bind("click", function(e){
	long_table = $('#table-as-rep tbody tr').length + 1;
		$.ajax({
	        type: "POST",
	        url: env_webroot_script + "actas/add_row_as_rep",
	        data: { long_table: long_table },
	        cache: false,
	        success: function(html)
	         {
	       	 $('#table-as-rep tr:last').after(html);
	         }
		 });
	});
	
	/* AGREGAR FILAS A LA TABLA CONDICIONES SUBESTÁNDARES PARA EL REPORTE*/	
	$("#div-btn-add-cond-rep .add-more-row-cond-rep").bind("click", function(e){
	long_table = $('#table-cond-rep tbody tr').length + 1;
		$.ajax({
	        type: "POST",
	        url: env_webroot_script + "actas/add_row_cond_rep",
	        data: { long_table: long_table },
	        cache: false,
	        success: function(html)
	         {
	       	 $('#table-cond-rep tr:last').after(html);
	         }
		 });
	});
	
	$("#div-btn-add-epp-rep .add-more-row-epp-rep").bind("click", function(e){
		long_table = $('#table-epp-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "actas/add_row_epp_rep",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-epp-rep tr:last').after(html);
		         }
			 });
		});
	
	$("#div-btn-add-sd-rep .add-more-row-sd-rep").bind("click", function(e){
		long_table = $('#table-sd-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "actas/add_row_sd_rep",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-sd-rep tr:last').after(html);
		         }
			 });
		});
	
	$("#div-btn-add-um-rep .add-more-row-um-rep").bind("click", function(e){
		long_table = $('#table-um-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "actas/add_row_um_rep",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-um-rep tr:last').after(html);
		         }
			 });
		});
	
	$("#div-btn-add-ds-rep .add-more-row-ds-rep").bind("click", function(e){
		long_table = $('#table-ds-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "actas/add_row_ds_rep",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-ds-rep tr:last').after(html);
		         }
			 });
		});
	
	/*AUTOCOMPLETAR CON SELECT2*/
	
	$(".cbo-empresas-select2").select2({
		  placeholder: "Seleccione una empresa",
		  allowClear: true
		});
	
	$(".cbo-acta-refer-select2").select2({
		  placeholder: "Seleccione informe",
		  allowClear: true
		});
	
	$(".cbo-uunn-select2").select2({
		  placeholder: "Seleccione UUNN",
		  allowClear: true
		});
	
	function loadATrabajador(){
	$(".cbo-trabajadores-select2").select2({
		  placeholder: "Seleccione un trabajador",
		  allowClear: true,
		  width: '100%'
	});
	}
	loadATrabajador();
	
	function loadAActosSub(){
		$(".cbo-tipo-act-sub-select2").select2({
			  placeholder: "Acto Subestandar",
			  allowClear: true,
			  width: '100%'
		});
	}
	loadAActosSub();
	
	function loadACondSub(){
		$(".cbo-tipo-cond-sub-select2").select2({
			  placeholder: "Condici\u00F3n Subestandar",
			  allowClear: true,
			  width: '100%'
		});
	}
	loadACondSub();
	
	$(".cbo-responsable-select2").select2({
			  placeholder: "Seleccione responsable",
			  allowClear: true,
			  width: '100%'
	});
	
	$.each($('.cbo-responsable-select2'), function(index) {
		index_input = (index + 1);
		cadena_name_id = "#ResId"+ index_input;
		
		$(cadena_name_id).change(function(e) {
			nombre_id_input_responsable = $(this).attr('id');
		    longitud = nombre_id_input_responsable.length;
	    	index_current = nombre_id_input_responsable.substring(longitud-1);
	    	attr_id_dni = '#txtDniRes'+ index_current;

		    responsable_id = $("option:selected",this).val();
		    loadDniByTrabajador(responsable_id, attr_id_dni)
		});
	});

	
	/*$(".cbo-actividades-select2").select2({
		  placeholder: "Seleccione una actividad",
		  allowClear: true
	});*/
	
	function loadANIncumplicas(){
		$(".cbo-nincumplidas-select2").select2({
			placeholder: "NI",
			allowClear: true,
			width: '100%'
		});
	}
	loadANIncumplicas();

	function loadAPlaca(){
		$(".cbo-placas-select2").select2({
			  placeholder: "Nro de Placa",
			  allowClear: true,
			  width: '80%'
		});
	}
	loadAPlaca();
	
	function loadEachTrabajador(){
		$.each($('.cbo-trabajadores-select2'), function(index) {
			index_input = (index + 1);
			cadena_name_id = "#Trabajador"+ index_input;
			name_class_ni = ".txt-ni"+ index_input;
			
			$(cadena_name_id).change(function(e) {
				nombre_id_input_trabajador = $(this).attr('id');
			    longitud = nombre_id_input_trabajador.length;
			    if(longitud == 11){
		    		index_current = nombre_id_input_trabajador.substring(longitud-1);
			    }else{
			    	index_current = nombre_id_input_trabajador.substring(longitud-2);
			    }
			    trabajadore_id = $("option:selected",this).val();
			    loadActividadByTrabajador(trabajadore_id, index_current);
			});
		});
	}
	loadEachTrabajador();
	
	
	function loadEachPlaca(){
		$.each($('.cbo-placas-select2'), function(index) {
			index_input = (index + 1);
			cadena_name_id = "#PlacaActa"+ index_input;
			name_class_ni = ".txt-ni"+ index_input;
			
			$(cadena_name_id).change(function(e) {
				nombre_id_input_placa = $(this).attr('id');
			    longitud = nombre_id_input_placa.length;
			    if(longitud == 10){
		    		index_current = nombre_id_input_placa.substring(longitud-1);
			    }else{
			    	index_current = nombre_id_input_placa.substring(longitud-2);
			    }
			    placa_id = $("option:selected",this).val();
			    loadVehiculoByPlaca(placa_id, index_current)
			});
		});
	}
	loadEachPlaca();
	
	function loadActividadByTrabajador(trabajador_id, index){
		element_actividad = '#Actividad'+index;
		//element_actividad_hidden = '#HiddenActividadid'+index; //aqui obtengo el nombre
        $.ajax({
          type: "POST",
          url: env_webroot_script + "actas/ajax_actividad_trabajador",
          data: { trabajador_id: trabajador_id },
          dataType: "json",
          cache: false,
          success: function(html)
           {
        	  $.each($("option", element_actividad), function(index) {
        		  //alert($(this).attr('value') +"  -----  "+ html.id);
        		  if($(this).attr('value') == html.id){
        			  $(this).attr('selected','selected');
                  }  
        	  })
        	  
        	  //$(element_actividad).val(html.nombre_actividad);
              //$(element_actividad_hidden).val(html.id);

           }
        })
	}
	
	function loadVehiculoByPlaca(placa_id, index){
		element_vehiculo = '#TipoVehiculoActa'+index;
		element_vehiculo_hidden = '#hiddenVehiculoid'+index;
        $.ajax({
          type: "POST",
          url: env_webroot_script + "actas/ajax_vehiculo_placa",
          data: { placa_id: placa_id },
          dataType: "json",
          cache: false,
          success: function(html)
           {
              $(element_vehiculo).val(html.nombre_vehiculo);
              $(element_vehiculo_hidden).val(html.id);
              $(element_vehiculo).attr('Disabled',true);

           }
        })
	}
	
	function loadDniByTrabajador(trabajador_id, attr_id_dni){
        $.ajax({
          type: "POST",
          url: env_webroot_script + "actas/ajax_trabajador_dni",
          data: { trabajador_id: trabajador_id },
          cache: false,
          success: function(html)
           {
             $(attr_id_dni).val(html);
             $(attr_id_dni).prop("disabled","disabled");
             if(html.length > 50){
            	 $(attr_id_dni).val('');
   			 }
           }
        })
	}
	
	
	/* Date Picker */
	$('#txtFechaActa').datepicker(
			{
				changeYear: true, 
				dateFormat: 'dd-mm-yy',
				 onSelect: function(datetext){
				        var d = new Date(); // for now
				        
				        function addZero(i) {
				            if (i < 10) {
				                i = "0" + i;
				            }
				            return i;
				        }
				        
				        //datetext=datetext+" "+addZero(d.getHours())+":"+addZero(d.getMinutes())+":"+addZero(d.getSeconds());
				        $('#txtFechaActa').val(datetext);
				    },
				minDate: new Date(1924, 1 - 1, 1),
				maxDate: new Date()
			});
	
	//$('#rbTipo1').checked()
	$( "#rbMym" ).click(function() {
		  $('#txtEmpSup').attr('value','MyM');
		  $('#txtEmpSup').css('display','none');
	});
	
	$( "#rbOtro" ).click(function() {
		  $('#txtEmpSup').attr('value','');
		  $('#txtEmpSup').css('display','');
	});
	
	$('[data-toggle="tooltip"]').tooltip();
	
});