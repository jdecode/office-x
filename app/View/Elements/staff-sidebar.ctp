<?php
$rep_class = 'btn btn-info white bold s24 centered';
$_Inbox = 0;
$_Sent = 0;
$_Draft = 0;
?>

<ul class="sidebar-menu" id="nav-accordion">

	<!--<p class="centered"><a href="#">
	<?php echo $this->Html->image("/assets/img/ui-sam.jpg", array("class" => "img-circle", "width" => "60")) ?>
			
			</a></p>
	<h5 class="centered">him-soft-solution Admin</h5>-->
	<li>
		<?php
		echo $this->Html->link(
				'Compose', array(
			'controller' => 'Uploads',
			'action' => 'add'
				), array(
			"class" => $rep_class,
			"escape" => false
				)
		);
		?>
	</li>
</ul>
<ul class="sidebar-menu folders">
	<li>
		<?php
		echo $this->Html->link(__('Received (' . $_Inbox . ')'), array('controller' => 'uploads', 'action' => 'inbox'));
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(__('Sent (' . $_Sent . ')'), array('controller' => 'uploads', 'action' => 'sent'));
		?>
	</li>
	<li>
		<?php
		echo $this->Html->link(__('Uploaded by Scan (' . $_Draft . ')'), array('controller' => 'uploads', 'action' => 'draft'));
		?>
	</li>
	<li>
		<?php
//echo $this->Html->link(__('Shared ('.$_shared.')'), array('controller' => 'uploads', 'action' => 'sent'));
		?>
	</li>
	<hr>
	<?php
	if (isset($_folders) && is_array($_folders) && count($_folders)) {
		foreach ($_folders as $_folder) {
			?>
			<li>
				<?php
				echo $this->Html->link(
						ucwords(
								strtolower(
										$_folder['ManageFolder']['Name'] . ' (' . $_folder['ManageFolder']['count'] . ')'
								)
						), array(
					'controller' => 'uploads',
					'action' => 'folder/' . $_folder['ManageFolder']['id'],
					'admin' => false
						)
				);
				?>
			</li>
			<?php
		}
		?>
		<hr>
		<?php
	}
	?>
	<li>
		<?php
		echo $this->Html->link(
				'Manage Folders', array(
			'controller' => 'manageFolders',
			'action' => 'manage',
			'staff' => true
				)
		);
		?>
	</li>
</ul>
