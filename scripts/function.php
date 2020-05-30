<?php

function echobr($text)
{
    echo $text.'<br>';
}

function checkInclude()
{
    return 'Yes';
}

function check_var($name)
{
    if(isset($$name)){
        return $$name;
    }
}

function activeCheck($link, $page)
{
    $check = substr($link, strrpos($link, '/') + 1);
    if(preg_match('/'.$check.'$/', $page)){
    return true;
    }
}

function echoSpace(array $items)
{
    foreach($items as $key=>$value)
    {
        echo $value . ' ';
    }
}


?>