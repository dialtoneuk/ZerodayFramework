<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: UserSessionModel.php
     *
     * Created by: Gaming (on 24/06/2017 at 09:57)
     */

    namespace Zeroday\Framework\Pages\Support\Models;


    use Zeroday\Framework\Configuration\Support\SettingsConfiguration;
    use Zeroday\Framework\Pages\ModelInterface;
    use Zeroday\Framework\Session\Support\UserSession;

    class UserSessionModel implements ModelInterface
    {

        protected $data = [];
        protected $session;
        protected $settings;

        public function __construct()
        {

            $this->session = new UserSession();
            $this->settings = new SettingsConfiguration();

            if( $this->settings->getSetting('session.auto') )
                $this->session->start();
        }

        public function setData(array $data)
        {

            $this->data = array_merge( $this->data, $data );
        }

        public function getData()
        {

            if( $this->session->isLoggedIn() == false )
                return array_merge( $this->data, array('session'=>false));

            return array_merge( $this->data, array(
                'session' => [
                    'sessionid'     => session_id(),
                    'userid'        => $this->session->userid(),
                    'lastaction'    => $this->session->lastaction(),
                    'logintime'     => $this->session->logintime(),
                    'ipaddress'     => $this->session->ipaddress()
                ]
            ));
        }

        public function getTemplate()
        {

            return( '/templates/pages/page.default' );
        }
    }