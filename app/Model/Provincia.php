<?php
App::uses('AppModel','Model');
  class Provincia extends AppModel {
    public $name = 'Provincia';
    
    public function listProvinciasByDepartamentoId($departamento_id='') {
    	return $this->find('list',
    			array(
    					'fields' => array('id','nomprovincia'),
    					'conditions' => array('Provincia.departamento_id' => $departamento_id),
    					'order' => array('Provincia.nomprovincia ASC'),
    			));
    }
    
    /*public function listAllProvincias() {
    	return $this->findObjects('all');
    }*/
    
    public function listAllProvincias() {
    	return $this->find('list',
    			array(
    					'fields' => array('id','nomprovincia'),
    					'order' => array('Provincia.nomprovincia ASC'),
    			));
    }
  }
?>
