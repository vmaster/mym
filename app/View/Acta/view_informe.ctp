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
		
.pie-pag {
   position:fixed;
   left:0px;
   bottom:-20px;
   height:30px;
   width:100%;
   font: 50% sans-serif;
   color:#0062AA 
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
		
img { border:1px solid green}

.salto-linea{ page-break-before:always; }
</style>";
$codigo.= "<div class='pie-pag'><hr>";
$codigo.= "<table class='tg' width='100%' style='border:0px;'>";
$codigo.= "<tr><td style='border:0px;font-size:11px;padding: 0px 5px; width:68%'><strong>Av. Victor Ra&uacute;l Haya de la Torre 1512</strong></td>
				<td style='border:0px;font-size:11px;padding: 0px 5px;text-align:right;'><strong>Telf. 074-271154 / RPM *716060 /978007000</strong></td></tr>";
$codigo.= "<tr><td style='border:0px;font-size:11px;padding: 0px 5px;'><strong>La Victoria - Chiclayo - Lambayeque</strong></td>
				<td style='border:0px;font-size:11px;padding: 0px 5px;text-align:right;'><strong>Email: mym.ingenieria@mym-iceperu.com</strong></td></tr>";
$codigo.= "</table>";
$codigo.= "</div>";

$codigo.= "<table class='tg tg-031eF back-blue' width='100%' style='margin-bottom:-15px'>
			  <tr>
				<th style='width:10%;' class='tg-031e' rowspan='3'><img src='".ENV_WEBROOT_FULL_URL."img/logo_mym2016.png' style='width: 76px; border:0px;'/></th>
			    <th style='width:62%' class='tg-031e' rowspan='3'><h2 style='margin:2px'>M&amp;M Ingenier&iacute;a Obras y Servicios <span style='font-size:16px;'>E.I.R.L.</span></h2>
			    <h5 style='margin:2px'>Ejecuci&oacute;n y supervisi&oacute;n de obras el&eacute;ctricas, electromec&aacute;nicas, civiles, miner&iacute;a e industrial.<br>Especialistas de gesti&oacute;n en Seguridad, salud en el trabajo, calidad y medio ambiente.</h5>		
			    </th>
			    <th style='width:22%' class='aling-left'><strong>Programa: SEGESEM </strong></th>
			  </tr>
			  <tr>
			    <td class='aling-left'><strong>C&oacute;digo: M001-SST</strong></td>
			  </tr>
			  <tr>
			    <td class='tg-031e'><strong>Versi&oacute;n:</strong> 00/2015-M001</strong></td>
			  </tr>
			  <tr>
			    <td class='tg-uni back-green' colspan='3' style='font-size:1em;'><strong>INFORME T&Eacute;CNICO N&#176; ".$obj_acta->getAttr('num_informe')."</strong></td>
			  </tr>
			</table><br>";


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
    <td class='tg-031eF' colspan='3'>".$obj_acta->Trabajadore1->getAttr('apellido_nombre')." (".$obj_acta->Actividade1->getAttr('descripcion').') '."</td>
    <td class='aling-left back-green'><strong>Fecha:</strong></td>
    <td class='tg-031eF'>".date('d-m-Y',strtotime($obj_acta->getAttr('fecha')))."</td>
  </tr>
  <tr>
    <td style='width:10%' class='tg-e3zv back-green'>Supervisi&oacute;n:</td>
    <td class='tg-031eF'>".$tipo_supervision."</td>
	<td class='tg-e3zv back-green'>N&deg; Acta:</td>
	<td class='tg-031eF'>".$obj_acta->getAttr('numero')."</td>
    <td class='aling-left back-green'><strong>Emp. Superv. al Servicio de:</strong></td>
    <td class='tg-031eF'>".$obj_acta->getAttr('empresa_supervisora')."</td>
  </tr>
</table><br>";
$codigo.= "
	<table class='tg' width='100%' style='margin-bottom:-10px'>
	<tr><td class='tg-e3zv back-blue' style='text-align:center'>SUPERVISI&Oacute;N DE SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
	<tr><td class='tg-e3zv back-green2' style='text-align:center'>CUMPLIMIENTO E INCUMPLIMIENTO A NORMAS DE SEGURIDAD Y  SALUD EN EL TRABAJO</td></tr>
	</table><br>
		";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-green'>EQUIPOS DE PROTECCI&Oacute;N (PERSONAL Y/O COLECTIVO)</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>";
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
			    		$codigo.= "(NC) ";
			    		$normas_cumplidas++;
			    		$total_nc_epp = $normas_cumplidas;
			    	}elseif($value->alternativa == 0){
			    		$codigo.= "(NI) ";
			    		$normas_incumplidas++;
			    		$total_ni_epp = $normas_incumplidas;
			    	}else{
			    		$codigo.= "( - ) ";
			    	}
			    	
			    	$codigo.= $value->info_des_epp."<br>";
		    	}
		    }
		    $codigo.="</td>";	
