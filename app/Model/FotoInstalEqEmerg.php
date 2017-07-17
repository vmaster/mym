<?php
App::uses('AppModel','Model');
  class FotoInstalEqEmerg extends AppModel {
    public $name = 'FotoInstalEqEmerg';
    
    public $belongsTo = array(
    		'FotoInstalEqEmerg' => array(
    				'className' => 'FotoInstalEqEmerg',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>
