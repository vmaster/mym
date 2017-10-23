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


    public function obtenerActividades($tarea_id){
        $arr_obj_tarea = $this->find('all',array(
                    'fields'  => array('Tarea.descripcion','Tarea.created','TrabajadorJoin.apellido_nombre',),
                    'joins' => array(
                        array(
                                'table' => 'users',
                                'alias' => 'UsuarioJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'UsuarioJoin.id = Tarea.user_id',
                                )
                        ),
                        array(
                                'table' => 'trabajadores',
                                'alias' => 'TrabajadorJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'TrabajadorJoin.id = UsuarioJoin.id',
                                )
                        )
                    ),
                    'conditions'=>array(
                            'tarea.id' => $tarea_id
                            //'tarea.estado != ' => 0
                    )
               )
        );
        return $arr_obj_tarea;
    }

    public function verficarTareaHoy($user_id) {
        $registro = $this->find('all',array(
                'conditions'=>array(
                        'Acta.estado' => 1,
                        'Acta.user_id' => user_id,
                        'DATE(Acta.fecha)= DATE(NOW())'

                ),
                'group'=> array('EmpresaJoin.nombre'),
                'order' => array('Cantidad'=>'desc')
        )
        );

       //debug("hola  ".count($registro));
        
        if(count($registro) > 0){
          return true;
       }else{
          return false;
       }
    }
}
?>