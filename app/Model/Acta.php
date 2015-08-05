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
    		'FotoAct' => array(
    				'className' => 'FotoAct',
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
    		'FotoCond' => array(
    				'className' => 'FotoCond',
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
    		'FotoDoc' => array(
    				'className' => 'FotoDoc',
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
    		'FotoMed' => array(
    				'className' => 'FotoMed',
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
    		),
    		'TipoLugare' => array(
    				'className' => 'TipoLugare',
    				'foreignKey' => 'tipo_lugar_id',
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
    				'rule' => array('datetime'),
    				'message' => 'Ingrese fecha y hora v&aacute;lida',
    				'allowEmpty' => true
    		),
    		'sector' => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Sector es requerido'
    				)
    		),
    		'lugar' => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Lugar es requerido'
    				)
    		),
    		'uunn_id' => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La UUNN es requerida'
    				)
    		),
    		'nro_trabajadores' => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La N&uacute;mero de trabajadores es requerido'
    				)
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
    
    public function sendReporteEmail($acta_id, $email_destino, $email_copia, $num_informe, $asunto, $mensaje){
    	App::uses('CakeEmail', 'Network/Email');
    	$Email = new CakeEmail('mym');
    	$Email->from(array('informes@mym-iceperu.com' => 'M&M'));
    	$Email->emailFormat('html');
    	$Email->template('informe','send_informe');
    	$Email->viewVars(array('acta_id' => $acta_id,'num_informe'=> $num_informe, 'mensaje'=> $mensaje));
    	$Email->to($email_destino);
    	if($email_copia != ''){
    		$Email->cc($email_copia);
    	}
    	$Email->subject($asunto);
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
    
    /* Usado para Contar los informes del día */
    public function listUltimosInformes() {
    	return $this->findObjects('all',
    			array(
    					'order' => array('Acta.created DESC'),
    					'limit' => 5
    				)
    			);
    }
    
    /* Usado para contar los informes enviados */
    public function listInformesEnviados(){
    	return $this->find('list',
    			array(
    					'conditions'=>array(
    							'Acta.fecha_envio != '=> NULL
    					)
    			));
    }
    
    /* Usado para contar los informes Pendientes */
    public function listInformesPendientes(){
    	return $this->find('list',
    			array(
    					'conditions'=>array(
    							'OR' => array( 
    								'Acta.info_des_conclusion '=> '',
    								'Acta.info_des_rec '=> '',
    							)
    					)
    			));
    }
    
    /* CONSULTAS PARA LOS REPORTES */
    
    public function listSupervisionByEmpresa($fec_inicio, $fec_fin) {
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
    			'conditions'=>array(
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			),
    	/*'order'=> array($order_by.' '.$order),*/
    			'group'=> array('EmpresaJoin.nombre')
    	)
    	);
    	 
    	//debug($arr_obj_sup_emp);exit();
    	return $arr_obj_sup_emp;
    }
    
    
    public function listDetalleSupervisionByEmpresa($fec_inicio, $fec_fin) {
    	$arr_obj_det_sup_emp = $this->findObjects('all',array(
    			/*'fields' => array('EmpresaJoin.nombre, Acta.fecha, Num'),*/
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
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			),
    			'order'=> array('EmpresaJoin.nombre')
    			/*'group'=> array('EmpresaJoin.nombre')*/
    	)
    	);
    
    	//debug($arr_obj_sup_emp);exit();
    	return $arr_obj_det_sup_emp;
    }
    
    
    public function listSupervisionByUuNn($fec_inicio, $fec_fin) {
    	$arr_obj_sup_uunn = $this->find('all',array(
    			'fields' => array('UnidadesNegocioJoin.descripcion, count(*) as Cantidad'),
    			'joins' => array(
    					array(
    							'table' => 'unidades_negocios',
    							'alias' => 'UnidadesNegocioJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UnidadesNegocioJoin.id = Acta.uunn_id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			),
    			/*'order'=> array($order_by.' '.$order),*/
    			'group'=> array('UnidadesNegocioJoin.descripcion')
    	)
    	);
    
    	//debug($arr_obj_sup_emp);exit();
    	return $arr_obj_sup_uunn;
    }
    
    public function listDetalleSupervisionByUuNn($fec_inicio, $fec_fin) {
    	$arr_obj_det_sup_uunn = $this->findObjects('all',array(
    			'joins' => array(
    					array(
    							'table' => 'unidades_negocios',
    							'alias' => 'UnidadesNegocioJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UnidadesNegocioJoin.id = Acta.uunn_id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			),
    			'order'=> array('UnidadesNegocioJoin.descripcion'),
    			//'group'=> array('UnidadesNegocioJoin.descripcion')
    	)
    	);
    
    	return $arr_obj_det_sup_uunn;
    }
    
    
    public function listNiByEmpresaTrabajador($fec_inicio, $fec_fin) {
    	$arr_obj_ni_emp = $this->find('all',array(
    			'fields' => array('EmpresasJoin.id, EmpresasJoin.nombre, count(*) as Cantidad'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'imp_prot_personales',
    							'alias' => 'ImpProtPersonalesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'ImpProtPersonalesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'ipp_normas_incumplidas',
    							'alias' => 'IppNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'IppNormasIncumplidasJoin.ipp_id = ImpProtPersonalesJoin.id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			),
    			/*'order'=> array($order_by.' '.$order),*/
    			'group'=> array('EmpresasJoin.nombre')
    	)
    	);
    	return $arr_obj_ni_emp;
    }
    
    public function listNiByTrabajador($empresa_id, $fec_inicio, $fec_fin) {
    	$arr_obj_ni_tra = $this->find('all',array(
    			'fields' => array('TrabajadorJoin.apellido_nombre, count(*) as Cantidad'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'imp_prot_personales',
    							'alias' => 'ImpProtPersonalesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'ImpProtPersonalesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'ipp_normas_incumplidas',
    							'alias' => 'IppNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'IppNormasIncumplidasJoin.ipp_id = ImpProtPersonalesJoin.id'
    							)
    					),
    					array(
    							'table' => 'trabajadores',
    							'alias' => 'TrabajadorJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'TrabajadorJoin.id = ImpProtPersonalesJoin.trabajador_id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'AND' => array(
    							'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin),
    							'Acta.empresa_id'=> $empresa_id
    							)
    			),
    			/*'order'=> array($order_by.' '.$order),*/
    			'group'=> array('TrabajadorJoin.apellido_nombre')
    	)
    	);
    	return $arr_obj_ni_tra;
    }
    
    public function listDetalleNiByEmpresaTrabajador($fec_inicio, $fec_fin) {
    	$arr_obj_ni_emp = $this->find('all',array(
    			'fields' => array('EmpresasJoin.nombre, TrabajadorJoin.apellido_nombre, CodigosJoin.codigo, Acta.num_informe, Acta.fecha'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'imp_prot_personales',
    							'alias' => 'ImpProtPersonalesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'ImpProtPersonalesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'trabajadores',
    							'alias' => 'TrabajadorJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'TrabajadorJoin.id = ImpProtPersonalesJoin.trabajador_id'
    							)
    					),
    					array(
    							'table' => 'ipp_normas_incumplidas',
    							'alias' => 'IppNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'IppNormasIncumplidasJoin.ipp_id = ImpProtPersonalesJoin.id'
    							)
    					),
    					array(
    							'table' => 'codigos',
    							'alias' => 'CodigosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CodigosJoin.id = IppNormasIncumplidasJoin.codigo_id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			)
    			/*'order'=> array($order_by.' '.$order),*/
    			//'group'=> array('EmpresasJoin.nombre')
    	)
    	);
    	return $arr_obj_ni_emp;
    }
    
    
    public function listNiByEmpresaVehiculo($fec_inicio, $fec_fin) {
    	$arr_obj_ni_emp = $this->find('all',array(
    			'fields' => array('EmpresasJoin.id, EmpresasJoin.nombre, count(*) as Cantidad'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'unidades_moviles',
    							'alias' => 'UnidadesMovilesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UnidadesMovilesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'um_normas_incumplidas',
    							'alias' => 'UmNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UmNormasIncumplidasJoin.um_id = UnidadesMovilesJoin.id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			),
    			/*'order'=> array($order_by.' '.$order),*/
    			'group'=> array('EmpresasJoin.nombre')
    	)
    	);
    	return $arr_obj_ni_emp;
    }
    
    public function listNiByVehiculo($empresa_id, $fec_inicio, $fec_fin) {
    	$arr_obj_ni_veh = $this->find('all',array(
    			'fields' => array('VehiculoJoin.nro_placa, count(*) as Cantidad'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'unidades_moviles',
    							'alias' => 'UnidadesMovilesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UnidadesMovilesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'um_normas_incumplidas',
    							'alias' => 'UmNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UmNormasIncumplidasJoin.um_id = UnidadesMovilesJoin.id'
    							)
    					),
    					array(
    							'table' => 'vehiculos',
    							'alias' => 'VehiculoJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'VehiculoJoin.id = UnidadesMovilesJoin.vehiculo_id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'AND' => array(
    							'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin),
    							'Acta.empresa_id'=> $empresa_id
    					)
    			),
    			/*'order'=> array($order_by.' '.$order),*/
    			'group'=> array('VehiculoJoin.nro_placa')
    	)
    	);
    	return $arr_obj_ni_veh;
    }
    
    public function listDetalleNiByEmpresaVehiculo($fec_inicio, $fec_fin) {
    	$arr_obj_ni_emp = $this->find('all',array(
    			'fields' => array('EmpresasJoin.nombre, VehiculosJoin.nro_placa, CodigosJoin.codigo, Acta.num_informe, Acta.fecha'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'unidades_moviles',
    							'alias' => 'UnidadesMovilesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UnidadesMovilesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'vehiculos',
    							'alias' => 'VehiculosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'VehiculosJoin.id = UnidadesMovilesJoin.vehiculo_id'
    							)
    					),
    					array(
    							'table' => 'um_normas_incumplidas',
    							'alias' => 'UmNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UmNormasIncumplidasJoin.um_id = UnidadesMovilesJoin.id'
    							)
    					),
    					array(
    							'table' => 'codigos',
    							'alias' => 'CodigosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CodigosJoin.id = UmNormasIncumplidasJoin.codigo_id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			)
    			/*'order'=> array($order_by.' '.$order),*/
    			//'group'=> array('EmpresasJoin.nombre')
    	)
    	);
    	return $arr_obj_ni_emp;
    }
    
    /* NORMAS INCUMPLIDAS POR EMPRESA */
    public function listNiByEmpresa1($fec_inicio, $fec_fin, $empresa_id) {
    	$arr_obj_ni_emp1 = $this->find('all',array(
    			'fields' => array('IppNormasIncumplidasJoin.codigo_id, CodigosJoin.codigo, count(*) as Cantidad'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'imp_prot_personales',
    							'alias' => 'ImpProtPersonalesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'ImpProtPersonalesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'trabajadores',
    							'alias' => 'TrabajadorJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'TrabajadorJoin.id = ImpProtPersonalesJoin.trabajador_id'
    							)
    					),
    					array(
    							'table' => 'ipp_normas_incumplidas',
    							'alias' => 'IppNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'IppNormasIncumplidasJoin.ipp_id = ImpProtPersonalesJoin.id'
    							)
    					),
    					array(
    							'table' => 'codigos',
    							'alias' => 'CodigosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CodigosJoin.id = IppNormasIncumplidasJoin.codigo_id',
    							)
    					)
    			),
    			'conditions'=>array(
    					'AND' => array(
    							'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin),
    							'Acta.empresa_id' => $empresa_id
    					)
    			),
    			'order'=> array('Cantidad DESC'),
    			'group'=> array('IppNormasIncumplidasJoin.codigo_id')
    	)
    	);
    
    	//debug($arr_obj_sup_emp);exit();
    	return $arr_obj_ni_emp1;
    }
    
    public function listNiByEmpresa2($fec_inicio, $fec_fin, $empresa_id) {
    	$arr_obj_ni_emp2 = $this->find('all',array(
    			'fields' => array('CodigosJoin.codigo, count(*) as Cantidad'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'unidades_moviles',
    							'alias' => 'UnidadesMovilesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UnidadesMovilesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'vehiculos',
    							'alias' => 'VehiculosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'VehiculosJoin.id = UnidadesMovilesJoin.vehiculo_id'
    							)
    					),
    					array(
    							'table' => 'um_normas_incumplidas',
    							'alias' => 'UmNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UmNormasIncumplidasJoin.um_id = UnidadesMovilesJoin.id'
    							)
    					),
    					array(
    							'table' => 'codigos',
    							'alias' => 'CodigosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CodigosJoin.id = UmNormasIncumplidasJoin.codigo_id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'AND' => array(
    							'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin),
    							'Acta.empresa_id' => $empresa_id
    					)
    			),
    			'order'=> array('Cantidad DESC'),
    			'group'=> array('CodigosJoin.codigo')
    	)
    	);
    
    	return $arr_obj_ni_emp2;
    }
    
    public function listDetalleNiByEmpresa1($fec_inicio, $fec_fin, $empresa_id) {
    	$arr_obj_det_ni_emp = $this->find('all',array(
    			'fields' => array('TrabajadorJoin.apellido_nombre, CodigosJoin.codigo, Acta.num_informe, Acta.fecha'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'imp_prot_personales',
    							'alias' => 'ImpProtPersonalesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'ImpProtPersonalesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'trabajadores',
    							'alias' => 'TrabajadorJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'TrabajadorJoin.id = ImpProtPersonalesJoin.trabajador_id'
    							)
    					),
    					array(
    							'table' => 'ipp_normas_incumplidas',
    							'alias' => 'IppNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'IppNormasIncumplidasJoin.ipp_id = ImpProtPersonalesJoin.id'
    							)
    					),
    					array(
    							'table' => 'codigos',
    							'alias' => 'CodigosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CodigosJoin.id = IppNormasIncumplidasJoin.codigo_id',
    							)
    					)
    			),
    			'conditions'=>array(
    					'AND' => array(
    							'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin),
    							'Acta.empresa_id' => $empresa_id
    					)
    			),
    			'order by'=> array('CodigosJoin.codigo ASC')
    	)
    	);
    
    	return $arr_obj_det_ni_emp;
    }
    
    public function listDetalleNiByEmpresa2($fec_inicio, $fec_fin, $empresa_id) {
    	$arr_obj_det_ni_emp = $this->find('all',array(
    			'fields' => array('VehiculosJoin.nro_placa, CodigosJoin.codigo, Acta.num_informe, Acta.fecha'),
    			'joins' => array(
    					array(
    							'table' => 'empresas',
    							'alias' => 'EmpresasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'EmpresasJoin.id = Acta.empresa_id'
    							)
    					),
    					array(
    							'table' => 'unidades_moviles',
    							'alias' => 'UnidadesMovilesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UnidadesMovilesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'vehiculos',
    							'alias' => 'VehiculosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'VehiculosJoin.id = UnidadesMovilesJoin.vehiculo_id'
    							)
    					),
    					array(
    							'table' => 'um_normas_incumplidas',
    							'alias' => 'UmNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UmNormasIncumplidasJoin.um_id = UnidadesMovilesJoin.id'
    							)
    					),
    					array(
    							'table' => 'codigos',
    							'alias' => 'CodigosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CodigosJoin.id = UmNormasIncumplidasJoin.codigo_id'
    							)
    					)
    			),
    			'conditions'=>array(
    					'AND' => array(
    							'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin),
    							'Acta.empresa_id' => $empresa_id
    					)
    			),
    			'order by'=> array('CodigosJoin.codigo ASC')
    	)
    	);
    
    	return $arr_obj_det_ni_emp;
    }
    
    
    
    public function getEmpresaMayorNi() {
    	$tmp_array = (array) $this->query('
			SELECT count(*) as cantidad, E.nombre,((count(*) + 
    			(SELECT  count(*) from actas INNER JOIN empresas on actas.empresa_id = empresas.id INNER JOIN imp_prot_personales IPP on IPP.acta_id = actas.id INNER JOIN ipp_normas_incumplidas INI on INI.ipp_id = IPP.id WHERE actas.empresa_id=A.empresa_id))
    			/(SELECT count(*) as totalacta FROM actas WHERE actas.empresa_id = A.empresa_id)) as promedio from actas A INNER JOIN empresas E on A.empresa_id = E.id INNER JOIN unidades_moviles UM on UM.acta_id = A.id INNER JOIN um_normas_incumplidas UNI on UNI.um_id = UM.id GROUP BY A.empresa_id order by promedio desc limit 1');
    		 
    		return $tmp_array;
    }
    
    public function getTrabajadorMayorNi() {
    	$tmp_array = (array) $this->query('
			SELECT count(*) as cantidad, T.apellido_nombre,(count(*) /(SELECT count(*) as totalacta FROM imp_prot_personales WHERE imp_prot_personales.trabajador_id = T.id)) 
    			as promedio FROM actas A INNER JOIN imp_prot_personales IPP on IPP.acta_id = A.id INNER JOIN trabajadores T on T.id = IPP.trabajador_id  INNER JOIN ipp_normas_incumplidas INI on INI.ipp_id = IPP.id GROUP BY IPP.trabajador_id order by promedio desc limit 1');
    	 
    	return $tmp_array;
    }
    
    
    /*REPORTE DE CUMPLIMIENTOS*/
    public function listCumplimientoByEmpresa($fec_inicio, $fec_fin) {
    	$arr_obj_sup_emp = $this->find('all',array(
    			'fields' => array('EmpresaJoin.nombre, AVG(cumplimiento) as Porcentaje'),
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
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			),
    			/*'order'=> array($order_by.' '.$order),*/
    			'group'=> array('EmpresaJoin.nombre')
    	)
    	);
    
    	//debug($arr_obj_sup_emp);exit();
    	return $arr_obj_sup_emp;
    }
    
    
    public function listDetalleCumplimientoByEmpresa($fec_inicio, $fec_fin) {
    	$arr_obj_det_sup_emp = $this->findObjects('all',array(
    			/*'fields' => array('EmpresaJoin.nombre, Acta.fecha, Num'),*/
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
    					'Acta.fecha BETWEEN ? and ?'=>array($fec_inicio, $fec_fin)
    			),
    			'order'=> array('EmpresaJoin.nombre')
    			/*'group'=> array('EmpresaJoin.nombre')*/
    	)
    	);
    
    	//debug($arr_obj_sup_emp);exit();
    	return $arr_obj_det_sup_emp;
    }
    
    
    /* Detalle de las Ni para el View Informe*/
    public function infoNiT($acta_id){
    	$arr_obj_det_ni_trab = $this->find('all',array(
    			'fields' => array('CodigosJoin.codigo', 'CodigosJoin.observacion', 'CategoriaNormasJoin.descripcion'),
    			'joins' => array(
    					array(
    							'table' => 'imp_prot_personales',
    							'alias' => 'ImpProtPersonalesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'ImpProtPersonalesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'trabajadores',
    							'alias' => 'TrabajadorJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'TrabajadorJoin.id = ImpProtPersonalesJoin.trabajador_id'
    							)
    					),
    					array(
    							'table' => 'ipp_normas_incumplidas',
    							'alias' => 'IppNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'IppNormasIncumplidasJoin.ipp_id = ImpProtPersonalesJoin.id'
    							)
    					),
    					array(
    							'table' => 'codigos',
    							'alias' => 'CodigosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CodigosJoin.id = IppNormasIncumplidasJoin.codigo_id',
    							)
    					),
    					array(
    							'table' => 'categoria_normas',
    							'alias' => 'CategoriaNormasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CategoriaNormasJoin.id = CodigosJoin.categoria_id'
    							)
    					)    				
    			),
    			'conditions'=>array('Acta.id' => $acta_id),
    			'group' => array('CodigosJoin.codigo', 'CodigosJoin.observacion', 'CategoriaNormasJoin.descripcion')
    	)
    	);
    	
    	return $arr_obj_det_ni_trab;
    }
    
    
    public function infoNiV($acta_id){
    	$arr_obj_det_ni_veh = $this->find('all',array(
    			'fields' => array('CodigosJoin.codigo', 'CodigosJoin.observacion', 'CategoriaNormasJoin.descripcion'),
    			'joins' => array(
    					array(
    							'table' => 'unidades_moviles',
    							'alias' => 'UnidadesMovilesJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UnidadesMovilesJoin.acta_id = Acta.id'
    							)
    					),
    					array(
    							'table' => 'um_normas_incumplidas',
    							'alias' => 'UmNormasIncumplidasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'UmNormasIncumplidasJoin.um_id = UnidadesMovilesJoin.id'
    							)
    					),
    					array(
    							'table' => 'codigos',
    							'alias' => 'CodigosJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CodigosJoin.id = UmNormasIncumplidasJoin.codigo_id'
    							)
    					),
    					array(
    							'table' => 'categoria_normas',
    							'alias' => 'CategoriaNormasJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'CategoriaNormasJoin.id = CodigosJoin.categoria_id'
    							)
    					)
    			),
    			'conditions'=>array('Acta.id' => $acta_id),
    			'group' => array('CodigosJoin.codigo', 'CodigosJoin.observacion', 'CategoriaNormasJoin.descripcion')
    	)
    	);
    	 
    	return $arr_obj_det_ni_veh;
    }
    
  }
?>
