    <div class="row">
    	<div class="col-md-6 offset-md-3">
    		<div class="d-grid gap-3 gap-lg-5">
    			<!-- Card -->
    			<div class="card">
    				<!-- Body -->
    				<div class="card-body">
    					<div class="row border-bottom">
    						<div class="col col-md-9">
    							<h3>Payment Status</h3>
    						</div>
    						<div class="col col-md-3" style="text-align: right;">
    							<?php if($reff['type'] == 'history'):?>
    							<a class="link link-sm link-secondary"
    								href="<?= site_url('user/payments-history/'.$reff['id'])?>">
    								<i class="bi-chevron-left small ms-1"></i> Go back
    							</a>
    							<?php else:?>
    							<a class="link link-sm link-secondary" href="<?= site_url('user/payment')?>">
    								<i class="bi-chevron-left small ms-1"></i> Go back
    							</a>
    							<?php endif;?>
    						</div>
    					</div>
    					<div id="boxStatus" class="text-center mt-4 mb-4">
    					</div>
    					<dl class="row mb-4">
    						<dt class="col-sm-6">ID TRANSACTION</dt>
    						<dd class="col-sm-6 text-sm-end mb-0">#<?= $payment_detail->transaction_id?></dd>
    					</dl>
    					<dl class="row mt-4 mb-4">
    						<dt class="col-sm-6">PAYMENT STATUS</dt>
    						<dd class="col-sm-6 text-sm-end mb-0">
    							<?php if($payment_detail->status == 1):?>
    							<span class="badge bg-secondary">pending</span>
    							<?php elseif($payment_detail->status == 2):?>
    							<span class="badge bg-success">success</span>
    							<?php elseif($payment_detail->status == 3):?>
    							<span class="badge bg-danger">canceled</span>
    							<?php elseif($payment_detail->status == 4):?>
    							<span class="badge bg-danger">rejected</span>
    							<p class="my-0"><small class="text-info">your payment is rejected, please contact us for
    									more
    									info</small></p>
    							<?php elseif($payment_detail->status == 5):?>
    							<span class="badge bg-danger">expired</span>
    							<?php else:?>
    							<span class="badge bg-warning">-</span>
    							<?php endif;?>
    						</dd>
    					</dl>
    					<dl class="row mt-4 mb-4">
    						<dt class="col-sm-6">DATE</dt>
    						<dd class="col-sm-6 text-sm-end mb-0">
    							<?= strtoupper(date("F d, Y H:i", $payment_detail->created_at))?></dd>
    					</dl>
    					<dl class="row mb-4">
    						<dt class="col-sm-6">ITEM</dt>
    						<dd class="col-sm-6 text-sm-end mb-0"><?= strtoupper($payment_detail->summit)?></dd>
    					</dl>
    					<dl class="row mb-4">
    						<dt class="col-sm-6">METHOD TYPE</dt>
    						<dd class="col-sm-6 text-sm-end mb-0">
    							<?= strtoupper(str_replace("_", " ", $payment_detail->payment_method))?></dd>
    					</dl>
    					<dl class="row mb-4">
    						<dt class="col-sm-6">METHOD</dt>
    						<dd class="col-sm-6 text-sm-end mb-0">
    							<img style="max-width: 75px;" src="<?= base_url();?><?= $payment_detail->img_method?>"
    								alt="">
    						</dd>
    					</dl>
    					<dl class="row mb-4">
    						<dt class="col-sm-6">REMARKS</dt>
    						<dd class="col-sm-6 text-sm-end mb-0"><?= $payment_detail->remarks?></dd>
    					</dl>
    					<p><b>Note:</b></p>
    					<p class="mb-4">- If there is an error, please reload your browser, if still send an email to <a
    							href="mailto:<?= $web_email;?>"><?= $web_email;?></a></p>
    					<div class="row mt-4">
    						<?php if($payment_detail->status <= 1):?>
    						<div class="col">
    							<button class="btn btn-soft-danger w-100 mt-4 btn-sm" data-bs-toggle="modal"
    								data-bs-target="#cancelPaymentGateway">Cancel Payment</button>
    						</div>
    						<?php endif;?>
    					</div>
    				</div>
    				<!-- End Body -->
    				<!-- End Footer -->
    			</div>
    			<!-- End Card -->
    		</div>
    	</div>
    	<!-- End Col -->
    </div>
    <!-- End Row -->

    <!-- Modal -->
    <div class="modal fade" id="cancelPaymentGateway" tabindex="-1" aria-labelledby="mdlCancelLabel" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="mdlCancelLabel">Cancel Payment</h5>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>

    			<div class="modal-body text-center">
    				<h4 class="text-center">Are you sure cancel this payment ?</h4>
					<span class="text-secondary small">you can cancel this payment to change your payment method or other purpose.</span>
    			</div>

    			<div class="modal-footer">
    				<form action="<?= site_url('api/payments/cancel')?>" method="POST" class="js-validate">
    					<input type="hidden" name="order_id" value="<?= $payment_detail->order_id?>">
    					<button type="button" class="btn btn-outline-secondary btn-sm"
    						data-bs-dismiss="modal">Close</button>
    					<button type="submit" class="btn btn-soft-danger btn-sm">Cancel Payment</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- End Modal -->