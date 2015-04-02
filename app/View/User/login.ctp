<div class="row text-center ">
	<div class="col-md-12">
		<br> <br>
		<h2>M & M Ingenieros : <?php echo utf8_encode(__('Iniciar Sesión')); ?></h2>

		<h5>( Ingrese sus datos de usuario para ingresar )</h5>
		<br>
	</div>
</div>
<div class="row ">

	<div
		class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong> Login </strong>
			</div>
			<div class="panel-body">
				<?php echo $this->Form->create('User',array('action' => 'login','type' => 'post'));?>
					<br>
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-tag"></i> </span>
							<?php echo $this->Form->input('username', array('label' =>false, 'class' => 'form-control', 'placeholder'=>__('Nombre de Usuario '))); ?>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i> </span>
							<?php echo $this->Form->input('password',array('label' =>false, 'type' => 'password', 'class' => 'form-control', 'placeholder'=>__(utf8_encode('Constraseña ')))); ?>
					</div>
					<!--  <div class="form-group">
						<label class="checkbox-inline"> <input type="checkbox"> Remember
							me
						</label> <span class="pull-right"> <a href="#">Forget password ? </a>
						</span>
					</div>
					-->
					<hr>
					<!-- Not register ? <a href="registeration.html">click here </a> -->
					<center>
					<button type="submit" class="btn btn-primary">
						<?php echo __('Ingresar'); ?>
					</button>
					</center>
				</form>
			</div>

		</div>
	</div>


</div>
