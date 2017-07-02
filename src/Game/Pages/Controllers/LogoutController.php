<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: LogoutController.php
     *
     * Created by: Gaming (on 02/07/2017 at 15:27)
     */

    namespace Zeroday\Game\Pages\Controllers;


    use Zeroday\Framework\Application\Container;
    use Zeroday\Framework\Pages\ControllerInterface;
    use Zeroday\Framework\Pages\ModelInterface;
    use Zeroday\Framework\Session\SessionManager;

    class LogoutController implements ControllerInterface
    {

        protected $model;
        protected $session;

        public function __construct( ModelInterface $model )
        {

            $this->model = $model;
            $this->session = new SessionManager();
        }

        public function get($parameters = null, $data = [])
        {

            if( $this->session->active() == false )
                Container::get('page_controller')->redirect('index');

            $this->session->remove();
            $this->session->keep([]);
            $this->session->destroy();

            Container::get('page_controller')->redirect('index');
        }

        public function post($parameters = null, $data = [])
        {


        }

        public function delete($parameters = null, $data = [])
        {
            // TODO: Implement delete() method.
        }

        public function put($paremeters = null, $data = [])
        {
            // TODO: Implement put() method.
        }
    }