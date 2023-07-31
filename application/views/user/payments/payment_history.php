<div class="d-grid gap-3 gap-lg-5">
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Payment History
				<a href="<?= site_url('user/payment');?>" class="btn btn-outline-secondary btn-sm float-end">back</a>
			</h4>
		</div>

		<div class="card-body">
			<div class="row">
				<table class="table table-borderless table-thead-bordered datatable" id="table">
					<thead class="thead-light">
						<tr>
							<th scope="col">Payment</th>
							<th scope="col">Date</th>
							<th scope="col">Method</th>
							<th scope="col">Status</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($payment_history)):?>
						<?php foreach($payment_history as $key => $val):?>
						<tr>
							<td scope="col"><?= $val->summit;?></td>
							<td scope="col"><?= date('F d, Y H:i:s', $val->created_at);?></td>
							<td scope="col">
								<img style="max-width: 75px;" src="<?= base_url();?><?= $val->img_method;?>" />
							</td>
							<td scope="col">
								<?php if($val->status == 1):?>
								<span class="badge bg-secondary">pending</span>
								<?php elseif($val->status == 2):?>
								<span class="badge bg-success">success</span>
								<?php elseif($val->status == 3):?>
								<span class="badge bg-warning">canceled</span>
								<?php elseif($val->status == 4):?>
								<span class="badge bg-danger">rejected</span>
								<?php elseif($val->status == 5):?>
								<span class="badge bg-danger">expired</span>
								<?php else:?>
								<span class="badge bg-warning">-</span>
								<?php endif;?>
							</td>
							<td class="d-flex ">
								
								<?php if($val->status == 2):?>
								<form method="post" action="<?= site_url('api/payments/invoice');?>">
									<input type="hidden" name="file" value="<?= $val->file;?>">
									<input type="hidden" name="no" value="<?= !is_null($val->order_id) ? $val->order_id : $val->transaction_id;?>">
									<input type="hidden" name="name" value="<?= $this->session->userdata('name');?>">
									<button type="submit" class="btn btn-xs btn-success" style="margin-right: 5px">Receipt</button>
								</form>
								<?php endif;?>
								<?php if($val->type_method == 'gateway_midtrans'):?>
								<a href="<?= site_url('user/payments-transaction/'.$val->order_id.'?reff=history&method=gateway&id='.$this->uri->segment(3));?>"
									class="btn btn-xs btn-info">check</a>
								<?php else:?>
								<a href="<?= site_url('user/payments-transaction/'.$val->id.'?reff=history&id='.$this->uri->segment(3));?>"
									class="btn btn-xs btn-info">check</a>
								<?php endif;?>
							</td>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer pt-0">
		</div>
	</div>
	<!-- End Card -->
</div>
