<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/FindYourJob2/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", FRONT_ROOT."img/");
define('API_KEY','x-api-key: 4f3bceed-50ba-4461-a910-518598664c08');
define('API_URL', 'https://utn-students-api.herokuapp.com/api/');


define("DB_HOST", "localhost");
define("DB_NAME", "FindYourJob");
define("DB_USER", "root");
define("DB_PASS", "");


define('EMAIL','findyourjob.utn@gmail.com');
define('EMAILPASS','Findyourjob123');

?>

