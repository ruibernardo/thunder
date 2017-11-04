<?php
    class Url {

        public static function action($viewdata,$route,$params) {
            $url = "/";
            $route = trim($route, "/");
            $routenodes = explode("/",$route);
            $nodecount = sizeof($routenodes);
            if($nodecount == 3)
                $url.=$route;
            if($nodecount == 2)
                $url.="{$viewdata['scope']}/{$viewdata['domain']}/$route";
            if($nodecount == 1)
                $url.="{$viewdata['scope']}/{$viewdata['domain']}/{$viewdata['controller']}/$route";

            foreach($params as $param){
                $url.="/$param";
            }
            
            return $url;
        }

        public static function rescope($viewdata,$scope){
            $url = "/$scope/{$viewdata['domain']}/{$viewdata['controller']}/{$viewdata['action']}";
            foreach($viewdata['parameters'] as $param){
                $url.="/$param";
            }
            return $url;
        }

    }
?>