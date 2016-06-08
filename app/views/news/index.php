<div class = "single-page">
    <!-- === START CONTENT === -->
    <div class="content">
        <!-- === START PATH === -->
        <div class="path-section">
            <div class="bg-cover">
                <div class="container">
                    <h3>News</h3>
                </div>
            </div>
        </div>
        <!-- === END PATH === -->

        <!-- === START BLOG RIGHT SIDEBAR === -->
        <div class="blog-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <?php foreach($this->getAllData as $data){?>
                            <div class="blog-entry wow bounceInLeft">
                                <div class="entry-date"><span class="d-text-c"><?php echo date('d', strtotime($data['date']))?></span> <?php echo date('M', strtotime($data['date']))?></div>
                                <div class="entry-cover">
                                    <?php if (isset($data['image']) && !empty($data['image'])){?>
                                        <a href="/news/view/<?php echo $data['slug']?>/"><img src="/assets/uploads/news/<?php echo $data['image']?>" alt="<?php echo $data['title']?>" /></a>
                                    <?php }elseif(isset($data['video']) && !empty($data['video'])) {?>
                                        <?php $link = explode('v=', $data['video'])?>
                                        <a href="/news/view/<?php echo $data['slug']?>/"><img src="http://img.youtube.com/vi/<?php echo $link[1]?>/mqdefault.jpg" alt="<?php echo $data['title']?>" style =""></a>
                                    <?php }?>
                                </div>
                                <div class="entry-hover d-bg-c">
                                    <img src="/assets/images/photo-format-2.png" alt="photo" />
                                    <h2><a href="/news/view/<?php echo $data['slug']?>/" class="d-text-c-h"><?php echo $data['title']?></a></h2>
                                    <p><?php echo ucfirst(str_replace(',', ' / ', $data['categories']))?></p>
                                </div>
                                <div class="entry-content">
                                    <p><?php echo substr($data['text'],0,50)?>...</p>
                                    <a href="/news/view/<?php echo $data['slug']?>/" class="read-more d-border-c-h d-text-c">Continue reading...</a>
                                </div>
                            </div>
                        <?php } ?>
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
                <div class = "shop-section">
                    <?php if(!empty($this->page_links)){ ?>
                        <?php echo $this->page_links; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- === END BLOG RIGHT SIDEBAR === -->
    </div>
    <!-- === END CONTENT === -->
</div>