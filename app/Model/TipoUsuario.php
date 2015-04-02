<?php
App::uses('AppModel','Model');
  class TipoUsuario extends AppModel {
    public $name = 'TipoUsuario';
    
    public function listAllTipoUsuarios() {
    	return $this->find('all');
    }
  }
?>
