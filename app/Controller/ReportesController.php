<?php
class ReportesController extends AppController{
	public $name = 'Reporte';
	
	
	public function rpt_cant_empresas(/*$order_by=null,$order_by_or=null,$search_descripcion=null*/) {
		$this->layout = "default";
		$this->loadModel('Acta');

		/*if($this->request->is('get')){
			if($search_descripcion!=''){
				$search_descripcion = $search_descripcion;
			}else{
				$search_descripcion = '';
			}

		}else{
			$search_descripcion = '';
		}*/
		
		$list_sep_emp = $this->Acta->listSupervisionByEmpresa();
		
		$this->set(compact('list_sep_emp'));
	}
	
	public function rpt_cant_normas_incumplidas() {
		$this->layout = "default";
		$this->loadModel('Acta');
	
		/*if($this->request->is('get')){
		 if($search_descripcion!=''){
		$search_descripcion = $search_descripcion;
		}else{
		$search_descripcion = '';
		}
	
		}else{
		$search_descripcion = '';
		}*/
	
		$list_sep_emp = $this->Acta->listSupervisionByEmpresa();
	
		$this->set(compact('list_sep_emp'));
	}
	
	public function prueba_data(){
		$this->loadModel('Acta');
		//$this->layout = 'ajax';
		$this->autoRender = false;
		
		$list_sep_emp = $this->Acta->listSupervisionByEmpresa();
		foreach ($list_sep_emp as $key => $arr_emp):
			$x[] = $arr_emp['EmpresaJoin']['nombre'];
			$y[] = intval($arr_emp[0]['Cantidad']);
		endforeach;
		return json_encode(array('success'=>true,'categoria'=>$x, 'name'=>'Empresa', 'data'=>$y));
		//exit();
	}
	
	public function find_actividades($order_by=null,$order_by_or=null,$search_descripcion=null) {
		$this->layout = 'ajax';
		$this->loadModel('Persona');

		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'Actividade.created';
	
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
			if($search_descripcion == 'null'){
				$search_descripcion = '';
			}else{
				$search_descripcion = $search_descripcion;
			}
	
		}else{
			$search_descripcion = '';
		}
		/*
		 $this->paginate = array('conditions'=>array($select_by .' LIKE "%'. $search .'%"'),'limit'=>15, 'order' => array($order_by => 'desc'));
		$seo_journals = $this->paginate('Journal');
		$this->set('seo_journals',$seo_journals);
		*/
		$list_actividad = $this->Actividade->listFindActividade($order_by, utf8_encode($search_descripcion),$order_by_or);
		$this->set(compact('list_actividad'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 20 March 2013
	 * @author Vladimir
	 */
	public function add_edit_actividad($actividad_id=null){
		$this->layout = 'ajax';
		$this->loadModel('Actividade');
		
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($actividad_id) && intval($actividad_id) > 0){
				
				//update
				
				$this->Actividade->id = $actividad_id;
	
				if ($this->Actividade->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'Actividade_id'=>$actividad_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Actividade->validationErrors));
					exit();
				}
			}else{
				//insert
	
				$this->Actividade->create();
				if ($this->Actividade->save($this->request->data)) {
					$actividad_id = $this->Actividade->id;
					echo json_encode(array('success'=>true,'msg'=>__('La Actividad fue agregada con &eacute;xito.'),'Actividade_id'=>$actividad_id));
					exit();
				}else{
					$actividad_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Actividade->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($actividad_id)){
				$obj_actividad = $this->Actividade->findById($actividad_id);
				
				$this->request->data = $obj_actividad->data;
				$this->set(compact('actividad_id','obj_actividad'));
			}
		}
	
	}
	
	
	public function delete_actividad(){
		$this->layout = 'ajax';
		
		$this->loadModel('Actividade');
		
		if($this->request->is('post')){
			$actividad_id = $this->request->data['actividad_id'];
			
			$obj_actividad = $this->Actividade->findById($actividad_id);
			if($obj_actividad->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->Actividade->deleteActividad($actividad_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();*/
		}
		
		
	}
	
	public function get_actividad_row($actividad_id){
		$this->layout = 'ajax';
	
		$this->loadModel('Actividade');
		$obj_actividad = $this->Persona->findById($persona_id);
		$this->set(compact('actividad_id','obj_actividad'));
	}

}