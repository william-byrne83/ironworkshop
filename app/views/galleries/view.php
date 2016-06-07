<!-- === START CONTENT === -->
<div class="content">
    <!-- === START PATH === -->
    <div class="path-section">
        <div class="bg-cover">
            <div class="container">
                <h3>Gallery</h3>
                <h5><?php echo $this->data[0]['title']?></h5>
            </div>
        </div>
    </div>
    <!-- === END PATH === -->

    <!-- === START BLOG RIGHT SIDEBAR === -->
    <?php if(isset($this->data[0]['image']) && !empty($this->data[0]['image'])){?>
        <div class="container shop-section">
            <div class="shop-item-v1">
                <!-- === START SLIDER SECTION === -->
                <section class="slider-section" id="gallery-section">
                    <div class="slider" data-theme-plugin="slider" data-theme-item=".slide"  data-theme-container=".slide-wrapper">
                        <ul class="slide-wrapper  wow bounceInLeft">
                            <li class="slide">
                                    <img src="/assets/uploads/galleries/<?php echo $this->data[0]['image'] ?>" alt="<?php echo $this->data[0]['title'] ?>">
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- === END SLIDER SECTION === -->
                <h1><?php echo $this->data[0]['title'] ?></h1>
            </div>
        </div>
    <?php }elseif(isset($this->data[0]['video']) && !empty($this->data[0]['video'])){?>
        <?php $link = explode('v=',$this->data[0]['video'])?>
        <div class="container shop-section">
            <div class="shop-item-v1">
                <section class="slider-section" id="gallery-section">
                    <iframe id="ytplayer" type="text/html" width="900" height="600"
                            src="https://www.youtube.com/v/<?php echo $link[1]?>?autoplay=0&origin=<?php echo SITE_URL?>"
                            frameborder="0"/>
                    </iframe>
                </section>
                <h1><?php echo $this->data[0]['title'] ?></h1>
            </div>
        </div>
    <?php } ?>
    <!-- === END SHOP RIGHT SIDEBAR === -->
</div>
<!-- === END CONTENT === -->