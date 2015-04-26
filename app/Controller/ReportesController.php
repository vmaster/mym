<?php
class ReportesController extends AppController{
	public $name = 'Reporte';
	
	
	public function rpt_cant_info_empresas() {
		$this->layout = "default";
		$this->loadModel('Acta');

	}
	
	public function load_graf_cant_info_emp($fec_inicio, $fec_fin){
		$this->loadModel('Acta');
		$this->autoRender = false;
		
		if(isset($fec_inicio)){
			$fec_inicio = $fec_inicio;
		}else{
			$fec_inicio = '';
		}
		
		if(isset($fec_fin)){
			$fec_fin = $fec_fin;
		}else{
			$fec_fin = '';
		}
		
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
		
		$list_sep_emp = $this->Acta->listSupervisionByEmpresa($fec_inicio_format, $fec_fin_format);
		foreach ($list_sep_emp as $key => $arr_emp):
			$x[] = $arr_emp['EmpresaJoin']['nombre'];
			$y[] = intval($arr_emp[0]['Cantidad']);
		endforeach;
		return json_encode(array('success'=>true,'categoria'=>$x, 'name'=>'Empresa', 'data'=>$y));
		//exit();
	}
	
	public function load_list_cant_info_emp($fec_inicio, $fec_fin){
		$this->layout = "ajax";
		$this->loadModel('Acta');
		
		if(isset($fec_inicio)){
			$fec_inicio = $fec_inicio;
		}else{
			$fec_inicio = '';
		}
		
		if(isset($fec_fin)){
			$fec_fin = $fec_fin;
		}else{
			$fec_fin = '';
		}
		
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
		
		$list_sep_emp = $this->Acta->listDetalleSupervisionByEmpresa($fec_inicio_format, $fec_fin_format);
		$this->set(compact('list_sep_emp'));
	}
	
	
	public function rpt_cant_info_uunn() {
		$this->layout = "default";
		$this->loadModel('Acta');
	
	}
	
	public function load_graf_cant_info_uunn($fec_inicio, $fec_fin){
		$this->loadModel('Acta');
		$this->autoRender = false;
	
		if(isset($fec_inicio)){
			$fec_inicio = $fec_inicio;
		}else{
			$fec_inicio = '';
		}
	
		if(isset($fec_fin)){
			$fec_fin = $fec_fin;
		}else{
			$fec_fin = '';
		}
	
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
	
		$list_info_uunn = $this->Acta->listSupervisionByUuNn($fec_inicio_format, $fec_fin_format);
		foreach ($list_info_uunn as $key => $arr_emp):
		$x[] = $arr_emp['UnidadesNegocioJoin']['descripcion'];
		$y[] = intval($arr_emp[0]['Cantidad']);
		endforeach;
		return json_encode(array('success'=>true,'categoria'=>$x, 'name'=>'Unidad de Negocio', 'data'=>$y));
		//exit();
	}
	
	public function load_list_cant_info_uunn($fec_inicio, $fec_fin){
		$this->layout = "ajax";
		$this->loadModel('Acta');
	
		if(isset($fec_inicio)){
			$fec_inicio = $fec_inicio;
		}else{
			$fec_inicio = '';
		}
	
		if(isset($fec_fin)){
			$fec_fin = $fec_fin;
		}else{
			$fec_fin = '';
		}
	
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
	
		$list_info_uunn = $this->Acta->listDetalleSupervisionByUuNn($fec_inicio_format, $fec_fin_format);
		$this->set(compact('list_info_uunn'));
	}
	
	
	
	public function rpt_cant_ni_trabajador() {
		$this->layout = "default";
		$this->loadModel('Acta');
	
	}
	
	public function load_graf_cant_ni_trab($fec_inicio, $fec_fin){
		$this->loadModel('Acta');
		$this->autoRender = false;
	
		if(isset($fec_inicio)){
			$fec_inicio = $fec_inicio;
		}else{
			$fec_inicio = '';
		}
	
		if(isset($fec_fin)){
			$fec_fin = $fec_fin;
		}else{
			$fec_fin = '';
		}
	
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
	
		$list_ni_empresa = $this->Acta->listNiByEmpresaTrabajador($fec_inicio_format, $fec_fin_format);
		$x= ""; $y=""; $v=""; $d=""; 
		foreach ($list_ni_empresa as $key => $arr_emp):
			$empresa_id = $arr_emp['EmpresasJoin']['id'];
			
			$list_ni_trabajador = $this->Acta->listNiByTrabajador($empresa_id, $fec_inicio_format, $fec_fin_format);
			
			$x[] = $arr_emp['EmpresasJoin']['nombre'];
			$y[$key]['name'] = $arr_emp['EmpresasJoin']['nombre'];
			$y[$key]['y'] = intval($arr_emp[0]['Cantidad']);
			$y[$key]['drilldown'] = 'estado-'.$key;
			
			
			$v[$key]['id'] = 'estado-'.$key;
			$v[$key]['name'] = $arr_emp['EmpresasJoin']['nombre'];
			foreach($list_ni_trabajador as $key2 => $arr_trab):
				$d[$key2]['name'] = $arr_trab['TrabajadorJoin']['apellido_nombre'];
				$d[$key2]['y'] = intval($arr_trab[0]['Cantidad']);
				$d[$key2]['drilldown'] = $key."-".$key2;
			
				$v[$key]['data'] = $d;
			endforeach;
		endforeach;
		
		return json_encode(array('success'=>true,'categoria'=>$x, 'name'=>'Empresa', 'data'=>$y, 'data_drilldown'=>$v));
	}
	
