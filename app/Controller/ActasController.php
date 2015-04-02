<?php
class ActasController extends AppController{
	public $name = 'Acta';
	
	
	public function index($page=null,$order_by=null,$order_by_or=null,$search_nro=null,$search_actividad=null,$search_empresa=null,$search_obra=null) {
		$this->layout = "default";
		$this->loadModel('Acta');
		
		$page = 0;
		//$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		
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
		$list_acta = $this->Acta->listFindActas($order_by, $search_nro, utf8_encode($search_actividad),utf8_encode($search_empresa),utf8_encode($search_obra),$order_by_or, $start, $per_page);
		$count = count($list_acta_all);
		$no_of_paginations = ceil($count / $per_page);
		$page = $page + 1;
		
		$this->set(compact('list_acta','page','no_of_paginations'));
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
		$this->layout = 'default';
		
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
		
		
		if($this->request->is('post')  || $this->request->is('put')){
				//insert
				
				$error_validation = '';
				
				if($this->request->data['EmpresaActa']['empresa'] == ''){
					
							$arr_validation['empresa_id'] = array(__('La Empresa es requerida'));
							$error_validation = true;
				}
				
				if($error_validation == true){
					echo json_encode(array('success' =>false, 'msg' => __('No se pudo guardar'), 'validation' => $arr_validation));
					exit();
				}
				
				$this->formatFecha($this->request->data['Acta']['fecha']);
				
				if($this->request->data['EmpresaActa']['empresa'] != null && $this->request->data['EmpresaActa']['empresa_id'] != ''){
						
					$this->request->data['Acta']['empresa_id'] = $this->request->data['EmpresaActa']['empresa_id'];
						
				}/*elseif($this->request->data['EmpresaActa']['empresa'] != null && $this->request->data['EmpresaActa']['empresa_id'] == ''){
						
					$new_empresa['Empresa']['nombre'] = $this->request->data['EmpresaActa']['empresa'];
					$this->Empresa->create();
						
					if ($this->Empresa->save($new_empresa)) {
						$this->request->data['Acta']['empresa_id'] = $this->Empresa->id;
					}
				}*/
				
				/* Verificamos el Responsable de la Actividad previo y post a la corrección */
				
				if($this->request->data['ResponsableAct1']['nom_res_act'] != null && $this->request->data['ResponsableAct1']['res_act_id1'] != ''){
				
					$this->request->data['Acta']['reponsable_act_id'] = $this->request->data['ResponsableAct1']['res_act_id1'];
				
				}/*elseif($this->request->data['ResponsableAct1']['nom_res_act'] != null && $this->request->data['ResponsableAct1']['res_act_id1'] == ''){
				
					$new_trabajador_res['Trabajadore']['apellido_nombre'] = $this->request->data['ResponsableAct1']['nom_res_act'];
					$new_trabajador_res['Trabajadore']['nro_documento'] = $this->request->data['ResponsableAct1']['dni_res_act'];
					$new_trabajador_res['Trabajadore']['tipo_trabajador'] = 'I';
					$new_trabajador_res['Trabajadore']['distrito_id'] = '140101';
					$this->Trabajadore->create();
					if ($this->Trabajadore->save($new_trabajador_res)) {
						$this->request->data['Acta']['reponsable_act_id'] = $this->Trabajadore->id;
					}
				}*/
				
				if($this->request->data['ResponsableAct2']['nom_res_act'] != null && $this->request->data['ResponsableAct2']['res_act_id'] != ''){
				
					$this->request->data['Acta']['reponsable_corr_id'] = $this->request->data['ResponsableAct2']['res_act_id'];
				
				}/*elseif($this->request->data['ResponsableAct2']['nom_res_act'] != null && $this->request->data['ResponsableAct2']['res_act_id'] == ''){
				
					$new_trabajador_corr['Trabajadore']['apellido_nombre'] = $this->request->data['ResponsableAct2']['nom_res_act'];
					$new_trabajador_corr['Trabajadore']['nro_documento'] = $this->request->data['ResponsableAct2']['dni_res_act'];
					$new_trabajador_corr['Trabajadore']['tipo_trabajador'] = 'I';
					$new_trabajador_corr['Trabajadore']['distrito_id'] = '140101';
					$this->Trabajadore->create();
					if ($this->Trabajadore->save($new_trabajador_corr)) {
						$this->request->data['Acta']['reponsable_corr_id'] = $this->Trabajadore->id;
					}
				}*/
				
				
				/* Verificamos el Responsable de la Supervisión previo y post a la corrección */
				
				if($this->request->data['ResponsableSup1']['nom_res_sup'] != null && $this->request->data['ResponsableSup1']['res_sup_id'] != ''){
				
					$this->request->data['Acta']['reponsable_sup_id'] = $this->request->data['ResponsableSup1']['res_sup_id'];
				
				}/*elseif($this->request->data['ResponsableSup1']['nom_res_sup'] != null && $this->request->data['ResponsableSup1']['res_sup_id'] == ''){
				
					$new_trabajador_sup['Trabajadore']['apellido_nombre'] = $this->request->data['ResponsableSup1']['nom_res_sup'];
					$new_trabajador_sup['Trabajadore']['nro_documento'] = $this->request->data['ResponsableSup1']['dni_res_sup'];
					$new_trabajador_sup['Trabajadore']['tipo_trabajador'] = 'E';
					$new_trabajador_sup['Trabajadore']['distrito_id'] = '140101';
					$this->Trabajadore->create();
					if ($this->Trabajadore->save($new_trabajador_sup)) {
						$this->request->data['Acta']['reponsable_sup_id'] = $this->Trabajadore->id;
					}
				}*/
				
				if($this->request->data['ResponsableSup2']['nom_res_sup'] != null && $this->request->data['ResponsableSup2']['res_sup_id'] != ''){
				
					$this->request->data['Acta']['reponsable_sup_corr_id'] = $this->request->data['ResponsableSup2']['res_sup_id'];
				
				}/*elseif($this->request->data['ResponsableSup2']['nom_res_sup'] != null && $this->request->data['ResponsableSup2']['res_sup_id'] == ''){
				
					$new_trabajador_sup_corr['Trabajadore']['apellido_nombre'] = $this->request->data['ResponsableSup2']['nom_res_sup'];
					$new_trabajador_sup_corr['Trabajadore']['nro_documento'] = $this->request->data['ResponsableSup2']['dni_res_sup'];
					$new_trabajador_sup_corr['Trabajadore']['tipo_trabajador'] = 'E';
					$new_trabajador_sup_corr['Trabajadore']['distrito_id'] = '140101';
					$this->Trabajadore->create();
					if ($this->Trabajadore->save($new_trabajador_sup_corr)) {
						$this->request->data['Acta']['reponsable_sup_corr_id'] = $this->Trabajadore->id;
					}
				}*/
				
				
				/* VALORES DEL INFORME */
				
				if($this->request->data['Acta']['info_des_epp'] != ''){
					$formato = nl2br(utf8_encode($this->request->data['Acta']['info_des_epp']));
					$this->request->data['Acta']['info_des_epp'] = $formato;
				}
				
				if($this->request->data['Acta']['info_des_se_de'] != ''){
					$formato = nl2br(utf8_encode($this->request->data['Acta']['info_des_se_de']));
					$this->request->data['Acta']['info_des_se_de'] = $formato;
				}
				
				if($this->request->data['Acta']['info_des_um'] != ''){
					$formato = nl2br(utf8_encode($this->request->data['Acta']['info_des_um']));
					$this->request->data['Acta']['info_des_um'] = $formato;
				}
				
				if($this->request->data['Acta']['info_des_act_cond'] != ''){
					$formato = nl2br(utf8_encode($this->request->data['Acta']['info_des_act_cond']));
					$this->request->data['Acta']['info_des_act_cond'] = $formato;
				}
				
				if($this->request->data['Acta']['info_des_conclusion'] != ''){
					$formato = nl2br(utf8_encode($this->request->data['Acta']['info_des_conclusion']));
					$this->request->data['Acta']['info_des_conclusion'] = $formato;
				}
				
				if($this->request->data['Acta']['info_des_rec'] != ''){
					$formato = nl2br(utf8_encode($this->request->data['Acta']['info_des_rec']));
					$this->request->data['Acta']['info_des_rec'] = $formato;
				}
				
				/*INTENTANDO SUBIR FOTO
				if($this->request->data['Acta']['foto']=!'')
				{ 
					$file = new File($this->request->data['Acta']['foto']['tmp_name']);
					$path_parts = pathinfo($this->request->data['Acta']['foto']['name']);
					$ext = $path_parts['extension'];
						
					if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'png') {
						$this->Session->setFlash('Solo puedes subir imagenes.');
						$this->render();
					} else {
						$date = $this->request->data['Acta']['foto']['name'];
						$filename =$date.'-post-image.'.$ext;

						$data = $file->read();
						$file->close();

						$file = new File(ENV_WEBROOT_FULL_URL.'/uploads/'.$filename,true);
						$file->write($data);
						$file->close();
					}
						

					$this->loadModel('IppFoto');
					$newfoto['IppFoto']['archivo'] = $this->request->data['Acta']['foto']['name'];
					$this->IppFoto->create();
					if ($this->IppFoto->save($newfoto)) {
						$this->Session->setFlash(__('The sector has been saved'));
						//$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The sector could not be saved. Please, try again.'));
					}
				}*/
				
				$this->Acta->create();
				if ($this->Acta->save($this->request->data)) {

				/* IMPLEMENTOS DE PROTECCIÓN PERSONAL */	
					for($i =1 ; $i <=10 ; $i++){
						if($this->request->data['TrabajadorActa'.$i]['nombre_trabajador'] != null && $this->request->data['TrabajadorActa']['trabajador_id'.$i] != ''){
							//verificar actividad if no exist => se inserta a la tabla activ y no a la tabla trabaj ademas obtenemos su ID para PPT
							//if exits solo se inserta a la tabla PPT
							if($this->request->data['TrabajadorActividad']['actividad_id'.$i] != ''){
								$imp_pp_acta['ImpProtPersonale']['actividad_id'] = $this->request->data['TrabajadorActividad']['actividad_id'.$i];
								/*if($this->Actividade->ExistActividad(trim($this->request->data['ActividadPersona'.$i]['actividad']))){
									//Obtengo el ID de la actividad por su nombre.
									$arr_obj_actividad = $this->Actividade->find('first',
											array(
													'conditions'=>array(
									    					'Actividade.descripcion' => trim($this->request->data['ActividadPersona'.$i]['actividad'])
									    			),
													'fields' => array('id'),
													'order' => array('Actividade.descripcion ASC'),
											));
									
									$actividad_id =  $arr_obj_actividad['Actividade']['id'];
									
									$imp_pp_acta['ImpProtPersonale']['actividad_id'] = $actividad_id;
								}else{
									$new_actividad['Actividade']['descripcion'] = $this->request->data['ActividadPersona'.$i]['actividad'];
									$this->Actividade->create();
									if ($this->Actividade->save($new_actividad)) {
										$imp_pp_acta['ImpProtPersonale']['actividad_id'] = $this->Actividade->id;
									}
								}*/
							}
							
							$imp_pp_acta['ImpProtPersonale']['trabajador_id'] = $this->request->data['TrabajadorActa']['trabajador_id'.$i];
						
						}/*elseif($this->request->data['TrabajadorActa'.$i]['nombre_trabajador'] != null && $this->request->data['TrabajadorActa']['trabajador_id'.$i] == ''){
							//verificar actividad if no exist => se inserta a la tabla activ y En la tabla trabaj ademas obtenemos su ID para PPT
							//if exits solo se inserta a la tabla PPT
							if($this->request->data['ActividadPersona'.$i]['actividad'] != null){
								if($this->Actividade->ExistActividad(trim($this->request->data['ActividadPersona'.$i]['actividad']))){
									//Obtengo el ID de la actividad por su nombre.
									$arr_obj_actividad = $this->Actividade->find('first',
											array(
													'conditions'=>array(
															'Actividade.descripcion' => trim($this->request->data['ActividadPersona'.$i]['actividad'])
													),
													'fields' => array('id'),
													'order' => array('Actividade.descripcion ASC'),
											));
										
									$actividad_id =  $arr_obj_actividad['Actividade']['id'];
										
									$imp_pp_acta['ImpProtPersonale']['actividad_id'] = $actividad_id;
									$new_trabajador['Trabajadore']['actividade_id'] = $actividad_id;
								}else{
									$new_actividad['Actividade']['descripcion'] = $this->request->data['ActividadPersona'.$i]['actividad'];
									$this->Actividade->create();
									if ($this->Actividade->save($new_actividad)) {
										$imp_pp_acta['ImpProtPersonale']['actividad_id'] = $this->Actividade->id;
										$new_trabajador['Trabajadore']['actividade_id'] = $this->Actividade->id;
									}
								}
							}
							
							$new_trabajador['Trabajadore']['apellido_nombre'] = $this->request->data['TrabajadorActa'.$i]['nombre_trabajador'];
							$new_trabajador['Trabajadore']['distrito_id'] = '140101';
							$this->Trabajadore->create();
							if ($this->Trabajadore->save($new_trabajador)) {
								$imp_pp_acta['ImpProtPersonale']['trabajador_id'] = $this->Trabajadore->id;
							}
						}*/
						
						/* Inserción en la tabla "imp_prot_personales" y su tabla detalle "ipp_normas_incumplidas" */
						if($this->request->data['TrabajadorActa'.$i]['nombre_trabajador'] != null){
							$imp_pp_acta['ImpProtPersonale']['acta_id'] = $this->Acta->id;
							$this->ImpProtPersonale->create();
							if ($this->ImpProtPersonale->save($imp_pp_acta)) {
								$ipp_id = $this->ImpProtPersonale->id;
								//echo json_encode(array('success'=>true,'msg'=>__('El IPP fue agregada con &eacute;xito.'),'ImpProtPersonale_id'=>$ipp_id));
									
								for($n =1 ; $n <=7 ; $n++){
									$ni_acta['IppNormasIncumplida']['codigo_id'] = $this->request->data['NiActa']['ni-id'.$i.'-'.$n];
									if($ni_acta['IppNormasIncumplida']['codigo_id'] !=''){
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
					
					
					/*UNIDAD MOVIL */
					for($i =1 ; $i <=4 ; $i++){
					
						if($this->request->data['UnidadMovil']['nro_placa_id'.$i] != ''){
							
							$new_um_acta['UnidadesMovile']['acta_id'] = $this->Acta->id;
							$new_um_acta['UnidadesMovile']['vehiculo_id'] = $this->request->data['UnidadMovil']['nro_placa_id'.$i];
							
							$this->UnidadesMovile->create();
							if ($this->UnidadesMovile->save($new_um_acta)) {
								$um_id = $this->UnidadesMovile->id;
									
								for($n =1 ; $n <=9 ; $n++){
									$um_ni['UmNormasIncumplida']['codigo_id'] = $this->request->data['UnidadNorma']['ni-id'.$i.'-'.$n];
									if($um_ni['UmNormasIncumplida']['codigo_id'] !=''){
										$um_ni['UmNormasIncumplida']['um_id'] = $um_id;
										$this->UmNormasIncumplida->create();
										if ($this->UmNormasIncumplida->save($um_ni)) {
											$um_normas_id = $this->UmNormasIncumplida->id;
											//echo json_encode(array('success'=>true,'msg'=>__('El Detalle de la UM fue agregada con &eacute;xito.'),'UmNormasIncumplida_id'=>$um_normas_id));
										}else{
											$um_normas_id = '';
											//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->UmNormasIncumplida->validationErrors));
											//exit();
										}
									}
								}
									
							}else{
								$um_id = '';
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->UnidadesMovile->validationErrors));
								//exit();
							}
						}
					}
					
					
					/* Actos Subestándares*/
					for($i =1 ; $i <=5 ; $i++){
							
						if($this->request->data['ActoSubestandar'.$i]['descripcion'] != ''){
								
							$new_as_acta['ActosSubestandare']['acta_id'] = $this->Acta->id;
							$new_as_acta['ActosSubestandare']['descripcion'] = $this->request->data['ActoSubestandar'.$i]['descripcion'];
							$new_as_acta['ActosSubestandare']['codigo_id'] = $this->request->data['ActoSubestandar'.$i]['ni-id'];
								
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
					
					/* Condiciones Subestándares*/
					for($i =1 ; $i <=5 ; $i++){
							
						if($this->request->data['CondiSubestandar'.$i]['descripcion'] != ''){
					
							$new_cs_acta['CondicionesSubestandare']['acta_id'] = $this->Acta->id;
							$new_cs_acta['CondicionesSubestandare']['descripcion'] = $this->request->data['CondiSubestandar'.$i]['descripcion'];
							$new_cs_acta['CondicionesSubestandare']['codigo_id'] = $this->request->data['CondiSubestandar'.$i]['ni-id'];
					
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
					
					/* Cierre del acta de supervisión */
					for($i =1 ; $i <=7 ; $i++){
							
						if($this->request->data['MedidasAdoptadas'.$i]['descripcion'] != ''){
								
							$new_cierre_acta['CierreActa']['acta_id'] = $this->Acta->id;
							$new_cierre_acta['CierreActa']['descripcion'] = $this->request->data['MedidasAdoptadas'.$i]['descripcion'];
								
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
		$this->layout = 'default';
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
	
	
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($acta_id) && intval($acta_id) > 0){
	
				//update
				$error_validation = '';
	
				$this->Acta->id = $acta_id;
				
				
				// INICIO UPDATE IMPLEMENTOS DE PROTECCION PERSONAL
				for($i =1 ; $i <=10 ; $i++){
					if($this->request->data['TrabajadorActa']['ipp_id'.$i] != 0 || $this->request->data['TrabajadorActa']['ipp_id'.$i] != ''){
						//ACTUALIZANDO REGISTRO DE IPP
						
						$ipp_id = $this->request->data['TrabajadorActa']['ipp_id'.$i];
						if($this->request->data['TrabajadorActa']['trabajador_id'.$i] !='' && $this->request->data['TrabajadorActa'.$i]['nombre_trabajador'] !=''){
							
							$this->ImpProtPersonale->id = $ipp_id;
							
							$update_ipp['ImpProtPersonale']['trabajador_id'] = $this->request->data['TrabajadorActa']['trabajador_id'.$i];
							$update_ipp['ImpProtPersonale']['actividad_id'] = $this->request->data['TrabajadorActividad']['actividad_id'.$i];
							if ($this->ImpProtPersonale->save($update_ipp)) {
								//echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'ImpProtPersonale_id'=>$this->request->data['TrabajadorActa']['ipp_id'.$i]));
								//exit();
								for($n =1 ; $n <=7 ; $n++){
									//Verifico si el id del Ni ipp, no es vacia para poder actualizar
									if($this->request->data['IppNi']['ippni-id'.$i."-".$n] != '' || $this->request->data['IppNi']['ippni-id'.$i."-".$n] != 0){
										
										$ipp_ni_id = $this->request->data['IppNi']['ippni-id'.$i."-".$n];
										//Verifico si los valores no son vacíos de lo contrarío que eliminen el registro de la BD
										if($this->request->data['NiActa']['ni-'.$i.'-'.$n] !='' && $this->request->data['NiActa']['ni-id'.$i.'-'.$n] !=''){
											$this->IppNormasIncumplida->id = $ipp_ni_id;
											
											$update_ipp_ni['IppNormasIncumplida']['codigo_id'] = $this->request->data['NiActa']['ni-id'.$i.'-'.$n];
											$this->IppNormasIncumplida->save($update_ipp_ni);
										}else{
											$this->IppNormasIncumplida->deleteAll(array('IppNormasIncumplida.id' => $ipp_ni_id), $cascada = true);
										}
									}else{
										if($this->request->data['NiActa']['ni-id'.$i.'-'.$n] !='' && $this->request->data['NiActa']['ni-'.$i.'-'.$n] !=''){
											$this->IppNormasIncumplida->create();
											
											$new_ipp_ni['IppNormasIncumplida']['ipp_id'] = $ipp_id;
											$new_ipp_ni['IppNormasIncumplida']['codigo_id'] = $this->request->data['NiActa']['ni-id'.$i.'-'.$n];

											if($this->IppNormasIncumplida->save($new_ipp_ni)){
												$ipp_ni_id = $this->IppNormasIncumplida->id;
											}
										}
									}
								}
							}else{
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ImpProtPersonale->validationErrors));
								//exit();
							}
						}else{
							//En el caso los valores del trabajador esten vacios del ipp.
							$this->ImpProtPersonale->deleteAll(array('ImpProtPersonale.id' => $ipp_id), $cascada = true);
							for($n =1 ; $n <=7 ; $n++){
								if($this->request->data['IppNi']['ippni-id'.$i."-".$n] != ''){
									$ipp_ni_id = $this->request->data['IppNi']['ippni-id'.$i."-".$n];
									$this->IppNormasIncumplida->deleteAll(array('IppNormasIncumplida.id' => $ipp_ni_id), $cascada = true);
								}
							}
							
						}
					}elseif($this->request->data['TrabajadorActa']['ipp_id'.$i] == '' && $this->request->data['TrabajadorActa']['trabajador_id'.$i] != ''){
						//CREANDO NUEVO REGISTRO DE IPP
						
						$new_ipp['ImpProtPersonale']['acta_id'] = $acta_id;
						$new_ipp['ImpProtPersonale']['trabajador_id'] = $this->request->data['TrabajadorActa']['trabajador_id'.$i];
						$new_ipp['ImpProtPersonale']['actividad_id'] = $this->request->data['TrabajadorActividad']['actividad_id'.$i];
						
						$this->ImpProtPersonale->create();
						if ($this->ImpProtPersonale->save($new_ipp)) {
							$ipp_id = $this->ImpProtPersonale->id;
							
							for($n =1 ; $n <=7 ; $n++){
								//Verifico si el id del Ni ipp
									if($this->request->data['NiActa']['ni-'.$i.'-'.$n] !='' && $this->request->data['NiActa']['ni-id'.$i.'-'.$n] !=''){
										$this->IppNormasIncumplida->create();
											
										$new_ipp_ni['IppNormasIncumplida']['ipp_id'] = $ipp_id;
										$new_ipp_ni['IppNormasIncumplida']['codigo_id'] = $this->request->data['NiActa']['ni-id'.$i.'-'.$n];
										if($this->IppNormasIncumplida->save($new_ipp_ni)){
											$ipp_ni_id = $this->IppNormasIncumplida->id;
										}
									}
							}
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$ipp_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
					}
				}
				// FIN UPDATE
				
				// INICIO UPDATE UNIDADES MÓVILES
				for($i =1 ; $i <=4 ; $i++){
					if($this->request->data['UnidadMovil']['um_id'.$i] != 0 || $this->request->data['UnidadMovil']['um_id'.$i] != ''){
						//ACTUALIZANDO REGISTRO DE UM
				
						$um_id = $this->request->data['UnidadMovil']['um_id'.$i]; 
						if($this->request->data['UnidadMovil']['nro_placa_id'.$i] !='' && $this->request->data['UnidadMovil'.$i]['nro_placa'] !=''){
								
							$this->UnidadesMovile->id = $um_id;
								
							$update_um['UnidadesMovile']['vehiculo_id'] = $this->request->data['UnidadMovil']['nro_placa_id'.$i];
							if ($this->UnidadesMovile->save($update_um)) {
								//echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'ImpProtPersonale_id'=>$this->request->data['TrabajadorActa']['ipp_id'.$i]));
								//exit();
								for($n =1 ; $n <=9 ; $n++){//
									//Verifico si el id del Ni UM, no es vacía para poder actualizar
									if($this->request->data['UmNi']['umni-id'.$i."-".$n] != '' || $this->request->data['UmNi']['umni-id'.$i."-".$n] != 0){
				
										$um_ni_id = $this->request->data['UmNi']['umni-id'.$i."-".$n];
										//Verifico si los valores no son vacíos de lo contrarío que eliminen el registro de la BD
										if($this->request->data['UnidadNorma']['ni-'.$i.'-'.$n] !='' && $this->request->data['UnidadNorma']['ni-id'.$i.'-'.$n] !=''){
											$this->UmNormasIncumplida->id = $um_ni_id;
												
											$update_um_ni['UmNormasIncumplida']['codigo_id'] = $this->request->data['UnidadNorma']['ni-id'.$i.'-'.$n];
											$this->UmNormasIncumplida->save($update_ipp_ni);
										}else{
											$this->UmNormasIncumplida->deleteAll(array('UmNormasIncumplida.id' => $um_ni_id), $cascada = true);
										}
									}else{
										if($this->request->data['UnidadNorma']['ni-'.$i.'-'.$n] !='' && $this->request->data['UnidadNorma']['ni-id'.$i.'-'.$n] !=''){
											$this->UmNormasIncumplida->create();
												
											$new_um_ni['UmNormasIncumplida']['um_id'] = $um_id;
											$new_um_ni['UmNormasIncumplida']['codigo_id'] = $this->request->data['UnidadNorma']['ni-id'.$i.'-'.$n];
				
											if($this->UmNormasIncumplida->save($new_um_ni)){
												$um_ni_id = $this->UmNormasIncumplida->id;
											}
										}
									}
								}
							}else{
								//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->ImpProtPersonale->validationErrors));
								//exit();
							}
						}else{
							//En el caso los valores del vehiculo esten vacios del ipp.
							$this->UnidadesMovile->deleteAll(array('UnidadesMovile.id' => $um_id), $cascada = true);
							for($n =1 ; $n <=9 ; $n++){//
								if($this->request->data['UmNi']['umni-id'.$i."-".$n] != ''){
									$um_ni_id = $this->request->data['UmNi']['umni-id'.$i."-".$n];
									$this->UmNormasIncumplida->deleteAll(array('UmNormasIncumplida.id' => $um_ni_id), $cascada = true);
								}
							}
								
						}
					}elseif($this->request->data['UnidadMovil']['um_id'.$i] == '' && $this->request->data['UnidadMovil']['nro_placa_id'.$i] != ''){
						//CREANDO NUEVO REGISTRO DE UM
				
						$new_um['UnidadesMovile']['acta_id'] = $acta_id;
						$new_um['UnidadesMovile']['vehiculo_id'] = $this->request->data['UnidadMovil']['nro_placa_id'.$i];
				
						$this->UnidadesMovile->create();
						if ($this->UnidadesMovile->save($new_um)) {
							$um_id = $this->UnidadesMovile->id;
								
							for($n =1 ; $n <=9 ; $n++){
								//Verifico si el id del Ni UM
								if($this->request->data['UnidadNorma']['ni-'.$i.'-'.$n] !='' && $this->request->data['UnidadNorma']['ni-id'.$i.'-'.$n] !=''){
									$this->UmNormasIncumplida->create();
										
									$new_um_ni['UmNormasIncumplida']['um_id'] = $um_id;
									$new_um_ni['UmNormasIncumplida']['codigo_id'] = $this->request->data['UnidadNorma']['ni-id'.$i.'-'.$n];
									if($this->UmNormasIncumplida->save($new_um_ni)){
										$um_ni_id = $this->UmNormasIncumplida->id;
									}
								}
							}
							// echo json_encode(array('success'=>true,'msg'=>__('La Condicion Subestándar fue agregado con &eacute;xito.'),'CondicionesSubestandare_id'=>$cs_id));
						}else{
							$um_id = '';
							//echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->CondicionesSubestandare->validationErrors));
							//exit();
						}
					}
				}
				
				// FIN UPDATE
				
				
				
				// INICIO UPDATE ACTOS SUBESTANDARES
				for($i =1 ; $i <=5 ; $i++){
					if($this->request->data['ActoSubestandar'.$i]['as-id'] != 0 || $this->request->data['ActoSubestandar'.$i]['as-id'] != ''){
						//ACTUALIZANDO REGISTRO DE ACT SUB
				
						$as_id = $this->request->data['ActoSubestandar'.$i]['as-id'];
						if($this->request->data['ActoSubestandar'.$i]['descripcion'] !=''){
				
							$this->ActosSubestandare->id = $as_id;
				
							$update_as['ActosSubestandare']['descripcion'] = $this->request->data['ActoSubestandar'.$i]['descripcion'];
							$update_as['ActosSubestandare']['codigo_id'] = $this->request->data['ActoSubestandar'.$i]['ni-id'];
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
						
					}elseif($this->request->data['ActoSubestandar'.$i]['as-id'] == '' && $this->request->data['ActoSubestandar'.$i]['descripcion'] != ''){
						//CREANDO NUEVO REGISTRO DE AC
				
						$new_ac['ActosSubestandare']['acta_id'] = $acta_id;
						$new_ac['ActosSubestandare']['descripcion'] = $this->request->data['ActoSubestandar'.$i]['descripcion'];
						$new_ac['ActosSubestandare']['codigo_id'] = $this->request->data['ActoSubestandar'.$i]['ni-id'];
				
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
				
				// FIN UPDATE
				
				
				// INICIO UPDATE CONDICIONES SUBESTANDARES
				for($i =1 ; $i <=5 ; $i++){
					if($this->request->data['CondiSubestandar'.$i]['cs-id'] != 0 || $this->request->data['CondiSubestandar'.$i]['cs-id'] != ''){
						//ACTUALIZANDO REGISTRO DE ACT SUB
				
						$cs_id = $this->request->data['CondiSubestandar'.$i]['cs-id'];
						if($this->request->data['CondiSubestandar'.$i]['descripcion'] !=''){
				
							$this->CondicionesSubestandare->id = $as_id;
				
							$update_cs['CondicionesSubestandare']['descripcion'] = $this->request->data['CondiSubestandar'.$i]['descripcion'];
							$update_cs['CondicionesSubestandare']['codigo_id'] = $this->request->data['CondiSubestandar'.$i]['ni-id'];
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
				
					}elseif($this->request->data['CondiSubestandar'.$i]['cs-id'] == '' && $this->request->data['CondiSubestandar'.$i]['descripcion'] != ''){
						//CREANDO NUEVO REGISTRO DE AC
				
						$new_cs['CondicionesSubestandare']['acta_id'] = $acta_id;
						$new_cs['CondicionesSubestandare']['descripcion'] = $this->request->data['CondiSubestandar'.$i]['descripcion'];
						$new_cs['CondicionesSubestandare']['codigo_id'] = $this->request->data['CondiSubestandar'.$i]['ni-id'];
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
				
				// FIN UPDATE
				
				
				// INICIO UPDATE CIERRE DE ACTA
				for($i =1 ; $i <=5 ; $i++){
					if($this->request->data['MedidasAdoptadas'.$i]['ca_id'] != 0 || $this->request->data['MedidasAdoptadas'.$i]['ca_id'] != ''){
						//ACTUALIZANDO REGISTRO DE CIERRE ACTA
				
						$ca_id = $this->request->data['MedidasAdoptadas'.$i]['ca_id'];
						if($this->request->data['MedidasAdoptadas'.$i]['descripcion'] !=''){
				
							$this->CierreActa->id = $ca_id;
				
							$update_ca['CierreActa']['descripcion'] = $this->request->data['MedidasAdoptadas'.$i]['descripcion'];
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
				
					}elseif($this->request->data['MedidasAdoptadas'.$i]['ca_id'] == '' && $this->request->data['MedidasAdoptadas'.$i]['descripcion'] != ''){
						//CREANDO NUEVO REGISTRO DE CA
				
						$new_ca['CierreActa']['acta_id'] = $acta_id;
						$new_ca['CierreActa']['descripcion'] = $this->request->data['MedidasAdoptadas'.$i]['descripcion'];
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
				// FIN UPDATE
				
				//INICIO UPDATE PERSONA
				
	
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
			$this->request->data = $obj_acta->data;
			$this->set(compact('acta_id','obj_acta'));
		}
	}
	
	public function delete_acta(){
		$this->layout = 'ajax';
	
		$this->loadModel('Acta');
	
		if($this->request->is('post')){
			$acta_id = $this->request->data['acta_id'];
			if($this->Acta->deleteActa($acta_id)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				//exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				//exit();
			}
			exit();
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
	
			if($fec_nac == '' || $fec_nac == NULL){
				$fec_nac = '';
			}else{
				$dd = substr($fec_nac, 0, 2);
				$mm = substr($fec_nac, 3, 2);
				$yy = substr($fec_nac, -4);
				$fec_nac = $yy.'-'.$mm.'-'.$dd;//1990-12-12
			}
			$this->request->data['Persona']['fec_nac'] = $fec_nac;
		}
	
		return $this->request->data['Persona']['fec_nac'];
	}
	
}