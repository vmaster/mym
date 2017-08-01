<?php
App::uses('AppModel','Model');
  class FotoInstalOrdenLimpieza extends AppModel {
    public $name = 'FotoInstalOrdenLimpieza';
    
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