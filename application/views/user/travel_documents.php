<div class="d-grid gap-3 gap-lg-5">
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Travel Documents</h4>
		</div>

		<div class="card-body">
			<div class="row">
				<div class="col-4 mb-4">
					<!-- Card -->
					<div class="card card-sm">
						<div class="card-body">
							<h3 class="card-title">Passport</h3>
							<?= is_null($passport) ? '<span class="badge bg-danger">Not Completed</span>' : '<span class="badge bg-success">Completed</span>';?>
							<div class="text-center mt-4">
								<img class="" src="<?= base_url()?><?= $web_logo;?>" style="width: 175px;" alt="Logo">
							</div>
							<button data-bs-toggle="modal" data-bs-target="#passport"
								class="btn btn-soft-primary btn-sm w-100 mt-3">Upload</button>
						</div>
					</div>
					<!-- End Card -->
				</div>
				<div class="col-4 mb-4">
					<!-- Card -->
					<div class="card card-sm">
						<div class="card-body">
							<h3 class="card-title">Flight</h3>
							<?= is_null($flight) ? '<span class="badge bg-danger">Not Completed</span>' : '<span class="badge bg-success">Completed</span>';?>
							<div class="text-center mt-4">
								<img class="" src="<?= base_url()?><?= $web_logo;?>" style="width: 175px;" alt="Logo">
							</div>
							<button data-bs-toggle="modal" data-bs-target="#flight"
								class="btn btn-soft-primary btn-sm w-100 mt-3">Upload</button>
						</div>
					</div>
					<!-- End Card -->
				</div>
				<div class="col-4 mb-4">
					<!-- Card -->
					<div class="card card-sm">
						<div class="card-body">
							<h3 class="card-title">Residence</h3>
							<?= is_null($residence) ? '<span class="badge bg-danger">Not Completed</span>' : '<span class="badge bg-success">Completed</span>';?>
							<div class="text-center mt-4">
								<img class="" src="<?= base_url()?><?= $web_logo;?>" style="width: 175px;" alt="Logo">
							</div>
							<button data-bs-toggle="modal" data-bs-target="#residence"
								class="btn btn-soft-primary btn-sm w-100 mt-3">Upload</button>
						</div>
					</div>
					<!-- End Card -->
				</div>
				<div class="col-4 mb-4">
					<!-- Card -->
					<div class="card card-sm">
						<div class="card-body">
							<h3 class="card-title">Vaccine Certificate</h3>
							<?= is_null($vaccine) ? '<span class="badge bg-danger">Not Completed</span>' : '<span class="badge bg-success">Completed</span>';?>
							<div class="text-center mt-4">
								<img class="" src="<?= base_url()?><?= $web_logo;?>" style="width: 175px;" alt="Logo">
							</div>
							<button data-bs-toggle="modal" data-bs-target="#vaccine"
								class="btn btn-soft-primary btn-sm w-100 mt-3">Upload</button>
						</div>
					</div>
					<!-- End Card -->
				</div>
				<div class="col-4 mb-4">
					<!-- Card -->
					<div class="card card-sm">
						<div class="card-body">
							<h3 class="card-title">Visa</h3>
							<?= is_null($visa) ? '<span class="badge bg-danger">Not Completed</span>' : '<span class="badge bg-success">Completed</span>';?>
							<div class="text-center mt-4">
								<img class="" src="<?= base_url()?><?= $web_logo;?>" style="width: 175px;" alt="Logo">
							</div>
							<button data-bs-toggle="modal" data-bs-target="#visa"
								class="btn btn-soft-primary btn-sm w-100 mt-3">Upload</button>
						</div>
					</div>
					<!-- End Card -->
				</div>
			</div>
		</div>
		<div class="card-footer pt-0">
			<div class="card-footer ps-0 pb-0">
				<p><b>Note:</b></p>
				<p>For further information, you can contact: <a href="mailto:<?= $web_email;?>"><?= $web_email;?></a>
				</p>
			</div>
		</div>
	</div>
	<!-- End Card -->
</div>


