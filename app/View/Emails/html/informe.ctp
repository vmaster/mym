<p>
<?php //echo utf8_encode('Hola, estamos enviando el informe <strong>N°'.$num_informe. '</strong>'; ?>
<?php echo $mensaje; ?><p>
<?php echo utf8_encode('Para poder verlo hacer click en el siguiente enlace'); ?>: <a href="<?= ENV_WEBROOT_FULL_URL; ?>actas/view_informe/<?php echo $acta_id;?>" target="_blank"><?php echo utf8_encode('Informe N° '.$num_informe); ?></a>
</p>