<?php
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 

if(isset($obj_acta)){
	$acta_id = $obj_acta->getAttr('id');
	//echo $my_content;
	$tipo_supervision = ($obj_acta->getAttr('tipo') == 'P')? 'Planeada':'Inopinada';
}
$codigo = "<style type='text/css'>
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-e3zv{font-weight:bold; text-align:center;}
.tg-uni {text-align:center;}
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
</style>";
$codigo.= "<div class='pie-pag'><hr>";
$codigo.= "<div class='row'>
		   <div class='col-md-3 col-sm-6 col-xs-6'>Av. Victor Ra&uacute;l Haya de la Torre 1512</div>";
$codigo.= "<div class='col-md-3 col-sm-6 col-xs-6' style='text-align: right;'>Telf. 074-271154 / RPM *716060 /978007000</div>
		  </div>";
$codigo.= "<div class='row'>
		   <div class='col-md-3 col-sm-6 col-xs-6'>La Victoria - Chiclayo - Lambayeque</div>";
$codigo.= "<div class='col-md-3 col-sm-6 col-xs-6' style='text-align: right;'>Email: mym.ingenieria@mym-iceperu.com</div>
		  </div>";
$codigo.= "</div>";

$codigo.= "<table class='tg' width='100%' style='margin-bottom:-15px'>
			  <tr>
			    <th class='tg-031e back-green' rowspan='3'><img src='".ENV_WEBROOT_FULL_URL."img/logo-mini.png' style='width: 80px; border:0px;'/></th>
			    <th class='tg-031e back-blue' rowspan='2'>M&amp;M Ingeniera Obras y Serivcios E.I.R.L.
			    <h6>Ejecuci&oacute;n y supervisi&oacute;n de obras el&eacute;ctricas, civiles, mineria e industrial.<br>Especialistas de gestión en Seguridad, salud en el trabajo, calidad y medio ambiente.</h6>		
			    </th>
			    <th class='aling-left back-green'><strong>UUNN:</strong> ".$obj_acta->UnidadesNegocio->getAttr('descripcion')."</th>
			  </tr>
			  <tr>
			    <td class='aling-left back-green'><strong>&Aacute;rea:</strong>".$obj_acta->getAttr('sector')."</td>
			  </tr>
			  <tr>
			    <td class='tg-uni back-blue'><strong>INFORME T&Eacute;CNICO DE SEGURIDAD</strong></td>
			    <td class='tg-031e back-green'>N&deg; ".$obj_acta->getAttr('num_informe')."</td>
			  </tr>
			</table><br>";


$codigo .="<table class='tg' width='100%' style='margin-bottom:-10px'>

  <tr>
    <th class='tg-e3zv back-green'>Empresa:</th>
    <th class='tg-031e aling-left' colspan='3'>".$obj_acta->Empresa->getAttr('nombre')."</th>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Actividad:</td>
    <td class='tg-031e' colspan='3'>".$obj_acta->getAttr('actividad')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Obra:</td>
    <td class='tg-031e'>".$obj_acta->getAttr('obra')."</td>
    <td class='aling-right back-green'><strong>Tipo de Lugar:</strong></td>
    <td class='tg-031e'>".$obj_acta->TipoLugare->getAttr('descripcion')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Lugar:</td>
    <td class='tg-031e'>".$obj_acta->getAttr('lugar')."</td>
    <td class='aling-right back-green'><strong>Fecha:</strong></td>
    <td class='tg-031e'>".$obj_acta->getAttr('fecha')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Responsable:</td>
    <td class='tg-031e'>".$obj_acta->Trabajadore1->getAttr('apellido_nombre')."</td>
    <td class='aling-right back-green'><strong>Supervisor M&amp;M:</strong></td>
    <td class='tg-031e'>".$obj_acta->Trabajadore2->getAttr('apellido_nombre')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv back-green'>Supervisi&oacute;n:</td>
    <td class='tg-031e'>".$tipo_supervision."</td>
    <td class='aling-right back-green'><strong>Empresa supervisada al servicio de:</strong></td>
    <td class='tg-031e'>".$obj_acta->getAttr('empresa_supervisora')."</td>
  </tr>
</table><br>";
$codigo.= "
	<table class='tg' width='100%' style='margin-bottom:-10px'>
	<tr><td class='tg-e3zv back-blue' style='text-align:center'>SUPERVISI&Oacute;N DE SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
	<tr><td class='tg-e3zv back-green2' style='text-align:center'>CUMPLIMIENTO AL RESESATE Y NORMAS DE SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
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
		<th class='tg-e3zv back-green2'>
		INCUMPLIMIENTOS AL RESESATE Y NORMAS DE SEGURIDAD Y SALUD EN EL TRABAJO
		</th>
		</tr>
		</table>
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv back-green'>ACTOS Y CONDICIONES SUBESTANDARES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_act_cond'))."</td>
		  </tr>
		  <tr>
		   	<td>
		   	<table class='tg' width='100%'>
		    ";
			$cont= 0;
			$codigo.="<tr>";
			foreach($obj_acta->FotoAc as $key => $obj_foto_ac) {
				$codigo.= "<td class='tg-031e' style='vertical-align:middle; text-align:center; border-style: none;'>
							<img src='".ENV_WEBROOT_FULL_URL."files/fotos_ac/thumbnail/".$obj_foto_ac->getAttr('file_name')."' width='200px' height='200px'>
							<br>".$obj_foto_ac->getAttr('observacion')."</td>";
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
		<table class='tg' width='100%'>
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

$codigo.="
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-hgcj back-green'><strong>MEDIDAS DE CONTROL</strong></th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_med'))."</td>
		  </tr>
		</table>
		<br>
		";

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
	foreach ($info_ni_t as $k => $v){
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
	
	foreach ($info_ni_v as $k2 => $v2){
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
	
	$codigo.= "</table>";
}


//echo $codigo; exit();
$dompdf = new DOMPDF();
$dompdf->set_paper("A4");
$dompdf->load_html($codigo);
ini_set('memory_limit', '512M');
$dompdf->render();

$dompdf->stream("ejemplo.pdf",array("Attachment"=>0));

exit();
?>