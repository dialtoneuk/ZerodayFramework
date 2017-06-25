<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: ModelInterface.php
     *
     * Created by: Gaming (on 24/06/2017 at 09:52)
     */

    namespace Zeroday\Framework\Pages;


    interface ModelInterface
    {


        public function setData( array $data );


        /**
         * @return array
         */

        public function getData();

        /**
         * @return string
         */

        public function getTemplate();
    }