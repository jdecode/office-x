<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
?>
<fieldset style="border: solid 1px #000; width:500px; margin-left: 250px; margin-top: 100px;"><legend>Change Password</legend>
	<div class="users form">
		<?php echo $this->Form->create('User', array('action' => 'changepassword')); ?>
		<?php echo $this->Form->input("User.old_password", array('type' => 'password')); ?>
		<?php echo $this->Form->input("User.new_password", array('type' => 'password')); ?>
		<?php echo $this->Form->input("User.conf_password", array('type' => 'password')); ?>
		<?php echo $this->Form->end(__("Change Password")); ?>
	</div>
</fieldset>
<?php */?>

<div class="col-lg-8">
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-angle-right"></i>Change Password</h4>
		
			<?php echo $this->Form->create('User', array("class" => "form-horizontal style-form","type"=>'post')); ?>
				<?php echo $this->Form->input('User.group_id', array('type' => 'hidden', array('label' => ''), 'value' => '2')); ?>
			<div class="form-group">
				<label class="col-sm-3 col-sm-3 control-label">Old password</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('User.old_password', array('type' => 'password','label' => '', "class" => "form-control")); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 col-sm-3 control-label">New Password</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('User.new_password', array('type' => 'password','label' => '', "class" => "form-control")); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 col-sm-3 control-label">Confirm</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('User.conf_password', array('type' => 'password','label' => '', "class" => "form-control")); ?>
				</div>
			</div>

			<?php echo $this->Form->input('Change password', array("type" => "submit", "label" => false, "class" => "btn btn-theme")); ?>

			<?php echo $this->Form->end(); ?>
	</div>
</div>