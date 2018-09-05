<?php
class ConfigurationsController extends AppController{
	
	public $useModel = false;
	
	public $name = 'Configuration';
	
	public function beforeFilter(){
		$this->Auth->allow(array('cron_send_database'));
		parent::beforeFilter();
	}
	
	public function backup_database(){
	
	}
	
	function send_database($tables = '*') {
		ini_set('memory_limit', '512M');
		
		$return = '';
			
		$modelName = $this->modelClass;
			
		$dataSource = $this->{$modelName}->getDataSource();
		$databaseName = $dataSource->getSchemaName();
			
		// Do a short header
		$return .= '-- Database: `' . $databaseName . '`' . "\n";
		$return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";
			
			
		if ($tables == '*') {
			$tables = array();
			$result = $this->{$modelName}->query('SHOW TABLES');
			foreach($result as $resultKey => $resultValue){
				$tables[] = current($resultValue['TABLE_NAMES']);
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}
			
		// Run through all the tables
		foreach ($tables as $table) {
			$tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);

			$return .= 'DROP TABLE IF EXISTS ' . $table . ';';
			$createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
			$createTableEntry = current(current($createTableResult));
			$return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";

			// Output the table data
			foreach($tableData as $tableDataIndex => $tableDataDetails) {
					
				$return .= 'INSERT INTO ' . $table . ' VALUES(';
					
				foreach($tableDataDetails[$table] as $dataKey => $dataValue) {

					if(is_null($dataValue)){
						$escapedDataValue = 'NULL';
					}
					else {
						// Convert the encoding
						$escapedDataValue = mb_convert_encoding( $dataValue, "UTF-8", "ISO-8859-1" );
							
						// Escape any apostrophes using the datasource of the model.
						$escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
					}

					$tableDataDetails[$table][$dataKey] = $escapedDataValue;
				}
				$return .= implode(',', $tableDataDetails[$table]);
					
				$return .= ");\n";
			}

			$return .= "\n\n\n";
		}
			
		// Set the default file name
		$fileName = $databaseName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';
			
		// Serve the file as a download
		$this->autoRender = false;
		$this->response->type('Content-Type: text/x-sql');
		//$this->response->download($fileName);
		$this->response->body($return);
		
		$content_file = $this->response;
		
		$new_file = fopen(APP.WEBROOT_DIR.'/files/backup_database/'.$fileName, "w") or die("Unable to open file!");
		fwrite($new_file, $content_file);
		fclose($new_file);
		
		//copy($fileName, APP.WEBROOT_DIR.'/files/backup_database/'.$fileName);
		
		
		// SEND EMAIL WITH FILE ATTACHMENT
		if($this->request->is('post')){
			$email_destino = $this->request->data['email_destino'];
			$asunto = $this->request->data['asunto'];
			$mensaje = $this->request->data['mensaje'];
		
			$error_validation = '';
			if(Validation::email($email_destino)){
				App::uses('CakeEmail', 'Network/Email');
		 
				$Email = new CakeEmail('default');
				$Email->from(array('mym.ingenieria@mym-iceperu.com' => 'M&M'));
				$Email->emailFormat('html');
				$Email->template('content_send_backup','layout_email_backup');
				$Email->viewVars(array('mensaje'=> $mensaje));
				$Email->to($email_destino);
				$Email->subject($asunto);
				$Email->attachments(array(
						$fileName => array(
								'file' => APP.WEBROOT_DIR.'/files/backup_database/'.$fileName,
								'mimetype' => 'text/x-sql',
								'contentId' => 'my-unique-id'
						)
				));
				$Email->send('Mi Mensaje');
				
				echo json_encode(array('success'=>true,'msg'=>__('El Backup fue enviado')));
				//exit();
			}else{
				$arr_validation['backup_e_destino'] = array(__('Debe ingresar un email v&aacute;lido'));
				$error_validation = true;
			}
				
			if($error_validation == true){
				echo json_encode(array('success' =>false, 'msg' => __('No se pudo guardar'), 'validation' => $arr_validation));
				exit();
			}
		}
		
		exit();
	}
	
