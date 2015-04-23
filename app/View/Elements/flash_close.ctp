<div id="flash_close" class="page-alert alert <?php echo @$this->Session->read('Message.flash.params.class') ?>">
	<button class="close" data-dismiss="alert">&times;</button>
	<?php echo $message; ?>
</div>

<script type="text/javascript">
	if($('#flash_close').length == 1) {
		$('#flash_close').
			//animate({'margin-top' : '-200px'}).
				removeClass('hide').
					animate({'margin-top' : '0px'}).
						delay(10000).
							fadeOut('slow');
							//animate({'margin-top' : '-200px'});
	}
</script>
