<?php
App::uses('AppModel','Model');
  class Actividade extends AppModel {
    public $name = 'Actividade';


    public $hasMany = array(
    		'Trabajadore' => array(
    				'className' => 'Trabajadore',
    				'foreignKey' => 'actividade_id',
    				'dependent' => false,
    				'conditions' => '',
    				'fields' => '',
    				'order' => '',
    				'limit' => '',
    				'offset' => '',
    				'exclusive' => '',
    				'finderQuery' => '',
    				'counterQuery' => ''
    		),
    		'ImpProtPersonale' => array(
    				'className' => 'ImpProtPersonale',
    				'foreignKey' => 'actividad_id',
    				'dependent' => false,
    				'conditions' => '',
    				'fields' => '',
    				'order' => '',
    				'limit' => '',
    				'offset' => '',
    				'exclusive' => '',
    				'finderQuery' => '',
    				'counterQuery' => ''
    		)
    );
    
    /*public $belongsTo = array(
    		'TipoPersona' => array(
    				'className' => 'TipoPersona',
    				'foreignKey' => 'tipo_persona_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		
    		'TipoDocumento' => array(
    				'className' => 'TipoDocumento',
    				'foreignKey' => 'tipo_documento_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Distrito' => array(
    				'className' => 'Distrito',
    				'foreignKey' => 'distrito_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );*/
    
    
    public $validate = array(
    		'descripcion'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El cargo es requerido'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'El cargo ya existe'
    				)
    		)
    );
    
    
    public function listAllActividades($order_by='Actividade.created', $search_actividad='',$order='DESC') {
    	$arr_obj_actividade = $this->findObjects('all',array(
    			'conditions'=>array(
    					'Actividade.descripcion LIKE'=> '%'.$search_actividad.'%',
    					'Actividade.estado != ' => 0
    			),
    			'order'=> array($order_by.' '.$order)
    	)
    	);
    	return $arr_obj_actividade;
    }
    
    public function listFindActividade($order_by='Actividade.created', $search_actividad='',$order='DESC', $start=0, $per_page=10) {
    		$arr_obj_actividade = $this->findObjects('all',array(
    				'conditions'=>array(
    						'Actividade.descripcion LIKE'=> '%'.$search_actividad.'%',
    						'Actividade.estado != ' => 0
    				),
    				//'page'=> $start,
    				//'limit'=> $per_page,
    				//'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_actividade;
    }
    
    /**
     * Delete actividades
     * @param int $actividad_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteActividad($actividad_id){
    
    	if($this->deleteAll(array('Actividade.id' => $actividad_id), $cascada = true)){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    public function listActividades() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','descripcion'),
    					'conditions'=>array(
    							'Actividade.estado != '=> 0
    					),
    					'order' => array('Actividade.descripcion ASC')
    			));
    }
    
    
    public function ExistActividad($nombre_actividad='') {
    	$arr_obj_actividad = $this->findObjects('all',array(
    			'conditions'=>array(
    					'Actividade.descripcion' => $nombre_actividad
    			)
    	)
    	);
    	
    	return $arr_obj_actividad ? true : false;
    }
    
    
  }
?>
