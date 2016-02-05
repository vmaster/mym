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
}
