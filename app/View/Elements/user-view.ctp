<?php
$_users = array(2 => 'Staff', 3 => 'Client');

echo $this->Session->flash();
?>
<div class="content-panel">
	<table class="table">
		<tbody>
			<tr>
				<th><?php echo 'Type: '; ?></th>
				<td><?php echo $_users[$user['User']['group_id']]; ?></td>
			</tr>
			<tr>
				<th><?php echo __('Username: '); ?></th>
				<td><?php echo h($user['User']['username']); ?></td>
			</tr>
			<tr>
				<th><?php echo __('Name: '); ?></th>
				<td><?php echo h($user['User']['name']); ?></td>
			</tr>
			<tr>
				<th><?php echo 'Email: '; ?></th>
				<td><?php echo $user['User']['email']; ?></td>
			</tr>
			<?php
			if ($user['User']['group_id'] <= 2) {
				?>
				<tr>
					<th><?php echo __('Department: '); ?></th>
					<td><?php echo $user['Department']['name']; ?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<th><?php echo 'Added: '; ?></th>
				<td><?php echo ($user['User']['created']); ?></td>
			</tr>
		</tbody>
	</table>
	<?php
		echo $this->Form->create('User', array("class" => "form-horizontal style-form", "type" => 'post'));
	?>
	<table class="table reset_password_form hide">
		<tr>
			<th><?php echo 'Reset Password '; ?></th>
			<td>
				<?php 
				echo $this->Form->input(
						'reset_password', 
						array(
							'value' => '',
							'placeholder' => 'Enter New Password',
							'div' => false,
							'label' => false,
						)
					);
				?>
			</td>
		</tr>
	</table>
	<?php
		echo $this->Form->end();
	?>
	<div class="row">
		<div class="col-sm-3">
			<?php
			echo $this->Html->link(
					'Back', array(
				"controller" => "users",
				"action" => ($user['User']['group_id'] == 2 ? 'staff' : 'clients'),
				'admin' => true
					), array(
				"class" => "btn btn-info"
					)
			);
			?>
		</div>
		<div class="col-sm-4">
			<div class="btn btn-info reset_password pull-left">Reset Password</div>
			<div class="btn btn-success reset_password_submit pull-left hide">Save Password</div>
			<div class="btn btn-danger reset_password_cancel pull-right hide">Cancel</div>
		</div>
		<div class="col-sm-3">
			<a 
				class="btn btn-info reset_password pull-left"
				target="_blank"
				href="<?php echo $this->webroot.'admin/users/loginas/'.$user['User']['id'] ?>">Login on front end</a>
		</div>
	</div>
</div>


<script>
	$(document).ready( function() {
		$('.reset_password').click( function () {
			$('.reset_password_form').toggleClass('hide');
			$('.reset_password').toggleClass('hide');
			$('.reset_password_submit').toggleClass('hide');
			$('.reset_password_cancel').toggleClass('hide');
		});
		$('.reset_password_submit').click( function () {
			$('#UserAdminViewForm').submit();
		});
		$('.reset_password_cancel').click( function () {
			$('.reset_password_form').toggleClass('hide');
			$('.reset_password').toggleClass('hide');
			$('.reset_password_submit').toggleClass('hide');
			$('.reset_password_cancel').toggleClass('hide');
		});
	});
</script>