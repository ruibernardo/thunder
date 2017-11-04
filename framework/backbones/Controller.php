<?php if(!defined("THUNDER_MANAGED")){header("Location:/dead-end/403");exit();}?>
<?php
    class Controller {

        private $scope;
        private $domain;
        private $controller;
        private $action;
        private $parameters;
        private $heldData = array();

        function __construct($scope,$domain,$controller,$action,$parameters) {
            $this->scope = $scope;
            $this->domain = $domain;
            $this->controller = $controller;
            $this->action = $action;
            $this->parameters = $parameters;
        }

        function data($key,$value){
            $this->heldData[$key] = $value;
        }

        function view($path = "index",$wrapper = "") {
            $controller = $this->controller;
            $domain = $this->domain;

            $this->heldData["___VIEWID"] = array(
                "scope" => $this->scope,
                "domain" => $this->domain,
                "controller" => $this->controller,
                "action" => $this->action,
                "parameters" => $this->parameters 
            );

            ob_start();
            
            if(stripos($path,"/") !== FALSE){
                if(!FileSystem::includeWithData(__AP_DIR . "views/$path.php",$this->heldData))
                    throw new Exception("NO SUITABLE VIEW HERE");
            }else{
                if(!FileSystem::includeWithData(__AP_DIR . "views/$domain/$controller/$path.php",$this->heldData))
                    throw new Exception("NO SUITABLE VIEW HERE");
            }

            $___VIEWCONTENT = ob_get_contents(); 
            ob_end_clean();

            ob_start();

            $this->heldData["___VIEWCONTENT"] = $___VIEWCONTENT;
            if($wrapper != "" && !FileSystem::includeWithData(__AP_DIR . "wrapperviews/$wrapper.php",$this->heldData))
                throw new Exception("NO SUITABLE WRAPPER VIEW HERE");
            
            $wrap=ob_get_contents(); 
            ob_end_clean();
            
            return $wrap;
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