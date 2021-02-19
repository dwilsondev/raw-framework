<?php

    /**
     *
     * This class handles error requests. By default, it just processes 404
     * page not found and a possible unknown error.
     *
     */
    class Errors extends Controller
    {
        /**
         * Index function
         *
         * Loads error pages
         *
         * @param string $code Error code.
         * @return void
         */
        public function index($code = "")
        {
            if ($code == 404) {
                $this->view("404");
                die();
            } else {
                echo "Unknown Error.";
                die();
            }
        }
    }
