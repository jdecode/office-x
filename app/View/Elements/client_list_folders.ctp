<?php
//pr($folders);
$statuses = array(0 => 'Inactive', 1 => 'active');

echo $this->Session->flash();
?>
<div class="table">
	<h2>
		<?php
		//echo $_folders[$folder_type] . ' folders';
		?>
	</h2>
	<?php
	if (false) {
		?>
		<a
			href="<?php echo $this->webroot ?>client/folders/add"
			alt="Add Folder"
			title="Add Folder"
			style="float: right; font-weight: bold; font-size: 18px; padding-right: 30px;"
			>
			<i class="fa fa-angle-right"></i>
			<span>
				Add Folder
			</span>
		</a>
		<?php
	}
	?>
	<table class="table table-striped table-advance table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Action</th>
				<!--<th>Action</th>-->
			</tr>
		</thead>
		<tbody>
			<?php foreach ($folders as $folder) { ?>
				<tr>
					<td><?php echo $folder['Folder']['id']; ?></td>
					<td>
						<?php
						echo $this->Html->link(
								$folder['Folder']['name'],
								"/client/messages/custom_folder/{$folder['Folder']['id']}"
								);
						?>
					</td>
					<td class="">
						<?php
							echo $this->Html->link(
									'View',
									'/client/messages/custom_folder/' . $folder['Folder']['id'], 
									array(
										'class' => 'btn btn-success btn-xs',
										'rel' => $folder['Folder']['id']
										)
							);
						/*
						echo
						$folder['Folder']['status'] == 1 ?
								$this->Html->link(
										'Active',
										'/admin/folders/update_status/' . $folder['Folder']['id'], 
										array(
											'class' => 'btn btn-success btn-xs',
											'rel' => $folder['Folder']['id']
											)
								) :
								$this->Html->link(
										'Inactive', 
										'/admin/folders/update_status/' . $folder['Folder']['id'], 
										array(
											'class' => 'btn btn-danger btn-xs',
											'rel' => $folder['Folder']['id']
											)
								)
						;
						*/
						?>
					</td>
					<!--<td>
						<?php
						/*
						echo $this->Html->link(
								'<i class="fa fa-check"></i> View', '/admin/folders/documents/' . $folder['Folder']['id'], array(
							'class' => 'btn btn-success btn-xs',
							'escape' => false
								)
						);
						*/
						?>
					</td>-->
				</tr>
				</tr>
			<?php } ?>
		</tbody>
	</table>


</table>

<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}')
	));
	?>	</p>

<div class="paging">
	<?php
	echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
</div>

</div>

<script>
	$(document).ready(function() {
		$(document.body).on('click', '.update_status a', function(e) {
			e.preventDefault();
			_this = $(this);
			_id = _this.attr('rel');
			_this.addClass('disabled');
			$.ajax({
				url: "<?php echo $this->webroot.'admin/folders/update_status/' ?>"+_id,
				cache: false
			}).done(function(html) {
				if(html === '1') {
					_this.removeClass('btn-danger');
					_this.addClass('btn-success');
					_this.text('Active');
				}
				if(html === '2') {
					_this.removeClass('btn-success');
					_this.addClass('btn-danger');
					_this.text('Inactive');
				}
				_this.removeClass('disabled');
			});
		});
	});
</script>