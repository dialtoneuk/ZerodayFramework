<?php

    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: routes.php
     *
     * Created by: Gaming (on 25/06/2017 at 09:48)
     */

    use Zeroday\Framework\Pages\PageRouter;

    /**
     * Index
     */

    PageRouter::route('/',[
        'model'     => 'IndexModel',
        'view'      => 'IndexView',
        'controller' => 'IndexController'
    ]);

    PageRouter::route('/index',[
        'model'     => 'IndexModel',
        'view'      => 'IndexView',
        'controller' => 'IndexController'
    ]);

    /**
     * Login
     */

    PageRouter::route('/login',[
        'model'     => 'LoginModel',
        'view'      => 'LoginView',
        'controller' => 'LoginController'
    ]);

    /**
     * Logout
     */

    PageRouter::route('/logout',[
        'model'     => 'DefaultModel',
        'view'      => 'DefaultView',
        'controller' => 'LogoutController'
    ]);