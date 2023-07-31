<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">FAQ content
				<button type="button" class="btn btn-primary btn-sm float-end me-2" data-bs-toggle="modal"
					data-bs-target="#tambah">Add new FAQ</button>
				<a href="<?= site_url('master/master-faq'); ?>" class="btn btn-info btn-sm float-end me-2">Master
					FAQ</a>
				<a class="btn btn-ghost-secondary btn-sm float-end me-2" style="margin-right: 10px;"
					href="<?= site_url('faq'); ?>" target="_blank">
					Preview <i class="bi-box-arrow-up-right ms-1"></i>
				</a>
			</h1>
			<p class="docs-page-header-text">Manage FAQ page contents.</p>
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
							<th>Question</th>
							<th>Answer</th>
							<th>Created at</th>
						</tr>
					</thead>
					<tbody>

						<?php if(!empty($faq)):?>
						<?php $no = 1; foreach($faq as $key => $val):?>
						<tr>
							<th rowspan="<?= count($val->lists)+1;?>" class="text-center align-items-center">
								<?= $no++;?></th>
							<th colspan="4" class="thead-dark"><?= $val->title;?></th>
						</tr>
						<?php if(!empty($val->lists)):?>
						<?php foreach($val->lists as $k => $v):?>
						<tr>
							<td class="align-items-center">
								<button type="button" class="btn btn-info btn-xs" data-bs-toggle="modal"
									data-bs-target="#edit-<?= $v->id;?>">edit</button>
								<button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal"
									data-bs-target="#delete-<?= $v->id;?>">delete</button>
							</td>
							<td><?= $v->faq;?></td>
							<td>
								<button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal"
									data-bs-target="#answer-<?= $v->id;?>">check answer</button>
							</td>
							<td><?= date("d F Y", $v->created_at); ?></td>
						</tr>

						<!-- Modal -->
						<div id="edit-<?= $v->id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="add" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
								role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Edit FAQ content</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('api/master/editFaq');?>" method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $v->id;?>" required>

											<div class="mb-3">
												<label for="inputSubject" class="form-label">Question <small
														class="text-danger">*</small></label>
												<input class="form-control form-control-sm" type="text" name="faq"
													value="<?= $v->faq;?>" required>
											</div>

											<div class="mb-3">
												<label for="inputContent" class="form-label">Answer <small
														class="text-danger">*</small></label>
												<textarea class="form-control form-control-sm" name="answer" rows="5"
													placeholder="Answer" required><?= $v->content;?></textarea>
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

						<div id="delete-<?= $v->id; ?>" class="modal fade" tabindex="-1" role="dialog"
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
										<form action="<?= site_url('api/master/deleteFaq');?>" method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $v->id;?>">
											<p>Are you sure want to delete <b><?= $v->faq;?></b>?</p>
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

						<div id="answer-<?= $v->id; ?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="delete" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Answer</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<p><?= $v->content;?></p>
										<div class="modal-footer px-0 pb-0">
											<button type="button" class="btn btn-white btn-sm"
												data-bs-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>
						<?php endif;?>
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
				<h4 class="modal-title" id="detailUserTitle">Add new FAQ</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/master/addFaq');?>" method="post" class="js-validate need-validate"
					novalidate>

					<div class="mb-3">
						<label for="inputSubject" class="form-label">Question <small
								class="text-danger">*</small></label>
						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" autocomplete="off" name="m_faq_id"
								data-hs-tom-select-options='{"placeholder": "Select a person..."}'>
								<?php if(!empty($master_faq)):?>
								<?php foreach($master_faq as $key => $val):?>
								<option value="<?= $val->id;?>"><?= $val->title;?></option>
								<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					</div>

					<div class="mb-3">
						<label for="inputSubject" class="form-label">Question <small
								class="text-danger">*</small></label>
						<input class="form-control form-control-sm" type="text" name="faq" placeholder="Question"
							required>
					</div>

					<div class="mb-3">
						<label for="inputContent" class="form-label">Answer <small
								class="text-danger">*</small></label>
						<textarea class="form-control form-control-sm" name="answer" rows="5" placeholder="Answer"
							required></textarea>
					</div>

					<div class="modal-footer px-0 pb-0">
						<button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary btn-sm">Add new FAQ</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
