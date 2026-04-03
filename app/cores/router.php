<?php
class Router {
    protected $routers = [];
    public function get($url, $action){
        $this->routers['GET'][$url] = $action;   
    }
    public function post($url, $action){
        $this->routers['POST'][$url] = $action;   
    }

    //get('user','userController@index')
    public function processURL($method, $url){
        
        $url = ($url) ? : '/';
        //nếu có url trong set thì :
        if(isset($this->routers[$method][$url])){
            $action = $this->routers[$method][$url];
            // truncate thành 2 chuỗi con bởi kí tự @
            [$controller,$function] = explode('@',$action);

            //sau khi xử lí url xong ta có 2 thành phần của nó là : CTR + method cần thực hiện trong nó
            require_once "./app/controllers/$controller.php";
            $useController = new $controller();
            $useController -> $function();
        }else {
            echo '404';
        }
    }
}