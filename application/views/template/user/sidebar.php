    <!-- Breadcrumb -->
    <div class="navbar-dark bg-dark"
    	style="background-image: url(<?= base_url(); ?>assets/svg/components/wave-pattern-light.svg);">
    	<div class="container content-space-4 content-space-b-lg-3">
    		<div class="row align-items-center">
    			<div class="col">
    				<div class="d-none d-lg-block">
    					<h1 class="h2 text-white">Account information</h1>
    				</div>

    				<!-- Breadcrumb -->
    				<nav aria-label="breadcrumb">
    					<ol class="breadcrumb breadcrumb-light mb-0">
    						<li class="breadcrumb-item">Account</li>
    						<li class="breadcrumb-item active" aria-current="page">
    							<?= !empty($this->uri->segment(2)) ? str_replace('-', ' ', $this->uri->segment(2)) : 'Overview'; ?>
    						</li>
    					</ol>
    				</nav>
    				<!-- End Breadcrumb -->
    			</div>
    			<!-- End Col -->

    			<div class="col-auto">
    				<!-- Responsive Toggle Button -->
    				<button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
    					data-bs-target="#sidebarNav" aria-controls="sidebarNav" aria-expanded="false"
    					aria-label="Toggle navigation">
    					<span class="navbar-toggler-default">
    						<i class="bi-list"></i>
    					</span>
    					<span class="navbar-toggler-toggled">
    						<i class="bi-x"></i>
    					</span>
    				</button>
    				<!-- End Responsive Toggle Button -->
    			</div>
    			<!-- End Col -->
    		</div>
    		<!-- End Row -->
    	</div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Content -->
    <div class="container content-space-1 content-space-t-lg-0 content-space-b-lg-2 mt-lg-n10">
    	<div class="row">
    		<div class="col-lg-3">
    			<!-- Navbar -->
    			<div class="navbar-expand-lg navbar-light">
    				<div id="sidebarNav" class="collapse navbar-collapse navbar-vertical">
    					<!-- Card -->
    					<div class="card flex-grow-1 mb-5">
    						<div class="card-body">
    							<!-- Avatar -->
    							<div class="d-none d-lg-block text-center mb-5">
    								<div class="avatar avatar-xxl avatar-circle mb-3">
    									<img class="avatar-img"
    										src="<?= !isset($user_profil->self_photo) ? 'https://i.stack.imgur.com/ZQT8Z.png' : base_url(). '/' . $user_profil->self_photo; ?>"
    										alt="<?= $user->name; ?>" style="height: 110px; width: 110px;">
    									<img class="avatar-status avatar-lg-status"
    										src="<?= base_url(); ?>assets/svg/illustrations/top-vendor.svg"
    										alt="Image Description" data-bs-toggle="tooltip" data-bs-placement="top"
    										title="Verified user">
    								</div>

    								<h4 class="card-title mb-0">
    									<?php $name = explode(" ", $user->name);echo $name[0]; ?></h4>
    								<p class="card-text small">
    									<?= mb_substr($user->email, 0, 4) ?>***@<?php $mail = explode("@", $user->email);echo $mail[1]; ?>
    								</p>
    							</div>
    							<!-- End Avatar -->

    							<!-- Nav -->
    							<span class="text-cap">Account</span>

    							<!-- List -->
    							<ul class="nav nav-sm nav-tabs nav-vertical">
    								<li class="nav-item">
    									<a class="nav-link <?= ($this->uri->segment(1) == "user" && empty($this->uri->segment(2)) ? "active" : "") ?>"
    										href="<?= site_url('user'); ?>">
    										<i class="bi-person-badge nav-icon"></i> Overview
    									</a>
    								</li>
    								<li class="nav-item">
    									<a class="nav-link <?= ($this->uri->segment(2) == "submission" ? "active" : "") ?>"
    										href="<?= site_url('user/submission'); ?>">
    										<i class="bi-clipboard nav-icon"></i> Submission</span>
    									</a>
    								</li>
    								<li class="nav-item">
    									<!-- <a class="nav-link <?= ($this->uri->segment(2) == "payment" ? "active" : "") ?>"
    										href="<?= site_url('user/payment'); ?>"> 
    										<i class="bi-credit-card nav-icon"></i> Payment
    									</a> -->
    									<span class="nav-link text-secondary <?= ($this->uri->segment(2) == "payment" ? "active" : "") ?>"> 
    										<i class="bi-credit-card nav-icon"></i> Payment
    									</span>
    								</li>
    								<li class="nav-item">
    									<a class="nav-link <?= ($this->uri->segment(2) == "announcements" ? "active" : "") ?>"
    										href="<?= site_url('user/announcements'); ?>">
    										<i class="bi-app-indicator nav-icon"></i> Announcements
    										<?php if($countAnnouncements > 0):?><span
    											class="badge bg-soft-info text-info rounded-pill nav-link-badge"><?= $countAnnouncements;?></span><?php endif;?>
    									</a>
    								</li>
    								<li class="nav-item d-none">
    									<a class="nav-link <?= ($this->uri->segment(2) == "travel-documents" ? "active" : "") ?>"
    										href="<?= site_url('user/travel-documents'); ?>">
    										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="nav-icon" style="margin-left: -7.5px; margin-right: 6.5px;"
    											fill="currentColor" class="bi bi-airplane-engines" viewBox="0 0 16 16">
    											<path
    												d="M8 0c-.787 0-1.292.592-1.572 1.151A4.347 4.347 0 0 0 6 3v3.691l-2 1V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.191l-1.17.585A1.5 1.5 0 0 0 0 10.618V12a.5.5 0 0 0 .582.493l1.631-.272.313.937a.5.5 0 0 0 .948 0l.405-1.214 2.21-.369.375 2.253-1.318 1.318A.5.5 0 0 0 5.5 16h5a.5.5 0 0 0 .354-.854l-1.318-1.318.375-2.253 2.21.369.405 1.214a.5.5 0 0 0 .948 0l.313-.937 1.63.272A.5.5 0 0 0 16 12v-1.382a1.5 1.5 0 0 0-.83-1.342L14 8.691V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v.191l-2-1V3c0-.568-.14-1.271-.428-1.849C9.292.591 8.787 0 8 0ZM7 3c0-.432.11-.979.322-1.401C7.542 1.159 7.787 1 8 1c.213 0 .458.158.678.599C8.889 2.02 9 2.569 9 3v4a.5.5 0 0 0 .276.447l5.448 2.724a.5.5 0 0 1 .276.447v.792l-5.418-.903a.5.5 0 0 0-.575.41l-.5 3a.5.5 0 0 0 .14.437l.646.646H6.707l.647-.646a.5.5 0 0 0 .14-.436l-.5-3a.5.5 0 0 0-.576-.411L1 11.41v-.792a.5.5 0 0 1 .276-.447l5.448-2.724A.5.5 0 0 0 7 7V3Z" />
    										</svg> Travel Documents
    									</a>
    								</li>
    								<li class="nav-item">
    									<a class="nav-link <?= ($this->uri->segment(2) == "documents" ? "active" : "") ?>"
    										href="<?= site_url('user/documents'); ?>">
    										<i class="bi-file nav-icon"></i> Documents
    										<?php if($countDocuments > 0):?><span
    											class="badge bg-soft-info text-info rounded-pill nav-link-badge"><?= $countDocuments;?></span><?php endif;?>
    									</a>
    								</li>
    								<li class="nav-item">
    									<a class="nav-link <?= ($this->uri->segment(2) == "settings" ? "active" : "") ?>"
    										href="<?= site_url('user/settings'); ?>">
    										<i class="bi-sliders nav-icon"></i> Settings
    									</a>
    								</li>
    							</ul>
    							<!-- End List -->

    							<div class="d-lg-none">
    								<div class="dropdown-divider"></div>

    								<!-- List -->
    								<ul class="nav nav-sm nav-tabs nav-vertical">
    									<li class="nav-item">
    										<a class="nav-link" href="<?= site_url('logout');?>">
    											<i class="bi-box-arrow-right nav-icon"></i> Sign out
    										</a>
    									</li>
    								</ul>
    								<!-- End List -->
    							</div>
    							<!-- End Nav -->
    						</div>
    					</div>
    					<!-- End Card -->
    				</div>
    			</div>
    			<!-- End Navbar -->
    		</div>
    		<!-- End Col -->

    		<div class="col-lg-9">
