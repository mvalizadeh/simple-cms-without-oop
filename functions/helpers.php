<?php


function redirect($url)
{
    header('Location: ' . BASE_URL . $url);
    exit;
}

function asset($url)
{
    return BASE_URL . 'assets/' . trim($url, '/');
}

function url($uri)
{
    return BASE_URL . trim($uri, '/');
}


function dd($var)
{
    echo "<pre>";
    var_dump($var);
    exit;
}


function flushMsg($msg){
    
}
