<?php
App::uses('AppModel','Model');
  class CondicionesSubestandare extends AppModel {
    public $name = 'CondicionesSubestandare';
    
    public $belongsTo = array(
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Codigo' => array(
    				'className' => 'Codigo',
    				'foreignKey' => 'codigo_id',
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
    		/*'distrito_id'     => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El distrito es requerido'
    				)
    		),*/
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
    
    
  }
?>
