<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
App::uses('Controller', 'Controller');
class AppController extends Controller {
	public $components = array(
		'Session',	
		'Auth'=> array(
			'authenticate' => array(
					'Form' => array(
							'fields' => array('username' => 'username', 'password' => 'password'),
					)
			),
        'loginRedirect' => array('controller' => 'dashboards', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
		'authorize' => array('Controller')
 
    	)
	);
	
	public function isAuthorized($user){
		return true;
	}
	
	public function beforeFilter(){
		//$this->Auth->allow('index','view');
		$this->verificarAccessoInvitado();
	}

	/**
	 * Verificamos desde AppController que el Perfil Invitado no tenga acceso.
	 * @param $
	 * @return redirect
	 * @author Vladimir
	 * @version 12 Octubre 2015
	 */
	public function verificarAccessoInvitado(){

		$arr_accesos = array('actividades', 'users', 'trabajadores', 'empresas', 'vehiculos', 'tipo_vehiculos', 'codigos','unidades_negocios','categoria_normas','nuevo_informe','emails_enviados'); 
		$arr_accesos_public = array('login', 'logout', 'register'); 

		if (!in_array($this->request->params['action'], $arr_accesos_public)) {

			if (in_array($this->request->params['controller'], $arr_accesos) && $this->Session->read('Auth.User.tipo_user_id') == 3) {
				echo json_encode(array('success'=>true,'msg'=>__('Esta acción no esta permitida')));
				$this->redirect(array('controller' => 'actas', 'action' => 'index'));
				exit();
       		 }
		}
	}

	public function supervisores_enosa(){
		$this->loadModel('User');
		$arr_obj_usuario = $this->User->find('all',array(
    			'fields' => array('User.id'),
    			'conditions'=>array(
                        'User.consorcio_id' => 2,
                        'User.estado' => 1
    			)
    		)
    	);
    	//debug($arr_obj_usuario);
    	return $arr_obj_usuario;
	}

	public function tareas_supervisores_del_dia_ayer($user_id){
		$this->loadModel('Tarea');
		$arr_obj_tareas = $this->Tarea->find('all',array(    			
    			'conditions'=>array(
                        'Tarea.user_id' => $user_id,
                        'DATE(Tarea.created) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)'
    			)
    		)
    	);
    	//debug($arr_obj_tareas);exit();
    	return $arr_obj_tareas;
	}
	
	public function tareas_supervisores_del_dia_antesdeayer($user_id){
		$this->loadModel('Tarea');
		$arr_obj_tareas = $this->Tarea->find('all',array(    			
    			'conditions'=>array(
                        'Tarea.user_id' => $user_id,
                        'DATE(Tarea.created) = DATE_SUB(CURDATE(), INTERVAL 2 DAY)'
    			)
    		)
    	);
    	//debug($arr_obj_tareas);exit();
    	return $arr_obj_tareas;
	}

	/**
	 * Creamos tareas del dia anterior al supervisor enosa
	 * @return boolean
	 * @author Alan Hugo
	 * @version 25 Octubre 2017
	 */
	public function crear_tarea_supervisor_dia_ayer_y_antesdeayer(){
		$this->loadModel('Tarea');
		$arr_obj_usuarios = $this->supervisores_enosa();

		foreach ($arr_obj_usuarios as $key => $obj_usuario) {
			$user_id = $obj_usuario['User']['id'];
			$arr_obj_tareas_ayer = $this->tareas_supervisores_del_dia_ayer($user_id);
			$arr_obj_tareas_antesdeayer = $this->tareas_supervisores_del_dia_antesdeayer($user_id);

			if(empty($arr_obj_tareas_ayer)){
				$arr_obj_tarea_ayer['user_id'] = $user_id;
				$arr_obj_tarea_ayer['created'] = date('Y-m-d', (strtotime(date('Y-m-d')) - 3600));
				$arr_obj_tarea_ayer['modified'] = $arr_obj_tarea_ayer['created'];
				$arr_obj_tarea_ayer['estado'] = '0';
		    	
		    	$this->Tarea->create();
				$this->Tarea->save($arr_obj_tarea_ayer);
			}
			
			if(empty($arr_obj_tareas_antesdeayer)){
				$arr_obj_tarea_antesdeayer['user_id'] = $user_id;
				$arr_obj_tarea_antesdeayer['created'] = date('Y-m-d', (strtotime(date('Y-m-d')) - 7200));
				$arr_obj_tarea_antesdeayer['modified'] = $arr_obj_tarea_antesdeayer['created'];
				$arr_obj_tarea_antesdeayer['estado'] = '0';
		    	
		    	$this->Tarea->create();
				$this->Tarea->save($arr_obj_tarea_antesdeayer);
			}
		}

		return true;
	}


}
