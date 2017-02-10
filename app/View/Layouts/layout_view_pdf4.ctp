<?php
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 

if(isset($obj_acta)){
	$acta_id = $obj_acta->getAttr('id');
	//echo $my_content;
	$tipo_supervision = ($obj_acta->getAttr('tipo') == 'P')? 'Planeada':'Inopinada';
}
$codigo = "<style type='text/css'>
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Times New Roman, Georgia, Serif;font-size:14px;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Times New Roman, Georgia, Serif;font-size:14px;font-weight:normal;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.font-head{font-family:Arial, Verdana, Sans-serif !important;font-size:14px;font-weight:normal;}
.tg-031eF{color:#17365D;}
.tg .tg-e3zv{font-weight:bold;}
.tg-uni {text-align:center !important;}
.aling-left {text-align:left;}
.aling-right {text-align:right;}
	
@page { margin-top: 150px; }
	
.pie-pag {
   position:fixed;
   left:0px;
   bottom:-20px;
   height:30px;
   width:100%;
   font: 50% sans-serif;
   color:#0062AA 
}

.head-pag {
   position:fixed;
   left:0px;
   top:-115px;
   width:100%;
   font: 50% sans-serif;
}

.back-green{
 background-color: #D6E3BC;
}
		
.back-green2{
 background-color: #92D050;
}

.back-blue{
 background-color: #DBE5F1;
}

.back-gray{
 background-color: #dcdbdb;
}
		
img { border:1px solid green}

.salto-linea{ page-break-before:always; }

.celd-align {
	text-align: center;
}
</style>";
$codigo.= "<div class='pie-pag'><hr>";
$codigo.= "<table class='tg' width='100%' style='border:0px;'>";
$codigo.= "<tr><td style='border:0px;font-size:11px;padding: 0px 5px; width:68%'><strong>Copyright © Todos los Derechos Reservados</strong></td>
				<td style='border:0px;font-size:11px;padding: 0px 5px;text-align:right;'><strong>Email: mym.ingenieria@mym-iceperu.com</strong></td></tr>";
$codigo.= "<tr><td style='border:0px;font-size:11px;padding: 0px 5px;'><strong>M&M Ingeniería Obras y Servicios EIRL</strong></td>
				<td style='border:0px;font-size:11px;padding: 0px 5px;text-align:right;'><strong>Web: www.mym-iceperu.com</strong></td></tr>";
$codigo.= "</table>";
$codigo.= "</div>";

$codigo.= "<div class='head-pag'>
			<table class='tg tg-031eF back-blue' width='100%'>
			  <tr>
				<th style='width:10%;' class='tg-031e' rowspan='3'><img src='".ENV_WEBROOT_FULL_URL."img/logo_mym2016.png' style='width: 60px; border:0px;'/></th>
			    <th style='width:62%' class='tg-031e' rowspan='3'><h2 style='margin:2px'>M&amp;M Ingenier&iacute;a Obras y Servicios <span style='font-size:16px;'>E.I.R.L.</span></h2>
			    <h5 style='margin:2px'>Ejecuci&oacute;n y supervisi&oacute;n de obras el&eacute;ctricas, electromec&aacute;nicas, civiles, miner&iacute;a e industrial.<br>Especialistas de gesti&oacute;n en Seguridad, salud en el trabajo, calidad y medio ambiente.</h5>		
			    </th>
			    <th style='width:22%' class='aling-left'><strong>Programa: GISEMM </strong></th>
			  </tr>
			  <tr>
			    <td class='aling-left'><strong>C&oacute;digo: M001-SST/MA</strong></td>
			  </tr>
			  <tr>
			    <td class='tg-031e'><strong>Versi&oacute;n: 00/2017-M001</strong></td>
			  </tr>
			</table>
			<table class='tg tg-031eF back-gray' width='100%' style='margin-bottom:-10px'>
			<tr>
			    <td style='text-align:center' class='tg-031e'><strong>Versión Anterior: 00/2015-M001</strong></td>
			    <td style='text-align:center' class='aling-left'><strong>Modificaci&oacute;n Versión: JAMM</strong></td>
			    <td style='text-align:center' class='tg-031e'><strong>Fecha Modificaci&oacute;n: ".date('d/m/Y',strtotime(($obj_acta->getAttr('modified')==''?$obj_acta->getAttr('fecha'):$obj_acta->getAttr('modified'))))."</strong></td>
			  </tr>
			</table>
			<br>
			</div>";
			
$codigo.= "<table class='tg' width='100%' style='margin-bottom:-10px'>
			<tr>
			    <td class='tg-e3zv back-blue' style='text-align:center'><strong>INFORME T&Eacute;CNICO N&#176; ".$obj_acta->getAttr('num_informe')."</strong></td>
			  </tr>
			  <tr>
			    <td class='tg-e3zv back-blue' style='text-align:center'><strong>SUPERVISI&Oacute;N (INSPECCI&Oacute;N / OBSERVACI&Oacute;N) EN SEGURIDAD Y SALUD EN EL TRABAJO</strong></td>
			  </tr>
			</table>
			<br>";


$codigo .="<table class='tg font-head' width='100%' style='margin-bottom:-10px'>

  <tr>
    <th class='tg-e3zv aling-left back-green'>Empresa:</th>
    <th class='tg-031eF aling-left' colspan='3' style='width:43%'>".$obj_acta->Empresa->getAttr('nombre')."</th>
    <th class='aling-left back-green' colspan='1'><strong>UUNN:</strong></th>
    <th class='tg-031eF aling-left' style='width:29%' colspan='1'>".$obj_acta->UnidadesNegocio->getAttr('descripcion')."</th>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Actividad:</td>
    <td class='tg-031eF' colspan='5'>".$obj_acta->getAttr('actividad')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Obra:</td>
    <td class='tg-031eF' colspan='5'>".$obj_acta->getAttr('obra')."</td>
  </tr>
  <tr>
    <td style='width:10%' class='tg-e3zv back-green'>Lugar:</td>
    <td style='width:36%' class='tg-031eF' colspan='3'>".$obj_acta->getAttr('lugar')."</td>
    <td style='width:26%' class='aling-left back-green'><strong>&Aacute;rea:</strong></td>
    <td style='width:28%' class='tg-031eF'>".$obj_acta->TipoLugare->getAttr('descripcion')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Responsable:</td>
    <td class='tg-031eF' colspan='3'>";
    if($obj_acta->getAttr('reponsable_act_id')!=0){
    	$codigo.= $obj_acta->Trabajadore1->getAttr('apellido_nombre')." (".$obj_acta->Actividade1->getAttr('descripcion').') ';
    }else{
    	$codigo.="--";
    }
    $codigo.= "</td><td class='aling-left back-green'><strong>Fecha:</strong></td>
    <td class='tg-031eF'>".date('d-m-Y',strtotime($obj_acta->getAttr('fecha')))."</td>
  </tr>
  <tr>
    <td style='width:10%' class='tg-e3zv back-green'>Tipo de Supervisi&oacute;n:</td>
    <td class='tg-031eF'>".$tipo_supervision."</td>
	<td class='tg-e3zv back-green'>N&deg; Acta:</td>
	<td class='tg-031eF'>".$obj_acta->getAttr('numero')."</td>
    <td class='aling-left back-green'><strong>Emp. Superv. al Servicio de:</strong></td>
    <td class='tg-031eF'>".$obj_acta->getAttr('empresa_supervisora')."</td>
  </tr>
</table><br>";
$codigo.= "
	<table class='tg' width='100%' style='margin-bottom:-10px'>
	<tr><td class='tg-e3zv back-green' style='text-align:center;background-color:#AAC95B'><strong>SUPERVISI&Oacute;N (INSPECCI&Oacute;N / OBSERVACI&Oacute;N) EN SEGURIDAD Y SALUD EN EL TRABAJO</strong></td></tr>
	</table><br>";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-blue'>EQUIPOS DE PROTECCI&Oacute;N (PERSONAL Y/O COLECTIVO)</th>
		  </tr>
		  <tr>
		   	<td class='tg-031e' style='text-align: justify;'>";
			$normas_cumplidas = 0;
			$normas_incumplidas = 0;
			$cont_nc_sd = 0;
			$cont_ni_sd = 0;

			$cont_nc_um = 0;
			$cont_ni_um = 0;

			$cont_nc_ds = 0;
			$cont_ni_ds = 0;
			 
			$cont_nc_cu = 0;
			$cont_ni_cu = 0;

			$cont_nc_cs = 0;
			$cont_ni_cs = 0;

			$total_nc_epp = 0;
			$total_ni_epp = 0;

			$total_nc_sd = 0;
			$total_ni_sd = 0;

			$total_nc_um = 0;
			$total_ni_um = 0;

			$total_nc_ds = 0;
			$total_ni_ds = 0;
			 
			$total_nc_cu = 0;
			$total_ni_cu = 0;

			$total_nc_cs = 0;
			$total_ni_cs = 0;
			
		    $info_des_act = json_decode($obj_acta->info_des_epp);

		    foreach($info_des_act as $value){
		    	if($value->info_des_epp != ''){
		    	
			    	if($value->alternativa == 1){
			    		$codigo.= "<b>(NC)</b> ";
			    		$normas_cumplidas++;
			    		$total_nc_epp = $normas_cumplidas;
			    	}elseif($value->alternativa == 0){
			    		$codigo.= "<b>(NI)</b> ";
			    		$normas_incumplidas++;
			    		$total_ni_epp = $normas_incumplidas;
			    	}else{
			    		$codigo.= "( - ) ";
			    	}
			    	$codigo.= $value->info_des_epp." ...... ";
		    		
			    	if(isset($value->incidencia) && $value->incidencia == 1){
				    	$codigo.= "<b>(Reiterativo)</b>";
				    }elseif(isset($value->incidencia) && $value->incidencia == 2){
				    	$codigo.= "<b>(Subsanado)</b>";
					}elseif(isset($value->incidencia) && $value->incidencia == 3){
				    	$codigo.= "<b>(Nueva Insp./Obs.)</b>";
				    }else{
				    	$codigo.= "( - )";
				    }
				    $codigo.="<br>";
		    	}
		    }
$codigo.= "</td></tr>
		  <tr>
		   <td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoIpp as $key => $obj_foto_ipp) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
						<img src='".ENV_WEBROOT_FULL_URL."files/fotos_ipp/thumbnail/".$obj_foto_ipp->getAttr('file_name')."' width='190px' height='190px'>
								<br>".$obj_foto_ipp->getAttr('observacion')."</td>";
				$cont++;
				if($cont == 3){
					$codigo.="</tr>";
					$codigo.="<tr>";
					$cont = 0;
				}
			}
			
			
