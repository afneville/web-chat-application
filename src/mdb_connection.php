<?php

    function mdb_connect() {
        
        $mdb = new mysqli('localhost', 'php', '1234', 'chatter');

        if ($conn->connect_error) {
            
            die("Connection failed: " . $conn->connect_error);
        
        } 
        return $mdb;
    
    }

    function mdb_disconnect($mdb) {

        $mdb->close();

    }

?>
