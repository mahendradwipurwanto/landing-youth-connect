<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Announcements
				<button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
					data-bs-target="#add">Add New</button>
			</h1>
			<p class="docs-page-header-text">Manage announcements</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<table id="table" class="table table-striped display nowrap align-middle w-100 dataTables">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th></th>
							<th>Title</th>
							<th>Type</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($announcement) > 0) : ?>
						<?php $no = 1;
                            foreach ($announcement as $item) : ?>
						<tr>
							<td class="text-center"><?= $no++; ?></td>
							<td>
								<button type="button" data-bs-toggle="modal" id="<?= $item->id; ?>"
									data-bs-target="#detail<?= $item->id; ?>" class="btn btn-info btn-xs"><i
										class="bi bi-eye"></i>
									details</button>
								<button type="button" data-bs-toggle="modal" id="<?= $item->id; ?>"
									data-bs-target="#edit" class="btn btn-primary btn-xs selectorDetail"><i
										class="bi bi-pencil-square"></i>
									edit</button>
								<button type="button" data-bs-toggle="modal" data-bs-target="#delete<?= $item->id; ?>"
									class="btn btn-danger btn-xs"><i class="bi bi-bookmark-check"></i> delete</button>
							</td>
							<td><b><?= substr($item->title, 0 , 50); ?></b></td>
							<td>
								<?php if ($item->is_public == 1):?>
								<span class="badge bg-info mr-2">Public</span>
								<?php endif;?>
								<?php if ($item->is_member == 1):?>
								<span class="badge bg-warning mr-2">Participans</span>
								<?php endif;?>
							</td>
							<td><b><?= date("d F Y", $item->created_at); ?></b></td>
						</tr>
						<!-- Modal -->
						<div id="detail<?= $item->id; ?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="edit" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
								role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Details</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<h3 class="mb-3"><?= $item->title;?></h3>
										<figure>
											<img src="#" id="imgthumbnail" class="img-thumbnail img-fluid"
												alt="Thumbnail image"
												onerror="this.onerror=null;this.src='<?= base_url();?><?= $item->poster == null ? 'assets/images/placeholder.jpg' : $item->poster;?>';">
										</figure>
										<?php if ($item->is_public == 1):?>
										<span class="badge bg-info mr-2">Public</span>
										<?php endif;?>
										<?php if ($item->is_member == 1):?>
										<span class="badge bg-warning mr-2">Participans</span>
										<?php endif;?>
										<p><?= $item->content;?></p>
										<div class="modal-footer px-0 pb-0">
											<span class="float-start">Created at
												<?= date("d F Y", $item->created_at); ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Modal -->
						<!-- Modal -->
						<div id="delete<?= $item->id; ?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="edit" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
								role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Delete</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('api/master/deleteAnnouncement');?>" method="post"
											class="js-validate needs-validation" novalidate>
											<input type="hidden" name="id" value="<?= $item->id;?>">
											<p>Are you sure you want to delete this announcement?</p>
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
						<!-- End Modal -->
						<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="detailUserTitle">Add new</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/master/addAnnouncement');?>" method="post"
					class="js-validate needs-validation" novalidate enctype="multipart/form-data">

					<div class="mb-3">
						<label for="inputSubject" class="form-label">Title <small class="text-danger">*</small></label>
						<input class="form-control form-control-sm" type="text" name="subject" placeholder="Enter Title"
							required>
					</div>

					<div class="mb-3">
						<figure>
							<img src="#" id="anouncement-preview" class="img-thumbnail img-fluid" alt="Thumbnail image"
								onerror="this.onerror=null;this.src='<?= base_url();?><?= 'assets/images/placeholder.jpg'?>';">
						</figure>
						<label for="anouncement-upload" class="form-label">Logo <small
								class="text-muted">(optional)</small>:</label>
						<div class="input-group">
							<input type="file" class="form-control form-control-sm imgprev" name="image"
								accept="image/*, .svg" id="anouncement-upload">
						</div>
						<small class="text-muted">Max file size 1Mb</small>
					</div>

					<div class="mb-3">
						<label class="input-label mb-2"> Choose to whom this announcement will be displayed <small
								class="text-danger">*</small></label>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<!-- Check -->
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="is_public" id="publicType"
										value="1" checked>
									<label class="form-check-label text-dark" for="publicType">
										<b>Public</b>
										<span class="d-block text-muted small">This will be displayed on the landing
											page</span>
									</label>
								</div>
								<!-- End Check -->
							</div>
							<div class="col-md-6 col-sm-12">
								<!-- Check -->
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="is_member" id="usersType"
										value="1">
									<label class="form-check-label text-dark" for="usersType">
										<b>Participans</b>
										<span class="d-block text-muted small">This will be displayed on
											every participans account</span>
									</label>
								</div>
								<!-- End Check -->
							</div>
						</div>
					</div>

					<div class="mb-3 d-none">
						<label for="tag" class="form-label">Tags <small
								class="text-secondary">(optional)</small>:</label>
						<input type="text" class="form-control" name="tag" id="tag"
							style="min-height: 50px; height: 50px;">
						<small class="text-muted">Use , (comma) or use <i>enter</i> to braket tag</small>
					</div>

					<div class="mb-3">
						<label class="form-label" for="inputContent">Description <small
								class="text-danger">*</small></label>
						<textarea type="text" id="inputContent" class="form-control editor" rows="3" name="content"
							placeholder="Description" required></textarea>
						<small class="text-secondary">This is use on metatag as well</small>
					</div>

					<div class="modal-footer px-0 pb-0">
						<button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-info btn-sm">Publish</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="detailUserTitle">Edit</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div id="modalAnnouncementContent">

				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<script>
	//  ckeditor
	$('textarea.editor').each(function () {
		CKEDITOR.replace($(this).attr('id'), {
			toolbar: [{
					name: 'basicstyles',
					items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript']
				},
				{
					name: 'paragraph',
					items: ['NumberedList', 'BulletedList', '-',
						'Blockquote', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
						'JustifyBlock'
					]
				},
				{
					name: 'links',
					items: ['Link', 'Unlink']
				},
				{
					name: 'insert',
					items: ['Image', 'Smiley', 'SpecialChar', 'Iframe']
				},
				{
					name: 'styles',
					items: ['Styles', 'Format', 'Font', 'FontSize']
				},
				{
					name: 'colors',
					items: ['TextColor', 'BGColor']
				}
			]
		});

	});

	$(".selectorDetail").click(function () {

		var id = $(this).attr('id');
		$("#modalAnnouncementContent").html(
			`<center class="py-5"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sedang memuat ...</center>`
		);

		jQuery.ajax({
			url: "<?= site_url('api/master/getDetailAnnouncement') ?>",
			type: 'POST',
			data: {
				id: id
			},
			success: function (data) {
				$("#modalAnnouncementContent").html(data);
			}
		});
	});

</script>
