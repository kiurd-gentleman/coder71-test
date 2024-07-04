<?php
namespace App\Core;

use App\Core\Params;
use App\Core\Request;

class Route
{
    /**
     * Keep all the routes
     *
     * @var array
     */
    private static $routes = array();

    /**
     * Route Request Method
     *
     * @var string
     */
    private $method;

    /**
     * Route Path
     *
     * @var string
     */
    private $path;

    /**
     * Route Action
     *
     * @var string
     */
    private $action;

    /**
     * Constructor
     *
     * @param string $method
     * @param string $path
     * @param string $action
     */
    public function __construct($method, $path, $action)
    {
        $this->method = $method;
        $this->path = $path;
        $this->action = $action;
    }

    /**
     * Add GET requests to routes
     *
     * @param string $path
     * @param string $action
     * @return void
     */
    public static function get($path, $action)
    {
        self::$routes[] = new Route('get', $path, $action);
    }

    /**
     * Add POST requests to routes
     *
     * @param string $path
     * @param string $action
     * @return void
     */
    public static function post($path, $action)
    {
        self::$routes[] = new Route('post', $path, $action);
    }

    /**
     * Get the routes array
     *
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Handle route to destinated controller function
     *
     * @param string $path
     * @return void
     */
    public static function handle($path)
    {
        $desired_route = null;

        //index.php remove from the path

        $path = str_replace('/index.php', '', $path);
//
//        echo '<h1>Route Debugging</h1>';
//        echo '<pre>';
//        echo 'Routes: ' . print_r(self::$routes, true) . PHP_EOL;
//        echo 'Path to match: ' . $path . PHP_EOL;
//        echo '</pre>';

        foreach (self::$routes as $route) {
            $pattern = $route->path;
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^' . $pattern . '$/i';
            $pattern = preg_replace('/{[A-Za-z0-9]+}/', '([A-Za-z0-9]+)', $pattern);
//
//            echo '<h1>Route Debugging1</h1>';
//
//            echo '<pre>';
//            echo 'Route Path: ' . $route->path . PHP_EOL;
//            echo 'Constructed Pattern: ' . $pattern . PHP_EOL;
//            echo '</pre>';

            if (preg_match($pattern, $path, $match)) {
                $desired_route = $route;
//                break; // Exit the loop once a match is found
            }
        }

        if ($desired_route) {
            $url_parts = explode('/', $path);
            $route_parts = explode('/', $desired_route->path);

//            echo '<pre>';
//            echo 'URL Parts: ' . print_r($url_parts, true) . PHP_EOL;
//            echo 'Route Parts: ' . print_r($route_parts, true) . PHP_EOL;
//            echo '</pre>';

            foreach ($route_parts as $key => $value) {
                if (!empty($value)) {
                    $value = str_replace('{', '', $value, $count1);
                    $value = str_replace('}', '', $value, $count2);

                    if ($count1 == 1 && $count2 == 1) {
                        Params::set($value, $url_parts[$key]);
                    }
                }
            }

            echo '<pre>';
            echo 'URL Parts: ' . $desired_route->method . PHP_EOL;
            echo 'Route Parts: ' . strtolower($_SERVER['REQUEST_METHOD']) . PHP_EOL;
            echo '</pre>';

            if ($desired_route->method != strtolower($_SERVER['REQUEST_METHOD'])) {
                http_response_code(404);
                echo '<h1>Route Not Allowed</h1>';
                die();
            } else {
                $actions = explode('@', $desired_route->action);
                $class = '\\App\\Http\\Controllers\\' . $actions[0];
                $obj = new $class();
//                (new Request()) = $_POST;
                $obj1 = new Request();
                $obj1->request = $_POST;
                echo call_user_func(array($obj, $actions[1]));
            }
        } else {
            http_response_code(404);
            echo '<h1>404 - Not Found</h1>';
            die();
        }
    }
}