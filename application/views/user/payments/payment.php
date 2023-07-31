<?php if($gateway_provider == "midtrans"):?>
<?php if($midtrans_prod == true):?>
<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="<?= $client_key;?>">
</script>
<?php else:?>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $client_key;?>">
</script>
<?php endif;?>
<?php endif;?>

<div class="d-grid gap-3 gap-lg-5">
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Payment
				<a href="<?= site_url('user/payments-history');?>" class="text-primary fw-bold float-end">View your
					payments
					history</a>
			</h4>
		</div>
	</div>
	<!-- End Card -->

	<div class="alert alert-soft-info mb-0">
		If you use manual transfer. Please transfer money as requested! if you transfer less or more your
		payment had high chances to be decline by our.
	</div>
	<?php if(isset($participants->is_payment) && $participants->is_payment == 1):?>
	<div class="alert alert-soft-success mb-0">
		Yey! Your payment for regristration FEE is accepted!
	</div>
	<?php endif;?>
	<div class="row">
		<?php if(!empty($payment_batch)):?>
		<?php foreach($payment_batch as $key => $val):?>
		<div class="col col-sm-6 mb-4">
			<!-- Card -->
			<div class="card card-sm" style="max-width: 20rem;">
				<div class="card-header border-bottom">
					<h3 class="card-title" style="margin-bottom: 0px !important;"><?= $val->summit?></h3>
					<small>West Indonesian Time (GMT+7)</small>
					<br>
					<?php if(!is_null($val->payments)):?>
					<?php if($val->payments->status == 1):?>
					<span class="badge bg-secondary">pending</span>
					<?php elseif($val->payments->status == 2):?>
					<span class="badge bg-success">success</span>
					<?php elseif($val->payments->status == 3):?>
					<span class="badge bg-danger">canceled</span>
					<?php elseif($val->payments->status == 4):?>
					<span class="badge bg-danger">rejected</span>
					<p class="my-0"><small class="text-info">your payment is rejected, please contact us for more
							info</small></p>
					<?php elseif($val->payments->status == 5):?>
					<span class="badge bg-danger">expired</span>
					<?php else:?>
					<span class="badge bg-warning">-</span>
					<?php endif;?>
					<?php endif;?>
				</div>
				<div class="card-body">
					<div class="mb-4">
						<span class="card-subtitle">Open:</span>
						<h5><?= date("F d, Y H:i", $val->start_date)?></h5>
					</div>
					<div class="mb-4">
						<span class="card-subtitle">Close:</span>
						<h5><?= date("F d, Y 23:59", $val->end_date)?></h5>
					</div>
					<div>
						<span class="card-subtitle">Total (IDR)</span>
						<h3 class="text-primary">Rp. <?= number_format($val->amount)?></h3>
						<b>OR</b>
						<span class="card-subtitle mt-1">Total (USD)</span>
						<h3 class="text-primary">$<?= $val->amount_usd?></h3>
					</div>
					<div>
						<span class="text-secondary small"><?= $val->description;?></span>
					</div>
					<?php if(is_null($val->payments) || $val->payments->status == 3 || $val->payments->status == 4 || $val->payments->status == 5):?>
					<?php if($gateway_provider == "midtrans"):?>
					<?php if($is_allow_gateway == true):?>
					<button type="button" class="btn btn-outline-success btn-sm purchase-button w-100 mt-2"
						onclick="payMidtrans(<?= $val->id;?>, <?= $val->amount;?>, <?= $val->amount_usd;?>)">Pay
						(payment
						gateway)</button>
					<?php else:?>
					<button type="button" class="btn btn-outline-success btn-sm purchase-button w-100 mt-2" disabled>Pay
						(payment
						gateway) LOCKED</button>
					<?php endif;?>
					<?php endif;?>
					<?php if($gateway_provider == "xendit"):?>
					<button type="button" class="btn btn-outline-success btn-sm purchase-button w-100 mt-2"
						onclick="payXendit(<?= $val->id;?>, <?= $val->amount;?>, <?= $val->amount_usd;?>)">Pay (payment
						gateway)</button>
					<?php endif;?>
					<button type="button" class="btn btn-warning btn-sm purchase-button w-100 mt-2"
						data-bs-toggle="modal" data-bs-target="#manual-transfer-<?= $val->id;?>">Manual
						Transfer</button>
					<?php else:?>
					<?php if($val->payments->type_method == 'gateway_midtrans'):?>
					<a href="<?= site_url('user/payments-transaction/'.$val->payments->order_id.'?method=gateway');?>"
						class="btn btn-warning btn-sm purchase-button w-100 mt-2">View Transaction</a>
					<?php else:?>
					<a href="<?= site_url('user/payments-transaction/'.$val->payments->id);?>"
						class="btn btn-warning btn-sm purchase-button w-100 mt-2">View Transaction</a>
					<?php endif;?>
					<?php endif;?>
					<a href="<?= site_url('user/payments-history/'.$val->id);?>"
						class="btn btn-info btn-sm purchase-button w-100 mt-2">History</a>
				</div>
			</div>
			<!-- End Card -->
		</div>
		<!-- Modal -->
		<div class="modal fade" id="manual-transfer-<?= $val->id;?>" tabindex="-1"
			aria-labelledby="manual-transfer-title-<?= $val->id;?>Label" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="manual-transfer-title-<?= $val->id;?>Label">Manual Transfer -
							<?= $val->summit;?></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">
						<form action="<?= site_url('api/payments/manualPayment')?>" method="POST"
							enctype="multipart/form-data" class="js-validate">
							<input type="hidden" name="payment_batch" value="<?= $val->id;?>">
							<input type="hidden" name="amount" value="<?= $val->amount;?>">
							<input type="hidden" name="amount_usd" value="<?= $val->amount_usd;?>">
							<div class="form-group">
								<label class="mb-2 form-label" for="">Method Payment</label>
								<div class="row gx-3 text-center" role="tablist">
									<?php if(!empty($payment_settings)):?>
									<?php $no = 1; foreach($payment_settings as $k => $v):?>
									<input type="hidden" name="code_method" value="<?= $v->code_method;?>">
									<div class="col-3 col-md-3 mb-3">
										<!-- Radio Check -->
										<div class="form-check form-check-card text-center"
											onclick="showGuide(<?= $v->id;?>)">
											<input class="form-check-input" type="radio" name="payment_setting"
												value="<?= $v->id;?>" id="method_payment-<?= $v->id;?>"
												<?= $no++ == 1 ? 'checked' : '';?>>
											<label class="form-check-label" for="method_payment-<?= $v->id;?>">
												<div class="h-100 payments-height-user d-flex align-items-center">
													<img class="w-100 h-auto mb-3"
														src="<?= base_url()?><?= $v->img_method;?>" alt="SVG">
												</div>
												<span class="d-block"><?= $v->payment_method;?></span>
											</label>
										</div>
										<!-- End Radio Check -->
									</div>
									<!-- End Col -->
									<?php endforeach;?>
									<?php endif;?>
								</div>
								<!-- End Row -->
							</div>

							<?php if(!empty($payment_settings)):?>
							<?php $no = 1; foreach($payment_settings as $k => $v):?>
							<div class="mb-3">
								<div id="data-<?= $v->id;?>" class="data <?= $no == 1 ? '' : 'd-none';?>">
									<label class="form-label" for="">Payment Data -
										<?= $v->payment_method;?></label>
									<?php if($v->data == "" || $v->data == null):?>
									<p>There is not yet payment data for this method</p>
									<?php else:?>
									<ul class="list-pointer list-pointer-sm list-pointer-primary">
										<li class="list-pointer-item text-danger"><b>Payment FEE need to TRANSFER</b>:
											<b>Rp. <?= number_format($val->amount)?> (IDR)</b> /
											<b>$<?= number_format($val->amount_usd)?> (USD)</b></li>
										<?php foreach($v->data as $kk => $vv):?>
										<li class="list-pointer-item"><b><?= ucwords(str_replace("_", " ", $kk));?></b>:
											<?= $vv;?></li>
										<?php endforeach;?>
									</ul>
									<?php endif;?>
								</div>
							</div>
							<div class="mb-3">
								<div id="guide-<?= $v->id;?>" class="guide <?= $no == 1 ? '' : 'd-none';?>">
									<label class="form-label" for="">Payment Guide -
										<?= $v->payment_method;?></label>
									<div class="alert alert-soft-info small pb-0">
										<?= $v->tutorial == "" || $v->tutorial == null ? '<p>There is not yet payment guide for this method</p>' : $v->tutorial;?>
									</div>
								</div>
							</div>
							<?php $no++; endforeach;?>
							<?php endif;?>

							<!-- <div class="mb-3">
								<label for="poster-announcements" class="form-label">Payment Proof</label>
								<figure class="text-center">
									<img src="#" id="imgthumbnail" class="img-thumbnail img-fluid mb-2"
										alt="Thumbnail image"
										onerror="this.onerror=null;this.src='<?= base_url();?>assets/images/placeholder.jpg';">
								</figure>
								<div class="input-group">
									<input type="file" class="form-control form-control-sm imgprev" name="image"
										accept="image/*" id="poster-announcements" required>
								</div>
								<small class="text-muted">Max file size 1Mb. <span class="text-danger">Upload proof that
										you already transfer money as
										requested for this payment!</span></small>
							</div> -->
							<div class="mb-3">
								<label for="paymentproff<?= $val->id;?>-upload" class="form-label">Payment Proof</label>
								<figure>
									<img src="#" id="paymentproff<?= $val->id;?>-preview" class="img-thumbnail img-fluid"
										alt="Thumbnail image"
										onerror="this.onerror=null;this.src='<?= base_url();?><?= 'assets/images/placeholder.jpg'?>';">
								</figure>
								<div class="input-group">
									<input type="file" class="form-control form-control-sm imgprev" name="image"
										accept="image/*, .svg" id="paymentproff<?= $val->id;?>-upload">
								</div>
								<small class="text-muted">Max file size 1Mb. <span class="text-danger">Upload proof that
										you already transfer money as
										requested for this payment!</span></small>
							</div>

							<div class="form-group mt-2">
								<label for="">Remarks</label>
								<input type="text" name="remarks" class="form-control form-control-sm"
									placeholder="Name of Participant" required>
							</div>
					</div>

					<div class="modal-footer">
						<input type="hidden" name="id_payment_type" id="mdlManual_id">
						<button type="button" class="btn btn-outline-secondary btn-sm"
							data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-soft-success btn-sm">Make Payment</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal -->
		<?php endforeach;?>
		<?php endif;?>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<p><b>Note:</b></p>
					<p>- The "Pay" button provides many different payment methods of your choice such as Credit/Debit
						Card, Virtual Account, Bank Transfer, and GoPay).</p>
					<p>- Confirm your PayPal payments by sending the payment proof, full name, and account email to <a
							href="mailto:<?= $web_email;?>"><?= $web_email;?></a></p>
					<p>- If there is an error, please reload your browser, if still send an email to <a
							href="mailto:<?= $web_email;?>"><?= $web_email;?></a></p>
				</div>
			</div>
		</div>
	</div>
