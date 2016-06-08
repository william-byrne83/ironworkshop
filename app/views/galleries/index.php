<!-- === START PATH === -->
    <div class="path-section">
        <div class="bg-cover">
            <div class="container">
                <h3>Gallery</h3>
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
                                                <h5><a href="/galleries/view/<?php echo $data['slug']?>"><img src="/assets/images/photo-format.png" alt="photo" />View</a></h5>
                                            </div>
                                            <?php if (isset($data['image']) && !empty($data['image'])){?>
                                                <img src="/assets/uploads/galleries/<?php echo $data['image']?>" alt="<?php echo $data['title']?>" style ="width:300px; height:300px"/>
                                            <?php }elseif(isset($data['video']) && !empty($data['video'])) {?>
                                                <?php $link = explode('v=', $data['video'])?>
                                                <img src="http://img.youtube.com/vi/<?php echo $link[1]?>/mqdefault.jpg" alt="<?php echo $data['title']?>" style ="width:300px; height:300px">
                                            <?php }?>
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