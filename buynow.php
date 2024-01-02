<?php
require_once("config.php");
$PageInfo = array();
$PageInfo["pagetitle"] = "Order Page";
$PageInfo['isSecure'] = true;
$page = new Page($PageInfo);
$user = new User();
ob_start();
//var_dump($_SESSION);
$userInfo = $user->getUserInfo($_SESSION['userid']);
?>


<div id="welcomemessage"> Welcome <?php print $userInfo['first_name']; ?></div>
<?php
$book_id = $_GET['bookid'];  // Do some check here
$OrderInfo = array();
$OrderInfo['book_id'] = $book_id;
$OrderInfo['userid'] = $_SESSION['userid']; // Visit later
//$OrderInfo['order_date']="";
$OrderInfo['quantity'] = 1;
$OrderInfo['total_price'] = 12;
$OrderInfo['shipping_address'] = "Anything";
$OrderInfo['order_status'] = "Pending";

$order = new Order();
if ($order->create($OrderInfo)) {
    print " Your order has been taken, It will be processed in next three days.";
}

?>
<?php
$MainContent = ob_get_clean();
//print $page->getHeaderContent();
$page->ShowPage($MainContent);
?>