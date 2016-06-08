<!-- === START CONTENT === -->
<div class="content">
    <!-- === START PATH === -->
    <div class="path-section">
        <div class="bg-cover">
            <div class="container">
                <h3>Result</h3>
            </div>
        </div>
    </div>
    <!-- === END PATH === -->

    <!-- === START BLOG RIGHT SIDEBAR === -->
    <div class="container shop-section">
        <div class="shop-item-v1">
            <!-- === START SLIDER SECTION === -->
            <section class="slider-section" id="result-section">
                <div class="slider" data-theme-plugin="slider" data-theme-item=".slide"  data-theme-container=".slide-wrapper">
                    <ul class="slide-wrapper  wow bounceInLeft">
                        <li class="slide">
                            <img src="/assets/uploads/results/<?php echo $this->data[0]['image']?>" alt="<?php echo $this->data[0]['image']?>" class = "gallery-image">
                        </li>
                    </ul>
                </div>
            </section>
            <!-- === END SLIDER SECTION === -->
            <p><?php echo $this->data[0]['text']?></p>
        </div>
    </div>
    <!-- === END SHOP RIGHT SIDEBAR === -->
</div>
<!-- === END CONTENT === -->