<?php
class CategoriaNormasController extends AppController{
	public $name = 'CategoriaNorma';
	
	public function beforeFilter(){
		$this->Auth->allow(array('lista_json'));
		//parent::beforeFilter();
	}
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_descripcion=null) {
		$this->layout = "default";
		$this->loadModel('CategoriaNorma');
		
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
		
	
	
	$order_by = 'CategoriaNorma.created';
		
		if($this->request->is('get')){
			if($search_descripcion!=''){
				$search_descripcion = $search_descripcion;
			}else{
				$search_descripcion = '';
			}

		}else{
			$search_descripcion = '';
		}
		
		$list_categoria_norma_all = $this->CategoriaNorma->listAllCategoriaNormas($order_by, utf8_encode($search_descripcion),$order_by_or);
		$list_categoria_norma = $this->CategoriaNorma->listFindCategoriaNormas($order_by, utf8_encode($search_descripcion),$order_by_or, $start, $per_page);
		$count = count($list_categoria_norma_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_categoria_norma','page','no_of_paginations'));
	}
	
	public function find_categoria_normas($page=null,$order_by=null,$order_by_or=null,$search_descripcion=null) {
		$this->layout = 'ajax';
		$this->loadModel('CategoriaNorma');
		$page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'CategoriaNorma.created';
	
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

		$list_categoria_norma_all = $this->CategoriaNorma->listAllCategoriaNormas($order_by, utf8_encode($search_descripcion),$order_by_or);
		$list_categoria_norma = $this->CategoriaNorma->listFindCategoriaNormas($order_by, utf8_encode($search_descripcion),$order_by_or, $start, $per_page);
		$count = count($list_categoria_norma_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_categoria_norma','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function add_edit_categoria_norma($categoria_norma_id=null){
		$this->layout = 'ajax';
		
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($categoria_norma_id) && intval($categoria_norma_id) > 0){
				
				//update
				$error_validation = '';
				
				$this->CategoriaNorma->id = $categoria_norma_id;
	
				//$this->Persona->set($this->request->data);
				//$this->Persona->setFields();
	
				if ($this->CategoriaNorma->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'CategoriaNorma_id'=>$categoria_norma_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CategoriaNorma->validationErrors));
					exit();
				}
			}else{
				//insert
				$error_validation = '';
				
				$this->CategoriaNorma->create();
				if ($this->CategoriaNorma->save($this->request->data)) {
					$categoria_norma_id = $this->CategoriaNorma->id;
					echo json_encode(array('success'=>true,'msg'=>__('El veh&iacute;culo fue agregado con &eacute;xito.'),'CategoriaNorma_id'=>$categoria_norma_id));
					exit();
				}else{
					$categoria_norma_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CategoriaNorma->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($categoria_norma_id)){
				$obj_categoria_norma = $this->CategoriaNorma->findById($categoria_norma_id);
				
				$this->request->data = $obj_categoria_norma->data;
				$this->set(compact('categoria_norma_id','obj_categoria_norma'));
			}
		}
	}
	
	public function delete_categoria_norma(){
		$this->layout = 'ajax';
	
		$this->loadModel('CategoriaNorma');
	
		if($this->request->is('post')){
			$categoria_norma_id = $this->request->data['categoria_norma_id'];
			
			$obj_categoria_norma = $this->CategoriaNorma->findById($categoria_norma_id);
			if($obj_categoria_norma->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->CategoriaNorma->deleteCategoriaNorma($categoria_norma_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();*/
		}
	
	
	}
	
	public function lista_json(){
		ini_set('memory_limit', '-1');
		$this->layout = 'ajax';
		
		$arr_normas_categorias = $this->CategoriaNorma->find('all');
		echo json_encode($arr_normas_categorias);
		exit();
	}
	
}