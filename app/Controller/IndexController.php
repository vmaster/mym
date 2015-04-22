<?php
  class IndexController extends AppController{
       var $name = 'Index';
       
       public function index(){
           $this->layout = "default";
           
           $this->loadModel('Acta');
           $this->loadModel('User');
           $this->loadModel('Empresa');
           $count_informe_day = count($this->Acta->TotalActasPorDia());
           $count_usuarios = count($this->User->TotalUsuarios());
           $count_empresas = count($this->Empresa->listEmpresas());
           
           $this->set(compact('count_informe_day','count_usuarios','count_empresas'));
       }
  }
?>
