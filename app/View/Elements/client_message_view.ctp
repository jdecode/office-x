<?php
echo $this->Session->flash();
//pr($message);
?>

<?php echo $this->Session->flash(); ?>
<div class="col-md-12">
	<div class="content-panel">
		<table class="table table-striped table-advance table-hover">
			<tbody>

				<?php
				?>
				<tr>
					<td>
						Sender
					</td>
					<td>
						<?php echo $message['User']['username']; ?>
					</td>
				</tr>
				<tr>
					<td>
						Receiver
					</td>
					<td>
						<?php echo $message['User2']['username']; ?>
					</td>
				</tr>
				<tr>
					<td>Message</td>
					<td><?php echo $message['Message']['message']; ?>&nbsp;</td>
				</tr>
				<tr>
					<td>Date</td>
					<td><?php echo date('F d, Y H:i', $message['Message']['created']); ?>&nbsp;</td>
				</tr>
				<?php
				if(isset($message['Document']) && count($message['Document'])){
					$i = 1;
					foreach($message['Document'] as $k => $document) {
				?>
				<tr>
					<td class="actions">
						Download Document <?php echo count($message['Document']) == 1 ? '' : $i ?>
					</td>
					<td class="actions">
						<?php 
						echo $this->Html->link(
								''
								. '<button class="btn btn-primary">'
								. 'Download'
								. '</button>', 
								'/app/webroot/files/documents/'.$document['filename'],
								array(
									'escape' => false, 
									'title' => "Download",
									'download' => $document['filename']
									)
								);
						?>
					</td>
				</tr>
				<?php
					$i++;
					}
				}
				?>
			</tbody>
		</table>
		<br />
		<a 
			style="margin-left: 10px;" 
			href="<?php echo $this->webroot.'client/messages/custom_folder/'.$message['Folder']['id'] ?>" >
			<button type="button" class="btn btn-theme">Back</button>
		</a>
	</div><!-- /content-panel -->

	<div class=" clear">&nbsp;</div>

</div><!-- /col-md-12 -->
