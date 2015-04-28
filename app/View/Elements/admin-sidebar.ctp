<?php
if (
		$this->params['controller'] == 'users' &&
		(
		$this->params['action'] == 'admin_clients' || $this->params['action'] == 'admin_addclient'
		)
) {
	$client_class = 'active';
} else {
	$client_class = '';
	if ($this->params['action'] == 'admin_view' && isset($user['User']['group_id']) && $user['User']['group_id'] == 3) {
		$client_class = 'active';
	}
}

if (
		$this->params['controller'] == 'users' &&
		(
		$this->params['action'] == 'admin_staff' || $this->params['action'] == 'admin_addstaff'
		)
) {
	$staffs_class = 'active';
} else {
	$staffs_class = '';
	if ($this->params['action'] == 'admin_view' && isset($user['User']['group_id']) && $user['User']['group_id'] == 2) {
		$staffs_class = 'active';
	}
}

if ($this->params['controller'] == 'departments') {
	$departments_class = 'active';
} else {
	$departments_class = '';
}

if (strtolower($this->params['controller']) == 'folders') {
	$manage_folder = 'active';
} else {
	$manage_folder = '';
}

if ($this->params['controller'] == 'users' && $this->params['action'] == 'admin_reset_password') {
	$rep_class = 'active';
} else {
	$rep_class = '';
}

if (
		$this->params['controller'] == 'messages' 
		&& 
		(
			$this->params['action'] == 'admin_inbox'
			|| $this->params['action'] == 'admin_sent'
			|| $this->params['action'] == 'admin_draft'
			|| $this->params['action'] == 'admin_add'
		)
	) {
	$inbox_class = 'active';
	$manage_folder = '';
} else {
	$inbox_class = '';
}
?>


<ul class="sidebar-menu" id="nav-accordion">
	<li class="sub-menu">
		<a href="javascript:;" class="<?php echo $staffs_class; ?>" >
			<i class="fa fa-desktop"></i>
			<span>Staff</span>
		</a>
		<ul class="sub">
			<li>
				<?php
				echo $this->Html->link(
						'List Staffs', array(
					'controller' => 'users',
					'action' => 'staff',
					'admin' => true
						)
				);
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'New Staff', array(
					'controller' => 'users',
					'action' => 'addstaff',
					'admin' => true
						)
				);
				?>
			</li>
		</ul>
	</li>
	<li class="sub-menu">
		<a href="javascript:;"  class="<?php echo $client_class; ?>">
			<i class="fa fa-desktop"></i>
			<span>Clients</span>
		</a>
		<ul class="sub">
			<li>
				<?php
				echo $this->Html->link(
						'List Clients', array(
					'controller' => 'users',
					'action' => 'clients',
					'admin' => true
						)
				);
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'New Client', array(
					'controller' => 'users',
					'action' => 'addclient',
					'admin' => true
						)
				);
				?>
			</li>
		</ul>
	</li>

	<li class="sub-menu">
		
			<?php
			echo $this->Html->link(
					'<i class="fa fa-desktop"></i> Messages', '/admin/messages/inbox', array(
				"class" => "$inbox_class",
				"escape" => false
					)
			);
			?>
		
		<ul class="sub">
			<li>
				<?php
				echo $this->Html->link(
						'Compose', array(
					'controller' => 'messages',
					'action' => 'admin_add',
					'admin' => true
						), array(
					'class' => ''
						)
				);
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						"Inbox ($admin_inbox_count)", '/admin/messages/inbox', array(
					"class" => '',
					"escape" => false
						)
				);
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						"Sent ($admin_sent_count)", '/admin/messages/sent', array(
					"class" => '',
					"escape" => false
						)
				);
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						"Drafts ($admin_draft_count)", '/admin/messages/draft', array(
					"class" => '',
					"escape" => false
						)
				);
				?>
			</li>
		</ul>
	</li>

	<li class="sub-menu">
			<?php
			echo $this->Html->link(
					'<i class="fa fa-desktop"></i> Folders', '/admin/folders', array(
				"class" => $manage_folder,
				"escape" => false
					)
			);
			?>
		<ul class="sub">
			<?php
			$folders = array(0 => 'All', 1 => 'Admin', 2 => 'Staff', 3 => 'Client');
			foreach ($folders as $k => $folder) {
				?>
				<li>
					<?php
					echo $this->Html->link(
							$folder, array(
						'controller' => 'folders',
						'action' => 'view/' . $k,
						'admin' => true
							)
					);
					?>
				</li>
				<?php
			}
			?>
		</ul>
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
</ul>
