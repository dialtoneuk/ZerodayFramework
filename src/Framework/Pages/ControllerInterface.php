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

        public function get( array $parameters );

        public function post( array $data );

        public function delete( array $data );

        public function put( array $data );
    }