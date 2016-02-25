<?php
class ReportesController extends AppController{
	public $name = 'Reporte';
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
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
		$x ="";
		$y ="";
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
	
	
	/* Normas incumplidas por empresa */
	public function rpt_reincidencia_ni_empresa() {
		$this->layout = "default";
		$this->loadModel('Acta');
		$this->loadModel('Empresa');
		$list_all_empresas = $this->Empresa->listEmpresas();
		$this->set(compact('list_all_empresas'));
	}
	
	public function load_graf_reincidencia_ni_empresa($fec_inicio, $fec_fin, $empresa_id){
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
		
		if(isset($empresa_id)){
			$empresa_id = $empresa_id;
		}else{
			$empresa_id = '';
		}
	
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
		$xy = array();
		$x = array();
		$y = array();
	
		$list_ni_emp1 = $this->Acta->listNiByEmpresa1($fec_inicio_format, $fec_fin_format, $empresa_id);
		foreach ($list_ni_emp1 as $key1 => $arr_emp1):
			$xy[$arr_emp1['CodigosJoin']['codigo']] = intval($arr_emp1[0]['Cantidad']);
		endforeach;
		
		$list_ni_emp2 = $this->Acta->listNiByEmpresa2($fec_inicio_format, $fec_fin_format, $empresa_id);
		foreach ($list_ni_emp2 as $key2 => $arr_emp2):
			$xy[$arr_emp2['CodigosJoin']['codigo']] = intval($arr_emp2[0]['Cantidad']);
		endforeach;
		
		arsort($xy);
		
		foreach ($xy as $x_valor => $y_valor):
			$x[] = $x_valor;
			$y[] = $y_valor;
		endforeach;
			
		return json_encode(array('success'=>true,'categoria'=>$x, 'name'=>'Empresa', 'data'=>$y));
		//exit();
	}
	
	public function load_list_reincidencia_ni_empresa($fec_inicio, $fec_fin, $empresa_id){
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
		
		if(isset($empresa_id)){
			$empresa_id = $empresa_id;
		}else{
			$empresa_id = '';
		}
	
		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);
	
