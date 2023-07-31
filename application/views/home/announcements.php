<!-- Hero -->
<div class="bg-img-start" style="background-image: url(<?= base_url();?>assets/svg/components/card-11.svg);">
	<div class="container content-space-2 content-space-b-3 content-space-t-lg-5">
		<div class="w-lg-65 text-center mx-lg-auto">
			<h1 class="mb-0">Announcements</h1>
			<p>Read our latest announcement.</p>
			<!-- <span class="badge bg-warning text-dark rounded-pill mb-3">Baca pengumuman terbaru dari kami</span> -->
		</div>
	</div>
</div>
<!-- End Hero -->

<!-- Card Grid -->
<div class="container content-space-2 content-space-lg-3"
	style="background: url(<?= base_url();?>assets/svg/components/abstract-shapes-9.svg) center no-repeat;">
	<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 mb-5 justify-content-center">
		<?php if(empty($announcements)):?>
		<h1 class="h2">No announcements yet.</h1>
		<p> Stay tuned for announcements at the Istanbull Youth Summit</p>
		<?php else:?>
		<?php foreach ($announcements as $val):?>
		<div class="col mb-5">
			<!-- Card -->
			<div class="card h-100" style="max-width: 20rem;">
				<img class="card-img-top" style="object-fit: cover;height: 350px;"
					src="<?= base_url();?><?= $val->poster == null ? 'assets/images/placeholder.jpg' : $val->poster;?>"
					alt="Card image cap">
				<div class="card-body">
					<h5><?= $val->title;?></h5>
					<p class="card-text"><?= substr(strip_tags($val->content), 0, 100);?>...</p>
					<h6 class="mb-0"><?= date("d M F - H:i", $val->created_at);?></h6>
				</div>

				<div class="card-footer pt-0">
					<a class="card-link cursor" href="<?= site_url('announcements/'.$val->permalink);?>">Read
						more<i class="bi-chevron-right small ms-1"></i></a>
				</div>
			</div>
			<!-- End Card -->
		</div>
		<!-- End Col -->
		<?php endforeach;?>
		<?php endif;?>

	</div>
	<!-- End Row -->
</div>
<!-- End Card Grid -->