$codigo.= "	</tr>
			</table>
		</td>
		</tr>
		</table>
	</td>
		<br>";
$codigo.= "
			<table class='tg' width='100%'>
		  		<tr>
		    		<th class='tg-e3zv back-blue'>SE&Ntilde;ALIZACI&Oacute;N Y DELIMITACI&Oacute;N</th>
		 		</tr>
		 		<tr>
		 		<td class='tg-031e' style='text-align: justify;'>";

			    $info_des_act = json_decode($obj_acta->info_des_se_de);
			    
			    foreach($info_des_act as $value){

			    	if($value->info_des_se_de != ''){
			    		
				    	if($value->alternativa == 1){
				    		$codigo.= "<b>(NC)</b> ";
				    		$normas_cumplidas++;
				    		$cont_nc_sd++;
				    		$total_nc_sd = $cont_nc_sd;
				    	}elseif($value->alternativa == 0){
				    		$codigo.= "<b>(NI)</b> ";
				    		$normas_incumplidas++;
				    		$cont_ni_sd++;
				    		$total_ni_sd = $cont_ni_sd;
				    	}else{
				    		$codigo.= "( - ) ";
				    	}
				    	
					    $codigo.= $value->info_des_se_de." ...... ";
			    		
				    	if(isset($value->incidencia) && $value->incidencia == 1){
							$codigo.= "<b>(Reiterativo)</b>";
						}elseif(isset($value->incidencia) && $value->incidencia == 2){
							$codigo.= "<b>(Subsanado)</b>";
						}elseif(isset($value->incidencia) && $value->incidencia == 3){
							$codigo.= "<b>(Nueva Insp./Obs.)</b>";
						}else{
							$codigo.= "( - )";
						}
						$codigo.="<br>";
			    	}
			    }
