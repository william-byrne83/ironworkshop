<!-- === START CONTENT === -->
<div class="content">
    <!-- === START PATH === -->
    <div class="path-section">
        <div class="bg-cover">
            <div class="container">
                <h3>Trainer</h3>
                <h5><?php echo $this->data[0]['name']?></h5>
            </div>
        </div>
    </div>
    <!-- === END PATH === -->

    <!-- === START BLOG RIGHT SIDEBAR === -->
    <div class="container shop-section">
        <div class="shop-item-v1">
            <!-- === START SLIDER SECTION === -->
            <section class="slider-section" id="trainer-section">
                <div class="slider" data-theme-plugin="slider" data-theme-item=".slide"  data-theme-container=".slide-wrapper">
                    <ul class="slide-wrapper  wow bounceInLeft">
                        <?php foreach($this->data[0]['images'] as $image){?>
                            <li class="slide">
                                <img src="/assets/uploads/trainers/<?php echo $image['image']?>" alt="<?php echo $image['title']?>">
                            </li>
                        <?php } ?>
                    </ul>
                    <ul class="slider-dots wow bounceInRight" data-theme-plugin="bullets">
                        <?php foreach($this->data[0]['images'] as $image){?>
                            <li class="d-border-c-h"><img src="/assets/uploads/trainers/<?php echo $image['image']?>" alt="<?php echo $image['title']?>" alt="<?php echo $image['title']?>"></li>
                        <?php }?>
                    </ul>
                </div>
            </section>
            <!-- === END SLIDER SECTION === -->
            <h1><?php echo $this->data[0]['name']?></h1>
            <h5 class="d-text-c"></i>Phone Number : <?php echo $this->data[0]['phone']?></h5>
            <p><?php echo $this->data[0]['text']?></p>
        </div>

        <?php if(!empty($this->data[0]['results'])){?>
            <div class="site-title wow fadeInDown carousel" data-theme-plugin="carousel" data-theme-container=".tesla-carousel-items" data-theme-item="&gt;div" data-theme-rotate="false" data-theme-autoplay="false" data-theme-hide-effect="false">
                <p>Take a look at <?php echo $this->data[0]['name']?></p>
                <h1>Results</h1>
                <div class="site-dots d-text-c carousel-arrows"><i class="fa prev fa-angle-left"></i> <i class="fa fa-times-2"></i><i class="fa fa-times-2"></i> <i class="fa next fa-angle-right"></i></div>


                <div class="our-clients-logo" >
                    <div class="row tesla-carousel-items">
                        <?php foreach($this->data[0]['results'] as $result){?>
                            <div class="col-md-2 col-xs-4">
                                <img src="/assets/uploads/results/<?php echo $result['image']?>" alt="<?php echo $result['image']?>" />
                            </div>
                        <?php } ?>
                    </div>
                </div>
        <?php }?>

        <h1 class="styled">Find More About <?php echo $this->data[0]['name']?></h1>
        <ul class="socials">
            <?php if(!empty($this->data[0]['facebook'])){?>
                <li><a href="https://<?php echo $this->data[0]['facebook'];?>" target = _blank class="d-text-c d-border-c"><i class="fa fa-facebook"></i></a></li>
            <?php } ?>

            <?php if(!empty($this->data[0]['twitter'])){?>
                <li><a href="<?php echo $this->data[0]['twitter'];?>" target = _blank class="d-text-c d-border-c"><i class="fa fa-twitter"></i></a></li>
            <?php } ?>

            <?php if(!empty($this->data[0]['instagram'])){?>
                <li><a href="https://www.instagram.com/<?php echo $this->data[0]['instagram'];?>" target = _blank class="d-text-c d-border-c"><i class="fa fa-instagram"></i></a></li>
            <?php } ?>

            <?php if(!empty($this->data[0]['google'])){?>
                <li><a href="<?php echo $this->data[0]['google'];?>" target = _blank class="d-text-c d-border-c"><i class="fa fa-google-plus"></i></a></li>
            <?php } ?>

            <?php if(!empty($this->data[0]['email'])){?>
                <li><a href = "mailto:<?php echo $this->data[0]['email'];?>" class="d-text-c d-border-c"><i class="fa fa-envelope-o"></i></a></li>
            <?php } ?>

            <?php if(!empty($this->data[0]['website'])){?>
                <li><a href = "<?php echo $this->data[0]['website'];?>" target = _blank class="d-text-c d-border-c"><i class="fa fa-globe"></i></a></li>
            <?php } ?>

            <?php if(!empty($this->data[0]['phone'])){?>
                <li><a href = "tel:<?php echo $this->data[0]['phone'];?>" class="d-text-c d-border-c"><i class="fa fa-phone"></i></a></li>
            <?php } ?>
        </ul>

    </div>
    <!-- === END SHOP RIGHT SIDEBAR === -->
</div>
<!-- === END CONTENT === -->