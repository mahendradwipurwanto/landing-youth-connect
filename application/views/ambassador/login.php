<!-- Signup Form -->
<div class="container content-space-5 content-space-lg-5">
	<div class="row justify-content-lg-between align-items-md-center">
		<div class="col-md-5 mb-7 mb-md-0">
			<div class="mb-5">
				<h2>Ambassador Middle East Youth Summit</h2>
				<p>Access your ambassador account to see statistic about your campaign on Middle East Youth Summit.</p>
			</div>

			<!-- <h4>Learn more about:</h4> -->

			<!-- List Checked -->
			<!-- <ul class="list-checked list-checked-primary">
        <li class="list-checked-item">Unlimited access to the top 3,500+ courses</li>
        <li class="list-checked-item">Fresh content taught by 1,300+ experts – for any learning style</li>
        <li class="list-checked-item">Actionable learning insights <span class="badge bg-warning text-dark rounded-pill ms-1">Beta</span></li>
      </ul> -->
			<!-- End List Checked -->
		</div>
		<!-- End Col -->

		<div class="col-md-7 col-lg-6">
			<!-- Card -->
			<div class="card">
				<div class="card-body">
					<!-- Form -->
					<form action="<?= site_url('ambassador/proses_login'); ?>" method="POST" class="js-validate needs-validation"
						novalidate>
						<!-- Form -->
						<div class="mb-3">
							<label class="form-label" for="signupModalFormSignupEmail">Email</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend input-group-text" id="inputGroupMergeEmail">
									<i class="bi-envelope-open"></i>
								</div>
								<input type="email" class="form-control form-control-lg" name="email" id="signupModalFormSignupEmail"
									placeholder="email@site.com" aria-label="email@site.com" aria-describedby="inputGroupMergeEmail"
									required>
								<span class="invalid-feedback">Please enter a valid email address.</span>
							</div>
						</div>
						<!-- End Form -->

						<!-- Form -->
						<div class="mb-3">
							<label class="form-label" for="signupModalFormSignupKode">Kode</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend input-group-text" id="inputGroupMergeKode">
									<i class="bi-key"></i>
								</div>
								<input type="text" class="form-control form-control-lg" name="kode" id="signupModalFormSignupKode"
									placeholder="AFH001" aria-label="AFH001" aria-describedby="inputGroupMergeKode" required>
								<span class="invalid-feedback">Please enter a valid referral code.</span>
							</div>
						</div>
						<!-- End Form -->

						<div class="d-grid mb-3">
							<button type="submit" class="btn btn-primary btn-lg">Sign in</button>
						</div>
					</form>
					<!-- End Form -->
				</div>
			</div>
			<!-- End Card -->
		</div>
		<!-- End Col -->
	</div>
	<!-- End Row -->
</div>
<!-- End Signup Form -->
