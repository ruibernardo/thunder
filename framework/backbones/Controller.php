<?php if(!defined("THUNDER_MANAGED")){header("Location:/dead-end/403");exit();}?>
<?php
    class Controller {

        private $scope;
        private $domain;
        private $controller;
        private $heldData = array();

        function __construct($scope,$domain,$controller) {
            $this->scope = $scope;
            $this->domain = $domain;
            $this->controller = $controller;
        }

        function data($key,$value){
            $this->heldData[$key] = $value;
        }

        function view($action = "index") {
            $controller = $this->controller;
            $domain = $this->domain;
            extract($this->heldData);
            ob_start();
            include(__AP_DIR . "views/$domain/$controller/$action.php");
            $content=ob_get_contents(); 
            ob_end_clean();
            return $content;
        }

        function redirect($route){
            $scope = ($this->scope != "") ? ($this->scope . "/") : "";
            header("Location:/" . $scope . $route);
            exit();
        }

        function reroute($route){
            header("Location:/$route");
            exit();
        }

    }
?>