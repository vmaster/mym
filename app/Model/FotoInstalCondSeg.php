<?php
App::uses('AppModel','Model');
  class FotoInstalCondSeg extends AppModel {
    public $name = 'FotoInstalCondSeg';
    
    public $belongsTo = array(
    		'FotoInstalCondSeg' => array(
    				'className' => 'FotoInstalCondSeg',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>
