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
 background-color: #C6D9F1;
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

$codigo.= "<table class='tg' width='100%' style='margin-bottom:-15px'>
			  <tr>
			    <th style='width:10%' class='tg-031e back-green' rowspan='3'><img src='".ENV_WEBROOT_FULL_URL."img/logo-mini.png' style='width: 80px; border:0px;'/></th>
			    <th style='width:62%' class='tg-031e back-blue' rowspan='2'><h2 style='margin:2px'>M&amp;M Ingenier&iacute;a Obras y Servicios E.I.R.L.</h2>
			    <h5 style='margin:2px'>Ejecuci&oacute;n y supervisi&oacute;n de obras el&eacute;ctricas, civiles, miner&iacute;a e industrial.<br>Especialistas de gesti&oacute;n en Seguridad, salud en el trabajo, calidad y medio ambiente.</h5>		
			    </th>
			    <th style='width:28%' class='aling-left back-green'><strong>UUNN:</strong> ".$obj_acta->UnidadesNegocio->getAttr('descripcion')."</th>
			  </tr>
			  <tr>
			    <td class='aling-left back-green'><strong>SECTOR:</strong>".$obj_acta->getAttr('sector')."</td>
			  </tr>
			  <tr>
			    <td class='tg-uni back-blue'><strong>INFORME T&Eacute;CNICO DE SEGURIDAD</strong></td>
			    <td class='tg-031e back-green'><strong>N&deg; ".$obj_acta->getAttr('num_informe')."</strong></td>
			  </tr>
			</table><br>";


$codigo .="<table class='tg' width='100%' style='margin-bottom:-10px'>

  <tr>
    <th class='tg-e3zv aling-left back-green'>Empresa:</th>
    <th class='tg-031e aling-left' colspan='3'>".$obj_acta->Empresa->getAttr('nombre')."</th>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Actividad:</td>
    <td class='tg-031e' colspan='3'>".$obj_acta->getAttr('actividad')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Obra:</td>
    <td class='tg-031e' colspan='3'>".$obj_acta->getAttr('obra')."</td>
  </tr>
  <tr>
    <td style='width:10%' class='tg-e3zv back-green'>Lugar:</td>
    <td style='width:36%' class='tg-031e'>".$obj_acta->getAttr('lugar')."</td>
    <td style='width:26%' class='aling-left back-green'><strong>&Aacute;rea:</strong></td>
    <td style='width:28%' class='tg-031e'>".$obj_acta->TipoLugare->getAttr('descripcion')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Fecha:</td>
    <td class='tg-031e'>".date('d-m-Y   H:i',strtotime($obj_acta->getAttr('fecha')))."</td>
    <td class='aling-left back-green'><strong>Responsable:</strong></td>
    <td class='tg-031e'>".$obj_acta->Trabajadore1->getAttr('apellido_nombre')."</td>
  </tr>
  <tr>
    <td style='width:10%' class='tg-e3zv back-green'>Supervisi&oacute;n:</td>
    <td class='tg-031e'>".$tipo_supervision."</td>
    <td class='aling-left back-green'><strong>Emp. Superv. al Servicio de:</strong></td>
    <td class='tg-031e'>".$obj_acta->getAttr('empresa_supervisora')."</td>
  </tr>
</table><br>";
$codigo.= "
	<table class='tg' width='100%' style='margin-bottom:-10px'>
	<tr><td class='tg-e3zv back-blue' style='text-align:center'>SUPERVISI&Oacute;N DE SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
	<tr><td class='tg-e3zv back-green2' style='text-align:center'>CUMPLIMIENTO E INCUMPLIMIENTO AL RESESATE Y NORMAS DE SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
	</table><br>
		";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-green'>EQUIPOS DE PROTECCI&Oacute;N PERSONAL</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_epp'))."</td>
		  </tr>
		  <tr>
		   <td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoIpp as $key => $obj_foto_ipp) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
						<img src='".ENV_WEBROOT_FULL_URL."files/fotos_ipp/thumbnail/".$obj_foto_ipp->getAttr('file_name')."' width='200px' height='200px'>
								<br>".$obj_foto_ipp->getAttr('observacion')."</td>";
				if($cont == 2){
					$codigo.="</tr>";
					$cont = 0;
					$codigo.="<tr>";
				}
				$cont++;
			}
			
			
$codigo.= "	</tr>
			</table>
		</td>
		</tr>
		</table><br>";
$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-green'>SE&Ntilde;ALIZACI&Oacute;N Y DELIMITACI&Oacute;N</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_se_de'))."</td>
		  </tr>
		  <tr>
		    <td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoSd as $key => $obj_foto_sd) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
							<img src='".ENV_WEBROOT_FULL_URL."files/fotos_sd/thumbnail/".$obj_foto_sd->getAttr('file_name')."' width='200px' height='200px'>
							<br>".$obj_foto_sd->getAttr('observacion')."</td>";
			if($cont == 2){
					$codigo.="</tr>";
					$cont = 0;
					$codigo.="<tr>";
				}
				$cont++;
			}
$codigo.= "	</tr>
			</table>
		</td>
		</tr>
		</table><br>";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-green'>UNIDADES M&Oacute;VILES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_um'))."</td>
		  </tr>
		  <tr>
		  	<td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoUm as $key => $obj_foto_um) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
						  <img src='".ENV_WEBROOT_FULL_URL."files/fotos_um/thumbnail/".$obj_foto_um->getAttr('file_name')."' width='200px' height='200px'>
						  <br>".$obj_foto_um->getAttr('observacion')."</td>";
				if($cont == 2){
					$codigo.="</tr>";
					$cont = 0;
					$codigo.="<tr>";
				}
				$cont++;
			}