$codigo.= "		
				</td>
				</tr>
		  		<tr>
		    		<td>
						<table class='tg' width='100%'>
						    ";
							$cont= 0;
							$codigo.="<tr>";
							foreach($obj_acta->FotoSd as $key => $obj_foto_sd) {
								$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
											<img src='".ENV_WEBROOT_FULL_URL."files/fotos_sd/thumbnail/".$obj_foto_sd->getAttr('file_name')."' width='190px' height='190px'>
											<br>".$obj_foto_sd->getAttr('observacion')."</td>";
								$cont++;
								if($cont == 3){
									$codigo.="</tr>";
									$codigo.="<tr>";
									$cont = 0;
								}
							}
		$codigo.= "			</tr>
						</table>
					</td>
				</tr>
			</table>
		<br>";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-blue'>UNIDADES M&Oacute;VILES</th>
		  </tr>
		  <tr><td class='tg-031e' style='text-align: justify;'>";
		  
		    $info_des_act = json_decode($obj_acta->info_des_um);
		    foreach($info_des_act as $value){
		    	
		    	if($value->info_des_um != ''){
		    		
		    		if($value->alternativa == 1){
		    			$codigo.= "<b>(NC)</b> ";
		    			$normas_cumplidas++;
		    			$cont_nc_um++;
				    	$total_nc_um = $cont_nc_um;
		    		}elseif($value->alternativa == 0){
		    			$codigo.= "<b>(NI)</b> ";
		    			$normas_incumplidas++;
		    			$cont_ni_um++;
				    	$total_ni_um = $cont_ni_um;
		    		}else{
		    			$codigo.= "( - ) ";
		    		}
		    		 
		    		$codigo.=$value->info_des_um." ...... ";
			    		
				   	if(isset($value->incidencia) && $value->incidencia == 1){
				    	$codigo.= "<b>(Reiterativo)</b>";
				    }elseif(isset($value->incidencia) && $value->incidencia == 2){
				    	$codigo.= "<b>(Subsanado)</b>";
					}elseif(isset($value->incidencia) && $value->incidencia == 3){
				    	$codigo.= "<b>(Nueva Insp./Obs.)</b>";
				    }else{
				    	$codigo.= "( - )";
				    }
				$codigo .="<br>";
			    }
		    }
$codigo.= "
		  </td></tr>
		  <tr>
		  	<td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoUm as $key => $obj_foto_um) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
						  <img src='".ENV_WEBROOT_FULL_URL."files/fotos_um/thumbnail/".$obj_foto_um->getAttr('file_name')."' width='190px' height='190px'>
						  <br>".$obj_foto_um->getAttr('observacion')."</td>";
				$cont++;
				if($cont == 3){
					$codigo.="</tr>";
					$codigo.="<tr>";
					$cont = 0;
				}
			}
$codigo.= "	</tr>
			</table>
		 </td>
		</tr>
		</table>
<br>";

