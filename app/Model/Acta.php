<?php
App::uses('AppModel','Model');
  class Acta extends AppModel {
    public $name = 'Acta';

    public $hasMany = array(
    		'ImpProtPersonale' => array(
    				'className' => 'ImpProtPersonale',
    				'foreignKey' => 'acta_id',
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
    		'UnidadesMovile' => array(
    				'className' => 'UnidadesMovile',
    				'foreignKey' => 'acta_id',
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
    		'ActosSubestandare' => array(
    				'className' => 'ActosSubestandare',
    				'foreignKey' => 'acta_id',
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
    		'CondicionesSubestandare' => array(
    				'className' => 'CondicionesSubestandare',
    				'foreignKey' => 'acta_id',
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
    		'CierreActa' => array(
    				'className' => 'CierreActa',
    				'foreignKey' => 'acta_id',
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
    		'Trabajadore1' => array(
    				'className' => 'Trabajadore',
    				'foreignKey' => 'reponsable_act_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Trabajadore2' => array(
    				'className' => 'Trabajadore',
    				'foreignKey' => 'reponsable_sup_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Trabajadore3' => array(
    				'className' => 'Trabajadore',
    				'foreignKey' => 'reponsable_corr_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Trabajadore4' => array(
    				'className' => 'Trabajadore',
    				'foreignKey' => 'reponsable_sup_corr_id',
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
    		)
    );
    
    
    public $validate = array(
    		'actividad'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La Actividad es requerida'
    				)
    		),
    		'obra'     => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Nombre de la Obra es requerida'
    				)
    		),
    		'empresa_id'     => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La Empresa es requerida'
    				)
    		),
    		'fecha' => array(
    				'rule' => 'date',
    				'message' => 'Ingrese una fecha v&aacute;lida',
    				'allowEmpty' => true
    		)
    );
    
    
    public function listAllActas($order_by='Acta.created', $search_nro='',$search_actividad='',$search_empresa='',$search_obra='',$order='DESC') {
    		$arr_obj_acta = $this->findObjects('all',array(
    				'joins' => array(
    						array(
    								'table' => 'empresas',
    								'alias' => 'EmpresaJoin',
    								'type' => 'INNER',
    								'conditions' => array(
    										'EmpresaJoin.id = Acta.empresa_id'
    								)
    						)
    				),
    				'conditions'=>array(
    						'AND' => array(
    								'Acta.numero LIKE'=> '%'.$search_nro.'%',
    								'Acta.actividad LIKE'=> '%'.$search_actividad.'%',
    								'EmpresaJoin.nombre LIKE'=> '%'.$search_empresa.'%',
    								'Acta.obra LIKE'=> '%'.$search_obra.'%',
    						)
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_acta;
    }
    
    public function listFindActas($order_by='Acta.created', $search_nro='',$search_actividad='',$search_empresa='',$search_obra='',$order='DESC', $start=0, $per_page=10) {
    		$arr_obj_acta = $this->findObjects('all',array(
    				'joins' => array(
    						array(
    								'table' => 'empresas',
    								'alias' => 'EmpresaJoin',
    								'type' => 'INNER',
    								'conditions' => array(
    										'EmpresaJoin.id = Acta.empresa_id'
    								)
    						)
    				),
    				'conditions'=>array(
    						'AND' => array(
    								'Acta.numero LIKE'=> '%'.$search_nro.'%',
    								'Acta.actividad LIKE'=> '%'.$search_actividad.'%',
    								'EmpresaJoin.nombre LIKE'=> '%'.$search_empresa.'%',
    								'Acta.obra LIKE'=> '%'.$search_obra.'%',
    						)
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_acta;
    }
    
    public function listAllPersonal() {
    	return $this->findObjects('all',array(
    			'conditions' => array(
    					'AND' => array(
    					'Acta.id NOT IN (select users.id from users)',
    					'Acta.tipo_acta' => 'I'
    							)
    			)/*,
    			'order'=> array('Persona.created ASC'),*/
    		)
    	);
    }
    
    /**
     * Delete acta
     * @param int $acta_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteActa($acta_id){
    	if($this->deleteAll(array('Acta.id' => $acta_id), $cascada = true)){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    public function listActas() {
    	return $this->find('all');
    }
    
    
  }
?>
