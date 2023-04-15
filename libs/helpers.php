<?php

function getCurrentUrl(){
    return 1;
}

function isAjaxRequest(){
  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
return true;
  }
  return false;
}

function diePage($msg){
    echo "<div style='padding: 30px;background: #f9dede; border: 1px solid #cca4a4; color: #521717; border-radius: 5px; font-family: sans-serif; }'>$msg</div>";
    die();
}

function redirect($url){
  header("location: $url");
  die();
}

function message($msg, $cssClass = 'info'){
  echo "<div class='$cssClass' style='padding: 20px; width: 80%; margin: 10px auto; background: red; text-align: center; border: 1px solid #cca4a4; color: black; border-radius: 5px; font-family: sans-serif'>$msg</div>";
}

function site_url($uri = ''){
  return BASE_URL . $uri;
}