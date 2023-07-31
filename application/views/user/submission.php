<div class="d-grid gap-3 gap-lg-5">
	<!-- Card -->
	<div class="card">
		<div class="card-header py-3 border-bottom">
			<h4 class="card-header-title my-0">Overview
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
			</h4>
		</div>
		<?php if(!empty($participants) && $participants->status == 3):?>

		<?php if(!empty($participants)):?>
		<div class="card-body">
			<?php if($participants->status == 2):?>
			<div class="alert alert-soft-info small">
				Submission submitted, waiting for approval
			</div>
			<?php elseif($participants->status == 3):?>
			<div class="alert alert-soft-success small">
				Horray! Your submission has been accepted, please upload necessary documents down below!
			</div>
			<?php elseif($participants->status == 4):?>
			<div class="alert alert-soft-danger small">
				Ouch! Your submission has been rejected, contact our Team for more information!
			</div>
			<?php else:?>
			<div class="alert alert-soft-warning small">
				Hmm... There is something wrong with your
				submission progress. Please contact our TEAM and tell your had code 412 on your submission status
			</div>
			<?php endif;?>
		</div>
		<?php endif;?>
		<div class="card-header py-3 border-bottom">
			<h4 class="card-header-title my-0">Your submission data</h4>
		</div>
		<!-- Body -->
		<div class="card-body">
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
									<span class="step-icon step-icon-soft-dark stepy-last">5</span>
									<div class="step-content pb-5">
										<span class="step-title mt-2">Self Photo</span>
									</div>
								</a>
							</li>
						</ul>
						<!-- End Step -->
					</div>

					<div class="col-lg-9">
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
												<span><?= $participants->nationality_custom;?></span>
												<?php else:?>
												<span>
													<?php foreach($countries as $key => $val):?>
													<?php if($participants->nationality == $val->num_code):?>
													<?= $val->en_short_name; break;?>
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
										<span style="margin-top: -20px; margin-left: 5px"
											class="fw-bold">Questions</span>
									</li>
									<?php if(!empty($m_essay)):?>
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
									<?php endif;?>
								</ul>
							</div>

							<div id="programsForm" class="" style="display: none; min-height: 15rem;">
								<!-- List Striped -->
								<ul class="list-group list-group-lg">
									<li class="list-group-item p-2 active">
										<span style="margin-top: -20px; margin-left: 5px"
											class="fw-bold">Programs</span>
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
														target="_blank"><?= $participants->share_proof_link;?></a></span>
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
										<span style="margin-top: -20px; margin-left: 5px" class="fw-bold">Self
											Photo</span>
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
						</div>
						<!-- End Content Step Form -->
					</div>
				</div>
				<!-- End Row -->
			</form>
		</div>
		<?php else:?>

		<!-- Body -->
		<div class="card-body">

			<!-- Step Form -->
			<?php if($this->session->userdata("role") == 0 || $this->session->userdata("role")):?>
			<form id="form" class="js-step-form-validate js-validate"
				data-hs-step-form-options='{"progressSelector": "#formParticipansProgress", "stepsSelector": "#overviewParticipansContent", "endSelector": "#sendSubmission", "isValidate": false}'
				enctype="multipart/form-data">
			<?php else:?>
			<form id="form" class="js-step-form-validate js-validate"
				data-hs-step-form-options='{"progressSelector": "#formParticipansProgress", "stepsSelector": "#overviewParticipansContent", "endSelector": "#sendSubmission", "isValidate": true}'
				enctype="multipart/form-data">
			<?php endif;?>
				<div class="row">
					<div class="col-lg-3">
						<!-- Step -->
						<ul id="formParticipansProgress" class="js-step-progress step step-icon-sm mb-7">
							<li
								class="step-item <?= isset($participants->step) && $participants->step == 1 ? 'is-valid' : '';?>">
								<a class="step-content-wrapper" href="javascript:;"
									data-hs-step-form-next-options='{"targetSelector": "#formBasic"}'>
									<span class="step-icon step-icon-soft-dark">1</span>
									<div class="step-content d-flex align-items-center">
										<span class="step-title">Basic</span>
									</div>
								</a>
							</li>

							<li
								class="step-item <?= isset($participants->step) && $participants->step >= 2 ? 'is-valid' : '';?>">
								<a class="step-content-wrapper" href="javascript:;"
									data-hs-step-form-next-options='{"targetSelector": "#formOthers"}'>
									<span class="step-icon step-icon-soft-dark">2</span>
									<div class="step-content d-flex align-items-center">
										<span class="step-title">Others</span>
									</div>
								</a>
							</li>

							<li
								class="step-item <?= isset($participants->step) && $participants->step >= 3 ? 'is-valid' : '';?>">
								<a class="step-content-wrapper" href="javascript:;"
									data-hs-step-form-next-options='{"targetSelector": "#formEssay"}'>
									<span class="step-icon step-icon-soft-dark">3</span>
									<div class="step-content d-flex align-items-center">
										<span class="step-title">Questions</span>
									</div>
								</a>
							</li>

							<li
								class="step-item <?= isset($participants->step) && $participants->step >= 4 ? 'is-valid' : '';?>">
								<a class="step-content-wrapper" href="javascript:;"
									data-hs-step-form-next-options='{"targetSelector": "#formProgram"}'>
									<span class="step-icon step-icon-soft-dark">4</span>
									<div class="step-content d-flex align-items-center">
										<span class="step-title">Program</span>
									</div>
								</a>
							</li>

							<li
								class="step-item <?= isset($participants->step) && $participants->step >= 5 ? 'is-valid' : '';?>">
								<a class="step-content-wrapper" href="javascript:;"
									data-hs-step-form-next-options='{"targetSelector": "#formSelfPhoto"}'>
									<span class="step-icon step-icon-soft-dark">5</span>
									<div class="step-content d-flex align-items-center">
										<span class="step-title">Self Photo</span>
									</div>
								</a>
							</li>

							<li
								class="step-item <?= isset($participants->step) && $participants->step == 6 ? 'is-valid' : '';?>">
								<a class="step-content-wrapper" href="javascript:;"
									data-hs-step-form-next-options='{"targetSelector": "#formSubmission"}'>
									<span class="step-icon step-icon-soft-dark stepy-last">6</span>
									<div class="step-content d-flex align-items-center">
										<span class="step-title">Payment & Submission</span>
									</div>
								</a>
							</li>
						</ul>
						<!-- End Step -->
					</div>

					<div class="col-lg-9">
						<!-- Content Step Form -->
						<div id="overviewParticipansContent">
							<div id="formBasic" class="active" style="min-height: 15rem;">

								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormFullname" class="form-label">Full name</label>

									<div class="js-form-message">
										<input type="text" class="form-control form-control-sm"
											onkeypress="return isAlpha(event)" id="validationFormFullname"
											placeholder="Full name" aria-label="Full name" name="fullname" required
											data-msg="Please enter your full name."
											<?= isset($participants->name) ? 'value="'.$participants->name.'"' : '';?>>
										<span class="invalid-feedback">Please enter a valid full name.</span>
									</div>
								</div>
								<!-- End Form Group -->

								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormBirthdate" class="form-label">Birthdate</label>

									<div class="js-form-message">
										<input type="text" class="form-control form-control-sm flatpickr"
											id="validationFormBirthdate" placeholder="Birthdate"
											aria-label="Birthdate" name="birthdate" required
											data-msg="Please enter your birthdate."
											<?= isset($participants->birthdate) ? 'value="'.date("F d, Y", $participants->birthdate).'"' : 'value="'.date("F d, Y").'"';?>>
										<span class="invalid-feedback">Please enter a valid birthdate.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormGender" class="form-label">Gender</label>

									<div class="js-form-message">
										<div class="row">
											<div class="col-sm mb-2 mb-sm-0">
												<!-- Form Radio -->
												<label class="form-control form-control-sm" for="formGenderMale">
													<span class="form-check">
														<input type="radio" class="form-check-input" name="gender"
															value="male" id="formGenderMale"
															<?= isset($participants->gender) ? ($participants->gender == 'male' ? 'checked' : '') : '';?>
															required>
														<span class="form-check-label">Male</span>
													</span>
												</label>
												<!-- End Form Radio -->
											</div>

											<div class="col-sm mb-2 mb-sm-0">
												<!-- Form Radio -->
												<label class="form-control form-control-sm" for="formGenderFemale">
													<span class="form-check">
														<input type="radio" class="form-check-input" name="gender"
															value="female" id="formGenderFemale"
															<?= isset($participants->gender) ?($participants->gender == 'female' ? 'checked' : '') : '';?>
															required>
														<span class="form-check-label">Female</span>
													</span>
												</label>
												<!-- End Form Radio -->
											</div>
										</div>
										<span class="invalid-feedback">Please enter a gender.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel" class="form-label">Address</label>

									<div class="row">
										<div class="col-sm-12 mb-3">
											<div class="js-form-message">
												<input type="text" class="form-control form-control-sm"
													placeholder="Detail Address Ex: Village/Street/House No"
													name="address" required
													<?= isset($participants->address) ? 'value="'.$participants->address.'"' : '';?> />
												<span class="invalid-feedback">Please enter a valid detail
													address.</span>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="js-form-message">
												<input type="text" class="form-control form-control-sm"
													placeholder="Postal Code" name="postal_code" required
													<?= isset($participants->postal_code) ? 'value="'.$participants->postal_code.'"' : '';?> />
												<span class="invalid-feedback">Please enter a valid postal
													code.</span>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="js-form-message">
												<input type="text" class="form-control form-control-sm"
													placeholder="City" name="city" required
													<?= isset($participants->city) ? 'value="'.$participants->city.'"' : '';?> />
												<span class="invalid-feedback">Please enter a valid city.</span>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="js-form-message">
												<input type="text" class="form-control form-control-sm"
													placeholder="Province" name="province" required
													<?= isset($participants->province) ? 'value="'.$participants->province.'"' : '';?> />
												<span class="invalid-feedback">Please enter a valid province.</span>
											</div>
										</div>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3"
									style="display: <?= isset($participants->nationality) && $participants->nationality == -1 ? 'none' : '';?>;"
									id="select-nationality">
									<label for="validationFormNationality" class="form-label">Nationality</label>

									<div class="js-form-message">
										<!-- <div class="tom-select-custom">
										<select class="js-select form-select form-select-sm" autocomplete="off"
											id="validationFormNationality" name="nationality"
											data-hs-tom-select-options='{"placeholder": "Choose Nationality..."}'
											required>
											<?php if(!empty($countries)):?>
											<?php foreach($countries as $key => $val):?>
											<option value="<?= $val->num_code;?>"
												<?= isset($participants->nationality) ? ($participants->nationality == $val->num_code ? 'selected' : '') : '';?>>
												<?= $val->en_short_name;?>
											</option>
											<?php endforeach;?>
											<?php endif;?>
										</select>
									</div> -->
										<select class="form-select select2" autocomplete="off"
											id="validationFormNationality" name="nationality" required>
											<?php if(isset($participants->nationality)):?>
											<option value="<?= $participants->nationality;?>">
												<?= $participants->en_short_name;?></option>
											<?php endif;?>
										</select>
										<span class="invalid-feedback">Please enter a valid nationality.</span>
									</div>
									<small> can't find your nationality? <span class="text-primary"
											onclick="displayCustomNationality()" role="button">click here</span> to
										insert new one</small>
								</div>
								<!-- End Form Group -->
								<input type="hidden" name="is_custom_nationality" class="d-none"
									value="<?= isset($participants->nationality) && $participants->nationality  == -1 ? -1 : 0;?>">
								<!-- Form Group -->
								<div class="mb-3"
									style="display: <?= !isset($participants->nationality) || $participants->nationality > -1 ? 'none' : '';?>;"
									id="custom-nationality">
									<label for="validationFormCustomNationality"
										class="form-label">Nationality</label>
									<div class="js-form-message">
										<input type="text" class="form-control form-control-sm"
											onkeypress="return isAlpha(event)" id="validationFormCustomNationality"
											placeholder="Nationality" aria-label="Nationality"
											name="nationality_custom" data-msg="Please enter your nationality."
											<?= isset($participants->nationality_custom) ? 'value="'.$participants->nationality_custom.'"' : '';?>>
										<span class="invalid-feedback">Please enter a valid nationality.</span>
									</div>
									<small> choose nationality we provide? <span class="text-primary"
											onclick="displayCustomNationality()" role="button">click
											here</span></small>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormOccupation" class="form-label">Occupation</label>

									<div class="js-form-message">
										<input type="text" class="form-control form-control-sm" name="occupation"
											id="validationFormOccupation" placeholder="Occupation"
											aria-label="Occupation" required
											data-msg="Please enter a valid occupation."
											<?= isset($participants->occupation) ? 'value="'.$participants->occupation.'"' : '';?>>
										<span class="invalid-feedback">Please enter a valid occupation.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormFieldOfStudy" class="form-label">Field of
										Study</label>

									<div class="js-form-message">
										<input type="text" class="form-control form-control-sm" name="fieldofstudy"
											id="validationFormFieldOfStudy" placeholder="Full of Study"
											aria-label="Field of Study" required
											data-msg="Please enter a valid full of study."
											<?= isset($participants->field_of_study) ? 'value="'.$participants->field_of_study.'"' : '';?>>
										<span class="invalid-feedback">Please enter a valid full of study.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormInstitution" class="form-label">Institution /
										Workplace</label>

									<div class="js-form-message">
										<input type="text" class="form-control form-control-sm" name="institution"
											id="validationFormInstitution" placeholder="Institution / Workplace"
											aria-label="Institution / Workplace" required data-msg="Please enter a valid institution /
										workplace." <?= isset($participants->institution_workplace) ? 'value="'.$participants->institution_workplace.'"' : '';?>>
										<span class="invalid-feedback">Please enter a valid institution /
											workplace.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormWhatsapp" class="form-label">Whatsapp Number</label>

									<div class="js-form-message">
										<input type="text" class="form-control form-control-sm"
											onkeypress="return isNumberKey(event)" name="whatsAppNumber"
											id="validationFormWhatsapp" placeholder="Whatsapp Number"
											aria-label="Whatsapp Number" required
											data-msg="Please enter a valid whatsapp number."
											<?= isset($participants->whatsapp_number) ? 'value="'.$participants->whatsapp_number.'"' : '';?>>
										<span class="form-text"><b>Example:</b> +628123456789 </span>
										<span class="invalid-feedback">Please enter a valid whatsapp number.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormInstagram" class="form-label">Instagram
										Account</label>

									<div class="js-form-message input-group">
										<span class="input-group-text"
											id="basic-addon1">https://www.instagram.com/</span>
										<input type="text" class="form-control form-control-sm"
											onkeypress="return space(event)" name="instagram"
											id="validationFormInstagram" placeholder="Instagram Account"
											aria-label="Instagram Account" required data-msg="Please enter a valid instagram
									account." <?= isset($participants->instagram) ? 'value="'.$participants->instagram.'"' : '';?>>
										<span class="invalid-feedback">Please enter a valid instagram
											account.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormEmergency" class="form-label">Emergency
										Contact</label>

									<div class="js-form-message">
										<input type="text" class="form-control form-control-sm" name="emergency"
											id="validationFormEmergency" placeholder="Emergency Contact"
											aria-label="Emergency Contact" required data-msg="Please enter a valid emergency
									contact." <?= isset($participants->emergency_contact) ? 'value="'.$participants->emergency_contact.'"' : '';?>>
										<span class="invalid-feedback">Please enter a valid emergency
											contact.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormContact" class="form-label">Contact Relation</label>

									<div class="js-form-message">
										<input type="text" class="form-control form-control-sm"
											name="contactRelation" id="validationFormContact"
											placeholder="Contact Relation" aria-label="Contact Relation" required
											data-msg="Please enter a valid contact relation."
											<?= isset($participants->contact_relation) ? 'value="'.$participants->contact_relation.'"' : '';?>>
										<span class="invalid-feedback">Please enter a valid contact relation.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormDisease" class="form-label">Disease History</label>

									<div class="js-form-message">
										<textarea class="form-control form-control-sm" name="disease" required
											id="validationFormDisease"
											rows="5"> <?= isset($participants->disease_history) ? $participants->disease_history : '';?></textarea>
										<span class="form-text"><b>Note:</b> Enter a dash (-) if you have no history
											of disease.</span>
										<span class="invalid-feedback">Please enter a disease history.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormShirt" class="form-label">T-Shirt Size</label>

									<div class="js-form-message">
										<div class="row">
											<div class="col-3 mb-2">
												<!-- Form Radio -->
												<label class="form-control form-control-sm" for="formShirtS">
													<span class="form-check">
														<input type="radio" class="form-check-input" name="tshirt"
															value="S" id="formShirtS"
															<?= isset($participants->tshirt_size) ? ($participants->tshirt_size == 'S' ? 'checked' : '') : '';?>
															required>
														<span class="form-check-label">S</span>
													</span>
												</label>
												<!-- End Form Radio -->
											</div>

											<div class="col-3 mb-2">
												<!-- Form Radio -->
												<label class="form-control form-control-sm" for="formShirtM">
													<span class="form-check">
														<input type="radio" class="form-check-input" name="tshirt"
															value="M" id="formShirtM"
															<?= isset($participants->tshirt_size) ? ($participants->tshirt_size == 'M' ? 'checked' : '') : '';?>
															required>
														<span class="form-check-label">M</span>
													</span>
												</label>
												<!-- End Form Radio -->
											</div>

											<div class="col-3 mb-2">
												<!-- Form Radio -->
												<label class="form-control form-control-sm" for="formShirtL">
													<span class="form-check">
														<input type="radio" class="form-check-input" name="tshirt"
															value="L" id="formShirtL"
															<?= isset($participants->tshirt_size) ? ($participants->tshirt_size == 'L' ? 'checked' : '') : '';?>
															required>
														<span class="form-check-label">L</span>
													</span>
												</label>
												<!-- End Form Radio -->
											</div>

											<div class="col-3 mb-2">
												<!-- Form Radio -->
												<label class="form-control form-control-sm" for="formShirtXL">
													<span class="form-check">
														<input type="radio" class="form-check-input" name="tshirt"
															value="XL" id="formShirtXL"
															<?= isset($participants->tshirt_size) ? ($participants->tshirt_size == 'XL' ? 'checked' : '') : '';?>
															required>
														<span class="form-check-label">XL</span>
													</span>
												</label>
												<!-- End Form Radio -->
											</div>

											<div class="col-3 mb-2">
												<!-- Form Radio -->
												<label class="form-control form-control-sm" for="formShirtXXL">
													<span class="form-check">
														<input type="radio" class="form-check-input" name="tshirt"
															value="XXL" id="formShirtXXL"
															<?= isset($participants->tshirt_size) ? ($participants->tshirt_size == 'XXL' ? 'checked' : '') : '';?>
															required>
														<span class="form-check-label">XXL</span>
													</span>
												</label>
												<!-- End Form Radio -->
											</div>
										</div>
										<span class="invalid-feedback">Please enter a valid tshirt size.</span>
									</div>
								</div>
								<!-- End Form Group -->

								<!-- Footer -->
								<div class="d-flex align-items-center mt-5">
									<div class="ms-auto">
										<button type="button" class="btn btn-primary btn-sm" onclick="stepOneSave()"
											data-hs-step-form-next-options='{"targetSelector": "#formOthers"}'>
											Next <i class="bi-chevron-right small"></i>
										</button>
									</div>
								</div>
								<!-- End Footer -->
							</div>

							<div id="formOthers" style="display: none; min-height: 15rem;">
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel" class="form-label">Experience</label>

									<div class="js-form-message">
										<textarea class="form-control form-control-sm" name="experience" required
											rows="5"><?= isset($participants->experience) ? $participants->experience : ''?></textarea>
										<span class="form-text"><b>Note:</b> Enter a dash (-) if you have no
											experience.</span>
										<span class="invalid-feedback">Please enter a experience.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel" class="form-label">Achievements</label>

									<div class="js-form-message">
										<textarea class="form-control form-control-sm" name="achievements" required
											rows="5"><?= isset($participants->achievements) ? $participants->achievements : ''?></textarea>
										<span class="form-text"><b>Note:</b> Enter a dash (-) if you have no
											achievements.</span>
										<span class="invalid-feedback">Please enter a achievements.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel" class="form-label">Social
										Projects</label>

									<div class="js-form-message">
										<textarea class="form-control form-control-sm" name="socialProjects"
											required
											rows="5"><?= isset($participants->social_projects) ? $participants->social_projects : ''?></textarea>
										<span class="form-text"><b>Note:</b> Enter a dash (-) if you have no social
											projects.</span>
										<span class="invalid-feedback">Please enter a social projects.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel" class="form-label">Talents</label>

									<div class="js-form-message">
										<textarea class="form-control form-control-sm" name="talents" required
											rows="5"><?= isset($participants->talents) ? $participants->talents : ''?></textarea>
										<span class="form-text"><b>Note:</b> Enter a dash (-) if you have no
											talents.</span>
										<span class="invalid-feedback">Please enter a social talents.</span>
									</div>
								</div>
								<!-- End Form Group -->

								<!-- Footer -->
								<div class="d-flex align-items-center mt-5">
									<button type="button" class="btn btn-outline-secondary btn-sm me-2"
										data-hs-step-form-prev-options='{"targetSelector": "#formBasic"}'>
										<i class="bi-chevron-left small"></i> Previous
									</button>

									<div class="ms-auto">
										<button type="button" class="btn btn-primary btn-sm" onclick="stepTwoSave()"
											data-hs-step-form-next-options='{"targetSelector": "#formEssay"}'>
											Next <i class="bi-chevron-right small"></i>
										</button>
									</div>
								</div>
								<!-- End Footer -->
							</div>

							<div id="formEssay" style="display: none; min-height: 15rem;">
								<p>ANSWER EACH OF THE FOLLOWING QUESTIONS AND EXPLAIN YOUR ANALYSIS BRIEFLY. EACH
									ANSWER
									CAN BE FILLED IN USING A MAXIMUM OF <b>200 WORDS</b>.
								</p>
								<?php if(!empty($m_essay)):?>
								<?php foreach($m_essay as $key => $val):?>
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel"
										class="form-label"><?= $val->question;?></label>

									<div class="js-form-message">
										<?php if($val->type == 'textarea'):?>
										<span class="show" id="showtext<?= $val->id;?>">0 words</span>
										<textarea class="form-control form-control-sm formEssay"
											name="essay[<?= $val->id;?>][]"
											<?= $val->required == 1 ? 'required' : '';?> id="text<?= $val->id;?>"
											rows="5"><?= !empty($p_essay) && isset($p_essay[$val->id]->answer) ? $p_essay[$val->id]->answer : '';?></textarea>
										<?php else:?>
										<input class="form-control form-control-sm formEssay"
											name="essay[<?= $val->id;?>][]"
											<?= $val->required == 1 ? 'required' : '';?> rows="5">
										<?php endif;?>
										<span class="form-text"> <?= $val->desc;?></span>
										<span class="invalid-feedback">Please enter a achievements.</span>
									</div>
								</div>

								<!-- End Form Group -->
								<?php endforeach;?>
								<?php endif;?>
								<script>
									$(document).ready(function () {
										$('textarea.formEssay').each(function () {
											$('#' + $(this).attr('id')).keydown(function (e) {
												// Get the input text value
												var text = document.getElementById($(this).attr('id')).value;
												// Initialize the word counter
												var numWords = 0;

												// Loop through the text
												// and count spaces in it
												for (var i = 0; i < text.length; i++) {
													var currentCharacter = text[i];

													// Check if the character is a space
													if (currentCharacter == " ") {
														numWords += 1;
													}
												}

												// Add 1 to make the count equal to
												// the number of words
												// (count of words = count of spaces + 1)
												// numWords += 1;

												if (numWords >= 200) {
													e.preventDefault();
												}

												console.log("show" + $(this).attr('id'));
												// Display it as output
												$("#show" + $(this).attr('id')).html(numWords + " words");
											});
										});
									});

								</script>
								<!-- Footer -->
								<div class="d-flex align-items-center mt-5">
									<button type="button" class="btn btn-outline-secondary btn-sm me-2"
										data-hs-step-form-prev-options='{"targetSelector": "#formOthers"}'>
										<i class="bi-chevron-left small"></i> Previous
									</button>

									<div class="ms-auto">
										<button type="button" class="btn btn-primary btn-sm"
											onclick="stepThreeSave()"
											data-hs-step-form-next-options='{"targetSelector": "#formProgram"}'>
											Next <i class="bi-chevron-right small"></i>
										</button>
									</div>
								</div>
								<!-- End Footer -->
							</div>

							<div id="formProgram" style="display: none; min-height: 15rem;">
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel" class="form-label">How do you know
										about
										this program?
									</label>
									<div class="js-form-message">
										<div class="tom-select-custom">
											<select class="js-select form-select form-select-sm" autocomplete="off"
												id="validationFormNationality" name="source"
												data-hs-tom-select-options='{"placeholder": "Choose Source..."}'
												required>
												<option value="Facebook"
													<?= isset($participants->source) && $participants->source == 'Facebook' ? 'selected' : ''?>>
													Facebook
												</option>
												<option value="Instagram"
													<?= isset($participants->source) && $participants->source == 'Instagram' ? 'selected' : ''?>>
													Instagram
												</option>
												<option value="Friends"
													<?= isset($participants->source) && $participants->source == 'Friends' ? 'selected' : ''?>>
													Friends
												</option>
												<option value="Others"
													<?= isset($participants->source) && $participants->source == 'Others' ? 'selected' : ''?>>
													Others</option>
											</select>
										</div>
										<span class="invalid-feedback">Please enter a valid tshirt size.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel" class="form-label">Source
										Account/Name</label>

									<div class="js-form-message">
										<input type="text" class="form-control" name="sourceAccount"
											id="validationFormUsernameLabel" placeholder="Source Account / Name"
											aria-label="sourceAccount"
											value="<?= isset($participants->source_account) ? $participants->source_account : '' ?>"
											required data-msg="Please enter your fullname.">
										<span class="invalid-feedback">Please enter a valid source.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel" class="form-label">Twibbon Link</label>

									<div class="js-form-message">
										<input type="text" class="form-control" name="twibbon_link"
											id="validationFormUsernameLabel" placeholder="Twibbon Link"
											aria-label="sourceAccount"
											value="<?= isset($participants->twibbon_link) ? $participants->twibbon_link : '' ?>"
											required data-msg="Please enter your fullname.">
										<span class="form-text"><b>Note:</b> Paste the link to your twibbon. The
											twibbon can uploaded to Instagram or Facebook.</span>
										<br>
										<small class="form-text"><b>Link:</b> <a href="https://twb.nz/meysummit2023" target="_blank" rel="noopener noreferrer">https://twb.nz/meysummit2023</a>.</small>
										<span class="invalid-feedback">Please enter a valid twibbon link.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormUsernameLabel" class="form-label">Share Requirement
										Proof
										Link</label>

									<div class="js-form-message">
										<input type="text" class="form-control" name="shareRequirement"
											id="validationFormUsernameLabel"
											placeholder="Share Requirement Proof Link"
											value="<?= isset($participants->share_proof_link) ? $participants->share_proof_link : '' ?>"
											aria-label="sourceAccount" required
											data-msg="Please enter your fullname.">
										<span class="form-text"><b>Note:</b> As mentioned in the Registration
											Guidelines, you need to do the followings:
											<ul>
												<li>Follow Istanbull Youth Summit and Youth Break the Boundaries
													Instagram & TikTok
													<ul>
														<li><b>Instagram YBB: </b><a href="https://www.instagram.com/youthbreaktheboundaries" target="_blank" rel="noopener noreferrer">https://www.instagram.com/youthbreaktheboundaries</a></li>
														<li><b>Instagram MEYS: </b><a href="https://www.instagram.com/meysummit" target="_blank" rel="noopener noreferrer">https://www.instagram.com/meysummit</a></li>
														<li><b>Tiktok YBB: </b><a href="https://www.tiktok.com/@youthbreaktheboundaries" target="_blank" rel="noopener noreferrer">https://www.tiktok.com/@youthbreaktheboundaries</a></li>
														<li><b>Tiktok MEYS: </b><a href="https://www.tiktok.com/@middleeastyouthsummit" target="_blank" rel="noopener noreferrer">https://www.tiktok.com/@middleeastyouthsummit</a></li>
													</ul>
												</li>
												<li>Join Istanbull Youth Summit and Youth Break the Boundaries
													Telegram channel
													<ul>
														<li><b>Telegram YBB: </b><a href="http://t.me/youthbreaktheboundaries" target="_blank" rel="noopener noreferrer">http://t.me/youthbreaktheboundaries</a></li>
														<li><b>Telegram MEYS: </b><a href="https://www.tiktok.com/@middleeastyouthsummit" target="_blank" rel="noopener noreferrer">https://www.tiktok.com/@middleeastyouthsummit</a></li>
													</ul>
												</li>
												<li>Subscribe YouTube channel YBB</li>
												<li>Tag 5 of your friends & @middleeastyouthsummit on your twibbon
													Instagram / social media post.</li>
												<li>Share the program information of the Istanbull Youth Summit to
													3
													WhatsApp Groups</li>
											</ul>
											Take a screenshot of each action above and upload it to your storage
											drive.
											Please copy the link and paste it into the input form above. (Make sure
											the
											folder is accessible to the public and not private).
										</span>
										<span class="invalid-feedback">Please enter a valid share requirement
											proofspan>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="referral_code" class="form-label">Referral Code <span
											class="fw-normal">(optional)</span></label>

									<div class="js-form-message input-group">
										<input type="text" class="form-control form-control-sm" name="referral"
											id="referral_code" placeholder="Referral Code"
											value="<?= isset($participants->referral_code) && $participants->referral_code !== 0 ? $participants->referral_code : '' ;?>"
											aria-label="sourceAccount" data-msg="Please enter your fullname."
											onkeyup="checkReferral()">
										<button class="btn btn-success btn-sm" onclick="checkReferral()"
											type="button" id="button-addon2">Check</button>
									</div>
									<span class="form-text"><b>Note:</b> Enter a dash (-) if you don't have any
										code.</span>
									<div class="form-text mt-0" id="checkRCStatus"></div>
									<?php if(isset($participants->referral_code) && $participants->referral_code != "" && !is_null($participants->referral_code) && $participants->referral_code !== 0):?>
									<div class="form-text mt-0" id="RCStatus"><span class="text-success">Your
											referral
											code is valid, affiliate with <b><?= $participants->fullname;?></b>
											!</span>
									</div>
									<?php endif;?>
									<div class="invalid-feedback">Please enter a valid referral.</div>
								</div>
								<!-- End Form Group -->

								<!-- Footer -->
								<div class="d-flex align-items-center mt-5">
									<button type="button" class="btn btn-outline-secondary btn-sm me-2"
										data-hs-step-form-prev-options='{"targetSelector": "#formEssay"}'>
										<i class="bi-chevron-left small"></i> Previous
									</button>

									<div class="ms-auto">
										<button type="button" class="btn btn-primary btn-sm"
											onclick="stepFourSave()"
											data-hs-step-form-next-options='{"targetSelector": "#formSelfPhoto"}'>
											Next <i class="bi-chevron-right small"></i>
										</button>
									</div>
								</div>
								<!-- End Footer -->
							</div>

							<div id="formSelfPhoto" style="display: none; min-height: 15rem;">

								<div class="mb-3">
									<label for="self-photo" class="form-label">Please upload your formal
										photo here:</label>

									<div class="js-form-message">
										<figure class="text-center mb-2">
											<img src="#" id="imgthumbnail" class="img-thumbnail img-fluid"
												alt="Thumbnail image"
												onerror="this.onerror=null;this.src='<?= base_url();?><?= isset($participants->self_photo) ? $participants->self_photo : 'assets/images/placeholder.jpg';?>';">
										</figure>
										<div class="input-group">
											<input type="file" class="form-control form-control-sm imgprev"
												name="image" accept="image/*" id="self-photo"
												<?= !isset($participants->self_photo) ? 'required' : '';?>>
											<input type="hidden" name="image64" id="base64SelfPhoto">
										</div>
										<span class="form-text"><b>Note:</b> Choose a formal photo of yourself with
											an
											image ratio of 3:4 (preferably). The cropped preview image does not
											affect
											the original image. max size(1MB)
										</span>
										<span class="invalid-feedback">Please choose self photo.</span>
									</div>
								</div>

								<!-- Footer -->
								<div class="d-flex align-items-center mt-5">
									<button type="button" class="btn btn-outline-secondary btn-sm me-2"
										data-hs-step-form-prev-options='{"targetSelector": "#formProgram"}'>
										<i class="bi-chevron-left small"></i> Previous
									</button>

									<div class="ms-auto">
										<button type="button" class="btn btn-primary btn-sm"
											onclick="stepFiveSave()"
											data-hs-step-form-next-options='{"targetSelector": "#formSubmission"}'>
											Next <i class="bi-chevron-right small"></i>
										</button>
									</div>
								</div>
								<!-- End Footer -->
							</div>

							<div id="formSubmission" style="display: none; min-height: 15rem;">
								<?php if($participants->status == 2):?>
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormPayment" class="form-label">Waiting for review</label>

									<div class="alert alert-soft-info small">
										Your submission is waiting for review, you can still update and resubmit
										your
										submission on this state.
									</div>
								</div>
								<!-- End Form Group -->
								<?php else:?>
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormPayment" class="form-label">Payment</label>

									<div class="alert alert-soft-info small">
										You need to make payment first, before submitted your documents for Middle
										East
										Youth Summit Program. You can go to payments menu on your MEYS account or <a
											href="<?= site_url('user/payments');?>" class="text-primary">click
											here</a>
									</div>
								</div>
								<!-- End Form Group -->
								<!-- Form Group -->
								<div class="mb-3">
									<label for="validationFormTermCondition" class="form-label">Terms &
										Conditions</label>


									<div class="js-form-message form-check">
										<input type="checkbox" id="formHelperCheck1" name="terms"
											class="form-check-input"
											<?= isset($participants->terms_condition) && $participants->terms_condition == 1 ? 'checked' : ''?>
											required>
										<label class="form-check-label" for="formHelperCheck1">I Agree</label>
										<div class="text-muted">I understand and agree to the terms and conditions
											of
											this program and that this program is self-funded meaning that
											participants
											have to pay for the program fee, flights to-from Saudi Arabia, visa, and
											other expenses themselves. However, the quota of delegates for the
											Middle
											East Youth Summit is limited. I am ready to join the Middle East Youth
											Summit 2023.
										</div>
										<span class="invalid-feedback">Please agree with our terms and
											conditions.</span>
									</div>
								</div>
								<!-- End Form Group -->
								<?php endif;?>
								<!-- Footer -->
								<div class="d-flex align-items-center mt-5">
									<button type="button" class="btn btn-outline-secondary btn-sm me-2"
										data-hs-step-form-prev-options='{"targetSelector": "#formSelfPhoto"}'>
										<i class="bi-chevron-left small"></i> Previous
									</button>

									<div class="ms-auto">
										<?php if(isset($participants->is_payment) && $participants->is_payment == 1):?>
										<button type="button" class="btn btn-primary btn-sm" id="sendSubmission"
											onclick="stepSixSave()">Submit
											<i class="bi-check small"></i></button>
										<?php else:?>
										<button type="button" class="btn btn-primary btn-sm" disabled>Please
											make payment first <i class="bi-credit-card small"></i></button>
										<?php endif;?>
									</div>
								</div>
								<!-- End Footer -->
							</div>
						</div>
						<!-- End Content Step Form -->
					</div>
				</div>
				<!-- End Row -->

				<!-- Message Body -->
				<div id="basicVerStepSuccessMessage" class="js-success-message" style="display:none;">
					<div class="text-center">
						<img class="img-fluid mb-3" src="<?= base_url();?>	assets/svg/illustrations/oc-hi-five.svg"
							alt="Image Description" style="max-width: 15rem;">

						<div class="mb-3">
							<h2>Successful!</h2>
							<p>Your submisson has been successfully submitted. You can still edit your submission on
								"Submission Menu" on your MEYS Account.</p>
						</div>

						<div class="d-flex justify-content-center">
							<a class="btn btn-white btn-sm me-3" href="<?= site_url('user/submission');?>">
								<i class="bi-chevron-left small ms-1"></i> Go to your submission
							</a>
						</div>
					</div>
				</div>
				<!-- End Message Body -->
			</form>
			<!-- End Step Form -->

		</div>
		<?php endif;?>
	</div>
	<!-- End Body -->
	<!-- End Card -->
	<!-- Card -->
	<div class="card d-none">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Delete your account</h4>
		</div>

		<!-- Body -->
		<div class="card-body">
			<p class="card-text">When you delete your account, you lose access to Front account services, and
				we permanently delete your personal data. You can cancel the deletion for 14 days.</p>

			<div class="mb-3">
				<!-- Check -->
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="deleteAccountCheckbox">
					<label class="form-check-label" for="deleteAccountCheckbox">Confirm that I want to delete
						my account.</label>
				</div>
				<!-- End Check -->
			</div>

			<div class="d-flex justify-content-end">
				<button type="submit" class="btn btn-danger">Delete</button>
			</div>
		</div>
		<!-- End Body -->
	</div>
	<!-- End Card -->
