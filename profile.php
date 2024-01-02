<?php
require_once("config.php");
$PageInfo = array();
$PageInfo["pagetitle"] = "Profile Page";
$PageInfo['isSecure'] = true;
$page = new Page($PageInfo);
$user = new User();
ob_start();
//var_dump($_SESSION);
$userInfo = $user->getUserInfo($_SESSION['userid']);

?>
<div id="welcomemessage"> Welcome <?php print $userInfo['first_name']; ?></div>
<?php
print Utility::getHTMLTablefromPHPSingleArray($userInfo);
?>
<?php
$MainContent = ob_get_clean();
//print $page->getHeaderContent();
$page->ShowPage($MainContent);
?>