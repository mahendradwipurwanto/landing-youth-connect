<!-- Content -->
<div class="container-fluid content-space-3 content-space-lg-3">

	<div class="row justify-content-center">
		<div class="col-sm-12 col-md-9 col-lg-9">
			<!-- Page Header -->
			<div class="docs-page-header">
				<div class="row align-items-center">
					<div class="col-sm">
						<h1 class="docs-page-header-title">Dashboard ambassador</h1>
						<p class="docs-page-header-text">Overview your campaign in here</p>
					</div>
				</div>
			</div>
			<!-- End Page Header -->
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-12 col-md-3 col-lg-3">
			<!-- Card -->
			<div class="card">
				<!-- Card Header -->
				<div class="card-header text-center">
					<div class="avatar avatar-xxl avatar-circle mb-3">
						<img class="avatar-img" src="https://i.stack.imgur.com/ZQT8Z.png"
							alt="<?= $ambassador->fullname; ?>">
						<img class="avatar-status avatar-lg-status"
							src="<?= base_url(); ?>assets/svg/illustrations/top-vendor.svg" alt="Image Description"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Verified user">
					</div>

					<h4 class="card-title mb-0">
						<?php $fullname = explode(" ", $ambassador->fullname);echo $fullname[0]; ?></h4>
					<p class="card-text small">
						<?= mb_substr($ambassador->email, 0, 4) ?>***@<?php $mail = explode("@", $ambassador->email);echo $mail[1]; ?>
					</p>
				</div>
				<!-- End Card Header -->

				<!-- Card Body -->
				<div class="card-body">

					<div class="mb-4">
						<h4>Affiliate overview</h4>
					</div>

					<div class="row">
						<div class="col-6 col-md-12 col-lg-6 mb-4">
							<!-- Icon Block -->
							<div class="d-flex align-items-center">
								<div class="flex-shrink-0">
									<span class="avatar avatar-xs">
										<img class="avatar-img" src="<?= base_url();?>assets/svg/illustrations/star.svg"
											alt="<?= $this->session->userdata('name');?>">
									</span>
								</div>

								<div class="flex-grow-1 ms-3">
									<span class="text-body small"><?= $statistik['total'];?> Register</span>
								</div>
							</div>
							<!-- End Icon Block -->
						</div>
						<!-- End Col -->

						<div class="col-6 col-md-12 col-lg-6 mb-4">
							<!-- Icon Block -->
							<div class="d-flex align-items-center">
								<div class="flex-shrink-0">
									<span class="avatar avatar-xs">
										<img class="avatar-img"
											src="<?= base_url();?>assets/svg/illustrations/add-file.svg"
											alt="Image Description">
									</span>
								</div>

								<div class="flex-grow-1 ms-3">
									<span class="text-body small"><?= $statistik['submission'];?> Joined</span>
								</div>
							</div>
							<!-- End Icon Block -->
						</div>
						<!-- End Col -->

						<div class="col-12 mt-2">
							<div class="input-group input-group-sm mb-3">
								<span class="input-group-text bg-primary text-white cursor" onclick="copyLink()"
									id="basic-addon1">copy
									link</span>
								<input type="text" class="form-control form-control-sm text-secondary"
									value="<?= $ambassador->referral_code;?>" id="referral_code" readonly>
								<span class="input-group-text bg-primary text-white cursor" onclick="copyCode()"
									id="basic-addon2">copy
									code</span>
							</div>
						</div>
					</div>
					<!-- End Row -->
				</div>
				<!-- End Card Body -->
			</div>
			<!-- End Card -->
		</div>
		<!-- End Col -->
		<div class="col-md-6 col-lg-6">
			<div class="card">
				<div class="card-header my-0 py-3">
					<h4 class="card-header-title">Your affiliate participants</h4>
				</div>
				<div class="card-body">
					<table class="table table-hover table-striped w-100 dataTables nowrap" id="table">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th>Name</th>
								<th>Email</th>
								<th>Joined date</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($affiliate)):?>
							<?php $no = 1; foreach($affiliate as $val):?>
							<tr>
								<td><?= $no++;?></td>
								<td><?= $val->name;?></td>
								<td><?= $val->email;?></td>
								<td><?= date("F d, Y", $val->created_at);?></td>
								<td>
									<?php if($val->status == 0):?>
									<span class="badge bg-secondary">not yet joined submission</span>
									<?php elseif($val->status == 1):?>
									<span class="badge bg-secondary">not yet joined submission</span>
									<?php elseif($val->status > 1):?>
									<span class="badge bg-danger">joined submission</span>
									<?php else:?>
									<span class="badge bg-warning">-</span>
									<?php endif;?>
								</td>
							</tr>
							<?php endforeach;?>
							<?php endif;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- End Row -->
</div>
<!-- End Content -->

<script>
	function copyLink() {
		var host = window.location.protocol + "//" + window.location.hostname + '/';
		var timer, xhr;

		// check if localhost
		if (host.includes('localhost')) {
			host = host + 'meys-v2/';
		}

		var code = document.getElementById("referral_code");

		code.select();
		code.setSelectionRange(0, 99999);

		navigator.clipboard.writeText(host+"sign-up?affiliate-code="+code.value);
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		})

		Toast.fire({
			icon: 'success',
			title: "Successfuly copy your affiliate register link"
		})
	}

	function copyCode() {

		var code = document.getElementById("referral_code");

		code.select();
		code.setSelectionRange(0, 99999);

		navigator.clipboard.writeText(code.value);
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		})

		Toast.fire({
			icon: 'success',
			title: "Successfuly copy your referral code <b>" + code.value + "</b>"
		})
	}

</script>
