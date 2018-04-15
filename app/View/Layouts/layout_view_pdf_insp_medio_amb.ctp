<?php
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 

if(isset($obj_acta)){
	$acta_id = $obj_acta->getAttr('id');
	//echo $my_content;
	$tipo_supervision = ($obj_acta->getAttr('tipo') == 'P')? 'Planeada':'Inopinada';
}
$codigo = "<style type='text/css'>
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Californian FB, Georgia, Serif;font-size:14px;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Californian FB, Georgia, Serif;font-size:14px;font-weight:normal;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.font-head{font-family:Arial, Verdana, Sans-serif !important;font-size:14px;font-weight:normal;}
.tg-031eF{color:#17365D;}
.tg .tg-e3zv{font-weight:bold;}
.tg-uni {text-align:center !important;}
.aling-left {text-align:left;}
.aling-right {text-align:right;}
.aling-justify {text-align:justify;}

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
.head-pag td{
	padding:0px 5px
}

.back-green{
 background-color: #D6E3BC;
}
		
.back-green2{
 background-color: #92D050;
}

.back-blue{
 background-color: #BDD6EE;
}

.back-blue2{
 background-color: #DEEAF6;
}

.back-gray{
 background-color: #dcdbdb;
}

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
			<table class='tg tg-031eF back-blue2' width='100%'>
			  <tr>
				<th style='width:12%;' class='tg-031e back-green' rowspan='3'><img src='".ENV_WEBROOT_FULL_URL."img/logo_mym2016.png' style='width: 70px; border:0px; padding:0px 0px'/></th>
			    <th style='width:60%' class='tg-031e' rowspan='2' colspan='2'><h2 style='margin:2px'>M&amp;M Ingenier&iacute;a Obras y Servicios <span style='font-size:16px;'>E.I.R.L.</span></h2>
			    <span style='font-size:8.0pt;color:#002060;margin:2px'>Ejecuci&oacute;n y supervisi&oacute;n de obras el&eacute;ctricas, electromec&aacute;nicas, civiles, miner&iacute;a e industrial.<br>Especialistas de gesti&oacute;n en Seguridad, salud en el trabajo, calidad y medio ambiente.</span></th>
				<th class='aling-left'><strong>C&oacute;digo: M001-SST/MA</strong></th>
			  </tr>
			  <tr>
			    <td class='tg-031e'><strong>Versi&oacute;n: 01/2018-M001</strong></td>
			  </tr>
			  <tr>
			    <td style='text-align:center;font-size:9.5pt;' class='tg-031e back-green'>Versión Anterior: 01/2017-M001</td>
			    <td style='text-align:center;font-size:9.5pt;' class='aling-left back-green'>Modificaci&oacute;n Versión: JAMM</td>
			    <td style='text-align:center;font-size:9.5pt;' class='tg-031e back-green'>Fecha Modificaci&oacute;n: 01/01/2018</td>
			  </tr>
			</table>
			<br>
			</div>";
			
$codigo.= "<table class='tg' width='100%' style='margin-bottom:-10px'>
			<tr>
			    <td class='tg-e3zv back-blue' style='text-align:center'><strong>INFORME T&Eacute;CNICO N&#176; ".$obj_acta->getAttr('num_informe')."</strong></td>
			  </tr>";
if($obj_acta->getAttr('llenado_lugar')!=null && $obj_acta->getAttr('llenado_lugar')!=''){			 
$codigo.="<tr><td class='tg-e3zv back-blue' style='text-align:center'><strong>".$obj_acta->getAttr('llenado_lugar')."</td></tr>";
}
$codigo.="
			</table>
			<br>";


$codigo .="<table class='tg font-head' width='100%' style='margin-bottom:-10px'>

  <tr>
    <th class='tg-e3zv aling-left back-green'>Empresa:</th>
    <th class='tg-031eF aling-left' colspan='3' style='width:43%'>".$obj_acta->Empresa->getAttr('nombre')."</th>
    <th class='aling-left back-green'><strong>UUNN:</strong></th>
    <th class='tg-031eF aling-left' style='width:29%'>";
    if($obj_acta->getAttr('uunn_id') != 0){
    	$codigo.= $obj_acta->UnidadesNegocio->getAttr('descripcion');
    }else{
    	$codigo.="--";
    }
  $codigo .= "</th>
  </tr>
  <tr>
    <td style='width:10%' class='tg-e3zv back-green'>Lugar:</td>
    <td style='width:36%' class='tg-031eF' colspan='3'>".$obj_acta->getAttr('lugar')."</td>
    <td style='width:26%' class='aling-left back-green'><strong>&Aacute;rea:</strong></td>
    <td style='width:28%' class='tg-031eF'>";
    if($obj_acta->getAttr('tipo_lugar_id') != 0){
    	$codigo.= $obj_acta->TipoLugare->getAttr('descripcion');
    }else{
    	$codigo.="--";
    }
     

     $codigo.="</td>
  </tr>";

  $codigo .="<tr>
    <td class='tg-e3zv back-green'>Responsable:</td>
    <td class='tg-031eF' colspan='3'>".$obj_acta->getAttr('obra')."</td>
	<td class='aling-left back-green'><strong>Fecha:</strong></td>
    <td class='tg-031eF'>".date('d-m-Y',strtotime($obj_acta->getAttr('fecha')))."</td>
  </tr>
  <tr>
    <td style='width:10%' class='tg-e3zv back-green'>Tipo de Inspecci&oacute;n:</td>
    <td class='tg-031eF' colspan='3'>".$tipo_supervision."</td>
	<td class='tg-e3zv back-green'>Inspecci&oacute;n Realizado Por:</td>
	<td class='tg-031eF'>";
if($obj_acta->getAttr('reponsable_sup_cargo_id')!=0){
    	$codigo.= "ING. ".$obj_acta->Trabajadore2->getAttr('apellido_nombre');
    }else{
    	$codigo.="--";
    }
	
  $codigo.="</td></tr>
</table><br>";
$codigo.= "
	<table class='tg' width='100%' style='margin-bottom:-10px'>
	<tr><td class='tg-e3zv back-green' style='text-align:center;background-color:#AAC95B'><strong>SUPERVISI&Oacute;N E INSPECCION DEL ESTADO  MEDIOAMBIENTAL</strong></td></tr>
	</table><br>";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-blue'>DOCUMENTACI&Oacute;N MEDIO AMBIENTAL</th>
		  </tr>
		  <tr>
		   	<td class='tg-031e' style='text-align: justify;'>";
			$normas_cumplidas = 0;
			$normas_incumplidas = 0;

			$total_nc_ma = 0;
			$total_ni_ma = 0;

			$total_nc_ca = 0;
			$total_ni_ca = 0;
			
		    $info_json_doc_med_amb = json_decode($obj_acta->json_doc_med_amb);

		    foreach($info_json_doc_med_amb as $value){
		    	if($value->inf_des_doc_med != ''){
		    	
			    	if($value->alternativa == 1){
			    		$codigo.= "<b>(NC)</b> ";
			    		$normas_cumplidas++;
						$total_nc_ma++;
			    	}elseif($value->alternativa == 0){
			    		$codigo.= "<b>(NI)</b> ";
			    		$normas_incumplidas++;
			    		$total_ni_ma++;
			    	}else{
			    		$codigo.= "( - ) ";
			    	}
			    	$codigo.= $value->inf_des_doc_med;
		    		
			    	if(isset($value->incidencia) && $value->incidencia == 1){
				    	$codigo.= " ...... <b>(Reiterativo)</b>";
				    }elseif(isset($value->incidencia) && $value->incidencia == 2){
				    	$codigo.= " ...... <b>(Subsanado)</b>";
					}elseif(isset($value->incidencia) && $value->incidencia == 3){
				    	$codigo.= " ...... <b>(Nueva Insp./Obs.)</b>";
				    }else{
				    	$codigo.= ""; // change ( - )
				    }
				    $codigo.="<br>";
		    	}
		    }
$codigo.= "</td></tr></table>";

$codigo.= "<div style='border-style:solid;border-width:1px;'><table class='tg' width='100%'>";
$cont= 0;
$codigo.="<tr>";
foreach($obj_acta->FotoMedAmbDoc as $key => $obj_foto_ad) {
	$file = ENV_WEBROOT_FULL_URL."files/fotos_med_amb_doc/".$obj_foto_ad->getAttr('file_name');
	list($ancho, $alto, $type, $attr) = getimagesize($file);
	$width = ($ancho > $alto) ? "width='340px'":"";
	$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none; width:50%'>
			<a target='_blank' href='".ENV_WEBROOT_FULL_URL."files/fotos_med_amb_doc/".$obj_foto_ad->getAttr('file_name')."' ><img src='".ENV_WEBROOT_FULL_URL."files/fotos_med_amb_doc/thumbnail/".$obj_foto_ad->getAttr('file_name')."' ".$width." height='255px'></a>
					<br>".$obj_foto_ad->getAttr('observacion')."</td>";
	$cont++;
	if($cont == 2){
		$codigo.="</tr></table>";
		$codigo.="<table class='tg' width='100%'><tr>";
		$cont = 0;
	}
}
$codigo.= "	</tr></table></div><br>";


$codigo.= "<table style='padding:-3px;margin:0px' width='100%' border='0'><tr><td>
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-blue'>CONDICIONES AMBIENTALES</th>
		  </tr>
		  <tr><td class='tg-031e' style='text-align: justify;'>";
		    $info_json_cond_amb = json_decode($obj_acta->json_cond_amb);
		    foreach($info_json_cond_amb as $value){
		    	if($value->inf_des_cond_amb != ''){
		    		
		    		if($value->alternativa == 1){
		    			$codigo.= "<b>(NC)</b> ";
		    			$normas_cumplidas++;
		    			$total_nc_ca++;
		    		}elseif($value->alternativa == 0){
		    			$codigo.= "<b>(NI)</b> ";
		    			$normas_incumplidas++;
		    			$total_ni_ca++;
		    		}else{
		    			$codigo.= "( - ) ";
		    		}

		    		$codigo.= $value->inf_des_cond_amb;
			    		
				   	if(isset($value->incidencia) && $value->incidencia == 1){
				    	$codigo.= " ...... <b>(Reiterativo)</b>";
				    }elseif(isset($value->incidencia) && $value->incidencia == 2){
				    	$codigo.= " ...... <b>(Subsanado)</b>";
					}elseif(isset($value->incidencia) && $value->incidencia == 3){
				    	$codigo.= " ...... <b>(Nueva Insp./Obs.)</b>";
				    }else{
				    	$codigo.= "";// change ( - )
				    }
		    		$codigo.="<br>";
		    	}
		    }
		    	
$codigo.= "</td>
		  </tr>
		</table>
		</td></tr></table>";


$codigo.= "<div style='border-style:solid;border-width:1px;'><table class='tg' width='100%'>";
$cont= 0;
$codigo.="<tr>";
foreach($obj_acta->FotoMedAmbCond as $key => $obj_foto_ca) {
	$file = ENV_WEBROOT_FULL_URL."files/fotos_med_amb_cond/".$obj_foto_ca->getAttr('file_name');
	list($ancho, $alto, $type, $attr) = getimagesize($file);
	$width = ($ancho > $alto) ? "width='340px'":"";
	$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none; width:50%'>
				<a target='_blank' href='".ENV_WEBROOT_FULL_URL."files/fotos_med_amb_cond/".$obj_foto_ca->getAttr('file_name')."' ><img src='".ENV_WEBROOT_FULL_URL."files/fotos_med_amb_cond/thumbnail/".$obj_foto_ca->getAttr('file_name')."' ".$width." height='255px'></a>
				<br>".$obj_foto_ca->getAttr('observacion')."</td>";
	$cont++;
	if($cont == 2){
		$codigo.="</tr></table>";
		$codigo.="<table class='tg' width='100%'><tr>";
		$cont = 0;
	}
}
$codigo.= "	</tr></table></div><br>";

$codigo.="
		<table class='tg salto-linea' width='100%'>
		  <tr>
		    <th class='tg-hgcj back-blue' colspan='2'><strong>SUPERVISI&Oacute;N E INSPECCION DEL ESTADO  MEDIOAMBIENTAL</strong></th>
		  </tr>
		  <tr>
		    <th class='tg-hgcj back-blue' colspan='2'><strong>CONCLUSIONES, RECOMENDACIONES Y ACCIONES CORRECTIVAS</strong></th>
		  </tr>
		  <tr>
		    <td width='50%' class='tg-e3zv back-green' style='text-align:center;background-color:#AAC95B'>CONCLUSIONES</td>
		    <td width='50%' class='tg-e3zv back-green' style='text-align:center;background-color:#AAC95B'>RECOMENDACIONES</td>
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
		    <th class='tg-e3zv back-green' style='text-align:center;background-color:#AAC95B'><strong>MEDIDAS DE CONTROL</strong></th>
		  </tr>
		  <tr style='vertical-align:top;'>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_med')."</td>
		  </tr>
		  <tr>
		   	<td>
		  </tr></table>";

		  
		    $codigo.= "<div style='border-style:solid;border-width:1px;'><table class='tg' width='100%'>";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoMedAmbMedida as $key => $obj_foto_med) {
				$file = ENV_WEBROOT_FULL_URL."files/fotos_med_amb_medida/".$obj_foto_med->getAttr('file_name');
				list($ancho, $alto, $type, $attr) = getimagesize($file);
				$width = ($ancho > $alto) ? "width='340px'":"";
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none; width:50%'>
							<a target='_blank' href='".ENV_WEBROOT_FULL_URL."files/fotos_med_amb_medida/".$obj_foto_med->getAttr('file_name')."' ><img src='".ENV_WEBROOT_FULL_URL."files/fotos_med_amb_medida/thumbnail/".$obj_foto_med->getAttr('file_name')."' ".$width." height='255px'></a>
							<br>".$obj_foto_med->getAttr('observacion')."</td>";
				$cont++;
				if($cont == 2){
					$codigo.="</tr></table>";
					$codigo.="<table class='tg' width='100%'><tr>";
					$cont = 0;
				}
			}
