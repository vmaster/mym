<?php
App::uses('AppModel','Model');
  class FotoMedAmbDoc extends AppModel {
    public $name = 'FotoMedAmbDoc';
    
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