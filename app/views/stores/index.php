<!-- === START PATH === -->
<div class="path-section">
    <div class="bg-cover">
        <div class="container">
            <h3>Shop</h3>
        </div>
    </div>
</div>
<!-- === END PATH === -->

<!-- === START BLOG RIGHT SIDEBAR === -->
<div class="shop-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shop-items">
                    <div class="row">
                        <?php foreach($this->getAllData as $data){?>
                            <div class="col-md-3">
                                <div class="shop-item">
                                    <div class="item-image d-border-c">
                                        <div class="item-hover">
                                            <div class="item-hover-bg d-bg-c"></div>
                                            <h5><a href="/stores/view/<?php echo $data['slug']?>"><img src="/assets/images/cart.png" alt="photo" />View</a></h5>
                                        </div>
                                        <?php if (isset($data['hero_image']) && !empty($data['hero_image'])){?>
                                            <img src="/assets/uploads/store/<?php echo $data['hero_image'][0]['image']?>" alt="<?php echo $data['hero_image'][0]['title']?>" style ="width:300px; height:300px"/>
                                        <?php }?>
                                    </div>
                                    <div class="item-details">
                                        <h3><a href="/stores/view/<?php echo $data['slug']?>" class="d-text-c-h"><?php echo $data['title']?></a></h3>
                                        <h6>&pound<?php echo $data['price']?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if(!empty($this->page_links)){ ?>
                        <?php echo $this->page_links; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- === END SHOP RIGHT SIDEBAR === -->
<!-- === END CONTENT === -->