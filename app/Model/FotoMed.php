<?php
App::uses('AppModel','Model');
  class FotoMed extends AppModel {
    public $name = 'FotoMed';

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
