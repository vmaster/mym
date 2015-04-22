<?php
App::uses('AppModel','Model');
  class UnidadesMovile extends AppModel {
    public $name = 'UnidadesMovile';

    public $hasMany = array(
    		'UmNormasIncumplida' => array(
    				'className' => 'UmNormasIncumplida',
    				'foreignKey' => 'um_id',
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
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		
    		'Vehiculo' => array(
    				'className' => 'Vehiculo',
    				'foreignKey' => 'vehiculo_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>
