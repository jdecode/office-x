<?php

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
						'Inbox', '/staff/messages/inbox', array(
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
						'Drafts', '/staff/messages/draft', array(
					"class" => '',
					"escape" => false
						)
				);
				?>
			</li>
		</ul>

