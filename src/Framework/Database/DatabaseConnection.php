<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: DatabaseConnection.php
     *
     * Created by: Gaming (on 24/06/2017 at 11:15)
     */

    namespace Zeroday\Framework\Database;


    use Illuminate\Database\Capsule\Manager;
    use Illuminate\Database\Connection;
    use Zeroday\Framework\Configuration\Support\DatabaseConfiguration;
    use Zeroday\Framework\Exceptions\Support\ZeroDayException;

    class DatabaseConnection
    {

        /**
         * @var DatabaseConfiguration
         */

        protected $connection_configuration;

        /**
         * @var Manager
         */

        public $connection_manager;

        /**
         * @var Connection
         */

        public static $connection_capsule;

        /**
         * DatabaseConnection constructor.
         * @param string $configuration_file
         * @param bool $autoconnect
         */

        public function __construct( $configuration_file = null, $autoconnect=true )
        {

            if( $configuration_file == null )
                $configuration_file = ZERODAY_DATABASE_CONNECTIONFILE;

            $this->connection_configuration = new DatabaseConfiguration( $configuration_file );
            $this->connection_manager = new Manager();

            if( $autoconnect )
                $this->connect();
        }

        /**
         * @param bool $global
         * @throws ZeroDayException
         */

        public function connect( $global=true )
        {

            if( $this->connection_configuration->check() == false )
                throw new ZeroDayException("Formatting of the configuration file is incorrect");

            $this->connection_manager->addConnection( $this->getConnectionConfiguration() );

            $this->connection_manager->setAsGlobal();

            if( $global )
                self::$connection_capsule = $this->connection_manager->getConnection();
        }

        /**
         * @return bool
         */

        public function hasConnection()
        {

            try
            {

                $this->connection_manager->getConnection()->getPdo();
            }
            catch( \Exception $error )
            {

                return false;
            }

            return true;
        }

        /**
         * @return array
         */

        private function getConnectionConfiguration()
        {

            return ( $this->connection_configuration->toArray() );
        }
    }