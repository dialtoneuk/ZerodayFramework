<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: PageRouter.php
     *
     * Created by: Gaming (on 25/06/2017 at 09:08)
     */

    namespace Zeroday\Framework\Pages;


    use Zeroday\Framework\Exceptions\Support\ZeroDayException;

    class PageRouter
    {

        protected static $routes;

        public static function route( $url, array $data )
        {

            if( isset( self::$routes[ $url ] ) )
                throw new ZeroDayException("Route $url has already been set");

            self::$routes[ $url ] = $data;
        }

        public static function get( $url )
        {

            return( self::$routes[ $url] );
        }

        public static function has( $url )
        {

            return( isset( self::$routes[ $url ] ) );
        }

        public static function empty()
        {

            return( empty( self::$routes ) );
        }
    }