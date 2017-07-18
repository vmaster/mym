<?php
App::uses('AppModel','Model');
  class FotoInstalSshh extends AppModel {
    public $name = 'FotoInstalSshh';
    
    public $belongsTo = array(
    		'FotoInstalSshh' => array(
    				'className' => 'FotoInstalSshh',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>