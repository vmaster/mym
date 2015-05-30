<?php
//App::uses('AppController', 'Controller');
class UsersController extends AppController{

	//var $components = array('Auth', 'Session');
	public $name = 'User';

	public function beforeFilter(){
		$this->Auth->allow(array('login','register','logout'));
		//parent::beforeFilter();
	}

	public function login() {
		$this->layout = "default_external";

		if($this->request->is('post')) {
			if($this->Auth->login()) {
				//$this->User->saveField('ultimo_acceso', date('Y-m-d H:i:s') );
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('El Usuario o Contrase&ntilde;a es Incorrecto'),array(),'auth');
			}
		}else{
			if($this->Auth->user('id')){
				$this->redirect($this->Auth->redirect());
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}


	/*public function index() {
		$this->layout = "default";
		$this->loadModel('TipoUsuario');
		$this->loadModel('Persona');
		$array_obj_usuario = $this->User->listarInfoPersonalUsuario();
		$this->set(compact('array_obj_usuario'));
	}*/
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_username=null) {
		
		if($this->Session->read('Auth.User.tipo_user_id') == 2) {
			$this->redirect(array('controller' => 'index'));
		}
		
		$this->layout = "default";
		$this->loadModel('Trabajadore');
		$this->loadModel('TipoUsuario');
	
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
		$order_by = 'User.created';
	
		if($this->request->is('get')){
			if($search_username!=''){
				$search_username = $search_username;
			}else{
				$search_username = '';
			}
	
		}else{
			$search_username = '';
		}
	
		$list_user_all = $this->User->listAllUsers($order_by, utf8_encode($search_username),$order_by_or);
		$list_user = $this->User->listFindUsers($order_by, utf8_encode($search_username),$order_by_or, $start, $per_page);
		$count = count($list_user_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
	
		$this->set(compact('list_user','page','no_of_paginations'));
	}
	
	public function find_users($page=null,$order_by=null,$order_by_or=null,$search_username=null) {
		$this->layout = 'ajax';
		$this->loadModel('Trabajadore');
		$this->loadModel('TipoUsuario');
		$page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		/*if(isset($order_by)){
		 $order_by = $order_by;
		}else{
		$order_by = 'Persona.created';
		}*/
		$order_by = 'User.created';
	
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
				
			if($search_username == 'null'){
				$search_username = '';
			}else{
				$search_username = $search_username;
			}
		}else{
			$search_username = '';
		}
	
		$list_user_all = $this->User->listAllUsers($order_by, utf8_encode($search_username),$order_by_or);
		$list_user = $this->User->listFindUsers($order_by, utf8_encode($search_username),$order_by_or, $start, $per_page);
		$count = count($list_user_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_user','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function add_edit_user($user_id=null){
		$this->layout = 'ajax';
		$this->loadModel('TipoUsuario');
		$this->loadModel('Trabajadore');
		$list_all_personals = $this->Trabajadore->listAllPersonal();
		$list_all_tipo_usuarios = $this->TipoUsuario->listAllTipoUsuarios();
		$this->set(compact('list_all_tipo_usuarios','list_all_personals'));
	
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($user_id) && intval($user_id) > 0){
	
				//update
					
				$this->User->id = $user_id;
	
	
				if ($this->User->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'User_id'=>$user_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->User->validationErrors));
					exit();
				}
			}else{
				//insert
				
				$this->request->data['User']['id'] = $this->request->data['Trabajadore']['id'];
	
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$user_id = $this->User->id;
					echo json_encode(array('success'=>true,'msg'=>__('El Usuario fue agregado con &eacute;xito.'),'User_id'=>$user_id));
					exit();
				}else{
					$user_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->User->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($user_id)){
				$obj_user = $this->User->findById($user_id);
	
				$this->request->data = $obj_user->data;
				$this->set(compact('user_id','obj_user'));
			}
		}
	}
	
	
	
	
	

	/**
	 * Add and Edit using Ajax
	 * 17 March 2015
	 * @author Vladimir
	 */
	/*public function add_edit_usuario($usuario_id=null){
		$this->layout = 'ajax';
		$this->loadModel('TipoUsuario');
		$this->loadModel('Trabajadore');
		$list_all_personals = $this->Trabajadore->listAllPersonal();
		$list_all_tipo_usuarios = $this->TipoUsuario->listAllTipoUsuarios();
		$this->set(compact('list_all_tipo_usuarios','list_all_personals'));

		if($this->request->is('post')  || $this->request->is('put')){
			 
			if(isset($usuario_id) && intval($usuario_id) > 0){
				//update
				$this->User->id = $usuario_id;

				$this->User->set($this->request->data);
				$this->User->setFields();

				if ($this->User->save()) {
					echo json_encode(array('success'=>true,'msg'=>__('Usuario updated.'),'User_id'=>$usuario_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Your information is incorrect.'),'validation'=>$this->User->validationErrors));
					exit();
				}
			}else{
				//insert
				
				$this->request->data['User']['id'] = $this->request->data['Trabajadore']['id'];
				//$this->User->set($this->request->data);
				//$this->User->setFields();

				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$usuario_id = $this->User->id;
					echo json_encode(array('success'=>true,'msg'=>__('Usuario agregado.'),'User_id'=>$usuario_id));
					exit();
				}else{
					$usuario_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Your information is incorrect.'),'validation'=>$this->User->validationErrors));
					exit();
				}
			}
		}else{

		}

	}*/
	
	public function delete_user(){
		$this->layout = 'ajax';
	
		$this->loadModel('User');
	
		if($this->request->is('post')){
			$user_id = $this->request->data['user_id'];
			if($this->User->deleteUser($user_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();
		}
	}

	public function get_usuario_row($usuario_id){
		$this->layout = 'ajax';

		$this->loadModel('Usuario');
		$obj_usuario = $this->Usuario->findById($usuario_id);
		$this->set(compact('usuario_id','obj_usuario'));
	}

	public function change_password(){
		//$this->layout = 'ajax';
		$this->autoRender = false;
		
		$this->loadModel('User');
		
		if($this->request->is('post')){
			//debug($this->request->data);
			$user_id = $this->request->data['user_id'];
			$current_pass = $this->request->data['current_pass'];
			$new_pass = $this->request->data['new_pass'];
			$new_confirm = $this->request->data['confirm_pass'];
			
			$error_validation1 = '';
			$error_validation2 = '';
			
			if($current_pass == ''){
				$arr_validation1['current_password'] = array(__('Debe ingresar su clave actual'));
				$error_validation1 = true;
			}
			
			if($new_pass == ''){
				$arr_validation1['new_password'] = array(__('Debe ingresar su nueva clave'));
				$error_validation1 = true;
			}
			
			if($new_confirm == ''){
				$arr_validation1['new_password_confirm'] = array(__('Debe ingresar clave de confirmaci&oacute;n'));
				$error_validation1 = true;
			}
			
			if($error_validation1 == true){
				echo json_encode(array('success' =>false, 'msg' => __('No se pudo guardar'), 'validation' => $arr_validation1));
				exit();
			}
			
			if($this->User->checkPasswordForUser($user_id,$current_pass)){
				if($new_pass == $new_confirm){
					$new_pass_hash= AuthComponent::password($new_pass);
					$obj_user = $this->User->findById($user_id);
					if($obj_user->saveField('password', $new_pass_hash)){
						echo json_encode(array('success'=>true,'msg'=>__('su constrase&ntilde;a fue cambiada con &eacute;xito')));
						exit();
					}
				}else{
					//echo json_encode(array('success'=>false,'msg'=>__('La clave de confirmaci&eacute;n no coincide con su nueva clave')));
					//exit();
					$arr_validation2['new_password_confirm'] = array(__('La clave de confirmaci&oacute;n no coincide con su nueva clave'));
					$error_validation2 = true;
				}
			}else{
				//echo json_encode(array('success'=>false,'msg'=>__('La clave ingresada es incorrecta')));
				//exit();
				$arr_validation2['current_password'] = array(__('La clave ingresada es incorrecta'));
				$error_validation2 = true;
			}
			
			if($error_validation2 == true){
				echo json_encode(array('success' =>false, 'msg' => __('No se pudo guardar'), 'validation' => $arr_validation2));
				exit();
			}
		}
	}
}
?>
