<?php
    Class DbConexion{
        function getdbconnect(){
            $conn = mysqli_connect("127.0.0.1","root","Bowser:7","examenweb") or die("Couldn't connect");
            return $conn;
        }
    }
?>