<div class="row">
	<div class="col-12">
		<?php if(is_null($loa)):?>
		<center>Not yet upload LOA documents</center>
		<?php else:?>
		<iframe width="100%" height="500px" src="<?= base_url().$loa->file;?>" frameborder="0"></iframe>
		<?php endif;?>
	</div>
</div>
