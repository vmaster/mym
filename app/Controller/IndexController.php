<?php
  class IndexController extends AppController{
       var $name = 'Index';
       
       public function index(){
           $this->layout = "default";
           
           $this->loadModel('Acta');
           $this->loadModel('Empresa');
           $this->loadModel('Trabajadore');
           $this->loadModel('Vehiculo');
           //$count_informe_day = count($this->Acta->TotalActasPorDia());
           $count_informe = count($this->Acta->listActas());
           //$count_usuarios = count($this->User->TotalUsuarios());
           $count_empresas = count($this->Empresa->listEmpresas());
           $count_trabajadores = count($this->Trabajadore->listAllTrabajadores());
           $count_unidades_moviles = count($this->Vehiculo->listAllVehiculos());

           $empresa_mayor_numero_normas = $this->Acta->listNiByEmpresaTrabajadorSinFecha();
           //$empresa_mayor_numero_normas = $empresa_mayor_numero_normas['EmpresasJoin']['nombre'];
           
           $this->set(compact('count_informe','count_trabajadores','count_empresas','count_unidades_moviles','empresa_mayor_numero_normas'));
       }
  }
?>
