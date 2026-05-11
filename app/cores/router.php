<?php
class Router
{
    protected $routers = [];
    //2 hàm dưới là tương ứng 2 hàm gán URL + function vào mảng thôi
    public function get($url, $action)
    {
        $this->routers['GET'][$url] = $action;
    }
    public function post($url, $action)
    {
        $this->routers['POST'][$url] = $action;
    }

    //define cách xử lí 1 url : ví dụ 1 req có dạng : get('user','userController@index')
    public function processURL($method, $url)
    {

        $url = ($url) ?: '/'; //nếu url rỗng thì trả đưa người dùng về /home
        //nếu tồn tại url thì :
        if (isset($this->routers[$method][$url])) {
            $action = $this->routers[$method][$url];
            // truncate thành 2 chuỗi con bởi kí tự @
            [$controller, $function] = explode('@', $action);

            //sau khi xử lí url xong ta có 2 thành phần của nó là : controller + chức năng cần thực hiện trong nó
            require_once "./app/controllers/$controller.php";
            $useController = new $controller();
            $useController->$function();
        } else {
            echo '404 Router';
        }
    }
}
