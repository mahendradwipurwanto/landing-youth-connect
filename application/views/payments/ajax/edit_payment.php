<form action="<?= site_url('api/payments/savePaymentSettings');?>" method="post" class="js-validate needs-validation"
	novalidate>
	<input type="hidden" name="id" value="<?= $item->id;?>">
	<div class="row">
		<label for="inputPaymentMethod" class="form-label">Payment Method</label>
		<div class="col-7">
			<div class="mb-3">
				<input type="text" class="form-control form-control-sm" id="inputPaymentMethod"
					value="<?= $item->payment_method;?>" name="payment_method" readonly>
			</div>
		</div>
		<div class="col-5 d-flex align-items-center">
			<!-- Checkbox Switch -->
			<div class="form-check form-switch mb-3">
				<input type="checkbox" class="form-check-input" name="active" id="formSwitch-<?= $item->id;?>"
					<?= $item->active == 1 ? 'checked' : '';?>>
				<label class="form-check-label" for="formSwitch-<?= $item->id;?>">Active ?</label>
			</div>
			<!-- End Checkbox Switch -->
		</div>
	</div>
	<div class="mb-3">
		<label for="inputPaymentData" class="form-label">Payment Data</label>
		<textarea class="form-control form-control-sm bg-blue-dark text-white" name="data" id="textJson" rows="10"
			required><?= $item->data;?></textarea>
		<small class="text-primary">Payment data must be json format text. <a onclick="prettyJson()"
				class="fw-bold text-dark cursor">click here</a> to format to json</small>
	</div>

	<div class="mb-3">
		<label for="inputContent" class="form-label">Tutorial</label>
		<textarea class="form-control editor" id="ckeditor-<?= $item->id;?>" name="tutorial" rows="5"
			value="Insert payment tutorial"><?= $item->tutorial;?></textarea>
	</div>
	<div class="modal-footer px-0 pb-0 mb-0">
		<button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary btn-sm">Save changes</button>
	</div>
</form>

<script>
	//  ckeditor
	$('textarea.editor').each(function () {

		CKEDITOR.replace($(this).attr('id'));

	});

</script>