$codigo.= "
		 <table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-blue' width='65%'>DOCUMENTACI&Oacute;N DE SEGURIDAD</th>
		  </tr>
		  <tr><td class='tg-031e' style='text-align: justify;'>";
		    $info_des_act = json_decode($obj_acta->info_des_doc);
		    foreach($info_des_act as $value){
		    	if($value->info_des_doc != ''){
		    		
		    		if($value->alternativa == 1){
		    			$codigo.= "<b>(NC)</b> ";
		    			$normas_cumplidas++;
		    			$cont_nc_ds++;
				    	$total_nc_ds = $cont_nc_ds;
		    		}elseif($value->alternativa == 0){
		    			$codigo.= "<b>(NI)</b> ";
		    			$normas_incumplidas++;
		    			$cont_ni_ds++;
				    	$total_ni_ds = $cont_ni_ds;
		    		}else{
		    			$codigo.= "( - )";
		    		}

		    		$codigo.= $value->info_des_doc." ...... ";

				   	if(isset($value->incidencia) && $value->incidencia == 1){
				    	$codigo.= "<b>(Reiterativo)</b>";
				    }elseif(isset($value->incidencia) && $value->incidencia == 2){
				    	$codigo.= "<b>(Subsanado)</b>";
					}elseif(isset($value->incidencia) && $value->incidencia == 3){
				    	$codigo.= "<b>(Nueva Insp./Obs.)</b>";
				    }else{
				    	$codigo.= "<b>( - )</b>";
				    }

		    		$codigo.="<br>";
		    	}
		    }
		    	
$codigo.= "
		  </tr>
		  </td>
		  <tr>
		  	<td>
		   	<table class='tg' width='100%'>
		    ";
$cont= 0;
$codigo.="<tr>";
foreach($obj_acta->FotoDoc as $key => $obj_foto_doc) {
	$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
						  <img src='".ENV_WEBROOT_FULL_URL."files/fotos_doc/thumbnail/".$obj_foto_doc->getAttr('file_name')."' width='190px' height='190px'>
						  <br>".$obj_foto_doc->getAttr('observacion')."</td>";
				$cont++;
				if($cont == 3){
					$codigo.="</tr>";
					$codigo.="<tr>";
					$cont = 0;
				}
}
$codigo.= "	</tr>
			</table>
		 </td>
		</tr>
		</table>
		<br>";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-blue'>CUMPLIMIENTO DEL PROCEDIMIENTO DE TRABAJO SEGURO</th>
		  </tr>
		  <tr><td class='tg-031e' style='text-align: justify;'>";
		    $info_des_act = json_decode($obj_acta->info_des_act);
		    foreach($info_des_act as $value){
		    	if($value->info_des_act != ''){
		    		
		    		if($value->alternativa == 1){
		    			$codigo.= "<b>(NC)</b> ";
		    			$normas_cumplidas++;
		    			$cont_nc_cu++;
				    	$total_nc_cu = $cont_nc_cu;
		    		}elseif($value->alternativa == 0){
		    			$codigo.= "<b>(NI)</b> ";
		    			$normas_incumplidas++;
		    			$cont_ni_cu++;
				    	$total_ni_cu = $cont_ni_cu;
		    		}else{
		    			$codigo.= "( - ) ";
		    		}

		    		$codigo.= $value->info_des_act." ...... ";
			    		
				   	if(isset($value->incidencia) && $value->incidencia == 1){
				    	$codigo.= "<b>(Reiterativo)</b>";
				    }elseif(isset($value->incidencia) && $value->incidencia == 2){
				    	$codigo.= "<b>(Subsanado)</b>";
					}elseif(isset($value->incidencia) && $value->incidencia == 3){
				    	$codigo.= "<b>(Nueva Insp./Obs.)</b>";
				    }else{
				    	$codigo.= "( - )";
				    }
		    		$codigo.="<br>";
		    	}
		    }
		    	
$codigo.= " </td>
		   </tr>
		   <tr>
		   	<td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoAct as $key => $obj_foto_as) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
							<img src='".ENV_WEBROOT_FULL_URL."files/fotos_as/thumbnail/".$obj_foto_as->getAttr('file_name')."' width='190px' height='190px'>
							<br>".$obj_foto_as->getAttr('observacion')."</td>";
				$cont++;
				if($cont == 3){
					$codigo.="</tr>";
					$codigo.="<tr>";
					$cont = 0;
				}
			}
$codigo.= "	</tr>
			</table>
			</td>
		  </tr>
		</table>		
<br>";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
			<th class='tg-e3zv back-blue'>CONDICIONES DE SEGURIDAD</th>
		  </tr>
		  <tr><td class='tg-031e' style='text-align: justify;'>
		  ";
		    $info_des_cond = json_decode($obj_acta->info_des_cond);
		    foreach($info_des_cond as $value){
		    	if($value->info_des_cond != ''){
		    		
		    		if($value->alternativa == 1){
		    			$codigo.= "<b>(NC)</b> ";
		    			$normas_cumplidas++;
		    			$cont_nc_cs++;
				    	$total_nc_cs = $cont_nc_cs;
		    		}elseif($value->alternativa == 0){
		    			$codigo.= "<b>(NI)</b> ";
		    			$normas_incumplidas++;
		    			$cont_ni_cs++;
				    	$total_ni_cs = $cont_ni_cs;
		    		}else{
		    			$codigo.= "( - ) ";
		    		}
		    		
		    		$codigo.= $value->info_des_cond." ...... ";
			    		
				   	if(isset($value->incidencia) && $value->incidencia == 1){
				    	$codigo.= " <b>(Reiterativo)</b>";
				    }elseif(isset($value->incidencia) && $value->incidencia == 2){
				    	$codigo.= " <b>(Subsanado)</b>";
					}elseif(isset($value->incidencia) && $value->incidencia == 3){
				    	$codigo.= " <b>(Nueva Insp./Obs.)</b>";
				    }else{
				    	$codigo.= "( - )";
				    }
		    		$codigo.="<br>";
		    	}
		    }
		    
