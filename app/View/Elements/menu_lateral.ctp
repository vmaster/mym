<nav class="navbar-default navbar-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="main-menu">
			<li class="text-center"><img
				src="<?= ENV_WEBROOT_FULL_URL; ?>lib/theme/img/find_user.png"
				class="user-image img-responsive" /></li>


			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'index')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>index" id="link-dashboard"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a></li>
			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'actas')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>actas" id="link-acta"><i class="fa fa-desktop fa-3x"></i> <?php echo ' '.__('Actas'); ?></a>
			</li>
			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'actividades')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>actividades" id="link-actividad"><i class="fa fa-qrcode fa-3x"></i> <?php echo ' '.__('Actividades'); ?></a></li>
			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'users')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>users" id="link-usuario"><i class="fa fa-user fa-3x"></i>Usuarios</a></li>
			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'trabajadores')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>trabajadores" id="link-trabajador"><i class="fa fa-male fa-3x"></i> <?php echo ' '.__('Trabajadores'); ?></a></li>
			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'empresas')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>empresas" id="link-empresa"><i class="fa fa-building-o fa-3x"></i> <?php echo ' '.__('Empresa'); ?> </a></li>
			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'vehiculos')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>vehiculos" id="link-vehiculo"><i class="fa fa-truck fa-3x"></i><?php echo ' '.__('Veh&iacute;culo'); ?> </a></li>
			<li><a class="enlaces <?php echo ($this->request->params['controller'] == 'tipo_vehiculos')?"active-menu":""; ?>" href="<?= ENV_WEBROOT_FULL_URL; ?>tipo_vehiculos" id="link-vehiculo"><i class="fa fa-truck fa-3x"></i><?php echo ' '.__('Tipo Vehiculo'); ?> </a></li>

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
					Page</a></li>
		</ul> -->

	</div>

</nav>