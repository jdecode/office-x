<?php
echo $this->Session->flash();
?>

<div class="col-md-12">
	<div class="content-panel">
		<table class="table table-striped table-advance table-hover">
			<?php echo $this->Session->flash(); ?>

			<div class=" clear">&nbsp;</div>
			<hr>
			<thead>
				<tr>
					<th><?php echo 'Sr.No'; ?></th>
					<th><?php echo 'Sender'; ?></th>
					<th><?php echo 'Receiver'; ?></th>
					<th><?php echo 'Message'; ?></th>
					<th><?php echo 'Date/Time'; ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>

				<?php
				if (!empty($messages)) {
					$i = 1;
					if (isset($this->params->paging["Message"]["page"])) {
						$i = (10 * $this->params->paging["Message"]["page"]) - 9;
					} else {
						$i = 1;
					}
					foreach ($messages as $message):
						?>
						<tr>
							<td><?php echo $i; ?>&nbsp;</td>
							<td>
								<?php echo $message['User']['username']; ?>
							</td>
							<td>
								<?php echo $message['User2']['username']; ?>
							</td>
							<!-- <td><?php //echo $this->Html->link('<span class="btn btn-primary">Download</span>', '/app/webroot/files/documents/' . $message['Document']['filename'], array('escape' => false, 'target' => '_blank', 'download' => true)); ?>&nbsp;</td> -->
							<td><?php echo $message['Message']['message']; ?>&nbsp;</td>
							<td><?php echo date('F d, Y H:i', $message['Message']['created']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link('<button class="btn btn-success btn-xs"><i class="glyphicon glyphicon-eye-open"></i></button>', array('action' => 'view', $message['Message']['id']), array('escape' => false, 'title' => "View")); ?>
								<?php //echo $this->Form->postLink('<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>', array('action' => 'delete_inbox', $message['Message']['id'], 'admin' => false), array('escape' => false, 'title' => "Delete"), __('Are you sure you want to delete # %s?', $message['Message']['id'])); ?>
							</td>
						</tr>
						<?php
						$i++;
					endforeach;
				}else {
					?>
					<tr>
						<td colspan="9">
							<div class="alert alert-danger" role="alert">No result found</div>
						</td>
					</tr>
				<?php } ?>

			</tbody>
		</table>
		<br />
		<a 
			style="margin-left: 10px;" 
			href="<?php echo $this->webroot.'staff/folders/view' ?>">
			<button type="button" class="btn btn-theme">Back</button>
		</a>
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
			//$this->Paginator->options = array( 'url' => $paginatorURL );
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
