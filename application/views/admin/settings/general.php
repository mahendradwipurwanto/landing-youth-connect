<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">General Information</h1>
			</h1>
			<p class="docs-page-header-text">Manage general information of your website</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<form action="<?= site_url('api/website/ubahGeneral');?>" method="post"
					class="js-validate needs-validation" novalidate enctype="multipart/form-data">
					<div class="mb-3">
						<label for="inputWebsiteTitle" class="form-label">Title <small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteTitle" class="form-control form-control-sm" name="web_title"
							value="<?= $web_title;?>" required>
						<small class="text-secondary">This is use on metatag as well</small>
					</div>
					<div class="mb-3">
						<figure class="w-25">
							<img src="<?= base_url();?><?= $web_logo;?>" id="websiteLogo-preview"
								class="img-thumbnail img-fluid" alt="Thumbnail image"
								onerror="this.onerror=null;this.src='<?= base_url();?><?= 'assets/images/placeholder.jpg'?>';">
						</figure>
						<label for="websiteLogo-upload" class="form-label">Logo <small
								class="text-muted">(optional)</small>:</label>
						<div class="input-group">
							<input type="file" class="form-control form-control-sm imgprev" name="image"
								accept="image/*, .svg" id="websiteLogo-upload">
						</div>
						<small class="text-muted">Max file size 1Mb</small>
					</div>
					<div class="mb-3">
						<label class="form-label" for="inputWebDesc">Description <small
								class="text-danger">*</small></label>
						<textarea type="text" id="inputWebDesc" class="form-control editor" rows="4" name="web_desc"
							placeholder="Description" required><?= $web_desc;?></textarea>
						<small class="text-secondary">This is use on metatag as well</small>
					</div>
					<div class="mb-3">
						<label class="form-label" for="inputWebsiteAddress">Address <small
								class="text-danger">*</small></label>
						<textarea type="text" id="inputWebsiteAddress" class="form-control form-control-sm" rows="3"
							name="web_alamat" placeholder="Address" required><?= $web_alamat;?></textarea>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteTelepon" class="form-label">Whatsapp<small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteTelepon" class="form-control form-control-sm"
							name="web_telepon" value="<?= $web_telepon;?>" required>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteFacebook" class="form-label">Facebook<small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteFacebook" class="form-control form-control-sm"
							name="sosmed_facebook" value="<?= $sosmed_facebook;?>" required>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteInstagram" class="form-label">Instagram<small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteInstagram" class="form-control form-control-sm"
							name="sosmed_ig" value="<?= $sosmed_ig;?>" required>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteTwitter" class="form-label">Twitter<small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteTwitter" class="form-control form-control-sm"
							name="sosmed_twitter" value="<?= $sosmed_twitter;?>" required>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteYoutube" class="form-label">Youtube<small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteYoutube" class="form-control form-control-sm"
							name="sosmed_yt" value="<?= $sosmed_yt;?>" required>
					</div>
					<div class="card-footer px-0">
						<button type="submit" class="btn btn-primary btn-sm float-end">Save Changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


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

</script>
