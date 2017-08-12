<?php
App::uses('AppModel','Model');
  class FotoInstalActInsSeg extends AppModel {
    public $name = 'FotoInstalActInsSeg';
    
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