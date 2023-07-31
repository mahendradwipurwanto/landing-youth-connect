<!-- Hero -->
<div class="position-relative bg-img-start"
	style="background-image: url(<?= base_url();?>berkas/landing/hero/hero1.jpg);">
	<div class="container content-space-t-2 content-space-t-md-3 content-space-3 content-space-b-lg-5">
		<div class="w-lg-50 mt-5">
			<h1>Eligilibity Countries for MEYS Summit</h1>
		</div>
	</div>

	<!-- Shape -->
	<div class="shape shape-bottom zi-1" style="margin-bottom: -.125rem">
		<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
			<path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
		</svg>
	</div>
	<!-- End Shape -->
</div>
<!-- End Hero -->

<!-- Clients -->
<div class="container position-relative zi-2">
	<div class="row justify-content-center mt-n5">
		<div class="col-lg-2 d-none d-lg-inline-block mt-lg-n10">
			<!-- Logo -->
			<div class="avatar avatar-xxl avatar-circle shadow-sm p-2 mx-auto">
				<img class="avatar-img" src="<?= base_url();?>assets/vendor/flag-icon-css/flags/1x1/id.svg">
			</div>
			<!-- End Logo -->
		</div>

		<div class="col-3 col-lg-2 d-none d-sm-inline-block mt-n10">
			<!-- Logo -->
			<div class="avatar avatar-xl avatar-circle shadow-sm p-2 mx-auto">
				<img class="avatar-img" src="<?= base_url();?>assets/vendor/flag-icon-css/flags/1x1/my.svg"
					alt="Image Description">
			</div>
			<!-- End Logo -->
		</div>

		<div class="col-lg-2 d-none d-lg-inline-block mt-lg-n8">
			<!-- Logo -->
			<div class="avatar avatar-xxl avatar-circle shadow-sm p-2 mx-auto">
				<img class="avatar-img" src="<?= base_url();?>assets/vendor/flag-icon-css/flags/1x1/sa.svg"
					alt="Image Description">
			</div>
			<!-- End Logo -->
		</div>

		<div class="col-3 col-lg-2 d-none d-sm-inline-block mt-n4">
			<!-- Logo -->
			<div class="avatar avatar-xl avatar-circle shadow-sm p-2 mx-auto">
				<img class="avatar-img" src="<?= base_url();?>assets/vendor/flag-icon-css/flags/1x1/tr.svg">
			</div>
			<!-- End Logo -->
		</div>

		<div class="col-3 col-lg-2 d-none d-sm-inline-block mt-n7">
			<!-- Logo -->
			<div class="avatar avatar-xl avatar-circle shadow-sm p-2 mx-auto">
				<img class="avatar-img" src="<?= base_url();?>assets/vendor/flag-icon-css/flags/1x1/sg.svg">
			</div>
			<!-- End Logo -->
		</div>

		<div class="col-lg-2 d-none d-lg-inline-block mt-lg-n10">
			<!-- Logo -->
			<div class="avatar avatar-xxl avatar-circle shadow-sm p-2 mx-auto">
				<img class="avatar-img" src="<?= base_url();?>assets/vendor/flag-icon-css/flags/1x1/ph.svg"
					alt="Image Description">
			</div>
			<!-- End Logo -->
		</div>
	</div>
</div>
<!-- End Clients -->
<div class="container content-space-1">
	<!-- Heading -->
	<div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
		<span class="text-cap">Eligilibity Countries</span>
		<h2>Find information about Eligilibity Countries for MEYS Summit</h2>
	</div>
	<!-- End Heading -->

	<div class="row mb-5">
		<div class="col mb-5">
			<!-- Card -->
			<div class="card">
				<div class="card-body">
					<table class="table table-hover table-striped w-100 dataTables" id="table">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th width="15%">Nationality</th>
								<th>Continent</th>
								<th>Type of Visa</th>
								<th>Issued From</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($eligilibity)):?>
							<?php $no = 1; foreach($eligilibity as $val):?>
							<tr>
								<td><?= $no++;?></td>
								<td><?= $val->nationality;?></td>
								<td><?= $val->continent;?></td>
								<td><?= $val->type_visa;?></td>
								<td><?= $val->issued_from;?></td>
							</tr>
							<?php endforeach;?>
							<?php endif;?>
						</tbody>
					</table>
				</div>

			</div>
			<!-- End Card -->
		</div>
		<!-- End Col -->

	</div>
</div>
