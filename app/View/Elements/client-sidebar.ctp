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
			'client' => true
				), array(
			'class' => ''
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'Invoices', "/client/messages/folder/19", array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'Sent', '/client/messages/sent', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'Quotation', '/client/messages/folder/20', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'HSE Update', '/client/messages/folder/21', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'Project Picture and Progress', '/client/messages/folder/22', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'Others', '/client/messages/folder/23', array(
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
				'Add Folder', '/client/folders/add', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
				'View Folders', '/client/folders/view', array(
			"class" => '',
			"escape" => false
				)
		);
		?>
	</li>
</ul>

