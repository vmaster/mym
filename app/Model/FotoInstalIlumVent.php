<?php
App::uses('AppModel','Model');
  class FotoInstalIlumVent extends AppModel {
    public $name = 'FotoInstalIlumVent';
    
    public $belongsTo = array(
    		'ActaInstalacione' => array(
    				'className' => 'ActaInstalacione',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>
