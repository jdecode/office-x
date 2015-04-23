<?php
$rep_class = 'btn btn-info white bold s24 centered';
$_Inbox = 0;
$_Sent = 0;
$_Draft = 0;
?>
<ul class="sidebar-menu" id="nav-accordion">

	<p class="centered"></p>

	<li><?php echo $this->Html->link('Compose', array('controller' => 'uploads', 'action' => 'add', 'client' => true), array("class" => $rep_class, "escape" => false)); ?> </li>
</ul>
<ul class="sidebar-menu folders">
	<li><?php echo $this->Html->link(__('Received (' . $_Inbox . ')'), array('controller' => 'uploads', 'action' => 'inbox')); ?> </li>
	<li><?php echo $this->Html->link(__('Uploaded (' . $_Draft . ')'), array('controller' => 'uploads', 'action' => 'draft')); ?> </li>
	<li><?php echo $this->Html->link(__('Sent (' . $_Sent . ')'), array('controller' => 'uploads', 'action' => 'sent')); ?> </li>
	<hr>
	<?php
	if (isset($_folders) && is_array($_folders) && count($_folders)) {
		foreach ($_folders as $_folder) {
			?>
			<li><?php echo $this->Html->link(ucwords(strtolower($_folder['ManageFolder']['Name'] . ' (' . $_folder['ManageFolder']['count'] . ')')), array('controller' => 'uploads', 'action' => 'folder/' . $_folder['ManageFolder']['id'], 'client' => true)); ?> </li>
			<?php
		}
	}
	?>
</ul>
