<?php
  class IndexController extends AppController{
       var $name = 'Index';
       
       public function beforeFilter(){
          parent::beforeFilter();
      }

       public function index(){
           $this->layout = "default";
           
           $this->loadModel('Acta');
           $this->loadModel('Empresa');
           $this->loadModel('Trabajadore');
           $this->loadModel('Vehiculo');
           
           $count_informe_enviados = count($this->Acta->listInformesEnviados());
           $count_informe_pendientes = count($this->Acta->listInformesPendientes());
           $count_empresas = count($this->Empresa->listEmpresas());
           $count_trabajadores = count($this->Trabajadore->listAllTrabajadores());
           $count_unidades_moviles = count($this->Vehiculo->listAllVehiculos());
           $list_ultimos_informes = $this->Acta->listUltimosInformes();

           $empresa_mayor_numero_normas = $this->Acta->getEmpresaMayorNi();
           if(count($empresa_mayor_numero_normas) > 0){
           		$empresa_mayor_numero_normas = $empresa_mayor_numero_normas[0]['E']['nombre'];
           }else{
           	 	$empresa_mayor_numero_normas = '';
           }
           
           $trabajador_mayor_numero_normas = $this->Acta->getTrabajadorMayorNi();
           if(count($trabajador_mayor_numero_normas) > 0){
           		$trabajador_mayor_numero_normas = $trabajador_mayor_numero_normas[0]['T']['apellido_nombre'];
           }else{
           		$trabajador_mayor_numero_normas = "";
           }
           
           $this->set(compact('count_informe_enviados','count_informe_pendientes','count_trabajadores','count_empresas','count_unidades_moviles','empresa_mayor_numero_normas','trabajador_mayor_numero_normas','list_ultimos_informes'));
       }
  }
?>
