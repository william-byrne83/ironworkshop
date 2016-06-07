<!-- === START HEADER === -->
<header class="header sticky-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="logo"><a class="to-top" href="index.html"><img src="/assets/images/IRON-WORKSHOP-BACK.gif" alt="logo"/></a></div>
            </div>
            <div class="col-md-9">
                <nav class="menu">
                    <div class="responsive-menu d-text-c-h"><i class="fa fa-bars"></i></div>
                    <ul>
                        <li <?php echo isset($this->pageSection) && $this->pageSection == 'Home' ? ' class="activesadsadsa"' : ''; ?>><a class="d-text-c-h" data-anchor="slider-section" href="<?php echo isset($this->pageSection) && $this->pageSection != 'Home' ? '/' : '#'; ?>">Home</a></li>
                        <li <?php echo isset($this->pageSection) && $this->pageSection == 'Gallery' ? ' class="active"' : ''; ?>><a class="d-text-c-h" data-anchor="gallery-section" href="/galleries/">Gallery</a></li>
                        <li><a class="d-text-c-h" data-anchor="about-section" href="<?php echo isset($this->pageSection) && $this->pageSection != 'Home' ? '/' : '#'; ?>">About</a></li>
                        <li><a class="d-text-c-h" data-anchor="results-section" href="<?php echo isset($this->pageSection) && $this->pageSection != 'Home' ? '/' : '#'; ?>">Results</a></li>
                        <li><a class="d-text-c-h" data-anchor="trainers-section" href="<?php echo isset($this->pageSection) && $this->pageSection != 'Home' ? '/' : '#'; ?>">Trainers</a></li>
                        <li><a class="d-text-c-h" data-anchor="blog-section" href="#">Blog</a>
                            <ul>
                                <li><a class="d-text-c-h" href="blog.html">Blog with sidebar</a></li>
                                <li><a class="d-text-c-h" href="post.html">Blog post</a></li>
                            </ul>
                        </li>
                        <li ><a class="d-text-c-h" data-anchor="store-section" href="#">Shop</a>
                            <ul>
                                <li><a class="d-text-c-h" href="shop.html">Shop</a></li>
                                <li><a class="d-text-c-h" href="shop-item.html">Shop Item</a></li>
                                <li><a class="d-text-c-h" href="cart.html">Cart</a></li>
                            </ul>
                        </li>
                        <li><a class="d-text-c-h" data-anchor="contact-section" href="#">Contact</a></li>
                        <li><a class="d-text-c-h" data-anchor="faq-section" href="/faqs/">Faq</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- === END HEADER === -->