<script>
    $(document).ready(function () {
        $("#UserUserType").change(function () {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/admin/users/userlist',
                data: 'g_id=' + $('#UserUserType').val(),
                success: function (response) {
                    $('#response').html(response);
                }
            });
        });
    });
</script>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="col-lg-8">
	<div class="form-panel">
		<h4 class="mb"><i class="fa fa-angle-right"></i> Password reset</h4>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Form->create('User', array("class" => "form-horizontal style-form")); ?>
		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">User Type</label>
			<div class="col-sm-9">
				<?php echo $this->Form->input("User.user_type", array('type' => 'select', 'options' => array('' => '--select--', '2' => 'Staff', '3' => 'Client'), "label" => false)); ?>
			</div>
		</div>
		<div class="form-group">
			<div id="response"></div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 col-sm-3 control-label">Password</label>
			<div class="col-sm-9">
				<?php echo $this->Form->input("User.password", array('type' => 'password', "label" => false)); ?>
			</div>
		</div>


		<?php
		$options = array('label' => 'Reset password', 'class' => 'btn btn-success', 'div' => false);
		echo $this->Form->end($options);
		?>
	</div>

</div>
</div>