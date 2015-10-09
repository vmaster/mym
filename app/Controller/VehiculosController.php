<?php
class VehiculosController extends AppController{
	public $name = 'Vehiculo';
	
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_nroplaca=null,$search_nrosoat=null) {
		if($this->Session->read('Auth.User.tipo_user_id') == 3) {
			echo json_encode(array('success'=>true,'msg'=>__('Esta acción no esta permitida')));
			$this->redirect(array('controller' => 'actas', 'action' => 'index'));
			exit();
        }
		
		$this->layout = "default";
		$this->loadModel('Vehiculo');
		
		$page = 0;
		//$page -= 1;
		$per_page = 1000;
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
		
	
	
	$order_by = 'Vehiculo.created';
		
		if($this->request->is('get')){
			if($search_nroplaca!=''){
				$search_nroplaca = $search_nroplaca;
			}else{
				$search_nroplaca = '';
			}
			
			if($search_nrosoat!=''){
				$search_nrosoat = $search_nrosoat;
			}else{
				$search_nrosoat = '';
			}

		}else{
			$search_nroplaca = '';
			$search_nrosoat = '';
		}
		
		$list_vehiculo_all = $this->Vehiculo->listAllVehiculos($order_by, utf8_encode($search_nroplaca),utf8_encode($search_nrosoat),$order_by_or);
		$list_vehiculo = $this->Vehiculo->listFindVehiculos($order_by, utf8_encode($search_nroplaca),utf8_encode($search_nrosoat),$order_by_or, $start, $per_page);
		$count = count($list_vehiculo_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_vehiculo','page','no_of_paginations'));
	}
	
	public function find_vehiculos($page=null,$order_by=null,$order_by_or=null,$search_nroplaca=null,$search_nrosoat=null) {
		$this->layout = 'ajax';
		$this->loadModel('Vehiculo');
		$page = $page;
		$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;
		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'Vehiculo.created';
	
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
		
			if($search_nroplaca == 'null'){
				$search_nroplaca = '';
			}else{
				$search_nroplaca = $search_nroplaca;
			}
			
			if($search_nrosoat == 'null'){
				$search_nrosoat = '';
			}else{
				$search_nrosoat = $search_nrosoat;
			}
	
		}else{
			$search_nroplaca = '';
			$search_nrosoat = ''; 
		}

		$list_vehiculo_all = $this->Vehiculo->listAllVehiculos($order_by, utf8_encode($search_nroplaca), utf8_encode($search_nrosoat),$order_by_or);
		$list_vehiculo = $this->Vehiculo->listFindVehiculos($order_by, utf8_encode($search_nroplaca), utf8_encode($search_nrosoat),$order_by_or, $start, $per_page);
		$count = count($list_vehiculo_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_vehiculo','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function add_edit_vehiculo($vehiculo_id=null){
		$this->layout = 'ajax';
		
		$this->loadModel('TipoVehiculo');
		$list_all_vehiculos = $this->TipoVehiculo->listTipoVehiculos();
		$this->set(compact('list_all_vehiculos'));
		
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($vehiculo_id) && intval($vehiculo_id) > 0){
				
				//update
				$fec_soat = $this->formatFecha($this->request->data['Vehiculo']['fec_ven_soat'], "'fec_ven_soat'");
				$fec_rev = $this->formatFecha($this->request->data['Vehiculo']['fec_rev_tec'], "'fec_rev_tec'");
				
				$this->request->data['Vehiculo']['fec_ven_soat'] = $fec_soat;
				$this->request->data['Vehiculo']['fec_rev_tec'] = $fec_rev;
				
				$this->Vehiculo->id = $vehiculo_id;
	
				//$this->Persona->set($this->request->data);
				//$this->Persona->setFields();
	
				if ($this->Vehiculo->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'Vehiculo_id'=>$vehiculo_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Vehiculo->validationErrors));
					exit();
				}
			}else{
				//insert
				$fec_soat = $this->formatFecha($this->request->data['Vehiculo']['fec_ven_soat'], "'fec_ven_soat'");
				$fec_rev = $this->formatFecha($this->request->data['Vehiculo']['fec_rev_tec'], "'fec_rev_tec'");
				
				$this->request->data['Vehiculo']['fec_ven_soat'] = $fec_soat;
				$this->request->data['Vehiculo']['fec_rev_tec'] = $fec_rev;
				$this->Vehiculo->create();
				if ($this->Vehiculo->save($this->request->data)) {
					$vehiculo_id = $this->Vehiculo->id;
					echo json_encode(array('success'=>true,'msg'=>__('El veh&iacute;culo fue agregado con &eacute;xito.'),'Vehiculo_id'=>$vehiculo_id));
					exit();
				}else{
					$vehiculo_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Vehiculo->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($vehiculo_id)){
				$obj_vehiculo = $this->Vehiculo->findById($vehiculo_id);
				
				$this->request->data = $obj_vehiculo->data;
				$this->set(compact('vehiculo_id','obj_vehiculo'));
			}
		}
	}
	
	public function delete_vehiculo(){
		$this->layout = 'ajax';
	
		$this->loadModel('Vehiculo');
	
		if($this->request->is('post')){
			$vehiculo_id = $this->request->data['vehiculo_id'];
			
			$obj_vehiculo = $this->Vehiculo->findById($vehiculo_id);
			if($obj_vehiculo->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->Vehiculo->deleteVehiculo($vehiculo_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();*/
		}
	
	}
	
	function formatFecha($fecha,$campo){
		if(isset($fecha)){
			$fec_veh = $fecha;//12-12-1990
	
			if($fec_veh == '' || $fec_veh == NULL){
				$fec_veh = '';
			}else{
				$dd = substr($fec_veh, 0, 2);
				$mm = substr($fec_veh, 3, 2);
				$yy = substr($fec_veh, -4);
				$fec_veh = $yy.'-'.$mm.'-'.$dd;//1990-12-12
			}
			$this->request->data['Vehiculo'][$campo] = $fec_veh;
		}
	
		return $this->request->data['Vehiculo'][$campo];
	}
	
	public function add_vehiculo(){
		$this->layout = 'ajax';
		$this->loadModel('Vehiculo');
		if($this->request->is('post') || $this->request->is('put')){
			//debug($this->request->data['Trabajadore']['apellido_nombre']); exit();
			$this->Vehiculo->create();
			if ($this->Vehiculo->save($this->request->data)) {
				$vehiculo_id = $this->Vehiculo->id;
				echo json_encode(array('success'=>true,'msg'=>__('El Vehiculo fue agregado con &eacute;xito.'),'Vehiculo_id'=>$vehiculo_id));
				exit();
			}else{
				$vehiculo_id = '';
				echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Vehiculo->validationErrors));
				exit();
			}
		}
	}
		
}