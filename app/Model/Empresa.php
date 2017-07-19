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
    		),

            'ActaInstalacione' => array(
                    'className' => 'ActaInstalacione',
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

    public function listarCantidadInformexAreaxEmpresa($area_id){
        $arr_obj_det_ni_veh = $this->find('all',array(
                'fields' => array('Empresa.nombre', 'ActaJoin.empresa_id', 'count(ActaJoin.id) as cantidad', 'sum(ActaJoin.total_cumplimiento) as total_cumplimiento', 'sum(ActaJoin.suma_cu_in) as suma_cu_in', 'sum(ActaJoin.cumplimiento) as cumplimiento'),
                'joins' => array(
                        array(
                                'table' => 'actas',
                                'alias' => 'ActaJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'Empresa.id = ActaJoin.empresa_id'
                                )
                        ),
                        array(
                                'table' => 'tipo_lugares',
                                'alias' => 'TipoLugaresJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'TipoLugaresJoin.id = ActaJoin.tipo_lugar_id'
                                )
                        )
                ),
                'conditions'=>array('ActaJoin.estado' => 1, 'ActaJoin.tipo_lugar_id'=> $area_id),
                'group' => array('ActaJoin.empresa_id')
        )
        );
         
        return $arr_obj_det_ni_veh;
    }

    public function listarCantidadInformeEmpresa(){
        $arr_obj_det_ni_veh = $this->find('all',array(
                'fields' => array('Empresa.nombre', 'ActaJoin.empresa_id', 'count(ActaJoin.id) as cantidad', 'sum(ActaJoin.total_cumplimiento) as total_cumplimiento', 'sum(ActaJoin.suma_cu_in) as suma_cu_in', 'sum(ActaJoin.cumplimiento) as cumplimiento'),
                'joins' => array(
                        array(
                                'table' => 'actas',
                                'alias' => 'ActaJoin',
                                'type' => 'INNER',
                                'conditions' => array(
                                        'Empresa.id = ActaJoin.empresa_id'
                                )
                        )
                ),
                'conditions'=>array('ActaJoin.estado' => 1),
                'group' => array('ActaJoin.empresa_id')
        )
        );
         
        return $arr_obj_det_ni_veh;
    }
    
  }
?>
