<?php
App::uses('AppModel','Model');
  class EmailsEnviado extends AppModel {
    public $name = 'EmailsEnviado';


    public $belongsTo = array(
            'Acta' => array(
                    'className' => 'Acta',
                    'foreignKey' => 'acta_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
            )
    );
   
    
  public function listAllEmailsEnviados($order_by='EmailsEnviado.created', $order='DESC') {
    		$arr_obj_emails_enviado = $this->findObjects('all',array(
    				'conditions'=>array(
    								'EmailsEnviado.estado != ' => 0
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_emails_enviado;
    }
    
    public function listFindEmailsEnviados($order_by='EmailsEnviado.created', $order='DESC') {
    		$arr_obj_emails_enviado = $this->findObjects('all',array(
    				'conditions'=>array(
    						'EmailsEnviado.estado != ' => 0
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_emails_enviado;
    }
    
  }
?>