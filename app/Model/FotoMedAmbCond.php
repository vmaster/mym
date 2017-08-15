<?php
App::uses('AppModel','Model');
  class FotoMedAmbCond extends AppModel {
    public $name = 'FotoMedAmbCond';
    
    public $belongsTo = array(
    		'ActaMedioAmbiente' => array(
    				'className' => 'ActaMedioAmbiente',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>