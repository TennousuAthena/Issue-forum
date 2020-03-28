<?php
/*  ___                      _____
 * |_ _|___ ___ _   _  ___  |  ___|__  _ __ _   _ _ __ ___
 *  | |/ __/ __| | | |/ _ \ | |_ / _ \| '__| | | | '_ ` _ \
 *  | |\__ \__ \ |_| |  __/ |  _| (_) | |  | |_| | | | | | |
 * |___|___/___/\__,_|\___| |_|  \___/|_|   \__,_|_| |_| |_|
 */
require_once "inc.php";
class qs{
    public $queryString;
    public $httpMethod;
}
class qa{
    public $code;
    public $cid;
    public $method;
}
$localTest = new qs();
$localTest->httpMethod = $_SERVER['REQUEST_METHOD'];
$localTest->queryString = new qa();
foreach ($_REQUEST as $key => $value) {
    $localTest->queryString->$key = $_REQUEST[$key];
}
$r = main_handler($localTest, []);
if(is_string($r)){
    echo $r;
}else{
    echo json_encode($r);
}