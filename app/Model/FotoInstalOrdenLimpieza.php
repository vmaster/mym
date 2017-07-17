<?php
App::uses('AppModel','Model');
  class FotoInstalOrdenLimpieza extends AppModel {
    public $name = 'FotoInstalOrdenLimpieza';
    
    public $belongsTo = array(
    		'FotoInstalOrdenLimpieza' => array(
    				'className' => 'FotoInstalOrdenLimpieza',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
  }
?>