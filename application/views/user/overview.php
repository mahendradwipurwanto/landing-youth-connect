<div class="d-grid gap-3 gap-lg-5">
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Overview</h4>
		</div>

		<div class="card-body">
			<?php if (empty($participants)):?>
			<!-- CTA -->
			<div class="card card-sm overflow-hidden mb-5">
				<!-- Card -->
				<div class="card-body">
					<div class="row justify-content-md-start align-items-md-center text-center text-md-start">
						<div class="col-md offset-md-3 mb-3 mb-md-0">
							<h4 class="card-title">You haven't submitted your registration form!</h4>
						</div>

						<div class="col-md-auto">
							<a class="btn btn-primary btn-sm btn-transition"
								href="<?= site_url('user/submission');?>">Submit it now</a>
						</div>
					</div>

					<!-- SVG Shape -->
					<figure class="w-25 d-none d-md-block position-absolute top-0 start-0 mt-n2">
						<svg viewBox="0 0 451 902" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path opacity="0.125" d="M0 82C203.8 82 369 247.2 369 451C369 654.8 203.8 820 0 820"
								stroke="url(#paint2_linear)" stroke-width="164" stroke-miterlimit="10" />
							<defs>
								<linearGradient id="paint2_linear" x1="323.205" y1="785.242" x2="-97.6164" y2="56.3589"
									gradientUnits="userSpaceOnUse">
									<stop offset="0" stop-color="white" stop-opacity="0" />
									<stop offset="1" stop-color="#25476C" />
								</linearGradient>
							</defs>
						</svg>
					</figure>
					<!-- End SVG Shape -->
				</div>
				<!-- End Card -->
			</div>
			<!-- End CTA -->
			<?php else:?>
			<?php if (isset($participants->is_payment) && $participants->is_payment == 0):?>
			<!-- <div class="alert alert-soft-danger small" role="alert">
				You not yet make payment for your submission to be submitted. Please make payment at "Payment" menu or
				<a href="<?= site_url('user/payment');?>" class="text-primary fw-bold">click here</a>
			</div> -->
			<?php endif;?>
			<?php if (isset($participants->status) && $participants->is_payment == 1 && ($participants->status == 0 || $participants->status == 1)):?>
			<div class="alert alert-soft-info small" role="alert">
				You has been paid your submission, you can submit your submission now !
			</div>
			<?php endif;?>
			<?php if (isset($participants->status) && $participants->status == 2):?>
			<div class="alert alert-soft-primary small" role="alert">
				Your submission has been submitted, please wait until your submission verified by our TEAM
			</div>
			<?php endif;?>
			<?php if (isset($participants->status) && $participants->status == 3):?>
			<div class="alert alert-soft-success small" role="alert">
				Your submission has been <b>ACCEPTED !</b>, welcome to IYS program. Please wait for furthure notice
			</div>
			<?php endif;?>
			<?php if (isset($participants->status) && $participants->status == 4):?>
			<div class="alert alert-soft-danger small" role="alert">
				Your submission has been <b>REJECTED !</b>
			</div>
			<?php endif;?>
			<?php endif;?>
		</div>
		<div class="card-footer pt-0">
		</div>
	</div>
	<!-- End Card -->
</div>
