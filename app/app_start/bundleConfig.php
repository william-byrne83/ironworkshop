<?php
function renderDefaultCssBundle(){
//	echo '<link rel="stylesheet" href="/assets/css/reset.css?v=1.0">';
//	echo '<link rel="stylesheet" href="/assets/css/main.css?v=1.0">';
//    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">';
     echo '<link href="/assets/css/swipebox.css" rel="stylesheet" />';
     echo '<link href="/assets/css/bootstrap.css" rel="stylesheet" />';
     echo '<link href="/assets/css/style.css" rel="stylesheet" />';
     echo '<link href="/assets/css/animate.css" rel="stylesheet" />';
     echo '<link href="/assets/css/font-awesome.css" rel="stylesheet" />';
//     echo '<link href="/assets/color-box/color-style.css" rel="stylesheet" />';
//     echo '<link href="/assets/color-box/farbtastic/farbtastic.css" rel="stylesheet" />';
     echo '<link href="http://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic" rel="stylesheet" type="text/css"/>';
}

function renderDefaultJSBundle(){
//	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>';
//    echo '<script src="/assets/js/general.js"></script>';
        echo '<script src="/assets/js/modernizr.custom.63321.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/jquery-1.11.1.min.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/jquery-ui.min.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/waypoints.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/bootstrap.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/placeholder.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/masonry.pkgd.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/jquery.swipebox.min.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/wow.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/knob.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/jquery.counterup.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/options.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/plugins.js" type="text/javascript"></script>';
        echo '<script src="/assets/js/general.js" type="text/javascript"></script>';

//        echo '<script src="/assets/color-box/color-js.js" type="text/javascript"></script>';
//        echo '<script src="/assets/color-box/farbtastic/farbtastic.js" type="text/javascript"></script>';

}

function renderAdminCssBundle(){
	echo '<link rel="stylesheet" href="/app/areas/backoffice/assets/css/bootstrap.min.css?v=1.0">';
	echo '<link rel="stylesheet" href="/app/areas/backoffice/assets/css/plugins.css?v=1.0">';
	echo '<link rel="stylesheet" href="/app/areas/backoffice/assets/css/main.css?v=1.0">';
	echo '<link rel="stylesheet" href="/app/areas/backoffice/assets/css/themes.css?v=1.0">';
	echo '<link rel="stylesheet" href="/app/areas/backoffice/assets/css/custom.css?v=1.0">';
}
function renderAdminHeadJSBundle(){
    echo '<script src="/app/areas/backoffice/assets/js/modernizr-2.8.3.min.js"></script>';
    echo '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';

}
function renderAdminJSBundle(){
    echo '<script src="/app/areas/backoffice/assets/js/jquery-2.1.4.min.js"></script>';
    echo '<script src="/app/areas/backoffice/assets/js/bootstrap.min.js"></script>';
    echo '<script src="/app/areas/backoffice/assets/js/plugins.js"></script>';
    echo '<script src="/app/areas/backoffice/assets/js/app.js"></script>';
    echo '<script src="/app/areas/backoffice/assets/js/general.js"></script>';
    echo '<script src="/app/areas/backoffice/assets/js/ckeditor/ckeditor.js"></script>';
}
?>