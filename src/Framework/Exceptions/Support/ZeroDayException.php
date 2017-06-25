<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: ZeroDayException.php
     *
     * Created by: Gaming (on 24/06/2017 at 11:19)
     */

    namespace Zeroday\Framework\Exceptions\Support;


    use Exception;

    class ZeroDayException extends \Exception
    {

        public function __construct($message = "", $code = 0, Exception $previous = null)
        {

            parent::__construct($message, $code, $previous);
        }
    }