$codigo.="	</td>
		  </tr>
			<tr>
		   	<td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoCond as $key => $obj_foto_cs) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;' width='100%'>
							<img src='".ENV_WEBROOT_FULL_URL."files/fotos_cs/thumbnail/".$obj_foto_cs->getAttr('file_name')."' width='190px' height='190px'>
							<br>".$obj_foto_cs->getAttr('observacion')."</td>";
				$cont++;
				if($cont == 3){
					$codigo.="</tr>";
					$codigo.="<tr>";
					$cont = 0;
				}
			}
$codigo.= "	</tr>
			</table>
			</td>
		  </tr>
		</table>
<br>";

$codigo.="
		<table class='tg salto-linea' width='100%'>
		  <tr>
		    <th class='tg-hgcj back-blue' colspan='2'><strong>CONCLUSIONES, RECOMENDACIONES Y ACCIONES CORRECTIVAS</strong></th>
		  </tr>
		  <tr>
		    <td width='50%' class='tg-e3zv back-blue'>CONCLUSIONES</td>
		    <td width='50%' class='tg-e3zv back-blue'>RECOMENDACIONES</td>
		  </tr>
		  <tr style='vertical-align:top;'>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_conclusion')."</td>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_rec')."</td>
		  </tr>
		</table>
		";
$codigo.="<br>";
$codigo.="
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-hgcj back-blue'><strong>MEDIDAS DE CONTROL</strong></th>
		  </tr>
		  <tr style='vertical-align:top;'>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_med')."</td>
		  </tr>
		  <tr>
		   	<td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoMed as $key => $obj_foto_med) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
							<img src='".ENV_WEBROOT_FULL_URL."files/fotos_med/thumbnail/".$obj_foto_med->getAttr('file_name')."' width='190px' height='190px'>
							<br>".$obj_foto_med->getAttr('observacion')."</td>";
				$cont++;
				if($cont == 3){
					$codigo.="</tr>";
					$codigo.="<tr>";
					$cont = 0;
				}
			}
