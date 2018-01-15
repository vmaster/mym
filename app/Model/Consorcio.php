<?php
App::uses('AppModel','Model');
  class Consorcio extends AppModel {
    public $name = 'Consorcio';

    public $hasMany = array(
    		'User' => array(
    				'className' => 'User',
    				'foreignKey' => 'consorcio_id',
    				'dependent' => false,
    				'conditions' => '',
    				'fields' => '',
    				'order' => '',
    				'limit' => '',
    				'offset' => '',
    				'exclusive' => '',
    				'finderQuery' => '',
    				'counterQuery' => ''
    		),
            'Acta' => array(
                    'className' => 'Acta',
                    'foreignKey' => 'consorcio_id',
                    'dependent' => false,
                    'conditions' => '',
                    'fields' => '',
                    'order' => '',
                    'limit' => '',
                    'offset' => '',
                    'exclusive' => '',
                    'finderQuery' => '',
                    'counterQuery' => ''
            )
    );
    
    public function listConsorcios() {
    	return $this->findObjects('all');
    }
    
  }
?>
