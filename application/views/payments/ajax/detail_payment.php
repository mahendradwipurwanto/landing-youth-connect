<script src="<?= base_url(); ?>assets/vendor/fslightbox/index.js"></script>
<table class="table table-striped w-100 dataTables nowrap" id="table">
	<thead>
		<tr>
			<th width="5%">No.</th>
			<th width="15%">Action</th>
			<th>Payment</th>
			<th>Date</th>
			<th>Type</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($payment_history)):?>
		<?php $no = 1; foreach($payment_history as $val):?>
		<tr>
			<td><?= $no++;?></td>
			<td>
				<?php if($val->type_method == 'gateway_midtrans'):?>
					<span type="button" class="btn btn-soft-primary btn-xs">Payment Gateway</span>
				<?php else:?>
				<!-- Media Viewer -->
				<a class="media-viewer" href="<?= base_url();?><?= $val->evidance;?>" data-fslightbox="gallery">
					<!-- End Media Viewer -->
					<button type="button" class="btn btn-soft-info btn-xs"><i class="bi bi-card-image"></i>
						proff </button>
				</a>
				<?php endif;?>
			</td>
			<td><?= $val->summit;?></td>
			<td><?= date('F d, Y H:i:s', $val->created_at);?></td>
			<td><img style="max-width: 75px;" src="<?= base_url();?><?= $val->img_method;?>" /></td>
			<td>
				<?php if($val->status == 1):?>
				<span class="badge bg-secondary">pending</span>
				<?php elseif($val->status == 2):?>
				<span class="badge bg-success">success</span>
				<?php elseif($val->status == 3):?>
				<span class="badge bg-warning">canceled</span>
				<?php elseif($val->status == 4):?>
				<span class="badge bg-danger">rejected</span>
				<?php else:?>
				<span class="badge bg-danger">expired</span>
				<?php endif;?>
			</td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
	</tbody>
</table>
