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

            if($user_id != 0){

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
        								'Tarea.user_id' => $user_id,
        								//'tarea.estado != ' => 0
        				),
        				'order'=> array($order_by.' '.$order)
        		)
        		);

            }else{
                $arr_obj_tarea = $this->findObjects('all',array(
                        'joins' => array(
                            array(
                                    'table' => 'users',
                                    'alias' => 'UsuarioJoin',
                                    'type' => 'INNER',
                                    'conditions' => array(
                                            'UsuarioJoin.id = Tarea.user_id',
                                            'DATE(Tarea.created)= DATE(NOW())'
                                    )
                            )
                        ),
                        'order'=> array($order_by.' '.$order)
                )
                );

            }
    	return $arr_obj_tarea;
    }
    
    public function listFindTareas($order_by='Tarea.created', $order='DESC', $start=0, $per_page=10, $user_id=0) {

        if($user_id != 0){
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
    					 	'Tarea.user_id' => $user_id
    						//'tarea.estado != ' => 0
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
        }else{
            $arr_obj_tarea = $this->findObjects('all',array(
                    'joins' => array(
                        array(
                                'table' => 'users',
                                'alias' => 'UsuarioJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'UsuarioJoin.id = Tarea.user_id',
                                        'DATE(Tarea.created)= DATE(NOW())'
                                )
                        )
                    ),
                    //'page'=> $start,
                    'limit'=> $per_page,
                    'offset'=> $start,
                    'order'=> array($order_by.' '.$order),
            )
            );
        }
    	return $arr_obj_tarea;
    }

    public function listTodasTareas($order_by='Tarea.created', $order='DESC', $start=0, $per_page=10) {

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
                    'fields'  => array('Tarea.descripcion','Tarea.created','TrabajadorJoin.apellido_nombre','Tarea.created','Tarea.informe_ref','Tarea.movilidad','Tarea.placa_auto'),
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
                            'Tarea.id' => $tarea_id
                            //'tarea.estado != ' => 0
                    )
               )
        );
        return $arr_obj_tarea;
    }

    public function verficarTareaHoy($user_id) {
        $registro = $this->find('all',array(
                'conditions'=>array(
                        'Tarea.estado' => 1,
                        'Tarea.user_id' => $user_id,
                        'DATE(Tarea.created)= DATE(NOW())'

                )
        )
        );

       //debug("IN MODEL  ".count($registro)); exit();
        
        if(count($registro) > 0){
          return true;
       }else{
          return false;
       }
    }

}
?>