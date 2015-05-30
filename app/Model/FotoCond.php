<?php
App::uses('AppModel','Model');
  class FotoCond extends AppModel {
    public $name = 'FotoCond';

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
