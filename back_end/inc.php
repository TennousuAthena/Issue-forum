<?php
/*  ___                      _____
 * |_ _|___ ___ _   _  ___  |  ___|__  _ __ _   _ _ __ ___
 *  | |/ __/ __| | | |/ _ \ | |_ / _ \| '__| | | | '_ ` _ \
 *  | |\__ \__ \ |_| |  __/ |  _| (_) | |  | |_| | | | | | |
 * |___|___/___/\__,_|\___| |_|  \___/|_|   \__,_|_| |_| |_|
 */
header('Content-Type:text/json; charset=UTF-8');

function getUrl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function main_handler($event, $context)
{
    if (!file_exists("config.php")) {
        return (json_encode(["success" => false, "msg" => "Missing configuration file"]));
    }
    require_once "config.php";
    if (!$CONFIG['DEBUG']) {
        echo json_encode($event);
    }
    $_req = objectToArray($event->queryString);
    $targetFile = "controller". DIRECTORY_SEPARATOR . @$_req['method'] . ".php";
    $data = [];
    if (!file_exists($targetFile)) {
        http_response_code(404);
        return ["success" => 0, "msg" => "Method does not exist."];
    } else {
        $staus = include $targetFile;
        $return = array_merge(["success" => $staus], $data);
    }
    return $return;
}

function objectToArray($obj)
{
    $obj = (array) $obj;
    foreach ($obj as $k => $v) {
        if (gettype($v) == 'resource') {
            return;
        }
        if (gettype($v) == 'object' || gettype($v) == 'array') {
            $obj[$k] = (array) object_to_array($v);
        }
    }
    return $obj;
}
