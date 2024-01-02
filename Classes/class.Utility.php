<?php

class Utility
{
    public static function isValidPhoneNumber($string) {
        if (preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/", $string)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isValidEmailAddress($string) {
        if (preg_match("/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $string)) {
            return true;
        } else {
            return false;
        }
        
    }
    static function getDBConnection()
    {

        $conn = new mysqli(SERVER, USER, PASSWORD, DBNAME);

        if (SHOW_MYSQL_ERROR === true) {
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }
        return $conn;
    }
    static function getHTMLTablefromPHPSingleArray(array $array)
    {


        $Table = <<<HERE
        <div class="flex-table">
        <!-- Header -->
        
HERE;

        foreach ($array as $key => $value) {

            $Table .= <<<HERE
    <div class="flex-row">
            <div class="flex-cell">$key</div>
            <div class="flex-cell">$value</div>
            </div>

HERE;
        }


        $Table .= "</div>";

        return $Table;
    }

    static function getHTMLTablefromPHPArray(array $array)
    {


        $AllColumns = array_keys($array['0']);

        //       var_dump($AllColumns);


        $Table = <<<HERE
        <div class="flex-table">
        <!-- Header -->
        <div class="flex-row header">
HERE;

        foreach ($AllColumns as $value) {

            $Table .= <<<HERE
            <div class="flex-cell">$value</div>
HERE;
        }
        $Table .= "</div>";

        foreach ($array as $value) {

            $Table .= <<<HERE
    <!-- Row 1 -->
    <div class="flex-row">
HERE;
            foreach ($value as $key => $value_column) {
                $Table .= <<<HERE
     
            <div class="flex-cell">$value_column</div>

    HERE;
            }
            $Table .= "</div>";
        }


        $Table .= "</div>";

        return $Table;
    }
}
