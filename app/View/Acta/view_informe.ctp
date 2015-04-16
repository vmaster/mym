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
.pie-pag {
   position:fixed;
		
.pie-pag {
   position:fixed;
   left:0px;
   bottom:0px;
   height:30px;
   width:100%;
   font: 50% sans-serif; 
}
</style>";
$codigo.= "<div class='pie-pag'><hr>";
$codigo.= "<div class='row'>
		   <div class='col-md-3 col-sm-6 col-xs-6'>Calle Las Piletas 255 - Urb. Federico Villarreal</div>";
$codigo.= "<div class='col-md-3 col-sm-6 col-xs-6' style='text-align: right;'>Telf. 074-271154 / RPM *716060 /978007000</div>
		  </div>";
$codigo.= "<div class='row'>
		   <div class='col-md-3 col-sm-6 col-xs-6'>Chiclayo - Chiclayo - Lambayeque</div>";
$codigo.= "<div class='col-md-3 col-sm-6 col-xs-6' style='text-align: right;'>Email: mym.ingenieria@hotmail.com</div>
		  </div>";
$codigo.= "</div>";
$codigo .="<table class='tg' width='100%'>
  <tr>
    <th class='tg-031e' rowspan='2'><img src='".ENV_WEBROOT_FULL_URL."img/logo-mini.png' style='width: 80px;'/></th>
    <th class='tg-031e' colspan='2' rowspan='2'>M&amp;M Ingeniería Obras y Serivcios E.I.R.L.<h6>Ejecuci&oacute;n y supervisi&oacute;n de obras el&eacute;ctricas, civiles, mineria e industrial.</h6><h6>Especialistas de gestión en Seguridad, salud en el trabajo, calidad y medio ambiente.</h6></th>
    <th class='tg-031e'><h5>SEGURIDAD Y SALUD EN EL TRABAJO</h5>INFORME T&Eacute;CNICO</th>
  </tr>
  <tr>
    <td style='text-align:center;'>N° ".$obj_acta->getAttr('num_informe')."</td>
  </tr>
  <tr>
    <th class='tg-e3zv'>Empresa:</th>
    <th class='tg-031e'>".$obj_acta->Empresa->getAttr('nombre')."</th>
    <th class='tg-e3zv'>Sector / Área:</th>
    <th class='tg-031e'>".$obj_acta->getAttr('sector')."</th>
  </tr>
  <tr>
    <td class='tg-e3zv'>Actividad:</td>
    <td class='tg-031e' colspan='3'>".$obj_acta->getAttr('actividad')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv'>Obra:</td>
    <td class='tg-031e' colspan='3'>".$obj_acta->getAttr('obra')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv'>Lugar:</td>
    <td class='tg-031e'>".$obj_acta->getAttr('lugar')."</td>
    <td class='tg-e3zv'>UU.NN:</td>
    <td class='tg-031e'>".$obj_acta->getAttr('uunn')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv'>Responsable:</td>
    <td class='tg-031e'>".$obj_acta->Trabajadore1->getAttr('apellido_nombre')."</td>
    <td class='tg-e3zv'>Supervisor M&amp;M:</td>
    <td class='tg-031e'>".$obj_acta->Trabajadore2->getAttr('apellido_nombre')."</td>
  </tr>
  <tr>
    <td class='tg-e3zv'>Supervisi&oacute;n:</td>
    <td class='tg-031e'>".$tipo_supervision."</td>
    <td class='tg-e3zv'>Fecha:</td>
    <td class='tg-031e'>".$obj_acta->getAttr('fecha')."</td>
  </tr>
</table>";
$codigo.= "
	<table class='tg' width='100%'>
	<tr><td class='tg-e3zv' style='text-align:center'>SUPERVISI&Oacute;N DE SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
	<tr><td class='tg-e3zv' style='text-align:center'>CUMPLIMIENTO AL RESESATE Y NORMAS DE SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
	</table>	
		";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv'>EQUIPOS DE PROTECCI&Oacute;N PERSONAL</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_epp'))."</td>
		  </tr>
		  <tr>
		    <td class='tg-031e' style='vertical-align:middle; text-align:center;'>";
			foreach($obj_acta->FotoIpp as $key => $obj_foto_ipp) {
				$codigo.= "<img src='".ENV_WEBROOT_FULL_URL."files/fotos_ipp/thumbnail/".$obj_foto_ipp->getAttr('file_name')."' width='200px' height='200px'>&nbsp;";
				if($key==3){
					$codigo.="<br>";
				}
			}
$codigo.= "</td>
		  </tr>
		</table><br>";
$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv'>SE&Ntilde;ALIZACI&Oacute;N Y DELIMITACI&Oacute;N</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_se_de'))."</td>
		  </tr>
		  <tr>
		    <td class='tg-031e' style='vertical-align:middle; text-align:center;'>";
			foreach($obj_acta->FotoSd as $key => $obj_foto_sd) {
				$codigo.= "<img src='".ENV_WEBROOT_FULL_URL."files/fotos_sd/thumbnail/".$obj_foto_sd->getAttr('file_name')."' width='200px' height='200px'>&nbsp;";
				if($key==3){
					$codigo.="<br>";
				}
			}
$codigo.= "</td>
		  </tr>
		</table><br>";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv'>UNIDADES M&Oacute;VILES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_um'))."</td>
		  </tr>
		  <tr>
		    <td class='tg-031e' style='vertical-align:middle; text-align:center;'>";
			foreach($obj_acta->FotoUm as $key => $obj_foto_um) {
				$codigo.= "<img src='".ENV_WEBROOT_FULL_URL."files/fotos_um/thumbnail/".$obj_foto_um->getAttr('file_name')."' width='200px' height='200px'>&nbsp;";
				if($key==3){
					$codigo.="<br>";
				}
			}
$codigo.= "</td>
		  </tr>
		</table><br>";
$codigo.= "
		<table class='tg' width='100%'>
		<tr>
		<th class='tg-e3zv'>
		INCUMPLIMIENTOS AL RESESATE Y NORMAS DE SEGURIDAD Y SALUD EN EL TRABAJO
		</th>
		</tr>
		</table>
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv'>ACTOS Y CONDICIONES SUBESTANDARES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_act_cond'))."</td>
		  </tr>
		  <tr>
		    <td class='tg-031e' style='vertical-align:middle; text-align:center;'>";
			foreach($obj_acta->FotoAc as $key => $obj_foto_ac) {
				$codigo.= "<img src='".ENV_WEBROOT_FULL_URL."files/fotos_ac/thumbnail/".$obj_foto_ac->getAttr('file_name')."' width='200px' height='200px'>&nbsp;";
				if($key==3){
					$codigo.="<br>";
				}
			}
$codigo.= "</td>
		  </tr>
		</table>";

$codigo.="
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-hgcj' colspan='2'><strong>CONCLUSIONES, RECOMENDACIONES Y ACCIONES CORRECTIVAS</strong></th>
		  </tr>
		  <tr>
		    <td class='tg-e3zv'>CONCLUSIONES</td>
		    <td class='tg-e3zv'>RECOMENDACIONES</td>
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
		    <th class='tg-hgcj'><strong>MEDIDAS DE CONTROL</strong></th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".nl2br($obj_acta->getAttr('info_des_med'))."</td>
		  </tr>
		</table>
		";

//echo $codigo; exit();
$dompdf = new DOMPDF();
$dompdf->set_paper("A4");
$dompdf->load_html($codigo);
ini_set('memory_limit', '512M');
$dompdf->render();

$dompdf->stream("ejemplo.pdf",array("Attachment"=>0));

exit();
?>