$(document).ready(function(){
	
	Acta = this;
	$body = $('body');
	
	acta = {

		deleteActaInstalacion: function(acta_instalacion_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'acta_instalaciones/delete_acta',
				data:{
					'acta_instalacion_id': acta_instalacion_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.acta_instalacion_row_container[acta_instalacion_id='+acta_instalacion_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		changeEstadoRevisado: function(acta_instalacion_id, value_check){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'acta_instalaciones/activar_revisado',
				data:{
					'acta_instalacion_id': acta_instalacion_id,
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
		},

		saveTimeToTimeEdit: function(){
			tinyMCE.triggerSave();
			$form = $('#add_edit_acta_instal'). eq(0);
			var html_conclusiones = $('#father-container1 .nicEdit-main:first').html();
			var html_recomendaciones = $('#father-container1 .nicEdit-main:last').html();
			var html_csegeg_control = $('#father-container2 .nicEdit-main:first').html();
			
			$.ajax({
				url: $form.attr('action'),
				data: $form.serialize() + '&html_conclusiones=' + html_conclusiones + '&html_recomendaciones=' + html_recomendaciones + '&html_csegeg_control=' + html_csegeg_control,
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					alertify.success('Guardado Atomatico Exitoso!');
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Acta]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Acta]['+key+']"]').change(function() {
							$('[name="data[Acta]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		}
	}


	/* Mostrar formulario: Crear vehículo */
	$body.off('click','div#acta_instalacion .btn-nuevo-acta-instal');
	$body.on('click', 'div#acta_instalacion .btn-nuevo-acta-instal' , function(){
		acta_instalacion_id = $(this).attr('acta_instalacion_id');
		acta.openAddActa(acta_instalacion_id);
	});
	
	/* Ocultar formulario Crear Acta*/
	$body.on('click','div#div-crear-acta-instal .btn-cancelar-crear-acta-instal', function(){
		window.open(env_webroot_script + 'acta_instalaciones/','_self');
	});
	
	$body.on('click','div#div-editar-acta-instal .btn-cancelar-crear-acta-instal', function(){
		window.open(env_webroot_script + 'acta_instalaciones/','_self');
	});

	$body.off('click','.btn_crear_acta_instal_trigger');
	$body.on('click','.btn_crear_acta_instal_trigger',function(){
		myProccess.showPleaseWait();
		tinyMCE.triggerSave();
		$form = $(this).parents('form').eq(0);
		var html_conclusiones = $('#father-container1 .nicEdit-main:first').html();
		var html_recomendaciones = $('#father-container1 .nicEdit-main:last').html();
		var html_med_control = $('#father-container2 .nicEdit-main:first').html();
		
		var svg = document.getElementById('container_graf_cu').children[0].innerHTML;
		canvg(document.getElementById('canvas'),svg);

		//var canvas = new Canvas();
		var img = canvas.toDataURL("image/png"); //img is data:image/png;base64
		img = img.replace('data:image/png;base64,', '');
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize() + '&html_conclusiones=' + html_conclusiones + '&html_recomendaciones=' + html_recomendaciones + '&html_med_control=' + html_med_control + '&graf=' +  img,
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				myProccess.hidePleaseWait();
				$('.btn_crear_acta_instal_trigger').prop('disabled',true)
				alertify.success(data.msg);
				setTimeout(function(){
					window.open(env_webroot_script + 'acta_instalaciones/','_self');
				},1000)
				
			}else{
				myProccess.hidePleaseWait();

				$('.btn_crear_acta_instal_trigger').prop('disabled',false)
				$.each(data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[ActaInstalacione]['+key+']"]').parent().addClass('control-group has-error');
					
					$('[name="data[ActaInstalacione]['+key+']"]').change(function() {
						$('[name="data[ActaInstalacione]['+key+']"]').parent().removeClass('control-group has-error');
					});


					var span_combo = $("span.select2-selection");
					$('.span-cbo-empresa').find(span_combo).css("border-color","#a94442");
					$('.td-cbo-uunn').find(span_combo).css("border-color","#a94442");
					$('.span-cbo-responsable-act').find(span_combo).css("border-color","#a94442")
					$('.span-cbo-responsable-sup').find(span_combo).css("border-color","#a94442");

					$('.span-cbo-empresa').change(function() {
						$('.span-cbo-empresa').find(span_combo).css("border-color","");
					});
					$('.td-cbo-uunn').change(function() {
						$('.td-cbo-uunn').find(span_combo).css("border-color","");
					});
					$('.span-cbo-responsable-act').change(function() {
						$('.span-cbo-responsable-act').find(span_combo).css("border-color","");
					});
					$('.span-cbo-responsable-sup').change(function() {
						$('.span-cbo-responsable-sup').find(span_combo).css("border-color","");
					});

					if($('.span-cbo-empresa').find($('.select2-selection__clear')).length > 0){
						$('.span-cbo-empresa').find(span_combo).css("border-color","");
					}
					if($('.td-cbo-uunn').find($('.select2-selection__clear')).length > 0){
						$('.td-cbo-uunn').find(span_combo).css("border-color","");
					}
					if($('.span-cbo-responsable-act').find($('.select2-selection__clear')).length > 0){
						$('.span-cbo-responsable-act').find(span_combo).css("border-color","");
					}
					if($('.span-cbo-responsable-sup').find($('.select2-selection__clear')).length > 0){
						$('.span-cbo-responsable-sup').find(span_combo).css("border-color","");
					}

					$('html,body').animate({scrollTop:'400px'}, 700);return false;

				});
			}
		});
	});

	$body.off('click','div#acta_instalacion .edit-acta-trigger');
	$body.on('click','div#acta_instalacion .edit-acta-trigger', function(){
		acta_instalacion_id = $(this).parents('.acta_instalacion_row_container').attr('acta_instalacion_id');
		//acta.openEditActa(acta_instalacion_id);
		
		/*if($form.attr('acta_instalacion_id') == undefined || !$form.attr('acta_instalacion_id')) {
			codigo_id ='';
		}else{*/
			//alert($('txtConclusiones').val());
			$('#father-container .nicEdit-main:first').html($('txtConclusiones').val());
		//}
	});
	
	$body.off('click','div#acta_instalacion .open-model-delete-acta-instal');
	$body.on('click','div#acta_instalacion .open-model-delete-acta-instal', function(){
		acta_instalacion_id = $(this).parents('.acta_instalacion_row_container').attr('acta_instalacion_id');
		$('div#myModaldeleteActaInstalacion').attr('acta_instalacion_id', acta_instalacion_id);
	});
	
	$body.off('click','div#myModaldeleteActaInstalacion .eliminar-acta-trigger');
	$body.on('click','div#myModaldeleteActaInstalacion .eliminar-acta-trigger', function(){
		acta_instalacion_id = $('div#myModaldeleteActaInstalacion').attr('acta_instalacion_id');
		acta.deleteActaInstalacion(acta_instalacion_id);
	});
	
	$( "#rbMym" ).click(function() {
		  $('#txtEmpSup').attr('value','MyM');
		  $('#txtEmpSup').css('display','none');
	});
	
	$body.off('click','div#acta_instalacion #chRevisado');
	$body.on('click','div#acta_instalacion #chRevisado', function(){
		if($(this).prop('checked') == true){
			$(this).val(1);
			$(this).parents('.acta_instalacion_row_container').attr('style','');
        } else {  
        	$(this).val(0);
        	$(this).parents('.acta_instalacion_row_container').attr('style','background-color:#BADEFB');
        }
		acta_instalacion_id = $(this).parents('.acta_instalacion_row_container').attr('acta_instalacion_id');
		value_check = $(this).val();
		acta.changeEstadoRevisado(acta_instalacion_id, value_check);
	});
	
	/*Send Report by Email*/
	$body.off('click','div#acta_instalacion .open-model-send-informe');
	$body.on('click','div#acta_instalacion .open-model-send-informe', function(){
		document.getElementById("form_send_email").reset();
		acta_instalacion_id = $(this).parents('.acta_instalacion_row_container').attr('acta_instalacion_id');
		$('div#myModalSendReport').attr('acta_instalacion_id', acta_instalacion_id);
		$('#spinner-send-report').hide();
		$('#myModalSendReport .modal-body').show();
		$('.nicEdit-main').html('');
		$(":input").each(function(){	
			$($(this)).val('');
		});
	});
	
	$body.off('click','.send-report-email-trigger');
	$body.on('click','.send-report-email-trigger', function(){

		$('#spinner-send-report').show();
		$('#myModalSendReport .modal-body').hide();
		tinyMCE.triggerSave();
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: env_webroot_script + 'acta_instalaciones/send_reporte_email',
			data: $form.serialize() + '&acta_instalacion_id=' + acta_instalacion_id,
			dataType: 'json',
			type: 'post'
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
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS ILUMINACIÓN Y VENTILACIÓN -  EXISTENTES*/
	$body.off('click','.delete-file-iv');
	$body.on('click','.delete-file-iv', function(){
		file_name = $(this).data('url');
		foto_iv = $(this).data('foto-iv');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_instalaciones/delete_foto_iv',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-iv='+foto_iv+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS ORDEN Y LIMPIEZA -  EXISTENTES*/
	$body.off('click','.delete-file-ol');
	$body.on('click','.delete-file-ol', function(){
		file_name = $(this).data('url');
		foto_ol = $(this).data('foto-ol');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_instalaciones/delete_foto_ol',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-ol='+foto_ol+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});

	/*SCRIPT PARA ELIMINAR FOTOS SERVICIOS HIGIENICOS -  EXISTENTES*/
	$body.off('click','.delete-file-sshh');
	$body.on('click','.delete-file-sshh', function(){
		file_name = $(this).data('url');
		foto_sshh = $(this).data('foto-sshh');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_instalaciones/delete_foto_sshh',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-sshh='+foto_sshh+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});

	/*SCRIPT PARA ELIMINAR FOTOS SEÑALES DE SEGURIDAD -  EXISTENTES*/
	$body.off('click','.delete-file-ss');
	$body.on('click','.delete-file-ss', function(){
		file_name = $(this).data('url');
		foto_ss = $(this).data('foto-ss');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_instalaciones/delete_foto_ss',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-ss='+foto_ss+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS EQUIPOS DE EMERGENCIAS -  EXISTENTES*/
	$body.off('click','.delete-file-ee');
	$body.on('click','.delete-file-ee', function(){
		file_name = $(this).data('url');
		foto_ee = $(this).data('foto-ee');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_instalaciones/delete_foto_ee',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-ee='+foto_ee+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	
	
	/*SCRIPT PARA ELIMINAR FOTOS CONDICIONES DE SEGURIDAD -  EXISTENTES*/
	$body.off('click','.delete-file-cseg');
	$body.on('click','.delete-file-cseg', function(){
		file_name = $(this).data('url');
		foto_cseg = $(this).data('foto-cseg');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_instalaciones/delete_foto_cseg',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-cseg='+foto_cseg+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS MEDIDAS DE SEGURIDAD -  EXISTENTES*/
	$body.off('click','.delete-file-med-instal');
	$body.on('click','.delete-file-med-instal', function(){
		file_name = $(this).data('url');
		foto_med = $(this).data('foto-med');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_instalaciones/delete_foto_med',
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

	/*SCRIPT PARA ELIMINAR  FOTOS ACTA DE INSPECCION DE SEGURIDAD -  EXISTENTES*/
	$body.off('click','.delete-file-act-ins-seg');
	$body.on('click','.delete-file-act-ins-seg', function(){
		file_name = $(this).data('url');
		foto_act_ins_seg = $(this).data('foto-act-ins-seg');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_instalaciones/delete_foto_act_ins_seg',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-act-ins-seg='+foto_act_ins_seg+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	
/***** ENVIAR EL INDEX DEL BOTON CREAR TRABAJADOR AL MODAL ******/
	/*function loassendIndexButtonToModalTrabajador(){
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
				  $('#txt-nro-sshhsshhento').val('');
				  $('.cboTipoTrabajadores').val('');
				  $('#txt-apellido-nombre').parent().removeClass('control-group has-error');
				  $('#myModalAddTrabajador').attr('index-button',index_current);
				  $('#myModalAddTrabajador').attr('data-type','t');
			  });
		});
	}
	loassendIndexButtonToModalTrabajador();*/

/***** ENVIAR EL INDEX DEL BOTON CREAR TRABAJADOR AL MODAL ******/
	/*function loassendIndexButtonToModalResponsable(){
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
	loassendIndexButtonToModalResponsable();

/******* ENVIAR INDEX DEL BOTON CREAR VEHICULO AL MODAL *******/
	/*function loassendIndexButtonToModalVehiculo(){
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
	loassendIndexButtonToModalVehiculo();*/



	function showHighchart (porc_in_categorias, porc_cu_categorias, porc_cu){
		console.log(porc_cu_categorias);
		//$(function () {
				//alert(categorias);
			    var colors = Highcharts.getOptions().colors,
			        categories = ['NI', 'NC'],
			        data = [{
			            y: porc_ni,
			            color: '#E03737',
			            drilldown: {
			                name: 'NI Items',
			                categories: ['IV', 'OL', 'SSHH', 'SS', 'EE', 'CSEG'],
			                data: [porc_ni, 0, 0, 0, 0, 0],
			                color: '#E03737'
			            }
			        }, {
			            y: porc_nc,
			            color: colors[0],
			            drilldown: {
			                name: 'NC Items',
			                categories: ['IV', 'OL', 'SSHH', 'SS', 'EE', 'CSEG'],
			                data: porc_cu_categorias,
			                color: colors[0]
			            }
			        }],
			        browserData = [],
			        versionsData = [],
			        i,
			        j,
			        dataLen = data.length,
			        drillDataLen,
			        brightness;


				var leyendtitle = ["ILUMINACIÓN Y VENTILACIÓN", "ORDEN Y LIMPIEZA", "SERVICIOS HIGIENICOS", "SEÑALES DE SEGURIDAD", "EQUIPOS DE EMERGENCIAS", "CONDICIONES DE SEGURIDAD"];
			    // Build the data arrays
			    for (i = 0; i < dataLen; i += 1) {

			        // add browser data
			        browserData.push({
			            name: categories[i],
						category_porc: categories[i]+': '+data[i].y +'%',
			            y: data[i].y,
			            color: data[i].color
			        });

			        // add version data
			        drillDataLen = data[i].drilldown.data.length;
			        for (j = 0; j < drillDataLen; j += 1) {
			            brightness = 0.2 - (j / drillDataLen) / 5;
			            versionsData.push({
			                name: data[i].drilldown.categories[j],
			                y: data[i].drilldown.data[j],
							leyendtitle: leyendtitle[j],
							category: categories[i],
							indice: j,
							valor: porc_cu[j],
			                color: Highcharts.Color(data[i].color).brighten(brightness).get()
			            });
			        }
			    }


			    // Create the chart
			    $('#container_graf_cu').highcharts({
			        chart: {
			            type: 'pie'
			        },
			        title: {
			            text: ''
			        },
			        credits: {
						enabled: false
					},
			        yAxis: {
			            title: {
			                text: 'Total percent market share'
			            }
			        },
			        plotOptions: {
			            pie: {
			                shadow: false,
			                center: ['50%', '50%'],
			                showInLegend: true
			            }
			        },
			        tooltip: {
			            valueSuffix: '%'
			        },
			        legend: {
						layout: 'vertical',
						backgroundColor: '#FFFFFF',
						floating: false,
						align: 'center',
						verticalAlign: 'bottom',
						labelFormatter: function () {
							if(this.category == 'NC'){
								if(this.indice == 5){
									return '<span style="font-size:5px"><strong>'+this.name + '</strong>: <span style="font-weight:100">'+this.leyendtitle+'</span></span><br><br><span style="font-size:5px"><strong>NI</strong>: <span style="font-weight:100">NIVEL INCUMPLIMIENTO</span></span><br><span style="font-size:5px"><strong>NC</strong>: <span style="font-weight:100">NIVEL CUMPLIMIENTO</span></span>';
								}else{
									return '<span style="font-size:5px"><strong>'+this.name + '</strong>: <span style="font-weight:100">'+this.leyendtitle+'</span></span>';
								}
							}
						}
					},
			        series: [{
			            name: 'Browsers',
			            data: browserData,
			            size: '60%',
			            dataLabels: {
			                formatter: function () {
			                    return this.y > 5 ? this.point.category_porc : null;
			                },
			                color: '#000000',
			                distance: -30
			            }
			        }, {
			            name: 'Versions',
			            data: versionsData,
			            size: '80%',
			            innerSize: '60%',
			            dataLabels: {
			                formatter: function () {
			                    // display only if larger than 1
								if(this.point.category=='NC'){
									return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.point.valor + '%' : null;
								}
			                }
			            }
			        }]
			    });
			//});

	}


function ssshhaAcsshhularNormas(){
		//select_cu_iv
			var n_cu_iv = 0;
			var n_in_iv = 0;
			$(".select_cu_iv").each(function(){
				val_estado_iv = $(this).val();
			
				if(val_estado_iv == 1){
					n_cu_iv++;
				}

				if(val_estado_iv == 0){
					n_in_iv++;
				}
			});


			var n_cu_ol = 0;
		 	var n_in_ol = 0;

		 	$('.select_cu_ol').each(function(){
		 		val_estado_ol = $(this).val();

		 		if(val_estado_ol == 1){
		 			n_cu_ol++;
		 		}

		 		if(val_estado_ol == 0){
		 			n_in_ol++;
		 		}
		  	})
		  
 	
		 	var n_cu_sshh = 0;
		 	var n_in_sshh = 0;

		 	$('.select_cu_sshh').each(function(){
		 		val_estado_sshh = $(this).val();

		 		if(val_estado_sshh == 1){
		 			n_cu_sshh++;
		 		}

		 		if(val_estado_sshh == 0){
		 			n_in_sshh++;
		 		}
		  	})
		  
		 	
		 	var n_cu_ss = 0;
		 	var n_in_ss = 0;

		 	$('.select_cu_ss').each(function(){
		 		val_estado_ss = $(this).val();

		 		if(val_estado_ss == 1){
		 			n_cu_ss++;
		 		}

		 		if(val_estado_ss == 0){
		 			n_in_ss++;
		 		}
		  	})
		  

		  var n_cu_ee = 0;
		  var n_in_ee = 0;
		  $('.select_cu_ee').each(function(){
		 		val_estado_ee = $(this).val();

		 		if(val_estado_ee == 1){
		 			n_cu_ee++;
		 		}

		 		if(val_estado_ee == 0){
		 			n_in_ee++;
		 		}
		   })

		  var n_cu_cseg = 0;
		  var n_in_cseg = 0;
		  $('.select_cu_cseg').each(function(){
		 		val_estado_cseg = $(this).val();

		 		if(val_estado_cseg == 1){
		 			n_cu_cseg++;
		 		}

		 		if(val_estado_cseg == 0){
		 			n_in_cseg++;
		 		}
		   })

		  	normas_csshhplidas = Math.round(n_cu_iv + n_cu_ol + n_cu_sshh + n_cu_ss + n_cu_ee + n_cu_cseg);
			normas_incsshhplidas = Math.round(n_in_iv + n_in_ol + n_in_sshh + n_in_ss + n_in_ee + n_in_cseg);
			ssshha_normas = normas_csshhplidas + normas_incsshhplidas;

			porc_nc = Math.round((normas_csshhplidas * 100) / ssshha_normas);
			porc_ni = Math.round((normas_incsshhplidas * 100) / ssshha_normas);

			porc_cu_iv = n_cu_iv > 0 ? Math.round((n_cu_iv*100)/ssshha_normas) : 0;
			porc_in_iv = n_in_iv > 0 ? Math.round((n_in_iv*100)/ssshha_normas) : 0;
			porc_iv = n_cu_iv >0 ? Math.round((n_cu_iv*100)/(n_cu_iv + n_in_iv)) : 0;
			porc_iv_vivo = porc_cu_iv > 0 ? 1 : 0;

			porc_cu_ol = n_cu_ol > 0 ? Math.round((n_cu_ol*100)/ssshha_normas) : 0;
			porc_in_ol = n_in_ol > 0 ? Math.round((n_in_ol*100)/ssshha_normas) : 0;
			porc_ol = n_cu_ol > 0 ? Math.round((n_cu_ol*100)/(n_cu_ol + n_in_ol)) : 0;
			porc_ol_vivo = porc_cu_ol > 0 ? 1 : 0;

			porc_cu_sshh = n_cu_sshh > 0 ? Math.round((n_cu_sshh*100)/ssshha_normas) : 0;
			porc_in_sshh = n_in_sshh > 0 ? Math.round((n_in_sshh*100)/ssshha_normas) : 0;
			porc_sshh = n_cu_sshh > 0 ? Math.round((n_cu_sshh*100)/(n_cu_sshh + n_in_sshh)) : 0;
			porc_sshh_vivo = porc_cu_sshh > 0 ? 1 : 0;

			porc_cu_ss = n_cu_ss > 0 ? Math.round((n_cu_ss*100)/ssshha_normas) : 0;
			porc_in_ss = n_in_ss > 0 ? Math.round((n_in_ss*100)/ssshha_normas) : 0;
			porc_ss = n_cu_ss > 0 ? Math.round((n_cu_ss*100)/(n_cu_ss + n_in_ss)) : 0;
			porc_ss_vivo = porc_cu_ss > 0 ? 1 : 0;

			porc_cu_ee = n_cu_ee > 0 ? Math.round((n_cu_ee*100)/ssshha_normas) : 0;
			porc_in_ee = n_in_ee > 0 ? Math.round((n_in_ee*100)/ssshha_normas) : 0;
			porc_ee = n_cu_ee > 0 ? Math.round((n_cu_ee*100)/(n_cu_ee + n_in_ee)) : 0;
			porc_ee_vivo = porc_cu_ee > 0 ? 1 : 0;

			porc_cu_cseg = n_cu_cseg > 0 ? Math.round((n_cu_cseg*100)/ssshha_normas) : 0;
			porc_in_cseg = n_in_cseg > 0 ? Math.round((n_in_cseg*100)/ssshha_normas) : 0;
			porc_cseg = n_cu_cseg > 0 ? Math.round((n_cu_cseg*100)/(n_cu_cseg + n_in_cseg)) : 0;
			porc_cseg_vivo = porc_cu_cseg > 0 ? 1 : 0;

			ssshha_porc = porc_cu_iv + porc_cu_ol + porc_cu_sshh + porc_cu_ss + porc_cu_ee + porc_cu_cseg;
			ssshha_vivo = porc_iv_vivo + porc_ol_vivo + porc_sshh_vivo + porc_ss_vivo + porc_ee_vivo + porc_cseg_vivo;
			
			count=0;
			divisor=0;
			if(porc_cu_iv == 0){
				count = count + 2;
				divisor++;
			}
			if(porc_cu_ol == 0){
				count = count + 2;
				divisor++;
			}
			if(porc_cu_sshh == 0){
				count = count + 2;
				divisor++;
			}
			if(porc_cu_ss == 0){
				count = count + 2;
				divisor++;
			}
			if(porc_cu_ee == 0){
				count = count + 2;
				divisor++;
			}
			if(porc_cu_cseg == 0){
				count = count + 2;
				divisor++;
			}

			porc_nc2 = porc_nc - count;
			divisor = 6 - divisor;

			porc_iv_vivo_test = (porc_cu_iv > 2 && porc_nc2/divisor > 2) ? (porc_nc2/divisor) : 2;
			porc_ol_vivo_test = (porc_cu_ol > 2 && porc_nc2/divisor > 2) ? (porc_nc2/divisor) : 2;
			porc_sshh_vivo_test = (porc_cu_sshh > 2 && porc_nc2/divisor > 2) ? (porc_nc2/divisor) : 2;
			porc_ss_vivo_test = (porc_cu_ss > 2 && porc_nc2/divisor > 2) ? (porc_nc2/divisor) : 2;
			porc_ee_vivo_test = (porc_cu_ee > 2 && porc_nc2/divisor > 2) ?(porc_nc2/divisor) : 2;
			porc_cseg_vivo_test = (porc_cu_cseg > 2 && porc_nc2/divisor > 2) ? (porc_nc2/divisor) : 2;
			
			var porc_cu_categorias = [porc_cu_iv, porc_cu_ol, porc_cu_sshh, porc_cu_ss, porc_cu_ee, porc_cu_cseg];
			var porc_cu_categoriastest = [porc_iv_vivo_test, porc_ol_vivo_test, porc_sshh_vivo_test, porc_ss_vivo_test, porc_ee_vivo_test, porc_cseg_vivo_test];
			var porc_in_categorias = [porc_in_iv, porc_in_ol, porc_in_sshh, porc_in_ss, porc_in_ee, porc_in_cseg];
			var porc_cu = [porc_iv, porc_ol, porc_sshh, porc_ss, porc_ee, porc_cseg];

			showHighchart(porc_in_categorias, porc_cu_categoriastest, porc_cu);

	}

	ssshhaAcsshhularNormas();


	/*SCRIPT PARA CREAR GRAFICO EN NUEVO INFORME*/
	function loadGraficoNuevaActa(){
		$('.select-NI-NC').change(function(){
		
			/*FUNCTION */
			ssshhaAcsshhularNormas();

		});
	}
	
	loadGraficoNuevaActa();
	


/*SCRIPTS PARA EL CREAR Y EDITAR INFORME  */
	
	
	/* CsshhPLIMIENTO E INCsshhPLIMIENTOS */
	/* AGREGAR FILAS A LA TABLA EQUIPOS DE EMERGENCIAS*/	
	$("#div-btn-add-ee-rep .add-more-row-ee-rep").bind("click", function(e){
	long_table = $('#table-ee-rep tbody tr').length + 1;
		$.ajax({
	        type: "POST",
	        url: env_webroot_script + "acta_instalaciones/add_row_eq_emerg",
	        data: { long_table: long_table },
	        cache: false,
	        success: function(html)
	         {
	       	 $('#table-ee-rep tr:last').after(html);
	       	 loadGraficoNuevaActa();
	         }
		 });
	});
	
	/* AGREGAR FILAS A LA TABLA CONDICIONES DE SEGURIDAD*/	
	$("#div-btn-add-cseg-rep .add-more-row-cseg-rep").bind("click", function(e){
	long_table = $('#table-cseg-rep tbody tr').length + 1;
		$.ajax({
	        type: "POST",
	        url: env_webroot_script + "acta_instalaciones/add_row_cond_seg",
	        data: { long_table: long_table },
	        cache: false,
	        success: function(html)
	         {
	       	 $('#table-cseg-rep tr:last').after(html);
	       	 loadGraficoNuevaActa();
	         }
		 });
	});
	
	$("#div-btn-add-iv-rep .add-more-row-iv-rep").bind("click", function(e){
		long_table = $('#table-iv-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "acta_instalaciones/add_row_ilum_vent",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-iv-rep tr:last').after(html);
		       	 loadGraficoNuevaActa();
		         }
			 });
		});
	
	$("#div-btn-add-ol-rep .add-more-row-ol-rep").bind("click", function(e){
		long_table = $('#table-ol-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "acta_instalaciones/add_row_orden_limp",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-ol-rep tr:last').after(html);
		       	 loadGraficoNuevaActa();
		         }
			 });
		});
	
	$("#div-btn-add-sshh-rep .add-more-row-sshh-rep").bind("click", function(e){
		long_table = $('#table-sshh-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "acta_instalaciones/add_row_eq_sshh",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-sshh-rep tr:last').after(html);
		       	 loadGraficoNuevaActa();
		         }
			 });
		});
	
	$("#div-btn-add-ss-rep .add-more-row-ss-rep").bind("click", function(e){
		long_table = $('#table-ss-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "acta_instalaciones/add_row_sen_seg",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-ss-rep tr:last').after(html);
		       	 loadGraficoNuevaActa();
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
		  allowClear: true,
		  width: '100%'
		});
	
	$(".cbo-uunn-select2").select2({
		  placeholder: "Seleccione UUNN",
		  allowClear: true
		});

	$(".cbo-reponsable-act-cargo").select2({
			  placeholder: "Seleccione cargo de resp. carg",
			  allowClear: true,
			  width: '100%'
	});

	$(".cbo-reponsable-sup-cargo").select2({
			  placeholder: "Seleccione cargo de resp. sup",
			  allowClear: true,
			  width: '100%'
	});

	$(".cbo-reponsable-act").select2({
			  placeholder: "Seleccione responsable de act.",
			  allowClear: true,
			  width: '100%'
	});

	$(".cbo-reponsable-sup").select2({
			  placeholder: "Seleccione responsable de sup",
			  allowClear: true,
			  width: '100%'
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
	
	function loadAConssub(){
		$(".cbo-tipo-cond-sub-select2").select2({
			  placeholder: "Condici\u00F3n Subestandar",
			  allowClear: true,
			  width: '100%'
		});
	}
	loadAConssub();
	
	
	
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
		$(".cbo-nincsshhplidas-select2").select2({
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

	function loadTagsEmpresa(){
		$(".cbo-rpte-empresas-select2").select2({
			placeholder: "Empresa",
			allowholder: true,
			width: '100%'
		})
	}
	loadTagsEmpresa();

	function loadTagsUunn(){
		$(".cbo-rpte-uunn-select2").select2({
			placeholder: "Unidad de Negocio",
			allowholder: true,
			width: '100%'
		})
	}
	loadTagsUunn();
	


	/*function loadEachTrabajador(){
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
	loadEachPlaca();*/
	
	function loadActividadByTrabajador(trabajador_id, index){
		element_actividad = '#Actividad'+index;
		//element_actividad_hidden = '#HiddenActividadid'+index; //aqui obtengo el nombre
        $.ajax({
          type: "POST",
          url: env_webroot_script + "acta_instalaciones/ajax_actividad_trabajador",
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
          url: env_webroot_script + "acta_instalaciones/ajax_vehiculo_placa",
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
          url: env_webroot_script + "acta_instalaciones/ajax_trabajador_dni",
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
				        
				        //datetext=datetext+" "+addZero(d.getHours())+":"+addZero(d.getMinutes())+":"+addZero(d.getSeconss());
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