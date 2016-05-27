<!-- === START CONTENT === -->
    <div class="content">
        <!-- === START SLIDER SECTION === -->
        <section class="slider-section" id="slider-section">
            <div class="slider" data-theme-plugin="slider" data-theme-item=".slide" data-theme-next=".slide-right" data-theme-prev=".slide-left" data-theme-container=".slide-wrapper">
                <ul class="slider-arrows">
                    <li class="slide-left"><i class="fa fa-angle-left"></i></li>
                    <li class="slide-right"><i class="fa fa-angle-right"></i></li>
                </ul>
                <div class="bg-cover"></div>
                <ul class="slide-wrapper">
                    <?php foreach ($this->homepage[0]['images'] as $image){?>
                        <li class="slide">
                            <div class="slide-text">
                                <h4 class="wow rollIn" data-wow-delay="1s">Iron Workshop</h4>
                                <h2 class="wow fadeInDown" data-wow-delay="1s">Belfast Gym</h2>
                                <h5 class="wow bounceInRight" data-wow-delay="1s"><?php echo $this->homepage[0]['title']?></h5>
                            </div>
                            <img src="/assets/uploads/homepages/<?php echo $image['image']?>" alt="<?php echo $image['title']?>" style = "width:1920px">
                        </li>
                    <?php } ?>
                </ul>

                <ul class="slider-dots" data-theme-plugin="bullets">
                    <li class="d-border-c-h"></li>
                    <li class="d-border-c-h"></li>
                    <li class="d-border-c-h"></li>
                </ul>
            </div>
        </section>
        <!-- === END SLIDER SECTION === -->


        <!-- === START INFO SECTION === -->
        <div class="info-section">
            <div class="container">
                <div class="col-md-4">
                    <div class="info-details d-bg-c wow bounceInLeft">
                        <h4>Opening hours</h4>
                        <ul class="ul-time">
                            <?php if(!empty($this->about[0])){?>
                                <li>Monday <?php echo $this->about[0]['monday']?></li>
                                <li>Tuesday <?php echo $this->about[0]['tuesday']?></li>
                                <li>Wednesday <?php echo $this->about[0]['wednesday']?></li>
                                <li>Thursday <?php echo $this->about[0]['thursday']?></li>
                                <li>Friday <?php echo $this->about[0]['friday']?></li>
                                <li>Saturday <?php echo $this->about[0]['saturday']?></li>
                                <li>Sunday <?php echo $this->about[0]['sunday']?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="under-button wow bounceInUp">
                        <span></span>
                        <a href="#about-section" data-anchor="about-section" class="d-border-c d-bg-c-h d-text-c">about us</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-details info-details-center d-bg-c wow flipInX">
                        <h4>Membership</h4>
                        <div class="info-image"><img src="/assets/images/info-img.jpg" alt="image" /></div>
                        <ul class="ul-calendar">
                            <?php if(!empty($this->about[0]['pricing'])){?>
                                <li>
                                    <?php echo $this->about[0]['pricing']?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="under-button wow bounceInUp">
                        <span></span>
                        <a href="/stores/" class="d-border-c d-bg-c-h d-text-c">shop</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-details d-bg-c wow bounceInRight">
                        <h4>Contact info</h4>
                        <ul class="ul-contact">
                            <?php if(!empty($this->contact[0]['location'])){?>
                                <li class="ul-contact-1">
                                    <p><?php echo $this->contact[0]['location'];?></p>
                                </li>
                            <?php } ?>
                            <?php if(!empty($this->contact[0]['phone'])){?>
                                <li class="ul-contact-2">
                                    <p><?php echo $this->contact[0]['phone'];?></p>
                                </li>
                            <?php } ?>
                            <?php if(!empty($this->contact[0]['email'])){?>
                                <li class="ul-contact-3"><a href="mailto:<?php echo $this->contact[0]['email'];?>"><?php echo $this->contact[0]['email'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="under-button wow bounceInUp">
                        <span></span>
                        <a href="#contact-section" data-anchor="contact-section" class="d-border-c d-bg-c-h d-text-c">Find us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- === END INFO SECTION === -->


        <!-- === START ABOUT === -->
        <div class="about-section" id="about-section">
            <div class="container">
                <div class="site-title wow fadeInDown">
                    <p>A few words about us</p>
                    <h1>get to know us</h1>
                    <div class="site-dots d-text-c"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>
                </div>
                <div class="row">
                    <div class="col-md-6 wow bounceInLeft">
                        <div class="img-box"><img src="/assets/images/presentation.png" alt="presentation" /></div>
                    </div>
                    <div class="col-md-6">
                        <div class="services-mark-1">
<!--                            <div class="one-service wow bounceInRight">-->
<!--                                <img src="/assets/images/class-1.png" alt="class" />-->
<!--                                <h4>YOGA CLASSES</h4>-->
<!--                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.</p>-->
<!--                            </div>-->
                            <div class="one-service wow bounceInRight">
                                <img src="/assets/images/class-2.png" alt="class" />
<!--                                <h4>POWER LIFTING</h4>-->

                                <p><?php echo $this->about[0]['text']?></p>
                            </div>
<!--                            <div class="one-service wow bounceInRight">-->
<!--                                <img src="/assets/images/class-3.png" alt="class" />-->
<!--                                <h4>SHAPING</h4>-->
<!--                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.</p>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- === END ABOUT === -->

        <!-- === START STATISTICS === -->
        <div class="statistics-section">
            <div class="container">
                <div class="site-title wow bounceInLeft">
                    <p>Take a look at</p>
                    <h1>our shop</h1>
                    <a href="/stores/"class="">View All</a>
                </div>
                <div class="row">
                    <div class="col-md-4 wow bounceInLeft">
                        <?php if (!empty($this->stores[0]['hero_image'])){?>
                            <a href = "/store/<?php echo $this->stores[0]['slug']?>">
                                <div class="statistic" style = "background: url('/assets/uploads/store/<?php echo $this->stores[0]['hero_image'][0]['image'] ?>') top right no-repeat; background-size: cover;">
                                    <div class="bg-cover"></div>
                                    <div class="statistic-cut"></div>
                                    <h3 class="d-text-c"><span style = "font-size: 50px;">&pound;<?php echo $this->stores[0]['price'] ?></span></h3>
                                    <h6><?php echo $this->stores[0]['title'] ?></h6>
                                </div>
                            </a>
                        <?php } ?>
                    </div>

                    <div class="col-md-4 wow fadeInUp">
                        <?php if (!empty($this->stores[1]['hero_image'])){?>
                            <a href = "/store/<?php echo $this->stores[1]['slug']?>">
                                <div class="statistic" style = "background: url('/assets/uploads/store/<?php echo $this->stores[1]['hero_image'][0]['image'] ?>') top right no-repeat; background-size: cover;">
                                    <div class="bg-cover"></div>
                                    <div class="statistic-cut"></div>
                                    <h3 class="d-text-c"><span style = "font-size: 50px;">&pound;<?php echo $this->stores[1]['price'] ?></span></h3>
                                    <h6><?php echo $this->stores[1]['title'] ?></h6>
                                </div>
                            </a>
                        <?php } ?>
                    </div>

                    <div class="col-md-4 wow bounceInRight">
                        <?php if (!empty($this->stores[2]['hero_image'])){?>
                            <a href = "/store/<?php echo $this->stores[2]['slug']?>">
                                <div class="statistic" style = "background: url('/assets/uploads/store/<?php echo $this->stores[2]['hero_image'][0]['image'] ?>') top right no-repeat; background-size: cover;">
                                    <div class="bg-cover"></div>
                                    <div class="statistic-cut"></div>
                                    <h3 class="d-text-c"><span style = "font-size: 50px;">&pound;<?php echo $this->stores[2]['price'] ?></span></h3>
                                    <h6><?php echo $this->stores[2]['title'] ?></h6>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- === END STATISTICS === -->


        <!-- === START CLASSES === -->
<!--        <div class="classes-section" id="classes-section" data-theme-plugin="slider" data-theme-item=".slide" data-theme-next=".slide-next" data-theme-prev=".slide-prev" data-theme-container=".slide-wrapper">-->
<!--            <div class="container">-->
<!--                <div class="site-title wow bounceInRight">-->
<!--                    <p>Take a look at</p>-->
<!--                    <h1>our classes</h1>-->
<!--                    <div class="site-dots d-text-c"><i class="fa slide-prev fa-angle-left"></i> <i class="fa fa-times-2"></i><i class="fa fa-times-2"></i> <i class="fa slide-next fa-angle-right"></i></div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="container relative">-->
<!--                <ul class="slider-dots" data-theme-plugin="bullets">-->
<!--                    <li>01</li>-->
<!--                    <li>02</li>-->
<!--                    <li>03</li>-->
<!--                    <li>04</li>-->
<!--                    <li>05</li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            <ul class="slide-wrapper">-->
<!--                <li class="slide">-->
<!--                    <div class="slide-text">-->
<!--                        <div class="white-box">-->
<!--                            <h4>Power Lifting</h4>-->
<!--                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>-->
<!--                            <a href="#" class="button-box d-border-c d-bg-c-h d-text-c">view timetable</a>-->
<!--                        </div>-->
<!--                        <div class="box-2 d-bg-c">-->
<!--                            <ul>-->
<!--                                <li class="i-1">Mon-Fri 9.00 - 10.00</li>-->
<!--                                <li class="i-2">Jane Austin</li>-->
<!--                                <li class="i-3">Room B</li>-->
<!--                                <li class="i-4">Starting with 100/mth</li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img src="images/m-slide-1.jpg" alt="slide">-->
<!--                </li>-->
<!--                <li class="slide">-->
<!--                    <div class="slide-text">-->
<!--                        <div class="white-box">-->
<!--                            <h4>Boxing</h4>-->
<!--                            <p>Serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>-->
<!--                            <a href="#" class="button-box d-border-c d-bg-c-h d-text-c">view timetable</a>-->
<!--                        </div>-->
<!--                        <div class="box-2 d-bg-c">-->
<!--                            <ul>-->
<!--                                <li class="i-1">Mon-Fri 9.00 - 10.00</li>-->
<!--                                <li class="i-2">Jane Austin</li>-->
<!--                                <li class="i-3">Room B</li>-->
<!--                                <li class="i-4">Starting with 100/mth</li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img src="images/m-slide-2.jpg" alt="slide">-->
<!--                </li>-->
<!--                <li class="slide">-->
<!--                    <div class="slide-text">-->
<!--                        <div class="white-box">-->
<!--                            <h4>Fitness</h4>-->
<!--                            <p>Serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>-->
<!--                            <a href="#" class="button-box d-border-c d-bg-c-h d-text-c">view timetable</a>-->
<!--                        </div>-->
<!--                        <div class="box-2 d-bg-c">-->
<!--                            <ul>-->
<!--                                <li class="i-1">Mon-Fri 9.00 - 10.00</li>-->
<!--                                <li class="i-2">Jane Austin</li>-->
<!--                                <li class="i-3">Room B</li>-->
<!--                                <li class="i-4">Starting with 100/mth</li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img src="images/m-slide-3.jpg" alt="slide">-->
<!--                </li>-->
<!--                <li class="slide">-->
<!--                    <div class="slide-text">-->
<!--                        <div class="white-box">-->
<!--                            <h4>Body Building</h4>-->
<!--                            <p>Serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>-->
<!--                            <a href="#" class="button-box d-border-c d-bg-c-h d-text-c">view timetable</a>-->
<!--                        </div>-->
<!--                        <div class="box-2 d-bg-c">-->
<!--                            <ul>-->
<!--                                <li class="i-1">Mon-Fri 9.00 - 10.00</li>-->
<!--                                <li class="i-2">Jane Austin</li>-->
<!--                                <li class="i-3">Room B</li>-->
<!--                                <li class="i-4">Starting with 100/mth</li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img src="images/m-slide-4.jpg" alt="slide">-->
<!--                </li>-->
<!--                <li class="slide">-->
<!--                    <div class="slide-text">-->
<!--                        <div class="white-box">-->
<!--                            <h4>Shapping</h4>-->
<!--                            <p>Wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>-->
<!--                            <a href="#" class="button-box d-border-c d-bg-c-h d-text-c">view timetable</a>-->
<!--                        </div>-->
<!--                        <div class="box-2 d-bg-c">-->
<!--                            <ul>-->
<!--                                <li class="i-1">Mon-Fri 9.00 - 10.00</li>-->
<!--                                <li class="i-2">Jane Austin</li>-->
<!--                                <li class="i-3">Room B</li>-->
<!--                                <li class="i-4">Starting with 100/mth</li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img src="images/m-slide-5.jpg" alt="slide">-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
        <!-- === END CLASSES === -->


        <!-- === START TRAINERS === -->
        <div class="trainers-section carousel" id="trainers-section" data-theme-plugin="carousel" data-theme-container=".carousel-items" data-theme-item="&gt;div" data-theme-rotate="false" data-theme-autoplay="false" data-theme-hide-effect="false">
            <div class="container">
                <div class="site-title wow bounceInLeft">
                    <p>Take a look at</p>
                    <h1>our trainers</h1>
                    <div class="site-dots d-text-c carousel-arrows"><i class="fa prev fa-angle-left"></i> <i class="fa fa-times-2"></i><i class="fa fa-times-2"></i> <i class="fa next fa-angle-right"></i></div>
                </div>
                <div class="row carousel-items">
                    <div class="col-md-4">
                        <div class="trainer wow bounceInLeft">
                            <ul class="socials d-bg-c wow fadeInUp">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                            <img src="images/trainer-1.jpg" alt="trainer" />
                            <div class="trainer-info">
                                <h4>rachel adams<span>Yoga instructor</span></h4>
                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="trainer wow fadeInDown">
                            <ul class="socials d-bg-c wow fadeInUp">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                            <img src="images/trainer-2.jpg" alt="trainer" />
                            <div class="trainer-info">
                                <h4>Alexande Bergunov<span>Box instructor</span></h4>
                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="trainer wow bounceInRight">
                            <ul class="socials d-bg-c wow fadeInUp">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                            <img src="images/trainer-3.jpg" alt="trainer" />
                            <div class="trainer-info">
                                <h4>Xenia James<span>Bodybuilding instructor</span></h4>
                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="trainer">
                            <ul class="socials d-bg-c wow fadeInUp">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                            <img src="images/trainer-4.jpg" alt="trainer" />
                            <div class="trainer-info">
                                <h4>Alexande Bergunov<span>Box instructor</span></h4>
                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="trainer">
                            <ul class="socials d-bg-c wow fadeInUp">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                            <img src="images/trainer-5.jpg" alt="trainer" />
                            <div class="trainer-info">
                                <h4>Xenia James<span>Bodybuilding instructor</span></h4>
                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- === END TRAINERS === -->



        <!-- === START PURCHASE === -->
<!--        <div class="purchase-section wow fadeInDown">-->
<!--            <div class="bg-cover">-->
<!--                <div class="container">-->
<!--                    <div class="site-title">-->
<!--                        <p>Already excited with the seen?</p>-->
<!--                        <h1>Purchase ulysses now</h1>-->
<!--                        <a href="http://themeforest.net/user/geothemes/portfolio?ref=geothemes">Buy it now</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <!-- === END PURCHASE === -->


        <!-- === START BLOG POSTS === -->
        <div class="blog-post-section carousel" id="blog-section" data-theme-plugin="carousel" data-theme-container=".carousel-items" data-theme-item="&gt;div" data-theme-rotate="false" data-theme-autoplay="false" data-theme-hide-effect="false">
            <div class="container">
                <div class="site-title wow bounceInRight">
                    <p>Our thoughts</p>
                    <h1>Latest from the blog</h1>
                    <div class="site-dots d-text-c carousel-arrows"><i class="fa prev fa-angle-left"></i> <i class="fa fa-times-2"></i><i class="fa fa-times-2"></i> <i class="fa next fa-angle-right"></i></div>
                </div>
                <div class="row carousel-items">
                    <div class="col-md-6">
                        <div class="blog-entry wow bounceInLeft">
                            <div class="entry-date"><span class="d-text-c">15</span> may</div>
                            <div class="entry-cover">
                                <a href="post.html"><img src="images/blog-1.jpg" alt="blog image" /></a>
                            </div>
                            <div class="entry-hover d-bg-c">
                                <img src="images/photo-format.png" alt="photo" />
                                <h2><a href="post.html">Having fun at the lake</a></h2>
                                <p>Nature / Photography</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog-entry wow bounceInRight">
                            <div class="entry-date"><span class="d-text-c">22</span> Sep </div>
                            <div class="entry-cover">
                                <a href="post.html"><img src="images/blog-3.jpg" alt="blog image" /></a>
                            </div>
                            <div class="entry-hover d-bg-c">
                                <img src="images/photo-format.png" alt="photo" />
                                <h2><a href="post.html">Having fun at the lake</a></h2>
                                <p>Nature / Photography</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog-entry wow bounceInRight">
                            <div class="entry-date"><span class="d-text-c">06</span> Oct </div>
                            <div class="entry-cover">
                                <a href="post.html"><img src="images/blog-2.jpg" alt="blog image" /></a>
                            </div>
                            <div class="entry-hover d-bg-c">
                                <img src="images/photo-format.png" alt="photo" />
                                <h2><a href="post.html">Having fun at the lake</a></h2>
                                <p>Nature / Photography</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog-entry wow bounceInRight">
                            <div class="entry-date"><span class="d-text-c">12</span> Dec </div>
                            <div class="entry-cover">
                                <a href="post.html"><img src="images/blog-4.jpg" alt="blog image" /></a>
                            </div>
                            <div class="entry-hover d-bg-c">
                                <img src="images/photo-format.png" alt="photo" />
                                <h2><a href="post.html">Having fun at the lake</a></h2>
                                <p>Nature / Photography</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- === END BLOG POSTS === -->



        <!-- START PRICING TABLES -->
        <div class="pricing-section" id="shop-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 wow bounceInLeft">
                        <div class="pricing-table">
                            <h2 class="pricing-table-name">Silver</h2>
                            <div class="pricing-table-price d-bg-c">$25 / <span>per month</span></div>
                            <ul class="pricing-table-stuff">
                                <li>Cardio</li>
                                <li>Swimming Pool</li>
                                <li>Massage</li>
                                <li>Yoga</li>
                                <li>Aerobics</li>
                                <li>Solar</li>
                            </ul>
                            <p><a href="#" class="button d-bg-c-h">Buy now</a></p>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInDown">
                        <div class="pricing-table popular-table d-bg-c">
                            <h2 class="pricing-table-name">Gold</h2>
                            <div class="pricing-table-price d-text-c">$25 / <span>per month</span></div>
                            <ul class="pricing-table-stuff">
                                <li>Cardio</li>
                                <li>Swimming Pool</li>
                                <li>Massage</li>
                                <li>Yoga</li>
                                <li>Aerobics</li>
                                <li>Solar</li>
                            </ul>
                            <p><a href="#" class="button">Buy now</a></p>
                        </div>
                    </div>
                    <div class="col-md-4 wow bounceInRight">
                        <div class="pricing-table">
                            <h2 class="pricing-table-name">Platium</h2>
                            <div class="pricing-table-price d-bg-c">$25 / <span>per month</span></div>
                            <ul class="pricing-table-stuff">
                                <li>Cardio</li>
                                <li>Swimming Pool</li>
                                <li>Massage</li>
                                <li>Yoga</li>
                                <li>Aerobics</li>
                                <li>Solar</li>
                            </ul>
                            <p><a href="#" class="button d-bg-c-h">Buy now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PRICING TABLES -->



        <!-- START CONTACT SECTION -->
        <div class="contact-section" id="contact-section">
            <div class="container">
                <div class="site-title wow bounceInRight">
                    <p>Get in touch with us</p>
                    <h1>Contact</h1>
                    <div class="site-dots d-text-c"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>
                </div>
                <form class="contact-form d-bg-c wow bounceInLeft">
                    <input type="text" name="contact-name" class="d-border-c-f contact-form-line" placeholder="Name">
                    <input type="text" name="contact-email" class="d-border-c-f contact-form-line" placeholder="Email Address">
                    <input type="text" name="contact-website" class="d-border-c-f contact-form-line" placeholder="Subject">
                    <textarea name="contact-message" class="d-border-c-f contact-form-area" placeholder="Message"></textarea>
                    <p class="align-center"><input type="submit" value="Submit" class="form-send"></p>
                </form>
            </div>

            <div class="map-location wow fadeInDown">
            </div>
        </div>
        <!-- END CONTACT SECTION -->