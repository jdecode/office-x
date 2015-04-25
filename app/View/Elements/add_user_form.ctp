<?php
echo $this->Session->flash();
?>
<div class="col-lg-8">
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-angle-right"></i> Add <?php echo $_group_name; ?></h4>

		<?php echo $this->Form->create('User', array("class" => "form-horizontal style-form", "type" => 'post')); ?>
		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">User Name</label>
			<div class="col-sm-9">
				<?php echo $this->Form->input('username', array('label' => '', "class" => "form-control")); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">Password</label>
			<div class="col-sm-9">
				<?php echo $this->Form->input('password', array('label' => '', "class" => "form-control")); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<?php echo $this->Form->input('email', array('label' => '', "class" => "form-control")); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">Name</label>
			<div class="col-sm-9">
				<?php echo $this->Form->input('name', array('label' => '', "class" => "form-control")); ?>
			</div>
		</div>


		<?php
		if ($_group_name == 'Staff') {
			?>
			<div class="form-group">
				<label class="col-sm-3 col-sm-3 control-label">Department</label>
				<div class="col-sm-9">
					<?php
					echo $this->Form->input(
							'department_id', array(
						'label' => '',
						"class" => "form-control",
						"options" => $departments,
						"empty" => "Select"
							)
					);
					?>
				</div>
			</div>
			<?php
		}
		?>

		<div class="row">
			<div class="col-sm-3">
				<?php
				echo $this->Html->link(
						'Back', array(
					"controller" => "users",
					"action" => "staff",
					'admin' => true
						), array(
					"class" => "btn btn-theme"
						)
				);
				?>
			</div>
			<div class="col-sm-3"><?php echo $this->Form->input('submit', array("type" => "submit", "label" => false, "class" => "btn btn-theme")); ?></div>
		</div>

		<?php echo $this->Form->end(); ?>
	</div>
</div>