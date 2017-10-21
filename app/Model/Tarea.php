<?php

App::uses('AppModel','Model');

	class Tarea extends AppModel{
		public $name = 'Tarea';

    public $belongsTo = array(
    		'User' => array(
    				'className' => 'User',
    				'foreignKey' => 'user_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
    
    /*public $validate = array(
    		'descripcion'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'Las actividades son requeridas'
    				)
    		)
    );*/
    
    
   public function listAllTareas($order_by='Tarea.created',$order='DESC', $user_id=0) {
    		$arr_obj_tarea = $this->findObjects('all',array(
    				'joins' => array(
    					array(
    							'table' => 'users',
    							'alias' => 'UsuarioJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UsuarioJoin.id = Tarea.user_id',
    							)
    					)
    				),
    				'conditions'=>array(
    								'tarea.user_id' => $user_id
    								//'tarea.estado != ' => 0
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_tarea;
    }
    
    public function listFindTareas($order_by='Tarea.created', $order='DESC', $start=0, $per_page=10, $user_id=0) {
    		$arr_obj_tarea = $this->findObjects('all',array(
    				'joins' => array(
    					array(
    							'table' => 'users',
    							'alias' => 'UsuarioJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UsuarioJoin.id = Tarea.user_id',
    							)
    					)
    				),
    				'conditions'=>array(
    					 	'tarea.user_id' => $user_id
    						//'tarea.estado != ' => 0
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_tarea;
    }
}
?>