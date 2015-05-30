<?php
class TrabajadoresController extends AppController{
	public $name = 'Trabajadore';
	
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_nro_documento=null,$search_nombre=null) {
		$this->layout = "default";
		$this->loadModel('Trabajadore');
		$this->loadModel('Actividade');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
		
		/*if($order_by=='title'){
			$order_by = 'Bit.title';
		}elseif($order_by=='username'){
			$order_by = 'UserJoin.username';
		}elseif($order_by=='home'){
			$order_by = 'Bit.view_home';
		}elseif($order_by=='status'){
			$order_by = 'Bit.status';
		}else{
			$order_by = 'Bit.created';
		}*/
		$order_by = 'Trabajadore.created';
		
		if($this->request->is('get')){
			if($search_nro_documento!=''){
				$search_nro_documento = $search_nro_documento;
			}else{
				$search_nro_documento = '';
			}
			
			if($search_nombre!=''){
				$search_nombre = $search_nombre;
			}else{
				$search_nombre = '';
			}

		}else{
			$search_nombre = '';
			$search_nro_documento = '';
		}
		
		$list_trabajador_all = $this->Trabajadore->listAllTrabajadores($order_by, utf8_encode($search_nro_documento),utf8_encode($search_nombre),$order_by_or);
		$list_trabajador = $this->Trabajadore->listFindTrabajadores($order_by, utf8_encode($search_nro_documento),utf8_encode($search_nombre),$order_by_or, $start, $per_page);
		$obj_tipo_actividades = $this->Actividade->listActividades();
		$count = count($list_trabajador_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_trabajador','obj_tipo_actividades','page','no_of_paginations'));
	}
	
	public function find_trabajadores($page=null,$order_by=null,$order_by_or=null,$search_nro_documento=null,$search_nombre=null) {
		$this->layout = 'ajax';
		$this->loadModel('Trabajadore');
		$this->loadModel('Actividade');
		$page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'Trabajadore.created';
	
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
	
		/*if($order_by=='title'){
			$order_by = 'Bit.title';
		}elseif($order_by=='username'){
			$order_by = 'UserJoin.username';
		}elseif($order_by=='home'){
			$order_by = 'Bit.view_home';
		}elseif($order_by=='status'){
			$order_by = 'Bit.status';
		}else{
			$order_by = 'Bit.created';
		}*/
	
		if($this->request->is('get')){
		/*if($search_tipo_persona!=''){
				$search_tipo_persona = $search_tipo_persona;
			}else{
				$search_tipo_persona = '';
			}*/
			
			/*if($search_nro_documento!=''){
				$search_nro_documento = $search_nro_documento;
			}else{
				$search_nro_documento = '';
			}
			
			if($search_nombre!=''){
				$search_nombre = $search_nombre;
			}else{
				$search_nombre = '';
			}*/
			
			if($search_nro_documento == 'null'){
				$search_nro_documento = '';
			}else{
				$search_nro_documento = $search_nro_documento;
			}
				
			if($search_nombre == 'null'){
				$search_nombre = '';
			}else{
				$search_nombre = $search_nombre;
			}
	
		}else{
			$search_nombre = '';
			$search_nro_documento = '';
		}

		$list_trabajador_all = $this->Trabajadore->listAllTrabajadores($order_by, utf8_encode($search_nro_documento),utf8_encode($search_nombre),$order_by_or);
		$list_trabajador = $this->Trabajadore->listFindTrabajadores($order_by, utf8_encode($search_nro_documento),utf8_encode($search_nombre),$order_by_or, $start, $per_page);
		$count = count($list_trabajador_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_trabajador','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function add_edit_trabajador($trabajador_id=null){
		$this->layout = 'default';
		$this->loadModel('Actividade');
		$this->loadModel('Empresa');
		$this->loadModel('Departamento');
		$this->loadModel('EstadoCivile');
		$list_all_departamentos = $this->Departamento->listAllDepartamentos();
		$list_all_actividades = $this->Actividade->listActividades();
		$list_all_empresas = $this->Empresa->listEmpresas();
		$list_all_estados_civiles = $this->EstadoCivile->listEstadoCiviles();
		
		$this->set(compact('list_all_actividades','list_all_empresas','list_all_departamentos','list_all_estados_civiles'));
		
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($trabajador_id) && intval($trabajador_id) > 0){
				
				//update
				$error_validation = '';
				//$this->formatFecha($this->request->data['Trabajadore']['fec_nac']);
				if(isset($this->request->data['Trabajadore']['poliza_vigente'])){
					if($this->request->data['Trabajadore']['poliza_vigente'] == null){
						$this->request->data['Trabajadore']['poliza_vigente'] = 0;
					}else{
						$this->request->data['Trabajadore']['poliza_vigente'] = 1;
					}
				}
				
				if(isset($this->request->data['Trabajadore']['nro_documento'])){
					$nro_documento = $this->request->data['Trabajadore']['nro_documento'];
				
					if($nro_documento == '' || $nro_documento == NULL){
						$nro_documento = '';
					}else{
						$cant_digitos =  strlen($nro_documento);
						if($cant_digitos != Configure::read('NUM_DIGITOS_DNI')){
							$arr_validation['nro_documento'] = array(__('El DNI debe ser de '.Configure::read('NUM_DIGITOS_DNI').' d&iacute;gitos'));
							$error_validation = true;
						}
					}
				}
				
				if($error_validation == true){
					echo json_encode(array('success' =>false, 'msg' => __('No se pudo guardar'), 'validation' => $arr_validation));
					exit();
				}
				
				$this->Trabajadore->id = $trabajador_id;
	
				if($this->request->data['Trabajadore']['firma']['name'] != ''){
					$this->request->data['Trabajadore']['firma'] = $this->request->data['Trabajadore']['firma']['name'];
						
					//$image_tmp = $this->request->data['Trabajadore']['firma']['tmp_name'];
					$uploaddir = APP.WEBROOT_DIR.'/files/firmas/';
					$uploadfile = $uploaddir . basename($_FILES['data']['name']['Trabajadore']['firma']);
				
					move_uploaded_file($_FILES['data']['tmp_name']['Trabajadore']['firma'], $uploadfile);
				
				}
				
	
				if ($this->Trabajadore->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'Trabajador_id'=>$trabajador_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Trabajadore->validationErrors));
					exit();
				}
			}else{
				//insert
				$error_validation = '';
				//debug($this->request);
				//debug($_FILES);
				
				//exit();
				//$this->formatFecha($this->request->data['Trabajadore']['fec_nac']);
				if(isset($this->request->data['Trabajadore']['poliza_vigente'])){
					if($this->request->data['Trabajadore']['poliza_vigente'] == null){
						$this->request->data['Trabajadore']['poliza_vigente'] = 0;
					}else{
						$this->request->data['Trabajadore']['poliza_vigente'] = 1;
					}
				}
				
				if(isset($this->request->data['Trabajadore']['nro_documento'])){
					$nro_documento = $this->request->data['Trabajadore']['nro_documento'];

					if($nro_documento == '' || $nro_documento == NULL){
						$nro_documento = '';
					}else{
						$cant_digitos =  strlen($nro_documento);
						if($cant_digitos != Configure::read('NUM_DIGITOS_DNI')){
							$arr_validation['nro_documento'] = array(__('El DNI debe ser de '.Configure::read('NUM_DIGITOS_DNI').' d&iacute;gitos'));
							$error_validation = true;
						}
					}
				}
				
				if($this->request->data['Trabajadore']['dpto'] == 0){
							$arr_validation['dpto'] = array(__('Debe ingresar un lugar de nacimiento como referencia'));
							$error_validation = true;
				}
				
				
				if($error_validation == true){
					echo json_encode(array('success' =>false, 'msg' => __('No se pudo guardar'), 'validation' => $arr_validation));
					exit();
				}
				
				if($this->request->data['Trabajadore']['firma']['name'] != ''){
					$this->request->data['Trabajadore']['firma'] = $this->request->data['Trabajadore']['firma']['name'];
					
					//$image_tmp = $this->request->data['Trabajadore']['firma']['tmp_name'];
					$uploaddir = APP.WEBROOT_DIR.'/files/firmas/';
					$uploadfile = $uploaddir . basename($_FILES['data']['name']['Trabajadore']['firma']);
				
					move_uploaded_file($_FILES['data']['tmp_name']['Trabajadore']['firma'], $uploadfile);
				
				}
				
				
				$this->Trabajadore->create();
				if ($this->Trabajadore->save($this->request->data)) {
					$trabajador_id = $this->Trabajadore->id;
					echo json_encode(array('success'=>true,'msg'=>__('El trbajador fue agregado con &eacute;xito.'),'Trabajador_id'=>$trabajador_id));
					//$this->redirect(array('controller' => 'trabajadores', 'accion' =>'index'));
					exit();
				}else{
					$trabajador_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Trabajadore->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($trabajador_id)){
				$obj_trabajador = $this->Trabajadore->findById($trabajador_id);
				$get_ids = $this->Trabajadore->showDistritoByUser($obj_trabajador->getAttr('distrito_id'));
				
				$this->loadModel('Provincia');
				$list_all_provincias = $this->Provincia->listAllProvincias();
				$this->loadModel('Distrito');
				$list_all_distritos = $this->Distrito->listAllDistritos();
				
				$this->request->data = $obj_trabajador->data;
				$this->set(compact('trabajador_id','obj_trabajador','get_ids','list_all_provincias','list_all_distritos'));
			}
		}
	}
	
	public function delete_trabajador(){
		$this->layout = 'ajax';
	
		$this->loadModel('Trabajadore');
	
		if($this->request->is('post')){
			$trabajador_id = $this->request->data['trabajador_id'];
			$obj_trabajador = $this->Trabajadore->findById($trabajador_id);
			if($obj_trabajador->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->Trabajadore->deleteTrabajador($trabajador_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();*/
		}
	
	
	}
	
	public function get_trabajador_row($trabajador_id){
		$this->layout = 'ajax';
	
		$this->loadModel('Trabajadore');
		$obj_trabajador = $this->Trabajadore->findById($trabajador_id);
		$this->set(compact('trabajador_id','obj_trabajador'));
	}
	
	public function ajax_list_provincias(){
		$this->layout = 'ajax';
		$this->loadModel('Provincia');
		
		if($this->request->is('post')){
			$departamento_id = $this->request->data['departamento_id'];
			//$departamento_name = $this->request->data['departamento_nombre'];
		
			$array_provincia = $this->Provincia->listProvinciasByDepartamentoId($departamento_id);
		}
		
		$this->set(compact('array_provincia'));
	}
	
	public function ajax_list_distritos(){
		$this->layout = 'ajax';
		$this->loadModel('Distrito');
	
		if($this->request->is('post')){
			$provincia_id = $this->request->data['provincia_id'];
			//$region_name = $this->request->data['region_nombre'];
	
			$array_distritos = $this->Distrito->listDistritosByProvinciaId($provincia_id);
		}
		$this->set(compact('array_distritos'));
	}
	
	function formatFecha($fecha){
		if(isset($fecha)){
			$fec_nac = $fecha;//12-12-1990

			if($fec_nac == '' || $fec_nac == NULL){
				$fec_nac = '';
			}else{
				$dd = substr($fec_nac, 0, 2);
				$mm = substr($fec_nac, 3, 2);
				$yy = substr($fec_nac, -4);
				$fec_nac = $yy.'-'.$mm.'-'.$dd;//1990-12-12
			}
			$this->request->data['Persona']['fec_nac'] = $fec_nac;
		}
		
		return $this->request->data['Persona']['fec_nac'];
	}
	
	
	public function add_trabajador(){
		$this->layout = 'ajax';
		$this->loadModel('Trabajadore');
		if($this->request->is('post') || $this->request->is('put')){
			$this->request->data['Trabajadore']['distrito_id'] = '140101';
			$this->Trabajadore->create();
			if ($this->Trabajadore->save($this->request->data)) {
				$trabajador_id = $this->Trabajadore->id;
				$obj_trabajador = $this->Trabajadore->findById($trabajador_id);
				$actividad_id = $obj_trabajador->getAttr('actividade_id');
				echo json_encode(array('success'=>true,'msg'=>__('El trabajador fue agregado con &eacute;xito.'),'Trabajador_id'=>$trabajador_id, 'Actividad_id'=>$actividad_id));
				exit();
			}else{
				$trabajador_id = '';
				echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Trabajadore->validationErrors));
				exit();
			}
		}
	}
	
}