<?php
App::uses('AppModel','Model');
  class TipoPersona extends AppModel {
    public $name = 'TipoPersona';
    
    public $hasMany = array(
    		'Persona' => array(
    				'className' => 'Persona',
    				'foreignKey' => 'tipo_persona_id',
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
    
    /*public function listAllTipoPersonas() {
    	return $this->findObjects('all');
    }*/
    
    public function listAllTipoPersonas() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','descripcion'),
    					'order' => array('TipoPersona.id ASC'),
    			));
    }
  }
?>
