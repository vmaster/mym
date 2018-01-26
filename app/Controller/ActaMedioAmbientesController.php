<?php
class ActaMedioAmbientesController extends AppController{
	public $name = 'ActaMedioAmbiente';
	public $components = array('RequestHandler');
	
	public function beforeFilter(){
		$this->Auth->allow(array('view_informe_instal','save_pdf'));
		parent::beforeFilter();
		//$this->layout = 'default';
	}
	public function index($page=null,$order_by=null,$order_by_or=null,$search_nro=null,$search_actividad=null,$search_empresa=null,$search_obra=null) {
		$this->layout = "default";
		$this->loadModel('ActaMedioAmbiente');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
		

		$order_by = 'ActaMedioAmbiente.created';
		
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
		$list_acta_all = $this->ActaMedioAmbiente->listAllActaMedAmb($order_by,$search_nro, utf8_encode($search_actividad),utf8_encode($search_empresa),utf8_encode($search_obra),$order_by_or, $tipo_user_id);
		$list_acta = $this->ActaMedioAmbiente->listFindActaMedAmb($order_by, $search_nro, utf8_encode($search_actividad),utf8_encode($search_empresa),utf8_encode($search_obra), date('Y'),$order_by_or, $start, $per_page, $tipo_user_id);
		$count = count($list_acta_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_acta','page','no_of_paginations'));
	}
	
	public function search_actas($search_ano=null) {
		$this->layout = 'ajax';
		$this->loadModel('ActaMedioAmbiente');
		$tipo_user_id = $this->Session->read('Auth.User.tipo_user_id');
		$list_acta = $this->ActaMedioAmbiente->listSearchActaMedAmb($search_ano, $tipo_user_id);

		$this->set(compact('list_acta'));
	}
	
		
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function nuevo_informe_med_amb($acta_med_amb_id=null){
		$this->verificarAccessoInvitado();

		$this->layout = 'acta';
		
		$this->loadModel('ActaMedioAmbiente');
		$this->loadModel('Empresa');
		$this->loadModel('Vehiculo');
		$this->loadModel('Actividade');
		$this->loadModel('Trabajadore');
		$this->loadModel('Codigo');
		$this->loadModel('FotoMedAmbDoc');
		$this->loadModel('FotoMedAmbCond');
		$this->loadModel('FotoMedAmbMedida');
		$this->loadModel('FotoMedAmbActa');
		$this->loadModel('ActosSubestandaresTipo');
		$this->loadModel('CondicionesSubestandaresTipo');
		$this->loadModel('UnidadesNegocio');
		$this->loadModel('TipoLugare');
		
		$list_all_empresas = $this->Empresa->listEmpresas();
		$list_all_actas = $this->ActaMedioAmbiente->listActaMedAmb();
		$list_all_unidades_negocios = $this->UnidadesNegocio->listUnidadesNegocios();
		$list_all_trabajadores = $this->Trabajadore->listTrabajadores();
		$list_all_actividades = $this->Actividade->listActividades();
		$list_all_codigos = $this->Codigo->listCodigos();
		$list_all_vehiculos = $this->Vehiculo->listVehiculos();
		$list_all_tipos_actos_sub = $this->ActosSubestandaresTipo->listTipoActosSubEstandares();
		$list_all_tipos_condiciones_sub = $this->CondicionesSubestandaresTipo->listTipoCondicionesSubEstandares();
		$list_all_tipo_lugares = $this->TipoLugare->listTipoLugares();
		
		$total_registros = $this->ActaMedioAmbiente->find('count', 
							array(
							'conditions' => array(
									'YEAR(ActaMedioAmbiente.created) = YEAR(NOW())'							
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
				
				
				$this->formatFecha($this->request->data['ActaMedioAmbiente']['fecha']);

				$this->request->data['ActaMedioAmbiente']['json_doc_med_amb'] = json_encode($this->request->data['ActaMedioAmbiente']['cumplimiento_doc_med']);
				$this->request->data['ActaMedioAmbiente']['json_cond_amb'] = json_encode($this->request->data['ActaMedioAmbiente']['cumplimiento_cond_amb']);

				$this->request->data['ActaMedioAmbiente']['info_des_conclusion'] = $this->request->data['ActaMedioAmbiente']['info_des_conclusion'];
				$this->request->data['ActaMedioAmbiente']['info_des_rec'] = $this->request->data['ActaMedioAmbiente']['info_des_rec'];
				$this->request->data['ActaMedioAmbiente']['info_des_med'] = $this->request->data['ActaMedioAmbiente']['info_des_med'];
				$this->request->data['ActaMedioAmbiente']['vers_cambios'] = 2;
				if($this->Session->read('Auth.User.tipo_user_id')== 3){
					$this->request->data['ActaMedioAmbiente']['created_mym'] = 1;
				}else{
					$this->request->data['ActaMedioAmbiente']['created_mym'] = 0;
				}

				$this->request->data['ActaMedioAmbiente']['consorcio_id'] = $this->Session->read('Auth.User.consorcio_id');
				$this->request->data['ActaMedioAmbiente']['user_id'] = $this->Session->read('Auth.User.id');

				$data = str_replace(' ', '+', $this->request->data['graf']);
				$data_64= base64_decode($data);
				$filename = date('ymdhis').'.png';
				$im = imagecreatefromstring($data_64);

				// Save image in the specified location
				imagepng($im, APP.WEBROOT_DIR.'/files/graficos_acta_med_amb/'.$filename);
				//imagedestroy($im);
				$this->request->data['ActaMedioAmbiente']['grafico'] = $filename;
					
				
				/* Guardar porcentaje de cumplimiento */
				$normas_incumplidas = 0;
				$normas_cumplidas = 0;
				
				
				foreach($this->request->data['ActaMedioAmbiente']['cumplimiento_doc_med'] as $key => $value){
					if($value['inf_des_doc_med'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaMedioAmbiente']['cumplimiento_cond_amb'] as $key => $value){
					if($value['inf_des_cond_amb'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				
				//$formula = ($normas_cumplidas * 100)/($normas_incumplidas + $normas_cumplidas);
				//$this->request->data['ActaMedioAmbiente']['cumplimiento'] = $formula;
				
				$suma_normas = $normas_incumplidas + $normas_cumplidas;
				if($suma_normas > 0){
					$formula = ($normas_cumplidas * 100)/$suma_normas;
				}else{
					$formula = 0;
				}
				
				$this->request->data['ActaMedioAmbiente']['cumplimiento'] = $formula;
				$this->request->data['ActaMedioAmbiente']['total_cumplimiento'] = $normas_cumplidas;
				$this->request->data['ActaMedioAmbiente']['total_incumplimiento'] = $normas_incumplidas;
				
				/* CREAMOS ACTA */
				$this->ActaMedioAmbiente->create();
				if ($this->ActaMedioAmbiente->save($this->request->data)) {

					
					/* INSERTANDO IMAGENES DOCUMENTACIÓN MEDIO AMBIENTAL */
					if(!empty($this->request->data['FotoMedAmbDoc'])){
						$cont = 0;
						foreach ($this->request->data['FotoMedAmbDoc'] as $key=> $array):
							$imagen = $array['Imagen'][0];
							$new_foto_dm['FotoMedAmbDoc']['acta_med_amb_id'] = $this->ActaMedioAmbiente->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
							
							$new_foto_dm['FotoMedAmbDoc']['file_name'] = $new_file_name;
							$new_foto_dm['FotoMedAmbDoc']['observacion'] = $array['Observacion'][0];
							$this->FotoMedAmbDoc->create();
							if ($this->FotoMedAmbDoc->save($new_foto_dm)) {
								$foto_dm_id = $this->FotoMedAmbDoc->id;
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_doc/'.$new_foto_dm['FotoMedAmbDoc']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_doc/thumbnail/'.$new_foto_dm['FotoMedAmbDoc']['file_name']);

								//Backup Images
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_doc/'.$new_foto_dm['FotoMedAmbDoc']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_doc/thumbnail/'.$new_foto_dm['FotoMedAmbDoc']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							
								
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_dm_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
							$cont ++; 
						endforeach;
					}
					
					/* INSERTANDO IMAGENES CONDICIONES AMBIENTALES */
					if(!empty($this->request->data['FotoMedAmbCond'])){
						$cont = 0;
						foreach ($this->request->data['FotoMedAmbCond'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_ca['FotoMedAmbCond']['acta_med_amb_id'] = $this->ActaMedioAmbiente->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_ca['FotoMedAmbCond']['file_name'] = $new_file_name;
							$new_foto_ca['FotoMedAmbCond']['observacion'] = $array['Observacion'][0];
							$this->FotoMedAmbCond->create();
							if ($this->FotoMedAmbCond->save($new_foto_ca)) {
								$foto_ca_id = $this->FotoMedAmbCond->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_cond/'.$new_foto_ca['FotoMedAmbCond']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_cond/thumbnail/'.$new_foto_ca['FotoMedAmbCond']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_cond/'.$new_foto_ca['FotoMedAmbCond']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_cond/thumbnail/'.$new_foto_ca['FotoMedAmbCond']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_ca_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
					}
					

					/* INSERTANDO IMAGENES 	ACTA DE INSPECCIÓN DE SEGURIDAD */
					if(!empty($this->request->data['FotoMedAmbActa'])){
						$cont = 0;
						foreach ($this->request->data['FotoMedAmbActa'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_act_med_amb['FotoMedAmbActa']['acta_med_amb_id'] = $this->ActaMedioAmbiente->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
					
							$new_foto_act_med_amb['FotoMedAmbActa']['file_name'] = $new_file_name;
							$new_foto_act_med_amb['FotoMedAmbActa']['observacion'] = $array['Observacion'][0];
							$this->FotoMedAmbActa->create();
							if ($this->FotoMedAmbActa->save($new_foto_act_med_amb)) {
								$foto_act_ins_seg_id = $this->FotoMedAmbActa->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_acta/'.$new_foto_act_med_amb['FotoMedAmbActa']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_acta/thumbnail/'.$new_foto_act_med_amb['FotoMedAmbActa']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_acta/'.$new_foto_act_med_amb['FotoMedAmbActa']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_acta/thumbnail/'.$new_foto_act_med_amb['FotoMedAmbActa']['file_name']);

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

					
					$acta_med_amb_id = $this->ActaMedioAmbiente->id;
					echo json_encode(array('success'=>true,'msg'=>__('El Acta Instalación fue agregada con &eacute;xito.'),'ActaMedioAmbiente_id'=>$acta_med_amb_id));
					exit();
				}else{
					$acta_med_amb_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ActaMedioAmbiente->validationErrors));
					exit();
				}
		}
	}
	
	public function editar_informe_med_amb($acta_med_amb_id=null){
		$this->layout = 'acta';
		if(!isset($acta_med_amb_id)){
			echo json_encode(array('success'=>true,'msg'=>__('Esta acción no esta permitida')));
			$this->redirect(array('controller' => 'actas', 'action' => 'index'));
			exit();
		}
		$this->loadModel('ActaMedioAmbiente');
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
		$this->loadModel('CierreActaMedioAmbiente');
		$this->loadModel('Codigo');
		$this->loadModel('FotoMedAmbDoc');
		$this->loadModel('FotoMedAmbCond');
		$this->loadModel('FotoMedAmbMedida');
		$this->loadModel('FotoMedAmbActa');
		$this->loadModel('ActosSubestandaresTipo');
		$this->loadModel('CondicionesSubestandaresTipo');
		$this->loadModel('UnidadesNegocio');
		$this->loadModel('TipoLugare');
		
		$list_all_empresas = $this->Empresa->listEmpresas();
		$list_all_actas = $this->ActaMedioAmbiente->listActaMedAmb();
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
			if(isset($acta_med_amb_id) && intval($acta_med_amb_id) > 0){
				
				$this->formatFecha($this->request->data['ActaMedioAmbiente']['fecha']);
				
				//update
				$error_validation = '';
	
				$this->ActaMedioAmbiente->id = $acta_med_amb_id;

				$this->request->data['ActaMedioAmbiente']['json_doc_med_amb'] = json_encode($this->request->data['ActaMedioAmbiente']['cumplimiento_doc_med']);
				$this->request->data['ActaMedioAmbiente']['json_cond_amb'] = json_encode($this->request->data['ActaMedioAmbiente']['cumplimiento_cond_amb']);
				
				
				$this->request->data['ActaMedioAmbiente']['info_des_conclusion'] = $this->request->data['ActaMedioAmbiente']['info_des_conclusion'];
				$this->request->data['ActaMedioAmbiente']['info_des_rec'] = $this->request->data['ActaMedioAmbiente']['info_des_rec'];
				$this->request->data['ActaMedioAmbiente']['info_des_med'] = $this->request->data['ActaMedioAmbiente']['info_des_med'];

				$this->request->data['ActaMedioAmbiente']['consorcio_id'] = $this->Session->read('Auth.User.consorcio_id');
				$this->request->data['ActaMedioAmbiente']['user_id'] = $this->Session->read('Auth.User.id');


				if($this->request->data['ActaMedioAmbiente']['grafico'] != ''){

					unlink(APP.WEBROOT_DIR.'/files/graficos_acta_med_amb/'.$this->request->data['ActaMedioAmbiente']['grafico']);

					$data = str_replace(' ', '+', $this->request->data['graf']);
					$data_64= base64_decode($data);
					$filename = date('ymdhis').'.png';
					$im = imagecreatefromstring($data_64);
	
					// Save image in the specified location
					imagepng($im, APP.WEBROOT_DIR.'/files/graficos_acta_med_amb/'.$filename);
					$this->request->data['ActaMedioAmbiente']['grafico'] = $filename;
					
					
				}else{
					$data = str_replace(' ', '+', $this->request->data['graf']);
					$data_64= base64_decode($data);
					$filename = date('ymdhis').'.png';
					$im = imagecreatefromstring($data_64);
	
					// Save image in the specified location
					imagepng($im, APP.WEBROOT_DIR.'/files/graficos_acta_med_amb/'.$filename);
					$this->request->data['ActaMedioAmbiente']['grafico'] = $filename;
				}

								
				/* Guardar porcentaje de cumplimiento */
				$normas_incumplidas = 0;
				$normas_cumplidas = 0;
				
				
				foreach($this->request->data['ActaMedioAmbiente']['cumplimiento_doc_med'] as $key => $value){
					if($value['inf_des_doc_med'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['ActaMedioAmbiente']['cumplimiento_cond_amb'] as $key => $value){
					if($value['inf_des_cond_amb'] != ''){
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
					
				$this->request->data['ActaMedioAmbiente']['cumplimiento'] = $formula;
				$this->request->data['ActaMedioAmbiente']['total_cumplimiento'] = $normas_cumplidas;
				$this->request->data['ActaMedioAmbiente']['total_incumplimiento'] = $normas_incumplidas;
				
				
				//INICIO UPDATE FOTOS DOCUMENTACIÓN DE MEDIO AMBIENTE

				if(!empty($this->request->data['FotoMedAmbDoc'])){
					$cont = 0;
					foreach ($this->request->data['FotoMedAmbDoc'] as $key=> $array):
					$imagen = $array['Imagen'][0];
					$new_foto_dm['FotoMedAmbDoc']['acta_id'] = $this->ActaMedioAmbiente->id;
					$arr = explode(".", $imagen);
					$extension = strtolower(array_pop($arr));
					$new_file_name = time().$cont.'.'.$extension;
						
					$new_foto_dm['FotoMedAmbDoc']['file_name'] = $new_file_name;
					$new_foto_dm['FotoMedAmbDoc']['observacion'] = $array['Observacion'][0];
					$this->FotoMedAmbDoc->create();
					if ($this->FotoMedAmbDoc->save($new_foto_dm)) {
						$foto_dm_id = $this->FotoMedAmbDoc->id;
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_doc/'.$new_foto_dm['FotoMedAmbDoc']['file_name']);
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_doc/thumbnail/'.$new_foto_dm['FotoMedAmbDoc']['file_name']);

						//Backup Images
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_doc/'.$new_foto_dm['FotoMedAmbDoc']['file_name']);
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_doc/thumbnail/'.$new_foto_dm['FotoMedAmbDoc']['file_name']);


						unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
						unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
						// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
					}else{
						$foto_dm_id = '';
						//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
						//exit();
					}
					$cont ++;
					endforeach;
				}
				
				if(!empty($this->request->data['FotoDmUpdate'])){
					
					foreach ($this->request->data['FotoDmUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
						
						$this->FotoMedAmbDoc->id = $array['id'][0];
						
						$update_foto_dm['FotoMedAmbDoc']['observacion'] = $array['Observacion'][0];
						
						$this->FotoMedAmbDoc->save($update_foto_dm);
							
					}
					endforeach;
				}
				
				//INICIO UPDATE FOTOS DE CONDICIONES AMBIENTALES
				if(!empty($this->request->data['FotoMedAmbCond'])){
						$cont = 0;
						foreach ($this->request->data['FotoMedAmbCond'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_ca['FotoMedAmbCond']['acta_id'] = $this->ActaMedioAmbiente->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_ca['FotoMedAmbCond']['file_name'] = $new_file_name;
							$new_foto_ca['FotoMedAmbCond']['observacion'] = $array['Observacion'][0];
							$this->FotoMedAmbCond->create();
							if ($this->FotoMedAmbCond->save($new_foto_ca)) {
								$foto_ca_id = $this->FotoMedAmbCond->id;
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_cond/'.$new_foto_ca['FotoMedAmbCond']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_cond/thumbnail/'.$new_foto_ca['FotoMedAmbCond']['file_name']);

								//Backup Images
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_cond/'.$new_foto_ca['FotoMedAmbCond']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_cond/thumbnail/'.$new_foto_ca['FotoMedAmbCond']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_ca_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
				}
				
				if(!empty($this->request->data['FotoCaUpdate'])){
						
					foreach ($this->request->data['FotoCaUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoMedAmbCond->id = $array['id'][0];
				
						$update_foto_ca['FotoMedAmbCond']['observacion'] = $array['Observacion'][0];
				
						$this->FotoMedAmbCond->save($update_foto_ca);
							
					}
					endforeach;
				}
				

				//INICIO UPDATE FOTOS CONCLUSIONES / RECOMENDACIONES Y MEDIDAS DE SEGURIDAD
				if(!empty($this->request->data['FotoMedAmbMedida'])){
					$cont = 0;
					foreach ($this->request->data['FotoMedAmbMedida'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_med['FotoMedAmbMedida']['acta_id'] = $this->ActaMedioAmbiente->id;

						/*debug("HOLA  ".$new_foto_med['FotoMedAmbMedida']['acta_id']);
						exit();*/
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_med['FotoMedAmbMedida']['file_name'] = $new_file_name;
						$new_foto_med['FotoMedAmbMedida']['observacion'] = $array['Observacion'][0];
						$this->FotoMedAmbMedida->create();
						if ($this->FotoMedAmbMedida->save($new_foto_med)) {
							$foto_med_id = $this->FotoMedAmbMedida->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_medida/'.$new_foto_med['FotoMedAmbMedida']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_medida/thumbnail/'.$new_foto_med['FotoMedAmbMedida']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_medida/'.$new_foto_med['FotoMedAmbMedida']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_medida/thumbnail/'.$new_foto_med['FotoMedAmbMedida']['file_name']);

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
				
						$this->FotoMedAmbMedida->id = $array['id'][0];
				
						$update_foto_med['FotoMedAmbMedida']['observacion'] = $array['Observacion'][0];
				
						$this->FotoMedAmbMedida->save($update_foto_med);
							
					}
					endforeach;
				}

				//INICIO UPDATE FOTOS ACTA DE INSPECCIÓN DE MEDIO AMBIENTE
				if(!empty($this->request->data['FotoMedAmbActa'])){
					$cont = 0;
					foreach ($this->request->data['FotoMedAmbActa'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_act_med_amb['FotoMedAmbActa']['acta_id'] = $this->ActaMedioAmbiente->id;

						/*debug("HOLA  ".$new_foto_act_med_amb['FotoMedAmbActa']['acta_id']);
						exit();*/
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_act_med_amb['FotoMedAmbActa']['file_name'] = $new_file_name;
						$new_foto_act_med_amb['FotoMedAmbActa']['observacion'] = $array['Observacion'][0];
						$this->FotoMedAmbActa->create();
						if ($this->FotoMedAmbActa->save($new_foto_act_med_amb)) {
							$foto_act_ins_seg_id = $this->FotoMedAmbActa->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_acta/'.$new_foto_act_med_amb['FotoMedAmbActa']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med_amb_acta/thumbnail/'.$new_foto_act_med_amb['FotoMedAmbActa']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_acta/'.$new_foto_act_med_amb['FotoMedAmbActa']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_acta/thumbnail/'.$new_foto_act_med_amb['FotoMedAmbActa']['file_name']);

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

				if(!empty($this->request->data['FotoMedAmbActaUpdate'])){
				
					foreach ($this->request->data['FotoMedAmbActaUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoMedAmbActa->id = $array['id'][0];
				
						$update_foto_act_ins_seg['FotoMedAmbActa']['observacion'] = $array['Observacion'][0];
				
						$this->FotoMedAmbActa->save($update_foto_act_ins_seg);
							
					}
					endforeach;
				}
				
				
				//INICIO UPDATE ACTA EN A INSTALACIONES
				//debug($this->request->data);
				if ($this->ActaMedioAmbiente->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'ActaMedioAmbiente_id'=>$acta_med_amb_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ActaMedioAmbiente->validationErrors));
					exit();
				}
				
			}
		}else{
			$obj_acta = $this->ActaMedioAmbiente->findById($acta_med_amb_id);
			if(($this->Session->read('Auth.User.tipo_user_id') == 1) || ($this->Session->read('Auth.User.id') == $obj_acta->getAttr('reponsable_sup_id') || ($this->Session->read('Auth.User.tipo_user_id') == 3))){
				$this->request->data = $obj_acta->data;
				$this->set(compact('acta_med_amb_id','obj_acta'));
			}else{
				throw new NotFoundException();
			}
			
		}
	}
	
	public function delete_acta(){
		$this->layout = 'ajax';
	
		$this->loadModel('ActaMedioAmbiente');
	
		if($this->request->is('post')){
			$acta_med_amb_id = $this->request->data['acta_med_amb_id'];
			
			$obj_acta = $this->ActaMedioAmbiente->findById($acta_med_amb_id);
			if($obj_acta->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->ActaMedioAmbiente->deleteActaMedioAmbiente($acta_med_amb_id)){
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
			$this->request->data['ActaMedioAmbiente']['fecha'] = $fecha.' '.$time;
		}
	
		return $this->request->data['ActaMedioAmbiente']['fecha'];
	}
	
	/*public function add_file_dm(){
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
	
	public function add_row_doc_med(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function add_row_cond_amb(){
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
	
	public function view_informe($acta_med_amb_id = null){

		ini_set('memory_limit', '512M');
		$this->loadModel('ActaMedioAmbiente');
		$this->loadModel('Actividade');
		$obj_acta = $this->ActaMedioAmbiente->findById($acta_med_amb_id);

		$this->layout= 'layout_view_pdf_insp_medio_amb';	
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
				
		if(!isset($acta_med_amb_id)){
			echo json_encode(array('success'=>true,'msg'=>__('Esta acción no esta permitida')));
			$this->redirect(array('controller' => 'actas', 'action' => 'index'));
			exit();
		}

		$cargo_supervisor = $this->Actividade->getNombreCargo($obj_acta->getAttr('reponsable_sup_cargo_id'));
				
		$info_ni_t = $this->ActaMedioAmbiente->infoNiT($acta_med_amb_id);
		$info_ni_v = $this->ActaMedioAmbiente->infoNiV($acta_med_amb_id);
		
		$obj_acta_ref = array();
		if($obj_acta->getAttr('acta_referencia')!= 0){
			$informe_ref_id = $obj_acta->getAttr('acta_referencia');
			$obj_acta_ref = $this->ActaMedioAmbiente->findById($informe_ref_id);
		}

		$this->set(compact('obj_acta','obj_acta_ref','info_ni_t','info_ni_v', 'cargo_supervisor'));
	}
	
	public function send_reporte_email()
	{
		$this->autoRender = false;
		$this->loadModel('ActaMedioAmbiente');
		
			if(isset($this->request->data) || $this->request->is('post')){
				//debug($this->request->data);exit();
				$acta_med_amb_id = $this->request->data['acta_med_amb_id'];
				$obj_acta = $this->ActaMedioAmbiente->findById($acta_med_amb_id);
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
					$this->save_pdf($acta_med_amb_id);
					$this->ActaMedioAmbiente->sendReporteEmail($acta_med_amb_id, $email_destino, $email_copia, $num_informe, $asunto, $mensaje);
					/* Save Emails enviados */
					$this->loadModel('EmailsEnviado');
					$arr_email_send['EmailsEnviado']['acta_med_amb_id'] = $acta_med_amb_id;
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
	public function delete_foto_dm()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoMedAmbDoc');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoMedAmbDoc->deleteAll(array('FotoMedAmbDoc.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med_amb_doc/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med_amb_doc/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med_amb_doc/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med_amb_doc/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_doc/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_doc/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_doc/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_doc/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	/* ELIMINAR FOTOS CONDICIONES AMBIENTALES */
	public function delete_foto_ca()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoMedAmbCond');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoMedAmbCond->deleteAll(array('FotoMedAmbCond.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med_amb_cond/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med_amb_cond/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med_amb_cond/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med_amb_cond/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_cond/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_cond/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_cond/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_cond/thumbnail/'.$file_name);
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
		$this->loadModel('FotoMedAmbMedida');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoMedAmbMedida->deleteAll(array('FotoMedAmbMedida.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med_amb_medida/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med_amb_medida/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med_amb_medida/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med_amb_medida/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_medida/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_medida/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_medida/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_medida/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}

	public function delete_foto_acta()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoMedAmbActa');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoMedAmbActa->deleteAll(array('FotoMedAmbActa.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med_amb_acta/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med_amb_acta/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med_amb_acta/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med_amb_acta/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_acta/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_acta/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_acta/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_med_amb_acta/thumbnail/'.$file_name);
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
	
		$this->loadModel('ActaMedioAmbiente');
	
		if($this->request->is('post')){
			$acta_med_amb_id = $this->request->data['acta_med_amb_id'];
			$value_check = $this->request->data['value_check'];
				
			$obj_acta = $this->ActaMedioAmbiente->findById($acta_med_amb_id);
			if($obj_acta->saveField('revisado', $value_check)){
				echo json_encode(array('success'=>true,'msg'=>__('El cambio se realiz&oacute; con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->ActaMedioAmbiente->deleteActaMedioAmbiente($acta_med_amb_id)){
			 echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
			//exit();
			}else{
			echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
			//exit();
			}
			exit();*/
		}
	}

	public function save_pdf($acta_med_amb_id){
		$source = ENV_WEBROOT_FULL_URL."/actas/view_informe/".$acta_med_amb_id;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $source);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSLVERSION,3);
		$data = curl_exec ($ch);
		$error = curl_error($ch); 
		curl_close ($ch);
		
		$this->loadModel('ActaMedioAmbiente');
		$obj_acta = $this->ActaMedioAmbiente->findById($acta_med_amb_id);
		
		$destination = APP.WEBROOT_DIR."/files/pdf/".str_replace('/','-',$obj_acta->getAttr('num_informe')).".pdf";
		$file = fopen($destination, "w+");
		fputs($file, $data);
		fclose($file);
	}

	public function ajax_normas_info_ref(){
		$this->autoRender = false;
		$this->loadModel('ActaMedioAmbiente');
	
		if($this->request->is('post')){
			$informe_ref_id = $this->request->data['id_informe_ref'];
			$obj_acta = $this->ActaMedioAmbiente->findObjects('first',
					array(
							'conditions'=>array(
									'ActaMedioAmbiente.id'=> $informe_ref_id
							),
							//'fields' => array('id','apellido_nombre'),
					));
			
			//foreach ($arr_obj_trabajadore as $trabajadore):
			$normas_dm = $obj_acta->getAttr('info_des_epp');
			$normas_ca = $obj_acta->getAttr('info_des_se_de');
			$normas_um = $obj_acta->getAttr('info_des_um');
			$normas_ds = $obj_acta->getAttr('info_des_sshh');
			$normas_cp = $obj_acta->getAttr('info_des_act');
			$normas_ac = $obj_acta->getAttr('info_des_cond');

		
			//endforeach;
		}
		return json_encode(array('success'=>true,'normas'=> array('normas_dm' => $normas_dm, 'normas_ca'=>$normas_ca, 'normas_um'=>$normas_um, 'normas_ds'=>$normas_ds, 'normas_cp'=>$normas_cp, 'normas_ac'=>$normas_ac)));
	}

	public function ajax_export_report_pdf (){
		ini_set('memory_limit', '512M');
		ini_set('max_execution_time', 1000);
		$this->layout = "layout_export_report_pdf";

		$this->loadModel('ActaMedioAmbiente');
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
			
			$list_total_ni_nc = $this->ActaMedioAmbiente->listTotalNiNc2($fec_inicio, $fec_fin, $empresas, $uunns);

			//debug($list_total_ni_nc); exit();
			
			$sum_nc_epp = 0 ; $sum_ni_epp= 0; $sum_nc_ca= 0; $sum_ni_ca= 0; $sum_nc_um= 0; $sum_ni_um=0; $sum_nc_sshh=0; $sum_ni_sshh=0; $sum_nc_cp= 0;
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
								$sum_nc_ca++;
							}elseif($value->alternativa == 0){
								$sum_ni_ca++;
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

			$sum_normas_cumplidas = round($sum_nc_epp + $sum_nc_ca + $sum_nc_um + $sum_nc_sshh + $sum_nc_cp + $sum_nc_ac);
			$sum_normas_incumplidas = round($sum_ni_epp + $sum_ni_ca + $sum_ni_um + $sum_ni_sshh + $sum_ni_cp + $sum_ni_ac);
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
			$this->set(compact('sum_nc_epp', 'sum_nc_ca', 'sum_nc_um', 'sum_nc_sshh', 'sum_nc_cp', 'sum_nc_ac'));
			$this->set(compact('sum_ni_epp', 'sum_ni_ca', 'sum_ni_um', 'sum_ni_sshh', 'sum_ni_cp', 'sum_ni_ac'));
			$this->set(compact('sum_normas_cumplidas', 'sum_normas_incumplidas', 'suma_total_normas','porc_nc','porc_ni'));
	}
		
}