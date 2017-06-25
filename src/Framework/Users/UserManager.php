<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: UserManager.php
     *
     * Created by: Gaming (on 25/06/2017 at 12:34)
     */

    namespace Zeroday\Framework\Users;


    use Zeroday\Framework\Application\Container;
    use Zeroday\Framework\Configuration\Support\SettingsConfiguration;
    use Zeroday\Framework\Database\Tables\UserTable;

    class UserManager
    {

        protected $database;
        protected $settings;

        public function __construct()
        {

            $this->database = new UserTable();

            if( Container::has('settings') )
                $this->settings = Container::get('settings');
            else
                $this->settings = new SettingsConfiguration();
        }

        public function get( $userid )
        {

            return( $this->database->get( $userid )->first() );
        }

        public function exists( $userid )
        {

            return( $this->database->get( $userid )->isEmpty() );
        }

        public function hasUsername( $username )
        {

            return( $this->database->find( $username )->isEmpty() );
        }

        public function find( $username )
        {

            return( $this->database->find( $username ) );
        }

        public function username( $userid )
        {

            return( $this->get( $userid )->username );
        }

        public function email( $userid )
        {

            return( $this->get( $userid )->email );
        }

        public function group( $userid )
        {

            return( $this->get( $userid )->group );
        }

        public function isAdmin( $userid )
        {

            $group = $this->get( $userid )->group;

            if( $this->settings->getSetting('user.group.admin') == $group )
                return true;

            return false;
        }

        public function isDonor( $userid )
        {

            $group = $this->get( $userid )->group;

            if( $this->settings->getSetting('user.group.donor') == $group )
                return true;

            return false;
        }
    }