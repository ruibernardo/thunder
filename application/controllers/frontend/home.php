<?php if(!defined("THUNDER_MANAGED")){header("Location:/dead-end/403");exit();}?>
<?php
    class Home extends Controller {

        function __construct($scope,$domain,$controller) {
            parent::__construct($scope,$domain,$controller);
        }
        
        public function index($parameters,$binder)
        {	
            $c = $this;

            $c->data("testicles","name:" . $binder->name . " age:" . $binder->age);

            $c->redirect("frontend/home/other/bubu/22");

            return $c->view();
        }

        public function other($parameters,$binder)
        {	
            $c = $this;

            $c->data("testicles","name:" . $binder->name . " age:" . $binder->age);

            return $c->view("frontend/home/index");
        }
        
    }
?>