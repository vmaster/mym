<?php
App::uses('AppModel','Model');
  class CategoriaNorma extends AppModel {
    public $name = 'CategoriaNorma';


    public $hasMany = array(
    		'Codigo' => array(
    				'className' => 'Codigo',
    				'foreignKey' => 'categoria_id',
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
    		'descripcion'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La Categor&iacute;a es requerida'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'La Categor&iacute;a ya existe'
    				)
    		)
    );
    
  public function listAllCategoriaNormas($order_by='CategoriaNorma.created', $search_descripcion='',$order='DESC') {
    		$arr_obj_categoria_norma = $this->findObjects('all',array(
    				'conditions'=>array(
    								'CategoriaNorma.descripcion LIKE'=> '%'.$search_descripcion.'%',
    								'CategoriaNorma.estado != ' => 0
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_categoria_norma;
    }
    
    public function listFindCategoriaNormas($order_by='Trabajadore.created', $search_descripcion='',$order='DESC', $start=0, $per_page=10) {
    		$arr_obj_categoria_norma = $this->findObjects('all',array(
    				'conditions'=>array(
    						'CategoriaNorma.descripcion LIKE'=> '%'.$search_descripcion.'%',
    						'CategoriaNorma.estado != ' => 0
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_categoria_norma;
    }
    
    /**
     * Delete actividades
     * @param int $actividad_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteCategoriaNorma($categoria_norma_id){
    
    	if($this->deleteAll(array('CategoriaNorma.id' => $categoria_norma_id), $cascada = true)){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    public function listCategoriaNormas() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','descripcion'),
    					'conditions'=>array(
    							'CategoriaNorma.estado != '=> 0
    					),
    					'order' => array('CategoriaNorma.id ASC')
    			));
    }
    
    public function listAllTipoCategoriaNormas() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','descripcion'),
    					'order' => array('CategoriaNorma.id ASC'),
    			));
    }
    
    
  }
?>
