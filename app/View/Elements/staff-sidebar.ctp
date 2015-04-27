<?php
if (
		$this->params['controller'] == 'messages' &&
		(
		$this->params['action'] == 'admin_inbox' || $this->params['action'] == 'admin_sent' || $this->params['action'] == 'admin_draft' || $this->params['action'] == 'admin_add'
		)
) {
	$inbox_class = 'active';
	$manage_folder = '';
} else {
	$inbox_class = '';
}

if (strtolower($this->params['controller']) == 'folders') {
	$manage_folder = 'active';
} else {
	$manage_folder = '';
}

$rep_class = 'btn btn-info white bold s24 centered';
$_Inbox = 0;
$_Sent = 0;
$_Draft = 0;
?>


<ul class="sub sidebar-menu">
	<li>
		<?php
		echo $this->Html->link(
				'Compose', array(
			'controller' => 'messages',
			'action' => 'add',
			'staff' => true
				), array(
			'class' => ''
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'Received', "/staff/messages/folder/24", array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'Sent', '/staff/messages/sent', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'Uploaded by Scan', '/staff/messages/folder/26', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'Shared', '/staff/messages/folder/27', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<hr>
	<li>
		<?php
		echo $this->Html->link(
				'Add Folder', '/staff/folders/add', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'View Folders', '/staff/folders/view', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
</ul>

