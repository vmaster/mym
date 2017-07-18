<?php
App::uses('AppModel','Model');
  class FotoInstalSenSeg extends AppModel {
    public $name = 'FotoInstalSenSeg';
    
    public $belongsTo = array(
    		'FotoInstalSenSeg' => array(
    				'className' => 'FotoInstalSenSeg',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>