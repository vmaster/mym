<?php
App::uses('AppModel','Model');
  class Role extends AppModel {
    public $name = 'Role';

    public $hasMany = array(
    		'RolPersona' => array(
    				'className' => 'RolPersona',
    				'foreignKey' => 'role_id',
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
    
    public function listRoles() {
    	return $this->findObjects('all');
    }
    
    public function listRolesMissing($persona_id) {
    	return $this->findObjects('all',array(
    			'conditions' => array(
    							'Role.id NOT IN (select rol_personas.role_id from rol_personas WHERE rol_personas.persona_id='.$persona_id.')'
    			)/*,
    			'order'=> array('Persona.created ASC'),*/
    		)
    	);
    }
    
  }
?>
