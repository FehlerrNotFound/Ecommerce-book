<?php
session_start();
mysqli_report(MYSQLI_REPORT_STRICT);
define("ENVIROMENT", "DEV");


if (ENVIROMENT == "DEV") {
    ini_set("display_errors", "Yes");
    error_reporting(E_ALL);
    define("SHOW_MYSQL_ERROR",true);
    define("SERVER", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DBNAME", "apu");
}


if (ENVIROMENT == "PROD") {
    ini_set("display_errors", "No");
    error_reporting(0);
    define("SHOW_MYSQL_ERROR",false);
    define("SERVER", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DBNAME", "apu");
}

///// Please do not change anything after this line, unless you know what you are doing !!! 

require_once("classes/class.Utility.php");
require_once("classes/class.Page.php");
require_once("classes/class.User.php");
require_once("classes/class.Book.php");
require_once("classes/class.Order.php");