</div>

<form id="payment-form" method="post" action="<?= site_url('api/payments/finish') ?>">
	<input type="hidden" name="result_type" id="result-type" value=""></div>
	<input type="hidden" name="result_data" id="result-data" value=""></div>
</form>

<script>
	function showGuide(id) {
		console.log(id);
		$('.data').addClass('d-none');
		$('.guide').addClass('d-none');
		$('#data-' + id).removeClass('d-none');
		$('#guide-' + id).removeClass('d-none');
	}

	function payMidtrans(batch_id, amount, usd) {
		$(this).attr("disabled", true);

		$.ajax({
			url: "<?=site_url('api/payments/pay')?>",
			method: 'POST',
			data: {
				payment_batch: batch_id,
				amount: amount,
				amount_usd: usd,
			},
			cache: false,

			success: function (data) {
				var resultType = document.getElementById('result-type');
				var resultData = document.getElementById('result-data');

				function changeResult(type, data) {
					$("#result-type").val(type);
					$("#result-data").val(JSON.stringify(data));
				}

				snap.pay(data, {

					onSuccess: function (result) {
						changeResult('success', result);
						$("#payment-form").submit();
					},
					onPending: function (result) {
						changeResult('pending', result);
						$("#payment-form").submit();
					},
					onError: function (result) {
						changeResult('error', result);
						$("#payment-form").submit();
					}
				});

				$(this).attr("disabled", false);
			}
		});
	}

</script>
