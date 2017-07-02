<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: LoginController.php
     *
     * Created by: Gaming (on 02/07/2017 at 14:58)
     */

    namespace Zeroday\Game\Pages\Controllers;


    use Zeroday\Framework\Application\Container;
    use Zeroday\Framework\Pages\ControllerInterface;
    use Zeroday\Framework\Pages\ModelInterface;
    use Zeroday\Framework\Pages\Request;
    use Zeroday\Framework\Session\SessionManager;
    use Zeroday\Framework\Users\UserManager;

    class LoginController implements ControllerInterface
    {

        protected $model;
        protected $session;
        protected $usermanager;

        protected $required_post_keys = [
            'username',
            'password',
            'recaptcha'
        ];

        public function __construct( ModelInterface $model )
        {

            $this->model = $model;
            $this->session = new SessionManager();
            $this->usermanager = new UserManager();
        }

        public function get($parameters = null, $data = [])
        {

            if( isset( $this->model->getData()['session'] ) )
            {

                if( $this->model->getData()['session']['active'] !== false )
                    Container::get('page_controller')->redirect('index');
            }
        }

        public function post($parameters = null, $data = [])
        {

            if( isset( $this->model->getData()['session'] ) )
            {

                if( $this->model->getData()['session']['active'] !== false )
                    Container::get('page_controller')->redirect('index');
            }

            if( Request::compareData( $this->required_post_keys ) == false )
            {

                $this->model->setData([
                    'error' => 'Missing information'
                ]);

                return;
            }

            $username = $data['username'];
            $password = $data['password'];
            $recaptcha = $data['recaptcha'];

            if( $this->usermanager->find( $username )->isEmpty() )
            {

                $this->model->setData([
                    'error' => 'Information incorrect'
                ]);

                return;
            }

            $user = $this->usermanager->find( $username )->first();

            if( sha1( $password . $user->salt ) !== $user->password )
            {

                $this->model->setData([
                    'error' => 'Information incorrect'
                ]);

                return;
            }

            $this->session->regenerate();
            $this->session->add( $user->userid );

            Container::get('page_controller')->redirect('index');
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