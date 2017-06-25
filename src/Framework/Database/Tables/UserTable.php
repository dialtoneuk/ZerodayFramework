<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: UserTable.php
     *
     * Created by: Gaming (on 25/06/2017 at 12:33)
     */

    namespace Zeroday\Framework\Database\Tables;


    use Zeroday\Framework\Database\Support\DatabaseTable;

    class UserTable extends DatabaseTable
    {

        public function __construct($table_name = 'users')
        {

            parent::__construct($table_name);
        }

        public function get( $userid )
        {

            return( $this->where([
                'userid' => $userid
            ])->get() );
        }

        public function find( $username )
        {

            return( $this->where([
                'username' => $username
            ])->get() );
        }
    }