<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Payments
			</h1>
			<p class="docs-page-header-text">Manage payments for your programs.</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-md-12">
		<div class="alert alert-soft-info">
			<small>This is a temporary data, more features for this page will coming soon</small>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table table-hover table-striped w-100 dataTables" id="table">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Action</th>
							<th>Name</th>
							<th>Email</th>
							<th>Institution</th>
							<th>Payment State</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($payments)):?>
						<?php $no = 1; foreach($payments as $val):?>
						<tr>
							<td><?= $no++;?></td>
							<td>
								<button type="button" class="btn btn-soft-info btn-xs" data-bs-toggle="modal"
									data-bs-target="#detail-<?= $val->id;?>">detail</button>
								<button type="button" class="btn btn-soft-success btn-xs" data-bs-toggle="modal"
									data-bs-target="#verif-<?= $val->id;?>">verif</button>
							</td>
							<td><?= $val->name;?></td>
							<td><?= $val->email;?></td>
							<td><?= $val->institution;?></td>
							<td><?= $val->summit;?></td>
							<td>
								<?php if($val->status == 1):?>
								<span class="badge bg-secondary">pending</span>
								<?php elseif($val->status == 2):?>
								<span class="badge bg-success">success</span>
								<?php elseif($val->status == 3):?>
								<span class="badge bg-danger">canceled</span>
								<?php elseif($val->status == 4):?>
								<span class="badge bg-warning">-</span>
								<?php else:?>
								<span class="badge bg-warning">-</span>
								<?php endif;?>
							</td>
						</tr>

						<div id="detail-<?= $val->id; ?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="delete" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
								role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Detail</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="row mb-3 border-bottom">
											<div class="col-4 fw-bold">Payment</div>
											<div class="col-3 fw-bold">Date</div>
											<div class="col-3 fw-bold">Type</div>
											<div class="col-2 fw-bold">Status</div>
										</div>
										<?php if(!empty($val->payment_history)):?>
										<?php foreach($val->payment_history as $k => $v):?>
										<div class="row">
											<div class="col-4"><?= $v->summit;?></div>
											<div class="col-3">
												<?= date('F d, Y H:i:s', $v->created_at);?></div>
											<div class="col-3"><img style="max-width: 75px;"
													src="<?= base_url();?><?= $v->img_method;?>" />
											</div>
											<div class="col-2">
												<?php if($v->status == 1):?>
												<span class="badge bg-secondary">pending</span>
												<?php elseif($v->status == 2):?>
												<span class="badge bg-success">success</span>
												<?php elseif($v->status == 3):?>
												<span class="badge bg-danger">canceled</span>
												<?php elseif($v->status == 4):?>
												<span class="badge bg-danger">rejected</span>
												<?php else:?>
												<span class="badge bg-warning">-</span>
												<?php endif;?>
											</div>
										</div>
										<?php endforeach;?>
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade" id="verif-<?= $val->id;?>" tabindex="-1"
							aria-labelledby="mdlDeleteLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="mdlDeleteLabel">Verification</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>

									<div class="modal-body pb-2">
										<h5>Payment proff</h5>
										<!-- Media Viewer -->
										<a class="media-viewer" href="<?= base_url();?><?= $val->evidance;?>"
											data-fslightbox="gallery">
											<!-- End Media Viewer -->
											<img src="<?= base_url();?><?= $val->evidance;?>"
												class="img-thumbnail w-100 mb-3" alt="">
										</a>
										<div class="text-center">Are you sure to verification this payment?</div>
									</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-outline-secondary btn-sm"
											data-bs-dismiss="modal">Cancel</button>
										<form action="<?= site_url('api/payments/verificationPayment')?> " method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<input type="hidden" name="user_id" value="<?= $val->user_id;?>">
											<button type="submit"
												class="btn btn-soft-success btn-sm">Verification</button>
										</form>
										<form action="<?= site_url('api/payments/rejectedPayment')?> " method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<input type="hidden" name="user_id" value="<?= $val->user_id;?>">
											<button type="submit" class="btn btn-soft-danger btn-sm">Rejected</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- End Modal -->
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
