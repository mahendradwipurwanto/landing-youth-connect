<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Database</h1>
			<p class="docs-page-header-text">Manage all configuration</p>
		</div>
	</div>
</div>
<!-- Card -->
<div class="row">
	<div class="col-9">
		<div class="card card-body">
			<h4>Reset Database</h4>
			<form action="<?= site_url('api/website/resetDatabase');?>" method="post"
				class="js-validate needs-validation" novalidate>
				<!-- Table -->
				<table class="table table-bordered">
					<thead class="bg-soft-primary align-middle">
						<tr>
							<th colspan="2" scope="col" class="text-center">
								<!-- Checkbox -->
								<div class="form-check flex-center">
									<input type="checkbox" id="select-all" class="form-check-input">
								</div>
								<!-- End Checkbox -->
							</th>
							<th scope="col" class="fw-bold ">Table</th>
							<th scope="col" class="fw-bold ">Data`s</th>
							<th scope="col" class="fw-bold">Join</th>
							<th scope="col" class="fw-bold">FK</th>
							<th scope="col" class="fw-bold">Condition</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($reset_schema)):?>
						<?php foreach($reset_schema as $key => $val):?>
						<tr class="thead-light align-middle">
							<th colspan="2" class="text-center">
								<!-- Checkbox -->
								<div class="form-check flex-center">
									<input type="checkbox" id="check-group" name="check-group[<?= $key;?>]"
										onclick="checkGroupCheckboxes(`<?= $key;?>`, event)"
										class="form-check-input check">
								</div>
								<!-- End Checkbox -->
							</th>
							<th colspan="4">cluster <b><?= $key;?></b></th>
						</tr>
						<?php $no = 0; foreach($val["data"] as $k => $v):?>
						<tr class="align-middle">
							<?php if($no == 0):?>
							<td rowspan="<?= $val["rows"];?>"></td>
							<?php endif;?>
							<td scope="row" class="text-center">
								<!-- Checkbox -->
								<div class="form-check flex-center">
									<input type="checkbox" class="form-check-input check group-<?= $key;?>" name="check[<?= $v['table'];?>]">
								</div>
								<!-- End Checkbox -->
							</td>
							<td><?= $v["table"];?></td>
							<td class="text-center"><b><?= $v["data"];?></b></td>
							<td><input class="form-control form-control-sm" type="text" name="join[<?= $v['table'];?>]" value="<?= $v["join"];?>"></td>
							<td><input class="form-control form-control-sm" type="text" name="fk[<?= $v['table'];?>]" value="<?= $v["fk"];?>"></td>
							<td><input class="form-control form-control-sm" type="text" name="condition[<?= $v['table'];?>]" value="<?= $v["condition"];?>">
							</td>
						</tr>
						<?php $no++; endforeach;?>
						<?php endforeach;?>
						<?php else:?>
						<tr class="align-middle">
							<th colspan="6">No table found</th>
						</tr>
						<?php endif;?>
					</tbody>
				</table>
				<!-- End Table -->
				<button type="button" class="btn btn-danger btn-sm float-end mt-4" data-bs-toggle="modal"
					data-bs-target="#resetDatabase">Reset database</button>

				<!-- Modal -->
				<div id="resetDatabase" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="resetDatabaseTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="resetDatabaseTitle">Reset database</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<p>Are you sure want to reset database? with this rules</p>
								<!-- List -->
								<ul class="list-unstyled border list-py-1 p-2"
									style="max-height: 200px; overflow: auto;">
									<?php if(!empty($reset_schema)):?>
									<?php foreach($reset_schema as $key => $val):?>
									<li><b><?= $key;?></b>
										<ul>
											<?php foreach($val["data"] as $k => $v):?>
											<li><?= $v["table"];?> <i class="text-danger bi-x"></i></li>
											<?php endforeach;?>
										</ul>
									</li>
									<?php endforeach;?>
									<?php else:?>
									<li>No table found</li>
									<?php endif;?>
								</ul>
								<!-- End List -->
								<small class="text-danger"><i>You can redo this process, please re check the rules
										before continue</i></small>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-white" data-bs-dismiss="modal">Nevermind</button>
								<button type="submit" class="btn btn-danger">Yes! I want to reset</button>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->
			</form>
		</div>
	</div>
	<div class="col-3">
		<!-- Card -->
		<a class="card card-sm card-transition" target="_blank" href="<?= base_url(); ?>ngodingin.php"
			data-aos="fade-up">
			<img class="card-img p-2" src="<?= base_url(); ?>assets/svg/design-system/docs-divider.svg"
				alt="Image Description">
			<div class="card-body">
				<h4 class="card-title text-inherit">Access Database</h4>
				<p class="card-text small text-body">Manage website database</p>
			</div>
		</a>
		<!-- End Card -->
	</div>
</div>
<!-- End Card -->


<script>
	// Get the "select all" checkbox element
	var selectAllCheckbox = document.getElementById('select-all');

	// Get all checkboxes
	var checkboxes = document.getElementsByClassName('check');

	// Add click event listener to the "select all" checkbox
	selectAllCheckbox.addEventListener('click', function (event) {
		// Iterate through all checkboxes
		for (var i = 0; i < checkboxes.length; i++) {
			checkboxes[i].checked = this.checked;
		}
	});

	// Add click event listener to each checkbox
	for (var i = 0; i < checkboxes.length; i++) {
		checkboxes[i].addEventListener('click', function (event) {
			var allChecked = true;

			// Check if all checkboxes are checked
			for (var j = 0; j < checkboxes.length; j++) {
				if (!checkboxes[j].checked) {
					allChecked = false;
					break;
				}
			}

			// Update "select all" checkbox state
			selectAllCheckbox.checked = allChecked;
		});
	}

	function checkGroupCheckboxes(group, event) {
		// Get all checkboxes
		var checkboxes = document.getElementsByClassName(`group-${group}`);

		// Iterate through all checkboxes
		for (var i = 0; i < checkboxes.length; i++) {
			if (event.target.checked) {
				checkboxes[i].checked = true;
			} else {
				checkboxes[i].checked = false;
			}
		}
	}

</script>
