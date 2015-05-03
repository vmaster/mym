<?php
App::uses('AppModel','Model');
  class TipoLugare extends AppModel {
    public $name = 'TipoLugare';


    public $hasMany = array(
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'tipo_lugar_id',
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
    
    public function listTipoLugares() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','descripcion'),
    					'conditions'=>array(
    							'TipoLugare.estado != '=> 0
    					),
    					'order' => array('TipoLugare.descripcion ASC')
    			));
    }
    
    
  }
?>
