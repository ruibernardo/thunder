<?php
    class FileSystem {

        public static function include($path,$includesfolder = false) {
            return self::_include($path,array(),$includesfolder);
        }

        public static function includeWithData($path,$data,$includesfolder = false) {
            return self::_include($path,$data,$includesfolder);
        }

        private static function _include($path,$data,$includesfolder){
            if($includesfolder)
                $path = __AP_DIR . "includes/$path.php";
                
            extract($data);

            if(file_exists($path)){
                require($path);
                return TRUE;
            }
            return FALSE;
        }

    }
?>