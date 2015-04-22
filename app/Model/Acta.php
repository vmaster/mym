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
    		),
    		'FotoIpp' => array(
    				'className' => 'FotoIpp',
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
    		'FotoUm' => array(
    				'className' => 'FotoUm',
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
    		'FotoSd' => array(
    				'className' => 'FotoSd',
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
    		'FotoAc' => array(
    				'className' => 'FotoAc',
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
    		),
    		'UnidadesNegocio' => array(
    				'className' => 'UnidadesNegocio',
    				'foreignKey' => 'uunn_id',
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
    
    public function sendReporteEmail($acta_id, $email_destino, $num_informe, $mensaje){
    	App::uses('CakeEmail', 'Network/Email');
    	
    	$Email = new CakeEmail('mym');
    	$Email->from(array('informes@mym-iceperu.com' => 'M&M'));
    	$Email->emailFormat('html');
    	$Email->template('informe','send_informe');
    	$Email->viewVars(array('acta_id' => $acta_id,'num_informe'=> $num_informe, 'mensaje'=> $mensaje));
    	$Email->to($email_destino);
    	$Email->subject(utf8_encode('Informe N� ').$num_informe);
    	$Email->send('Mi Mensaje');
    }
    
   
    /* Usado para el Combo de Acta en Registrar Acta*/
    public function listActas() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','numero'),
    					'conditions'=>array(
    							'Acta.estado != '=> 0
    					),
    					'order' => array('Acta.numero ASC')
    			));
    }
    
    /* Usado para Contar los informes del d�a */
    public function TotalActasPorDia() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','numero'),
    					'conditions'=>array(
    							'Acta.fecha' => date('Y-m-d'), 
    							'Acta.estado != '=> 0
    					),
    					'order' => array('Acta.numero ASC')
    			));
    }
    
    /* CONSULTAS PARA LOS REPORTES */
    
    public function listSupervisionByEmpresa(/*$order_by='Actividade.created', $search_actividad='',$order='DESC', $start=0, $per_page=10*/) {
    	$arr_obj_sup_emp = $this->find('all',array(
    			'fields' => array('EmpresaJoin.nombre, count(*) as Cantidad'),
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
    
    public function listTotalNormasByTrabajador(/*$order_by='Actividade.created', $search_actividad='',$order='DESC', $start=0, $per_page=10*/) {
    	$arr_obj_sup_emp = $this->find('all',array(
    			'fields' => array('EmpresaJoin.nombre, count(*) as Cantidad'),
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
