<?php
App::uses('AppModel','Model');
  class FotoMedAmbMedida extends AppModel {
    public $name = 'FotoMedAmbMedida';

    public $belongsTo = array(
    		'ActaMedioAmbiente' => array(
    				'className' => 'ActaMedioAmbiente',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );

  }
?>
