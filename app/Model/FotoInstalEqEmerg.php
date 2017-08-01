<?php
App::uses('AppModel','Model');
  class FotoInstalEqEmerg extends AppModel {
    public $name = 'FotoInstalEqEmerg';
    
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
