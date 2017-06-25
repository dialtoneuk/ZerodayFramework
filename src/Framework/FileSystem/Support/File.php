<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: File.php
     *
     * Created by: Gaming (on 24/06/2017 at 11:19)
     */

    namespace Zeroday\Framework\FileSystem\Support;


    use Zeroday\Framework\Exceptions\Support\ZeroDayException;

    class File
    {

        protected $file_path;

        public function __construct( string $file_path )
        {

            if( file_exists( $file_path ) == false )
                throw new ZeroDayException("File $file_path does not exist");

            if( is_file( $file_path ) == false )
                throw new ZeroDayException("Path is not a file");

            $this->file_path = $file_path;
        }

        public function delete()
        {

            unlink( $this->file_path );
        }

        public function read()
        {

            return ( file_get_contents( $this->file_path ) );
        }

        public function write( $data=null )
        {

            file_put_contents( $this->file_path, $data );
        }

        public function writeJson( $data )
        {

            file_put_contents( $this->file_path, json_encode( $data ) );
        }

        public function readJson( $association=false)
        {

            return ( json_decode( $this->read(), $association ) );
        }

        public function serialize( $data )
        {

            file_put_contents( $this->file_path, serialize( $data ) );
        }

        public function unserialize()
        {

            return ( unserialize( file_get_contents( $this->file_path ) ) );
        }

        public function info()
        {

            return ( pathinfo( $this->file_path) );
        }

        public function extension()
        {

            return( $this->info()['extension'] );
        }

        public function filename()
        {

            return( $this->info()['filename'] );
        }

        public function size()
        {

            return ( filesize( $this->file_path ) );
        }

        public function permissions()
        {

            return( fileperms( $this->file_path ) );
        }

        public function chmod( $permission )
        {

            chmod( $this->file_path, $permission );
        }

        public function isJson()
        {

            json_decode( $this->read() );

            return ( json_last_error() !== JSON_ERROR_NONE );
        }
    }