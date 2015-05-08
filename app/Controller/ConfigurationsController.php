<?php
class ConfigurationsController extends AppController{
	
	public $useModel = false;
	
	public $name = 'Configuration';
	
	
	
	function send_database($tables = '*') {
			
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
		 
				$Email = new CakeEmail('mym');
				$Email->from(array('informes@mym-iceperu.com' => 'M&M'));
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
	
	public function backup_database(){
		
	} 

}