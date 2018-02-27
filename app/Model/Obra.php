<?php
App::uses('AppModel','Model');
  class Obra extends AppModel {
    public $name = 'Obra';

    public $belongsTo = array(
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );

  }
?>