<!-- Modal -->
<div class="modal fade" id="passport" tabindex="-1" aria-labelledby="passportLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="passportLabel">Upload Passport</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="<?= site_url('api/travel/passport')?>" method="POST" enctype="multipart/form-data" class="js-validate">
				<div class="modal-body">
					<div class="form-group mb-3">
						<label for="">Passport Number</label>
						<input class="form-control" type="text"
							value="<?= !is_null($passport) ? $passport->passport_number : ""?>" name="passport_number"
							required>
					</div>
					<div class="form-group mb-3">
						<label for="">Full Name</label>
						<input class="form-control" type="text"
							value="<?= !is_null($passport) ? $passport->fullname : ""?>" name="fullname" required>
					</div>
					<div class="form-group mb-3">
						<label for="">Passport File</label>
						<figure class="text-center">
							<img src="<?= !is_null($passport) ? base_url().$passport->file : site_url('assets/images/placeholder.jpg')?>"
								id="passport-preview" class="img-thumbnail img-fluid mb-2" alt="Thumbnail image"
								onerror="this.onerror=null;this.src='<?= base_url();?>assets/images/placeholder.jpg';">
						</figure>
						<div class="input-group">
							<input type="file" class="form-control form-control-sm imgprev" name="image"
								accept="image/*" id="passport-upload" required>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="id" value="<?= !is_null($passport) ? $passport->id : null?>">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" href="" class="btn btn-soft-success">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal -->
