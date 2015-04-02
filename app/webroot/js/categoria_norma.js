$(document).ready(function(){
	
	CategoriaNorma = this;
	$body = $('body');
	
	categorianorma = {
		openAddEditCategoriaNorma: function(categoria_norma_id){
			if(categoria_norma_id == undefined || !categoria_norma_id) {
				categoria_norma_id ='';
			}
			
			$('div#categoria_norma #add_edit_categoria_norma_container').unbind();
			$('div#categoria_norma #add_edit_categoria_norma_container').load(env_webroot_script + 'categoria_normas/add_edit_categoria_norma/'+categoria_norma_id,function(){
				
				/*Global.setPlaces('EducationPlace','education');
				$(".icon-search-education-place").click(function (e) {
					$('#EducationPlaceEdit').val('');
					$('#EducationPlaceId').val('');				
					$('.row-education-place').toggle();
					$('#EducationPlaceEdit').focus();
				});
				
				var targetOffset =$('#add_edit_persona_container').offset().top-130; 
				$('html,body').animate({scrollTop: targetOffset}, 700);*/
			});
		},
		
		deleteCategoriaNorma: function(categoria_norma_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'categoria_normas/delete_categoria_norma',
				data:{
					'categoria_norma_id': categoria_norma_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.categoria_norma_row_container[categoria_norma_id='+categoria_norma_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear vehículo */
	$body.off('click','div#categoria_norma .btn-nuevo-categoria_norma');
	$body.on('click', 'div#categoria_norma .btn-nuevo-categoria-norma' , function(){
		categoria_norma_id = $(this).attr('categoria_norma_id');
		categorianorma.openAddEditCategoriaNorma(categoria_norma_id);
	});
	
	/* Ocultar formulario Crear vehículo*/
	$body.on('click','div#div-crear-categoria-norma .btn-cancelar-crear-categoria-norma', function(){
		$('#add_edit_categoria_norma').hide();
	});
	
	$body.off('click','.btn-crear-categoria-norma-trigger');
	$body.on('click','.btn-crear-categoria-norma-trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#add_edit_categoria_norma').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('categoria_normas/find_categoria_normas/1/'+null+'/'+null+'/'+''+'/'+''),function(){
				});
				alertify.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[CategoriaNorma]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[CategoriaNorma]['+key+']"]').change(function() {
						$('[name="data[CategoriaNorma]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#categoria_norma .edit-categoria-norma-trigger');
	$body.on('click','div#categoria_norma .edit-categoria-norma-trigger', function(){
		categoria_norma_id = $(this).parents('.categoria_norma_row_container').attr('categoria_norma_id');
		categorianorma.openAddEditCategoriaNorma(categoria_norma_id);
	});
	
	$body.off('click','div#categoria_norma .open-model-delete-categoria-norma');
	$body.on('click','div#categoria_norma .open-model-delete-categoria-norma', function(){
		categoria_norma_id = $(this).parents('.categoria_norma_row_container').attr('categoria_norma_id');
		$('div#myModalDeleteCategoriaNorma').attr('categoria_norma_id', categoria_norma_id);
	});
	
	$body.off('click','div#myModalDeleteCategoriaNorma .eliminar-categoria-norma-trigger');
	$body.on('click','div#myModalDeleteCategoriaNorma .eliminar-categoria-norma-trigger', function(){
		categoria_norma_id = $('div#myModalDeleteCategoriaNorma').attr('categoria_norma_id');
		categorianorma.deleteCategoriaNorma(categoria_norma_id);
	});
	
});