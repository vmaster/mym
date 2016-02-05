<?php
class EmailsEnviadosController extends AppController{
	public $name = 'EmailsEnviado';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function index($page=null,$order_by=null,$order_by_or=null) {
        
		$this->layout = "default";
		$this->loadModel('EmailsEnviado');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
		

		$order_by = 'EmailsEnviado.created';

		$list_emails_enviado_all = $this->EmailsEnviado->listAllEmailsEnviados($order_by, $order_by_or);
		$list_emails_enviado = $this->EmailsEnviado->listFindEmailsEnviados($order_by,$order_by_or);

		
		$this->set(compact('list_emails_enviado'));
	}

	

	public function delete_emails_enviado(){
		$this->layout = 'ajax';
	
		$this->loadModel('EmailsEnviado');
	
		if($this->request->is('post')){
			$emails_enviado_id = $this->request->data['emails_enviado_id'];
			
			$obj_emails_enviado = $this->EmailsEnviado->findById($emails_enviado_id);
			if($obj_emails_enviado->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
		}
	}
	
}