<!-- Modal -->
<div class="modal fade" id="flight" tabindex="-1" aria-labelledby="flightLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="flightLabel">Upload Flight Information</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="<?= site_url('api/travel/flight')?>" method="POST" enctype="multipart/form-data" class="js-validate">
				<div class="modal-body">
					<h4>DEPARTURE</h4>
					<div class="form-group mb-3">
						<label for="">Departure Airport</label>
						<!-- Select -->
						<div class="tom-select-custom">
							<select class="js-select form-select" autocomplete="off" name="departure_airport"
								data-hs-tom-select-options='{"placeholder": "Select...", "hideSearch": true}'>
								<option value="">Select...</option>
								<option value="Taif International Airport">Taif International Airport</option>
								<option value="King Abdulaziz International Airport" selected>King Abdulaziz
									International Airport</option>
							</select>
						</div>
						<!-- End Select -->
					</div>
					<div class="form-group mb-3">
						<label for="">Departure Date</label> <small>(Based on Ticket)</small>
						<input type="text" class="form-control flatpickr"
							value="<?= !is_null($flight) ? date_format(date_create($flight->departure_date), 'F j, Y') : ""?>"
							name="departure_date" required>
					</div>
					<div class="form-group mb-3">
						<label for="">Departure Time</label> <small>(Based on Ticket)</small>
						<input type="text" class="form-control flatpickrTM"
							value="<?= !is_null($flight) ? $flight->departure_time : ""?>" name="departure_time"
							required>
					</div>
					<div class="form-group mb-3">
						<label for="">Departure Airlane</label>
						<input class="form-control" type="text"
							value="<?= !is_null($flight) ? $flight->departure_airline : ""?>" name="departure_airline"
							required>
					</div>
					<div class="form-group mb-3">
						<label for="">Departure Flight Code</label>
						<input class="form-control" type="text"
							value="<?= !is_null($flight) ? $flight->departure_flightcode : ""?>"
							name="departure_flightcode" required>
					</div>
					<h4>RETURN</h4>
					<div class="form-group mb-3">
						<label for="">Return Airport</label>
						<!-- Select -->
						<div class="tom-select-custom">
							<select class="js-select form-select" autocomplete="off" name="return_airport"
								data-hs-tom-select-options='{"placeholder": "Select..."}'>
								<option value="">Select...</option>
								<option value="Taif International Airport">Taif International Airport</option>
								<option value="King Abdulaziz International Airport" selected>King Abdulaziz
									International Airport</option>
							</select>
						</div>
						<!-- End Select -->
					</div>
					<div class="form-group mb-3">
						<label for="">Return Date</label> <small>(Based on Ticket)</small>
						<input type="text" class="form-control flatpickr"
							value="<?= !is_null($flight) ? date_format(date_create($flight->return_date), 'F j, Y') : ""?>"
							name="return_date" required>
					</div>
					<div class="form-group mb-3">
						<label for="">Return Time</label> <small>(Based on Ticket)</small>
						<input type="text" class="form-control flatpickrTM"
							value="<?= !is_null($flight) ? $flight->return_time : ""?>" name="return_time" required>
					</div>
					<div class="form-group mb-3">
						<label for="">Return Airlane</label>
						<input class="form-control" type="text" name="return_airline"
							value="<?= !is_null($flight) ? $flight->return_airline : ""?>" required>
					</div>
					<div class="form-group mb-3">
						<label for="">Return Flight Code</label>
						<input class="form-control" type="text"
							value="<?= !is_null($flight) ? $flight->return_flightcode : ""?>" name="return_flightcode"
							required>
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="id" value="<?= !is_null($flight) ? $flight->id : null?>">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" href="" class="btn btn-soft-success">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal -->
<!-- Modal -->
<div class="modal fade" id="residence" tabindex="-1" aria-labelledby="residenceLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="residenceLabel">Upload Residence Information</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="<?= site_url('api/travel/residence')?>" method="POST" enctype="multipart/form-data" class="js-validate">
				<div class="modal-body">
					<div class="form-group mb-3">
						<label for="">Type</label>
						<!-- Select -->
						<div class="tom-select-custom">
							<select class="js-select form-select" autocomplete="off" name="type"
								data-hs-tom-select-options='{"placeholder": "Select...", "hideSearch": true}'>
								<option value="">Select...</option>
                                <option value="Hotel"
                                    <?= !is_null($residence) && $residence->type == "Hotel" ? "Selected" : "" ?>>Hotel
                                </option>
                                <option value="Hostel"
                                    <?= !is_null($residence) && $residence->type == "Hostel" ? "Selected" : "" ?>>Hostel
                                </option>
                                <option value="Apartment"
                                    <?= !is_null($residence) && $residence->type == "Apartment" ? "Selected" : "" ?>>
                                    Apartment</option>
                                <option value="Family"
                                    <?= !is_null($residence) && $residence->type == "Family" ? "Selected" : "" ?>>Family
                                </option>
                                <option value="Others"
                                    <?= !is_null($residence) && $residence->type == "Others" ? "Selected" : "" ?>>Others
                                </option>
							</select>
						</div>
					</div>
					<div class="form-group mb-3">
						<label for="">Address</label>
						<input class="form-control" type="text" name="address"
							value="<?= !is_null($residence) ? $residence->address : "" ?>" required>
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="id" value="<?= !is_null($residence) ? $residence->id : null?>">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" href="" class="btn btn-soft-success">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal -->
<!-- Modal -->
<div class="modal fade" id="visa" tabindex="-1" aria-labelledby="visaLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="visaLabel">Upload Visa</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="<?= site_url('api/travel/visa')?>" method="POST" enctype="multipart/form-data" class="js-validate">
				<div class="modal-body">
					<div class="form-group mb-3">
						<label for="">Visa File</label>
						<figure class="text-center">
							<img src="<?= !is_null($visa) ? base_url().$visa->file : site_url('assets/images/placeholder.jpg')?>"
								id="visa-preview" class="img-thumbnail img-fluid mb-2" alt="Thumbnail image"
								onerror="this.onerror=null;this.src='<?= base_url();?>assets/images/placeholder.jpg';">
						</figure>
						<div class="input-group">
							<input type="file" class="form-control form-control-sm imgprev" name="image"
								accept="image/*" id="visa-upload" required>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="id" value="<?= !is_null($visa) ? $visa->id : null?>">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" href="" class="btn btn-soft-success">Upload</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal -->
<!-- Modal -->
<div class="modal fade" id="vaccine" tabindex="-1" aria-labelledby="vaccineLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="vaccineLabel">Upload Vaccine Certificate</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="<?= site_url('api/travel/vaccine')?>" method="POST" enctype="multipart/form-data" class="js-validate">
				<div class="modal-body">
					<div class="form-group mb-3">
						<label for="">Vaccine Certificate File</label>
						<figure class="text-center">
							<img src="<?= !is_null($vaccine) ? base_url().$vaccine->file : site_url('assets/images/placeholder.jpg')?>"
								id="vaccine-preview" class="img-thumbnail img-fluid mb-2" alt="Thumbnail image"
								onerror="this.onerror=null;this.src='<?= base_url();?>assets/images/placeholder.jpg';">
						</figure>
						<div class="input-group">
							<input type="file" class="form-control form-control-sm imgprev" name="image"
								accept="image/*" id="vaccine-upload" required>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="id" value="<?= !is_null($vaccine) ? $vaccine->id : null?>">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" href="" class="btn btn-soft-success">Upload</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal -->