	function cron_send_database($tables = '*') {
		ini_set('memory_limit', '512M');
		
		$return = '';
			
		$modelName = $this->modelClass;
			
		$dataSource = $this->{$modelName}->getDataSource();
		$databaseName = $dataSource->getSchemaName();
			
		// Do a short header
		$return .= '-- Database: `' . $databaseName . '`' . "\n";
		$return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";
			
			
		if ($tables == '*') {
			$tables = array();
			$result = $this->{$modelName}->query('SHOW TABLES');
			foreach($result as $resultKey => $resultValue){
				$tables[] = current($resultValue['TABLE_NAMES']);
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}
			
		// Run through all the tables
		foreach ($tables as $table) {
			$tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);
	
			$return .= 'DROP TABLE IF EXISTS ' . $table . ';';
			$createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
			$createTableEntry = current(current($createTableResult));
			$return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";
	
			// Output the table data
			foreach($tableData as $tableDataIndex => $tableDataDetails) {
					
				$return .= 'INSERT INTO ' . $table . ' VALUES(';
					
				foreach($tableDataDetails[$table] as $dataKey => $dataValue) {
	
					if(is_null($dataValue)){
						$escapedDataValue = 'NULL';
					}
					else {
						// Convert the encoding
						$escapedDataValue = mb_convert_encoding( $dataValue, "UTF-8", "ISO-8859-1" );
							
						// Escape any apostrophes using the datasource of the model.
						$escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
					}
	
					$tableDataDetails[$table][$dataKey] = $escapedDataValue;
				}
				$return .= implode(',', $tableDataDetails[$table]);
					
				$return .= ");\n";
			}
	
			$return .= "\n\n\n";
		}
			
		// Set the default file name
		$fileName = $databaseName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';
			
		// Serve the file as a download
	
		$this->response->type('Content-Type: text/x-sql');
		//$this->response->download($fileName);
		$this->response->body($return);
	
		$content_file = $this->response;
	
		$new_file = fopen(APP.WEBROOT_DIR.'/files/backup_database/'.$fileName, "w") or die("Unable to open file!");
		fwrite($new_file, $content_file);
		fclose($new_file);
	
		//copy($fileName, APP.WEBROOT_DIR.'/files/backup_database/'.$fileName);
	
	
		// SEND EMAIL WITH FILE ATTACHMENT

				App::uses('CakeEmail', 'Network/Email');
					
				$Email = new CakeEmail('default');
				$Email->from(array('mym.ingenieria@mym-iceperu.com' => 'M&M'));
				$Email->emailFormat('html');
				$Email->template('content_send_backup','layout_email_backup');
				$Email->viewVars(array('mensaje'=> 'Esta una copia de seguridad autom&aacute;tica de su Base de Datos'));
				$Email->to(array('jmaldonado.milian@gmail.com','ahugo.soft@gmail.com','vladitorresmirez@gmail.com'));
				$Email->subject(utf8_encode('Copia Automática - ').$fileName);
				$Email->attachments(array(
						$fileName => array(
								'file' => APP.WEBROOT_DIR.'/files/backup_database/'.$fileName,
								'mimetype' => 'text/x-sql',
								'contentId' => 'my-unique-id'
						)
				));
				$Email->send('Mi Mensaje');
	
				//echo json_encode(array('success'=>true,'msg'=>__('El Backup fue enviado')));
				//exit();

		$this->autoRender = false;
	
		exit();
	}

	public function search_actas_bkp_img($search_tipo_acta=null, $fec_inicio, $fec_fin) {
		$this->layout = 'ajax';
		$this->loadModel('Acta');
		$this->loadModel('ActaInstalacione');
		$this->loadModel('ActaMedioAmbiente');


		$fec_inicio_format = $this->formatFecha($fec_inicio);
		$fec_fin_format = $this->formatFecha($fec_fin);

		if($search_tipo_acta==0){
			$list_acta = $this->Acta->listSearchActasBkpImg($fec_inicio_format, $fec_fin_format);
		}elseif ($search_tipo_acta == 1) {
			$list_acta = $this->ActaInstalacione->listSearchActasBkpImg($fec_inicio_format, $fec_fin_format);
		}else{
			$list_acta = $this->ActaMedioAmbiente->listSearchActasBkpImg($fec_inicio_format, $fec_fin_format);
		}
		

		$this->set(compact('list_acta'));
	}

	public function backup_img($page=null,$order_by=null,$order_by_or=null) {
		$this->layout = "default";
		$this->loadModel('Acta');
		$this->loadModel('Consorcio');

		$list_consorcios = $this->Consorcio->listConsorcios();

		$page = 0;

		$per_page = 10000;
		$start = $page * $per_page;
		
		if($order_by_or!=NULL && isset($order_by_or) && $order_by_or!='null'){
			$order_by_or = $order_by_or;
		}else{
			$order_by_or = 'DESC';
		}
		

		$order_by = 'Acta.created';
		
	
		$tipo_user_id = $this->Session->read('Auth.User.tipo_user_id');
	
		$search_ano = date ("Y");
		$search_consorcio = 1;
		$list_acta = $this->Acta->listSearchActas($search_ano, $search_consorcio, $tipo_user_id);

		
		$this->set(compact('list_acta','page','no_of_paginations', 'list_consorcios'));
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

}