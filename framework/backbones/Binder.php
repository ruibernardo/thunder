<?php if(!defined("THUNDER_MANAGED")){header("Location:/dead-end/403");exit();}?>
<?php
    class Binder {

        function __construct($parameters,$registers) {
            for($r=0;$r<sizeof($registers);$r++){
                $varname = $registers[$r];
                $this->$varname = $parameters[$r];
            }
        }

    }
?>