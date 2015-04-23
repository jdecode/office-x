<div class="container">
	
<?php echo $this->Form->create('User', array('action' => 'login','client'=>true,"class"=>"form-login")); ?>
	<?php echo $this->Session->flash();?>
	
		<h2 class="form-login-heading">sign in now</h2>
		<div class="login-wrap">
			<?php echo $this->Form->input('username', array('label' => '',"class"=>"form-control","placeholder"=>"Username","autofocus")); ?>
			
			
			<br>
			<?php echo $this->Form->input('password', array('label' => '',"class"=>"form-control","placeholder"=>"Password")); ?>
			
			<label class="checkbox">
				<span class="pull-right">
					&nbsp;

				</span>
			</label>
			<button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
			<hr>


		</div>


	<?php echo $this->Form->end();?>	

</div>
