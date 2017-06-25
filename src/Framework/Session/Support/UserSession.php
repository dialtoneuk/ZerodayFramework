<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: UserSession.php
     *
     * Created by: Gaming (on 25/06/2017 at 05:23)
     */

    namespace Zeroday\Framework\Session\Support;


    use Zeroday\Framework\Configuration\Support\SettingsConfiguration;
    use Zeroday\Framework\Session\SessionManager;

    class UserSession extends SessionManager
    {

        protected $settings;

        public function __construct()
        {

            parent::__construct();

            $this->settings = new SettingsConfiguration();
        }

        public function logintime()
        {

            return ( $this->get()->logintime );
        }

        public function lastaction()
        {

            return( $this->get()->lastaction );
        }

        public function userid()
        {

            return( $this->get()->userid );
        }

        public function ipaddress()
        {

            return( $this->get()->ipaddress );
        }

        public function isLoggedIn()
        {

            return( $this->active() );
        }

        public function hasExpired()
        {

            return( $this->lastaction() < $this->settings->getSetting('session.expire') );
        }

        public function fresh()
        {

            $this->start();

            $this->regenerate();
        }

        public function logout()
        {

            $this->remove();

            $this->destroy();
        }
    }