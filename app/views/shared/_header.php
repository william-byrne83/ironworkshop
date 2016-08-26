<!-- === START HEADER === -->
<header class="header sticky-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="logo"><a class="to-top" href="index.html"><img src="/assets/images/logo-for-wall.png" alt="logo"/></a></div>
            </div>
            <div class="col-md-9">
                <nav class="menu">
                    <div class="responsive-menu d-text-c-h"><i class="fa fa-bars"></i></div>
                    <ul>
                        <li <?php echo isset($this->pageSection) && $this->pageSection == 'Home' ? ' class="active"' : ''; ?>><a class="d-text-c-h" data-anchor="slider-section" href="<?php echo isset($this->pageSection) && $this->pageSection != 'Home' ? '/' : '#'; ?>">Home</a></li>
                        <li><a class="d-text-c-h" data-anchor="about-section" href="<?php echo isset($this->pageSection) && $this->pageSection != 'Home' ? '/' : '#'; ?>">About</a></li>
                        <li <?php echo isset($this->pageSection) && $this->pageSection == 'News' ? ' class="active"' : ''; ?>><a class="d-text-c-h" data-anchor="blog-section" href="/news/">News</a>
                        <li <?php echo isset($this->pageSection) && $this->pageSection == 'Trainers' ? ' class="active"' : ''; ?>><a class="d-text-c-h" data-anchor="trainers-section" href="<?php echo isset($this->pageSection) && $this->pageSection != 'Home' ? '/' : '#'; ?>">Trainers</a></li>
                        <li <?php echo isset($this->pageSection) && $this->pageSection == 'Results' ? ' class="active"' : ''; ?>><a class="d-text-c-h" data-anchor="results-section" href="/results/">Results</a></li>
                        <li <?php echo isset($this->pageSection) && $this->pageSection == 'Gallery' ? ' class="active"' : ''; ?>><a class="d-text-c-h" data-anchor="derp-section" href="/galleries/">Gallery</a></li>
                        </li>
                        <li <?php echo isset($this->pageSection) && $this->pageSection == 'Stores' ? ' class="active"' : ''; ?>><a class="d-text-c-h" data-anchor="store-section" href="/stores/">Shop</a></li>
                        <li><a class="d-text-c-h" data-anchor="contact-section" href="/">Contact</a></li>
                        <li <?php echo isset($this->pageSection) && $this->pageSection == 'Faq' ? ' class="active"' : ''; ?>><a class="d-text-c-h" data-anchor="faq-section" href="/faqs/">Faq</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- === END HEADER === -->