$codigo.= "	</tr>
			</table>
		 </td>
		</tr>
		</table><br>";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-green'>DOCUMENTACI&Oacute;N DE SEGURIDAD</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_doc'))."</td>
		  </tr>
		  <tr>
		  	<td>
		   	<table class='tg' width='100%'>
		    ";
$cont= 0;
$codigo.="<tr>";
foreach($obj_acta->FotoDoc as $key => $obj_foto_doc) {
	$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
						  <img src='".ENV_WEBROOT_FULL_URL."files/fotos_doc/thumbnail/".$obj_foto_doc->getAttr('file_name')."' width='200px' height='200px'>
						  <br>".$obj_foto_doc->getAttr('observacion')."</td>";
	if($cont == 2){
		$codigo.="</tr>";
		$cont = 0;
		$codigo.="<tr>";
	}
	$cont++;
}
$codigo.= "	</tr>
			</table>
		 </td>
		</tr>
		</table><br>";

$codigo.= "
		<table class='tg' width='100%'>
		  <!-- <tr>
			<th class='tg-e3zv back-green2'>
			INCUMPLIMIENTOS AL RESESATE Y NORMAS DE SEGURIDAD Y SALUD EN EL TRABAJO
			</th>
	      </tr>-->
		  <tr>
		    <th class='tg-e3zv back-green'>ACTOS SUBESTANDARES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>";
		    $info_des_act = json_decode($obj_acta->info_des_act);
		    foreach($info_des_act as $value){
		    	$codigo.= $value->info_des_act."<br>";
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
							<img src='".ENV_WEBROOT_FULL_URL."files/fotos_as/thumbnail/".$obj_foto_as->getAttr('file_name')."' width='200px' height='200px'>
							<br>".$obj_foto_as->getAttr('observacion')."</td>";
				if($cont == 2){
					$codigo.="</tr>";
					$cont = 0;
					$codigo.="<tr>";
				}
				$cont++;
			}
$codigo.= "	</tr>
			</table>
			</td>
		  </tr>
		</table><br>";

$codigo.= "<table class='tg' width='100%'>
		  <tr>
			<th class='tg-e3zv back-green'>CONDICIONES SUBESTANDARES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>";
		    $info_des_cond = json_decode($obj_acta->info_des_cond);
		    foreach($info_des_cond as $value){
		    	$codigo.= $value->info_des_cond."<br>";
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
							<img src='".ENV_WEBROOT_FULL_URL."files/fotos_cs/thumbnail/".$obj_foto_cs->getAttr('file_name')."' width='200px' height='200px'>
							<br>".$obj_foto_cs->getAttr('observacion')."</td>";
				if($cont == 2){
					$codigo.="</tr>";
					$cont = 0;
					$codigo.="<tr>";
				}
				$cont++;
			}
$codigo.= "	</tr>
			</table>
			</td>
		  </tr>
		</table><br>";

$codigo.="
		<table class='tg salto-linea' width='100%'>
		  <tr>
		    <th class='tg-hgcj back-blue' colspan='2'><strong>CONCLUSIONES, RECOMENDACIONES Y ACCIONES CORRECTIVAS</strong></th>
		  </tr>
		  <tr>
		    <td class='tg-e3zv back-green'>CONCLUSIONES</td>
		    <td class='tg-e3zv back-green'>RECOMENDACIONES</td>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_conclusion'))."</td>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_rec'))."</td>
		  </tr>
		</table>
		";
$codigo.="<br>";
$codigo.="
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-hgcj back-green'><strong>MEDIDAS DE CONTROL</strong></th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_med'))."</td>
		  </tr>
		  <tr>
		   	<td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoMed as $key => $obj_foto_med) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
							<img src='".ENV_WEBROOT_FULL_URL."files/fotos_med/thumbnail/".$obj_foto_med->getAttr('file_name')."' width='200px' height='200px'>
							<br>".$obj_foto_med->getAttr('observacion')."</td>";
				if($cont == 2){
					$codigo.="</tr>";
					$cont = 0;
					$codigo.="<tr>";
				}
				$cont++;
			}
$codigo.= "	</tr>
			</table>
			</td>
		  </tr>  		
		</table>
		<br>
		";

$codigo.= "<table class='tg salto-linea' width='100%'>
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

$codigo .= "<div style='text-align:left; padding-left: 25px; padding-right: 25px;'><strong>NIVEL DE CUMPLIMIENTO:</strong> ".$obj_acta->getAttr('cumplimiento')."%</div>";
$codigo .= "<p align='right'><table width='100%'>
			<tr><td><div style='text-align:right;'><img src='".ENV_WEBROOT_FULL_URL."files/firmas/".$obj_acta->Trabajadore2->getAttr('firma')."' style='border:0px;' width='180px' height='100px'> </div>";
$codigo .= "<div style='text-align:right;'><hr width='30%' align='right'></div>
		   	<div style='text-align:right; /*padding-left: 52px; padding-right: 52px;*/'>ING. ".$obj_acta->Trabajadore2->getAttr('apellido_nombre')."</div>
		   	<div style='text-align:right; padding-left: 25px; padding-right: 25px;'>SUPERVISOR DE SST - M&M</div></td></tr></table></p>";


//echo $codigo; exit();
$dompdf = new DOMPDF();
$dompdf->set_paper("A4");
$dompdf->load_html($codigo);
ini_set('memory_limit', '512M');
$dompdf->render();

$dompdf->stream("Informe ".$obj_acta->getAttr('num_informe').".pdf",array("Attachment"=>0));

exit();
?>