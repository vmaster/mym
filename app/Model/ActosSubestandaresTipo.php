<?php
App::uses('AppModel','Model');
  class ActosSubestandaresTipo extends AppModel {
    public $name = 'ActosSubestandaresTipo';


    /*public $hasMany = array(
    		'ActosSubestandare' => array(
    				'className' => 'ActosSubestandare',
    				'foreignKey' => 'tipo_acto_sub_id',
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
    );*/
    
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
    
    
    /*public $validate = array(
    		'descripcion'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Tipo Veh&iacute;culo es requerido'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'El Tipo Veh&iacute;culo ya existe'
    				)
    		)
    );
    
  public function listAllTipoVehiculos($order_by='TipoVehiculo.created', $search_descripcion='',$order='DESC') {
    		$arr_obj_tipo_vehiculo = $this->findObjects('all',array(
    				'conditions'=>array(
    								'TipoVehiculo.descripcion LIKE'=> '%'.$search_descripcion.'%',
    								'TipoVehiculo.estado != ' => 0
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_tipo_vehiculo;
    }
    
    public function listFindTipoVehiculos($order_by='Trabajadore.created', $search_descripcion='',$order='DESC', $start=0, $per_page=10) {
    		$arr_obj_tipo_vehiculo = $this->findObjects('all',array(
    				'conditions'=>array(
    						'TipoVehiculo.descripcion LIKE'=> '%'.$search_descripcion.'%',
    						'TipoVehiculo.estado != ' => 0
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_tipo_vehiculo;
    }*/
    
    /**
     * Delete actividades
     * @param int $actividad_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    /*public function deleteTipoVehiculo($tipo_vehiculo_id){
    
    	if($this->deleteAll(array('TipoVehiculo.id' => $tipo_vehiculo_id), $cascada = true)){
    		return true;
    	}else{
    		return false;
    	}
    }*/
    
    public function listTipoActosSubEstandares() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','descripcion'),
    					'conditions'=>array(
    							'ActosSubestandaresTipo.estado != '=> 0
    					),
    					'order' => array('ActosSubestandaresTipo.descripcion ASC')
    			));
    }
    
    /*public function listAllTipoTipoVehiculos() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','descripcion'),
    					'order' => array('TipoVehiculo.id ASC'),
    			));
    }*/
    
    
  }
?>
