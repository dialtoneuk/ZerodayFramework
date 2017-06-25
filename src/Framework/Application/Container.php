<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: Container.php
     *
     * Created by: Gaming (on 25/06/2017 at 12:07)
     */

    namespace Zeroday\Framework\Application;


    use Zeroday\Framework\Configuration\Support\SettingsConfiguration;
    use Zeroday\Framework\Pages\PageController;

    class Container
    {

        protected static $container_objects;

        /**
         * @param $object_name
         * @return PageController|\stdClass|SettingsConfiguration
         */

        public static function get( $object_name )
        {

            return ( self::$container_objects[ $object_name ] );
        }

        public static function set( $object_name, $object_value )
        {

            self::$container_objects[ $object_name ] = $object_value;
        }

        public static function unset( $object_name )
        {

            unset( self::$container_objects[ $object_name ] );
        }

        public static function has( $object_name )
        {

            return( isset( self::$container_objects[ $object_name ] ) );
        }
    }