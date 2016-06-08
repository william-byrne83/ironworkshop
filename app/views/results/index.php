<!-- === START PATH === -->
<div class="path-section">
    <div class="bg-cover">
        <div class="container">
            <h3>Results</h3>
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
                                            <h5><a href="/results/view/<?php echo $data['id']?>"><img src="/assets/images/photo-format.png" alt="photo" />View</a></h5>
                                        </div>
                                        <?php if (isset($data['image']) && !empty($data['image'])){?>
                                            <img src="/assets/uploads/results/<?php echo $data['image']?>" alt="<?php echo $data['image']?>" style ="width:300px; height:300px"/>
                                        <?php }?>
                                    </div>
                                    <div class="item-details">
                                        <h3><a href="/results/view/<?php echo $data['id']?>" class="d-text-c-h"></a></h3>
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