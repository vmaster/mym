<?php
App::uses('AppModel','Model');
  class User extends AppModel {
    public $name = 'User';
    //public $displayField = 'nombre_usuario';
    
    //public $virtualFields = array('captcha' => 0);
    
    function beforeFilter() {
    	/*$this->Auth->authenticate = ClassRegistry::init('User');*/
    	parent::beforeFilter();
    }
    
    public $belongsTo = array(
    		'TipoUsuario' => array(
    				'className' => 'TipoUsuario',
    				'foreignKey' => 'tipo_user_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
			'Consorcio' => array(
    				'className' => 'Consorcio',
    				'foreignKey' => 'consorcio_id',
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
    
    public $hasOne = array(
    		'Trabajadore' => array(
    				'className'    => 'Trabajadore',
    				'foreignKey' => 'id',
    				'fields' => '',
    				'order' => ''
    				//'dependent'    => true
    		)
    );

    public $validate = array(
        'username'    => array(
            'required' => array(
                'rule' => array('notEmpty','isUnique'),
                'message' => 'Nombre de usuario es requerido'
            )
        ),
        'password'     => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La clave es requerida'
            )
        )
    );
    
    public function beforeSave($options = array()) {
    
    	/* password hashing */
    	if (isset($this->data[$this->alias]['password'])) {
    		$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    	}
    	return true;
    }
    
    
    public function listAllUsers($order_by='User.created', $search_username='',$order='DESC') {
    	$arr_obj_user = $this->findObjects('all',array(
    			'conditions'=>array(
    					'AND' => array(
    							'User.username LIKE'=> '%'.$search_username.'%',
    							'User.estado != ' => 0
    					)
    			),
    			'order'=> array($order_by.' '.$order)
    	)
    	);
    	return $arr_obj_user;
    }
    
    public function listFindUsers($order_by='User.estado', $search_username='',$order='DESC', $start=0, $per_page=10) {
    	$arr_obj_user = $this->findObjects('all',array(
    			'conditions'=>array(
    					'AND' => array(
    							'User.username LIKE'=> '%'.$search_username.'%',
    							//'User.estado != ' => 0
    					)
    			),
    			//'page'=> $start,
    			'limit'=> $per_page,
    			'offset'=> $start,
    			'order'=> array('User.estado DESC'),
    	)
    	);
    	return $arr_obj_user;
    }
    
    /* Contar los usuarios usado para el Dashboard */
    public function TotalUsuarios() {
    	return $this->find('list',
    			array(
    					/*'fields' => array('id','username'),*/
    					'conditions'=>array(
    							'User.estado != '=> 0
    					),
    					'order' => array('User.username ASC')
    			));
    }
    
    /**
     * Delete users
     * @param int $user_id
     * @return boolean
     * @author Vladimir
     * @version 17 Marzo 2015
     */
    public function deleteUser($user_id){
    	if($this->deleteAll(array('User.id' => $user_id), $cascada = false)){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    public function listarInfoPersonalUsuario(){
    	$arr_obj_info_usuarios = $this->findObjects('all',array(
    			/*'joins' => array(
    					array(
    							'table' => 'tipo_usuarios',
    							'alias' => 'TipoUsuarioJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'TipoUsuarioJoin.id = Usuario.tipo_usuario_id'
    							)
    					),
    					array(
    							'table' => 'personas',
    							'alias' => 'PersonaJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'PersonaJoin.id = Usuario.id'
    							)
    					)
    					array(
    							'table' => 'personas',
    							'alias' => 'PersonaJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'PersonaJoin.id = Usuario.id'
    							)
    					)
    					),*/
    			'order'=> array('User.created ASC'),
    	)
    	);
    	return $arr_obj_info_usuarios;
    }
    
    
    public function checkPasswordForUser($user_id, $current_pass = null){
    	$obj_user = $this->findById($user_id);

    	$old_pass = $obj_user ->getAttr('password');
    	$current_pass_hash = AuthComponent::password($current_pass);

    
    	if($current_pass_hash == $old_pass){
    		return true;
    	}
    	return false;
    }
    
    
    public function hashPasswords($data) {
    	if (isset($data['User']['clave'])) {
    		$data['User']['clave'] = md5($data['User']['clave']);
    		return $data;
    	}
    	return $data;
    }
    
  }
?>