		$list_ni_emp1 = $this->Acta->listDetalleNiByEmpresa1($fec_inicio_format, $fec_fin_format, $empresa_id);
		$list_ni_emp2 = $this->Acta->listDetalleNiByEmpresa2($fec_inicio_format, $fec_fin_format, $empresa_id);
		$this->set(compact('list_ni_emp1','list_ni_emp2'));
	}
	
	
	/*NIVEL DE CUMPLIMIENTO*/
	public function rpt_cumplimiento_empresas() {
		$this->layout = "default";
		$this->loadModel('Acta');
	
	}
	
	public function load_graf_cumplimiento_emp($fec_inicio, $fec_fin){
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
		$x ="";
		$y ="";
		$list_sep_emp = $this->Acta->listCumplimientoByEmpresa($fec_inicio_format, $fec_fin_format);
		foreach ($list_sep_emp as $key => $arr_emp):
		$x[] = $arr_emp['EmpresaJoin']['nombre'];
		$y[] = intval($arr_emp[0]['Porcentaje']);
		endforeach;
		return json_encode(array('success'=>true,'categoria'=>$x, 'name'=>'Empresa', 'data'=>$y));
		//exit();
	}
	
	public function load_list_cumplimiento_emp($fec_inicio, $fec_fin){
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
	
		$list_sep_emp = $this->Acta->listDetalleCumplimientoByEmpresa($fec_inicio_format, $fec_fin_format);
		$this->set(compact('list_sep_emp'));
	}
	/* FIN */
	
	
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

	function calculo_ni_cu($obj_acta){
		$normas_cumplidas = 0;
		$normas_incumplidas = 0;

		$info_des_act = json_decode($obj_acta->info_des_epp);
	    foreach($info_des_act as $value){
	    	if($value->info_des_epp != ''){
		    	if($value->alternativa == 1){
		    		$normas_cumplidas++;
		    	}elseif($value->alternativa == 0){
		    		$normas_incumplidas++;
		    	}
	    	}
	    }
	    $info_des_act1 = json_decode($obj_acta->info_des_se_de);
	    foreach($info_des_act1 as $value){
	    	if(isset($value->info_des_se_de) && $value->info_des_se_de != ''){
		    	if($value->alternativa == 1){
		    		$normas_cumplidas++;
		    	}elseif($value->alternativa == 0){
		    		$normas_incumplidas++;
		    	}
	    	}
	    }
		$info_des_act2 = json_decode($obj_acta->info_des_um);
	    foreach($info_des_act2 as $value){
	    	if(isset($value->info_des_um) && $value->info_des_um != ''){
		    	if($value->alternativa == 1){
		    		$normas_cumplidas++;
		    	}elseif($value->alternativa == 0){
		    		$normas_incumplidas++;
		    	}
	    	}
	    }
	    $info_des_act3 = json_decode($obj_acta->info_des_doc);
	    foreach($info_des_act3 as $value){
	    	if(isset($value->info_des_doc) && $value->info_des_doc != ''){
		    	if($value->alternativa == 1){
		    		$normas_cumplidas++;
		    	}elseif($value->alternativa == 0){
		    		$normas_incumplidas++;
		    	}
	    	}
	    }
	    $info_des_act4 = json_decode($obj_acta->info_des_act);
	    foreach($info_des_act4 as $value){
	    	if(isset($value->info_des_act) && $value->info_des_act != ''){
		    	if($value->alternativa == 1){
		    		$normas_cumplidas++;
		    	}elseif($value->alternativa == 0){
		    		$normas_incumplidas++;
		    	}
	    	}
	    }
	    $info_des_act5 = json_decode($obj_acta->info_des_cond);
	    foreach($info_des_act5 as $value){
	    	if(isset($value->info_des_cond) && $value->info_des_cond != ''){
		    	if($value->alternativa == 1){
		    		$normas_cumplidas++;
		    	}elseif($value->alternativa == 0){
		    		$normas_incumplidas++;
		    	}
	    	}
	    }
	    return explode('-', $normas_cumplidas.'-'.$normas_incumplidas.'-'.($normas_cumplidas+$normas_incumplidas));
	}

	function excel_resumen_seguimiento(){
		$this->autoRender = false;
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300000);
		set_time_limit(0);

		$this->loadModel('Acta');
		$this->loadModel('Empresa');
		$this->loadModel('UnidadesNegocio');
		
		$list_acta_all = $this->Acta->listAllActas('Acta.created','', '','','','DESC');

		$color = 'background: #81EFF1;';
		$tabla='<table border=1>
				<th colspan="17" style="'.$color.' height:60px">SEGUIMIENTO A NO CONFORMIDADES SEGÚN INFORMES DE SEGURIDAD DE CAMPO - SEGÚN PROGRAMA SEGESEM (Sostenibilidad empresarial  en gestion de la Seguridad y Salud en el trabajo en M&M)</th>
				<tr>
					<th colspan="8" style="'.$color.'">DESCRIPCI&Oacute;N DEL INFORME</th>
					<th colspan="3" style="'.$color.'">NIVEL DE CUMPLIMIENTO</th>
					<th style="'.$color.'">Acci&oacute;n Correctiva</th>
					<th colspan="5" style="'.$color.'">DEFICIENCIAS - NO CONFORMIDADES</th>
				</tr>
				<tr>
					<th style="'.$color.'">Item</th>
					<th style="'.$color.'">N. Informe T&eacute;cnico</th>
					<th style="'.$color.'">Fecha</th>
					<th style="'.$color.' width:120px;">UUNN</th>
					<th style="'.$color.' width:120px;">&Aacute;rea</th>
					<th style="'.$color.' width:150px;">Empresa</th>
					<th style="'.$color.' width:150px;">Obra/Servicio</th>
					<th style="'.$color.' width:150px;">Actividad(es)</th>
					
					<th style="'.$color.' width:90px;">% Cumplimiento</th>
					<th style="'.$color.' width:90px;">Cumplimientos</th>
					<th style="'.$color.' width:90px;">Total Item Inspeccionados</th>

					<th style="'.$color.' width:90px;">Acci&oacute;n Correctiva</th>

					<th style="'.$color.' width:90px;">Se&ntilde;alizaci&oacute;n</th>
					<th style="'.$color.' width:90px;">U. Movil</th>
					<th style="'.$color.' width:90px;">Documentaci&oacute;n de seguridad</th>
					<th style="'.$color.' width:90px;">Cumplimiento de Procedimiento </th>
					<th style="'.$color.' width:90px;">Actos y Condiciones Sub-estandares</th>
				</tr>';
		foreach ($list_acta_all as $key => $obj_acta){
			$tabla.='<tr>';
			$tabla.= '<td>'.($key+1).'</td>';
			$tabla.= '<td>'.$obj_acta->getAttr('num_informe').'</td>';
			$tabla.= '<td>'.$obj_acta->getAttr('created').'</td>';
			$tabla.= '<td>'.$obj_acta->UnidadesNegocio->getAttr('descripcion').'</td>';
			$tabla.= '<td>'.utf8_decode($obj_acta->getAttr('sector')).'</td>';
			$tabla.= '<td>'.$obj_acta->Empresa->getAttr('nombre').'</td>';
			$tabla.= '<td>'.utf8_decode($obj_acta->getAttr('obra')).'</td>';
			$tabla.= '<td>'.utf8_decode($obj_acta->getAttr('actividad')).'</td>';

			$tabla.= '<td>'.$obj_acta->getAttr('cumplimiento').'%'.'</td>';
			$tabla.= '<td>'.$this->calculo_ni_cu($obj_acta)[0].'</td>'; // normas cumplidas
			$tabla.= '<td>'.$this->calculo_ni_cu($obj_acta)[2].'</td>'; // normas cumplidas + normas incumplidas

			$tabla.= '<td></td>';

			$tabla.= '<td></td>';
			$tabla.= '<td></td>';
			$tabla.= '<td></td>';
			$tabla.= '<td></td>';
			$tabla.= '<td></td>';
			$tabla.='</tr>';
		}
		$tabla = $tabla.'</table>';
		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=reporte-".date('Y-m-d-h-i-s').".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $tabla;
	}

	function excel_areas(){ //agrupar las actas por Tipo de Lugar
		$this->autoRender = false;
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300000);
		set_time_limit(0);

		$this->loadModel('Acta');
		$this->loadModel('Empresa');
		$this->loadModel('UnidadesNegocio');
		
		$list_x_area_all = $this->Acta->listarCantidadInformexArea();
		$suma_cantidad = 0;
		$total_cumplimiento = 0;
		$suma_cu_in = 0;
		$suma_porc_cumplimiento = 0;

		$tabla='<table border=1>
				<tr>
					<th style ="background:#C0CAD1;">&Aacute;reas</th>
					<th style ="background:#C0CAD1;">Total N&deg; de informes</th>
					<th style ="background:#C0CAD1;">Suma de Cumplimientos</th>
					<th style ="background:#C0CAD1;">Suma de Verificaci&oacute;nes</th>
					<th style ="background:#C0CAD1;"></th>
				</tr>';
		foreach ($list_x_area_all as $key => $value){
			$tabla.='<tr>';
			$tabla.= '<td>'.$value['TipoLugaresJoin']['descripcion'].'</td>';
			$tabla.= '<td>'.$value[0]['cantidad'].'</td>';
			$tabla.= '<td>'.$value[0]['total_cumplimiento'].'</td>';
			$tabla.= '<td>'.$value[0]['suma_cu_in'].'</td>';
			$porc_cumplimiento_x_area = round(($value[0]['total_cumplimiento']/$value[0]['suma_cu_in'])*100);
			$tabla.= '<td>'.$porc_cumplimiento_x_area.'%</td>';
			$tabla.='</tr>';

			$suma_cantidad+= $value[0]['cantidad'];
			$total_cumplimiento+= $value[0]['total_cumplimiento'];
			$suma_cu_in+= $value[0]['suma_cu_in'];
			$suma_porc_cumplimiento+= $porc_cumplimiento_x_area;
		}
		 $tabla.= '<tr>';
		 $tabla.= '<td style ="background:#C0CAD1;"><b>Total general</b></td>';
		 $tabla.= '<td style ="background:#C0CAD1;"><b>'.$suma_cantidad.'</b></td>';
		 $tabla.= '<td style ="background:#C0CAD1;"><b>'.$total_cumplimiento.'</b></td>';
		 $tabla.= '<td style ="background:#C0CAD1;"><b>'.$suma_cu_in.'</b></td>';
		 $tabla.= '<td style ="background:#C0CAD1;"><b>'.round(($total_cumplimiento/$suma_cu_in)*100).'%</b></td>';
		 $tabla.= "</tr>";


		$tabla = $tabla.'</table>';
		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=reporte-".date('Y-m-d-h-i-s').".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $tabla;
	}

	function excel_areas_empresas(){ //agrupar las actas por Tipo de Lugar y Empresas
		$this->autoRender = false;
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300000);
		set_time_limit(0);

		$this->loadModel('Acta');
		$this->loadModel('Empresa');
		$this->loadModel('UnidadesNegocio');
		
		$list_x_area_all = $this->Acta->listarCantidadInformexArea();
		$suma_cantidad = 0;
		$total_cumplimiento = 0;
		$suma_cu_in = 0;
		$suma_porc_cumplimiento = 0;

		$tabla='<table border=1>
				<tr>
					<th style ="background:#C0CAD1;">&Aacute;reas</th>
					<th style ="background:#C0CAD1;">Total N&deg; de informes</th>
					<th style ="background:#C0CAD1;">Suma de Cumplimientos</th>
					<th style ="background:#C0CAD1;">Suma de Verificaci&oacute;nes</th>
					<th style ="background:#C0CAD1;"></th>
				</tr>';
		foreach ($list_x_area_all as $key => $value){
			$tabla.='<tr style="font-weight: bold;">';
			$tabla.= '<td>'.$value['TipoLugaresJoin']['descripcion'].'</td>';
			$tabla.= '<td>'.$value[0]['cantidad'].'</td>';
			$tabla.= '<td>'.$value[0]['total_cumplimiento'].'</td>';
			$tabla.= '<td>'.$value[0]['suma_cu_in'].'</td>';
			$porc_cumplimiento_x_area = round(($value[0]['total_cumplimiento']/$value[0]['suma_cu_in'])*100);
			$tabla.= '<td>'.$porc_cumplimiento_x_area.'%</td>';
			$tabla.='</tr>';
			//debug($value);
			$suma_cantidad+= $value[0]['cantidad'];
			$total_cumplimiento+= $value[0]['total_cumplimiento'];
			$suma_cu_in+= $value[0]['suma_cu_in'];
			$suma_porc_cumplimiento+= $porc_cumplimiento_x_area;
			$arr_area_empresas = $this->Empresa->listarCantidadInformexAreaxEmpresa($value['Acta']['tipo_lugar_id']);
			//debug($arr_area_empresas);
			foreach ($arr_area_empresas as $key => $value){
				$tabla.='<tr>';
				$tabla.= '<td> &nbsp; &nbsp; &nbsp;'.$value['Empresa']['nombre'].'</td>';
				$tabla.= '<td>'.$value[0]['cantidad'].'</td>';
				$tabla.= '<td>'.$value[0]['total_cumplimiento'].'</td>';
				$tabla.= '<td>'.$value[0]['suma_cu_in'].'</td>';
				$porc_cumplimiento_x_area = round(($value[0]['total_cumplimiento']/$value[0]['suma_cu_in'])*100);
				$tabla.= '<td>'.$porc_cumplimiento_x_area.'%</td>';
				$tabla.='</tr>';
			}
		}
		//exit();
		$tabla.= '<tr>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>Total general</b></td>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>'.$suma_cantidad.'</b></td>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>'.$total_cumplimiento.'</b></td>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>'.$suma_cu_in.'</b></td>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>'.round(($total_cumplimiento/$suma_cu_in)*100).'%</b></td>';
		$tabla.= "</tr>";


		$tabla = $tabla.'</table>';
		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=reporte-".date('Y-m-d-h-i-s').".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $tabla;
	}

	function excel_cumplimiento(){ //agrupar las actas por Tipo de Lugar y Empresas
		$this->autoRender = false;
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300000);
		set_time_limit(0);

		$this->loadModel('Acta');
		$this->loadModel('Empresa');
		$this->loadModel('UnidadesNegocio');
		
		$arr_empresas_all = $this->Empresa->listarCantidadInformeEmpresa();
		$suma_cantidad = 0;
		$total_cumplimiento = 0;
		$suma_cu_in = 0;
		$suma_porc_cumplimiento = 0;

		$tabla='<table border=1>
				<tr>
					<th style ="background:#C0CAD1;">Empresa</th>
					<th style ="background:#C0CAD1;">Total N&deg; de informes</th>
					<th style ="background:#C0CAD1;">Suma de Cumplimientos</th>
					<th style ="background:#C0CAD1;">Suma de Verificaci&oacute;nes</th>
					<th style ="background:#C0CAD1;"></th>
				</tr>';
		foreach ($arr_empresas_all as $key => $value){
			$tabla.='<tr style="font-weight: bold;">';
			$tabla.= '<td>'.$value['Empresa']['nombre'].'</td>';
			$tabla.= '<td>'.$value[0]['cantidad'].'</td>';
			$tabla.= '<td>'.$value[0]['total_cumplimiento'].'</td>';
			$tabla.= '<td>'.$value[0]['suma_cu_in'].'</td>';
			$porc_cumplimiento_x_area = round(($value[0]['total_cumplimiento']/$value[0]['suma_cu_in'])*100);
			$tabla.= '<td>'.$porc_cumplimiento_x_area.'%</td>';
			$tabla.='</tr>';
			//debug($value);
			$suma_cantidad+= $value[0]['cantidad'];
			$total_cumplimiento+= $value[0]['total_cumplimiento'];
			$suma_cu_in+= $value[0]['suma_cu_in'];
			$suma_porc_cumplimiento+= $porc_cumplimiento_x_area;
		}
		//exit();
		$tabla.= '<tr>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>Total general</b></td>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>'.$suma_cantidad.'</b></td>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>'.$total_cumplimiento.'</b></td>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>'.$suma_cu_in.'</b></td>';
		$tabla.= '<td style ="background:#C0CAD1;"><b>'.round(($total_cumplimiento/$suma_cu_in)*100).'%</b></td>';
		$tabla.= "</tr>";


		$tabla = $tabla.'</table>';
		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=reporte-".date('Y-m-d-h-i-s').".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $tabla;
	}

	function rpt_descargo_excel(){
		$this->layout = "default";
	}

	function insert_cu_ic(){ //Función para insertar total cumplimientos e incumplimientos
		$this->autoRender = false;
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300000);
		set_time_limit(0);

		$this->loadModel('Acta');
		
		$list_acta_all = $this->Acta->listAllActas('Acta.created','', '','','','DESC');


		foreach ($list_acta_all as $key => $obj_acta){
			$normas_cumplidas = $this->calculo_ni_cu($obj_acta)[0];
			$normas_incumplidas = $this->calculo_ni_cu($obj_acta)[1];
			$suma_cumplidas_incumplidas = $this->calculo_ni_cu($obj_acta)[2];

			$obj_acta->saveField('total_cumplimiento', $normas_cumplidas);
			$obj_acta->saveField('total_incumplimiento', $normas_incumplidas);
			$obj_acta->saveField('suma_cu_in', $suma_cumplidas_incumplidas);
		}

	}

}