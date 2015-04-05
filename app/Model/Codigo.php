<?php
App::uses('AppModel','Model');
  class Codigo extends AppModel {
    public $name = 'Codigo';


    public $hasMany = array(
    		'IppNormasIncumplida' => array(
    				'className' => 'IppNormasIncumplida',
    				'foreignKey' => 'codigo_id',
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
    		'UmNormasIncumplida' => array(
    				'className' => 'UmNormasIncumplida',
    				'foreignKey' => 'codigo_id',
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
    				'foreignKey' => 'codigo_id',
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
    				'foreignKey' => 'codigo_id',
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
    
    /*public $belongsTo = array(
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
    );*/
    
    
    public $validate = array(
    		'codigo'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La Codigo es requerido'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'La codigo ya existe'
    				)
    		)
    );
    
    
  public function listAllCodigos($order_by='Codigo.created', $search_codigo='',$order='DESC') {
    		$arr_obj_codigo = $this->findObjects('all',array(
    				'conditions'=>array(
    								'Codigo.codigo LIKE'=> '%'.$search_codigo.'%',
    								'Codigo.estado != ' => 0
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_codigo;
    }
    
    public function listFindCodigos($order_by='Trabajadore.created', $search_codigo='',$order='DESC', $start=0, $per_page=10) {
    		$arr_obj_codigo = $this->findObjects('all',array(
    				'conditions'=>array(
    						'Codigo.codigo LIKE'=> '%'.$search_codigo.'%',
    						'Codigo.estado != ' => 0
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_codigo;
    }
    
    /* Usado para ...*/    
    public function listCodigos() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','codigo'),
    					'conditions'=>array(
    							'Codigo.estado != '=> 0
    					),
    					'order' => array('Codigo.codigo ASC')
    			));
    }
    
    /**
     * Delete actividades
     * @param int $actividad_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteCodigo($codigo_id){
    
    	if($this->deleteAll(array('Codigo.id' => $codigo_id), $cascada = true)){
    		return true;
    	}else{
    		return false;
    	}
    }
    
  }
?>
