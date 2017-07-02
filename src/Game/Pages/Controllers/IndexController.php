<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: IndexController.php
     *
     * Created by: Gaming (on 25/06/2017 at 09:03)
     */

    namespace Zeroday\Game\Pages\Controllers;


    use Zeroday\Framework\Pages\ControllerInterface;
    use Zeroday\Framework\Pages\ModelInterface;

    class IndexController implements ControllerInterface
    {

        protected $model;

        public function __construct( ModelInterface $model )
        {

            $this->model = $model;
        }

        public function get( $parameters=null, $data=[] )
        {


        }

        public function post( $parameters=null, $data=null )
        {
            // TODO: Implement post() method.
        }

        public function delete( $parameters=null, $data=null )
        {
            // TODO: Implement delete() method.
        }

        public function put( $parameters=null, $data=null )
        {
            // TODO: Implement pit() method.
        }
    }