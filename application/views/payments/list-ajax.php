<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Payments
				<div class="btn-group float-end">
					<button class="btn btn-sm btn-success dropdown-toggle" type="button"
						id="dropdownMenuButtonClickAnimation" data-bs-toggle="dropdown" aria-expanded="false"
						data-bs-dropdown-animation>
						<i class="bi-file-earmark-excel-fill"></i>&nbsp;
						Export
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonClickAnimation">
						<a class="dropdown-item" href="<?= site_url('admin/export-payments/0')?>" target="_blank">All</a>
						<a class="dropdown-item" href="<?= site_url('admin/export-payments/1')?>" target="_blank">Pending</a>
						<a class="dropdown-item" href="<?= site_url('admin/export-payments/2')?>" target="_blank">Success</a>
						<a class="dropdown-item" href="<?= site_url('admin/export-payments/3')?>" target="_blank">Cancel</a>
						<a class="dropdown-item" href="<?= site_url('admin/export-payments/4')?>" target="_blank">Rejected</a>
						<a class="dropdown-item" href="<?= site_url('admin/export-payments/5')?>" target="_blank">Expired</a>
					</div>
				</div>
			</h1>
			<p class="docs-page-header-text">Manage payments for your programs.</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<h3>Summary Payments Income</h3>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Total Income</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="text-dark" id="totalIncome">Rp. 0</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Card -->
	</div>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Manual Income</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="text-dark" id="manualIncome">Rp. 0</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Card -->
	</div>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Paypal Income</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="text-dark" id="paypalIncome">Rp. 0</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Card -->
	</div>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5 d-none">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Xendit Income</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="text-dark" id="xenditIncome">Rp. 0</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Card -->
	</div>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Midtrans Income</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="text-dark" id="midtransIncome">Rp. 0</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Card -->
	</div>
