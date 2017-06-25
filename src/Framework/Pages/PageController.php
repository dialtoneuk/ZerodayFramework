<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: PageController.php
     *
     * Created by: Gaming (on 25/06/2017 at 09:05)
     */

    namespace Zeroday\Framework\Pages;


    use Illuminate\Contracts\View\View;
    use Illuminate\Database\Eloquent\Model;
    use Zeroday\Framework\Configuration\Support\SettingsConfiguration;
    use Zeroday\Framework\Exceptions\Support\ZeroDayException;

    class PageController
    {

        protected $settings;
        protected $data_requirements = [
            'model',
            'view',
            'controller'
        ];
        protected $namespace_mapping = [
            'model'     => 'Models',
            'view'      => 'Views',
            'controller' => 'Controllers'
        ];
        protected $page_classes = [];
        protected $page_namespace = "Zeroday\\Game\\Pages\\";
        protected static $page_payload = [];

        public function __construct( $page_namespace=null )
        {

            $this->settings = new SettingsConfiguration();

            if( $page_namespace !== null )
                $this->page_namespace = $page_namespace;
        }

        public function run( $global=true, $auto_output = true )
        {

            if( PageRouter::empty() )
                throw new ZeroDayException("No routes have been found");

            if( $this->isRouted() == false )
                $this->notFound();

            $data = PageRouter::get( $this->url()['path'] );

            if( $this->check( $data ) == false )
                throw new ZeroDayException("Data for route " . $this->url()['path'] . " is incorrect");

            foreach( $data as $key=>$value )
            {

                if( class_exists( $this->namespace( $key, $value) ) == false )
                    throw new ZeroDayException("Class " . $this->namespace( $key, $value)  . " does not exist" );
            }

            $namespace =  $this->namespace('model', $data['model'] );

            /** @var ModelInterface $model */
            $model = new $namespace;

            if( $model instanceof ModelInterface == false )
                throw new ZeroDayException($data['model'] . " must implement the correct interface" );

            $namespace = $this->namespace('controller', $data['controller'] );

            /** @var ControllerInterface $controller **/
            $controller = new $namespace( $model );

            if( $controller instanceof ControllerInterface == false )
                throw new ZeroDayException($data['controller'] . " must implement the correct interface" );

            $this->frontController( $controller );

            $namespace = $this->namespace('view', $data['view'] );

            /** @var ViewInterface $view */
            $view = new $namespace( $controller, $model );

            if( $view instanceof ViewInterface == false )
                throw new ZeroDayException($data['view'] . " must implement the correct interface" );

            if( $global == true )
                self::$page_payload = [
                    'model'         => $model,
                    'controller'    => $controller,
                    'view'          => $view
                ];

            if( $auto_output )
                $view->output();

            return $view;
        }

        public function isRouted()
        {

            return( PageRouter::has( $this->url()['path'] ) );
        }

        public function notFound()
        {

            header("HTTP/1.0 404 Not Found"); exit;
        }

        public function getPage()
        {

            if( empty( explode("/", $this->url()['path'] ) ) )
                return $this->settings->getSetting('page.index');

            return( explode("/", $this->url()['path'] )[1] );
        }

        private function frontController( ControllerInterface $controller )
        {

            if( $_SERVER['REQUEST_METHOD'] == 'GET' )
            {

                $controller->get( $_GET );
            }

            if( $_SERVER['REQUEST_METHOD'] == 'POST' )
            {

                $controller->post( $_POST );
            }
        }

        private function check( $data )
        {

            foreach( $this->data_requirements as $requirement )
            {

                if( isset( $data[ $requirement ] ) == false )
                    return false;
            }

            return true;
        }

        private function namespace( $key, $class )
        {

            return ( $this->page_namespace . $this->namespace_mapping[ $key ] . "\\" . $class );
        }

        private function url()
        {

            return ( parse_url( $_SERVER['REQUEST_URI'] ) );
        }
    }