<?php
App::uses('AppModel','Model');
  class Vehiculo extends AppModel {
    public $name = 'Vehiculo';


    public $hasMany = array(
    		'UnidadesMovile' => array(
    				'className' => 'UnidadesMovile',
    				'foreignKey' => 'vehiculo_id',
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
    
    public $belongsTo = array(
    		'TipoVehiculo' => array(
    				'className' => 'TipoVehiculo',
    				'foreignKey' => 'tipo_vehiculo_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
    
    public $validate = array(
    		'nro_placa'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El n&uacute;mero Veh&iacute;culo es requerido'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'La Placa del Veh&iacute;culo ya existe'
    				)
    		)
    );
    
    
    
  public function listAllVehiculos($order_by='Vehiculo.created', $search_nroplaca='', $search_nrosoat='',$order='DESC') {
    		$arr_obj_vehiculo = $this->findObjects('all',array(
    				'conditions'=>array(
    						'AND' => array(
    								'Vehiculo.nro_placa LIKE'=> '%'.$search_nroplaca.'%',
    								'Vehiculo.nro_soat LIKE'=> '%'.$search_nrosoat.'%',
    								'Vehiculo.estado != ' => 0
    						)
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_vehiculo;
    }
    
    public function listFindVehiculos($order_by='Trabajadore.created', $search_nroplaca='', $search_nrosoat='',$order='DESC', $start=0, $per_page=10) {
    		$arr_obj_vehiculo = $this->findObjects('all',array(
    				'conditions'=>array(
    						'AND' => array(
    								'Vehiculo.nro_placa LIKE'=> '%'.$search_nroplaca.'%',
    								'Vehiculo.nro_soat LIKE'=> '%'.$search_nrosoat.'%',
    								'Vehiculo.estado != ' => 0
    						)
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_vehiculo;
    }
    
    /**
     * Delete actividades
     * @param int $actividad_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteVehiculo($vehiculo_id){
    	if($this->deleteAll(array('Vehiculo.id' => $vehiculo_id), $cascada = true)){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    public function listVehiculos() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','nro_placa'),
    					'conditions'=>array(
    							'Vehiculo.estado != '=> 0
    					),
    					'order' => array('Vehiculo.nro_placa ASC')
    			));
    }
    
    public function listCodigos() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','codigo'),
    					'conditions'=>array(
    							'Codigo.estado != '=> 0
    					),
    					'order' => array('Codigo.codigo ASC')
    			));
    }
    
  }
?>
