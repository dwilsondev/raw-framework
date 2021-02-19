<?php

    /**
     *
     * Kernel class processes urls by breaking them down and setting up the
     * controller -> method -> params. This class uses the controller
     * specified in system/config.php as the default controller.
     *
     */
    class Kernel
    {
        protected $controller = DEFAULT_CONTROLLER;
        protected $method = "index";
        protected $params = [];

        /**
         * raw function
         *
         * Break up URLs into controller, method, and params.
         *
         * First load the controller, a method (if requested), and pass params
         * into the method (if applied).
         *
         * @return void
         */
        public function raw()
        {

            // Parse url, filter, and sanitize the url.
            if (isset($_GET["url"])) {
                $url = explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
            }

            $controller_is_dir = false;

            // Check if the controller requested is located in a sub directory inside the controllers folder.
            // If so, set the controller to second url index instead of the first.
            if (isset($url[0]) && isset($url[1]) && file_exists(CONTROLLER_PATH.$url[0]."/".$url[1].".php")) {
                $this->controller = $url[1];

                $controller_is_dir = true;
            }

            // Check if controller requested is at the root of the controllers folder.
            // and set it to the first url index.
            if (isset($url[0]) && file_exists(CONTROLLER_PATH.$url[0].".php")) {
                $this->controller = $url[0];
                unset($url[0]);
            }

            // Load controller file and unset the controller indexes.
            if ($controller_is_dir == true) {
                require_once CONTROLLER_PATH.$url[0]."/".$url[1].".php";
                unset($url[0]);
                unset($url[1]);

                // If a third param was called (method for controller in this case),
                // set its index to the second index in the url array. Unset the third index.
                if (isset($url[2])) {
                    $url[1] = $url[2];
                    unset($url[2]);
                }
            } else {
                require_once CONTROLLER_PATH.$this->controller.".php";
            }

            $this->controller = new $this->controller(); // Instantiate controller.
            
            // Check for methods.
            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }

            // Check for params.
            if (isset($url)) {
                $this->params = array_values($url);
            } else {
                $this->params = []; // No params found, leave params array empty.
            }

            // Check if method is private or protected. This prevents Controller
            // methods from being called from the url.
            $reflection = new ReflectionMethod($this->controller, $this->method);

            if ($reflection->isProtected() || $reflection->isPrivate()) {
                echo "Method being accessed is either protected or private. Raw Framework has stopped.";
                die();
            } else {
                // Call controller function, the method, and send params.
                call_user_func_array([$this->controller, $this->method], $this->params);
            }
        }
    }
