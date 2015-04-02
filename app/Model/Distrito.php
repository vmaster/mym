<?php
App::uses('AppModel','Model');
  class Distrito extends AppModel {
    public $name = 'Distrito';
    
    public function listDistritosByProvinciaId($provincia_id='') {
    	return $this->find('list',
    			array(
    					'fields' => array('id','nomdistrito'),
    					'conditions' => array('Distrito.provincia_id' => $provincia_id),
    					'order' => array('Distrito.nomdistrito ASC'),
    			));
    }
    
    public function listAllDistritos() {
    	return $this->findObjects('all');
    }
    
    /*public function showDistritoByUser($distrito_id='') {
    	return $this->findObjects('list',
    			array(
    					'joins' => array(
    							array(
    									'table' => 'provincias',
    									'alias' => 'ProvinciaJoin',
    									'type' => 'INNER',
    									'conditions' => array(
    											'ProvinciaJoin.id = Distrito.provincia_id'
    									)
    							),
    							array(
    									'table' => 'departamentos',
    									'alias' => 'DepartamentoJoin',
    									'type' => 'INNER',
    									'conditions' => array(
    											'DepartamentoJoin.id = ProvinciaJoin.departamento_id'
    									)
    							)
    					),
    					'fields' => array('id'),
    					'conditions' => array('Distrito.id' => $distrito_id),
    			));
    }*/
  }
?>