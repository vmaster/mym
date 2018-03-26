<?php
App::uses('AppModel','Model');
  class UnidadesNegocio extends AppModel {
    public $name = 'UnidadesNegocio';


    public $hasMany = array(
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'uunn_id',
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
            'User' => array(
                    'className' => 'User',
                    'foreignKey' => 'uunn_id',
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
			'Consorcio' => array(
    				'className' => 'Consorcio',
    				'foreignKey' => 'consorcio_id',
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

    public $validate = array(
    		'descripcion'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La Unidad de Negocia es requerida'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'La Unidad de Negocia ya existe'
    				)
    		)
    );
    
    
    
  public function listAllUnidadesNegocios($order_by='UnidadesNegocio.created', $search_descripcion='',$order='DESC') {
    		$arr_obj_unidades_negocio = $this->findObjects('all',array(
    				'conditions'=>array(
    						'AND' => array(
    								'UnidadesNegocio.descripcion LIKE'=> '%'.$search_descripcion.'%',
    								'UnidadesNegocio.estado != ' => 0
    						)
    				),
    				'order'=> array($order_by.' '.$order)
    		)
    		);
    	return $arr_obj_unidades_negocio;
    }
    
    public function listFindUnidadesNegocios($order_by='UnidadesNegocio.created', $search_descripcion='',$order='DESC', $start=0, $per_page=10) {
    		$arr_obj_unidades_negocio = $this->findObjects('all',array(
    				'conditions'=>array(
    						'AND' => array(
    								'UnidadesNegocio.descripcion LIKE'=> '%'.$search_descripcion.'%',
    								'UnidadesNegocio.estado != ' => 0
    						)
    				),
    				//'page'=> $start,
    				'limit'=> $per_page,
    				'offset'=> $start,
    				'order'=> array($order_by.' '.$order),
    		)
    		);
    	return $arr_obj_unidades_negocio;
    }
    
    /**
     * Delete actividades
     * @param int $actividad_id
     * @return boolean
     * @author Vladimir
     * @version 16 Marzo 2015
     */
    public function deleteUnidadesNegocio($unidades_negocio_id){
    	if($this->deleteAll(array('UnidadesNegocio.id' => $unidades_negocio_id), $cascada = true)){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    /* Usado para el Combo en el registro de Acta*/
    public function listUnidadesNegocios($consorcio_id = 1) {
    	return $this->find('list',
    			array(
    					'fields' => array('id','descripcion'),
    					'conditions'=>array(
    							'UnidadesNegocio.estado != '=> 0,
								'UnidadesNegocio.consorcio_id'=> $consorcio_id
    					),
    					'order' => array('UnidadesNegocio.descripcion ASC')
    			));
    }



    /* USARIO EN EL REGISTRO DE USUARIO */
    public function listUunn() {
        return $this->findObjects('all');
    }


    public function listUunnsByConsorcioId($consorcio_id='') {
        return $this->find('list',
                array(
                        'fields' => array('id','descripcion'),
                        'conditions' => array('UnidadesNegocio.consorcio_id' => $consorcio_id),
                        'order' => array('UnidadesNegocio.descripcion ASC'),
                ));
    }
    
    
  }
?>
