<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: SessionTable.php
     *
     * Created by: Gaming (on 24/06/2017 at 13:48)
     */

    namespace Zeroday\Framework\Database\Tables;


    use Zeroday\Framework\Database\Support\DatabaseTable;

    class SessionTable extends DatabaseTable
    {

        /**
         * SessionTable constructor.
         * @param string $table_name
         */

        public function __construct($table_name = 'sessions' )
        {

            parent::__construct($table_name);
        }

        /**
         * @param $sessionid
         * @return \Illuminate\Support\Collection
         */

        public function get( $sessionid )
        {

            return ( $this->where([
                'sessionid' => $sessionid
            ])->get() );
        }

        /**
         * @param $sessionid
         */

        public function delete( $sessionid )
        {

            $this->where([
                'sessionid' => $sessionid
            ])->delete();
        }

        /**
         * @param $userid
         * @return \Illuminate\Support\Collection
         */

        public function getByUser( $userid )
        {

            return( $this->where([
                'userid' => $userid
            ])->get() );
        }

        /**
         * @param $ipaddress
         * @return \Illuminate\Support\Collection
         */

        public function getByAddress( $ipaddress )
        {

            return( $this->where([
                'ipaddress' => $ipaddress
            ])->get());
        }
    }