<?php
App::uses('AppModel','Model');
  class ImpProtPersonale extends AppModel {
    public $name = 'ImpProtPersonale';

    public $hasMany = array(
    		'IppNormasIncumplida' => array(
    				'className' => 'IppNormasIncumplida',
    				'foreignKey' => 'ipp_id',
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
    		'Acta' => array(
    				'className' => 'Acta',
    				'foreignKey' => 'acta_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		
    		'Trabajadore' => array(
    				'className' => 'Trabajadore',
    				'foreignKey' => 'trabajador_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		
    		'Actividade' => array(
    				'className' => 'Actividade',
    				'foreignKey' => 'actividad_id',
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
			)
    ); 
    
  }
?>
