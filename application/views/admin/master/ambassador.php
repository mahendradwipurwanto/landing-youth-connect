<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Ambassador
				<button type="button" class="btn btn-primary btn-sm float-end me-2" data-bs-toggle="modal"
					data-bs-target="#tambah">Add new Ambassador</button>
				</a>
			</h1>
			<p class="docs-page-header-text">Manage all of your ambassador.</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered w-100 dataTables" id="table">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Action</th>
							<th>Name</th>
							<th>Referral Code</th>
							<th>Affiliate Participants</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>

						<?php if(!empty($ambassador)):?>
						<?php $no = 1; foreach($ambassador as $key => $val):?>
						<tr>
							<td><?= $no++?></td>
							<td class="align-items-center">
								<button type="button" class="btn btn-info btn-xs" data-bs-toggle="modal"
									data-bs-target="#edit-<?= $val->id;?>">edit</button>
								<button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal"
									data-bs-target="#delete-<?= $val->id;?>">delete</button>
							</td>
							<td><?= $val->fullname;?></td>
							<td><?= $val->referral_code;?></td>
							<td><?= $val->affiliate;?> participants</td>
							<td>
								<?php if($val->status == 1):?>
								<span class="badge bg-success">active</span>
								<?php else:?>
								<span class="badge bg-secondary">in-active</span>
								<?php endif;?>
							</td>
						</tr>

						<!-- Modal -->
						<div id="edit-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="add" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
								role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Edit Ambassador</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('api/master/editAmbassador');?>" method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>" required>

											<div class="row">
												<div class="col">
													<div class="mb-3">
														<label for="validationValidInput1"
															class="form-label">Name</label>
														<input type="text" name="fullname" id="fullname-<?= $val->id;?>"
															class="form-control form-control-sm"
															value="<?= $val->fullname;?>" required>
													</div>
												</div>
												<div class="col">
													<div class="mb-3">
														<label for="validationValidInput1" class="form-label">Referral
															Code</label>
														<div class="input-group input-group-sm">
															<input type="text" name="referral_code"
																class="form-control inptRC-<?= $val->id;?>"
																id="validationValidInput1"
																value="<?= $val->referral_code;?> Code" required>
															<button type="button" onclick="generateRCEdit()"
																class="btn btn-sm btn-success input-group-text"
																id="basic-addon2">Generate</button>
														</div>
														<small class="text-secondary">generate or make kustom</small>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col">
													<div class="mb-3">
														<label for="validationValidInput1"
															class="form-label">Email</label>
														<input type="email" id="inptName" name="email"
															class="form-control form-control-sm"
															id="validationValidInput1" value="<?= $val->email;?>"
															required>
													</div>
												</div>
												<div class="col">
													<div class="mb-3">
														<label for="validationValidInput1"
															class="form-label">Institution</label>
														<input type="text" id="inptName" name="institution"
															class="form-control form-control-sm"
															id="validationValidInput1" value="<?= $val->institution;?>"
															required>
													</div>
												</div>
											</div>

											<div class="mb-3">
												<label for="validationValidInput1" class="form-label">Occupation</label>
												<input type="text" id="inptName" name="occupation"
													class="form-control form-control-sm" id="validationValidInput1"
													value="<?= $val->occupation;?>" required>
											</div>
											<div class="mb-3">
												<label for="validationValidInput1"
													class="form-label">Nationality</label>

												<div class="tom-select-custom">
													<select class="js-select form-select form-select-sm"
														autocomplete="off" id="validationFormNationality"
														name="nationality"
														data-hs-tom-select-options='{"placeholder": "Choose Nationality..."}'
														required>
														<?php if(!empty($countries)):?>
														<?php foreach($countries as $k => $v):?>
														<option value="<?= $v->num_code;?>"
															<?= isset($val->nationality) ? ($val->nationality == $v->num_code ? 'selected' : '') : '';?>>
															<?= $v->en_short_name;?>
														</option>
														<?php endforeach;?>
														<?php endif;?>
													</select>
												</div>
											</div>
											<!-- Form Group -->
											<div class="mb-3">
												<label for="validationFormWhatsapp" class="form-label">Whatsapp
													Number</label>

												<div class="js-form-message">
													<input type="text" class="form-control form-control-sm"
														onkeypress="return isNumberKey(event)" name="whatsapp"
														id="validationFormWhatsapp" value="<?= $val->whatsapp;?>"
														aria-label="Whatsapp Number" required
														data-msg="Please enter a valid whatsapp number.">
													<span class="form-text"><b>Example:</b> +628123456789 </span>
													<span class="invalid-feedback">Please enter a valid whatsapp
														number.</span>
												</div>
											</div>
											<!-- End Form Group -->
											<div class="mb-3">
												<label for="validationValidInput1" class="form-label">Instagram</label>
												<div class="input-group input-group-sm">
													<span class="input-group-text"
														id="basic-addon1">https://instagram.com/</span>
													<input type="text" id="inptName" name="instagram"
														class="form-control form-control-sm" id="validationValidInput1"
														value="<?= $val->instagram;?>" required>
												</div>
											</div>
											<div class="mb-3">
												<label for="validationValidInput1" class="form-label">Tiktok</label>
												<div class="input-group input-group-sm">
													<span class="input-group-text"
														id="basic-addon1">https://tiktok.com/@</span>
													<input type="text" id="inptName" name="tiktok"
														class="form-control form-control-sm" id="validationValidInput1"
														value="<?= $val->tiktok;?>" required>
												</div>
											</div>

											<div class="mb-3">
												<label for="validationValidInput1" class="form-label">Address <small
														class="text-secondary">(optional)</small></label>
												<textarea type="text" id="inptName" name="address"
													class="form-control form-control-sm" id="validationValidInput1"
													value="<?= $val->address;?>" rows="3"></textarea>
											</div>

											<div class="mb-3 d-none">
												<label for="poster-announcements" class="form-label"
													class="form-label">Photo <small
														class="text-muted">(optional)</small>:</label>
												<figure>
													<img src="#" id="imgthumbnail" class="img-thumbnail img-fluid"
														alt="Thumbnail image"
														onerror="this.onerror=null;this.src='<?= base_url();?>assets/images/placeholder.jpg';">
												</figure>
												<div class="input-group">
													<input type="file" class="form-control imgprev" name="image"
														accept="image/*" id="poster-announcements">
												</div>
												<small class="text-muted">Max file size 1Mb</small>
											</div>

											<div class="modal-footer px-0 pb-0">
												<button type="button" class="btn btn-white btn-sm"
													data-bs-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-info btn-sm">Save
													Ambassador</button>
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
										<form action="<?= site_url('api/master/deleteAmbassador');?>" method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<p>Are you sure want to delete <b><?= $val->fullname;?></b>?</p>
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

						<script>
							function generateRCEdit() {
								const name = $('#fullname-' + "<?= $val->id; ?>").val()
								$.ajax({
									url: "<?= site_url('api/master/ajxGenRC')?>",
									method: 'POST',
									data: {
										name
									},
									success: function (res) {
										res = JSON.parse(res)
										$('.inptRC-' + "<?= $val->id; ?>").val(res.referral_code)
									}
								})
							}

						</script>

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
				<h4 class="modal-title" id="detailUserTitle">Add new Ambassador</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/master/addAmbassador');?>" method="post"
					class="js-validate need-validate" novalidate>

					<div class="row">
						<div class="col">
							<div class="mb-3">
								<label for="validationValidInput1" class="form-label">Name</label>
								<input type="text" id="inptNameAdd" name="fullname" class="form-control form-control-sm"
									id="validationValidInput1" placeholder="Name" required>
							</div>
						</div>
						<div class="col">
							<div class="mb-3">
								<label for="validationValidInput1" class="form-label">Referral Code</label>
								<div class="input-group input-group-sm">
									<input type="text" name="referral_code" class="form-control inptRC"
										id="validationValidInput1" placeholder="referral Code" required>
									<button type="button" onclick="generateRC()"
										class="btn btn-sm btn-success input-group-text"
										id="basic-addon2">Generate</button>
								</div>
								<small class="text-secondary">generate or make kustom</small>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="mb-3">
								<label for="validationValidInput1" class="form-label">Email</label>
								<input type="email" id="inptName" name="email" class="form-control form-control-sm"
									id="validationValidInput1" placeholder="Email" required>
							</div>
						</div>
						<div class="col">
							<div class="mb-3">
								<label for="validationValidInput1" class="form-label">Institution</label>
								<input type="text" id="inptName" name="institution" class="form-control form-control-sm"
									id="validationValidInput1" placeholder="Institution" required>
							</div>
						</div>
					</div>

					<div class="mb-3">
						<label for="validationValidInput1" class="form-label">Occupation</label>
						<input type="text" id="inptName" name="occupation" class="form-control form-control-sm"
							id="validationValidInput1" placeholder="Occupation" required>
					</div>
					<div class="mb-3">
						<label for="validationValidInput1" class="form-label">Nationality</label>

						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" autocomplete="off"
								id="validationFormNationality" name="nationality"
								data-hs-tom-select-options='{"placeholder": "Choose Nationality..."}' required>
								<?php if(!empty($countries)):?>
								<?php foreach($countries as $key => $val):?>
								<option value="<?= $val->num_code;?>">
									<?= $val->en_short_name;?>
								</option>
								<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					</div>
					<!-- Form Group -->
					<div class="mb-3">
						<label for="validationFormWhatsapp" class="form-label">Whatsapp Number</label>

						<div class="js-form-message">
							<input type="text" class="form-control form-control-sm"
								onkeypress="return isNumberKey(event)" name="whatsapp"
								id="validationFormWhatsapp" placeholder="Whatsapp Number" aria-label="Whatsapp Number"
								required data-msg="Please enter a valid whatsapp number."
								<?= isset($participants->whatsapp) ? 'value="'.$participants->whatsapp.'"' : '';?>>
							<span class="form-text"><b>Example:</b> +628123456789 </span>
							<span class="invalid-feedback">Please enter a valid whatsapp number.</span>
						</div>
					</div>
					<!-- End Form Group -->
					<div class="mb-3">
						<label for="validationValidInput1" class="form-label">Instagram</label>
						<div class="input-group input-group-sm">
							<span class="input-group-text" id="basic-addon1">https://instagram.com/</span>
							<input type="text" id="inptName" name="instagram" class="form-control form-control-sm"
								id="validationValidInput1" placeholder="Username" required>
						</div>
					</div>
					<div class="mb-3">
						<label for="validationValidInput1" class="form-label">Tiktok</label>
						<div class="input-group input-group-sm">
							<span class="input-group-text" id="basic-addon1">https://tiktok.com/@</span>
							<input type="text" id="inptName" name="tiktok" class="form-control form-control-sm"
								id="validationValidInput1" placeholder="Username" required>
						</div>
					</div>

					<div class="mb-3">
						<label for="validationValidInput1" class="form-label">Address <small
								class="text-secondary">(optional)</small></label>
						<textarea type="text" id="inptName" name="address" class="form-control form-control-sm"
							id="validationValidInput1" placeholder="Address" rows="3"></textarea>
					</div>

					<div class="mb-3 d-none">
						<label for="poster-announcements" class="form-label" class="form-label">Photo <small
								class="text-muted">(optional)</small>:</label>
						<figure>
							<img src="#" id="imgthumbnail" class="img-thumbnail img-fluid" alt="Thumbnail image"
								onerror="this.onerror=null;this.src='<?= base_url();?>assets/images/placeholder.jpg';">
						</figure>
						<div class="input-group">
							<input type="file" class="form-control imgprev" name="image" accept="image/*"
								id="poster-announcements">
						</div>
						<small class="text-muted">Max file size 1Mb</small>
					</div>

					<div class="modal-footer px-0 pb-0">
						<button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary btn-sm">Add new Ambassador</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	function generateRC() {
		var name = $('#inptNameAdd').val()
		$.ajax({
			url: "<?= site_url('api/master/ajxGenRC')?>",
			method: 'POST',
			data: {
				name
			},
			success: function (res) {
				console.log(res);
				res = JSON.parse(res)
				$('.inptRC').val(res.referral_code)
			}
		})
	}

</script>
