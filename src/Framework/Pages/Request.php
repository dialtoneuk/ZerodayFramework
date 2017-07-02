<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: Request.php
     *
     * Created by: Gaming (on 02/07/2017 at 15:03)
     */

    namespace Zeroday\Framework\Pages;


    class Request
    {

        protected static function isPost()
        {

            return( $_SERVER['REQUEST_METHOD'] == 'POST' );
        }

        public static function compareData( array $requirements )
        {

            if( empty( $_POST ) )
                return false;

            foreach( $requirements as $key )
            {

                if( isset( $_POST[ $key ] ) == false )
                    return false;

                if( empty( $_POST[ $key ] ) )
                    return false;
            }

            return true;
        }
    }