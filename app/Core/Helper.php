<?php
class Helper
{

    public static function getString(string $var)
    {

        if (isset($_GET[$var])){
            return filter_var($_GET[$var], FILTER_SANITIZE_STRING);
        } else {
            return null;
        }
    }

    public static function postString($var)
    {
        if (isset($_POST[$var])){
            return filter_var($_POST[$var], FILTER_SANITIZE_STRING);
        } else {
            return null;
        }
    }

    public static function isAdmin()
    {
        if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == 'true') {
            return true;
        } else {
            return false;
        }
    }

    public static function postInt($var)
    {
        if (isset($_POST[$var])){
            return filter_var($_POST[$var], FILTER_SANITIZE_NUMBER_INT);
        } else {
            return null;
        }
    }

}