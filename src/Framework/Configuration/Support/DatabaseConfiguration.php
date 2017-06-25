<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: DatabaseConfiguration.php
     *
     * Created by: Gaming (on 24/06/2017 at 13:28)
     */

    namespace Zeroday\Framework\Configuration\Support;


    use Zeroday\Framework\Configuration\ConfigurationManager;

    class DatabaseConfiguration extends ConfigurationManager
    {

        /**
         * @var array
         */

        protected $database_requirements = [
            'host',
            'username',
            'password',
            'database',
            'prefix',
            'driver',
            'charset',
            'coallation'
        ];

        /**
         * DatabaseConfiguration constructor.
         * @param string $connection_file
         * @param bool $autocache
         */

        public function __construct( $connection_file, $autocache = true )
        {

            parent::__construct("/config/database/$connection_file", $autocache);
        }

        public function check()
        {

            $configuration = $this->get();

            foreach( $this->database_requirements as $requirement )
            {

                if( isset( $configuration->$requirement ) == false )
                    return false;
            }

            return true;
        }

        public function reset( array $configuration )
        {

            $this->configuration_file->writeJson( $configuration );
        }

        public function toArray()
        {

            $result = array();

            foreach( $this->database_requirements as $requirement )
            {

                $result[$requirement] = $this->find( $requirement );
            }

            return $result;
        }
    }