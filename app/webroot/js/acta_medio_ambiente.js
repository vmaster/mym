$(document).ready(function(){
	
	Acta = this;
	$body = $('body');
	
	acta = {

		deleteActaInstalacion: function(acta_med_amb_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'acta_medio_ambientes/delete_acta',
				data:{
					'acta_med_amb_id': acta_med_amb_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.acta_med_amb_row_container[acta_med_amb_id='+acta_med_amb_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		changeEstadoRevisado: function(acta_med_amb_id, value_check){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'acta_medio_ambientes/activar_revisado',
				data:{
					'acta_med_amb_id': acta_med_amb_id,
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
			$form = $('#add_edit_acta_med_amb'). eq(0);
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
	$body.off('click','div#acta_med_amb .btn-nuevo-acta-med-amb');
	$body.on('click', 'div#acta_med_amb .btn-nuevo-acta-med-amb' , function(){
		acta_med_amb_id = $(this).attr('acta_med_amb_id');
		acta.openAddActa(acta_med_amb_id);
	});
	
	/* Ocultar formulario Crear Acta*/
	$body.on('click','div#div-crear-acta-med-amb .btn-cancelar-crear-acta-med-amb', function(){
		window.open(env_webroot_script + 'acta_medio_ambientes/','_self');
	});
	
	$body.on('click','div#div-editar-acta-med-amb .btn-cancelar-crear-acta-med-amb', function(){
		window.open(env_webroot_script + 'acta_medio_ambientes/','_self');
	});

	$body.off('click','.btn_crear_acta_med_amb_trigger');
	$body.on('click','.btn_crear_acta_med_amb_trigger',function(){
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
				$('.btn_crear_acta_med_amb_trigger').prop('disabled',true)
				alertify.success(data.msg);
				setTimeout(function(){
					window.open(env_webroot_script + 'acta_medio_ambientes/','_self');
				},1000)
				
			}else{
				myProccess.hidePleaseWait();

				$('.btn_crear_acta_med_amb_trigger').prop('disabled',false)
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

	$body.off('click','div#acta_med_amb .edit-acta-trigger');
	$body.on('click','div#acta_med_amb .edit-acta-trigger', function(){
		acta_med_amb_id = $(this).parents('.acta_med_amb_row_container').attr('acta_med_amb_id');
		//acta.openEditActa(acta_med_amb_id);
		
		/*if($form.attr('acta_med_amb_id') == undefined || !$form.attr('acta_med_amb_id')) {
			codigo_id ='';
		}else{*/
			//alert($('txtConclusiones').val());
			$('#father-container .nicEdit-main:first').html($('txtConclusiones').val());
		//}
	});
	
	$body.off('click','div#acta_med_amb .open-model-delete-acta-med-amb');
	$body.on('click','div#acta_med_amb .open-model-delete-acta-med-amb', function(){
		acta_med_amb_id = $(this).parents('.acta_med_amb_row_container').attr('acta_med_amb_id');
		$('div#myModalDeleteActaMedioAmbiente').attr('acta_med_amb_id', acta_med_amb_id);
	});
	
	$body.off('click','div#myModalDeleteActaMedioAmbiente .eliminar-acta-trigger');
	$body.on('click','div#myModalDeleteActaMedioAmbiente .eliminar-acta-trigger', function(){
		acta_med_amb_id = $('div#myModalDeleteActaMedioAmbiente').attr('acta_med_amb_id');
		acta.deleteActaInstalacion(acta_med_amb_id);
	});
	
	$( "#rbMym" ).click(function() {
		  $('#txtEmpSup').attr('value','MyM');
		  $('#txtEmpSup').css('display','none');
	});
	
	$body.off('click','div#acta_med_amb #chRevisado');
	$body.on('click','div#acta_med_amb #chRevisado', function(){
		if($(this).prop('checked') == true){
			$(this).val(1);
			$(this).parents('.acta_med_amb_row_container').attr('style','');
        } else {  
        	$(this).val(0);
        	$(this).parents('.acta_med_amb_row_container').attr('style','background-color:#BADEFB');
        }
		acta_med_amb_id = $(this).parents('.acta_med_amb_row_container').attr('acta_med_amb_id');
		value_check = $(this).val();
		acta.changeEstadoRevisado(acta_med_amb_id, value_check);
	});
	
	/*Send Report by Email*/
	$body.off('click','div#acta_med_amb .open-model-send-informe');
	$body.on('click','div#acta_med_amb .open-model-send-informe', function(){
		document.getElementById("form_send_email").reset();
		acta_med_amb_id = $(this).parents('.acta_med_amb_row_container').attr('acta_med_amb_id');
		$('div#myModalSendReport').attr('acta_med_amb_id', acta_med_amb_id);
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
			url: env_webroot_script + 'acta_medio_ambientes/send_reporte_email',
			data: $form.serialize() + '&acta_med_amb_id=' + acta_med_amb_id,
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
	
	/*SCRIPT PARA ELIMINAR FOTOS DOCUMENTACIÓN MEDIO AMBIENTAL -  EXISTENTES*/
	$body.off('click','.delete-file-dm');
	$body.on('click','.delete-file-dm', function(){
		file_name = $(this).data('url');
		foto_dm = $(this).data('foto-dm');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_medio_ambientes/delete_foto_dm',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-dm='+foto_dm+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	
	/*SCRIPT PARA ELIMINAR FOTOS CONDICIONES AMBIENTALES -  EXISTENTES*/
	$body.off('click','.delete-file-ca');
	$body.on('click','.delete-file-ca', function(){
		file_name = $(this).data('url');
		foto_ca = $(this).data('foto-ca');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_medio_ambientes/delete_foto_ca',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-ca='+foto_ca+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});

	/*SCRIPT PARA ELIMINAR FOTOS MEDIDAS DE CONTROL -  EXISTENTES*/
	$body.off('click','.delete-file-medida');
	$body.on('click','.delete-file-medida', function(){
		file_name = $(this).data('url');
		foto_med = $(this).data('foto-med');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_medio_ambientes/delete_foto_med',
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

	/*SCRIPT PARA ELIMINAR  FOTOS ACTA 	DE INSPECCIÓN DEL MEDIO AMBIENTE -  EXISTENTES*/
	$body.off('click','.delete-file-acta');
	$body.on('click','.delete-file-acta', function(){
		file_name = $(this).data('url');
		foto_acta = $(this).data('foto-acta');
		$.ajax({
			type: 'post',
			url: env_webroot_script + 'acta_medio_ambientes/delete_foto_acta',
			data:{
				'file_name': file_name
			},
			dataType: 'json'
		}).done(function(data){
			if(data.success == true){
				$('.template-download[foto-acta='+foto_acta+']').fadeOut(function(){$(this).remove()});
			}else{
				alertify.error(data.msg);
			}
		});
	});
	

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
			                categories: ['DMA', 'CA'],
			                data: [porc_ni, 0, 0, 0, 0, 0],
			                color: '#E03737'
			            }
			        }, {
			            y: porc_nc,
			            color: colors[0],
			            drilldown: {
			                name: 'NC Items',
			                categories: ['DMA', 'CA'],
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


				var leyendtitle = ["DOCUMENTACIÓN MEDIO AMBIENTAL", "CONDICIONES AMBIENTALES"];
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


function sumAcsshhularNormas(){
		//select_cu_dm
			var n_cu_dm = 0;
			var n_in_dm = 0;
			$(".select_cu_dm").each(function(){
				val_estado_dm = $(this).val();
			
				if(val_estado_dm == 1){
					n_cu_dm++;
				}

				if(val_estado_dm == 0){
					n_in_dm++;
				}
			});


			var n_cu_ca = 0;
		 	var n_in_ca = 0;

		 	$('.select_cu_ca').each(function(){
		 		val_estado_ca = $(this).val();

		 		if(val_estado_ca == 1){
		 			n_cu_ca++;
		 		}

		 		if(val_estado_ca == 0){
		 			n_in_ca++;
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

		  	normas_cumplidas = Math.round(n_cu_dm + n_cu_ca + n_cu_sshh + n_cu_ss + n_cu_ee + n_cu_cseg);
			normas_incumplidas = Math.round(n_in_dm + n_in_ca + n_in_sshh + n_in_ss + n_in_ee + n_in_cseg);
			sum_normas = normas_cumplidas + normas_incumplidas;

			porc_nc = Math.round((normas_cumplidas * 100) / sum_normas);
			porc_ni = Math.round((normas_incumplidas * 100) / sum_normas);

			porc_cu_dm = n_cu_dm > 0 ? Math.round((n_cu_dm*100)/sum_normas) : 0;
			porc_in_dm = n_in_dm > 0 ? Math.round((n_in_dm*100)/sum_normas) : 0;
			porc_dm = n_cu_dm >0 ? Math.round((n_cu_dm*100)/(n_cu_dm + n_in_dm)) : 0;
			porc_dm_vivo = porc_cu_dm > 0 ? 1 : 0;

			porc_cu_ca = n_cu_ca > 0 ? Math.round((n_cu_ca*100)/sum_normas) : 0;
			porc_in_ca = n_in_ca > 0 ? Math.round((n_in_ca*100)/sum_normas) : 0;
			porc_ca = n_cu_ca > 0 ? Math.round((n_cu_ca*100)/(n_cu_ca + n_in_ca)) : 0;
			porc_ca_vivo = porc_cu_ca > 0 ? 1 : 0;


			sum_porc = porc_cu_dm + porc_cu_ca;
			sum_vivo = porc_dm_vivo + porc_ca_vivo;
			
			count=0;
			divisor=0;
			if(porc_cu_dm == 0){
				count = count + 2;
				divisor++;
			}
			if(porc_cu_ca == 0){
				count = count + 2;
				divisor++;
			}


			porc_nc2 = porc_nc - count;
			divisor = 2 - divisor;

			porc_dm_vivo_test = (porc_cu_dm > 2 && porc_nc2/divisor > 2) ? (porc_nc2/divisor) : 2;
			porc_ca_vivo_test = (porc_cu_ca > 2 && porc_nc2/divisor > 2) ? (porc_nc2/divisor) : 2;

			
			var porc_cu_categorias = [porc_cu_dm, porc_cu_ca];
			var porc_cu_categoriastest = [porc_dm_vivo_test, porc_ca_vivo_test];
			var porc_in_categorias = [porc_in_dm, porc_in_ca];
			var porc_cu = [porc_dm, porc_ca];

			showHighchart(porc_in_categorias, porc_cu_categoriastest, porc_cu);

	}

	sumAcsshhularNormas();


	/*SCRIPT PARA CREAR GRAFICO EN NUEVO INFORME*/
	function loadGraficoNuevaActa(){
		$('.select-NI-NC').change(function(){
		
			/*FUNCTION */
			sumAcsshhularNormas();

		});
	}
	
	loadGraficoNuevaActa();
	


/*SCRIPTS PARA EL CREAR Y EDITAR INFORME  */
	
	
	/* cumplimiento E incumplimiento */
	/* AGREGAR FILAS A LAS TABLAS*/	

	
	$("#div-btn-add-dm-rep .add-more-row-dm-rep").bind("click", function(e){
		long_table = $('#table-dm-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "acta_medio_ambientes/add_row_doc_med",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-dm-rep tr:last').after(html);
		       	 loadGraficoNuevaActa();
		         }
			 });
		});
	
	$("#div-btn-add-ca-rep .add-more-row-ca-rep").bind("click", function(e){
		long_table = $('#table-ca-rep tbody tr').length + 1;
			$.ajax({
		        type: "POST",
		        url: env_webroot_script + "acta_medio_ambientes/add_row_cond_amb",
		        data: { long_table: long_table },
		        cache: false,
		        success: function(html)
		         {
		       	 $('#table-ca-rep tr:last').after(html);
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
		$(".cbo-nincumplidas-select2").select2({
			placeholder: "NI",
			allowClear: true,
			width: '100%'
		});
	}
	loadANIncumplicas();

	
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
	

	function loadActividadByTrabajador(trabajador_id, index){
		element_actividad = '#Actividad'+index;
		//element_actividad_hidden = '#HiddenActividadid'+index; //aqui obtengo el nombre
        $.ajax({
          type: "POST",
          url: env_webroot_script + "acta_medio_ambientes/ajax_actividad_trabajador",
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
          url: env_webroot_script + "acta_medio_ambientes/ajax_vehiculo_placa",
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
          url: env_webroot_script + "acta_medio_ambientes/ajax_trabajador_dni",
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