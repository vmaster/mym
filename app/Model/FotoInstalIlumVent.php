<?php
App::uses('AppModel','Model');
  class FotoInstalIlumVent extends AppModel {
    public $name = 'FotoInstalIlumVent';
    
    public $belongsTo = array(
    		'FotoInstalIlumVent' => array(
    				'className' => 'FotoInstalIlumVent',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>
