<?php
class CodigosController extends AppController{
	public $name = 'Codigo';
	
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_codigo=null) {
		if($this->Session->read('Auth.User.tipo_user_id') == 3) {
			echo json_encode(array('success'=>true,'msg'=>__('Esta acción no esta permitida')));
			$this->redirect(array('controller' => 'actas', 'action' => 'index'));
			exit();
        }
		
		$this->layout = "default";
		$this->loadModel('Codigo');
		
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
		
	
	
	$order_by = 'Codigo.created';
		
		if($this->request->is('get')){
			if($search_codigo!=''){
				$search_codigo = $search_codigo;
			}else{
				$search_codigo = '';
			}
			
		}else{
			$search_codigo = '';
		}
		
		$list_codigo_all = $this->Codigo->listAllCodigos($order_by, utf8_encode($search_codigo),$order_by_or);
		$list_codigo = $this->Codigo->listFindCodigos($order_by, $search_codigo,$order_by_or, $start, $per_page);
		$count = count($list_codigo_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_codigo','page','no_of_paginations'));
	}
	
	public function find_codigos($page=null,$order_by=null,$order_by_or=null,$search_codigo=null) {
		$this->layout = 'ajax';
		$this->loadModel('Codigo');
		$page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'Codigo.created';
	
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
		
			if($search_codigo == 'null'){
				$search_codigo = '';
			}else{
				$search_codigo = $search_codigo;
			}

		}else{
			$search_codigo = '';
		}

		$list_codigo_all = $this->Codigo->listAllCodigos($order_by, utf8_encode($search_codigo),$order_by_or);
		$list_codigo = $this->Codigo->listFindCodigos($order_by, utf8_encode($search_codigo),$order_by_or, $start, $per_page);
		$count = count($list_codigo_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_codigo','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function add_edit_codigo($codigo_id=null){
		$this->layout = 'ajax';
		
		$this->loadModel('CategoriaNorma');
		$list_all_categorias = $this->CategoriaNorma->listCategoriaNormas();
		$this->set(compact('list_all_categorias'));
		
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($codigo_id) && intval($codigo_id) > 0){
				
				//update
				
				$this->Codigo->id = $codigo_id;
	
				if ($this->Codigo->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'Codigo_id'=>$codigo_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Codigo->validationErrors));
					exit();
				}
			}else{
				//insert

				$this->Codigo->create();
				if ($this->Codigo->save($this->request->data)) {
					$codigo_id = $this->Codigo->id;
					echo json_encode(array('success'=>true,'msg'=>__('El C&oacute;digo fue agregado con &eacute;xito.'),'Codigo_id'=>$codigo_id));
					exit();
				}else{
					$codigo_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Codigo->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($codigo_id)){
				$obj_codigo = $this->Codigo->findById($codigo_id);
				
				$this->request->data = $obj_codigo->data;
				$this->set(compact('codigo_id','obj_codigo'));
			}
		}
	}
	
	public function delete_codigo(){
		$this->layout = 'ajax';
	
		$this->loadModel('Codigo');
	
		if($this->request->is('post')){
			$codigo_id = $this->request->data['codigo_id'];
			
			$obj_codigo = $this->Codigo->findById($codigo_id);
			if($obj_codigo->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->Codigo->deleteCodigo($codigo_id)){
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