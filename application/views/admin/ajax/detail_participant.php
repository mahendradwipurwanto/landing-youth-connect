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
								data-hs-step-form-next-options='{"targetSelector": "#basicForm"}'>
								<span class="step-icon step-icon-soft-dark">1</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Personal Data</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#otherForm"}'>
								<span class="step-icon step-icon-soft-dark">2</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Others</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#questionForm"}'>
								<span class="step-icon step-icon-soft-dark">3</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Question</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#programsForm"}'>
								<span class="step-icon step-icon-soft-dark">4</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Programs</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#selfPhotoForm"}'>
								<span class="step-icon step-icon-soft-dark">5</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Self Photo</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#proposal"}'>
								<span class="step-icon step-icon-soft-dark">6</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Proposal</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#travel_document"}'>
								<span class="step-icon step-icon-soft-dark">7</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Travel Document</span>
								</div>
							</a>
						</li>

						<li class="step-item">
							<a class="step-content-wrapper" href="javascript:;"
								data-hs-step-form-next-options='{"targetSelector": "#others_document"}'>
								<span class="step-icon step-icon-soft-dark stepy-last">8</span>
								<div class="step-content pb-5">
									<span class="step-title mt-2">Others Document</span>
								</div>
							</a>
						</li>
					</ul>
					<!-- End Step -->
				</div>

				<div class="col-lg-9">
					<div class="row mb-4">
						<div class="col-6">
							<?php if($participants->is_payment == 1):?>
							<span class="badge bg-soft-success text-danger">Payment Accepted</span>
							<?php endif;?>
						</div>
						<div class="col-6 text-right">
							<?php if(!empty($participants)):?>
							<?php if($participants->status == 0 || $participants->status == 1):?>
							<span class="badge bg-soft-danger text-danger float-end">Not Submitted</span>
							<?php elseif($participants->status == 2):?>
							<span class="badge bg-soft-info float-end">Submitted</span>
							<?php elseif($participants->status == 3):?>
							<span class="badge bg-soft-success text-danger float-end">Submission Accepted</span>
							<?php elseif($participants->status == 4):?>
							<span class="badge bg-soft-danger text-danger float-end">Submission Rejected</span>
							<?php else:?>
							<span class="badge bg-soft-danger text-danger float-end">Unknow</span>
							<?php endif;?>
							<?php else:?>
							<span class="badge bg-soft-danger text-danger float-end">Fill submission first</span>
							<?php endif;?>
						</div>
					</div>
					<!-- Content Step Form -->
					<div id="basicVerStepFormContent">
						<div id="basicForm" class="active" style="min-height: 15rem;">
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Personal
										Data</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Full Name</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->name;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Brithdate</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= date("F d, Y", $participants->birthdate);?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Gender</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->gender;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Address</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->address;?>. <?= $participants->province;?> -
												<?= $participants->city;?>, <?= $participants->postal_code;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Nationality</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<?php if($participants->nationality == -1):?>
											<span><?= $participants->nationality_custom;?> <span
													class="badge bg-soft-info"><i>(using custom input)</i></span></span>
											<?php else:?>
											<span>
												<?php foreach($countries as $key => $val):?>
												<?php if($participants->nationality == $val->num_code):?>
												<?= $val->en_short_name;
													break;?>
												<?php endif;?>
												<?php endforeach;?>
											</span>
											<?php endif;?>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Occupation</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->occupation;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Field of Study</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->field_of_study;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Institution / Workplace</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->institution_workplace;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Whatsapp Number</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->whatsapp_number;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Instagram Account</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><a href="https://www.instagram.com/<?= $participants->instagram;?>"
													target="_blank">@<?= $participants->instagram;?></a></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Emergency Contact</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->emergency_contact;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Contact Relation</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->contact_relation;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Disease History</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->disease_history;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">T-Shirt Size</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->tshirt_size;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
							<!-- End List Striped -->
						</div>

						<div id="otherForm" class="" style="display: none; min-height: 15rem;">
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Others</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Experience</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->experience;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Achievements</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->achievements;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Social Projects</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->social_projects;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Talents</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->talents;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
						</div>

						<div id="questionForm" class="" style="display: none; min-height: 15rem;">
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Questions</span>
								</li>
								<?php if(!empty($m_essay) && !empty($p_essay)):?>
								<?php foreach($m_essay as $key => $val):?>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-12 mb-2 mb-sm-0">
											<span class="h6"><?= $val->question;?></span>
										</div>
										<!-- End Col -->

										<div class="col-sm-12 mb-2 mb-sm-0">
											<span><?= $p_essay[$val->id]->answer;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<?php endforeach;?>
								<?php else:?>
								<h4 class="mt-5 pt-5">This participant not yet fill this part, please contact
									participant</h4>
								<?php endif;?>
							</ul>
						</div>

						<div id="programsForm" class="" style="display: none; min-height: 15rem;">
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Programs</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">How do you know about this program?</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->source;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Source Account/Name</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><?= $participants->achievements;?></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Twibbon Link</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><a href="<?= $participants->twibbon_link;?>"
													target="_blank"><?= $participants->twibbon_link;?></a></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Share Requirement Proof Link</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<span><a href="<?= $participants->share_proof_link;?>"
													target="_blank">open link</a></span>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-4 mb-2 mb-sm-0">
											<span class="h6">Referral Code</span>
										</div>
										<!-- End Col -->

										<div class="col-sm-8 mb-2 mb-sm-0">
											<?php if(isset($participants->referral_code) && $participants->referral_code !== "" && !is_null($participants->referral_code)):?>
											<span>affiliate with <b><?= $participants->fullname;?></b> !</span>
											<?php endif;?>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
						</div>

						<div id="selfPhotoForm" class="" style="display: none; min-height: 15rem;">
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Self Photo</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-12 mb-2 mb-sm-0">
											<figure class="text-center mb-2">
												<img id="imgthumbnail" class="img-thumbnail img-fluid"
													alt="Thumbnail image"
													src="<?= base_url();?><?= isset($participants->self_photo) ? $participants->self_photo : 'assets/images/placeholder.jpg';?>">
											</figure>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
						</div>

						<div id="proposal" class="" style="display: none; min-height: 15rem;">
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Proposal</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-12 mb-2 mb-sm-0">
											<figure class="text-center mb-2">
												<img id="imgthumbnail" class="img-thumbnail img-fluid"
													alt="Thumbnail image"
													src="<?= base_url();?><?= isset($participants->self_photo) ? $participants->self_photo : 'assets/images/placeholder.jpg';?>">
											</figure>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
						</div>

						<div id="travel_document" class="" style="display: none; min-height: 15rem;">
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Travel Documents</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-12 mb-2 mb-sm-0">
											<figure class="text-center mb-2">
												<img id="imgthumbnail" class="img-thumbnail img-fluid" alt="Thumbnail image"
													src="<?= base_url();?><?= isset($participants->self_photo) ? $participants->self_photo : 'assets/images/placeholder.jpg';?>">
											</figure>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
						</div>

						<div id="others_document" class="" style="display: none; min-height: 15rem;">
							<!-- List Striped -->
							<ul class="list-group list-group-lg">
								<li class="list-group-item p-2 active">
									<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Others Documents</span>
								</li>
								<li class="list-group-item p-3">
									<div class="row">
										<div class="col-sm-12 mb-2 mb-sm-0">
											<figure class="text-center mb-2">
												<img id="imgthumbnail" class="img-thumbnail img-fluid" alt="Thumbnail image"
													src="<?= base_url();?><?= isset($participants->self_photo) ? $participants->self_photo : 'assets/images/placeholder.jpg';?>">
											</figure>
										</div>
										<!-- End Col -->
									</div>
									<!-- End Row -->
								</li>
							</ul>
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
