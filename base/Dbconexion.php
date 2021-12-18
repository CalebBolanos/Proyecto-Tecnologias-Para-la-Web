<?php
    Class DbConexion{
        function getdbconnect(){
            $conn = mysqli_connect("localhost","root","","examenweb") or die("Couldn't connect");
            return $conn;
        }
    }
?>