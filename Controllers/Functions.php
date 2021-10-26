<?php

namespace Controllers;
//fuction from message database
class Functions
{

    static function contains_substr($mainStr, $str, $loc = false)
    {
        if ($loc === false) return (strpos($mainStr, $str) !== false);
        if (strlen($mainStr) < strlen($str)) return false;
        if (($loc + strlen($str)) > strlen($mainStr)) return false;
        return (strcmp(substr($mainStr, $loc, strlen($str)), $str) == 0);
    }
}


?>