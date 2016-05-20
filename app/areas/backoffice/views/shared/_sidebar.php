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
                    <a href="#" class="sidebar-nav-menu <?php echo isset($this->pageSection) && $this->pageSection == 'General' ? 'open' : ''; ?>">
	                    <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
	                	<i class="fa fa-cog sidebar-nav-icon"></i>
	                    <span class="sidebar-nav-mini-hide">General</span>
	                </a>
                    <ul>
                        <li><a href="/backoffice/homepage/" <?php echo isset($this->pageSubSection) && $this->pageSubSection == 'Homepage' ? ' class="active"' : ''; ?>>Manage Homepage</a></li>
                        <li><a href="/backoffice/meet-team/" <?php echo isset($this->pageSubSection) && $this->pageSubSection == 'Meet The Team' ? ' class="active"' : ''; ?>>Manage Meet The Team</a></li>
                    </ul>
                </li>
            </ul><!-- END Sidebar Navigation -->
        </div><!-- END Sidebar Content -->
    </div><!-- END Wrapper for scrolling functionality -->
</div><!-- END Main Sidebar -->