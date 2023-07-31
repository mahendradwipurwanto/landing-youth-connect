	<!-- Main Slider -->
	<div class="js-swiper-navigation swiper vh-md-70">
		<div class="swiper-wrapper">
			<?php if(!empty($swiper)):?>
			<script src="<?= base_url();?>assets/vendor/countdown/countdown.js"></script>
			<?php foreach($swiper as $key => $val):?>
			<!-- Slide -->
			<div class="swiper-slide gradient-y-overlay-sm-gray-900 bg-img-start"
				style="background-image: url(<?= base_url(); ?><?= $val->background;?>);">
				<div
					class="container d-md-flex align-items-md-center vh-md-70 content-space-t-5 content-space-b-3 content-space-md-0">
					<div class="w-75 w-lg-50">
						<h1 class="display-4 text-white mb-0"><?= $val->title;?></h1>
						<?php if($val->is_subtitle):?>
						<h3 class="text-white"><?= $val->subtitle;?></h3>
						<?php endif;?>
						<?php if($val->is_countdown):?>
						<div class="js-countdown-<?= $val->id;?> row">
							<div class="col-2">
								<h2 class="js-cd-days-<?= $val->id;?> h1 text-white mb-0"></h2>
								<h5 class="mb-0 text-white">Days</h5>
							</div>
							<!-- End Col -->

							<div class="col-2">
								<h2 class="js-cd-hours-<?= $val->id;?> h1 text-white mb-0"></h2>
								<h5 class="mb-0 text-white">Hours</h5>
							</div>
							<!-- End Col -->

							<div class="col-2">
								<h2 class="js-cd-minutes-<?= $val->id;?> h1 text-white mb-0"></h2>
								<h5 class="mb-0 text-white">Mins</h5>
							</div>
							<!-- End Col -->

							<div class="col-2">
								<h2 class="js-cd-seconds-<?= $val->id;?> h1 text-white mb-0"></h2>
								<h5 class="mb-0 text-white">Secs</h5>
							</div>
							<!-- End Col -->
						</div>

						<script>
							var countdownEnd = new Date('<?= $val->countdown;?>')

							document.querySelectorAll('.js-countdown-' + '<?= $val->id;?>').forEach(item => {
								var days = item.querySelector('.js-cd-days-' + '<?= $val->id;?>'),
									hours = item.querySelector('.js-cd-hours-' + '<?= $val->id;?>'),
									minutes = item.querySelector('.js-cd-minutes-' + '<?= $val->id;?>'),
									seconds = item.querySelector('.js-cd-seconds-' + '<?= $val->id;?>')

								countdown(countdownEnd,
									ts => {
										days.innerHTML = ts.days
										hours.innerHTML = ts.hours
										minutes.innerHTML = ts.minutes
										seconds.innerHTML = ts.seconds
									},
									countdown.DAYS | countdown.HOURS | countdown.MINUTES | countdown.SECONDS
								)
							})

						</script>
						<small class="text-white">West Indonesian Time (GMT+7)</small>
						<?php endif;?>
						<div class="mt-5">
							<?php if($val->is_btn):?>
							<?php if($val->is_btn_link):?>
							<a href="<?= $val->is_link_external ? $val->btn_link : site_url($val->btn_link);?>"
								class="<?= $val->btn_style;?>"><?= $val->btn_text;?></a>
							<?php else:?>
							<button class="<?= $val->btn_style;?>"><?= $val->btn_text;?></button>
							<?php endif;?>
							<?php endif;?>
							<?php if($val->is_btn_second):?>
							<?php if($val->is_btn_second_link):?>
							<a href="<?= $val->is_second_link_external ? $val->btn_second_link : site_url($val->btn_second_link);?>"
								class="<?= $val->btn_second_style;?>"><?= $val->btn_second_text;?></a>
							<?php else:?>
							<button class="<?= $val->btn_second_style;?>"><?= $val->btn_second_text;?></button>
							<?php endif;?>
							<?php endif;?>
						</div>
						<!-- End Row -->
					</div>
				</div>
			</div>
			<!-- End Slide -->
			<?php endforeach;?>
			<?php else:?>
			<!-- Slide -->
			<div class="swiper-slide gradient-y-overlay-sm-gray-900 bg-img-start"
				style="background-image: url(<?= base_url(); ?>assets/images/placeholder.jpg);">
				<div
					class="container d-md-flex align-items-md-center vh-md-70 content-space-t-5 content-space-b-3 content-space-md-0">
					<div class="w-75 w-lg-50">
						<h1 class="display-4 text-white mb-0"><?= $web_title;?></h1>
						<h3 class="text-white"><?= $web_desc;?></h3>
						<div class="mt-5">
							<a href="<?= site_url('sign-up');?>" class="btn btn-outline-light">Sign up</a>
						</div>
						<!-- End Row -->
					</div>
				</div>
			</div>
			<!-- End Slide -->
			<?php endif;?>

		</div>

		<!-- Arrows -->
		<div class="d-none d-md-inline-block">
			<div class="js-swiper-navigation-button-next swiper-button-next swiper-button-next-soft-white"></div>
			<div class="js-swiper-navigation-button-prev swiper-button-prev swiper-button-prev-soft-white"></div>
		</div>
	</div>
	<!-- End Main Slider -->

	<!-- Thumbs Slider -->
	<div class="js-swiper-thumbs swiper">
		<div class="swiper-wrapper">
		</div>
	</div>
	<!-- End Thumbs Slider -->
