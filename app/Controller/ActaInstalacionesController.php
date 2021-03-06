<?php
class ActaInstalacionesController extends AppController{
	public $name = 'ActaInstalacione';
	public $components = array('RequestHandler');
	
	public function beforeFilter(){
		$this->Auth->allow(array('view_informe_instal','save_pdf'));
		parent::beforeFilter();
		//$this->layout = 'default';
	}
	public function index($page=null,$order_by=null,$order_by_or=null,$search_nro=null,$search_actividad=null,$search_empresa=null,$search_obra=null) {
		$this->layout = "default";
		$this->loadModel('ActaInstalacione');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
		

		$order_by = 'ActaInstalacione.created';
		
		if($this->request->is('get')){
			if($search_nro!=''){
				$search_nro = $search_nro;
			}else{
				$search_nro = '';
			}
			if($search_actividad!=''){
				$search_actividad = $search_actividad;
			}else{
				$search_actividad = '';
			}
			if($search_empresa!=''){
				$search_empresa = $search_empresa;
			}else{
				$search_empresa = '';
			}
			if($search_obra!=''){
				$search_obra = $search_obra;
			}else{
				$search_obra = '';
			}
			  

		}else{
			$search_nro = '';
			$search_actividad = '';
			$search_empresa = '';
			$search_obra = '';
		}
		$tipo_user_id = $this->Session->read('Auth.User.tipo_user_id');
		$list_acta_all = $this->ActaInstalacione->listAllActaInstalaciones($order_by,$search_nro, utf8_encode($search_actividad),utf8_encode($search_empresa),utf8_encode($search_obra),$order_by_or, $tipo_user_id);
		$list_acta = $this->ActaInstalacione->listFindActaInstalaciones($order_by, $search_nro, utf8_encode($search_actividad),utf8_encode($search_empresa),utf8_encode($search_obra), date('Y'),$order_by_or, $start, $per_page, $tipo_user_id);
		$count = count($list_acta_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_acta','page','no_of_paginations'));
	}
	
	public function search_actas($search_ano=null) {
		$this->layout = 'ajax';
		$this->loadModel('ActaInstalacione');
		$tipo_user_id = $this->Session->read('Auth.User.tipo_user_id');
		$list_acta = $this->ActaInstalacione->listSearchActaInstalaciones($search_ano, $tipo_user_id);

		$this->set(compact('list_acta'));
	}
	
		
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function nuevo_informe_instalacion($acta_instalacion_id=null){
		$this->verificarAccessoInvitado();

		$this->layout = 'acta';
		
		$this->loadModel('ActaInstalacione');
		$this->loadModel('Empresa');
		$this->loadModel('Vehiculo');
		$this->loadModel('Actividade');
		$this->loadModel('Trabajadore');
		$this->loadModel('Codigo');
		$this->loadModel('FotoInstalCondSeg');
		$this->loadModel('FotoInstalEqEmerg');
		$this->loadModel('FotoInstalIlumVent');
		$this->loadModel('FotoInstalOrdenLimpieza');
		$this->loadModel('FotoInstalSenSeg');
		$this->loadModel('FotoInstalSshh');
		$this->loadModel('FotoInstalActInsSeg');
		$this->loadModel('ActosSubestandaresTipo');
		$this->loadModel('CondicionesSubestandaresTipo');
		$this->loadModel('UnidadesNegocio');
		$this->loadModel('TipoLugare');
		
		$list_all_empresas = $this->Empresa->listEmpresas();
		$list_all_actas = $this->ActaInstalacione->listActaInstalaciones();
		$list_all_unidades_negocios = $this->UnidadesNegocio->listUnidadesNegocios();
		$list_all_trabajadores = $this->Trabajadore->listTrabajadores();
		$list_all_actividades = $this->Actividade->listActividades();
		$list_all_codigos = $this->Codigo->listCodigos();
		$list_all_vehiculos = $this->Vehiculo->listVehiculos();
		$list_all_tipos_actos_sub = $this->ActosSubestandaresTipo->listTipoActosSubEstandares();
		$list_all_tipos_condiciones_sub = $this->CondicionesSubestandaresTipo->listTipoCondicionesSubEstandares();
		$list_all_tipo_lugares = $this->TipoLugare->listTipoLugares();
		
		$total_registros = $this->ActaInstalacione->find('count', 
							array(
							'conditions' => array(
									'YEAR(ActaInstalacione.created) = YEAR(NOW())'							
									)
								)
							) + 1;

		$codigo = str_pad($total_registros, 4, "0", STR_PAD_LEFT);
		$string_complement = " - M&M/SST-".date('Y');
		$codigo_completo = $codigo.$string_complement;
		
		
		$this->set(compact('list_all_empresas','list_all_actas','list_all_trabajadores','list_all_actividades','list_all_codigos','list_all_vehiculos','codigo_completo','list_all_tipos_actos_sub','list_all_tipos_condiciones_sub','list_all_unidades_negocios','list_all_tipo_lugares'));
		
		
		//debug($count_actas);
		if($this->request->is('post')  || $this->request->is('put')){
				//insert
				
				
				$this->formatFecha($this->request->data['ActaInstalacione']['fecha']);

				$this->request->data['ActaInstalacione']['json_ilum_vent'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_ilum_vent']);
				$this->request->data['ActaInstalacione']['json_orden_limpieza'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_orden_limp']);
				
				$this->request->data['ActaInstalacione']['json_sshh'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_sshh']);
				$this->request->data['ActaInstalacione']['json_sen_seg'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_sen_seg']);
				$this->request->data['ActaInstalacione']['json_eq_emerg'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_eq_emerg']);
				$this->request->data['ActaInstalacione']['json_cond_seg'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_cond_seg']);
				
				$this->request->data['ActaInstalacione']['info_des_conclusion'] = $this->request->data['ActaInstalacione']['info_des_conclusion'];
				$this->request->data['ActaInstalacione']['info_des_rec'] = $this->request->data['ActaInstalacione']['info_des_rec'];
				$this->request->data['ActaInstalacione']['info_des_med'] = $this->request->data['ActaInstalacione']['info_des_med'];
				$this->request->data['ActaInstalacione']['vers_cambios'] = 2;
				
				if($this->Session->read('Auth.User.tipo_user_id')== 3){
					$this->request->data['ActaInstalacione']['created_mym'] = 1;
				}else{
					$this->request->data['ActaInstalacione']['created_mym'] = 0;
				}

				$this->request->data['ActaInstalacione']['consorcio_id'] = $this->Session->read('Auth.User.consorcio_id');
				$this->request->data['ActaInstalacione']['user_id'] = $this->Session->read('Auth.User.id');



				$data = str_replace(' ', '+', $this->request->data['graf']);
				$data_64= base64_decode($data);
				$filename = date('ymdhis').'.png';
				$im = imagecreatefromstring($data_64);

				// Save image in the specified location
				imagepng($im, APP.WEBROOT_DIR.'/files/graficos_acta_instal/'.$filename);
				//imagedestroy($im);
				$this->request->data['ActaInstalacione']['grafico'] = $filename;
					
				
				/* Guardar porcentaje de cumplimiento */
				$normas_incumplidas = 0;
				$normas_cumplidas = 0;
				
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_ilum_vent'] as $key => $value){
					if($value['inf_des_ilum_vent'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_orden_limp'] as $key => $value){
					if($value['inf_des_orden_limp'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_sshh'] as $key => $value){
					if($value['inf_des_sshh'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_sen_seg'] as $key => $value){
					if($value['inf_des_sen_seg'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_eq_emerg'] as $key => $value){
					if($value['inf_des_eq_emerg'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_cond_seg'] as $key => $value){
					if($value['inf_des_cond_seg'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				//$formula = ($normas_cumplidas * 100)/($normas_incumplidas + $normas_cumplidas);
				//$this->request->data['ActaInstalacione']['cumplimiento'] = $formula;
				
				$suma_normas = $normas_incumplidas + $normas_cumplidas;
				if($suma_normas > 0){
					$formula = ($normas_cumplidas * 100)/$suma_normas;
				}else{
					$formula = 0;
				}
				
				$this->request->data['ActaInstalacione']['cumplimiento'] = $formula;
				$this->request->data['ActaInstalacione']['total_cumplimiento'] = $normas_cumplidas;
				$this->request->data['ActaInstalacione']['total_incumplimiento'] = $normas_incumplidas;
				
				/* CREAMOS ACTA */
				$this->ActaInstalacione->create();
				if ($this->ActaInstalacione->save($this->request->data)) {

				
					
					/* Actos Subestándares*/
				/*if(!empty($this->request->data['ActoSubestandar'])){
					foreach($this->request->data['ActoSubestandar'] as $i){
							
						if($i['act_sub_tipo_id'] != ''){
								
							$new_ss_acta['ActosSubestandare']['acta_instalacion_id'] = $this->ActaInstalacione->id;
							$new_ss_acta['ActosSubestandare']['act_sub_tipo_id'] = $i['act_sub_tipo_id'];
							$new_ss_acta['ActosSubestandare']['codigo_id'] = $i['ni-id'];
								
							$this->ActosSubestandare->create();
							if ($this->ActosSubestandare->save($new_ss_acta)) {
								$as_id = $this->ActosSubestandare->id;
								// echo json_encode(array('success'=>true,'msg'=>__('El acto Subestándar fue agregado con &eacute;xito.'),'ActoSubestandar_id'=>$as_id));	
							}else{
								$as_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ActosSubestandare->validationErrors));
								//exit();
							}
						}
					}
				}*/
					
					/* Condiciones Subestándares*/
					/*if(!empty($this->request->data['CondiSubestandar'])){
						foreach($this->request->data['CondiSubestandar'] as $i){
							if($i['cond_sub_tipo_id'] != ''){
						
								$new_ee_acta['CondicionesSubestandare']['acta_instalacion_id'] = $this->ActaInstalacione->id;
								$new_ee_acta['CondicionesSubestandare']['cond_sub_tipo_id'] = $i['cond_sub_tipo_id'];
								$new_ee_acta['CondicionesSubestandare']['codigo_id'] = $i['ni-id'];
						
								$this->CondicionesSubestandare->create();
								if ($this->CondicionesSubestandare->save($new_ee_acta)) {
									$cs_id = $this->CondicionesSubestandare->id;
									// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
								}else{
									$cs_id = '';
									//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
									//exit();
								}
							}
						}
					}*/
					
					/* Cierre del acta de supervisión */
					/*if(!empty($this->request->data['MedidasAdoptadas'])){
						foreach($this->request->data['MedidasAdoptadas'] as $i){
							
							if($i['descripcion'] != ''){
									
								$new_cierre_acta['CierreActaInstalacione']['acta_instalacion_id'] = $this->ActaInstalacione->id;
								$new_cierre_acta['CierreActaInstalacione']['descripcion'] = $i['descripcion'];
									
								$this->CierreActaInstalacione->create();
								if ($this->CierreActaInstalacione->save($new_cierre_acta)) {
									$ca_id = $this->CierreActaInstalacione->id;
									// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
								}else{
									$ca_id = '';
									//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
									//exit();
								}
							}
						}
					}*/
					
					/* INSERTANDO IMAGENES ILUMINACIÓN Y VENTILACIÓN */
					if(!empty($this->request->data['FotoInstalIlumVent'])){
						$cont = 0;
						foreach ($this->request->data['FotoInstalIlumVent'] as $key=> $array):
							$imagen = $array['Imagen'][0];
							$new_foto_iv['FotoInstalIlumVent']['acta_id'] = $this->ActaInstalacione->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
							
							$new_foto_iv['FotoInstalIlumVent']['file_name'] = $new_file_name;
							$new_foto_iv['FotoInstalIlumVent']['observacion'] = $array['Observacion'][0];
							$this->FotoInstalIlumVent->create();
							if ($this->FotoInstalIlumVent->save($new_foto_iv)) {
								$foto_iv_id = $this->FotoInstalIlumVent->id;
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_ilum_vent/'.$new_foto_iv['FotoInstalIlumVent']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_ilum_vent/thumbnail/'.$new_foto_iv['FotoInstalIlumVent']['file_name']);

								//Backup Images
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_ilum_vent/'.$new_foto_iv['FotoInstalIlumVent']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_ilum_vent/thumbnail/'.$new_foto_iv['FotoInstalIlumVent']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							
								
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_iv_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
							$cont ++; 
						endforeach;
					}
					
					/* INSERTANDO IMAGENES ORDEN Y LIMPIEZA */
					if(!empty($this->request->data['FotoInstalOrdenLimpieza'])){
						$cont = 0;
						foreach ($this->request->data['FotoInstalOrdenLimpieza'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_ol['FotoInstalOrdenLimpieza']['acta_id'] = $this->ActaInstalacione->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_ol['FotoInstalOrdenLimpieza']['file_name'] = $new_file_name;
							$new_foto_ol['FotoInstalOrdenLimpieza']['observacion'] = $array['Observacion'][0];
							$this->FotoInstalOrdenLimpieza->create();
							if ($this->FotoInstalOrdenLimpieza->save($new_foto_ol)) {
								$foto_ol_id = $this->FotoInstalOrdenLimpieza->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_orden_limp/'.$new_foto_ol['FotoInstalOrdenLimpieza']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_orden_limp/thumbnail/'.$new_foto_ol['FotoInstalOrdenLimpieza']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_orden_limp/'.$new_foto_ol['FotoInstalOrdenLimpieza']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_orden_limp/thumbnail/'.$new_foto_ol['FotoInstalOrdenLimpieza']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_ol_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
					}
					
					
					
					/* INSERTANDO IMAGENES SERVICIOS HIGIENICOS */
					if(!empty($this->request->data['FotoInstalSshh'])){
						$cont = 0;
						foreach ($this->request->data['FotoInstalSshh'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_sshh['FotoInstalSshh']['acta_id'] = $this->ActaInstalacione->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_sshh['FotoInstalSshh']['file_name'] = $new_file_name;
							$new_foto_sshh['FotoInstalSshh']['observacion'] = $array['Observacion'][0];
							$this->FotoInstalSshh->create();
							if ($this->FotoInstalSshh->save($new_foto_sshh)) {
								$foto_sshh_id = $this->FotoInstalSshh->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_sshh/'.$new_foto_sshh['FotoInstalSshh']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_sshh/thumbnail/'.$new_foto_sshh['FotoInstalSshh']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sshh/'.$new_foto_sshh['FotoInstalSshh']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sshh/thumbnail/'.$new_foto_sshh['FotoInstalSshh']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_sshh_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
							$cont ++;
						}
					}
					
					/* INSERTANDO IMAGENES SEÑALES DE SEGURIDAD*/
					if(!empty($this->request->data['FotoInstalSenSeg'])){
						$cont = 0;
						foreach ($this->request->data['FotoInstalSenSeg'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_ss['FotoInstalSenSeg']['acta_id'] = $this->ActaInstalacione->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
							
							$new_foto_ss['FotoInstalSenSeg']['file_name'] = $new_file_name;
							$new_foto_ss['FotoInstalSenSeg']['observacion'] = $array['Observacion'][0];
							$this->FotoInstalSenSeg->create();
							if ($this->FotoInstalSenSeg->save($new_foto_ss)) {
								$foto_ss_id = $this->FotoInstalSenSeg->id;
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_sen_seg/'.$new_foto_ss['FotoInstalSenSeg']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_sen_seg/thumbnail/'.$new_foto_ss['FotoInstalSenSeg']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sen_seg/'.$new_foto_ss['FotoInstalSenSeg']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sen_seg/thumbnail/'.$new_foto_ss['FotoInstalSenSeg']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_ss_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
					}
					
					/* INSERTANDO IMAGENES EQUIPOS DE EMERCIAS*/
					if(!empty($this->request->data['FotoInstalEqEmerg'])){
						$cont = 0;
						foreach ($this->request->data['FotoInstalEqEmerg'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_ee['FotoInstalEqEmerg']['acta_id'] = $this->ActaInstalacione->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_ee['FotoInstalEqEmerg']['file_name'] = $new_file_name;
							$new_foto_ee['FotoInstalEqEmerg']['observacion'] = $array['Observacion'][0];
							$this->FotoInstalEqEmerg->create();
							if ($this->FotoInstalEqEmerg->save($new_foto_ee)) {
								$foto_ee_id = $this->FotoInstalEqEmerg->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_eq_emerg/'.$new_foto_ee['FotoInstalEqEmerg']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_eq_emerg/thumbnail/'.$new_foto_ee['FotoInstalEqEmerg']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_eq_emerg/'.$new_foto_ee['FotoInstalEqEmerg']['file_name']);	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_eq_emerg/thumbnail/'.$new_foto_ee['FotoInstalEqEmerg']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_ee_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
							$cont ++;
						}
					}
					
					/* INSERTANDO IMAGENES CONDICIONES DE SEGURIDAD*/
					if(!empty($this->request->data['FotoInstalCondSeg'])){
						$cont = 0;
						foreach ($this->request->data['FotoInstalCondSeg'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_med['FotoInstalCondSeg']['acta_id'] = $this->ActaInstalacione->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
					
							$new_foto_med['FotoInstalCondSeg']['file_name'] = $new_file_name;
							$new_foto_med['FotoInstalCondSeg']['observacion'] = $array['Observacion'][0];
							$this->FotoInstalCondSeg->create();
							if ($this->FotoInstalCondSeg->save($new_foto_med)) {
								$foto_cseg_id = $this->FotoInstalCondSeg->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_cond_seg/'.$new_foto_med['FotoInstalCondSeg']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_cond_seg/thumbnail/'.$new_foto_med['FotoInstalCondSeg']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_cond_seg/'.$new_foto_med['FotoInstalCondSeg']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_cond_seg/thumbnail/'.$new_foto_med['FotoInstalCondSeg']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_cseg_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
							$cont ++;
						}
					}

					/* INSERTANDO IMAGENES 	ACTA DE INSPECCIÓN DE SEGURIDAD */
					if(!empty($this->request->data['FotoInstalActInsSeg'])){
						$cont = 0;
						foreach ($this->request->data['FotoInstalActInsSeg'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_act_ins_seg['FotoInstalActInsSeg']['acta_id'] = $this->ActaInstalacione->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
					
							$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name'] = $new_file_name;
							$new_foto_act_ins_seg['FotoInstalActInsSeg']['observacion'] = $array['Observacion'][0];
							$this->FotoInstalActInsSeg->create();
							if ($this->FotoInstalActInsSeg->save($new_foto_act_ins_seg)) {
								$foto_act_ins_seg_id = $this->FotoInstalActInsSeg->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_act_ins_seg/'.$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_act_ins_seg/thumbnail/'.$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_act_ins_seg/'.$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_act_ins_seg/thumbnail/'.$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_act_ins_seg_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
							$cont ++;
						}
					}

					
					$acta_instalacion_id = $this->ActaInstalacione->id;
					echo json_encode(array('success'=>true,'msg'=>__('El Acta Instalación fue agregada con &eacute;xito.'),'ActaInstalacione_id'=>$acta_instalacion_id));
					exit();
				}else{
					$acta_instalacion_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ActaInstalacione->validationErrors));
					exit();
				}
		}
	}
	
	public function editar_informe_instalacion($acta_instalacion_id=null){
		$this->layout = 'acta';
		if(!isset($acta_instalacion_id)){
			echo json_encode(array('success'=>true,'msg'=>__('Esta acción no esta permitida')));
			$this->redirect(array('controller' => 'actas', 'action' => 'index'));
			exit();
		}
		$this->loadModel('ActaInstalacione');
		$this->loadModel('Empresa');
		$this->loadModel('Vehiculo');
		$this->loadModel('Actividade');
		$this->loadModel('Trabajadore');
		$this->loadModel('ImpProtPersonale');
		$this->loadModel('IppNormasIncumplida');
		$this->loadModel('UnidadesMovile');
		$this->loadModel('UmNormasIncumplida');
		$this->loadModel('ActosSubestandare');
		$this->loadModel('CondicionesSubestandare');
		$this->loadModel('CierreActaInstalacione');
		$this->loadModel('Codigo');
		$this->loadModel('FotoInstalIlumVent');
		$this->loadModel('FotoInstalOrdenLimpieza');
		$this->loadModel('FotoInstalSshh');
		$this->loadModel('FotoInstalSenSeg');
		$this->loadModel('FotoInstalEqEmerg');
		$this->loadModel('FotoInstalCondSeg');
		$this->loadModel('FotoInstalMed');
		$this->loadModel('FotoInstalActInsSeg');
		$this->loadModel('ActosSubestandaresTipo');
		$this->loadModel('CondicionesSubestandaresTipo');
		$this->loadModel('UnidadesNegocio');
		$this->loadModel('TipoLugare');
		
		$list_all_empresas = $this->Empresa->listEmpresas();
		$list_all_actas = $this->ActaInstalacione->listActaInstalaciones();
		$list_all_unidades_negocios = $this->UnidadesNegocio->listUnidadesNegocios();
		$list_all_trabajadores = $this->Trabajadore->listTrabajadores();
		$list_all_actividades = $this->Actividade->listActividades();
		$list_all_codigos = $this->Codigo->listCodigos();
		$list_all_vehiculos = $this->Vehiculo->listVehiculos();
		$list_all_tipos_actos_sub = $this->ActosSubestandaresTipo->listTipoActosSubEstandares();
		$list_all_tipos_condiciones_sub = $this->CondicionesSubestandaresTipo->listTipoCondicionesSubEstandares();
		$list_all_tipo_lugares = $this->TipoLugare->listTipoLugares();
		$this->set(compact('list_all_empresas','list_all_actas','list_all_trabajadores','list_all_actividades','list_all_codigos','list_all_vehiculos','list_all_tipos_actos_sub','list_all_tipos_condiciones_sub','list_all_unidades_negocios','list_all_tipo_lugares'));
	
	
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($acta_instalacion_id) && intval($acta_instalacion_id) > 0){
				
				$this->formatFecha($this->request->data['ActaInstalacione']['fecha']);
				
				//update
				$error_validation = '';
	
				$this->ActaInstalacione->id = $acta_instalacion_id;
				
				$this->request->data['ActaInstalacione']['json_ilum_vent'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_ilum_vent']);
				$this->request->data['ActaInstalacione']['json_orden_limpieza'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_orden_limp']);
				
				$this->request->data['ActaInstalacione']['json_sshh'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_sshh']);
				$this->request->data['ActaInstalacione']['json_sen_seg'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_sen_seg']);
				$this->request->data['ActaInstalacione']['json_eq_emerg'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_eq_emerg']);
				$this->request->data['ActaInstalacione']['json_cond_seg'] = json_encode($this->request->data['ActaInstalacione']['cumplimiento_cond_seg']);
				
				$this->request->data['ActaInstalacione']['info_des_conclusion'] = $this->request->data['ActaInstalacione']['info_des_conclusion'];
				$this->request->data['ActaInstalacione']['info_des_rec'] = $this->request->data['ActaInstalacione']['info_des_rec'];
				$this->request->data['ActaInstalacione']['info_des_med'] = $this->request->data['ActaInstalacione']['info_des_med'];

				$this->request->data['ActaInstalacione']['consorcio_id'] = $this->Session->read('Auth.User.consorcio_id');
				$this->request->data['ActaInstalacione']['user_id'] = $this->Session->read('Auth.User.id');


				if($this->request->data['ActaInstalacione']['grafico'] != ''){

					unlink(APP.WEBROOT_DIR.'/files/graficos_acta_instal/'.$this->request->data['ActaInstalacione']['grafico']);

					$data = str_replace(' ', '+', $this->request->data['graf']);
					$data_64= base64_decode($data);
					$filename = date('ymdhis').'.png';
					$im = imagecreatefromstring($data_64);
	
					// Save image in the specified location
					imagepng($im, APP.WEBROOT_DIR.'/files/graficos_acta_instal/'.$filename);
					$this->request->data['ActaInstalacione']['grafico'] = $filename;
					
					
				}else{
					$data = str_replace(' ', '+', $this->request->data['graf']);
					$data_64= base64_decode($data);
					$filename = date('ymdhis').'.png';
					$im = imagecreatefromstring($data_64);
	
					// Save image in the specified location
					imagepng($im, APP.WEBROOT_DIR.'/files/graficos_acta_instal/'.$filename);
					$this->request->data['ActaInstalacione']['grafico'] = $filename;
				}

								
				/* Guardar porcentaje de cumplimiento */
				$normas_incumplidas = 0;
				$normas_cumplidas = 0;
				
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_ilum_vent'] as $key => $value){
					if($value['inf_des_ilum_vent'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_orden_limp'] as $key => $value){
					if($value['inf_des_orden_limp'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_sshh'] as $key => $value){
					if($value['inf_des_sshh'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_sen_seg'] as $key => $value){
					if($value['inf_des_sen_seg'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_eq_emerg'] as $key => $value){
					if($value['inf_des_eq_emerg'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaInstalacione']['cumplimiento_cond_seg'] as $key => $value){
					if($value['inf_des_cond_seg'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				$suma_normas = $normas_incumplidas + $normas_cumplidas;
				if($suma_normas > 0){
					$formula = ($normas_cumplidas * 100)/$suma_normas;
				}else{
					$formula = 0;
				}
					
				$this->request->data['ActaInstalacione']['cumplimiento'] = $formula;
				$this->request->data['ActaInstalacione']['total_cumplimiento'] = $normas_cumplidas;
				$this->request->data['ActaInstalacione']['total_incumplimiento'] = $normas_incumplidas;
				
				
				//INICIO UPDATE FOTOS ILUMINACIÓN Y VENTILACIÓN

				if(!empty($this->request->data['FotoInstalIlumVent'])){
					$cont = 0;
					foreach ($this->request->data['FotoInstalIlumVent'] as $key=> $array):
					$imagen = $array['Imagen'][0];
					$new_foto_iv['FotoInstalIlumVent']['acta_id'] = $this->ActaInstalacione->id;
					$arr = explode(".", $imagen);
					$extension = strtolower(array_pop($arr));
					$new_file_name = time().$cont.'.'.$extension;
						
					$new_foto_iv['FotoInstalIlumVent']['file_name'] = $new_file_name;
					$new_foto_iv['FotoInstalIlumVent']['observacion'] = $array['Observacion'][0];
					$this->FotoInstalIlumVent->create();
					if ($this->FotoInstalIlumVent->save($new_foto_iv)) {
						$foto_iv_id = $this->FotoInstalIlumVent->id;
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_ilum_vent/'.$new_foto_iv['FotoInstalIlumVent']['file_name']);
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_ilum_vent/thumbnail/'.$new_foto_iv['FotoInstalIlumVent']['file_name']);

						//Backup Images
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_ilum_vent/'.$new_foto_iv['FotoInstalIlumVent']['file_name']);
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_ilum_vent/thumbnail/'.$new_foto_iv['FotoInstalIlumVent']['file_name']);


						unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
						unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
						// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
					}else{
						$foto_iv_id = '';
						//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
						//exit();
					}
					$cont ++;
					endforeach;
				}
				
				if(!empty($this->request->data['FotoIvUpdate'])){
					
					foreach ($this->request->data['FotoIvUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
						
						$this->FotoInstalIlumVent->id = $array['id'][0];
						
						$update_foto_iv['FotoInstalIlumVent']['observacion'] = $array['Observacion'][0];
						
						$this->FotoInstalIlumVent->save($update_foto_iv);
							
					}
					endforeach;
				}
				
				//INICIO UPDATE FOTOS ORDEN Y LIMPIEZA
				if(!empty($this->request->data['FotoInstalOrdenLimpieza'])){
						$cont = 0;
						foreach ($this->request->data['FotoInstalOrdenLimpieza'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_ol['FotoInstalOrdenLimpieza']['acta_id'] = $this->ActaInstalacione->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_ol['FotoInstalOrdenLimpieza']['file_name'] = $new_file_name;
							$new_foto_ol['FotoInstalOrdenLimpieza']['observacion'] = $array['Observacion'][0];
							$this->FotoInstalOrdenLimpieza->create();
							if ($this->FotoInstalOrdenLimpieza->save($new_foto_ol)) {
								$foto_ol_id = $this->FotoInstalOrdenLimpieza->id;
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_orden_limp/'.$new_foto_ol['FotoInstalOrdenLimpieza']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_orden_limp/thumbnail/'.$new_foto_ol['FotoInstalOrdenLimpieza']['file_name']);

								//Backup Images
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_orden_limp/'.$new_foto_ol['FotoInstalOrdenLimpieza']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_orden_limp/thumbnail/'.$new_foto_ol['FotoInstalOrdenLimpieza']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_ol_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
				}
				
				if(!empty($this->request->data['FotoOlUpdate'])){
						
					foreach ($this->request->data['FotoOlUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoInstalOrdenLimpieza->id = $array['id'][0];
				
						$update_foto_ol['FotoInstalOrdenLimpieza']['observacion'] = $array['Observacion'][0];
				
						$this->FotoInstalOrdenLimpieza->save($update_foto_ol);
							
					}
					endforeach;
				}
				
			
				//INICIO UPDATE FOTOS SERVICIO HIGIENICOS
				if(!empty($this->request->data['FotoInstalSshh'])){
					$cont = 0;
					foreach ($this->request->data['FotoInstalSshh'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_sshh['FotoInstalSshh']['acta_id'] = $this->ActaInstalacione->id;
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_sshh['FotoInstalSshh']['file_name'] = $new_file_name;
						$new_foto_sshh['FotoInstalSshh']['observacion'] = $array['Observacion'][0];
						$this->FotoInstalSshh->create();
						if ($this->FotoInstalSshh->save($new_foto_sshh)) {
							$foto_sshh_id = $this->FotoInstalSshh->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_sshh/'.$new_foto_sshh['FotoInstalSshh']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_sshh/thumbnail/'.$new_foto_sshh['FotoInstalSshh']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sshh/'.$new_foto_sshh['FotoInstalSshh']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sshh/thumbnail/'.$new_foto_sshh['FotoInstalSshh']['file_name']);

							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$foto_sshh_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
						$cont ++;
					}
				}
				
				if(!empty($this->request->data['FotoSshhUpdate'])){
				
					foreach ($this->request->data['FotoSshhUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoInstalSshh->id = $array['id'][0];
				
						$update_foto_sshh['FotoInstalSshh']['observacion'] = $array['Observacion'][0];
				
						$this->FotoInstalSshh->save($update_foto_sshh);
							
					}
					endforeach;
				}
				
				//INICIO UPDATE FOTOS SEÑALES DE SEGURIDAD
				if(!empty($this->request->data['FotoInstalSenSeg'])){
						$cont = 0;
						foreach ($this->request->data['FotoInstalSenSeg'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_ss['FotoInstalSenSeg']['acta_id'] = $this->ActaInstalacione->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
							
							$new_foto_ss['FotoInstalSenSeg']['file_name'] = $new_file_name;
							$new_foto_ss['FotoInstalSenSeg']['observacion'] = $array['Observacion'][0];
							$this->FotoInstalSenSeg->create();
							if ($this->FotoInstalSenSeg->save($new_foto_ss)) {
								$foto_ss_id = $this->FotoInstalSenSeg->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_sen_seg/'.$new_foto_ss['FotoInstalSenSeg']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_sen_seg/thumbnail/'.$new_foto_ss['FotoInstalSenSeg']['file_name']);

								//Backup Images
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sen_seg/'.$new_foto_ss['FotoInstalSenSeg']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sen_seg/thumbnail/'.$new_foto_ss['FotoInstalSenSeg']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_ss_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
				}
				
				if(!empty($this->request->data['FotoSsUpdate'])){
				
					foreach ($this->request->data['FotoSsUpdate'] as $key=> $array):
					if($array['id'][0] != ''){

						$this->FotoInstalSenSeg->id = $array['id'][0];
				
						$update_foto_ss['FotoInstalSenSeg']['observacion'] = $array['Observacion'][0];
				
						$this->FotoInstalSenSeg->save($update_foto_ss);
							
					}
					endforeach;
				}
				
				
				//INICIO UPDATE FOTOS EQUIPOS DE EMERGENCIAS
				if(!empty($this->request->data['FotoInstalEqEmerg'])){
					$cont = 0;
					foreach ($this->request->data['FotoInstalEqEmerg'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_ee['FotoInstalEqEmerg']['acta_id'] = $this->ActaInstalacione->id;
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_ee['FotoInstalEqEmerg']['file_name'] = $new_file_name;
						$new_foto_ee['FotoInstalEqEmerg']['observacion'] = $array['Observacion'][0];
						$this->FotoInstalEqEmerg->create();
						if ($this->FotoInstalEqEmerg->save($new_foto_ee)) {
							$foto_ee_id = $this->FotoInstalEqEmerg->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_eq_emerg/'.$new_foto_ee['FotoInstalEqEmerg']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_eq_emerg/thumbnail/'.$new_foto_ee['FotoInstalEqEmerg']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_eq_emerg/'.$new_foto_ee['FotoInstalEqEmerg']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_eq_emerg/thumbnail/'.$new_foto_ee['FotoInstalEqEmerg']['file_name']);

							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$foto_ee_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
						$cont ++;
					}
				}
				
				if(!empty($this->request->data['FotoEeUpdate'])){
				
					foreach ($this->request->data['FotoEeUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoInstalEqEmerg->id = $array['id'][0];
				
						$update_foto_ee['FotoInstalEqEmerg']['observacion'] = $array['Observacion'][0];
				
						$this->FotoInstalEqEmerg->save($update_foto_ee);
							
					}
					endforeach;
				}
				
				
				//INICIO UPDATE FOTOS CONDICIONES DE SEGURIDAD
				if(!empty($this->request->data['FotoInstalCondSeg'])){
					$cont = 0;
					foreach ($this->request->data['FotoInstalCondSeg'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_cseg['FotoInstalCondSeg']['acta_id'] = $this->ActaInstalacione->id;
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_cseg['FotoInstalCondSeg']['file_name'] = $new_file_name;
						$new_foto_cseg['FotoInstalCondSeg']['observacion'] = $array['Observacion'][0];
						$this->FotoInstalCondSeg->create();
						if ($this->FotoInstalCondSeg->save($new_foto_cseg)) {
							$foto_cseg_id = $this->FotoInstalCondSeg->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_cond_seg/'.$new_foto_cseg['FotoInstalCondSeg']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_cond_seg/thumbnail/'.$new_foto_cseg['FotoInstalCondSeg']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_cond_seg/'.$new_foto_cseg['FotoInstalCondSeg']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_cond_seg/thumbnail/'.$new_foto_cseg['FotoInstalCondSeg']['file_name']);

							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$foto_cseg_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
						$cont ++;
					}
				}
				
				if(!empty($this->request->data['FotoCsegUpdate'])){
				
					foreach ($this->request->data['FotoCsegUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoInstalCondSeg->id = $array['id'][0];
				
						$update_foto_ceseg['FotoInstalCondSeg']['observacion'] = $array['Observacion'][0];
				
						$this->FotoInstalCondSeg->save($update_foto_ceseg);
							
					}
					endforeach;
				}


				//INICIO UPDATE FOTOS CONCLUSIONES / RECOMENDACIONES Y MEDIDAS DE SEGURIDAD
				if(!empty($this->request->data['FotoInstalMed'])){
					$cont = 0;
					foreach ($this->request->data['FotoInstalMed'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_med['FotoInstalMed']['acta_id'] = $this->ActaInstalacione->id;

						/*debug("HOLA  ".$new_foto_med['FotoInstalMed']['acta_id']);
						exit();*/
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_med['FotoInstalMed']['file_name'] = $new_file_name;
						$new_foto_med['FotoInstalMed']['observacion'] = $array['Observacion'][0];
						$this->FotoInstalMed->create();
						if ($this->FotoInstalMed->save($new_foto_med)) {
							$foto_med_id = $this->FotoInstalMed->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_med/'.$new_foto_med['FotoInstalMed']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_med/thumbnail/'.$new_foto_med['FotoInstalMed']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_med/'.$new_foto_med['FotoInstalMed']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_med/thumbnail/'.$new_foto_med['FotoInstalMed']['file_name']);

							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$foto_med_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
						$cont ++;
					}
				}

				if(!empty($this->request->data['FotoMedUpdate'])){
				
					foreach ($this->request->data['FotoMedUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoInstalMed->id = $array['id'][0];
				
						$update_foto_med['FotoInstalMed']['observacion'] = $array['Observacion'][0];
				
						$this->FotoInstalMed->save($update_foto_med);
							
					}
					endforeach;
				}

				//INICIO UPDATE FOTOS ACTA DE INSPECCIÓN DE SEGURIDAD
				if(!empty($this->request->data['FotoInstalActInsSeg'])){
					$cont = 0;
					foreach ($this->request->data['FotoInstalActInsSeg'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_act_ins_seg['FotoInstalActInsSeg']['acta_id'] = $this->ActaInstalacione->id;

						/*debug("HOLA  ".$new_foto_act_ins_seg['FotoInstalActInsSeg']['acta_id']);
						exit();*/
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name'] = $new_file_name;
						$new_foto_act_ins_seg['FotoInstalActInsSeg']['observacion'] = $array['Observacion'][0];
						$this->FotoInstalActInsSeg->create();
						if ($this->FotoInstalActInsSeg->save($new_foto_act_ins_seg)) {
							$foto_act_ins_seg_id = $this->FotoInstalActInsSeg->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_act_ins_seg/'.$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_instal_act_ins_seg/thumbnail/'.$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_act_ins_seg/'.$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_act_ins_seg/thumbnail/'.$new_foto_act_ins_seg['FotoInstalActInsSeg']['file_name']);

							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$foto_act_ins_seg_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
						$cont ++;
					}
				}

				if(!empty($this->request->data['FotoInstalActInsSegUpdate'])){
				
					foreach ($this->request->data['FotoInstalActInsSegUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoInstalActInsSeg->id = $array['id'][0];
				
						$update_foto_act_ins_seg['FotoInstalActInsSeg']['observacion'] = $array['Observacion'][0];
				
						$this->FotoInstalActInsSeg->save($update_foto_act_ins_seg);
							
					}
					endforeach;
				}
				
				
				//INICIO UPDATE ACTA EN A INSTALACIONES
				//debug($this->request->data);
				if ($this->ActaInstalacione->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'ActaInstalacione_id'=>$acta_instalacion_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ActaInstalacione->validationErrors));
					exit();
				}
				
			}
		}else{
			$obj_acta = $this->ActaInstalacione->findById($acta_instalacion_id);
			if(($this->Session->read('Auth.User.tipo_user_id') == 1) || ($this->Session->read('Auth.User.id') == $obj_acta->getAttr('reponsable_sup_id') || ($this->Session->read('Auth.User.tipo_user_id') == 3))){
				$this->request->data = $obj_acta->data;
				$this->set(compact('acta_instalacion_id','obj_acta'));
			}else{
				throw new NotFoundException();
			}
			
		}
	}
	
	public function delete_acta(){
		$this->layout = 'ajax';
	
		$this->loadModel('ActaInstalacione');
	
		if($this->request->is('post')){
			$acta_instalacion_id = $this->request->data['acta_instalacion_id'];
			
			$obj_acta = $this->ActaInstalacione->findById($acta_instalacion_id);
			if($obj_acta->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->ActaInstalacione->deleteActaInstalacione($acta_instalacion_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();*/
		}
	
	
	}
	
	public function ajax_list_empresa(){
		$this->autoRender = false;
		$this->loadModel('Empresa');
		$lista = "";
		$arr_obj_empresa = $this->Empresa->find('list',
				array(
						'fields' => array('id','nombre'),
						'order' => array('Empresa.nombre ASC'),
				));
		
		foreach ($arr_obj_empresa as $id => $nombre):
			$lista.= json_encode(array("value"=> $nombre, "id"=>$id)).",";
			//$lista.= '{value:"'.$nombre.'",data: "'.$id.'"},';
			//$lista.= '{"value":"'.utf8_encode($nombre).'", "data": "'.$id.'"},';
		endforeach;
		
		$lista = substr($lista, 0,strlen($lista) - 1);
		//$lista = json_encode(array("value"=>"vladi to", "data"=>"hola"));
		
		$h= '{"suggestions": ['.$lista.']}';
		return $h;
	}
	
	public function ajax_list_trabajador(){
		$this->autoRender = false;
		$this->loadModel('Trabajadore');
		$lista = "";
		
		
		$arr_obj_trabajador = $this->Trabajadore->find('list',
				array(
						'fields' => array('id','apellido_nombre'),
						'conditions'=>array('Trabajadore.estado != ' => 0),
						'order' => array('Trabajadore.apellido_nombre ASC')
				));
	
		foreach ($arr_obj_trabajador as $id => $trabajador):
		$lista.= json_encode(array("value"=> $trabajador, "id"=>$id)).",";
		endforeach;
	
		$lista = substr($lista, 0,strlen($lista) - 1);
	
		$h= '{"suggestions": ['.$lista.']}';
		return $h;
	}
	
	
	public function ajax_actividad_trabajador(){
		$this->autoRender = false;
		$this->loadModel('Trabajadore');
		$this->loadModel('Actividade');
	
		if($this->request->is('post')){
			$trabajador_id = $this->request->data['trabajador_id'];
			$obj_trabajadore = $this->Trabajadore->findObjects('first',
					array(
							'joins' => array(
									array(
											'table' => 'actividades',
											'alias' => 'ActividadeJoin',
											'type' => 'INNER',
											'conditions' => array(
													'ActividadeJoin.id = Trabajadore.actividade_id'
											)
									)
							),
							'conditions'=>array(
									'Trabajadore.id'=> $trabajador_id
							),
							//'fields' => array('id','apellido_nombre'),
					));
			
			//foreach ($arr_obj_trabajadore as $trabajadore):
			$nombre_actividad = $obj_trabajadore->Actividade->getAttr('descripcion');
			$id_actividad = $obj_trabajadore->Actividade->getID();
			//endforeach;
		}
		return json_encode(array('success'=>true,'id'=>$id_actividad, 'nombre_actividad'=>$nombre_actividad));
	}
	
	public function ajax_vehiculo_placa(){
		$this->autoRender = false;
		$this->loadModel('Vehiculo');
		$this->loadModel('TipoVehiculo');
	
		if($this->request->is('post')){
			$placa_id = $this->request->data['placa_id'];
			$obj_placa = $this->Vehiculo->findObjects('first',
					array(
							'joins' => array(
									array(
											'table' => 'tipo_vehiculos',
											'alias' => 'TipoVehiculoJoin',
											'type' => 'INNER',
											'conditions' => array(
													'TipoVehiculoJoin.id = Vehiculo.tipo_vehiculo_id'
											)
									)
							),
							'conditions'=>array(
									'Vehiculo.id'=> $placa_id
							),
							//'fields' => array('id','apellido_nombre'),
					));
				
			//foreach ($arr_obj_trabajadore as $trabajadore):
			$tipo_vehiculo = $obj_placa->TipoVehiculo->getAttr('descripcion');
			$id_tipo_vehiculo = $obj_placa->TipoVehiculo->getID();
			//endforeach;
		}
		return json_encode(array('success'=>true,'id'=>$id_tipo_vehiculo, 'nombre_vehiculo'=>$tipo_vehiculo));
	}
	
	
	public function ajax_trabajador_dni(){
		$this->autoRender = false;
		$this->loadModel('Trabajadore');
	
		if($this->request->is('post')){
			$trabajador_id = $this->request->data['trabajador_id'];
			$arr_obj_trabajadore = $this->Trabajadore->findObjects('all',
					array(
							'conditions'=>array(
									'Trabajadore.id'=> $trabajador_id
							),
							//'fields' => array('id','apellido_nombre'),
					));
				
			foreach ($arr_obj_trabajadore as $trabajadore):
			$dni = $trabajadore->getAttr('nro_sshhumento');
			endforeach;
		}
		return $dni;
	}
	
	public function ajax_list_actividad(){
		$this->autoRender = false;
		$this->loadModel('Actividade');
		$lista = "";
	
	
		$arr_obj_actividad = $this->Actividade->find('list',
				array(
						'fields' => array('id','descripcion'),
						'order' => array('Actividade.descripcion ASC'),
				));
	
		foreach ($arr_obj_actividad as $id => $actividad):
		$lista.= json_encode(array("value"=> $actividad, "id"=>$id)).",";
		endforeach;
	
		$lista = substr($lista, 0,strlen($lista) - 1);
	
		$h= '{"suggestions": ['.$lista.']}';
		return $h;
	}
	
	public function ajax_list_codigo(){
		$this->autoRender = false;
		$this->loadModel('Codigo');
		$lista = "";
	
	
		$arr_obj_codigo = $this->Codigo->find('list',
				array(
						'fields' => array('id','codigo'),
						'order' => array('Codigo.codigo ASC'),
				));
	
		foreach ($arr_obj_codigo as $id => $codigo):
		$lista.= json_encode(array("value"=> $codigo, "id"=>$id)).",";
		endforeach;
	
		$lista = substr($lista, 0,strlen($lista) - 1);
	
		$result= '{"suggestions": ['.$lista.']}';
		return $result;
	}
	
	
	public function ajax_list_placa(){
		$this->autoRender = false;
		$this->loadModel('Vehiculo');
		$lista = "";
	
	
		$arr_obj_vehiculo = $this->Vehiculo->find('list',
				array(
						'fields' => array('id','nro_placa'),
						'order' => array('Vehiculo.nro_placa ASC'),
				));
	
		foreach ($arr_obj_vehiculo as $id => $vehiculo):
		$lista.= json_encode(array("value"=> $vehiculo, "id"=>$id)).",";
		endforeach;
	
		$lista = substr($lista, 0,strlen($lista) - 1);
	
		$result= '{"suggestions": ['.$lista.']}';
		return $result;
	}
	
	
	function formatFecha($fecha){
		if(isset($fecha)){
			$fec_nac = $fecha;//12-12-1990
	
			if($fecha == '' || $fecha == NULL){
				$fecha = '';
			}else{
				$dd = substr($fecha, 0, 2);
				$mm = substr($fecha, 3, 2);
				$yy = substr($fecha, 6, 4);
				$time= substr($fecha, 11, 8);
				$fecha = $yy.'-'.$mm.'-'.$dd;//1990-12-12
			}
			$this->request->data['ActaInstalacione']['fecha'] = $fecha.' '.$time;
		}
	
		return $this->request->data['ActaInstalacione']['fecha'];
	}
	
	/*public function add_file_iv(){
		$this->layout = 'ajax';
		$this->loadModel('Actividade');
		$this->loadModel('Trabajadore');
		$this->loadModel('Codigo');
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
		
		$list_all_trabajadores = $this->Trabajadore->listTrabajadores();
		$list_all_actividades = $this->Actividade->listActividades();
		$list_all_codigos = $this->Codigo->listCodigos();
		//$list_all_vehiculos = $this->Vehiculo->listVehiculos();
		$this->set(compact('list_all_trabajadores','list_all_actividades','list_all_codigos','long_table'));
	}
	
	public function add_file_um(){
		$this->layout = 'ajax';
		$this->loadModel('Vehiculo');
		$this->loadModel('Codigo');
		
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$list_all_codigos = $this->Codigo->listCodigos();
		$list_all_vehiculos = $this->Vehiculo->listVehiculos();
		$this->set(compact('list_all_vehiculos','list_all_codigos','long_table'));
	}
	
	public function add_file_ss(){
		$this->layout = 'ajax';
		$this->loadModel('ActosSubestandaresTipo');
		$this->loadModel('Codigo');
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$list_all_tipos_actos_sub = $this->ActosSubestandaresTipo->listTipoActosSubEstandares();
		$list_all_codigos = $this->Codigo->listCodigos();
		$this->set(compact('list_all_tipos_actos_sub','list_all_codigos','long_table'));
	}
	
	public function add_file_ee(){
		$this->layout = 'ajax';
		$this->loadModel('Codigo');
		$this->loadModel('CondicionesSubestandaresTipo');
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$list_all_codigos = $this->Codigo->listCodigos();
		$list_all_tipos_condiciones_sub = $this->CondicionesSubestandaresTipo->listTipoCondicionesSubEstandares();
		$this->set(compact('list_all_tipos_condiciones_sub','list_all_codigos','long_table'));
	}*/
	
	public function add_row_cond_seg(){
		$this->layout = 'ajax';

		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}

		$this->set(compact('long_table'));
	}
	
	public function add_row_eq_emerg(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function add_row_eq_sshh(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function add_row_ilum_vent(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function add_row_orden_limp(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function add_row_sen_seg(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function view_informe($acta_instalacion_id = null){

		ini_set('memory_limit', '512M');
		$this->loadModel('ActaInstalacione');
		$this->loadModel('Actividade');
		$obj_acta = $this->ActaInstalacione->findById($acta_instalacion_id);

		$this->layout= 'layout_view_pdf_insp_seguridad';	
		/*if($this->Session->read('Auth.User.tipo_user_id') == 3){
			$this->layout= 'layout_view_pdf_ensa';	
		}else{
			if($obj_acta->getAttr('vers_cambios')==1){
				$this->layout = 'layout_view_pdf1';
			}else{
				// Cambio de direccion que solo afecte a las actas creadas a partir de la nueva fecha
				if($obj_acta->getAttr('created')>='2016-11-07' && $obj_acta->getAttr('created')<'2017-02-08'){
					$this->layout = 'layout_view_pdf3';
				}elseif($obj_acta->getAttr('created')>='2017-02-08'){
					$this->layout = 'layout_view_pdf4';
				}else{
					$this->layout = 'layout_view_pdf2';
				}
			}
		}*/
				
		if(!isset($acta_instalacion_id)){
			echo json_encode(array('success'=>true,'msg'=>__('Esta acción no esta permitida')));
			$this->redirect(array('controller' => 'actas', 'action' => 'index'));
			exit();
		}

		$cargo_supervisor = $this->Actividade->getNombreCargo($obj_acta->getAttr('reponsable_sup_cargo_id'));
				
		$info_ni_t = $this->ActaInstalacione->infoNiT($acta_instalacion_id);
		$info_ni_v = $this->ActaInstalacione->infoNiV($acta_instalacion_id);
		
		$obj_acta_ref = array();
		if($obj_acta->getAttr('acta_referencia')!= 0){
			$informe_ref_id = $obj_acta->getAttr('acta_referencia');
			$obj_acta_ref = $this->ActaInstalacione->findById($informe_ref_id);
		}

		$this->set(compact('obj_acta','obj_acta_ref','info_ni_t','info_ni_v', 'cargo_supervisor'));
	}
	
	public function send_reporte_email()
	{
		$this->autoRender = false;
		$this->loadModel('ActaInstalacione');
		
			if(isset($this->request->data) || $this->request->is('post')){
				//debug($this->request->data);exit();
				$acta_instalacion_id = $this->request->data['acta_instalacion_id'];
				$obj_acta = $this->ActaInstalacione->findById($acta_instalacion_id);
				$num_informe = $obj_acta->getAttr('num_informe'); //Obtengo el número de informe
				$email_destino = $this->request->data['SendEmail']['email_destino'];
				$email_copia = $this->request->data['SendEmail']['email_copia'];
				$asunto = $this->request->data['SendEmail']['asunto'];
				$mensaje = $this->request->data['SendEmail']['mensaje'];
				$error_validation = false;
					
				if($asunto == ''){
					$arr_validation['asunto'] = array(__('Debe ingresar el Asunto'));
					$error_validation = true;
				}
					
				if($email_copia != ''){
					/*if(!Validation::email($email_copia)){
					 $arr_validation['asunto'] = array(__('Debe ingresar un email v&aacute;lido'));
					$error_validation = true;
					}*/
				}
					
				if($email_destino != ''){
					/*if(!Validation::email($email_destino)){
					 $arr_validation['email_destino'] = array(__('Debe ingresar un email v&aacute;lido'));
					$error_validation = true;
					}*/
				}else{
					$arr_validation['email_destino'] = array(__('Debe ingresar un email de destino'));
					$error_validation = true;
				}
				
				if($error_validation == false){
					$this->save_pdf($acta_instalacion_id);
					$this->ActaInstalacione->sendReporteEmail($acta_instalacion_id, $email_destino, $email_copia, $num_informe, $asunto, $mensaje);
					/* Save Emails enviados */
					$this->loadModel('EmailsEnviado');
					$arr_email_send['EmailsEnviado']['acta_instalacion_id'] = $acta_instalacion_id;
					$arr_email_send['EmailsEnviado']['emails_destino'] = $email_destino;
					$arr_email_send['EmailsEnviado']['emails_copy'] = $email_copia;
					$arr_email_send['EmailsEnviado']['asunto'] = $asunto;
					$this->EmailsEnviado->create();
					$this->EmailsEnviado->save($arr_email_send);
					/* End */
					$obj_acta->saveField('fecha_envio', date('Y-m-d'));
					echo json_encode(array('success'=>true,'msg'=>__('El Informe fue enviado')));
					exit();
				}
					
				if($error_validation == true){
					echo json_encode(array('success' =>false, 'msg' => __('No se pudo guardar'), 'validation' => $arr_validation));
					exit();
				}
			}
		
	}
	
	
	/* ELIMINAR FOTOS ILUMINCACIÓN Y VENTILACIÓN*/
	public function delete_foto_iv()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoInstalIlumVent');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoInstalIlumVent->deleteAll(array('FotoInstalIlumVent.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_ilum_vent/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_ilum_vent/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_ilum_vent/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_ilum_vent/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_ilum_vent/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_ilum_vent/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_ilum_vent/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_ilum_vent/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	/* ELIMINAR FOTOS ORDEN Y LIMPIEZA*/
	public function delete_foto_ol()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoInstalOrdenLimpieza');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoInstalOrdenLimpieza->deleteAll(array('FotoInstalOrdenLimpieza.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_orden_limp/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_orden_limp/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_orden_limp/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_orden_limp/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_orden_limp/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_orden_limp/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_orden_limp/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_orden_limp/thumbnail/'.$file_name);
				}

				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	
	/* ELIMINAR FOTOS SSHH  */
	public function delete_foto_sshh()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoInstalSshh');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoInstalSshh->deleteAll(array('FotoInstalSshh.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_sshh/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_sshh/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_sshh/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_sshh/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sshh/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sshh/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sshh/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sshh/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	public function delete_foto_ss()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoInstalSenSeg');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoInstalSenSeg->deleteAll(array('FotoInstalSenSeg.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_sen_seg/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_sen_seg/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_sen_seg/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_sen_seg/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sen_seg/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sen_seg/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sen_seg/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_sen_seg/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	public function delete_foto_ee()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoInstalEqEmerg');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoInstalEqEmerg->deleteAll(array('FotoInstalEqEmerg.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_eq_emerg/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_eq_emerg/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_eq_emerg/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_eq_emerg/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_eq_emerg/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_eq_emerg/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_eq_emerg/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_eq_emerg/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	public function delete_foto_cseg()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoInstalCondSeg');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoInstalCondSeg->deleteAll(array('FotoInstalCondSeg.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_cond_seg/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_cond_seg/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_cond_seg/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_cond_seg/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_cond_seg/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_cond_seg/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_cond_seg/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_cond_seg/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}

	public function delete_foto_med()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoInstalMed');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoInstalMed->deleteAll(array('FotoInstalMed.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_med/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_med/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_med/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_med/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_med/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_med/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_med/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_med/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}

	public function delete_foto_act_ins_seg()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoInstalActInsSeg');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoInstalActInsSeg->deleteAll(array('FotoInstalActInsSeg.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_act_ins_seg/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_act_ins_seg/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_instal_act_ins_seg/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_instal_act_ins_seg/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_act_ins_seg/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_act_ins_seg/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_act_ins_seg/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_instal_act_ins_seg/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	public function activar_revisado(){
		$this->layout = 'ajax';
	
		$this->loadModel('ActaInstalacione');
	
		if($this->request->is('post')){
			$acta_instalacion_id = $this->request->data['acta_instalacion_id'];
			$value_check = $this->request->data['value_check'];
				
			$obj_acta = $this->ActaInstalacione->findById($acta_instalacion_id);
			if($obj_acta->saveField('revisado', $value_check)){
				echo json_encode(array('success'=>true,'msg'=>__('El cambio se realiz&oacute; con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->ActaInstalacione->deleteActaInstalacione($acta_instalacion_id)){
			 echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
			//exit();
			}else{
			echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
			//exit();
			}
			exit();*/
		}
	}

	public function save_pdf($acta_instalacion_id){
		$source = ENV_WEBROOT_FULL_URL."/actas/view_informe/".$acta_instalacion_id;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $source);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSLVERSION,3);
		$data = curl_exec ($ch);
		$error = curl_error($ch); 
		curl_close ($ch);
		
		$this->loadModel('ActaInstalacione');
		$obj_acta = $this->ActaInstalacione->findById($acta_instalacion_id);
		
		$destination = APP.WEBROOT_DIR."/files/pdf/".str_replace('/','-',$obj_acta->getAttr('num_informe')).".pdf";
		$file = fopen($destination, "w+");
		fputs($file, $data);
		fclose($file);
	}

	public function ajax_normas_info_ref(){
		$this->autoRender = false;
		$this->loadModel('ActaInstalacione');
	
		if($this->request->is('post')){
			$informe_ref_id = $this->request->data['id_informe_ref'];
			$obj_acta = $this->ActaInstalacione->findObjects('first',
					array(
							'conditions'=>array(
									'ActaInstalacione.id'=> $informe_ref_id
							),
							//'fields' => array('id','apellido_nombre'),
					));
			
			//foreach ($arr_obj_trabajadore as $trabajadore):
			$normas_iv = $obj_acta->getAttr('info_des_epp');
			$normas_ol = $obj_acta->getAttr('info_des_se_de');
			$normas_um = $obj_acta->getAttr('info_des_um');
			$normas_ds = $obj_acta->getAttr('info_des_sshh');
			$normas_cp = $obj_acta->getAttr('info_des_act');
			$normas_ac = $obj_acta->getAttr('info_des_cond');

		
			//endforeach;
		}
		return json_encode(array('success'=>true,'normas'=> array('normas_iv' => $normas_iv, 'normas_ol'=>$normas_ol, 'normas_um'=>$normas_um, 'normas_ds'=>$normas_ds, 'normas_cp'=>$normas_cp, 'normas_ac'=>$normas_ac)));
	}

	public function ajax_export_report_pdf (){
		ini_set('memory_limit', '512M');
		ini_set('max_execution_time', 1000);
		$this->layout = "layout_export_report_pdf";

		$this->loadModel('ActaInstalacione');
		$this->loadModel('Empresa');
		$this->loadModel('UnidadesNegocio');

		/*$fec_inicio = $_POST['data[RptTotalNiNc][fec_inicio]'];
		$fec_fin = $_POST['data[RptTotalNiNc][fec_fin]'];
		$empresa = $_POST['data[RptTotalNiNc][empresa][]'];
		$uunn = $_POST['data[RptTotalNiNc][uunn][]'];
		$img = $_POST['graf'];*/

		if($this->request->is('post') || $this->request->is('put')){
		
			$uunns =array();
			$empresas = array();

			$empresas =  $this->request->data['RptTotalNiNc']['empresa'];
			$uunns =  $this->request->data['RptTotalNiNc']['uunn'];


			$nombre_empresas = $this->Empresa->find('list', array(
			'fields' => array('Empresa.nombre'), 
			'conditions' => array(
				'Empresa.id' => $empresas
				)
			));


			$nombre_uunns = $this->UnidadesNegocio->find('list', array(
				'fields' => array('UnidadesNegocio.descripcion'), 
				'conditions' => array(
					'UnidadesNegocio.id' => $uunns
					)
				));

			$fec_inicio = $this->formatFecha($this->request->data['RptTotalNiNc']['fec_inicio']);
			$fec_fin =  $this->formatFecha($this->request->data['RptTotalNiNc']['fec_fin']);

			$user_id = $this->Session->read('Auth.User.id');

			$data = str_replace(' ', '+', $this->request->data['graf']);
			$data_64= base64_decode($data);
			//$filename = date('ymdhis').'.png';
			$filename = $user_id;
			$im = imagecreatefromstring($data_64);

			// Save image in the specified location
			if(file_exists(APP.WEBROOT_DIR.'/files/pdf_informes/'.$filename)){
				unlink(APP.WEBROOT_DIR.'/files/pdf_informes/'.$filename);
			}
				imagepng($im, APP.WEBROOT_DIR.'/files/pdf_informes/'.$filename);

			//imagedestroy($im);
			
			$list_total_ni_nc = $this->ActaInstalacione->listTotalNiNc2($fec_inicio, $fec_fin, $empresas, $uunns);

			//debug($list_total_ni_nc); exit();
			
			$sum_nc_epp = 0 ; $sum_ni_epp= 0; $sum_nc_ol= 0; $sum_ni_ol= 0; $sum_nc_um= 0; $sum_ni_um=0; $sum_nc_sshh=0; $sum_ni_sshh=0; $sum_nc_cp= 0;
			$sum_ni_cp = 0; $sum_nc_ac= 0; $sum_ni_ac= 0;

			foreach ($list_total_ni_nc as $row_acta):
				if($row_acta->getAttr('info_des_epp') != ""){
					$info_des_epp = json_decode($row_acta->getAttr('info_des_epp'));
					foreach($info_des_epp as $value){
						if($value->info_des_epp != ""){
							if($value->alternativa == 1){
								$sum_nc_epp++;
							}elseif($value->alternativa == 0){
								$sum_ni_epp++;
							}else{

							}
						}
					}
				}

				if($row_acta->getAttr('info_des_se_de') != ""){
					$info_des_se_de = json_decode($row_acta->getAttr('info_des_se_de'));
					foreach($info_des_se_de as $value):
						if($value->info_des_se_de != ""){
							if($value->alternativa == 1){
								$sum_nc_ol++;
							}elseif($value->alternativa == 0){
								$sum_ni_ol++;
							}else{
								
							}
						}
					endforeach;
				}
					

				if($row_acta->getAttr('info_des_um') != ""){
					$info_des_um = json_decode($row_acta->getAttr('info_des_um'));
					foreach($info_des_um as $value):
						if($value->info_des_um != ""){
							if($value->alternativa == 1){
								$sum_nc_um++;
							}elseif($value->alternativa == 0){
								$sum_ni_um++;
							}else{
								
							}
						}
					endforeach;
				}

				if($row_acta->getAttr('info_des_sshh') != ""){
					$info_des_sshh = json_decode($row_acta->getAttr('info_des_sshh'));
					foreach($info_des_sshh as $value):
						if($value->info_des_sshh != ""){
							if($value->alternativa == 1){
								$sum_nc_sshh++;
							}elseif($value->alternativa == 0){
								$sum_ni_sshh++;
							}else{
								
							}
						}
					endforeach;
				}

				if($row_acta->getAttr('info_des_act') != ""){ //cambiar abreviatura "ac" x cp
					$info_des_act = json_decode($row_acta->getAttr('info_des_act'));
					foreach($info_des_act as $value):
						if($value->info_des_act != ""){
							if($value->alternativa == 1){
								$sum_nc_cp++; 
							}elseif($value->alternativa == 0){
								$sum_ni_cp++;
							}else{
								
							}
						}
					endforeach;
				}

				if($row_acta->getAttr('info_des_cond') != ""){ 
					$info_des_cond = json_decode($row_acta->getAttr('info_des_cond'));
					foreach($info_des_cond as $value):
						if($value->info_des_cond != ""){
							if($value->alternativa == 1){
								$sum_nc_ac++; 
							}elseif($value->alternativa == 0){
								$sum_ni_ac++;
							}else{
								
							}
						}
					endforeach;
				}

			endforeach;

			$sum_normas_cumplidas = round($sum_nc_epp + $sum_nc_ol + $sum_nc_um + $sum_nc_sshh + $sum_nc_cp + $sum_nc_ac);
			$sum_normas_incumplidas = round($sum_ni_epp + $sum_ni_ol + $sum_ni_um + $sum_ni_sshh + $sum_ni_cp + $sum_ni_ac);
			$suma_total_normas = $sum_normas_cumplidas + $sum_normas_incumplidas;

			if($suma_total_normas > 0){
				$porc_nc = round(($sum_normas_cumplidas * 100) / $suma_total_normas);
				$porc_ni = round(($sum_normas_incumplidas * 100) / $suma_total_normas);	
			}else{
				$porc_nc = 0;
				$porc_ni = 0;
			}
				
		}


			$this->set(compact('filename','fec_inicio','fec_fin','nombre_empresas','nombre_uunns','list_total_ni_nc'));
			$this->set(compact('sum_nc_epp', 'sum_nc_ol', 'sum_nc_um', 'sum_nc_sshh', 'sum_nc_cp', 'sum_nc_ac'));
			$this->set(compact('sum_ni_epp', 'sum_ni_ol', 'sum_ni_um', 'sum_ni_sshh', 'sum_ni_cp', 'sum_ni_ac'));
			$this->set(compact('sum_normas_cumplidas', 'sum_normas_incumplidas', 'suma_total_normas','porc_nc','porc_ni'));
	}
		
}