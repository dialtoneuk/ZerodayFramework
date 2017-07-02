<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: LoginView.php
     *
     * Created by: Gaming (on 24/06/2017 at 09:50)
     */

    namespace Zeroday\Game\Pages\Views;


    use Zeroday\Framework\Pages\ControllerInterface;
    use Zeroday\Framework\Pages\ModelInterface;
    use Zeroday\Framework\Pages\ViewInterface;

    class LoginView implements ViewInterface
    {

        protected $controller;
        protected $model;

        public function __construct( ControllerInterface $controller, ModelInterface $model )
        {

            $this->model = $model;
            $this->controller = $controller;
        }

        public function output()
        {

            $data = $this->model->getData();

            die( print_r( $data ) );
        }
    }