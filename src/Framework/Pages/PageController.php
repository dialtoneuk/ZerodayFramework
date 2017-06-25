<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: PageController.php
     *
     * Created by: Gaming (on 25/06/2017 at 09:05)
     */

    namespace Zeroday\Framework\Pages;


    use Zeroday\Framework\Configuration\Support\SettingsConfiguration;
    use Zeroday\Framework\Exceptions\Support\ZeroDayException;

    class PageController
    {

        /**
         * @var SettingsConfiguration
         */

        protected $settings;

        /**
         * @var array
         */

        protected $data_requirements = [
            'model',
            'view',
            'controller'
        ];

        /**
         * @var array
         */

        protected $namespace_mapping = [
            'model'     => 'Models',
            'view'      => 'Views',
            'controller' => 'Controllers'
        ];

        /**
         * @var array
         */

        protected $page_classes = [];

        /**
         * @var null|string
         */

        protected $page_namespace = "Zeroday\\Game\\Pages\\";

        /**
         * @var array
         */

        protected static $page_payload = [];

        /**
         * PageController constructor.
         * @param null $page_namespace
         */

        public function __construct( $page_namespace=null )
        {

            $this->settings = new SettingsConfiguration();

            if( $page_namespace !== null )
                $this->page_namespace = $page_namespace;
        }

        /**
         * @param bool $global
         * @param bool $auto_output
         * @return ViewInterface
         * @throws ZeroDayException
         */

        public function run( $global=true, $auto_output = true )
        {

            if( PageRouter::empty() )
                throw new ZeroDayException("No routes have been found");

            $url = PageRouter::match( $this->url()['path'] );

            if( PageRouter::has( $url ) == false )
                $this->notFound();

            $data = PageRouter::get( $url );

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

            $this->frontController( $url, $controller );

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

        /**
         * @return bool
         */

        public function isRouted()
        {

            return( PageRouter::has( $this->url()['path'] ) );
        }

        /**
         * Displays a 404 page
         */

        public function notFound()
        {

            header("HTTP/1.0 404 Not Found"); exit;
        }

        /**
         * @param $url
         */

        public function redirect( $url )
        {

            header('Location: ' . $url ); exit;
        }

        /**
         * @return mixed
         */

        public function getPage()
        {

            if( empty( explode("/", $this->url()['path'] ) ) )
                return $this->settings->getSetting('page.index');

            return( explode("/", $this->url()['path'] )[1] );
        }

        /**
         * @param $url
         * @param ControllerInterface $controller
         */

        private function frontController( $url, ControllerInterface $controller )
        {

            if( PageRouter::hasVariables( $url ) )
                $variables = PageRouter::getVariables( $url );

            if( $_SERVER['REQUEST_METHOD'] == 'GET' )
            {

                if( isset( $variables ) )
                    $controller->get( $variables );
                else
                    $controller->get( null );
            }

            if( $_SERVER['REQUEST_METHOD'] == 'POST' )
            {

                if( isset( $variables ) )
                    $controller->post( $variables );
                else
                    $controller->post( null );
            }

            if( $_SERVER['REQUEST_METHOD'] == 'DELETE' )
            {

                if( isset( $variables ) )
                    $controller->delete( $variables );
                else
                    $controller->delete( null );
            }

            if( $_SERVER['REQUEST_METHOD'] == 'PUT' )
            {

                if( isset( $variables ) )
                    $controller->put( $variables );
                else
                    $controller->put( null );
            }
        }

        /**
         * @param $data
         * @return bool
         */

        private function check( $data )
        {

            foreach( $this->data_requirements as $requirement )
            {

                if( isset( $data[ $requirement ] ) == false )
                    return false;
            }

            return true;
        }

        /**
         * @param $key
         * @param $class
         * @return string
         */

        private function namespace( $key, $class )
        {

            return ( $this->page_namespace . $this->namespace_mapping[ $key ] . "\\" . $class );
        }

        /**
         * @return mixed
         */

        private function url()
        {

            return ( parse_url( $_SERVER['REQUEST_URI'] ) );
        }
    }