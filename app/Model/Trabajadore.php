<?php
App::uses('AppModel','Model');
  class Trabajadore extends AppModel {
    public $name = 'Trabajadore';

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
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'reponsable_act_id',
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
    		'ImpProtPersonale' => array(
    				'className' => 'ImpProtPersonale',
    				'foreignKey' => 'trabajador_id',
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
    		'Actividade' => array(
    				'className' => 'Actividade',
    				'foreignKey' => 'actividade_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Empresa' => array(
    				'className' => 'Empresa',
    				'foreignKey' => 'empresa_id',
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
    				/*'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El N&uacute;mero de documento es requerido'
    				),*/
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
    		'apellido_nombre'     => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Nombre del trabajador es requerida'
    				)
    		),
    		/*'apellido'     => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Apellido del trabajador es requerido'
    				)
    		),*/
    		'email' => array(
					'email' => array(
							'rule' =>'email',
							'message' => 'Debe ingresar un email v&aacute;lido',
							'allowEmpty' => true
					)
			)/*,
    		'fec_nac' => array(
    				'rule' => 'date',
    				'message' => 'Ingrese una fecha v&aacute;lida',
    				'allowEmpty' => true
    		)*/
    );
    
    
    public function listAllTrabajadores($order_by='Trabajadore.created', $search_nro_documento='',$search_nombre='',$order='DESC') {
    		$arr_obj_trabajador = $this->findObjects('all',array(
    				'conditions'=>array(
    						'AND' => array(
    								'OR' => array(
    										'Trabajadore.apellido_nombre LIKE'=> '%'.$search_nombre.'%'
    										//'Trabajadore.apellido LIKE'=> '%'.$search_nombre.'%'
    								),
    								'Trabajadore.nro_documento LIKE'=> '%'.$search_nro_documento.'%',
    								'Trabajadore.estado != ' => 0
    						)
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_trabajador;
    }
    
    public function listFindTrabajadores($order_by='Trabajadore.created', $search_nro_documento='',$search_nombre='',$order='DESC', $start=0, $per_page=10) {
    		$arr_obj_trabajador = $this->findObjects('all',array(
    				'conditions'=>array(

    						'AND' => array(
    								'OR' => array(
    										'Trabajadore.apellido_nombre LIKE'=> '%'.$search_nombre.'%'
    										//'Trabajadore.apellido LIKE'=> '%'.$search_nombre.'%'
    								),
    								'Trabajadore.nro_documento LIKE'=> '%'.$search_nro_documento.'%',
    								'Trabajadore.estado != ' => 0
    						)
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_trabajador;
    }
    
    public function listAllPersonal() {
    	return $this->findObjects('all',array(
    			'conditions' => array(
    					'AND' => array(
    					'Trabajadore.id NOT IN (select users.id from users)',
    					'Trabajadore.tipo_trabajador' => 'I'
    							)
    			)/*,
    			'order'=> array('Persona.created ASC'),*/
    		)
    	);
    }
    
    /**
     * Delete trabajador
     * @param int $trabajador_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteTrabajador($trabajador_id){
    	if($this->deleteAll(array('Trabajadore.id' => $trabajador_id), $cascada = true)){
    		return true;
    	}else{
    		return false;
    	}
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
    							'DistritoJoin.id = Trabajadore.distrito_id'
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
    					'fields' => array('Trabajadore.distrito_id','DistritoJoin.provincia_id','ProvinciaJoin.departamento_id'),
    					'conditions' => array('Trabajadore.distrito_id' => $distrito_id),
    			));
    }
    
    public function showTrabajador($trabajador_id='') {
    	return $this->find('first',array('conditions' => array('Trabajadore.id' => $trabajador_id)));
    }
    
    /* Usado para los Combos del Informe*/
    public function listTrabajadores() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','apellido_nombre'),
    					'conditions'=>array(
    							'Trabajadore.estado != '=> 0
    					),
    					'order' => array('Trabajadore.apellido_nombre ASC')
    			));
    }
    
    
  }
?>
