<?php 
//Define the router class
class Router{
    //A member to hold the routes
    private $routes = array();

    function __construct($routes)
    {
        $this->routes=$routes;
    }

    public function route($path)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        //Strip the parameters from the path
        if(isset(explode('?', $path)[1])    )
        {
        $parameters = explode('?', $path)[1];
        }
        else{
            $parameters=null;
        }
        $path = explode('?', $path)[0];
        $matchingRoutes = array_filter($this->routes, function($route) use ($path, $method) {
            return $route->path == $path && $route->method == $method;
        });
        if (!empty($matchingRoutes)) {
            $callback = reset($matchingRoutes)->callback;
            $callback($parameters);
            return;
        }
        echo "404 - Not Found";
    }
}

class route{
    public $method;
    public $path;
    public $callback;
    function __construct($method, $path, $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback=$callback;
    }
}
