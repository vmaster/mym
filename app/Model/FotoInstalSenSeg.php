<?php
App::uses('AppModel','Model');
  class FotoInstalSenSeg extends AppModel {
    public $name = 'FotoInstalSenSeg';
    
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