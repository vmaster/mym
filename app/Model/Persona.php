<?php
App::uses('AppModel','Model');
  class Persona extends AppModel {
    public $name = 'Persona';

    public $hasOne = array(
    		/*'PersonaGenerale' => array(
    				'className'    => 'PersonaGenerale',
    				'foreignKey' => 'id',
    				'fields' => '',
    				'order' => ''
    				//'dependent'    => true
    		),
    		'PersonaRuc' => array(
    				'className'    => 'PersonaRuc',
    				'foreignKey' => 'id',
    				'fields' => '',
    				'order' => ''
    				//'dependent'    => true
    		)*/
    );
    
    public $hasMany = array(
    		'RolPersona' => array(
    				'className' => 'RolPersona',
    				'foreignKey' => 'persona_id',
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
    		),
    		'Distrito' => array(
    				'className' => 'Distrito',
    				'foreignKey' => 'distrito_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
    
    public $validate = array(
    		'nro_documento'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El N&uacute;mero de documento es requerido'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'El N&uacute;mero de documento ya existe'
    				),
    				'numeric' => array(
    						'rule' => array('numeric'),
    						'message' => 'El documento debe ser de tipo num&eacute;rico'
    				)
    		),
    		'distrito_id'     => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El distrito es requerido'
    				)
    		),
    		'nombre'     => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Nombre de la persona es requerida'
    				)
    		),
    		'apellido'     => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Apellido de la persona es requerida'
    				)
    		),
    		'email' => array(
					'email' => array(
							'rule' =>'email',
							'message' => 'Debe ingresar un email v&aacute;lido',
							'allowEmpty' => true
					)
			),
    		'fec_nac' => array(
    				'rule' => 'date',
    				'message' => 'Ingrese una fecha v&aacute;lida',
    				'allowEmpty' => true
    		)
    );
    
    
    public function listAllPersonas($order_by='Persona.created', $search_nro_documento='',$search_nombre='',$search_tipo_persona=0, $order='DESC') {
    	if($search_tipo_persona == 0){
    		$arr_obj_persona = $this->findObjects('all',array(
    				'conditions'=>array(
    						'AND' => array(
    								'OR' => array(
    										'Persona.nombre LIKE'=> '%'.$search_nombre.'%',
    										'Persona.apellido LIKE'=> '%'.$search_nombre.'%'
    								),
    								'Persona.nro_documento LIKE'=> '%'.$search_nro_documento.'%',
    								'Persona.estado != ' => 0
    						)
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	}else{
    		$arr_obj_persona = $this->findObjects('all',array(
    				'conditions'=>array(
    						'AND' => array(
    								'OR' => array(
    										'Persona.nombre LIKE'=> '%'.$search_nombre.'%',
    										'Persona.apellido LIKE'=> '%'.$search_nombre.'%'
    								),
    								'Persona.nro_documento LIKE'=> '%'.$search_nro_documento.'%',
    								'Persona.tipo_persona_id' => $search_tipo_persona,
    								'Persona.estado != ' => 0
    						)
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	}
    	return $arr_obj_persona;
    }
    
    public function listFindPersonas($order_by='Persona.created', $search_nro_documento='',$search_nombre='',$search_tipo_persona=0, $order='DESC', $start=0, $per_page=10) {
    	//debug($search_tipo_persona); 
    	if($search_tipo_persona == 0){
    		$arr_obj_persona = $this->findObjects('all',array(
    				'conditions'=>array(

    						'AND' => array(
    								'OR' => array(
    										'Persona.nombre LIKE'=> '%'.$search_nombre.'%',
    										'Persona.apellido LIKE'=> '%'.$search_nombre.'%'
    								),
    								'Persona.nro_documento LIKE'=> '%'.$search_nro_documento.'%',
    								'Persona.estado != ' => 0
    						)
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	}else{
    		$arr_obj_persona = $this->findObjects('all',array(
    				'conditions'=>array(
    		
    						'AND' => array(
    								'OR' => array(
    										'Persona.nombre LIKE'=> '%'.$search_nombre.'%',
    										'Persona.apellido LIKE'=> '%'.$search_nombre.'%'
    								),
    								'Persona.nro_documento LIKE'=> '%'.$search_nro_documento.'%',
    								'Persona.tipo_persona_id' => $search_tipo_persona,
    								'Persona.estado != ' => 0
    						)
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	}
    	return $arr_obj_persona;
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
    
    public function existsNroDoc($nro_doc){
    
    	$result = $this->find('first',array(
    			'conditions'=> array(
    					'User.nro_documento'=>$nro_doc
    			)
    	)
    	);
    	return $result ? true : false;
    }
    
    public function showDistritoByUser($distrito_id='') {
    	return $this->find('list',
    			array(
    					'joins' => array(
    					array(
    							'table' => 'distritos',
    							'alias' => 'DistritoJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    							'DistritoJoin.id = Persona.distrito_id'
    						)
    					),
    					 array(
    					 		'table' => 'provincias',
    					 		'alias' => 'ProvinciaJoin',
    					 		'type' => 'INNER',
    					 		'conditions' => array(
    					 				'ProvinciaJoin.id = DistritoJoin.provincia_id'
    					 		)
    					 ),
    							array(
    									'table' => 'departamentos',
    									'alias' => 'DepartamentoJoin',
    									'type' => 'INNER',
    									'conditions' => array(
    											'DepartamentoJoin.id = ProvinciaJoin.departamento_id'
    									)
    							)
    					),
    					'fields' => array('Persona.distrito_id','DistritoJoin.provincia_id','ProvinciaJoin.departamento_id'),
    					'conditions' => array('Persona.distrito_id' => $distrito_id),
    			));
    }
    
    
  }
?>
