<?php
class ActasController extends AppController{
	public $name = 'Acta';
	public $components = array('RequestHandler');
	
	public function beforeFilter(){
		$this->Auth->allow(array('view_informe','save_pdf'));
		parent::beforeFilter();
		//$this->layout = 'default';
	}
	public function index($page=null,$order_by=null,$order_by_or=null,$search_nro=null,$search_actividad=null,$search_empresa=null,$search_obra=null) {
		$this->layout = "default";
		$this->loadModel('Acta');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10000;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
		

		$order_by = 'Acta.created';
		
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
		
		$list_acta_all = $this->Acta->listAllActas($order_by,$search_nro, utf8_encode($search_actividad),utf8_encode($search_empresa),utf8_encode($search_obra),$order_by_or);
		$list_acta = $this->Acta->listFindActas($order_by, $search_nro, utf8_encode($search_actividad),utf8_encode($search_empresa),utf8_encode($search_obra), date('Y'),$order_by_or, $start, $per_page);
		$count = count($list_acta_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_acta','page','no_of_paginations'));
	}
	
	public function search_actas($search_ano=null) {
		$this->layout = 'ajax';
		$this->loadModel('Acta');
		$list_acta = $this->Acta->listSearchActas($search_ano);

		$this->set(compact('list_acta'));
	}
	
	public function find_actas($page=null,$order_by=null,$order_by_or=null,$search_nro=null,$search_actividad=null,$search_empresa=null,$search_obra=null) {
		$this->layout = 'ajax';
		$this->loadModel('Acta');
		$page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		/*if(isset($order_by)){
			$order_by = $order_by;
		}else{
			$order_by = 'Persona.created';
		}*/
		$order_by = 'Acta.created';
	
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
	
		/*if($order_by=='title'){
			$order_by = 'Bit.title';
		}elseif($order_by=='username'){
			$order_by = 'UserJoin.username';
		}elseif($order_by=='home'){
			$order_by = 'Bit.view_home';
		}elseif($order_by=='status'){
			$order_by = 'Bit.status';
		}else{
			$order_by = 'Bit.created';
		}*/
	
		if($this->request->is('get')){
			if($search_nro == 'null'){
				$search_nro = '';
			}else{
				$search_nro = $search_nro;
			}
			
			if($search_actividad == 'null'){
				$search_actividad = '';
			}else{
				$search_actividad = $search_actividad;
			}
			
			if($search_empresa == 'null'){
				$search_empresa = '';
			}else{
				$search_empresa = $search_empresa;
			}
			
			if($search_obra == 'null'){
				$search_obra = '';
			}else{
				$search_obra = $search_obra;
			}
	
		}else{
			$search_nro = '';
			$search_actividad = '';
			$search_empresa = '';
			$search_obra = '';
		}

		$list_acta_all = $this->Acta->listAllActas($order_by, $search_nro, utf8_encode($search_actividad),utf8_encode($search_empresa),utf8_encode($search_obra),$order_by_or);
		$list_acta = $this->Acta->listFindActas($order_by, $search_nro, utf8_encode($search_actividad),utf8_encode($search_empresa),utf8_encode($search_obra),$order_by_or, $start, $per_page);
		$count = count($list_acta_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page+1;
		$this->set(compact('list_acta','page','no_of_paginations'));
	}
	
	
	/**
	 * Add and Edit using Ajax
	 * 16 March 2015
	 * @author Vladimir
	 */
	public function nuevo_informe($acta_id=null){
		$this->verificarAccessoInvitado();

		$this->layout = 'acta';
		
		$this->loadModel('Acta');
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
		$this->loadModel('CierreActa');
		$this->loadModel('Codigo');
		$this->loadModel('FotoIpp');
		$this->loadModel('FotoSd');
		$this->loadModel('FotoUm');
		$this->loadModel('FotoDoc');
		$this->loadModel('FotoAct');
		$this->loadModel('FotoCond');
		$this->loadModel('FotoMed');
		$this->loadModel('ActosSubestandaresTipo');
		$this->loadModel('CondicionesSubestandaresTipo');
		$this->loadModel('UnidadesNegocio');
		$this->loadModel('TipoLugare');
		
		$list_all_empresas = $this->Empresa->listEmpresas();
		$list_all_actas = $this->Acta->listActas();
		$list_all_unidades_negocios = $this->UnidadesNegocio->listUnidadesNegocios();
		$list_all_trabajadores = $this->Trabajadore->listTrabajadores();
		$list_all_actividades = $this->Actividade->listActividades();
		$list_all_codigos = $this->Codigo->listCodigos();
		$list_all_vehiculos = $this->Vehiculo->listVehiculos();
		$list_all_tipos_actos_sub = $this->ActosSubestandaresTipo->listTipoActosSubEstandares();
		$list_all_tipos_condiciones_sub = $this->CondicionesSubestandaresTipo->listTipoCondicionesSubEstandares();
		$list_all_tipo_lugares = $this->TipoLugare->listTipoLugares();
		
		$total_registros = $this->Acta->find('count') + 1;
		$codigo = str_pad($total_registros, 4, "0", STR_PAD_LEFT);
		$string_complement = " - M&M/SST-".date('Y');
		$codigo_completo = $codigo.$string_complement;
		
		
		$this->set(compact('list_all_empresas','list_all_actas','list_all_trabajadores','list_all_actividades','list_all_codigos','list_all_vehiculos','codigo_completo','list_all_tipos_actos_sub','list_all_tipos_condiciones_sub','list_all_unidades_negocios','list_all_tipo_lugares'));
		
		
		//debug($count_actas);
		if($this->request->is('post')  || $this->request->is('put')){
				//insert
				
				
				$this->formatFecha($this->request->data['Acta']['fecha']);

				$this->request->data['Acta']['info_des_act'] = json_encode($this->request->data['Acta']['cumplimiento_act']);
				$this->request->data['Acta']['info_des_cond'] = json_encode($this->request->data['Acta']['cumplimiento_cond']);
				
				$this->request->data['Acta']['info_des_epp'] = json_encode($this->request->data['Acta']['cumplimiento_epp']);
				$this->request->data['Acta']['info_des_se_de'] = json_encode($this->request->data['Acta']['cumplimiento_sd']);
				$this->request->data['Acta']['info_des_um'] = json_encode($this->request->data['Acta']['cumplimiento_um']);
				$this->request->data['Acta']['info_des_doc'] = json_encode($this->request->data['Acta']['cumplimiento_ds']);
				
				$this->request->data['Acta']['info_des_conclusion'] = $this->request->data['Acta']['info_des_conclusion'];
				$this->request->data['Acta']['info_des_rec'] = $this->request->data['Acta']['info_des_rec'];
				$this->request->data['Acta']['info_des_med'] = $this->request->data['Acta']['info_des_med'];

				$data = str_replace(' ', '+', $this->request->data['graf']);
				$data_64= base64_decode($data);
				$filename = date('ymdhis').'.png';
				$im = imagecreatefromstring($data_64);
				//debug($filename);
				//exit();
				if ($im !== false) {
				// Save image in the specified location
					imagepng($im, APP.WEBROOT_DIR.'/files/graficos/'.$filename);
					//imagedestroy($im);
					$this->request->data['Acta']['grafico'] = $filename;
					echo "Saved successfully";
				}else{
					$this->request->data['Acta']['grafico'] = "";
					echo 'An error occurred.';
				}
				
				/* Guardar porcentaje de cumplimiento */
				$normas_incumplidas = 0;
				$normas_cumplidas = 0;
				
				
				foreach($this->request->data['Acta']['cumplimiento_act'] as $key => $value){
					if($value['info_des_act'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_cond'] as $key => $value){
					if($value['info_des_cond'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_epp'] as $key => $value){
					if($value['info_des_epp'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_sd'] as $key => $value){
					if($value['info_des_se_de'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_um'] as $key => $value){
					if($value['info_des_um'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_ds'] as $key => $value){
					if($value['info_des_doc'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				//$formula = ($normas_cumplidas * 100)/($normas_incumplidas + $normas_cumplidas);
				//$this->request->data['Acta']['cumplimiento'] = $formula;
				
				$suma_normas = $normas_incumplidas + $normas_cumplidas;
				if($suma_normas > 0){
					$formula = ($normas_cumplidas * 100)/$suma_normas;
				}else{
					$formula = 0;
				}
				
				$this->request->data['Acta']['cumplimiento'] = $formula;
				$this->request->data['Acta']['total_cumplimiento'] = $normas_cumplidas;
				$this->request->data['Acta']['total_incumplimiento'] = $normas_incumplidas;
				
				/* CREAMOS ACTA */
				$this->Acta->create();
				if ($this->Acta->save($this->request->data)) {

				/* IMPLEMENTOS DE PROTECCIÓN PERSONAL */	
				$cont="0";	
				if(!empty($this->request->data['TrabajadorActa'])){
					foreach($this->request->data['TrabajadorActa'] as $key => $i){
						$cont = $cont + 1;
						if($i['trabajador_id'] > 0 && $i['trabajador_id'] != ''){
							//verificar actividad if no exist => se inserta a la tabla activ y no a la tabla trabaj ademas obtenemos su ID para PPT
							//if exits solo se inserta a la tabla PPT
							if($i['actividad_id'] != ''){
								$imp_pp_acta['ImpProtPersonale']['actividad_id'] = $i['actividad_id'];
							}
							
							/* Inserción en la tabla "imp_prot_personales" y su tabla detalle "ipp_normas_incumplidas" */
							$imp_pp_acta['ImpProtPersonale']['trabajador_id'] = $i['trabajador_id'];
							$imp_pp_acta['ImpProtPersonale']['acta_id'] = $this->Acta->id;
							$this->ImpProtPersonale->create();
							if ($this->ImpProtPersonale->save($imp_pp_acta)) {
								$ipp_id = $this->ImpProtPersonale->id;
								//echo json_encode(array('success'=>true,'msg'=>__('El IPP fue agregada con &eacute;xito.'),'ImpProtPersonale_id'=>$ipp_id));
									
								if(isset($this->request->data['NiActa'][$key])){
									foreach($this->request->data['NiActa'][$key] as $k => $codigo_id){
										$ni_acta['IppNormasIncumplida']['codigo_id'] = $codigo_id;
										$ni_acta['IppNormasIncumplida']['ipp_id'] = $ipp_id;
										$this->IppNormasIncumplida->create();
										if ($this->IppNormasIncumplida->save($ni_acta)) {
											$ipp_normas_id = $this->IppNormasIncumplida->id;
											//echo json_encode(array('success'=>true,'msg'=>__('El IPP fue agregada con &eacute;xito.'),'IppNormasIncumplida_id'=>$ipp_normas_id));
										}else{
											$ipp_normas_id = '';
											//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->IppNormasIncumplida->validationErrors));
											//exit();
										}
									}
								}
									
							}else{
								$ipp_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ImpProtPersonale->validationErrors));
								//exit();
							}
						
						}
					}//FIN DEL FOR 
				}
					
				/*UNIDAD MOVIL */
				if(!empty($this->request->data['UnidadMovil'])){
					foreach($this->request->data['UnidadMovil'] as $key => $i){
						if($i['nro_placa_id'] != ''){
							
							$new_um_acta['UnidadesMovile']['acta_id'] = $this->Acta->id;
							$new_um_acta['UnidadesMovile']['vehiculo_id'] = $i['nro_placa_id'];
							
							$this->UnidadesMovile->create();
							if ($this->UnidadesMovile->save($new_um_acta)) {
								$um_id = $this->UnidadesMovile->id;
								if(isset($this->request->data['UnidadNorma'][$key])){	
									foreach($this->request->data['UnidadNorma'][$key] as $k => $codigo_id){
										$um_ni['UmNormasIncumplida']['codigo_id'] = $codigo_id;
										if($um_ni['UmNormasIncumplida']['codigo_id'] !=''){
											$um_ni['UmNormasIncumplida']['um_id'] = $um_id;
											$this->UmNormasIncumplida->create();
											if ($this->UmNormasIncumplida->save($um_ni)) {
												$um_normas_id = $this->UmNormasIncumplida->id;
											}else{
												$um_normas_id = '';
											}
										}
									}
								}	
							}else{
								$um_id = '';
							}
						}
					}
				}
					
					
					/* Actos Subestándares*/
				if(!empty($this->request->data['ActoSubestandar'])){
					foreach($this->request->data['ActoSubestandar'] as $i){
							
						if($i['act_sub_tipo_id'] != ''){
								
							$new_as_acta['ActosSubestandare']['acta_id'] = $this->Acta->id;
							$new_as_acta['ActosSubestandare']['act_sub_tipo_id'] = $i['act_sub_tipo_id'];
							$new_as_acta['ActosSubestandare']['codigo_id'] = $i['ni-id'];
								
							$this->ActosSubestandare->create();
							if ($this->ActosSubestandare->save($new_as_acta)) {
								$as_id = $this->ActosSubestandare->id;
								// echo json_encode(array('success'=>true,'msg'=>__('El acto Subestándar fue agregado con &eacute;xito.'),'ActoSubestandar_id'=>$as_id));	
							}else{
								$as_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ActosSubestandare->validationErrors));
								//exit();
							}
						}
					}
				}
					
					/* Condiciones Subestándares*/
					if(!empty($this->request->data['CondiSubestandar'])){
						foreach($this->request->data['CondiSubestandar'] as $i){
							if($i['cond_sub_tipo_id'] != ''){
						
								$new_cs_acta['CondicionesSubestandare']['acta_id'] = $this->Acta->id;
								$new_cs_acta['CondicionesSubestandare']['cond_sub_tipo_id'] = $i['cond_sub_tipo_id'];
								$new_cs_acta['CondicionesSubestandare']['codigo_id'] = $i['ni-id'];
						
								$this->CondicionesSubestandare->create();
								if ($this->CondicionesSubestandare->save($new_cs_acta)) {
									$cs_id = $this->CondicionesSubestandare->id;
									// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
								}else{
									$cs_id = '';
									//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
									//exit();
								}
							}
						}
					}
					
					/* Cierre del acta de supervisión */
					if(!empty($this->request->data['MedidasAdoptadas'])){
						foreach($this->request->data['MedidasAdoptadas'] as $i){
							
							if($i['descripcion'] != ''){
									
								$new_cierre_acta['CierreActa']['acta_id'] = $this->Acta->id;
								$new_cierre_acta['CierreActa']['descripcion'] = $i['descripcion'];
									
								$this->CierreActa->create();
								if ($this->CierreActa->save($new_cierre_acta)) {
									$ca_id = $this->CierreActa->id;
									// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
								}else{
									$ca_id = '';
									//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
									//exit();
								}
							}
						}
					}
					
					/* INSERTANDO IMAGENES IPP */
					if(!empty($this->request->data['FotoIpp'])){
						$cont = 0;
						foreach ($this->request->data['FotoIpp'] as $key=> $array):
							$imagen = $array['Imagen'][0];
							$new_foto_ipp['FotoIpp']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
							
							$new_foto_ipp['FotoIpp']['file_name'] = $new_file_name;
							$new_foto_ipp['FotoIpp']['observacion'] = $array['Observacion'][0];
							$this->FotoIpp->create();
							if ($this->FotoIpp->save($new_foto_ipp)) {
								$foto_ipp_id = $this->FotoIpp->id;
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_ipp/'.$new_foto_ipp['FotoIpp']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_ipp/thumbnail/'.$new_foto_ipp['FotoIpp']['file_name']);

								//Backup Images
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_ipp/'.$new_foto_ipp['FotoIpp']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_ipp/thumbnail/'.$new_foto_ipp['FotoIpp']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							
								
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_ipp_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
							$cont ++; 
						endforeach;
					}
					
					/* INSERTANDO IMAGENES SEÑALIZACIÓN Y DELIMITACIÓN */
					if(!empty($this->request->data['FotoSd'])){
						$cont = 0;
						foreach ($this->request->data['FotoSd'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_sd['FotoSd']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_sd['FotoSd']['file_name'] = $new_file_name;
							$new_foto_sd['FotoSd']['observacion'] = $array['Observacion'][0];
							$this->FotoSd->create();
							if ($this->FotoSd->save($new_foto_sd)) {
								$foto_sd_id = $this->FotoSd->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_sd/'.$new_foto_sd['FotoSd']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_sd/thumbnail/'.$new_foto_sd['FotoSd']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_sd/'.$new_foto_sd['FotoSd']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_sd/thumbnail/'.$new_foto_sd['FotoSd']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_sd_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
					}
					
					/* INSERTANDO IMAGENES UNIDADES MOVILES */
					if(!empty($this->request->data['FotoUm'])){
						$cont = 0;
						foreach ($this->request->data['FotoUm'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_um['FotoUm']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
					
							$new_foto_um['FotoUm']['file_name'] = $new_file_name;
							$new_foto_um['FotoUm']['observacion'] = $array['Observacion'][0];
							$this->FotoUm->create();
							if ($this->FotoUm->save($new_foto_um)) {
								$foto_um_id = $this->FotoUm->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_um/'.$new_foto_um['FotoUm']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_um/thumbnail/'.$new_foto_um['FotoUm']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_um/'.$new_foto_um['FotoUm']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_um/thumbnail/'.$new_foto_um['FotoUm']['file_name']);	

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_um_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
					}
					
					/* INSERTANDO IMAGENES DOCUMENTACIÓN DE SEGURIDAD */
					if(!empty($this->request->data['FotoDoc'])){
						$cont = 0;
						foreach ($this->request->data['FotoDoc'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_doc['FotoDoc']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_doc['FotoDoc']['file_name'] = $new_file_name;
							$new_foto_doc['FotoDoc']['observacion'] = $array['Observacion'][0];
							$this->FotoDoc->create();
							if ($this->FotoDoc->save($new_foto_doc)) {
								$foto_doc_id = $this->FotoDoc->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_doc/'.$new_foto_doc['FotoDoc']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_doc/thumbnail/'.$new_foto_doc['FotoDoc']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_doc/'.$new_foto_doc['FotoDoc']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_doc/thumbnail/'.$new_foto_doc['FotoDoc']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_doc_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
							$cont ++;
						}
					}
					
					/* INSERTANDO IMAGENES ACTOS SUB*/
					if(!empty($this->request->data['FotoAct'])){
						$cont = 0;
						foreach ($this->request->data['FotoAct'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_as['FotoAct']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
							
							$new_foto_as['FotoAct']['file_name'] = $new_file_name;
							$new_foto_as['FotoAct']['observacion'] = $array['Observacion'][0];
							$this->FotoAct->create();
							if ($this->FotoAct->save($new_foto_as)) {
								$foto_as_id = $this->FotoAct->id;
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_as/'.$new_foto_as['FotoAct']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_as/thumbnail/'.$new_foto_as['FotoAct']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_as/'.$new_foto_as['FotoAct']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_as/thumbnail/'.$new_foto_as['FotoAct']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_as_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
					}
					
					/* INSERTANDO IMAGENES COND SUB*/
					if(!empty($this->request->data['FotoCond'])){
						$cont = 0;
						foreach ($this->request->data['FotoCond'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_cs['FotoCond']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_cs['FotoCond']['file_name'] = $new_file_name;
							$new_foto_cs['FotoCond']['observacion'] = $array['Observacion'][0];
							$this->FotoCond->create();
							if ($this->FotoCond->save($new_foto_cs)) {
								$foto_cs_id = $this->FotoCond->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_cs/'.$new_foto_cs['FotoCond']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_cs/thumbnail/'.$new_foto_cs['FotoCond']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/'.$new_foto_cs['FotoCond']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/thumbnail/'.$new_foto_cs['FotoCond']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_cs_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
							$cont ++;
						}
					}
					
					/* INSERTANDO IMAGENES MED CONTROL*/
					if(!empty($this->request->data['FotoMed'])){
						$cont = 0;
						foreach ($this->request->data['FotoMed'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_med['FotoMed']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
					
							$new_foto_med['FotoMed']['file_name'] = $new_file_name;
							$new_foto_med['FotoMed']['observacion'] = $array['Observacion'][0];
							$this->FotoMed->create();
							if ($this->FotoMed->save($new_foto_med)) {
								$foto_med_id = $this->FotoMed->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med/'.$new_foto_med['FotoMed']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med/thumbnail/'.$new_foto_med['FotoMed']['file_name']);

								//Backup Images	
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/'.$new_foto_cs['FotoCond']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/thumbnail/'.$new_foto_cs['FotoCond']['file_name']);

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
					
					$acta_id = $this->Acta->id;
					echo json_encode(array('success'=>true,'msg'=>__('El Acta fue agregada con &eacute;xito.'),'Acta_id'=>$acta_id));
					exit();
				}else{
					$acta_id = '';
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Acta->validationErrors));
					exit();
				}
		}
	}
	
	public function editar_informe($acta_id=null){
		$this->layout = 'acta';
		if(!isset($acta_id)){
			echo json_encode(array('success'=>true,'msg'=>__('Esta acción no esta permitida')));
			$this->redirect(array('controller' => 'actas', 'action' => 'index'));
			exit();
		}
		$this->loadModel('Acta');
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
		$this->loadModel('CierreActa');
		$this->loadModel('Codigo');
		$this->loadModel('FotoIpp');
		$this->loadModel('FotoSd');
		$this->loadModel('FotoUm');
		$this->loadModel('FotoDoc');
		$this->loadModel('FotoAct');
		$this->loadModel('FotoCond');
		$this->loadModel('FotoMed');
		$this->loadModel('ActosSubestandaresTipo');
		$this->loadModel('CondicionesSubestandaresTipo');
		$this->loadModel('UnidadesNegocio');
		$this->loadModel('TipoLugare');
		
		$list_all_empresas = $this->Empresa->listEmpresas();
		$list_all_actas = $this->Acta->listActas();
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
			if(isset($acta_id) && intval($acta_id) > 0){
				
				$this->formatFecha($this->request->data['Acta']['fecha']);
				
				//update
				$error_validation = '';
	
				$this->Acta->id = $acta_id;
				
				$this->request->data['Acta']['info_des_act'] = json_encode($this->request->data['Acta']['cumplimiento_act']);
				$this->request->data['Acta']['info_des_cond'] = json_encode($this->request->data['Acta']['cumplimiento_cond']);
				
				$this->request->data['Acta']['info_des_epp'] = json_encode($this->request->data['Acta']['cumplimiento_epp']);
				$this->request->data['Acta']['info_des_se_de'] = json_encode($this->request->data['Acta']['cumplimiento_sd']);
				$this->request->data['Acta']['info_des_um'] = json_encode($this->request->data['Acta']['cumplimiento_um']);
				$this->request->data['Acta']['info_des_doc'] = json_encode($this->request->data['Acta']['cumplimiento_ds']);
				
				$this->request->data['Acta']['info_des_conclusion'] = $this->request->data['Acta']['info_des_conclusion'];
				$this->request->data['Acta']['info_des_rec'] = $this->request->data['Acta']['info_des_rec'];
				$this->request->data['Acta']['info_des_med'] = $this->request->data['Acta']['info_des_med'];


				if($this->request->data['Acta']['grafico'] != ''){

					unlink(APP.WEBROOT_DIR.'/files/graficos/'.$this->request->data['Acta']['grafico']);

					$data = str_replace(' ', '+', $this->request->data['graf']);
					$data_64= base64_decode($data);
					$filename = date('ymdhis').'.png';
					$im = imagecreatefromstring($data_64);
	
					// Save image in the specified location
					imagepng($im, APP.WEBROOT_DIR.'/files/graficos/'.$filename);
					$this->request->data['Acta']['grafico'] = $filename;
					
					
				}else{
					$data = str_replace(' ', '+', $this->request->data['graf']);
					$data_64= base64_decode($data);
					$filename = date('ymdhis').'.png';
					$im = imagecreatefromstring($data_64);
	
					// Save image in the specified location
					imagepng($im, APP.WEBROOT_DIR.'/files/graficos/'.$filename);
					$this->request->data['Acta']['grafico'] = $filename;
				}

								
				/* Guardar porcentaje de cumplimiento */
				$normas_incumplidas = 0;
				$normas_cumplidas = 0;
				
				
				foreach($this->request->data['Acta']['cumplimiento_act'] as $key => $value){
					if($value['info_des_act'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_cond'] as $key => $value){
					if($value['info_des_cond'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_epp'] as $key => $value){
					if($value['info_des_epp'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_sd'] as $key => $value){
					if($value['info_des_se_de'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_um'] as $key => $value){
					if($value['info_des_um'] != ''){
						if($value['alternativa'] == 1){
							$normas_cumplidas++;
						}else{
							$normas_incumplidas++;
						}
					}
				}
				
				foreach($this->request->data['Acta']['cumplimiento_ds'] as $key => $value){
					if($value['info_des_doc'] != ''){
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
					
				$this->request->data['Acta']['cumplimiento'] = $formula;
				$this->request->data['Acta']['total_cumplimiento'] = $normas_cumplidas;
				$this->request->data['Acta']['total_incumplimiento'] = $normas_incumplidas;
				
			// INICIO UPDATE IMPLEMENTOS DE PROTECCION PERSONAL
			if(!empty($this->request->data['TrabajadorActa'])){
				foreach($this->request->data['TrabajadorActa'] as $key => $i){
					if($i['ipp_id'] != 0 || $i['ipp_id'] != ''){
						//ACTUALIZANDO REGISTRO DE IPP
						
						$ipp_id = $i['ipp_id'];
						if($i['trabajador_id'] !='' && $i['trabajador_id'] > 0){
							
							$this->ImpProtPersonale->id = $ipp_id;
							
							$update_ipp['ImpProtPersonale']['trabajador_id'] = $i['trabajador_id'];
							$update_ipp['ImpProtPersonale']['actividad_id'] = $i['actividad_id'];
							if ($this->ImpProtPersonale->save($update_ipp)) {

								$array_ids = explode(',',$this->request->data['IppNi'][$key]);
								foreach($array_ids as $ipp_ni_id){
									$this->IppNormasIncumplida->deleteAll(array('IppNormasIncumplida.id' => $ipp_ni_id), $cascada = true);
								}
									
								if(!empty($this->request->data['NiActa'][$key])){
									foreach($this->request->data['NiActa'][$key] as $k => $codigo_id){
											
										$this->IppNormasIncumplida->create();

										$new_ipp_ni['IppNormasIncumplida']['ipp_id'] = $ipp_id;
										$new_ipp_ni['IppNormasIncumplida']['codigo_id'] = $codigo_id;
											
										if($this->IppNormasIncumplida->save($new_ipp_ni)){
											$ipp_ni_id = $this->IppNormasIncumplida->id;
										}
									}
								}
							}
						}else{
							//En el caso los valores del trabajador esten vacios del ipp.
							$this->ImpProtPersonale->deleteAll(array('ImpProtPersonale.id' => $ipp_id), $cascada = true);
							if($this->request->data['IppNi'][$key] != ''){
								$array_ids = explode(',',$this->request->data['IppNi'][$key]);
								foreach($array_ids as $ipp_ni_id){
									$this->IppNormasIncumplida->deleteAll(array('IppNormasIncumplida.id' => $ipp_ni_id), $cascada = true);
								}
							}

						}
					}elseif($i['ipp_id'] == '' && $i['trabajador_id'] != ''){
						//CREANDO NUEVO REGISTRO DE TABLA IMPLE.PROT.PERS
						
						$new_ipp['ImpProtPersonale']['acta_id'] = $acta_id;
						$new_ipp['ImpProtPersonale']['trabajador_id'] = $i['trabajador_id'];
						$new_ipp['ImpProtPersonale']['actividad_id'] = $i['actividad_id'];
						
						$this->ImpProtPersonale->create();
						if ($this->ImpProtPersonale->save($new_ipp)) {
							$ipp_id = $this->ImpProtPersonale->id;
							
							if($this->request->data['NiActa'][$key] != ''){
								foreach($this->request->data['NiActa'][$key] as $k => $codigo_id){
									//debug($v);
										
									$this->IppNormasIncumplida->create();
							
									$new_ipp_ni['IppNormasIncumplida']['ipp_id'] = $ipp_id;
									$new_ipp_ni['IppNormasIncumplida']['codigo_id'] = $codigo_id;
										
									if($this->IppNormasIncumplida->save($new_ipp_ni)){
										$ipp_ni_id = $this->IppNormasIncumplida->id;
									}
								}
							}
						}else{
							$ipp_id = '';

						}
					}
				}
			}
				// FIN UPDATE
				
			// INICIO UPDATE UNIDADES MÓVILES
			if(!empty($this->request->data['UnidadMovil'])){
				foreach($this->request->data['UnidadMovil'] as $key => $i){
					
					if($i['um_id'] != 0 || $i['um_id'] != ''){
						//ACTUALIZANDO REGISTRO DE UM
				
						$um_id = $i['um_id']; 
						if($i['nro_placa_id'] > 0 && $i['nro_placa_id'] !=''){
								
							$this->UnidadesMovile->id = $um_id;
								
							$update_um['UnidadesMovile']['vehiculo_id'] = $i['nro_placa_id'];
							if ($this->UnidadesMovile->save($update_um)) {
									//Verifico si el id del Ni UM, no es vacía para poder actualizar
										$array_ids = explode(',',$this->request->data['UmNi'][$key]);
										foreach($array_ids as $um_ni_id){
											$this->UmNormasIncumplida->deleteAll(array('UmNormasIncumplida.id' => $um_ni_id), $cascada = true);
										}
										
										if(!empty($this->request->data['UnidadNorma'][$key])){
											foreach($this->request->data['UnidadNorma'][$key] as $k => $codigo_id){
													
												$this->UmNormasIncumplida->create();
										
												$new_um_ni['UmNormasIncumplida']['um_id'] = $um_id;
												$new_um_ni['UmNormasIncumplida']['codigo_id'] = $codigo_id;
													
												if($this->UmNormasIncumplida->save($new_um_ni)){
													$um_ni_id = $this->UmNormasIncumplida->id;
												}
											}
										}
							}
						}else{
							//En el caso los valores del vehiculo esten vacios .
							$this->UnidadesMovile->deleteAll(array('UnidadesMovile.id' => $um_id), $cascada = true);
								if($this->request->data['UmNi'][$key] != ''){
									$array_ids = explode(',',$this->request->data['UmNi'][$key]);
									foreach($array_ids as $um_ni_id){
										$this->UmNormasIncumplida->deleteAll(array('UmNormasIncumplida.id' => $um_ni_id), $cascada = true);
									}
								}
								
						}
					}elseif($i['um_id'] == '' && $i['nro_placa_id'] != ''){
						//CREANDO NUEVO REGISTRO DE UM
				
						$new_um['UnidadesMovile']['acta_id'] = $acta_id;
						$new_um['UnidadesMovile']['vehiculo_id'] = $i['nro_placa_id'];
				
						$this->UnidadesMovile->create();
						if ($this->UnidadesMovile->save($new_um)) {
							$um_id = $this->UnidadesMovile->id;
								
								//Verifico si el id del Ni UM
								if($this->request->data['UnidadNorma'][$key] != null || $this->request->data['UnidadNorma'][$key] !=''){
									
									foreach($this->request->data['UnidadNorma'][$key] as $k => $codigo_id){
										$this->UmNormasIncumplida->create();
										
										$new_um_ni['UmNormasIncumplida']['um_id'] = $um_id;
										$new_um_ni['UmNormasIncumplida']['codigo_id'] = $codigo_id;
										
										if($this->UmNormasIncumplida->save($new_um_ni)){
											$um_ni_id = $this->UmNormasIncumplida->id;
										}
									}
								}
						}else{
							$um_id = '';
						}
					}
				}
			}
				
				// FIN UPDATE
				
				
				
				// INICIO UPDATE ACTOS SUBESTANDARES
			if(!empty($this->request->data['ActoSubestandar'])){
				foreach($this->request->data['ActoSubestandar'] as $i){
					if($i['as-id'] != 0 || $i['as-id'] != ''){
						//ACTUALIZANDO REGISTRO DE ACT SUB
				
						$as_id = $i['as-id'];
						if($i['act_sub_tipo_id'] !=''){
				
							$this->ActosSubestandare->id = $as_id;
				
							$update_as['ActosSubestandare']['act_sub_tipo_id'] = $i['act_sub_tipo_id'];
							$update_as['ActosSubestandare']['codigo_id'] = $i['ni-id'];
							if ($this->ActosSubestandare->save($update_as)) {//
								//echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'ImpProtPersonale_id'=>$this->request->data['TrabajadorActa']['ipp_id'.$i]));
								//exit();
								
							}else{
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ImpProtPersonale->validationErrors));
								//exit();
							}
						}else{
							//En el caso los valores del vehiculo esten vacios del ipp.
							$this->ActosSubestandare->deleteAll(array('ActosSubestandare.id' => $as_id), $cascada = true);//
						}
						
					}elseif($i['as-id'] == '' && $i['act_sub_tipo_id'] != ''){
						//CREANDO NUEVO REGISTRO DE AC
				
						$new_ac['ActosSubestandare']['acta_id'] = $acta_id;
						$new_ac['ActosSubestandare']['act_sub_tipo_id'] = $i['act_sub_tipo_id'];
						$new_ac['ActosSubestandare']['codigo_id'] = $i['ni-id'];
				
						$this->ActosSubestandare->create();
						if ($this->ActosSubestandare->save($new_ac)) {
							$as_id = $this->ActosSubestandare->id;
				
							
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$as_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
					}
				}
			}
				// FIN UPDATE
				
				
				// INICIO UPDATE CONDICIONES SUBESTANDARES
			if(!empty($this->request->data['CondiSubestandar'])){
				foreach($this->request->data['CondiSubestandar'] as $i){
					if($i['cs-id'] != 0 || $i['cs-id'] != ''){
						//ACTUALIZANDO REGISTRO DE ACT SUB
				
						$cs_id = $i['cs-id'];
						if($i['cond_sub_tipo_id'] !=''){
				
							$this->CondicionesSubestandare->id = $cs_id;
				
							$update_cs['CondicionesSubestandare']['cond_sub_tipo_id'] = $i['cond_sub_tipo_id'];
							$update_cs['CondicionesSubestandare']['codigo_id'] = $i['ni-id'];
							if ($this->CondicionesSubestandare->save($update_cs)) {
								//echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'ImpProtPersonale_id'=>$this->request->data['TrabajadorActa']['ipp_id'.$i]));
								//exit();
				
							}else{
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ImpProtPersonale->validationErrors));
								//exit();
							}
						}else{
							//En el caso los valores del vehiculo esten vacios del ipp.
							$this->CondicionesSubestandare->deleteAll(array('CondicionesSubestandare.id' => $cs_id), $cascada = true);//
						}
				
					}elseif($i['cs-id'] == '' && $i['cond_sub_tipo_id'] != ''){
						//CREANDO NUEVO REGISTRO DE AC
				
						$new_cs['CondicionesSubestandare']['acta_id'] = $acta_id;
						$new_cs['CondicionesSubestandare']['cond_sub_tipo_id'] = $i['cond_sub_tipo_id'];
						$new_cs['CondicionesSubestandare']['codigo_id'] = $i['ni-id'];
						$this->CondicionesSubestandare->create();
						if ($this->CondicionesSubestandare->save($new_cs)) {
							$cs_id = $this->CondicionesSubestandare->id;
				
								
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$cs_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
					}
				}
			}	
				// FIN UPDATE
				
				
				// INICIO UPDATE CIERRE DE ACTA
			if(!empty($this->request->data['MedidasAdoptadas'])){
				foreach($this->request->data['MedidasAdoptadas'] as $i){
					if($i['ca_id'] != 0 || $i['ca_id'] != ''){
						//ACTUALIZANDO REGISTRO DE CIERRE ACTA
				
						$ca_id = $i['ca_id'];
						if($i['descripcion'] !=''){
				
							$this->CierreActa->id = $ca_id;
				
							$update_ca['CierreActa']['descripcion'] = $i['descripcion'];
							if ($this->CierreActa->save($update_ca)) {
								//echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'ImpProtPersonale_id'=>$this->request->data['TrabajadorActa']['ipp_id'.$i]));
								//exit();
				
							}else{
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ImpProtPersonale->validationErrors));
								//exit();
							}
						}else{
							//En el caso los valores del vehiculo esten vacios del ipp.
							$this->CierreActa->deleteAll(array('CierreActa.id' => $ca_id), $cascada = true);//
						}
				
					}elseif($i['ca_id'] == '' && $i['descripcion'] != ''){
						//CREANDO NUEVO REGISTRO DE CA
				
						$new_ca['CierreActa']['acta_id'] = $acta_id;
						$new_ca['CierreActa']['descripcion'] = $i['descripcion'];
						$this->CierreActa->create();
						if ($this->CierreActa->save($new_ca)) {
							$ca_id = $this->CierreActa->id;
				
				
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$ca_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
					}
				}
			}
				// FIN UPDATE
				
				//INICIO UPDATE FOTOS IPP

				if(!empty($this->request->data['FotoIpp'])){
					$cont = 0;
					foreach ($this->request->data['FotoIpp'] as $key=> $array):
					$imagen = $array['Imagen'][0];
					$new_foto_ipp['FotoIpp']['acta_id'] = $this->Acta->id;
					$arr = explode(".", $imagen);
					$extension = strtolower(array_pop($arr));
					$new_file_name = time().$cont.'.'.$extension;
						
					$new_foto_ipp['FotoIpp']['file_name'] = $new_file_name;
					$new_foto_ipp['FotoIpp']['observacion'] = $array['Observacion'][0];
					$this->FotoIpp->create();
					if ($this->FotoIpp->save($new_foto_ipp)) {
						$foto_ipp_id = $this->FotoIpp->id;
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_ipp/'.$new_foto_ipp['FotoIpp']['file_name']);
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_ipp/thumbnail/'.$new_foto_ipp['FotoIpp']['file_name']);

						//Backup Images
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_ipp/'.$new_foto_ipp['FotoIpp']['file_name']);
						copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_ipp/thumbnail/'.$new_foto_ipp['FotoIpp']['file_name']);


						unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
						unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
						// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
					}else{
						$foto_ipp_id = '';
						//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
						//exit();
					}
					$cont ++;
					endforeach;
				}
				
				if(!empty($this->request->data['FotoIppUpdate'])){
					
					foreach ($this->request->data['FotoIppUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
						
						$this->FotoIpp->id = $array['id'][0];
						
						$update_foto_ipp['FotoIpp']['observacion'] = $array['Observacion'][0];
						
						$this->FotoIpp->save($update_foto_ipp);
							
					}
					endforeach;
				}
				
				//INICIO UPDATE FOTOS SEÑALIZACIÓN Y DELIMITACIÓN
				if(!empty($this->request->data['FotoSd'])){
						$cont = 0;
						foreach ($this->request->data['FotoSd'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_sd['FotoSd']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
								
							$new_foto_sd['FotoSd']['file_name'] = $new_file_name;
							$new_foto_sd['FotoSd']['observacion'] = $array['Observacion'][0];
							$this->FotoSd->create();
							if ($this->FotoSd->save($new_foto_sd)) {
								$foto_sd_id = $this->FotoSd->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_sd/'.$new_foto_sd['FotoSd']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_sd/thumbnail/'.$new_foto_sd['FotoSd']['file_name']);

								//Backup Images
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_sd/'.$new_foto_sd['FotoSd']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_sd/thumbnail/'.$new_foto_sd['FotoSd']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_sd_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
				}
				
				if(!empty($this->request->data['FotoSdUpdate'])){
						
					foreach ($this->request->data['FotoSdUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoSd->id = $array['id'][0];
				
						$update_foto_sd['FotoSd']['observacion'] = $array['Observacion'][0];
				
						$this->FotoSd->save($update_foto_sd);
							
					}
					endforeach;
				}
				
				//INICIO UPDATE FOTOS UNIDADES MOVILES
				if(!empty($this->request->data['FotoUm'])){
						$cont = 0;
						foreach ($this->request->data['FotoUm'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_um['FotoUm']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
					
							$new_foto_um['FotoUm']['file_name'] = $new_file_name;
							$new_foto_um['FotoUm']['observacion'] = $array['Observacion'][0];
							$this->FotoUm->create();
							if ($this->FotoUm->save($new_foto_um)) {
								$foto_um_id = $this->FotoUm->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_um/'.$new_foto_um['FotoUm']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_um/thumbnail/'.$new_foto_um['FotoUm']['file_name']);

								//Backup Images
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_um/'.$new_foto_um['FotoUm']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_um/thumbnail/'.$new_foto_um['FotoUm']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_um_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
				}
				
				if(!empty($this->request->data['FotoUmUpdate'])){
				
					foreach ($this->request->data['FotoUmUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoUm->id = $array['id'][0];
				
						$update_foto_um['FotoUm']['observacion'] = $array['Observacion'][0];
				
						$this->FotoUm->save($update_foto_um);
							
					}
					endforeach;
				}
				
				
				//INICIO UPDATE FOTOS DOCUMENTOS DE SEGURIDAD
				if(!empty($this->request->data['FotoDoc'])){
					$cont = 0;
					foreach ($this->request->data['FotoDoc'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_doc['FotoDoc']['acta_id'] = $this->Acta->id;
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_doc['FotoDoc']['file_name'] = $new_file_name;
						$new_foto_doc['FotoDoc']['observacion'] = $array['Observacion'][0];
						$this->FotoDoc->create();
						if ($this->FotoDoc->save($new_foto_doc)) {
							$foto_doc_id = $this->FotoDoc->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_doc/'.$new_foto_doc['FotoDoc']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_doc/thumbnail/'.$new_foto_doc['FotoDoc']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_doc/'.$new_foto_doc['FotoDoc']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_doc/thumbnail/'.$new_foto_doc['FotoDoc']['file_name']);

							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$foto_doc_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
						$cont ++;
					}
				}
				
				if(!empty($this->request->data['FotoDocUpdate'])){
				
					foreach ($this->request->data['FotoDocUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoDoc->id = $array['id'][0];
				
						$update_foto_doc['FotoDoc']['observacion'] = $array['Observacion'][0];
				
						$this->FotoDoc->save($update_foto_doc);
							
					}
					endforeach;
				}
				
				//INICIO UPDATE FOTOS ACTOS SUB (CUMPLIMIENTO DEL PROCEDIMIENTO DE TRABAJO SEGURO)
				if(!empty($this->request->data['FotoAct'])){
						$cont = 0;
						foreach ($this->request->data['FotoAct'] as $key => $array){
							$imagen = $array['Imagen'][0];
							$new_foto_as['FotoAct']['acta_id'] = $this->Acta->id;
							$arr = explode(".", $imagen);
							$extension = strtolower(array_pop($arr));
							$new_file_name = time().$cont.'.'.$extension;
							
							$new_foto_as['FotoAct']['file_name'] = $new_file_name;
							$new_foto_as['FotoAct']['observacion'] = $array['Observacion'][0];
							$this->FotoAct->create();
							if ($this->FotoAct->save($new_foto_as)) {
								$foto_as_id = $this->FotoAct->id;
								//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_as/'.$new_foto_as['FotoAct']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_as/thumbnail/'.$new_foto_as['FotoAct']['file_name']);

								//Backup Images
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_as/'.$new_foto_as['FotoAct']['file_name']);
								copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_as/thumbnail/'.$new_foto_as['FotoAct']['file_name']);

								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
								unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
								// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
							}else{
								$foto_as_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
								//exit();
							}
						$cont ++;
						}
				}
				
				if(!empty($this->request->data['FotoActUpdate'])){
				
					foreach ($this->request->data['FotoActUpdate'] as $key=> $array):
					if($array['id'][0] != ''){

						$this->FotoAct->id = $array['id'][0];
				
						$update_foto_as['FotoAct']['observacion'] = $array['Observacion'][0];
				
						$this->FotoAct->save($update_foto_as);
							
					}
					endforeach;
				}
				
				
				//INICIO UPDATE FOTOS CONDICIONES SUB (ACTOS Y CONDICIONES SUBESTÁNDARES)
				if(!empty($this->request->data['FotoCond'])){
					$cont = 0;
					foreach ($this->request->data['FotoCond'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_cs['FotoCond']['acta_id'] = $this->Acta->id;
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_cs['FotoCond']['file_name'] = $new_file_name;
						$new_foto_cs['FotoCond']['observacion'] = $array['Observacion'][0];
						$this->FotoCond->create();
						if ($this->FotoCond->save($new_foto_cs)) {
							$foto_cs_id = $this->FotoCond->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_cs/'.$new_foto_cs['FotoCond']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_cs/thumbnail/'.$new_foto_cs['FotoCond']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/'.$new_foto_cs['FotoCond']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/thumbnail/'.$new_foto_cs['FotoCond']['file_name']);

							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen);
							unlink(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen);
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$foto_cs_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
						$cont ++;
					}
				}
				
				if(!empty($this->request->data['FotoCondUpdate'])){
				
					foreach ($this->request->data['FotoCondUpdate'] as $key=> $array):
					if($array['id'][0] != ''){
				
						$this->FotoCond->id = $array['id'][0];
				
						$update_foto_cs['FotoCond']['observacion'] = $array['Observacion'][0];
				
						$this->FotoCond->save($update_foto_cs);
							
					}
					endforeach;
				}
				
				
				//INICIO UPDATE FOTOS MEDIDAS DE CONTROL
				if(!empty($this->request->data['FotoMed'])){
					$cont = 0;
					foreach ($this->request->data['FotoMed'] as $key => $array){
						$imagen = $array['Imagen'][0];
						$new_foto_med['FotoMed']['acta_id'] = $this->Acta->id;
						$arr = explode(".", $imagen);
						$extension = strtolower(array_pop($arr));
						$new_file_name = time().$cont.'.'.$extension;
							
						$new_foto_med['FotoMed']['file_name'] = $new_file_name;
						$new_foto_med['FotoMed']['observacion'] = $array['Observacion'][0];
						$this->FotoMed->create();
						if ($this->FotoMed->save($new_foto_med)) {
							$foto_med_id = $this->FotoMed->id;
							//debug(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/');exit();
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med/'.$new_foto_med['FotoMed']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/fotos_med/thumbnail/'.$new_foto_med['FotoMed']['file_name']);

							//Backup Images
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med/'.$new_foto_med['FotoMed']['file_name']);
							copy(APP.WEBROOT_DIR.'/lib/file.upload/server/php/files/thumbnail/'.$imagen, APP.WEBROOT_DIR.'/files/backup_image/fotos_med/thumbnail/'.$new_foto_med['FotoMed']['file_name']);

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
				
						$this->FotoMed->id = $array['id'][0];
				
						$update_foto_med['FotoMed']['observacion'] = $array['Observacion'][0];
				
						$this->FotoMed->save($update_foto_med);
							
					}
					endforeach;
				}
				
				
				//INICIO UPDATE ACTA
				//debug($this->request->data);
				if ($this->Acta->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'Acta_id'=>$acta_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Acta->validationErrors));
					exit();
				}
				
			}
		}else{
			$obj_acta = $this->Acta->findById($acta_id);
			if(($this->Session->read('Auth.User.tipo_user_id') == 1) || ($this->Session->read('Auth.User.id') == $obj_acta->getAttr('reponsable_sup_id'))){
				$this->request->data = $obj_acta->data;
				$this->set(compact('acta_id','obj_acta'));
			}else{
				throw new NotFoundException();
			}
			
		}
	}
	
	public function delete_acta(){
		$this->layout = 'ajax';
	
		$this->loadModel('Acta');
	
		if($this->request->is('post')){
			$acta_id = $this->request->data['acta_id'];
			
			$obj_acta = $this->Acta->findById($acta_id);
			if($obj_acta->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->Acta->deleteActa($acta_id)){
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
			$dni = $trabajadore->getAttr('nro_documento');
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
			$this->request->data['Acta']['fecha'] = $fecha.' '.$time;
		}
	
		return $this->request->data['Acta']['fecha'];
	}
	
	public function add_file_ipp(){
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
	
	public function add_file_as(){
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
	
	public function add_file_cs(){
		$this->layout = 'ajax';
		$this->loadModel('Codigo');
		$this->loadModel('CondicionesSubestandaresTipo');
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$list_all_codigos = $this->Codigo->listCodigos();
		$list_all_tipos_condiciones_sub = $this->CondicionesSubestandaresTipo->listTipoCondicionesSubEstandares();
		$this->set(compact('list_all_tipos_condiciones_sub','list_all_codigos','long_table'));
	}
	
	public function add_row_as_rep(){
		$this->layout = 'ajax';

		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}

		$this->set(compact('long_table'));
	}
	
	public function add_row_cond_rep(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function add_row_epp_rep(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function add_row_sd_rep(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function add_row_um_rep(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function add_row_ds_rep(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$long_table = $this->request->data['long_table'];
		}
	
		$this->set(compact('long_table'));
	}
	
	public function view_informe($acta_id = null)
	{
		$this->layout = 'pdf'; //esto usara el layout pdf.ctp
		//$this->render();
		//$this->autoRender = false;
		
		$this->loadModel('Acta');
		if(!isset($acta_id)){
			echo json_encode(array('success'=>true,'msg'=>__('Esta acción no esta permitida')));
			$this->redirect(array('controller' => 'actas', 'action' => 'index'));
			exit();
		}

		ini_set('memory_limit', '512M');
		$obj_acta = $this->Acta->findById($acta_id);
		$info_ni_t = $this->Acta->infoNiT($acta_id);
		$info_ni_v = $this->Acta->infoNiV($acta_id);
		//debug($info_ni_t); 
		//debug($info_ni_v);exit();
		$this->set(compact('obj_acta','info_ni_t','info_ni_v'));
	}
	
	public function send_reporte_email()
	{
		$this->autoRender = false;
		$this->loadModel('Acta');
		
			if(isset($this->request->data) || $this->request->is('post')){
				//debug($this->request->data);exit();
				$acta_id = $this->request->data['acta_id'];
				$obj_acta = $this->Acta->findById($acta_id);
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
					$this->save_pdf($acta_id);
					$this->Acta->sendReporteEmail($acta_id, $email_destino, $email_copia, $num_informe, $asunto, $mensaje);
					/* Save Emails enviados */
					$this->loadModel('EmailsEnviado');
					$arr_email_send['EmailsEnviado']['acta_id'] = $acta_id;
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
	
	
	/* ELIMINAR FOTOS IPP*/
	public function delete_foto_ipp()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoIpp');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoIpp->deleteAll(array('FotoIpp.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_ipp/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_ipp/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_ipp/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_ipp/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_ipp/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_ipp/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_ipp/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_ipp/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	/* ELIMINAR FOTOS SD*/
	public function delete_foto_sd()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoSd');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoSd->deleteAll(array('FotoSd.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_sd/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_sd/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_sd/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_sd/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_sd/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_sd/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_sd/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_sd/thumbnail/'.$file_name);
				}

				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	/* ELIMINAR FOTOS UM*/
	public function delete_foto_um()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoUm');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoUm->deleteAll(array('FotoUm.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_um/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_um/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_um/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_um/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_um/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_um/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_um/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_um/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	/* ELIMINAR FOTOS DOC - SEG */
	public function delete_foto_doc()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoDoc');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoDoc->deleteAll(array('FotoDoc.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_doc/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_doc/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_doc/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_doc/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_doc/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_doc/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_doc/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_doc/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	public function delete_foto_as()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoAct');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoAct->deleteAll(array('FotoAct.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_as/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_as/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_as/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_as/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_as/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_as/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_as/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_as/thumbnail/'.$file_name);
				}
				echo json_encode(array('success' =>true, 'msg' => __('Foto eliminada')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('La Foto no fue eliminada')));
				exit();
			}
		}
	}
	
	public function delete_foto_cs()
	{
		$this->layout = "ajax";
		$this->loadModel('FotoCond');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoCond->deleteAll(array('FotoCond.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_cs/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_cs/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_cs/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_cs/thumbnail/'.$file_name);
				}

				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/backup_image/fotos_cs/thumbnail/'.$file_name);
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
		$this->loadModel('FotoMed');
		if($this->request->is('post')){
			$file_name = $this->request->data['file_name'];
			if($this->FotoMed->deleteAll(array('FotoMed.file_name' => $file_name), $cascada = false)){
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med/'.$file_name);
				}
				if(file_exists(APP.WEBROOT_DIR.'/files/fotos_med/thumbnail/'.$file_name)){
					unlink(APP.WEBROOT_DIR.'/files/fotos_med/thumbnail/'.$file_name);
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
	
		$this->loadModel('Acta');
	
		if($this->request->is('post')){
			$acta_id = $this->request->data['acta_id'];
			$value_check = $this->request->data['value_check'];
				
			$obj_acta = $this->Acta->findById($acta_id);
			if($obj_acta->saveField('revisado', $value_check)){
				echo json_encode(array('success'=>true,'msg'=>__('El cambio se realiz&oacute; con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
			/*if($this->Acta->deleteActa($acta_id)){
			 echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
			//exit();
			}else{
			echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
			//exit();
			}
			exit();*/
		}
	}

	public function save_pdf($acta_id){
		$source = ENV_WEBROOT_FULL_URL."/actas/view_informe/".$acta_id;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $source);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSLVERSION,3);
		$data = curl_exec ($ch);
		$error = curl_error($ch); 
		curl_close ($ch);
		
		$this->loadModel('Acta');
		$obj_acta = $this->Acta->findById($acta_id);
		
		$destination = APP.WEBROOT_DIR."/files/pdf/".str_replace('/','-',$obj_acta->getAttr('num_informe')).".pdf";
		$file = fopen($destination, "w+");
		fputs($file, $data);
		fclose($file);
	}
		
}