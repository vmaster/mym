<script>
$body = $('body');
var order_by_select;
var order_by_or;

$body.on('keyup','#txtBuscarDescripcion',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_descripcion = $(this).val();


	if(search_descripcion==''){
		search_descripcion = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('trabajadores/find_trabajadores/'+null+'/'+null+'/'+search_descripcion),function(){
	});
});

function loadData(page){
    //loading_show();  
    search_descripcion = $('#txtBuscarDescripcion').val();
	
	if (typeof(order_by_select) === "undefined"){
		order_by_select = null;
	}else{
		order_by_select = order_by_select;
	}
	if (typeof(order_by_or) === "undefined"){
		order_by_or = null;
	}else{
		order_by_or = order_by_or;
	}

	if(search_descripcion==''){
		search_descripcion = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('trabajadores/find_trabajadores/'+order_by_select+'/'+order_by_or+'/'+search_descripcion),function(){
		});
}
loadData(1);  /* For first time page load default results */
$('#container_page .pagination li.active').live('click',function(){
    var page = $(this).attr('p');
    loadData(page);
    
}); 

</script>
<div class="row">
	<div class="col-md-12">
		<h2>Listado de Personal ENOSA</h2>
	</div>
</div>
<hr />
<div id="trabajador">
	<div id="add_edit_trabajador_container">
	</div>
	
	<p>
	<div class="row">
		<div class="col-md-2 col-sm-6 col-xs-6" style="margin-top: 16px;"><label><?php echo __('Buscar por');?>:</label></div>
	</div>
	<div class="well">
		<div id = "conteiner_all_rows">
	    <?php 
		if(empty($list_trabajador)){ 
			echo __('No hay datos de cargos');
		}else{ ?>  
	      
	      <?php 
	      	echo $this->element('Trabajadore/trabajador_actividad_row');
	 	  ?>
	    <?php }?>
	    </div>
	</div>	
	
</div>
<script>
$(document).ready(function(){
	$('.tooltip-mym').tooltip();
});
</script>