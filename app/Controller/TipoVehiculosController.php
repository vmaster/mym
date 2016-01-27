<?php
class TipoVehiculosController extends AppController{
	public $name = 'TipoVehiculo';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_descripcion=null) {
		$this->verificarAccessoInvitado(); //AppController
        
		$this->layout = "default";
		$this->loadModel('TipoVehiculo');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
	
	$order_by = 'TipoVehiculo.created';
		
		if($this->request->is('get')){
			if($search_descripcion!=''){
				$search_descripcion = $search_descripcion;
			}else{
				$search_descripcion = '';
			}

		}else{
			$search_descripcion = '';
		}
		
		$list_tipo_vehiculo_all = $this->TipoVehiculo->listAllTipoVehiculos($order_by, utf8_encode($search_descripcion),$order_by_or);
		$list_tipo_vehiculo = $this->TipoVehiculo->listFindTipoVehiculos($order_by, utf8_encode($search_descripcion),$order_by_or, $start, $per_page);
		$count = count($list_tipo_vehiculo_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_tipo_vehiculo','page','no_of_paginations'));
	}
	
	public function find_tipo_vehiculos($page=null,$order_by=null,$order_by_or=null,$search_descripcion=null) {
		$this->layout = 'ajax';
		$this->loadModel('TipoVehiculo');
		$page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'TipoVehiculo.created';
	
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
			
			if($search_descripcion == 'null'){
				$search_descripcion = '';
			}else{
				$search_descripcion = $search_descripcion;
			}
	
		}else{
			$search_descripcion = '';
		}

		$list_tipo_vehiculo_all = $this->TipoVehiculo->listAllTipoVehiculos($order_by, utf8_encode($search_descripcion),$order_by_or);
		$list_tipo_vehiculo = $this->TipoVehiculo->listFindTipoVehiculos($order_by, utf8_encode($search_descripcion),$order_by_or, $start, $per_page);
		$count = count($list_tipo_vehiculo_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_tipo_vehiculo','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function add_edit_tipo_vehiculo($tipo_vehiculo_id=null){
		$this->layout = 'ajax';
		
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($tipo_vehiculo_id) && intval($tipo_vehiculo_id) > 0){
				
				//update
				$error_validation = '';
				
				$this->TipoVehiculo->id = $tipo_vehiculo_id;
	
				//$this->Persona->set($this->request->data);
				//$this->Persona->setFields();
	
				if ($this->TipoVehiculo->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'TipoVehiculo_id'=>$tipo_vehiculo_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->TipoVehiculo->validationErrors));
					exit();
				}
			}else{
				//insert
				$error_validation = '';
				
				$this->TipoVehiculo->create();
				if ($this->TipoVehiculo->save($this->request->data)) {
					$tipo_vehiculo_id = $this->TipoVehiculo->id;
					echo json_encode(array('success'=>true,'msg'=>__('El veh&iacute;culo fue agregado con &eacute;xito.'),'TipoVehiculo_id'=>$tipo_vehiculo_id));
					exit();
				}else{
					$tipo_vehiculo_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->TipoVehiculo->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($tipo_vehiculo_id)){
				$obj_tipo_vehiculo = $this->TipoVehiculo->findById($tipo_vehiculo_id);
				
				$this->request->data = $obj_tipo_vehiculo->data;
				$this->set(compact('tipo_vehiculo_id','obj_tipo_vehiculo'));
			}
		}
	}
	
	public function delete_tipo_vehiculo(){
		$this->layout = 'ajax';
	
		$this->loadModel('TipoVehiculo');
	
		if($this->request->is('post')){
			$tipo_vehiculo_id = $this->request->data['tipo_vehiculo_id'];
			
			$obj_tipo_vehiculo = $this->TipoVehiculo->findById($tipo_vehiculo_id);
			if($obj_tipo_vehiculo->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->TipoVehiculo->deleteTipoVehiculo($tipo_vehiculo_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();*/
		}
	
	
	}
	
}