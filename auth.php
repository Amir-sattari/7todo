<?php
include "bootstrap/init.php";

$home_url = site_url();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET['action'];
    $params = $_POST;
    if ($action == 'register') {
        $result = register($params);
        if (!$result) {
            message("ERROR: an error in Registration");
        } else {
            message("You are successfully registered. Welcome to 7Todo. <br>
            <a href='{$home_url}auth.php'>Please login.</a>", 'success');
        }
    } else if ($action == 'login') {
        $result = login($params['email'], $params['password']);
        if (!$result) {
            message("ERROR: email or password is incorrect.");
        } else {
            redirect(site_url());
        }
    }
}




include "tpl/tpl-auth.php";
