<?php
class Helper
{

    /**
     * Filter $_GET string variable
     *
     * @param string $var
     * @return string|null
     */

    public static function getString(string $var)
    {

        if (isset($_GET[$var])){
            return filter_var($_GET[$var], FILTER_SANITIZE_STRING);
        } else {
            return null;
        }
    }

    /**
     * Filter $_POST string variable
     *
     * @param $var
     * @return mixed|null
     */

    public static function postString($var)
    {
        if (isset($_POST[$var])){
            return filter_var($_POST[$var], FILTER_SANITIZE_STRING);
        } else {
            return null;
        }
    }

    /**
     * Check admin auth
     *
     * @return bool
     */

    public static function isAdmin()
    {
        if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == 'true') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Filter $_POST int variable
     *
     * @param $var
     * @return int|null
     */

    public static function postInt($var)
    {
        if (isset($_POST[$var])){
            return filter_var($_POST[$var], FILTER_SANITIZE_NUMBER_INT);
        } else {
            return null;
        }
    }

}