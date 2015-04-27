<div class="col-lg-8">
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-angle-right"></i>Add Folder</h4>
		<?php
		echo $this->Form->create(
				'Folder', array(
			"class" => "form-horizontal style-form",
			"id" => "UploadAdminAddForm"
				)
		);
		?>
		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">Folder Name</label>
			<div class="col-sm-9">
				<?php echo $this->Form->input('name', array('label' => false, 'type' => 'text')); ?>
			</div>
		</div>



		<div class="row">
			<div class="col-sm-3">
				<?php
				echo $this->Html->link(
						'Back', array(
					"controller" => "folders",
					"action" => "view",
					'staff' => true
						), array(
					"class" => "btn btn-theme"
						)
				);
				?>
			</div>
			<div class="col-sm-3">
				<?php 
				echo $this->Form->input('submit', array("type" => "submit", "label" => false, "class" => "btn btn-theme"));
				?>
			</div>
		</div>


		<?php echo $this->Form->end(); ?>
	</div>
</div>

