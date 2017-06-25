<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: ConfigurationManager.php
     *
     * Created by: Gaming (on 24/06/2017 at 11:16)
     */

    namespace Zeroday\Framework\Configuration;


    use Zeroday\Framework\Exceptions\Support\ZeroDayException;
    use Zeroday\Framework\FileSystem\FileSystemController;
    use Zeroday\Framework\FileSystem\Support\File;

    class ConfigurationManager
    {

        protected $configuration_file;
        protected $configuration_cache;

        public function __construct( $configuration_location="/config/default.json", $autocache=true )
        {

            if( FileSystemController::exists( $configuration_location ) == false )
                throw new ZeroDayException("Configuration file $configuration_location does not exist");

            $this->configuration_file = new File( FileSystemController::getPath( $configuration_location ) );

            if( $autocache == true )
                $this->configuration_cache = $this->get();
        }

        public function clear()
        {

            $this->configuration_file->writeJson([]);
        }

        public function get()
        {

            return ( $this->configuration_file->readJson() );
        }

        public function find( $configuration_name )
        {

            if( empty( $this->configuraton_cache ) )
                $this->configuration_cache = $this->get();

            return ( $this->configuration_cache->$configuration_name );
        }

        public function has( $configuration_name )
        {

            if( empty( $this->configuraton_cache ) )
                $this->configuration_cache = $this->get();

            return ( isset( $this->configuraton_cache->$configuration_name ) );
        }

        public function set( $configuration_name, $configuration_value )
        {

            $data = $this->get();

            if( isset( $data->$configuration_name ) )
                throw new ZeroDayException("Configuration name $configuration_name already is set");

            $data->$configuration_name = $configuration_value;

            $this->configuration_file->writeJson( $data );
        }
    }