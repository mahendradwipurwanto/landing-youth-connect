<form action="<?= site_url('api/master/editAnnouncement');?>" method="post" class="js-validate needs-validation"
	novalidate enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $item->id;?>">
	<input type="hidden" name="permalink" value="<?= $item->permalink;?>">

	<div class="mb-3">
		<label for="inputSubject" class="form-label">Title <small class="text-danger">*</small></label>
		<input class="form-control form-control-sm" type="text" name="subject" value="<?= $item->title;?>" required>
	</div>

	<div class="mb-3">
		<figure>
			<img src="#" id="imgthumbnail" class="img-thumbnail img-fluid" alt="Thumbnail image"
				onerror="this.onerror=null;this.src='<?= base_url();?><?= $item->poster == null ? 'assets/images/placeholder.jpg' : $item->poster;?>';">
		</figure>
		<label for="poster-announcements" class="form-label">Poster <small
				class="text-muted">(optional)</small>:</label>
		<div class="input-group">
			<input type="file" class="form-control imgprev" name="image" accept="image/*" id="poster-announcements">
		</div>
		<small class="text-muted">Max file size 1Mb</small>
	</div>

	<div class="mb-3">
		<div class="d-grid gap-3">
			<!-- Check -->
			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="is_public" id="publicType-<?= $item->id;?>"
					value="1" <?= $item->is_public == 1 ? 'checked' : '';?>>
				<label class="form-check-label text-dark" for="publicType-<?= $item->id;?>">
					<b>Public</b>
					<span class="d-block text-muted small">This will be displayed on the
						landing page</span>
				</label>
			</div>
			<!-- End Check -->

			<!-- Check -->
			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="is_member" id="usersType-<?= $item->id;?>"
					value="1" <?= $item->is_member == 1 ? 'checked' : '';?>>
				<label class="form-check-label text-dark" for="usersType-<?= $item->id;?>">
					<b>Participans</b>
					<span class="d-block text-muted small">This will be displayed on
						every participans account</span>
				</label>
			</div>
			<!-- End Check -->
		</div>
	</div>

	<div class="mb-3 d-none">
		<label for="tag" class="form-label">Tags <small class="text-secondary">(optional)</small>:</label>
		<input type="text" class="form-control" name="tag" id="tag" style="min-height: 50px; height: 50px;"
			value="<?= $item->tag; ?>" required>
		<small class="text-muted">Gunakan , atau tekan <i>enter</i> untuk memisahkan tag</small>
	</div>

	<div class="mb-3">
		<label for="inputContent" class="form-label">Content <small class="text-danger">*</small></label>
		<textarea class="form-control editor" id="ckeditor-<?= $item->id;?>" name="content" rows="5"
			value="Insert annoucement content" required><?= $item->content;?></textarea>
	</div>

	<div class="modal-footer px-0 pb-0">
		<button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Cancel</button>
		<?php if($item->notification == 1):?>
		<button type="submit" class="btn btn-success btn-sm">Resend</button>
		<button type="submit" class="btn btn-warning btn-sm">Save &
			Resend</button>
		<?php endif;?>
		<button type="submit" class="btn btn-info btn-sm">Save</button>
	</div>
</form>

<script>
	//  ckeditor
	$('textarea.editor').each(function () {

		CKEDITOR.replace($(this).attr('id'));

	});

</script>
