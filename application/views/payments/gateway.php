<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center <?php if ($this->agent->is_mobile()):?>mb-0<?php endif;?>">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Payments Gateway Settings</h1>
			<p class="docs-page-header-text">Manage your payments gateway settings in here</p>
		</div>
	</div>
</div>
<!-- End Page Header -->
<!-- Nav -->
<div class="row">
	<div class="col">
		<ul class="nav nav-segment mb-3" role="tablist">
			<li class="nav-item">
				<a class="nav-link <?= !$this->input->get('tab') ? 'active' : '';?>" id="general-settings" href="#general-settings-tab" data-bs-toggle="pill"
					data-bs-target="#general-settings-tab" role="tab" aria-controls="general-settings-tab"
					aria-selected="true">General Settings</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->input->get('tab') == 'midtrans' ? 'active' : '';?>" id="midtrans-settings"
					href="#midtrans-settings-tab" data-bs-toggle="pill"
					data-bs-target="#midtrans-settings-tab" role="tab" aria-controls="midtrans-settings-tab"
					aria-selected="false"><img src="<?= base_url();?>assets/images/payments/midtrans.jpg" alt=""
						class=nav-icon"
						style="width: 25px !important; margin-left: -4px; margin-top: -5px; margin-right: 10px; ">
					Midtrans</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?= $this->input->get('tab') == 'xendit' ? 'active' : '';?>" id="xendit-settings"
					href="#xendit-settings-tab" data-bs-toggle="pill"
					data-bs-target="#xendit-settings-tab" role="tab" aria-controls="xendit-settings-tab"
					aria-selected="false"><img src="<?= base_url();?>assets/images/payments/xendit.png" alt=""
						class=nav-icon"
						style="width: 25px !important; margin-left: -4px; margin-top: -5px; margin-right: 10px; ">
					Xendit</a>
			</li>
		</ul>
	</div>
</div>
<!-- End Nav -->

