<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: SessionModel.php
     *
     * Created by: Gaming (on 24/06/2017 at 09:57)
     */

    namespace Zeroday\Framework\Pages\Support\Models;


    use Zeroday\Framework\Configuration\Support\SettingsConfiguration;
    use Zeroday\Framework\Pages\ModelInterface;
    use Zeroday\Framework\Session\SessionManager;

    class SessionModel implements ModelInterface
    {

        protected $data = [];
        protected $session;
        protected $settings;

        public function __construct()
        {

            $this->session = new SessionManager();
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

            return array_merge( $this->data, array(
                'session' => [
                    'sessionid' => session_id(),
                    'active'  => $this->session->active()
                ]
            ));
        }

        public function getTemplate()
        {

            return( '/templates/pages/page.default' );
        }
    }