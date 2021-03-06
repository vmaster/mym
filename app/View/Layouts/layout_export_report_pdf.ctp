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
			<br>
			</div>";
			$codigo.= "
			<table class='tg tg-031eF' width='100%' style='margin-bottom:-10px'>
			<tr>
			    <td style='text-align:center' class='tg-031e'><strong>Fecha Inicio:</strong> ".$fec_inicio."</td>
			    <td style='text-align:center' class='aling-left'><strong>Fecha Fin:</strong> ".$fec_fin."</td>   
			 </tr>
			</table>
			";


			$porc_epp = ($sum_nc_epp+$sum_ni_epp>0)?round(($sum_nc_epp*100)/($sum_nc_epp+$sum_ni_epp)):0;
			$porc_sd = ($sum_nc_sd+$sum_ni_sd>0)?round(($sum_nc_sd*100)/($sum_nc_sd+$sum_ni_sd)):0;
			$porc_um = ($sum_nc_um+$sum_ni_um>0)?round(($sum_nc_um*100)/($sum_nc_um+$sum_ni_um)):0;
			$porc_doc = ($sum_nc_doc+$sum_ni_doc>0)?round(($sum_nc_doc*100)/($sum_nc_doc+$sum_ni_doc)):0;
			$porc_cp = ($sum_nc_cp+$sum_ni_cp>0)?round(($sum_nc_cp*100)/($sum_nc_cp+$sum_ni_cp)):0;
			$porc_ac = ($sum_nc_ac+$sum_ni_ac>0)?round(($sum_nc_ac*100)/($sum_nc_ac+$sum_ni_ac)):0;

			$codigo.= "<br><table class='tg tg-031eF' width='40%' style='margin-bottom:-10px'><tr><td class='back-gray'><strong>EMPRESAS:</strong></td><td>";
			foreach ($nombre_empresas as $key => $empresa) {
				$codigo.= $empresa. " / ";
			}

			$codigo .= "</td></tr>";
			$codigo .= "<tr><td class='back-gray'><strong>UNIDADES DE NEGOCIO:</strong></td><td>";
			foreach ($nombre_uunns as $key => $uunn) {
				$codigo.= $uunn. " / ";
			}
			$codigo .= "</td></tr></table><br>";

			$codigo.= "<table class='tg tg-031eF ' width='100%'>";
			$codigo.= "<tr class='back-blue'><th colspan='8' style='text-align: center;'><strong>CUADRO RESUMEN DE NIVEL DE CUMPLIMIENTO A NORMAS DE SEGURIDAD</strong></th></tr>";
			$codigo.= "<tr><td></td><td>EPP</td><td>SE</td><td>UM</td><td>DOC</td><td>CP</td><td>AC</td><td>TOTAL</td></tr>";
			$codigo.= "<tr><td><strong>TOTAL CUMPLIMIENTO (NC):</strong> </td><td>". $sum_nc_epp ."</td><td>" . $sum_nc_sd . "</td><td>" .$sum_nc_um. "</td><td>".$sum_nc_doc."</td><td>".$sum_nc_cp."</td><td>".$sum_nc_ac."</td><td>".$sum_normas_cumplidas."</td></tr>";
			$codigo.="<tr><td><strong>TOTAL INCUMPLIMIENTO (NI):</strong> </td><td>".$sum_ni_epp."</td><td>".$sum_ni_sd."</td><td>".$sum_ni_um."</td><td>".$sum_ni_doc."</td><td>".$sum_ni_cp."</td><td>".$sum_ni_ac."</td><td>".$sum_normas_incumplidas."</td></tr>";
			$codigo.="<tr><td><strong>NIVEL DE CUMPLIMIENTO:</strong> </td><td>".$porc_epp."%</td><td>".$porc_sd."%</td><td>".$porc_um."%</td><td>".$porc_doc."%</td><td>".$porc_cp."%</td><td>".$porc_ac."%</td><td>";
			
			$porc_total = ($suma_total_normas>0)? round(($sum_normas_cumplidas * 100)/$suma_total_normas):0;
			$codigo.= $porc_total."%</td></tr></table><br>";

			$codigo.= "<center><img src= '". ENV_WEBROOT_FULL_URL."files/pdf_informes/".$filename."' style='width: 1000px; heigh: 800px; border:0px;'/></center>";


			if(empty($list_total_ni_nc)){
				$codigo.= "No hay datos estad&iacute;sticos";
					}else{
				$codigo.= "<table class='tg tg-031eF ' width='100%'>";
				$codigo.= "<tr class='back-blue'>";
				$codigo.= "<th><strong>".utf8_encode('Nombre de Empresa')."</strong></th>";
				$codigo.= "<th><strong>".utf8_encode('Nro Informe')."</strong></th>";
				$codigo.= "<th><strong>".utf8_encode('Fecha')."</strong></th>";
				$codigo.= "<th><strong>".utf8_encode('Cumplimiento(%)')."</strong></th>";
				$codigo.= "</tr>";
					foreach ($list_total_ni_nc as $arr_informe):
				$codigo.= "<tr class='report_row_container'>";
				$codigo.= "<td>".$arr_informe->Empresa->getAttr('nombre')."</td>";
				$codigo.="<td>".$arr_informe->getAttr('num_informe')."</td>";
				$codigo.="<td>".date('Y-m-d H:i',strtotime($arr_informe->getAttr('fecha')))."</td>";
				$codigo.= "<td>".$arr_informe->getAttr('cumplimiento')."</td>";
				$codigo.= "</tr>";
						endforeach;
				$codigo.= "</table>";
			}
		
//echo $codigo; exit();
$dompdf = new DOMPDF();
$dompdf->set_paper("A4");
$dompdf->load_html($codigo);
ini_set('memory_limit', '512M');
$dompdf->render();

$dompdf->stream("Reporte NC y NI.pdf",array("Attachment"=>0));

exit();
?>