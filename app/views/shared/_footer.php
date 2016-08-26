<!-- === START FOOTER === -->
<footer class="footer wow fadeInUp">
    <div class="container">
        <div class="logo wow bounceInRight"><img src="/assets/images/logo-for-wall.png" alt="logo"/></div>
        <ul class="socials wow bounceInLeft">
            <?php if(isset($this->contact[0]['facebook']) && !empty($this->contact[0]['facebook'])){?>
                <li><a href="<?php echo $this->contact[0]['facebook']?>" class="d-text-c-h d-border-c-h"><i class="fa fa-facebook"></i></a></li>
            <?php } ?>
            <?php if(isset($this->contact[0]['twitter']) && !empty($this->contact[0]['twitter'])){?>
                <li><a href="<?php echo $this->contact[0]['twitter']?>" class="d-text-c-h d-border-c-h"><i class="fa fa-twitter"></i></a></li>
            <?php } ?>

            <?php if(isset($this->contact[0]['instagram']) && !empty($this->contact[0]['instagram'])){?>
                <li><a href="<?php echo $this->contact[0]['instagram']?>" class="d-text-c-h d-border-c-h"><i class="fa fa-instagram"></i></a></li>
            <?php } ?>

            <?php if(isset($this->contact[0]['google']) && !empty($this->contact[0]['google'])){?>
                <li><a href="<?php echo $this->contact[0]['google']?>" class="d-text-c-h d-border-c-h"><i class="fa fa-google-plus"></i></a></li>
            <?php } ?>
        </ul>
        <p class="copywrite">Copyright <?php echo date('Y')?> by Ironworkshop. All rights reserved.</p>
    </div>
</footer>
<!-- === END FOOTER === -->