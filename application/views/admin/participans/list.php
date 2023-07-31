<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Participans
				<div class="btn-group float-end">
					<button class="btn btn-sm btn-success dropdown-toggle" type="button"
						id="dropdownMenuButtonClickAnimation" data-bs-toggle="dropdown" aria-expanded="false"
						data-bs-dropdown-animation>
						<i class="bi-file-earmark-excel-fill"></i>&nbsp;
						Export
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonClickAnimation">
						<a class="dropdown-item" href="<?= site_url('admin/export-participants/0')?>" target="_blank">All</a>
						<a class="dropdown-item" href="<?= site_url('admin/export-participants/2')?>" target="_blank">Submitted</a>
						<a class="dropdown-item" href="<?= site_url('admin/export-participants/3')?>" target="_blank">Accepted</a>
						<a class="dropdown-item" href="<?= site_url('admin/export-participants/4')?>" target="_blank">Rejected</a>
					</div>
				</div>
			</h1>
			<p class="docs-page-header-text">List of all participans.</p>
		</div>
	</div>
</div>
<!-- End Page Header -->
<div class="row">
	<h3>Summary participants</h3>
	<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-body">
				<h6 class="card-subtitle mb-2">Total checked</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="counterChecked display-5 text-dark" id="totalChecked">0</span>
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
				<h6 class="card-subtitle mb-2">Total submited</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="js-counter display-5 text-dark" id="totalSubmitted">0</span>
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
				<h6 class="card-subtitle mb-2">Total verifed</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="js-counter display-5 text-dark" id="totalVerif">0</span>
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
				<h6 class="card-subtitle mb-2">Total user</h6>

				<div class="row align-items-center gx-2">
					<div class="col">
						<span class="js-counter display-5 text-dark" id="totalUser">0</span>
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
				<h4 class="card-header-title">Filter Participants Data</h4>
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

					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Phone</label>
						<input type="text" id="filter_number" class="form-control form-control-sm"
							placeholder="Phone Filter">
					</div>
					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Account</label>
						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" id="filter_verified" autocomplete="off"
								data-hs-tom-select-options='{"placeholder": "All Account Status", "hideSearch": true}'>
								<option value="0">All Account Status</option>
								<option value="1">Verified</option>
								<option value="3">Not Verified/unverified</option>
								<option value="2">Suspend</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Steps</label>
						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" id="filter_step" autocomplete="off"
								data-hs-tom-select-options='{"placeholder": "All Steps Status", "hideSearch": true}'>
								<option value="0">All Steps Status</option>
								<option value="1">(1) Personal Data</option>
								<option value="2">(2) Others</option>
								<option value="3">(3) Question</option>
								<option value="4">(4) Programs</option>
								<option value="5">(5) Self Photo</option>
								<option value="6">(6) Payment & Agreement</option>
								<option value="7">Waiting for review</option>
								<option value="8">Reviewed</option>
							</select>
						</div>
					</div>
					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Submited</label>
						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" id="filter_submited" autocomplete="off"
								data-hs-tom-select-options='{"placeholder": "All Submited Status", "hideSearch": true}'>
								<option value="0">All Submited Status</option>
								<option value="2">Submited</option>
								<option value="1">Not Submited</option>
							</select>
						</div>
					</div>
					<div class="col-sm mb-2 mb-sm-0">
						<label for="">Checked</label>
						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" id="filter_checked" autocomplete="off"
								data-hs-tom-select-options='{"placeholder": "All Checked Status", "hideSearch": true}'>
								<option value="0">All Checked Status</option>
								<option value="3">Checked/Accepted</option>
								<option value="2">Not Checked</option>
								<option value="4">Rejected</option>
							</select>
						</div>
					</div>
					<div class="col-sm mb-2 mb-sm-0">
						<button class="btn btn-sm btn-primary mt-4" type="button" id="searchBtn"
							onclick="btnSearch()"><i class="bi-search"></i>&nbsp&nbspSearch</button>
					</div>
				</div>
			</div>
			<div class="card-body pb-0">
				<div class="alert alert-soft-info small">
					<ul class="list-unstyled mb-0">
						<li><i class="bi bi-eye me-2 text-success"></i> See participants submission data</li>
						<li><i class="bi bi-key me-2 text-warning"></i> Change participants password with generated
							password</li>
						<!-- <li><i class="bi bi-envelope me-2 text-danger"></i> Change participants email (<span
								class="text-danger">Don't change email without reaching participant</span>)</li> -->
						<li>
							<span class="text-info me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
									fill="currentColor" class="bi bi-envelope-check" viewBox="0 0 16 16">
									<path
										d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
									<path
										d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
								</svg>
							</span> Verified email participants that had problem with <i>"verified email"</i> process
						</li>
						<li><i class="bi bi-files me-2 text-success"></i> Travel documents participant</li>
						<li><i class="bi bi-files me-2 text-info"></i> LOA documents participant</li>
					</ul>
				</div>
			</div>
			<div class="card-header py-3">
				<h4 class="card-header-title">Participans Data</h4>
			</div>
			<div class="card-body">
				<!-- End Row -->
				<table id="dataTable" class="table table-borderless table-thead-bordered nowrap w-100">
					<thead class="thead-light">
						<tr>
							<th scope="col">No</th>
							<th scope="col">Action</th>
							<th scope="col">Name</th>
							<th scope="col">Email</th>
							<th scope="col">Step</th>
							<th scope="col">Account Status</th>
							<th scope="col">Submit Status</th>
							<th scope="col">Check Status</th>
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

<!-- Modal -->
<div class="modal fade" id="mdlDocuments" tabindex="-1" aria-labelledby="mdlDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdlDeleteLabel">Travel Documents</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modalDocumentsContent">
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="mdlDocumentsLoa" tabindex="-1" aria-labelledby="mdlDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdlDeleteLabel">LOA Documents</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modalDocumentsLoaContent">
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
				<input type="hidden" name="id" class="mdlChecked_id">
				<button type="button" id="checkBtnDocuments" class="btn btn-soft-success btn-sm" onclick="checkDataDocuments()">Check</button>
				<button type="button" id="rejectBtnDocuments" class="btn btn-soft-danger btn-sm" onclick="rejectDataDocuments()">Reject</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="mdlChangePass" tabindex="-1" aria-labelledby="mdlDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdlDeleteLabel">Change Password</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">
				<div class="text-center">Are you sure to change the password? new passwords: <span
						class="mdlChangePass_passLabel" style="font-weight: bold;"></span></div>
				<small class="text-secondary">Participants will receive email, regarding of these password
					changaes</small>
			</div>

			<div class="modal-footer">
				<form action="<?= site_url('api/master/changeParticipanPassword')?> " method="post"
					class="js-validate need-validate" novalidate>
					<input type="hidden" name="id" id="mdlChangePass_id">
					<input type="hidden" name="pass" id="mdlChangePass_pass">
					<button type="button" class="btn btn-outline-secondary btn-sm"
						data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-soft-success btn-sm">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="mdlChangeEmail" tabindex="-1" aria-labelledby="mdlDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdlDeleteLabel">Change Email</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<form action="<?= site_url('api/master/changeParticipanEmail')?> " method="post"
					class="js-validate need-validate" novalidate>
					<input type="hidden" name="id" id="mdlChangeEmail_id">
					<div class="mb-3">
						<label for="inputEmailChange" class="form-label">New participants email</label>
						<input type="email" class="form-control form-control-sm" name="email" id="inputEmailChange"
							placeholder="New email" required>
						<small class="text-secondary">Participants will receive email, regarding of these password
							changaes on his/her new email</small>
					</div>

					<div class="modal-footer px-0 mb-0 pb-0">
						<button type="button" class="btn btn-outline-secondary btn-sm"
							data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-soft-success btn-sm">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="mdlChecked" tabindex="-1" aria-labelledby="mdlDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdlDeleteLabel">Checked/Accepted Participant</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body text-center">
				<div class="text-center">Are you sure to checked/accepted this participant submission?</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
				<input type="hidden" name="id" class="mdlChecked_id">
				<button type="button" id="checkBtn" class="btn btn-soft-success btn-sm" onclick="checkData()">Check</button>
				<button type="button" id="rejectBtn" class="btn btn-soft-danger btn-sm" onclick="rejectData()">Reject</button>

				<!-- <form action="<?= site_url('api/admin/checkedParticipant')?> " method="post"
					class="js-validate need-validate" novalidate>
					<input type="hidden" name="id" class="mdlChecked_id">
					<button type="submit" class="btn btn-soft-success btn-sm">Check</button>
				</form>
				<form action="<?= site_url('api/admin/rejectedParticipant')?> " method="post"
					class="js-validate need-validate" novalidate>
					<input type="hidden" name="id" class="mdlChecked_id">
					<button type="submit" class="btn btn-soft-danger btn-sm">Rejected</button>
				</form> -->
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="mdlVerified" tabindex="-1" aria-labelledby="mdlDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdlDeleteLabel">Verified Participant account</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body text-center">
				<div class="text-center">Are you sure to Verified this participant email?</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
				<form action="<?= site_url('api/admin/activatedParticipant')?> " method="post"
					class="js-validate need-validate" novalidate>
					<input type="hidden" name="id" class="mdlVerified_id">
					<button type="submit" class="btn btn-soft-success btn-sm">Check</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<script>
	var table = $('#dataTable').DataTable({
		'processing': true,
		'serverSide': true,
		'destroy': true,
		'ordering': false,
		'searching': false,
		'scrollX': true,
		'responsive': true,
		'serverMethod': 'post',
		'ajax': {
			'url': "<?= site_url('admin/getAjaxParticipant')?>",
			'data': function (d) {
				d.filterEmail = $('#filter_email').val()
				d.filterName = $('#filter_name').val()
				d.filterNumber = $('#filter_number').val()
				d.filterVerified = $('#filter_verified').val()
				d.filterSubmited = $('#filter_submited').val()
				d.filterChecked = $('#filter_checked').val()
				d.filterStep = $('#filter_step').val();
			},
			'dataSrc': function (json) {
				$('#totalChecked').html(json.totalChecked);
				$('#totalSubmitted').html(json.totalSubmitted);
				$('#totalVerif').html(json.totalVerif);
				$('#totalUser').html(json.totalUser);

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
				data: 'name'
			},
			{
				data: 'email'
			},
			{
				data: 'step'
			},
			{
				data: 'accountStatus'
			},
			{
				data: 'submitStatus'
			},
			{
				data: 'checkStatus'
			}
		]
	});
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
	const showMdlDocuments = id => {
		$('#mdlChecked_id').val(id);

		$("#modalDocumentsContent").html(
			`<center class="py-5"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading ...</center>`
		);

		$('#mdlDocuments').modal('show')

		jQuery.ajax({
			url: "<?= site_url('admin/getDetailDocuments') ?>",
			type: 'POST',
			data: {
				user_id: id
			},
			success: function (data) {
				$("#modalDocumentsContent").html(data);
			}
		});
	}
	const showMdlLoa = id => {
		$('.mdlChecked_id').val(id);

		$("#modalDocumentsLoaContent").html(
			`<center class="py-5"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading ...</center>`
		);

		$('#mdlDocumentsLoa').modal('show')

		jQuery.ajax({
			url: "<?= site_url('admin/getDetailDocumentsLoa') ?>",
			type: 'POST',
			data: {
				user_id: id
			},
			success: function (data) {
				$("#modalDocumentsLoaContent").html(data);
			}
		});
	}

	const showMdlChangePassword = id => {
		const pass = Math.random().toString(36).slice(-8);
		$('#mdlChangePass_id').val(id);
		$('#mdlChangePass_pass').val(pass);
		$('.mdlChangePass_passLabel').html(pass);
		$('#mdlChangePass').modal('show')
	}

	const showMdlChangeEmail = id => {
		$('#mdlChangeEmail_id').val(id);
		$('#mdlChangeEmail').modal('show')
	}

	const showMdlChecked = id => {
		$('.mdlChecked_id').val(id);
		$('#mdlChecked').modal('show')
	}

	const showMdlVerified = id => {
		$('.mdlVerified_id').val(id);
		$('#mdlVerified').modal('show')
	}

	function doneLoading() {
		$('#searchBtn').prop("disabled", false);
		// add spinner to button
		$('#searchBtn').html(
			`<i class="bi-search"></i>&nbsp&nbspSearch`
		);
	}

	function btnSearch() {
		$('#searchBtn').prop("disabled", true);
		// add spinner to button
		$('#searchBtn').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		table.ajax.reload();
	}

	function checkData() {
		var id = $('.mdlChecked_id').val();

		$('#checkBtn').prop("disabled", true);
		// add spinner to button
		$('#checkBtn').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		jQuery.ajax({
			url: "<?= site_url('api/admin/checkedParticipant') ?>",
			type: 'POST',
			data: {
				id: id
			},
			success: function (data) {
				$('#checkBtn').prop("disabled", false);
				$('#checkBtn').html(`Check`);

				$('#mdlChecked').modal('hide');

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
					title: "Succesfuly checked/accepted participant submission"
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
		var id = $('.mdlChecked_id').val();

		$('#rejectBtn').prop("disabled", true);
		// add spinner to button
		$('#rejectBtn').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		jQuery.ajax({
			url: "<?= site_url('api/admin/rejectedParticipant') ?>",
			type: 'POST',
			data: {
				id: id
			},
			success: function (data) {
				$('#rejectBtn').prop("disabled", false);
				$('#rejectBtn').html(`Reject`);

				$('#mdlChecked').modal('hide');

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
					title: "Succesfuly rejected participant submission"
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

	function checkDataDocuments() {
		var id = $('.mdlChecked_id').val();

		$('#checkBtnDocuments').prop("disabled", true);
		// add spinner to button
		$('#checkBtnDocuments').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		jQuery.ajax({
			url: "<?= site_url('api/admin/checkedParticipantDocumentsLoa') ?>",
			type: 'POST',
			data: {
				id: id
			},
			success: function (data) {
				$('#checkBtnDocuments').prop("disabled", false);
				$('#checkBtnDocuments').html(`Check`);

				$('#mdlDocumentsLoa').modal('hide');

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
					title: "Succesfuly checked/accepted participant submission"
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

	function rejectDataDocuments() {
		var id = $('.mdlChecked_id').val();

		$('#rejectBtnDocuments').prop("disabled", true);
		// add spinner to button
		$('#rejectBtnDocuments').html(
			`<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span> loading...`
		);

		jQuery.ajax({
			url: "<?= site_url('api/admin/rejectedParticipantDocumentsLoa') ?>",
			type: 'POST',
			data: {
				id: id
			},
			success: function (data) {
				$('#rejectBtnDocuments').prop("disabled", false);
				$('#rejectBtnDocuments').html(`Reject`);

				$('#mdlDocumentsLoa').modal('hide');

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
					title: "Succesfuly rejected participant submission"
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
