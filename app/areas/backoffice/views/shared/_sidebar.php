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
                	<a href="/backoffice/users/" <?php echo isset($this->pageSection) && $this->pageSection == 'Users' ? ' class="active"' : ''; ?>>
						<i class="fa fa-users sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Frontend Users</span>
					</a>
				</li>
            </ul><!-- END Sidebar Navigation -->
        </div><!-- END Sidebar Content -->
    </div><!-- END Wrapper for scrolling functionality -->
</div><!-- END Main Sidebar -->