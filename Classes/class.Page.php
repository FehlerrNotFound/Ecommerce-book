<?php

class Page
{
    public $pagetitle;
    private $isSecure = true;
    private $user;

    public function __construct($PageInfo)
    {
        $this->user = new User();
        $this->pagetitle = isset($PageInfo['pagetitle']) ? $PageInfo['pagetitle'] : "My Website";

        $this->isSecure = isset($PageInfo['isSecure']) ? $PageInfo['isSecure'] : true;

        if ($this->isSecure && !$this->user->isUserLoggedIn()) {
            header("location:secure_page_error.php");
        }
    }

    public function isSecure()
    {
        return $this->isSecure;
    }

    private function getHeaderContent()
    {
        //return file_get_contents("parts/header.php");

        //return file_get_contents("parts/header.php");
        ob_start();
        require("parts/header.php");
        return ob_get_clean();
        //   return "";
    }
    private function getFooterContent()
    {
        return file_get_contents("parts/footer.php");
    }

    private function getSidebarContent()
    {
        //        return file_get_contents("parts/sidebar.php");

        ob_start();
        require("parts/sidebar.php");
        return ob_get_clean();
    }
    private function getHeadSectionContent()
    {
        return "";
    }
    public function ShowPage($MainContent)
    {

        $pagetitle = $this->pagetitle;
        $FooterContent = $this->getFooterContent();
        $HeadContent = $this->getHeadSectionContent();
        $HeaderContent = $this->getHeaderContent();
        $SideBarContent = $this->getSidebarContent();



        $FullPageContent = <<<HTML

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$pagetitle</title>
    <link rel="stylesheet" href="static/css/style.css">
$HeadContent
</head>
<body>
    <div id="page">
        <div id="header">
            $HeaderContent
        </div>
        <div id="middlepart">
            <div id="sidebar">
                $SideBarContent
            </div>
            <div id="contentarea">
$MainContent
            </div>

    </div>
    <div id="footer">
$FooterContent    
</div>
    </div>
    
</body>
</html>


HTML;



        print $FullPageContent;
    }
    public function ShowDefaultPage()
    {
    }
}