</div>


<script>
	function stepOneSave() {
		if ($('input[name="fullname"]').val() == '' ||
			$('input[name="birthdate"]').val() == '' ||
			$('input[name="address"]').val() == '' ||
			$('input[name="postal_code"]').val() == '' ||
			$('input[name="city"]').val() == '' ||
			$('input[name="province"]').val() == '' ||
			$('input[name="occupation"]').val() == '' ||
			$('input[name="fieldofstudy"]').val() == '' ||
			$('input[name="institution"]').val() == '' ||
			$('input[name="whatsAppNumber"]').val() == '' ||
			$('input[name="instagram"]').val() == '' ||
			$('input[name="emergency"]').val() == '' ||
			$('input[name="contactRelation"]').val() == '' ||
			$('textarea[name="disease"]').val() == '') {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})

			Toast.fire({
				icon: 'warning',
				title: 'Please fill the requirement field'
			})

			return false;
		}

		const formData = {
			'fullname': $('input[name="fullname"]').val(),
			'birthdate': $('input[name="birthdate"]').val(),
			'gender': $('input[name="gender"]:checked').val(),
			'address': $('input[name="address"]').val(),
			'postal_code': $('input[name="postal_code"]').val(),
			'city': $('input[name="city"]').val(),
			'province': $('input[name="province"]').val(),
			'nationality': $('select[name="nationality"]').val(),
			'nationality_custom': $('input[name="nationality_custom"]').val(),
			'is_custom_nationality': $('input[name="is_custom_nationality"]').val(),
			'occupation': $('input[name="occupation"]').val(),
			'fieldofstudy': $('input[name="fieldofstudy"]').val(),
			'institution': $('input[name="institution"]').val(),
			'whatsAppNumber': $('input[name="whatsAppNumber"]').val(),
			'instagram': $('input[name="instagram"]').val(),
			'emergency': $('input[name="emergency"]').val(),
			'contactRelation': $('input[name="contactRelation"]').val(),
			'disease': $('textarea[name="disease"]').val(),
			'tshirt': $('input[name="tshirt"]:checked').val(),
		}

		$.ajax({
			url: "<?= site_url('api/user/ajxPostBasic')?>",
			method: 'POST',
			data: formData,
			success: function (res) {
				var res = JSON.parse(res);
				if (res.status == true) {
					var Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					})

					Toast.fire({
						icon: 'success',
						title: 'Successfuly save your personal data'
					})
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				var Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})

				Toast.fire({
					icon: 'error',
					title: xhr.status + ' - ' + thrownError
				})
			}
		})
	}

	function stepTwoSave() {
		if ($('textarea[name="experience"]').val() == '' ||
			$('textarea[name="achievements"]').val() == '' ||
			$('textarea[name="socialProjects"]').val() == '' ||
			$('textarea[name="talents"]').val() == '') {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})

			Toast.fire({
				icon: 'warning',
				title: 'Please fill the requirement field'
			})

			return false;
		}

		const formData = {
			'experience': $('textarea[name="experience"]').val(),
			'achievements': $('textarea[name="achievements"]').val(),
			'socialProjects': $('textarea[name="socialProjects"]').val(),
			'talents': $('textarea[name="talents"]').val()
		}

		$.ajax({
			url: "<?= site_url('api/user/ajxPostOther')?>",
			method: 'POST',
			data: formData,
			success: function (res) {
				var res = JSON.parse(res);
				if (res.status == true) {
					var Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					})

					Toast.fire({
						icon: 'success',
						title: 'Successfuly save your others information'
					})
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				var Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})

				Toast.fire({
					icon: 'error',
					title: xhr.status + ' - ' + thrownError
				})
			}
		})
	}

	function stepThreeSave() {
		var formData = {};
		$.each($('textarea[name^="essay\\["] , input[name^="essay\\["]').serializeArray(), function () {
			var vv = this.name.replace(/(\[[0-9]\])$/, '');
			formData[vv] = this.value;
		});
		$.ajax({
			url: "<?= site_url('api/user/ajxPostEssay')?>",
			method: 'POST',
			data: formData,
			success: function (res) {
				var res = JSON.parse(res);
				if (res.status == true) {
					var Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					})

					Toast.fire({
						icon: 'success',
						title: 'Successfuly save your essay'
					})
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				var Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})

				Toast.fire({
					icon: 'error',
					title: xhr.status + ' - ' + thrownError
				})
			}
		})
	}

	function stepFourSave() {
		if ($('input[name="sourceAccount"]').val() == '' ||
			$('input[name="twibbon_link"]').val() == '' ||
			$('input[name="shareRequirement"]').val() == '') {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})

			Toast.fire({
				icon: 'warning',
				title: 'Please fill the requirement field'
			})

			return false;
		}

		const formData = {
			'source': $('select[name="source"]').val(),
			'sourceAccount': $('input[name="sourceAccount"]').val(),
			'twibbon_link': $('input[name="twibbon_link"]').val(),
			'shareRequirement': $('input[name="shareRequirement"]').val(),
			'referral': $('input[name="referral"]').val(),
		}

		$.ajax({
			url: "<?= site_url('api/user/ajxPostProgram')?>",
			method: 'POST',
			data: formData,
			success: function (res) {
				var res = JSON.parse(res);
				if (res.status == true) {
					var Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					})

					Toast.fire({
						icon: 'success',
						title: 'Successfuly save your program information'
					})
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				var Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})

				Toast.fire({
					icon: 'error',
					title: xhr.status + ' - ' + thrownError
				})
			}
		})
	}

	function checkReferral() {
		$('#RCStatus').attr('hidden', true);

		var rc = $('#referral_code').val()
		$.ajax({
			url: "<?= site_url('api/user/ajxCheckRC')?>",
			method: 'POST',
			data: {
				referral: rc
			},
			success: function (res) {
				var res = JSON.parse(res);
				$('#checkRCStatus').attr('hidden', false);
				if (res.status == true) {
					$('#checkRCStatus').html(
						`<span class="text-success">Your referral code is valid, affiliate with <b>` + res
						.data.fullname + `</b> !</span>`);
				} else {
					$('#checkRCStatus').attr('hidden', false);
					$('#checkRCStatus').html(
						`<span class="form-text text-danger">The referral code you entered doesn't exist. Try again.!</span>`
					);
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				var Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})

				Toast.fire({
					icon: 'error',
					title: xhr.status + ' - ' + thrownError
				})
			}
		})
	}

	document.querySelector('input[name="image"]').addEventListener("change", function (e) {
		var file = e.target.files[0];
		if (file.size <= (1 * 1024 * 1024)) {
			toBase64(file).then(
				data => document.getElementById('base64SelfPhoto').value = data
			);
		} else {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})

			Toast.fire({
				icon: 'error',
				title: 'Maximum file size for Self Photo is 1Mb'
			})
		}
	})

	function stepFiveSave() {
		if ($('#base64SelfPhoto').val() == '') {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})

			Toast.fire({
				icon: 'warning',
				title: 'Please fill the requirement field'
			})

			return false;
		}

		const formData = {
			'image': $('#base64SelfPhoto').val(),
		}
		$.ajax({
			url: "<?= site_url('api/user/ajxPostSelf')?>",
			method: 'POST',
			data: formData,
			success: function (res) {
				var res = JSON.parse(res);
				if (res.status == true) {
					var Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					})

					Toast.fire({
						icon: 'success',
						title: 'Successfuly save your self photo information'
					})
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				var Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})

				Toast.fire({
					icon: 'error',
					title: xhr.status + ' - ' + thrownError
				})
			}
		})
	}

	function stepSixSave() {

		$.ajax({
			url: "<?= site_url('api/user/ajxPostSubmission')?>",
			method: 'POST',
			success: function (res) {
				var res = JSON.parse(res);
				if (res.status == true) {
					var Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					})

					Toast.fire({
						icon: 'success',
						title: 'Successfuly submit your data'
					})
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				var Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})

				Toast.fire({
					icon: 'error',
					title: xhr.status + ' - ' + thrownError
				})
			}
		})
	}

	$(function () {
		$('.select2').select2({
			minimumInputLength: 3,
			allowClear: true,
			placeholder: 'Choose nationality',
			ajax: {
				dataType: 'json',
				url: "<?= site_url('api/user/getNationality');?>",
				delay: 800,
				data: function (params) {
					return {
						search: params.term
					}
				},
				processResults: function (data, page) {
					return {
						results: data
					};
				},
			}
		}).on('select2:select', function (evt) {
			var data = $(".select2 option:selected").text();
		});
	});

	function displayCustomNationality() {
		custom = document.getElementById('custom-nationality');
		select = document.getElementById('select-nationality');
		is_custom = $('input[name="is_custom_nationality"]');

		if (custom.style.display == 'none') {
			is_custom.val(-1);
			custom.style.display = 'block';
			select.style.display = 'none';
		} else {
			is_custom.val(0);
			custom.style.display = 'none';
			select.style.display = 'block';
		}
	}

</script>
