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
    define('ZERODAY_SETTINGS_GLOBAL', true );

    /**
     * Init Composer
     */

    require_once 'vendor/autoload.php';

    /**
     * Require our roots file
     */

    require_once "routes.php";

    /**
     * Include our classes
     */

    use Zeroday\Framework\Pages\PageController;
    use Zeroday\Framework\Application\Container;
    use Zeroday\Framework\Configuration\Support\SettingsConfiguration;

    /**
     * Add to global container
     */

    Container::set('page_controller', new PageController() );

    /**
     * If this global is true, we will add the settings to the container too
     */

    if( ZERODAY_SETTINGS_GLOBAL )
        Container::set('settings', new SettingsConfiguration( true ) );

    /**
     * Run the page controller
     */

    Container::get('page_controller')->run( true, true );
