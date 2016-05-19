<?php

/** RouteConfig */

/**
 * Route Name
 * Route URL
 * Route Area
 * Route Controller
 * Route Action
 */

// Set Array
$routeArray = array();
$routeArray[] = Route::addRoute("Login",
                 "/backoffice/login",
                 "Backoffice",
                 "AdminUsers",
                 "login"
);

$routeArray[] = Route::addRoute("Login",
                 "/backoffice/logout",
                 "Backoffice",
                 "AdminUsers",
                 "logout"
);

$routeArray[] = Route::addRoute("Login",
                 "/login",
                 NULL,
                 "Users",
                 "login"
);

$routeArray[] = Route::addRoute("Login",
                 "/logout",
                 NULL,
                 "Users",
                 "logout"
);

