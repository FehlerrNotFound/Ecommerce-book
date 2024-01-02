<?php
require_once("config.php");
$PageInfo = array();
$PageInfo["pagetitle"] = "Forgot Password";
$page = new Page($PageInfo);
ob_start();
?>


<?php
$MainContent = ob_get_clean();
//print $page->getHeaderContent();
$page->ShowPage($MainContent);
?>
