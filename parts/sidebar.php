<?php
$user = new User();
if ($user->isUserLoggedIn()) {
?>

    <ul>
        <li><a href="myorders.php"> My Orders</a></li>
        <li> Link 1</li>
        <li> Link 1</li>
        <li> Link 1</li>
        <li> Link 1</li>
    </ul>
<?php
} else {
?>

<?php
}
?>