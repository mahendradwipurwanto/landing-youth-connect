<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Payments Batch
				<button type="button" class="btn btn-primary btn-sm float-end me-2" data-bs-toggle="modal"
					data-bs-target="#tambah"><i class="bi bi-plus me-2"></i> Add</button>
			</h1>
			<p class="docs-page-header-text">Manage payments batch for your programs.</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-hover table-striped w-100 dataTables" id="table">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Action</th>
							<th>Summit</th>
							<th>Description</th>
							<th>Amount</th>
							<th>Start Date</th>
							<th>End Date</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($payments_batch)):?>
						<?php $no = 1; foreach($payments_batch as $val):?>
						<tr>
							<td><?= $no++;?></td>
							<td>
								<button type="button" class="btn btn-info btn-xs" data-bs-toggle="modal"
									data-bs-target="#edit-<?= $val->id;?>">edit</button>
								<button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal"
									data-bs-target="#delete-<?= $val->id;?>">delete</button>
							</td>
							<td><?= $val->summit;?></td>
							<td><?= $val->description;?></td>
							<td>Rp. <?= number_format($val->amount);?> / $<?= number_format($val->amount_usd);?></td>
							<td><?= date("d F Y", $val->start_date);?> 23:59</td>
							<td><?= date("d F Y", $val->end_date);?> 23:59</td>
						</tr>

						<!-- Modal -->
						<div id="edit-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="add" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
								role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Edit payments batch</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('api/master/editPaymentBatch');?>" method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>" required>

											<div class="mb-3">
												<label for="inputSubject" class="form-label">Summit <small class="text-danger">*</small></label>
												<div class="row">
													<div class="col-sm-12 col-md-6">
														<input class="form-control form-control-sm" type="text" name="summit" value="<?= $val->summit;?>"
															required>
													</div>
													<div class="col-sm-12 col-md-6">
														<!-- Checkbox Switch -->
														<div class="form-check form-switch mt-2">
															<input type="checkbox" class="form-check-input" name="active" id="formSwitchActive-Edit-<?= $val->id;?>" <?= $val->active == 1 ? 'checked' : '';?>>
															<label class="form-check-label" for="formSwitchActive-Edit-<?= $val->id;?>">Active ?</label>
														</div>
														<!-- End Checkbox Switch -->
													</div>
												</div>
											</div>

											<div class="mb-3">
												<label for="inputDesc" class="form-label">Desc <small
														class="text-secondary">(optional)</small></label>
												<textarea class="form-control form-control-sm" type="text"
													id="inputDesc" rows="3"
													name="desc"><?= $val->description;?></textarea>
											</div>

											<div class="mb-3">
												<label for="inputAmount" class="form-label">Amount <small
														class="text-danger">*</small></label>
												<div class="row">
													<div class="col-6">
														<div class="input-group input-group-merge">
															<div class="input-group-prepend input-group-text"
																id="inputAmountGroup">
																Rp.
															</div>
															<input type="text" class="form-control" id="inputAmount"
																name="amount" value="<?= $val->amount;?>"
																aria-label="Mark Williams"
																aria-describedby="inputAmountGroup">
														</div>
													</div>
													<div class="col-6">
														<div class="input-group input-group-merge">
															<div class="input-group-prepend input-group-text"
																id="inputAmountGroup">
																$
															</div>
															<input type="text" class="form-control" id="inputAmount"
																name="amount_usd" value="<?= $val->amount_usd;?>"
																aria-label="Mark Williams"
																aria-describedby="inputAmountGroup">
														</div>
													</div>
												</div>
											</div>

											<div class="mb-3 row">
												<div class="col-6">
													<label class="form-label" for="formPeriodeMulai">Start date</label>
													<input type="datetime-local" name="start_date" id="formPeriodeMulai"
														class="form-control form-control-sm"
														value="<?= gmdate("Y-m-d\TH:i", $val->start_date);?>" required>
												</div>
												<div class="col-6">
													<label class="form-label" for="formPeriodeSelesai">End date</label>
													<input type="datetime-local" name="end_date" id="formPeriodeSelesai"
														class="form-control form-control-sm"
														value="<?= gmdate("Y-m-d\TH:i", $val->end_date);?>" required>
												</div>
											</div>

											<div class="modal-footer px-0 pb-0">
												<button type="button" class="btn btn-white btn-sm"
													data-bs-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-info btn-sm">Save
													Changes</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div id="delete-<?= $val->id; ?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="delete" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
								role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Delete</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('api/master/deletePaymentBatch');?>" method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<p>Are you sure want to delete <b><?= $val->summit;?></b>?</p>
											<div class="modal-footer px-0 pb-0">
												<button type="button" class="btn btn-white btn-sm"
													data-bs-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-danger btn-sm">Yes</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="detailUserTitle">Add new payments batch</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/master/addPaymentBatch');?>" method="post"
					class="js-validate need-validate" novalidate>

					<div class="mb-3">
						<div class="row">
							<label for="inputSubject" class="form-label">Summit <small class="text-danger">*</small></label>
							<div class="col-sm-12 col-md-6">
								<input class="form-control form-control-sm" type="text" name="summit" placeholder="Summit"
									required>
							</div>
							<div class="col-sm-12 col-md-6">
								<!-- Checkbox Switch -->
								<div class="form-check form-switch mt-2">
									<input type="checkbox" class="form-check-input" name="active" id="formSwitchActive">
									<label class="form-check-label" for="formSwitchActive">Active ?</label>
								</div>
								<!-- End Checkbox Switch -->
							</div>
						</div>
					</div>

					<div class="mb-3">
						<label for="inputDesc" class="form-label">Desc <small
								class="text-secondary">(optional)</small></label>
						<textarea class="form-control form-control-sm" type="text" id="inputDesc" rows="3" name="desc"
							placeholder="Description"></textarea>
					</div>

					<div class="mb-3">
						<label for="inputAmount" class="form-label">Amount <small class="text-danger">*</small></label>
						<div class="row">
							<div class="col-6">
								<div class="input-group input-group-merge">
									<div class="input-group-prepend input-group-text" id="inputAmountGroup">
										Rp.
									</div>
									<input type="text" class="form-control" id="inputAmount" name="amount"
										placeholder="Amount" aria-label="Mark Williams"
										aria-describedby="inputAmountGroup">
								</div>
							</div>
							<div class="col-6">
								<div class="input-group input-group-merge">
									<div class="input-group-prepend input-group-text" id="inputAmountGroup">
										$
									</div>
									<input type="text" class="form-control" id="inputAmount" name="amount_usd"
										placeholder="Amount" aria-label="Mark Williams"
										aria-describedby="inputAmountGroup">
								</div>
							</div>
						</div>
					</div>

					<div class="mb-3 row">
						<div class="col-6">
							<label class="form-label" for="formPeriodeMulai">Start date</label>
							<input type="datetime-local" name="start_date" id="formPeriodeMulai"
								class="form-control form-control-sm" value="<?= date('Y-m-d');?>" required>
						</div>
						<div class="col-6">
							<label class="form-label" for="formPeriodeSelesai">End date</label>
							<input type="datetime-local" name="end_date" id="formPeriodeSelesai"
								class="form-control form-control-sm" value="<?= date('Y-m-d', strtotime('+1 week'));?>"
								required>
						</div>
					</div>

					<div class="modal-footer px-0 pb-0">
						<button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary btn-sm">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
	// Restricts input for the given textbox to the given inputFilter.
	function setInputFilter(textbox, inputFilter) {
		["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (
			event) {
			textbox.addEventListener(event, function () {
				if (inputFilter(this.value)) {
					this.oldValue = this.value;
					this.oldSelectionStart = this.selectionStart;
					this.oldSelectionEnd = this.selectionEnd;
				} else if (this.hasOwnProperty("oldValue")) {
					this.value = this.oldValue;
					this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
				} else {
					this.value = "";
				}
			});
		});
	}

	// Install input filters Tambah Hp Pegawai.
	setInputFilter(document.getElementById("inputAmount"), function (value) {
		return /^\d*$/.test(value);
	});

</script>
