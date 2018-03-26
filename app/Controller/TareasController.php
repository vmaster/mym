<?php
class TareasController extends AppController{
	public $name = 'Tarea';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function index($page=null,$order_by=null,$order_by_or=null) {
        
		$this->layout = "default";
		$this->loadModel('Tarea');
		$this->loadModel('Trabajadore');
		
		$page = 0;
		$per_page = 10000;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}

		$order_by = 'Tarea.created';	

		if($this->Session->read('Auth.User.tipo_user_id') == 2){
			$user_id = $this->Session->read('Auth.User.id');
		}else{
			$user_id = 0;
		}

		//$list_trabajadores_enosa = $this->Trabajadore->listAllTrabajadoresEnosa();

				
		$list_tarea_all = $this->Tarea->listAllTareas($order_by, $order_by_or, $user_id, '');
		$list_tarea = $this->Tarea->listFindTareas($order_by, $order_by_or, $start, $per_page, $user_id, '');
		$count = count($list_tarea_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_tarea','page','no_of_paginations'));
	}
	
	public function find_tareas($page=null,$order_by=null,$order_by_or=null, $trabajador_id=null) {
		$this->layout = 'ajax';
		$this->loadModel('Tarea');
		$page = $page;
		$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;

		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/

		if(isset($trabajador_id)){
			//debug("id desde el combo ".$trabajador_id); exit();
			$user_id = $trabajador_id;
		}else{
			$user_id = $this->Session->read('Auth.User.id');
		}

				
		$order_by = 'Tarea.created';
	
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
	

		$list_tarea_all = $this->Tarea->listAllTareas($order_by, $order_by_or, $user_id);
		$list_tarea = $this->Tarea->listFindTareas($order_by, $order_by_or, $start, $per_page, $user_id);
		$count = count($list_tarea_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_tarea','page','no_of_paginations'));
	}
	

	public function listar_todas_tareas($page=null,$order_by=null,$order_by_or=null) {
		ini_set('memory_limit', '512M');
		$this->layout = 'ajax';
		$this->loadModel('Tarea');
		$page = $page;
		$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;

		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/

		if(isset($trabajador_id)){
			//debug("id desde el combo ".$trabajador_id); exit();
			$user_id = $trabajador_id;
		}else{
			$user_id = $this->Session->read('Auth.User.id');
		}

		if(isset($all)){
			debug("TEXTO DE ALL ".$all); exit();
			$all= $all;
		}else{
			$all = '';
		}
		
		$order_by = 'Tarea.created';
	
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
	

		//$list_tarea_all = $this->Tarea->listAllTareas($order_by, $order_by_or, $user_id, $all);
		$list_tarea = $this->Tarea->listTodasTareas($order_by, $order_by_or, $start, $per_page, $user_id, $all);
		//$count = count($list_tarea_all);
		//$no_of_paginations = ceil($count / $per_page);
		//$page = $page+1;
		$this->set(compact('list_tarea','page','no_of_paginations'));
	}
	
	/**
	 * Add and Edit using Ajax
	 * 18 October 2017
	 * @author Vladimir
	 */
	public function nueva_tarea($tarea_id=null){
		$this->layout = 'default';
		$this->loadModel('Tarea');
	
		if($this->request->is('post')  || $this->request->is('put')){
			
				//insert
				$error_validation = '';
				$this->loadModel('Tarea');

				$this->request->data['Tarea']['descripcion'] = $this->request->data['Tarea']['descripcion'];
				$this->request->data['Tarea']['user_id'] = $this->Session->read('Auth.User.id');
				$this->request->data['Tarea']['estado'] = 0;
				$this->request->data['Tarea']['dia_libre'] = 0;
				if($this->request->data['Tarea']['movilidad'] == 0){
					$this->request->data['Tarea']['trabajador_id'] = 0;
				}
				
				$this->Tarea->create();
				if ($this->Tarea->save($this->request->data)) {
					$tarea_id = $this->Tarea->id;
					$obj_tarea = $this->Tarea->findById($tarea_id );

					$num_tarea = str_pad($tarea_id, 5, '0', STR_PAD_LEFT);				
					$obj_tarea->saveField('num_tarea', $num_tarea);
					$this->request->data['Tarea']['num_tarea'] = $num_tarea;
					echo json_encode(array('success'=>true,'msg'=>__('La tarea fue agregado con &eacute;xito.'),'Tarea_id'=>$tarea_id));
					exit();
				}else{
					$tarea_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Tarea->validationErrors));
					exit();
				}
			
		}else{
			if(isset($tarea_id)){
				$obj_tarea = $this->Tarea->findById($tarea_id);
				$arr_trabaj_enosa = $this->Trabajadore->listAllTrabajadoresEnosaChofer();
				
				$this->request->data = $obj_tarea->data;
				$this->set(compact('tarea_id','obj_tarea','arr_trabaj_enosa'));
			}
			
			$this->loadModel('Trabajadore');
			$arr_trabaj_enosa = $this->Trabajadore->listAllTrabajadoresEnosaChofer();
			$this->set(compact('arr_trabaj_enosa'));
		}
		
	}

	public function editar_tarea($tarea_id=null){
		$this->layout = 'default';
		$this->loadModel('Tarea');

	
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($tarea_id) && intval($tarea_id) > 0){
				
				//update
				$error_validation = '';
				
				$this->Tarea->id = $tarea_id;
	
				//$this->Persona->set($this->request->data);
				//$this->Persona->setFields();

				$this->request->data['Tarea']['descripcion'] = $this->request->data['Tarea']['descripcion'];
				$this->request->data['Tarea']['trabajador_id'] = $this->request->data['Tarea']['trabajador_id'];
				if($this->Session->read('Auth.User.id') != 1){
					$this->request->data['Tarea']['user_id'] = $this->Session->read('Auth.User.id');
				}
				if($this->request->data['Tarea']['movilidad'] == 0){
					$this->request->data['Tarea']['trabajador_id'] = 0;
				}
				
				if ($this->Tarea->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'Tarea_id'=>$tarea_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Tarea->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($tarea_id)){
				$obj_tarea = $this->Tarea->findById($tarea_id);
				$this->loadModel('Trabajadore');
				$arr_trabaj_enosa = $this->Trabajadore->listAllTrabajadoresEnosaChofer();
			
				$this->request->data = $obj_tarea->data;
				
				$this->set(compact('tarea_id','obj_tarea','arr_trabaj_enosa'));
			}
		}
		
	}
	
	public function delete_tarea(){
		$this->layout = 'ajax';
	
		$this->loadModel('Tarea');
	
		if($this->request->is('post')){
			$tarea_id = $this->request->data['tarea_id'];
			
			/*$obj_tarea = $this->Tarea->findById($tarea_id);
			if($obj_tarea->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}*/
			if($this->Tarea->delete($tarea_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();
		}
	}
	
	public function add_tarea(){
		$this->layout = 'ajax';
		$this->loadModel('Tarea');
		if($this->request->is('post') || $this->request->is('put')){
			//debug($this->request->data['Tarea']['nombre']); exit();
			$this->Tarea->create();
			if ($this->Tarea->save($this->request->data)) {
				$tarea_id = $this->Tarea->id;
				echo json_encode(array('success'=>true,'msg'=>__('La tarea fue agregado con &eacute;xito.'),'Tarea_id'=>$tarea_id));
				exit();
			}else{
				$tarea_id = '';
				echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Tarea->validationErrors));
				exit();
			}	
		}
	}

	public function obtener_actividades(){
		$this->layout = 'ajax';
		$this->loadModel('Tarea');
		if($this->request->is('post') || $this->request->is('put')){
			$tarea_id = $this->request->data['tarea_id'];
			$array_tarea = $this->Tarea->obtenerActividades($tarea_id);
			if(count($array_tarea)>0){
				$actividades = $array_tarea[0]['Tarea']['descripcion'];
				$fecha = date("Y-m-d, g:i a",strtotime($array_tarea[0]['Tarea']['created']));
				$personal =  $array_tarea[0]['TrabajadorJoin']['apellido_nombre'];
				$informe_ref = $array_tarea[0]['Tarea']['informe_ref'];
				$movilidad = $array_tarea[0]['Tarea']['movilidad'];
				$placa = $array_tarea[0]['Tarea']['placa_auto'];
				$dia_libre = $array_tarea[0]['Tarea']['dia_libre'];
				$observacion = $array_tarea[0]['Tarea']['observacion'];
				$chofer = $array_tarea[0]['ChoferJoin']['apellido_nombre'];
				$uunn = $array_tarea[0]['UsuarioJoin']['uunn_id'];
			}else{
				$actividades = "";
				$fecha = "";
				$personal =  "";
				$informe_ref = "";
				$movilidad = "";
				$placa = "";
				$dia_libre = "";
				$observacion = "";
				$chofer = "";
			}
			
			echo json_encode(array('success'=>true,'fecha'=> $fecha, 'actividades'=> $actividades,'personal'=> $personal, 'inf_ref'=> $informe_ref, 'movilidad'=> $movilidad, 'placa' => $placa, 'dia_libre' => $dia_libre, 'observacion' => $observacion, 'chofer' => $chofer, 'uunn' => $uunn));
			exit();
		}else{
			echo json_encode(array('success'=>false,'fecha'=> '', 'actividades'=> '','personal'=> ''));
			exit();
		}
	}

	
	/* FUNCIÓN PARA LISTAR ACTIVIDADES SEGUN EL TRABAJADOR ENOSA SELECCIONADO */
	public function listado_tareas($page=null,$trabajador_id=null,$order_by=null,$order_by_or=null) {
        
		$this->layout = "default";
		$this->loadModel('Tarea');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}

		if(isset($trabajador_id)){
			$trabajador_id = $trabajador_id;
		}else{
			$trabajador_id = "";
		}
		
		$user_id = $this->Session->read('Auth.User.id');
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
		$order_by = 'Tarea.created';
		
				
		$list_tarea_all = $this->Tarea->listAllTareas($order_by, $order_by_or, $trabajador_id);
		$list_tarea = $this->Tarea->listFindTareas($order_by, $order_by_or, $start, $per_page, $trabajador_id);
		$count = count($list_tarea_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_tarea','page','no_of_paginations'));
	}


	public function active_desactive_edit()
	{
		$this->autoRender = false;
		$this->loadModel('Tarea');
		
			if(isset($this->request->data) || $this->request->is('post')){
				//debug($this->request->data);exit();
				$tarea_id = $this->request->data['tarea_id'];
				$estado = $this->request->data['estado'];
				$obj_tarea = $this->Tarea->findById($tarea_id);

				if($estado == 1){
					$obj_tarea->saveField('estado', 0);	
				}else{
					$obj_tarea->saveField('estado', 1);
				}

				echo json_encode(array('success'=>true,'msg'=>__('El estado ha sido cambiado')));
					
			}
		
	}


	public function active_desactive_dialibre()
	{
		$this->autoRender = false;
		$this->loadModel('Tarea');
		
			if(isset($this->request->data) || $this->request->is('post')){
				//debug($this->request->data);exit();
				$tarea_id = $this->request->data['tarea_id'];
				$dia_libre = $this->request->data['dia_libre'];
				$obj_tarea = $this->Tarea->findById($tarea_id);

				if($dia_libre == 1){
					$obj_tarea->saveField('dia_libre', 0);	
				}else{
					$obj_tarea->saveField('dia_libre', 1);
				}

				echo json_encode(array('success'=>true,'msg'=>__('El estado ha sido cambiado')));
					
			}
		
	}

	public function verifica_tarea_hoy($user_id = null){
		$this->autoRender = false;
		$this->loadModel('Tarea');

		if(isset($user_id)){
			$existe = $this->Tarea->verficarTareaHoy($user_id);
			//debug("RETURN ".$existe);
			if($existe == false){
				return false;
			}else{
				return true;
			}
		}

	}

	public function ajax_list_trabajador(){
		$this->layout = 'ajax';
		$this->loadModel('Trabajadore');
		
		if($this->request->is('post')){
			$uunn_id = $this->request->data['uunn_id'];
			//$departamento_name = $this->request->data['departamento_nombre'];
		
			$array_trabajadores = $this->Trabajadore->listTrabajadoresByUunnId($uunn_id);

		}
		
		$this->set(compact('array_trabajadores'));
	}
	

	
}