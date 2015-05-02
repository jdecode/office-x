<?php
$_users = array(2 => 'Staff', 3 => 'Clients');

echo $this->Session->flash();
?>
<div class="table">
	<h2><?php echo $_users[$user_type]; ?></h2>
	<table class="table table-striped table-advance table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<?php
				if ($user_type == 2) {
					?>
					<th>Department</th>
					<?php
				}
				?>
				<th>Actions</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 1;
			if (isset($this->params->paging["User"]["page"])) {
				$i = (10 * $this->params->paging["User"]["page"]) - 9;
			} else {
				$i = 1;
			}
			foreach ($users as $user) { ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo h($user['User']['name']); ?></td>
					<?php
					if ($user_type == 2) {
						?>
						<td><?php echo $user['Department']['name']; ?></td>
						<?php
					}
					?>
					<td>
						<?php
						echo $this->Html->link(
								'<i class="fa fa-check"></i> View', '/admin/users/view/' . $user['User']['id'], array(
							'class' => 'btn btn-success btn-xs',
							'escape' => false
								)
						);
						?>
						<!--<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>-->
						<?php
						/*
						echo $this->Form->postLink(
								'<i class="fa fa-trash-o "></i> Delete', array(
							'action' => 'delete', $user['User']['id']
								), array(
							'class' => 'btn btn-danger btn-xs',
							'escape' => false
								), __('Are you sure you want to delete "%s"?', $user['User']['username'])
						);
						*/
						?>
					</td>
					<td class="update_status">
						<?php
						echo
						$user['User']['status'] == 1 ?
								$this->Html->link(
										'Active', '/admin/users/update_status/' . $user['User']['id'], array(
									'class' => 'btn btn-success btn-xs',
									'rel' => $user['User']['id']
										)
								) :
								$this->Html->link(
										'Inactive', '/admin/users/update_status/' . $user['User']['id'], array(
									'class' => 'btn btn-danger btn-xs',
									'rel' => $user['User']['id']
										)
								)
						;
						?>
					</td>
				</tr>
				</tr>
					<?php 
					$i++;
					} ?>
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
				url: "<?php echo $this->webroot . 'admin/users/update_status/' ?>" + _id,
				cache: false
			}).done(function(html) {
				if (html === '1') {
					_this.removeClass('btn-danger');
					_this.addClass('btn-success');
					_this.text('Active');
				}
				if (html === '2') {
					_this.removeClass('btn-success');
					_this.addClass('btn-danger');
					_this.text('Inactive');
				}
				_this.removeClass('disabled');
			});
		});
	});
</script>