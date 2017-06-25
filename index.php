<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: index.php
     *
     * Created by: Gaming (on 24/06/2017 at 11:17)
     */

    define('ZERODAY_FILE_ROOT', $_SERVER['DOCUMENT_ROOT'] );
    define('ZERODAY_DATABASE_CONNECTIONFILE', 'database.default.json');
    define('ZERODAY_SETTINGS_LOCATION', '/config/settings.json');

    /**
     * Init Composer
     */

    require_once 'vendor/autoload.php';

    /**
     * Require our roots file
     */

    require_once "roots.php";

    /**
     * Start the page controller
     */

    use Zeroday\Framework\Pages\PageController;

    $page_controller = new PageController();

    /**
     * Run the page controller
     */

    $page_controller->run( true, true );
