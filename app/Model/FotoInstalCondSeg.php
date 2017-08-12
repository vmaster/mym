<?php
App::uses('AppModel','Model');
  class FotoInstalCondSeg extends AppModel {
    public $name = 'FotoInstalCondSeg';
    
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
