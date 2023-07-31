  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main">
  	<!-- Navbar -->
  	<nav class="js-nav-scroller navbar navbar-expand-lg navbar-sidebar navbar-vertical navbar-light bg-white border-end"
  		data-hs-nav-scroller-options='{
            "type": "vertical",
            "target": ".navbar-nav .active",
            "offset": 80
           }'>
  		<!-- Navbar Toggle -->
  		<button type="button" class="navbar-toggler btn btn-white d-grid w-100" data-bs-toggle="collapse"
  			data-bs-target="#navbarVerticalNavMenu" aria-label="Toggle navigation" aria-expanded="false"
  			aria-controls="navbarVerticalNavMenu">
  			<span class="d-flex justify-content-between align-items-center">
  				<span class="h3 mb-0">Nav menu</span>

  				<span class="navbar-toggler-default">
  					<i class="bi-list"></i>
  				</span>

  				<span class="navbar-toggler-toggled">
  					<i class="bi-x"></i>
  				</span>
  			</span>
  		</button>
  		<!-- End Navbar Toggle -->

  		<!-- Navbar Collapse -->
  		<div id="navbarVerticalNavMenu" class="collapse navbar-collapse">
  			<div class="navbar-brand-wrapper border-end" style="height: auto;">
  				<!-- Default Logo -->
  				<div class="d-flex align-items-center mb-3">
  					<a class="navbar-brand" href="<?= site_url('dashboard'); ?>" aria-label="Space">
  						<img class="navbar-brand-logo" src="<?= base_url(); ?><?= $web_logo;?>" alt="Logo">
  					</a>
  					<a class="navbar-brand-badge">
  						<span class="badge bg-soft-primary text-primary ms-2">v2.0.9</span>
  					</a>
  				</div>
  				<!-- End Default Logo -->
  			</div>

  			<div class="docs-navbar-sidebar-aside-body navbar-sidebar-aside-body">
  				<ul id="navbarSettings" class="navbar-nav nav nav-vertical nav-tabs nav-tabs-borderless nav-sm">
  					<li class="nav-item" id="tour-dashboard">
  						<a class="nav-link <?= ($this->uri->segment(2) == "dashboard" ? "active" : "") ?>"
  							href="<?= site_url('admin/dashboard'); ?>"><i class="bi bi-window nav-icon"></i>
  							Dashboard</a>
  					</li>
  					<li class="nav-item" id="tour-statistics">
  						<a class="nav-link <?= ($this->uri->segment(2) == "statistics" ? "active" : "") ?>"
  							href="<?= site_url('admin/statistics'); ?>"><i class="bi bi-activity nav-icon"></i>
  							Statistics</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Participants</span>
  					</li>
  					<li class="nav-item" id="tour-participans">
  						<a class="nav-link <?= ($this->uri->segment(2) == "participans" ? "active" : "") ?>"
  							href="<?= site_url('admin/participans'); ?>"><i class="bi bi-people nav-icon"></i>
  							Participants</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Payment</span>
  					</li>

  					<li class="nav-item" id="tour-payments">
  						<a class="nav-link <?= ($this->uri->segment(2) == "payments" ? "active" : "") ?>"
  							href="<?= site_url('admin/payments'); ?>"><i
  								class="bi bi-cash-stack nav-icon"></i> Payments</a>
  					</li>
  					<li class="nav-item" id="tour-payment-batch">
  						<a class="nav-link <?= ($this->uri->segment(2) == "payment-batch" ? "active" : "") ?>"
  							href="<?= site_url('master/payment-batch'); ?>"><i
  								class="bi bi-credit-card-2-front nav-icon"></i> Payment Batch</a>
  					</li>
  					<li class="nav-item" id="tour-payment-settings">
  						<a class="nav-link <?= ($this->uri->segment(2) == "payment-settings" ? "active" : "") ?>"
  							href="<?= site_url('admin/payment-settings'); ?>"><i
  								class="bi bi-wallet2 nav-icon"></i> Payments Settings</a>
  					</li>
  					<li class="nav-item d-none" id="tour-payment-xendit">
  						<a class="nav-link <?= ($this->uri->segment(2) == "xendit-settings" ? "active" : "") ?>"
  							href="<?= site_url('admin/xendit-settings'); ?>"><img src="<?= base_url();?>assets/images/payments/xendit.png" alt="" class=nav-icon" style="width: 25px !important; margin-left: -4px; margin-top: -5px; margin-right: 10px; "> Xendit Settings</a>
  					</li>
  					<li class="nav-item" id="tour-payment-gateway">
  						<a class="nav-link <?= ($this->uri->segment(2) == "payments-gateway-settings" ? "active" : "") ?>"
  							href="<?= site_url('admin/payments-gateway-settings'); ?>"><i class="bi bi-credit-card nav-icon"></i> Gateway Settings</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Master</span>
  					</li>
  					<li class="nav-item" id="tour-ambassador">
  						<a class="nav-link <?= ($this->uri->segment(2) == "ambassador" ? "active" : "") ?>"
  							href="<?= site_url('master/ambassador'); ?>"><i class="bi bi-people nav-icon"></i>
  							Ambassador</a>
  					</li>
  					<li class="nav-item" id="tour-eligilibity-countries">
  						<a class="nav-link <?= ($this->uri->segment(2) == "eligilibity-countries" ? "active" : "") ?>"
  							href="<?= site_url('master/eligilibity-countries'); ?>"><i
  								class="bi bi-file-break nav-icon"></i>
  							Eligilibity Countries</a>
  					</li>
  					<li class="nav-item" id="tour-announcements">
  						<a class="nav-link <?= ($this->uri->segment(2) == "announcements" ? "active" : "") ?>"
  							href="<?= site_url('master/announcements'); ?>"><i class="bi bi-megaphone nav-icon"></i>
  							Announcements</a>
  					</li>
  					<li class="nav-item" id="tour-faq">
  						<a class="nav-link <?= ($this->uri->segment(2) == "faq" ? "active" : "") ?>"
  							href="<?= site_url('master/faq'); ?>"><i class="bi bi-chat-left-dots nav-icon"></i>
  							FAQ</a>
  					</li>
  					<li class="nav-item d-none" id="tour-entrant">
  						<a class="nav-link <?= ($this->uri->segment(2) == "users" ? "active" : "") ?>"
  							href="<?= site_url('users'); ?>"><i class="bi bi-clipboard nav-icon"></i> Entrant Form</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Settings</span>
  					</li>
  					<li class="nav-item" id="tour-landing">
  						<a class="nav-link dropdown-toggle <?= ($this->uri->segment(2) == "landing-page" ? "active" : "") ?>"
  							href="#snippetsSidebarNavFeaturesCollapse2" role="button" data-bs-toggle="collapse"
  							aria-expanded="false" aria-controls="snippetsSidebarNavFeaturesCollapse2"><i
  								class="bi bi-arrow-up-right-square nav-icon"></i> Landing Page</a>

  						<div id="snippetsSidebarNavFeaturesCollapse2" class="nav-collapse collapse ms-2">
  							<a class="nav-link" href="#">Home</a>
  							<a class="nav-link" href="#">About</a>
  							<a class="nav-link" href="#">Gallery</a>
  							<a class="nav-link" href="#">Guidelines</a>
  							<a class="nav-link" href="#">Sponshorship</a>
  						</div>
  					</li>
  					<li class="nav-item" id="tour-website">
  						<a class="nav-link <?= ($this->uri->segment(2) == "settings" ? "active" : "") ?>"
  							href="<?= site_url('admin/settings'); ?>"><i class="bi bi-sliders nav-icon"></i>
  							Website</a>
  					</li>
  				</ul>
  			</div>
  		</div>
  		<!-- End Navbar Collapse -->
  	</nav>
  	<!-- End Navbar -->
  	<!-- Content -->
  	<div class="navbar-sidebar-aside-content content-space-1 content-space-md-2 px-lg-5 px-xl-10">
