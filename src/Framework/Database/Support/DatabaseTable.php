<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: Table.php
     *
     * Created by: Gaming (on 24/06/2017 at 13:41)
     */

    namespace Zeroday\Framework\Database\Support;


    use Zeroday\Framework\Application\Container;
    use Zeroday\Framework\Database\DatabaseConnection;

    class DatabaseTable extends DatabaseConnection
    {

        /**
         * @var null
         */

        protected $table_name;

        /**
         * DatabaseTable constructor.
         * @param null $table_name
         */

        public function __construct( $table_name = null )
        {

            parent::__construct( false );

            if( empty( self::$connection_capsule ) || self::$connection_capsule == null )
                $this->connect( true );

            if( $table_name == null )
                $this->table_name = $this->getShortName();
            else
                $this->table_name = $table_name;
        }

        /**
         * @return \Illuminate\Database\Query\Builder
         */

        public function table()
        {

            return ( self::$connection_capsule->table( $this->table_name ) );
        }

        /**
         * @return \Illuminate\Database\Query\Builder
         */

        public function where( $query )
        {

            return ( self::$connection_capsule->table($this->table_name)->where( $query ) );
        }

        /**
         * @param $array
         */

        public function inset( $array )
        {

            self::$connection_capsule->table( $this->table_name )->insert( $array );
        }

        /**
         * @return string
         */

        private function getShortName()
        {

            $class = new \ReflectionClass( $this );

            if( Container::has('settings') )
            {

                if( Container::get('settings')->getSetting('database.table.lower') )
                    return ( strtolower( $class->getShortName() ) );
            }

            return ( $class->getShortName() );
        }
    }