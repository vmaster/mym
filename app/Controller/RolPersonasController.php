<?php
class RolPersonasController extends AppController{
	public $name = 'RolPersonas';
	

	public function list_roles_personas($persona_id= 0,$persona_nombre='', $page=null,$order_by=null,$order_by_or=null) {
		$this->layout = "ajax";
		$this->loadModel('RolPersona');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}

		$order_by = 'RolPersona.id';
		
		if(isset($persona_nombre) || $persona_nombre != ''){
				/*$persona_id = $persona_id;*/
				$persona_nombre = $persona_nombre;
		}
		
		
		if(isset($persona_id) && intval($persona_id)){
			$persona_id = $persona_id;
		}
		//$list_rol_persona_all = $this->RolPersona->listAllRoles($order_by, $order_by_or, $persona_id);
		$list_rol_persona = $this->RolPersona->listFindRoles($order_by, $order_by_or, $persona_id);
		/*$count = count($list_rol_persona_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;*/
		
		$this->set(compact('list_rol_persona','persona_id','persona_nombre'));
	}
	
	public function find_personas($page=null,$order_by=null,$order_by_or=null,$search_tipo_persona=0,$search_nro_documento=null,$search_nombre=null) {
		$this->layout = 'ajax';
		$this->loadModel('Persona');
		$this->loadModel('TipoPersona');
		$page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'Persona.created';
	
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
			if($search_tipo_persona!= 0){
				$search_tipo_persona = $search_tipo_persona;
			}else{
				$search_tipo_persona = 0;
			}
			
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
			$search_tipo_persona = 0;
			$search_nro_documento = '';
		}
		/*
		 $this->paginate = array('conditions'=>array($select_by .' LIKE "%'. $search .'%"'),'limit'=>15, 'order' => array($order_by => 'desc'));
		$seo_journals = $this->paginate('Journal');
		$this->set('seo_journals',$seo_journals);
		*/
		$list_persona_all = $this->Persona->listAllPersonas($order_by, utf8_encode($search_nro_documento),utf8_encode($search_nombre),$search_tipo_persona,$order_by_or);
		$list_persona = $this->Persona->listFindPersonas($order_by, utf8_encode($search_nro_documento),utf8_encode($search_nombre),$search_tipo_persona, $order_by_or, $start, $per_page);
		$count = count($list_persona_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_persona','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 20 March 2013
	 * @author Vladimir
	 */
	public function add_edit_rol_persona($persona_id = null, $persona_nombre=''){
		$this->layout = 'ajax';
		$this->loadModel('Role');
		$this->loadModel('RolPersona');
		
		
		//debug("HOLACCCC ".$persona_nombre);
		
		$this->set(compact('list_all_roles'));
		
		if($this->request->is('post')  || $this->request->is('put')){

				//insert
				$error_validation = '';

				if($error_validation == true){
					echo json_encode(array('success' =>false, 'msg' => __('No se pudo guardar'), 'validation' => $arr_validation));
					exit();
				}
				
				if(isset($persona_id)){
					$this->request->data['RolPersona']['persona_id'] = $persona_id;
				}
	
				//$this->Persona->set($this->request->data);
				//$this->Persona->setFields();
	
				$this->RolPersona->create();
				if ($this->RolPersona->save($this->request->data)) {
					//$persona_id = $this->RolPersona->id;
					//$this->RolPersona->agregarRolPersona($persona_id,$role_id);
					echo json_encode(array('success'=>true,'msg'=>__('Persona fue agregada con &eacute;xito.'),'Persona_id'=>$persona_id));
					exit();
				}else{
					$persona_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Persona->validationErrors));
					exit();
				}
		}else{
			if(isset($persona_id) && isset($persona_nombre)){
				$list_all_roles_missing = $this->Role->listRolesMissing($persona_id);
				//debug($list_all_roles_missing); exit();
				$this->set(compact('persona_nombre', 'list_all_roles_missing'));
			}
			
		}
	}
	
	public function get_persona_row($persona_id){
		$this->layout = 'ajax';
	
		$this->loadModel('Persona');
		$obj_persona = $this->Persona->findById($persona_id);
		$this->set(compact('persona_id','obj_usuario'));
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
	
	public function ajax_list_tipo_documentos(){
		$this->layout = 'ajax';
		$this->loadModel('TipoPersonaDocumento');
	
		if($this->request->is('post') || $this->request->is('put')){
			$tipo_persona_id = $this->request->data['tipo_persona_id'];
			$persona_id = $this->request->data['persona_id_doc'];

			if($persona_id != 0 || $persona_id != ''){
				$obj_persona = $this->Persona->findById($persona_id);
				$this->set(compact('obj_persona'));
			} 
	
			$obj_tipo_documentos = $this->TipoPersonaDocumento->listDocumentosByTipoPersonaId($tipo_persona_id);
		}
		$this->set(compact('obj_tipo_documentos'));
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
	
	/*function validateNroDoc($nro_doc, $tipo_doc_id){
		//if(isset($nro_doc) && isset($tipo_doc)){
			$nro_documento = $nro_doc;
			$tipo_documento_id = $tipo_doc_id;
		
			if($nro_documento == '' || $nro_documento == NULL){
				$nro_documento = '';
			}else{
				$cant_digitos =  strlen($nro_documento);
				if($tipo_documento_id == 1	&&	$cant_digitos != Configure::read('NUM_DIGITOS_DNI')){
					$arr_validation['nro_documento'] = array(__('El DNI debe ser de '.Configure::read('NUM_DIGITOS_DNI').' d&iacute;gitos'));
					$error_validation = true;
				}
		
				if($tipo_documento_id == 2	&&	$cant_digitos != Configure::read('NUM_DIGITOS_CEXT')){
					$arr_validation['nro_documento'] = array(__('El Carnet debe ser de '.Configure::read('NUM_DIGITOS_CEXT').' d&iacute;gitos'));
					$error_validation = true;
				}
		
				if($tipo_documento_id == 3	&&	$cant_digitos != Configure::read('NUM_DIGITOS_RUC')){
					$arr_validation['nro_documento'] = array(__('El DNI debe ser de '.Configure::read('NUM_DIGITOS_RUC').' d&iacute;gitos'));
					$error_validation = true;
				}
			}
		//}
	}*/
}