	public function load_list_cant_ni_emp_trab($fec_inicio, $fec_fin){
		$this->layout = "ajax";
		$this->loadModel('Acta');
	
		if(isset($fec_inicio)){
			$fec_inicio = $fec_inicio;
		}else{
			$fec_inicio = '';
		}
	
		if(isset($fec_fin)){
			$fec_fin = $fec_fin;
		}else{
			$fec_fin = '';
		}
	
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
	
		$list_info_emp_trab = $this->Acta->listDetalleNiByEmpresaTrabajador($fec_inicio_format, $fec_fin_format);
		$this->set(compact('list_info_emp_trab'));
	}
	
	
	
	
	public function rpt_cant_ni_vehiculo() {
		$this->layout = "default";
		$this->loadModel('Acta');
	
	}
	
	
	public function load_graf_cant_ni_ve($fec_inicio, $fec_fin){
		$this->loadModel('Acta');
		$this->autoRender = false;
	
		if(isset($fec_inicio)){
			$fec_inicio = $fec_inicio;
		}else{
			$fec_inicio = '';
		}
	
		if(isset($fec_fin)){
			$fec_fin = $fec_fin;
		}else{
			$fec_fin = '';
		}
	
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
	
		$list_ni_empresa = $this->Acta->listNiByEmpresaVehiculo($fec_inicio_format, $fec_fin_format);
		$x= ""; $y=""; $v=""; $d="";
		foreach ($list_ni_empresa as $key => $arr_emp):
			$empresa_id = $arr_emp['EmpresasJoin']['id'];
				
			$list_ni_vehiculo = $this->Acta->listNiByVehiculo($empresa_id, $fec_inicio_format, $fec_fin_format);
				
			$x[] = $arr_emp['EmpresasJoin']['nombre'];
			$y[$key]['name'] = $arr_emp['EmpresasJoin']['nombre'];
			$y[$key]['y'] = intval($arr_emp[0]['Cantidad']);
			$y[$key]['drilldown'] = 'estado-'.$key;
				
				
			$v[$key]['id'] = 'estado-'.$key;
			$v[$key]['name'] = $arr_emp['EmpresasJoin']['nombre'];
			foreach($list_ni_vehiculo as $key2 => $arr_veh):
				$d[$key2]['name'] = $arr_veh['VehiculoJoin']['nro_placa'];
				$d[$key2]['y'] = intval($arr_veh[0]['Cantidad']);
				$d[$key2]['drilldown'] = $key."-".$key2;
					
				$v[$key]['data'] = $d;
			endforeach;
		endforeach;
	
		return json_encode(array('success'=>true,'categoria'=>$x, 'name'=>'Empresa', 'data'=>$y, 'data_drilldown'=>$v));
	}
	
	public function load_list_cant_ni_emp_veh($fec_inicio, $fec_fin){
		$this->layout = "ajax";
		$this->loadModel('Acta');
	
		if(isset($fec_inicio)){
			$fec_inicio = $fec_inicio;
		}else{
			$fec_inicio = '';
		}
	
		if(isset($fec_fin)){
			$fec_fin = $fec_fin;
		}else{
			$fec_fin = '';
		}
	
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
	
		$list_info_emp_veh = $this->Acta->listDetalleNiByEmpresaVehiculo($fec_inicio_format, $fec_fin_format);
		$this->set(compact('list_info_emp_veh'));
	}
	
	
	function formatFecha($fecha){
		if(isset($fecha)){
			$fec_nac = $fecha;//12-12-1990
	
			if($fecha == '' || $fecha == NULL){
				$fecha = '';
			}else{
				$dd = substr($fecha, 0, 2);
				$mm = substr($fecha, 3, 2);
				$yy = substr($fecha, -4);
				$fecha = $yy.'-'.$mm.'-'.$dd;//1990-12-12
			}
		}
	
		return $fecha;
	}
}