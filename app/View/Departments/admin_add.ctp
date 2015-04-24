<div class="col-lg-8">
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-angle-right"></i> Add</h4>
			<?php echo $this->Form->create('Department', array("class" => "form-horizontal style-form")); ?>
			<div class="form-group">
				<label class="col-sm-3 col-sm-3 control-label">Name</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('name', array('label' => '', "class" => "form-control")); ?>
				</div>
			</div>

			<?php echo $this->Form->input('submit', array("type" => "submit", "label" => false, "class" => "btn btn-theme")); ?>


			<?php echo $this->Form->end(); ?>
	</div>
</div>