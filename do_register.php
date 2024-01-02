<?php
require_once("config.php");
$PageInfo = array();
$PageInfo["pagetitle"] = "Registration Status";
$PageInfo['isSecure'] = false;
$page = new Page($PageInfo);
ob_start();
$user = new User();
$UserInfo = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $UserInfo['username'] = $_POST['username'];
    $UserInfo['email'] = $_POST['email'];
    $UserInfo['password'] = md5($_POST['password']);
    $UserInfo['first_name'] = $_POST['first_name'];
    $UserInfo['last_name'] = $_POST['last_name'];


    if ($user->createUser($UserInfo)) {

        print "<div id='scuccess'>Your registration was successfull.</div>";
    } else {
        foreach ($user->getErrors() as $error) {

            print "$error<br>";
        }
        print "<div id='alert'>Something went wrong, please try again.</div>";
    }
} else {
    print "<div id='alert'>You are not allowed to do this operation.</div>";
}


//$user->getUserInfo("1");
//$user->updateUserInfo(1,$UserInfo);
?>




<?php
$MainContent = ob_get_clean();
//print $page->getHeaderContent();
$page->ShowPage($MainContent);
?>