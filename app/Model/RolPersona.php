<?php
App::uses('AppModel','Model');
  class RolPersona extends AppModel {
    public $name = 'RolPersona';

    public $belongsTo = array(
    		'Role' => array(
    				'className' => 'Role',
    				'foreignKey' => 'role_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Persona' => array(
    				'className' => 'Persona',
    				'foreignKey' => 'persona_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
    public function agregarRolPersona($persona_id, $role_id){
    	
    	$this->create();
    	$this->data['RolPersona']['persona_id'] = $persona_id;
    	$this->data['RolPersona']['role_id'] = $role_id;
    	
    	if(!$this->save()){
    		return false;
    	}
    	
    	return true;
    }
    
    public function listAllRoles($order_by='RolPersona.id', $order='DESC', $persona_id=0) {
    		$arr_obj_persona = $this->findObjects('all',array(
    				'joins' => array(
    						array(
    								'table' => 'roles',
    								'alias' => 'RolesJoin',
    								'type' => 'INNER',
    								'conditions' => array(
    										'RolesJoin.role_id = RolPersona.id'
    								)
    						)
    				),
    				'conditions'=>array(
    								'RolPersona.persona_id'=> $persona_id,
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	
    	return $arr_obj_persona;
    }
    
    public function listFindRoles($order_by='RolPersona.id', $order='DESC', $persona_id=0) {
    		$arr_obj_persona = $this->findObjects('all',array(
    				'joins' => array(
    						array(
    								'table' => 'roles',
    								'alias' => 'RolesJoin',
    								'type' => 'INNER',
    								'conditions' => array(
    										'RolesJoin.id = RolPersona.role_id'
    								)
    						)
    				),
    				'conditions'=>array(
    								'RolPersona.persona_id'=> $persona_id,
    				),
    				//'page'=> $start,
    				//'limit'=> $per_page,
    				//'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_persona;
    }
  }
?>
