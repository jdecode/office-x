<?php
echo $this->Session->flash();
?>
<div class="col-lg-10">
	<?php echo $this->Form->create('Message', array("class" => "form-horizontal style-form", 'id' => "UploadAdminAddForm", "type" => "file")); ?>
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-angle-right"></i>Compose</h4>
		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">Select User Type</label>
			<div class="col-sm-9">
				<button type="button" id="_staff" class="btn btn-success">Staff</button>
				&nbsp;
				&nbsp;
				<button type="button" id="_client" class="btn btn-danger">Client</button>
				&nbsp;
				&nbsp;
				<button type="button" id="_draft" class="btn btn-danger">Save as Draft</button>
			</div>
		</div>

		<div class="form-group user-group" id="_staff_users">
			<label class="col-sm-3 col-sm-3 control-label">Select Staff</label>
			<div class="col-sm-9">
				<?php
				echo $this->Form->input(
						'_staff_users', array(
					'label' => '',
					'type' => 'select',
					'options' => $_staff_users
						)
				);
				?>
			</div>
		</div>

		<div class="form-group hide user-group" id="_client_users">
			<label class="col-sm-3 col-sm-3 control-label">Select Client</label>
			<div class="col-sm-9">
				<?php
				echo $this->Form->input(
						'_client_users', array(
					'label' => '',
					'type' => 'select',
					'options' => $_client_users
						)
				);
				?>
			</div>
		</div>

		<div class="form-group folder-group" id="_staff_folders">
			<label class="col-sm-3 col-sm-3 control-label">Select Folder</label>
			<div class="col-sm-9">
				<?php
				echo $this->Form->input(
						'_staff_folders', array(
					'label' => '',
					'type' => 'select',
					'options' => $_staff_folders
						)
				);
				?>
			</div>
		</div>

		<div class="form-group hide folder-group" id="_client_folders">
			<label class="col-sm-3 col-sm-3 control-label">Select Folder</label>
			<div class="col-sm-9">
				<?php
				echo $this->Form->input(
						'_client_folders', array(
					'label' => '',
					'type' => 'select',
					'options' => $_client_folders
						)
				);
				?>
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">File</label>
			<div class="col-sm-9">
				<div class="row _documents">
					<div class="col-sm-12 document_set">
						<div class="row _document">
							<div class="col-sm-3">
								<span>
									<?php
									echo $this->Form->input(
											'_name', array(
										'label' => false,
										'type' => 'text',
										'placeholder' => 'Enter File Name',
										'name' => '_name[]',
											)
									);
									?>
								</span>
							</div>
							<div class="col-sm-3">
								<span>
									<?php
									echo $this->Form->input(
											'filename', array(
										'label' => false,
										'type' => 'file',
										'name' => 'file_name[]',
											)
									);
									?>
								</span>
							</div>
							<div class="col-sm-3">
								<span>
									<button 
										type="button"
										class="remove_me btn btn-danger btn-sm fa fa-minus alerts-color pull-right hide"></button>
								</span>
							</div>
						</div>
					</div>
                </div>
				<button 
					type="button" 
					id="add_more"
					class=" btn btn-sm btn-primary fa fa-plus margin-top-8 pull-right">
					Add
				</button>

			</div>

		</div>
		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">Description</label>
			<div class="col-sm-9">
				<?php echo $this->Form->input('description', array('label' => '', 'type' => 'textarea')); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3"><?php echo $this->Html->link('Back', array("controller" => "uploads", "action" => "index"), array("class" => "btn btn-theme")); ?></div>
			<div class="col-sm-3"><?php echo $this->Form->input('submit', array("type" => "submit", "label" => false, "class" => "btn btn-theme")); ?></div>
		</div>
	</div>

	<?php echo $this->Form->input('_core_type', array('type' => 'hidden', 'id' => '_core_type', 'value' => '2')); ?>

	<?php echo $this->Form->end(); ?>
</div>

<script>
	$(document).ready(function() {
		$('#_staff').click(function() {

			$('#_core_type').val('2');

			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
			$('#_client').addClass('btn-danger');
			$('#_draft').addClass('btn-danger');

			$('.user-group').addClass('hide');
			$('#_staff_users').removeClass('hide');

			$('.folder-group').addClass('hide');
			$('#_staff_folders').removeClass('hide');

		});
		$('#_client').click(function() {

			$('#_core_type').val('3');

			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
			$('#_staff').addClass('btn-danger');
			$('#_draft').addClass('btn-danger');

			$('.user-group').addClass('hide');
			$('#_client_users').removeClass('hide');

			$('.folder-group').addClass('hide');
			$('#_client_folders').removeClass('hide');
		});
		$('#_draft').click(function() {

			$('#_core_type').val('1');

			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
			$('#_staff').addClass('btn-danger');
			$('#_client').addClass('btn-danger');

			$('.user-group').addClass('hide');
			//$('#_client_users').removeClass('hide');

			$('.folder-group').addClass('hide');
			//$('#_client_folders').removeClass('hide');
		});

		$('#add_more').click(function() {
			//alert($('.document_set ._document').length);
			_last = $('.document_set ._document').last();
			//alert(_last.html());
			_data = '<div class="row _document">' + _last.html() + '</div>';
			$('.document_set').append(_data);
			$('.remove_me').removeClass('hide');
			$('.remove_me').first().addClass('hide');
		});

		$(document).on("click", ".remove_me", function(){
			$(this).parent().parent().parent().remove();
		});
	});
</script>
