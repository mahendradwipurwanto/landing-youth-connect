<!-- Hero -->
<div class="bg-img-start" style="background-image: url(<?= base_url();?>assets/svg/components/card-11.svg);">
	<div class="container content-space-t-3 content-space-t-lg-5 content-space-b-2">
		<div class="w-md-75 w-lg-50 text-center mx-md-auto">
			<h1>FAQ</h1>
			<p>Search our FAQ for answers to anything you might ask.</p>
		</div>
	</div>
</div>
<!-- End Hero -->
<!-- FAQ -->
<div class="container content-space-2 content-space-b-lg-3">
	<div class="w-lg-75 mx-lg-auto">
		<div class="d-grid gap-10">

			<?php if(!empty($faq)):?>
			<?php foreach($faq as $key => $val):?>
			<div class="d-grid gap-3">
				<h2><?= $val->title;?></h2>

				<?php if(!empty($val->lists)):?>
				<!-- Accordion -->
				<div class="accordion accordion-flush accordion-lg" id="accordionFAQ-<?= $val->id;?>">
					<?php foreach($val->lists as $k => $v):?>
					<!-- Accordion Item -->
					<div class="accordion-item">
						<div class="accordion-header" id="headingFAQ-<?= $v->id;?>">
							<a class="accordion-button <?= $val->order == 1 && $v->order == 1 ? '' : 'collapsed';?>" role="button" data-bs-toggle="collapse"
								data-bs-target="#collapseFaq-<?= $v->id;?>" aria-expanded="<?= $val->order == 1 && $v->order == 1 ? 'true' : 'false';?>"
								aria-controls="collapseFaq-<?= $v->id;?>">
								<?= $v->faq;?>
							</a>
						</div>
						<div id="collapseFaq-<?= $v->id;?>" class="accordion-collapse collapse <?= $val->order == 1 && $v->order == 1 ? 'show' : '';?>"
							aria-labelledby="headingFAQ-<?= $v->id;?>" data-bs-parent="#accordionFAQ-<?= $val->id;?>">
							<div class="accordion-body">
								<?= $v->content;?>
							</div>
						</div>
					</div>
					<!-- End Accordion Item -->
					<?php endforeach;?>
				</div>
				<!-- End Accordion -->
				<?php endif;?>
			</div>
			<?php endforeach;?>
			<?php endif;?>
		</div>
	</div>
</div>
<!-- End FAQ -->
