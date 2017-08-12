<?php
App::uses('AppModel','Model');
  class FotoInstalSshh extends AppModel {
    public $name = 'FotoInstalSshh';
    
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