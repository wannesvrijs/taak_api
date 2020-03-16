<?php
require_once('autoload.php');
$apiActions = $container->getApiActions();

//get the urlparts
$uri_parts = explode("/",$_SERVER["REQUEST_URI"]);

//count the urlparts
$count = count($uri_parts);

//divide url into different parts
$last_part = end($uri_parts);
$second_last_part = $uri_parts[$count-2];

if($count == $uri_count AND $last_part == 'taken') {
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $apiActions->read();
        return true;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $apiActions->create();
        return true;
    }
    else {
        echo 'unvalid request method';
        return false;
    }
}

if($count == $uri_count + 1 AND $second_last_part == 'taken') {
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $apiActions->read($last_part);
        return true;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
        $apiActions->update($last_part);
        return true;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        $apiActions->delete($last_part);
        return true;
    }
    else {
        echo 'unvalid request method';
        return false;
    }
}