$codigo.= "	</tr></table></div><br>";


$codigo.= "<table class='tg salto-linea' width='100%' style='border:0px;font-size:8px;'>";
	$codigo.= "<tr><th colspan=4 class='tg-e3zv back-blue'><strong>CUADRO RESUMEN DE NIVEL DE CUMPLIMIENTO A NORMAS DE SEGURIDAD</strong></th></tr>";
	$codigo .= "<tr><td width='25%'></td>
					<td width='25%'>DMA</td>
					<td width='25%'>CA</td>
					<td width='25%'>TOTAL</td></tr>";
	$codigo .= "<tr><td><strong>TOTAL CUMPLIMIENTO (NC):</strong> </td><td>".$total_nc_ma."</td><td>".$total_nc_ca."</td><td>".$normas_cumplidas."</td></tr>";
	$codigo .= "<tr><td><strong>TOTAL INCUMPLIMIENTO (NI):</strong> </td><td>".$total_ni_ma."</td><td>".$total_ni_ca."</td><td>".$normas_incumplidas."</td></tr>";
	//$codigo .= "<tr><td><strong>TOTAL (NC + NI):</strong> </td><td>".($normas_incumplidas + $normas_cumplidas)."</td></tr>";
	$suma_normas = $normas_cumplidas + $normas_incumplidas;
	if($suma_normas > 0){
		$formula = ($normas_cumplidas * 100)/$suma_normas;
	}else{
		$formula = 0;
	}

	$codigo .= "<tr><td><strong>NIVEL DE CUMPLIMIENTO:</strong> </td><td>";
	if(($total_nc_ma+$total_ni_ma)>0){$codigo .= round(($total_nc_ma*100)/($total_nc_ma+$total_ni_ma),2)."%</td><td>";}else{$codigo .= round(($total_nc_ma*100),2)."%</td><td>";}
	if(($total_nc_ca+$total_ni_ca)>0){$codigo .= round(($total_nc_ca*100)/($total_nc_ca+$total_ni_ca),2)."%</td><td>";}else{$codigo .= round(($total_nc_ca*100),2)."%</td><td>";}
	$codigo .= round($formula,2)."%</td></tr>";
	$codigo .= "</table>";

	//SHOW GRAPHIC
	if($obj_acta->getAttr('grafico')!='' && $obj_acta->getAttr('grafico') !=null){
		$codigo .= "<br><center><strong>GR&Aacute;FICO</strong></center>";
		$codigo .= "<center><img src='".ENV_WEBROOT_FULL_URL."files/graficos_acta_med_amb/".$obj_acta->getAttr('grafico')."'></center>";
	}

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
		   	<div style='text-align:right;font-size:13px; padding-left: 25px; padding-right: 25px;'>SUPERVISOR DE SST - M&M</div></td></tr></table></div>";

if(count($obj_acta->FotoMedAmbActa)>0){	
$codigo.= "<div class='salto-linea'>&nbsp;</div>
<div style='border-style:solid;border-width:1px;'><table class='tg' width='100%'><tr>
		    <th class='tg-e3zv back-blue'>ACTA DE MEDIO AMBIENTE</th>
		  </tr>";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoMedAmbActa as $key => $obj_foto_med) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
							<a target='_blank' href='".ENV_WEBROOT_FULL_URL."files/fotos_med_amb_acta/".$obj_foto_med->getAttr('file_name')."' ><img src='".ENV_WEBROOT_FULL_URL."files/fotos_med_amb_acta/".$obj_foto_med->getAttr('file_name')."' width='680px' height='840px' style='padding:4px'></a></td>";
				$cont++;
				if($cont == 1){
					$codigo.="</tr></table>";
					$codigo.="<table class='tg' width='100%'><tr>";
					$cont = 0;
				}
			}
$codigo.= "	</tr></table></div><br>";
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