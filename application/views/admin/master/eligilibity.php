<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Master Eligilibity Countries
				<button type="button" class="btn btn-primary btn-sm float-end me-2" data-bs-toggle="modal"
					data-bs-target="#tambah">Add new Master Eligilibity Countries</button>
				<a class="btn btn-outline-secondary btn-sm float-end me-2" style="margin-right: 10px;"
					href="<?= site_url('master/faq'); ?>">
					Back
				</a>
			</h1>
			<p class="docs-page-header-text">Manage Master Eligilibity Countries page contents.</p>
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
							<th width="10%"></th>
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
							<td>
								<button type="button" class="btn btn-info btn-xs" data-bs-toggle="modal"
									data-bs-target="#edit-<?= $val->id;?>">edit</button>
								<button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal"
									data-bs-target="#delete-<?= $val->id;?>">delete</button>
							</td>
							<td><?= $val->nationality;?></td>
							<td><?= $val->continent;?></td>
							<td><?= $val->type_visa;?></td>
							<td><?= $val->issued_from;?></td>
						</tr>

						<!-- Modal -->
						<div id="edit-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="add" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
								role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Edit Eligilibity Countries</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('api/master/editMasterEligilibity');?>" method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>" required>

											<div class="mb-3">
												<label for="inputSubject" class="form-label">Nationality</label>
												<input class="form-control form-control-sm" type="text"
													name="nationality" value="<?= $val->nationality;?>" required>
											</div>

											<div class="mb-3">
												<label for="inputSubject" class="form-label">Continent</label>
												<input class="form-control form-control-sm" type="text" name="continent"
													value="<?= $val->continent;?>" required>
											</div>

											<div class="mb-3">
												<label for="inputSubject" class="form-label">Type of Visa</label>
												<input class="form-control form-control-sm" type="text" name="type_visa"
													value="<?= $val->type_visa;?>" required>
											</div>

											<div class="mb-3">
												<label for="inputSubject" class="form-label">Issued from</label>
												<input class="form-control form-control-sm" type="text"
													name="issued_from" value="<?= $val->issued_from;?>" required>
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
										<form action="<?= site_url('api/master/deleteMasterEligilibity');?>"
											method="post" class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<p>Are you sure want to delete this Eligilibity Countries?</p>
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
				<h4 class="modal-title" id="detailUserTitle">Add new Master Eligilibity Countries</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/master/addMasterEligilibity');?>" method="post"
					class="js-validate need-validate" novalidate>

					<div class="mb-3">
						<label for="inputSubject" class="form-label">Nationality</label>
						<input class="form-control form-control-sm" type="text" name="nationality"
							placeholder="Nationality" required>
					</div>

					<div class="mb-3">
						<label for="inputSubject" class="form-label">Continent</label>
						<input class="form-control form-control-sm" type="text" name="continent" placeholder="Continent"
							required>
					</div>

					<div class="mb-3">
						<label for="inputSubject" class="form-label">Type of Visa</label>
						<input class="form-control form-control-sm" type="text" name="type_visa"
							placeholder="Type of Visa" required>
					</div>

					<div class="mb-3">
						<label for="inputSubject" class="form-label">Issued from</label>
						<input class="form-control form-control-sm" type="text" name="issued_from"
							placeholder="Issued from" required>
					</div>

					<div class="modal-footer px-0 pb-0">
						<button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary btn-sm">Add new</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
