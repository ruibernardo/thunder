<?php
    class Security {

        public static function cleanRoute($slice) {
            return preg_replace("/[^a-zA-Z0-9\-_]/", "", $slice);
        }

    }
?>