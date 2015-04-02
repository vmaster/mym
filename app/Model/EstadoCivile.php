<?php
App::uses('AppModel','Model');
  class EstadoCivile extends AppModel {
    public $name = 'EstadoCivile';
    
    public function listEstadoCiviles() {
    	return $this->findObjects('all');
    }

  }
?>
