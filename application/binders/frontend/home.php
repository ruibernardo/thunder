<?php if(!defined("THUNDER_MANAGED")){header("Location:/dead-end/403");exit();}?>
<?php
    class HomeIndex extends Binder {

        function __construct($parameters) {
            parent::__construct($parameters,array("name","age"));
        }

    }

    class HomeOther extends Binder {
        
        function __construct($parameters) {
            parent::__construct($parameters,array("name","age"));
        }

    }
?>