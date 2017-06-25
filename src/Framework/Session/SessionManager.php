<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: SessionManager.php
     *
     * Created by: Gaming (on 24/06/2017 at 11:14)
     */

    namespace Zeroday\Framework\Session;


    use Zeroday\Framework\Database\Tables\SessionTable;

    class SessionManager
    {

        /**
         * @var SessionTable
         */

        protected $database;

        /**
         * Session constructor.
         */

        public function __construct()
        {

            $this->database = new SessionTable();
        }

        /**
         * Starts the Session
         */

        public function start()
        {

            session_start();
        }

        /**
         * Destroys the session
         */

        public function destroy()
        {

            session_destroy();
        }

        /**
         * @param $session_key
         * @param $session_value
         */

        public function set( $session_key, $session_value )
        {

            $_SESSION[ $session_key ] = $session_value;
        }

        /**
         * @return bool
         */

        public function active()
        {

            if( session_status() !== PHP_SESSION_ACTIVE )
                return false;

            if( $this->database->get( session_id() )->isEmpty() )
                return false;

            return true;
        }

        /**
         * @return \Illuminate\Support\Collection
         */

        public function get()
        {

            return( $this->database->get( session_id() )->first() );
        }

        /**
         * Removes the session from the database
         */

        public function remove()
        {

            $this->database->delete( session_id() );
        }

        /**
         * @param array $session_keys
         */

        public function unset( array $session_keys )
        {

            foreach( $session_keys as $session_key )
            {

                if( isset( $_SESSION[ $session_key ] ) )
                    unset( $_SESSION[ $session_key ] );
            }
        }

        /**
         * @param array $session_keys
         */

        public function keep( array $session_keys )
        {

            foreach( $_SESSION as $key=>$value )
            {

                if( isset( $session_keys[$key]) == false )
                    unset( $_SESSION[ $key ] );
            }
        }

        /**
         * Regenerates our sessionid
         */

        public function regenerate()
        {

            session_regenerate_id( true );
        }
    }