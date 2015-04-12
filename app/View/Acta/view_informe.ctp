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
.tg .tg-e3zv{font-weight:bold}
.tg-uni {text-align:center;}
</style>";
$codigo .= "
 <table class='tg' width='100%'>
  <tr>
    <th class='tg-031e' rowspan='2'><img src='".ENV_WEBROOT_FULL_URL."img/logo.png' style='width: 300%;'/></th>
    <th class='tg-031e' rowspan='2'>M&amp;M Ingeniería Ibras y Serivcios E.I.R.L.<h6>Ejecución y supervisión de obras eléctricas, civiles, mineria e industrial.</h6><h6>Especialistas de gestión en Seguridad, salud en el trabajo, calidad y medio ambiente.</h6></th>
    <th class='tg-031e'><h5>SEGURIDAD Y SALUD EN EL TRABAJO</h5>INFORME TÉCNICO</th>
  </tr>
  <tr>
    <td style='text-align:center;'>N° ".$obj_acta->getAttr('num_informe')."</td>
  </tr>
</table>";
$codigo .="<table class='tg' width='100%'>
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
    <td class='tg-e3zv'>Supervisión:</td>
    <td class='tg-031e'>".$tipo_supervision."</td>
    <td class='tg-031e'>Fecha:</td>
    <td class='tg-031e'>".$obj_acta->getAttr('fecha')."</td>
  </tr>
</table>";
$codigo.= "
	<table class='tg' width='100%'>
	<tr><td class='tg-uni'>SUPERVISIÓN DE SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
	<tr><td class='tg-uni'>CUMPLIMIENTO AL RESESATE Y NORMAS DE SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
	</table>	
		";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv'>EQUIPOS DE PROTECCIÓN PERSONAL</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_epp')."</td>
		  </tr>
		  <tr>
		    <td class='tg-031e'>FOTOS IPP</td>
		  </tr>
		</table><br>
		";
$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv'>SEÑALIZACIÓN Y DELIMITACIÓN</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_se_de')."</td>
		  </tr>
		  <tr>
		    <td class='tg-031e'>FOTOS SEÑALIZACION</td>
		  </tr>
		</table>
		";

$codigo.= "
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv'>UNIDADES MÓVILES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_um')."</td>
		  </tr>
		  <tr>
		    <td class='tg-031e'>FOTOS UM</td>
		  </tr>
		</table><br>
		";
$codigo.= "
		<table class='tg' width='100%'>
		<tr>
		<th>
		INCUMPLIMIENTOS AL RESESATE Y NORMAS DE SEGURIDAD Y SALUD EN EL TRABAJO
		</th>
		</tr>
		</table>
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-e3zv'>ACTOS Y CONDICIONES SUBESTANDARES</th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_act_cond')."</td>
		  </tr>
		  <tr>
		    <td class='tg-031e'>FOTOS ACTOS Y CONDI SUB</td>
		  </tr>
		</table>
		";

$codigo.="
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-hgcj' colspan='2'><strong>CONCLUSIONES, RECOMENDACIONES Y ACCIONES CORRECTIVAS</strong></th>
		  </tr>
		  <tr>
		    <td class='tg-hgcj'>CONCLUSIONES</td>
		    <td class='tg-hgcj'>RECOMENDACIONES</td>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_conclusion')."</td>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_rec')."</td>
		  </tr>
		</table>
		";

$codigo.="
		<table class='tg' width='100%'>
		  <tr>
		    <th class='tg-hgcj'><strong>MEDIDAS DE CONTROL</strong></th>
		  </tr>
		  <tr>
		    <td class='tg-031e'>".$obj_acta->getAttr('info_des_med')."</td>
		  </tr>
		</table>
		";


$codigo=utf8_encode($codigo);
$dompdf = new DOMPDF();
$dompdf->set_paper("A4");
$dompdf->load_html($codigo);
ini_set('memory_limit', '512M');
$dompdf->render();

$dompdf->stream("ejemplo.pdf",array("Attachment"=>0));

exit();
?>