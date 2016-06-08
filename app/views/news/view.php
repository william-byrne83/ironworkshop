<div class = "single-page">
    <!-- === START CONTENT === -->
    <div class="content">
        <!-- === START PATH === -->
        <div class="path-section">
            <div class="bg-cover">
                <div class="container">
                    <h3>News</h3>
                    <h5><?php echo $this->data[0]['title']?></h5>
                </div>
            </div>
        </div>
        <!-- === END PATH === -->

        <!-- === START BLOG RIGHT SIDEBAR === -->
        <div class="blog-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="blog-entry wow bounceInLeft">
                            <div class="entry-date"><span class="d-text-c"><?php echo date('d', strtotime($this->data[0]['date']))?></span> <?php echo date('M', strtotime($this->data[0]['date']))?></div>
                            <div class="entry-cover">
                                <?php if(isset($this->data[0]['image']) && !empty($this->data[0]['image'])){?>
                                    <img src="/assets/images/blog-f1.jpg" alt="blog image" />
                                <?php }elseif(isset($this->data[0]['video']) && !empty($this->data[0]['video'])){?>
                                    <?php $link = explode('v=',$this->data[0]['video'])?>
                                    <iframe id="ytplayer" type="text/html" width="900" height="600"
                                        src="https://www.youtube.com/v/<?php echo $link[1]?>?autoplay=0&origin=<?php echo SITE_URL?>"
                                        frameborder="0"/>
                                    </iframe>
                                <?php }?>
                            </div>

                            <div class="entry-hover d-bg-c">
                                <img src="/assets/images/photo-format-2.png" alt="photo" />
                                <h2><?php echo $this->data[0]['title']?></h2>
                                <p><?php echo ucfirst(str_replace(',', ' / ', $data['categories']))?></p>
                            </div>

                            <div class="entry-content">
                                <?php echo $this->data[0]['text']?>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="sidebar wow bounceInRight">
                            <div class="widget">
                                <form class="widget-search-form" method='get' action='/news/index/'>
                                    <i class="fa fa-search d-text-c-h"></i>
                                    <input type="submit" name="submit" class="search-button"  value ="">
                                    <input class="search-line" name="keywords" type="text" placeholder="Search" <?php if (isset($_GET["keywords"])) {echo 'value="'.htmlentities($_GET["keywords"]).'"';}?>>
                                </form>
                            </div>

                            <div class="widget widget-categories">
                                <h3 class="widget-title">Categories<span></span></h3>
                                <ul>
                                    <?php foreach($this->categories as $category){?>
                                        <li><a href="/news/index/?categories=<?php echo $category['id']?>" class="d-text-c-h"><?php echo ucfirst($category['name'])?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- === END BLOG RIGHT SIDEBAR === -->
    </div>
    <!-- === END CONTENT === -->
</div>