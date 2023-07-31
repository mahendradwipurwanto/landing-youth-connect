<!-- Hero -->
<div class="bg-img-start" style="background-image: url(<?= base_url();?>assets/svg/components/card-11.svg);">
	<div class="container content-space-2 content-space-b-3 content-space-t-lg-5">
		<div class="w-lg-65 text-center mx-lg-auto">
			<h1 class="mb-0"><?= $announcements->title ?></h1>
			<p>Read our latest announcement.</p>
			<!-- <span class="badge bg-warning text-dark rounded-pill mb-3">Baca pengumuman terbaru dari kami</span> -->
		</div>
	</div>
</div>
<!-- End Hero -->
<div class="container content-space-2 content-space-t-lg-0 content-space-b-lg-2 mt-lg-n10 ">
	<div class="row" style="margin-top: 10rem;">

		<div class="col-lg-12">
			<div class="d-grid gap-3 gap-lg-5">
				<!-- Card -->
				<div class="card">
					<!-- Body -->
					<div class="card-body">
						<div class="row">
							<div class="col col-md-9">
								<h2><?= $announcements->title ?></h2>
							</div>
							<div class="col col-md-3" style="text-align: right;">
								<a class="link link-sm link-secondary" href="<?= site_url('announcements')?>">
									<i class="bi-chevron-left small ms-1"></i> Go back
								</a>
							</div>
						</div>
						<p class="card-text mb-5">
							<small class="text-muted"><?= date('l, F d, Y H:i', $announcements->created_at)?></small>
						</p>
						<div class="text-center mb-6 w-100">
							<img src="<?= base_url();?><?= $announcements->poster == null ? 'assets/images/placeholder.jpg' : $announcements->poster;?>"
								clsss="w-100" alt="" style="width:100%">
						</div>
						<span>
							<?= $announcements->content?>
						</span>
					</div>
					<!-- End Body -->
				</div>
				<!-- End Card -->
			</div>
		</div>
		<!-- End Col -->
	</div>
	<!-- End Row -->
</div>
