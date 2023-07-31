<div class="d-grid gap-3 gap-lg-5">
	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h4 class="card-header-title">Announcements</h4>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<?php if(!empty($announcements)):?>
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
				<thead class="thead-light">
					<tr>
						<th>Announcements</th>
						<th>Date</th>
						<th style="width: 5%;"></th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($announcements as $val):?>
					<tr>
						<td><?= $val->title;?></td>
						<td><?= date("d F Y - H:i", ($val->created_at));?></td>
						<td>
							<button class="btn text-body" href="javascript:;" data-bs-toggle="modal"
								data-bs-target="#read-<?= $val->id;?>">
								<i class="bi-book-half"></i>
							</button>
						</td>
					</tr>

					<!-- Modal -->
					<div id="read-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
						aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<h3><?= $val->title;?></h3>
									<figure class="mb-4">
										<img src="#" id="imgthumbnail" class="img-thumbnail img-fluid"
											alt="Thumbnail image"
											onerror="this.onerror=null;this.src='<?= base_url();?><?= $val->poster == null ? 'assets/images/placeholder.jpg' : $val->poster;?>';">
									</figure>
									<?= $val->content;?>
								</div>
							</div>
						</div>
					</div>
					<!-- End Modal -->

					<?php endforeach;?>
				</tbody>
			</table>
			<?php else:?>
			<div class="w-sm-75 w-lg-50 text-center mx-sm-auto">
				<div class="mb-7">
					<img class="img-fluid" src="<?= base_url();?>assets/svg/illustrations/oc-relaxing.svg"
						alt="SVG Illustration">
				</div>

				<h1 class="h2">No announcements yet.</h1>
				<p> Stay tuned for announcements at the Middle East Youth Summit. Immediately complete your
					personal data!</p>
			</div>
			<?php endif;?>
		</div>
		<!-- End Table -->
	</div>
	<!-- End Card -->
</div>
