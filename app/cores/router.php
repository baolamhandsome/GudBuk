<?php
class Router
{
    protected $routers = [];
    //2 hàm dưới là tương ứng 2 hàm gán URL + function vào mảng thôi
    public function get($url, $action, $middleware = [])
    {
        $this->routers['GET'][$url] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }
    public function post($url, $action, $middleware = [])
    {
        $this->routers['POST'][$url] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    //define cách xử lí 1 url : ví dụ 1 req có dạng : get('user','userController@index')
    public function processURL($method, $url)
    {
        $url = ($url) ?: '/'; //nếu url rỗng thì trả đưa người dùng về /home
        //nếu tồn tại url thì :
        if (isset($this->routers[$method][$url])) {

            $route = $this->routers[$method][$url];
            $action = $route['action'];

            //Vì middleware có thể null ở một số route
            $middlewares = $route['middleware'] ?? [];
            if ($middlewares) {
                foreach ($middlewares as $middlewareClass) {
                    require_once "./app/middlewares/$middlewareClass.php";
                    $middleware = new $middlewareClass();

                    if ($middlewareClass === "AuthMiddleware") {
                        $role = $middleware->handle();
                        if (!$role) {
                            // redirect('http://localhost/gudbuk/login');
                            exit();
                        }
                        if (strpos($url, '/admin-dashboard') === 0) {
                            if ($role != "ADMIN") {
                                // Người dùng thường cố vào trang admin
                                header("HTTP/1.1 403 Forbidden");
                                echo "<h1>403 - Lỗi bảo mật</h1><p>Bạn không có quyền truy cập trang quản trị!</p>";
                                exit();
                            }
                        }
                    } else if ($middlewareClass === "UserIDMiddleware") {
                        // echo '<pre>';
                        // print_r($_GET);
                        // echo '</pre>';

                        $userid = $_GET['userid'];
                        if (!$userid) continue;
                        $check = $middleware->handle($userid);
                        if (!$check) {
                            redirect("http://localhost/gudbuk/home");
                        }
                    } else if ($middlewareClass === "OrderIDMiddleware") {
                        $orderid = $_GET['orderid'];
                        if (!$orderid) continue;
                        $check = $middleware->handle($orderid);
                        if (!$check) {
                            redirect("http://localhost/gudbuk/home");
                        }
                    }
                }
            }

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
