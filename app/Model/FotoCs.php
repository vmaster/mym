<?php
App::uses('AppModel','Model');
  class FotoCs extends AppModel {
    public $name = 'FotoCs';

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