</div>
<div class="row">
	<h3>Summary Payments Status </h3>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Payments success</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="counterChecked display-5 text-dark" id="paymentSuccess">0</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Card -->
	</div>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Payments pending</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="js-counter display-5 text-dark" id="paymentPending">0</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Card -->
	</div>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Payments cancel/deny/rejected</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="js-counter display-5 text-dark" id="paymentFailed">0</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Card -->
	</div>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Payments expire</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="js-counter display-5 text-dark" id="paymentExpired">0</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Card -->
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header py-3">
				<h4 class="card-header-title">Filter Payments Data</h4>
			</div>
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Email</label>
						<input type="text" id="filter_email" class="form-control form-control-sm"
							placeholder="Email Filter" />
					</div>

					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Name</label>
						<input type="text" id="filter_name" class="form-control form-control-sm"
							placeholder="Name Filter">
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Payment Batch/Summit</label>
						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" id="filter_batch" autocomplete="off"
								data-hs-tom-select-options='{"placeholder": "All Status"}'>
								<option value="0">All Payment batch</option>
								<?php if(!empty($payments_batch)):?>
								<?php foreach($payments_batch as $key => $val):?>
								<option value="<?= $val->id;?>"><?= $val->summit;?></option>
								<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					</div>
					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Payment Status</label>
						<!-- Select -->
						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" id="filter_status" autocomplete="off"
								data-hs-tom-select-options='{"placeholder": "All Status", "hideSearch": true}'>
								<option value="0">All Status</option>
								<option value="1">Pending</option>
								<option value="2">Success</option>
								<option value="3">Cancel</option>
								<option value="4">Rejected</option>
								<option value="5">Expired</option>
							</select>
						</div>
					</div>
					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Payment Method</label>
						<!-- Select -->
						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" id="filter_method" autocomplete="off"
								data-hs-tom-select-options='{"placeholder": "All Status", "hideSearch": true}'>
								<option value="0">All Method</option>
								<option value="1">Manual</option>
								<option value="2">Paypal</option>
								<option value="3">Midtrans</option>
							</select>
						</div>
					</div>
					<div class="col-sm mb-2 mb-sm-0">
						<button class="btn btn-sm btn-primary mt-4" id="searchBtn" onclick="btnSearch()"><i
								class="bi-search"></i>&nbsp&nbspSearch</button>
					</div>
				</div>
			</div>
			<div class="card-header py-3">
				<h4 class="card-header-title">Payments Data</h4>
			</div>
			<div class="card-body">
				<!-- End Row -->
				<table id="dataTable" class="table table-borderless table-thead-bordered nowrap w-100">
					<thead class="thead-light">
						<tr>
							<th scope="col">No</th>
							<th scope="col">Action</th>
							<th scope="col">Method</th>
							<th scope="col">Payment State</th>
							<th scope="col">Status</th>
							<th scope="col">Name</th>
							<th scope="col">Email</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdlPaymentDetail" tabindex="-1" aria-labelledby="mdlDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdlDeleteLabel">Payment Detail</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modalPaymentContent">
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="mdlPaymentDetailVerif" tabindex="-1" aria-labelledby="mdlDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdlDeleteLabel">Verification</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">
				<h5>Payment proff</h5>
				<img src="<?= base_url();?>assets/images/placeholder.jpg" class="img-thumbnail w-100 mb-3" alt=""
					id="evidance">
				<div class="text-center">Are you sure to verification this payment?</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
				<input type="hidden" name="id" class="mdlVerif_id">
				<input type="hidden" name="user_id" class="mdlVerif_userid">
				<button type="button" class="btn btn-soft-success btn-sm" id="verifBtn" onclick="verifData()">Verified</button>
				<button type="button" class="btn btn-soft-danger btn-sm" id="rejectBtn" onclick="rejectData()">Reject</button>
				<?php if($this->session->userdata('role') == 0):?>
				<button type="button" class="btn btn-soft-secondary btn-sm" id="pendingBtn" onclick="pendingData()">Pending</button>
				<button type="button" class="btn btn-soft-warning btn-sm" id="cancelBtn" onclick="cancelData()">Cancel</button>
				<?php endif;?>
				<!-- <form action="<?= site_url('api/payments/verificationPayment')?> " method="post"
					class="js-validate need-validate" novalidate>
					<input type="hidden" name="id" class="mdlVerif_id">
					<input type="hidden" name="user_id" class="mdlVerif_userid">
					<button type="submit" class="btn btn-soft-success btn-sm">Verification</button>
				</form>
				<form action="<?= site_url('api/payments/rejectedPayment')?> " method="post"
					class="js-validate need-validate" novalidate>
					<input type="hidden" name="id" class="mdlVerif_id">
					<input type="hidden" name="user_id" class="mdlVerif_userid">
					<button type="submit" class="btn btn-soft-danger btn-sm">Rejected</button>
				</form> -->
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="mdlParticipantDetail" tabindex="-1" aria-labelledby="mdlDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdlDeleteLabel">Participant Detail</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modalParticipantContent">
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<script>
	var table = $('#dataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'ordering': false,
		'searching': false,
		"scrollX": true,
		'responsive': true,
		'serverMethod': 'post',
		'ajax': {
			'url': "<?= site_url('admin/getAjaxPayment')?>",
			'data': function (d) {
				d.filterEmail = $('#filter_email').val()
				d.filterName = $('#filter_name').val()
				d.filterInstitution = $('#filter_institution').val()
				d.filterBatch = $('#filter_batch').val()
				d.filterStatus = $('#filter_status').val()
				d.filterMethod = $('#filter_method').val()
			},
			'dataSrc': function (json) {
				$('#totalIncome').html(json.totalIncome);
				$('#manualIncome').html(json.manualIncome);
				$('#paypalIncome').html(json.paypalIncome);
				$('#xenditIncome').html(json.xenditIncome);
				$('#midtransIncome').html(json.midtransIncome);

				$('#paymentSuccess').html(json.paymentSuccess);
				$('#paymentPending').html(json.paymentPending);
				$('#paymentFailed').html(json.paymentFailed);
				$('#paymentExpired').html(json.paymentExpired);

				doneLoading();
				return json.data;
			}
		},
		'columns': [{
				data: 'no'
			},
			{
				data: 'action'
			},
			{
				data: 'paymentMethod'
			},
			{
				data: 'paymentState'
			},
			{
				data: 'status'
			},
			{
				data: 'name'
			},
			{
				data: 'email'
			}
		]
	});
	const mdlPaymentDetail = function (id, batch_id) {
		$('#mdlChecked_id').val(id);

		$("#modalPaymentContent").html(
			`<center class="py-5"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading ...</center>`
		);

		$('#mdlPaymentDetail').modal('show')

		jQuery.ajax({
			url: "<?= site_url('admin/getDetailPayment') ?>",
			type: 'POST',
			data: {
				user_id: id,
				batch_id: batch_id
			},
			success: function (data) {
				$("#modalPaymentContent").html(data);
			}
		});
	}
	const showMdlParticipantDetail = id => {
		$('#mdlChecked_id').val(id);

		$("#modalParticipantContent").html(
			`<center class="py-5"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading ...</center>`
		);

		$('#mdlParticipantDetail').modal('show')

		jQuery.ajax({
			url: "<?= site_url('admin/getDetailParticipant') ?>",
			type: 'POST',
			data: {
				user_id: id
			},
			success: function (data) {
				$("#modalParticipantContent").html(data);
			}
		});
	}

	function doneLoading() {
		$('#searchBtn').prop("disabled", false);
		// add spinner to button
		$('#searchBtn').html(
			`<i class="bi-search"></i>&nbsp&nbspSearch`
		);
	}

	const mdlPaymentDetailVerif = function (user_id, id, img) {
		$('#evidance').prop('src', img);
		$('.mdlVerif_id').val(id);
		$('.mdlVerif_userid').val(user_id);
		$('#mdlPaymentDetailVerif').modal('show')
	}

	function btnSearch() {
		$('#searchBtn').prop("disabled", true);
		// add spinner to button
		$('#searchBtn').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		table.ajax.reload();
	}

	function verifData() {
		var id = $('.mdlVerif_id').val();
		var user_id = $('.mdlVerif_userid').val();

		$('#verifBtn').prop("disabled", true);
		// add spinner to button
		$('#verifBtn').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		jQuery.ajax({
			url: "<?= site_url('api/payments/verificationPayment') ?>",
			type: 'POST',
			data: {
				id: id,
				user_id: user_id
			},
			success: function (data) {
				$('#verifBtn').prop("disabled", false);
				$('#verifBtn').html(`Verified`);

				$('#mdlPaymentDetailVerif').modal('hide');

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
					title: "Succesfuly verification payment"
				})

				table.ajax.reload();
			},
			error: function (xhr, ajaxOptions, thrownError) {

				table.ajax.reload();

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
					icon: 'error',
					title: thrownError
				})
			}
		});
	}

	function rejectData() {
		var id = $('.mdlVerif_id').val();
		var user_id = $('.mdlVerif_userid').val();

		$('#rejectBtn').prop("disabled", true);
		// add spinner to button
		$('#rejectBtn').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		jQuery.ajax({
			url: "<?= site_url('api/payments/rejectedPayment') ?>",
			type: 'POST',
			data: {
				id: id,
				user_id: user_id
			},
			success: function (data) {
				$('#rejectBtn').prop("disabled", false);
				$('#rejectBtn').html(`Reject`);

				$('#mdlPaymentDetailVerif').modal('hide');

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
					title: "Succesfuly rejected payment"
				})

				table.ajax.reload();
			},
			error: function (xhr, ajaxOptions, thrownError) {

				table.ajax.reload();

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
					icon: 'error',
					title: thrownError
				})
			}
		});
	}

	function pendingData() {
		var id = $('.mdlVerif_id').val();
		var user_id = $('.mdlVerif_userid').val();

		$('#pendingBtn').prop("disabled", true);
		// add spinner to button
		$('#pendingBtn').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		jQuery.ajax({
			url: "<?= site_url('api/payments/pendingPayment') ?>",
			type: 'POST',
			data: {
				id: id,
				user_id: user_id
			},
			success: function (data) {
				$('#pendingBtn').prop("disabled", false);
				$('#pendingBtn').html(`Pending`);

				$('#mdlPaymentDetailVerif').modal('hide');

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
					title: "Succesfuly set payment to pending"
				})

				table.ajax.reload();
			},
			error: function (xhr, ajaxOptions, thrownError) {

				table.ajax.reload();

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
					icon: 'error',
					title: thrownError
				})
			}
		});
	}

	function cancelData() {
		var id = $('.mdlVerif_id').val();
		var user_id = $('.mdlVerif_userid').val();

		$('#cancelBtn').prop("disabled", true);
		// add spinner to button
		$('#cancelBtn').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		jQuery.ajax({
			url: "<?= site_url('api/payments/cancelPayment') ?>",
			type: 'POST',
			data: {
				id: id,
				user_id: user_id
			},
			success: function (data) {
				$('#cancelBtn').prop("disabled", false);
				$('#cancelBtn').html(`Cancel`);

				$('#mdlPaymentDetailVerif').modal('hide');

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
					title: "Succesfuly set payment to cancel"
				})

				table.ajax.reload();
			},
			error: function (xhr, ajaxOptions, thrownError) {

				table.ajax.reload();

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
					icon: 'error',
					title: thrownError
				})
			}
		});
	}

</script>
