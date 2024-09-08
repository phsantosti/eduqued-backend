<?php
const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "cloudserver.pedrohsantos.com.br",
    "port" => "3306",
    "dbname" => "eduqued",
    "username" => "root",
    "passwd" => "36630013152478963",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];
const CONF_APP_IS_DEBUG = true;
const CONF_APP_DOMAIN = "eduqued.com.br";
const CONF_APP_SECURITY_KEY = "hNoXw6eKeIFuiqyrBgy18q865Lnuw3ob";
