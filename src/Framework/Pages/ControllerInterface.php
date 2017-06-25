<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: ControllerInterface.php
     *
     * Created by: Gaming (on 24/06/2017 at 09:53)
     */

    namespace Zeroday\Framework\Pages;


    interface ControllerInterface
    {

        public function get( $parameters=null );

        public function post( $data=null );

        public function delete( $data=null );

        public function put( $data=null );
    }