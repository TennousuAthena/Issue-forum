<?php
/*  ___                      _____
 * |_ _|___ ___ _   _  ___  |  ___|__  _ __ _   _ _ __ ___
 *  | |/ __/ __| | | |/ _ \ | |_ / _ \| '__| | | | '_ ` _ \
 *  | |\__ \__ \ |_| |  __/ |  _| (_) | |  | |_| | | | | | |
 * |___|___/___/\__,_|\___| |_|  \___/|_|   \__,_|_| |_| |_|
 */
if (!(@$_req['code'] && @$_req['cid'] && @$CONFIG['CLIENT_SECRET'])) {
    $data = ["msg" => "Information incomplete"];
    return 0;
}
$reqUrl = "https://github.com/login/oauth/access_token?client_id=" . $_req['cid'] . "&code=" . $_req['code'] . "&client_secret=" . $CONFIG['CLIENT_SECRET'];
$result = getUrl($reqUrl);

$purl = parse_url("http://q.c/?" . $result);
parse_str($purl['query'], $purl);
if (@$purl['access_token'] == "") {
    $data = array_merge(["msg" => "Auth error"], $purl);
    return 0;
}
