<div id="header">
    <h1>My Experiments with PHP</h1>
    <?php
    $user = new User();
    if ($user->isUserLoggedIn()) {
        $userInfo = $user->getUserInfo($_SESSION['userid']);
        print "Hello " . $userInfo['first_name'];
    }
    ?>

    <hr>
    <nav class="navbar">
        <ul class="nav-list">

            <li><a href="index.php"> Home</a> </li>

            <?php

            if ($user->isUserLoggedIn()) {
            ?>
                <li> <a href="profile.php"> Profile</a></li>


            <?php
                // Feeling little brave here.  
            } else { ?>
                <li> <a href="login.php"> Login</a></li>
                <li><a href="registration.php"> Registration</a></li>
            <?php }

            if ($user->isUserLoggedIn()) {
                print "<li><a href='logout.php'>Logout</a></li>";
            }

            ?>
        </ul>
    </nav>
    <hr>
</div>