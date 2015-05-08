<?php
class EmpresasController extends AppController{
	public $name = 'Empresa';
	
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_nombre=null) {
		$this->layout = "default";
		$this->loadModel('Empresa');
		
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
		$order_by = 'Empresa.created';
		
		if($this->request->is('get')){
			if($search_nombre!=''){
				$search_nombre = $search_nombre;
			}else{
				$search_nombre = '';
			}

		}else{
			$search_nombre = '';
		}
		
		$list_empresa_all = $this->Empresa->listAllEmpresas($order_by, utf8_encode($search_nombre),$order_by_or);
		$list_empresa = $this->Empresa->listFindEmpresas($order_by, utf8_encode($search_nombre),$order_by_or, $start, $per_page);
		$count = count($list_empresa_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_empresa','page','no_of_paginations'));
	}
	
	public function find_empresas($page=null,$order_by=null,$order_by_or=null,$search_nombre=null) {
		$this->layout = 'ajax';
		$this->loadModel('Empresa');
		$page = $page;
		$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;
		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'Empresa.created';
	
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
			
			if($search_nombre == 'null'){
				$search_nombre = '';
			}else{
				$search_nombre = $search_nombre;
			}
	
		}else{
			$search_descripcion = '';
		}

		$list_empresa_all = $this->Empresa->listAllEmpresas($order_by, utf8_encode($search_nombre),$order_by_or);
		$list_empresa = $this->Empresa->listFindEmpresas($order_by, utf8_encode($search_nombre),$order_by_or, $start, $per_page);
		$count = count($list_empresa_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_empresa','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function add_edit_empresa($empresa_id=null){
		$this->layout = 'ajax';
		
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($empresa_id) && intval($empresa_id) > 0){
				
				//update
				$error_validation = '';
				
				$this->Empresa->id = $empresa_id;
	
				//$this->Persona->set($this->request->data);
				//$this->Persona->setFields();
	
				if ($this->Empresa->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'Empresa_id'=>$empresa_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Empresa->validationErrors));
					exit();
				}
			}else{
				//insert
				$error_validation = '';
				
				$this->Empresa->create();
				if ($this->Empresa->save($this->request->data)) {
					$empresa_id = $this->Empresa->id;
					echo json_encode(array('success'=>true,'msg'=>__('La empresa fue agregado con &eacute;xito.'),'Empresa_id'=>$empresa_id));
					exit();
				}else{
					$empresa_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Empresa->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($empresa_id)){
				$obj_empresa = $this->Empresa->findById($empresa_id);
				
				$this->request->data = $obj_empresa->data;
				$this->set(compact('empresa_id','obj_empresa'));
			}
		}
	}
	
	public function delete_empresa(){
		$this->layout = 'ajax';
	
		$this->loadModel('Empresa');
	
		if($this->request->is('post')){
			$empresa_id = $this->request->data['empresa_id'];
			
			$obj_empresa = $this->Empresa->findById($empresa_id);
			if($obj_empresa->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->Empresa->deleteEmpresa($empresa_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();*/
		}
	}
	
	public function add_empresa(){
		$this->layout = 'ajax';
		$this->loadModel('Empresa');
		if($this->request->is('post') || $this->request->is('put')){
			//debug($this->request->data['Empresa']['nombre']); exit();
			$this->Empresa->create();
			if ($this->Empresa->save($this->request->data)) {
				$empresa_id = $this->Empresa->id;
				echo json_encode(array('success'=>true,'msg'=>__('La empresa fue agregado con &eacute;xito.'),'Empresa_id'=>$empresa_id));
				exit();
			}else{
				$empresa_id = '';
				echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Empresa->validationErrors));
				exit();
			}	
		}
	}
	
}