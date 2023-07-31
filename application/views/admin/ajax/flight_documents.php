<div class="row">
	<div class="col-12">
		<!-- List Striped -->
		<!-- Step Form -->
		<form class="js-step-form"
			data-hs-step-form-options='{"progressSelector": "#basicVerStepFormProgress","stepsSelector": "#basicVerStepFormContent"}'>
			<div class="row">
				<div class="col-lg-3">
					<!-- Step -->
					<ul id="basicVerStepFormProgress" class="js-step-progress step step-icon-sm mb-7">
						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#passport"}'>
								<span class="step-icon step-icon-soft-dark">1</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Passport</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#flight"}'>
								<span class="step-icon step-icon-soft-dark">2</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Flight</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#residance"}'>
								<span class="step-icon step-icon-soft-dark">3</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Residence</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#vaccine"}'>
								<span class="step-icon step-icon-soft-dark">4</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Vaccine Certificate</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#visa"}'>
								<span class="step-icon step-icon-soft-dark stepy-last">5</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Visa</span>
								</div>
							</a>
						</li>
					</ul>
					<!-- End Step -->
				</div>

				<div class="col-lg-9">
					<!-- Content Step Form -->
					<div id="basicVerStepFormContent">
						<div id="passport" class="active" style="min-height: 15rem;">
							<?php if(is_null($passport)):?>
							<center>Not yet fill the requirement documents</center>
							<?php else:?>
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Passport
										Information</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Passport Number</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $passport->passport_number;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Full Name</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $passport->fullname;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Passport</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<figure class="text-center mb-2">
												<img id="imgthumbnail" class="img-thumbnail img-fluid"
													alt="Thumbnail image"
													src="<?= base_url();?><?= isset($passport->file) ? $passport->file : 'assets/images/placeholder.jpg';?>">
											</figure>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
							<!-- End List Striped -->
							<?php endif;?>
						</div>

						<div id="flight" class="" style="display: none; min-height: 15rem;">
							<?php if(is_null($passport)):?>
							<center>Not yet fill the requirement documents</center>
							<?php else:?>
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Flight
										Departure</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Departure Airport</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->departure_airport;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Departure Date (based on ticket)</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->departure_date;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Departure Time (based on ticket)</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->departure_time;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Departure Airlane</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->departure_airline;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Departure Flight Code</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->departure_flightcode;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Flight
										Return</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Return Airport</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->departure_airport;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Return Date (based on ticket)</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->return_date;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Return Time (based on ticket)</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->return_time;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Return Airlane</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->return_airline;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Return Flight Code</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $flight->return_flightcode;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
							<?php endif;?>
						</div>

						<div id="residance" class="" style="display: none; min-height: 15rem;">
							<?php if(is_null($passport)):?>
							<center>Not yet fill the requirement documents</center>
							<?php else:?>
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Residance</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Residance Type</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $residance->type;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Residance Address</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $residance->address;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
							<?php endif;?>
						</div>

						<div id="vaccine" class="" style="display: none; min-height: 15rem;">
							<?php if(is_null($passport)):?>
							<center>Not yet fill the requirement documents</center>
							<?php else:?>
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Vaccine
										Certificate</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-12 mb-2 mb-sm-0">
											<figure class="text-center mb-2">
												<img id="imgthumbnail" class="img-thumbnail img-fluid"
													alt="Thumbnail image"
													src="<?= base_url();?><?= isset($vaccine->file) ? $vaccine->file : 'assets/images/placeholder.jpg';?>">
											</figure>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
							<?php endif;?>
						</div>

						<div id="visa" class="" style="display: none; min-height: 15rem;">
							<?php if(is_null($passport)):?>
							<center>Not yet fill the requirement documents</center>
							<?php else:?>
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Visa</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-12 mb-2 mb-sm-0">
											<figure class="text-center mb-2">
												<img id="imgthumbnail" class="img-thumbnail img-fluid"
													alt="Thumbnail image"
													src="<?= base_url();?><?= isset($visa->file) ? $visa->file : 'assets/images/placeholder.jpg';?>">
											</figure>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
							<?php endif;?>
						</div>
					</div>
					<!-- End Content Step Form -->
				</div>
			</div>
			<!-- End Row -->
		</form>
		<!-- End Step Form -->
		<!-- End List Striped -->
	</div>
</div>

<script src="<?= base_url(); ?>assets/vendor/hs-step-form/dist/hs-step-form.min.js"></script>
<script>
	// INITIALIZATION OF STEP FORM
	// =======================================================
	new HSStepForm('.js-step-form', {
		finish($el) {
			const $successMessageTempalte = $el.querySelector('.js-success-message').cloneNode(true)

			$successMessageTempalte.style.display = 'block'

			$el.style.display = 'none'
			$el.parentElement.appendChild($successMessageTempalte)
		}
	})

</script>
