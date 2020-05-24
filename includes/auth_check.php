<?php

session_start();

if(!isset($_SESSION['user'])){
    $_SESSION['login_error'] = 'You must login to continue';
    header("Location: login");
}
else{
    
}