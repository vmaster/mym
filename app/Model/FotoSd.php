<?php
App::uses('AppModel','Model');
  class FotoSd extends AppModel {
    public $name = 'FotoSd';


    /*public $hasMany = array(
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
    );*/
    
    public $belongsTo = array(
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
    
    /*public $validate = array(
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
    );*/
    
    
    
  
    
  }
?>
