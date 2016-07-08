<?php echo $this->Html->css(captcha_layout_stylesheet_url(), array('inline' => false)); ?>
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
					<center style="margin-bottom: -15px;">
						<?php
							if ($this->Session->check('Message.authe')) {
								$this->Session->flash();
							}
							echo "<font color='red'>".$this->Session->flash('authe')."</font><p>";
						?>
					</center>

					<?php if($show_captcha == 1){ ?>
					<center style="padding-bottom: 10px;">
						<?php 
						echo "<div style='padding-bottom: 15px;'>";
						// display Captcha markup, wrapped in an extra div for layout purposes
						echo $this->Html->div('captcha', captcha_image_html(), false);

						// Captcha code user input textbox
						echo $this->Form->input('CaptchaCode');
						echo "</div>";


						echo "<font color='gray'>".$this->Session->flash('captcha')."</font>";
						if ($this->Session->check('Message.captcha')) {
							$this->Session->flash('captcha');
						}
					?>

					</center>
					<?php } ?>
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
<style>
.captcha{padding-bottom: 10px;}
#ExampleCaptcha_CaptchaIconsDiv{width: 28px !important;height: 50px !important;float: left; padding-left: 3px;}
#ExampleCaptcha_CaptchaImageDiv{width: 250px !important;height: 50px !important;float: left;}
</style>