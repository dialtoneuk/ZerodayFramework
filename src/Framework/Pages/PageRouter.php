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

        public static function match( $url )
        {

            foreach( self::$routes as $key=>$value )
            {

                $url = self::getBase( $key, $url );

                $route_url = self::transform( $key );

                if( $route_url == $url )
                {

                    return $key;
                }
            }

            return null;
        }

        public static function transform( $url )
        {

            $url = array_values( explode('/', $url ) );

            foreach( $url as $key=>$value )
            {

                if( substr( $value, 0, 1 ) == "@" )
                    unset( $url[ $key ] );
            }

            return implode('/', $url );
        }

        public static function getBase( $route, $url )
        {

            $route = array_values( explode('/', $route ) );

            $url = array_values( explode('/', $url ) );

            foreach( $route as $key=>$value )
            {

                if( substr( $value, 0, 1 ) == "@" )
                    unset( $url[ $key ] );
            }

            return implode('/', $url );
        }

        public static function getVariables( $url )
        {

            $request_url = array_values( explode('/', parse_url( $_SERVER['REQUEST_URI'] )['path'] ) );

            if( empty( $request_url ) )
                return [];

            $url = array_values( explode('/', $url ) );

            if( count( $url ) !== count( $request_url ) )
                throw new ZeroDayException('Mismatch in url parameter count');

            $variables = [];

            foreach( $url as $key=>$value )
            {

                if( substr( $value, 0, 1 ) == "@" )
                    $variables[ ltrim( $value, '@') ] = $request_url[ $key ];
            }


            return $variables;
        }

        public static function hasVariables( $url )
        {

            return( str_contains( $url, '@' ) );
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