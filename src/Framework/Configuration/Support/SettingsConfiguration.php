<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: SettingsConfiguration.php
     *
     * Created by: Gaming (on 24/06/2017 at 13:26)
     */

    namespace Zeroday\Framework\Configuration\Support;


    use Zeroday\Framework\Configuration\ConfigurationManager;

    class SettingsConfiguration extends ConfigurationManager
    {

        public function __construct( $autocache = true)
        {

            parent::__construct( ZERODAY_SETTINGS_LOCATION , $autocache);
        }

        public function getSetting( $setting_name )
        {

            return ( $this->find( $setting_name ) );
        }

        public function hasSetting( $setting_name )
        {

            return ( $this->has( $setting_name ) );
        }

        public function getSettings()
        {

            return ( $this->get() );
        }
    }