$codigo.= "</tr>
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
		    		<th class='tg-e3zv back-green'>SE&Ntilde;ALIZACI&Oacute;N Y DELIMITACI&Oacute;N</th>
		 		</tr>
		  		<tr>
			    <td class='tg-031e'>";
			    $info_des_act = json_decode($obj_acta->info_des_se_de);
			    
			    foreach($info_des_act as $value){
			    	if($value->info_des_se_de != ''){
				    	if($value->alternativa == 1){
				    		$codigo.= "(NC) ";
				    		$normas_cumplidas++;
				    		$cont_nc_sd++;
				    		$total_nc_sd = $cont_nc_sd;
				    	}elseif($value->alternativa == 0){
				    		$codigo.= "(NI) ";
				    		$normas_incumplidas++;
				    		$cont_ni_sd++;
				    		$total_ni_sd = $cont_ni_sd;
				    	}else{
				    		$codigo.= "( - ) ";
				    	}
				    	
				    	$codigo.= $value->info_des_se_de."<br>";
			    	}	
			    }
			    
			    $codigo.="</td>";	
$codigo.= "		</tr>
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
		    <th class='tg-e3zv back-green'>UNIDADES M&Oacute;VILES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>";
		    $info_des_act = json_decode($obj_acta->info_des_um);
		    foreach($info_des_act as $value){
		    	if($value->info_des_um != ''){
		    		if($value->alternativa == 1){
		    			$codigo.= "(NC) ";
		    			$normas_cumplidas++;
		    			$cont_nc_um++;
				    	$total_nc_um = $cont_nc_um;
		    		}elseif($value->alternativa == 0){
		    			$codigo.= "(NI) ";
		    			$normas_incumplidas++;
		    			$cont_ni_um++;
				    	$total_ni_um = $cont_ni_um;
		    		}else{
		    			$codigo.= "( - ) ";
		    		}
		    		 
		    		$codigo.= $value->info_des_um."<br>";
		    	}
		    }
		    $codigo.="</td>";	
$codigo.= "</tr>
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
		    <th class='tg-e3zv back-green'>DOCUMENTACI&Oacute;N DE SEGURIDAD</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>";
		    $info_des_act = json_decode($obj_acta->info_des_doc);
		    foreach($info_des_act as $value){
		    	if($value->info_des_doc != ''){
		    		if($value->alternativa == 1){
		    			$codigo.= "(NC) ";
		    			$normas_cumplidas++;
		    			$cont_nc_ds++;
				    	$total_nc_ds = $cont_nc_ds;
		    		}elseif($value->alternativa == 0){
		    			$codigo.= "(NI) ";
		    			$normas_incumplidas++;
		    			$cont_ni_ds++;
				    	$total_ni_ds = $cont_ni_ds;
		    		}else{
		    			$codigo.= "( - ) ";
		    		}
		    		 
		    		$codigo.= $value->info_des_doc."<br>";
		    	}
		    }
		    $codigo.="</td>";	
$codigo.= "</tr>
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
		  <!-- <tr>
			<th class='tg-e3zv back-green2'>
			INCUMPLIMIENTOS AL RESESATE Y NORMAS DE SEGURIDAD Y SALUD EN EL TRABAJO
			</th>
	      </tr>-->
		  <tr>
		    <th class='tg-e3zv back-green'>CUMPLIMIENTO DEL PROCEDIMIENTO DE TRABAJO SEGURO</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>";
		    $info_des_act = json_decode($obj_acta->info_des_act);
		    foreach($info_des_act as $value){
		    	if($value->info_des_act != ''){
		    		if($value->alternativa == 1){
		    			$codigo.= "(NC) ";
		    			$normas_cumplidas++;
		    			$cont_nc_cu++;
				    	$total_nc_cu = $cont_nc_cu;
		    		}elseif($value->alternativa == 0){
		    			$codigo.= "(NI) ";
		    			$normas_incumplidas++;
		    			$cont_ni_cu++;
				    	$total_ni_cu = $cont_ni_cu;
		    		}else{
		    			$codigo.= "( - ) ";
		    		}
		    		 
		    		$codigo.= $value->info_des_act."<br>";
		    	}
		    }
		    $codigo.="</td>";	
$codigo.= "</tr>
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
			<th class='tg-e3zv back-green'>ACTOS Y CONDICIONES ESTANDARES Y/O SUB-ESTANDARES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>";
		    $info_des_cond = json_decode($obj_acta->info_des_cond);
		    foreach($info_des_cond as $value){
		    	if($value->info_des_cond != ''){
		    		if($value->alternativa == 1){
		    			$codigo.= "(NC) ";
		    			$normas_cumplidas++;
		    			$cont_nc_cs++;
				    	$total_nc_cs = $cont_nc_cs;
		    		}elseif($value->alternativa == 0){
		    			$codigo.= "(NI) ";
		    			$normas_incumplidas++;
		    			$cont_ni_cs++;
				    	$total_ni_cs = $cont_ni_cs;
		    		}else{
		    			$codigo.= "( - ) ";
		    		}
		    		 
		    		$codigo.= $value->info_des_cond."<br>";
		    	}
		    }
		    $codigo.="</td>";
