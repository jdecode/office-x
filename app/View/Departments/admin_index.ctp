
<div class="col-md-12">
	<div class="content-panel">
		<table class="table table-striped table-advance table-hover">
			<h4><i class="fa fa-angle-right"></i> Departments</h4>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Html->link('<span aria-hidden="true" class="glyphicon glyphicon-plus"></span><span aria-hidden="true" class="glyphicon glyphicon-user"></span>', array("controller" => "departments", "action" => "add", "admin" => true), array("escape" => false, "class" => "btn-lg pull-right", "title" => "Add Department")); ?>
			<div class=" clear">&nbsp;</div>
			<hr>
			<thead>
				<tr>
					<th><?php echo 'Sr No'; ?></th>
					<th><?php echo 'Name'; ?></th>
					<th><?php echo 'Created'; ?></th>
					<th class="actions"><?php echo __('Edit'); ?></th>
					<th class="actions"><?php echo __('Status'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($departments as $group): ?>
					<tr>
						<td><?php echo h($group['Department']['id']); ?>&nbsp;</td>
						<td><?php echo h($group['Department']['name']); ?>&nbsp;</td>
						<td><?php echo h($group['Department']['created']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>', array('action' => 'edit', $group['Department']['id']), array('escape' => false, 'title' => "Edit")); ?>
						</td>
						<td class="update_status">
							<?php
							echo
							$group['Department']['status'] == 1 ?
									$this->Html->link(
											'Active', '/admin/departments/update_status/' . $group['Department']['id'], array(
										'class' => 'btn btn-success btn-xs',
										'rel' => $group['Department']['id']
											)
									) :
									$this->Html->link(
											'Inactive', '/admin/departments/update_status/' . $group['Department']['id'], array(
										'class' => 'btn btn-danger btn-xs',
										'rel' => $group['Department']['id']
											)
									)
							;
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>


	</div><!-- /content-panel -->

	<div class=" clear">&nbsp;</div>
	<?php
	if (!isset($summary)) {
		$summary = 'before';
	}
	?>

    <div class="pull-right <?php echo (!empty($class) ? $class : ''); ?>">
		<?php if ($summary == 'before') { ?>
			<div class="pagination-summary before" style="text-align:right">
				<?php
				echo $this->Paginator->counter(array(
					'format' => __('{:current} of {:count} ' . ucfirst($this->request->params['controller']) . '  /  Page {:page} of {:pages}')
				));
				?>
			</div>         
			<?php
		}

		$params = $this->Paginator->params();
		if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination">
				<li><?php echo $this->Paginator->first('«', array('escape' => false), null, array('escape' => false, 'class' => 'prev disabled')); ?></li>
				<li><?php echo $this->Paginator->prev('‹', array('escape' => false), null, array('escape' => false, 'class' => 'prev disabled')); ?></li>
				<?php echo $this->Paginator->numbers(array('separator' => '</li><li>', 'before' => '<li>', 'after' => '</li>')); ?>
				<li><?php echo $this->Paginator->next('›', array('escape' => false), null, array('escape' => false, 'class' => 'next disabled')); ?></li>
				<li><?php echo $this->Paginator->last('»', array('escape' => false), null, array('escape' => false, 'class' => 'next disabled')); ?></li>
			</ul>
			<?php if ($summary == 'after') { ?>
				<div class="pagination-summary after" style="text-align:right">
					<?php
					echo $this->Paginator->counter(array(
						'format' => __('{:current} of {:count} ' . ucfirst($this->request->params['controller']) . '  /  Page {:page} of {:pages}')
					));
					?>
				</div>         
				<?php
			}
		}
		?>
    </div><!-- /.pagination -->


</div><!-- /col-md-12 -->

<script>
	$(document).ready(function() {
		$(document.body).on('click', '.update_status a', function(e) {
			e.preventDefault();
			_this = $(this);
			_url = _this.attr('href');
			_this.addClass('disabled');
			$.ajax({
				url: _url,
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