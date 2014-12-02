<?php
$myConnection = new mysqli("localhost", "root", "", "websecurity");
$myConnection->set_charset("utf8");

if ($myConnection->connect_errno) {
    echo "Connecting to the database faild: " . $myConnection->connect_error . ". Error number: " . $myConnection->connect_errno;
}

