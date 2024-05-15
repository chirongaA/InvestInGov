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
        //Strip the parameters from the path
        if(isset(explode('?', $path)[1])    )
        {
        $parameters = explode('?', $path)[1];//Get the parameters
        }
        else{
            $parameters=null;
        }
        $path = explode('?', $path)[0]; //Get the path without the parameters
        $method = $_SERVER['REQUEST_METHOD'];//Get the request method
        //Check if the method type is POST and the content type is JSON
        if($method == 'POST' && $_SERVER['CONTENT_TYPE'] == 'application/json')
        {
            //Get the JSON data
            $data = json_decode(file_get_contents('php://input'), true);
            //Check if the data is not null
            if($data != null)
            {
                //Add the data to the $_POST array
                $_POST = $data;
                $parameters=$data;
            }
        }
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
