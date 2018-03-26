$(document).ready(function(){
	
	User = this;
	$body = $('body');
	
	user = {
		openAddEditUser: function(user_id){
			if(user_id == undefined || !user_id) {
				user_id ='';
			}
			
			$('div#user #add_edit_user_container').unbind();
			$('div#user #add_edit_user_container').load(env_webroot_script+'users/add_edit_user/'+user_id,function(){
				if(user_id !== '' || user_id== null){
					$('#div-cbo-trabajadores').hide();
					$('#UserPassword').remove();
					$('#txtPasswordFalse').show();
				}else{
					$('.link_cambiar_clave').hide();
					$('#txtPasswordFalse').hide();
				}
			});
		},
		
		deleteUser: function(user_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script+'users/delete_user',
				data:{
					'user_id': user_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.user_row_container[user_id='+user_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		changePassword: function(user_id, current_pass, new_pass, confirm_pass){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'users/change_password',
				data:{
					'user_id': user_id,
					'current_pass': current_pass,
					'new_pass' : new_pass,
					'confirm_pass' : confirm_pass
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					alertify.success(data.msg);
					$('#myModalChangePass').modal('hide');
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[UserChangePass]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[UserChangePass]['+key+']"]').change(function() {
							$('[name="data[UserChangePass]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});	
		}
	}
	
	/* CARGAR UUNN POR CONSORCIO */

	$body.on('change','.cboConsorcio', function(){
		var id=$(this).val(); 
        var consorcio = $(this).find('option:selected').html();  
        $.ajax({
          type: "POST",
          url: env_webroot_script + "users/ajax_list_uunn",
          data: { consorcio_id: id , consorcio_nombre : consorcio },
          cache: false,
          success: function(html)
           {
             $(".cboUunn").html(html);
             $(".cboUunn").removeAttr('disabled');
           }
        })
	});

	
	/* Mostrar formulario: Crear user */
	$body.off('click','div#user .btn-nuevo-user');
	$body.on('click', 'div#user .btn-nuevo-user' , function(){
		user_id = $(this).attr('user_id');
		user.openAddEditUser(user_id);
	});
	
	/* Ocultar formulario Crear user*/
	$body.on('click','div#div-crear-user .btn-cancelar-crear-user', function(){
		$('#add_edit_user').hide();
	});
	
	$body.off('click','.btn_crear_user_trigger');
	$body.on('click','.btn_crear_user_trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		//alert($form);return false;
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#add_edit_user').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('users/find_users/1/'+null+'/'+null+'/'+''),function(){
				});
				alertify.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[User]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[User]['+key+']"]').change(function() {
						$('[name="data[User]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#user .edit-user-trigger');
	$body.on('click','div#user .edit-user-trigger', function(){
		user_id = $(this).parents('.user_row_container').attr('user_id');
		user.openAddEditUser(user_id);
	});
	
	$body.off('click','div#user .open-model-delete-user');
	$body.on('click','div#user .open-model-delete-user', function(){
		user_id = $(this).parents('.user_row_container').attr('user_id');
		$('div#myModalDeleteUser').attr('user_id', user_id);
	});
	
	$body.off('click','div#myModalDeleteUser .eliminar-user-trigger');
	$body.on('click','div#myModalDeleteUser .eliminar-user-trigger', function(){
		user_id = $('div#myModalDeleteUser').attr('user_id');
		user.deleteUser(user_id);
	});
	
	
	/* Change Password */
	$body.off('click','div#div-crear-user .link_cambiar_clave');
	$body.on('click','div#div-crear-user .link_cambiar_clave', function(){
		user_id = $('#myModalChangePass').attr('user_id');
		$('div#myModalDeleteUser').attr('user_id', user_id);
	});
	
	$body.off('click','div#myModalChangePass .change-pass-user-trigger');
	$body.on('click','div#myModalChangePass .change-pass-user-trigger', function(){
		user_id = $('div#myModalChangePass').attr('user_id');
		current_pass = $('#current-password').val();
		new_pass = $('#new-password').val();
		confirm_pass = $('#confirm-password').val();
		user.changePassword(user_id, current_pass, new_pass, confirm_pass);
	});


	
	
});