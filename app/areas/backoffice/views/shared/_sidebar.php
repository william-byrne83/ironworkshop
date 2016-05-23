<div id="sidebar">
    <!-- Sidebar Brand -->

    <div id="sidebar-brand" class="themed-background">
        <a href="/backoffice/users/" class="sidebar-title">
	        <i class="fa fa-cube"></i><span class="sidebar-nav-mini-hide"><?php echo SITE_NAME; ?></span>
	    </a>
    </div><!-- END Sidebar Brand -->
    <!-- Wrapper for scrolling functionality -->

    <div id="sidebar-scroll">
        <!-- Sidebar Content -->

        <div class="sidebar-content">
            <!-- Sidebar Navigation -->

            <ul class="sidebar-nav">
                <li>
                	<a href="/backoffice/adminusers/" <?php echo isset($this->pageSection) && $this->pageSection == 'Admin Users' ? ' class="active"' : ''; ?>>
						<i class="fa fa-user sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Admin Users</span>
					</a>
				</li>

                <li>
                	<a href="/backoffice/about-us/" <?php echo isset($this->pageSection) && $this->pageSection == 'About Us' ? ' class="active"' : ''; ?>>
						<i class="fa fa-book sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">About Us</span>
					</a>
				</li>

                <li>
                    <a href="#" class="sidebar-nav-menu <?php echo isset($this->pageSection) && $this->pageSection == 'News' ? 'open' : ''; ?>">
	                    <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
	                	<i class="fa fa-newspaper-o sidebar-nav-icon"></i>
	                    <span class="sidebar-nav-mini-hide">News</span>
	                </a>
                    <ul>
                        <li><a href="/backoffice/news/" <?php echo isset($this->pageSubSection) && $this->pageSubSection == 'News Index' ? ' class="active"' : ''; ?>>Manage News</a></li>
                        <li><a href="/backoffice/categories/" <?php echo isset($this->pageSubSection) && $this->pageSubSection == 'Category Index' ? ' class="active"' : ''; ?>>Manage News Categories</a></li>
                    </ul>
                </li>

                <li>
                	<a href="/backoffice/contact-us/" <?php echo isset($this->pageSection) && $this->pageSection == 'Contact Us' ? ' class="active"' : ''; ?>>
						<i class="fa fa-map-marker sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Contact Us</span>
					</a>
				</li>

                <li>
                	<a href="/backoffice/emails/" <?php echo isset($this->pageSection) && $this->pageSection == 'Emails' ? ' class="active"' : ''; ?>>
						<i class="fa fa-envelope-o sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Newsletter Emails</span>
					</a>
				</li>

                <li>
                	<a href="/backoffice/faqs/" <?php echo isset($this->pageSection) && $this->pageSection == 'Faq' ? ' class="active"' : ''; ?>>
						<i class="fa fa-question sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Faqs</span>
					</a>
				</li>

                <li>
                	<a href="/backoffice/galleries/" <?php echo isset($this->pageSection) && $this->pageSection == 'Gallery' ? ' class="active"' : ''; ?>>
						<i class="fa fa-picture-o sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Gallery</span>
					</a>
				</li>

                <li>
                	<a href="/backoffice/results/" <?php echo isset($this->pageSection) && $this->pageSection == 'Results' ? ' class="active"' : ''; ?>>
						<i class="fa fa-trophy  sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Results</span>
					</a>
				</li>

                <li>
                	<a href="/backoffice/stores/" <?php echo isset($this->pageSection) && $this->pageSection == 'Stores' ? ' class="active"' : ''; ?>>
						<i class="fa fa-shopping-cart   sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Stores</span>
					</a>
				</li>

                <li>
                	<a href="/backoffice/trainers/" <?php echo isset($this->pageSection) && $this->pageSection == 'Trainers' ? ' class="active"' : ''; ?>>
						<i class="fa fa-users sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Trainers</span>
					</a>
				</li>

            </ul><!-- END Sidebar Navigation -->
        </div><!-- END Sidebar Content -->
    </div><!-- END Wrapper for scrolling functionality -->
</div><!-- END Main Sidebar -->