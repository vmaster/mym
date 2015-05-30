<?php
App::uses('AppModel','Model');
  class FotoAct extends AppModel {
    public $name = 'FotoAct';
    
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
