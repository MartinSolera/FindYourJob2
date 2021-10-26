<?php

    namespace Utils;

    class Utils{

        public static function checkStudentSession(){
            if(!isset($_SESSION['student'])){
                header("Location:".FRONT_ROOT);
            }
        }

        public static function checkAdminSession(){
            if(!isset($_SESSION['admin'])){
                header("Location:".FRONT_ROOT);
            }
        }
        public static function checkSession(){
            if(!(isset($_SESSION['admin']) || isset($_SESSION['student']))){
                $userNotLogged = true;
                require_once(VIEWS_PATH ."login.php");
            }
        }

        public static function logout(){
            session_destroy();
            header("Location: ".FRONT_ROOT);
        }


        public static function completeSearch(String $haystack, String $needle)
        {
            return $needle != '' && strncmp($haystack, $needle, strlen($needle)) == 0;
        }
    }

    

?>