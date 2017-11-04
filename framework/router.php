<?php if(!defined("THUNDER_MANAGED")){header("Location:/dead-end/403");exit();}?>
<?php
    $routedata = explode("/",$_GET['route']);
    $domains = array_filter(glob(__AP_DIR . "controllers/*"), "is_dir");

    $scope = "";
    $domain = "";
    $controller = "";
    $action = "";
    $parameters = array();
    $domainindex = 0;

    foreach($domains as $d){
        $d = strtolower(substr($d,strripos($d,"/") + 1));
        if($d == strtolower($routedata[0])){
            $domain = $d;
            break;
        }elseif($d == strtolower($routedata[1])){
            $domain = $d;
            $scope = $routedata[0];
            $domainindex = 1;
            break;
        }
    }    

    if($domain == "")
        throw new Exception("LOAD 404 TEMPLATE HERE");

    $scope = Security::cleanRoute($scope); 
    $domain = Security::cleanRoute($domain); 

    $controllers = array_filter(glob(__AP_DIR . "controllers/$domain/*"), "is_file");
        
    foreach($controllers as $c){
        $c = str_replace(".php","",strtolower(substr($c,strripos($c,"/") + 1)));
        if($c == strtolower($routedata[$domainindex + 1])){
            $controller = $c;
            break;
        }
    }

    $action = $routedata[$domainindex + 2];
    $parameters = array_slice($routedata,$domainindex + 3);
   
    $controller = Security::cleanRoute($controller); 
    $action = Security::cleanRoute($action); 

    if(!FileSystem::include(__AP_DIR . "controllers/$domain/$controller.php"))
        throw new Exception("LOAD 404 TEMPLATE HERE");

    $hasbinder = FileSystem::include(__AP_DIR . "binders/$domain/$controller.php");
    $controllerClass = ucfirst($controller);
    
    $cc = new $controllerClass($scope,$domain,$controller,$action,$parameters);
    $binderClass = ($hasbinder) ? ucfirst($controller).ucfirst($action) : "";

    if($hasbinder && class_exists($binderClass))
        echo $cc->$action($parameters,new $binderClass($parameters));
    else
        echo $cc->$action($parameters);
?>