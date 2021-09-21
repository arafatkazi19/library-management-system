<?php
$db = mysqli_connect("localhost","root","","library_app");

if ($db){
    echo "Connected successfully";
} else {
    echo "something went wrong";
}