$codigo.= "	</tr>
			</table>
			</td>
		  </tr>  		
		</table>
		<br>
		";
	
	$codigo.= "<table class='tg salto-linea' width='100%' style='border:0px;font-size:8px;'>";
	$codigo.= "<tr><th colspan=8 class='tg-e3zv back-blue'><strong>CUADRO RESUMEN DE NIVEL DE CUMPLIMIENTO A NORMAS DE SEGURIDAD</strong></th></tr>";
	$codigo .= "<tr><td></td>
					<td>EPP</td>
					<td>SE</td>
					<td>UM</td>
					<td>DOC</td>
					<td>CP</td>
					<td>AC</td>
					<td>TOTAL</td></tr>";
	$codigo .= "<tr><td><strong>TOTAL CUMPLIMIENTO (NC):</strong> </td><td>".$total_nc_epp."</td><td>".$total_nc_sd."</td><td>".$total_nc_um."</td><td>".$total_nc_ds."</td><td>".$total_nc_cu."</td><td>".$total_nc_cs."</td><td>".$normas_cumplidas."</td></tr>";
	$codigo .= "<tr><td><strong>TOTAL INCUMPLIMIENTO (NI):</strong> </td><td>".$total_ni_epp."</td><td>".$total_ni_sd."</td><td>".$total_ni_um."</td><td>".$total_ni_ds."</td><td>".$total_ni_cu."</td><td>".$total_ni_cs."</td><td>".$normas_incumplidas."</td></tr>";
	//$codigo .= "<tr><td><strong>TOTAL (NC + NI):</strong> </td><td>".($normas_incumplidas + $normas_cumplidas)."</td></tr>";
	$suma_normas = $normas_cumplidas + $normas_incumplidas;
	if($suma_normas > 0){
		$formula = ($normas_cumplidas * 100)/$suma_normas;
	}else{
		$formula = 0;
	}

	$codigo .= "<tr><td><strong>NIVEL DE CUMPLIMIENTO:</strong> </td><td>";
	if(($total_nc_epp+$total_ni_epp)>0){$codigo .= round(($total_nc_epp*100)/($total_nc_epp+$total_ni_epp),2)."%</td><td>";}else{$codigo .= round(($total_nc_epp*100),2)."%</td><td>";}
	if(($total_nc_sd+$total_ni_sd)>0){$codigo .= round(($total_nc_sd*100)/($total_nc_sd+$total_ni_sd),2)."%</td><td>";}else{$codigo .= round(($total_nc_sd*100),2)."%</td><td>";}
	if(($total_nc_um+$total_ni_um)>0){$codigo .= round(($total_nc_um*100)/($total_nc_um+$total_ni_um),2)."%</td><td>";}else{$codigo .= round(($total_nc_um*100),2)."%</td><td>";}
	if(($total_nc_ds+$total_ni_ds)>0){$codigo .= round(($total_nc_ds*100)/($total_nc_ds+$total_ni_ds),2)."%</td><td>";}else{$codigo .= round(($total_nc_ds*100),2)."%</td><td>";}
	if(($total_nc_cu+$total_ni_cu)>0){$codigo .= round(($total_nc_cu*100)/($total_nc_cu+$total_ni_cu),2)."%</td><td>";}else{$codigo .= round(($total_nc_cu*100),2)."%</td><td>";}
	if(($total_nc_cs+$total_ni_cs)>0){$codigo .= round(($total_nc_cs*100)/($total_nc_cs+$total_ni_cs),2)."%</td><td>";}else{$codigo .= round(($total_nc_cs*100),2)."%</td><td>";}
	$codigo .= round($formula,2)."%</td></tr>";
	$codigo .= "</table>";

	//SHOW GRAPHIC
	if($obj_acta->getAttr('grafico')!='' && $obj_acta->getAttr('grafico') !=null){
		$codigo .= "<br><center><strong>GR&Aacute;FICO</strong></center>";
		$codigo .= "<center><img src='".ENV_WEBROOT_FULL_URL."files/graficos/".$obj_acta->getAttr('grafico')."'></center>";
	}


	//Show Tabla de acta de referencia y grafico de referencia 
	if($obj_acta->getAttr('acta_referencia')!=''){

		$normas_epp2 = $obj_acta_ref->getAttr('info_des_epp');
		$normas_sd2 = $obj_acta_ref->getAttr('info_des_se_de');
		$normas_um2 = $obj_acta_ref->getAttr('info_des_um');
		$normas_ds2 = $obj_acta_ref->getAttr('info_des_doc');
		$normas_cp2 = $obj_acta_ref->getAttr('info_des_act');
		$normas_ac2 = $obj_acta_ref->getAttr('info_des_cond');

		//Contador inicializado en cero
		$total_nc_epp2 = 0;
		$total_ni_epp2 = 0;

		$total_nc_sd2 = 0;
		$total_ni_sd2 = 0;

		$total_nc_um2 = 0;
		$total_ni_um2 = 0;

		$total_nc_ds2 = 0;
		$total_ni_ds2 = 0;
		 
		$total_nc_cu2 = 0;
		$total_ni_cu2 = 0;

		$total_nc_cs2 = 0;
		$total_ni_cs2 = 0;

		$normas_cumplidas2 = 0;
		$normas_incumplidas2 = 0;

		//recorremos
		$info_des_epp2 = json_decode($normas_epp2);
		foreach($info_des_epp2 as $value){
			if($value->info_des_epp != ''){
		    	if($value->alternativa == 1){
		    		$normas_cumplidas2++;
		    		$total_nc_epp2++;
		    	}elseif($value->alternativa == 0){
					$normas_incumplidas2++;
		    		$total_ni_epp2++;
		    	}

			}
		}

		$info_des_se_de2 = json_decode($normas_sd2);
		foreach($info_des_se_de2 as $value){
			if($value->info_des_se_de != ''){
		    	if($value->alternativa == 1){
		    		$normas_cumplidas2++;
		    		$total_nc_sd2++;
		    	}elseif($value->alternativa == 0){
					$normas_incumplidas2++;
		    		$total_ni_sd2++;
		    	}
			}	
		}


		$info_des_um2 = json_decode($normas_um2);
		foreach($info_des_um2 as $value){
			if($value->info_des_um != ''){
				if($value->alternativa == 1){
					$normas_cumplidas2++;
			    	$total_nc_um2++;
				}elseif($value->alternativa == 0){
					$normas_incumplidas2++;
			    	$total_ni_um2++;
				}
			}
		}

		$info_des_doc2 = json_decode($normas_ds2);
		foreach($info_des_doc2 as $value){
			if($value->info_des_doc != ''){
				if($value->alternativa == 1){
					$normas_cumplidas2++;
			    	$total_nc_ds2++;
				}elseif($value->alternativa == 0){
					$normas_incumplidas2++;
			    	$total_ni_ds2++;
				}
			}
		}

		$info_des_act2 = json_decode($normas_cp2);
		foreach($info_des_act2 as $value){
			if($value->info_des_act != ''){
				if($value->alternativa == 1){
					$normas_cumplidas2++;
			    	$total_nc_cu2++;
				}elseif($value->alternativa == 0){
					$normas_incumplidas2++;
			    	$total_ni_cu2++;
				}
			}
		}


		$info_des_cond2 = json_decode($normas_ac2);
		foreach($info_des_cond2 as $value){
			if($value->info_des_cond != ''){
				if($value->alternativa == 1){
					$normas_cumplidas2++;
			    	$total_nc_cs2++;
				}elseif($value->alternativa == 0){
					$normas_incumplidas2++;
			    	$total_ni_cs2++;
				}
			}
		}

		$suma_normas2 = $normas_cumplidas2 + $normas_incumplidas2;
		if($suma_normas > 0){
			$formula2 = ($normas_cumplidas2 * 100)/$suma_normas2;
		}else{
			$formula2 = 0;
		}

		$codigo.= "<div class='tg salto-linea'></div>";
		$codigo.= "<div><strong>INF. DE REFERENCIA N&#176; ".$obj_acta_ref->getAttr('num_informe')."</strong></div><br>";
		$codigo.= "<table class='tg' width='100%' style='border:0px;font-size:8px;'>";
		$codigo.= "<tr><th colspan=8 class='tg-e3zv back-blue'><strong>CUADRO RESUMEN DE NIVEL DE CUMPLIMIENTO A NORMAS DE SEGURIDAD</strong></th></tr>";
		$codigo .= "<tr><td></td>
					<td>EPP</td>
					<td>SE</td>
					<td>UM</td>
					<td>DOC</td>
					<td>CP</td>
					<td>AC</td>
					<td>TOTAL</td></tr>";
		$codigo .= "<tr><td><strong>TOTAL CUMPLIMIENTO (NC):</strong> </td><td>".$total_nc_epp2."</td><td>".$total_nc_sd2."</td><td>".$total_nc_um2."</td><td>".$total_nc_ds2."</td><td>".$total_nc_cu2."</td><td>".$total_nc_cs2."</td><td>".$normas_cumplidas2."</td></tr>";
		$codigo .= "<tr><td><strong>TOTAL INCUMPLIMIENTO (NI):</strong> </td><td>".$total_ni_epp2."</td><td>".$total_ni_sd2."</td><td>".$total_ni_um2."</td><td>".$total_ni_ds2."</td><td>".$total_ni_cu2."</td><td>".$total_ni_cs2."</td><td>".$normas_incumplidas2."</td></tr>";

		$codigo .= "<tr><td><strong>NIVEL DE CUMPLIMIENTO:</strong> </td><td>";
		if(($total_nc_epp2+$total_ni_epp2)>0){$codigo .= round(($total_nc_epp2*100)/($total_nc_epp2+$total_ni_epp2),2)."%</td><td>";}else{$codigo .= round(($total_nc_epp2*100),2)."%</td><td>";}
		if(($total_nc_sd2+$total_ni_sd2)>0){$codigo .= round(($total_nc_sd2*100)/($total_nc_sd2+$total_ni_sd2),2)."%</td><td>";}else{$codigo .= round(($total_nc_sd2*100),2)."%</td><td>";}
		if(($total_nc_um2+$total_ni_um2)>0){$codigo .= round(($total_nc_um2*100)/($total_nc_um2+$total_ni_um2),2)."%</td><td>";}else{$codigo .= round(($total_nc_um2*100),2)."%</td><td>";}
		if(($total_nc_ds2+$total_ni_ds2)>0){$codigo .= round(($total_nc_ds2*100)/($total_nc_ds2+$total_ni_ds2),2)."%</td><td>";}else{$codigo .= round(($total_nc_ds2*100),2)."%</td><td>";}
		if(($total_nc_cu2+$total_ni_cu2)>0){$codigo .= round(($total_nc_cu2*100)/($total_nc_cu2+$total_ni_cu2),2)."%</td><td>";}else{$codigo .= round(($total_nc_cu2*100),2)."%</td><td>";}
		if(($total_nc_cs2+$total_ni_cs2)>0){$codigo .= round(($total_nc_cs2*100)/($total_nc_cs2+$total_ni_cs2),2)."%</td><td>";}else{$codigo .= round(($total_nc_cs2*100),2)."%</td><td>";}
		$codigo .= round($formula2,2)."%</td></tr>";
		$codigo .= "</table>";

		//SHOW GRAPHIC
		if($obj_acta_ref->getAttr('grafico')!='' && $obj_acta_ref->getAttr('grafico') != null){
			$codigo .= "<br><center><strong>GR&Aacute;FICO</strong></center>";
			$codigo .= "<center><img src='".ENV_WEBROOT_FULL_URL."files/graficos/".$obj_acta_ref->getAttr('grafico')."'></center>";
		}
	}
	//END Informe de referencia

