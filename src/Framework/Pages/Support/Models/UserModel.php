<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: UserModel.php
     *
     * Created by: Gaming (on 25/06/2017 at 12:30)
     */

    namespace Zeroday\Framework\Pages\Support\Models;


    use Zeroday\Framework\Pages\ModelInterface;
    use Zeroday\Framework\Users\UserManager;

    class UserModel extends ActiveSessionModel implements ModelInterface
    {

        protected $users;

        public function __construct()
        {

            $this->users = new UserManager();

            parent::__construct();
        }

        public function getData()
        {

            if( $this->session->isLoggedIn() == false )
                return array_merge([
                    'user' => false
                ], parent::getData() );

            return array_merge([
                'user' => [
                    'username'  => $this->users->username( $this->session->userid() ),
                    'email'     => $this->users->email( $this->session->userid() ),
                    'group'     => $this->users->group( $this->session->userid() )
                ]
            ], parent::getData() );
        }
    }