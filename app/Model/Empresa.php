<?php
App::uses('AppModel','Model');
  class Empresa extends AppModel {
    public $name = 'Empresa';


    public $hasMany = array(
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'empresa_id',
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
    		'nombre'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La Empresa es requerido'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'La empresa ya existe'
    				)
    		)
    );
    
    
  public function listAllEmpresas($order_by='Empresa.created', $search_nombre='',$order='DESC') {
    		$arr_obj_empresa = $this->findObjects('all',array(
    				'conditions'=>array(
    								'Empresa.nombre LIKE'=> '%'.$search_nombre.'%',
    								'Empresa.estado != ' => 0
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_empresa;
    }
    
    public function listFindEmpresas($order_by='Trabajadore.created', $search_nombre='',$order='DESC', $start=0, $per_page=10) {
    		$arr_obj_empresa = $this->findObjects('all',array(
    				'conditions'=>array(
    						'Empresa.nombre LIKE'=> '%'.$search_nombre.'%',
    						'Empresa.estado != ' => 0
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_empresa;
    }
    
    /* Usado para el Combo del mantenimiento de trabajadores*/    
    public function listEmpresas() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','nombre'),
    					'conditions'=>array(
    							'Empresa.estado != '=> 0
    					),
    					'order' => array('Empresa.id ASC')
    			));
    }
    
    /**
     * Delete actividades
     * @param int $actividad_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteEmpresa($empresa_id){
    
    	if($this->deleteAll(array('Empresa.id' => $empresa_id), $cascada = true)){
    		return true;
    	}else{
    		return false;
    	}
    }
    
  }
?>