$codigo.=" 	  </tr>
		  <tr>
		   	<td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoCond as $key => $obj_foto_cs) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
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
		    <td width='50%' class='tg-e3zv back-green'>CONCLUSIONES</td>
		    <td width='50%' class='tg-e3zv back-green'>RECOMENDACIONES</td>
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
		    <th class='tg-hgcj back-green'><strong>MEDIDAS DE CONTROL</strong></th>
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
//$codigo .= "<table width='50%' class='tg' style='text-align:left; padding-left: 25px; padding-right: 25px; font-size:0.85em;'>";
$codigo.= "<table class='tg' width='100%' style='border:0px;font-size:8px;'>";
$codigo .= "<tr>";
$codigo .= "<td></td><td>EPP</td><td>SE&Ntilde;ALIZACI&Oacute;N</td><td>U.M</td><td>DOCUMENTO</td><td>CUMPLIMIENTO</td><td>CONDICI&Oacute;N</td><td>TOTAL</td>";
$codigo .= "</tr>";
$codigo .= "<tr><td><strong>TOTAL CUMPLIMIENTO (NC):</strong> </td><td>".$total_nc_epp."</td><td>".$total_nc_sd."</td><td>".$total_nc_um."</td><td>".$total_nc_ds."</td><td>".$total_nc_cu."</td><td>".$total_nc_cs."</td><td>".$normas_cumplidas."</td></tr>";
$codigo .= "<tr><td><strong>TOTAL INCUMPLIMIENTO (NI):</strong> </td><td>".$total_ni_epp."</td><td>".$total_ni_sd."</td><td>".$total_ni_um."</td><td>".$total_ni_ds."</td><td>".$total_ni_cu."</td><td>".$total_ni_cs."</td><td>".$normas_incumplidas."</td></tr>";
//$codigo .= "<tr><td><strong>TOTAL (NC + NI):</strong> </td><td>".($normas_incumplidas + $normas_cumplidas)."</td></tr>";
$suma_normas = $normas_cumplidas + $normas_incumplidas;
if($suma_normas > 0){
	$formula = ($normas_cumplidas * 100)/$suma_normas;
}else{
	$formula = 0;
}

$codigo .= "<tr><td><strong>NIVEL DE CUMPLIMIENTO:</strong> </td><td></td><td></td><td></td><td></td><td></td><td></td><td>".round($formula,2)."%</td></tr>";
$codigo .= "</table>";

//SHOW GRAPHIC
$codigo .= "<center><img src='".ENV_WEBROOT_FULL_URL."files/graficos/".$obj_acta->getAttr('grafico')."'></center>";

$codigo .= "<p align='right'><table width='100%'>
			<tr><td><div style='text-align:right;'><img src='".ENV_WEBROOT_FULL_URL."files/firmas/".$obj_acta->Trabajadore2->getAttr('firma')."' style='border:0px;' width='144px' height='80px'> </div>";
$codigo .= "<div style='text-align:right;'><hr width='30%' align='right'></div>
		   	<div style='text-align:right;font-size:13px; /*padding-left: 52px; padding-right: 52px;*/'>ING. ".$obj_acta->Trabajadore2->getAttr('apellido_nombre')."</div>
		   	<div style='text-align:right;font-size:13px; padding-left: 25px; padding-right: 25px;'>SUPERVISOR DE SST - M&M</div></td></tr></table></p><p class='salto-linea'>&nbsp;</p>";

$codigo.= "<table class='tg' width='100%'>
		<thead>
		<tr>
		<th class='tg-e3zv back-green' colspan=10 style='text-align: center;'>".utf8_encode('TRABAJADORES SUPERVISADOS').
		"</th>
				</tr>
				<tr>
				<th>".utf8_encode('N°')."</th>
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
		<th class='tg-e3zv back-green' colspan=11 style='text-align: center;'>".utf8_encode('UNIDADES MÓVILES SUPERVISADAS').
									"</th>
								</tr>
								<tr>
									<th style='width: 6%;'
										style='vertical-align:middle; text-align: center;'>".utf8_encode('N° T').
									"</th>
									<th>".utf8_encode('N° de Placa')."</th>
									<th>".utf8_encode('Tipo Vehículo')."</th>
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
					<th class='tg-e3zv back-green' colspan=3 style='text-align: center;'>".utf8_encode('DETALLE DE NORMAS INCUMPLIDAS')."</th>
				</tr>
				<tr>
					<th>".utf8_encode('Código')."</th>
					<th>".utf8_encode('Categoria')."</th>
					<th>".utf8_encode('Observación')."</th>
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