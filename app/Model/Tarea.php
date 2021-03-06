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
                    'fields'  => array('Tarea.descripcion','Tarea.created','TrabajadorJoin.apellido_nombre','Tarea.created','Tarea.informe_ref','Tarea.movilidad','Tarea.placa_auto','Tarea.dia_libre','Tarea.observacion','ChoferJoin.apellido_nombre', 'UsuarioJoin.uunn_id'),
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
                        ),
                        array(
                                'table' => 'trabajadores',
                                'alias' => 'ChoferJoin',
                                'type' => 'LEFT',
                                'conditions' => array(
                                        'ChoferJoin.id = Tarea.trabajador_id',
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

    public function listCamionetaAsesor($fec_inicio, $fec_fin, $asesor_id='%%%') {
        $arr_obj_camionetas_asesor = $this->find('all',array(
                'fields' => array('TrabajadorJoin.apellido_nombre, count(*) as Cantidad'),
                'joins' => array(
                        array(
                                'table' => 'trabajadores',
                                'alias' => 'TrabajadorJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'TrabajadorJoin.id = Tarea.user_id',
                                )
                        ),
                ),
                'conditions'=>array(
                        //'Tarea.estado' => 1,
                        'Tarea.movilidad' => 1,
                        'Tarea.user_id like' => $asesor_id,
                        'Tarea.created BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
                ),
                'group'=> array('Tarea.user_id'),
                'order' => array('Cantidad'=>'desc')
        )
        );
        //debug($arr_obj_camionetas_asesor); exit();
        return $arr_obj_camionetas_asesor;
    }

    public function listDetalleCamionetaAsesor($fec_inicio, $fec_fin, $asesor_id='%%%') {
            $arr_obj_camionetas_asesor = $this->findObjects('all',array(
                'joins' => array(
                        array(
                                'table' => 'trabajadores',
                                'alias' => 'TrabajadorJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'TrabajadorJoin.id = Tarea.user_id',
                                )
                        ),
                ),
                'conditions'=>array(
                        //'Tarea.estado' => 1,
                        'Tarea.movilidad' => 1,
                        'Tarea.user_id like' => $asesor_id,
                        'Tarea.created BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
                )
        )
        );
        //debug($arr_obj_camionetas_asesor); exit();
        return $arr_obj_camionetas_asesor;
    }

    public function listAsesores() {
            $arr_obj_asesores = $this->findObjects('all',array(
                'group'=> array('Tarea.user_id')
        )
        );
        //debug($arr_obj_asesores); exit();
        return $arr_obj_asesores;
    }

	
	public function listViaticoAsesor($fec_inicio, $fec_fin, $asesor_id='%%%') {
        $arr_obj_viaticos_asesor = $this->find('all',array(
                'fields' => array('TrabajadorJoin.apellido_nombre, count(*) as Cantidad'),
                'joins' => array(
                        array(
                                'table' => 'trabajadores',
                                'alias' => 'TrabajadorJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'TrabajadorJoin.id = Tarea.user_id',
                                )
                        ),
                ),
                'conditions'=>array(
                        //'Tarea.estado' => 1,
                        'Tarea.movilidad' => 0,
                        'Tarea.user_id like' => $asesor_id,
                        'Tarea.created BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
                ),
                'group'=> array('Tarea.user_id'),
                'order' => array('Cantidad'=>'desc')
        )
        );
        //debug($arr_obj_viaticos_asesor); exit();
        return $arr_obj_viaticos_asesor;
    }

    public function listDetalleViaticoAsesor($fec_inicio, $fec_fin, $asesor_id='%%%') {
            $arr_obj_viaticos_asesor = $this->findObjects('all',array(
                'joins' => array(
                        array(
                                'table' => 'trabajadores',
                                'alias' => 'TrabajadorJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'TrabajadorJoin.id = Tarea.user_id',
                                )
                        ),
                ),
                'conditions'=>array(
                        //'Tarea.estado' => 1,
                        'Tarea.movilidad' => 0,
                        'Tarea.user_id like' => $asesor_id,
                        'Tarea.created BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
                )
        )
        );
        //debug($arr_obj_viaticos_asesor); exit();
        return $arr_obj_viaticos_asesor;
    }
}
?>