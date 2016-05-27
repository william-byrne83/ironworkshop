<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="/assets/images/favicon.ico" rel="shortcut icon" />    
    <title><?php echo isset($this->pageTitle) ? Page::getPageTitle($this->pageTitle) : SITE_NAME; ?></title>
    <meta name="description" content="<?php echo isset($this->pageDescription) ? Page::getPageDescription($this->pageDescription) : ''; ?>" />
    <meta name="author" content="ComfyStudio">
    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <!-- Css -->
    <?php 
	    renderDefaultCssBundle();
	?>
    <?php echo isset($this->pageCss) ? Page::getPageCss($this->pageCss) : ''; ?>
</head>
<body class="home-page">
    <div class="load-complete">
        <div class="load-position">
            <div class="logo"><img src="images/logo.png" alt="logo"/></div>
            <h6>Please wait, loading...</h6>
            <div class="loading">
                <div class="loading-line"></div>
                <div class="loading-break loading-dot-1"></div>
                <div class="loading-break loading-dot-2"></div>
                <div class="loading-break loading-dot-3"></div>
            </div>
        </div>
    </div>

    <div class="box-wide">
        <?php $this->renderPartial('shared/_header');?>
            <div id="container">

                <!--IF Flash Message then display it-->
                <?php if (!empty($this->flash)) { ?>
                    <div class="alert-<?php echo $this->flash[1];?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><strong><?php echo ucfirst($this->flash[1]);?></strong></h4>
                        <?php echo Html::formatSuccess($this->flash[0]); ?>
                    </div>
                <?php } ?>

                <!--IF Error Message then display it-->
                <?php if (!empty($this->error)) { ?>
                    <div class="alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><strong>Error</strong></h4>
                        <?php
                            echo Html::formatErrors($this->error);
                        ?>
                    </div>
                <?php } ?>

                <?php require $pathToViewsFolder . $renderBody . '.php'; ?>
            </div>
        <?php $this->renderPartial('shared/_footer');?>
    </div>
    <?php 
	    renderDefaultJSBundle();
	?>
	<?php echo isset($this->pageJs) ? Page::getPageJs($this->pageJs) : ''; ?>
</body>
</html>