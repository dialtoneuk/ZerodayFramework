<?php
    /**
     * zeroday by Lewis Lancaster 2017
     *
     * Current file: FileSystemController.php
     *
     * Created by: Gaming (on 24/06/2017 at 11:16)
     */

    namespace Zeroday\Framework\FileSystem;


    use Zeroday\Framework\FileSystem\Support\Directory;
    use Zeroday\Framework\FileSystem\Support\File;

    class FileSystemController
    {

        public static function getFile( $file_path )
        {

            return ( new File( self::getPath( $file_path ) ) );
        }

        public static function getDir( $directory_path )
        {

            return ( new Directory( self::getPath( $directory_path ) ) );
        }

        public static function exists( $file_path )
        {

            return ( file_exists( self::getPath( $file_path) ) );
        }

        public static function getPath( $file_path )
        {

            return ( ZERODAY_FILE_ROOT . $file_path );
        }
    }