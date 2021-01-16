<?php

    class User {

        private $username;
        private $id;

        function __construct($username, $id) {

            $this->username = $username;
            $this->id = $id;

        }

        function get_username() {
        
            return $this->username;
        
        }

        function get_id() {
        
            return $this->id;
        }

    }

?>
