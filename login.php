<?php
require_once("config.php");
$PageInfo = array();
$PageInfo["pagetitle"] = "Login";
$user = new User();

if ($user->isUserLoggedIn()) {
    header("location:index.php");
}
$PageInfo['isSecure'] = false;

$page = new Page($PageInfo);


ob_start();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $userid = $user->doLoginCheck($username, $password);
    if ($userid) {
        $_SESSION['userid'] = $userid;
        header("location:profile.php");
    } else {
        print "Something is wrong with your credentials, please try again.";
    }
}


?>




<form action="login.php" method="POST">
    UserName <input type="text" name="username">
    <br>
    Password <input type="password" name="password">
    <br>
    <input type="submit" name="submit" value="Login">
    <br>

</form>


<?php
$MainContent = ob_get_clean();
//print $page->getHeaderContent();
$page->ShowPage($MainContent);
?>