<div class="row">
	<div class="col">
		<!-- Tab Content -->
		<div class="tab-content">
			<div class="tab-pane fade <?= !$this->input->get('tab') ? 'show active' : '';?>" id="general-settings-tab" role="tabpanel"
				aria-labelledby="general-settings">
				<div class="card">
					<div class="card-body">
						<form action="<?= site_url('api/payments/ubahProviders');?>" method="post"
							class="js-validate needs-validation" novalidate enctype="multipart/form-data">
							<!-- Form -->
							<div class="mb-4">
								<label class="form-label">Providers</label>
								<div class="alert bg-soft-primary">
									<small>You set the config of providers you choose, before activated the providers
										below</small>
								</div>

								<div class="input-group input-group-md-down-break">
									<!-- Radio Check -->
									<label class="form-control" for="midtransProviders">
										<span class="form-check">
											<input type="radio" class="form-check-input" name="_gateway_providers"
												id="midtransProviders" value="midtrans"
												<?php if($_gateway_providers == 'midtrans'):;?>checked<?php endif;?>>
											<span class="form-check-label"><img
													src="<?= base_url();?>assets/images/payments/midtrans.jpg" alt=""
													class=nav-icon"
													style="width: 25px !important; margin-left: -4px; margin-top: -4px; margin-right: 10px; ">Midtrans</span>
										</span>
									</label>
									<!-- End Radio Check -->

									<!-- Radio Check -->
									<label class="form-control" for="xenditProviders">
										<span class="form-check">
											<input type="radio" class="form-check-input" name="_gateway_providers"
												id="xenditProviders" value="xendit"
												<?php if($_gateway_providers == 'xendit'):;?>checked<?php endif;?>>
											<span class="form-check-label"><img
													src="<?= base_url();?>assets/images/payments/xendit.png" alt=""
													class=nav-icon"
													style="width: 25px !important; margin-left: -4px; margin-top: -4px; margin-right: 10px; ">Xendit</span>
										</span>
									</label>
									<!-- End Radio Check -->

									<!-- Radio Check -->
									<label class="form-control" for="disabledProviders">
										<span class="form-check">
											<input type="radio" class="form-check-input" name="_gateway_providers"
												id="disabledProviders" value="disabled"
												<?php if($_gateway_providers == 'disabled'):;?>checked<?php endif;?>>
											<span class="form-check-label">Disabled <small><i>(Only manual payment will
														be active)</i></small></span>
										</span>
									</label>
									<!-- End Radio Check -->
								</div>
							</div>
							<div class="card-footer px-0">
								<button type="submit" class="btn btn-primary btn-sm float-end">Save Changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="tab-pane fade <?= $this->input->get('tab') == 'midtrans' ? 'show active' : '';?>" id="midtrans-settings-tab" role="tabpanel" aria-labelledby="midtrans-settings">
				<div class="card">
					<div class="card-body">
						<form action="<?= site_url('api/payments/ubahMidtrans');?>" method="post"
							class="js-validate needs-validation" novalidate enctype="multipart/form-data">
							<div class="mb-3">
								<label class="form-label">Mode</label>
								<!-- Form Switch -->
								<div class="form-check form-switch form-switch-between">
									<label class="form-check-label">Test mode</label>
									<input name="_midtrans_prod" class="js-toggle-switch form-check-input"
										type="checkbox" <?php if($_midtrans_prod == 1):;?>checked<?php endif;?>>
									<label class="form-check-label text-primary form-switch-promotion">
										Live mode
									</label>
								</div>
								<!-- End Form Switch -->
							</div>
							<div class="mb-3">
								<label for="inputWebsiteTitle" class="form-label">Server key test mode <small
										class="text-danger">*</small></label>
								<input type="text" id="inputWebsiteTitle" class="form-control form-control-sm"
									name="_server_key_sandbox" value="<?= $_server_key_sandbox;?>" required>
							</div>
							<div class="mb-3">
								<label for="inputWebsiteTitle" class="form-label">Client key test mode <small
										class="text-danger">*</small></label>
								<input type="text" id="inputWebsiteTitle" class="form-control form-control-sm"
									name="_client_key_sandbox" value="<?= $_client_key_sandbox;?>" required>
							</div>
							<div class="mb-3">
								<label for="inputWebsiteTitle" class="form-label">Server key live mode <small
										class="text-danger">*</small></label>
								<input type="text" id="inputWebsiteTitle" class="form-control form-control-sm"
									name="_server_key_production" value="<?= $_server_key_production;?>" required>
							</div>
							<div class="mb-3">
								<label for="inputWebsiteTitle" class="form-label">Client key live mode <small
										class="text-danger">*</small></label>
								<input type="text" id="inputWebsiteTitle" class="form-control form-control-sm"
									name="_client_key_production" value="<?= $_client_key_production;?>" required>
							</div>
							<div class="card-footer px-0">
								<button type="submit" class="btn btn-primary btn-sm float-end">Save Changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="tab-pane fade <?= $this->input->get('tab') == 'xendit' ? 'show active' : '';?>" id="xendit-settings-tab" role="tabpanel" aria-labelledby="xendit-settings">
				<div class="card">
					<div class="card-body">
						<form action="<?= site_url('api/payments/ubahXendit');?>" method="post"
							class="js-validate needs-validation" novalidate enctype="multipart/form-data">
							<div class="mb-3">
								<label class="form-label">Mode</label>
								<!-- Form Switch -->
								<div class="form-check form-switch form-switch-between">
									<label class="form-check-label">Test mode</label>
									<input name="_xendit_prod" class="js-toggle-switch form-check-input"
										type="checkbox" <?php if($_xendit_prod == 1):;?>checked<?php endif;?>>
									<label class="form-check-label text-primary form-switch-promotion">
										Live mode
									</label>
								</div>
								<!-- End Form Switch -->
							</div>
							<div class="mb-3">
								<label for="inputWebsiteTitle" class="form-label">Server key test mode <small
										class="text-danger">*</small></label>
								<input type="text" id="inputWebsiteTitle" class="form-control form-control-sm"
									name="_secret_key_production" value="<?= $_secret_key_production;?>" required>
							</div>
							<div class="mb-3">
								<label for="inputWebsiteTitle" class="form-label">Client key test mode <small
										class="text-danger">*</small></label>
								<input type="text" id="inputWebsiteTitle" class="form-control form-control-sm"
									name="_secret_key_sandbox" value="<?= $_secret_key_sandbox;?>" required>
							</div>
							<div class="card-footer px-0">
								<button type="submit" class="btn btn-primary btn-sm float-end">Save Changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End Tab Content -->
	</div>
</div>
