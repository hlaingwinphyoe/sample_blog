<?php

function con(){
    return mysqli_connect("localhost","root","","blog");
}

$info = array(
  "name" => "Sample Blog",
  "short" => "SB",
  "description" => "ကျောင်းသားများအတွက် sample project",
);

$role = ["Admin","Editor","User"];

$url = "http://{$_SERVER['HTTP_HOST']}/web_dev/4_sample_blog";

date_default_timezone_set('Asia/Yangon');