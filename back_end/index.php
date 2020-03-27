<?php

function main_handler($event, $context) {
    echo("hello world");
    print_r($event);
    return "hello world";
}

?>