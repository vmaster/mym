<?php
App::uses('AppModel','Model');
  class Departamento extends AppModel {
    public $name = 'Departamento';
    
    public function listAllDepartamentos() {
    	return $this->findObjects('all');
    }
  }
?>
