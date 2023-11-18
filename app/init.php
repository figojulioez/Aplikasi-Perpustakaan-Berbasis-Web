<?php 

spl_autoload_register(function ($class){
	require_once "core/". $class . ".php";
});

session_start();
require "app/core/help.php";
require "app/core/flasher.php";


// $_SESSION["klien"] = "admin";