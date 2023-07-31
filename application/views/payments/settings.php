<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center <?php if ($this->agent->is_mobile()):?>mb-0<?php endif;?>">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Payment Settings</h1>
			<p class="docs-page-header-text">Manage all of your manual payment settings in here</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 mb-6">

	<?php if(!empty($payments)):?>
	<?php foreach($payments as $key => $val):?>
	<div class="col mb-4">
		<!-- Card -->
		<div class="card card-sm card-transition h-100" data-aos="fade-up">
			<div class="h-100 d-flex align-items-center payments-height">
				<img class="card-img p-2"
					src="<?= base_url(); ?><?= $val->img_method == null ? 'assets/svg/design-system/docs-bs-icons.svg' : $val->img_method;?>"
					alt="Image Description">
				<?php if($val->active == 1):?>
				<span class="badge bg-success payments-setting-badge">active</span>
				<?php else:?>
				<span class="badge bg-secondary payments-setting-badge">inactive</span>
				<?php endif;?>
			</div>
			<div class="card-body">
				<h4 class="card-title text-inherit"><?= $val->payment_method;?></h4>
				<button class="btn btn-primary btn-xs w-100 selectorDetail" data-bs-toggle="modal"
					data-bs-target="#settings" id="<?= $val->id; ?>">setting</button>
			</div>
		</div>
		<!-- End Card -->
	</div>
	<?php endforeach;?>
	<?php endif;?>
</div>
<!-- End Row -->

<!-- Modal -->
<div id="settings" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="settingsTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="settingsTitle">Settings Payment</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modalPaymentsContent">
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<script>
	$(".selectorDetail").click(function () {

		var id = $(this).attr('id');
		$("#modalPaymentsContent").html(
			`<center class="py-5"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading data ...</center>`
		);

		jQuery.ajax({
			url: "<?= site_url('payments/getDetailPaymentSetting') ?>",
			type: 'POST',
			data: {
				id: id
			},
			success: function (data) {
				$("#modalPaymentsContent").html(data);
			}
		});
	});

</script>
