<?php

class User
{
    public $userid;
    public $username;
    public $password;
    public $email;
    public $conn;
    private $errors = array();
    public function __construct()
    {
        $this->conn = Utility::getDBConnection();
    }
    public function createUser($UserInfo)
    {
        $username = $UserInfo['username'];
        $email = $UserInfo['email'];
        $password = $UserInfo['password'];
        $first_name = $UserInfo['first_name'];
        $last_name = $UserInfo['last_name'];


        if ($this->checkIfUserNameAvailable($username)) {

            // In production, please prepared statements. 
            $Query = <<< HERE
    INSERT INTO `users` 
    (`userid`, 
    `username`, 
    `password`, 
    `email`, 
    `first_name`, 
    `last_name`, 
    `date_created`)
    VALUES 
    (NULL, 
    '$username', 
    '$password', 
    '$email', 
    '$first_name', 
    '$last_name', 
    current_timestamp());
HERE;

            //print $Query;


            try {
                if ($this->conn->query($Query) === TRUE) {
                    return true;
                } else {
                    $this->showError();
                    return false;
                }
            } catch (PDOException $e) {
                $this->showError();
                return false;
            }
        } else {
            $this->errors[] = "User Name is not available.";

            return false;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getUserInfo($userid)
    {

        $Query = "select * from users where userid='$userid'";

        //print $Query;

        try {
            $result = $this->conn->query($Query);
            if ($result) {
                return $result->fetch_assoc();
            } else {
                $this->showError();
                return false;
            }
        } catch (PDOException $e) {
            $this->showError();
            return false;
        }
    }

    public function updateUserInfo($userid, $UserInfo)
    {
        //return false;

        $username = $UserInfo['username'];
        $email = $UserInfo['email'];
        $password = $UserInfo['password'];
        $first_name = $UserInfo['first_name'];
        $last_name = $UserInfo['last_name'];
        // In production, please prepared statements. 
        $Query = <<< HERE
    UPDATE `users` 
    set  
    `username`='$username', 
    `password`='$username', 
    `email`='$email', 
    `first_name`='$first_name', 
    `last_name`='last_name'
    where `userid`='$userid'
HERE;

        //print $Query;

        try {
            if ($this->conn->query($Query) === TRUE) {
                return true;
            } else {
                $this->showError();
                return false;
            }
        } catch (PDOException $e) {
            $this->showError();
            return false;
        }
    }


    private function showError($message = "")
    {

        if (SHOW_MYSQL_ERROR) {

            print $this->conn->error;
        }

        if ($message) {
            print $message;
        }
    }


    public function checkIfUserNameAvailable($username)
    {

        $Query = "select * from users where `username`='$username'";

        //  print $Query;


        try {
            $result = $this->conn->query($Query);

            if ($result->num_rows == 0) {
                return true;
            } else {
                $this->showError("I am from " . __METHOD__);
                return false;
            }
        } catch (PDOException $e) {
            $this->showError();
            return false;
        }
    }

    public function doLoginCheck($username, $password)
    {
        $password = md5($password);

        $Query = "select * from users where `username`='$username' AND `password`= '$password'";

        //  print $Query;


        try {
            $result = $this->conn->query($Query);

            if ($result->num_rows == 1) {
                $userInfo = $result->fetch_assoc();
                // var_dump($userInfo);
                return $userInfo['userid'];
            } else {
                $this->showError("I am from " . __METHOD__);
                return false;
            }
        } catch (PDOException $e) {
            $this->showError();
            return false;
        }
    }


    public function isUserLoggedIn()
    {
        if (isset($_SESSION['userid'])) {
            return true;
        } else {
            return false;
        }
    }
}
