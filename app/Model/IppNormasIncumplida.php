<?php
App::uses('AppModel','Model');
  class IppNormasIncumplida extends AppModel {
    public $name = 'IppNormasIncumplida';


    public $belongsTo = array(
    		'ImpProtPersonale' => array(
    				'className' => 'ImpProtPersonale',
    				'foreignKey' => 'ipp_id',
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
    
    
    public function listTotalNormasByTrabajador() {
    	$arr_obj_nom_trab = $this->find('all',array(
    			'fields' => array('EmpresaJoin.nombre, count(*) as Cantidad'),
    			'joins' => array(
    					array(
    							'table' => 'imp_prot_personales',
    							'alias' => 'ImpProtPersonaleJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'ImpProtPersonaleJoin.id = IppNormasIncumplida.ipp_id'
    							)
    					)
    			),
    			/*'conditions'=>array(
    			 	
    					//'Actividade.descripcion LIKE'=> '%'.$search_actividad.'%',
    					//'Actividade.estado != ' => 0
    			)/*,
    	'order'=> array($order_by.' '.$order),*/
    			'group'=> array('EmpresaJoin.nombre')
    	)
    	);
    
    	//debug($arr_obj_sup_emp);exit();
    	return $arr_obj_sup_emp;
    }
    
    
    
    
    
  }
?>