$codigo .= "<div align='right'><table width='100%'>
			<tr><td><div style='text-align:right;'>";
			if($obj_acta->getAttr('reponsable_sup_id') != 0){
				$codigo.= "<img src='".ENV_WEBROOT_FULL_URL."files/firmas/".$obj_acta->Trabajadore2->getAttr('firma')."' style='border:0px;' width='144px' height='80px'> ";
			}else{
				$codigo.="";
			}
$codigo .= "</div>";
$codigo .= "<div style='text-align:right;'><hr width='30%' align='right'></div>
		   	<div style='text-align:right;font-size:13px;'>";
			if($obj_acta->getAttr('reponsable_sup_id') !=0){
				$codigo.= "ING. ".$obj_acta->Trabajadore2->getAttr('apellido_nombre');
			}else{
				$codigo.="";
			}
$codigo.="</div>
		   	<div style='text-align:right;font-size:13px; padding-left: 25px; padding-right: 25px;'>SUPERVISOR DE SST - M&M</div></td></tr></table></div><div class='salto-linea'>&nbsp;</div>";

$codigo.= "<table class='tg' width='100%'>
		<thead>
		<tr>
		<th class='tg-e3zv back-blue' colspan=10 style='text-align: center;'>TRABAJADORES SUPERVISADOS</th>
				</tr>
				<tr>
				<th>N&deg;</th>
				<th>Nombre del trabajador</th>
				<th>Cargo</th>
				<th colspan=7 style='vertical-align: middle; text-align: center;'>Normas Incumplidas</th>
				</tr>
				</thead>
		<tbody>";

