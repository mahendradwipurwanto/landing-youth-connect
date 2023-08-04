<div class="d-grid gap-3 gap-lg-5">
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Documents</h4>
		</div>

		<div class="card-body">
			<div class="row">
				<?php if(!empty($documents)):?>
				<?php foreach($documents as $val):?>
				<div class="col-4">
					<!-- Card -->
					<div class="card card-sm card-transition shadow-sm mb-4">
						<img class="card-img-top p-4" src="<?= base_url();?><?= $web_logo;?>" alt="Image Description">

						<div class="card-body">
							<h4 class="card-title"><?= $val->title;?></h4>
							<?php if($val->is_upload):?>
								<?php if($val->status == 0):?>
									<span class="badge bg-danger mb-2">Not Completed</span>
								<?php elseif($val->status == 1):?>
									<span class="badge bg-warning mb-2">Waiting approval</span>
								<?php elseif($val->status == 2):?>
									<span class="badge bg-success mb-2">Accepted</span>
								<?php elseif($val->status == 3):?>
									<span class="badge bg-danger mb-2">Rejected</span>
								<?php endif;?>
							<?php endif;?>
							<div class="d-grid">
								<?php if($val->is_source):?>
								<a href="<?= $val->source;?>"
									class="<?= $val->btn_style;?> mb-2"><?= $val->btn_text;?></a>
								<?php endif;?>
								<?php if($val->is_second_source):?>
								<a href="<?= $val->second_source;?>"
									class="<?= $val->btn_second_style;?> mb-2"><?= $val->btn_second_text;?></a>
								<?php endif;?>
								<?php if($val->is_upload && $val->is_upload_allowed && ($val->status == 0 || $val->status == 3 )):?>
								<button data-bs-toggle="modal" data-bs-target="#upload"
									onclick="mdlUpload(<?= $val->id;?>)"
									class="btn btn-soft-success btn-sm w-100">Upload</button>
								<?php endif;?>
							</div>
						</div>
					</div>
					<!-- End Card -->
				</div>

				<?php endforeach;?>
				<?php endif;?>
			</div>
		</div>
		<div class="card-footer pt-0">
			<div class="card-footer ps-0 pb-0">
				<p><b>Note:</b></p>
				<p>For further information, you can contact: <a href="mailto:<?= $web_email;?>"><?= $web_email;?></a>
				</p>
			</div>
		</div>
	</div>
	<!-- End Card -->
</div>

<!-- Modal -->
<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="uploadLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="uploadLabel">Upload Documents</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="<?= site_url('api/user/uploadDocuments')?>" method="POST" enctype="multipart/form-data"
				class="js-validate">
				<div class="modal-body">
					<div class="form-group mb-3">
						<label for="">File</label>
						<div class="input-group">
							<input type="file" class="form-control form-control-sm imgprev" name="file" accept=".pdf"
								id="poster-announcements" required>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="m_document_id" id="m_document_id">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" href="" class="btn btn-soft-success">Upload</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal -->

<script>
	function mdlUpload(m_document_id = null, status = 0) {
		$('#m_document_id').val(m_document_id)
	}

</script>
