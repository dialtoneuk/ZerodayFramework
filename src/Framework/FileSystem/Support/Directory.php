<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: Directory.php
     *
     * Created by: Gaming (on 24/06/2017 at 13:08)
     */

    namespace Zeroday\Framework\FileSystem\Support;


    use Zeroday\Framework\Exceptions\Support\ZeroDayException;

    class Directory
    {

        protected $directory_path;

        public function __construct( string $directory_path )
        {

            if( file_exists( $directory_path ) == false )
                throw new ZeroDayException("Directory $directory_path does not exist");

            if( is_dir( $directory_path ) == false )
                throw new ZeroDayException("Path is not a directory");

            if( strpos( $directory_path, -1 ) !== DIRECTORY_SEPARATOR )
                $directory_path = $directory_path . DIRECTORY_SEPARATOR;

            $this->directory_path = $directory_path;
        }

        public function contents()
        {

            $contents = glob( $this->directory_path . "*" );
            $files = array();

            foreach( $contents as $filepath )
            {

                $files[] = new File( $filepath );
            }

            return $files;
        }

        public function search( $query="*.php" )
        {

            $contents = glob( $this->directory_path . $query );
            $files = array();

            foreach( $contents as $filepath )
            {

                $files[] = new File( $filepath );
            }

            return $files;
        }

        public function create( $file_name )
        {

            file_put_contents( $this->directory_path . $file_name, null );

            if( file_exists( $this->directory_path . $file_name ) == false )
                throw new ZeroDayException("Failed to create file $file_name in $this->directory_path");

            return new File( $this->directory_path . $file_name );
        }

        public function delete()
        {

            rmdir( $this->directory_path );
        }

        public function count()
        {

            return ( count( $this->contents() ) );
        }
    }