foreach ($obj_acta->ImpProtPersonale as $key => $obj_imp_prot_personal){
		$codigo.= "<tr>";
		$codigo.= "<td>".($key+1)."</td>";
		$codigo.= "<td style='width:28%;'>";
		$codigo.= $obj_imp_prot_personal->Trabajadore->getAttr('apellido_nombre');
		$codigo.= "</td>";

		$codigo.= "<td>";
		$codigo.= $obj_imp_prot_personal->Actividade->getAttr('descripcion');
		$codigo.= "</td>";

		$count_obj_ipp_ni = count($obj_imp_prot_personal->IppNormasIncumplida);
		if($count_obj_ipp_ni > 0){
			foreach($obj_imp_prot_personal->IppNormasIncumplida as $k =>$v){
				$codigo.= "<td style='width:7%;'>";
				$codigo.= $v->Codigo->getAttr('codigo');
				$codigo.= "</td>";
			}
				
			for($j= ($k+2); $j <=7; $j++){
				$codigo.= "<td style='width:7%; text-align: center;'>-";
				$codigo.= "</td>";
			}
				
		}else{
			for($i= 1; $i <=7; $i++){
				$codigo.= "<td style='width:7%; text-align: center;'>-";
				$codigo.= "</td>";
			}
		}
}
$codigo.= "</tr>";
$codigo.= "</tbody>";
$codigo.= "</table><br>";

$codigo.= "<table class='tg' width='100%'>
		<thead>
		<tr>
		<th class='tg-e3zv back-blue' colspan=11 style='text-align: center;'>UNIDADES M&Oacute;VILES SUPERVISADAS</th>
								</tr>
								<tr>
									<th style='width: 6%;'
										style='vertical-align:middle; text-align: center;'>N&deg; T</th>
									<th>N&deg; de Placa</th>
									<th>Tipo Veh&iacute;culo</th>
									<th colspan=8
										style='vertical-align: middle; text-align: center;'>Normas
										Incumplidas</th>
								</tr>
							</thead>
							<tbody>";
							
							foreach ($obj_acta->UnidadesMovile as $key2 => $obj_uni_movil){
									$codigo.= "<tr>";
									$codigo.= "<td>".($key2+1)."</td>";
									$codigo.= "<td style='width:14%;'>";
									$codigo.= $obj_uni_movil->Vehiculo->getAttr('nro_placa');
									$codigo.= "</td>";
								
									$codigo.= "<td>";
									$codigo.= $obj_uni_movil->Vehiculo->TipoVehiculo->getAttr('descripcion');
									$codigo.= "</td>";
								
									$count_obj_um_ni = count($obj_uni_movil->UmNormasIncumplida);
									if($count_obj_um_ni > 0){
										foreach($obj_uni_movil->UmNormasIncumplida as $k =>$v){
											$codigo.= "<td style='width:7%;'>";
											$codigo.= $v->Codigo->getAttr('codigo');
											$codigo.= "</td>";
										}
											
										for($j= ($k+2); $j <=8; $j++){
											$codigo.= "<td style='width:7%; text-align: center;'>-";
											$codigo.= "</td>";
										}
											
									}else{
										for($i= 1; $i <=8; $i++){
											$codigo.= "<td style='width:7%; text-align: center;'>-";
											$codigo.= "</td>";
										}
									}
							}
							$codigo.= "</tr>";
							$codigo.= "</tbody>";
							$codigo.= "</table><br>";
if(isset($info_ni_t) || isset($info_ni_v)){
	$codigo.= "<table class='tg' width='100%'>";
	$codigo.= "<thead>
				<tr>
					<th class='tg-e3zv back-blue' colspan=3 style='text-align: center;'>DETALLE DE NORMAS INCUMPLIDAS</th>
				</tr>
				<tr>
					<th>C&oacute;digo</th>
					<th>Categoria</th>
					<th>Observaci&oacute;n</th>
				</tr>
			</thead>";
	foreach ($info_ni_t as $k => $v){ //normas incumplidas Trabajadores
		$codigo.= "<tr>";
		$codigo.= "<td>";
		$codigo.= $v['CodigosJoin']['codigo'];
		$codigo.= "</td>";
		$codigo.= "<td>";
		$codigo.= $v['CategoriaNormasJoin']['descripcion'];
		$codigo.= "</td>";
		$codigo.= "<td>";
		$codigo.= $v['CodigosJoin']['observacion'];
		$codigo.= "</td>";
		$codigo.= "</tr>";
	}
	
	foreach ($info_ni_v as $k2 => $v2){ //normas incumplidas Vehiculos
		$codigo.= "<tr>";
		$codigo.= "<td>";
		$codigo.= $v2['CodigosJoin']['codigo'];
		$codigo.= "</td>";
		$codigo.= "<td>";
		$codigo.= $v2['CategoriaNormasJoin']['descripcion'];
		$codigo.= "</td>";
		$codigo.= "<td>";
		$codigo.= $v2['CodigosJoin']['observacion'];
		$codigo.= "</td>";
		$codigo.= "</tr>";
	}
	
	$codigo.= "</table><p>&nbsp;</p>";
}

//echo $codigo; exit();
$dompdf = new DOMPDF();
$dompdf->set_paper("A4");
$dompdf->load_html($codigo);
ini_set('memory_limit', '512M');
$dompdf->render();

$dompdf->stream("Informe ".$obj_acta->getAttr('num_informe').".pdf",array("Attachment"=>0));

exit();
?>