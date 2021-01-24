<?php

    function mdb_connect() {
        
        $mdb = new mysqli('localhost', 'php', '1234', 'chatter');

        return $mdb;
    
    }

    function mdb_disconnect($mdb) {

        $mdb->close();

    }

?>
