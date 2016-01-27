<?php
class UnidadesNegociosController extends AppController{
	public $name = 'UnidadesNegocio';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_descripcion=null) {
		$this->verificarAccessoInvitado(); //AppController
        
		$this->layout = "default";
		$this->loadModel('UnidadesNegocio');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10;
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
		
	
	
	$order_by = 'UnidadesNegocio.created';
		
		if($this->request->is('get')){
			if($search_descripcion!=''){
				$search_descripcion = $search_descripcion;
			}else{
				$search_descripcion = '';
			}
			
		}else{
			$search_descripcion = '';
		}
		
		$list_unidades_negocio_all = $this->UnidadesNegocio->listAllUnidadesNegocios($order_by, utf8_encode($search_descripcion),$order_by_or);
		$list_unidades_negocio = $this->UnidadesNegocio->listFindUnidadesNegocios($order_by, utf8_encode($search_descripcion),$order_by_or, $start, $per_page);
		$count = count($list_unidades_negocio_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_unidades_negocio','page','no_of_paginations'));
	}
	
	public function find_uunns($page=null,$order_by=null,$order_by_or=null,$search_descripcion=null) {
		$this->layout = 'ajax';
		$this->loadModel('UnidadesNegocio');
		$page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'UnidadesNegocio.created';
	
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
	
		if($this->request->is('get')){
		
			if($search_descripcion == 'null'){
				$search_descripcion = '';
			}else{
				$search_descripcion = $search_descripcion;
			}

		}else{
			$search_descripcion = '';
		}

		$list_unidades_negocio_all = $this->UnidadesNegocio->listAllUnidadesNegocios($order_by, utf8_encode($search_descripcion),$order_by_or);
		$list_unidades_negocio = $this->UnidadesNegocio->listFindUnidadesNegocios($order_by, utf8_encode($search_descripcion),$order_by_or, $start, $per_page);
		$count = count($list_unidades_negocio_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_unidades_negocio','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function add_edit_uunn($unidades_negocio_id=null){
		$this->layout = 'ajax';
		
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($unidades_negocio_id) && intval($unidades_negocio_id) > 0){
				
				//update
				
				$this->UnidadesNegocio->id = $unidades_negocio_id;
	
				if ($this->UnidadesNegocio->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'UnidadesNegocio_id'=>$unidades_negocio_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->UnidadesNegocio->validationErrors));
					exit();
				}
			}else{
				//insert

				$this->UnidadesNegocio->create();
				if ($this->UnidadesNegocio->save($this->request->data)) {
					$unidades_negocio_id = $this->UnidadesNegocio->id;
					echo json_encode(array('success'=>true,'msg'=>__('El veh&iacute;culo fue agregado con &eacute;xito.'),'UnidadesNegocio_id'=>$unidades_negocio_id));
					exit();
				}else{
					$unidades_negocio_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->UnidadesNegocio->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($unidades_negocio_id)){
				$obj_unidades_negocio = $this->UnidadesNegocio->findById($unidades_negocio_id);
				
				$this->request->data = $obj_unidades_negocio->data;
				$this->set(compact('unidades_negocio_id','obj_unidades_negocio'));
			}
		}
	}
	
	public function delete_unidades_negocio(){
		$this->layout = 'ajax';
	
		$this->loadModel('UnidadesNegocio');
	
		if($this->request->is('post')){
			$unidades_negocio_id = $this->request->data['unidades_negocio_id'];
			
			$obj_unidades_negocio = $this->UnidadesNegocio->findById($unidades_negocio_id);
			if($obj_unidades_negocio->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->UnidadesNegocio->deleteUnidadesNegocio($unidades_negocio_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();*/
		}
	
	}

	
	/*public function add_unidades_negocio(){
		$this->layout = 'ajax';
		$this->loadModel('UnidadesNegocio');
		if($this->request->is('post') || $this->request->is('put')){
			//debug($this->request->data['Trabajadore']['apellido_nombre']); exit();
			$this->UnidadesNegocio->create();
			if ($this->UnidadesNegocio->save($this->request->data)) {
				$unidades_negocio_id = $this->UnidadesNegocio->id;
				echo json_encode(array('success'=>true,'msg'=>__('El UnidadesNegocio fue agregado con &eacute;xito.'),'UnidadesNegocio_id'=>$unidades_negocio_id));
				exit();
			}else{
				$unidades_negocio_id = '';
				echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->UnidadesNegocio->validationErrors));
				exit();
			}
		}
	}*/
		
}