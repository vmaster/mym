<?php
App::uses('AppModel','Model');
  class TipoPersonaDocumento extends AppModel {
    public $name = 'TipoPersonaDocumento';
    
    public $belongsTo = array(
    		'TipoPersona' => array(
    				'className' => 'TipoPersona',
    				'foreignKey' => 'tipo_persona_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'TipoDocumento' => array(
    				'className' => 'TipoDocumento',
    				'foreignKey' => 'tipo_documento_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
    public function listDocumentosByTipoPersonaId($tipo_persona_id='') {
    	return $this->findObjects('all',array(
    			'joins' => array(
    					array(
    							'table' => 'tipo_personas',
    							'alias' => 'TipoPersonaJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'TipoPersonaJoin.id = TipoPersonaDocumento.tipo_persona_id'
    							)
    					),
    					array(
    							'table' => 'tipo_documentos',
    							'alias' => 'TipoDocumentoJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'TipoDocumentoJoin.id = TipoPersonaDocumento.tipo_documento_id'
    							)
    					)
    			),
    			'conditions' => array(
    					'AND' => array(
    							'TipoPersonaDocumento.tipo_persona_id' => $tipo_persona_id
    					)
    			)/*,
    			'order'=> array('Persona.created ASC'),*/
    	)
    	);
    }
    
    public function listAllPersonal() {
    	return $this->findObjects('all',array(
    			'joins' => array(
    					array(
    							'table' => 'rol_personas',
    							'alias' => 'RolPersonaJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'RolPersonaJoin.persona_id = Persona.id'
    							)
    					),
    					array(
    							'table' => 'persona_naturales',
    							'alias' => 'PersonaNaturaleJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'PersonaNaturaleJoin.id = Persona.id'
    							)
    					)
    			),
    			'conditions' => array(
    					'AND' => array(
    							'RolPersonaJoin.rol_id = 2',
    							'Persona.id NOT IN (select user.id from users)'
    					)
    			)/*,
    			'order'=> array('Persona.created ASC'),*/
    	)
    	);
    }
  }
?>