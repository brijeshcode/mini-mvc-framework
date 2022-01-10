<?php
/**
 * router class responsible for actions related to routers
 */
namespace Core;

class Router
{
        public $routes = [
                'GET' => [],
                'POST' => []
        ];

        public function get($uri, $controllers)
        {
                /*if (strpos($uri, '{id}') !== false) {
                        $temp = Request::uri();
                        $arr = explode('/', $temp);
                    $uri = str_replace('{id}', $arr[count($arr) - 1], $uri);
                }*/
                $this->routes['GET'][$uri] = $controllers;
        }

        public function post($uri, $controllers)
        {
            $this->routes['POST'][$uri] = $controllers;
        }
        public static function load($file)
        {
            $router = new static;
            require $file;
            return $router;
        }

        public function direct($uri, $requestType)
        {
                /*echo html_entity_decode($uri);
                echo getStrBetween($uri, '{','}');
                die;*/
                if(array_key_exists($uri, $this->routes[$requestType])){
                        // return $this->routes[$requestType][$uri];
                        return  $this->callAction(
                                ...explode('@', $this->routes[$requestType][$uri])
                        );
                }else{
                        // throw new Exception("No Route is defined for the given uri", 1);
                        // echo "<pre>"; var_dump($this->routes['GET']['']); echo "</pre>"; die();
                        require $this->routes['GET']['404'];
                }
        }

        protected function callAction($controller , $action)
        {
                $controller = "\\App\\Controllers\\{$controller}";
                $controller = new $controller;
                if ( ! method_exists($controller,$action)) {
                        throw new Exception("{$controller} does not respond to the {$action} action.", 1);
                }
                return $controller->$action();
        }
}

?>
