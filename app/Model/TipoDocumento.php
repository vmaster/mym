<?php
App::uses('AppModel','Model');
  class TipoDocumento extends AppModel {
    public $name = 'TipoDocumento';
    
    public $hasMany = array(
    		'Persona' => array(
    				'className' => 'Persona',
    				'foreignKey' => 'tipo_documento_id',
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
    
    public function listAllTipoDocumentos() {
    	return $this->find('all');
    }
    
  }
?>
