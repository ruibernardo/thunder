<?php if(!defined("THUNDER_MANAGED")){header("Location:/dead-end/403");exit();}?>
<?php
    class Binder {

        function __construct($parameters,$registers) {
            $classmembers = get_object_vars($this);
            
            $sources = array($_GET,$_POST,$_FILES);

            foreach($classmembers as $membername => $memberval){
                foreach($sources as $source){
                    if(isset($source[$membername])){
                        $this->$membername = $source[$membername];
                        break;
                    }
                }
            }

            for($r=0;$r<sizeof($registers);$r++){
                $varname = $registers[$r];
                $this->$varname = $parameters[$r];
            }

        }

    }
?>