<?php
App::uses('AppModel','Model');
  class FotoSupervisionActa extends AppModel {
    public $name = 'FotoSupervisionActa';
    
    public $belongsTo = array(
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>