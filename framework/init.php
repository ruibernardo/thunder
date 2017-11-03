<?php if(!defined("THUNDER_MANAGED")){header("Location:/dead-end/403");exit();}?>
<?php

    function error_handler($errno, $errstr, $errfile, $errline){
        echo "$errno, $errstr, $errfile, $errline";
    };

    function exception_handler($exception ){
        var_dump($exception);
    };

    function shutdown(){
        
    }

    set_error_handler("error_handler");
    set_exception_handler("exception_handler");
    register_shutdown_function("shutdown");

    $backbones = array("Controller","Binder");
    foreach($backbones as $backbone)
        require_once(__FW_DIR . "backbones/$backbone.php");

    require_once(__FW_DIR . "router.php");
    
?>