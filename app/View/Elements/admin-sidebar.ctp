<?php
if ($this->params['controller'] == 'clients') {
	$client_class = 'active';
} else {
	$client_class = '';
}

if ($this->params['controller'] == 'staffs') {
	$staffs_class = 'active';
} else {
	$staffs_class = '';
}

if ($this->params['controller'] == 'uploads') {
	$uploads_class = 'active';
} else {
	$uploads_class = '';
}

if ($this->params['controller'] == 'departments') {
	$departments_class = 'active';
} else {
	$departments_class = '';
}

if (strtolower($this->params['controller']) == 'managefolders') {
	$manage_folder = 'active';
} else {
	$manage_folder = '';
}

if ($this->params['controller'] == 'users' && $this->params['action'] == 'admin_reset_password') {
	$rep_class = 'active';
} else {
	$rep_class = '';
}
?>

<?php //echo $_Inbox; ?>

<ul class="sidebar-menu" id="nav-accordion">
	<li class="sub-menu">
		<a href="javascript:;" class="<?php echo $staffs_class; ?>" >
			<i class="fa fa-desktop"></i>
			<span>Staff</span>
		</a>
		<ul class="sub">
			<li><?php echo $this->Html->link(__('List Staffs'), array('controller' => 'staffs', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Staff'), array('controller' => 'staffs', 'action' => 'add')); ?> </li>
		</ul>
	</li>
	<li class="sub-menu">
		<a href="javascript:;"  class="<?php echo $client_class; ?>">
			<i class="fa fa-desktop"></i>
			<span>Clients</span>
		</a>
		<ul class="sub">
			<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		</ul>
	</li>
	<li class="sub-menu">
		<a href="javascript:;"  class="<?php echo $uploads_class; ?>">
			<i class="fa fa-desktop"></i>
			<span>Uploads</span>
		</a>
		<ul class="sub">
<?php
/*
  ?>
  <li>
  <?php
  echo $this->Html->link(
  'Received ('.$_Inbox.')',
  array(
  'controller' => 'uploads',
  'action' => 'inbox'
  )
  );
  ?>
  </li>
  <li>
  <?php
  echo $this->Html->link(
  'Uploaded ('.$_Draft.')',
  array(
  'controller' => 'uploads',
  'action' => 'draft'
  )
  );
  ?>
  </li>
  <li>
  <?php
  echo $this->Html->link(
  'Sent ('.$_Sent.')',
  array(
  'controller' => 'uploads',
  'action' => 'sent'
  )
  );
  ?>
  </li>
  <?php
 */
if (isset($_folders) && is_array($_folders) && count($_folders)) {
	foreach ($_folders as $_folder) {
		?>
					<li>
					<?php
					echo $this->Html->link(
							ucwords(strtolower($_folder['ManageFolder']['Name'] . ' (' . $_folder['ManageFolder']['count'] . ')')), array(
						'controller' => 'uploads',
						'action' => 'folder/' . $_folder['ManageFolder']['id'],
						'admin' => true
							)
					);
					?>
					</li>
						<?php
					}
				}
				?>

			<li>
			<?php
			echo $this->Html->link(
					'Compose', array(
				'controller' => 'uploads',
				'action' => 'add'
					)
			);
			?>
			</li>
		</ul>
	</li>
	<li class="sub-menu">
		<a href="javascript:;"  class="<?php echo $uploads_class; ?>">
				<?php
				echo $this->Html->link(
						'<i class="fa fa-desktop"></i> Manage Folders', array(
					'controller' => 'manageFolders',
					'action' => 'manage'
						), array(
					"class" => $manage_folder,
					"escape" => false
						)
				);
				?>
		</a>
	</li>
	<li>
			<?php
			echo $this->Html->link(
					'<i class="fa fa-th"></i> Departments', array(
				'controller' => 'departments',
				'action' => 'admin_index'
					), array(
				"class" => $departments_class,
				"escape" => false
					)
			);
			?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'<i class="fa fa-th"></i> Reset Password', array(
			'controller' => 'users',
			'action' => 'reset_password'
				), array(
			"class" => $rep_class,
			"escape" => false
				)
		);
		?>
	</li>
</ul>
