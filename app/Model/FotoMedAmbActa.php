<?php
App::uses('AppModel','Model');
  class FotoMedAmbActa extends AppModel {
    public $name = 'FotoMedAmbActa';
    
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