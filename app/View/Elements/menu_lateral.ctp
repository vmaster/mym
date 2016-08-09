<nav class="navbar-default navbar-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="main-menu">
			<li class="text-center"><img
				src="<?= ENV_WEBROOT_FULL_URL; ?>img/logo_mym2012602.jpg" width="140"
				class="user-image img-responsive" /></li>


			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'dashboards')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>dashboards" id="link-dashboard"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a></li>
			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'actas')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>actas" id="link-acta"><i class="fa fa-file-text fa-3x"></i> <?php echo ' '.__('Informes'); ?></a></li>
			<?php if($this->Session->read('Auth.User.tipo_user_id') != 3) { ?>		
				<li><a href="#"><i class="fa fa-sitemap fa-3x"></i> Mantenimiento <span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($this->request->params['controller'] == 'actividades' || $this->request->params['controller'] == 'users' || $this->request->params['controller'] == 'trabajadores' || $this->request->params['controller'] == 'empresas' || $this->request->params['controller'] == 'vehiculos' || $this->request->params['controller'] == 'tipo_vehiculos' || $this->request->params['controller'] == 'codigos' || $this->request->params['controller'] == 'unidades_negocios' || $this->request->params['controller'] == 'categoria_normas')?"collapse in":"collapse";  ?>">
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'actividades')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>actividades" id="link-actividad"><i class="fa fa-qrcode fa-3x"></i> <?php echo ' '.__('Cargos'); ?></a></li>
					<?php if($this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'users')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>users" id="link-usuario"><i class="fa fa-user fa-3x"></i>Usuarios</a></li>
					<?php }?>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'trabajadores')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>trabajadores" id="link-trabajador"><i class="fa fa-male fa-3x"></i> <?php echo ' '.__('Trabajadores'); ?></a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'empresas')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>empresas" id="link-empresa"><i class="fa fa-building-o fa-3x"></i> <?php echo ' '.__('Empresa'); ?> </a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'vehiculos')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>vehiculos" id="link-vehiculo"><i class="fa fa-truck fa-3x"></i><?php echo ' '.__('Unidad M&oacute;vil'); ?> </a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'tipo_vehiculos')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>tipo_vehiculos" id="link-vehiculo"><i class="fa fa-truck fa-3x"></i><?php echo ' '.__('Tipo Vehiculo'); ?> </a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'categoria_normas')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>categoria_normas" id="link-categoria-codigo"><i class="fa fa-gavel fa-3x"></i> <?php echo ' '.__('Categor&iacute;a Normas'); ?> </a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'codigos')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>codigos" id="link-codigo"><i class="fa fa-gavel fa-3x"></i> <?php echo ' '.__('Normas'); ?> </a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'unidades_negocios')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>unidades_negocios" id="link-uunn"><i class="fa fa-suitcase fa-3x"></i> <?php echo ' '.__('UUNN'); ?> </a></li>
					</ul>
				</li>
			<?php } ?>
			<li><a href="#"><i class="fa fa-signal fa-3x"></i> Reportes <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level <?php echo ($this->request->params['controller'] == 'reportes')?"collapse in":"collapse";  ?>">
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'reportes' && $this->request->params['action']=='rpt_cant_info_empresas')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/rpt_cant_info_empresas" id="link-rpt_cant_empresas"><i class="fa fa-qrcode fa-3x"></i> <?php echo ' '.__('Informes por empresa'); ?></a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'reportes' && $this->request->params['action']=='rpt_cant_info_uunn')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/rpt_cant_info_uunn" id="link-rpt_cant_uunn"><i class="fa fa-qrcode fa-3x"></i> <?php echo ' '.__('Informes por UUNN'); ?></a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'reportes' && $this->request->params['action']=='rpt_cant_ni_trabajador')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/rpt_cant_ni_trabajador" id="link-usuario"><i class="fa fa-user fa-3x"></i><?php echo ' '.__('NI. por Trabajador'); ?></a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'reportes' && $this->request->params['action']=='rpt_cant_ni_vehiculo')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/rpt_cant_ni_vehiculo" id="link-usuario"><i class="fa fa-user fa-3x"></i><?php echo ' '.__('NI. por Unidad M&oacute;vil'); ?></a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'reportes' && $this->request->params['action']=='rpt_reincidencia_ni_empresa')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/rpt_reincidencia_ni_empresa" id="link-usuario"><i class="fa fa-user fa-3x"></i><?php echo ' '.__('Reincidencias por Empresa'); ?></a></li>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'reportes' && $this->request->params['action']=='rpt_cumplimiento_empresas')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/rpt_cumplimiento_empresas" id="link-usuario"><i class="fa fa-user fa-3x"></i><?php echo ' '.__('Cumplimiento por Empresa (%)'); ?></a></li>
					<?php if($this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'emails_enviado' && $this->request->params['action']=='index')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>emails_enviados/index" id="link-usuario"><i class="fa fa-user fa-3x"></i><?php echo ' '.__('Emails enviados'); ?></a></li>
					<?php } if($this->Session->read('Auth.User.tipo_user_id') != 3) { ?>	
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'reportes' && $this->request->params['action']=='descargo_excel')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/rpt_descargo_excel" id="link-usuario"><i class="fa fa-user fa-3x"></i><?php echo ' '.__('Descargo en Excel'); ?></a></li>
					<?php } if($this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
					<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'reportes' && $this->request->params['action']=='rpt_cumplimiento_area_emp')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/rpt_cumplimiento_area_emp" id="link-usuario"><i class="fa fa-user fa-3x"></i>Cumplimiento por &Aacute;rea y Empresa (%)</a></li>
					<?php } ?>
				</ul>
			</li>
			<?php if($this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
				<li><a href="#"><i class="fa fa-cog fa-3x"></i> Configuraci&oacute;n <span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($this->request->params['controller'] == 'configurations')?"collapse in":"collapse";  ?>">
						<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'configurations' && $this->request->params['action']=='backup_database')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>configurations/backup_database" id="link-actividad"><i class="fa fa-floppy-o fa-3x"></i> <?php echo ' '.__('Backup de Base de Datos'); ?></a></li>
					</ul>
				</li>
			<?php } ?>
			<!-- 
			<li><a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level
					Dropdown<span class="fa arrow"></span>
			</a>
				<ul class="nav nav-second-level">
					<li><a href="#">Second Level Link</a></li>
					<li><a href="#">Second Level Link</a></li>
					<li><a href="#">Second Level Link<span class="fa arrow"></span>
					</a>
						<ul class="nav nav-third-level">
							<li><a href="#">Third Level Link</a></li>
							<li><a href="#">Third Level Link</a></li>
							<li><a href="#">Third Level Link</a></li>

						</ul></li>
				</ul></li>
			<li><a href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank
					Page</a></li>-->
		</ul> 

	</div>

</nav>