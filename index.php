<?php 
require_once("config.php");
$PageInfo=array();
$PageInfo["pagetitle"]= "Welcome to My Website";
$PageInfo['isSecure']=false;
$page= new Page($PageInfo);
ob_start();
?>

<?php 
$book= new Book();
$Books=$book->getBooks();

foreach($Books as $Book) {
    print $Book['book_id'];
    print "<br>";
    print $Book['title'];
    print "<br>";
    print "<a href=\"buynow.php?bookid={$Book['book_id']}\"> Buy Now</a>";
    print "<br><br>";
}


?>



<?php 
$MainContent=ob_get_clean();
//print $page->getHeaderContent();
$page->ShowPage($MainContent);
?>