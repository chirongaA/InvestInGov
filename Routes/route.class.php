<?php
namespace Routes;
//Define the route class
class route{
    public $method;
    public $path;
    public $callback;
    /**
     * Constructor
     * @param string $method The HTTP method
     * @param string $path The path
     * @param callable $callback The callback function
     */
    function __construct($method, $path, $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback=$callback;
    }
}
