<?php
App::uses('AppModel','Model');
  class FotoInstalMed extends AppModel {
    public $name = 'FotoInstalMed';

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
