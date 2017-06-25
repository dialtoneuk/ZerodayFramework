<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: IndexModel.php
     *
     * Created by: Gaming (on 24/06/2017 at 09:56)
     */

    namespace Zeroday\Game\Pages\Models;


    use Zeroday\Framework\Pages\ModelInterface;
    use Zeroday\Framework\Pages\Support\Models\SessionModel;

    class IndexModel extends SessionModel implements ModelInterface
    {

        /**
         * @var array
         */

        protected $data = [];

        /**
         * @param array $array
         */

        public function setData( array $array )
        {

            $this->data = array_merge( $this->data, $array );
        }

        /**
         * @return array
         */

        public function getData()
        {

            return ( array_merge( $this->data, parent::getData() ) );
        }

        /**
         * @return string
         */

        public function getTemplate()
        {

            return ( 'templates/pages/page.index' );
        }
    }