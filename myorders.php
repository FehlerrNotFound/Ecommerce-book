<?php
require_once("config.php");
$PageInfo = array();
$PageInfo["pagetitle"] = "Orders Page";
$PageInfo['isSecure'] = true;
$page = new Page($PageInfo);
$user = new User();
ob_start();
$userInfo = $user->getUserInfo($_SESSION['userid']);

?>
<div id="welcomemessage"> Welcome <?php print $userInfo['first_name']; ?></div>
<h1> My Orders </h1>
<?php
$order = new Order();
$AllOrders = $order->getOrders();
//var_dump($order->getOrders())
print Utility::getHTMLTablefromPHPArray($AllOrders);

?>

<?php
$MainContent = ob_get_clean();
//print $page->getHeaderContent();
$page->ShowPage($MainContent);
?>