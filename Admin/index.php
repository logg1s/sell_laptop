<?php
header('Access-Control-Allow-Origin: *');
session_start();
require_once "./Models/DB.php";
require_once "./core/Application.php";
require_once "./core/BaseController.php";
$TTCS = new Application();

