<!-- === START CONTENT === -->
<div class="content">
    <!-- === START PATH === -->
    <div class="path-section">
        <div class="bg-cover">
            <div class="container">
                <h3>Shop</h3>
                <h5><?php echo $this->data[0]['title']?></h5>
            </div>
        </div>
    </div>
    <!-- === END PATH === -->

    <!-- === START BLOG RIGHT SIDEBAR === -->
    <div class="container shop-section">
        <div class="shop-item-v1">
            <!-- === START SLIDER SECTION === -->
            <section class="slider-section" id="store-section">
                <div class="slider" data-theme-plugin="slider" data-theme-item=".slide"  data-theme-container=".slide-wrapper">
                    <ul class="slide-wrapper  wow bounceInLeft">
                        <?php foreach($this->data[0]['images'] as $image){?>
                            <li class="slide">
                                <img src="/assets/uploads/store/<?php echo $image['image']?>" alt="<?php echo $image['title']?>" style = "width:1200px">
                            </li>
                        <?php } ?>
                    </ul>
                    <ul class="slider-dots wow bounceInRight" data-theme-plugin="bullets">
                        <?php foreach($this->data[0]['images'] as $image){?>
                            <li class="d-border-c-h"><img src="/assets/uploads/store/<?php echo $image['image']?>" alt="<?php echo $image['title']?>" alt="<?php echo $image['title']?>"></li>
                        <?php }?>
                    </ul>
                </div>
            </section>
            <!-- === END SLIDER SECTION === -->
            <h1><?php echo $this->data[0]['title']?></h1>
            <h5 class="d-text-c">&pound <?php echo $this->data[0]['price']?></h5>
            <p><?php echo $this->data[0]['text']?></p>
        </div>

        <div class="site-title wow fadeInDown">
            <p>Like this?</p>
            <h1>Please visit Ironworkshop to purchase</h1>
            <div class="site-dots d-text-c"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>
        </div>
    </div>
    <!-- === END SHOP RIGHT SIDEBAR === -->
</div>
<!-- === END CONTENT === -->